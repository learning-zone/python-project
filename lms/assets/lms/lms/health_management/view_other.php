<html>
<?php
   include("../db.php");
   $grade=$_POST['grade'];
   $dts = $_POST['dts'];
?>
<head>
<script>
    function cli()
    {
      document.frmMedicaldetail.action='view_reports.php';
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
<form name="frmMedicaldetail" method="post" >
		
		
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
			    $ff=execute("select * from doc_other where name='$grade' and d_date='$dts'");
			    $fff=fetcharray($ff);
			
			?>
			<tr>			
			<td align="Center" height="30" colspan=4 class=head>
			Sick Report Of <?php echo $fff[name]?> On <?php echo date("d-m-Y",strtotime($fff[d_date]))?> At <?php echo $fff['time']?></font>
			</td></tr>
			       <tr class="keyrow">
					<td width="25%" >&nbsp;Identification No</td>
					<td width="25%">&nbsp;<?php echo $fff[slno]?></td>
					<td width="25%">&nbsp;Designation</td>
					<td width="25%">&nbsp;<?php echo $fff[designation]?></td>
				</tr>
				<tr vAlign="top" align="left">
					<td class="keycell" >&nbsp;Seen By&nbsp;</td>
					<td class="keycell" colSpan="3" >&nbsp;<?php echo $fff[doc_name]?></td>
				</tr>
					<tr>
					<td class="keycell" >&nbsp;Complaints </td>
					<td colSpan="3">&nbsp;<?php echo $fff[complaints]?>
					</td>
				</tr>		

				<tr>
					<td class="keycell">&nbsp;Treatment </td>
					<td colSpan="3">&nbsp;<?php echo $fff[treatment]?></td>
				</tr>
				<tr>
					<td class="keycell" >&nbsp;Remarks</td>
					<td colSpan="3">&nbsp;<?php echo $fff[remarks]?></td>
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
			</td>
		</tr>
	</form>


</body>

</html>
