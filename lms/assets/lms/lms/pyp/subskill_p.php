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
		document.MyFrm.action="subskill_p.php";
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
	$skills=$_POST['skills'];
	$examname_m=$_POST['examname_m'];
	
	
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
	
	
	
	//print_r($_POST);
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
	$skills=$_POST['skills'];
	
	
	
if(isset($_POST['update']))
{
	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$priority=$_POST['priority'.$cid[$i]];
		$skills=$_POST['skills'.$cid[$i]];
		
        execute("update pypskills set skill='".addslashes($skills)."', posi='$priority' where id='$cid[$i]'");	
	}
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php		
}
if(isset($_POST['save']))
{
if($skills!='')
{
	$sql2=execute("select * from pypskills where acc_year='$accyeardet' and class='$sem' and sub='$subject' and skill='$skills' and exam_id='$examname_m' and posi='$priority'");
	if(rowcount($sql2)>=1)
	{
		?>
		<Script language="JavaScript">
		alert("Duplicate entry not allowed");
		</Script>
		<?php
	}
	else
	{
		
		$sql5="INSERT INTO pypskills (acc_year,class,exam_id,sub, skill, posi) VALUES ('$accyeardet','$sem','$examname_m','$subject', '".addslashes($skills)."', '$priority')";
		execute($sql5);
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php
		}
		}
		else
		{
		?>
		
		<SCRIPT LANGUAGE="JavaScript">
	alert("Enter Skill");
	</script>
	
		<?php
			
	}
}
?>

</head>
<body class='bodyline'>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' class='forumline' width='70%' >

<tr>
  <td colspan=2 align='center' class='head'>MAIN SKILLS</td></tr>
<tr><td width="40%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td><td><select name="course" onChange="RefreshMe(0)">
<option value='-1'>-- Select --</option>
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
      <td><select name="sem" onChange="RefreshMe(0)">
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
	<td>&nbsp;&nbsp;Subject Name</td><td><select name="subject" onChange="RefreshMe(0)">
	<option value="0">Select Subject </option>
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

<td>&nbsp;&nbsp;Exam</td><td><select name="examname_m" onChange="RefreshMe(0)">
	<option value="0">Select  </option>
<?php
	echo $sql3=execute("SELECT id, descr FROM `exam_m` where `class`='$sem' and sts=1 ");
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[0]==$examname_m)
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
</table>
<?php
$subject=$_POST['subject'];

	
if($subject=='0' ||  $subject=='' )
{
die();
}
?>
<br>
<table align='center' class='forumline' width='70%' border="1" >
	<tr>
		
		<td align='center' class='head' nowrap>SKILL</td>
        
		<td align='center' class='head' nowrap>ORDER</td>
        	
	</tr>
	<tr>
	
      <td align='center' nowrap>
        <input size="70" type='text' name='skills' value=''>
		</td>
     
        <td align='center' nowrap>
        <input type='text' name='priority' value='' maxlength="2" size="2" width="2">
				
	</tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'>
  <br>
    <?php

$sql3=execute("select id, skill, posi from pypskills where acc_year='$accyeardet' and class='$sem' and sub='$subject' and exam_id='$examname_m'");
if(rowcount($sql3)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='70%' border="1" >
<tr>
		<td align='center' class='head' nowrap>Sel
		</td>
		<td align='center' class='head' nowrap>SKILL</td>
       
		<td align='center' class='head' nowrap>ORDER</td>
		<td align='center' class='head' nowrap>ADD SUB SKILLS</td>
		
	</tr>
	<?php
	while($r6=fetcharray($sql3))
	{
	echo "<tr><td align='center'  nowrap><input type='checkbox' name='cid[]' value='$r6[0]'>
		</td>
		 <td align='center' nowrap>
        <input size='60' type='text' name='skills$r6[0]' value='$r6[1]'>
		</td>
        
        <td align='center' nowrap>
        <input type='text' name='priority$r6[0]' value='$r6[2]' maxlength='2' size='2' width='2'>
		</td>
		<td align='center' nowrap>";
		?>
<a href= "javascript:OpenWind2('sub_skill1.php?master=<?php echo $r6[0]; ?>&&mastername=<?php echo $r6[1]; ?>')">
	ADD SUB SKILLS
	
</a> 		
		<?php
		
		echo "</td>
		</tr>";
	}
	?>
	<?php
	?>
	</table>
    <br>
  <div align='center' >
  <input type="submit" name="update" value="UPDATE"  class='bgbutton'>
	<?php
}
?>	
 
	</form></body></html>

