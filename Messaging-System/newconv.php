<html>
<head>
<style>
#label
{
font-family:"Segoe UI", sans-serif;

}
.press
{

width:50px;
display:block;
background: #fff;
font-family:"Segoe UI", sans-serif;
color:#006699;
text-transform:uppercase;
position:relative;
border-color:#006699;
border-style:solid;
height:30px;
font-size: 12px;
cursor: pointer;
text-align:left;
font-weight:bold;
}
</style>
</head>
<body>
<?php
require_once("config.php");
$user_one=intval($_GET['user_one']);
$user_two=intval($_GET['target_id']);
$username1=$_GET['username1'];
$username2=$_GET['username2'];

if(isset($_POST['submit'])){

$user_one=intval($_POST['user_one']);
$user_two=intval($_POST['target_id']);
$username1=$_POST['username1'];
$username2=$_POST['username2'];
     $subquery1=mysql_query("SELECT * FROM usersmsg WHERE username='$username1' ") or die(mysql_error());
 if(mysql_num_rows($subquery1)==0)
 {
    $qry=mysql_query("INSERT INTO usersmsg  VALUES ('$user_one','$username1')") or die(mysql_error());
    }
     $subquery2=mysql_query("SELECT * FROM usersmsg WHERE username='$username2' ") or die(mysql_error());
     if(mysql_num_rows($subquery2)==0)
     {
    $qry=mysql_query("INSERT INTO usersmsg  VALUES ('$user_two','$username2')") or die(mysql_error());
    }
$query= mysql_query("SELECT * FROM conversation WHERE (((user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one')) and banned<>'0' )") or die(mysql_error());
if(mysql_num_rows($query)==0){
if($user_one!=$user_two)
{
$q= mysql_query("SELECT c_id FROM conversation WHERE (((user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one')) AND banned=0 )") or die(mysql_error());

$time=time();
$ip=$_SERVER['REMOTE_ADDR'];
if(mysql_num_rows($q)==0)
{
$query = mysql_query("INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('$user_one','$user_two','$ip','$time')") or die(mysql_error());
$q= mysql_query("SELECT c_id FROM conversation WHERE (((user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one')) AND banned=0 )") or die(mysql_error());

$v=mysql_fetch_array($q);
$c_id= $v['c_id'];
$reply=mysql_real_escape_string($_POST['reply']);
//$cid=mysql_real_escape_string($_GET['cid']);
$uid=mysql_real_escape_string($user_one);
$time=time();
//$ip=$_SERVER['REMOTE_ADDR'];
$q1= mysql_query("INSERT INTO conversation_reply (user_id,reply,ip,time,c_id) VALUES ('$uid','$reply','$ip','$time','$c_id')") or die(mysql_error());
echo '<p><span style="font-size: 16px; font-weight: bold; font-family: Segoe UI, sans-serif; color: #000;">Message Successfully sent</span></p>';
}
else
{
$q=mysql_query("SELECT c_id FROM conversation WHERE (((user_one='$user_one' and user_two='$user_one')or (user_one='$user_two' and user_two='$user_one')) AND banned ='0')");
$v=mysql_fetch_array($q);
$c_id= $v['c_id'];
$reply=mysql_real_escape_string($_POST['reply']);
//$cid=mysql_real_escape_string($_POST['c_id']);
$uid=mysql_real_escape_string($user_one);
$time=time();
$ip=$_SERVER['REMOTE_ADDR'];
$q1= mysql_query("INSERT INTO conversation_reply (user_id,reply,ip,time,c_id) VALUES ('$uid','$reply','$ip','$time','$c_id')") or die(mysql_error());
echo '<p><span style="font-size: 16px; font-weight: bold; font-family: Segoe UI, sans-serif; color: #000;">Message Successfully sent</span></p>';?>
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="form1">
<label for="newconv" id="label" ><p><span style="font-size: 16px; font-weight: bold; font-family: Segoe UI, sans-serif; color: #000;">Send message to <?php echo $username2;?></span><br></p>
<input type="hidden" name="target_id" value="<?php echo $user_two;?>" id="target_id"/>
<input type="hidden" name="user_one" value="<?php echo $user_one;?>" id="user_one"/>
<input type="hidden" name="username2" value="<?php echo $username2;?>" id="username2"/>
<input type="hidden" name="username1" value="<?php echo $username1;?>" id="username1"/>
<textarea rows='5' cols="40" name="reply"></textarea>
<input class="press" type="submit" name="submit" value="Send" />
<?php
}
}
}
else{
echo '<p><span style="font-size: 16px; font-weight: bold; font-family: Segoe UI, sans-serif; color: #000;">You have blocked this user</span><br><span style="font-size: 12px; font-family: Segoe UI, sans-serif; color: #000;"> Please unblock to send and recieve messages</span></p>';
}
}

else
{
?>
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="form1">
<label for="newconv" id="label" ><p><span style="font-size: 16px; font-weight: bold; font-family: Segoe UI, sans-serif; color: #000;">Send message to <?php echo $username2;?></span></p>
</label>
<input type="hidden" name="target_id" value="<?php echo $user_two;?>" id="target_id"/>
<input type="hidden" name="user_one" value="<?php echo $user_one;?>" id="user_one"/>
<input type="hidden" name="username2" value="<?php echo $username2;?>" id="username2"/>
<input type="hidden" name="username1" value="<?php echo $username1;?>" id="username1"/>
<textarea rows='5' cols="40" name="reply"></textarea>
<input class="press" type="submit" name="submit" value="Send" />

<?php
//echo $user_one.$user_two.$username1.$username2;
}
?>
</body>
</html>