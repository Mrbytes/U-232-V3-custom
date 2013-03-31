<?php
/**
 *   https://github.com/Bigjoos/
 *   Licence Info: GPL
 *   Copyright (C) 2010 U-232 v.3
 *   A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 *   Project Leaders: Mindless, putyn.
 *
 */
function docleanup($data)
{
    global $INSTALLER09, $queries, $mc1;
    set_time_limit(0);
    ignore_user_abort(1);
    //=== delete from now viewing after 15 minutes
    sql_query('DELETE FROM ".TBL_NOW_VIEWING." WHERE added < '.(TIME_NOW - 900));
    //=== fix any messed up counts
    $forums = sql_query('SELECT f.id, count( DISTINCT t.id ) AS '.TBL_TOPICS.', count(p.id) AS posts
                          FROM '.TBL_FORUMS.' f
                          LEFT JOIN '.TBL_TOPICS.' t ON f.id = t.forum_id
                          LEFT JOIN '.TBL_POSTS.' p ON t.id = p.topic_id
                          GROUP BY f.id');
    while ($forum = mysqli_fetch_assoc($forums)) {
        $forum['posts'] = $forum['topics'] > 0 ? $forum['posts'] : 0;
        sql_query('update '.TBL_FORUMS.' set post_count = '.$forum['posts'].', topic_count = '.$forum['topics'].' where id='.$forum['id']);
    }
    if ($queries > 0) write_log("Forum clean-------------------- Forum cleanup Complete using $queries queries --------------------");
    if (false !== mysqli_affected_rows($GLOBALS["___mysqli_ston"])) {
        $data['clean_desc'] = mysqli_affected_rows($GLOBALS["___mysqli_ston"])." items updated";
    }
    if ($data['clean_log']) {
        cleanup_log($data);
    }
}
function cleanup_log($data)
{
    $text = sqlesc($data['clean_title']);
    $added = TIME_NOW;
    $ip = sqlesc($_SERVER['REMOTE_ADDR']);
    $desc = sqlesc($data['clean_desc']);
    sql_query("INSERT INTO ".TBL_CLEANUP_LOG." (clog_event, clog_time, clog_ip, clog_desc) VALUES ($text, $added, $ip, {$desc})") or sqlerr(__FILE__, __LINE__);
}
?>
