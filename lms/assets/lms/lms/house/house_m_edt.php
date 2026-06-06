<?php
session_start();
include("../db.php");
if($_POST)
{
	$Sel=$_POST['Sel'];
	$name=$_POST['name'];
	$description=$_POST['description'];
	$color=$_POST['color'];
	
}
if($_REQUEST)
{
	$Sel=$_REQUEST['Sel'];
	$name=$_REQUEST['name'];
	$description=$_REQUEST['description'];
	$color=$_REQUEST['color'];
	$Type=$_REQUEST['Type'];
}


//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);

if(trim($Type) == "Add")
{

      //echo "Inside ADD";
      $sql="INSERT INTO `house_m` (`name`, `description`, `color`, `date_inserted`, `status`) VALUES ('$name', '$description', '$color', CURDATE(), '1')";
	  //echo $sql;
	 $result=execute($sql) or die(mysql_error());
      if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=house_m.php?msg=Records Added Successfully'>";
	  }	
}

if(trim($Type) == "Mod")
{
    //echo "Inside Mod";
	for($i=0;$i<sizeof($Sel);$i++)
	{
      $val=$Sel[$i];
	  
	  //echo "Selected Values :".$val;
	  
	  $name=$_POST[$val.'name'];
      $description=$_POST[$val.'description'];
      $color=$_POST[$val.'color'];
      
	  $sql="UPDATE `house_m` SET `name` = '$name', `description` = '$description', `color` = '$color' WHERE `id` = '$val'";
	 
	  //echo $sql;
	 $result=execute($sql) or die(mysql_error());
	}
	  if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=house_m.php?msg=Records Updated Successfully'>";
	  }	
}

if(trim($Type) == "Del")
{
      //echo "Inside Del";
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sql="UPDATE `house_m` SET `status` = '0' WHERE `id` = '$val'";
		  //echo $sql;
		  $result=execute($sql) or die(mysql_error());
	  }
		  
	  if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=house_m.php?msg=Records Deleted Successfully'>";
	  }	
}
?>
