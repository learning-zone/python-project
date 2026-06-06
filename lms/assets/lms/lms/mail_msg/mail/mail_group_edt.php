<?php
session_start();
include("../../db1.php");
if($_POST)
{
	$Sel=$_POST['Sel'];
	$group_name=$_POST['group_name'];
	$description=$_POST['description'];
	
}
if($_REQUEST)
{
	$Sel=$_REQUEST['Sel'];
	$group_name=$_REQUEST['group_name'];
	$description=$_REQUEST['description'];
	$Type=$_REQUEST['Type'];
}


//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);

if(trim($Type) == "Add")
{

      //echo "Inside ADD";
      $sql="INSERT INTO `mail_group` (`group_name`, `description`, `status`) VALUES ('$group_name', '$description', '1')";
	  //echo $sql;
	 $result=execute($sql);
      if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=mail_group.php?msg=Records Added Successfully'>";
	  }	
}

if(trim($Type) == "Mod")
{
    //echo "Inside Mod";
	for($i=0;$i<sizeof($Sel);$i++)
	{
      $val=$Sel[$i];
	  
	  //echo "Selected Values :".$val;
	  
	  $group_name=$_POST[$val.'group_name'];
      $description=$_POST[$val.'description'];
      
	  $sql="UPDATE `mail_group` SET `group_name` = '$group_name', `description` = '$description'  WHERE `id` = '$val'";
	 
	  //echo $sql;
	 $result=execute($sql);
	}
	  if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=mail_group.php?msg=Records Updated Successfully'>";
	  }	
}

if(trim($Type) == "Del")
{
      //echo "Inside Del";
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sql="UPDATE `mail_group` SET `status` = '0' WHERE `id` = '$val'";
		  //echo $sql;
		  $result=execute($sql);
	  }
		  
	  if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=mail_group.php?msg=Records Deleted Successfully'>";
	  }	
}
?>
