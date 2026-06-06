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
		document.MyFrm.action="dp_subject_grade.php";
		document.MyFrm.submit();
	}
function checkval(st)
{
	alert("Marks have been entered for this term, hence cannot be modified. Please get in touch with your school system administrator for further assistance  ");
	document.getElementById(st).checked = false;
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
$From=$_POST['From'];
$subject=$_POST['subject'];
$class_section_id=$_POST['class_section_id'];
$level=$_POST['level'];
$examname_m=$_POST['examname_m'];
$To=$_POST['To'];
$Persatage=$_POST['Persatage'];
$grade=$_POST['grade'];
$remark=$_POST['remark'];
		if ($_POST['saveyear'])
{	
	if(!is_numeric($From) && !is_numeric($To))
	{
		
	?>
		<script language='javascript'> 
		alert ('Please enter proper data'); 
		</script>
	<?php
	}
	else
	{
	
		//$yearstt=execute("SELECT count(id)FROM `dp_grade_point` where`acc_year`='$a_year' and `sem`='$sem' and exam_id='$examname_m' and subject_id='$subject' and (from_point='$From' or to_point='$To')");
		//$yearstt1=fetchrow($yearstt);
		if($yearstt1[0]>0)
		{
			
			?>
			<Script language="JavaScript">
			alert("Duplicate Entry not allowed");
			</Script>
			<?php		
		}
		else
		{
			if($sem!=0 and $From!='' and $To!='' and $grade!='' and $examname_m!='' and $level!='')
			{
				
				execute("INSERT INTO `dp_grade_point` ( `from_point`, `to_point`, `tot_point`, `sem`, `status`, `desc`,`exam_id`,`level_id`) VALUES ( '$From', '$To', '$grade','$sem','1','".addslashes($remark)."','$examname_m','$level')");
				?>
              
				<Script language="JavaScript">
				alert("Updated successfully");
				</Script>
				<?php
			}
			else
			{
				?>	
				<Script language="JavaScript">
				alert("Make sure all the entry properly entered");
				</Script>
				<?php
				
			}
		}
	
}
		
}
      
//modify
if ($_POST['modify'])
{
	
	$cid=$_POST['seltype'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$From1=$_POST['From'.$cid[$i]];
		$To1=$_POST['To'.$cid[$i]];
		$Persatage1=$_POST['Persatage'.$cid[$i]];
		$remark1=$_POST['remark'.$cid[$i]];		
		$grade1=$_POST['grade'.$cid[$i]];
		execute("update dp_grade_point set `from_point`='$From1', `to_point`='$To1', `desc`='".addslashes($remark1)."',`tot_point`='$grade1' where id='$cid[$i]'");	
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
<table align='center' class='forumline' width='70%' >
<tr><td class="head" align="center" colspan="2">Grade Boundaries (DP)</td></tr>
<tr><td width="40%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td><td><select name="course" onChange="RefreshMe(0)">
<option value=''>-- Select --</option>
<?php
	while (list(, $value) = each($branch2)) 
	{
		$j=$value;
		$sql1="select coursename from course_m where course_id='".$j."' order by course_id";
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
		$sql1="select year_name from course_year where year_id='".$j."' and head_id='".$course."' order by year_id";
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
	$sql3=execute("SELECT id,exam_name FROM `dp_exam_year_m` where `class`='$sem' and status=1");
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
<tr>
<td>&nbsp;&nbsp;Level</td><td><select name="level" onChange="RefreshMe(0)">
	<option value="0">Select  </option>
<?php
	$dplevel=execute("SELECT id, level FROM `dp_levels` where sts=1 ");
	for($j=0;$j<rowcount($dplevel);$j++)
	{
		$dplevel1=fetcharray($dplevel,$j);
		if($dplevel1[0]==$level)
		{
			echo "<option value=$dplevel1[0] selected>$dplevel1[1]</option>";
		}
		else
		{
			echo "<option value=$dplevel1[0]>$dplevel1[1]</option>";
		}
	}
?>
</select>
</td>
</tr>
<?php
$level=$_POST['level'];

	
if($level=='0' ||  $level=='' )
{
die();
}
?>

</table>
<br>

<table align='center' class='forumline' width='70%' border="1" >
	<tr><td align="center" colspan="4" class="head">Declare Grading System </td>
    </tr>
    <tr>
        <td align='center' class='rowpic' nowrap>From</td>
        <td align='center' class='rowpic' nowrap>To</td>
		<!--<td align='center' class='rowpic' nowrap> % </td>-->
        <td align='center' class='rowpic' nowrap>Grade</td>
        <td align='center' class='rowpic' nowrap>Remark</td>
	</tr>

	<tr>
	
        <td align='center' nowrap>
        	<input type='text' size="4" maxlength="3" name='From' value=''>
		</td>
        <td align='center' nowrap>
        	<input type='text' size="4" name='To' maxlength="3" value=''>
		</td>
    <!--    <td align='center' nowrap>
        	<input type='text' name='Persatage' size="2" maxlength="3" value=''>
		</td>-->
		
        <td align='center' nowrap>
        	<input type='text' size="4" name='grade' maxlength="3" value=''>
		</td>
         <td align='center'>
    <textarea name="remark" cols="30" rows="1"></textarea> 
		</td>

</tr>
 </table>
<br>  <div align='center' >
  <input type="submit" name="saveyear" value="Save Setup"  class='bgbutton'>
</div>  


<br>
<?php

		$yearstt=execute("SELECT id FROM `dp_grade_point` where `sem`='$sem' and exam_id='$examname_m' and level_id='$level'");
		$yearstt2=fetchrow($yearstt);
		$yearstt2[0];
		if($yearstt2[0]==0)
		die();
?><table align='center' class='forumline' width='70%' border="1" >
<tr>
    <td align="center" colspan="5" class="head">Modify Grading System </td>
    </tr>
	<tr>
		<td align='center' class='rowpic' nowrap>Sl No.</td>
        <td align='center' class='rowpic' nowrap>From</td>
        <td align='center' class='rowpic' nowrap>To</td>
		<!--<td align='center' class='rowpic' nowrap> % </td>-->
        <td align='center' class='rowpic' nowrap>Grade</td>
        <td align='center' class='rowpic' nowrap>Remark</td>
	</tr>
<?php

$yearstt=execute("SELECT *FROM `dp_grade_point` where `sem`='$sem' and exam_id='$examname_m' and level_id='$level'");
while($yearstt1=fetcharray($yearstt))
{
?>
	<tr>
	
      	<td align='center' nowrap>
          <?php
		 if($yearstt1['status']==0)
		 {
		 	echo "<input type='checkbox' name='$yearstt1[0]' onClick='checkval(this.value)' id='$yearstt1[0]' value='$yearstt1[0]'>";
         }
		 else
		 {
				echo "<input type='checkbox' name='seltype[]' value='$yearstt1[0]'>";
		 }
		 ?>
         
        </td>
        <td align='center' nowrap>
        	<input type='text' size="4" maxlength="3" name='From<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['from_point']; ?>' >
		</td>
        <td align='center' nowrap>
        	<input type='text' size="4" maxlength="3" name='To<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['to_point']; ?>' >
		</td>
      
        <td align='center' nowrap>
        	<input type='text' size="4" name='grade<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['tot_point']; ?>'>
		</td><td align="center">
       <textarea name="remark<?php echo $yearstt1[0]; ?>" cols="30" rows="1"><?php echo $yearstt1['desc']; ?></textarea>
		</td>

	
</tr>

<?php
}
?>
</table>
<br>
  <div align='center' >
  <input type="submit" name="modify" value="Modify"  class='bgbutton'>
</div>
	</form>
 </body>
</html>
