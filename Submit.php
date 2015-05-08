<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Submit</title>
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
<?php
	/*change the layout if the user login */
	session_start();
	if( isset($_GET["logout"]))
	{
		unset($_SESSION["name"]);
		session_destroy();
	}
	if(isset($_SESSION["name"]))
	{
		?>
		<div class="STYLE3">
		<td width="10" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="index.php">Homepage</a></h2></td>
		<td width="9" height="22">|</td>
		<td width="223" height="22"><h2><a href="Registration.php">Registration</a></h2></td>
		<td width="8" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="index.php?logout=true">Logout</a></h2></td>
		<td width="9" height="22">|</td>
		<td width="266" height="22"><h2><a href="Submit.php">Submit</a></h2></td>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="STYLE3">
		<td width="10" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="index.php">Homepage</a></h2></td>
		<td width="9" height="22">|</td>
		<td width="223" height="22"><h2><a href="Registration.php">Registration</a></h2></td>
		<td width="8" height="22">|</td>
		<td width="314" height="22"><h2><a href="Login.php">Login</a></h2></td>
		</div>
		<?php
	}
?>
  </tr>
</table>
<p>&nbsp;</p>
<table width="1290" border="1">
  <tr>
    <td height="285">
    <p>
    <table width="1290" border="1">
  <tr>
    <td width="248" height="91">&nbsp;</td>
    <td width="794">  
    
   
      <p>
	     <table width="794" border="1">
    
        <tr>
		  <FORM enctype="multipart/form-data" action="index.php" method=post name="file1">
			<tr>
				<td width="1030"><div align="center" class="STYLE1"><LABEL for="titlelabel">Titile: </LABEL><INPUT type="text" name="title" ></div></td>
			</tr>
			<tr>
   				<td width="1030" colspan="2"><div align="center"><input type="file" id="userfile"	name="userfile", 	maxlength="100"></div></td>
			</tr>
			<tr>
				<td><div align="center" class="STYLE1"><LABEL for="titlelabel">Description: </LABEL></div></td>
				
			</tr>
			<tr>
			    <td><div align="center"><textarea name="description" cols="60" rows="20" id="description"></textarea></div>	</td>
			</tr>
			<tr>
					<td><input type="submit" 	name="submit" 	value="Attach file"></td>
			</tr>
		</FORM>
          </tr>
      </table>
	  </p>
    <td width="226">&nbsp;</td>
  </tr>
</table>

    <p>&nbsp;</p></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
