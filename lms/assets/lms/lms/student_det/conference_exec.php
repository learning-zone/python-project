<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/

$user_name=$_SESSION['user'];
$a_year=$_SESSION['AcademicYear'];
if($_POST)
{
	$Sel=$_POST['Sel'];
	$adate=$_POST['adate'];
	$other=$_POST['other'];
	$StudID=$_POST['StudID'];
	$reason=$_POST['reason'];
	$conduct=$_POST['conduct'];
	$subject=$_POST['subject'];
	$conf_id=$_POST['conf_id'];
	$academic=$_POST['academic'];
	$location=$_POST['location'];	
	$teacher_id=$_POST['teacher_id'];
	$observation=$_POST['observation'];
	$other_reason=$_POST['other_reason'];
	$observation_id=$_POST['observation_id'];
	$recommendation=$_POST['recommendation'];
	$parents_comments=$_POST['parents_comments'];
}

if(strtoupper($_REQUEST[Type]) == "ADD")
{
	
	  $dateArray=explode('/',$adate);
	  $acq_yy=$dateArray[2];
	  $acq_mm=$dateArray[1];
	  $acq_dd=$dateArray[0];
	  $conf_date="$acq_yy-$acq_mm-$acq_dd";
	  	
	 $reason="$reason[0],$reason[1],$reason[2]";
	 
	 	
    $sql="INSERT INTO `student_pt_m` (`user_name`, `subject`, `student_id`, `teacher_id`, `conf_date`, `academic`, `conduct`, `other`, `location`, `other_reason`, `observation`, `recommendation`, `parents_comments`, `a_year`, `inserted_date`) VALUES ('$user_name', '$subject', '$StudID', '$teacher_id', '$conf_date', '$academic', '$conduct', '$other', '$location', '{$other_reason}', '{$observation}', '{$recommendation}', '{$parents_comments}', '$a_year', NOW())";
	
	//echo "<br>".$sql;
	$result = execute($sql) ;
	
	
	for($i=0;$i< sizeof($Sel);++$i)
	{
		
		$val=$Sel[$i];
		
		
		$field_name=fetcharray(execute("SELECT `observation` FROM `student_pt_observation` WHERE `id`='$val'"));
		
		$field_name = str_replace(' ', '_', $field_name[0]);

		$field_Value=$_POST[$val.$field_name];
		
		if($field_Value=="on")
		{

		$chk=rowcount(execute("SELECT `id` FROM `student_pt_observation_m` WHERE `student_id`='$StudID' AND `teacher_id`='$teacher_id' AND `observation_id`='$val' AND `checkbox`=1"));
	
	if($chk < 1){	
		$sqlC="INSERT INTO `student_pt_observation_m` (`student_id`, `teacher_id`, `observation_id`, `checkbox`) VALUES ('$StudID', '$teacher_id', '$val', '1')";
	
		//echo "<BR>".$sqlC;
		$resultC = execute($sqlC) ;
	}
   }
}
		

	if($result)
	{
		$msg="Records Added";	
		echo "<META http-equiv='refresh' content='0;URL=conference_edt.php?msg=$msg&StudID=$StudID'>";
	}
	else
	{
		echo "<META http-equiv='refresh' content='0;URL=conference_edt.php?msg=$msg&StudID=$StudID'>";
	}

}
if(strtoupper($_REQUEST[Type]) == "UPDATE")

{
	
	  $dateArray=explode('/',$adate);
	  $acq_yy=$dateArray[2];
	  $acq_mm=$dateArray[1];
	  $acq_dd=$dateArray[0];
	  $conf_date="$acq_yy-$acq_mm-$acq_dd";
	  
	 $reason="$reason[0],$reason[1],$reason[2]";
	 
	 $count=fetcharray(execute("SELECT COUNT(*) FROM `student_pt_observation` LIMIT 1"));
		
		
		$sql="UPDATE  `student_pt_m` SET `subject`='$subject',`other`='$other',`conduct`='$conduct',`academic`='$academic',`conf_date`='$conf_date', `location`='$location', `reason`='$reason', `other_reason`='{$other_reason}', `observation_id`='$observation_id',`observation`='$observation', `recommendation`='{$recommendation}', `parents_comments`='{$parents_comments}' WHERE id='$conf_id'";

	//echo "<br>".$sql;
	$result = execute($sql) or die(mysql_error());
	
	
		
  for($i=0;$i< sizeof($Sel);++$i)
  {
		
		$val=$Sel[$i];
			
		$field_name=fetcharray(execute("SELECT `observation` FROM `student_pt_observation` WHERE `id`='$val'"));
		
		$field_name = str_replace(' ', '_', $field_name[0]);

		$field_Value=$_POST[$val.$field_name];
		
	if($field_Value=="on")
	{

		$chk=rowcount(execute("SELECT `id` FROM `student_pt_observation_m` WHERE `student_id`='$StudID' AND `teacher_id`='$teacher_id' AND `observation_id`='$val' AND `checkbox`=1"));
	
	if($chk < 1){	
		$sqlC="INSERT INTO `student_pt_observation_m` (`student_id`, `teacher_id`, `observation_id`, `checkbox`) VALUES ('$StudID', '$teacher_id', '$val', '1')";
	
		//echo "<BR>".$sqlC;
		$resultC = execute($sqlC);
	}

   }
   	else
	{
		$sqlD="DELETE FROM `student_pt_observation_m` WHERE `student_id`='$StudID' AND `teacher_id`='$teacher_id' AND `observation_id`='$val'";
	
		//echo "<BR>".$sqlD;
		$resultD = execute($sqlD);
	}
}
		

	if($result)
	{
		$msg="Records Updated";	
		echo "<META http-equiv='refresh' content='0;URL=conference_edt.php?msg=$msg&conf_id=$conf_id&StudID=$StudID'>";
	}
	else
	{
		echo "<META http-equiv='refresh' content='0;URL=conference_edt.php?conf_id=$conf_id&StudID=$StudID'>";
	}
}
if(strtoupper($_REQUEST[Type]) == "DEL")
{
	
		$sql="UPDATE `student_pt_m` SET `status`='0' WHERE id='$conf_id'";
		//echo "<br>".$sql;
		$result = execute($sql) ;
	
	if($result)
	{	
		echo "<META http-equiv='refresh' content='0;URL=conference_edt.php?conf_id=$conf_id&StudID=$StudID'>";
	}
	else
	{
		echo "<META http-equiv='refresh' content='0;URL=conference_edt.php?conf_id=$conf_id&StudID=$StudID'>";
	}
}
?>
