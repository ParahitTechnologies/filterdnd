<?php
set_time_limit(72000000);
session_start();
if(empty($_SESSION['employee']))
{
   header("Location:../index.php");
}
?>
<table width="300px" cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center">
<div align="center" class="style1" style="background:white;width:90%;height:5%;valign:middle;-moz-border-radius:0.6em;border:1px solid #EEEEFF; opacity:.9; filter:alpha(opacity=90)">

</div>
</td>
</tr>
</table>
<div id='my_div' style="text-align:center;position:absolute;overflow:auto;left:16%;margin-right:1%;top:170px;height:390px;border:0px solid black;text-align:center;"></div>
