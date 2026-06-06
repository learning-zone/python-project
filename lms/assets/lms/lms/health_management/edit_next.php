<?php

	include("../db.php");

    //print_r($_POST);

	$grade=$_REQUEST['grade']; 
	$user=$_SESSION['user']; 

	$stud =$_REQUEST['stud'];

	$fs =$_REQUEST['fs'];

	$id =$_REQUEST['id'];

	$ad =$_REQUEST['ad'];

	$ag =$_REQUEST['ag'];

	$gen =$_REQUEST['gen'];

	$adm =$_REQUEST['adm'];

	$branch=$_REQUEST['branch'];

	$sem=$_REQUEST['sem'];

	$class_section_id=$_REQUEST['class_section_id'];

	$branch=$_POST['branch'];

	$sem=$_POST['sem'];

	$class_section_id=$_POST['class_section_id'];

	$gob = $_POST['gob'];

	$doct = $_POST['doct'];

	$txtPresenting = $_POST['txtPresenting'];

	$txtTreatment = $_POST['txtTreatment'];

	$txtRecommendations = $_POST['txtRecommendations'];

	$penal_day = $_POST['penal_day'];

	$penal_month = $_POST['penal_month'];

	$penal_year = $_POST['penal_year'];

	$penal_hr = $_POST['penal_hr'];

	$penal_sec = $_POST['penal_sec'];

	$ams = $_POST['ams'];
	
	$penal_hr1 = $_POST['penal_hr1'];

	$penal_sec1 = $_POST['penal_sec1'];

	$ams1 = $_POST['ams1'];

	$dts=$_POST['dts'];
	
	$place=$_POST['place'];
	$report=$_POST['report'];
	
	$type=$_POST['type'];
	$doc_name = $_POST['doc_name'];
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
	$uploadedfile=$POST['uploadedfile'];
	$doc_detail_id=$_POST['doc_detail_id'];
	
if($gob)

{

	$dts=$penal_year."-".$penal_month."-".$penal_day;

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
	$type=$_POST['type'];
$doc_detail_id=$_POST['doc_detail_id'];
$today = date('Y-m-d H:i:s');
	$gj=execute("update accident_report set doc_name='{$doct}',d_date='".addslashes($dts)."',time='".addslashes($timr)."',complaints='".addslashes($txtPresenting)."',treatment='".addslashes($txtTreatment)."',remarks='".addslashes($txtRecommendations)."',place='$place',time_1='".addslashes($timr1)."',type='$type',report='$report',entered_date='$today' where id='$id'");
	//echo "select * from hospital_det where `doc_detail_id`='$id'";
	  $sql_fetch_sports=execute("select * from hospital_det where `doc_detail_id`='$id'");
					  if(rowcount($sql_fetch_sports)!=0)
		 {
	//echo "update hospital_det set doc_name='{$doc_name}',time_in='".addslashes($timr2)."',time_out='".addslashes($timr3)."',diagnosis='".addslashes($diagnosis)."',treatment='".addslashes($treatment)."',report='".addslashes($report)."',returned='$returned',picked='".addslashes($picked)."' where doc_detail_id='$doc_detail_id'";
	$gj1=execute("update hospital_det set doc_name='{$doc_name}',time_in='".addslashes($timr2)."',time_out='".addslashes($timr3)."',diagnosis='".addslashes($diagnosis)."',treatment='".addslashes($treatment)."',report='".addslashes($report)."',returned='$returned',picked='".addslashes($picked)."' where doc_detail_id='$id'");
		 }
		 else
		 {
			$qryy=execute("INSERT INTO `hospital_det`(doc_name,treatment_date,time_in,time_out,diagnosis,treatment,report,returned,picked,doc_detail_id,hospital_name)values('$doc_name','$treatment_date','$time_in','$time_out','$diagnosis','$treatment','$report','$returned','$picked','$id','$hosp')");
		 }
	

	?>

		<script language="JavaScript" type="text/javascript">

       	 	alert("MODIFIED SUCESSFULLY");

        </script>

	<?php

	

}

$dcv2=execute("select * from accident_report where id='$id'");

	

?>



<html>



<head>

<script>

       function reload()

       {

          document.frmMedicaldetail.action='edit_stud.php';

		  document.frmMedicaldetail.submit();

       }

</script>

<meta http-equiv="Content-Language" content="en-us">

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>New Page 1</title>

</head>

<body>

<p>&nbsp;</p>

<p>&nbsp;</p>



<SCRIPT language=javascript>

	function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

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

    document.frmMedicaldetail.action="edit_studs.php";

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

        

        

<?php

	while($r=fetcharray($dcv2))

	{
		$doc_detail_id=$r['id'];

		 $grade=$r['course_id'];

		 $ad=$r['acc_year'];

		 $gen=$r['sex'];

		 $adm=$r['name'];

		 $stud=$r['stud_id'];

		$txtPresenting = $r['complaints'];

		$txtTreatment = $r['treatment'];

		$txtRecommendations = $r['remarks'];

		$tempdate=$r['d_date'];
		
		$place=$r['place'];
		$type=$r['type'];

	}

	$date1=explode('-',$tempdate);	

	$penal_day = $date1[2];

	$penal_month =  $date1[1];

	$penal_year =  $date1[0];


 $ser2="select first_name, last_name, course_yearsem ,gender from student_m where id='$stud'";

$ser=execute($ser2);

while($r1=fetcharray($ser))

{

	$studentname=$r1['first_name'].' '.$r1['last_name'];

	$semid=$r1['course_yearsem'];

	if($r1[gender]=='M')

	$gender="Male";

	else

	$gender="Female";

}

$semid1=fetchrow(execute("SELECT  year_name FROM `course_year` where  year_id='$semid'"));

$sem1=$semid1[0];

$sem=$semid;



?>
		      <form name="frmMedicaldetail" method="post" action='edit_next.php'>

      <input type=hidden name='grade' value='<?php echo $grade?>'>

      <input type=hidden name='ad' value='<?php echo $ad?>'>

      <input type=hidden name='gen' value='<?php echo $gen?>'>

      <input type=hidden name='adm' value='<?php echo $adm?>'>

      <input type=hidden name='ag' value='<?php echo $ag?>'>

      <input type=hidden name='stud' value='<?php echo $stud?>'>

      <input type=hidden name='dts' value='<?php echo $dts?>'>

      <input type=hidden name='fs' value='<?php echo $fs?>'>

    <input type=hidden name='branch' value='<?php echo $branch?>'>

    <input type=hidden name='sem' value='<?php echo $sem?>'>

    <input type=hidden name='class_section_id' value='<?php echo $class_section_id?>'>

    <input type="hidden" name="id" value="<?=$id?>">



			<table class='forumline' cellspacing=0 width="60%" id="table2" align=center>

			<tr>

			<td vAlign="top" align="center" height="30" colspan=5 class=head>

			Edit Accident Report </td>

			

		</tr>
        <tr height="25"><td class="submenu" colspan="4" nowrap>

<div id=123A style="float: left; text-align: left;"><b> </b></div>

<div id=123B style="float: right; text-align: right;">

<a href="javascript:OpenWind2('student_medical_info.php?student_id=<?=$stud?>')" >
<input type="hidden" name="tempiddet" value="<?=$stud?>">

<input type="button" class="bgbutton" value="View medical information">

</a></div></td></tr>
        <tr class="keyrow"><td width="25%" >&nbsp;Name:</td><td width="25%" ><?php echo $studentname?></td><td colspan="2"></td></tr>
        <tr>

				<td >&nbsp;Select Date</td>

				<td width='33%'>				

				<select name="penal_day">

<?php

				for($i=1;$i<=31;$i++)

				{

					if($penal_day==$i)

					{

						echo "<option value='$i' selected >$i</option>";

					}

					else

					{

						echo "<option value='$i'>$i</option>";

					} 

				}

?>

</select>

<select name="penal_month">

<?php

for($i=1;$i<=12;$i++)

{	

	if($penal_month==$i)

	{

	 	echo "<option value='$i' selected>$i</option>";

	}

	else

	{

	  	echo "<option value='$i'>$i</option>";

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

	if($penal_year==$i)

	{

	   $sel='selected';

	   echo "<option value=$i $sel>$i</option>";

	}

	else

	{

	  echo "<option value='$i'>$i</option>";

	} 

}

?>

</select></td><td></td><td></td>





<tr>
<td  width='15%'>&nbsp;Time In</td>
<?php
$test=execute("select time from accident_report where stud_id='$stud'");
while($tst=fetcharray($test))
{
		//$tst[0];
	$mgst=explode("-",$tst[0]);
	 
}

//echo $cvv[time];
 //$dm=explode("-",$cvv[time]);   


?>
<td nowrap><select name="penal_hr">
<?php
   for($il='1';$il<=12;$il++)
  {
	  if($il<10)
	{
	  $il='0'.$il;
	}
	if($mgst[0]=='' || $mgst[0]=='0')
	{
	  $p=$il;
	}
	else
	{
	  $p=$mgst[0];
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
	 $qq=$mgst[1];
for($is1=0;$is1<=59;$is1++)
{    if($is1<10)
	{
	  $is1='0'.$is1;
	}
	
/*	if($dm[1]=='' || $dm[1]=='0')
	{  

	  $qq=$is1;
	}
	else
	{
	  $qq=$dm[1];
	}*/
	$sel='';
	
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

if($mgst[2]=="AM")

{

	$sj="selected";

	$sk="";

}

if($mgst[2]=="PM")

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
$test=execute("select time_1 from accident_report where stud_id='$stud'");
while($tsting=fetcharray($test))
{
		//$tsting[0];
	$mgstrt=explode("-",$tsting[0]);
	 
}

//echo $cvv[time];
 //$dm=explode("-",$cvv[time]);   


?>
<td nowrap><select name="penal_hr1">
<?php
   for($i2='0';$i2<=12;$i2++)
  {
	  if($i2<10)
	{
	  $i2='0'.$i2;
	}
	if($mgstrt[0]=='' || $mgstrt[0]=='0')
	{
	  $p1=$i2;
	}
	else
	{
	  $p1=$mgstrt[0];
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
 $qq1=$mgstrt[1];
for($is2=0;$is2<=59;$is2++)
{    if($is2<10)
	{
	  $is2='0'.$is2;
	}

	/*if($dm1[1]=='' || $dm1[1]=='0')
	{  

	  $qq1=$is2;
	}
	else
	{
	  $qq1=$dm1[1];
	}*/
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

if($mgstrt[2]=="AM")

{

	$sj1="selected";

	$sk1="";

}

if($mgstrt[2]=="PM")

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
            

				<tr class="keyrow">

					<td width="25%" >&nbsp;<?php echo $_SESSION['semname']; ?></td>

					<?php

					    	 $cr=execute("select * from course_year where year_id='$sem'");

				   $rtt=fetcharray($cr);

		

					?>

					<td width="25%" >&nbsp;<?php echo $sem1; ?></font></td>

					<td width="13%" >&nbsp;Age(yrs.)</td>

					<td width="38%" ><?php echo $ag?></td>

				</tr>

				<tr class="keyrow">

					<td width="16%" >&nbsp;Sex</td>

					<td width="33%"><?php echo $gen=$gender;?></td>

					<td width="13%">&nbsp;Admission Type</td>

					<td width="38%" >

					<?php

					    

					     $dcv=execute("select * from accident_report where id='$id'");

						 $cvv=fetcharray($dcv);

					

					?>

					<?php echo $adm?></td>

				</tr>

				    <tr class="keyrow">

					<td width="16%">&nbsp;Academic Year</td>

					<td width="33%"><?php echo $ad?></td>

					<td colspan='2'></td></tr>
                    <tr class="keyrow">

					<td width="16%">&nbsp;Seen By</td>

					<td width="33%"><?=$user?></td>
                    <td width="16%">&nbsp;Taken By</td>

					<td width="33%"><input type="text" value='<?=$cvv[username]?>'></td>


</tr>
					

					

					        <!--<tr vAlign="top" align="left">

					        <td class="keycell" >&nbsp;Seen By</td>

					        <td class="keycell" colSpan="3">					        

					        <input type=text name="doct" value='<?php echo $cvv[doc_name]?>'>

				                </td>

				                </tr>-->

				<?php

				   

				?>

				




				<?php

			

			

						

					  $dcv=execute("select * from accident_report where id='$id'");

					  $cvv=fetcharray($dcv);

				?>

				<input type=hidden name='cvv1' value='<?php echo $cvv[id]?>'>
                <tr>

					<td class="keycell">&nbsp;Diagnosis</td>

					<td colSpan="3">

					<textarea name="txtTreatment" rows="4" cols="60"><?php echo $cvv[treatment]?></textarea>

					</td>

				</tr>


				<tr>

					<td class="keycell">Treatment Given</td>

					<td colSpan="3">

					<textarea name="txtPresenting" rows="7" cols="60"><?php echo $cvv[complaints]?></textarea>

					</td>

				</tr>

			

				
				<tr>

					<td class="keycell">&nbsp;Remarks</td>

					<td colSpan="3">

					<textarea name="txtRecommendations" rows="4" cols="60"><?php echo $cvv[remarks]?></textarea>

					</font></td>

				</tr>		
                <tr align="left">
								<td>&nbsp;Place</td>
								<td colSpan="3">
					<textarea name="place" rows="4" cols="60"><?php echo $cvv[place]?></textarea>
					</td>
				            </tr>
                            <tr align="left">
								<td>&nbsp;Report</td>
								<td colSpan="3">
					<textarea name="report" rows="4" cols="60"><?php echo $cvv[report]?></textarea>
					</td>
				            </tr>
                           
      <tr height='25'>

<td nowrap>&nbsp;&nbsp;Image Path</td>
 <td align="left" colSpan="3"><img src="<?=$cvv[uploadedfile]?>" height="120"></td>
        </tr>	
 <?php
  if($cvv[type]=='yes')
  $check='checked';
  else if($cvv[type]=='no')
  $check1='checked';
  else if($cvv[type]=='none')
  $check2='checked';
  ?>
                         <tr>
        <td>&nbsp;Student sent to?</td>
        <td colspan="3">
        <input type="radio"  name="type" value="yes" <?=$check?>>Home
         
          <input type="radio"  name="type" value="no" <?=$check1?>>Hospital
          <input type="radio"  name="type" value="none" <?=$check2?>>None
      
          </td>
      </tr>	
		</table><br>
        
       <!--  <table class='forumline' cellspacing=0 width="60%" id="table2" align=center>
			<tr>
			<td vAlign="top" align="Center" colspan=5 class=head> Diagnosis in  Hospital
            </td>
			<?php

$dcv3=execute("select * from hospital_det where doc_detail_id=$cvv[id]");
$qry=fetcharray($dcv3);
?>
		</tr><?
				
				$hosp_name=fetcharray(execute("SELECT `hospital_name` FROM `hospital_tab` WHERE `id` ='$qry[hospital_name]'"));
			?>
         <tr vAlign="top" align="left">
								<td class="keycell" >&nbsp;Hospital Name</td>
								<td class="keycell" colSpan="3">&nbsp;
								
          <?=$hosp_name[0]?></td>
								
								
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
 $qq3=$dm3[1];
for($is3=0;$is3<=59;$is3++)
{        if($is3<10)
	{
	  $is3='0'.$is3;
	}
	/*if($dm3[1]=='' || $dm3[1]=='0')
	{  

	  $qq3=$is3;
	}
	else
	{
	  $qq3=$dm3[1];
	}*/
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
 $qq5=$dm5[1];
for($is5=0;$is5<=59;$is5++)
{        if($is5<10)
	{
	  $is5='0'.$is5;
	}
	/*if($dm5[1]=='' || $dm5[1]=='0')
	{  

	  $qq5=$is5;
	}
	else
	{
	  $qq5=$dm5[1];
	}*/
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
        -->
        

        <br>

        <center>

        <div>

			<input type=submit name='subn' value='Go Back' class='bgbutton' onclick='reload()'>

			<input type=submit name='gob' value='Modify' class='bgbutton'>

            </div>

            </center>

			

	</form>



</body>

</html>

