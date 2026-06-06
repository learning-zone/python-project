<html>
<head>
<title>MIS</title>
<?php
session_start();
/*

A front end to search archive staff members
Date: 05/03/2005
shobha
*/
require("../db.php");
?>
</head>
<body topmargin="15" leftmargin="5">
<form method="POST"  action="StaffListsToPromot.php" name="frm">
<div align="center"><center>
<table border=1 class="forumline">
<tr><td Class="head" align='center' colspan="4"><font face='Lucida Sans' size='3'>Add/Modify Service Book Information</font></td></tr>
<tr><td align="center" colspan="4"><font color='Brown'><b>*** Enter any one or more fields to Search Data ***</b></td></tr>
<tr><td><font face="Arial">Staff ID : </font></td><td><input type="text" name="slno"></td>
<td><font face="Arial">&nbsp;&nbsp;&nbsp;First Name : </font></td><td><input type="text" name="f_name"></td></tr>
<tr><td colspan="2" align="right"><font face="Arial">Department : </font></td><td colspan="2"><select  name="subj" size="1">
<option  value="0">-:- Select Department -:-</option>
<?php
$temp = "SELECT * FROM dept_no";
$rs = execute($temp);
$num = rowcount($rs);
for($i=0;$i<$num;$i++){
	$r = fetcharray($rs,$i);
	echo("<option value='" . $r[1] . "'>" . $r[0] . "</option>");
}
?>
</select></td></tr>
<tr><td colspan="4" align="center"><font face="Arial"><small><div align="center"><center><p></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
type="submit" value="<< SEARCH >>" name="B1" class="bgbutton"></font></td></tr>
</table>
</form>
</center>
</div>
</body>
</html>