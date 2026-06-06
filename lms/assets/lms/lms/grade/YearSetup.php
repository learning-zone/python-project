<html>
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
$ExamName=$_POST['ExamName'];
$ShortName=$_POST['ShortName'];
$Persatage=$_POST['Persatage'];
$maxmark=$_POST['maxmark'];
$class=$_POST['class'];
$ordercount=$_POST['ordercount'];
if($_POST['saveyear'])
{	
		$yearstt=execute("SELECT count(id)
FROM `igc_exam_year_m` where`acc_year`='$a_year' and `class`='$sem' and (exam_name='$ExamName' or exam_sub_name='$ShortName')");
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
			if($class!=0 and $ExamName!='')
			{
				execute("INSERT INTO `igc_exam_year_m` ( `exam_name`, `exam_sub_name`, `per_info`, `mark`, `acc_year`, `class`, `status`, `order_id`) VALUES ( '$ExamName', '$ShortName', '$Persatage', '$maxmark','$a_year','$sem','1','$ordercount')");
					//execute();				
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
		execute("update igc_exam_year_m set `exam_name`='$ExamName1', `exam_sub_name`='$ShortName1', `per_info`='$Persatage1', `order_id`='$ordercount1',`mark`='$maxmark1' where id='$cid[$i]' and status=1 ");	
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
  <td colspan=2 align='center' class='head'>Year Setup</td></tr>
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
</table>
<br>
<?

if($sem=='' and $sem==0)
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
        	<input type='text' size="40" name='ExamName' value=''>
		</td>
        <td align='center' nowrap>
        	<input type='text' name='ShortName' value=''>
		</td>
      <td align='center' nowrap>
        	<input type='text' name='Persatage' size="2" maxlength="3" value=''>
		</td>
		
        <td align='center' nowrap>
        	<input type='text' size="3" name='maxmark' maxlength="3" value=''>
		</td>
         <td align='center' nowrap>
                <select name="ordercount" >
                    <option value="">Select</option>
                    <?php
                        for($j=1;$j<10;$j++)
                        {
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

		$yearstt=execute("SELECT * FROM `igc_exam_year_m` where`acc_year`='$a_year' and `class`='$sem' ");
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
$yearstt=execute("SELECT * FROM `igc_exam_year_m` where`acc_year`='$a_year' and `class`='$sem'");
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
