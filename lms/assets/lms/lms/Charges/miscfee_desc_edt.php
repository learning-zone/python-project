<?php
session_start();
include("../db.php");

/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
$user_name = $_SESSION['user'];
$academic_yr = $_SESSION['AcademicYear'];

if($_POST)
{
   $id=$_POST['id'];
   $Sel=$_POST['Sel'];
   $name=$_POST['name'];
   $m_id=$_POST['m_id'];   
   $class=$_POST['class'];
   $a_year=$_POST['a_year'];
   $subgroup=$_POST['subgroup'];
	
}
if($_GET)
{
   $id=$_REQUEST['id'];
   $Sel=$_REQUEST['Sel'];
   $Type=$_REQUEST['Type']; 
	
}

if(trim($Type) == "Add")
{
		
							
     $sqlInsert="INSERT INTO `fee_misc_m_desc` (`m_id`, `user_name`, `class`, `academic_yr`, `inserted_date`) VALUES ('$m_id', '$user_name', '$class', '$a_year', CURDATE())";
	 
	   //echo "<br>".$sqlInsert;
	   $resultInsert=execute($sqlInsert) or die(mysql_error());
	 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	   
	   $maxID=fetcharray(execute("SELECT MAX(id) FROM `fee_misc_m_desc` WHERE `status` = 1 LIMIT 1"));
	 	   
	  //TO FETCH THE POST VALUE DYNAMICALLY	
		$i = 0;	
		$result=execute("SELECT * FROM `fee_misc_head` WHERE `m_id` = '$m_id' AND `status`=1");
		while($row=fetcharray($result))
		{
			
			 $fieldname1=$row['subgroup'];
			 $fieldname[]=$row['subgroup'];
			 $postvalue[]=$_POST[$fieldname1];
			 
			   $sqlUpdate="UPDATE `fee_misc_m_desc` SET `$fieldname[$i]` = '$postvalue[$i]'  WHERE `id` = '$maxID[0]'";
			   //echo "<br>".$sqlUpdate;  
			   $resultUpdate = execute($sqlUpdate) or die(mysql_error());
		     
		   $i++;
		}
	 
	 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      if($resultUpdate)
	  {
			$msg='Records Added';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_desc.php?msg=$msg'>";
	  }
	  else
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_desc.php'>";
	  }
}

if(trim($Type) == "Mod")
{
		
	for($i=0;$i<sizeof($Sel);$i++)
	{
		$val=$Sel[$i];

		
		$m_id = $_POST[$val.'m_id'];
		$class = $_POST[$val.'class'];	
	    $amount = $_POST[$val.'amount'];
		$a_year = $_POST[$val.'a_year'];	
		
			
		$sql="UPDATE `fee_misc_m_desc` SET `m_id` = '$m_id', `class` = '$class', `amount` = '$amount',
		`a_year` = '$a_year' WHERE `id` = '$val'";
	   
		//echo "<br>".$sql;
	    $result=execute($sql) or die(mysql_error());
	}
	  if($result)
	  {
		    $msg='Records Updated';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_desc.php?msg=$msg'>";
	  }
	  else
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_desc.php'>";
	  }
}

if(trim($Type) == "Del")
{
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sql="UPDATE `fee_misc_m_desc` SET `status` = '0' WHERE `id` = '$val'";
		  //echo "<br>".$sql;
		 $result=execute($sql) or die(mysql_error());
	  }
		  
	  if($result)
	  {
		    $msg='Records Deleted';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_desc.php?msg=$msg'>";
	  }	
	  else
	  {
		    echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_desc.php'>";
	  }
}
?>
