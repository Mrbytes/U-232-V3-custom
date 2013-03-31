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
    //=== Pirate status by Bigjoos/pdq:)
    $res = sql_query("SELECT id, modcomment FROM ".TBL_USERS." WHERE pirate > 0 AND pirate < ".TIME_NOW) or sqlerr(__FILE__, __LINE__);
    $msgs_buffer = $users_buffer = array();
    if (mysqli_num_rows($res) > 0) {
        $subject = "Pirate status expired.";
        $msg = "Your Pirate status has timed out and has been auto-removed by the system. If you would like to have it again, exchange some Karma Bonus Points again. Cheers!\n";
        while ($arr = mysqli_fetch_assoc($res)) {
            $modcomment = $arr['modcomment'];
            $modcomment = get_date(TIME_NOW, 'DATE', 1)." - pirate status Automatically Removed By System.\n".$modcomment;
            $modcom = sqlesc($modcomment);
            $msgs_buffer[] = '(0,'.$arr['id'].','.TIME_NOW.', '.sqlesc($msg).', '.sqlesc($subject).' )';
            $users_buffer[] = '('.$arr['id'].', \'0\', '.$modcom.')';
            $mc1->begin_transaction('user'.$arr['id']);
            $mc1->update_row(false, array(
                'pirate' => 0
            ));
            $mc1->commit_transaction($INSTALLER09['expires']['user_cache']);
            $mc1->begin_transaction('user_stats_'.$arr['id']);
            $mc1->update_row(false, array(
                'modcomment' => $modcomment
            ));
            $mc1->commit_transaction($INSTALLER09['expires']['user_stats']);
            $mc1->begin_transaction('MyUser_'.$arr['id']);
            $mc1->update_row(false, array(
                'pirate' => 0
            ));
            $mc1->commit_transaction($INSTALLER09['expires']['curuser']);
            $mc1->delete_value('inbox_new_'.$arr['id']);
            $mc1->delete_value('inbox_new_sb_'.$arr['id']);
        }
        $count = count($users_buffer);
        if ($count > 0) {
            sql_query("INSERT INTO ".TBL_MESSAGES." (sender,receiver,added,msg,subject) VALUES ".implode(', ', $msgs_buffer)) or sqlerr(__FILE__, __LINE__);
            sql_query("INSERT INTO ".TBL_USERS." (id, pirate, modcomment) VALUES ".implode(', ', $users_buffer)." ON DUPLICATE key UPDATE pirate=values(pirate), modcomment=concat(values(modcomment),modcomment)") or sqlerr(__FILE__, __LINE__);
            write_log("Cleanup - Removed Pirate status from ".$count." members");
        }
        unset($users_buffer, $msgs_buffer, $count);
    }
    //==End
    if ($queries > 0) write_log("Pirate clean-------------------- Pirate cleanup Complete using $queries queries --------------------");
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
