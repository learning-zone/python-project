<html>
<head></head>
<body>
<form method="post" action="PendingRequirementIndentDetails.php">
<?php
include("../db.php");
include("../urlaccess.php");
$FromDay = $_POST['FromDay'];
$FromMon = $_POST['FromMon'];
$FromYear = $_POST['FromYear'];
$ToDay = $_POST['ToDay'];
$ToMon = $_POST['ToMon'];
$ToYear = $_POST['ToYear'];
	$ToDay=explode("-",date("d-m-Y"));
?>
<table class=forumline align=center>
<tr><td Class=head align=center colspan=4>View Pending Requirement Indents</td></tr>
<tr>
<td Class=rowpic>Enter From Date</td>
<td>
<input type="text" name="FromDay" value="<?=$ToDay[0]?>" size="2" maxlength="2">
<input type="text" name="FromMon" value="<?=$ToDay[1]?>" size="2" maxlength="2">
<input type="text" name="FromYear" value="<?=$ToDay[2]?>" size="4" maxlength="4">
</td>
<td Class=rowpic>Enter To Date</td>
<td>
<input type="text" name="ToDay" value="<?=$ToDay[0]?>" size="2" maxlength="2">
<input type="text" name="ToMon" value="<?=$ToDay[1]?>" size="2" maxlength="2">
<input type="text" name="ToYear" value="<?=$ToDay[2]?>" size="4" maxlength="4">
</td>
</tr>
<tr><td colspan=4 align=center><input type="submit" value="View Pending Requirement Indents" class=bgbutton></td></tr>
</table>
</form>
</body>
</html>
