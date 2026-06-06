<?php
require_once("../db.php");
$member = $_POST['member'];
$B1 = $_POST['B1'];
$sql = "SELECT * FROM library_name";
$libname = execute($sql);
$row=rowcount($libname);
?>
<html>
<body>
<form method="POST" action="selectMember.php" name="frm">
	<table align='center' class='forumline' width="47%">
		<tr><br/>
			<td  align='center' class='head' colspan='2'>Add Member</td>
		</tr>
		<tr>
			<td align="right">Select Member&nbsp;&nbsp;&nbsp;</td>
			<td><select size="1" name="member" >
			<option value="">--- Member Type ---</option>
			<option value="1">Student</option>
			<option value="2">Staff</option>
			<!--<option value="3">Department</option>-->
			</select></td>
		</tr>
		<tr>
			</td>
		</tr>
	</table>
    <p align="center"><input type="submit" value="Submit" name="B1" class='bgbutton'></p>
    
</form>
</body>
</html>