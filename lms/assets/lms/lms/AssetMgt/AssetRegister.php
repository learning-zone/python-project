<html>
<head>
<title>View Asset Master / Register</title>
</head>
<body>
<?php
session_start();
include("../db.php");
include("../urlaccess.php");



$id = $_POST['id'];
$SeekPos = $_POST['SeekPos'];
$PAGES = $_POST['PAGES'];
$dept = $_POST['dept'];
$go_to = $_POST['go_to'];
$but_go_to = $_POST['but_go_to'];
$print = $_POST['print'];
?>
<form method="post" action="AssetRegisterDetails.php">
<table class=forumline align=center
<tr><td align=center colspan=6 class=head>Asset Master</td></tr>
<tr><td>Select Department</td><td><select name="dept">
<option value="-1">All</option>
<?php
$sql=execute("select * from dept_no") or die(error_description());
for($i=0;$i<rowcount($sql);$i++)
{
	$r=fetcharray($sql,$i);
	echo "<option value=$r[dpt_id]>$r[Dept]</option>";
}
?>
</select></td></tr>
<tr><td colspan=2 align=center><input type="submit" value="View Asset Register / Asset Master" class=bgbutton></td></tr>
</table>
</form>
</body>
</html>
