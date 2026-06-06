<html>
<head>
<title>View Asset Master / Register</title>
</head>
<body>
<?php
	session_start();
	include("../db.php");
	include("../urlaccess.php");
	
	$print = $_POST['print'];
$dept = $_POST['dept'];
?>
<form method="post" action="LocationwiseAssetReportDetails.php">
<table class=forumline align=center>
<tr><td colspan=3 class=head align=center>Location Wise Asset Report</td></tr>
<tr><td>Select Department</td><td><select name="dept">
<option value="-1">All</option>
<?php

$sql=execute("select * from dept_no where dept!='Central Stores' ") or die(error_description());

for($i=0;$i<rowcount($sql);$i++)
{
	$r=fetcharray($sql,$i);

	echo "<option value=$r[dpt_id]>$r[Dept]</option>";
}
?>
</select></td></tr>
<tr><td colspan=2 align=center><input type="submit" value="View Locationwise Asset Report" class=bgbutton></td></tr>
</table>
</form>
</body>
</html>



