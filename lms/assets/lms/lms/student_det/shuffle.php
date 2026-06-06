<?php
session_start();
require("../db.php");

$sql1 = "SELECT * FROM course_m order by coursename";
$sql2 = "SELECT a.* FROM course_year a,course_m b where a.head_id=b.head_id and a.status=1 and b.course_id='$course'";
if(empty($action))
{
	$action="ViewStudentList.php";
}
else
{
	$mesg = "";
}
?>
<html>
<head>
<title></title>
<script language="JavaScript">
function formSubmit()
{
	if(document.frm.course.selectedIndex != 0 && document.frm.sem.selectedIndex != 0)
		document.frm.submit();
	else
		alert("Please select a course and year !!");
}
function reload()
{
	document.frm.action='';
	document.frm.submit();
}
</script>
</head>
<body topmargin="0" leftmargin="0" link="#000000">
<form method="post" action="" name="frm">
<?=$mesg?>
<table class=forumline align=center>
<tr><td Class='head' colspan=4 align=center>Shuffle Students</td></tr>
<tr align="left">
<td ><font face="Arial">&nbsp;&nbsp; School Division&nbsp;&nbsp;</font></td>
<td >&nbsp;&nbsp;
<select name="course" size="1" onchange='reload()'>
<option value="0">-- Select--------</option>
<?php
$rs = execute($sql1);
$num = rowcount($rs);
for($i=0;$i<$num;$i++)
{
	$r = fetcharray($rs,$i);
	if($course==$r[course_id])
	{
		echo("<option value='" . $r["course_id"] . "' selected>" . $r["coursename"] . "</option>\n");
	}
	else
	{
		echo("<option value='" . $r["course_id"] . "'>" . $r["coursename"] . "</option>\n");
	}
}
?>
</select></td>
<td ><font face="Arial">&nbsp;&nbsp;Class&nbsp;&nbsp;</font></td>
<td align="center">&nbsp;&nbsp;
<select name="sem" size="1">
<option value="0">Select Class</option>
<?php
$rs = execute($sql2);
$num = rowcount($rs);
for($i=0;$i<$num;$i++)
{
	$r = fetcharray($rs,$i);
	echo("<option value='" . $r["year_id"] . "'>" . $r["year_name"] . "</option>\n");
}

?>
</select></td>
<tr align="center" >
<td align="center" colspan='4'><font face="Arial">&nbsp;&nbsp;No Of Section Shuffled&nbsp;&nbsp;</font>

<select name="shuffle" size="1" >
<option value="0">Select</option>
<?php
for($i=1;$i<=10;$i++)
				{
				if($i<10)
						$i=$i;
					$sel='';
					if($shuffle==$i)
						$sel='selected';
					echo "<option value='$i' $sel >$i</option>";
				}
?>
</select></td></tr>
<tr align="center">
<td colspan="4" height="25">
<input type="button" value="&lt;&lt; Submit &gt;&gt;" onClick="formSubmit()" class='bgbutton'>
</td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>