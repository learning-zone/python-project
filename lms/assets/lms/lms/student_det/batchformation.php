<?php
session_start();
include("../urlaccess.php");
require("../db.php");
/*Copyright   
This is an Search form to get the student details and batch master details from the student_m and batch_master table.*/


$sql3 = "SELECT * FROM class_section";
if(empty($action))
{
	$action="viewbatchformlist.php";
}
else
{
	$mesg = "";
}
?>
<html>
<head>
<title> </title>
<script language="JavaScript">
function frm_load()
{
	document.frm.action="batchformation.php";
	document.frm.submit();
}
function formSubmit()
{
	if(document.frm.sem.selectedIndex != 0 && document.frm.section.selectedIndex != "")
		document.frm.submit();
	else
		alert("Please select a course / year and section!!");
}
</script>
</head>
<body topmargin="0" leftmargin="0" link="#000000">
<form method="post" action="<?=$action?>" name="frm">
<?=$mesg?>
<table class='forumline' align='center'>
<tr><td class='head' align='center' colspan=6>Apply Student to Batch </td></tr>

<?php
	$sql1 = "SELECT course_id,coursename FROM course_m ORDER BY course_id";
	//echo $sql1;
	?>
	<tr align="left"><td width="30"><font face="Arial">Course</font></td>
	<td width="100"><div align="left"><select name="course" size="1" onchange='frm_load()'>
	<?php
	if($course==0)
	{
		?>
		<option value=0 selected>-- Select For First Year--</option>
		<?php
	}
	else
	{
		?>
		<option value=''>-- Select For First Year--</option>
		<?php
	}
	$rs = execute($sql1);
	$num = rowcount($rs);
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs);
		if($r["course_id"]==$course)
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
	<td width="30"><font face="Arial"><div align="right"><p>Year</font></td>
	<td width="100" align="center"><select name="sem" size="1">
	<option value="0">Select Year</option>
	<?php
		if($course!=0)
		{
			$sql2 = "SELECT * FROM course_year where year_id > 2 ";
		}
		else
		{
			$sql2 = "SELECT * FROM course_year where year_id < 3 ";
		}

	$rs = execute($sql2);
	$num = rowcount($rs);
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		if($r["year_id"]==$sem)
		{
		echo("<option value='" . $r["year_id"] . "' selected>" . $r["year_name"] . "</option>\n");
		}
		else
		{
		echo("<option value='" . $r["year_id"] . "'>" . $r["year_name"] . "</option>\n");
		}
	}
	?>
	</select></td>
	<td width="30"><font face="Arial"><div align="right"><p>Section</font></td>
	<td width="100" align="center">
	<select name="section" size="1">
	<option value="">Select Section</option>
	<option value="0">No Section</option>
	<?php
	echo $sql3."<br>";
	$rs = execute($sql3);
	$num = rowcount($rs);
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		echo("<option value='" . $r["id"] . "'>" . $r["section_name"] . "</option>\n");
	}
	?>
	</select></td></tr>
	<tr align="center"><td colspan="6" height="25">
	<input type="button" value="&lt;&lt; Submit &gt;&gt;" onClick="formSubmit()" class='bgbutton'></td></tr>
	</table>
	<?
//}
?>
</form>
</td></tr>
</table>
</body>
</html>