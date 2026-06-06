<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/


$user = $_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];

if($_GET)
{
	$Type = $_REQUEST['Type'];
	$term = $_REQUEST['term'];
	$subject = $_REQUEST['subject'];
}
if($_POST)
{
    $term=$_POST['term'];   
    $avg1=$_POST['avg1'];				$avg2=$_POST['avg2'];
	$avg3=$_POST['avg3'];				$avg4=$_POST['avg4'];
	$avg5=$_POST['avg5'];				$avg6=$_POST['avg6'];
	$avg7=$_POST['avg7'];				$avg8=$_POST['avg8'];
	$avg9=$_POST['avg9'];				$avg10=$_POST['avg10'];
	$avg11=$_POST['avg11'];				$avg12=$_POST['avg12'];
	$avg13=$_POST['avg13'];				$avg14=$_POST['avg14'];
	$avg15=$_POST['avg15'];

	$letter1=$_POST['letter1'];			$letter2=$_POST['letter2'];
	$letter3=$_POST['letter3'];			$letter4=$_POST['letter4'];
	$letter5=$_POST['letter5'];			$letter6=$_POST['letter6'];
	$letter7=$_POST['letter7'];			$letter8=$_POST['letter8'];
	$letter9=$_POST['letter9'];			$letter10=$_POST['letter10'];
	$letter11=$_POST['letter11'];		$letter12=$_POST['letter12'];
	$letter13=$_POST['letter13'];		$letter14=$_POST['letter14'];
	$letter15=$_POST['letter15'];
	
	$grade_id=$_POST['grade_id'];
	$cap_term=$_POST['cap_term'];
	$subject=$_POST['subject'];

	$copy_class=$_POST['copy_class'];
	$cal_method=$_POST['cal_method'];	
	$cap_category=$_POST['cap_category'];	
	$assignment_sorting=$_POST['assignment_sorting'];
	
}

$size=sizeof($subject);

if($Type == "Add")
{
	for($i=0; $i < $size; ++$i){
	  
	 //$record=execute("SELECT * FROM `grade_avg` WHERE `subject` = '$subject[$i]' AND `status` = 1");
     //$rowCount=rowcount($record);
	 
	 $chk=rowcount(execute("SELECT * FROM `grade_avg` WHERE `subject` = '$subject[$i]' AND `status` = 1"));
	  
	 if($chk < 1)
	 {
		 
	 
	  $sqlAvg="INSERT INTO `grade_avg` (`subject`, `letter1`, `letter2`, `letter3`, `letter4`, `letter5`, `letter6`, `letter7`, `letter8`, `letter9`, `letter10`, `letter11`, `letter12`,`letter13`,`letter14`,`letter15`, `avg1`, `avg2`, `avg3`, `avg4`, `avg5`, `avg6`, `avg7`, `avg8`, `avg9`, `avg10`, `avg11`, `avg12`, `avg13`, `avg14`, `avg15`, `inserted_date`) VALUES ('$subject[$i]', '$letter1', '$letter2', '$letter3', '$letter4', '$letter5', '$letter6', '$letter7', '$letter8', '$letter9', '$letter10', '$letter11', '$letter12','$letter13','$letter14','$letter15', '$avg1', '$avg2', '$avg3', '$avg4', '$avg5', '$avg6', '$avg7', '$avg8', '$avg9', '$avg10', '$avg11', '$avg12', '$avg13', '$avg14', '$avg15', CURDATE())";
	
	//echo "<br>".$sqlAvg;
	$resultAvg = execute($sqlAvg) or die(mysql_error());
		
	$maxID=fetcharray(execute("SELECT MAX(id) FROM `grade_avg` WHERE `subject` = '$subject[$i]' AND `status`=1 LIMIT 1"));
	$grade_id=$maxID[0];
	
	$sqlSetup="INSERT INTO `grade_setup` (`grade_id`, `subject`, `term`, `category_grade`, `term_grade`, `assignment_sorting`, `copy_class`, `cal_method`) VALUES ('$grade_id', '$subject[$i]', '$term', '$cap_category', '$cap_term', '$assignment_sorting', '$copy_class', '$cal_method')";
	
	//echo "<br>".$sqlSetup;
	$resultSetup = execute($sqlSetup) or die(mysql_error());
	
  //+++++++++++++++++++++++++++++    GRADE TABLE FOR MARKS ENTERY    ++++++++++++++++++++++++++++++++++++++++++++++   
	 $tablename='grade_m_'.$subject[$i].'_'.$term;
	 
	 $sqlCreate = "CREATE TABLE $tablename (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY" ;  
	 $sqlCreate .=	' ,`user` VARCHAR(70)  NULL , `a_year` INT(4) NULL, `student_id` INT(5) NULL ';
	 $sqlCreate .=	' ,`term` INT(5)  NULL , `subject` INT(5) NULL, `category` INT(5) NULL ';
	 $sqlCreate .=  ' , `inserted_date` DATE NULL , `status` INT(1)  NULL DEFAULT 1 '; 
     $sqlCreate .= ")";

	  //echo "<br>".$sqlCreate;	
	  $resultCreate = execute($sqlCreate) or die(mysql_error());
	 
   }
   //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   
   //+++++++++++++++++++++++++++++++++++   INSERTING STUDENT DETAILS    +++++++++++++++++++++++++++++++++++++++++++


	$sql=execute("SELECT a.id FROM student_m a,student_course b WHERE b.stu_id=a.id AND b.sub_sec=$subject[$i] AND b.acc_year='$a_year' GROUP BY b.stu_id ORDER BY a.first_name");	

	  while($r=fetcharray($sql))
	  {
		 $student_id=$r['id'];
		 if($student_id!='')
		 {
		 	$tablename='grade_m_'.$subject[$i].'_'.$term;
			
			$check=rowcount(execute("SELECT * FROM `$tablename` WHERE `student_id` = '$student_id' AND `status` = 1"));
			
		    if($check < 1)
		    {			
				$sqlInsert="INSERT INTO `$tablename` (`student_id`, `term`, `subject`) 
				VALUES ('$student_id', '$term', '$subject[$i]')";
		
				 //echo "<br>".$sqlInsert;
				 $resultInsert = execute($sqlInsert) or die(mysql_error());
			 }
		 }
		  
	  }
 
   //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	if($resultInsert)
	{
		$msg="Records Saved";	
		echo "<META http-equiv='refresh' content='2;URL=setup.php?msg=$msg&subject=$subject[0]&term=$term'>";
	}
	else
	{
		echo "<META http-equiv='refresh' content='2;URL=setup.php?subject=$subject[0]&term=$term'>";
	}
  }
		
}

?>