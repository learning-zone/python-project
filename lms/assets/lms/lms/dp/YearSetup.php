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

		document.MyFrm.action="YearSetup.php";

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
$a_year=$_POST['a_year'];
	$sem=$_POST['sem'];


}

else

{

	$course=$_SESSION['branch'];

	$sem=$_SESSION['sem'];
$a_year=$_SESSION['AcademicYear'];


}

$ExamName=$_POST['ExamName'];

$ShortName=$_POST['ShortName'];

$Persatage=$_POST['Persatage'];

$maxmark=$_POST['maxmark'];

$ordercount=$_POST['ordercount'];

if($_POST['saveyear'])

{	

		$yearstt=execute("SELECT count(id)

FROM `dp_exam_year_m` where `class`='$sem' and (exam_name='$ExamName' or exam_sub_name='$ShortName')");

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

			if($sem!=0 and $ExamName!='' and $Persatage!='' and $maxmark!='' )

			{

				execute("INSERT INTO `dp_exam_year_m` ( `exam_name`, `exam_sub_name`, `per_info`, `mark`, `class`, `status`, `order_id`,`acc_year`) VALUES ( '$ExamName', '$ShortName', '$Persatage', '$maxmark','$sem','1','$ordercount',$a_year)");

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

if($_POST['modify'])

{

	

	$cid=$_POST['seltype'];

	for($i=0;$i<sizeof($cid);$i++)

	{

		$ExamName1=$_POST['ExamName'.$cid[$i]];

		$ShortName1=$_POST['ShortName'.$cid[$i]];

		$Persatage1=$_POST['Persatage'.$cid[$i]];

		$ordercount1=$_POST['ordercount'.$cid[$i]];		

		$maxmark1=$_POST['maxmark'.$cid[$i]];

		execute("update dp_exam_year_m set `exam_name`='$ExamName1',`acc_year`='$a_year' ,`exam_sub_name`='$ShortName1', `per_info`='$Persatage1', `order_id`='$ordercount1',`mark`='$maxmark1' where id='$cid[$i]' and status=1 ");	

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
  <td colspan=2 align='center' class='head'>DP Year Setup</td></tr>
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
							if($i==$a_year)
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
<tr><td width="40%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td><td><select name="course" onChange="RefreshMe(0)">
<option value='-1'>-- Select --</option>
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
</table>
<br>
<?php
$sem=$_POST['sem'];

	
if($sem=='0' ||  $sem=='' )
{
die();
}
?>



<table align='center' class='forumline' width='70%' border="1" >

	<tr>

        <td align='center' class='head' nowrap>Exam Name</td>

        <td align='center' class='head' nowrap>Short Name</td>

		<td align='center' class='head' nowrap> % </td>

        <td align='center' class='head' nowrap> Mark </td>

        <td align='center' class='head' nowrap>Order</td>

	</tr>



	<tr>

	

        <td align='center' nowrap>

        	<input type='text' size="40" name='ExamName' value='<?php echo $ExamName; ?>'>

		</td>

        <td align='center' nowrap>

        	<input type='text' name='ShortName' value='<?php echo $ShortName; ?>'>

		</td>

      <td align='center' nowrap>

        	<input type='text' name='Persatage' size="2" maxlength="3" value='<?php echo $Persatage; ?>'>

		</td>

		

        <td align='center' nowrap>

        	<input type='text' size="3" name='maxmark' maxlength="3" value='<?php echo $maxmark; ?>'>

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



		$yearstt=execute("SELECT * FROM `dp_exam_year_m` where `class`='$sem' ");

		$yearstt2=fetchrow($yearstt);

		$yearstt2[0];

		if($yearstt2[0]==0)

		die();

?><table align='center' class='forumline' width='70%' border="1" >

	<tr>

		<td align='center' class='head' nowrap>Sl No.</td>

        <td align='center' class='head' nowrap>Exam Name</td>

        <td align='center' class='head' nowrap>Short Name</td>

		<td align='center' class='head' nowrap> % </td>

        <td align='center' class='head' nowrap>Mark </td>

        <td align='center' class='head' nowrap>Order</td>

	</tr>

<?php 

$yearstt=execute("SELECT * FROM `dp_exam_year_m` where `class`='$sem'");

while($yearstt1=fetcharray($yearstt))

{

?>

	<tr>

	

      	 <td align='center'  nowrap>

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

       <td align='center' nowrap>

        	<input type='text' name='Persatage<?php echo $yearstt1[0]; ?>' size="2" value='<?php echo $yearstt1['per_info']; ?>'>

		</td>

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

