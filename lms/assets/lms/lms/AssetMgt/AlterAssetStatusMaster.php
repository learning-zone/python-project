	<?php

	session_start();

	include("../db1.php");

	$Types = $_REQUEST['Types'];

	$id = $_POST['id'];

$condition = $_POST['condition'];

$addconditions = $_POST['addconditions'];
/*if(strtoupper($_REQUEST[Types]) == "ADD")
{
   $id = $_POST['id'];
   $condition = $_POST['condition'];
   $addconditions = $_POST['addconditions'];
	$sql="insert into assetstatusmaster(conditions) values('$condition')";
	execute($sql);
	$msg="Details inserted..";
	header("Location:AssetStatusMaster.php");
	
}*/

if( is_array($id) )

      {

		while( list(,$Value) = each($id) )

		{

		$C = $_POST["condition" . $Value];

			if($Types == "Mod")

			{

				 $sqlstr = "Update assetstatusmaster set conditions='" . trim($C) . "' where id=" . $Value ;
				 execute($sqlstr);
				 $msg= "Updated Successfuly!";
       			 //header("Location:AssetStatusMaster.php?msg=$msg");
				 echo "<META HTTP-EQUIV='Refresh' Content='0;URL=AssetStatusMaster.php?msg=$msg'>";

			}
			if($Types == "Del")
		{
           $sql = "Update assetstatusmaster set status=0 where id=" . $Value ;
		   execute($sql);
	       $msg="Deleted Successfuly.!";    
		    echo "<META HTTP-EQUIV='Refresh' Content='0;URL=AssetStatusMaster.php?msg=$msg'>";

			
        }
			
		

	      }
		  
			

		//$msg= "Updated Successfuly!";
        //header("Location:AssetStatusMaster.php?msg=$msg");
		

	  }

		


	//header("Location: AssetStatusMaster.php");









?>

