<?php

session_start();
$user_id = $_SESSION['employee'];
if (empty($_SESSION['employee'])) {
    header("Location:./login/index.php");
}
require_once("../common/connection.php"); ///date base connection
$fid = $_REQUEST["fid"];
$fname = $_REQUEST["fname"];
$target = $_REQUEST["target"];
if (isset($_REQUEST["target"]) == 'cvs_read') {
    $queryu = "update upload_file set f_status=2 where id=$fid";
    $resultu = mysql_query($queryu);

    exec("php -f update_dnd.php " . $UPLOAD_DIR . $fname . " " . $fid . " " . $fname . " &", $output);
}
?>
