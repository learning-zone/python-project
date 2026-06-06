<html>
<?php
   include("../db.php");
$staf=$_REQUEST['staf'];
$stafd=$_REQUEST['stafd'];  
$stud =$_REQUEST['stud'];
$gen =$_REQUEST['gen'];
$aa =$_REQUEST['aa'];
$staff_id=$_REQUEST['staff_id'];
$doct = $_POST['doct'];
$cmbSeen = $_POST['cmbSeen'];
$penal_day = $_POST['penal_day'];
$penal_month = $_POST['penal_month'];
$penal_year = $_POST['penal_year'];
$penal_hr = $_POST['penal_hr'];
$penal_sec = $_POST['penal_sec'];
$ams = $_POST['ams'];
$txtPresenting = $_POST['txtPresenting'];
$txtTreatment = $_POST['txtTreatment'];
$txtRecommendations = $_POST['txtRecommendations'];
$additional_info1 = $_POST['additional_info1'];
$additional_info2 = $_POST['additional_info2'];
$additional_info3 = $_POST['additional_info3'];
$emergency_name = $_POST['emergency_name'];
$emergency_no = $_POST['emergency_no'];
$sel=$_POST['sel'];
$type=$_POST['type'];
//print_r($_REQUEST);
$gob = $_POST['gob'];
$fn = $_POST['fn'];

?>
<head>
<script>
function reload2()
{
	if(document.frmMedicaldetail.type.value=='yes')
	{
		document.frmMedicaldetail.action='daily_staff_next.php';
		//document.frmMedicaldetail.submit();
	}
}
function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}
      function reload()
     {
        document.frmMedicaldetail.action='daily_sick_staffs.php';
	document.frmMedicaldetail.submit();
     }
</script>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Sick Report</title>
</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>

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
function reload()
{
    document.frmMedicaldetail.action="daily_staff_next.php";
    document.frmMedicaldetail.submit();
}

function frmMedicaldetail_submit()
{
	/*
	if (trim(document.frmMedicaldetail.cmbSeen.value)== "")
	{
		window.alert("Please Select Doctor Name");
		document.frmMedicaldetail.cmbSeen.focus();
		return false;
	}*/
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
                        <form name="frmMedicaldetail" method="post" action='daily_staff_next.php'>
			<input type=hidden name='gen' value='<?php echo $gen?>'>
			<input type=hidden name='stud' value='<?php echo $stud?>'>
			<input type=hidden name='staf' value='<?php echo $staf?>'>
			<input type=hidden name='aa' value='<?php echo $aa?>'>
			<input type=hidden name='stafd' value='<?php echo $stafd?>'>
            <input type=hidden name='staff_id' value='<?php echo $staff_id?>'>
            
			<table class="formtable" width="70%" id="table2" align=center>
			<tr>
             <?php
					
					 $cr22=fetcharray(execute("select * from staff_det where id='$stud'"));
				   //$rtt1=fetcharray($cr22);
				   
				   	?>
			<td vAlign="top" align="Center" height="30" colspan=5 class=head>
			Staff Daily Treatment Form For  - <?php echo $stud?></td>
			
		</tr>
         <tr height="25"><td class="submenu" colspan="4" nowrap>

<div id=123A style="float: left; text-align: left;"><b> </b></div>

<div id=123B style="float: right; text-align: right;">

<a href="javascript:OpenWind2('staff_medical_info.php?staff_id=<?=$staff_id?>')" >
<input type="hidden" name="tempiddet" value="<?=$id?>">

<input type="button" class="bgbutton" value="View medical information">

</a></div></td></tr>
				        
				<tr class="keyrow">
				<td width="25%">&nbsp;Sex</td>
					<td width="25%" ><?php echo $gen?></td>
					<td width="25%">&nbsp;Designation</td>
					<td width="25%" >
					<?php
					     $ggt=execute("select * from staff_des where d_id='$stafd'");
					     $g=fetcharray($ggt);
					
					?>
					<?php echo $g[d_name]?></td>
				</tr>
				        
			                
					
					        <tr vAlign="top" align="left">
					        <td class="keycell" >&nbsp;Seen By</td>
					        <td class="keycell" colSpan="3" >					        
					        <input type=text name="doct">
				                </td>
				                </tr>
				<?php
				   
				?>
				<tr>
				<td >Select Date</td>
				<td width='50%' colspan="3">
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

</td></tr>
<td width='50%' nowrap>&nbsp;Time In</td>
<td><select name="penal_hr">
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
for($i='0';$i<=59;$i++)
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
<td  width='10%'>&nbsp;Time Out</td>
<td nowrap><select name="penal_hr1">
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
<select name="penal_sec1">
<?php
for($i='0';$i<=59;$i++)
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
<select name='ams1'>
<option>AM</option>
<option>PM</option>
</select>
</td>

			</tr>
				<tr>
					<td class="keycell" >&nbsp;Complaints </td>
					<td colSpan="3">
				    <textarea name="txtPresenting" rows="4" cols="60"></textarea>
					</td>
				</tr>
			
				<tr>
					<td class="keycell" >&nbsp;Treatment </td>
					<td colSpan="3">
					<textarea name="txtTreatment" rows="4" cols="60"></textarea>
					</td>
				</tr>
                         
            
                
				<tr>
					<td class="keycell" width="60%">&nbsp;Remarks</td>
					<td colSpan="3">
					<textarea name="txtRecommendations" rows="4" cols="60"></textarea>
					</td>
				</tr>  
                <tr>
        <td>&nbsp;Staff sent to hospital?</td>
        <td colspan="3">
       <input type="radio" name="type"  value="yes" onChange="reload2()">Yes
         
          <input type="radio" name="type"  value="no" onChange="reload2()">No
          <input type="radio" name="type"  value="none" onChange="reload2()">None
          </td>
      </tr>	             
        
</table>				
				<?php
				     if(isset($gob))
				     {
				       $penaly=$_POST['penal_year'];
				       $penalm=$_POST['penal_month'];
				       $penald=$_POST['penal_day'];
				       $ddv=$penaly."-".$penalm."-".$penald;
				       $ti=$_POST['penal_hr'];
				       $tim=$_POST['penal_sec'];
				       $tims=$_POST['ams'];
				       $timr=$ti."-".$tim."-".$tims;
					    $ti1=$_POST['penal_hr1'];
				       $tim1=$_POST['penal_sec1'];
				       $tims1=$_POST['ams1'];
				       $timr1=$ti1."-".$tim1."-".$tims1;
				        $doc_name = $_POST['doc_name'];
					   $hospital_name = $_POST['hospital_name'];
						$penal_hr2 = $_POST['penal_hr2'];
						$penal_sec2 = $_POST['penal_sec2'];
						$ams2 = $_POST['ams2'];
						$penal_hr3 = $_POST['penal_hr3'];
						$penal_sec3 = $_POST['penal_sec3'];
						$ams3 = $_POST['ams3'];
						$ti2=$_POST['penal_hr2'];
						$tim2=$_POST['penal_sec2'];
						$tims2=$_POST['ams2'];
						$time_in=$ti2."-".$tim2."-".$tims2;
						$ti3=$_POST['penal_hr3'];
						$tim3=$_POST['penal_sec3'];
						$tims3=$_POST['ams3'];
						$time_out=$ti3."-".$tim3."-".$tims3;
						$diagnosis = $_POST['diagnosis'];
						$treatment = $_POST['treatment'];
						$report = $_POST['report'];
						$returned = $_POST['returned'];
						$picked=$_POST['picked'];
						$hosp=$_POST['hosp'];
						$type=$_POST['type'];
				       $c=execute("select * from doc_staff where slno='$aa' and d_date='$ddv' and staff_id='$stud'");
				      if($cmbSeen=='0' || $cmbSeen=='')
				      {
				       $dr=$doct;
				      } 
				      else
				      {
				       $dr=$cmbSeen;
				      }
				       if(rowcount($c)==0)
				       {
						
				         $gj=execute("insert into doc_staff(sex,doc_name,d_date,time,complaints,treatment,remarks,slno,group_id,des_id,additional_info1,additional_info2,additional_info3,emergency_name,emergency_no,staff_id,time_1,type)values('$gen','$dr','$ddv','$timr','".addslashes($txtPresenting)."','".addslashes($txtTreatment)."','".addslashes($txtRecommendations)."','$aa','$staf','$stafd','$additional_info1','$additional_info2','$additional_info3','$emergency_name','$emergency_no','$stud','$timr1','$type')");
						  $c=execute("select * from doc_staff where staff_id='$stud' and d_date='$ddv'");
					   while($c_qry=fetcharray($c))
					   {
						   $doc_detail_id=$c_qry['id'];
						   //$type=$c_qry['type'];
					   }
						 
						 $query="INSERT INTO `staff_hospital_det`(doc_name,treatment_date,time_in,time_out,diagnosis,treatment,report,returned,picked,doc_detail_id,hospital_name)values('$doc_name','$treatment_date','$time_in','$time_out','$diagnosis','$treatment','$report','$returned','$picked','$doc_detail_id','$hosp')";


   $result=execute($query);
						 if(is_array($sel))

	{

		 while( list(,$value)=each($sel))

		 {

			 $ce= $value;

			  $var12="insert into staff_health(dname,status,staff_id) values ('$ce',1,'$stud')";

			 execute($var12) or die(mysql_error()."a2");

		 }

	}						 
						 
						 
					 //echo "STAFF SICK REPORT INSERTED SUCESSFULLY";
					 ?>
					 <script language="JavaScript" type="text/javascript">
					 alert("STAFF SICK REPORT INSERTED SUCESSFULLY");
                     </script>
					 <?php
				       }
				       else
				       {
				         //echo "Data Entered for the Selected Student Id";
						 ?>
					 <script language="JavaScript" type="text/javascript">
					 alert("Data Entered for the Selected Student Id");
                     </script>
					 <?php
					 die();
				       }
				     }
				
				?>
		</table><br>
       <!-- <table class='forumline' cellspacing=0 width="70%" id="table2" align=center>
			<tr>
			<td vAlign="top" align="Center" colspan=5 class=head> Diagnosis in  Hospital
            </td>
			
		</tr>
        <tr vAlign="top" align="left">
								<td class="keycell" >&nbsp;Hospital Name</td>
								<td>&nbsp;&nbsp;
	<select name="hosp">
	<option value='0' >Select</option>
	 <?php
	 	$sql2="select * from hospital_tab";
	 	$rs2=execute($sql2) or die(error_description());
	 	for($i=0;$i<rowcount($rs2);$i++)
	 	{
	 		$r2=fetchrow($rs2);
	  		if($hosp==$r2[0])
	 		{
				?>
	 			<option value="<?php echo $r2[0]?>" selected><?php echo $r2[1]?></option>
				<?php
	 		}
	 		else
	 		{
				?>
	 			<option value="<?php echo $r2[0]?>"><?php echo $r2[1]?></option>
				<?php
	 		}
			
	 	}
	 ?>
        </select>	
        <a href= "javascript:OpenWind2('add_hospital.php?hospital')">

<input type="button" align="center" class="bgbutton" value="Add"></a>  </td>
<td></td>
<td></td>
				            </tr>
<tr vAlign="top" align="left">
								<td class="keycell" >&nbsp;Doctor's Name</td>
								<td class="keycell" colSpan="3">&nbsp;
								
								
								<input type=text name="doc_name">
				                </td>
				            </tr>
				<?php
				   
				?>
				
<tr>
<td  width='50%'>&nbsp;Time In</td>
<td><select name="penal_hr2">
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
<select name="penal_sec2">
<?php
for($i='0';$i<=59;$i++)
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
<select name='ams2'>
<option>AM</option>
<option>PM</option>
</select>
</td>
<td  width='20%'>&nbsp;Time Out</td>
<td><select name="penal_hr3">
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
<select name="penal_sec3">
<?php
for($i='0';$i<=59;$i++)
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
<select name='ams3'>
<option>AM</option>
<option>PM</option>
</select>
</td>

				
			</tr>
				<tr>
					
				</tr>
			<tr>
                <td class="keycell" >&nbsp;Diagnosis</td>
					<td colSpan="3"><textarea name="diagnosis" rows="4" cols="60"></textarea></td></tr>
				<tr>
					<td class="keycell">&nbsp;Treatment</td>
					<td colSpan="3">
					<textarea name="treatment" rows="4" cols="60"></textarea></td>
				</tr>
                
				<tr>
					<td class="keycell" >&nbsp;Report</td>
					<td colSpan="3">
					<textarea name="report" rows="4" cols="60"></textarea>
					</td>
				</tr>	
               
         <tr align="left">
								<td>&nbsp;Returned to?</td>
								   
        <td colspan="3">
       <input type="radio" name="returned" onChange="reload2()">School
         
          <input type="radio" name="returned" onChange="reload2()">Home
          </td>
				            </tr>
                            <tr>
					<td class="keycell" >&nbsp;Picked By</td>
					<td colSpan="3">
					<textarea name="picked" rows="4" cols="60"></textarea>
					</td>
				</tr>	
                            </table>-->
        <br>
        <center>	
		<div>
			<input type=submit name='subn' value='Go Back' class='bgbutton' onclick='reload()'>
			<input type=submit name='gob' value='Submit' class='bgbutton'>
			</div>
            </center>
	</form>

</body>

</html>
