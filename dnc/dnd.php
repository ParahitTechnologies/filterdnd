<?php  
set_time_limit(72000); 
	session_start();
	$user_id=$_SESSION['employee'];
	if(empty($_SESSION['employee']))
	{
		header("Location:./login/index.php");
	} 
if(isset($_REQUEST['phone']) && $_REQUEST['phone']!=''){
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
    @mysql_select_db('dnd_new', $mysql_link) or die(2);

    $status = Array('A' => 'DND : Active', 'D' => 'DND : Inactive');
    $category = Array(0=>'No Call & No SMS',1=>'Banking/Insurance/Financial Products/Credit Cards',2=>'Real Estate',3=>'Education',
        4=>'Health',5=>'Consumer goods and automobiles',6=>'Communication/Broadcasting/Entertainment/IT',7=>'Tourism and Leisure');
    
	$i = 0;
	$table = array();
	$query = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'dnd_new'";
	$result = @mysql_query($query) or die(mysql_error());
	if (mysql_num_rows($result)) {
		while ($row = mysql_fetch_object($result)) {
			if ($row->table_name == 'dnd_delete' || $row->table_name == 'never_call' || $row->table_name == 'dnd_ignore') {
				continue;
			}
			$table[] = $row->table_name;
		}
	}
	$dnd = "D";
	$query = "";
	foreach($table as $t){
		$query .= "select f3  from $t where f2='$phone' union ";
	}
	$query = rtrim($query," union ");
	//echo $query;
	$result = @mysql_query($query) or die(2);
	if (mysql_num_rows($result)) {
		$row = mysql_fetch_object($result);
		$dnd = "A";
		$cat = explode("#",$row->f3);
	}
	?>
<br><br>
    <table width="100%" cellpadding="3" cellspacing="0" border="0">
    <tr>
      <td colspan="4"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:gray"><?php echo $status[$dnd];?></span></td>
    </tr>
      <tr>
      <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold">S.No.</span></td>
       <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;font-weight:bold">Codes</span></td>
       <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;font-weight:bold">Categories</span></td>
        <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;font-weight:bold">Status</span></td>
    </tr>
    <?php
     $sn=1;
	 foreach($category as $ck=>$cv){     
		 ?>
		<tr>
	      <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"><?php echo $sn;?>.</span></td>
		  <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"><?php echo $ck;?></span></td>
	      <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"><?php echo $cv;?></span></td>
		  <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"><?php echo in_array($ck, $cat)?"Yes":"-";?></span></td>
	   </tr>
		<?php
        $sn=$sn+1;
	 }
	 exit();
	echo '</table>';
	}
	?>
<html>
    <head>
<link href="../css/style1.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="../js/jquery-1.7.1.js"></script>
        <script type="text/javascript">
            $(function() {        
                $("#button").click(function(){  
                     var phone=$("#phone").val();
                     if(phone=='')
                      {
                        alert("Please Enter Phone Number...!");
                         document.s_form.phone.focus();
                        return false;
                      }
                    $.ajax({
                        url : "dnd.php",
                        type : "GET",
                        data: {phone : $("#phone").val()},
                        timeout : 10000,
                        beforeSend: function(jqXHR, textStatus){
                            $("#alert").html("<img src=\'../images/loading_animation.gif\'>");
                        },                        
                        success: function(data, textStatus, jqXHR){
                            $("#alert").html(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            $("#alert").html(textStatus);
                        }
                    });                    
                });
            });
           </script>      
    </head>
    <body bgcolor="white">
	<form method="post" id="s_form" name="s_form" class="ContactForm">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td><input type="hidden" name="password" id="password" value="<?=$password;?>"/><input type="hidden" name="client_id" id="client_id" value="<?=$user_id;?>"/>
<table width="52%" border="0" align="center">
   <tr>
    <td align="center"><div align="center" style=" background:white;width:100%;height:370px;valign:middle;-moz-border-radius:0.6em;border:1px solid #EEEEFF; opacity:0.92; filter:alpha(opacity=100)"><table width="100%" border="0" align="center" style=" -moz-border-radius: 8px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold "  cellpadding="0" cellspacing="0">
	          
			  <tr>
 
          <td colspan="3" align="center"> <h1><span style="color:black">Single DNC</span></h1></td>
        </tr>
              
              <tr>
                <td align="right"><div class="tf"><span class="red">*</span>Phone number</div></td>
                 <td><input type="text" name="phone" id="phone"></td>
				 <td><input type="button" id="button" Value="Check DND" class="button"></td>
				</tr> 
				</table>
	<div id="alert"></div>
				</div>
				</td>
				</tr>
				</table>
			
		</form>
   </body>
</html>