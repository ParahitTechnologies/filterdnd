<?php
session_start();
ob_start();
$emp_id = $_SESSION['employee'];
if($emp_id=='')
{
   header("location:index.php");
}
$ip = $_SERVER['REMOTE_ADDR'];
$sid = session_id();
include_once('common/connection.php');
if(isset($_GET['logout']))
{
        session_destroy();
        header("location:index.php");
        exit();
}	
?>