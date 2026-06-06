<?php
	include("../db1.php");
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
        document.frmMedicaldetail.action='student_medical_info_p.php';
	document.frmMedicaldetail.submit();
     }
</script>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Sick Report</title>
</head>
<body onLoad="printReport()">
<p>&nbsp;</p>
<p>&nbsp;</p>

<SCRIPT language=javascript>
function printReport()
{
// prn.style.display="none";
 window.print();
}		
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
                        <form name="frmMedicaldetail" method="post" action='student_medical_info_p.php'>
			<input type=hidden name='gen' value='<?php echo $gen?>'>
			<input type=hidden name='stud' value='<?php echo $stud?>'>
			<input type=hidden name='staf' value='<?php echo $staf?>'>
			<input type=hidden name='aa' value='<?php echo $aa?>'>
			<input type=hidden name='stafd' value='<?php echo $stafd?>'>
            <input type=hidden name='student_id' value='<?php echo $student_id?>'>
            
			<table class="formtable" width="90%" id="table2" align=center>
            
            <tr height="50%">
            <?php
					$fetch_name=mysql_fetch_array(mysql_query("select first_name,last_name from student_m where id='$student_id'"));
					?>
              <td align='center' class='head' colspan="2" height="30%"><b><u>STUDENT MEDICAL DETAILS FOR  <?=strtoupper($fetch_name[first_name]." ".$fetch_name[last_name])?></u></b></td></tr>
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
					         <?php echo $fgb[hospital_name]?>
				                </td>
				                </tr>
                 <tr vAlign="top" align="left">
                        <td class="keycell" >&nbsp;Contact Number</td>
                        <td class="keycell" colSpan="3" align="center">					        
                        <?php echo $fgb[contact_no]?>
                            </td>
                            </tr> 
                            </table>  
   <table border='0' align='center' width='90%' class='forumline' >

<tr height="25">

   <td class="formtable" ><b><u>Medical History</u></b></td><td colspan="4"></td>

</tr>

<tr>

	<td><table border="0" width='100%' >

   <?php
   $count=1;

$sql=execute("select * from student_med_frm order by id") or die(mysql_error());

$numrows=rowcount($sql);

for($i=0;$i<rowcount($sql);$i++)

{

	$r1=fetcharray($sql,$i);

	$qry="select * from student_health where student_id='$student_id' and dname=$r1[id]";

	$t=execute($qry);
		$sel=$t['checked'];
	if(rowcount($t)>0)

		$sel="checked";

	else

		$sel="";

	if($doc_count ==0)

		echo "<tr>";

     if($doc_count <$numrows)

		 {

		if($count%5==0)

			echo "<tr>";

		?>

		<td valign='top' nowrap><input type="checkbox" name="check[]" value="<?=$r1["id"]?>" <?=$sel?> disabled>&nbsp;&nbsp;<?=$r1["dname"]?></td>

		<?php

		$doc_count=$doc_count+1;

		$count++;

	}

	else

	{

		$doc_count=0;

		echo "</tr>";

	}

}

if($doc_count !=0)

{

	echo "<td colspan=2></td></tr>";

}

?>


</table>

</td>

</tr>

</table></td></tr>

<tr><td>

<table border='0' align='center' width='90%' class='forumline' >

<tr>

   <td  class="keycell" width="60%">Allergy Information:</td>

	<td align="left">

		<?=$fgb[additional_info1]?>

	</td>

</tr>


<br>
<tr>

   <td  class="keycell" width="60%">&nbsp;Any regular medication

</td>

	<td align="left">

	<?=$fgb[additional_info2]?>
	</td>



<tr>

   <td  class="keycell" width="60%">&nbsp;Any surgery undergone: 
</td>

	<td align="left">

	<?=$fgb[additional_info3]?>

	</td>

</tr>


<tr>

   <td  class="keycell" width="60%" nowrap>&nbsp;Any basic immunization/vaccination:
</td>

	<td align="left">

		<?=$fgb[additional_info4]?></textarea>

	</td>

</tr>


<tr>

   <td  class="keycell" width="60%">&nbsp;If any special instruction: 
</td>

	<td align="left">

		<?=$fgb[additional_info5]?>

	</td>

</tr>
</table><br>
<table border='0' align='center' width='90%' class='forumline' >
<tr><td  class="keycell" colspan="2" align="justify">
CONSENT:The medical room is run by the school nurse and offers care to children with minor injuries and illnesses.All the medicines kept in the medical room are generic medicines and does not have any side effect.In case your child needs treatment during school hours would you be happy for your child to</td></tr>
</table><br>
<table width="80%" border="1" align="center">
  <tr>
    <td width="75%">&nbsp;To have cuts and grazes cleaned and dressed</td>
   <td> <?=strtoupper($fgb[type1])?></td>
  </tr>
  <tr>
    <td>&nbsp;Be given tablets like Paracetamol, lozenges, cough medicines etc</td>
  <td><?=strtoupper($fgb[type2])?></td>
  </tr>
  <tr>
    <td>&nbsp;Application of eye and ear drops</td>
    <td>&nbsp;<?=strtoupper($fgb[type3])?></td>
  </tr>
  <tr>
    <td>&nbsp;I herby give permission for emergency measure to be initiated in<br> case of accident or sudden illness with the understanding that<br> I will be notified as soon as possible.</td>     
    <td>&nbsp;<?=strtoupper($fgb[type4])?></td>
  </tr>
  <tr>
    <td>&nbsp;The nurse will endeavor to inform parents as soon as possible in the case of any serious illness. </td>
     
    <td>&nbsp;<?=strtoupper($fgb[type5])?></td>
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
								 $selsql = "SELECT * from student_health where student_id = '$student_id' and dname = '$ce' ";
					$rs = mysql_query($selsql);
					$num_row = mysql_num_rows($rs);
					if($num_row == 0)
					{
					
								 $var12="insert into student_health(dname,student_id,status,checked) values ('$ce','$student_id',1,1)";
					
								 mysql_query($var12) or die(mysql_error()."a2");

		                        }
							}

							}
						 
						 
						 
						$quer3=mysql_fetch_row(mysql_query("select student_id FROM `doc_student` where student_id='$student_id'"));
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
	/* if(is_array($check))
	{

		 while( list(,$value)=each($check))

		 {

			 $ce= $value;
			

			 $var12="insert into student_health(dname,student_id,status) values ('$ce','$student_id',1)";

			 mysql_query($var12) or die(mysql_error()."a2");

		 }

	}*/
						   $quer13=mysql_fetch_row(mysql_query("select student_id FROM `student_health` where student_id='$student_id'"));
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
						 
							/*while( list(,$value)=each($check))
							{

								 $ce= $value;
					
								echo $var1245="insert into student_health(dname,student_id,status,checked) values ('$ce','$student_id',1,1)";
					
								 mysql_query($var1245) or die(mysql_error()."a2");

		                        }*/
								$upsql = "Update student_health set status = '0' and checked = '0' where student_id = '$student_id'";
$usqlrs = mysql_query($upsql);
while( list(,$value)=each($check))
							{							
								 $ce= $value;
								
					$selsql = "SELECT * from student_health where student_id = '$student_id' and dname = '$ce' ";
					$rs = mysql_query($selsql);
					$num_row = mysql_num_rows($rs);
					if($num_row == 0)
					{
								$var1245="insert into student_health(dname,student_id,status,checked) values ('$ce','$student_id',1,1)";
					
								 mysql_query($var1245) or die(mysql_error()."a2");
					}
					else
					{
						 $upsql1 = "Update student_health set status = '1' and checked = '1' where student_id = '$student_id' and dname = '$ce'";
								 $rsusql1 = mysql_query($upsql1);						
					}

		                        }

						
				         //echo "Data Entered for the Selected Student Id";
						 ?>
					 <script language="JavaScript" type="text/javascript">
					 alert("Data Entered for the Selected Student Id");
                     </script>
					 <?php
					// die();
				       }
				     }
					   
				
				?>
                <br>
                <tr><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Signature of Parent / Guardian</u></td>
</tr>
		</table>
        <br>
        
      
	</form>

</body>

</html>
