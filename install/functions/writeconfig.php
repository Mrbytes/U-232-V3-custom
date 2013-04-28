<?php
//==09 Installer by putyn
$foo = array(
    ____('Database') => array(
        array(
            'text' => ____('Host'),
            'input' => 'config[mysql_host]',
            'info' => ____('Usually this will be localhost unless your on a cluster server.')
        ) ,
        array(
            'text' => ____('Username'),
            'input' => 'config[mysql_user]',
            'info' => ____('Your mysql username.')
        ) ,
        array(
            'text' => ____('Password'),
            'input' => 'config[mysql_pass]',
            'info' => ____('Your mysql password.')
        ) ,
        array(
            'text' => ____('Database'),
            'input' => 'config[mysql_db]',
            'info' => ____('Your mysql database name.')
        ) ,
        array(
            'text' => ____('Table prefix'),
            'input' => 'config[table_prefix]',
            'info' => ____('Prefix that you\'ll give to tables [default \'U232v3\']')
        ) ,
    ) ,
    ____('Tracker') => array(
        array(
            'text' => ____('Announce Url'),
            'input' => 'config[announce_urls]',
            'info' => ____('Your announce url.')
        ) ,
        array(
            'text' => ____('HTTPS Announce Url'),
            'input' => 'config[announce_https]',
            'info' => ____('Your HTTPS announce url.')
        ) ,
        array(
            'text' => ____('Site Email'),
            'input' => 'config[site_email]',
            'info' => ____('Your site email address.')
        ) ,
        array(
            'text' => ____('Site Name'),
            'input' => 'config[site_name]',
            'info' => ____('Your site name.')
        ) ,
    ) ,
    ____('Cookies') => array(
        array(
            'text' => ____('Prefix'),
            'input' => 'config[cookie_prefix]',
            'info' => ____('Only required for sub-domain installs.')
        ) ,
        array(
            'text' => ____('Path'),
            'input' => 'config[cookie_path]',
            'info' => ____('Only required for sub-domain installs.')
        ) ,
        array(
            'text' => ____('Cookie Domain'),
            'input' => 'config[cookie_domain]',
            'info' => ____('Your domain name - note exclude http and www.')
        ) ,
        array(
            'text' => ____('Domain'),
            'input' => 'config[domain]',
            'info' => ____('Your site domain name - note exclude http or www.')
        ) ,
    ) ,
    ____('Announce') => array(
        array(
            'text' => ____('Host'),
            'input' => 'announce[mysql_host]',
            'info' => ____('Usually this will be localhost unless your on a cluster server.')
        ) ,
        array(
            'text' => ____('Username'),
            'input' => 'announce[mysql_user]',
            'info' => ____('Your mysql username.')
        ) ,
        array(
            'text' => ____('Password'),
            'input' => 'announce[mysql_pass]',
            'info' => ____('Your mysql password.')
        ) ,
        array(
            'text' => ____('Database'),
            'input' => 'announce[mysql_db]',
            'info' => ____('Your mysql database name.')
        ) ,
        array(
            'text' => ____('Domain'),
            'input' => 'announce[baseurl]',
            'info' => ____('Your domain name - note include http and www.')
        ) ,
    ) ,
);
function foo($x)
{
    return '/\#'.$x.'/';
}
function createblock($fo, $foo)
{
    if (file_exists('step1.lock')) header('Location: index.php?step=2');
    $out = '
	<fieldset>
		<legend>'.$fo.'</legend>
		<table align="center">';
    foreach ($foo as $bo) $out.= '<tr>
			<td class="input_text">'.$bo['text'].'</td>
			<td class="input_input"><input type="'.(strpos($bo['input'], 'pass') == true ? 'password' : 'text').'" name="'.$bo['input'].'" size="30"/></td>
			<td class="input_info">'.$bo['info'].'</td>
		  </tr>';
    $out.= '</table></fieldset>';
    return $out;
}
function saveconfig()
{
    global $root;
    $continue = true;
    $out = '<fieldset><legend>'.____('Write config').'</legend>';
    if (!file_exists('config.lock')) {
        $config = file_get_contents('extra/config.sample.php');
        $keys = array_map('foo', array_keys($_POST['config']));
        $values = array_values($_POST['config']);
        $values[4] = ($values[4] == '') ? 'U232v3' : $values[4];
        $config = preg_replace($keys, $values, $config);
        if (file_put_contents($root.'include/config.php', $config)) {
            $out.= '<div class="readable">'.____('Config file was saved').'</div>';
            file_put_contents('config.lock', 1);
        } else {
            $out.= '<div class="notreadable">'.____('Config file could not be saved').'</div>';
            $continue = false;
        }
    } else $out.= '<div class="readable">'.____('Config file was already written').'</div>';
    if (!file_exists('announce.lock')) {
        $announce = file_get_contents('extra/ann_config.sample.php');
        $keys = array_map('foo', array_keys($_POST['announce']));
        $values = array_values($_POST['announce']);
        $announce = preg_replace($keys, $values, $announce);
        if (file_put_contents($root.'include/ann_config.php', $announce)) {
            $out.= '<div class="readable">'.____('Announce file was saved').'</div>';
            file_put_contents('announce.lock', 1);
        } else {
            $out.= '<div class="notreadable">'.____('announce file could not be saved').'</div>';
            $continue = false;
        }
    } else $out.= '<div class="readable">'.____('Announce file was already written').'</div>';
    if ($continue) {
        $out.= '<div style="text-align:center" class="info"><input type="button" value='.____('Next step').' onclick="window.location.href=\'index.php?step=2\'"/></div>';
        file_put_contents('step1.lock', 1);
    } else $out.= '<div style="text-align:center" class="info"><input type="button" value='.____('Go back').' onclick="window.go(-1)"/></div>';
    $out.= '</fieldset>';
    print ($out);
}
?>
