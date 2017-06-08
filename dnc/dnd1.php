<html>
        <script type="text/javascript">
  function check_dnc()
   {
    var phone=document.getElementById('phone').value;
  	  if(phone=='')
        {
             alert("Please Enter Mobile Number!.");
             document.g_form.phone.focus();
             return false;
        }
    var url="dnd2.php?phone="+phone;
    var xmlhttp=GetXmlHttpObject();
    if (xmlhttp==null) {
        alert ("Your browser does not support AJAX!");
        return;
    } 
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") {
			            document.getElementById('alert').innerHTML=xmlhttp.responseText;
		}
		else
		{
		document.getElementById('alert').innerHTML= "<img src=\"../images/loading_animation.gif\">";
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
 <?php
   require_once("../css/grid.php");
	require_once("../css/style.php");
?>
<body>
<!-----------------------------------------------------------Header----------------------------------------------------------->
<div class="clear"></div>
<!-----------------------------------------------------------Header End----------------------------------------------------------->
<!-----------------------------------------------------------Body Wrapper Start----------------------------------------------------------->
	  
<div class="adm_grid" style="margin-top:50px">
<div id="contect_div" class="content_div">
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:2px; margin-top:2px">
 <tr>
   <td width="12%" align="right"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;margin-left:11px; font-weight:bold">Enter Mobile No.:</span></td>
   <td width="13%" align="right"><input type="text" name="phone" id="phone" class="design_text" /></td>
 <td width="10%" align="right"><input type="button" id="button" Value="Check DND" class="dsh_btn" onclick="check_dnc();"></td>
 <td width="65%">&nbsp;</td>
 </tr>
 </table>
</div>	 

  <div class="adm_left_body_header">
    <div class="adm_left_body_curv_center">

	  <div align="right">
	 	  <div class="left">DND<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;margin-left:10px;"> <?php echo $status[$dnd];?></span></div>
  </div>
</div>
</div>
</div>
		<div class="adm_grid">
  <div class="adm_left_body_header">
</div>
	<div class="adm_left_body_middle" id="alert" style="height:300px">
</div>
</body>
</html>




