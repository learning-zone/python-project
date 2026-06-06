<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$a_year=$_SESSION['AcademicYear'];

if($_GET)
{
	$Type = $_REQUEST['Type'];
	$subject = $_REQUEST['subject'];
}
if($_POST)
{
	$term=$_POST['term'];
	$title=$_POST['title'];	
    $adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$category=$_POST['category'];
	$subject1=$_POST['subject1'];
	$max_point=$_POST['max_point'];
	$grade_type=$_POST['grade_type'];
	$apply_grade=$_POST['apply_grade'];
	$description=$_POST['description'];
	$course_objective=$_POST['course_objective'];
	
}

    $dateArray=explode('/',$adate);
	$acq_yy=$dateArray[2];
	$acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$assign_date="$acq_yy-$acq_mm-$acq_dd";
	

    $dateArray1=explode('/',$bdate);
	$acq_yy1=$dateArray1[2];
	$acq_mm1=$dateArray1[1];
	$acq_dd1=$dateArray1[0];
	$due_date="$acq_yy1-$acq_mm1-$acq_dd1";

if($Type == "Add")
{
	
  //++++++++++++++++++++++++++  ADDING FIELDS TO GRADE MASTER TABLE  +++++++++++++++++++++++++++++++++++
  /*	$titleNew = str_replace(' ', '_', $title);
	$titleNew = $titleNew.'_'.$category;
	
		
	$tablename='grade_m_'.$subject1.'_'.$term;
  
  	$sqlAlter="ALTER TABLE $tablename ADD $titleNew VARCHAR(5) DEFAULT NULL";
	

	$resultAlter = execute($sqlAlter) or die(mysql_error());*/

  //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
  
	 	
	  $sql="INSERT INTO `grade_assessment` (`category_id`, `subject`,`term`,`title`, `description`, `assign_date`, `due_date`, `max_point`, `apply_grade`, `grade_type`, `course_objective`, `a_year`, `inserted_date`) VALUES ('$category', '$subject1', '$term', '$title', '$description', '$assign_date', '$due_date', '$max_point', '$apply_grade', '$grade_type', '$course_objective', '$a_year', CURDATE())";
	
	  //echo "<br>".$sql;
	$result = @execute($sql);
	

	if($result)
	{
		$msg="Records Saved";	
		echo "<META http-equiv='refresh' content='0;URL=assignment.php?msg=$msg&subject=$subject1&term=$term&category=$category'>";
	}
	else
	{
		echo "<META http-equiv='refresh' content='0;URL=assignment.php?subject=$subject1&term=$term&category=$category'>";
	}
		
}

?>