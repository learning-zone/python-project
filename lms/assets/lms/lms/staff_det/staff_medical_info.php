<html>
<?php
   include("../db.php");
   $staff_id=$_REQUEST['staff_id'];
   $staff_category=$_REQUEST['staff_category'];
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
//print_r($_REQUEST);
$gob = $_POST['gob'];

?>
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
                        <form name="frmMedicaldetail" method="post" action='staff_medical_info.php'>
			<input type=hidden name='gen' value='<?php echo $gen?>'>
			<input type=hidden name='stud' value='<?php echo $stud?>'>
			<input type=hidden name='staf' value='<?php echo $staf?>'>
			<input type=hidden name='aa' value='<?php echo $aa?>'>
			<input type=hidden name='stafd' value='<?php echo $stafd?>'>
            <input type=hidden name='staff_id' value='<?php echo $staff_id?>'>
            
			<table class="formtable" width="90%" id="table2" align=center>
			<tr>
			<td vAlign="top" align="Center" height="30" colspan=5 class=head>
			Staff Medical Details <?php echo $stud?></td>
			
		</tr>
				        
				
					<td width="25%" >
					<?php
					     $ggt=execute("select * from staff_des where d_id='$stafd'");
					     $g=fetcharray($ggt);
					
					?>
                    <?php
				        $rfg=execute("select * from doc_staff where staff_id='$staff_id'");
			             $fgb=fetcharray($rfg);

                         ?>
					<?php echo $g[d_name]?></td>
                    <td></td>
				</tr>
				        
			                
					
					        
                
                 <tr vAlign="top" align="left">
					        <td class="keycell" >&nbsp;Emergency Contact</td>
					        <td class="keycell" colSpan="3" >					        
					        <input type=text name="emergency_name" value='<?php echo $fgb[emergency_name]?>'>
				                </td>
				                </tr>
                 <tr vAlign="top" align="left">
                        <td class="keycell" >&nbsp;Emergency Contact Number</td>
                        <td class="keycell" colSpan="3" >					        
                        <input type=text name="emergency_no" value='<?php echo $fgb[emergency_no]?>'>
                            </td>
                            </tr>   
   <table border='0' align='center' width='90%' height="30%" class='forumline' >

<tr height="25">

   <td class="formtable" >Please tick in the appropriate box if you have any history of the following:</td>

</tr>

<tr>

	<td><table border="0" width='100%' >

  <?php

$count=1;

$sql=execute("select * from staff_med_frm order by id") or die(mysql_error());

$numrows=rowcount($sql);

for($i=0;$i<rowcount($sql);$i++)

{

	$r1=fetcharray($sql,$i);

   $qry="select * from student_health where student_id='$student_id' and dname=$r1[id]";

	$t=execute($qry) or die(mysql_error());;
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

		<td valign='top' nowrap><input type="checkbox" name="check[]" value="<?=$r1["id"]?>" <?=$sel?>>&nbsp;&nbsp;<?=$r1["dname"]?></td>

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

   <td  class="keycell">Additional information if you have indicated yes:</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info1'><?=$fgb[additional_info1]?></textarea> 

	</td>

</tr>

</table>
<table border='0' align='center' width='90%' class='forumline' >

<tr>

   <td  class="keycell">&nbsp;Any regular medication?
If yes specify:
</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info2'><?=$fgb[additional_info2]?></textarea> 

	</td>

</tr>

</table>

<table border='0' align='center' width='90%' class='forumline' >

<tr>

   <td  class="keycell">&nbsp;Any surgery you have undergone :If yes specify: 
</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info3'><?=$fgb[additional_info3]?></textarea> 

	</td>

</tr>
</table>				
				<?php
				     if($gob)
				     {
						  if(is_array($sel))

	{

		 while( list(,$value)=each($sel))

		 {

			 $ce= $value;

			  $var12="insert into staff_health(dname,status,staff_id,checked) values ('$ce',1,'$staff_id',1)";

			 execute($var12) or die(mysql_error()."a2");

		 }

	}					
						$quer3=fetchrow(execute("select staff_id FROM `doc_staff` where staff_id='$staff_id'"));
                        if($quer3[0])
						{
				      
				           $upd=execute("update doc_staff set additional_info1='$additional_info1',additional_info2='$additional_info2',additional_info3='$additional_info3',emergency_name='$emergency_name',emergency_no='$emergency_no', where staff_id='$staff_id'");
						} 
						 
				       $penaly=$_POST['penal_year'];
				       $penalm=$_POST['penal_month'];
				       $penald=$_POST['penal_day'];
				       $ddv=$penaly."-".$penalm."-".$penald;
				       $ti=$_POST['penal_hr'];
				       $tim=$_POST['penal_sec'];
				       $tims=$_POST['ams'];
				       $timr=$ti."-".$tim."-".$tims;
					   $quer13=fetchrow(execute("select staff_id FROM `staff_health` where staff_id='$staff_id'"));
                        if($quer13[0])
						{
							$upd=execute("update staff_health set dname='$check',checked=1,status=1 where staff_id='$staff_id'");
						} 
				       
				       $c=execute("select * from doc_staff where slno='$aa' and d_date='$ddv'");
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
						
				         $gj=execute("insert into doc_staff(sex,doc_name,d_date,time,complaints,treatment,remarks,slno,group_id,des_id,additional_info1,additional_info2,additional_info3,emergency_name,emergency_no,staff_id)values('$gen','$dr','$ddv','$timr','".addslashes($txtPresenting)."','".addslashes($txtTreatment)."','".addslashes($txtRecommendations)."','$aa','$staf','$stafd','$additional_info1','$additional_info2','$additional_info3','$emergency_name','$emergency_no','$staff_id')");
							 
						 
						 
					 //echo "STAFF SICK REPORT INSERTED SUCESSFULLY";
					 ?>
					 <script language="JavaScript" type="text/javascript">
					 alert("STAFF SICK REPORT INSERTED SUCESSFULLY");
                     </script>
					 <?php
				       }
				       else
				       {
						   while( list(,$value)=each($check))
							{

								 $ce= $value;
					
								echo $var1245="insert into staff_health(dname,staff_id,status,checked) values ('$ce','$staff_id',1,1)";
					
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
		<div>
			
			<input type=submit name='gob' value='Submit' class='bgbutton'>
			</div>
            </center>
	</form>

</body>

</html>
