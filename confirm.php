<?php
/**
 *   https://github.com/Bigjoos/
 *   Licence Info: GPL
 *   Copyright (C) 2010 U-232 v.3
 *   A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 *   Project Leaders: Mindless, putyn.
 *
 */
require_once (dirname(__FILE__).DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'bittorrent.php');
require_once (INCL_DIR.'user_functions.php');
global $CURUSER;
if (!$CURUSER) {
    get_template();
}
$lang = array_merge(load_language('global') , load_language('confirm'));
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$md5 = isset($_GET['secret']) ? $_GET['secret'] : '';
if (!is_valid_id($id)) stderr("{$lang['confirm_user_error']}", "{$lang['confirm_invalid_id']}");
if (!preg_match("/^(?:[\d\w]){32}$/", $md5)) {
    stderr("{$lang['confirm_user_error']}", "{$lang['confirm_invalid_key']}");
}
dbconn();
$res = sql_query("SELECT passhash, editsecret, status FROM ".TBL_USERS." WHERE id =".sqlesc($id));
$row = mysqli_fetch_assoc($res);
if (!$row) stderr("{$lang['confirm_user_error']}", "{$lang['confirm_invalid_id']}");
if ($row['status'] != 'pending') {
    header("Refresh: 0; url={$INSTALLER09['baseurl']}/ok.php?type=confirmed");
    exit();
}
$sec = $row['editsecret'];
if ($md5 != $sec) stderr("{$lang['confirm_user_error']}", "{$lang['confirm_cannot_confirm']}");
sql_query("UPDATE ".TBL_USERS." SET status='confirmed', editsecret='' WHERE id=".sqlesc($id)." AND status='pending'");
if (!mysqli_affected_rows($GLOBALS["___mysqli_ston"])) stderr("{$lang['confirm_user_error']}", "{$lang['confirm_cannot_confirm']}");
$passh = md5($row["passhash"].$_SERVER["REMOTE_ADDR"]);
logincookie($id, $passh);
header("Refresh: 0; url={$INSTALLER09['baseurl']}/ok.php?type=confirm");
?>
