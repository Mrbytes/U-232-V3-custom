<?php
class TempDB extends SQLite3
{
    function __construct()
    {
        $this->open(":memory:");
    }
}

function ____($words)
{
    global $db;
    $stmt = $db->prepare('SELECT locale FROM script_texts WHERE deftext = :words');
    $stmt->bindValue(':words', $words);
    $res = $stmt->execute();
    $res = $res->fetchArray(SQLITE3_ASSOC);
    $locale = $res['locale'];
    if (!isset($locale)) return $words;
    return $locale;
}
require_once ('functions/database.php');
$table_locales = 'extra/script_text_locales.sql';
$sql_query = @fread(@fopen($table_locales, 'r'), @filesize($table_locales));
$sql_query = take_out_remarks($sql_query);
$sql_query = split_sql_file($sql_query,';');
$db = new TempDB();
if (!$db) die ("Could not create in-memory database.");
$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
for ($i = 0; $i < count($sql_query); $i++)
{
    $stmt = $db->prepare($sql_query[$i]);
    if (($db->lastErrorCode()) != 0)
    {
        die("There was an error while importing locales text: " . $db->lastErrorMsg() );
        $bd->close();
    }
    $stmt->bindValue(':lang', $lang);
    $stmt->execute();
}
$step = isset($_GET['step']) ? (int)$_GET['step'] : 0;
$root = $_SERVER['DOCUMENT_ROOT'];
if ($root[strlen($root) - 1] != DIRECTORY_SEPARATOR) $root = $root.DIRECTORY_SEPARATOR;
if (file_exists($root.'include/install.lock')) die(____('This was already installed, huh ? how this happened'));
function checkpreviousstep()
{
    $step = isset($_GET['step']) ? (int)$_GET['step'] - 1 : 0;
    if (!file_exists('step'.$step.'.lock')) header('Location: index.php?step='.$step);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>U-232 V3</title>
<link type="text/css" href="extra/installer.css" rel="stylesheet" />
</head>
<body>

<div id="wrapper">
<div id="logo"></div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valid_do = array(
        'write' => 1,
        'db_insert' => 1
    );
    $do = isset($_POST['do']) && isset($valid_do[$_POST['do']]) ? $_POST['do'] : false;
    switch ($do) {
    case 'write':
        require_once ('functions/writeconfig.php');
        saveconfig();
        break;

    case 'db_insert':
        require_once ('functions/database.php');
        db_insert();
        break;

    default:
        print ('<fieldset><div class="notreadable">'.____('Unknown action').'</div></fieldset>');
    }
} else {
    switch ($step) {
    case 0:
        require_once ('functions/permissioncheck.php');
        print (permissioncheck());
        break;

    case 1:
        checkpreviousstep();
        require_once ('functions/writeconfig.php');
        $out = '<form action="index.php" method="post">';
        foreach ($foo as $fo => $fooo) $out.= createblock($fo, $fooo);
        $out.= '<fieldset><div style="text-align:center"><input type="submit" value='.____('Submit data').' /><input type="hidden" value="write" name="do" /></div></fieldset></form>';
        print ($out);
        break;

    case 2:
        checkpreviousstep();
        require_once ('functions/database.php');
        db_test();
        break;

    case 3:
        $out = '<fieldset><legend>'.____('All done').'</legend><div class="info">'.____('Installation complete').'</div></fieldset>';
        print ($out);
        break;
    }
}
?>
</div>
</body>
</html>
