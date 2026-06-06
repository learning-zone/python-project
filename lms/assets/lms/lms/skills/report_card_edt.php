<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$user = $_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];

if($_POST)
{

	$Sel = $_POST['Sel'];
	$term = $_POST['term'];
	$subject = $_POST['subject'];
	$comments = $_POST['comments'];
	$category = $_POST['category'];
	 
}
if($_GET)
{
    $Sel=$_REQUEST['Sel'];
	$Type=$_REQUEST['Type'];
}
if(trim($Type) == "Add")
{

  
    //+++++++++++++++++++++++++++++++++++   INSERTING STUDENT DETAILS    +++++++++++++++++++++++++++++++++++++++++++++++++++++++
       
	$subdet=fetchrow(execute("select elective,course_year_id from subject_m where subject_id='$subject'"));
	if($subdet[0]=='N')
	{
		$sql=execute("select student_id from student_m where course_yearsem='$subdet[1]' and archive='N' order by first_name");
		$rowCount=rowcount($sql);
	}
	else
	{
		$sql=execute("select a.student_id from student_m a, student_course b where a.archive='N' and b.`sub`='$subject' and a.id=b.stu_id and b.acc_year=a.academic_year group by  a.student_id  order by a.first_name ");	
		$rowCount=rowcount($sql);
	}
	
		 	//TO FETCH THE POST VALUE DYNAMICALLY	
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	for($j=0;$j<sizeof($Sel);++$j)
	{
		$val=$Sel[$j];
		
     	$comments=$_POST[$val.'comments']; 
		
		$tablename='grade_m_'.$subject.'_'.$term;
			 
		$sqlUpdate="UPDATE `$tablename` SET `comments` = '$comments'  WHERE `student_id` = '$val'";
		//echo "<br>".$sqlUpdate;
		$resultUpdate = execute($sqlUpdate) or die(mysql_error());
		
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		
	}


      if($resultt)
	  {
		  $msg="Records Added";
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=report_card.php?term=$term&subject=$subject&category=$category'>";
	  }
	  else
	  {		   
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=report_card.php?term=$term&subject=$subject&category=$category'>";
	  }
}



?>
