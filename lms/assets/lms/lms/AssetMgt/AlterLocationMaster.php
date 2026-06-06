<?php
session_start();
/*

Copyright  © 2001 ABNIPL, Bangalore. All rights reserved.

* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*		Modify department from dept_no table   			*
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*Date: 15-09-2001							*
*Author: Sateesh							*
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

*/
       require("../db.php");
	   $Types = $_REQUEST['Types'];
	   if($_POST)
	{
$id = $_POST['id'];
$location_name = $_POST['location_name'];
$dept1 = $_POST['dept1'];
		}


if($_GET)
{
	$location_name = $_GET['location_name'];
	$dept = $_GET['dept'];
	
}
//       select_db();
      if( is_array($id) )
      {
	while( list(,$Value) = each($id) )
	{	
		//---------------------------------------MODIFIED BY ANURAJ--------------------------
		
		//$aa="dept1".$Value;
//		$ab=$$aa;
		$ab = $_POST["dept1" . $Value];
		//echo "aaaaaaaaaaaaa<br>".$ab;
		//$location_name = "location_name" . $Value;
//		$IName = $$location_name;
				$IName = $_POST["location_name" . $Value];
		//---------------------------------------ADDED BY ANURAJ----------------------------------		
		$sql1=execute("select * from location_master where location='$IName' and dept_id=$ab")or die(error_description());
		if(rowcount($sql1)!=0)
		{
			echo "<font color=red><b>Duplicate Entry! Cannot Modify Details</b></font><br>";
			echo "<font color=red><b><a href=LocationMaster.php>Back </a></b></font>";
			die();
		}
		//---------------------------------------**************--------------------------------------------------
		
		if($Types == "Mod")
		{
		$sqlstr = "Update location_master set location='" . trim($IName) . "' ,dept_id='$ab' where id=" . $Value ;
		//echo $sqlstr;
		}
		execute($sqlstr);
	}
	    //--------------------------------------ADDED BY ANURAJ------------------------------------
	 echo "<font color=blue><b>Updated Successfully.....!</b></font><br>";
	 echo "<font color=blue><b><a href= LocationMaster.php><u>Back</u></a></b></font>";
	  //---------------------------------------------*********-----------------------------------------------
	  }
	  //--------------------------------------ADDED BY ANURAJ------------------------------------
	  else
	  {
	 echo "<font color=red><b>Please Select The Check Box.....!</b></font><br>";
	 echo "<font color=blue><b><a href= LocationMaster.php><u>Back</u></a></b></font>";
	  }
	//---------------------------------------------*********-----------------------------------------------
/*
 Redirect to viewdept.php
 IMPORTANT: output_buffering is to be turned on ... refer to php.ini file.

*/
	

?>
