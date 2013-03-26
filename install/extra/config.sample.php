<?php
/**
 *   https://github.com/Bigjoos/
 *   Licence Info: GPL
 *   Copyright (C) 2010 U-232 V3
 *   A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 *   Project Leaders: Mindless,putyn.
 *
 */
error_reporting(E_ALL); //== turn off = 0 when live
define('PUBLIC_ACCESS', true);
define('EMAIL_CONFIRM', true); // false to auto confirm signups
define('SQL_DEBUG', 1);
//==charset
$INSTALLER09['char_set'] = 'UTF-8'; //also to be used site wide in meta tags
if (ini_get('default_charset') != $INSTALLER09['char_set']) {
    ini_set('default_charset', $INSTALLER09['char_set']);
}
/* Compare php version for date/time stuff etc! */
if (version_compare(PHP_VERSION, "5.1.0RC1", ">=")) date_default_timezone_set('Europe/London');
define('TIME_NOW', time());
$INSTALLER09['time_adjust'] = 0;
$INSTALLER09['time_offset'] = '0';
$INSTALLER09['time_use_relative'] = 1;
$INSTALLER09['time_use_relative_format'] = '{--}, h:i A';
$INSTALLER09['time_joined'] = 'j-F y';
$INSTALLER09['time_short'] = 'jS F Y - h:i A';
$INSTALLER09['time_long'] = 'M j Y, h:i A';
$INSTALLER09['time_tiny'] = '';
$INSTALLER09['time_date'] = '';
//== DB setup
$INSTALLER09['mysql_host'] = '#mysql_host';
$INSTALLER09['mysql_user'] = '#mysql_user';
$INSTALLER09['mysql_pass'] = '#mysql_pass';
$INSTALLER09['mysql_db'] = '#mysql_db';
$INSTALLER09['table_prefix'] = '#table_prefix';
//== Table names
define('TBL_ACH_BONUS',$INSTALLER09['table_prefix'].'_ach_bonus');
define('TBL_ACHIEVEMENTIST',$INSTALLER09['table_prefix'].'_achievementist');
define('TBL_ACHIEVEMENTS',$INSTALLER09['table_prefix'].'_achievements');
define('TBL_ANNOUNCEMENT_MAIN',$INSTALLER09['table_prefix'].'_announcement_main');
define('TBL_ANNOUNCEMENT_PROCESS',$INSTALLER09['table_prefix'].'_announcement_process');
define('TBL_ATTACHMENTS',$INSTALLER09['table_prefix'].'_attachments');
define('TBL_AVPS',$INSTALLER09['table_prefix'].'_avps');
define('TBL_BANNEDEMAILS',$INSTALLER09['table_prefix'].'_bannedemails');
define('TBL_BANS',$INSTALLER09['table_prefix'].'_bans');
define('TBL_BLACKJACK',$INSTALLER09['table_prefix'].'_blackjack');
define('TBL_BLOCKS',$INSTALLER09['table_prefix'].'_blocks');
define('TBL_BONUS',$INSTALLER09['table_prefix'].'_bonus');
define('TBL_BONUSLOG',$INSTALLER09['table_prefix'].'_bonuslog');
define('TBL_BOOKMARKS',$INSTALLER09['table_prefix'].'_bookmarks');
define('TBL_BUGS',$INSTALLER09['table_prefix'].'_bugs');
define('TBL_CARDS',$INSTALLER09['table_prefix'].'_cards');
define('TBL_CASINO',$INSTALLER09['table_prefix'].'_casino');
define('TBL_CASINO_BETS',$INSTALLER09['table_prefix'].'_casino_bets');
define('TBL_CATEGORIES',$INSTALLER09['table_prefix'].'_categories');
define('TBL_CHEATERS',$INSTALLER09['table_prefix'].'_cheaters');
define('TBL_CLEANUP',$INSTALLER09['table_prefix'].'_cleanup');
define('TBL_CLEANUP_LOG',$INSTALLER09['table_prefix'].'_cleanup_log');
define('TBL_COINS',$INSTALLER09['table_prefix'].'_coins');
define('TBL_COMMENTS',$INSTALLER09['table_prefix'].'_comments');
define('TBL_COUNTRIES',$INSTALLER09['table_prefix'].'_countries');
define('TBL_DBBACKUP',$INSTALLER09['table_prefix'].'_dbbackup');
define('TBL_EVENTS',$INSTALLER09['table_prefix'].'_events');
define('TBL_FAILEDLOGINS',$INSTALLER09['table_prefix'].'_failedlogins');
define('TBL_FILES',$INSTALLER09['table_prefix'].'_files');
define('TBL_FORUM_CONFIG',$INSTALLER09['table_prefix'].'_forum_config');
define('TBL_FORUM_POLL',$INSTALLER09['table_prefix'].'_forum_poll');
define('TBL_FORUM_POLL_VOTES',$INSTALLER09['table_prefix'].'_forum_poll_votes');
define('TBL_FORUMS',$INSTALLER09['table_prefix'].'_forums');
define('TBL_FREELEECH',$INSTALLER09['table_prefix'].'_freeleech');
define('TBL_FREESLOTS',$INSTALLER09['table_prefix'].'_freeslots');
define('TBL_FRIENDS',$INSTALLER09['table_prefix'].'_friends');
define('TBL_FUNDS',$INSTALLER09['table_prefix'].'_funds');
define('TBL_HAPPYHOUR',$INSTALLER09['table_prefix'].'_happyhour');
define('TBL_HAPPYLOG',$INSTALLER09['table_prefix'].'_happylog');
define('TBL_INFOLOG',$INSTALLER09['table_prefix'].'_infolog');
define('TBL_INVITE_CODES',$INSTALLER09['table_prefix'].'_invite_codes');
define('TBL_IPS',$INSTALLER09['table_prefix'].'_ips');
define('TBL_LOTTERY_CONFIG',$INSTALLER09['table_prefix'].'_lottery_config');
define('TBL_MESSAGES',$INSTALLER09['table_prefix'].'_messages');
define('TBL_MOODS',$INSTALLER09['table_prefix'].'_moods');
define('TBL_NEWS',$INSTALLER09['table_prefix'].'_news');
define('TBL_NOTCONNECTABLEPMLOG',$INSTALLER09['table_prefix'].'_notconnectablepmlog');
define('TBL_NOW_VIEWING',$INSTALLER09['table_prefix'].'_now_viewing');
define('TBL_OFFER_VOTES',$INSTALLER09['table_prefix'].'_offer_votes');
define('TBL_OFFERS',$INSTALLER09['table_prefix'].'_offers');
define('TBL_OVER_FORUMS',$INSTALLER09['table_prefix'].'_over_forums');
define('TBL_PAYPAL_CONFIG',$INSTALLER09['table_prefix'].'_paypal_config');
define('TBL_PEERS',$INSTALLER09['table_prefix'].'_peers');
define('TBL_PMBOXES',$INSTALLER09['table_prefix'].'_pmboxes');
define('TBL_POLL_VOTERS',$INSTALLER09['table_prefix'].'_poll_voters');
define('TBL_POLLS',$INSTALLER09['table_prefix'].'_polls');
define('TBL_POSTS',$INSTALLER09['table_prefix'].'_posts');
define('TBL_PROMO',$INSTALLER09['table_prefix'].'_promo');
define('TBL_RATING',$INSTALLER09['table_prefix'].'_rating');
define('TBL_READ_POSTS',$INSTALLER09['table_prefix'].'_read_posts');
define('TBL_RELATIONS',$INSTALLER09['table_prefix'].'_relations');
define('TBL_REPORTS',$INSTALLER09['table_prefix'].'_reports');
define('TBL_REPUTATION',$INSTALLER09['table_prefix'].'_reputation');
define('TBL_REPUTATIONLEVEL',$INSTALLER09['table_prefix'].'_reputationlevel');
define('TBL_REQUEST_VOTES',$INSTALLER09['table_prefix'].'_request_votes');
define('TBL_REQUESTS',$INSTALLER09['table_prefix'].'_requests');
define('TBL_SEARCHCLOUD',$INSTALLER09['table_prefix'].'_searchcloud');
define('TBL_SHIT_LIST',$INSTALLER09['table_prefix'].'_shit_list');
define('TBL_SHOUTBOX',$INSTALLER09['table_prefix'].'_shoutbox');
define('TBL_SITE_CONFIG',$INSTALLER09['table_prefix'].'_site_config');
define('TBL_SITELOG',$INSTALLER09['table_prefix'].'_sitelog');
define('TBL_SNATCHED',$INSTALLER09['table_prefix'].'_snatched');
define('TBL_STAFFMESSAGES',$INSTALLER09['table_prefix'].'_staffmessages');
define('TBL_STAFFPANEL',$INSTALLER09['table_prefix'].'_staffpanel');
define('TBL_STATS',$INSTALLER09['table_prefix'].'_stats');
define('TBL_STYLESHEETS',$INSTALLER09['table_prefix'].'_stylesheets');
define('TBL_SUBSCRIPTIONS',$INSTALLER09['table_prefix'].'_subscriptions');
define('TBL_SUBTITLES',$INSTALLER09['table_prefix'].'_subtitles');
define('TBL_THANKS',$INSTALLER09['table_prefix'].'_thanks');
define('TBL_THANKYOU',$INSTALLER09['table_prefix'].'_thankyou');
define('TBL_THUMBSUP',$INSTALLER09['table_prefix'].'_thumbsup');
define('TBL_TICKETS',$INSTALLER09['table_prefix'].'_tickets');
define('TBL_TOPICS',$INSTALLER09['table_prefix'].'_topics');
define('TBL_TORRENTS',$INSTALLER09['table_prefix'].'_torrents');
define('TBL_UPLOADAPP',$INSTALLER09['table_prefix'].'_uploadapp');
define('TBL_USER_BLOCKS',$INSTALLER09['table_prefix'].'_user_blocks');
define('TBL_USER_CONFIG',$INSTALLER09['table_prefix'].'_user_config');
define('TBL_USERCOMMENTS',$INSTALLER09['table_prefix'].'_usercomments');
define('TBL_USERHITS',$INSTALLER09['table_prefix'].'_userhits');
define('TBL_USERS',$INSTALLER09['table_prefix'].'_users');
define('TBL_USERSACHIEV',$INSTALLER09['table_prefix'].'_usersachiev');
define('TBL_USTATUS',$INSTALLER09['table_prefix'].'_ustatus');
define('TBL_WIKI',$INSTALLER09['table_prefix'].'_wiki');
//== Cookie setup
$INSTALLER09['cookie_prefix'] = '#cookie_prefix'; // This allows you to have multiple trackers, eg for demos, testing etc.
$INSTALLER09['cookie_path'] = '#cookie_path'; // ATTENTION: You should never need this unless the above applies eg: /tbdev
$INSTALLER09['cookie_domain'] = '#cookie_domain'; // set to eg: .somedomain.com or is subdomain set to: .sub.somedomain.com
$INSTALLER09['domain'] = '#domain';
//==
$INSTALLER09['tracker_post_key'] = 'lsdflksfda4545frwe35@kk';
$INSTALLER09['max_torrent_size'] = 3 * 1024 * 1024;
$INSTALLER09['announce_interval'] = 60 * 30;
$INSTALLER09['signup_timeout'] = 86400 * 3;
$INSTALLER09['autoclean_interval'] = 1800;
$INSTALLER09['minvotes'] = 1;
$INSTALLER09['max_dead_torrent_time'] = 6 * 3600;
$INSTALLER09['language'] = 1;
$INSTALLER09['bot_id'] = 2;
$INSTALLER09['staffpanel_online'] = 1;
$INSTALLER09['irc_autoshout_on'] = 0;
$INSTALLER09['crazyhour_on'] = 1;
$INSTALLER09['happyhour_on'] = 1;
$INSTALLER09['mods']['slots'] = 1;
$INSTALLER09['votesrequired'] = 15;
$INSTALLER09['catsperrow'] = 4;
$INSTALLER09['subcatperrow'] = 1;
$INSTALLER09['maxwidth'] = '90%';
//== Memcache expires
$INSTALLER09['expires']['latestuser'] = 0; // 0 = infinite
$INSTALLER09['expires']['MyPeers_'] = 120; // 60 = 60 seconds
$INSTALLER09['expires']['unread'] = 86400; // 86400 = 1 day
$INSTALLER09['expires']['alerts'] = 0; // 0 = infinite
$INSTALLER09['expires']['searchcloud'] = 0; // 0 = infinite
$INSTALLER09['expires']['user_cache'] = 30 * 86400; // 30 days
$INSTALLER09['expires']['curuser'] = 30 * 86400; // 30 days
$INSTALLER09['expires']['u_status'] = 30 * 84600; // 30x86400 = 30 days
$INSTALLER09['expires']['u_stats'] = 300; // 300 = 5 min
$INSTALLER09['expires']['user_status'] = 30 * 84600; // 30x86400 = 30 days
$INSTALLER09['expires']['user_stats'] = 300; // 300 = 5 min
$INSTALLER09['expires']['announcement'] = 600; // 600 = 10 min
$INSTALLER09['expires']['shoutbox'] = 86400; // 86400 = 1 day
$INSTALLER09['expires']['staff_shoutbox'] = 86400; // 86400 = 1 day
$INSTALLER09['expires']['forum_posts'] = 0;
$INSTALLER09['expires']['torrent_comments'] = 900; // 900 = 15 min
$INSTALLER09['expires']['latestposts'] = 0; // 900 = 15 min
$INSTALLER09['expires']['top5_torrents'] = 0; // 0 = infinite
$INSTALLER09['expires']['last5_torrents'] = 0; // 0 = infinite
$INSTALLER09['expires']['scroll_torrents'] = 0; // 0 = infinite
$INSTALLER09['expires']['torrent_details'] = 30 * 86400; // = 30 days
$INSTALLER09['expires']['torrent_details_text'] = 30 * 86400; // = 30 days
$INSTALLER09['expires']['insertJumpTo'] = 30 * 86400; // = 30 days
$INSTALLER09['expires']['get_all_boxes'] = 30 * 86400; // = 30 days
$INSTALLER09['expires']['thumbsup'] = 0; // 0 = infinite
$INSTALLER09['expires']['iphistory'] = 900; // 900 = 15 min
$INSTALLER09['expires']['newpoll'] = 0; // 900 = 15 min
$INSTALLER09['expires']['genrelist'] = 30 * 86400; // 30x86400 = 30 days
$INSTALLER09['expires']['genrelist2'] = 30 * 86400; // 30x86400 = 30 days
$INSTALLER09['expires']['poll_data'] = 900; // 300 = 5 min
$INSTALLER09['expires']['torrent_data'] = 900; // 900 = 15 min
$INSTALLER09['expires']['user_flag'] = 86400 * 28; // 900 = 15 min
$INSTALLER09['expires']['shit_list'] = 900; // 900 = 15 min
$INSTALLER09['expires']['port_data'] = 900; // 900 = 15 min
$INSTALLER09['expires']['user_peers'] = 900; // 900 = 15 min
$INSTALLER09['expires']['user_friends'] = 900; // 900 = 15 min
$INSTALLER09['expires']['user_hash'] = 900; // 900 = 15 min
$INSTALLER09['expires']['user_blocks'] = 900; // 900 = 15 min
$INSTALLER09['expires']['hnr_data'] = 300; // 300 = 5 min
$INSTALLER09['expires']['snatch_data'] = 300; // 300 = 5 min
$INSTALLER09['expires']['user_snatches_data'] = 300; // 300 = 5 min
$INSTALLER09['expires']['staff_snatches_data'] = 300; // 300 = 5 min
$INSTALLER09['expires']['user_snatches_complete'] = 300; // 300 = 5 min
$INSTALLER09['expires']['completed_torrents'] = 300; // 300 = 5 min
$INSTALLER09['expires']['activeusers'] = 60; // 60 = 1 minutes
$INSTALLER09['expires']['last24'] = 3600; // 3600 = 1 hours
$INSTALLER09['expires']['activeircusers'] = 300; // 300 = 5 min
$INSTALLER09['expires']['birthdayusers'] = 43200; //== 43200 = 12 hours
$INSTALLER09['expires']['news_users'] = 3600; // 3600 = 1 hours
$INSTALLER09['expires']['user_invitees'] = 900; // 900 = 15 min
$INSTALLER09['expires']['ip_data'] = 900; // 900 = 15 min
$INSTALLER09['expires']['latesttorrents'] = 0; // 0 = infinite
$INSTALLER09['expires']['invited_by'] = 900; // 900 = 15 min
$INSTALLER09['expires']['user_torrents'] = 900; // 900 = 15 min
$INSTALLER09['expires']['user_seedleech'] = 900; // 900 = 15 min
$INSTALLER09['expires']['radio'] = 0; // 0 = infinite
$INSTALLER09['expires']['total_funds'] = 0; // 0 = infinite
$INSTALLER09['expires']['latest_news'] = 0; // 0 = infinite
$INSTALLER09['expires']['site_stats'] = 300; // 300 = 5 min
$INSTALLER09['expires']['share_ratio'] = 900; // 900 = 15 min
$INSTALLER09['expires']['checked_by'] = 0; // 0 = infinite
$INSTALLER09['expires']['movieofweek'] = 300; // 604800 = 1 week
$INSTALLER09['expires']['latest_news_tpl'] = 0; // 0 = infinite
$INSTALLER09['expires']['latesttorrents_tpl'] = 0; // 0 = infinite
$INSTALLER09['expires']['latestposts_tpl'] = 0; // 0 = infinite
$INSTALLER09['expires']['site_stats_tpl'] = 0; // 0 = infinite
$INSTALLER09['expires']['latestuser_tpl'] = 0; // 0 = infinite
$INSTALLER09['expires']['activeusers_tpl'] = 0; // 0 = infinite
$INSTALLER09['expires']['forum_users'] = 30; // 60 = 1 minutes
$INSTALLER09['expires']['section_view'] = 30; // 60 = 1 minutes
$INSTALLER09['expires']['child_boards'] = 900; // 60 = 1 minutes
$INSTALLER09['expires']['sv_child_boards'] = 900; // 60 = 1 minutes
$INSTALLER09['expires']['forum_insertJumpTo'] = 3600; // = 1 hour
$INSTALLER09['expires']['last_post'] = 0; // infinite
$INSTALLER09['expires']['sv_last_post'] = 0; // infinite
$INSTALLER09['expires']['last_read_post'] = 0; // infinite
$INSTALLER09['expires']['sv_last_read_post'] = 0; // infinite
//== Latest posts limit
$INSTALLER09['latest_posts_limit'] = 5; //query limit for latest forum posts on index
//latest torrents limit
$INSTALLER09['latest_torrents_limit'] = 5;
$INSTALLER09['latest_torrents_limit_2'] = 5;
$INSTALLER09['latest_torrents_limit_scroll'] = 20;
/** Settings **/
$INSTALLER09['reports'] = 1; // 1/0 on/off
$INSTALLER09['karma'] = 1; // 1/0 on/off
$INSTALLER09['BBcode'] = 1; // 1/0 on/off
$INSTALLER09['inviteusers'] = 10000;
$INSTALLER09['flood_time'] = 900; //comment/forum/pm flood limit
$INSTALLER09['readpost_expiry'] = 14 * 86400; // 14 days

/** define dirs **/
define('INCL_DIR', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('ROOT_DIR', realpath(INCL_DIR.'..'.DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR);
define('ADMIN_DIR', ROOT_DIR.'admin'.DIRECTORY_SEPARATOR);
define('FORUM_DIR', ROOT_DIR.'forums'.DIRECTORY_SEPARATOR);
define('PM_DIR', ROOT_DIR.'pm_system'.DIRECTORY_SEPARATOR);
define('CACHE_DIR', ROOT_DIR.'cache'.DIRECTORY_SEPARATOR);
define('MODS_DIR', ROOT_DIR.'mods'.DIRECTORY_SEPARATOR);
define('LANG_DIR', ROOT_DIR.'lang'.DIRECTORY_SEPARATOR);
define('TEMPLATE_DIR', ROOT_DIR.'templates'.DIRECTORY_SEPARATOR);
define('BLOCK_DIR', ROOT_DIR.'blocks'.DIRECTORY_SEPARATOR);
define('IMDB_DIR', ROOT_DIR.'imdb'.DIRECTORY_SEPARATOR);
define('CLASS_DIR', INCL_DIR.'class'.DIRECTORY_SEPARATOR);
define('CLEAN_DIR', INCL_DIR.'cleanup'.DIRECTORY_SEPARATOR);
$INSTALLER09['cache'] = ROOT_DIR.'cache';
$INSTALLER09['backup_dir'] = INCL_DIR.'backup';
$INSTALLER09['torrent_dir'] = ROOT_DIR.'torrents'; // must be writable for httpd user
$INSTALLER09['flood_file'] = INCL_DIR.'settings'.DIRECTORY_SEPARATOR.'limitfile.txt';
$INSTALLER09['nameblacklist'] = ROOT_DIR.'cache'.DIRECTORY_SEPARATOR.'nameblacklist.txt';
//== tpl configs
$INSTALLER09['tpl_path'] = 'tpl/templates/';
$INSTALLER09['tpl_delimiters'] = '{#%s#}';
$INSTALLER09['tpl_cache_time'] = 30;
// the first one will be displayed on the pages
$INSTALLER09['announce_urls'] = array();
$INSTALLER09['announce_urls'][] = '#announce_urls';
$INSTALLER09['announce_urls'][] = '#announce_https';
if ($_SERVER["HTTP_HOST"] == "") $_SERVER["HTTP_HOST"] = $_SERVER["SERVER_NAME"];
$INSTALLER09['baseurl'] = 'http'.(isset($_SERVER['HTTPS']) && (bool)$_SERVER['HTTPS'] == true ? 's' : '').'://'.$_SERVER['HTTP_HOST'];
//== Email for sender/return path.
$INSTALLER09['site_email'] = '#site_email';
$INSTALLER09['site_name'] = '#site_name';
$INSTALLER09['xhtml_strict'] = 0; // enable for all users
$INSTALLER09['xhtml_strict'] = ''; // enable for one user
$INSTALLER09['msg_alert'] = 1; // saves a query when off
$INSTALLER09['report_alert'] = 1; // saves a query when off
$INSTALLER09['staffmsg_alert'] = 1; // saves a query when off
$INSTALLER09['uploadapp_alert'] = 1; // saves a query when off
$INSTALLER09['bug_alert'] = 1; // saves a query when off
$INSTALLER09['sql_error_log'] = ROOT_DIR.'logs'.DIRECTORY_SEPARATOR.'sql_err_'.date('M_D_Y').'.log';
$INSTALLER09['pic_base_url'] = "./pic/";
$INSTALLER09['stylesheet'] = 1;
$INSTALLER09['categorie_icon'] = 1;
//for subs & youtube mode
$INSTALLER09['movie_cats'] = array(
    3,
    5,
    6,
    10,
    11
);
$INSTALLER09['moviecats'] = "3,5,6,10,11";
$youtube_pattern = "/^http\:\/\/www\.youtube\.com\/watch\?v\=[\w]{11}/i";
//== set this to size of user avatars
$INSTALLER09['av_img_height'] = 100;
$INSTALLER09['av_img_width'] = 100;
//== set this to size of user signatures
$INSTALLER09['sig_img_height'] = 100;
$INSTALLER09['sig_img_width'] = 500;
$INSTALLER09['bucket_allowed'] = 0;
$INSTALLER09['bucket_dir'] = ROOT_DIR.'/bitbucket'; // must be writable for httpd user
$INSTALLER09['allowed_ext'] = array(
    'image/gif',
    'image/png',
    'image/jpeg'
);
$INSTALLER09['bucket_maxsize'] = 500 * 1024; //max size set to 500kb
$INSTALLER09['happyhour'] = CACHE_DIR.'happyhour'.DIRECTORY_SEPARATOR.'happyhour.txt';
//==User class defines
define('UC_USER', 0);
define('UC_POWER_USER', 1);
define('UC_VIP', 2);
define('UC_UPLOADER', 3);
define('UC_MODERATOR', 4);
define('UC_ADMINISTRATOR', 5);
define('UC_SYSOP', 6);
define('UC_MIN', 0); // minimum class
define('UC_MAX', 6); // maximum class
define('UC_STAFF', 4); // start of staff classes
//==View source code
$INSTALLER09['staff_viewcode_on'] = false;
//==Class check by pdq
$INSTALLER09['site']['owner'] = 1;
//== Salt - change this
$INSTALLER09['site']['salt2'] = 'jgutyxcjsaka';
//= Change staff pin daily or weekly
$INSTALLER09['staff']['staff_pin'] = 'uFll0y3Ihgtij8'; // should be mix of u/l case and min 12 chars length
//= Change owner pin daily or weekly
$INSTALLER09['staff']['owner_pin'] = 'jjknnkuuyqhjj0'; // should be mix of u/l case and min 12 chars length
//== Staff forum ID for autopost
$INSTALLER09['staff']['forumid'] = 2; // this forum ID should exist and be a staff forum
$INSTALLER09['staff_forums'] = array(
    1,
    2
); // these forum ID's' should exist and be a staff forum's to stop autoshouts
$INSTALLER09['variant'] = 'U-232 V3';
define('TBVERSION', $INSTALLER09['variant']);
?>
