<?php
set_time_limit(72000000);
session_start();
if(empty($_SESSION['employee']))
{
   header("Location:index.php");
}
 require_once('common/connection.php');
 $client_id=$_REQUEST["client_id"];
		   $newpass=$_REQUEST["newpass"];
if(isset($_REQUEST["client_id"]))
   {
	     $queryu="update emp_master set emp_password='$newpass' where emp_id='$client_id'";
		   $resultu = mysql_query($queryu);
	        echo "<span style='font-family:Arial, Helvetica, sans-serif; font-size:11px; color:gray'>Password Change Successfully!..</span>";
	}
	?>		