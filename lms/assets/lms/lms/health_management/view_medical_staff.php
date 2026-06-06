<html>
<?php
     include("../db.php");
	 
	
  
  $staf=$_POST['staf'];
  $stafd=$_POST['stafd'];
  
  
$stud = $_POST['stud'];
$fn = $_POST['fn'];
$gen = $_POST['gen'];

$dts = $_POST['dts'];
?>
<head>
<script>
    function cli()
  {
     document.frmMedicaldetail.action='view_staffs.php';
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
<form name="frmMedicaldetail" method="post" action='view_medical_staff.php'>

<input type=hidden name='gen' value='<?php echo $gen?>'>
<input type=hidden name='stud' value='<?php echo $stud?>'>
<input type=hidden name='staf' value='<?php echo $staf?>'>
<input type=hidden name='stafd' value='<?php echo $stafd?>'>
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
      $rfg=execute("select * from doc_staff where slno='$stud' and group_id='$staf' and des_id='$stafd' and d_date='$dts'");
      $fgb=fetcharray($rfg);

?>

<tr><td vAlign="top" align="CENTER" height="30" colspan=4 class=head>
Sick Report of <?php echo $fn?> On <?php echo date("d-m-Y",strtotime($fgb[d_date]))?>&nbsp;&nbsp; At <?php echo $fgb['time']?></td></tr>




                                <tr class="keyrow">
				        <td width="25%" >&nbsp;Sex</td>
					<td width="25%">&nbsp;<?php echo $gen?></td>
					<td width="25%">&nbsp;Designation</td>
					<?php
					     $ggt=execute("select * from staff_des where d_id='$stafd'");
//						$ggt=execute("select * from staff_des where d_id='gg'");
					     $g=fetcharray($ggt);
					
					?>
					<td width="25%" >&nbsp;<?php echo $g[d_name]?></td>
				</tr>
				<tr vAlign="top" align="left">
					<td class="keycell" >&nbsp;Seen By&nbsp;</td>
					<td class="keycell" colSpan="3" >&nbsp;
					<?php echo $fgb[doc_name]?></td>
				</tr>
					<tr>
					<td class="keycell">&nbsp;Complaints </td>
					<td colSpan="3">&nbsp;
					<?php echo $fgb[complaints]?>
					</td>
				</tr>		

				<tr>
					<td class="keycell">&nbsp;Treatment </td>
					<td colSpan="3" >&nbsp;<?php echo $fgb[treatment]?>
					
					</font></td>
				</tr>
				<tr>
					<td class="keycell" >&nbsp;Remarks</td>
					<td colSpan="3">&nbsp;<?php echo $fgb[remarks]?>
					</td>
				</tr>
				
			
		</table>
        <br>
        <div>
        <center>
        <input type=submit value='Go Back' class='bgbutton' onclick='cli()'>			
	    <input type=button name='prn' value="PRINT" class='bgbutton' onclick='printReport()'>
			</center>
                        </div>
			</td>
		</tr>
	</form>


</body>

</html>
