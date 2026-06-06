<?php
	session_start();
	include("../db.php");
	$user=$_SESSION['user'];
?>
<html>
<head>
<?php
if(isset($_POST['submit']))
{
	if($_POST['password']!=$_POST['con_password'])
	{
  		echo "<script language='JavaScript'>";
		echo "alert('Miss match in New Password and Confirm password !.')";
		echo "</script>";
	}
}
?>
</head>
<body class='bodyline'>
<?php
	if(isset($_POST['submit']))
	{
		$username=$_POST['username'];
	  if($_POST['password']==$_POST['con_password'])
		{
			$password1 = $_POST['oldpassword'];
			$qry = "select * from student_m where username='$username' and password='$password1'";
			$rs = execute($qry);
			if($rs)
			{
				if(rowcount($rs) == 0)
				{
					echo "<p><font color='red'><b>Enter valid Old Password...</b></font></p>";
				}
				else
				{
					$password = $_POST['password'];
					$qry = "update student_m set password='$password' where username='$username'";
					echo "<script language='JavaScript'>";
					echo "alert('Password Changed Successfully ...')";
					echo "</script>";
					execute($qry);
				}
			}
		}
	}
	echo "<center>";
	$qry1 = execute("select * from student_m where username='$user'");
	if(rowcount($qry1)>0)
	{
	echo "<form method=post>";
	echo "<table class='forumline' width='30%'>";
	echo "<tr><td colspan=3 align='center' class='head'><b>Change Password</b></td></tr>";
	echo "<input type=hidden name=username value='$user' size=15 maxlength=20>";
	echo "<tr>";
	echo "<td nowrap>";
	echo "Old Password";
	echo "</td>";
	echo "<td>";
	echo "<input type=password name=oldpassword size=15 maxlength=20>";
	echo "</td>";
	echo "<td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td nowrap>";
	echo "New Password";
	echo "</td>";
	echo "<td>";
	echo "<input type=password name=password size=15>";
	echo "</td>";
	echo "<td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td nowrap>";
	echo "Confirm New Password";
	echo "</td>";
	echo "<td>";
	echo "<input type=password name=con_password size=15>";
	echo "</td>";
	echo "<td>";
	echo "</tr>";
	echo "</table>";
	echo "<br>";
	echo "<input type=submit name=submit value='Update' class='bgbutton'>";
	echo "</form>";
	echo "</center>";
	}
	else
	{
	echo "<div align='left'><font color='red'><b>This Link is Authorized Only for Student</b></font></div>";
	}
?>
</body>
</html>

