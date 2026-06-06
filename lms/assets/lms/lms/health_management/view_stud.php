<html>
<?php
   include("../db.php");
   
$penal_day = $_POST['penal_day'];
$penal_month = $_POST['penal_month'];
$penal_year = $_POST['penal_year'];

$penal_days = $_POST['penal_days'];
$penal_months = $_POST['penal_months'];
$penal_years = $_POST['penal_years'];

$mtype = $_POST['mtype'];
?>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Daywise Report</title>

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


function frmMedicaldetail_submit1()
{
	frmMedicaldetail.txhControl.value = "Back";
	document.frmMedicaldetail.submit();
}	

function reload()
{

     
	if(document.frm.mtype.value=='1')
	{
		document.frm.action='accident_day_stud.php';
		document.frm.submit();
	}
	else if(document.frm.mtype.value=='2')
	{
		document.frm.action='accident_day_staff.php';	
		document.frm.submit();
	}
	
	else if(document.frm.mtype.value=='')
	{
		alert('Please Select Type');
		return false;
	}
}

		</SCRIPT>
		<form name='frm'> 
                <table class='forumline' cellspacing=0 width="55%" id="table2" align=center >
		<tr>
			<td vAlign="top" align="center" height="30"  colspan=4 class=head>
			View Date Wise Accident Report </td>
			
		</tr>
	         		
				<tr>
				<td >&nbsp;From Date</td>
				<td  width='50%'>
				<select name="penal_day">
<?php
$j=date('d');
for($i=1;$i<=31;$i++)
{
        if($i<10)
	{
	  $i='0'.$i;
	}
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
	if($i<10)
	{
	  $i='0'.$i;
	}
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
</select></td></tr>
				<tr>
				<td>&nbsp;To Date</td>
				<td width='50%'>
				<select name="penal_days">
<?php
$j=date('d');
for($i=1;$i<=31;$i++)
{
        if($i<10)
	{
	  $i='0'.$i;
	}
	$sel='';
	if($j==$i)
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";
}
?>
</select>
<select name="penal_months">
<?php
$j=date('m');
for($i=1;$i<=12;$i++)
{
        if($i<10)
	{
	  $i='0'.$i;
	}
	$sel='';
	if($j==$i)
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";
}
?>
</select>
<select name="penal_years">
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
</select></td></tr>
 <tr vAlign="top" align="left"><td class="keycell" >&nbsp;Select Type</td>
                  <td class="keycell" colSpan="3" ><select name='mtype' onchange='reload()'>
		  <option value='0'>---Select---</option>
		 <!-- <option value='-1'>---All---</option>-->
                  <option value='1'>Student</option>
                  <option value='2'>Staff</option>
                  <!--<option value='3'>Others</option>-->
                </select></td><tr>	
			
</form>
</table>
</body>
</html>
