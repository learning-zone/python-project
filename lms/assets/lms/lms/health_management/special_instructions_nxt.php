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
     
</script>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Sick Report</title>
</head>
<body>


<SCRIPT language=javascript>
function prn()

		{

			pr1.style.display = "none";

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
function reload()
{
    document.frmMedicaldetail.action="special_instructions_nxt.php";
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
	
		frmMedicaldetail.txhControl.value = "Submit";
	document.frmMedicaldetail.submit();
}	

function frmMedicaldetail_submit1()
  {
	frmMedicaldetail.txhControl.value = "Back";
	document.frmMedicaldetail.submit();
  }	

		</SCRIPT>
                        <form name="frmMedicaldetail" method="post" action='special_instructions_nxt.php'>
			<input type=hidden name='gen' value='<?php echo $gen?>'>
			<input type=hidden name='stud' value='<?php echo $stud?>'>
			<input type=hidden name='staf' value='<?php echo $staf?>'>
			<input type=hidden name='aa' value='<?php echo $aa?>'>
			<input type=hidden name='stafd' value='<?php echo $stafd?>'>
            <input type=hidden name='student_id' value='<?php echo $student_id?>'>
            <center><b><u>SPECIAL INSTRUCTIONS</u></b></center><br>
            
			<table class="formtable" width="80%" align=center cellpadding="0" cellspacing="0">
			
				 <tr>       
				
					<td>
					<?php
					     $ggt=execute("select * from staff_des where d_id='$stafd'");
					     $g=fetcharray($ggt);
					
					?>
                    <?php
					//echo "select * from doc_student where student_id='$student_id'";
				        $rfg=execute("select * from doc_student where student_id='$student_id'");
			             $fgb=fetcharray($rfg);

                         ?>
					<?php echo $g[d_name]?></td>
                    
				</tr>
				        
			                
					
					        
                
                
                          
<tr>

	   <td align="">&nbsp;Medical History&nbsp;:</td>

   <?php

$count=1;

$testvat=execute("select dname from student_health where student_id='$student_id' and status=1");
while($testvat1=fetcharray($testvat))
{
$teschwck=fetcharray(execute("select * from student_med_frm where id='$testvat1[0]' order by id"));
 
		?>
     <td align="right">

		&nbsp;&nbsp;<?=strtoupper($teschwck[dname])?>,

		<?php

}

?>
</td>

</tr>



<tr>

   <td  >&nbsp;Allergy Information:</td>

	<td align="right">

		<?=strtoupper($fgb[additional_info1])?>

	</td>

</tr>
<tr>

   <td  >&nbsp;Any regular medication?

</td>

	<td align="right">

		<?=strtoupper($fgb[additional_info2])?>

	</td>

</tr>



<tr>

   <td  >&nbsp;Any surgery undergone: 
</td>

	<td align="right">

		<?=strtoupper($fgb[additional_info3])?>

	</td>

</tr>


<tr>

   <td  >&nbsp;Any basic immunization/vaccination:
</td>

	<td align="right">

		<?=strtoupper($fgb[additional_info4])?>

	</td>

</tr>

<tr>

   <td  >&nbsp;If any special instruction: 
</td>

	<td align="right">

		<?=strtoupper($fgb[additional_info5])?> 

	</td>

</tr>
</table>
<table border='0' align='center' width='80%' class='forumline' >
<tr><td   colspan="2" align="justify">&nbsp;
</td></tr>
</table>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td>&nbsp;To have cuts and grazes cleaned and dressed</td>
     <?php
  if($fgb[type1]=='yes')
  $check='checked';
  else
  $check1='checked';
  ?>
    <td nowrap>&nbsp;<?=strtoupper($fgb[type1])?> </td>
  </tr>
  <tr>
    <td>&nbsp;Be given tablets like Paracetamol, lozenges, cough medicines etc</td>
    <?php
  if($fgb[type2]=='yes')
  $check2='checked';
  else
  $check3='checked';
  ?>
    <td>&nbsp;<?=strtoupper($fgb[type2])?></td>
  </tr>
  <tr>
    <td>&nbsp;Application of eye and ear drops</td>
     <?php
  if($fgb[type3]=='yes')
  $check4='checked';
  else
  $check5='checked';
  ?>
    <td>&nbsp;<?=strtoupper($fgb[type3])?></td>
  </tr>
  <tr>
    <td>&nbsp;I herby give permission for emergency measure to be initiated in case of accident or <br>sudden illness with the understanding that I will be notified as soon as possible.</td>
     <?php
  if($fgb[type4]=='yes')
  $check6='checked';
  else
  $check7='checked';
  ?>
    <td>&nbsp;<?=strtoupper($fgb[type4])?></td>
  </tr>
  <tr>
    <td>&nbsp;The nurse will endeavor to inform parents as soon as possible in the case of any serious illness. </td>
     <?php
  if($fgb[type5]=='yes')
  $check8='checked';
  else
  $check9='checked';
  ?>
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
		<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>

</div>
            </center>
	</form>

</body>

</html>
