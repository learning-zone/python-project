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

	$term_id = $_POST['term'];	
	$title=$_POST['title'];	
	$weight=$_POST['weight'];
	$subject=$_POST['subject'];
	$subject1=$_POST['subject1'];
	$description=$_POST['description'];
	
}

$size=sizeof($subject);

if($Type == "Add")
{
	 for($i=0; $i < $size; ++$i){ 
	 
		 
	$chk=rowcount(execute("SELECT id FROM `grade_category` WHERE subject='$subject[$i]' AND a_year='$a_year' AND term_id='$term_id' AND title='$title' AND status=1"));
	
 if($chk < 1)	 
 {
	
	  //$term="$term1, $term2, $term3, $term4, $term5, $term6";
	  $sql="INSERT INTO `grade_category` (`subject`, `title`, `description`, `a_year`, `term_id`, `term`, `weight`) VALUES ('$subject[$i]', '$title', '$description', '$a_year', '$term_id', '$term', '$weight')";
	
	//echo "<br>".$sql;
	$result = execute($sql) ;
	
	$maxID=fetcharray(execute("SELECT MAX(id) FROM `grade_category` WHERE `status`='1' AND subject='$subject[$i]'"));
	
   //++++++++++++++++++++++++++  ADDING FIELDS TO GRADE MASTER TABLE  +++++++++++++++++++++++++++++++++++
  	$tablename='grade_m_'.$subject[$i].'_'.$term_id;
	
  	$sqlAlter="ALTER TABLE $tablename ADD avg_$maxID[0] VARCHAR(5) DEFAULT NULL";
	
	//echo "<br>".$sqlAlter;
	$resultAlter = execute($sqlAlter) ;

  //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	 }
	}
	
	if($result)
	{
		$msg="Records Saved";
		echo "<META http-equiv='refresh' content='2;URL=category.php?msg=$msg&subject=$subject[0]&term=$term_id'>";
	}
	else
	{
		echo "<META http-equiv='refresh' content='2;URL=category.php?subject=$subject[0]&term=$term_id'>";
	}
		
}

?>