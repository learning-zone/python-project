<html>
<?php
    include("../db.php");
	$staf=$_POST['staf'];
  $stafd=$_POST['stafd'];
  $staff_id=$_POST['staff_id'];
  
$stud = $_POST['stud'];
$fn = $_POST['fn'];
$gen = $_POST['gen'];
$staff_id=$_POST['staff_id'];
$doct = $_POST['doct'];
$penal_day = $_POST['penal_day'];
$penal_month = $_POST['penal_month'];
$penal_year = $_POST['penal_year'];
$penal_hr = $_POST['penal_hr'];
$penal_sec = $_POST['penal_sec'];
$ams = $_POST['ams'];
$penal_hr1 = $_POST['penal_hr1'];
$penal_sec1 = $_POST['penal_sec1'];
$ams1= $_POST['ams1'];
$txtPresenting = $_POST['txtPresenting'];
$txtTreatment = $_POST['txtTreatment'];
$txtRecommendations = $_POST['txtRecommendations'];
$subn = $_POST['subn'];
$additional_info1 = $_POST['additional_info1'];
$additional_info2 = $_POST['additional_info2'];
$additional_info3 = $_POST['additional_info3'];
$emergency_no= $_POST['emergency_no'];
$emergency_name= $_POST['emergency_name'];
$sel=$_POST['sel'];
$dts = $_POST['dts'];
$type12=$_POST['type12'];
?>
<head>
<script>
    function cli()
  {
     document.frmMedicaldetail.action='edit_staffs.php';
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
<title>New Page 1</title>
</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form name="frmMedicaldetail" method="post" action='edit_staff_next.php'>
<input type=hidden name='gen' value='<?php echo $gen?>'>
<input type=hidden name='stud' value='<?php echo $stud?>'>
<input type=hidden name='staf' value='<?php echo $staf?>'>
<input type=hidden name='aa' value='<?php echo $aa?>'>
<input type=hidden name='stafd' value='<?php echo $stafd?>'>
<input type=hidden name='dts' value='<?php echo $dts?>'>
<input type=hidden name='id' value='<?php echo $id?>'>
<input type=hidden name='staff_id' value='<?php echo $staff_id?>'>
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
function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

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

			<table class="formtable" width="70%" id="table2" align=center >
				
			<tr>
			<td vAlign="top" align="Center" height="30"  colspan=4 class=head>Edit Accident Report for - <?php echo $fn?></td>
			
		</tr>
         <tr height="25"><td class="submenu" colspan="4" nowrap>

<div id=123A style="float: left; text-align: left;"><b> </b></div>

<div id=123B style="float: right; text-align: right;">

<a href="javascript:OpenWind2('student_medical_info.php?staff_id=<?=$staff_id?>')" >
<input type="hidden" name="tempiddet" value="<?=$stud?>">

<input type="button" class="bgbutton" value="View medical information">

</a></div></td></tr>
		         <?php
				 //echo "select * from doc_staff where staff_id='$staff_id' and d_date='$dts' and slno='$stud'";
				 
                              $rfg=execute("select * from accident_report_staff where staff_id='$staff_id' and d_date='$dts' and slno='$stud'");
			      $fgb=fetcharray($rfg);

                         ?>
				<tr class="keyrow">
					<td width="16%" >&nbsp;Sex</td>
					<td width="33%" ><?php echo $gen?></td>
					<td width="14%" >&nbsp;Designation</td>
					<?php
					     $ggt=execute("select * from staff_des where d_id='$stafd'");
					     $g=fetcharray($ggt);
					
					?>
					<td width="37%" ><?php echo $g[d_name]?></td>
				</tr>
				
					<tr vAlign="top" align="left">
					<td class="keycell" >&nbsp;Seen By Others</td>
					<td class="keycell" colSpan="3">
					
					<input type=text name="doct" value='<?php echo $fgb[doc_name]?>'>
				</td>
				</tr>
				<tr vAlign="top" align="left">
				<td class="keycell" >&nbsp;Date</td>
					<td width="33%"><select name="penal_day">
<?php
$dd=explode("-",$fgb[d_date]);
$j=date('d');
for($i=1;$i<=31;$i++)
{
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
</select></td><td></td><td></td><tr>
<td  width='15%'>&nbsp;Time In</td>
<?php

     $dm=explode("-",$fgb['time']);

?>
<td nowrap><select name="penal_hr">
<?php
   for($il='1';$il<=12;$il++)
  {
	  if($il<10)
	{
	  $il='0'.$il;
	}
	if($dm[0]=='' || $dm[0]=='0')
	{
	  $p=$il;
	}
	else
	{
	  $p=$dm[0];
	}
	if($p==$il)
	{
			       echo "<option value='$il' selected >$il</option>";
	}
	else
	{
	       echo "<option value=$il>$il</option>";

	} 

 }

?>

</select>
<select name="penal_sec">
<?php
for($is1=0;$is1<=59;$is1++)
{        if($is1<10)
	{
	  $is1='0'.$is1;
	}
	if($dm[1]=='' || $dm[1]=='0')
	{  

	  $qq=$is1;
	}
	else
	{
	  $qq=$dm[1];
	}
	$sel='';
	if($is1>59)
	{
		$is1=='0';
	}
	if($qq==$is1)
	{
	 $sel='selected';
	 echo "<option value='$is1' $sel>$is1</option>";
	}
	else
	{
	  echo "<option value='$is1'>$is1</option>";
	} 
}
?>

</select>

<select name='ams'>

<?php

if($dm[2]=="AM")

{

	$sj="selected";

	$sk="";

}

if($dm[2]=="PM")

{

	$sk="selected";

	$sj="";

}

?>

<option value="AM" <?php echo $sj?>>AM</option>

<option value="PM" <?php echo $sk?>>PM</option>

</select>
</td>
<td  width='15%'>&nbsp;Time Out</td>
<?php

     $dm1=explode("-",$fgb['time_1']);

?>
<td nowrap><select name="penal_hr1">
<?php
   for($i2='0';$i2<=12;$i2++)
  {
	  if($i2<10)
	{
	  $i2='0'.$i2;
	}
	if($dm1[0]=='' || $dm1[0]=='0')
	{
	  $p1=$i2;
	}
	else
	{
	  $p1=$dm1[0];
	}
	if($p1==$i2)
	{
			       echo "<option value='$i2' selected >$i2</option>";
	}
	else
	{
	       echo "<option value=$i2>$i2</option>";

	} 

 }

?>

</select>
<select name="penal_sec1">
<?php
for($is2=1;$is2<=59;$is2++)
{        if($is2<10)
	{
	  $i21='0'.$is2;
	}
	if($dm1[1]=='' || $dm1[1]=='0')
	{  

	  $qq1=$is2;
	}
	else
	{
	  $qq1=$dm1[1];
	}
	$sel='';
	if($qq1==$is2)
	{
	 $sel='selected';
	 echo "<option value='$is2' $sel>$is2</option>";
	}
	else
	{
	  echo "<option value='$is2'>$is2</option>";
	} 
}
?>

</select>

<select name='ams1'>

<?php

if($dm1[2]=="AM")

{

	$sj1="selected";

	$sk1="";

}

if($dm1[2]=="PM")

{

	$sk1="selected";

	$sj1="";

}

?>

<option value="AM" <?php echo $sj1?>>AM</option>

<option value="PM" <?php echo $sk1?>>PM</option>

</select>
</td>
				
			</tr>
				<tr>
					<td class="keycell" >&nbsp;Complaints</td>
					<td colSpan="3">
					<textarea name="txtPresenting" rows="4" cols="60"><?php echo $fgb[complaints]?></textarea>
					</td>
				</tr>
			
				<tr>
					<td class="keycell">&nbsp;Treatment</td>
					<td colSpan="3">
					<textarea name="txtTreatment" rows="4" cols="60"><?php echo $fgb[treatment]?></textarea></td>
				</tr>
				<tr>
					<td class="keycell" >&nbsp;Remarks</td>
					<td colSpan="3">
					<textarea name="txtRecommendations" rows="4" cols="60"><?php echo $fgb[remarks]?></textarea>
					</td>
                     <tr>
        
      </tr>	          
				</tr>
                <?php
 if($fgb[type]=='yes')
  $check='checked';
  else if($fgb[type]=='no')
  $check1='checked';
  else 
  $check2='checked';
  ?>
                         <tr>
        <td>&nbsp;Staff sent to hospital?</td>
        <td colspan="3">
        <input type="radio"  name="type12" value="yes" <?=$check?>>Yes
         
          <input type="radio"  name="type12" value="no" <?=$check1?>>No
          <input type="radio"  name="type12" value="none" <?=$check2?>>None
      
          </td>
      </tr>	
     		</table><br>
        
        <!-- <table class='forumline' cellspacing=0 width="70%" id="table2" align=center>
			<tr>
			<td vAlign="top" align="Center" colspan=5 class=head> Diagnosis in  Hospital
            </td>
            
			<?php
//echo "select * from staff_hospital_det where doc_detail_id=$fgb[id]";
$dcv3=execute("select * from staff_hospital_det where doc_detail_id=$fgb[id]");
$qry=fetcharray($dcv3);
?>
		</tr>
         <tr vAlign="top" align="left">
								<td class="keycell" >&nbsp;Hospital Name</td>
								<td class="keycell" colSpan="3">&nbsp;
								<?php
								
								$qry123=execute("select hospital_name from hospital_tab where id=$qry[hospital_name]");
								while($qw=fetcharray($qry123))
								{
									$hospital_name=$qw['hospital_name'];
								}
								?>
								
								<?=$hospital_name?>
				                </td>
				            </tr>
<tr vAlign="top" align="left">
								<td class="keycell" >&nbsp;Doctor's Name</td>
								<td class="keycell" colSpan="3">&nbsp;
								
								
								<input type=text name="doc_name" value='<?php echo $qry[doc_name]?>'>
				                </td>
				            </tr>
				<?php
				   
				?>
				
<tr>
<td  width='15%'>&nbsp;Time In</td>
<?php

     $dm3=explode("-",$qry[time_in]);

?>
<td nowrap><select name="penal_hr2">
<?php
   for($i3='0';$i3<=12;$i3++)
  {
	  if($i3<10)
	{
	  $i3='0'.$i3;
	}
	if($dm3[0]=='' || $dm3[0]=='0')
	{
	  $p3=$i3;
	}
	else
	{
	  $p3=$dm3[0];
	}
	if($p3==$i3)
	{
			       echo "<option value='$i3' selected >$i3</option>";
	}
	else
	{
	       echo "<option value=$i3>$i3</option>";

	} 

 }

?>

</select>
<select name="penal_sec2">
<?php
for($is3=0;$is3<=59;$is3++)
{        if($is3<10)
	{
	  $is3='0'.$is3;
	}
	if($dm3[1]=='' || $dm3[1]=='0')
	{  

	  $qq3=$is3;
	}
	else
	{
	  $qq3=$dm3[1];
	}
	$sel='';
	if($qq3==$is3)
	{
	 $sel='selected';
	 echo "<option value='$is3' $sel>$is3</option>";
	}
	else
	{
	  echo "<option value='$is3'>$is3</option>";
	} 
}
?>

</select>

<select name='ams2'>

<?php

if($dm3[2]=="AM")

{

	$sj3="selected";

	$sk3="";

}

if($dm3[2]=="PM")

{

	$sk3="selected";

	$sj3="";

}

?>

<option value="AM" <?php echo $sj3?>>AM</option>

<option value="PM" <?php echo $sk3?>>PM</option>

</select>
</td>
<td  width='15%'>&nbsp;Time Out</td>
<?php

     $dm5=explode("-",$qry[time_out]);

?>
<td nowrap><select name="penal_hr3">
<?php
   for($i5='0';$i5<=12;$i5++)
  {
	  if($i5<10)
	{
	  $i5='0'.$i5;
	}
	if($dm5[0]=='' || $dm5[0]=='0')
	{
	  $p5=$i5;
	}
	else
	{
	  $p5=$dm5[0];
	}
	if($p5==$i5)
	{
			       echo "<option value='$i5' selected >$i5</option>";
	}
	else
	{
	       echo "<option value=$i5>$i5</option>";

	} 

 }

?>

</select>
<select name="penal_sec3">
<?php
for($is5=0;$is5<=59;$is5++)
{        if($is5<10)
	{
	  $is5='0'.$is5;
	}
	if($dm5[1]=='' || $dm5[1]=='0')
	{  

	  $qq5=$is5;
	}
	else
	{
	  $qq5=$dm5[1];
	}
	$sel='';
	if($qq5==$is5)
	{
	 $sel='selected';
	 echo "<option value='$is5' $sel>$is5</option>";
	}
	else
	{
	  echo "<option value='$is5'>$is5</option>";
	} 
}
?>

</select>

<select name='ams3'>

<?php

if($dm5[2]=="AM")

{

	$sj5="selected";

	$sk5="";

}

if($dm5[2]=="PM")

{

	$sk5="selected";

	$sj5="";

}

?>

<option value="AM" <?php echo $sj5?>>AM</option>

<option value="PM" <?php echo $sk5?>>PM</option>

</select>
</td>

				
			</tr>
				<tr>
					
				</tr>
			<tr>
                <td class="keycell" >&nbsp;Diagnosis</td>
					<td colSpan="3"><textarea name="diagnosis" rows="4" cols="60"><?=$qry[diagnosis]?></textarea></td></tr>
				<tr>
					<td class="keycell">&nbsp;Treatment</td>
					<td colSpan="3">
					<textarea name="treatment" rows="4" cols="60" ><?=$qry[treatment]?></textarea></td>
				</tr>
                
				<tr>
					<td class="keycell" >&nbsp;Report</td>
					<td colSpan="3">
					<textarea name="report" rows="4" cols="60"><?=$qry[report]?></textarea>
					</td>
				</tr>	
               
          <?php
  if($qry[returned]=='yes')
  $check='checked';
  else
  $check1='checked';
  ?>
                         <tr>
        <td>&nbsp;Returned to school?</td>
        <td colspan="3">
        <input type="radio"  name="returned" value="yes" <?=$check?>>School
         
          <input type="radio"  name="returned" value="no" <?=$check1?>>Home
      
          </td>
				            </tr>
                            <tr>
					<td class="keycell" >&nbsp;Picked By</td>
					<td colSpan="3">
					<textarea name="picked" rows="4" cols="60"><?=$qry[picked]?></textarea>
					</td>
				</tr>	
                            </table>
               
				
				<?php
				     if(isset($subn))
				     {
				      $penal=$penal_year."-".$penal_month."-".$penal_day;
				      $timr=$penal_hr."-".$penal_sec."-".$ams;
					
				      $timr1=$penal_hr1."-".$penal_sec1."-".$ams1;
		
						$timr2=$penal_hr2."-".$penal_sec2."-".$ams2;
						$timr3=$penal_hr3."-".$penal_sec3."-".$ams3;
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
						$type12=$_POST['type12'];
				     // echo "update doc_staff set doc_name='$doct',d_date='$penal',time='$timr',complaints='$txtPresenting',treatment='$txtTreatment',remarks='$txtRecommendations',additional_info1='$additional_info1',additional_info2='$additional_info2',additional_info3='$additional_info3',emergency_name='$emergency_name',emergency_no='$emergency_no',time_1='$timr1' where id='$fgb[id]'";
					 
				      $upd=execute("update accident_report_staff set doc_name='$doct',d_date='$penal',time='$timr',complaints='$txtPresenting',treatment='$txtTreatment',remarks='$txtRecommendations',additional_info1='$additional_info1',additional_info2='$additional_info2',additional_info3='$additional_info3',emergency_name='$emergency_name',emergency_no='$emergency_no',time_1='$timr1',type='$type12' where id='$fgb[id]'")
					  ;
					
					   $sql_fetch_sports=execute("select * from staff_hospital_det where `doc_detail_id`='$fgb[id]'");
					  if(rowcount($sql_fetch_sports)!=0)
		 {
					  $gj1=execute("update staff_hospital_det set doc_name='{$doc_name}',time_in='".addslashes($timr2)."',time_out='".addslashes($timr3)."',diagnosis='".addslashes($diagnosis)."',treatment='".addslashes($treatment)."',report='".addslashes($report)."',returned='$returned',picked='".addslashes($picked)."' where doc_detail_id='$fgb[id]'");
		 }
		 else
		 {
			 
			 $query=execute("INSERT INTO `staff_hospital_det`(doc_name,treatment_date,time_in,time_out,diagnosis,treatment,report,returned,picked,doc_detail_id,hospital_name)values('$doc_name','$treatment_date','$time_in','$time_out','$diagnosis','$treatment','$report','$returned','$picked','$fgb[id]','$hosp')");
				      
		 }//echo "Modified Successfully";
					 ?>
<script language="JavaScript" type="text/javascript">
alert("Modified Successfully");
</script>
<?php
 
				     }
				
				?>
</table>-->
<br>			
		<div>
        <center>
			<input type=submit name='gob' value='Go Back' class='bgbutton' onclick='cli()'>
			<input type=submit name='subn' value='Modify' class='bgbutton'>
            </center>
			</div>
	</form>


</body>

</html>
