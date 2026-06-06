<html>
<?php
   include("../db.php");
   

$doct = $_POST['doct'];
$des = $_POST['des'];
$ide = $_POST['ide'];
$sta = $_POST['sta'];
$penal_day = $_POST['penal_day'];
$penal_month = $_POST['penal_month'];
$penal_year = $_POST['penal_year'];
$penal_hr = $_POST['penal_hr'];
$penal_sec = $_POST['penal_sec'];
$ams = $_POST['ams'];
$txtPresenting = $_POST['txtPresenting'];
$txtTreatment = $_POST['txtTreatment'];
$txtRecommendations = $_POST['txtRecommendations'];
$subn = $_POST['subn'];
?>
<head>
<script>
   function reload()
   {
      document.frmMedicaldetail.action='sick_report.php';
      document.frmMedicaldetail.submit();
   }
</script>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Sick report</title>
</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
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

			<table class="formtable" width="70%" id="table2" align=center>
				
				<tr>
			<td vAlign="top" align="center" height="30" colspan=5 class=head>
			Sick Report
			</td>
			
		</tr>
				<tr class="keyrow">
					<td width="25%" >&nbsp;Name </td>
					<td width="25%" colspan=3 >
					
					<input type='text' name='sta'></td></tr>
				<tr class="keyrow">
					<td width="25%" >&nbsp;Identification No</td>
					<td width="25%">
					
					<input type='text' name='ide'></td>
				
					<td width="25%">&nbsp;Designation </td>
					<td width="25%" >
					
					<input type='text' name='des'></td>
				</tr>

					<tr vAlign="top" align="left">
					<td class="keycell">&nbsp;Seen By</td>
					<td class="keycell" colSpan="3">					
					<input type=text name="doct">
				</td>
				</tr>
				<tr>
				<td >&nbsp;Select Date</td>
				<td width='50%'>
				<select name="penal_day">
<?php
$j=date('d');
for($i=1;$i<=31;$i++)
{
	$sel='';
	if($j==$i)
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";
}
?>
</select>
<select name="penal_month">
<?php
$j=date('m');
for($i=1;$i<=12;$i++)
{
	$sel='';
	if($j==$i)
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";
}
?>
</select>
<select name="penal_year">
<?php
$j=date('Y');
$d=$j-1;
for($i=$d;$i<=$j+1;$i++)
{
	$sel='';
	if($j==$i)
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";
}
?>
</select>

</td>
<td colspan=2 width='50%'>&nbsp;Time<select name="penal_hr">
  <?php
   
    for($i='1';$i<=12;$i++)
  {
	if($i<10)
	{
	  $i='0'.$i;
	}
	
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";
 }
?>
</select>
<select name="penal_sec">
<?php
for($i='1';$i<=59;$i++)
{
	if($i<10)
	{
	  $i='0'.$i;
	}
	
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";
}
?>
</select>
<select name='ams'>
<option>AM</option>
<option>PM</option></select>
</td>

			</tr>
			                <tr>
					<td class="keycell">&nbsp;Complaints </td>
					<td colSpan="3">
					<textarea name="txtPresenting" rows="4" cols="70"></textarea></td>
				</tr>
			
				<tr>
					<td class="keycell">&nbsp;Treatment </td>
					<td colSpan="3">
					<textarea name="txtTreatment" rows="4" cols="70"></textarea>
					</td>
				</tr>
				<tr>
					<td class="keycell">&nbsp;Remarks</td>
					<td colSpan="3">
					<textarea name="txtRecommendations" rows="4" cols="70"></textarea>
					</td>
				</tr>
				
				<?php
				     if(isset($subn))
				     {						 
				       $penaly=$_POST['penal_year'];
				       $penalm=$_POST['penal_month'];
				       $penald=$_POST['penal_day'];
				       $ddv=$penaly."-".$penalm."-".$penald;
				       $ti=$_POST['penal_hr'];
				       $tim=$_POST['penal_sec'];
				       $tims=$_POST['ams'];
				       $timr=$ti."-".$tim."-".$tims;
//				       echo $ddv;
				       //$c=execute("select * from doc_other where d_date='$ddv'");
					   //echo $ddv;
				       //if(rowcount($c)==0)
				       {
						   $gj=execute("insert into doc_other(slno,name,designation,doc_name,d_date,time,complaints,treatment,remarks)values('".addslashes($ide)."','$sta','$des','$doct','$ddv','$timr','".addslashes($txtPresenting)."','".addslashes($txtTreatment)."','".addslashes($txtRecommendations)."')");
					 //echo "INSERTED SUCESSFULLY";
					 ?>
						 <script language="JavaScript" type="text/javascript">
						 alert("INSERTED SUCESSFULLY");
                         </script>
						 <?php
				       }
				       
				     }
				
				?>
			
			</table>
		<br>	
        <center>		
			<input type=submit name='gob' value='Go Back' class='bgbutton' onclick='reload()'>
			<input type=submit name='subn' value='Submit' class='bgbutton'>
            </center>
				</form>


</body>
</html>
