<?php
require_once("../db.php");
$sql = "SELECT * FROM library_name";
$libname = execute($sql);
$row=rowcount($libname);
?>
<html>
<body>
<form method="POST" action="viewMember.php" name="frm">
	<table align='center' class='forumline' width="47%">
		<tr>
			<td align='center' class='head' colspan='2'>Cancel Member</td>
		</tr>
		<tr>
			<td align="right">Select Member&nbsp;&nbsp;&nbsp;</td>
			<td><select size="1" name="member" >
			<option value="-1">Select the Member</option>
			<option value="1">Student</option>
			<option value="2">Staff</option>
			<option value="3">Department</option>
			</select></td>
		</tr>
		<tr>
		</tr>
	</table>
    <br>
    <div align='center'><input type="submit" value="Submit" name="B1" class="bgbutton"></div>
</form>
</body>
</html>