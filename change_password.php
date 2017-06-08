<?php
set_time_limit(72000000);
session_start();
if(empty($_SESSION['employee']))
{
   header("Location:index.php");
}
require_once('common/connection.php');
$user_id=$_SESSION['employee'];
$query="select emp_password from emp_master where emp_id='$user_id'";
$result=mysql_query($query,$mysql_link);
		if(mysql_num_rows($result)>0)
		{
		   while($rows=mysql_fetch_array($result))
		    {
			   $password=$rows[0];
			}
	    }		
?>
<script language="javascript">
 function change_pass()
   {
    var oldpass=document.getElementById('oldpass').value;
	   var newpass=document.getElementById('newpass').value;
	   var cfnpass=document.getElementById('cfnpass').value;
	    var password=document.getElementById('password').value;
         var client_id=document.getElementById('client_id').value;
	if(oldpass=='')
        {
             alert("Please Enter Old Password!.");
             document.pass_form.oldpass.focus();
             return false;
        }
		if(oldpass!=password)
		  {
		     alert("Password not correct,Please Enter Correct Password!.");
             document.pass_form.newpass.focus();
             return false;
		  }
       if(newpass=='')
        {
             alert("Please Enter New Password!.");
             document.pass_form.newpass.focus();
             return false;
        }
		if(cfnpass=='')
        {
             alert("Please Re Enter New Password!.");
             document.pass_form.cfnpass.focus();
             return false;
        }   
		if(newpass!=cfnpass)
		  {
		     alert("New Password and Retype New Password not match,Please Enter Correct Retype New Password!.");
             document.pass_form.cfnpass.focus();
             return false;
		 }       
     var url="password_save.php?newpass="+newpass+"&client_id="+client_id;
    var xmlhttp=GetXmlHttpObject();
    if (xmlhttp==null) {
        alert ("Your browser does not support AJAX!");
        return;
    } 
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") {
			            document.getElementById('pass_div').innerHTML=xmlhttp.responseText;
		}
		else
		{
		document.getElementById('pass_div').innerHTML= '<img src=\"images/loading_animation.gif\">';
		}
    }
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);
}
function GetXmlHttpObject() {
    var xmlhttp=null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlhttp=new XMLHttpRequest();
    }
    catch (e) {
        // Internet Explorer
        try {
            xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlhttp;
  }
</script>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<form method="post" id="pass_form" name="pass_form" class="ContactForm">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center"><input type="hidden" name="password" id="password" value="<?=$password;?>"/><input type="hidden" name="client_id" id="client_id" value="<?=$user_id;?>"/>
<table width="40%" border="0" align="center">
   <tr>
    <td align="center"><div style=" background:white;width:100%;height:40%;valign:middle;-moz-border-radius:0.6em;border:1px solid #EEEEFF; opacity:0.8; filter:alpha(opacity=80)"><table width="100%" border="0" align="center" style=" -moz-border-radius: 8px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold "  cellpadding="2" cellspacing="1">
	          
			  <tr>
 
          <td colspan="2" align="center"> <h1><span style="color:black">Change Password</span></h1></td>
        </tr>
              
              <tr>
                <td align="right"><div class="tf"><span class="red">*</span>Old Password</div></td>
                <td>
				&nbsp;&nbsp;
				<input type="password" name="oldpass" id="oldpass"/>
				</label>
				<div></div></td>
              </tr>
              <tr>
          <td align="right"><div class="tf"><span class="red">*</span>New Password:</div> </td>
          <td>&nbsp;&nbsp;
            <input type="password" name="newpass" id="newpass"/></td>
        </tr>
        <tr>
          <td align="right"><div class="tf"><span class="red">*</span>Re type New&nbsp;Password: </div></td>
          <td>&nbsp;&nbsp;
            <input type="password" name="cfnpass" id="cfnpass"/>
		  	<div>			</div>		  </td>
        </tr>
        
		<tr bgcolor="white">       </tr>
        <tr>
          <td align="center" colspan="2">
				<table width=100%>
				  <tr>
				    <td align="right" colspan="2">&nbsp;</td>
			      </tr>
				  <tr><td width="62%" align="right">
	              <div id="c_password"></div><input type="button" name="Submit" class="button" value="Save" onclick="change_pass();"/>
				  </td>
				  <td width="38%" align="right" id="pass_div">				  </td>
				</tr>
		    </table>          </td>
        </tr>
    </table> 
    </div> 
</td>
  </tr>
</table>
</td>
</tr>
</table>
</form>

