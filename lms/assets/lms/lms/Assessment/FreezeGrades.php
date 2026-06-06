<html>
<head><title>MASTER SKILLS</title>
<Script language="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
	function RefreshMe(val)
	{
		document.MyFrm.action="FreezeGrades.php";
		document.MyFrm.submit();
	}

	
</script>
<?php
	session_start();
	include("../db.php");
if($_POST)
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$a_year=$_POST['a_year'];
}
else
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$a_year=$_SESSION['AcademicYear'];
}
$class_section_id=$_POST['class_section_id'];
if(isset($_POST['saveyear']))
{	
}
//modify
if(isset($_POST['modify']))
{
	
}
?>
</head>
<body class='bodyline'>
<br>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' border="1" class='forumline' width='50%' >
<tr>
  <td colspan='2' align='center' class='head'><p><strong>  Freeze Grades </strong></p></td></tr>
<tr height="25">
<td nowrap width="50%">&nbsp;&nbsp;Academic Year</td>
            <td> <select name="a_year" id="a_year" onchange='reload()'>
                <option value='0'>--Select--</option>
                <?php
				   $MyYear=date('Y')-1;
				   $CurrentYr=date("Y")+2;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}

						?>
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php
					 }
						   ?>
              </select></td>
              </tr>
<tr><td>&nbsp;&nbsp;School Division</td><td><select name="course" onChange="RefreshMe(0)">
<option value='-1'>-- Select --</option>
<?php
if($course=='0')
	$s="selected";
else
	$s="";
	$sql1=execute("select * from course_m ") or die(mysql_error());
	for($j=0;$j<rowcount($sql1);$j++)
	{
		$r1=fetcharray($sql1,$j);

		if($r1['course_id']==$course)
		{
			echo "<option value=$r1[course_id] selected>$r1[coursename]</option>";
		}
		else
		{
			echo "<option value=$r1[course_id]>$r1[coursename]</option>";
		}
	}

?>
</select></td></tr>
<tr>
      <td>&nbsp;&nbsp;Class</td>
      <td><select name="sem" onChange="RefreshMe(0)">
<option value=""> --Select-- </option>
<?php
	$sql=execute("select * from course_year  where head_id='$course'  ") or die(mysql_error());
	while($r=fetcharray($sql))
	{
		if($sem==$r[0])
			echo "<option value=$r[0] selected>$r[1]</option>";
		else
			echo "<option value=$r[0]>$r[1]</option>";
	}
?>
</select>
</td>
</tr>
 <tr>
  <td >&nbsp;&nbsp;Section</td><td><select name='class_section_id'  onChange="RefreshMe(0)">
<?
$rs_section=execute("select * from class_section");
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($class_section_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

}
?>
</select>
</td>
  </tr>


</table>
<br>  <div align='center' >
  <input type="submit" name="saveyear" value="Freeze Grades"  class='bgbutton'>
</div>  


<br>
<?php

		$yearstt=execute("SELECT id
FROM `exam_sub_m` where`acc_year`='$a_year' and `class`='$sem' and exam_id='$examname_m' and subject_id='$subject' and section='$class_section_id'  and status=1");
		$yearstt2=fetchrow($yearstt);
		$yearstt2[0];
		if($yearstt2[0]==0)
		die();
?>
	</form>
 </body>
</html>
