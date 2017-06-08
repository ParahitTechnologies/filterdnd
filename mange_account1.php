<?php
set_time_limit(72000000);
session_start();
if(empty($_SESSION['employee']))
{
   header("Location:index.php");
}
$user_id=$_SESSION['employee'];
require_once('common/connection.php');
		$query="SELECT c.client_id,c.client_name,c.company_name,c.address,c.mobile_no,c.address,c.city,c.state,c.website_name,e.t_upload,e.fix_upload,e.t_number,e.fix_number,e.f_api,e.r_api FROM client c left join emp_master e on c.client_id=e.emp_id WHERE e.emp_id='$user_id'";
		$result=mysql_query($query,$mysql_link);
		if(mysql_num_rows($result)>0)
		{
		   while($rows=mysql_fetch_array($result))
		    {
			   $client_id=$rows['client_id'];
			   $client_name=$rows['client_name'];
			   $company_name=$rows['company_name'];
			   $address=$rows['address'];
			   $mobile=$rows['mobile_no'];
			   $address=$rows['address'];
			   $city=$rows['city'];
			   $state=$rows['state'];
			   $website=$rows['website_name'];
			   $r_job=$rows['t_upload'];
			   $t_job=$rows['fix_upload'];
			   $r_number=$rows['t_number'];
			   $t_number=$rows['fix_number'];
			    $max_api=$rows['f_api'];
			    $r_api=$rows['r_api'];
			}
		}
?>
<script language="javascript">
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
  </script>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<form method="post" id="client_form" name="client_form" class="ContactForm">
<table width="70%" border="0" align="center">
   <tr>
    <td align="center"><div align="center" style=" background:white;width:100%;height:40%;valign:middle;-moz-border-radius:0.6em;border:1px solid #EEEEFF; opacity:0.8; filter:alpha(opacity=80)"><table width="100%" border="0" align="center" style=" -moz-border-radius: 8px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold "  cellpadding="2" cellspacing="1">
	          
			  <tr>
           <td colspan="4" align="center"> <h1><span style="color:black">Manage Account </span></h1></td>
        </tr>
              
              <tr>
                <td width="20%" align="right"><div class="tf">Account Id </div></td>
                <td width="31%"><input type="text" name="client_id" id="client_id" value="<?=$client_id;?>" readonly="readonly"/></td>
                <td width="16%" align="right"><div class="tf">Contact Person</div></td>
                <td width="33%">
				<input type="text" name="client_name" id="client_name" value="<?=$client_name;?>"/>
				</label>
				<div></div></td>
              </tr>
              <tr>
          <td align="right"><div class="tf">Max Numbers Allowed</div> </td>
          <td><input type="text" name="t_number" id="t_number" value="<?=$t_number;?>" readonly="readonly"/></td>
          <td align="right"><div class="tf">Mobile</div></td>
          <td>
            <input type="text" name="mobile" id="mobile" value="<?=$mobile;?>"/></td>
        </tr>
              <tr>
                <td align="right"><div class="tf">Numbers Remaining</div></td>
                <td><input type="text" name="r_number" id="r_number" value="<?=$r_number;?>" readonly="readonly"/></td>
                <td align="right"><div class="tf">Website</div></td>
                <td>
                    <input type="text" name="website" id="website" value="<?=$website;?>"/></td>
              </tr>
              <tr>
                <td align="right"><div class="tf">Max Jobs Allowed</div></td>
                <td><input type="text" name="t_job" id="t_job" value="<?=$t_job;?>" readonly="readonly"/></td>
                <td align="right"><div class="tf">State</div></td>
                <td><?php
				$sql="SELECT statename FROM state order by statename";
				$result=mysql_query($sql);
				 while($rows=mysql_fetch_array($result))
				{
				  $value[]=$rows['statename'];
				}
				?><select name="state" id="state" class="seletc_frm" onChange="get_state(this,'city')" style="border: 1px solid #919191; font-size: 12px; width: 308px; color: #1A1A1A; -moz-border-radius: 5px; border-radius: 5px; background-color:#fafafa; padding:5px 5px; font-family:"Open Sans", Helvetica, Arial, sans-serif;">
                <?php
       for($x = 0; $x < count($value); $x++)
        	 {
               if($value[$x]==$state)
 	        {
  	           $selected ='selected';
  	        }else{
	           $selected = 'Please Select';
 	        }
		    echo '<option value="'.$value[$x].'"'.$selected.'>'.$value[$x].'</option>';
			}
		?>
            </select></td>
              </tr>
              <tr>
                <td align="right"><div class="tf">Jobs Remaining</div></td>
                <td><input type="text" name="r_job" id="r_job" value="<?=$r_job;?>" readonly="readonly"/></td>
                <td align="right"><div class="tf">City</div></td>
                <td><select name="city" id="city" style="border: 1px solid #919191; font-size: 12px; width: 308px; color: #1A1A1A; -moz-border-radius: 5px; border-radius: 5px; background-color:#fafafa; padding:5px 5px; font-family:"Open Sans", Helvetica, Arial, sans-serif;">
                <option value="<?=$city;?>"><?=$city;?></option>
            </select></td>
              </tr>
                 <tr>
                <td align="right"><div class="tf">Max API Allowed</div></td>
                <td><input type="text" name="max_api" id="max_api" value="<?=$max_api;?>" readonly="readonly"/></td>
                <td align="right"><div class="tf">Company</div></td>
                <td>
                   <input type="text" name="company_name" id="company_name" value="<?=$company_name;?>"/></td>
              </tr>
              <tr>
                <td align="right" valign="top"><div class="tf">API Remaining</div></td>
                <td valign="top"><input type="text" name="r_api" id="r_api" value="<?=$r_api;?>" readonly="readonly"/></td>
                <td align="right"><div class="tf">Address</div></td>
                <td>
                <textarea name="client_address" id="client_address" tabindex="5"><?=$address;?></textarea></td>
              </tr>
            <tr>
          <td align="center" colspan="4">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				  
				  <tr><td align="right" colspan="2" width="330px">
	              <div id="c_password"></div><input type="button" name="Submit" class="button" value="Save" onclick="account_save();"/>
				  </td>
				  <td id="account_div" width="370px" align="right"></td>
				</tr>
		    </table>          </td>
        </tr>
    </table> 
    </div> 
</td>
  </tr>
</table>
</form>

