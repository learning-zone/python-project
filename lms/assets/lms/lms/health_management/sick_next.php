<html>
<?php
include("../db.php");
//print_r($_POST);
if($_REQUEST)
{
	$grade=$_REQUEST['grade'];  
	$stud =$_REQUEST['stud'];
	$fs =$_REQUEST['fs'];
	$ad =$_REQUEST['ad'];
	$ag =$_REQUEST['ag'];
	$gen =$_REQUEST['gen'];
	$adm =$_REQUEST['adm'];
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$class_section_id=$_REQUEST['class_section_id'];
	$id=$_REQUEST['id'];
	$user=$_REQUEST['user'];
	$user=$_SESSION['user'];
}
if($_POST)
{
	
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$fs=$_POST['$fs'];
	$gob = $_POST['gob'];
	$doct = $_POST['doct'];
	$penal_day = $_POST['penal_day'];
	$penal_month = $_POST['penal_month'];
	$penal_year = $_POST['penal_year'];
	$penal_hr = $_POST['penal_hr'];
	$penal_sec = $_POST['penal_sec'];
	$ams = $_POST['ams'];
	$penal_hr1 = $_POST['penal_hr1'];
	$penal_sec1 = $_POST['penal_sec1'];
	$ams1 = $_POST['ams1'];
	$txtPresenting = $_POST['txtPresenting'];
	$txtTreatment = $_POST['txtTreatment'];
	$txtRecommendations = $_POST['txtRecommendations'];
	$type = $_POST['type'];
	$place=$_POST['place'];
	//hospital_det page
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
	$uploadedfile=$POST['uploadedfile'];
	
	//echo "select id FROM `hospital_det` where doc_detail_id='$doc_detail_id'";

	
	}
	

?>
	

<head>
<script language='Javascript'>
function RefreshMe(val)
	{
		document.frmMedicaldetail.flag.value=val;
		document.frmMedicaldetail.action="sick_next.php";
		document.frmMedicaldetail.submit();
	}
function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}
function reload2()
{
	if(document.frmMedicaldetail.type.value=='yes')
	{
		//document.frmMedicaldetail.action='hospital_det.php';
		document.frmMedicaldetail.submit();
	}
}

function reload()
{
   document.frmMedicaldetail.action='sick_next.php';
   document.frmMedicaldetail.submit();
}
</script>
<script type="text/javascript">
<!--
function showTable(which) 
{
	if(which == "1") {
	document.getElementById('paymethod').style.display = "table";
	}
	if(which == "2") {
	document.getElementById('paymethod').style.display = "none";
	}
}
//-->
</script>
<style type="text/css">
#paymethod {
width: 700px;
border: 0px solid;
font-family: "Century Gothic";
font-size: 14px;
}
</style>

<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Sick Report</title>
</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form name="frmMedicaldetail" method="post" ENCTYPE="multipart/form-data" action='sick_next.php'>
<input type=hidden name='grade' value='<?php echo $grade?>'>
<input type=hidden name='ad' value='<?php echo $ad?>'>
<input type=hidden name='gen' value='<?php echo $gen?>'>
<input type=hidden name='adm' value='<?php echo $adm?>'>
<input type=hidden name='ag' value='<?php echo $ag?>'>
<input type=hidden name='stud' value='<?php echo $stud?>'>
<input type=hidden name='id' value='<?php echo $id?>'>
<input type=hidden name='branch' value='<?php echo $branch?>'>
<input type=hidden name='sem' value='<?php echo $sem?>'>
<input type=hidden name='class_section_id' value='<?php echo $class_section_id?>'>

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
    document.frmMedicaldetail.action="sick_studs.php";
    document.frmMedicaldetail.submit();
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

			<table class='forumline' cellspacing=0 width="60%" id="table2" align=center>
            <?php
					
					 $cr22=execute("select * from student_m where id='$id'");
				   $rtt1=fetcharray($cr22);
				   
				   	?>
			<tr>
           
			<td vAlign="top" align="Center" colspan=5 class=head>
			Accident Report </td>
			
		</tr>
        <tr height="25"><td class="submenu" colspan="4" nowrap>

<div id=123A style="float: left; text-align: left;"><b> </b></div>

<div id=123B style="float: right; text-align: right;">

<a href="javascript:OpenWind2('student_medical_info.php?student_id=<?=$id?>')" >
<input type="hidden" name="tempiddet" value="<?=$id?>">

<input type="button" class="bgbutton" value="View medical information">

</a></div></td></tr>
 <tr class="keyrow"><td width="25%" >&nbsp;Name:</td><td width="25%" ><?=$rtt1[first_name]?>&nbsp;<?=$rtt1[last_name]?></td><td></td><td></td></tr>
 <tr>
				<td>&nbsp;Select Date</td>
				<td>
				
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
<td></td><td></td>
</tr>
<tr>
<td  width='50%'>&nbsp;Time In</td>
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
<option>PM</option>
</select>
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
				        <tr class="keyrow">
					<td width="25%" >&nbsp;<?php echo $_SESSION['semname']; ?></td>
					<td width="25%" >
					<?php
					
					 $cr=execute("select * from course_year where year_id='$sem'");
				   $rtt=fetcharray($cr);
				   	?>
					<?php echo $rtt[year_name]?></td>
					<td width="25%" >&nbsp;Age(yrs.)</td>
					<td width="25%">
					<?php echo $ag?></td>
				</tr>
				        <tr class="keyrow">
					<td width="25%" >&nbsp;Sex</td>
					<td width="25%" >
					<?php echo $gen?></td>
					<td width="25%">&nbsp;Admission Type</td>
					<td width="25%">
					<?php
					     $ggt=execute("select * from admission where id='$adm'");
					     $g=fetcharray($ggt);
					?><?php echo $g[name]?></td>
				</tr>
				<tr class="keyrow">
					<td width="25%" >&nbsp;Academic Year</td>
					<td width="25%"><?php echo $ad?></td>
					<td width="25%" colspan='2'></td></tr>

				
					<?php
					//$query=execute("select distinct(doc_name) from doc_detail");
                     //$rc=rowcount($query);
					//if($rc>0)
					//{
					?>
					
					<?php
                         //               for($i=0;$i<$rc;$i++)
                    		//	{
							//		$rt=fetcharray($query,$i);
		 		              //  if($cmbSeen==$rt[0])
      							//{
          						//	echo("<option value='$rt[0]' selected>$rt[0]</option>");
							//}
						  //else
	    					//	{
	    					//		echo("<option value='$rt[0]'>$rt[0]</option>");
							//}
									
                             //           }
					//}
?>
<!-- </select></td><tr> -->
                                       
					
					        <tr vAlign="top" align="left">
								<td class="keycell" >&nbsp;Seen By</td>
								<td class="keycell">
								<?=$user?>
				                </td>
                                <td class="keycell" >&nbsp;Taken By</td>
								<td class="keycell" colSpan="3">
								<select name="username" onChange="RefreshMe(0)">
      <option value='0'>-- Select --</option>
      <?php

	$sql="SELECT a.username, b.f_name, b.s_name FROM users a, staff_det b WHERE a.Activated='On' and a.username!='administrator' and b.slno=a.S_ID order by a.username";
	$rs=execute($sql) or die(error_description());
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs);
		if($username==$r[username])
		{
			?>
      <option value="<?=$r['username']?>" ><?php echo $r['f_name']." ".$r['s_name']; ?></option>
      <?php
		}
		else
		{
			?>
      <option value="<?php echo $r[username] ?>">
        <?php echo $r['f_name']." ".$r['s_name']; ?>
        </option>
      <?php
		}
	}

?>
    </select>
				                </td>
				            </tr>
				<?php
				   
				?>
				

				<tr>
					
				</tr>
			
				<tr>
					<td class="keycell">&nbsp;Diagnosis</td>
					<td colSpan="3">
					<textarea name="txtTreatment" rows="4" cols="60"></textarea></td>
				</tr>
                <tr>
                <td class="keycell" >&nbsp;Treatment Given</td>
					<td colSpan="3"><textarea name="txtPresenting" rows="8" cols="60"></textarea></td></tr>
                
				<tr>
					<td class="keycell" >&nbsp;Place</td>
					<td colSpan="3">
					<textarea name="txtRecommendations" rows="4" cols="60"></textarea>
					</td>
				</tr>
               
         <tr align="left">
								<td>&nbsp;Remarks</td>
								<td colSpan="3">
					<textarea name="place" rows="4" cols="60"></textarea>
					</td>
				            </tr>
                            <tr height='35'>

<td nowrap>&nbsp;&nbsp;Image Upload</td>

           <td align='center' nowrap>
        <input type='FILE' name='uploadedfile' id='uploadedfile' size='25' value=""/>
        </td><td colspan="2"></td>
        </tr>
                         <tr height='35'>
        <td>&nbsp;Student sent to?</td>
        <td colspan="3">
        <!--<input type="radio" onClick="showTable('1')" id="paymentmethod_1" name="type" />Hospital

<input type="radio" onClick="showTable('2')" id="paymentmethod_0" name="type"/>Home-->
      <input type="radio" name="type"  value="yes" onChange="reload2()">Home
         
          <input type="radio" name="type"  value="no" onChange="reload2()">Hospital
           <input type="radio" name="type"  value="none" onChange="reload2()">None
          </td>
      </tr>	
      
     
      
      
         
				<?php
				     if($gob)
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
					   $type=$_POST['type'];
					   $place=$_POST['place'];
					   //here
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
						$username=$_POST['username'];
						//image
						$target_path = "menuimage/";
						$fext=basename($_FILES['uploadedfile']['name']);
						$fext1=explode(".",$fext);
						$fexn=$newname.".".$fext1[1];
						$target_path = $target_path.$fext;
						
						$today = date('Y-m-d H:i:s');
						
						if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
						$imagepath = $target_path;
						else
						$imagepath ='';
										
						
									   
				       $c=execute("select * from accident_report where stud_id='$id' and course_id='$as' and d_date='$ddv'");
					   while($c_qry=fetcharray($c))
					   {
						   $doc_detail_id=$c_qry['id'];
						   $type=$c_qry['type'];
					   }
					   
  if($c_qry['type']=='yes')
  $check='checked';
  else
  $check1='checked';			       
				       if(rowcount($c)==0)
				       {
						  // echo "insert into doc_detail(stud_id,course_id,age,sex,adm_type,acc_year,doc_name,d_date,time,complaints,treatment,remarks,time_1,type,place,name,uploadedfile )values('$id','$grade','$ag','$gen','$adm','$ad','$doct','$ddv','$timr','".addslashes($txtPresenting)."','".addslashes($txtTreatment)."','".addslashes($txtRecommendations)."','$timr1','$type','$place','$fs','$imagepath')";
						   
				        $gj=execute("insert into accident_report(stud_id,course_id,age,sex,adm_type,acc_year,doc_name,d_date,time,complaints,treatment,remarks,time_1,type,place,name,uploadedfile,username,entered_date  )values('$id','$grade','$ag','$gen','$adm','$ad','$doct','$ddv','$timr','".addslashes($txtPresenting)."','".addslashes($txtTreatment)."','".addslashes($txtRecommendations)."','$timr1','$type','$place','$fs','$imagepath','$username','$today')");
						 //echo "SICK REPORT INSERTED SUCESSFULLY";
						
						  $c=execute("select * from accident_report where stud_id='$id' and d_date='$ddv'");
					   while($c_qry=fetcharray($c))
					   {
						   $doc_detail_id=$c_qry['id'];
						   //$type=$c_qry['type'];
					   }
					   //echo "INSERT INTO `hospital_det`(doc_name,treatment_date,time_in,time_out,diagnosis,treatment,report,returned,picked,doc_detail_id,hospital_name)values('$doc_name','$treatment_date','$time_in','$time_out','$diagnosis','$treatment','$report','$returned','$picked','$doc_detail_id','$hosp')";
					   
						 
						 //$query="INSERT INTO `hospital_det`(doc_name,treatment_date,time_in,time_out,diagnosis,treatment,report,returned,picked,doc_detail_id,hospital_name)values('$doc_name','$today','$time_in','$time_out','$diagnosis','$treatment','$report','$returned','$picked','$doc_detail_id','$hosp')";


   $result=execute($query);
						 
						 
						 
						 
						 ?>
						 <script language="JavaScript" type="text/javascript">
						 alert("ACCIDENT REPORT INSERTED SUCESSFULLY");
						 reload();
                         </script>
						 <?php
				       }
				       else
				       {
				         //echo "Data Entered for the Selected Student Id";
						 ?>
						 <script language="JavaScript" type="text/javascript">
						 alert("Data Entered for the Selected Student");
                         </script>
						 <?php
						 die();
				       }
				     
}
				?>
		
                       
                      
            </table> <br>
             <?
//if($type=='no')
{
?>  
            
            <!--<table class='forumline' cellspacing=0 width="60%" id="paymethod" align=center>-->
           <!-- <table width="700" border="0" cellpadding="5" id="paymethod" align="Center">
			<tr>
			<td vAlign="top" align="Center" colspan=5 class=head > Diagnosis in  Hospital
            </td>
			
		</tr>
        <tr vAlign="top" align="left">
								<td class="keycell" width="30%">&nbsp;Hospital Name</td>
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

<input type="button" align="center" class="bgbutton" value="Add"></a>  </td><td colspan="2"></td>
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
       <input type="radio" name="returned" onChange="reload2(this.value)">School
         
          <input type="radio" name="returned" onChange="reload2(this.value)">Home
          </td>
				            </tr>
                            <tr>
					<td class="keycell" >&nbsp;Picked By</td>
					<td colSpan="3">
					<textarea name="picked" rows="4" cols="60"></textarea>
					</td>
				</tr>	
                            </table>-->
                            <?
}
?>
      
            
            
		<br>
			<center>
			<!--<input type=submit name='subn' value='Go Back' class='bgbutton' onclick='reload()'>-->
            <!--<div align="center">
            <input type=submit name='mail' value='Send E-Mail' class='bgbutton'>
            </div>-->
            <br>
			<input type=submit name='gob' value='Submit' class='bgbutton'>
			</center>
	</form>
    
            
            

</body>

</html>
