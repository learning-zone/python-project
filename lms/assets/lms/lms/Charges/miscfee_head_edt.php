<?php
session_start();
include("../db.php");
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/

if($_POST)
{
   $id=$_POST['id'];
   $Sel=$_POST['Sel'];
   $m_id=$_POST['m_id'];   
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

			$string=$subgroup;
			$subgroup = str_replace(' ', '_', $string);
			$subgroup = $subgroup.'_'.$m_id;  
				
     $sql="INSERT INTO `fee_misc_head` (`m_id`, `subgroup`) VALUES ('$m_id', '$subgroup')";
	    //echo "<br>".$sql;
	   $result=execute($sql) or die(mysql_error());
	   
	 $sqlAlter="ALTER TABLE fee_misc_m_desc ADD $subgroup INT(10) NULL";
	   //echo "<br>".$sqlAlter;
	
	   $resultAlter = execute($sqlAlter) or die(mysql_error());
	   
	   
      if($result)
	  {
			$msg='Records Added';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_head.php?msg=$msg'>";
	  }
	  else
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_head.php'>";
	  }
}

if(trim($Type) == "Mod")
{
    
	for($i=0;$i<sizeof($Sel);$i++)
	{
		$val=$Sel[$i];
		
		$m_id = $_POST[$val.'m_id'];		
		
	    $k = $val;
	    $k = $k + 6;
	    $string=$_POST[$val.'subgroup'];
        $subgroupNew = str_replace(' ', '_', $string);   //TO REPLACE FIELD NAME SPACE WITH "-"
	
			
		$sql="UPDATE `fee_misc_head` SET `m_id` = '$m_id', `subgroup` = '$subgroupNew'  WHERE `id` = '$val'";	   
		//echo "<br>".$sql;
	    $result=execute($sql) or die(mysql_error());
	
	  //+++++++++++++++++++++++++++   TO ALTER EXSISTING COLUMN NAME  +++++++++++++++++++++++++++++++++++++++++++
	    $resultCol=execute("SELECT * FROM `fee_misc_m_desc`");

		if($k < mysql_num_fields($resultCol)) 
		{
		  
			$meta = mysql_fetch_field($resultCol, $k);
			$subgroupOld=$meta->name;
			    
			$sqlAlter="ALTER TABLE fee_misc_m_desc CHANGE $subgroupOld $subgroupNew INT(10) NULL";
	         //echo "<br>".$sqlAlter;
			
	        $resultAlter = execute($sqlAlter) or die(mysql_error());
		 }
	  
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	}
	  if($result)
	  {
		    $msg='Records Updated';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_head.php?msg=$msg'>";
	  }
	  else
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_head.php'>";
	  }
}

if(trim($Type) == "Del")
{
      
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sql="UPDATE `fee_misc_head` SET `status` = '0' WHERE `id` = '$val'";
		  //echo "<br>".$sql;
		  $result=execute($sql) or die(mysql_error());
	  }
		  
	  if($result)
	  {
		    $msg='Records Deleted';
			//echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_head.php?msg=$msg'>";
	  }	
	  else
	  {
		    //echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_head.php'>";
	  }
}
?>
