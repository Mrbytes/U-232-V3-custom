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
    // *Updated* Reqest Filler Achievement Mod by MelvinMeow
    $res = sql_query("SELECT id, reqfilled, reqlvl FROM ".TBL_USERSACHIEV." WHERE reqfilled >= '1'") or sqlerr(__FILE__, __LINE__);
    $msg_buffer = $usersachiev_buffer = $achievements_buffer = array();
    if (mysqli_num_rows($res) > 0) {
        $dt = TIME_NOW;
        $subject = sqlesc("New Achievement Earned!");
        $points = rand(1, 3);
        while ($arr = mysqli_fetch_assoc($res)) {
            $reqfilled = (int)$arr['reqfilled'];
            $lvl = (int)$arr['reqlvl'];
            if ($reqfilled >= 1 && $lvl == 0) {
                $msg = sqlesc("Congratulations, you have just earned the [b]Request Filler LVL1[/b] achievement. :) [img]http://u-232.com/pic/achievements/reqfiller1.png[/img]");
                $msgs_buffer[] = '(0,' . $arr['id'] . ',' . TIME_NOW . ', ' . sqlesc($msg) . ', ' . sqlesc($subject) . ')';
                $achievements_buffer[] = '(' . $arr['id'] . ', ' . TIME_NOW . ', \'Request Filler LVL1\', \'reqfiller1.png\' , \'Filled at least 1 request from the request page.\')';
                $usersachiev_buffer[] = '(' . $arr['id'] . ',1, ' . $points . ')';
                $mc1->delete_value('inbox_new_' . $arr['id']);
                $mc1->delete_value('inbox_new_sb_' . $arr['id']);
                $mc1->delete_value('user_achievement_points_' . $arr['id']);
                $var1 = 'reqlvl';
            }
            if ($reqfilled >= 5 && $lvl == 1) {
                $msg = sqlesc("Congratulations, you have just earned the [b]Request Filler LVL2[/b] achievement. :) [img]http://u-232.com/pic/achievements/reqfiller2.png[/img]");
                $msgs_buffer[] = '(0,' . $arr['id'] . ',' . TIME_NOW . ', ' . sqlesc($msg) . ', ' . sqlesc($subject) . ')';
                $achievements_buffer[] = '(' . $arr['id'] . ', ' . TIME_NOW . ', \'Request Filler LVL2\', \'reqfiller2.png\' , \'Filled at least 5 requests from the request page.\')';
                $usersachiev_buffer[] = '(' . $arr['id'] . ',2, ' . $points . ')';
                $mc1->delete_value('inbox_new_' . $arr['id']);
                $mc1->delete_value('inbox_new_sb_' . $arr['id']);
                $var1 = 'reqlvl';
            }
            if ($reqfilled >= 10 && $lvl == 2) {
                $msg = sqlesc("Congratulations, you have just earned the [b]Request Filler LVL3[/b] achievement. :) [img]http://u-232.com/pic/achievements/reqfiller3.png[/img]");
                $msgs_buffer[] = '(0,' . $arr['id'] . ',' . TIME_NOW . ', ' . sqlesc($msg) . ', ' . sqlesc($subject) . ')';
                $achievements_buffer[] = '(' . $arr['id'] . ', ' . TIME_NOW . ', \'Request Filler LVL3\', \'reqfiller3.png\' , \'Filled at least 10 requests from the request page.\')';
                $usersachiev_buffer[] = '(' . $arr['id'] . ',3, ' . $points . ')';
                $mc1->delete_value('inbox_new_' . $arr['id']);
                $mc1->delete_value('inbox_new_sb_' . $arr['id']);
                $mc1->delete_value('user_achievement_points_' . $arr['id']);
                $var1 = 'reqlvl';
            }
            if ($reqfilled >= 25 && $lvl == 3) {
                $msg = sqlesc("Congratulations, you have just earned the [b]Request Filler LVL4[/b] achievement. :) [img]http://u-232.com/pic/achievements/reqfiller4.png[/img]");
                $msgs_buffer[] = '(0,' . $arr['id'] . ',' . TIME_NOW . ', ' . sqlesc($msg) . ', ' . sqlesc($subject) . ')';
                $achievements_buffer[] = '(' . $arr['id'] . ', ' . TIME_NOW . ', \'Request Filler LVL4\', \'reqfiller4.png\' , \'Filled at least 25 requests from the request page.\')';
                $usersachiev_buffer[] = '(' . $arr['id'] . ',4, ' . $points . ')';
                $mc1->delete_value('inbox_new_' . $arr['id']);
                $mc1->delete_value('inbox_new_sb_' . $arr['id']);
                $mc1->delete_value('user_achievement_points_' . $arr['id']);
                $var1 = 'reqlvl';
            }
            if ($reqfilled >= 50 && $lvl == 4) {
                $msg = sqlesc("Congratulations, you have just earned the [b]Request Filler LVL5[/b] achievement. :) [img]http://u-232.com/pic/achievements/reqfiller5.png[/img]");
                $msgs_buffer[] = '(0,' . $arr['id'] . ',' . TIME_NOW . ', ' . sqlesc($msg) . ', ' . sqlesc($subject) . ')';
                $achievements_buffer[] = '(' . $arr['id'] . ', ' . TIME_NOW . ', \'Request Filler LVL5\', \'reqfiller5.png\' , \'Filled at least 50 requests from the request page.\')';
                $usersachiev_buffer[] = '(' . $arr['id'] . ',5, ' . $points . ')';
                $mc1->delete_value('inbox_new_' . $arr['id']);
                $mc1->delete_value('inbox_new_sb_' . $arr['id']);
                $mc1->delete_value('user_achievement_points_' . $arr['id']);
                $var1 = 'reqlvl';
            }
        }
        $count = count($achievements_buffer);
        if ($count > 0) {
            sql_query("INSERT INTO ".TBL_MESSAGES." (sender,receiver,added,msg,subject) VALUES " . implode(', ', $msgs_buffer)) or sqlerr(__FILE__, __LINE__);
            sql_query("INSERT INTO ".TBL_ACHIEVEMENTS." (userid, date, achievement, icon, description) VALUES " . implode(', ', $achievements_buffer) . " ON DUPLICATE key UPDATE date=values(date),achievement=values(achievement),icon=values(icon),description=values(description)") or sqlerr(__FILE__, __LINE__);
            sql_query("INSERT INTO ".TBL_USERSACHIEV." (id, $var1, achpoints) VALUES " . implode(', ', $usersachiev_buffer) . " ON DUPLICATE key UPDATE $var1=values($var1), achpoints=achpoints+values(achpoints)") or sqlerr(__FILE__, __LINE__);
            if ($queries > 0) write_log("Achievements Cleanup: Achievements Request Filler Completed using $queries queries. Request Filler Achievements awarded to - " . $count . " Member(s)");
        }
        unset($usersachiev_buffer, $achievements_buffer, $msgs_buffer, $count);
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
