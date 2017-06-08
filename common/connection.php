<?php
include_once 'config.php';
$mysql_link = @mysql_connect($DB_HOST, $DB_USER, $DB_PASS) or die(header("location:505.php"));
@mysql_select_db($DB_NAME, $mysql_link) or die("DB error");
?>
