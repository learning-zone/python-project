
<?php

require("../db.php");
$sql1 = "SELECT * FROM course_m ";
$sql2 = "SELECT * FROM course_year order by year_id asc";
?>
<html>
<head>
<title>View </title>
<script language="JavaScript">
window.status = "Select a Course and Year to Promote...";
function validate(){
if(document.frm.FromCourse.selectedIndex != -1 ){
document.frm.submit();
}else{
alert("Please select a course.");
}
}
</script>
<base target="footer">
</head>
<body topmargin="0" leftmargin="0" link="#000000">
<center>
<table width="150"><tr><td Class="Block">Promotion Details</td></tr></table>
</center>
<form method="GET" action="promote.php" name="frm">
<div align="center"><center><table border="1" width="550" cellspacing="0">
<tr align="center">
<td width="52"><small><font face="Arial">Course</font></small></td>
<td colspan="3" align="left">
<select name="FromCourse" size="1">
<option selected value="-1">-- Select a Course--</option>
<?php
$rs1 = execute($sql1);
$num = rowcount($rs1);
for($i=0;$i<$num;$i++){
$r1 = fetcharray($rs1,$i);
echo "<option value='$r1[0]'>$r1[1]</option>";
}
?>
</select> </td>
</tr>
<tr align="center">
<td width="52"><small><font face="Arial">Semester</font></small></td>
<td width="215" align="left"><select name="FromYear"">
<option value="-1">Select From Year</option>
<?php
$rs2 = execute($sql2);
$num = rowcount($rs2);
for($i=0;$i<$num;$i++){
$r2 = fetcharray($rs2,$i);
?>
<option value="<?=$r2["year_id"]?>"><?=$r2["year_name"]?></option>
<?php
}
?>
</select> </td>
</tr>
<tr align="center">
<td width="534" colspan="4" align="center"><input type="button"
value="View Student List" name="B1" onClick="validate()"
onMouseOver="this.style.backgroundColor='green';this.style.cursor='hand';this.style.color='white'"
onMouseOut="this.style.backgroundColor='silver';this.style.cursor='default';this.style.color='black'"
Title="Promote/Demote Students."> </td>
</tr>
</table>
</center></div>
</form>
</body>
</html>
