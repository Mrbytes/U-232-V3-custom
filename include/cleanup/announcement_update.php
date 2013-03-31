<?php
/**
 *   https://github.com/Bigjoos/
 *   Licence Info: GPL
 *   Copyright (C) 2010 U-232 v.3
 *   A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 *   Project Leaders: Mindless, putyn.
 *
 */
function cleanup_log($data)
{
    $text = sqlesc($data['clean_title']);
    $added = TIME_NOW;
    $ip = sqlesc($_SERVER['REMOTE_ADDR']);
    $desc = sqlesc($data['clean_desc']);
    sql_query("INSERT INTO ".TBL_CLEANUP_LOG." (clog_event, clog_time, clog_ip, clog_desc) VALUES ($text, $added, $ip, {$desc})") or sqlerr(__FILE__, __LINE__);
}
function docleanup($data)
{
    global $INSTALLER09, $queries, $mc1;
    set_time_limit(1200);
    ignore_user_abort(1);
    //== Delete expired announcements and processors
    sql_query("DELETE ".TBL_ANNOUNCEMENT_PROCESS." FROM ".TBL_ANNOUNCEMENT_PROCESS." LEFT JOIN ".TBL_USERS." ON ".TBL_ANNOUNCEMENT_PROCESS.".user_id = ".TBL_USERS.".id WHERE ".TBL_USERS.".id IS NULL");
    sql_query("DELETE FROM ".TBL_ANNOUNCEMENT_MAIN." WHERE expires < ".TIME_NOW);
    sql_query("DELETE ".TBL_ANNOUNCEMENT_PROCESS." FROM ".TBL_ANNOUNCEMENT_PROCESS." LEFT JOIN ".TBL_ANNOUNCEMENT_MAIN." ON ".TBL_ANNOUNCEMENT_PROCESS.".main_id = ".TBL_ANNOUNCEMENT_MAIN.".main_id WHERE ".TBL_ANNOUNCEMENT_MAIN.".main_id IS NULL");
    if ($queries > 0) write_log("Announcement Clean -------------------- Announcement cleanup Complete using $queries queries --------------------");
    if (false !== mysqli_affected_rows($GLOBALS["___mysqli_ston"])) {
        $data['clean_desc'] = mysqli_affected_rows($GLOBALS["___mysqli_ston"])." items deleted/updated";
    }
    if ($data['clean_log']) {
        cleanup_log($data);
    }
}
?>
