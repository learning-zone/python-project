<html>
<?php
include("../db.php");
$grade=$_REQUEST['grade'];
$ay=$_REQUEST['ay'];
$fs=$_REQUEST['fs'];
$std=$_REQUEST['std'];

$txtheight = $_POST['txtheight'];
$txtweight = $_POST['txtweight'];
$txtGenExam = $_POST['txtGenExam'];
$txtvision = $_POST['txtvision'];
$txtdental = $_POST['txtdental'];
$txtCardExam = $_POST['txtCardExam'];
$txtchest = $_POST['txtchest'];
$txturine = $_POST['txturine'];
$txtblood = $_POST['txtblood'];
$txtremarks = $_POST['txtremarks'];
$subn = $_POST['subn'];
   if($_REQUEST)
   {
		$ad=$_REQUEST['ad'];
		$st=$_REQUEST['st'];
		$sid=$_REQUEST['sid'];
		$grade = $_REQUEST['grade'];
		$branch=$_REQUEST['branch'];
		$sem=$_REQUEST['sem'];
		$class_section_id=$_REQUEST['class_section_id'];

   }
   if($_POST)
   {
		$grade = $_POST['grade'];
		$sem=$_POST['sem'];
		$class_section_id=$_POST['class_section_id'];
		$branch=$_POST['branch'];	
		$subn = $_POST['subn'];
		
		$txtheight = $_POST['txtheight'];
		$txtweight = $_POST['txtweight'];
		$txtGenExam = $_POST['txtGenExam'];
		$txtvision = $_POST['txtvision'];
		$txtdental = $_POST['txtdental'];
		$txtCardExam = $_POST['txtCardExam'];
		$txtchest = $_POST['txtchest'];
		$txturine = $_POST['txturine'];
		$txtblood = $_POST['txtblood'];
		$txtremarks = $_POST['txtremarks'];
   }
  
?>
<head>
<script>
function cli()
{
   document.frmMedicaldetail.action='edit_medical_rep.php';
   document.frmMedicaldetail.submit();
}
</script>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Medical Details for</title>
</head>
<body>
<form name="frmMedicaldetail" method="post" action='edit_rep.php'>
<input type=hidden name='grade' value='<?php echo $grade?>'>	

<input type=hidden name='ay' value='<?php echo $ay?>'>
<input type=hidden name='fs' value='<?php echo $fs?>'>
<input type=hidden name='std' value='<?php echo $std?>'>
<input type=hidden name='branch' value='<?php echo $branch?>'>	
<input type=hidden name='sem' value='<?php echo $sem?>'>
<input type=hidden name='class_section_id' value='<?php echo $class_section_id?>'>

<SCRIPT language=javascript>
	

function frmMedicaldetail_submit()
{
	if (trim(frmMedicaldetail.txtheight.value)=="")
	{
		alert("Please Enter Student Height");
		//frmMedicaldetail.txtheight.value="";
		frmMedicaldetail.txtheight.focus();
        return false;
	}
	if (trim(frmMedicaldetail.txtweight.value)=="")
	{
		alert("Please Enter Student Weight");
		//frmMedicaldetail.txtweight.value="";
		frmMedicaldetail.txtweight.focus();
        return false;
	}
	if (document.frmMedicaldetail.txtGenExam.value  == "")
	{
		window.alert("Please Enter General Examination");
		document.frmMedicaldetail.txtGenExam.focus();
		return false;
	}
	if (document.frmMedicaldetail.txtvision.value  == "")
	{
		window.alert("Please Enter Vision");
		document.frmMedicaldetail.txtvision.focus();
		return false;
	}
	if (document.frmMedicaldetail.txtdental.value  == "")
	{
		window.alert("Please Enter Dental");
		document.frmMedicaldetail.txtdental.focus();
		return false;
	}
	if (document.frmMedicaldetail.txtCardExam.value  == "")
	{
		window.alert("Please Enter Cardiovascular Examination");
		document.frmMedicaldetail.txtCardExam.focus();
		return false;
	}
	if (document.frmMedicaldetail.txtchest.value  == "")
	{
		window.alert("Please Enter Chest Exam");
		document.frmMedicaldetail.txtchest.focus();
		return false;
	}
	if (document.frmMedicaldetail.txturine.value  == "")
	{
		window.alert("Please Enter Urine Microscopic Examination");
		document.frmMedicaldetail.txturine.focus();
		return false;
	}
	if (document.frmMedicaldetail.txtblood.value  == "")
	{
		window.alert("Please Enter Blood Examination");
		document.frmMedicaldetail.txtblood.focus();
		return false;
	}
	if (document.frmMedicaldetail.txtremarks.value  == "")
	{
		window.alert("Please Enter Remarks");
		document.frmMedicaldetail.txtremarks.focus();
		return false;
	}
	frmMedicaldetail.txhControl.value = "Submit";
	document.frmMedicaldetail.submit();
}	

function frmMedicaldetail_submit1()
{
	frmMedicaldetail.txhControl.value = "Back";
	document.frmMedicaldetail.submit();
}	

		</SCRIPT>
			 <?php
		       if(isset($subn))
				{
                                   $ebn=execute("update stud_health set height='$txtheight',weight='$txtweight',general_exam='$txtGenExam',vision='$txtvision',dental='$txtdental',cardio_exam='$txtCardExam',chest_exam='$txtchest',urine_exam='$txturine',blood_exam='$txtblood',remarks='$txtremarks' where studid='$std'");
                                   echo "Updated Successfully";
				   
				}
				?>
			<table class='forumline' cellspacing=0 width="55%"  align="center" border=1>
			<tr>
			<td vAlign="top" align="Center"  height="30"  colspan=4 class=head>
			Edit Medical Details for 
			<?php echo $fs?></td>
		</tr>
			
        <?php
                 $cr=execute("select * from course_year where year_id='$sem'");
				   $rtt=fetcharray($cr);
			?>
					
				
				
					<tr class="keyrow">
					<td >
					&nbsp;<?php echo $_SESSION['semname']; ?></td>
					<td >&nbsp;<?php echo $rtt[year_name]?></td>
					<td>
					&nbsp;Academic Year</td>
					<td>&nbsp;<?php echo $ay?></td>
				</tr>
				
				<?php
				         $ecv=execute("select * from stud_health where courseid='$grade' and studid='$std' and academicyear='$ay'");
				         $vv=fetcharray($ecv);
					{
                      
				?>
				<tr vAlign="top" align="left">
					<td class="keycell" >
					&nbsp;Height(in cms) </td>
					<td colSpan="3">
					
					<input size="41" value="<?php echo $vv[height]?>" name="txtheight"></td>
				</tr>
				<tr vAlign="top" align="left">
					<td class="keycell" >
					&nbsp;Weight </td>
					<td colSpan="3">
					<input size="41" value="<?php echo $vv[weight]?>" name="txtweight"></td>
				</tr>
				<tr>
					<td class="keycell" nowrap>
					&nbsp;General 
					Examination </td>
					<td colSpan="3">
					<textarea name="txtGenExam" rows="2" cols="50"><?php echo $vv[general_exam]?></textarea> </td>
				</tr>
				<tr>
					<td class="keycell" >&nbsp;Vision </td>
					<td colSpan="3">
					<textarea name="txtvision" rows="2" cols="50"><?php echo $vv[vision]?></textarea></td>
				</tr>
				<tr>
					<td class="keycell" >&nbsp;Dental </td>
					<td colSpan="3">
					<textarea name="txtdental" rows="2" cols="50"><?php echo $vv[dental]?></textarea> </td>
				</tr>
				<tr>
					<td class="keycell" nowrap>&nbsp;Cardiovascular Examination </td>
					<td colSpan="3">
					<textarea name="txtCardExam" rows="2" cols="50"><?php echo $vv[cardio_exam]?></textarea> </td>
				</tr>
				<tr>
					<td class="keycell">
					&nbsp;Chest Exam </td>
					<td colSpan="3">
					<textarea name="txtchest" rows="2" cols="50"><?php echo $vv[chest_exam]?></textarea>
					</td>
				</tr>
				<tr>
					<td class="keycell" nowrap>
					&nbsp;Urine Microscopic Examination </td>
					<td colSpan="3">
					<textarea name="txturine" rows="2" cols="50"><?php echo $vv[urine_exam]?></textarea>
					</td>
				</tr>
				<tr>
					<td class="keycell" >
					&nbsp;Blood Examination </td>
					<td colSpan="3">
					<textarea name="txtblood" rows="2" cols="50"><?php echo $vv[blood_exam]?></textarea>
					</td>
				</tr>
				<tr>
					<td class="keycell">
					&nbsp;Remarks </td>
					<td colSpan="3">
					<textarea name="txtremarks" rows="2" cols="50"><?php echo $vv[remarks]?></textarea>
					</td>
				</tr>
				<?php

					}
	          ?>		
		</table>
        <br>
        <center>
				<input type="submit" name="subs" value="GO BACK" size=3 class=bgbutton onclick='cli()'>
				<input type="submit" name="subn" value="EDIT" class=bgbutton> 
		</center>	
                <br>
				<tr>
					<td class="keycell" colSpan="4">Abbreviations used
					</td>
				</tr>
                <br>
				<tr>
					<td class="keycell" colSpan="4">					
					WNL - Within Normal Limits</td>
				</tr>
                <br>
				<tr>
					<td class="keycell" colSpan="4">					
					NAD - Nothing Abnormal Detected</td>
				</tr>
                <br>
					<tr>
					<td class="keycell" colSpan="4">
					For More details please contact infirmary at  Campus </td>
				</tr>
				

</form>
</table>
</body>
</html>
