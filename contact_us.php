<?php
session_start();
$user_id=$_SESSION['employee'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Speed DND | Contact US</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jq.js" type="text/javascript" language="javascript"></script>
<script>
$(document).ready(function(){
$("#cSubmit").click(function(){
var error = 'false';

$("#error_name1").html('');
$("#error_cName").html('');
$("#error_emailid").html('');
$("#error_query").html('');

if(($.trim($("#contactPerson").val()).length == 0))
{
	var errorMsg = "Please Enter Name.<br/>";
	$("#error_name1").html(errorMsg);
	error = "true";
}

if(($.trim($("#cName").val()).length == 0))
{
	var errorMsg = "Please Enter Company Name.<br/>";
	$("#error_cName").html(errorMsg);
	error = "true";
}

if(($.trim($("#emailID").val()).length == 0))
{

	var errorMsg = "Please Enter Your e-mail id.<br />";
	$("#error_emailid").html(errorMsg);
	error = "true";

}
if(($.trim($("#emailID").val()).length != 0))
{
 var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test($("#emailID").val())) {
			var errorMsg = "Please Enter Valid e-mail id.<br />";
	           $("#error_emailid").html(errorMsg);
	          error = "true";
	}
   }
if(($.trim($("#query").val()).length == 0))
{
	var errorMsg = "Please Enter Query.<br/>";
	$("#error_query").html(errorMsg);
	error = "true";
}



if(error=="true")
{
	return false;
}
return true;
});
});</script>

</head>
<body>
<?php 
if($user_id=='')
include("template/header.php");
 ?>
<div class="body_wrapper">
  <div class="body_inner">
    <h1>Contact us</h1>
    <p>Thank you for visiting our website. Please fill out the following form to request information about our products and services or to provide feedback about our site. When you are finished, click the ‘Submit’ button to send us your message.</p>
    <div class="frm">
        <form id="form1" name="form1" method="POST" action="mail.php" class="ContactForm">
          <div class="tf""><span class="red">*</span> Name</div>
          <div class="ib">
            <div class="left">
              <input name="contactPerson" type="text" id="contactPerson"  />
            </div>
            <div id='error_name1' class="error"></div>
          </div>
          <div class="tf"><span class="red">*</span> Company Name</div>
          <div class="ib">
            <div class="left">
              <input type="text" name="cName" id="cName"/>
            </div>
            <div id='error_cName' class="error"></div>
          </div>
          <div class="tf"><span class="red">*</span> E-mail ID</div>
          <div class="ib">
            <div class="left">
              <input name="emailID" type="text" id="emailID"/>
            </div>
            <div id='error_emailid' class="error"></div>
          </div>
          <div class="tf">&nbsp; Phone No.</div>
          <div class="ib">
            <div class="left">
              <input name="contactNumber" type="text"/>
            </div>
          </div>
          <div class="tf"><span class="red">*</span> Query</div>
          <div class="ib">
            <div class="left">
              <textarea name="query" id="query" ></textarea>
            </div>
            <div id='error_query' class="error"></div>
          </div>
          <div class="tf">&nbsp;</div>
          <div class="ib">
            <div class="left">
              <input type="submit" name="Submit" value="Submit" id="cSubmit" class="button" />
            </div>
          </div>
        </form>
      </div>
</div></div>
 <?php 
 if($user_id=='')
  include("template/footer.php");
 ?>
</body>
</html>
