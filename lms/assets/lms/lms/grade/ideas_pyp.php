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
		document.MyFrm.action="ideas_pyp.php";
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
	$skills=$_POST['skills'];
	$keycates=$_POST['keycates'];
	$unit=$_POST['unit'];
	$examname_m=$_POST['examname_m'];

if($_REQUEST)
{
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$unit=$_REQUEST['unit'];
	$examname_m=$_REQUEST['examname_m'];
}

if(($_POST['save']))
{
	$sql2=execute("select * from ideas where acc_year='$accyeardet' and class='$sem' and exam_id='$examname_m'  and unit='$unit'");
	if(rowcount($sql2)>=1)
	{
		$ads="update ideas set idea='$skills', theme='$priority',keyconc='$keycates' where acc_year='$accyeardet' and class='$sem' and exam_id='$examname_m' and unit='$unit'";
        execute($ads);	
		
	}
	else
	{
		
		$sql5="INSERT INTO ideas (acc_year,class,exam_id, idea, theme,keyconc,unit) VALUES ('$accyeardet','$sem','$examname_m', '{$skills}', '{$priority}','{$keycates}','$unit')";
		execute($sql5);
		}
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php
		
}
?>

</head>
<body class='bodyline'>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' class='forumline' width='90%' >

<tr>
  <td colspan=2 align='center' class='head'>Add Skill</td></tr>
<tr><td width="40%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td><td><select name="course" onChange="RefreshMe(0)">
<option value='-1'>-- Select --</option>
<?php
		$tempstr="SELECT course_id ,coursename FROM  course_m ";
		$rs_course=execute($tempstr);
		while($r1=fetcharray($rs_course))
		{
		if($course==$r1[0])
		{
		echo "<option value='$r1[0]' selected>$r1[1]</option>";
		}
		else
		{
		echo "<option value='$r1[0]'>$r1[1]</option>";
		}
		}
?>

</select></td></tr>
<tr>
      <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
      <td><select name="sem" onChange="RefreshMe(0)">
<option value="">Select</option>
<?php
	$sql2 = "SELECT * FROM course_year where status=1 and head_id='$course' ";
	$rs2 = execute($sql2);
	$num = rowcount($rs2);
	for($i=0;$i<$num;$i++)
	{
		$r2 = fetcharray($rs2,$i);
		if($sem==$r2[0])
		echo "<option value=\"$r2[0]\" selected>$r2[1]</option>";
		else
		echo "<option value=\"$r2[0]\">$r2[1]</option>";
	}
	?> 
    </select>
</td>
</tr>


<tr>

<td>&nbsp;&nbsp;Exam</td><td><select name="examname_m" onChange="RefreshMe(0)">
	<option value="0">Select  </option>
<?php
	echo $sql3=execute("SELECT id,exam_name FROM `igc_exam_year_m` where `class`='$sem' and status=1 and acc_year='$accyeardet'");
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
<?php
$examname_m=$_POST['examname_m'];

	
if($examname_m=='0' ||  $examname_m=='' )
{
die();
}
?>
 <tr>
	<td nowrap>&nbsp;&nbsp;Unit Name</td><td><select name="unit" onChange="RefreshMe(0)">
	<option value="">Select Unit </option>
<?php
	$rs=execute("select unit,id from msp_unit where status=1  and exam_id='$examname_m' order by posi");
	
    while($r=fetcharray($rs))
    {
        if($unit==$r[id])
        {
            echo "<option value='$r[id]' selected>$r[unit]</option>";
        }
            else
        {
            echo "<option value='$r[id]'>$r[unit]</option>";
        }
    }
?>
</select>
<a href="javascript:void(0);" onClick ="OpenWind2('unit_test.php?sem=<?=$sem?>&subject=<?=$subject?>&examid=<?=$examname_m?>&course=<?=$course?>', 'OpenWind3',700,400)">
   <input type='button' name='unit' value='Add Unit' class='bgbutton' title="Enroll"></a>
</td>
</tr>
</table>
<br>
<?
if($unit=='0' ||  $unit=='' )
{
die();
}
$sql3=execute("select id, idea, theme,keyconc from ideas where acc_year='$accyeardet' and class='$sem' and exam_id='$examname_m' and unit='$unit'");
while($r6=fetcharray($sql3))
	{
		$idaers=$r6[1];
		$themess=$r6[2];
		$keyscc=$r6[3];
	}

?>
<table align='center' class='forumline' width='90%' border="1" >
	<tr>
	 <td width="20%"  nowrap>&nbsp;Transdisciplinary Theme :</td><td width="50%">
        <textarea  name='priority' cols="50" rows="1" ><?=$themess?></textarea>
		</td>
     </tr>
	 <tr>
	 <td  width="20%" nowrap>&nbsp;Central Idea :</td>
        <td width="50%">
        <textarea name='skills' cols="50" rows="1"><?=$idaers?></textarea></td>
				
	</tr>
     <tr>
	 <td  width="20%" nowrap>&nbsp;Key Concepts :</td>
        <td width="50%">
        <textarea name='keycates' cols="50" rows="1" ><?=$keyscc?></textarea></td>
				
	</tr>
     <tr>
	 <td  width="20%" nowrap>&nbsp;Lines of Inquiry:</td>
        <td width="50%">&nbsp;&nbsp;
        <a href="javascript:OpenWind2('sub_skill1.php?examid=<?php echo $examname_m; ?>&course=<?=$course?>&class_section_id=<?=$class_section_id?>&masterexamid=<?=$examname_m?>&subject=<?=$subject?>&sem=<?=$sem?>&unit=<?=$unit?>')" >
         <input type="button" name="update" value="ADD"  class='bgbutton'></a></td>
				
	</tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'>
  </div>
	</form></body></html>

