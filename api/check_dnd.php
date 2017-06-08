<?php

$mysql_link = @mysql_connect("localhost", "root", "") or die(2);
@mysql_select_db('dnd', $mysql_link) or die(2);

if(isset($_REQUEST['addphone'])){
    $phone = $_REQUEST['addphone'];
    if(strlen($phone) > 10){
       $phone=substr($phone,strlen($phone)-10,strlen($phone));
    }
    $phone = substr($phone, strlen($phone)-10, strlen($phone));
    $query = "insert into never_call(phone) values('$phone')";
    $result = @mysql_query($query, $mysql_link);
    exit();
}

$i = 4;
if(!isset($_REQUEST['phone'])){
    echo $i = 3;
    exit();
}
$api_key = $_REQUEST['api_key'];
if($api_key!="speeddemoQAZiopNSB2514"){
    echo $i = "4";
    exit();
}
$phone = $_REQUEST['phone'];
if($phone==""){
    echo $i = 3;
    exit();
}
if(is_null($phone)){
    echo $i = 3;
    exit();
}
if(strlen($phone) > 10){
    $phone=substr($phone,strlen($phone)-10,strlen($phone));
}
$i=0;

$query = "select phone from dnd_ignore where phone='$phone' limit 1";
$result = @mysql_query($query) or die(2);
if(mysql_num_rows($result)){
    echo $i = 0;
    exit();
}
$query = "select phone from never_call where phone='$phone' limit 1";
$result = @mysql_query($query) or die(2);
if(mysql_num_rows($result)){
    echo $i = 1;
    exit();
}
$i = 0;
$table = array();
for($x=40;$x>=0;$x--){
    $table[] = "dnd_".$x;
}
$query = "";
foreach($table as $t){
    $query .= "select f2,f4,'$t' as tab  from $t where f2='$phone' union ";
}
$query = rtrim($query," union ");
$result = @mysql_query($query) or die(2);
if (mysql_num_rows($result)) {
    $row = mysql_fetch_object($result);
    if($row->f4=='A'){
        $i = 1;       
    }
}
echo $i;
?>