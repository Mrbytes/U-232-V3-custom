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
    //==delete torrents by putyn
    $days = 30;
    $dt = (TIME_NOW - ($days * 86400));
    $res = sql_query("SELECT id, name FROM ".TBL_TORRENTS." WHERE added < $dt AND seeders='0' AND leechers='0'");
    while ($arr = mysqli_fetch_assoc($res)) {
        sql_query("DELETE ".TBL_PEERS.".*, ".TBL_FILES.".*,".TBL_COMMENTS.".*,".TBL_SNATCHED.".*, ".TBL_THANKS.".*, ".TBL_BOOKMARKS.".*, ".TBL_COINS.".*, ".TBL_RATING.".*, ".TBL_TORRENTS.".* FROM ".TBL_TORRENTS." 
				 LEFT JOIN ".TBL_PEERS." ON ".TBL_PEERS.".torrent = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_FILES." ON ".TBL_FILES.".torrent = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_COMMENTS." ON ".TBL_COMMENTS.".torrent = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_THANKS." ON ".TBL_THANKS.".torrentid = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_BOOKMARKS." ON ".TBL_BOOKMARKS.".torrentid = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_COINS." ON ".TBL_COINS.".torrentid = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_RATING." ON  ".TBL_RATING.".torrent = ".TBL_TORRENTS.".id
				 LEFT JOIN ".TBL_SNATCHED." ON ".TBL_SNATCHED.".torrentid = ".TBL_TORRENTS.".id
				 WHERE ".TBL_TORRENTS.".id = {$arr['id']}") or sqlerr(__FILE__, __LINE__);
        @unlink("{$INSTALLER09['torrent_dir']}/{$arr['id']}.torrent");
        write_log("Torrent {$arr['id']} ({$arr['name']}) was deleted by system (older than $days days and no seeders)");
    }
    if ($queries > 0) write_log("Delete Old Torrents Clean -------------------- Delete Old Torrents cleanup Complete using $queries queries --------------------");
    if (false !== mysqli_affected_rows($GLOBALS["___mysqli_ston"])) {
        $data['clean_desc'] = mysqli_affected_rows($GLOBALS["___mysqli_ston"])." items deleted/updated";
    }
    if ($data['clean_log']) {
        cleanup_log($data);
    }
}
?>
