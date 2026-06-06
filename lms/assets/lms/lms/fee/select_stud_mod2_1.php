<?php
session_start();
include("../db.php");
include("../urlaccess.php");
if($user=='')
{
	header("Location:login.php");
}
else
{
	$p_th=$_SERVER['SCRIPT_NAME'];
	$qry=execute("select * from usermenu where username='$user' and access='Yes' and linkpath='$p_th'");
	if(rowcount($qry)==0)
	{
		header("Location:login.php");
	}
}
?>
<HTML>
<HEAD>
<TITLE>Student details Modify form</TITLE>
</HEAD>
<BODY>
<table width=100 class=forumline align="center">
<tr><td class=head colspan=3 align=center><b>Search Form</b></td></tr>
<SCRIPT LANGUAGE="JavaScript">
function validate()
{
	if ((document.studret.Student_id.value != "") && (document.studret.studFName.value != "" || document.studret.studLName.value != "" || document.studret.Coradmit.options[document.studret.Coradmit.selectedIndex].value != "0" || document.studret.acayr.options[document.studret.acayr.selectedIndex].value != "0" || document.studret.courseyr.options[document.studret.courseyr.selectedIndex].value != "0"))
	{
	alert("Please enter SR Number only")
	document.studret.Student_id.focus()
	return false
	}

	if ((document.studret.Coradmit.options[document.studret.Coradmit.selectedIndex].value != "0" && document.studret.acayr.options[document.studret.acayr.selectedIndex].value != "0" && document.studret.courseyr.options[document.studret.courseyr.selectedIndex].value != "0" && document.studret.studFName.value != "") && (document.studret.studLName.value != "" || document.studret.Student_id.value != ""))
	{
	alert("Please enter Course, Academic Year, Course Year and Student First Name")
	document.studret.Coradmit.options[document.studret.Coradmit.selectedIndex].focus()
	return false
	}
 document.studret.submit();
}
function reload()
{
	document.studret.action='select_stud_mod2.php';
	document.studret.submit();
}
</SCRIPT>
<?php
$rs = execute("SELECT * FROM student_m where archive='N'");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method=post action="FetchStudDetails.php" name="studret" onSubmit="return validate()">
	<tr><td align=center  colspan=3 >SR Number:</td></tr>
	<tr><td colspan=3 align='center'><input type=TEXT name="Student_id"></td></tr>
	<tr><td align=center colspan=3 ><Font face="verdana" ><font color='red'> OR </font></font></td></tr>
	<tr><td >Select Course:</td><td >Academic Year:<font color=Red>*</font>:</td>
	<td  align=Left>Course Year:<font color=Red>*</font>:</td>	</tr>
	<tr><td align=left><SELECT name="Coradmit" onchange='reload()'><OPTION selected value="0">Select</option>
	<?php
	$rs = execute("SELECT course_id,coursename,head_id FROM course_m");
	$num = rowcount($rs);
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		if($r[0]==$Coradmit)
		{
			?>
			<option value="<?=$r[0]?>" selected><?=$r[1]?></option>
			<?php
			$cid=$r[head_id];
		}
		else
		{
			?>
			<option value="<?=$r[0]?>"><?=$r[1]?></option>
			<?php
		}
	}
	?>
	</SELECT></td>
	<TD><SELECT name="acayr"><Option Value="0">Select</Option>
	<?php
	$ar = date('Y');
	for($i=2000;$i<=($ar+1);$i++)
	{
		$j=$i+1;
		$j=substr($j,2);
		?>
	 	<OPTION  value="<?=$i . "/" . $i+1 ?>"><?= $i?>-<?= $j ?></option>	
		<?php
	}
	?>
	</SELECT></TD>
	<td><SELECT name="courseyr"><OPTION selected value="0">Select</option>
	<?php
	$r = execute("SELECT * FROM course_year where head_id='$cid'");
	$num = rowcount($r);
	for($i=0;$i<$num;$i++)
	{
		$rsy = fetcharray($r,$i);
		?>
	   <option  value="<?=$rsy[0]?>"><?=$rsy[1]?></OPtion>
		<?php
	}
	?>
	</SELECT></td></tr>
	<tr><td align=Left width=150 >Student First Name:</td>
    <td align=Left width=150 >Student Last Name:</td><td></td></tr>
    <tr><td><input type=text name="studFName"></td>
	<td><input type=text name="studLName"></td><td></td></tr>
	</br><tr><td align=center colspan=3 ><INPUT TYPE="submit" class=bgbutton name="studmoddel" value="Submit">
	<INPUT TYPE=Reset name="studmodcan"class=bgbutton  value="Cancel"></td></tr>
	<tr><td colspan="3" align="center">
	<table >
	<tr><td class="row2">Note: The search combination are<td></tr>
	<tr><td class="row2">SR Number</td><tr>
	<td class="rowpic">or</td></tr>
	<tr><td class="row2">Course and Academic Year</td></tr>
	<tr><td class="row2">Course and Academic Year and Course Year</td></tr>
	<tr><td class="rowpic">or</td></tr>
	<tr><td class="row2">Course and Course Year</td></tr>
	<tr><td class="rowpic">or</td></tr>
	<tr><td class="row2">Course, Academic year, Course year and Student First Name</td></tr>
	</table></td></tr></table>
	<Input Type="Hidden" Name="Types" Value="<?=$type?>">
	</form>
	<?php
}
else
{
	?>
	<td class="row2">No studentid Record</td>
	<?php
}
?>
</body>
</html>