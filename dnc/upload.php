<?php

set_time_limit(0);
ini_set('memory_limit', '500M');
session_start();
$user_id = $_SESSION['employee'];
if (empty($_SESSION['employee'])) {
    header("Location:../index.php");
}
$file = fopen("responseText.txt", "a");
fwrite($file, "[" . date('d/m/Y H:i:s') . "]");
$start = round(microtime(true) * 1000);
fwrite($file . "\n\nUploading started at :" . $startTime);

require_once("../common/connection.php");
if ($_FILES['file']) {
    $uploaddir = $UPLOAD_DIR;
    $fname = time() . '-' . $_FILES['file']['name'];
    $fname = str_replace(' ', '', $fname);
    $f1 = explode(".", $fname);
    if ($f1[1] == "csv") {
        $fsize = number_format(($_FILES['file']['size'] / 1024), 2) . ' KB';
        $path = $uploaddir . $fname;
        $move = false;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir . $fname)) {
            $move = true;
        }
        if ($move) {
            $sql = "select file_name from upload_file where file_name='$fname'";
            $result = mysql_query($sql);
            if (mysql_num_rows($result) > 0) {
                echo "<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:green'>File Already exist!</span>" . '<br>';
            } else {
                $count = substr_count(file_get_contents($uploaddir . $fname), "\r\n");
                $querys = "select t_upload,t_number from emp_master where emp_id='$user_id'";
                $results = mysql_query($querys);
                while ($rows = mysql_fetch_array($results)) {
                    $r_file = $rows[0] - 1;
                    $r_no = $rows[1];
                }
                //if($count>$r_no){
                //	unlink($uploaddir.$fname);
                //}
                //else{
                $lines = count(file($uploaddir . $fname)) - 1;
                $queryi = "insert into upload_file(file_name,file_size,agent,file_rows) values('$fname','$fsize','$user_id','$lines')";
                $resulti = mysql_query($queryi);
                $r_no = $r_no - $count;
                //}	
            }
        }
    }
}
fwrite($file, "\nUploading of file done " . $uploaddir . $fname . " in " . ((round(microtime(true) * 1000) - $start) / 1000) . " s\n\n");
fclose($file);
?>					