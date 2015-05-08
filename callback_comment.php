<?php
//Add the comment to database
session_start();
date_default_timezone_set('Asia/Shanghai');
include "Database.php";
$comment = $_GET['comment'];
$photoid = $_GET['photoid'];
$username = $_SESSION['name'];
$t = date("Y-m-d H:i:s");

$sql2="INSERT INTO comments
	(photoid,username,time,comment) VALUES
	('$photoid','$username','$t','$comment')";
$do=mysql_query($sql2,$my_conn);
if($do){
	echo '1@@@'.$t;
} else{
	echo 0;
}
?>