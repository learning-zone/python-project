<html>
<?php
   include("../db.php");
   if($_REQUEST)
   {
		$ad=$_REQUEST['ad'];
		$st=$_REQUEST['st'];
		$sid=$_REQUEST['sid'];
		$grade = $_REQUEST['grade'];
		$sem=$_REQUEST['sem'];
		$class_section_id=$_REQUEST['class_section_id'];

   }
   if($_POST)
   {
		$grade = $_POST['grade'];
		$sem=$_POST['sem'];
		$class_section_id=$_POST['class_section_id'];

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
   $dat=date('Y-m-d');
?>
<head>
</head>

<SCRIPT language=javascript>
function doc()
{
   document.frmMedicaldetail.action='add_medical.php';
   document.frmMedicaldetail.submit();
}
		
function trim(par)
{	
	
	y=par.length;
	ret='';
	for (i=0;i<y;i++)
	{
		if (par.charAt(i)!=' ')
		{
			ret=ret+par.charAt(i);
		}
	}
	
	return ret;
	
}

function frmMedicaldetail_submit()
{
	if (trim(frmMedicaldetail.txtheight.value)=="")
	{
		alert("Please Enter Student Height");
		frmMedicaldetail.txtheight.focus();
                return false;
	}
	else if (trim(frmMedicaldetail.txtweight.value)=="")
	{
		alert("Please Enter Student Weight");
		frmMedicaldetail.txtweight.focus();
                return false;
	}
	else if (document.frmMedicaldetail.txtGenExam.value=="")
	{
		alert("Please Enter General Examination");
		document.frmMedicaldetail.txtGenExam.focus();
		return false;
	}
	else if (document.frmMedicaldetail.txtvision.value=="")
	{
		alert("Please Enter Vision");
		document.frmMedicaldetail.txtvision.focus();
		return false;
	}
	else if (document.frmMedicaldetail.txtdental.value=="")
	{
		alert("Please Enter Dental");
		document.frmMedicaldetail.txtdental.focus();
		return false;
	}
	else if (document.frmMedicaldetail.txtCardExam.value=="")
	{
		alert("Please Enter Cardiovascular Examination");
		document.frmMedicaldetail.txtCardExam.focus();
		return false;
	}
	else if (document.frmMedicaldetail.txtchest.value=="")
	{
		alert("Please Enter Chest Exam");
		document.frmMedicaldetail.txtchest.focus();
		return false;
	}
	else if (document.frmMedicaldetail.txturine.value=="")
	{
		alert("Please Enter Urine Microscopic Examination");
		document.frmMedicaldetail.txturine.focus();
		return false;
	}
	else if (document.frmMedicaldetail.txtblood.value=="")
	{
		alert("Please Enter Blood Examination");
		document.frmMedicaldetail.txtblood.focus();
		return false;
	}
	else if (document.frmMedicaldetail.txtremarks.value=="")
	{
		alert("Please Enter Remarks");
		document.frmMedicaldetail.txtremarks.focus();
		return false;
	}
	else
	{
		frmMedicaldetail.subn.value = "SUBMIT";
		document.frmMedicaldetail.submit();
	}
}	

function frmMedicaldetail_submit1()
{
	frmMedicaldetail.txhControl.value = "Back";
	document.frmMedicaldetail.submit();
}	

		</SCRIPT>
            <body>
         		<form name="frmMedicaldetail" method="post" action="ins_medical.php">
			<input type=hidden name='sid' value='<?php echo $sid?>'>
		<input type=hidden name='grade' value='<?php echo $grade?>'>
        <input type=hidden name='branch' value='<?php echo $grade?>'>
        <input type=hidden name='sem' value='<?php echo $sem?>'>
        <input type=hidden name='class_section_id' value='<?php echo $class_section_id?>'>
        
        		<input type=hidden name='ad' value='<?php echo $ad?>'>
			<input type=hidden name='st' value='<?php echo $st?>'>

<?php

if(isset($_POST['subn']))
{

	$cv=execute("select * from stud_health where studid='$sid' and courseid='$sem' and academicyear='$ad'");
	
	if(rowcount($cv)==0)
	{
		$query=execute("insert into stud_health(studid,studname,courseid,academicyear,height,weight,general_exam,vision,dental,cardio_exam,chest_exam,urine_exam,blood_exam,remarks,rep_date)values('$sid','$st',$sem,'$ad','$txtheight','$txtweight','$txtGenExam','$txtvision','$txtdental','$txtCardExam','$txtchest','$txturine','$txtblood','$txtremarks','$dat')"); 
		?>
		<script language='javascript'>
		alert("**** Updated Successfully ***");
		doc();
		</script>
		
		<?php
		 echo "<input type='submit' name='bac'  value='GO BACK' onclick='doc()' size=3 class='bgbutton'><br>";
		die("Data Inserted Successfully");
		
	}


}
?>  
 			<table class='forumline' cellspacing=0 width="45%"  align="center" border=1>
			<?php
			           $rvm=execute("select * from stud_health where studid='$sid'");
				   if(rowcount($rvm)>0)
				   {
				     echo "<input type='submit' name='bac'  value='GO BACK' onclick='doc()' size=3 class='bgbutton'><br>";
					 die("Detail Already Entered for Selected Student");
				   }
                                   $cr=execute("select * from course_year where year_id='$sem'");
				   $gh=fetcharray($cr);
			?>			
			<tr>
			<td vAlign="top" align="center"  height="30" colspan=4 class=head>
			Medical Details for 
			<?php echo $st?> </td>
		</tr>
		               
				<tr class="keyrow">
					<td>&nbsp;<?php echo $_SESSION['semname']; ?></td>
					<td><?php echo $gh[year_name]?></td>
					<td>&nbsp;Academic Year</td>
					<td><?php echo $ad?></td>
					
				</tr>
				<tr vAlign="top" align="left">
					<td class="keycell">&nbsp;Height(in cms) </td>
					<td colSpan="3">
					
					<input size="41" value="" name="txtheight"></td>
				</tr>
				<tr vAlign="top" align="left">
					<td class="keycell" >&nbsp;Weight </td>
					<td colSpan="3">
					<input size="41" value="" name="txtweight">
					</td>
				</tr>
				<tr>
					<td class="keycell" nowrap>&nbsp;General Examination </td>
					<td colSpan="3"><textarea name="txtGenExam" rows="2" cols="50"></textarea></td>
				</tr>
				<tr>
					<td class="keycell">&nbsp;Vision </td>
					<td colSpan="3">
					<textarea name="txtvision" rows="2" cols="50"></textarea></td>
				</tr>
				<tr>
					<td class="keycell">&nbsp;Dental </td>
					<td colSpan="3">
					<textarea name="txtdental" rows="2" cols="50"></textarea> </td>
				</tr>
				<tr>
					<td class="keycell" nowrap>&nbsp;Cardiovascular Examination </td>
					<td colSpan="3"><textarea name="txtCardExam" rows="2" cols="50"></textarea></td>
				</tr>
				<tr>
					<td class="keycell">&nbsp;Chest Exam </td>
					<td colSpan="3">
					<textarea name="txtchest" rows="2" cols="50"></textarea>
					</td>
				</tr>
				<tr>
					<td class="keycell" nowrap>&nbsp;Urine Microscopic Examination </td>
					<td colSpan="3">
					<textarea name="txturine" rows="2" cols="50"></textarea>
					</td>
				</tr>
				<tr>
					<td class="keycell">&nbsp;Blood Examination </td>
					<td colSpan="3">
					<textarea name="txtblood" rows="2" cols="50"></textarea>
					</td>
				</tr>
				<tr>
					<td class="keycell">&nbsp;Remarks </td>
					<td colSpan="3">
					<textarea name="txtremarks" rows="2" cols="50"></textarea>
					</td>
				</tr>
				


		</table>
        <center>
        <div>
				<input type="submit" name='bac'  value="GO BACK" onclick='doc()' size=3 class='bgbutton'>
				<input type="submit" name='subn' value="SUBMIT" class='bgbutton' onclick='return frmMedicaldetail_submit()'> 
			</div>
            </center>
				<tr>
					<td class="keycell" colSpan="4">&nbsp;Abbreviations used
					</td>
				</tr>
                <br>
				<tr>
					<td class="keycell" colSpan="4">
					
					WNL - Within Normal Limits
					</td>
				</tr>
<br>
				<tr>
					<td class="keycell" colSpan="4">
					
					NAD - Nothing Abnormal Detected
					</td>
				</tr>
                <br>
					<tr>
					<td class="keycell" colSpan="4">
					For More details please contact infirmary at  Campus</td>
				</tr>			
				
</table>
	</form>
</table>
</body>
</html>
