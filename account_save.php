<?php
set_time_limit(72000000);
session_start();
if(empty($_SESSION['employee']))
{
   header("Location:index.php");
}
 require_once('common/connection.php');
 $client_id=$_REQUEST["client_id"];
  $client_name=$_REQUEST["client_name"];
	$mobile=$_REQUEST["mobile"];
	   $company_name=$_REQUEST["company_name"];
	    $client_address=$_REQUEST["client_address"];
		 $website=$_REQUEST["website"];
		  $state=$_REQUEST["state"];
		   $city=$_REQUEST["city"];
                  $api_key=$_REQUEST["api_key"];
if(isset($_REQUEST["client_id"]))
   {
	     $queryu="update client set client_name='$client_name',company_name='$company_name',mobile_no='$mobile',city='$city',state='$state',address='$client_address',website_name='$website' where client_id='$client_id'";
		   $resultu = mysql_query($queryu);
             $querye="update emp_master set api_key='$api_key' where emp_id='$client_id'";
		   $resulte = mysql_query($querye);
	        echo "<span style='font-family:Arial, Helvetica, sans-serif; font-size:11px; color:gray'>Account Updated Successfully!..</span>";
	}
	?>		