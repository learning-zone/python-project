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
		document.MyFrm.action="subject_grade.php";
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
$examname_m=$_POST['examname_m'];
$To=$_POST['To'];
$Persatage=$_POST['Persatage'];
$grade=$_POST['grade'];
$remark=$_POST['remark'];
		if(isset($_POST['saveyear']))
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
	
		//$yearstt=execute("SELECT count(id)FROM `exam_grade_point` where`acc_year`='$a_year' and `sem`='$sem' and exam_id='$examname_m' and subject_id='$subject' and (from_point='$From' or to_point='$To')");
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
			if($sem!=0 and $From!='' and $To!='' and $grade!='' and $examname_m!='' and $subject!='')
			{
				
				execute("INSERT INTO `exam_grade_point` ( `from_point`, `to_point`, `tot_point`, `acc_year`, `sem`, `status`, `desc`,`exam_id`,`subject_id`) VALUES ( '$From', '$To', '$grade','$a_year','$sem','1','".addslashes($remark)."','$examname_m','$subject')");
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
if(isset($_POST['modify']))
{
	
	$cid=$_POST['seltype'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$From1=$_POST['From'.$cid[$i]];
		$To1=$_POST['To'.$cid[$i]];
		$Persatage1=$_POST['Persatage'.$cid[$i]];
		$remark1=$_POST['remark'.$cid[$i]];		
		$grade1=$_POST['grade'.$cid[$i]];
		execute("update exam_grade_point set `from_point`='$From1', `to_point`='$To1', `desc`='".addslashes($remark1)."',`tot_point`='$grade1' where id='$cid[$i]'");	
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
<tr>
  <td colspan=2 align='center' class='head'><p><strong>Add Grade</strong></p></td></tr>
<tr height="25">
<td nowrap>&nbsp;&nbsp;Academic Year</td>
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
	$sql=execute("select * from course_year  where head_id='$course'  ");
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
<td>&nbsp;&nbsp;Exam</td><td><select name="examname_m" onChange="RefreshMe(0)">
	<option value="0">Select  </option>
<?php
	$sql3=execute("SELECT id, descr FROM `exam_m` where `accyear`='$a_year' and `class`='$sem' and sts=1 ");
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

$sql4=execute("select sub_id from exam_m where id='$examname_m'");
$subid=fetchrow($sql4);
$sub_id1=explode(',',$subid[0]);


?>
<tr>
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

		$yearstt=execute("SELECT id FROM `exam_grade_point` where`acc_year`='$a_year' and `sem`='$sem' and exam_id='$examname_m' and subject_id='$subject'");
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
$yearstt=execute("SELECT *FROM `exam_grade_point` where`acc_year`='$a_year' and `sem`='$sem' and exam_id='$examname_m' and subject_id='$subject'");
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

	</form>
 </body>
</html>
