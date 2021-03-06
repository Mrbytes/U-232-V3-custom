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
    sql_query("UPDATE `".TBL_FREESLOTS."` SET `addedup` = 0 WHERE `addedup` != 0 AND `addedup` < ".TIME_NOW) or sqlerr(__FILE__, __LINE__);
    sql_query("UPDATE `".TBL_FREESLOTS."` SET `addedfree` = 0 WHERE `addedfree` != 0 AND `addedfree` < ".TIME_NOW) or sqlerr(__FILE__, __LINE__);
    sql_query("DELETE FROM `".TBL_FREESLOTS."` WHERE `addedup` = 0 AND `addedfree` = 0") or sqlerr(__FILE__, __LINE__);
    if ($queries > 0) write_log("Freeslot Clean -------------------- Freeslot Clean Complete using $queries queries--------------------");
    if (false !== mysqli_affected_rows($GLOBALS["___mysqli_ston"])) {
        $data['clean_desc'] = mysqli_affected_rows($GLOBALS["___mysqli_ston"])." items deleted/updated";
    }
    if ($data['clean_log']) {
        cleanup_log($data);
    }
}
?>
