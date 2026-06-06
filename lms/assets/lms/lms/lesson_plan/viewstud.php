<html>
<head>
<Script language="JavaScript">
function OpenWind2(URL, title,w,h)
{
 var left = (screen.width/2)-(w/2);
 var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
	function RefreshMe(val)
	{
		document.MyFrm.action="viewstud.php";
		document.MyFrm.submit();
	}

	
</script>
<?php
	session_start();
	include("../db.php");
	
	$accyeardet=$_SESSION['AcademicYear'];

if($_POST)
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
}
else
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
	$priority=$_POST['priority'];
	$subject=$_POST['subject'];
	$titlename=$_POST['titlename'];
	$sub_title=$_POST['sub_title'];
	$skills=$_POST['skills'];
	$examname_m=$_POST['examname_m'];
	$class_section_id=$_POST['class_section_id'];
	
	
if(isset($_POST['update']))
{
	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$priority=$_POST['priority'.$cid[$i]];
		$skills=$_POST['skills'.$cid[$i]];
		
       
	
	}
}
?>
	
	
	
	<?php

if($_POST)
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
}
else
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
	$priority=$_POST['priority'];
	$subject=$_POST['subject'];
	
?>
</head>
<body class='bodyline'>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' class='forumline' width='70%' >

<tr>
  <td colspan='3' align='center' class='head'>Lesson Plan</td></tr>
<tr><td>&nbsp;&nbsp;School Division</td><td colspan='2'><select name="course" onChange="RefreshMe(0)">
<option value=''>-- Select --</option>
<?php
if($course=='0')
	$s="selected";
else
	$s="";
	$sql1=execute("select * from course_m ") or die(mysql_error());
	for($j=0;$j<rowcount($sql1);$j++)
	{
		$r1=fetcharray($sql1,$j);

		if($r1[course_id]==$course)
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
      <td colspan='2'><select name="sem" onChange="RefreshMe(0)">
<option value="">Select Class</option>
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
	<td>&nbsp;&nbsp;Subject Name</td><td colspan='2'><select name="subject" onChange="RefreshMe(0)">
	<option value="">Select Subject </option>
<?php
	$sql3=execute("select subject_id, subject_name from subject_m where course_id='$course' and course_year_id='$sem' and status='1' order by sub_pre") or die(mysql_error());
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[0]==$subject)
		{
			echo "<option value=$r3[0] selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value=$r3[0]>$r3[1]</option>";
		}
	}
?>
</select>
</td>
</tr>

<tr>
  <td height="28">&nbsp;&nbsp;Section</td>
  <td><select name='class_section_id'  onChange="RefreshMe(0)">
<?
$rs_section=execute("SELECT * FROM student_m a,class_section b WHERE a.archive='N' and a.class_section_id=b.id and course_yearsem='$sem' group by b.id");
echo "<option value=''>--Select--</option>";
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
$class_section_id=$_POST['class_section_id'];

	
if( $class_section_id=='' )
{
die();
}
?>
<?
$studview=fetchrow(execute("SELECT student,unit_id FROM `lms_feedback` WHERE status='1'"));
?>
<?
	
	?>
<table border="1" align='center' width='70%' >
<tr><td class='head' align='center'>Sl
</td><td class='head' align='center'>Title</td>
</tr>
<?php
$s=1;
 $subtitle=execute("select id, title_a,title_b,title_c,lp_no,titleimage from lms_title where sub='$subject' and  status=1  order by posi");
while($subtitle1=fetcharray($subtitle))
{
	if($subtitle1[5]!='')
	{
	?>
		<tr><td align='center'><?=$s?></td><td align='left'>&nbsp;&nbsp;<a href="javascript:void(0);" onClick ="OpenWind2('studmenu.php?title_id=<?=$subtitle1[0]?>&subject=<?=$subject?>&course=<?=$course?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>', 'OpenWind2',1000,600)"><?=$subtitle1[1]?>
</a></td></tr>
	<?
	}
	
	if($subtitle1[5]=='')
   {
	?>
		<tr><td align='center'><?=$s?></td><td align='left'>&nbsp;&nbsp;<a href="javascript:void(0);" onClick ="OpenWind2('studlesson.php?title_id=<?=$subtitle1[0]?>&subject=<?=$subject?>&course=<?=$course?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>', 'OpenWind2',1000,600)"><?=$subtitle1[1]?>
</a></td></tr> 
    
    	
<?
   }
		$s++;
	} 


 ?>
</table>
</form></body></html>

