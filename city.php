<?php
      include_once("common/connection.php");
        $state =$_REQUEST['state'];
             $query = "select cityname from city where statename='$state'";
		    $result = mysql_query($query);
          while ($row = mysql_fetch_array($result))
       echo "<option value='$row[0]'>$row[0]</option>";
?>
                        