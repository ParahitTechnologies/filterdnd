<?php 
session_start();
$user_id=$_SESSION['employee'];
if($user_id=='')
{
header("Location:../login/index.php");
}
require_once("../common/connection.php");
$msg=$_REQUEST["act"];
$fname=$_REQUEST["fname"];
$file_name=$UPLOAD_DIR.$fname;
if($msg=$_REQUEST["act"])
{
 $querys="select t_upload,t_number from emp_master where emp_id='$user_id'";
	                                     $results=mysql_query($querys);
	                                      while($rows=mysql_fetch_array($results))
	                                        {
	                                          $r_file=$rows[0]+1;
		                                     $r_no=$rows[1];
	                                        }
$count = substr_count(file_get_contents($file_name), "\r\n");
$r_no=$r_no+$count;
$queryue="update emp_master set t_upload='$r_file',t_number='$r_no' where emp_id='$user_id'";
$resultue=mysql_query($queryue);
$sql="delete from upload_file WHERE id='$msg'";
$result = mysql_query($sql);
unlink($file_name);
?>
<script language="javascript">
window.location="index.php";
</script>
<?php
}
?>