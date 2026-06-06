<html>
<?php
   include("../db.php");
   $grades=$_POST['grades'];
   $dts = $_POST['dts'];
   
   $cmbSeen = $_POST['cmbSeen'];
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
<script language='javascript'>
function cli()
{
   document.frmMedicaldetail.action='edit_medical_others.php';
   document.frmMedicaldetail.submit();
}
</script>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>New Page 1</title>
</head>
<body>
<form name="frmMedicaldetail" method="post" action='edit_medical_other.php'>
<input type=hidden name='ids' value='<?php echo $ids?>'>
<input type=hidden name='grades' value='<?php echo $grades?>'>
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

			<table class="formtable" width="55%" id="table2" align=center >
				
				<tr>
			<td vAlign="top" align="center" height="30"  colspan=4 class=head>Edit Other Sick Report</td>
			
		</tr>
		                <?php
				   $cv=execute("select * from doc_other where name='$grades' and d_date='$dts'");
				   $cvv=fetcharray($cv);
				   $ids=$cvv['id'];
				  
				?>
				<tr class="keyrow">
					<td width="25%" >&nbsp;Name </td>
					<td width="25%" colspan=3 >
					<input type='text' name='sta' value='<?php echo $cvv[name]?>'></td></tr>
				<tr class="keyrow">
					<td width="25%" >&nbsp;Identification No</td>
					<td width="25%" ><input type='text' name='ide' value='<?php echo $cvv[slno]?>'></td>
				
					<td width="25%">&nbsp;Designation </td>
					<td width="25%"><input type='text' name='des' value='<?php echo $cvv[designation]?>'></td>
				</tr>
				<tr vAlign="top" align="left">
					
					<tr vAlign="top" align="left">
					<td class="keycell">&nbsp;Seen By Others</td>
					<td class="keycell" colSpan="3" >					
					<input type=text name="doct" value='<?php echo $cvv[doc_name]?>'>
				</td>
				</tr>
				<tr vAlign="top" align="left">
				<td class="keycell" >&nbsp;Date</td>
					<td width="40%"><select name="penal_day">
<?php
$dd=explode("-",$cvv[d_date]);
$j=date('d');
for($i=1;$i<=31;$i++)
{
     //  if($i<10)
	//{
	  //$i='0'.$i;
	//}
	if($dd[2]=='' || $dd[2]=='0')
	{
	  $p=$j;
	}
	else
	{
	$p=$dd[2];
	}
	
	if($p==$i)
	{
	       echo "<option value='$i' selected >$i</option>";
	}
	else
	{
	       echo "<option value=$i>$i</option>";
	} 
}
?>
</select>
<select name="penal_month">
<?php
$j=date('m');
for($i=1;$i<=12;$i++)
{
     //  if($i<10)
	//{
	  //$i='0'.$i;
	//}
	if($dd[1]=='' || $dd[1]=='0')
	{
	  $q=$j;
	}
	else
	{
	 $q=$dd[1];
	}
	$sel='';
	if($q==$i)
	{
	 $sel='selected';
	 echo "<option value=$i $sel>$i</option>";
	}
	else
	{
	  echo "<option value=$i>$i</option>";
	} 
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
	{
	   $sel='selected';
	   echo "<option value=$i $sel >$i</option>";
	}
	else
	{
	  echo "<option value=$i>$i</option>";
	} 
}
?>
</select></td><td >&nbsp;Time</td>
<td width='40%'>
<select name="penal_hr">
  <?php
    $ddm=explode("-",$cvv['time']);
    for($i=1;$i<=12;$i++)
  {
        if($i<10)
	{
	  $i='0'.$i;
	}
	if($ddm[0]=='' || $ddm[0]=='0')
	{
	  $p=$i;
	}
	else
	{
	  $p=$ddm[0];
	}
	
	if($p==$i)
	{
	       echo "<option value='$i' selected >$i</option>";
	}
	else
	{
	       echo "<option value=$i>$i</option>";
	} 
 }
  
?>
</select>
<select name="penal_sec">
<?php

 for($i=1;$i<=59;$i++)
{
        if($i<10)
	{
	  $i='0'.$i;
	}
	if($ddm[1]=='' || $ddm[1]=='0')
	{
	  $qq=$i;
	}
	else
	{
	  $qq=$ddm[1];
	}
	$sel='';
	if($qq==$i)
	{
	 $sel='selected';
	 echo "<option value=$i $sel>$i</option>";
	}
	else
	{
	  echo "<option value=$i>$i</option>";
	} 
}
?>
</select>
<select name='ams'>
<?php
if($ddm[2]=="AM")
{
	$sj="selected";
	$sk="";
}
if($ddm[2]=="PM")
{
	$sk="selected";
	$sj="";
}
?>
<option value="AM" <?php echo $sj?>>AM</option>
<option value="PM" <?php echo $sk?>>PM</option>
</select>
</td>
				</tr>
				<tr>
					<td class="keycell" >&nbsp;Complaints </td>
					<td colSpan="3">
					<textarea name="txtPresenting" rows="4" cols="60"><?php echo $cvv[complaints]?></textarea>
					</td>
				</tr>
			
				<tr>
					<td class="keycell" >&nbsp;Treatment </td>
					<td colSpan="3">
					<textarea name="txtTreatment" rows="4" cols="60"><?php echo $cvv[treatment]?></textarea>
					</td>
				</tr>
				<tr>
					<td class="keycell">Remarks</td>
					<td colSpan="3">
					<textarea name="txtRecommendations" rows="4" cols="60"><?php echo $cvv[remarks]?></textarea>
					</td>
				</tr>
				
				<?php
				       if(isset($subn))
				       {
				          $ddate=$penal_year."-".$penal_month."-".$penal_day;
				          $timr=$penal_hr."-".$penal_sec."-".$ams;
					 $av=execute("select * from doc_other where name='$grades'");
					 $avv=fetcharray($av);
				         $ids=$avv['id'];
					 $ra=execute("update doc_other set name='$grades',slno='$ide',designation='$des',doc_name='$grade',d_date='".$ddate."',time='$timr',complaints='$txtPresenting',treatment='$txtTreatment',remarks='$txtRecommendations' where id='$ids'");
				         //echo "Modified Successfully";
						 
						 ?>
						 <script language="JavaScript" type="text/javascript">
						 alert("Modified Successfully");
                         </script>
						 <?php
	                              }
				?>
                </table>
                <br>
                <center>
		<div>
			<input type=submit name='gob' value='Go Back' class='bgbutton' onclick='cli()'>
			<input type=submit name='subn' value='Modify' class='bgbutton'>
			</div>
            </center>
	</form>

</body>

</html>
