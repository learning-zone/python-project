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
		document.MyFrm.action="unit_kg.php";
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
		//$ads="update ideas set idea='".addslashes($skills)."', theme='".addslashes($priority)."' where id='$cid[$i]'";
       	$ads="update ideas set idea='$skills', theme='$priority' where id='$cid[$i]'";
        execute($ads);	
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
	$sql2=execute("select * from ideas where acc_year='$accyeardet' and class='$sem'  and idea='$skills' and exam_id='$examname_m' and posi='$priority'");
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
		
		$sql5="INSERT INTO ideas (acc_year,class,exam_id, idea, theme) VALUES ('$accyeardet','$sem','$examname_m', '".addslashes($skills)."', '".addslashes($priority)."')";
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
<table align='center' class='forumline' width='90%' >

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
$examname_m=$_POST['examname_m'];

	
if($examname_m=='0' ||  $examname_m=='' )
{
die();
}
?>
<br>
<table align='center' class='forumline' width='90%' border="1" >
	<tr>
	 <td width="20%"  nowrap>&nbsp;Central Ideas :</td><td width="50%">
        <textarea  name='skills' cols="50" rows="1" value=''></textarea>
		</td>
     </tr>
	 <tr>
	 <td  width="20%" nowrap>&nbsp;Organizing Theme :</td>
        <td width="50%">
        <textarea name='priority' cols="50" rows="1" value=''></textarea></td>
				
	</tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'>
  <br>
    <?php

$sql3=execute("select id, idea, theme from ideas where acc_year='$accyeardet' and class='$sem' and exam_id='$examname_m'");
if(rowcount($sql3)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='90%' border="1" >
<tr>
		<td align='center' class='head' nowrap width="5%">Sel
		</td>
		<td align='center' class='head' nowrap width="30%">&nbsp;Central Ideas :</td>
       
		<td align='center' class='head' nowrap width="30%">&nbsp;Organizing Theme :</td>
		<td align='center' class='head' nowrap width="5%">ADD SUB SKILLS</td>
		

	<?php
	while($r6=fetcharray($sql3))
	{
	echo "<tr><td align='center'  nowrap><input type='checkbox' name='cid[]' value='$r6[0]'>
		</td>
		 <td align='center' nowrap>
        <textarea size='60'  name='skills$r6[0]' cols='50' rows='1' >$r6[1]</textarea>
		</td>
        
        <td align='center' nowrap>
        <textarea name='priority$r6[0]' cols='50' rows='1'>$r6[2]</textarea>
		</td>
		<td align='center' nowrap>";
		?>
<a href= "javascript:OpenWind2('unit_kg1.php?master=<?php echo $r6[0]; ?>')">
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

