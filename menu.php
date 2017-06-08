<?php
set_time_limit(0);
session_start();
if(empty($_SESSION['employee']))
{
   header("Location:index.php");
}
$user_id=$_SESSION['employee'];
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
			document.getElementById('div_m1').style.background='white';
			document.getElementById('div_m2').style.background='white';
			document.getElementById('div_m3').style.background='white';
			document.getElementById('div_m4').style.background='white';
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
	 if(path=='contact_us.php')
	{
		 document.getElementById('div_m2').innerHTML='';
              document.getElementById('main_menu').innerHTML='';
	 }		
	return false;
   }
 </script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Filter DND | Ability to Make it Happen..</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body> 
<?php include("template/header.php"); ?>
<div class="banner_wrapper" id="div_m1">
  <div class="header_inner" id="div_m2">
<!--    <div class="banner" id="div_m3">
      <div class="img_wrapper" id="div_m4"></div>
    </div>-->
  </div>
 <iframe id='my_frame' src='dnc/index.php' width='100%' height='100%' frameborder='0'></iframe>
 
</div>
<div id='main_menu' style="text-align:center;position:absolute;overflow:auto;left:78%; margin-right:20px;top:130px;height:10%;border:0px solid black;text-align:center;"></div>

</body>
</html>
