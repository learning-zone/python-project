<?php
	
	//Include database connection details
	require_once('../db.php');
	$student_id=$_REQUEST['student_id'];

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
//	print_r($_POST);
if($_POST['Submit'])
{
	
	#### TO CONVERT DATE FORMAT(YYYY-MM-DD) ####
	$ish_start_date=$_POST['ish_start_date'];
	$dateArray=explode('-',$ish_start_date);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$ish_start_date="$acq_yy-$acq_mm-$acq_dd";
	#############################################
	
	$us_grade_level=$_POST['us_grade_level'];
	$student_email=$_POST['student_email'];
	$passport_no=$_POST['passport_no'];

	$date_of_issue=$_POST['date_of_issue'];
	$dateArray=explode('-',$date_of_issue);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$date_of_issue="$acq_yy-$acq_mm-$acq_dd";
	
	$date_of_expiration=$_POST['date_of_expiration'];
	$dateArray=explode('-',$date_of_expiration);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$date_of_expiration="$acq_yy-$acq_mm-$acq_dd";
	
	
	$visa_type=$_POST['visa_type'];
	$other_type=$_POST['other_type'];
	$other_type_x=$_POST['other_type_x'];
	

	

	$pre_school_name=$_POST['pre_school_name'];
	$pre_school_language=$_POST['pre_school_language'];
	$pre_school_address=$_POST['pre_school_address'];
	$pre_school_city=$_POST['pre_school_city'];
	$pre_school_state=$_POST['pre_school_state'];
	$pre_school_country=$_POST['pre_school_country'];
	
	
	$pre_school_doj=$_POST['pre_school_doj'];
	$dateArray=explode('-',$pre_school_doj);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$pre_school_doj="$acq_yy-$acq_mm-$acq_dd";
	
	
	$pre_school_ldate=$_POST['pre_school_ldate'];
	$dateArray=explode('-',$pre_school_ldate);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$pre_school_ldate="$acq_yy-$acq_mm-$acq_dd";
	
	$pre_school_grade_from=$_POST['pre_school_grade_from'];
	$pre_school_grade_to=$_POST['pre_school_grade_to'];
	
	$pre_school_cur_type=$_POST['pre_school_cur_type'];
	
	
	$pre_school_year_begin=$_POST['pre_school_year_begin'];
	$dateArray=explode('-',$pre_school_year_begin);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$pre_school_year_begin="$acq_yy-$acq_mm-$acq_dd";
	
	
	$pre_school_name2=$_POST['pre_school_name2'];
	$pre_school_language2=$_POST['pre_school_language2'];
	$pre_school_address2=$_POST['pre_school_address2'];
	$pre_school_city2=$_POST['pre_school_city2'];
	$pre_school_state2=$_POST['pre_school_state2'];
	$pre_school_country2=$_POST['pre_school_country2'];
	
	$pre_school_doj2=$_POST['pre_school_doj2'];
	$dateArray=explode('-',$pre_school_doj2);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$pre_school_doj2="$acq_yy-$acq_mm-$acq_dd";
	
	$pre_school_ldate2=$_POST['pre_school_ldate2'];
	$dateArray=explode('-',$pre_school_ldate2);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$pre_school_ldate2="$acq_yy-$acq_mm-$acq_dd";
	
	$pre_school_grade_from2=$_POST['pre_school_grade_from2'];
	$pre_school_grade_to2=$_POST['pre_school_grade_to2'];
	$pre_school_cur_type2=$_POST['pre_school_cur_type2'];
	
	$pre_school_year_begin2=$_POST['pre_school_year_begin2'];
	$dateArray=explode('-',$pre_school_year_begin2);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$pre_school_year_begin2="$acq_yy-$acq_mm-$acq_dd";
	
	$ish_student=$_POST['ish_student'];
	
	$ish_student_from=$_POST['ish_student_from'];
	$dateArray=explode('-',$ish_student_from);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$ish_student_from="$acq_yy-$acq_mm-$acq_dd";
	
	$ish_student_to=$_POST['ish_student_to'];
	$dateArray=explode('-',$ish_student_to);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$ish_student_to="$acq_yy-$acq_mm-$acq_dd";
	
	$pre_ish_student=$_POST['pre_ish_student'];
	
	$pre_ish_student_doj=$_POST['pre_ish_student_doj'];
	$dateArray=explode('-',$pre_ish_student_doj);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$pre_ish_student_doj="$acq_yy-$acq_mm-$acq_dd";
	
	
	$student_native_lang=$_POST['student_native_lang'];
	$student_native_language2=$_POST['student_native_language2'];
	$student_home_lang=$_POST['student_home_lang'];
	
	$father_native_lang=$_POST['father_native_lang'];
	$father_native_language2=$_POST['father_native_language2'];
	$father_home_lang=$_POST['father_home_lang'];
	
	$mother_native_lang=$_POST['mother_native_lang'];
	$mother_native_language2=$_POST['mother_native_language2'];
	$mother_home_lang=$_POST['mother_home_lang'];
	
	$eng_exp=$_POST['eng_exp'];
	$esl=$_POST['esl'];
	$rem_inst=$_POST['rem_inst'];
	$retained=$_POST['retained'];
	$ses=$_POST['ses'];
	$award=$_POST['award'];
	$psy=$_POST['psy'];
	
	$susp=$_POST['susp'];
	$medication=$_POST['medication'];
	$phl=$_POST['phl'];
	$cause=$_POST['cause'];
	
	//print_r($_GET);
	//print_r($_POST);
	
	
	
	
$quer3=fetchrow(execute("select student_id FROM `register` where student_id='$student_id'"));

if($quer3[0])
{
	$query="UPDATE `register` SET `ish_start_date`='$ish_start_date',`us_grade_level`='$us_grade_level',`student_email`='$student_email',`passport_no`='$passport_no',`date_of_issue`='$date_of_issue',
`date_of_expiration`='$date_of_expiration',`visa_type`='$visa_type', `other_type`='$other_type',`other_type_x`='$other_type_x',
`pre_school_name`='$pre_school_name',`pre_school_language`='$pre_school_language',`pre_school_address`='$pre_school_address',
`pre_school_city`='$pre_school_city',`pre_school_state`='$pre_school_state',`pre_school_country`='$pre_school_country',`pre_school_doj`='$pre_school_doj',
`pre_school_ldate`='$pre_school_ldate',`pre_school_grade_from`='$pre_school_grade_from',`pre_school_grade_to`='$pre_school_grade_to',`pre_school_cur_type`='$pre_school_cur_type',`pre_school_year_begin`='$pre_school_year_begin',`pre_school_name2`='$pre_school_name2',`pre_school_language2`='$pre_school_language2',
`pre_school_address2`='$pre_school_address2',`pre_school_city2`='$pre_school_city2',`pre_school_state2`='$pre_school_state2',`pre_school_country2`='$pre_school_country2',
`pre_school_doj2`='$pre_school_doj2',`pre_school_ldate2`='$pre_school_ldate2',`pre_school_grade_from2`='$pre_school_grade_from2',`pre_school_grade_to2`='$pre_school_grade_to2',
`pre_school_cur_type2`='$pre_school_cur_type2',`pre_school_year_begin2`='$pre_school_year_begin2',`ish_student`='$ish_student',`ish_student_from`='$ish_student_from',
`ish_student_to`='$ish_student_to',`pre_ish_student`='$pre_ish_student',`pre_ish_student_doj`='$pre_ish_student_doj',`student_native_lang`='$student_native_lang',
`student_native_language2`='$student_native_language2',`student_home_lang`='$student_home_lang',`father_native_lang`='$father_native_lang',
`father_native_language2`='$father_native_language2',`father_home_lang`='$father_home_lang',`mother_native_lang`='$mother_native_lang',
`mother_native_language2`='$mother_native_language2',`mother_home_lang`='$mother_home_lang',`eng_exp`='$eng_exp',`esl`='$esl',`rem_inst`='$rem_inst',`retained`='$retained',
`ses`='$ses',`award`='$award',`psy`='$psy',`susp`='$susp',`medication`='$medication',`phl`='$phl',`cause`='$cause' WHERE student_id='$student_id'";

}
else
{
	$query="INSERT INTO `register`(`student_id`, `ish_start_date`, `us_grade_level`, `student_email`, `passport_no`, `date_of_issue`, `date_of_expiration`, `visa_type`, `other_type`,  `other_type_x`,`pre_school_name`, `pre_school_language`, `pre_school_address`, `pre_school_city`, `pre_school_state`, `pre_school_country`, `pre_school_doj`, `pre_school_ldate`, `pre_school_grade_from`, `pre_school_grade_to`, `pre_school_cur_type`, `pre_school_year_begin`, `pre_school_name2`, `pre_school_language2`, `pre_school_address2`, `pre_school_city2`, `pre_school_state2`, `pre_school_country2`, `pre_school_doj2`, `pre_school_ldate2`, `pre_school_grade_from2`, `pre_school_grade_to2`, `pre_school_cur_type2`, `pre_school_year_begin2`, `ish_student`, `ish_student_from`, `ish_student_to`, `pre_ish_student`, `pre_ish_student_doj`, `student_native_lang`, `student_native_language2`, `student_home_lang`, `father_native_lang`, `father_native_language2`, `father_home_lang`, `mother_native_lang`, `mother_native_language2`, `mother_home_lang`, `eng_exp`, `esl`, `rem_inst`, `retained`, `ses`, `award`, `psy`, `susp`, `medication`, `phl`, `cause`) VALUES('$student_id', '$ish_start_date', '$us_grade_level', '$student_email', '$passport_no', '$date_of_issue', '$date_of_expiration', '$visa_type', '$other_type','$other_type_x', '$pre_school_name', '$pre_school_language', '$pre_school_address', '$pre_school_city', '$pre_school_state', '$pre_school_country', '$pre_school_doj', '$pre_school_ldate', '$pre_school_grade_from', '$pre_school_grade_to', '$pre_school_cur_type', '$pre_school_year_begin', '$pre_school_name2', '$pre_school_language2', '$pre_school_address2', '$pre_school_city2', '$pre_school_state2', '$pre_school_country2', '$pre_school_doj2', '$pre_school_ldate2', '$pre_school_grade_from2', '$pre_school_grade_to2', '$pre_school_cur_type2', '$pre_school_year_begin2', '$ish_student', '$ish_student_from', '$ish_student_to', '$pre_ish_student', '$pre_ish_student_doj', '$student_native_lang', '$student_native_language2', '$student_home_lang', '$father_native_lang', '$father_native_language2', '$father_home_lang', '$mother_native_lang', '$mother_native_language2', '$mother_home_lang', '$eng_exp', '$esl', '$rem_inst', '$retained', '$ses', '$award', '$psy', '$susp', '$medication', '$phl', '$cause')";
}

    $result=execute($query);
	
	
   
	if($result) 
	{
		?>
        <script language="javascript">
		alert("Updated Sucessfully");
        </script>
        <?php
		
	}
}
//data fetching 
	$quer=execute("select * FROM `register` where student_id='$student_id'");
	while($row5=fetcharray($quer))
	{
		#### TO CONVERT DATE FORMAT(YYYY-MM-DD) ####
		$ish_start_date=$row5['ish_start_date'];
		$dateArray=explode('-',$ish_start_date);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$ish_start_date="$acq_yy-$acq_mm-$acq_dd";
		else
		$ish_start_date="";
		#############################################
		
		$us_grade_level=$row5['us_grade_level'];
		$student_email=$row5['student_email'];
		$passport_no=$row5['passport_no'];
	
		$date_of_issue=$row5['date_of_issue'];
		$dateArray=explode('-',$date_of_issue);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$date_of_issue="$acq_yy-$acq_mm-$acq_dd";
		else
		$date_of_issue="";
		
		$date_of_expiration=$row5['date_of_expiration'];
		$dateArray=explode('-',$date_of_expiration);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$date_of_expiration="$acq_yy-$acq_mm-$acq_dd";
		else
		$date_of_expiration="";
		
		$visa_type=$row5['visa_type'];
		$other_type=$row5['other_type'];
		$other_type_x=$row5['other_type_x'];
		
	
		
	
		$pre_school_name=$row5['pre_school_name'];
		$pre_school_language=$row5['pre_school_language'];
		$pre_school_address=$row5['pre_school_address'];
		$pre_school_city=$row5['pre_school_city'];
		$pre_school_state=$row5['pre_school_state'];
		$pre_school_country=$row5['pre_school_country'];
		
		
		$pre_school_doj=$row5['pre_school_doj'];
		$dateArray=explode('-',$pre_school_doj);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$pre_school_doj="$acq_yy-$acq_mm-$acq_dd";
		else
		$pre_school_doj="";
		
		$pre_school_ldate=$row5['pre_school_ldate'];
		$dateArray=explode('-',$pre_school_ldate);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$pre_school_ldate="$acq_yy-$acq_mm-$acq_dd";
		else
		$pre_school_ldate="";
		
		$pre_school_grade_from=$row5['pre_school_grade_from'];
		$pre_school_grade_to=$row5['pre_school_grade_to'];
		
		$pre_school_cur_type=$row5['pre_school_cur_type'];
		
		
		$pre_school_year_begin=$row5['pre_school_year_begin'];
		$dateArray=explode('-',$pre_school_year_begin);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$pre_school_year_begin="$acq_yy-$acq_mm-$acq_dd";
		else
		$pre_school_year_begin="";
		
		$pre_school_name2=$row5['pre_school_name2'];
		$pre_school_language2=$row5['pre_school_language2'];
		$pre_school_address2=$row5['pre_school_address2'];
		$pre_school_city2=$row5['pre_school_city2'];
		$pre_school_state2=$row5['pre_school_state2'];
		$pre_school_country2=$row5['pre_school_country2'];
		
		$pre_school_doj2=$row5['pre_school_doj2'];
		$dateArray=explode('-',$pre_school_doj2);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$pre_school_doj2="$acq_yy-$acq_mm-$acq_dd";
		else
		$pre_school_doj2="";
		
		$pre_school_ldate2=$row5['pre_school_ldate2'];
		$dateArray=explode('-',$pre_school_ldate2);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$pre_school_ldate2="$acq_yy-$acq_mm-$acq_dd";
		else
		$pre_school_ldate2="";
		
		$pre_school_grade_from2=$row5['pre_school_grade_from2'];
		$pre_school_grade_to2=$row5['pre_school_grade_to2'];
		$pre_school_cur_type2=$row5['pre_school_cur_type2'];
		
		$pre_school_year_begin2=$row5['pre_school_year_begin2'];
		$dateArray=explode('-',$pre_school_year_begin2);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$pre_school_year_begin2="$acq_yy-$acq_mm-$acq_dd";
		else
		$pre_school_year_begin2="";
		
		$ish_student=$row5['ish_student'];
		
		$ish_student_from=$row5['ish_student_from'];
		$dateArray=explode('-',$ish_student_from);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$ish_student_from="$acq_yy-$acq_mm-$acq_dd";
		else
		$ish_student_from="";
		
		$ish_student_to=$row5['ish_student_to'];
		$dateArray=explode('-',$ish_student_to);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$ish_student_to="$acq_yy-$acq_mm-$acq_dd";
		else
		$ish_student_to="";
		
		$pre_ish_student=$row5['pre_ish_student'];
		
		$pre_ish_student_doj=$row5['pre_ish_student_doj'];
		$dateArray=explode('-',$pre_ish_student_doj);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$pre_ish_student_doj="$acq_yy-$acq_mm-$acq_dd";
		else
		$pre_ish_student_doj="";
	
		$student_native_lang=$row5['student_native_lang'];
		$student_native_language2=$row5['student_native_language2'];
		$student_home_lang=$row5['student_home_lang'];
		
		$father_native_lang=$row5['father_native_lang'];
		$father_native_language2=$row5['father_native_language2'];
		$father_home_lang=$row5['father_home_lang'];
		
		$mother_native_lang=$row5['mother_native_lang'];
		$mother_native_language2=$row5['mother_native_language2'];
		$mother_home_lang=$row5['mother_home_lang'];
		
		$eng_exp=$row5['eng_exp'];
		$esl=$row5['esl'];
		$rem_inst=$row5['rem_inst'];
		$retained=$row5['retained'];
		$ses=$row5['ses'];
		$award=$row5['award'];
		$psy=$row5['psy'];
		
		$susp=$row5['susp'];
		$medication=$row5['medication'];
		$phl=$row5['phl'];
		$cause=$row5['cause'];
	}
	//
	
	
	
	
	
	
	
	
?>
<!--###########################################################   UPDATE RECORDS   ############################################################################-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
	<meta http-equiv="expires" content="3600" />
    <meta name="revisit-after" content="1 days" />
	
    <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
	<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>	
	<script language="javascript" type="text/javascript">

</script>
        

</head>

<body >
<center/>

<center>
<table border="0" cellpadding="0" cellspacing="0" width="1000" align="center" >
<tbody>
         
        <td colspan="2" ><div align="center">
                <fieldset style="border:groove; width: 1000px; align:left; border-color:#A9E7D2;">
				
    <!--###################################   UPDATE RECORDS HERE  ###################################--> 
	
	
     <form  name="frmUpt" id="frmUpt"  method="POST"  action=""> 
     <input type="hidden" name="student_id" value="<?=$student_id?>" />            
   
	<fieldset style="border:groove; width: 900px; align:left;">
		<legend>Educational Information </legend>
			<table width="870" height="120">
	
   <?php		
   ?>
   <tr>
      <td width="500" title="Format :dd-mm-yyyy">Anticipated Starting Date at International School of Hyderabad : </td>
	   <td width="160"><input type="text" readonly name="ish_start_date" id="ish_start_date" value="<?=$ish_start_date?>" size="10">
       <img src="../images/calendar.jpg" align="absmiddle" onclick="displayCalendar(document.forms[0].ish_start_date,'dd-mm-yyyy',this)">
	  </td>
	  <div id="debug"></div>
   </tr>
   
    <tr>
	  <td width="500">Applying for Admission to US System Grade level </td>
      <td width="100"><input name="us_grade_level" id="us_grade_level" type="text" size="45" maxlength="50" value="<?=$us_grade_level?>" /></td>
  </tr>
   
    <tr>
      <td width="500">Student's Email Address (mandatory for HS students, so school counsellor may communicate directly with student) </td>
      <td width="100"><input name="student_email" id="student_email" type="text" size="45" maxlength="50" value="<?=$student_email?>" /></td>
   </tr>
  
  </table>
</fieldset><br/>

<fieldset style="border:groove; width: 900px; align:left;">
				  <legend> Passport Information </legend>
				     <table width="870" height="80" align="center">
	
   <tr>
   
	  <td width="110"> Passport No. </td>
      <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td>
   
    
	  <td width="130" title="Format :dd-mm-yyyy"> Date of Issue </td>
	  <td width="170"><input type="text"  readonly name="date_of_issue" id="date_of_issue" value="<?=$date_of_issue?>" size="10"  >
      <img src="../images/calendar.jpg" align="absmiddle" onclick="displayCalendar(document.forms[0].date_of_issue,'dd-mm-yyyy',this)">
	  </td>
	  <div id="debug"></div>
	   
	  <td width="160" title="Format :dd-mm-yyyy"> Date of Expiration </td>
	  <td width="170"><input type="text" readonly name="date_of_expiration" id="date_of_expiration" value="<?=$date_of_expiration?>" size="10">
      <img src="../images/calendar.jpg" align="absmiddle"  onclick="displayCalendar(document.forms[0].date_of_expiration,'dd-mm-yyyy',this)">
	  </td>
	  <div id="debug"></div>

	  
  </tr>
  
  
  </table>   
</fieldset><br/>
                  		  
    <fieldset style="border:groove; width: 900px; align:left;">
	    <legend style="border-color:red;">Visa Information </legend>
		    <table width="870" height="30" align="center">
					 
					 
  <tr>
					
      <td width="1250" title="Select any one of the following">Type of Visa ( Please Check One ) </td>
    
   </tr>
     
  
   <tr>
<?php
if($visa_type==2)
{
	$visa_type_se1='';
	$visa_type_se2='checked="checked"';
	$visa_type_se3='';
	$visa_type_se4='';
}
else if($visa_type==3)
{
	$visa_type_se1='';
	$visa_type_se2='';
	$visa_type_se3='checked="checked"';
	$visa_type_se4='';
}
else if($visa_type==4)
{
	$visa_type_se1='';
	$visa_type_se2='';
	$visa_type_se3='';
	$visa_type_se4='checked="checked"';
}
else
{
	$visa_type_se1='checked="checked"';
	$visa_type_se2='';
	$visa_type_se3='';
	$visa_type_se4='';
}

?>   
      <td width="300"><br/><label><input type="radio" name="visa_type"  value="1"  <?=$visa_type_se1?>>Non-Immigrant : Diplomatic</label>
      <td width="1700"><br/><label><input type="radio" name="visa_type"  value="2" <?=$visa_type_se2?>>Indian Passport holder, no visa needed </label>
   </tr>
   <tr>
      <td width="650"><br/><label><input type="radio" name="visa_type"  value="3" <?=$visa_type_se3?>>Other : Please Specify</label>
      <input type="text" name="other_type"  size="15" maxlength="50" value="<?=$other_type?>" ></td>
     
	  <td width="650" title="Description of your passport"><br/><label><input type="radio" name="visa_type" value="4" <?=$visa_type_se4?>>   Non-Immigrant : Type X (Please Specify)
	  </label><input type="text" name="other_type_x"  size="15" maxlength="50" value="<?=$other_type_x?>" >  </td>
    
	  
	 
  </tr>
  
  </table>
</fieldset><br/>
     <fieldset style="border:groove; width: 900px; align:left;">
	      <legend>Educational History Information </legend>

	
       <table width="870" height="150">
		
		
  <tr>
    
	<b>Previous Schools attended ( List most recent first )</b><br/><br/>
    <td width="50">School Name  </td>
    <td width="50"><input type="text" name="pre_school_name" id="pre_school_name" size="15" maxlength="55" value="<?=$pre_school_name?>" /></td>
	
    
    <td width="50">Language of Instruction  </td>
    <td width="50"><input type="text" name="pre_school_language" id="pre_school_language" size="15" maxlength="55" value="<?=$pre_school_language?>" /></td>
	
 
  </tr>
  
  <tr>
    <td width="50">Address  </td>
    <td width="50"><input type="text" name="pre_school_address" id="pre_school_address" size="15" maxlength="255" value="<?=$pre_school_address?>" /></td>
	
    
    <td width="50">City </td>
    <td width="50"><input name="pre_school_city" type="text" size="15" maxlength="55" value="<?=$pre_school_city?>" /></td>
	
  </tr>
   
  
  
   <tr>
     <td width="50">State/Province </td>
     <td width="50"><input name="pre_school_state" type="text" size="15" maxlength="22" value="<?=$pre_school_state?>" /></td>

	
     <td width="50">Country </td>
     <td width="50"><input name="pre_school_country" type="text" size="15" maxlength="22" value="<?=$pre_school_country?>" /></td>
	
   </tr>
    
   <tr>
      <td width="50" title="Format :dd-mm-yyyy">Join Date </td>
	  <td width="130"><input type="text" readonly name="pre_school_doj" value="<?=$pre_school_doj?>" size="10">
      <img src="../images/calendar.jpg" align="absmiddle" onclick="displayCalendar(document.forms[0].pre_school_doj,'dd-mm-yyyy',this)">
	 </td>
	  <div id="debug"></div>
 
      <td width="50" title="Format :dd-mm-yyyy">Leave Date </td>
	  <td width="130"><input type="text" readonly name="pre_school_ldate" size="10" value="<?=$pre_school_ldate?>" >
      <img src="../images/calendar.jpg" align="absmiddle"  onclick="displayCalendar(document.forms[0].pre_school_ldate,'dd-mm-yyyy',this)">
</td>
	  <div id="debug"></div>
	  
  
	</tr>
	
   <tr>
      <td width="50">Grade Level(from) </td>
      <td width="50"><input name="pre_school_grade_from" type="text" size="15" maxlength="55" value="<?=$pre_school_grade_from?>" /></td>
	 
    
      <td width="50">Grade Level(to) </td>
      <td width="50"><input name="pre_school_grade_to" type="text" size="15" maxlength="55" value="<?=$pre_school_grade_to?>" /></td>
	 
	</tr>
	
	<tr>
		 <td width="200">Type of Curriculum (American,British etc.) </td>
         <td width="50"><input name="pre_school_cur_type" type="text" size="15" maxlength="55" value="<?=$pre_school_cur_type?>" /></td>
		 
		 <td width="200" title="Format :dd/mm/yyyy">Previous academic year begin ? </td>
		 <td width="130"><input type="text" readonly name="pre_school_year_begin" size="10" value="<?=$pre_school_year_begin?>" >
         <img src="../images/calendar.jpg"  onclick="displayCalendar(document.forms[0].pre_school_year_begin,'dd-mm-yyyy',this)" align="absmiddle" >
	    </td>
	     <div id="debug"></div>
	</tr>
	
	
  </table>
 </fieldset><br/>  
 <fieldset style="border:groove; width: 900px; align:left;">
	      <legend>Educational History Information </legend>

	
       <table width="870" height="150">
		
		
  <tr>
    
	<b>Previous Schools attended ( List most recent first )</b><br/><br/>
    <td width="50">School Name  </td>
    <td width="50"><input name="pre_school_name2" type="text" size="15" maxlength="55" value="<?=$pre_school_name2?>" /></td>
	
    
    <td width="50">Language of Instruction  </td>
    <td width="50"><input name="pre_school_language2" type="text" size="15" maxlength="22" value="<?=$pre_school_language2?>" /></td>
	
 
  </tr>
  
  <tr>
    <td width="50">Address  </td>
    <td width="50"><input name="pre_school_address2" type="text" size="15" maxlength="255" value="<?=$pre_school_address2?>" /></td>

    
    <td width="50">City </td>
    <td width="50"><input name="pre_school_city2" type="text" size="15" maxlength="22" value="<?=$pre_school_city2?>" /></td>
	
  </tr>
   
  
  
   <tr>
     <td width="50">State/Province </td>
     <td width="50"><input name="pre_school_state2" type="text" size="15" maxlength="22" value="<?=$pre_school_state2?>" /></td>
	 
	
     <td width="50">Country </td>
     <td width="50"><input name="pre_school_country2" type="text" size="15" maxlength="22" value="<?=$pre_school_country2?>" /></td>
	
   </tr>
   
   <tr>
      <td width="50" title="Format :dd-mm-yyyy">Join Date </td>
	  <td width="130"><input type="text" readonly name="pre_school_doj2" size="10" value="<?=$pre_school_doj2?>" >
      <img src="../images/calendar.jpg" align="absmiddle" onclick="displayCalendar(document.forms[0].pre_school_doj2,'dd-mm-yyyy',this)">
	 </td>
	  <div id="debug"></div>
      
      <td width="50" title="Format :dd-mm-yyyy">Leave Date </td>
	  <td width="130"><input type="text" readonly name="pre_school_ldate2" size="10" value="<?=$pre_school_ldate2?>" >
      <img src="../images/calendar.jpg"  onclick="displayCalendar(document.forms[0].pre_school_ldate2,'dd-mm-yyyy',this)" align="absmiddle" >
	 </td>
	  <div id="debug"></div>
   
	</tr>
	
   <tr>
      <td width="50">Grade Level(from) </td>
      <td width="50"><input name="pre_school_grade_from2" type="text" size="15" maxlength="22" value="<?=$pre_school_grade_from2?>" /></td>
	  
    
      <td width="50">Grade Level(to) </td>
      <td width="50"><input name="pre_school_grade_to2" type="text" size="15" maxlength="22" value="<?=$pre_school_grade_to2?>" /></td>
	  
	</tr>
	
	<tr>
		 <td width="200">Type of Curriculum (American,British etc.) </td>
         <td width="50"><input name="pre_school_cur_type2" type="text" size="15" maxlength="22" value="<?=$pre_school_cur_type2?>" /></td>
	  
		 <td width="200" title="Format :dd-mm-yyyy">Previous academic year begin ? </td>
		 <td width="130"><input type="text" readonly name="pre_school_year_begin2" size="10" value="<?=$pre_school_year_begin2?>" >
         <img src="../images/calendar.jpg"  onclick="displayCalendar(document.forms[0].pre_school_year_begin2,'dd-mm-yyyy',this)" align="absmiddle" >
	    </td>
	     <div id="debug"></div>
	</tr>
	
	
  </table>
 </fieldset><br/>  
 <fieldset style="border:groove; width: 900px; align:left;">
				  <legend>School  Information </legend>
				  <table width="870" height="100">
   
  <tr>
	  <td width="500">Was this student previously enroll at International School of Hyderabad </td>
      <td width="150"><label>
      <?php
	  if($ish_student==1)
	  $ish_studentdes1='checked="checked" ';
	  else
	  $ish_studentdes2='checked="checked" ';
	  ?>
      <input type="radio" name="ish_student" value="1"  <?=$ish_studentdes1?> >Yes</label>
	  <label><input type="radio" name="ish_student" value="0" <?=$ish_studentdes2?>>No</label></td>
    
      <td width="120" title="Format :dd-mm-yyyy">If, Yes from </td>
	  <td width="130"><input type="text" readonly name="ish_student_from" size="10" value="<?=$ish_student_from?>" >
      <img src="../images/calendar.jpg"  onclick="displayCalendar(document.forms[0].ish_student_from,'dd-mm-yyyy',this)" align="absmiddle" >
	  </td>
	  <div id="debug"></div>
     
	   <td width="50" title="Format :dd-mm-yyyy">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;to </td>
	   <td width="160"><input type="text" readonly name="ish_student_to" size="10" value="<?=$ish_student_to?>" >
       <img src="../images/calendar.jpg"  onclick="displayCalendar(document.forms[0].ish_student_to,'dd-mm-yyyy',this)" align="absmiddle" >
	   </td>
	   <div id="debug"></div>
   </tr>
 
   <tr>
	   <td width="500">Has this student previously applied for admission to ISH </td>
       <td width="150">
      <?php
	  if($pre_ish_student==1)
	  $pre_ish_student1='checked="checked" ';
	  else
	  $pre_ish_student2='checked="checked" ';
	  ?>
<label><input type="radio" name="pre_ish_student" value="1"<?=$pre_ish_student1?> >Yes</label>
	   <label><input type="radio" name="pre_ish_student" value="0"  /<?=$pre_ish_student2?> >No</label></td>
      
       <td width="120" title="Format :dd-mm-yyyy">If, Yes When</td>
	   <td width="160"><input type="text" readonly name="pre_ish_student_doj" size="10" value="<?=$pre_ish_student_doj?>" >
       <img src="../images/calendar.jpg" onclick="displayCalendar(document.forms[0].pre_ish_student_doj,'dd-mm-yyyy',this)" align="absmiddle" >
	   </td>
	   <div id="debug"></div>   
   </tr>
 
  
  </table>
</fieldset><br/>
<fieldset style="border:groove; width: 900px; align:left;">
		<legend>Language Information </legend>

	
<table width="870" height="170">
   <tr>
      
	  <td width="200">Student Native Language </td>
	  <td width="50">
        <select name="student_native_lang">
			<?php
            $qqq=execute("select id,lang from language order by lang");
            while($myq=fetcharray($qqq))
            {
				if($student_native_lang==$myq[id])
				{
				echo "<option value='$myq[id]' selected>$myq[lang]</option>";
				}
				else
				{
				echo "<option value='$myq[id]'>$myq[lang]</option>";
				}
            }
            ?>
        </select>
      </td>
	 
      <td width="50">2<sup>nd</sup>&nbsp;Language  </td>
      <td width="50"><select name="student_native_language2">
			<?php
            $qqq=execute("select id,lang from language order by lang");
            while($myq=fetcharray($qqq))
            {
				if($student_native_language2==$myq[id])
				{
				echo "<option value='$myq[id]' selected>$myq[lang]</option>";
				}
				else
				{
				echo "<option value='$myq[id]'>$myq[lang]</option>";
				}
            }
            ?>
        </select>
		</td>
	
 
      <td width="50">Language spoken@home </td>
      <td width="50">
      <select name="student_home_lang">
			<?php
            $qqq=execute("select id,lang from language order by lang");
            while($myq=fetcharray($qqq))
            {
				if($student_home_lang==$myq[id])
				{
				echo "<option value='$myq[id]' selected>$myq[lang]</option>";
				}
				else
				{
				echo "<option value='$myq[id]'>$myq[lang]</option>";
				}
            }
            ?>
        </select></td>
	 
  </tr>
  
  <tr>
      <td width="200">Father's Native Language </td>
      <td width="50">
            <select name="father_native_lang">
			<?php
            $qqq=execute("select id,lang from language order by lang");
            while($myq=fetcharray($qqq))
            {
				if($father_native_lang==$myq[id])
				{
				echo "<option value='$myq[id]' selected>$myq[lang]</option>";
				}
				else
				{
				echo "<option value='$myq[id]'>$myq[lang]</option>";
				}
            }
            ?>
        </select></td>
	 
    
      <td width="75">2<sup>nd</sup>&nbsp;Language  </td>
      <td width="50">
                  <select name="father_native_language2">
			<?php
            $qqq=execute("select id,lang from language order by lang");
            while($myq=fetcharray($qqq))
            {
				if($father_native_language2==$myq[id])
				{
				echo "<option value='$myq[id]' selected>$myq[lang]</option>";
				}
				else
				{
				echo "<option value='$myq[id]'>$myq[lang]</option>";
				}
            }
            ?>
        </select></td>
	
 
      <td width="75">Language spoken@home </td>
      <td width="50">
         <select name="father_home_lang">
			<?php
            $qqq=execute("select id,lang from language order by lang");
            while($myq=fetcharray($qqq))
            {
				if($father_home_lang==$myq[id])
				{
				echo "<option value='$myq[id]' selected>$myq[lang]</option>";
				}
				else
				{
				echo "<option value='$myq[id]'>$myq[lang]</option>";
				}
            }
            ?>
        </select></td>
	  
  </tr>
  
   <tr>
      <td width="200">Mother's Native Language  </td>
      <td width="50">
         <select name="mother_native_lang">
			<?php
            $qqq=execute("select id,lang from language order by lang");
            while($myq=fetcharray($qqq))
            {
				if($mother_native_lang==$myq[id])
				{
				echo "<option value='$myq[id]' selected>$myq[lang]</option>";
				}
				else
				{
				echo "<option value='$myq[id]'>$myq[lang]</option>";
				}
            }
            ?>
        </select></td>
	  
    
      <td width="75">2<sup>nd</sup>&nbsp;Language  </td>
      <td width="50">
               <select name="mother_native_language2">
			<?php
            $qqq=execute("select id,lang from language order by lang");
            while($myq=fetcharray($qqq))
            {
				if($mother_native_language2==$myq[id])
				{
				echo "<option value='$myq[id]' selected>$myq[lang]</option>";
				}
				else
				{
				echo "<option value='$myq[id]'>$myq[lang]</option>";
				}
            }
            ?>
        </select></td>
	
 
      <td width="75">Language spoken@home </td>
      <td width="50">
               <select name="mother_home_lang">
			<?php
            $qqq=execute("select id,lang from language order by lang");
            while($myq=fetcharray($qqq))
            {
				if($mother_home_lang==$myq[id])
				{
				echo "<option value='$myq[id]' selected>$myq[lang]</option>";
				}
				else
				{
				echo "<option value='$myq[id]'>$myq[lang]</option>";
				}
            }
            ?>
        </select></td>
	 
	</tr>
	
  </table>
</fieldset><br/> 
 <fieldset style="border:groove; width: 900px; align:left;">
				  <legend style="border-color:red;">Other  Information </legend>
				  <table width="870" height="100">
  
 
  <tr>
	  <td width="150">Has your child had instruction or experience in English ?</td>
      <td width="100">
      <?php
	  if($eng_exp==1)
	  $eng_exp1='checked="checked" ';
	  else
	  $eng_exp2='checked="checked" ';
	  ?>
     
      <label><input type="radio" name="eng_exp" value="1" <?=$eng_exp1?>>Yes</label>
	  &nbsp;&nbsp;<label><input type="radio" name="eng_exp" value="0" <?=$eng_exp2?>>No</label></td>
     
   </tr>
   
   
   <tr>
	   <td width="150">Has this student been in an English as a Second Language (ESL or ESOL) program at any time  </td>
       <td width="100">
      <?php
	  if($esl==1)
	  $esl1='checked="checked" ';
	  else
	  $esl2='checked="checked" ';
	  ?>
<label><input type="radio" name="esl" value="1" <?=$esl1?> >Yes</label>
	   &nbsp;&nbsp;<label><input type="radio" name="esl" value="0" <?=$esl2?> >No</label></td>
      
   </tr>
   
    <tr>
	   <td width="150">Has this student ever received remedial instruction</td>
       <td width="100">
      <?php
	  if($rem_inst==1)
	  $rem_inst1='checked="checked" ';
	  else
	  $rem_inst2='checked="checked" ';
	  ?>
       <label><input type="radio" name="rem_inst" value="1" <?=$rem_inst1?>>Yes</label>
	   &nbsp;&nbsp;<label><input type="radio" name="rem_inst" value="0" <?=$rem_inst2?>>No</label></td>
       
   </tr>
  
   
   <tr>
	   <td width="150">Has this student ever been retained or repeated a grade level</td>
       <td width="100">
      <?php
	  if($retained==1)
	  $retained1='checked="checked" ';
	  else
	  $retained2='checked="checked" ';
	  ?>
       <label><input type="radio" name="retained" value="1" <?=$retained1?>>Yes</label>
	   &nbsp;&nbsp;<label><input type="radio" name="retained" value="0" <?=$retained2?>>No</label></td>
      
   </tr>
  
   
   <tr>
	   <td width="150">Has this student ever received special education services </td>
       <td width="100">
      <?php
	  if($ses==1)
	  $ses1='checked="checked" ';
	  else
	  $ses2='checked="checked" ';
	  ?>
       <label><input type="radio" name="ses" value="1" <?=$ses1?>>Yes</label>
	   &nbsp;&nbsp;<label><input type="radio" name="ses" value="0" <?=$ses?> >No</label></td>
       
   </tr>
   
   
   <tr>
	   <td width="150">Has this student ever been in a gifted and talented program</td>
       <td width="100">
      <?php
	  if($award==1)
	  $award1='checked="checked" ';
	  else
	  $award2='checked="checked" ';
	  ?>
       <label><input type="radio" name="award" value="1" <?=$award1?>>Yes</label>
	   &nbsp;&nbsp;<label><input type="radio" name="award" value="0" <?=$award2?>>No</label></td>
    
   </tr>
  
   
   <tr>
	   <td width="150">Has this student ever been evaluated by an educational psychologist or specialist</td>
       <td width="100">
      <?php
	  if($psy==1)
	  $psy1='checked="checked" ';
	  else
	  $psy2='checked="checked" ';
	  ?>
       <label><input type="radio" name="psy" value="1" <?=$psy1?>>Yes</label>
	   &nbsp;&nbsp;<label><input type="radio" name="psy" value="0" <?=$psy2?>>No</label></td>
       
   </tr>
   
   
   <tr>
	   <td width="150">Has this student ever been suspended or expelled from any school for any reason</td>
       <td width="100">
      <?php
	  if($susp==1)
	  $susp1='checked="checked" ';
	  else
	  $susp2='checked="checked" ';
	  ?>
       <label><input type="radio" name="susp" value="1" <?=$susp1?> >Yes</label>
	   &nbsp;&nbsp;<label><input type="radio" name="susp" value="0" <?=$susp2?> >No</label></td>
       
   </tr>
   
   <tr>
	   <td width="150">Is this student taking any medication on a regular basis</td>
       <td width="100">
      <?php
	  if($medication==1)
	  $medication1='checked="checked" ';
	  else
	  $medication2='checked="checked" ';
	  ?>
       <label><input type="radio" name="medication" value="1"<?=$medication1?> >Yes</label>
	   &nbsp;&nbsp;<label><input type="radio" name="medication" value="0" <?=$medication2?>>No</label></td>
       
   </tr>
	
   <tr>
	   <td width="150">Does this student have any Physical health limitations </td>
       <td width="100">
      <?php
	  if($phl==1)
	  $phl1='checked="checked" ';
	  else
	  $phl2='checked="checked" ';
	  ?>
	<label><input type="radio" name="phl" value="1" <?=$phl1?>>Yes</label>
	   &nbsp;&nbsp;<label><input type="radio" name="phl" value="0" <?=$phl2?>>No</label></td>
     
   </tr>
   
  <tr>
	   <td width="50">If  "YES" to any of the above, please explain :  </td></tr><tr>
       <td><textarea name="cause" id="cause" cols="68" rows="3" tabindex="1" maxlength="255" ><?=$cause?></textarea></td>
	  
   </tr>

 
  </table>
</fieldset><br/>
           <input name="Submit" type="submit" width="30" height="8" class="bgbutton" value=" Update " />        
			 </form>
	   </fieldset >
	             
</body>
</html>


