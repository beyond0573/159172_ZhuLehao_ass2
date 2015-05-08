
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Registration</title>
<script type="text/javascript" src="ajax.js"></script>
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
    <td width="989" height="296"><img src="submissions/01300000023544121299376470252.jpg" width="1280" height="292" alt="henfu" /></td>
  </tr>
</table>
<hr class="hr4" />
<table width="1290" height="42" border="0" align="left">
  <tr align="center" bgcolor="#F9F3dd">
    <td width="10" height="22">|</td>
	<td width="419" height="22" valign="middle"><h2><a href="index.php">Homepage</a></h2></td>
	<td width="9" height="22">|</td>
	<td width="223" height="22"><h2><a href="Registration.php">Registration</a></h2></td>
	<td width="8" height="22">|</td>
	<td width="314" height="22"><h2><a href="Login.php">Login</a></h2></td>
	
  </tr>
</table>

<p>&nbsp;</p>
<table width="1290" border="1">
<FORM action="Registration.php" method="post" name="send" onSubmit="return checkSubmit()">

			<P>		
			<tr>
					<td width="248" height="307">&nbsp;</td>
					<td width="738"><table width="778" height="233" border="1" align="center">
			<tr>
				<td colspan="2"><div align="center" class="STYLE1">Regislation Information</div></td>
			</tr>
			<tr>
				<td width="181"><div align="center" class="STYLE1"><LABEL for="namelabel">Name: </LABEL></div></td>
				<td width="1030"><INPUT type="text" name="name" onblur="checkname(this.value)"><span class="STYLE1" id="namehint"></span></td>
			</tr>
			<tr>
				<td width="181"><div align="center" class="STYLE1"><LABEL for="passwordlabel">Password: </LABEL></div></td>
				<td width="1030"><INPUT type="password" name="password" onkeyup="checkPwd1(this.value)" id="password1"><span class="STYLE1" id="password1hint"></span></td>
			</tr>
			<tr>
				<td width="181"><div align="center" class="STYLE1"><LABEL for="passwordchecklabel">Password Check: </LABEL></div></td>
				<td width="1030"><INPUT type="password" id="password2" name="passwordcheck" onkeyup="checkPwd2(this.value)"><span class="STYLE1" id="password2hint">
				</span></td>
			</tr>
			<tr>
				<td><div align="center" class="STYLE1"><LABEL for="emaillabel">Email: </LABEL></div></td>
				<td><INPUT type="text" name="email" onblur="checkEmail(this.value)"><span class="STYLE1" id="emailhint"></span></td>
			</tr>
			<tr>
				<td><div align="center" class="STYLE1"><LABEL for="Genderlabel">Gender: </LABEL></div></td>
				<td><p>
				  <label>
				    <input type="radio" name="sex" value="male" id="RadioGroup1_0" />
				    Male
				  </label>
				  <label>
				    <input type="radio" name="sex" value="female" id="RadioGroup1_1" />
				    Female
				  </label>
			    </p></td>
			</tr>
			<tr>
				<td><div align="center" class="STYLE1"><LABEL for="Educationlabel">Education: </LABEL></div></td>
				<td><label for="select"></label>
				  <select name="select" id="select">
					<option value="Bachelor">Bachelor</option>
					<option value="Master">Master</option>
					<option selected value="Phd">Phd</option>
		        </select></td>
			</tr>
			<tr>
				<td><div align="center" class="STYLE1"><LABEL for="Interestlabel">Interest: </LABEl></div></td>
				<td><p>
				  <label>
				    <input type="checkbox" name="interest1" value="Reading" id="CheckboxGroup1_0" />
				    Reading 
				  </label>
				  <label>
				    <input type="checkbox" name="interest2" value=" Computer Game" id="CheckboxGroup1_1" />
				    Computer Game
				  </label>
				  <label>
				    <input type="checkbox" name="interest3" value="Movie" id="CheckboxGroup1_2" />
				    Movie
				  </label>
				  <label>
				    <input type="checkbox" name="interest4" value="Sports" id="CheckboxGroup1_3" />
				  </label>
				  Sports
				  <label>
				    <input type="checkbox" name="interest5" value="Music" id="CheckboxGroup1_4" />
				    Music
				  </label>
			    </p></td>
			</tr>
			<tr>
			  <td colspan="2"><input type="submit" name="Submit" value="Submit Information">
			    <input type="reset" value="Reset Form"></td>
			</tr>
	          </table>					  <p>&nbsp;</p></td>
			<td width="282">&nbsp;</td>
			</tr>
			<td height="77"></P>
	</FORM>
</table>
</body>
</html>

<?php 
include 'Database.php';
 function valid_username($n){
	//check an username is possibly valid
	include "Database.php";
	$sql="select id from users where username = '".$n."'";
	$do=mysql_query($sql,$my_conn);
	$re_num=mysql_num_rows($do);
	if($re_num!=0){
		return false;
	}else{
		return true;
	}
}
?>
<?php
 
		$name = trim($_POST["name"]);
		$password = trim($_POST["password"]);
		$password=md5($password);
		$email = trim($_POST["email"]);
		$sex = trim($_POST["sex"]);
		$select = trim($_POST["select"]);	
		$interest1 = trim($_POST["interest1"]);
		$interest2 = trim($_POST["interest2"]);
		$interest3 = trim($_POST["interest3"]);
		$interest4 = trim($_POST["interest4"]);
		$interest5 = trim($_POST["interest5"]);
		
			$str=$interest1.'|'.$interest2.'|'.$interest3.'|'.$interest4.'|'.$interest5;
		if(isset($_POST["Submit"]))
		{
			$sql3="INSERT INTO `users`
			(`username`,`admin`,`password`,`email`,`interest`,`sex`,`select`)
			VALUES('$name','0','$password','$email','$str','$sex','$select')";
			if(!valid_username($name))
			{
				echo "<script>alert('The name has existed! Please change the name !');hisory.go(-l);</script>";
			}
			else
			{
				$result3=mysql_query($sql3,$my_conn)
				or die('Error: ' . mysql_error());	
				echo "<script>alert('Registrate success.');window.self.location='Login.php'</script>";
			}
		}
			
?>