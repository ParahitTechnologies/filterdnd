<?php
session_start();
$user_id=$_SESSION['employee'];
if(empty($_SESSION['employee']))
	{
		header("Location:../index.php");
	}
require_once("../common/connection.php");///date base connection
  $query="select t_upload from emp_master where emp_id='$user_id'";
	$result=mysql_query($query);
	while($rows=mysql_fetch_array($result))
	   echo $total_f=$rows[0];
 ?>		