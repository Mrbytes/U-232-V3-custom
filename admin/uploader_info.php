<?php
/**
 *   https://github.com/Bigjoos/
 *   Licence Info: GPL
 *   Copyright (C) 2010 U-232 v.3
 *   A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 *   Project Leaders: Mindless, putyn.
 *
 */
if (!defined('IN_INSTALLER09_ADMIN')) {
    $HTMLOUT = '';
    $HTMLOUT.= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
		\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<title>Error!</title>
		</head>
		<body>
	<div style='font-size:33px;color:white;background-color:red;text-align:center;'>Incorrect access<br />You cannot access this file directly.</div>
	</body></html>";
    echo $HTMLOUT;
    exit();
}
require_once (INCL_DIR.'user_functions.php');
require_once (INCL_DIR.'pager_functions.php');
require_once (CLASS_DIR.'class_check.php');
class_check(UC_STAFF);
$lang = array_merge($lang);
$HTMLOUT = $count = '';
$count1 = get_row_count('TBL_TORRENTS');
$perpage = 15;
$pager = pager($perpage, $count1, 'staffpanel.php?tool=uploader_info&amp;');
//=== main query
$res = sql_query('SELECT COUNT(t.id) as how_many_torrents, t.owner, t.added, u.username, u.uploaded, u.downloaded, u.id, u.donor, u.suspended, u.class, u.warned, u.enabled, u.chatpost, u.leechwarn, u.pirate, u.king
            FROM '.TBL_TORRENTS.' AS t LEFT JOIN '.TBL_USERS.' as u ON u.id = t.owner GROUP BY t.owner ORDER BY how_many_torrents DESC '.$pager['limit']);
if ($count1 > $perpage) $HTMLOUT.= $pager['pagertop'];
$HTMLOUT.= '<table border="0" cellspacing="0" cellpadding="5">
   <tr><td class="colhead" align="center">Rank</td><td class="colhead" align="center">#Torrents</td><td class="colhead" align="left">Member</td><td class="colhead" align="left">Class</td><td class="colhead" align="left">Ratio</td><td class="colhead" align="left">Last Upload</td><td class="colhead" align="center">Send Pm</td></tr>';
$i = 0;
while ($arr = mysqli_fetch_assoc($res)) {
    $i++;
    //=== change colors
    $count = (++$count) % 2;
    $class = ($count == 0 ? 'one' : 'two');
    $ratio = member_ratio($arr['uploaded'], $INSTALLER09['ratio_free'] ? '0' : $arr['downloaded']);
    $HTMLOUT.= '<tr>
<td class="'.$class.'" align="center">'.$i.'</td>
<td class="'.$class.'" align="center">'.(int)$arr['how_many_torrents'].'</td>
<td class="'.$class.'" align="left">'.format_username($arr).'</td>
<td class="'.$class.'" align="left">'.get_user_class_name($arr['class']).'</td>
<td class="'.$class.'" align="left">'.$ratio.'</td>
<td class="'.$class.'" align="left">'.get_date($arr['added'], 'DATE', 0, 1).'</td>
<td class="'.$class.'" align="center"><a href="pm_system.php?action=send_message&amp;receiver='.(int)$arr['id'].'"><img src="'.$INSTALLER09['pic_base_url'].'/button_pm.gif" alt="Pm" title="Pm" border="0" /></a></td>
</tr>';
}
$HTMLOUT.= '</table>';
if ($count1 > $perpage) $HTMLOUT.= $pager['pagerbottom'];
echo stdhead('Uploader Stats').$HTMLOUT.stdfoot();
?>
