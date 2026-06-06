<html>

<head>
<script>
function cli()
{
  document.frmMedicaldetail.action='view_stud.php';
  document.frmMedicaldetail.submit();
}
function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display=='';
}
</script>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Sick Report</title>
</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
	include("../db.php");
	
	$id=$_REQUEST['id'];
	$grade=$_POST['grade'];
	$stud =$_POST['stud'];
	$fs =$_POST['fs'];
	$ad =$_POST['ad'];
	$gen =$_POST['gen'];
	$adm =$_POST['adm'];
	$ag =$_POST['ag'];
	$dts = $_POST['dts'];
	$prn = $_POST['prn'];
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
echo "select * from doc_detail where id='$id'";
$dcg2=execute("select * from doc_detail where id='$id'");

while($r=fetcharray($dcg2))
{
	 $grade=$r['course_id'];
	 $ad=$r['acc_year'];
	 $gen=$r['sex'];
	 $id =$r['id'];
	 $adm=$r['name'];
	 $stud=$r['stud_id'];
	$txtPresenting = $r['complaints'];
	$txtTreatment = $r['treatment'];
	$txtRecommendations = $r['remarks'];
	$tempdate=$r['d_date'];
}
?>
<?php


$seb2="select first_name, last_name,nationality,f_email,course_admitted,course_yearsem from student_m where student_id='$stud'";
$seb=execute($seb2);
while($r1=fetcharray($seb))
{
	$studentname=$r1['first_name'].' '.$r1['last_name'];
	$agyer=$r1['nationality'];
	$agye=$r1['course_admitted'];
	$ayer=$r1['course_yearsem'];
	 
}
?>

<form name="frmMedicaldetail" method="post" action='view_medical_next.php'>
<input type=hidden name='grade' value='<?php echo $grade?>'>
<input type=hidden name='ad' value='<?php echo $ad?>'>
<input type=hidden name='gen' value='<?php echo $gen?>'>
<input type=hidden name='adm' value='<?php echo $adm?>'>
<input type=hidden name='ag' value='<?php echo $ag?>'>
<input type=hidden name='stud' value='<?php echo $stud?>'>
<input type=hidden name='dts' value='<?php echo $dts?>'>
<input type=hidden name='branch' value='<?php echo $branch?>'>
<input type=hidden name='sem' value='<?php echo $sem?>'>
<input type=hidden name='class_section_id' value='<?php echo $class_section_id?>'>
<input type="hidden" name="id" value="<?=$id?>">
<input type=hidden name='fs' value='<?php echo $fs?>'>
<SCRIPT language=javascript>
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
	if (trim(document.frmMedicaldetail.cmbSeen.value)== "")
	{
		window.alert("Please Select Doctor Name");
		document.frmMedicaldetail.cmbSeen.focus();
		return false;
	}
	if (document.frmMedicaldetail.txtPresenting.value == "")
	{
		window.alert("Please Enter presnting Complaints");
		
		document.frmMedicaldetail.txtPresenting.focus();
        return false;
	}
	if (document.frmMedicaldetail.txtSalient.value == "")
	{
		window.alert("Please Enter Salient Findings");
		
		document.frmMedicaldetail.txtSalient.focus();
        return false;
	}
	if (document.frmMedicaldetail.txtProvisional.value  == "")
	{
		window.alert("Please Enter Provisional Diagnostics");
		document.frmMedicaldetail.txtProvisional.focus();
		return false;
	}
	if (document.frmMedicaldetail.txtInvestigations.value  == "")
	{
		window.alert("Please Enter Investigations");
		document.frmMedicaldetail.txtInvestigations.focus();
		return false;
	}
	if (document.frmMedicaldetail.txtTreatment.value  == "")
	{
		window.alert("Please Enter treatment");
		document.frmMedicaldetail.txtTreatment.focus();
		return false;
	}
	if (document.frmMedicaldetail.txtRecommendations.value  == "")
	{
		window.alert("Please Enter Recommendations");
		document.frmMedicaldetail.txtRecommendations.focus();
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
<table class='forumline' cellspacing=0 width="80%" id="table2" align=center border=1>

<?php

   $rfg=execute("select * from doc_detail where id='$id'");
      $fgb=fetcharray($rfg);

?>
<tr><td vAlign="top" align="Center" height="30"  colspan=4 class=head>Sick Report of <?php echo $studentname?> On <?php echo date("d-m-Y",strtotime($fgb[d_date]))?>&nbsp;&nbsp; At <?php echo $fgb['time']?>
</td></tr>
<tr class="keyrow">
					<td width="25%">&nbsp;<?php echo $_SESSION['semname']; ?></td>
					<?php
								 $cr=execute("select * from course_year where year_id='$sem'");
				   $rtt=fetcharray($cr);
		
					?>
					<td width="25%" >&nbsp;<?php echo $rtt[year_name]?></td>
					<td width="25%">&nbsp;Sex</td>
					<td width="25%">&nbsp;<?php echo $gen?></td>
				</tr>
				<tr class="keyrow">
					<td width="25%">&nbsp;Admission Type</td>
					<?php
					     $ggt=execute("select * from admission where id='$adm'");
					     $g=fetcharray($ggt);
					
					?>
					<td width="25%">&nbsp;<?php echo $g[name]?></td>
				<td width="25%">&nbsp;Age (yrs.)</td>
					<td width="25%">&nbsp;<?php echo $ag?></tr>
				<tr><td width="25%">&nbsp;Academic Year</td>
					<td width="25%">&nbsp;<?php echo $ad?></td>
					<td width="25%"  colspan='2'></td></tr>
				<tr vAlign="top" align="left">
					<td class="keycell">&nbsp;Seen By&nbsp;</td>
					<td class="keycell" colSpan="3" >
                    &nbsp;<?php echo $fgb[doc_name]?></td>
				</tr>
					<tr>
					<td class="keycell">&nbsp;Description</td>
					<td colSpan="3">&nbsp;<?php echo $fgb[complaints]?>
					</td>
				</tr>		

				<tr>
					<td class="keycell">&nbsp;Treatment </td>
					<td colSpan="3">&nbsp;<?php echo $fgb[treatment]?>
					</td>
				</tr>
				<tr>
					<td class="keycell" >&nbsp;Outcome</td>
					<td colSpan="3">&nbsp;<?php echo $fgb[remarks]?>
					</td>
				</tr>
				
		</table>	
		<br>
        <div>
        <center>
			<input type=submit value='Go Back' class='bgbutton' onclick='cli()'>
			&nbsp;
            <input type=button name='prn' value="PRINT" class='bgbutton' onclick='printReport()'>
    
		       </center>
                       </div>
			
</form>
</body>

</html>
