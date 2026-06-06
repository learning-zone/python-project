<html>

<head>

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

$examname_m=$_POST['examname_m'];

$subject=$_POST['subject'];

$class_section_id=$_POST['class_section_id'];

$ExamName=$_POST['ExamName'];

$ShortName=$_POST['ShortName'];
$examtype=$_POST['examtype'];
$Persatage=$_POST['Persatage'];

$maxmark=$_POST['maxmark'];

$ordercount=$_POST['ordercount'];

if ($_POST['saveyear'])

{	

		$yearstt=execute("SELECT count(id)

FROM `dp_exam_sub_m` where `class`='$sem' and exam_id='$examname_m' and subject_id='$subject' and section='$class_section_id' and (exam_name='$ExamName' or exam_sub_name='$ShortName')");

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

			if($sem!=0 and $ExamName!='' and $ShortName!='' and $maxmark!='' and $examtype!='' and $examname_m!='' and $subject!='' and $ordercount!='')

			{

				execute("INSERT INTO `dp_exam_sub_m` ( `exam_name`, `exam_sub_name`, `per_info`, `mark`, `class`, `status`, `order_id`,`exam_id`,`subject_id`,`section`,`examtype`) VALUES ( '$ExamName', '$ShortName', '$Persatage', '$maxmark','$sem','1','$ordercount','$examname_m','$subject','$class_section_id','$examtype')");

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

if ($_POST['modify'])

{

	

	$cid=$_POST['seltype'];

	for($i=0;$i<sizeof($cid);$i++)

	{

		$ExamName1=$_POST['ExamName'.$cid[$i]];

		$ShortName1=$_POST['ShortName'.$cid[$i]];

		$Persatage1=$_POST['Persatage'.$cid[$i]];

		$ordercount1=$_POST['ordercount'.$cid[$i]];		

		$maxmark1=$_POST['maxmark'.$cid[$i]];
		
		$examtype1=$_POST['examtype'.$cid[$i]];
		
		execute("update dp_exam_sub_m set `exam_name`='$ExamName1', `exam_sub_name`='$ShortName1', `per_info`='$Persatage1', `order_id`='$ordercount1',`mark`='$maxmark1',`examtype`='$examtype1' where id='$cid[$i]'");	

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

  <td colspan=2 align='center' class='head'><p><strong>DP Subject Setup </strong></p></td></tr>
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

	<option value="0">Select</option>

<?php

	$sql3=execute("SELECT id,exam_name FROM `dp_exam_year_m` where `class`='$sem' and status=1 ");

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

</table>

<?php
$subject=$_POST['subject'];

	
if($subject=='0' ||  $subject=='' )
{
die();
}
?>

<table align='center' class='forumline' width='70%' border="1" >

	<tr>

        <td align='center' class='head' nowrap>Exam Name</td>

        <td align='center' class='head' nowrap>Short Name</td>

		<td align='center' class='head' nowrap>Exam Type</td>

        <td align='center' class='head' nowrap> Mark </td>

        <td align='center' class='head' nowrap>Group</td>

	</tr>



	<tr>

	

        <td align='center' nowrap>

        	<input type='text' size="40" name='ExamName' value=''>

		</td>

        <td align='center' nowrap>

        	<input type='text' name='ShortName' value=''>

		</td>
  
    <td title="Exam Type">
        &nbsp;&nbsp;<select name='examtype'>
      <option value=''>Select</option>
<?
$grd_name=execute("SELECT * FROM `dp_type`");
for($i=0;$i<rowcount($grd_name);$i++)
{
	$grd_id=fetcharray($grd_name,$i);
	if($nameexam==$grd_id[id])
	echo "<option value='$grd_id[id]' selected>$grd_id[name]</option>";
	else
	echo "<option value='$grd_id[id]'>$grd_id[name]</option>";
}
?></select></td>

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

FROM `dp_exam_sub_m` where `class`='$sem' and exam_id='$examname_m' and section='$class_section_id'");

		$yearstt2=fetchrow($yearstt);

		$yearstt2[0];

		if($yearstt2[0]==0)

		die();

?><table align='center' class='forumline' width='70%' border="1" >

	<tr>

		<td align='center' class='head' nowrap>Sl No.</td>

        <td align='center' class='head' nowrap>Exam Name</td>

        <td align='center' class='head' nowrap>Short Name</td>

		<td align='center' class='head' nowrap> Exam Type </td>

        <td align='center' class='head' nowrap>Mark </td>

        <td align='center' class='head' nowrap>Group</td>

        <td align='center' class='head' nowrap>Sub exam</td>

	</tr>

<?php 

$yearstt=execute("SELECT * FROM `dp_exam_sub_m` where `class`='$sem' and exam_id='$examname_m' and section='$class_section_id'");

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
        <td title="Exam Type">
        &nbsp;&nbsp;<select name='examtype<?php echo $yearstt1[0]; ?>'>
      <option value=''>Select</option>
		<?
        $grd_name=execute("SELECT * FROM `dp_type`");
        for($i=0;$i<rowcount($grd_name);$i++)
        {
            
            $examtype=$yearstt1['examtype'];
            $grd_id=fetcharray($grd_name,$i);
            if($examtype==$grd_id[id])
            echo "<option value='$grd_id[id]' selected>$grd_id[name]</option>";
            else
            echo "<option value='$grd_id[id]'>$grd_id[name]</option>";
        }
        ?>
        </select></td>

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

    <a href="javascript:OpenWind2('sub_sub_setup.php?examid=<?php echo $yearstt1[0]; ?>&masterexamid=<?=$examname_m?>&subject=<?=$subject?>&sem=<?=$sem?>')" >ADD</a>

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

