<?php
session_start();
include("../db.php");
if($_POST)
{
	$Sel=$_POST['Sel'];
	$stud_id=$_POST['stud_id'];
	$house_id=$_POST['house_id'];
	$academic_yr=$_POST['academic_yr'];
	$user=$_POST['user'];
}
if($_REQUEST)
{
	$Sel=$_REQUEST['Sel'];
	$stud_id=$_REQUEST['stud_id'];
	$house_id=$_REQUEST['house_id'];
	$academic_yr=$_REQUEST['academic_yr'];
	$user=$_REQUEST['user'];
	$Type=$_REQUEST['Type'];	
}


//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);
if(trim($Type) == "Add")
{

	   $sql="INSERT INTO `house_m_stud` (`stud_id`, `house_id`, `academic_yr`, `user`, `status`) VALUES ('$stud_id', '$house_id', '$academic_yr', '$user', '1')";
	  //echo $sql;
	  $result=execute($sql) or die(mysql_error());
	  if($result)
	  {
	  		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=house_m_stud.php?msg=Records Added Successfully'>";
	  }
}

if(trim($Type) == "Mod")
{
    //echo "Inside Mod";
	for($i=0;$i<sizeof($Sel);$i++)
	{
      $val=$Sel[$i];
	  
	  //echo "Selected Values :".$val;
	  
	  $stud_id=$_POST[$val.'stud_id'];
      $house_id=$_POST[$val.'house_id'];
      $academic_yr=$_POST[$val.'academic_yr'];
	  $user=$_POST[$val.'user'];
      
	  $sql="UPDATE `house_m_stud` SET `stud_id` = '$stud_id', `house_id` = '$house_id', `academic_yr` = '$academic_yr', `user` = '$user'  WHERE `id` = '$val'";
	 
	  //echo $sql;
	 $result=execute($sql) or die(mysql_error());
	}
	  if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=house_m_stud.php?msg=Records Updated Successfully'>";
	  }	
}

if(trim($Type) == "Del")
{
      //echo "Inside Del";
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sql="UPDATE `house_m_stud` SET `status` = '0' WHERE `id` = '$val'";
		  //echo $sql;
		  $result=execute($sql) or die(mysql_error());
	  }
		  
	  if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=house_m_stud.php?msg=Records Deleted Successfully'>";
	  }	
}

?>