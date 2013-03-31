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
require_once (INCL_DIR . 'function_memcache.php');
dbconn();
loggedinorreturn();
$lang = array_merge(load_language('global') , load_language('delete'));
if (!mkglobal("id")) stderr("{$lang['delete_failed']}", "{$lang['delete_missing_data']}");
$id = 0 + $id;
if (!is_valid_id($id)) stderr("{$lang['delete_failed']}", "{$lang['delete_missing_data']}");
//==delete torrents by putyn
function deletetorrent($id)
{
    global $INSTALLER09, $mc1, $CURUSER, $lang;
    sql_query("DELETE ".TBL_PEERS.".*, ".TBL_FILES.".*, ".TBL_COMMENTS.".*, ".TBL_SNATCHED.".*, ".TBL_THANKS.".*, ".TBL_BOOKMARKS.".*, ".TBL_COINS.".*, ".TBL_RATING.".*, ".TBL_TORRENTS.".* FROM ".TBL_TORRENTS." 
				 LEFT JOIN ".TBL_PEERS." ON ".TBL_PEERS.".torrent = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_FILES." ON ".TBL_FILES.".torrent = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_COMMENTS." ON ".TBL_COMMENTS.".torrent = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_THANKS." ON ".TBL_THANKS.".torrentid = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_BOOKMARKS." ON ".TBL_BOOKMARKS.".torrentid = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_COINS." ON ".TBL_COINS.".torrentid = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_RATING." ON ".TBL_RATING.".torrent = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_SNATCHED." ON ".TBL_SNATCHED.".torrentid = ".TBL_TORRENTS.".id
				 WHERE ".TBL_TORRENTS.".id =".sqlesc($id)) or sqlerr(__FILE__, __LINE__);
    unlink("{$INSTALLER09['torrent_dir']}/$id.torrent");
    $mc1->delete_value('MyPeers_'.$CURUSER['id']);
}
$res = sql_query("SELECT name,owner,seeders FROM ".TBL_TORRENTS." WHERE id =".sqlesc($id));
$row = mysqli_fetch_assoc($res);
if (!$row) stderr("{$lang['delete_failed']}", "{$lang['delete_not_exist']}");
if ($CURUSER["id"] != $row["owner"] && $CURUSER["class"] < UC_STAFF) stderr("{$lang['delete_failed']}", "{$lang['delete_not_owner']}\n");
$rt = 0 + $_POST["reasontype"];
if (!is_int($rt) || $rt < 1 || $rt > 5) stderr("{$lang['delete_failed']}", "{$lang['delete_invalid']}");
$reason = $_POST["reason"];
if ($rt == 1) $reasonstr = "{$lang['delete_dead']}";
elseif ($rt == 2) $reasonstr = "{$lang['delete_dupe']}".($reason[0] ? (": ".trim($reason[0])) : "!");
elseif ($rt == 3) $reasonstr = "{$lang['delete_nuked']}".($reason[1] ? (": ".trim($reason[1])) : "!");
elseif ($rt == 4) {
    if (!$reason[2]) stderr("{$lang['delete_failed']}", "{$lang['delete_violated']}");
    $reasonstr = $INSTALLER09['site_name']."{$lang['delete_rules']}".trim($reason[2]);
} else {
    if (!$reason[3]) stderr("{$lang['delete_failed']}", "{$lang['delete_reason']}");
    $reasonstr = trim($reason[3]);
}
deletetorrent($id);
remove_torrent_peers($id);
//$mc1->delete_value('lastest_tor_');
$mc1->delete_value('top5_tor_');
$mc1->delete_value('last5_tor_');
$mc1->delete_value('scroll_tor_');
$mc1->delete_value('torrent_details_'.$id);
$mc1->delete_value('torrent_details_text'.$id);
write_log("{$lang['delete_torrent']} $id ({$row['name']}){$lang['delete_deleted_by']}{$CURUSER['username']} ($reasonstr)\n");
if ($INSTALLER09['seedbonus_on'] == 1) {
    //===remove karma
    sql_query("UPDATE ".TBL_USERS." SET seedbonus = seedbonus-15.0 WHERE id = ".sqlesc($row["owner"])) or sqlerr(__FILE__, __LINE__);
    $update['seedbonus'] = ($CURUSER['seedbonus'] - 15);
    $mc1->begin_transaction('userstats_'.$row["owner"]);
    $mc1->update_row(false, array(
        'seedbonus' => $update['seedbonus']
    ));
    $mc1->commit_transaction($INSTALLER09['expires']['u_stats']);
    $mc1->begin_transaction('user_stats_'.$row["owner"]);
    $mc1->update_row(false, array(
        'seedbonus' => $update['seedbonus']
    ));
    $mc1->commit_transaction($INSTALLER09['expires']['user_stats']);
    //===end
    
}
if ($CURUSER["id"] != $row["owner"] AND $CURUSER['pm_on_delete'] == 'yes') {
    $added = TIME_NOW;
    $pm_on = (int)$row["owner"];
    $message = "Torrent $id (".htmlsafechars($row['name']).") has been deleted.\n  Reason: $reasonstr";
    sql_query("INSERT INTO ".TBL_MESSAGES." (sender, receiver, msg, added) VALUES(0, $pm_on,".sqlesc($message).", $added)") or sqlerr(__FILE__, __LINE__);
    $mc1->delete_value('inbox_new_'.$pm_on);
    $mc1->delete_value('inbox_new_sb_'.$pm_on);
}
if (isset($_POST["returnto"])) $ret = "<a href='".htmlsafechars($_POST["returnto"])."'>{$lang['delete_go_back']}</a>";
else $ret = "<a href='{$INSTALLER09['baseurl']}/browse.php'>{$lang['delete_back_browse']}</a>";
$HTMLOUT = '';
$HTMLOUT.= "<h2>{$lang['delete_deleted']}</h2>
    <p>$ret</p>";
echo stdhead("{$lang['delete_deleted']}").$HTMLOUT.stdfoot();
?>
