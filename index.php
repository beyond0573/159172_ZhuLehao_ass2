<?php
session_start();
	include "Database.php";
	date_default_timezone_set('Asia/Shanghai');
	 $sql2="CREATE TABLE IF NOT EXISTS `users`
	(
	`id` int NOT NULL auto_increment primary key,
	`username` varchar(10) NOT NULL,
	`admin`    int(2),
	`password` text NOT NULL ,
	`email` text NOT NULL ,
	`interest` text NOT NULL ,
	`sex`    text NOT NULL ,
	`select` text NOT NULL 
	)"; 
	$result1=mysql_query($sql2,$my_conn); 
	$sql3="select * from users where username = 'root'";
	$result2 = mysql_query($sql3, $my_conn) or die('Error: ' . mysql_error());
	$result2 = mysql_num_rows($result2);
	if($result2==0)
	{
		$sql4="INSERT INTO `users`
			(`username`,`admin`,`password`,`email`,`interest`,`sex`,`select`)
			VALUES('root','1','e10adc3949ba59abbe56e057f20f883e','root@qq.com','reading','male','master')";
		$result2=mysql_query($sql4,$my_conn); 
	}
//create photolist table
	$sql2="CREATE TABLE IF NOT EXISTS `photolist`
	(
		`id` int not null auto_increment primary key,
		`username` text not null ,
		`time` varchar(20) not null ,
		`permit` int not null,
		`photo` text not null,
		`title` text not null,
		`description` text not null
	)";
	$do=mysql_query($sql2,$my_conn);
//create comments table
$sql3="CREATE TABLE IF NOT EXISTS `comments`
(
	`id` int(6) not null auto_increment primary key,
	`photoid` int(6) not null ,
	`username` varchar(20) not null,
	`time` varchar(20) not null,
	`comment` text not null 
)";
$do=mysql_query($sql3,$my_conn);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>index</title>
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
    <td width="989" height="297"><img src='http://localhost/159172_ZhuLehao_ass2/submissions/01300000023544121299376470252.jpg' alt='henfu' title='hhhhhhh' height="292" width="1280"    /></td>
  </tr>
</table>
<hr class="hr4" />
<table width="1290" height="42" border="0" align="left">
<tr align="center" bgcolor="#F9F3dd">
<?php
	/*change the layout if the user login */
	//session_start();
	if( isset($_GET["logout"]))
	{
		unset($_SESSION["name"]);
		session_destroy();
	}
	
	if(isset($_SESSION["name"]))
	{
		$sql2="select admin from users where username='".$_SESSION["name"]."'";
		$do=mysql_query($sql2,$my_conn) or die('Error: ' . mysql_error());
		$do=mysql_fetch_array($do);
	    if($do['admin']=='0')
		{
		?>
		<div class="STYLE3">
		<td width="10" height="22">|</td>
		<td width="419" height="22" valign="middle"><div class="STYLE3"><h2><a href="index.php">Homepage</a></h2><div></td>
		<td width="7" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="index.php?logout=true">Logout</a></h2></td>
		<td width="9" height="22">|</td>
		<td width="266" height="22"><h2><a href="Submit.php">Submit</a><h2></td>
		</div>
		<?php
		}
		else
		{
		?>
		<div class="STYLE3">
		<td width="10" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="index.php">Homepage</a></h2></td>
		<td width="8" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="index.php?logout=true">Logout</a></h2></td>
		<td width="9" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="UserList.php">UserList</a></h2></td>
		<td width="10" height="22">|</td>
		<td width="419" height="22" valign="middle"><h2><a href="UserSubmit.php">UserSubmit</a></h2></td>
		</div>
		<?php
		}
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
<p>&nbsp;</p>
<table width="1285" height="550" border="1">
  <tr align="center">
    <td width="529" height="33">Image</td>
    <td width="740">Comment</td>
  </tr>
  <?php
	//Record how many photoes have been uploaded
	$sql3="select id from photolist ";
	$result=mysql_query($sql3,$my_conn);
	$number_of_photos=mysql_num_rows($result);
   if($number_of_photos==0 )
  { ?>
	<tr>
	<td height="318">There is no image right now</td>
    <td height="318">&nbsp;</td>
	</tr>
  <?php
  }
  else
  {	
   if(isset($_GET["IDnum"]))
   {
		 $currentID=$_GET["IDnum"];
   }
   else
   {
		$currentID=$number_of_photos;
   }
 
   if($currentID!=$number_of_photos)
   {
	 $currentID1=$currentID+1;
	 echo'<a href="index.php?IDnum='.$currentID1.'">Previous Page  |</a>';
   }
   if($currentID!=1)
	{
		 $currentID2=$currentID-1;
		 echo'<a  href="index.php?IDnum='.$currentID2.'">   Next Page</a>';
	}
   ?>
    <tr>
    <td height="425">
	<?php
	$sql4="select * from photolist where id='".$currentID."'";
	$result=mysql_query($sql4,$my_conn);
	$showphoto=mysql_fetch_array($result) or die('Error: ' . mysql_error());
	$description=$showphoto['description'];
	if($showphoto['permit']==1)
	{
		echo '<div class="STYLE2"><p align='.center.'>Title: '.$showphoto['title'].'</p></div>';
		echo "<img src='http://localhost/159172_ZhuLehao_ass2/".$showphoto['photo']."' alt='$showphoto[description]' title='$showphoto[title]' height=\"300\" hspace=10  width=\"200\" align='".Left."' />";
		echo $description;
	}
	else 
	{	
		$sql5="select admin from users where username='".$_SESSION["name"]."'";
		$do=mysql_query($sql5,$my_conn) or die('Error: ' . mysql_error());
		$do=mysql_fetch_array($do);
	    if($do['admin']=='0')
		{
			echo "The picture has not been approved by adminster ";
		}
		else
		{
			echo "There are photos need you to examine";
		}
	}
	
	?>
	</td>
	<td height="425">
	<div id="comment-content">
	<?php
	if($number_of_photos !=0)
	{
		$sql2="select * from comments where photoid=$currentID";
		$do=mysql_query($sql2,$my_conn);
		$i = 1;
		while($rows=mysql_fetch_array($do))
		{
			echo '<div id="'."div".$i.'" class="comments">
			<p>Comment: '.$rows['comment'].'</p>
			<p align='.right.'>Author: '.$rows['username'].' | PostTime: '.$rows['time'].'</p>
			</div>';
			$i++;
		}
	}
	?>
	<input id="count" type="hidden" value="<?php echo $i; ?>" />
	</div>
	<div align="center" class="STYLE2" id="comment">
	<?php
	if(!isset($_SESSION["name"]))
	{
		echo "<script>alert('You have not login, you cant comment');hisory.go(-l);</script>";
	}
	else
	{
		$commentPage="index.php?IDnum="."$currentID";
		echo'<form action='.$commentPage.' method="post" name="form1" id="form1" class="STYLE2">
		<div align="center"><textarea name="comment" cols="60" rows="20" id="comment_text"></textarea>
		<br><input id="button" type="button" value="Comment" name="Comment" onClick="checkComment()" /><input name=cres type="reset" value="reset" /></br>
		</div></form>';
		
		$user=$_SESSION['name'];
		echo"<input id=\"photoid\" type=\"hidden\" value=\"$currentID\" />";
		echo"<input id=\"un\" type=\"hidden\" value=\"$user\" />";
	}
	?>
	</div>
	</td>
	</tr>
	<?php	
	}
?>
</table>

</body>
</html>

<?php
// put  the image into Submission file 
		if(isset($_SESSION['name']))
		{
			$user=$_SESSION['name'];
         if(isset($_POST["submit"]))
		 {
			$upload_file="submissions/" . $_FILES["userfile"]["name"];
			$description=trim($_POST['description']);
			$title=trim($_POST['title']);
			//remove the uploaded picture to submissions file
			if( move_uploaded_file($_FILES["userfile"]["tmp_name"],$upload_file))
			{
				echo "<p><strong>Photo uploaded successfully</strong></p>";
				$time = date("Y-m-d H:i:s");
				$permit=0;
				//add information of a new picture to the photolist table
				$sql2="INSERT INTO photolist
				(username,time,permit,photo,title,description) VALUES
				('$user','$time','$permit','$upload_file','$title','$description')";
				$do=mysql_query($sql2,$my_conn) or die ('Error: ' . mysql_error());
				echo "<script>alert('Submit success.');window.self.location='index.php'</script>";
			}
			else
			{
			// upload failed
				echo"Upload failed"."(".$_FILES["file"]["error"].")";
			}
		}
		}
				
?> 


