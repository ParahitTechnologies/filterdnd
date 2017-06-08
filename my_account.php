<?php
set_time_limit(72000000);
session_start();
if(empty($_SESSION['employee']))
{
   header("Location:index.php");
}
?>
<table width="300px" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<div align="center" style="background:white;width:90%;height:5%;valign:middle;-moz-border-radius:0.6em;border:1px solid #EEEEFF; opacity:.9; filter:alpha(opacity=90)">
<table width="100%" cellpadding="0" cellspacing="1" style=" -moz-border-radius: 1px;" align="center">
<tr>
    <td width="44%" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold;color:black; cursor:pointer" onclick="get_path('mange_account.php');">Manage Account</span></td>
	<td width="11%" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:18px; color:black">|</span></td>
	<td width="45%" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:black; cursor:pointer" onclick="get_path('change_password.php');">Change Password</span></td>
</tr>
</table>
</div>
</td>
</tr>
</table>