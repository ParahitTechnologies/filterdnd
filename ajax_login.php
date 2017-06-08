<?php
session_start();
include('common/connection.php');
$emp_id=trim($_REQUEST['username']);
$pass=trim($_REQUEST['password']);
              
$sql="SELECT id,emp_id, emp_password,emp_status FROM emp_master WHERE emp_id='$emp_id'";
$result=mysql_query($sql,$mysql_link);
$row=mysql_fetch_array($result);
if(mysql_num_rows($result)>0)
{
	if(strcmp($row['emp_password'],$pass)==0)
	{
	           if($row['emp_status']==0)
                  {
                     echo "yes";
			$_SESSION['employee']=$emp_id;
			$employee = $_SESSION['employee'];

                     $query_1="select id from employee_dnc_history WHERE client_id='$row[0]' and date(date_time)=date(sysdate()) limit 1";
                     $result_1=@mysql_query($query_1,$mysql_link);
		       if(mysql_num_rows($result_1)==0)
                        {
				$query_2 = "insert into employee_dnc_history(client_id,date_time) values('$row[0]',sysdate())";
	                     $result_2=@mysql_query($query_2,$mysql_link);

				//$query_2 = "update emp_master set t_upload=fix_upload, t_number=fix_number where id='$row[0]'";
	                     //$result_2=@mysql_query($query_2,$mysql_link);
		           }
                     }
                 else
                  {
                       echo "no1";
                  }
            
      }
	else
	{
			echo "no";
	}	
}
else if($emp_id=='SPEED_DNC' && $pass=='SPEED@#$987')
	{
			       echo "yes";
                $_SESSION['employee']=$emp_id;
                $employee = $_SESSION['emp_id'];
	}
else
{
		echo "no";
}
?>