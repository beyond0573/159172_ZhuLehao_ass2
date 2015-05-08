<?php
	session_start();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<style type="text/css">
<!--
.hr4{ height:10px;border:none;border-top:10px double red;}
  -->
 </style>
<link href="blog.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="991" border="1">
  <tr>
    <td width="989" height="297"><img src="submissions/01300000023544121299376470252.jpg" width="1280" height="292" alt="henfu" /></td>
  </tr>
</table>
<hr class="hr4" />
<table width="1290" height="42" border="0" align="left">
  <tr align="center" bgcolor="#F9F3dd">
    <td width="10" height="22">|</td>
    <td width="419" height="22"><h2><a href="index.php">Homepage</a></h2></td>
    <td width="9" height="22">|</td>
    <td width="223" height="22"><h2><a href="Registration.php">Registration</a></h2></td>
    <td width="8" height="22">|</td>
    <td width="314" height="22"><h2><a href="Login.php">Login</a></h2></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="1290" border="1" align="center">
<FORM action="Login.php" method="post" onSubmit="return Check()">
  <tr>
	<td width="265">&nbsp;</td>
		<td width="727"><table width="380" height="131" border="1" align="center">
      <tr>
        <td height="38" colspan="2"><div align="center" class="STYLE1">Login Input </div></td>
       </tr>
      <tr>
        <td width="181"><div align="center" class="STYLE1"><LABEL for="namelabel">Username: </LABEL></div></td>
		<td width="1030"><INPUT type="text" name="username"> </td>
      </tr>
      <tr>
        <td width="181"><div align="center" class="STYLE1"><LABEL for="passwordlabel">Password: </LABEL></div></td>
		<td width="1030"><INPUT type="password" name="password"></td>
      </tr>
	  <tr>
		<td colspan="2"><input type="submit" name="Submit" value="Login">
	</tr>
    </table></td>
    <td width="276">&nbsp;</td>
  </tr>
  </FORM>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
function valid_login($name,$pwd)
  {
	include "Database.php";
	$pwd=md5($pwd);
	$sql = "select id from users where username = '".$name."' and password = '".$pwd."'";
	$do = mysql_query($sql,$my_conn);
	$re_num=mysql_num_rows($do);
	if($re_num!=0)
	{
		return true;
	} 
	else
	{
		return false;
	}
  }
?>
<?php
  $name=$_POST["username"];
  $passwd=$_POST["password"];

  if(isset($_POST['Submit']))
  {
	if(!valid_login($name,$passwd))
	echo "<script>alert('Wrong Password or Username! Please enter again!');hisory.go(-l);</script>";
	else 
	{
		echo "<script>alert('Log success.');window.self.location='index.php'</script>";
				$_SESSION["name"] = $name;
	}
  }
  
  
?>