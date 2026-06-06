<html>
<head>
<script language='javascript'>
function shashi()
{
	document.frm.action="staffrt_det.php";
	document.frm.submit();
}

</script>
</head>
<?
include("../db.php");
$cour = $_POST['cour'];
$year = $_POST['year'];
$sec = $_POST['sec'];
$druo = $_POST['druo'];
?>
<form name='frm' action='viewstfrghts.php' method="post">
<table align='center' class='forumline'>
<tr><td class='head' align='center' colspan='2'>VIEW STAFF SUBJECT RIGHTS</td></tr>
<tr><td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']?></td><td>&nbsp;&nbsp;<select name='cour' onchange='return shashi()'>
<option value=0>----------- Select -----------</option>
<?
$rt=execute("select * from course_m");
while($pp=fetcharray($rt))
{
	if($cour==$pp[course_id])
	{
	echo "<option value='$pp[course_id]' selected>$pp[coursename]</option>";
	}
	else
	{
	echo "<option value='$pp[course_id]'>$pp[coursename]</option>";
	}

}
?>
</td></select>
<tr>
      <td>&nbsp;&nbsp;<?php echo $_SESSION['semname'] ?></td>
      <td>&nbsp;&nbsp;<select name='year' onchange='return shashi()'>
<option value=''>----- Select -----</option>
<?
$rew=fetcharray(execute("select	head_id from course_m where course_id='$cour'"));
if($cour==0)
$rta=execute("select *from course_year where year_id<3 ");
else
$rta=execute("select *from course_year where head_id='$rew[0]' and year_id>2 ");
while($pp1=fetcharray($rta))
{
	if($year==$pp1[year_id])
	{
	echo "<option value='$pp1[year_id]' selected>$pp1[year_name]</option>";
	}
	else
	{
	echo "<option value='$pp1[year_id]'>$pp1[year_name]</option>";
	}

}
?>
</td></select>
<tr><td>&nbsp;&nbsp;Section</td><td>&nbsp;&nbsp;<select name='sec' onchange='return shashi()'>
<?
$rtu=execute(" select *from class_section");
while($pp2=fetcharray($rtu))
{
	if($sec==$pp2[id])
	{
	echo "<option value='$pp2[id]' selected>$pp2[1]</option>";
	}
	else
	{
	echo "<option value='$pp2[id]'>$pp2[1]</option>";
	}

}
?>
</td></select>

</table>
<br>
<div align='center'><input type='submit' name='druo' value='SUBMIT' class='bgbutton'></div>
</form>
</html>
