<?php
//check whether username has been used
include "Database.php";
$name = $_GET['name'];
$sql="select id from users where username = '".$name."'";
$do=mysql_query($sql,$my_conn);
$re_num=mysql_num_rows($do);
echo $re_num;
?>