<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UserSubmission</title>
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
		<div class="STYLE3">
		<td width="419" height="22" valign="middle"><h2><a href="index.php">Homepage</a></h2></td>
		<td width="9" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="index.php?logout=true">Logout</a></h2></td>
		<td width="9" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="UserList.php">UserList</a></h2></td>
		<td width="9" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="UserSubmit.php">UserSubmit</a></h2></td>
		</div>
  </tr>
</table>
<p>&nbsp;</p>
<table width="1290" height="351" border="1">
<tr>
  <td height="302">
	<?php
		include "Database.php";
		$sql2="select id from photolist where permit=0";
		$do=mysql_query($sql2,$my_conn) or die('Error: ' . mysql_error());
	?>
		<form method="POST" name="form1">
		<?php	
		while($rows=mysql_fetch_array($do))
		{
			$sql1="select id,photo from photolist where id='".$rows['id']."'";
			$image=mysql_query($sql1,$my_conn);
			$image=mysql_fetch_array($image);
			echo '<br/>';
			echo "<img src='".$image['photo']."' height=\"500\"/>";
			echo '<input type="checkbox" name="checkbox[]" value='.$image['id'].'/>';          
		    echo '<br/><br/><br/>' ;    		                                                                                                   
		}
		echo '<input type="submit" name="Submit"/>';
	?>
	</form>
	   <?php
	   		if(isset($_POST['Submit']))
			{
				$checkbox = $_POST['checkbox']; 
				for($i=0; $i<count($checkbox); $i++)
				{
					$k=$checkbox[$i];
					$k=(int)$k;
					include "Database.php";
					$sql="update photolist set permit=1 where id='$k'";
					$do=mysql_query($sql,$my_conn) or die('Error: ' . mysql_error());
				}
				echo "<script>alert('Examine success.');window.self.location='UserSubmit.php'</script>";
			}
	   ?>
		</td>
	</tr>
  <tr>
    <td height="37">&nbsp;</td>
  </tr>	
</table>
</body>
</html>