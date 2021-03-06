<?php
/**
 * https://github.com/Bigjoos/
 * Licence Info: GPL
 * Copyright (C) 2010 U-232 v.3
 * A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 * Project Leaders: Mindless, putyn.
 +------------------------------------------------
 |   $Date$
 |   $Revision$
 |   $Author$ MelvinMeow
 |   $URL$  tophos.org
 +------------------------------------------------
 */
function docleanup($data)
{
    global $INSTALLER09, $queries, $mc1;
    set_time_limit(0);
    ignore_user_abort(1);
    // Updated Signature Setter Achievement
    $res = sql_query("SELECT id, sigset FROM ".TBL_USERSACHIEV." WHERE sigset = '1' AND sigach = '0'") or sqlerr(__FILE__, __LINE__);
    $msg_buffer = $usersachiev_buffer = $achievements_buffer = array();
    if (mysqli_num_rows($res) > 0) {
        $subject = sqlesc("New Achievement Earned!");
        $msg = sqlesc("Congratulations, you have just earned the [b]Signature Setter[/b] achievement. :) [img]http://u-232.com/pic/achievements/signature.png[/img]");
        while ($arr = mysqli_fetch_assoc($res)) {
            $dt = TIME_NOW;
            $points = rand(1, 3);
            $msgs_buffer[] = '(0,' . $arr['id'] . ',' . TIME_NOW . ', ' . sqlesc($msg) . ', ' . sqlesc($subject) . ')';
            $achievements_buffer[] = '(' . $arr['id'] . ', ' . TIME_NOW . ', \'Signature Setter\', \'signature.png\' , \'User has successfully set a signature on profile settings.\')';
            $usersachiev_buffer[] = '(' . $arr['id'] . ',1, ' . $points . ')';
            $mc1->delete_value('inbox_new_' . $arr['id']);
            $mc1->delete_value('inbox_new_sb_' . $arr['id']);
            $mc1->delete_value('user_achievement_points_' . $arr['id']);
        }
        $count = count($achievements_buffer);
        if ($count > 0) {
            sql_query("INSERT INTO ".TBL_MESSAGES." (sender,receiver,added,msg,subject) VALUES " . implode(', ', $msgs_buffer)) or sqlerr(__FILE__, __LINE__);
            sql_query("INSERT INTO ".TBL_ACHIEVEMENTS." (userid, date, achievement, icon, description) VALUES " . implode(', ', $achievements_buffer) . " ON DUPLICATE key UPDATE date=values(date),achievement=values(achievement),icon=values(icon),description=values(description)") or sqlerr(__FILE__, __LINE__);
            sql_query("INSERT INTO ".TBL_USERSACHIEV." (id, sigach, achpoints) VALUES " . implode(', ', $usersachiev_buffer) . " ON DUPLICATE key UPDATE sigach=values(sigach), achpoints=achpoints+values(achpoints)") or sqlerr(__FILE__, __LINE__);
            if ($queries > 0) write_log("Achievements Cleanup:  Achievements Signature Setter Completed using $queries queries. Signature Setter Achievements awarded to - " . $count . " Member(s)");
        }
        unset($usersachiev_buffer, $achievement_buffer, $msgs_buffer, $count);
    }
    if (false !== mysqli_affected_rows($GLOBALS["___mysqli_ston"])) {
        $data['clean_desc'] = mysqli_affected_rows($GLOBALS["___mysqli_ston"]) . " items updated";
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
