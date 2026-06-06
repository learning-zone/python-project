<html>

<head>

<Script language="JavaScript">

function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=1200,height=600,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}

	function RefreshMe(val)

	{

		document.MyFrm.action="introduction.php";

		document.MyFrm.submit();

	}



	

</script>

<?php

	session_start();

	include("../db.php");
	$accyeardet=$_SESSION['AcademicYear'];



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

	$type=$_POST['type'];

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
<tr><td width="40%">&nbsp;<?php echo $_SESSION['branchname']; ?></td><td colspan="2">&nbsp;<select name="course" onChange="RefreshMe(0)">
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
      <td>&nbsp;<?php echo $_SESSION['semname']; ?></td>
      <td colspan="2">&nbsp;<select name="sem" onChange="RefreshMe(0)">
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
	<td>&nbsp;&nbsp;Subject Name</td><td colspan="2">&nbsp;<select name="subject" onChange="RefreshMe(0)">
	<option value="">Select Subject </option>
<?php
	while (list(, $value) = each($subject_id2)) 
	{
		$j=$value;
		$sql1="select subject_name from subject_m where subject_id='".$j."' and course_id='".$course."' and course_year_id='".$sem."'";
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
<tr>
  <tr>
  <td height="28">&nbsp;Section</td><td colspan="2">&nbsp;<select name='class_section_id'  onChange="RefreshMe(0)">
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
<?php

$class_section_id=$_POST['class_section_id'];



	

if( $class_section_id=='' )

{

die();

}

?>

<tr>

<td>&nbsp;&nbsp;LP Topic</td><td>&nbsp;<select name="titlename" onChange="RefreshMe(0)">

	<option value="">Select  </option>

<?php

	echo $sql3=execute("SELECT id, title_a FROM `lms_title` where `sub`='$subject' order by posi ");

	for($j=0;$j<rowcount($sql3);$j++)

	{

		$r3=fetcharray($sql3,$j);

		if($r3[0]==$titlename)

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

<td><a href="javascript:void(0);" onClick ="OpenWind2('introduction1.php?subject=<?php echo $subject; ?>', 'OpenWind2',1000,600)"><input type="button" align="center" class="bgbutton" value="Add Topic">
</a> 		

</td> 

</tr>

<?php

$titlename=$_POST['titlename'];



	

if($titlename=='0' ||  $titlename=='' )

{

die();

}

?>



</table>

<br>

<table border="1" align='center' width='70%' >

<tr><td class='head' align='center'>Sl No</td><td class='head' align='center'>Units</td><td class='head' align='center'>Add Content</td></tr>

 <?php

$s=1;

 $unit=execute("select id, unit_name,type from lms_units where status=1  order by posi");

while($unit1=fetcharray($unit))

{



	 if($unit1[2]=='0')

	{ 

	?>  	

    	<tr><td align='center'><?=$s?></td><td align='left'>&nbsp;&nbsp;<?=$unit1[1]?></td>

		<td align='center'><a href= "javascript:OpenWind2('ckeditor/_samples/output_html.php?unit=<?=$unit1[0]?>&title_id=<?=$titlename?>&subject=<?=$subject?>&type=<?=$unit1[2]?>&action=add')"><input type='button' align='center' class='bgbutton' value='Add Content'>

</a></td></tr>

<?

	}

	if($unit1[2]=='2')

		{



?>

<tr><td align='center'><?=$s?></td><td align='left'>&nbsp;&nbsp;<?=$unit1[1]?></td>

		<td align='center'><a href= "javascript:OpenWind2('OnlineAss/assessment.php?unit=<?=$unit1[0]?>&title_id=<?=$titlename?>&subject=<?=$subject?>&class_section_id=<?=$class_section_id?>&type=<?=$unit1[2]?>&sem=<?=$sem?>')"><input type='button' align='center' class='bgbutton' value='Add Content'>

</a></td></tr>

	<?

		}



if($unit1[2]=='1')

		{



?>

<tr><td align='center'><?=$s?></td><td align='left'>&nbsp;&nbsp;<?=$unit1[1]?></td>

		<td align='center'><a href= "javascript:OpenWind2('assessment.php?unit=<?=$unit1[0]?>&title_id=<?=$titlename?>&subject=<?=$subject?>&course=<?=$course?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>&type=<?=$unit1[2]?>')"><input type='button' align='center' class='bgbutton' value='Add Content'>

</a></td></tr>

	<?

		}



if($unit1[2]=='3')

		{



?>

<tr><td align='center'><?=$s?></td><td align='left'>&nbsp;&nbsp;<?=$unit1[1]?></td>

		<td align='center'><a href= "javascript:OpenWind2('ckeditor/_samples/output_html.php?unit=<?=$unit1[0]?>&title_id=<?=$titlename?>&subject=<?=$subject?>&type=<?=$unit1[2]?>&action=add')"><input type='button' align='center' class='bgbutton' value='Add Content'>

</a></td></tr>



<?

		}

?>

<?

		$s++;

	} 



 ?>

 </table>

</form></body></html>



