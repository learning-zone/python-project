<html>
<head>
</head>
<?php
	session_start();
	include("../db.php");
	include("../urlaccess.php");
	$FromDay = $_POST['FromDay'];
$FromMon = $_POST['FromMon'];
$FromYear = $_POST['FromYear'];
$ToDay = $_POST['ToDay'];
$ToMon = $_POST['ToMon'];
$ToYear = $_POST['ToYear'];
$dept = $_POST['dept'];

$ToDay=explode("-",date("d-m-Y"));



?>
<body>
<form method="post" action="AssetMovementRegisterDetails.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=4>Asset Movement Register</td></tr>
<tr>
<td Class="row3">Enter From Date</td>
<td>
<input type="text" name="FromDay" value="<?=$ToDay[0]?>" size="2" maxlength="2">
<input type="text" name="FromMon" value="<?=$ToDay[1]?>" size="2" maxlength="2">
<input type="text" name="FromYear" value="<?=$ToDay[2]?>" size="4" maxlength="4">
</td>

<td Class="row3">Enter To Date</td>
<td>
<input type="text" name="ToDay" value="<?=$ToDay[0]?>" size="2" maxlength="2">
<input type="text" name="ToMon" value="<?=$ToDay[1]?>" size="2" maxlength="2">
<input type="text" name="ToYear" value="<?=$ToDay[2]?>" size="4" maxlength="4">
</td>
<tr><td Class="row3">Select Department</td><td colspan=3><select name="dept">
<option value="-1">All</option>
<?php
	$sql=execute("select * from dept_no");

	for($i=0;$i<rowcount($sql);$i++)
	{
		$r=fetcharray($sql,$i);

		echo "<option value=$r[dpt_id]>$r[Dept]</option>";
	}
?>
</select></td>
</tr>
<tr><td colspan=4 align=center><input type="submit" value="View Asset Movement Register" class=bgbutton></td></tr>
</table>
</form>
</body>
</html>
