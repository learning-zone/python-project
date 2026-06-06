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
		document.MyFrm.action="SubjectSetup.php";
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
$examname_m=$_POST['examname_m'];
$subject=$_POST['subject'];
$class_section_id=$_POST['class_section_id'];
$ExamName=$_POST['ExamName'];
$ShortName=$_POST['ShortName'];
$Persatage=$_POST['Persatage'];
$maxmark=$_POST['maxmark'];
$ordercount=$_POST['ordercount'];
if(isset($_POST['saveyear']))
{	
		$yearstt=execute("SELECT count(id)
FROM `exam_sub_m` where`acc_year`='$a_year' and `class`='$sem' and exam_id='$examname_m' and subject_id='$subject' and section='$class_section_id' and (exam_name='$ExamName' or exam_sub_name='$ShortName')");
		$yearstt1=fetchrow($yearstt);
		if($yearstt1[0]>0)
		{
			?>
			<Script language="JavaScript">
			alert("Duplicate entry not allowed");
			</Script>
			<?php		
		}
		else
		{
			if($sem!=0 and $ExamName!='' and $ShortName!='' and $maxmark!='' and $ordercount!='' and $examname_m!='' and $subject!='' and $class_section_id!='')
			{
				execute("INSERT INTO `exam_sub_m` ( `exam_name`, `exam_sub_name`, `per_info`, `mark`, `acc_year`, `class`, `status`, `order_id`,`exam_id`,`subject_id`,`section`) VALUES ( '$ExamName', '$ShortName', '$Persatage', '$maxmark','$a_year','$sem','1','$ordercount','$examname_m','$subject','$class_section_id')");
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
//modify
if(isset($_POST['modify']))
{
	
	$cid=$_POST['seltype'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$ExamName1=$_POST['ExamName'.$cid[$i]];
		$ShortName1=$_POST['ShortName'.$cid[$i]];
		$Persatage1=$_POST['Persatage'.$cid[$i]];
		$ordercount1=$_POST['ordercount'.$cid[$i]];		
		$maxmark1=$_POST['maxmark'.$cid[$i]];
		execute("update exam_sub_m set `exam_name`='$ExamName1', `exam_sub_name`='$ShortName1', `per_info`='$Persatage1', `order_id`='$ordercount1',`mark`='$maxmark1' where id='$cid[$i]'");	
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
  <td colspan=2 align='center' class='head'><p><strong>Subject Setup </strong></p></td></tr>
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
  <td >&nbsp;&nbsp;Section</td><td><select name='class_section_id'  onChange="RefreshMe(0)">
<?
$rs_section=execute("SELECT a.id, a.section_name FROM class_section a,student_m b where a.id=b.class_section_id group by b.class_section_id");
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
	<td>&nbsp;&nbsp;Exam</td><td><select name="examname_m" onChange="RefreshMe(0)">
	<option value="0">Select  </option>
<?php
	$sql3=execute("SELECT id,exam_name FROM `exam_year_m` where`acc_year`='$a_year' and `class`='$sem' and status=1 ") or die(mysql_error());
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
	<td>&nbsp;&nbsp;Subject Name</td><td><select name="subject" onChange="RefreshMe(0)">
	<option value="-1"> Select </option>
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


</table>
<br>

<table align='center' class='forumline' width='70%' border="1" >
	<tr>
        <td align='center' class='head' nowrap>Exam Name</td>
        <td align='center' class='head' nowrap>Short Name</td>
		<!--<td align='center' class='head' nowrap> % </td>-->
        <td align='center' class='head' nowrap> Mark </td>
        <td align='center' class='head' nowrap>Order</td>
	</tr>

	<tr>
	
        <td align='center' nowrap>
        	<input type='text' size="40" name='ExamName' value=''>
		</td>
        <td align='center' nowrap>
        	<input type='text' name='ShortName' value=''>
		</td>
    <!--    <td align='center' nowrap>
        	<input type='text' name='Persatage' size="2" maxlength="3" value=''>
		</td>-->
		
        <td align='center' nowrap>
        	<input type='text' size="3" name='maxmark' maxlength="3" value=''>
		</td>
         <td align='center' nowrap>
                <select name="ordercount" >
                    <option value="">Select</option>
                    <?php
                        for($j=1;$j<10;$j++)
                        {
                            if($ordercount==$j)
                                echo "<option value=$j selected>   $j   </option>";
                            else
                                echo "<option value=$j>   $j   </option>";
                        }
                    ?>
             </select>
		</td>

</tr>

</table>
<br>  <div align='center' >
  <input type="submit" name="saveyear" value="Save Setup"  class='bgbutton'>
</div>  


<br>
<?php

		$yearstt=execute("SELECT id
FROM `exam_sub_m` where`acc_year`='$a_year' and `class`='$sem' and exam_id='$examname_m' and subject_id='$subject' and section='$class_section_id'");
		$yearstt2=fetchrow($yearstt);
		$yearstt2[0];
		if($yearstt2[0]==0)
		die();
?><table align='center' class='forumline' width='70%' border="1" >
	<tr>
		<td align='center' class='head' nowrap>Sl No.</td>
        <td align='center' class='head' nowrap>Exam Name</td>
        <td align='center' class='head' nowrap>Short Name</td>
		<!--<td align='center' class='head' nowrap> % </td>-->
        <td align='center' class='head' nowrap>Mark </td>
        <td align='center' class='head' nowrap>Order</td>
        <td align='center' class='head' nowrap>Sub exam</td>
	</tr>
<?php 
$yearstt=execute("SELECT *
FROM `exam_sub_m` where`acc_year`='$a_year' and `class`='$sem' and exam_id='$examname_m' and subject_id='$subject' and section='$class_section_id'");
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
        	<input type='text' size="40" name='ExamName<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['exam_name']; ?>'>
		</td>
        <td align='center' nowrap>
        	<input type='text' name='ShortName<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['exam_sub_name']; ?>'>
		</td>
       <!-- <td align='center' nowrap>
        	<input type='text' name='Persatage<?php echo $yearstt1[0]; ?>' size="2" value='<?php echo $yearstt1['per_info']; ?>'>
		</td>-->
        <td align='center' nowrap>
        	<input type='text' size="3" name='maxmark<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['mark']; ?>'>
		</td>
         <td align='center' nowrap>
                <select name="ordercount<?php echo $yearstt1[0]; ?>">
                    <option value="">Select</option>
                    <?php
                        for($j=1;$j<10;$j++)
                        {
							$tempname=$yearstt1['order_id'];
                            if($tempname==$j)
                                echo "<option value=$j selected>   $j   </option>";
                            else
                                echo "<option value=$j>   $j   </option>";
                        }
                    ?>
             </select>
		</td>

	<td align="center">
    <a href="javascript:OpenWind2('sub_sub_setup.php?examid=<?php echo $yearstt1[0]; ?>')" >ADD</a>
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
