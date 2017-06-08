<?php
session_start();
$user_id=$_SESSION['employee'];
error_reporting(E_ALL); 
ini_set('display_errors', 0);
if(isset($_POST['emailID'])){
//echo "INSIDE"; die();

ini_set('error_reporting', E_ALL);
$contactPerson	= $_POST['contactPerson'];
$cName			= $_POST['cName'];
$contactNumber	= $_POST['contactNumber'];
$email			= $_POST['emailID'];
$query			= $_POST['query'];
require_once('common/connection.php');
$ip=$_SERVER['REMOTE_ADDR'];
$query="insert into c_query(name,company_name,email_id,phone_no,r_query,agent,ip) values('$contactPerson','$cName','$email','$contactNumber','$query','$user_id','$ip')";
$result=mysql_query($query);
$salesEmail = "info@essencekey.com";

$to = "info@essencekey.com,guiwebcoder@gmail.com";


$subject = "Query Essencekey India";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: ".$contactPerson." <".$email.">" . "\r\n";
//$headers .= "Reply-To: ".$contactPerson."<".$email.">" . "\r\n";

$message1 = "Company Name: ".$cName."<br />Contact Person: ".$contactPerson."<br />Contact Number: ".$contactNumber."<br />Email: ".$email."<br />Query: ".$query."";


$subject2 = " Thank you for contacting us";

$message2 =  "<div style='float:left; width:550px; padding:20px; border:1px solid #b7b7b7'><div style='float:left; width:520px; background-color:#fff; padding:15px 15px'><a href='http://www.essencekey.com' target='_blank'><img border='0' alt='essencekey' src='http://www.essencekey.com/images/logo.png'></a></div><div style='float:left; width:550px; margin-top:20px; color:#161B07; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; line-height:22px;'><span style='font-size:18px; color: #029292; font-family:Arial, Helvetica, sans-serif'>Dear ".$contactPerson.",</span><br /><br />Thank You,<br />We appreciate spending your time with us. Looking forward to see you soon!</div><div style='width:550px; float: left; margin-top: 20px; font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #029292;'><div style='float:left; padding-right: 10px;'>Join us on:</div><div style='float:left; padding-top: 1px;'><a target='_blank' href='https://www.facebook.com/essence.key.7'><img border='0' alt='Facebook' src='http://www.etaindia.com/images/social/fb.png' /></a>&nbsp;&nbsp;<a href='https://twitter.com/essencekey' target='_blank'><img border='0' alt='Twitter' src='http://www.etaindia.com/images/social/twitter.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
</div><div style='float:left; width:530px; margin-top:50px; color:#8E8E8E; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; background-color: #000; padding:10px; line-height:22px'>Essencekey India</div></div>";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: sales<info@essencekey.com>\r\n";
$mail = mail($to, $subject, $message1, $headers);
$userMail = mail($email, $subject2, $message2, $headers);
if($mail){
echo "<script>window.location='thankYou.php'</script>";
}
//header("Loation:subscribe.html");
die();
}
else{
echo "<script>window.location='contact_us.php'</script>";
}
?>