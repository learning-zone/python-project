<html>
<?php
   include("../db.php");
$stud = $_REQUEST['stud'];
$gen = $_REQUEST['gen'];
$gg = $_REQUEST['gg'];
$aa = $_REQUEST['aa'];
$gr = $_REQUEST['gr'];
$pf = $_REQUEST['pf'];
$pt = $_REQUEST['pt']; 

$prn = $_POST['prn'];
?>
<head>
<script>
    function cli()
    {
      document.frmMedicaldetail.action='daywise_report.php';
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
        <form name="frmMedicaldetail" method="post" action='other_staffs.php'>
        <input type='hidden' name='stud' value='<?php echo $stud?>'>
	<input type='hidden' name='aa' value='<?php echo $aa?>'>
	<input type='hidden' name='dt' value='<?php echo $dt?>'>
	<input type='hidden' name='fs' value='<?php echo $fs?>'>
	<input type='hidden' name='as' value='<?php echo $as?>'>
	<input type='hidden' name='ad' value='<?php echo $ad?>'>
	<input type='hidden' name='ag' value='<?php echo $ag?>'>
	<input type='hidden' name='gen' value='<?php echo $gen?>'>
	<input type='hidden' name='adm' value='<?php echo $adm?>'>
	<input type='hidden' name='pf' value='<?php echo $pf?>'>
	<input type='hidden' name='pt' value='<?php echo $pt?>'>
	
	
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

			<table class="formtable" width="55%" id="table2" align=center border=1>
			<?php 
			    $ff=execute("select * from doc_other where slno='$aa'");
			    $fff=fetcharray($ff);
			
			?>
			
			<tr>
			<td align="CENTER" height="30"  colspan=4 class=head>
			Sick Report Of <?php echo $fff[name]?></td></tr>
			
			
				<tr class="keyrow">
					<td width="25%" >&nbsp;Identification No</td>
					<td width="25%" >&nbsp;<?php echo $fff[slno]?></td>
				</tr>
				<tr>	
					<td width="25%" >&nbsp;Designation</td>
					<td width="25%">&nbsp;<?php echo $fff[designation]?></td>
					
				</tr>
				
				</table>
				<br>
					<table border='1' align='center' width= "70%">
					<tr><td colspan=6 align=center  class=row3 align='center'>Date Wise Details</td></tr>
		<tr>
		         <td align=center>&nbsp;Sl No</td>
		        <td align=center>&nbsp;Seen By</td>
			<td align=center>&nbsp;Date</td>
			<td align=center>&nbsp;Complaints</td>
			<td align=center>&nbsp;Treatment</td>
			<td align=center>&nbsp;Remarks</td>
		</tr>
					<?php
					      $slno=1;
					      $rcb=execute("select * from doc_other where name='$stud' and slno='$aa' and d_date between '$pf' and '$pt' order by d_date");
					      while($rrf=fetcharray($rcb))
					     {
					?>
				<tr>
			<td >&nbsp;<?php echo $slno?></td>
			<td align=center>&nbsp;<?php echo $rrf[doc_name]?></td>
			<td >&nbsp;<?php echo date("d-m-Y",strtotime($rrf[d_date]))?></td>
			<td align=center>&nbsp;<?php echo $rrf[complaints]?></td>
			<td align=center>&nbsp;<?php echo $rrf[treatment]?></td>
			<td align=center>&nbsp;<?php echo $rrf[remarks]?></td>
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
