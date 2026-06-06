<?PHP
session_start();
require("../db1.php");

//print_r($_GET);



	$name=execute("SELECT *  FROM college");
    
	while($rc=fetcharray($name))
	{
		$_SESSION['SchoolName']=$rc['col_name'];
		$_SESSION['SchoolCode']=$rc['col_code'];
		$_SESSION['SchoolAddress']=$rc['col_addr']." ".$rc['col_city']." ".$rc['col_state']." Pin : ".$rc['col_pin'];
	}
	$date1=date("Y-m-d");
	$sql_id=fetcharray(execute("select acc_year from academic_year where  status=1 and ( '$date1' Between from_date and to_date )"));
	
	
	$a_year=$sql_id[0];

//$a_year = $_SESSION['AcademicYear'];

if($_GET)
{
	$sem=$_GET['sem'];
	$unit=$_GET['unit'];
	$term=$_GET['term'];
	$branch=$_GET['branch'];
	$student_id=$_GET['student_id'];
}

	$studentDet=fetcharray(execute("SELECT `first_name`,`middle_name`,`last_name`,`dob`,`student_id`,`course_yearsem`,`admission_date` FROM `student_m` WHERE `id`='$student_id'"));
	
	$termDet=fetcharray(execute("SELECT `start_date` FROM `academic_term` WHERE `a_year`='$a_year'"));
	/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/
	


?>

<!DOCTYPE html>
<head>
<title>STUDENT ASSESSMENT</title>
<style type="text/css">
<!--
body {	
	background-image:url('Logo2.jpg');
	background-position:top;  
	background-repeat:no-repeat;
	background-size: 1000px;
	font-size: 18px;
	border-bottom-left-radius:13px;
	border-bottom-right-radius:13px;
	border-top-left-radius:13px;
	border-top-right-radius:13px;
	font-family:"Times New Roman","serif";
}

table.forumline	{ 
	font-family:"Times New Roman","serif";
	font-weight: normal;
	font-size: 18px;
	border:thin;
	border-spacing: 5px;
	margin-top: 0px;
	padding-top:25px;
	padding-bottom:25px;
	padding-right:50px;
	padding-left:50px;
}

td{
	text-align:justify;
}

/*td.clsname { 
	border-bottom:thin;
	border-bottom-color:#999;
	font-family:"Times New Roman","serif";
	font-size: 12px;
	color: #404040;
	background-color:#CCC;
	//text-align: left;
	padding-left: 3px;
}*/
-->
</style>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="forumline">
<div align="center"><img src="oberoilogo.png" height="200" width="180"></div><BR>
<div align="center"><font size="6px"><b>SECONDARY SCHOOL REPORT</b></font></div>
<tr >
	<td align="left" width="50%"><b>Student Name</b></td>
    <td align="left" width="35%" >: <?=$studentDet['first_name']?>&nbsp;<?=$studentDet['middle_name']?>&nbsp;
	<?=$studentDet['last_name']?></td>
</tr>
<tr>
	<td align="left" ><b>Date of Birth</b></td>
    <? 
	
	if($studentDet['dob']=="1970-01-01" or $studentDet['dob']=="0000-00-00" ){
		$dob = '';
	}
	else{
		$dob = date("d/m/Y", strtotime($studentDet['dob']));
	}
	?>
    
    <td align="left" >: <?=$dob?></td>
   
</tr>
<tr>
	<td align="left" ><b>Student UD ID</b></td>
    <td align="left" >: <?=$studentDet['student_id']?></td>
</tr>
<tr>
	<td align="left" ><b>Grade</b></td>
    <td align="left" >: <?=$studentDet['course_yearsem']?></td>
</tr>
<tr>
	<td align="left" ><b>Commenced</b></td>
    <? 
	if($studentDet['admission_date']=="1970-01-01" or $studentDet['admission_date']=="0000-00-00" ){
		$Commenced = '';
	}
	else{
		$Commenced = date("d/m/Y", strtotime($studentDet['admission_date']));
	}
	?>  
    
    <td align="left" >: <?=$Commenced?></td>
</tr>
<tr>
	<td align="left"  colspan="2">&nbsp;</td>
</tr>
<tr>
	<td align="left"  colspan="2"><b>Grade Brand :</b></td>
</tr>
<tr>
	<td align="left"  ><b>Letter</b></td>
    <td align="left"  ><b>Word Descriptor</b></td>
</tr>
<tr>
	<td align="left"  >A+</td>
    <td align="left"  >Outstanding</td>
</tr>
<tr>
	<td align="left"  >A</td>
    <td align="left"  >Excellent</td>
</tr>
<tr>
	<td align="left"  >B+</td>
    <td align="left"  >Very Good</td>
</tr>
<tr>
	<td align="left"  >B</td>
    <td align="left"  >Good</td>
</tr>
<tr>
	<td align="left"  >C+</td>
    <td align="left"  >Satisfactory</td>
</tr>
<tr>
	<td align="left" >C</td>
    <td align="left" >Adequate</td>
</tr>
<tr>
	<td align="left" >D+</td>
    <td align="left" >Below Average</td>
</tr>
<tr>
	<td align="left" >D</td>
    <td align="left" >Poor</td>
</tr>
<tr>
	<td align="left" >F</td>
    <td align="left" >Fail</td>
</tr>
</table>
 <table align="center" class="" border="1" width="90%" cellpadding="0" cellspacing="0" bordercolor="#000000">
   <tr>
          <td align="center" style="background-color:#91D04E">&nbsp;<b>Subject</b></td>
          <td align="center" style="background-color:#91D04E">&nbsp;<b>Teacher</b></td>
          <td align="center" style="background-color:#91D04E"><center>&nbsp;<b>Semester 1<hr>&nbsp;Grade</b></center></td>
          <td align="center" style="background-color:#91D04E"><center>&nbsp;<b>Semester 1<hr>&nbsp;Grade</b></center></td>
          <td align="center" style="background-color:#91D04E"><center>&nbsp;<b>End of Year<hr>&nbsp;Grade</b></center></td>
     </tr><tr>
  <?
  
  	$sql=execute("SELECT * FROM student_course a,class_section b,subject_m c WHERE a.stu_id='$student_id' and a.acc_year='$a_year' and a.sub_sec=b.id  AND b.status=1 AND c.subject_id=b.sub AND c.sub_type!=2 AND b.grade!=0 group by sub_sec");
	
 while($r=fetcharray($sql))
 {
	
	$teacherID=fetcharray(execute("SELECT sub_teac,sub_teac2 FROM all_teachers WHERE section='$r[sub_sec]' AND acc_year='$a_year'"));	
	$className=fetcharray(execute("SELECT codename,section_name FROM class_section WHERE id='$r[sub_sec]' AND status=1"));
	
	if($teacherID['sub_teac']){
		$teacherName=fetcharray(execute("SELECT `f_name`,`s_name` FROM staff_det WHERE id='$teacherID[sub_teac]' AND `active`='YES'"));
	}
	else
	{
		$teacherName=fetcharray(execute("SELECT `f_name`,`s_name` FROM staff_det WHERE id='$teacherID[sub_teac2]' AND `active`='YES'"));
	}
	
			$tablename='grade_m_'.$r['sub_sec'].'_'.$term;
			
		/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  FOR EDITABLE GRADE xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
			
		$studentMarks=fetcharray(execute("SELECT `category` FROM $tablename WHERE `student_id`='$student_id'"));
		
		$finalMarks='';
		if($studentMarks['category']){
			if($studentMarks['category']==1){
				$finalMarks='A+';
			}elseif($studentMarks['category']==2){
				$finalMarks='A';
			}elseif($studentMarks['category']==3){
				$finalMarks='B+';
			}elseif($studentMarks['category']==4){
				$finalMarks='B';
			}elseif($studentMarks['category']==5){
				$finalMarks='C+';
			}elseif($studentMarks['category']==6){
				$finalMarks='C';
			}elseif($studentMarks['category']==7){
				$finalMarks='D+';
			}elseif($studentMarks['category']==8){
				$finalMarks='D';
			}elseif($studentMarks['category']==9){
				$finalMarks='F';
			}else{
				$finalMarks='';
			}
		}
    //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx	TO FETCH EXSISTING COLUMN NAME	xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

			$subject=$r['sub_sec'];
			
			$tablename='grade_m_'.$subject.'_'.$term;
	

	
	$SqlAvg=execute("SELECT * FROM $tablename WHERE `student_id` = '$student_id' AND `status` = 1 AND `term`='$term'");
		 $rowAvg=rowcount($SqlAvg);
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx


$resultColV=execute("SELECT a.category_id, a.title, a.max_point, a.inserted_date, a.description, a.apply_grade, a.grade_type FROM grade_assessment a ,grade_category b WHERE a.subject=$subject AND a.status=1 AND b.status=1 AND a.category_id=b.id ORDER BY a.category_id");

		$rowCount=rowcount($resultColV);
		
	
		$resultCount=execute("SELECT `id` FROM `grade_assessment` WHERE `subject`=$subject AND `apply_grade`='Y'  AND status=1 ORDER BY category_id");
		$NoRowCount=rowcount($resultCount);
		
				 $sum=0;		 
		while($rCol=fetcharray($resultColV))      
		{
			
			$string = str_replace(' ', '_', $rCol['title']);
			$field=$string.'_'.$rCol['category_id'];
	        
			$tablename='grade_m_'.$subject.'_'.$term;
			
		$colValue=fetcharray(execute("SELECT `category`,$field FROM `$tablename` WHERE `term`='$term' AND student_id='$student_id'"));

		}

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
			
			$avg_sum=0;
			while($rAvg=fetcharray($SqlAvg))
			{	
			
				
				$method=fetcharray(execute("SELECT `cal_method` FROM `grade_setup` WHERE `subject` = '$subject' AND `status`=1"));
				
				$qResult = execute ("SELECT * FROM `grade_avg` WHERE `subject` = '$subject' AND `status` ='1'");
				$itms=fetcharray($qResult);
				
				
				$SqlCat=execute("SELECT `id`,`weight` FROM `grade_category` WHERE `subject` = '$subject' AND `status` = '1'");
			    $rowCountFirst=rowcount($SqlCat); 
				
				while($rf=fetcharray($SqlCat))
				{		
						
	
	$SqlAssm=execute("SELECT `id` FROM `grade_assessment` WHERE `subject` = '$subject' AND `status` =1 AND category_id='$rf[id]'");
					$rowCount=rowcount($SqlAssm); 
				
						$field='avg_'.$rf['id'];
						
						if($method['cal_method']==1){
	
							$points=$rAvg[$field] * $rowCount;
						
				
						}if($method['cal_method']==2){
							
							$avg_sum = $avg_sum + (($rAvg[$field] * $rf['weight']))/100;
				  
						}									
					}

							$avg=$avg_sum;	
											
					
						if($avg <= $itms['avg1'] and $avg > $itms['avg2']){				/*CONDITIONS FOR DISPALY GRADES*/
							$display=$itms['letter1'];		
						}elseif($avg <= $itms['avg2'] and $avg > $itms['avg3']){
							$display=$itms['letter2'];
						}elseif($avg <= $itms['avg3'] and $avg > $itms['avg4']){
							$display=$itms['letter3'];
						}elseif($avg <= $itms['avg4'] and $avg > $itms['avg5']){
							$display=$itms['letter4'];
						}elseif($avg <= $itms['avg5'] and $avg > $itms['avg6']){
							$display=$itms['letter5'];
						}elseif($avg <= $itms['avg6'] and $avg > $itms['avg7']){
							$display=$itms['letter6'];
						}elseif($avg <= $itms['avg7'] and $avg > $itms['avg8']){
							$display=$itms['letter7'];
						}elseif($avg <= $itms['avg8'] and $avg > $itms['avg9']){
							$display=$itms['letter8'];
						}elseif($avg <= $itms['avg9'] and $avg > $itms['avg10']){
							$display=$itms['letter9'];
						}elseif($avg <= $itms['avg10'] and $avg > $itms['avg11']){
							$display=$itms['letter10'];
						}elseif($avg <= $itms['avg11'] and $avg > $itms['avg12']){
							$display=$itms['letter11'];
						}elseif($avg <= $itms['avg12'] and $avg > $itms['avg13']){
							$display=$itms['letter12'];
						}elseif($avg <= $itms['avg13'] and $avg > $itms['avg14']){
							$display=$itms['letter13'];
						}elseif($avg <= $itms['avg14'] and $avg > $itms['avg15']){
							$display=$itms['letter14'];
						}else{
							$display=$itms['letter15'];
						}
						 
			}
			   		
	
					if(!$finalMarks){
						$finalMarks=$display;
					}
					?>

          <td>&nbsp;<?=$className['codename']?> - <?=$className['section_name']?></td>
          <td>&nbsp;<?=$teacherName['f_name']?>&nbsp;<?=$teacherName['s_name']?></td>
          <td align="center"><center><?=$finalMarks?></center></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
     </tr>
    <?
		
 }
  ?>
    </table>
  <BR><BR> 
  <p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </u>
  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <b>Head of Secondary</b></p> 
  
  <BR><BR><BR>
  <table align="center" cellpadding="0" cellspacing="0" width="90%">
     <tr>
        <td><b>Grade Descriptors for Term Marks :</b></td>
     </tr>
     <tr>
        <td><BR>A+ and A</td>
     </tr>
     <tr>
        <td><BR>
        The student demonstrates a consistent and thorough understanding of the required knowledge and skills, and has the ability to apply the knowledge and skills without error in a variety of situations.The student regularly shows evidence of analysis, synthesis and evaluation where appropriate. The student consistently demonstrates originality and insight, and excels in formative and summative assignments.(The student meets and exceeds all required course learning standards.)</td>
      </tr>
	  <tr>
		 <td><BR>B+ and B</td>
	 </tr>
	 <tr>
		<td><BR>
		The student demonstrates a consistent and thorough understanding of the required knowledge and skills, and has the ability to apply the knowledge and skills with few errors in a variety of situations.The  student generally shows evidence of analysis, synthesis and evaluation where appropriate, and occasionally demonstrates originality and insight and does well on most formative and summative assignments.(The student meets all course standards and excels at some of the learning standards.) 
		</td>
	</tr>
	<tr>
		<td><BR>C+ and C</td>
	</tr>
	<tr>
		<td><BR>
		The student has a general understanding of the required knowledge and skills, and has some ability to apply the knowledge and skills effectively in normal situations.There is occasional evidence of the skills of analysis, synthesis and evaluation. The student completes most of the formative and summative assessments.(The student meets all course learning standards.)
		</td>
	</tr>
	<tr>
		<td><BR>D+ and D</td>
	</tr>
	<tr>
		<td><BR>
		The student has limited understating of the required knowledge and skills and is only able to apply the knowledge and skills fully in normally situations with extensive support.The student has difficulty completing formative and summative assessments.(The student does not meet most of the course learning standrads.)
		</td>
	</tr>
	<tr>
		<td><BR>F</td>
	</tr>
	<tr>
		<td><BR>The student does not understand the required knowledge and skills, and unable to apply them fully in normal situations,even with supports. The student is not able to complete formative and summative assessments.(The student does not meet the course learning standards) 
		</td>
	</tr>
   </table>
 <BR><BR><BR>
  <table align="center" class="" border="1" width="90%" cellpadding="0" cellspacing="0" bordercolor="#000000">
   <tr>
          <td align="center" style="background-color:#91D04E" width="20%">&nbsp;<b>Subject</b></td>
          <td align="center" style="background-color:#91D04E" width="20%">&nbsp;<b>Teacher</b></td>
          <td align="center" style="background-color:#91D04E" width="60%">&nbsp;<b>Teacher Comment</b></td>

     </tr>
     <tr>
     <?
       	$sqlC=execute("SELECT * FROM student_course a,class_section b,subject_m c where a.stu_id='$student_id' and a.acc_year='$a_year' and a.sub_sec=b.id  and b.status=1 and c.subject_id=b.sub and c.sub_type!=2 and b.grade!=0 group by sub_sec");
	
 while($rC=fetcharray($sqlC))
 {
	
	$teacherIDC=fetcharray(execute("SELECT sub_teac,sub_teac2 FROM all_teachers WHERE section='$rC[sub_sec]' and acc_year='$a_year'"));	
	$classNameC=fetcharray(execute("SELECT codename,section_name FROM class_section WHERE id='$rC[sub_sec]' AND status=1"));
	
	if($teacherIDC['sub_teac']){
		$teacherNameC=fetcharray(execute("SELECT `f_name`,`s_name` FROM staff_det WHERE id='$teacherIDC[sub_teac]' AND `active`='YES'"));
	}
	else
	{
		$teacherNameC=fetcharray(execute("SELECT `f_name`,`s_name` FROM staff_det WHERE id='$teacherIDC[sub_teac2]' AND `active`='YES'"));
	}
	
			$subject=$rC['sub_sec'];			
			$tablename='grade_m_'.$subject.'_'.$term;
			
	$teacherComment=fetcharray(execute("SELECT `comments` FROM $tablename WHERE student_id='$student_id' AND `status`='1'"));
	?>
    
          <td nowrap>&nbsp;<?=$classNameC['codename']?> - <?=$classNameC['section_name']?></td>
          <td nowrap>&nbsp;<?=$teacherNameC['f_name']?>&nbsp;<?=$teacherNameC['s_name']?>&nbsp;</td>
          <td align="left">&nbsp;<?=$teacherComment['comments']?>&nbsp;</td>          
       </tr>
    <?
 }
?>
</table>
<BR><BR>
</body>
</html>