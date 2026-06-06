<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='skillset_report.php';
	document.frm.submit();
	
}
function reload1()
{
	document.frm.action='skillset_report1.php';
	document.frm.submit();
	
}

</SCRIPT>
</HEAD>

<body>
<?php 
session_start();
require("../db.php");
// SUBJECT RIGHTS STARTS
	$user=$_SESSION['user'];
	
$sql21=execute("select a.curri_type, a.grade,	a.sect from class_teacher a,users b where b.username='$user' and a.teacher=b.srid order by a.curri_type, a.grade");

$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID order by a.course_id, a.year_id, a.subject_id");
	if(rowcount($sql)==0 and rowcount($sql21)==0)
	{
		echo die("You don't have rights"); 
	}
if(rowcount($sql21)!=0)
{
	while($r12=fetcharray($sql21))
	{
		$branch1[]=$r12[0];
		$br=$r12[0];
		$yearname1[]=$r12[1];
		$sm1=$r12[1];
		$sql5=execute("select subject_id from subject_m where course_id='$br' and course_year_id='$sm1' and	status=1 order by sub_pre");
		while($r=fetcharray($sql5))
		{
			$subject_id[]=$r[0];
		}
	}
}

$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID order by a.course_id, a.year_id, a.subject_id");
if(rowcount($sql)!=0)
{
	while($r12=fetcharray($sql))
	{
		$branch1[]=$r12[0];
		$yearname1[]=$r12[2];
		$subject_id[]=$r12[1];
	}
}

$branch2=array_unique($branch1);
$yearname2=array_unique($yearname1);
asort($yearname2);
$subject_id2=array_unique($subject_id);
//SUBJECT RIGHTS ENDS

$course=$_SESSION['course'];
$sem=$_SESSION['sem'];
$course=$_POST['course'];
$sem=$_POST['sem'];
$examname=$_POST['examname'];
$class_section_id=$_POST['class_section_id'];
echo '<form name="frm" action="" method="post" >';	

?>
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Skill Set Report card</td>
    </tr>
<tr><td width="40%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td><td>&nbsp;<select name="course" onChange="reload()">
<option value=''>-- Select --</option>
<?php
	while (list(, $value) = each($branch2)) 
	{
		$j=$value;
		$sql1="select coursename from course_m where course_id='".$j."'";
		$sqlname=fetchrow(execute($sql1));
		if($j==$course)
		{
			echo "<option value='$j' selected>$sqlname[0]</option>";
		}
		else
		{
			echo "<option value='$j'>$sqlname[0]</option>";
		}
	}

?>
</select></td></tr>
<tr>
      <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
      <td>&nbsp;<select name="sem" onChange="reload()">
<option value="">Select</option>
<?php
	while (list(, $value) = each($yearname2)) 
	{
		$j=$value;
		$sql1="select year_name from course_year where year_id='".$j."' and head_id='".$course."'";
		$sqlname=fetchrow(execute($sql1));
		if($j==$sem)
		{
			echo "<option value='$j' selected>$sqlname[0]</option>";
		}
		else
		{
			echo "<option value='$j'>$sqlname[0]</option>";
		}
	}
?>
</select>
</td>
</tr>
  <tr>
  <td height="28">&nbsp;&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="reload()">
<?
$rs_section=execute("select * from class_section");
echo "<option value='-1'>--Select--</option>";
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
  <?php

  if($class_section_id=='')
  die();
  if($sem=='0' || $sem=='')
	die();
  $sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N'";
	if($course!=0)
	{
	$sql123.=" and course_admitted=$course";
	}
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	$sql123.=" order by gender desc,first_name";
	$rs=execute($sql123) or die(mysql_error());
  ?><br>
  
  <div align="center" >
  	<input type="button" name="Print" value="Print All" class="bgbutton" onClick="printall()">&nbsp;&nbsp;&nbsp;
  	<input type="button" name="export" value="Export All" class="bgbutton" onClick="exportall()">
  
  </div>
  
  <br>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr height="25">
    <td width="10%" class="row3">Sl No.</td>
    <td width="40%" align="center" class="row3">Name</td>
    <td width="20%" align="center" class="row3">Student Id</td>
    <td width="23%" align="center" class="row3">Action</td>
   <!-- <td width="7%" align="center">Sel</td>-->
  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>
    <td nowrap align='center'>&nbsp;";
	?><a href= "javascript:OpenWind2('skillset_report1.php?course=<?=$course?>&sem=<?=$sem?>&examid=<?=$examname?>&studentid=<?=$r1[id]?>&class_section_id=<?=$class_section_id?>&stundetname=<?=$r1[first_name]?>&student_id=<?=$r1[student_id]?>')">Print		
</a>
&nbsp;&nbsp;
<a href= "javascript:OpenWind2('skillset_reportword.php?course=<?=$course?>&sem=<?=$sem?>&examid=<?=$examname?>&studentid=<?=$r1[id]?>&class_section_id=<?=$class_section_id?>&stundetname=<?=$r1[first_name]?>&student_id=<?=$r1[student_id]?>')">Export Word		
</a> </td> <!--<td align="center">
	<input type="checkbox" name="check[]" value="<?=$r1[id]?>" checked>
    <input type="hidden" name="stuid<?=$r1[id]?>" value="<?=$r1[student_id]?>">
     <input type="hidden" name="stuname<?=$r1[id]?>" value="<?=$r1[first_name]?>">
      <input type="hidden" name="admissionid<?=$r1[id]?>" value="<?=$r1[admission_id]?>">
    </td>-->
  </tr><?php
$i++;  }
  ?>
  
</table>
<br>
<!--<div align="center"><input type="button" name="open" value="View All" onClick="reload1()"></div>	-->			
</form>	
</body>
</html>
