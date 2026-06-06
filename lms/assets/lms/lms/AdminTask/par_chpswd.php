<?php
	session_start();
	include("../db.php");
	
	$user=$_SESSION['user'];
	$usernamedet=$_SESSION['usernamedet'];
	
	if($usernamedet=='parent_name')
	{
		$passfield='parent_username';
		$usern='f_email';
	}
	else
	{
		$passfield='parent_password';
		$usern='m_email';
	}
	$usermailid=fetchrow(execute("select $usern from student_m where student_id = '$user'"));
	$username=$_POST['username'];
	$oldpassword=$_POST['oldpassword'];
	$password=$_POST['password'];
	$con_password=$_POST['con_password'];
	$submit=$_POST['submit'];
?>
<html>
<head>
</head>
<body class='bodyline'>
<?php
if($submit)
{
	if($password)
	{
		if($password==$con_password)
		{
			//$password1 = md5($oldpassword);
			$qry = "select * from student_m where student_id = '$user' and $passfield='$oldpassword'";
			$rs = execute($qry);
			//if($rs)
			//{
				if(rowcount($rs)==0)
				{
					echo "<script language='JavaScript'>";
					echo "alert('Enter valid Old Password...')";
					echo "</script>";
				}
				else
				{
					//$password = md5($password);
					$qry = "update student_m set $passfield='$password' where $usern='$usermailid[0]'";
					echo "<script language='JavaScript'>";
					echo "alert('Password Changed Successfully ...')";
					echo "</script>";
					execute($qry);
				}
			//}
		}
	}
	else
	{
		echo "<script language='JavaScript'>";
		echo "alert('Invalid Password ...')";
		echo "</script>";
	}

}
echo "<center>";
$qry1 = execute("select * from student_m where username='$user'");
if(rowcount($qry1)>0)
{
	?>
<form method=post>

<table class='forumline' width='30%' align="center">
<tr><td colspan=3 align='center' class='head'><b><font size='2'>Change Password</font></b></td></tr>
<tr>
<td nowrap>
Old Password
</td>
<td>
<input type='password' name='oldpassword' size='15' maxlength='20'>
</td>
<td>
</tr>
<tr>
<td nowrap>
New Password
</td>
<td>

<input type='password' name='password' size='15'>
</td>
<td>

</tr>
<tr>
<td nowrap>
Confirm New Password
</td>
<td>

<input type='password' name='con_password' size='15'>
</td>
<td>

</tr>

</table>
<br>
<div align="center">
<input type='submit' name='submit' value='Update' class='bgbutton'>
</div>
</form>

<?php
}
else
	{
	echo "<div align='left'><font color='red'><b>This Link is Authorized Only for Parents</b></font></div>";
	}
?>
</body>
</html>

