<?php
session_start();
include("../db.php");
if($_POST)
{
	$Sel=$_POST['Sel'];
    $term=$_POST['term'];
	$f_day=$_POST['f_day'];
	$t_day=$_POST['t_day'];
    $f_year=$_POST['f_year'];
    $a_year=$_POST['a_year'];
	$t_year=$_POST['t_year'];
	$f_month=$_POST['f_month'];   
	$t_month=$_POST['t_month'];
}
if($_GET)
{
	$Sel=$_REQUEST['Sel'];
	$Type=$_REQUEST['Type'];
	
}

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if(trim($Type) == "Add")
{

      //echo "Inside ADD";
	  $start_date="$f_year-$f_month-$f_day";
	  $end_date="$t_year-$t_month-$t_day";
	  
     $sql="INSERT INTO `academic_term` (`term`, `a_year`, `start_date`, `end_date`, `inserted_date`) VALUES ('$term', '$a_year', '$start_date', '$end_date', CURDATE())";
	 // echo $sql;
	  //die();
	  $result=execute($sql) or die(mysql_error());
	  if($result)
	  {
		    $msg='Records Inserted';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=term.php?msg=$msg'>";
	  }	
	  else
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=term.php'>";
	  }		
}

if(trim($Type) == "Mod")
{
    //echo "Inside Mod";
	for($i=0;$i<sizeof($Sel);$i++)
	{
      $val=$Sel[$i];
	  
	  $term=$_POST[$val.'term'];
	  $f_day=$_POST[$val.'f_day'];
	  $t_day=$_POST[$val.'t_day'];
	  $a_year=$_POST[$val.'a_year'];
	  $f_year=$_POST[$val.'f_year'];
	  $t_year=$_POST[$val.'t_year'];
	  $f_month=$_POST[$val.'f_month'];
	  $t_month=$_POST[$val.'t_month'];
	  
	  $start_date="$f_year-$f_month-$f_day";
	  $end_date="$t_year-$t_month-$t_day";
      
	  $sql="UPDATE `academic_term` SET `term` = '$term', `a_year` = '$a_year', `start_date` = '$start_date', `end_date`='$end_date' WHERE `id` = '$val'";
	 
	  //echo "<br>".$sql;
	  
		$result=execute($sql) or die(mysql_error());
	}
	  if($result)
	  {
		    $msg='Records Updated';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=term.php?msg=$msg&a_year=$a_year'>";
	  }	
	  else
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=term.php?a_year=$a_year'>";
	  }		
}

if(trim($Type) == "Del")
{
      //echo "Inside Del";
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sql="UPDATE `academic_term` SET `status` = '0' WHERE `id` = '$val'";
		  //echo $sql;
		  $result=execute($sql) or die(mysql_error());
	  }
		  
	  if($result)
	  {
		    $msg='Records Deleted';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=term.php?msg=$msg&a_year=$a_year'>";
	  }	
	  else
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=term.php?a_year=$a_year'>";
	  }	
}
?>
