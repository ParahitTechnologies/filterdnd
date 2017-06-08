<?php
set_time_limit(0);
session_start();
if(empty($_SESSION['employee']))
{
   header("Location:index.php");
}
?>
<script language="javascript">
 function logout()
            {
              //  var answer = true;
                answer = confirm("Do You really want to Logout");
                if (answer){
                    window.location = "secure.php?logout";
                   
                    return(true);
                }
                else{
                    return(false);
                }
            }
			</script>
			<script language="javascript">
function my_menu(path)
  {
	xmlhttp=GetXmlHttpObject();
    if (xmlhttp==null) {
        alert ("Your browser does not support AJAX!");
        return;
    } 
var url=path;
 xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") {
            document.getElementById('main_menu').innerHTML=xmlhttp.responseText;
        }
		else
		{
		document.getElementById('main_menu').innerHTML= '<img src=\"images/loading_animation.gif\">';
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
function get_path(path)
  {
	document.getElementById('my_frame').src = path;
	return false;
   }
function get_state(th,tg)
            {
                var path="city.php?state="+th.value;
                var xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
                xmlhttp.onreadystatechange = triggered;
                xmlhttp.open("GET", path,true);
                xmlhttp.send(null);
                function triggered()
                {
                    if (xmlhttp.readyState == 4)
					{
						document.getElementById(tg).innerHTML = xmlhttp.responseText;
					}
                    else
                        document.getElementById(tg).innerHTML = '<option>Loading</option>';
                }
            };
function account_save()
   {
    var client_id=document.getElementById('client_id').value;
	   var company_name=document.getElementById('company_name').value;
	   var client_name=document.getElementById('client_name').value;
         var mobile=document.getElementById('mobile').value;
		  var website=document.getElementById('website').value;
		    var state=document.getElementById('state').value;
			 var city=document.getElementById('city').value;
	          var client_address=document.getElementById('client_address').value;
	if(client_name=='')
        {
             alert("Please Enter Client Name!.");
             document.client_form.client_name.focus();
             return false;
        }
       if(mobile=='')
        {
             alert("Please Enter Client Mobile Number!.");
             document.client_form.mobile.focus();
             return false;
        }
            var numericExpression = /^[0-9]+$/;
			if(mobile.match(numericExpression)){
			}else{
				alert("Please Enter only numeric digits Mobile No.!..");
				document.client_form.mobile.focus();
				return false;
			}
             if(client_address=='')
               {
                   alert("Please Enter Client Address!.");
                   document.client_form.client_address.focus();
                   return false;
              }
     var url="account_save.php?client_id="+client_id+"&client_name="+client_name+"&mobile="+mobile+"&client_address="+client_address+"&company_name="+company_name+"&state="+state+"&city="+city+"&website="+website;
    var xmlhttp=GetXmlHttpObject();
    if (xmlhttp==null) {
        alert ("Your browser does not support AJAX!");
        return;
    } 
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") {
			            document.getElementById('account_div').innerHTML=xmlhttp.responseText;
		}
		else
		{
		document.getElementById('account_div').innerHTML= '<img src=\"images/loading_animation.gif\">';
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Speed DND | We Speak your Language.</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include("template/header1.php"); ?>
<div class="banner_wrapper" id='banner_wrapper'>
  <div class="header_inner">
    <div class="banner">
      <div class="img_wrapper"></div>
    </div>
  </div>
  <iframe id='my_frame' src='' width='99%' height='100%' frameborder=0></iframe>
</div>

<div id='main_menu' style="text-align:center;position:absolute;overflow:auto;left:78%; margin-right:1%;top:130px;height:390px;border:0px solid black;text-align:center;"></div>
<?php include("template/footer.php"); ?>
</body>
</html>
