<?php 
	//database information
	$host="localhost";
	$user="root";
	$pass="123456";
	$my_conn=mysql_connect($host,$user,$pass);
	$sql= "CREATE DATABASE IF NOT EXISTS a134";
	$result=mysql_query($sql,$my_conn);
	$dataname="a134";
	mysql_select_db('a134', $my_conn);
?>