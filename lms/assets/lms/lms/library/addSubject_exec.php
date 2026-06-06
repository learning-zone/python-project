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
	$subtitle=$_REQUEST['subtitle'];
}
if($_POST)
{
	$Sel=$_POST['Sel'];
	$subtitle=$_POST['subtitle'];	 
}

//FOR MASTER RECORD
if($_POST['ntitle'])
{
	 $ntitle=$_POST['ntitle'];	
}
else
{
	 $ntitle=$_REQUEST['ntitle'];	
}
//FOR CHILD RECORD
if($_POST['title'])
{
	 $title=$_POST['title'];	
}
else
{
	 $title=$_REQUEST['title'];	
}
if(trim($Type) == "Add")
{

      
		 $sql="INSERT INTO `lib_book_title` (`title`) VALUES ('$ntitle')";
		
		 $result=execute($sql) or die(mysql_error());

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

    
		 //TO FETCH THE ID FROM MASTER TABLE
		 $id=fetcharray(execute("SELECT `id` FROM `lib_book_title` WHERE `title`='$title' AND `status`=1"));
		 $c_id=$id[0];
	  
		
		 $sql="INSERT INTO `lib_book_subtitle` (`lib_book_title_id`, `subtitle`) VALUES ('$c_id', '$subtitle')";
		 //echo "<br>".$sql;
		 $result=execute($sql) or die(mysql_error());
 
     
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
	  

	  $title=$_POST[$val.'title'];
      $subtitle=$_POST[$val.'subtitle'];
	 
	  $sqlUpdate="UPDATE `lib_book_subtitle` SET `subtitle` = '$subtitle'  WHERE `id` = '$val'";
	
	  $resultUpdate=execute($sqlUpdate);
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
		  
		  $sqlDelete="UPDATE `lib_book_subtitle` SET `status` = '0' WHERE `id` = '$val'";
		 
		  $resultDelete=execute($sqlDelete);
		  
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

		  $sqlDel="UPDATE `lib_book_title` SET `status` = '0' WHERE `title` = '$title'";
		 
		  $resultDel=execute($sqlDel);
		  
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
