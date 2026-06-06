<?php
session_start();
require_once("../db.php");


//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";


if($_GET)
{
	$Sel=$_REQUEST['Sel'];	
    $Type=$_REQUEST['Type'];
	$queue_name=$_REQUEST['queue_name'];
    $queue_description=$_REQUEST['queue_description'];
}
if($_POST)
{
	$Sel=$_POST['Sel'];
	$queue_name=$_POST['queue_name'];
    $queue_description=$_POST['queue_description'];	 
}

//FOR MASTER RECORD
if($_POST['nprocess_name'])
{
	 $nprocess_name = $_POST['nprocess_name'];
     $nprocess_description = $_POST['nprocess_description'];	
}
else
{
	 $nprocess_name=$_GET['nprocess_name'];	
     $nprocess_description = $_POST['nprocess_description'];
}
//FOR CHILD RECORD
if($_POST['process_name'])
{
	 $process_name=$_POST['process_name'];	
     $process_description=$_POST['process_description'];
}
else
{
	 $process_name=$_GET['process_name']; 
     $process_description=$_GET['process_description'];	
}
if(trim($Type) == "Add")
{

      
		 $sql="INSERT INTO `tasks_process` (`process_name`, `process_description`) VALUES ('".addslashes($process_name)."', '".addslashes($process_description)."')";
		
		 $result=execute($sql) or die("<p align=center>Unable to Save Record</p>");

      if($result)
	  {
		 $msg="Records Added";
		 echo "<META HTTP-EQUIV='Refresh' Content='0; URL=addSubject.php?msg=$msg'>";
	  }
	  else
	  {		   
		 echo "<META HTTP-EQUIV='Refresh' Content='0; URL=addSubject.php'>";
	  }
}
if(trim($Type) == "AddChild")
{

				
		 $sql="INSERT INTO `lib_book_subtitle` (`tasks_process_id`, `queue_name`, `queue_description`) VALUES ('$tasks_process_id', '".addslashes($queue_name)."', '".addslashes('$queue_description')."')";
		 //echo "<br>".$sql;
		 $result=execute($sql) or die("<p align=center>Unable to Save Record</p>");
 
     
      if($resultCreate)
	  {
		 $msg="Records Added";
		 echo "<META HTTP-EQUIV='Refresh' Content='0;URL=addSubject.php?msg=$msg'>";
	  }
	  else
	  {		   
		 echo "<META HTTP-EQUIV='Refresh' Content='0;URL=addSubject.php'>";
	  }
	 	
}

if(trim($Type) == "Mod")
{
   
	for($i=0;$i<sizeof($Sel);$i++)
	{
      $val=$Sel[$i];
	  

	  $title=$_POST[$val.'queue_name'];
      $subtitle=$_POST[$val.'queue_description'];
	 
	  $sqlUpdate="UPDATE `tasks_queue` SET `queue_name` = '$queue_name',  `queue_description` = '$queue_description'  WHERE `id` = '$val'";
	
	  $resultUpdate=execute($sqlUpdate) or die("<p align=center>Unable to Update Record</p>");
	}
	   if($resultUpdate)
	   {
			$msg="Records Updated";
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=addSubject.php?msg=$msg'>";
	   }
	   else
	   {
		    echo "<META HTTP-EQUIV='Refresh' Content='0;URL=addSubject.php'>";  
	   }
}

if(trim($Type) == "Del")
{
       
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  
		  $sqlDelete="UPDATE `tasks_queue` SET `status` = '0' WHERE `id` = '$val'";
		 
		  $resultDelete=execute($sqlDelete) or die("<p align=center>Unable to Delete Record</p>");
		  
	  }
         if($resultDelete)
		 {
			 $msg="Records Deleted";
			 echo "<META HTTP-EQUIV='Refresh' Content='0; URL=addSubject.php?msg=$msg'>";
		 }
		 else
		 {
			 echo "<META HTTP-EQUIV='Refresh' Content='0; URL=addSubject.php'>"; 
		 }
}
//////////////////////////////////////		CATEGORY DELETE OPTION			/////////////////////////////////////////
if(trim($Type) == "DelM")
{

		  $sqlDel="UPDATE `tasks_process` SET `status` = '0' WHERE `process_name` = '$process_name'";
		 
		  $resultDel=execute($sqlDel) or die("<p align=center>Unable to Delete Record</p>");
		  
	   if($resultDel)
	   {

		  $msg="Records Deleted";
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=addSubject.php?msg=$msg'>";
	   }
	   else
	   {
		   echo "<META HTTP-EQUIV='Refresh' Content='0;URL=addSubject.php'>";
	   }
	 	
}
?>
