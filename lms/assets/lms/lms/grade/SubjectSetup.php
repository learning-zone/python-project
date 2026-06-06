<html>

<head>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
<Script language="JavaScript">

function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}

	function RefreshMe(val)

	{

		document.frm.action="SubjectSetup.php";

		document.frm.submit();

	}
	function RefreshMe1(val)

	{

		document.frm.action="SubjectSetup.php?updateval=true";

		document.frm.submit();

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
	$a_year=$_SESSION['AcademicYear'];


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

$examname_m=$_POST['examname_m'];
$subject=$_POST['subject'];
$class_section_id=$_POST['class_section_id'];
$ExamName=$_POST['ExamName'];
$ShortName=$_POST['ShortName'];
$examtype=$_POST['examtype'];
$Persatage=$_POST['Persatage'];
$maxmark=$_POST['maxmark'];
$ordercount=$_POST['ordercount'];
$adate=$_POST['adate'];
$bdate=$_POST['bdate'];

$sem=$_REQUEST['sem'];
$course=$_REQUEST['course'];
$examname_m=$_REQUEST['examname_m'];
$subject=$_REQUEST['subject'];
$class_section_id=$_REQUEST['class_section_id'];



$ExamName=$_REQUEST['ExamName'];
$ShortName=$_REQUEST['ShortName'];
$examtype=$_REQUEST['examtype'];
$Persatage=$_REQUEST['Persatage'];
$maxmark=$_REQUEST['maxmark'];
$ordercount=$_REQUEST['ordercount'];
$adate=$_REQUEST['adate'];
$bdate=$_REQUEST['bdate'];
$examid=$_REQUEST['examid'];
$masterexamid=$_REQUEST['masterexamid'];

if ($_GET['updateval']=='true')

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
			$tfdate=explode('/',$adate);
			$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
			$ttdate=explode('/',$bdate);
			$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];

			if($sem!=0 and $ExamName!='' and $examname_m!='' )
			{
				$a_year=$_SESSION['AcademicYear'];
				
				
				execute("INSERT INTO `dp_exam_sub_m` ( `exam_name`, `exam_sub_name`, `mark`, `class`, `status`, `order_id`,`exam_id`,`subject_id`,`section`,`examtype`,`acc_year`,`from`,`to`) VALUES ( '$ExamName', '$ShortName', '$maxmark','$sem','1','1','$examname_m','$subject','$class_section_id','$examtype','$a_year','$fdate','$tdate')");
				
				
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

	//	$ordercount1=$_POST['ordercount'.$cid[$i]];		

	//	$maxmark1=$_POST['maxmark'.$cid[$i]];
		
		$examtype1=$_POST['examtype'.$cid[$i]];
		
		$a_year=$_SESSION['AcademicYear'];
		
		execute("update dp_exam_sub_m set `exam_name`='$ExamName1', `exam_sub_name`='$ShortName1', `per_info`='$Persatage1', `order_id`='$ordercount1',`mark`='$maxmark1',`examtype`='$examtype1',`acc_year`='$a_year' where id='$cid[$i]'");	

	}

		?>

		<Script language="JavaScript">

		alert("Updated successfully");

		</Script>

		<?php		



	

}

?>
<?
if($_POST['del'])
{
	$seltype=$_POST['seltype']; 
	while( list(,$Value) = each($seltype) )
	
	{
		$upd=execute("update dp_exam_sub_m set status='0' where id='$Value'");
	}
}
?>
</head>

<body class='bodyline'>

<form method="post" name="frm">

<input type="hidden" name="flag" value="<?=$flag?>">

<input type="hidden" name="userid" value="<?=$userid?>">

<table align='center' class='forumline' width='80%' >

<tr>

  <td colspan=2 align='center' class='head'><p><strong>Declare Exam</strong></p></td></tr>
<tr><td width="40%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td><td><select name="course" onChange="RefreshMe(0)">
<option value=''>-- Select --</option>
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

	<td>&nbsp;&nbsp;Exam</td><td><select name="examname_m" onChange="RefreshMe(0)" >

	<option value="0">Select</option>

<?php

	$sql3=execute("SELECT id,exam_name FROM `igc_exam_year_m` where `class`='$sem' and status=1 and acc_year='$a_year'");

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
	
if($examname_m=='0' ||  $examname_m=='' )
{
die();
}
?>

</table>

<table align='center' class='forumline' width='80%' border="1" >
	<tr>
		<td align='center' class='head' nowrap>Exam Name</td>
		<td align='center' class='head' nowrap>Short Name</td>
		<td align='center' class='head' nowrap>From</td>
		<td align='center' class='head' nowrap>To</td>
	</tr>

	<tr>

	

        <td align='center' nowrap>

        	<input type='text' size="40" name='ExamName' value='' placeholder="Exam Name" >

		</td>

        <td align='center' nowrap>

        	<input type='text' name='ShortName' value='' placeholder="Short Name" >

		</td>
  <td align='left' nowrap>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="adate" size="10%" value="" placeholder="Date" readonly>
        &nbsp;
        <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
</td>
<td nowrap>        
        <input type="text"  size="10%" name="bdate" value="" placeholder="Date" readonly>
        &nbsp;
        <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
</td>
    <!-- <td align='center' nowrap>

        	<input type='text' size="3" name='maxmark' maxlength="3" value='' placeholder="Mark" >
            </td>-->
            
<?php
if($examtype=='1')
{
echo $ordercount=='2';
}
if($examtype=='2' || $examtype=='3'  )
{
echo $ordercount=='1';
}
?>


</tr>



</table>

<br>  <div align='center' >

  <input type="button" name="saveyear" value="Save Setup" onClick="RefreshMe1()"  class='bgbutton'>

</div>  





<br>

<?php
		$yearstt=execute("SELECT id FROM `dp_exam_sub_m` where `class`='$sem' and exam_id='$examname_m' and section='$class_section_id' and acc_year='$a_year' and status=1");

		$yearstt2=fetchrow($yearstt);

		$yearstt2[0];

		if($yearstt2[0]==0)

		die();

?><table align='center' class='forumline' width='80%' border="1" >

	<tr>
        <td align='center' class='head' nowrap>Check</td>
        <td align='center' class='head' nowrap>Exam Name</td>
        <td align='center' class='head' nowrap>Short Name</td>
		<td align='center' class='head' nowrap>From</td>
        <td align='center' class='head' nowrap>To</td>
      <!--  <td align='center' class='head' nowrap>Mark </td>
        <td align='center' class='head' nowrap>Group</td>-->
		<td align='center' class='head' nowrap>Action</td>
	</tr>

<?php 

$yearstt=execute("SELECT * FROM `dp_exam_sub_m` where `class`='$sem' and exam_id='$examname_m' and section='$class_section_id' and acc_year='$a_year' and status=1");
while($yearstt1=fetcharray($yearstt))

{

?>

	<tr>
   <td align="center"><input type='checkbox' name='seltype[]' value='<?=$yearstt1[id]?>'></td>
        <td align='left' nowrap>&nbsp;&nbsp;<?=$yearstt1['exam_name']?></td>
        <td align='left' nowrap>&nbsp;&nbsp;<?php echo $yearstt1['exam_sub_name']; ?></td>
<?php 
	$frt=explode('-',$yearstt1['from']);
	$ffrt="$frt[2]-$frt[1]-$frt[0]";
?>     
        <td align='left' nowrap>&nbsp;&nbsp;<?php echo $ffrt;?></td>
<?php 
	$secnd=explode('-',$yearstt1['to']);
	$scnd="$secnd[2]-$secnd[1]-$secnd[0]";
?>     
        <td align='left' nowrap>&nbsp;&nbsp;<?php echo $scnd;?></td>
        <td>
    <a href="javascript:OpenWind2('marktran_mod.php?examid=<?php echo $yearstt1[0]; ?>&course=<?=$course?>&class_section_id=<?=$class_section_id?>&masterexamid=<?=$examname_m?>&subject=<?=$subject?>&sem=<?=$sem?>')" >Modify</a>
</td>

</tr>
<?php

}

?>

</table>
<br><div align='center'><input type='submit' name='del' value='Delete' class='bgbutton'></div>

</form>
 </body>
</html>

