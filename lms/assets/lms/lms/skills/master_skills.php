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
		document.MyFrm.action="master_skills.php";
		document.MyFrm.submit();
	}

	
</script>
<?php
	session_start();
	include("../db.php");
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
	$mark=$_POST['mark'];
	$examname_m=$_POST['examname_m'];
	
if(isset($_POST['update']))
{

	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$priority=$_POST['priority'.$cid[$i]];
		$skills=$_POST['skills'.$cid[$i]];
		$mark=$_POST['mark'.$cid[$i]];
        execute("update master_skills set skill='".addslashes($skills)."', mark='$mark', posi='$priority' where id='$cid[$i]'");	
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
	$sql2=execute("select * from master_skills where divi='$course' and class='$sem' and sub='$subject' and skill='$skills' and posi='$priority' and exam_id='$examname_m'");
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
		
		$sql5="INSERT INTO master_skills (id, divi, class, sub, skill, posi,mark,exam_id) VALUES (NULL, '$course', '$sem', '$subject', '".addslashes($skills)."', '$priority','$mark','$examname_m')";
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
      <td><select name="sem" onChange="RefreshMe(0)">
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
<tr>
<?php

$sql4=execute("select sub_id from exam_m where id='$examname_m'");
$subid=fetchrow($sql4);
$sub_id1=explode(',',$subid[0]);


?>
	<td>&nbsp;&nbsp;Subject Name</td><td><select name="subject" onChange="RefreshMe(0)">
	<option value="0">Select Subject </option>
<?php
	for($j=0;$j<sizeof($sub_id1);$j++)
	{
		$sql4=execute("select subject_name from subject_m where subject_id='$sub_id1[$j]'");
		$subdis=fetchrow($sql4);
		if($sub_id1[$j]==$subject)
		{
			echo "<option value='$sub_id1[$j]' selected>$subdis[0]</option>";
		}
		else
		{
			echo "<option value='$sub_id1[$j]'>$subdis[0]</option>";
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
        <td align='center' class='head' nowrap>MAX MARK</td>
		<td align='center' class='head' nowrap>ORDER</td>
	</tr>
	<tr>
	
      <td align='center' nowrap>
        <input size="70" type='text' name='skills' value=''>
		</td>
        <td align='center' nowrap>
        <input type='text' name='mark' value='' maxlength="3" size="3" width="3">
		</td>
        <td align='center' nowrap>
        <input type='text' name='priority' value='' maxlength="2" size="2" width="2">
		</td>		
	</tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'>
  <br>
  <?php

$sql3=execute("select id, skill, posi,mark from master_skills where divi='$course' and class='$sem' and sub='$subject' and exam_id='$examname_m'");
if(rowcount($sql3)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='70%' border="1" >
<tr>
		<td align='center' class='head' nowrap>Sel</td>
		<td align='center' class='head' nowrap>SKILL</td>
       	<td align='center' class='head' nowrap>MAX MARK</td>
		<td align='center' class='head' nowrap>ORDER</td>
		
		
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
        <input type='text' name='mark$r6[0]' value='$r6[mark]' maxlength='2' size='2' width='2'>
		</td>
        <td align='center' nowrap>
        <input type='text' name='priority$r6[0]' value='$r6[2]' maxlength='2' size='2' width='2'>
		</td>
		";
		?>
		
		<?php
		
		
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
