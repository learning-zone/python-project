 <?php
session_start();
include("../db.php");

$username = $_POST['username'];
$search = $_POST['search'];
$submit = $_POST['submit'];
?>
<script>
function win_open()
{
	var a = document.MyFrm.username.value;
	var len = a.length;
	if (a == "")
	{
		alert("Enter the Username atleast 3 characters !!");
		document.MyFrm.username.focus();
		return false;
	}
	else if (len < 3)
	{
		alert("Enter the First 3 characters of Username !!");
		document.MyFrm.username.focus();
		return false;
	}
	var x = window.open("usersearch5.php?username="+a,"user1","width=500,height=500,status=no,toolbar=no,scrollbar=no,menubar=no,sizeable=0");
}

</script>
<body >
<?php

echo "<center><br>";
echo "<table class=forumline  align=center width= '50%'>";
echo "<tr>";
echo "<td class=head colspan=4 class=head align=center>";
echo "SELECT USERNAME ";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<form method=post action='logweek_report.php' name='MyFrm'>";
echo "<td align='left' >User Name</td>";
echo "<TD WIDTH=45% ALIGN=LEFT>";

		$query = "SELECT username FROM users WHERE Activated='On'  ORDER BY username";
$rs = execute($query) or die("QUERY $query " . error_description());
       echo " <select name='username' onChange='reload1()'>";
	   echo "<OPTION VALUE='0'>------------ Select ------------

</OPTION>";
	   while($trow=fetcharray($rs))
	   {
		 //echo "<option value='$trow[0]'>$trow[0]</option>";
		 if($username==$trow[username])
		 {
			 echo "<option value='$trow[username]' selected>$trow[username]</option>";
		 }
		 else
		 {
			 echo "<option value='$trow[username]'>$trow[username]</option>";
			 }
		}
		
	echo "</select></TD>";
/*
echo "<tr><td>Users</td><td colspan=3><INPUT TYPE='TEXT' NAME='username' SIZE='15' value='$username'>&nbsp;&nbsp;
<INPUT TYPE='BUTTON' NAME='search' VALUE='SEARCH' CLASS='bgbutton' onClick='return win_open()'></td>";
*/
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<div align=center><input type=submit class=bgbutton name=submit value='Submit'></div>";
echo "</form>";

echo "</center>";
?>
</body>
</html>
