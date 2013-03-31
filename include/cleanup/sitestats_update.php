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
    global $INSTALLER09, $queries;
    set_time_limit(0);
    ignore_user_abort(1);
    //== 09 Stats
    $registered = get_row_count(TBL_USERS);
    $unverified = get_row_count(TBL_USERS, "WHERE status='pending'");
    $torrents = get_row_count(TBL_TORRENTS);
    $seeders = get_row_count(TBL_PEERS, "WHERE seeder='yes'");
    $leechers = get_row_count(TBL_PEERS, "WHERE seeder='no'");
    $torrentstoday = get_row_count(TBL_TORRENTS, 'WHERE added > '.TIME_NOW.' - 86400');
    $donors = get_row_count(TBL_USERS, "WHERE donor ='yes'");
    $unconnectables = get_row_count(TBL_PEERS, " WHERE connectable='no'");
    $forumposts = get_row_count(TBL_POSTS);
    $forumtopics = get_row_count(TBL_TOPICS);
    $dt = TIME_NOW - 300; // Active users last 5 minutes
    $numactive = get_row_count(TBL_USERS, "WHERE last_access >= $dt");
    $torrentsmonth = get_row_count(TBL_TORRENTS, 'WHERE added > '.TIME_NOW.' - 2592000');
    $gender_na = get_row_count(TBL_USERS, "WHERE gender='N/A'");
    $gender_male = get_row_count(TBL_USERS, "WHERE gender='Male'");
    $gender_female = get_row_count(TBL_USERS, "WHERE gender='Female'");
    $powerusers = get_row_count(TBL_USERS, "WHERE class='1'");
    $disabled = get_row_count(TBL_USERS, "WHERE enabled='no'");
    $uploaders = get_row_count(TBL_USERS, "WHERE class='3'");
    $moderators = get_row_count(TBL_USERS, "WHERE class='4'");
    $administrators = get_row_count(TBL_USERS, "WHERE class='5'");
    $sysops = get_row_count(TBL_USERS, "WHERE class='6'");
    sql_query("UPDATE ".TBL_STATS." SET regusers = '$registered', unconusers = '$unverified', torrents = '$torrents', seeders = '$seeders', leechers = '$leechers', unconnectables = '$unconnectables', torrentstoday = '$torrentstoday', donors = '$donors', forumposts = '$forumposts', forumtopics = '$forumtopics', numactive = '$numactive', torrentsmonth = '$torrentsmonth', gender_na = '$gender_na', gender_male = '$gender_male', gender_female = '$gender_female', powerusers = '$powerusers', disabled = '$disabled', uploaders = '$uploaders', moderators = '$moderators', administrators = '$administrators', sysops = '$sysops' WHERE id = '1' LIMIT 1");
    if ($queries > 0) write_log("Stats clean-------------------- Stats cleanup Complete using $queries queries --------------------");
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
