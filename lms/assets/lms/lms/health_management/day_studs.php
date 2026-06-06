<html>
<?php
include("../db.php");

	$stud = $_REQUEST['stud'];
	$dt = $_REQUEST['dt'];
	$fs = $_REQUEST['fs'];
	$as = $_REQUEST['as'];
	$ad = $_REQUEST['ad'];
	$ag = $_REQUEST['ag'];
	$gen = $_REQUEST['gen'];
	$adm = $_REQUEST['adm'];
	$pf = $_REQUEST['pf'];
	$pt = $_REQUEST['pt'];
	
	$prn = $_POST['prn'];
	$sem=$_REQUEST['sem'];
	$mtype=$_REQUEST['mtype'];
	$penal_to=$_REQUEST['penal_to'];
	$penal_from=$_REQUEST['penal_from'];


     
?>
<head>
<script>
function cli()
{
  document.frmMedicaldetail.action='day_stud.php';
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
<form name="frmMedicaldetail" method="post" action='day_studs.php'>
<input type=hidden name='as' value='<?php echo $as?>'>
<input type=hidden name='ad' value='<?php echo $ad?>'>
<input type=hidden name='gen' value='<?php echo $gen?>'>
<input type=hidden name='adm' value='<?php echo $adm?>'>
<input type=hidden name='ag' value='<?php echo $ag?>'>
<input type=hidden name='stud' value='<?php echo $stud?>'>
<input type=hidden name='fs' value='<?php echo $fs?>'>
<input type=hidden name='mtype' value='<?php echo $mtype?>'>
<input type=hidden name='st' value='<?php echo $st?>'>
<input type='hidden' name='pf' value='<?php echo $pf?>'>
<input type='hidden' name='pt' value='<?php echo $pt?>'>
<input type='hidden' name='dt' value='<?php echo $dt?>'>
<input type='hidden' name='penal_day' value='<?php echo $penal_day?>'>
<input type='hidden' name='penal_month' value='<?php echo $penal_month?>'>
<input type='hidden' name='penal_year' value='<?php echo $penal_year?>'>
<input type='hidden' name='penal_days' value='<?php echo $penal_days?>'>
<input type='hidden' name='penal_months' value='<?php echo $penal_months?>'>
<input type='hidden' name='penal_years' value='<?php echo $penal_years?>'>
<input type='hidden' name='mtype' value='<?php echo $mtype?>'>
<input type='hidden' name='penal_from' value='<?php echo $penal_from?>'>
<input type='hidden' name='penal_to' value='<?php echo $penal_to?>'>
<p>&nbsp;</p>
<p>&nbsp;</p>

<table class="formtable" width="55%" id="table2" align=center border=1>
<?php
      $rfg=execute("select * from doc_detail where stud_id='$stud' and course_id='$as'");
      $fgb=fetcharray($rfg);

?>

<tr><td align="Center" height="30"  colspan=4 class="submenu">
Sick Report Of <?php echo $fs?></td></tr>
<tr class="keyrow">
					<td width="25%" >&nbsp;<?php echo $_SESSION['semname']; ?></td>
					<?php
					    	 $cr=execute("select * from course_year where year_id='$sem'");
				   $rtt=fetcharray($cr);
		
					?>
					<td width="25%" >&nbsp;<?php echo $rtt[year_name]?></font></td>
					<tr>
					<td width="25%" >&nbsp;Sex</td>
					<td width="25%" >&nbsp;<?php echo $gen?></td>
					</tr>
				</tr>
				<tr>
				<td width="25%" >&nbsp;Age (yrs.)</td>
					<td width="25%">&nbsp;<?php echo $ag?></tr>
					
				<tr class="keyrow">
					<td width="25%">&nbsp;Admission Type</td>
					<?php
					     $ggt=execute("select * from admission where id='$adm'");
					     $g=fetcharray($ggt);
					
					?>
					<td width="25%">&nbsp;<?php echo $g[name]?></td>
					</tr>
				    	<tr>
					<td width="25%" >&nbsp;Academic Year</td>
					<td width="25%">&nbsp;<?php echo $ad?></td>
					
					</tr>
					</table>
					<br>
					<table border='1' align='center' width = "70%">
					<tr><td colspan=6 align=center class="submenu">Date Wise Details</td></tr>
	     <tr class="submenu">
		         <td align=center>&nbsp;Sl No</td>
			<td align=center>&nbsp;Date</td>
			<td align=center>&nbsp;Diagnosis</td>
			<td align=center>&nbsp;Taken By</td>
            <td align=center>&nbsp;Place</td>
		</tr>
					<?php
					      $slno=1;
					      $rcb=execute("select * from doc_detail where type='yes' and stud_id='$stud' and d_date between '$pf' and '$pt' order by d_date");
					      while($rrf=fetcharray($rcb))
					     {
					?>
			<tr>
			<td  align=center>&nbsp;<?php echo $slno?></td>
			<td  align=center>&nbsp;<?php echo date("d-m-Y",strtotime($rrf[d_date]))?></td>
			<td align=center>&nbsp;<?php echo $rrf[complaints]?></td>            
            <td align=center>&nbsp;<?php echo $rrf[doc_name]?></td>
			<td align=center>&nbsp;<?php echo $rrf[place]?></td>
		</tr>
		
				
			<?php
			     $slno++;
			     }
			?>
		
	
</table>
<br>
<center>
<input type=submit value='Go Back' class='bgbutton' onclick='cli()'>
&nbsp;
<input type=button name='prn' value="PRINT" class='bgbutton' onclick='printReport()'>
</center>
</div>
</form>
</body>

</html>
