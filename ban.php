<?php
require_once('config.php');

$q =intval($_GET['q']); 
$r=intval($_GET['r']);
echo $q;
echo $r;
$q1=1;


$sql= "UPDATE conversation SET banned= 1 WHERE c_id = $q";
$result = mysql_query($sql)or die(mysql_error());
$sql1= "UPDATE conversation_reply SET deleted = 1 WHERE cr_id = $r";

$result1 = mysql_query($sql1)or die(mysql_error());
echo 'User Banned ';
?>