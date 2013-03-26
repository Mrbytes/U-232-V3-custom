<?php

function take_out_remarks($sql)
{ 
    $lines = explode("\n", $sql);
    $sql = "";
    $linecount = count($lines);
    $catch = "";
    for ($i = 0; $i < $linecount; $i++)
    {
        if (($i != ($linecount - 1)) || (strlen($lines[$i]) > 0))
        {
            if ((!empty($lines[$i])) && (trim($lines[$i][0] != "#")))
            {
               $catch .= $lines[$i] . "\n";
            } else {
                $catch .= "\n";
                }
            $lines[$i] = "";
        }
    }
    return $catch;
}

//== Ported from phpbb, all acknowledgments.
function split_sql_file($sql, $delimiter)
{
    $tokens = explode($delimiter, $sql);
    $sql = "";
    $output = array();
    $matches = array();
    $token_count = count($tokens);
    for ($i = 0; $i < $token_count; $i++)
    {
        if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0)))
        {
            $total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
            $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);
            $unescaped_quotes = $total_quotes - $escaped_quotes;
            if (($unescaped_quotes % 2) == 0)
            {
                $output[] = $tokens[$i];
                $tokens[$i] = "";
            } else {
                $temp = $tokens[$i] . $delimiter;
                $tokens[$i] = "";
                $complete_stmt = false;
                for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++)
                {
                    $total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
                    $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);
                    $unescaped_quotes = $total_quotes - $escaped_quotes;
                    if (($unescaped_quotes % 2) == 1)
                    {
                        $output[] = $temp . $tokens[$j];
                        $tokens[$j] = "";
                        $temp = "";
                        $complete_stmt = true;
                        $i = $j;
                    } else {
                        $temp .= $tokens[$j] . $delimiter;
                        $tokens[$j] = "";
                        }
                } 
            } 
        }
    }
    return $output;
}

function db_test()
{
    global $root, $INSTALLER09;
    $out = '<fieldset><legend>Database</legend>';
    require_once ($root.'include/config.php');
    if (@mysqli_connect($INSTALLER09['mysql_host'], $INSTALLER09['mysql_user'], $INSTALLER09['mysql_pass'], $INSTALLER09['mysql_db']))
    {
        $out.= '<div class="readable">Connection to database no issues reported, data may be imported.</div>';
        $out.= '<form action="index.php" method="post"><div class="info" style="text-align:center;"><input type="hidden" name="do" value="db_insert" /><input type="submit" value="Import database" /></div></form>';
    } else $out.= '<div class="notreadable">The connection to the database reported the next issue: </br>'.mysqli_connect_error().'</div><div class="info" style="text-align:center"><input type="button" value="Reload" onclick="window.location.reload()"/></div>';   
	$out.= '</fieldset>';
    	print ($out);
}

function db_insert()
{
    global $root, $INSTALLER09;
    $table_structure = 'extra/structure.sql';
    $table_basicdata = 'extra/basicdata.sql';
    require_once ($root.'include/config.php');
    $mysqli = new mysqli($INSTALLER09['mysql_host'], $INSTALLER09['mysql_user'], $INSTALLER09['mysql_pass'], $INSTALLER09['mysql_db']);
    $endqueries = ';'; 
    $endqueries_basicdata = ';'; 
    $out = '<fieldset><legend>Database</legend>';
    $sql_query = @fread(@fopen($table_structure, 'r'), @filesize($table_structure));
    $sql_query = preg_replace('/U232v3/',$INSTALLER09['table_prefix'], $sql_query);
    $sql_query = take_out_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, $endqueries);
        for ($i = 0; $i < count($sql_query); $i++)
        {
            $stmt_query = $mysqli->stmt_init();
            $stmt_query->prepare($sql_query[$i]);
            $stmt_query->execute();
            if (($stmt_query->errno) != 0)
            {
                $out.= '<div class="notreadable">There was an error while importing the structure: <br/>'.$stmt_query->errno.' check for error.</div><div class="info" style="text-align:center"><input type="button" value="Reload" onclick="window.location.reload()"/></div>';
                $out.= '</fieldset>';
                print ($out);
                $mysqli->close();
                die();
            }
        }
        $out.= '<div class="readable">The structure of database was imported successful</div>';
    unset($sql_query);
    $sql_query = @fread(@fopen($table_basicdata, 'r'), @filesize($table_basicdata));
    $sql_query = preg_replace('/U232v3/',$INSTALLER09['table_prefix'], $sql_query);
    $sql_query = take_out_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, $endqueries_basicdata);
        for ($i = 0; $i < count($sql_query); $i++)
        {
            $stmt_query = $mysqli->stmt_init();
            $stmt_query->prepare($sql_query[$i]);
            $stmt_query->execute();
            if (($stmt_query->errno) != 0)
            {
                $out.= '<div class="notreadable">There was an error while importing the basicdata: <br/>'.$stmt_query->errno.' check for error.</div><div class="info" style="text-align:center"><input type="button" value="Reload" onclick="window.location.reload()"/></div>';
                $out.= '</fieldset>';
                print ($out);
                $mysqli->close();
                die();
            }
        }
        $out.= '<div class="readable">Basicdata of database was imported successful</div><div class="info" style="text-align:center"><input type="button" value="Finish" onclick="window.location.href=\'?step=3\'"/></div>';
        file_put_contents('step2.lock', 1);
    $out.= '</fieldset>';
    print ($out);
}

?>
