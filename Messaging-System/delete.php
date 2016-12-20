<?php 
require_once('config.php');

$q =intval($_GET['q']); 
echo $q;
$q1=1;


$sql= "UPDATE conversation_reply SET deleted = 1 WHERE cr_id = $q";

$result = mysql_query($sql)or die(mysql_error());
echo 'Message Deleted';
?>