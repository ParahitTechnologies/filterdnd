<?php 
session_start();
$user_id=$_SESSION['employee'];
if($user_id=='')
{
header("Location:../login/index.php");
}
require_once("../common/connection.php");
$msg=$_REQUEST["act"];
if(isset($_REQUEST["act"]))
 {
$queryue="update upload_file set flag_delete=1 where id='$msg'";
$resultue=mysql_query($queryue);
?>
<script language="javascript">
window.location="index.php";
</script>
<?php
}
?>