<?php
$v = explode(",", $args[1]);
print_r($args); die;
$DB_NAME_CLIENT = "filterdnc";
$DB_USER_CLIENT = "root";
$DB_PASS_CLIENT = "";
$DB_HOST_CLIENT = "localhost";

$mysql_link_client = @mysql_connect($DB_HOST_CLIENT, $DB_USER_CLIENT, $DB_PASS_CLIENT, true) or die(header("location:505.php"));
@mysql_select_db($DB_NAME_CLIENT, $mysql_link_client) or die("DB error");

$query_client = "select f2, f4 from dnc.dnd where f2 IN (" . implode(",", $v) . ")";
$result_client = @mysql_query($query_client) or die(mysql_error());
if (mysql_num_rows($result_client) > 0) {
    while ($row = mysql_fetch_assoc($result_client)) {
        if ($row['f4'] == 'A') {
            array_push($dnd_data_client, $row['f2']);
            $key = array_search($row['f2'], $v);
            unset($v[$key]);
        }
    }
    $non_dnd_client = $v;
}
mysql_close($mysql_link_client);
echo implode(",", $dnd_data_client)."$$$".implode(",", $non_dnd_client);
?>