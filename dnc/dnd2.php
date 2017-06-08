<?php  
set_time_limit(72000); 
	session_start();
	$user_id=$_SESSION['employee'];
	if(empty($_SESSION['employee']))
	{
		header("Location:./login/index.php");
	} 
require_once("../common/connection.php");
$phone = $_REQUEST['phone'];
    if (strlen($phone) > 10) {
        $phone = substr($phone, strlen($phone) - 10, strlen($phone));
    }
          $querys="select t_number from emp_master where emp_id='$user_id'";
	                                     $results=mysql_query($querys);
	                                      while($rows=mysql_fetch_array($results))
	                                        {
		                                     $r_no=$rows[0]-1;
	                                        }
      $queryue="update emp_master set t_number='$r_no' where emp_id='$user_id'";
     $resultue=mysql_query($queryue);
$mysql_link = @mysql_connect("localhost", "root", "") or die(2);
    @mysql_select_db('dnd', $mysql_link) or die(2);
    $status = Array('A' => 'DND : Active', 'D' => 'DND : Inactive');
    $category = Array(0=>'No Call & No SMS',1=>'Banking/Insurance/Financial Products/Credit Cards',2=>'Real Estate',3=>'Education',
        4=>'Health',5=>'Consumer goods and automobiles',6=>'Communication/Broadcasting/Entertainment/IT',7=>'Tourism and Leisure');
    
    $query = "select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_0 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_1 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_2 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_3 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_4 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_5 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_6 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_7 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_8 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_9 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_10 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_11 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_12 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_13 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_14 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_15 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_16 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_17 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_18 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_19 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_20 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_21 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_22 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_23 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_24 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_25 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_26 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_27 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_28 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_29 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_30 where f2='$phone' or f2='\"$phone\"' union
    select replace(f3,'\"','') as f3,replace(f4,'\"','') as f4 from dnd_13AUG where f2='$phone' or f2='\"$phone\"'";
    
    $dnd = "D";
    $result = @mysql_query($query) or die(2);
    if (mysql_num_rows($result)) {
        $row = mysql_fetch_object($result);
        if($row->f4=='A'){
            $dnd = 'A';
            $cat = explode("#",$row->f3);
        }
    }
?>
<table  border="0" width="100%" cellpadding="0" cellspacing="0">
      <tr>
      <td colspan="3"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;margin-left:11px; font-weight:bold;color:#666600"><?php echo $status[$dnd];?></span></td>
      </tr>
           <tr>
        <td colspan="3"><div class="adm_gride_border"></div></td>
      </tr>
          <tr class="adm_grid_heading">
		<td width="10%"><a href="#">Category Code</a></td>
        <td width="63%"><a href="#">Category</a></td>
		<td width="27%"><a href="#">Status</a></td>
 	</tr>
		   <tr>
        <td colspan="3"><div class="adm_gride_border"></div></td>
      </tr>
      <tr class="theme_tb_data" onmouseover='this.className="theme_tb_dataOver"' onmouseout='this.className="theme_tb_data"'>
<?php
    $i =0;
	foreach($category as $ck=>$cv)
      {
		
				if($i%2==0)
				{
				?>
    <tr class="theme_tb_data" onmouseover='this.className="theme_tb_dataOver"' onmouseout='this.className="theme_tb_data"'>
				<?php
				}
				else
				{
				?>
    <tr class="theme_text" onmouseover='this.className="theme_tb_dataOver"' onmouseout='this.className="theme_text"'>
				<?php
                }
				?>
		<td><?=$i;?>.</td>
        <td><?php echo $cv;?></td>
		 <?php
		echo "<td align='center'>".(in_array($ck, $cat)?"Yes":"-")."</td>";
		 ?>
	    </tr>
		<?
$i=$i+1;
}
exit();
?>
</table>

