<html>
<head>
<script language='javascript'>
function shashi()
{
	document.frm.action='powerstud.php';
	document.frm.submit();
}
</script>
</head>
<?php
include("../db.php");

if(isset($sha))
{
	$updt=execute("update student_m set count='0',Activated='On' where student_id='$stdid'");
	echo "<font color='blue' size='2'><b>STUDENT ACCOUNT HAS BEEN  SUCCESSFULLY OPENED..</b></font>";
}
?>
<form name='frm'>
<table class='forumline' align='center' width="30%">
<tr><td class='head' colspan='2' align='center'>STUDENT ACCOUNT OPEN</td></tr>
<tr>
<td> &nbsp; USER NAME</td>
<td align="LEFT">&nbsp;&nbsp;<select name='stdid' onchange='return shashi()'>
<option value='0'>-----Select-----</option>
<?
$rrt=execute("select * from student_m where count='5' and Activated='Off'");
while($dd=fetcharray($rrt))
{
if($stdid==$dd[student_id])
{
	echo "<option value='$dd[student_id]' selected>$dd[first_name]--$dd[student_id]</option>";
}
else
{
	echo "<option value='$dd[student_id]'>$dd[first_name]--$dd[student_id]</option>";
}
}
?>
</select>
</td>
</tr>
</table>
<br>
<div align="center"><input type='submit' name='sha' value='UNLOCK' class='bgbutton' ></div>

</form>
</html>


