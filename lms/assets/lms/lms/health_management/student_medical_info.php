<?php
	include("../db.php");
	$student_id=$_REQUEST['student_id'];
	$store_stud=$_REQUEST['store_stud'];
	$staf=$_REQUEST['staf'];
	$stafd=$_REQUEST['stafd'];  
	$stud =$_REQUEST['stud'];
	$gen =$_REQUEST['gen'];
	$aa =$_REQUEST['aa'];
	$staff_id=$_REQUEST['staff_id'];
	$additional_info1 = $_POST['additional_info1'];
	$additional_info2 = $_POST['additional_info2'];
	$additional_info3 = $_POST['additional_info3'];
	$additional_info4 = $_POST['additional_info4'];
	$additional_info5 = $_POST['additional_info5'];
	$hospital_name = $_POST['hospital_name'];
	$contact_no = $_POST['contact_no'];
	$sel=$_POST['sel'];
	//print_r($_REQUEST);
	$type1=$_POST['type1'];
	$type2=$_POST['type2'];
	$type3=$_POST['type3'];
	$type4=$_POST['type4'];
	$type5=$_POST['type5'];
	$gob = $_POST['gob'];
	$check=$_POST['check'];
	
	//print_r($_POST);

?>
<html>
<head>
<script>
      function reload()
     {
        document.frmMedicaldetail.action='sick_staffs.php';
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
    document.frmMedicaldetail.action="staff_studs.php";
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
                        <form name="frmMedicaldetail" method="post" action='student_medical_info.php'>
			<input type=hidden name='gen' value='<?php echo $gen?>'>
			<input type=hidden name='stud' value='<?php echo $stud?>'>
			<input type=hidden name='staf' value='<?php echo $staf?>'>
			<input type=hidden name='aa' value='<?php echo $aa?>'>
			<input type=hidden name='stafd' value='<?php echo $stafd?>'>
            <input type=hidden name='student_id' value='<?php echo $student_id?>'>
            
			<table class="formtable" width="80%" id="table2" align=center>
			<tr>
			<td vAlign="top" align="Center" height="30" colspan=5 class=head>
			Student Medical Details</td>
			
		</tr>
				        
				
					<td width="25%" >
					<?php
					     $ggt=execute("select * from staff_des where d_id='$stafd'");
					     $g=fetcharray($ggt);
					
					?>
                    <?php
					
				        $rfg=execute("select * from doc_student where student_id='$student_id'");
			             $fgb=fetcharray($rfg);

                         ?>
					<?php echo $g[d_name]?></td>
                    <td></td>
				</tr>
				        
			                
					
					        
                
                 <tr vAlign="top" align="left">
					        <td class="keycell" nowrap>&nbsp;Which hospital/clinic does your family use in Pune?</td>
					        <td class="keycell" colSpan="3" align="center">					        
					        <input type=text name="hospital_name" value='<?php echo $fgb[hospital_name]?>'>
				                </td>
				                </tr>
                 <tr vAlign="top" align="left">
                        <td class="keycell" >&nbsp;Contact Number</td>
                        <td class="keycell" colSpan="3" align="center">					        
                        <input type=text name="contact_no" value='<?php echo $fgb[contact_no]?>'>
                            </td>
                            </tr>  
                          
<tr>

	   <td class="keycell" colSpan="3">&nbsp;Medical History&nbsp;:

   <?php

$count=1;

$testvat=execute("select dname from student_health where student_id='$student_id' and status=1");
while($testvat1=fetcharray($testvat))
{
$teschwck=fetcharray(execute("select * from student_med_frm where id='$testvat1[0]' order by id"));
 
		?>
     

		&nbsp;&nbsp;<?=$teschwck[dname]?>,

		<?php

}

?>
</td>

</table>

</td>

</tr>

</table></td></tr>

<tr><td>

<table border='0' align='center' width='80%' class='forumline' >

<tr>

   <td  class="keycell">Allergy Information:</td>

	<td align="right">

		<textarea rows="4" cols="60" align="right" name='additional_info1'><?=$fgb[additional_info1]?></textarea> 

	</td>

</tr>

</table>
<table border='0' align='center' width='80%' class='forumline' >

<tr>

   <td  class="keycell">&nbsp;Any regular medication?

</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info2' align="right"><?=$fgb[additional_info2]?></textarea> 

	</td>

</tr>

</table>

<table border='0' align='center' width='80%' class='forumline' >

<tr>

   <td  class="keycell">&nbsp;Any surgery undergone: 
</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info3' align="right"><?=$fgb[additional_info3]?></textarea> 

	</td>

</tr>
</table>
<table border='0' align='center' width='80%' class='forumline' >

<tr>

   <td  class="keycell">&nbsp;Any basic immunization/vaccination:
</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info4' align="right"><?=$fgb[additional_info4]?></textarea> 

	</td>

</tr>
</table>
<table border='0' align='center' width='80%' class='forumline' >
<tr>

   <td  class="keycell">&nbsp;If any special instruction: 
</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info5'><?=$fgb[additional_info5]?></textarea> 

	</td>

</tr>
</table>
<table border='0' align='center' width='80%' class='forumline' >
<tr><td  class="keycell" colspan="2" align="justify">&nbsp;
CONSENT:The medical room is run by the school nurse and offers care to children with minor injuries and illnesses.All the medicines kept in the medical room are generic medicines and does not have any side effect.In case your child needs treatment during school hours would you be happy for your child to</td></tr>
</table>
<table width="80%" border="1" align="center">

  <tr>
    <td>&nbsp;To have cuts and grazes cleaned and dressed</td>
     <?php
  if($fgb[type1]=='yes')
  $check='checked';
  else
  $check1='checked';
  ?>
    <td nowrap>&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?> disabled>Yes
         </td>
    <td nowrap>&nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td>
  </tr>
  <tr>
    <td>&nbsp;Be given tablets like Paracetamol, lozenges, cough medicines etc</td>
    <?php
  if($fgb[type2]=='yes')
  $check2='checked';
  else
  $check3='checked';
  ?>
    <td>&nbsp;<input type="radio" name="type2"  value="yes" <?=$check2?>>Yes</td>
    <td>&nbsp;<input type="radio" name="type2"  value="no" <?=$check3?>>No</td>
  </tr>
  <tr>
    <td>&nbsp;Application of eye and ear drops</td>
     <?php
  if($fgb[type3]=='yes')
  $check4='checked';
  else
  $check5='checked';
  ?>
    <td>&nbsp;<input type="radio" name="type3"  value="yes"  <?=$check4?>>Yes</td>
    <td>&nbsp;<input type="radio" name="type3"  value="no"  <?=$check5?>>No</td>
  </tr>
  <tr>
    <td>&nbsp;I herby give permission for emergency measure to be initiated in case of accident or sudden illness with the understanding that I will be notified as soon as possible.</td>
     <?php
  if($fgb[type4]=='yes')
  $check6='checked';
  else
  $check7='checked';
  ?>
    <td>&nbsp;<input type="radio" name="type4"  value="yes"  <?=$check6?>>Yes</td>
    <td>&nbsp;<input type="radio" name="type4"  value="no"  <?=$check7?>>No</td>
  </tr>
  <tr>
    <td>&nbsp;The nurse will endeavor to inform parents as soon as possible in the case of any serious illness. </td>
     <?php
  if($fgb[type5]=='yes')
  $check8='checked';
  else
  $check9='checked';
  ?>
    <td>&nbsp;<input type="radio" name="type5"  value="yes"  <?=$check8?>>Yes</td>
    <td>&nbsp;<input type="radio" name="type5"  value="no"  <?=$check9?>>No</td>
  </tr>
</table>				
				<?php
				     if($gob)
				     {
						 if(is_array($check))
	                     {
							while( list(,$value)=each($check))
							{

								 $ce= $value;
					
								 $var12="insert into student_health(dname,student_id,status,checked) values ('$ce','$student_id',1,1)";
					
								 execute($var12) or die(mysql_error()."a2");

		                        }

							}
						 
						 
						 
						$quer3=fetchrow(execute("select student_id FROM `doc_student` where student_id='$student_id'"));
                        if($quer3[0])
						{
							
				      
				           $upd=execute("update doc_student set additional_info1='$additional_info1',additional_info2='$additional_info2',additional_info3='$additional_info3',additional_info4='$additional_info4',additional_info5='$additional_info5',hospital_name='$hospital_name',contact_no='$contact_no',type1='$type1',type2='$type2',type3='$type3',type4='$type4',type5='$type5' where student_id='$student_id'");
						} 
						 
				       $penaly=$_POST['penal_year'];
				       $penalm=$_POST['penal_month'];
				       $penald=$_POST['penal_day'];
				       $ddv=$penaly."-".$penalm."-".$penald;
				       $ti=$_POST['penal_hr'];
				       $tim=$_POST['penal_sec'];
				       $tims=$_POST['ams'];
				       $timr=$ti."-".$tim."-".$tims;
				       $type1=$_POST['type1'];
					    $type2=$_POST['type2'];
						$type3=$_POST['type3'];
						$type4=$_POST['type4'];
						$type5=$_POST['type5'];
	 if(is_array($check))
	{

		 while( list(,$value)=each($check))

		 {

			 $ce= $value;
			 echo "insert into student_health(dname,student_id,status) values ('$ce','$student_id',1)";

			 $var12="insert into student_health(dname,student_id,status) values ('$ce','$student_id',1)";

			 execute($var12) or die(mysql_error()."a2");

		 }

	}
						   $quer13=fetchrow(execute("select student_id FROM `student_health` where student_id='$student_id'"));
                        if($quer13[0])
						{
							$upd=execute("update student_health set dname='$check',additional_info2='$additional_info2',additional_info3='$additional_info3',additional_info4='$additional_info4',additional_info5='$additional_info5',hospital_name='$hospital_name',contact_no='$contact_no',type1='$type1',type2='$type2',type3='$type3',type4='$type4',type5='$type5' where student_id='$student_id'");
						} 
							
						  

	
						   
						   
				       $c=execute("select * from doc_student where student_id='$student_id'");
				     
				       if(rowcount($c)==0)
				       {
						//echo "insert into doc_student(hospital_name,contact_no,additional_info1,additional_info2,additional_info3,additional_info4,additional_info5,type1,type2,type3,type4,type5,student_id)values('$hospital_name','$contact_no','$additional_info1','$additional_info2','$additional_info3','$additional_info4','$additional_info5','$type1','$type2','$type3','$type4','$type5','$student_id')";  
						
				         $gj=execute("insert into doc_student(hospital_name,contact_no,additional_info1,additional_info2,additional_info3,additional_info4,additional_info5,type1,type2,type3,type4,type5,student_id)values('$hospital_name','$contact_no','$additional_info1','$additional_info2','$additional_info3','$additional_info4','$additional_info5','$type1','$type2','$type3','$type4','$type5','$student_id')");
						  
						
		 
		 
						 
						 
					 //echo "STAFF SICK REPORT INSERTED SUCESSFULLY";
					 ?>
					 <script language="JavaScript" type="text/javascript">
					 alert("INSERTED SUCESSFULLY");
                     </script>
					 <?php
				       }
				       else
				       {
						 
							while( list(,$value)=each($check))
							{

								 $ce= $value;
					
								echo $var1245="insert into student_health(dname,student_id,status,checked) values ('$ce','$student_id',1,1)";
					
								 execute($var1245) or die(mysql_error()."a2");

		                        }

						
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
		</table>
        <br>
        <center>	
		<!--<div>
			
			<input type=submit name='gob' value='Submit' class='bgbutton'>
			</div>-->
            </center>
	</form>

</body>

</html>
