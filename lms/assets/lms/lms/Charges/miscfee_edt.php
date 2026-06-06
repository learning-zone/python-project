<?php
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
session_start();
include("../db.php");
if($_POST)
{
   $id=$_POST['id'];
   $Sel=$_POST['Sel'];
   $name=$_POST['name'];
   $description=$_POST['description'];
	
}
if($_GET)
{
	$id=$_REQUEST['id'];
	$Sel=$_REQUEST['Sel'];
    $name=$_REQUEST['name'];
	$Type=$_REQUEST['Type'];
	$description=$_REQUEST['description'];	
}

if(trim($Type) == "Add")
{

      //echo "Inside ADD";
     $sql="INSERT INTO `fee_misc_m` (`name`, `description`) VALUES ('".addslashes($name)."', '".trim($description)."')";
	  //echo "<br>".$sql;
	 $result=execute($sql) or die(mysql_error());
      if($result)
	  {
			$msg='Records Added';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee.php?msg=$msg'>";
	  }
	  else
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee.php'>";
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
      
	  $sql="UPDATE `fee_misc_m` SET `name` = '$name', `description` = '$description' WHERE `id` = '$val'";
	 
	  //echo "<br>".$sql;
	 $result=execute($sql) or die(mysql_error());
	}
	  if($result)
	  {
		    $msg='Records Updated';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee.php?msg=$msg'>";
	  }
	  else
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee.php'>";
	  }
}

if(trim($Type) == "Del")
{
      //echo "Inside Del";
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sql="UPDATE `fee_misc_m` SET `status` = '0' WHERE `id` = '$val'";
		  //echo $sql;
		  $result=execute($sql) or die(mysql_error());
	  }
		  
	  if($result)
	  {
		    $msg='Records Deleted';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee.php?msg=$msg'>";
	  }	
	  else
	  {
		    echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee.php'>";
	  }
}
?>
