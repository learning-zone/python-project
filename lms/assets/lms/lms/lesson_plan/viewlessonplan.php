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

		document.MyFrm.action="viewlessonplan.php";

		document.MyFrm.submit();

	}



	

</script>

<?php

	session_start();

	include("../db.php");


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
	

	$accyeardet=$_SESSION['AcademicYear'];



if($_REQUEST)

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

<tr><td width="40%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td><td>&nbsp;<select name="course" onChange="RefreshMe(0)">
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
      <td>&nbsp;<select name="sem" onChange="RefreshMe(0)">
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
  <td height="28">&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="RefreshMe(0)">
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
  <tr>
	<td>&nbsp;&nbsp;Subject Name</td><td>&nbsp;<select name="subject" onChange="RefreshMe(0)">
	<option value="">Select Subject </option>
<?php
	while (list(, $value) = each($subject_id2)) 
	{
		$j=$value;
		$sql1="select subject_name from subject_m where subject_id='".$j."' and course_id='".$course."' and course_year_id='".$sem."' order by subject_name";
		$sqlname=fetchrow(execute($sql1));
		if($sqlname[0])
		{
			if($j==$subject)
			{
				echo "<option value='$j' selected>$sqlname[0]</option>";
			}
			else
			{
				echo "<option value='$j'>$sqlname[0]</option>";
			}
		}
	}
?>
</select>
</td>
</tr>
<?php
$subject=$_POST['subject'];
if($subject=='0' ||  $subject=='' )
{

die();

}
?>

</table>

<br>

<table border="1" align='center' width='70%' >

<tr><td class='head' align='center'>Sl</td><td class='head' align='left'>&nbsp;&nbsp;Title</td>
</tr>
 <?php
$s=1;
 $subtitle=execute("select id, title_a,title_b,title_c,lp_no,titleimage from lms_title where sub='$subject' and  status=1  order by posi");
while($subtitle1=fetcharray($subtitle))

{
	if($subtitle1[5]!='')

	{

	?>
		<tr><td align='center'><?=$s?></td><td align='left'>&nbsp;&nbsp;<a href="javascript:void(0);" onClick ="OpenWind2('menu.php?title_id=<?=$subtitle1[0]?>&subject=<?=$subject?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>', 'OpenWind2',1000,600)"><?=$subtitle1[1]?>
</a></td></tr>
	<?
	}
	if($subtitle1[5]=='')

   {

	?>

		<tr><td align='center'><?=$s?></td><td align='left'>&nbsp;&nbsp;<a href="javascript:void(0);" onClick ="OpenWind2('teacherlesson.php?title_id=<?=$subtitle1[0]?>&subject=<?=$subject?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>', 'OpenWind2',1000,600)"><?=$subtitle1[1]?>
</a></td></tr> 
<?
   }
		$s++;

	} 
 ?>
 </table>
</form></body></html>
