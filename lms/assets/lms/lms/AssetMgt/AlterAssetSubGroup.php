<?php

session_start();

       require("../db1.php");

	   $Types = $_REQUEST['Types'];  
	   $Mod=$_POST['Mod'];
	   $id = $_POST['id'];

		   $assetsubgroupname = $_POST['assetsubgroupname'];

		   $assetcode = $_POST['assetcode'];

		   $asset_sub_group = $_POST['asset_sub_group'];

	$assetsubgroupname = $_GET['assetsubgroupname'];

	$assetcode = $_GET['assetcode'];

      if( is_array($id) )

      {
		while( list(,$Value) = each($id) )

		{
			$IName = $_POST["assetsubgroupname" . $Value];

			//$ACode = $_POST["assetcode".$Value];		

			$AID = $_POST["asset_sub_group".$Value];
			if($Types == "Mod")
			{
				
		$sqlstr = "Update asset_sub_group set asset_subgroup_name='" . trim($IName) . "',asset_group_id=$AID where id=" . $Value ;
		execute($sqlstr);
		 $msg="Updated Successfuly!";    
		   header("Location:AssetSubGroupMaster.php?msg=$msg");
		
				}	
		if($Types == "Del")
		{
           $sql = "Update asset_sub_group set status=0 where id=" . $Value ;
		   execute($sql);
	       $msg="Deleted Successfuly.!";    
		   header("Location:AssetSubGroupMaster.php?msg=$msg");
			
        }		

	    }

	   
	  //$msg="Updated Successfuly!";    
		   //header("Location:AssetSubGroupMaster.php?msg=$msg");
	    //echo "<font color=blue><b><a href=AssetSubGroupMaster.php><u>Back</u></a></b></font>";	    

	  }
		else
		{

		$msg="Please Select The Check Box.!";
		header("Location:AssetSubGroupMaster.php?msg=$msg");

		}
?>

