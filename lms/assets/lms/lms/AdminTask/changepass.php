<?php
session_start();
include("../db.php");
?>
<html>
<head>
<?php
$user=$_SESSION['user'];
$username=$_POST['username'];
$password=$_POST['password'];
$con_password=$_POST['con_password'];
$oldpassword=$_POST['oldpassword'];
if($_POST['submit'])
{
	if($password!=$con_password)
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

if($_POST['submit'])
{
	if($password==$con_password)
	{
		$password1 = md5($oldpassword);
		$qry = "select * from users where username = '$username' and password='$password1'";
		$rs = execute($qry);
		if($rs)
		{
			if(rowcount($rs) == 0)
			{
				echo "<p>Enter valid Old Password...</p>";
			}
			else
			{
				$password = md5($password);
				$qry = "update users set password='$password' where username='$username'";
				execute($qry);
				echo "Password Changed Successfuly";
				?>
				<script language="javasccript">
				alert("Password Changed Successfuly");
				</script>
				<?php
			}
		}
	}

}
echo "<center>";

echo "<form method=post>";

echo "<table class='forumline' width = '40%'>";
echo "<tr><td  colspan=3 align='center' class='head' nowrap>Change Password</td></tr>";
echo "<input type=hidden name=username value='$user' size=15 maxlength=20>";
echo "<tr>";
echo "<td >";
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

echo "</table><br>";
echo "<input type=submit name=submit value='Update' class='bgbutton'>";
echo "</form>";
echo "</center>";
?>
</body>
</html>

