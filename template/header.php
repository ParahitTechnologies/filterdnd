<?php
if($user_id=='')
{
?>
<link type="text/css" rel="stylesheet" href="css/light.css" media="all" />

<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/light.js"></script>
<script src="js/jq.js" type="text/javascript" language="javascript"></script>
<script>
$(document).ready(function(){

	$("#Submit").click(function(){
		var error = 'false';
		
		$("#error_name").html('');
		$("#error_password").html('');
		$("#error_query").html('');
		
		if(($.trim($("#username").val()).length == 0)){
			var errorMsg = "Please Enter Valid User Name.<br/>";
			$("#error_name").html(errorMsg);
			return false;
		}
		
		if(($.trim($("#password").val()).length == 0)){
			var errorMsg = "Please Enter Valid Password.<br/>";
			$("#error_password").html(errorMsg);
			return false;
		}
        ajax_login();
	});
});
function ajax_login()
  {
    var username = $('#username').val();
		 var password = $('#password').val();
		 $.post("ajax_login.php",{username:username,password:password},function(result){
			if(result=='yes'){
				window.location="menu.php";
			}	
			 else if(result=='no')
			  {
			    	var errorMsg = "Your login detail not valid...!<br/>";
			        $("#msgbox").html(errorMsg);
				    return false;
			  }		
		 });
		 //alert('san');
  }
</script>


<div class="header_wrapper">
  <div class="header_inner">
    <div class="header">
    

    	
        <div class="logo"> &nbsp; </div>
    

    
      <div class="header_right">
                <div class="right"><a data-reveal-id="sivr_login_form" href="#">Login</a></div>
      
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
<div class="header_wrapper_2">
  <div class="header_inner">
    <div class="header"> 
      
	  <div id="sivr_login_form" class="reveal-modal large tile-modal" style="opacity: 1; visibility: hidden; display: none">
<h1><span style="color:#595a5a">Existing Users Login</span></h1>
<div id="contanor">
<form method="post" id="login-form" class="ContactForm">
<div class="form-item form-type-textfield">
<table width="100%" border="0" cellpadding="30" cellspacing="30">
<tr>
   <td><div class="tf""><span class="red">*</span>User Name</div><input type="text" class="form-text required" id="username" name="username" maxlength="75" /></div></td>
   <td><div id='error_name' class="error"></div></td>
</tr>
<tr>
   <td><div class="tf"><span class="red">*</span>Password</div><input type="password" class="form-text required" id="password" name="password" maxlength="75" /></div></td>
   <td><div id='error_password' class="error"></div></td>
</tr>
<tr>
   <td>
        <input type="button" name="Submit" value="Login" id="Submit" class="button" style="margin-left:150px"/>
  </td>
  <td><div id='msgbox' class="error"></div></td>
</tr>
</table>
				
</div>

<div><a class="close-reveal-modal"><img src="images/close.png"></a></div>
</form></div></div>
</div>
</div>
</div>
<?php
}
else
{
?>
<div class="header_wrapper">
  <div class="header_inner">
    <div class="header">
    
      <div class="header_right">
        <div class="left">Welcome : <?=$user_id;?></div>
         <div class="right"><a data-reveal-id="sivr_login_form" href="#" onclick="logout();">Logout</a></div>
      </div>
    </div>
  </div>
</div>
<div class="header_wrapper_2">
  <div class="header_inner">
    <div class="header">


<!--<div class="tabss" > 

<ul><li><a href="../../csv_upload/index.php">CSV Upload</a></li> <li> <a href="">Filter DNC</a></li> </ul>

        

<style>

.tabss { float:right;}
.tabss ul { margin:0px; padding:0px;}
.tabss li { float:left; list-style:inherit; margin-right:10px; background:#e25101; border:solid 1px #b84505 ; padding: 7px 10px; border-radius:5px;  }
.tabss li:hover { background:#333; border:solid 1px #000;}
.tabss li a {color:#fff !important; font-size:13px;}

</style>



      </div> -->

     
	  </div>


  </div>
</div>
<?php
}
?>

