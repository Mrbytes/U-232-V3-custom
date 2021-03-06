<?php
/**
 * https://github.com/Bigjoos/
 * Licence Info: GPL
 * Copyright (C) 2010 U-232 v.3
 * A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 * Project Leaders: Mindless, putyn.
 *
 */
// Achievements mod by MelvinMeow
require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'bittorrent.php');
require_once (INCL_DIR . 'user_functions.php');
require_once (INCL_DIR . 'bbcode_functions.php');
require_once (CLASS_DIR . 'page_verify.php');
dbconn(false);
loggedinorreturn();
$newpage = new page_verify();
$newpage->check('takecounts');
$lang = array_merge(load_language('global'));
$id = (int)$CURUSER['id'];
$rand = rand(1, 32);
$res = sql_query("SELECT achpoints FROM ".TBL_USERSACHIEV." WHERE id =" . sqlesc($id) . " AND achpoints >= '1'") or sqlerr(__FILE__, __LINE__);
$row = mysqli_fetch_row($res);
$count = $row['0'];
if (!$count) {
    header("Refresh: 3; url=achievementhistory.php?id=$id");
    stderr("No Achievement Bonus Points", "It appears that you currently have no Achievement Bonus Points available to spend.");
    exit();
}
$HTMLOUT = '';
$get_bonus = sql_query("SELECT * FROM ".TBL_ACH_BONUS." WHERE bonus_id =" . sqlesc($rand)) or sqlerr(__FILE__, __LINE__);
$bonus = mysqli_fetch_assoc($get_bonus);
$bonus_desc = htmlsafechars($bonus['bonus_desc']);
$bonus_type = htmlsafechars($bonus['bonus_type']);
$bonus_do = htmlsafechars($bonus['bonus_do']);
$get_d = sql_query("SELECT * FROM ".TBL_USERS." WHERE id =" . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
$dn = mysqli_fetch_assoc($get_d);
$down = (float)$dn['downloaded'];
$up = (float)$dn['uploaded'];
$invite = (int)$dn['invites'];
$karma = (float)$dn['seedbonus'];
if ($bonus_type == 1) {
    if ($down >= $bonus_do) {
        $msg = "Congratulations, you have just won $bonus_desc";
        sql_query("UPDATE ".TBL_USERSACHIEV." SET achpoints = achpoints-1, spentpoints = spentpoints+1 WHERE id =" . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
        $mc1->delete_value('user_achievement_points_' . $id);
        $sql = "UPDATE ".TBL_USERS." SET downloaded = downloaded - " . sqlesc($bonus_do) . " WHERE id = " . sqlesc($id);
        sql_query($sql) or sqlerr(__FILE__, __LINE__);
        $mc1->begin_transaction('userstats_' . $id);
        $mc1->update_row(false, array(
            'downloaded' => $down - $bonus_do
        ));
        $mc1->commit_transaction($INSTALLER09['expires']['u_stats']);
        $mc1->begin_transaction('user_stats_' . $id);
        $mc1->update_row(false, array(
            'downloaded' => $down - $bonus_do
        ));
        $mc1->commit_transaction($INSTALLER09['expires']['user_stats']);
    }
    if ($down < $bonus_do) {
        $msg = "Congratulations, your downloaded total has been reset from a negative value back to 0";
        sql_query("UPDATE ".TBL_USERSACHIEV." SET achpoints = achpoints-1, spentpoints = spentpoints+1 WHERE id =" . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
        $mc1->delete_value('user_achievement_points_' . $id);
        $sql = "UPDATE ".TBL_USERS." SET downloaded = '0' WHERE id =" . sqlesc($id);
        sql_query($sql) or sqlerr(__FILE__, __LINE__);
        $mc1->begin_transaction('userstats_' . $id);
        $mc1->update_row(false, array(
            'downloaded' => 0
        ));
        $mc1->commit_transaction($INSTALLER09['expires']['u_stats']);
        $mc1->begin_transaction('user_stats_' . $id);
        $mc1->update_row(false, array(
            'downloaded' => 0
        ));
        $mc1->commit_transaction($INSTALLER09['expires']['user_stats']);
    }
}
if ($bonus_type == 2) {
    $msg = "Congratulations, you have just won $bonus_desc";
    sql_query("UPDATE ".TBL_USERSACHIEV." SET achpoints = achpoints-1, spentpoints = spentpoints+1 WHERE id = " . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
    $mc1->delete_value('user_achievement_points_' . $id);
    $sql = "UPDATE ".TBL_USERS." SET uploaded = uploaded + " . sqlesc($bonus_do) . " WHERE id =" . sqlesc($id);
    sql_query($sql) or sqlerr(__FILE__, __LINE__);
    $mc1->begin_transaction('userstats_' . $id);
    $mc1->update_row(false, array(
        'uploaded' => $up + $bonus_do
    ));
    $mc1->commit_transaction($INSTALLER09['expires']['u_stats']);
    $mc1->begin_transaction('user_stats_' . $id);
    $mc1->update_row(false, array(
        'uploaded' => $up + $bonus_do
    ));
    $mc1->commit_transaction($INSTALLER09['expires']['user_stats']);
}
if ($bonus_type == 3) {
    $msg = "Congratulations, you have just won $bonus_desc";
    sql_query("UPDATE ".TBL_USERSACHIEV." SET achpoints = achpoints-1, spentpoints = spentpoints+1 WHERE id = " . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
    $mc1->delete_value('user_achievement_points_' . $id);
    $sql = "UPDATE ".TBL_USERS." SET invites = invites + " . sqlesc($bonus_do) . " WHERE id =" . sqlesc($id);
    sql_query($sql) or sqlerr(__FILE__, __LINE__);
    $mc1->begin_transaction('user' . $id);
    $mc1->update_row(false, array(
        'invites' => $invite + $bonus_do
    ));
    $mc1->commit_transaction($INSTALLER09['expires']['user_cache']);
    $mc1->begin_transaction('MyUser_' . $id);
    $mc1->update_row(false, array(
        'invites' => $invite + $bonus_do
    ));
    $mc1->commit_transaction($INSTALLER09['expires']['curuser']);
}
if ($bonus_type == 4) {
    $msg = "Congratulations, you have just won $bonus_desc";
    sql_query("UPDATE ".TBL_USERSACHIEV." SET achpoints = achpoints-1, spentpoints = spentpoints+1 WHERE id =" . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
    $mc1->delete_value('user_achievement_points_' . $id);
    $sql = "UPDATE ".TBL_USERS." SET seedbonus = seedbonus + " . sqlesc($bonus_do) . " WHERE id =" . sqlesc($id);
    sql_query($sql) or sqlerr(__FILE__, __LINE__);
    $mc1->begin_transaction('userstats_' . $id);
    $mc1->update_row(false, array(
        'seedbonus' => $karma + $bonus_do
    ));
    $mc1->commit_transaction($INSTALLER09['expires']['u_stats']);
    $mc1->begin_transaction('user_stats_' . $id);
    $mc1->update_row(false, array(
        'seedbonus' => $karma + $bonus_do
    ));
    $mc1->commit_transaction($INSTALLER09['expires']['user_stats']);
}
if ($bonus_type == 5) {
    $rand_fail = rand(1, 5);
    if ($rand_fail == 1) {
        $msg = "Sorry, Dunk64 has just run over you with his ultra-powered wheelchair. Better luck next time.";
        sql_query("UPDATE ".TBL_USERSACHIEV." SET achpoints = achpoints-1, spentpoints = spentpoints+1 WHERE id =" . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
        $mc1->delete_value('user_achievement_points_' . $id);
    }
    if ($rand_fail == 2) {
        $msg = "Sorry, We put your achievement bonus point into the collection plate in an attempt to get Ducktape a prostitute.";
        sql_query("UPDATE ".TBL_USERSACHIEV." SET achpoints = achpoints-1, spentpoints = spentpoints+1 WHERE id =" . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
        $mc1->delete_value('user_achievement_points_' . $id);
    }
    if ($rand_fail == 3) {
        $msg = "Sorry, The evil villian Adam has stolen your bonus point.";
        sql_query("UPDATE ".TBL_USERSACHIEV." SET achpoints = achpoints-1, spentpoints = spentpoints+1 WHERE id =" . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
        $mc1->delete_value('user_achievement_points_' . $id);
    }
    if ($rand_fail == 4) {
        $msg = "Sorry, Somehelp has used your achievement bonus point in attempt to buy puppy chow to lure doggies into his dinner plate.";
        sql_query("UPDATE ".TBL_USERSACHIEV." SET achpoints = achpoints-1, spentpoints = spentpoints+1 WHERE id =" . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
        $mc1->delete_value('user_achievement_points_' . $id);
    }
    if ($rand_fail == 5) {
        $msg = "Sorry, Hoodini has magically made your achievement bonus point dissapear, better luck next time.";
        sql_query("UPDATE ".TBL_USERSACHIEV." SET achpoints = achpoints-1, spentpoints = spentpoints+1 WHERE id =" . sqlesc($id)) or sqlerr(__FILE__, __LINE__);
        $mc1->delete_value('user_achievement_points_' . $id);
    }
}
header("Refresh: 3; url=achievementhistory.php?id=$id");
stderr("Random Achievement Bonus", "$msg");
echo stdhead('Achievement Random Bonus') . $HTMLOUT . stdfoot();
?>
