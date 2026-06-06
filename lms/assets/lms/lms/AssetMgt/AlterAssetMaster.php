<?php

	   session_start();

       require("../db1.php");

	   $Types = $_REQUEST['Types'];

	   if($_POST)

	{

	$id = $_POST['id'];

	$asset_name = $_POST['asset_name'];

	$asset_sub_group = $_POST['asset_sub_group'];
	
	 $assetcode = $_POST['assetcode'];

	}

	if($_GET)

{

	$asset_name = $_GET['asset_name'];

	$assetgroup = $_GET['assetgroup'];

	$assetcode = $_GET['assetcode'];

}



      if( is_array($id) )

      {

		while( list(,$Value) = each($id) )

		{

			

			$AName = $_POST["asset_name".$Value];

			$ACode = $_POST["assetcode".$Value];

			$AGrpId = $_POST["asset_sub_group".$Value];



			if($Types == "Mod")

			{

			$sqlstr = "Update asset_master set asset_group_id=$AGrpId,asset_name='".trim($AName)."' where id=". $Value ;
			execute($sqlstr);
			$msg="Updated Successfully";
			header("Location:AssetMaster.php?msg=$msg");
			}
			if($Types == "Del")
		{
           $sql = "Update asset_master set status=0 where id=" . $Value ;
		   execute($sql);
	       $msg="Deleted Successfuly.!";    
		   header("Location:AssetMaster.php?msg=$msg");
			
        }			
	    }
		$msg="Updated Successfuly...!";
	 header("Location:AssetMaster.php?msg=$msg");    

	  }

	  else

	  {

	  $msg="Please Select The Check Box....!";

	  header("Location:AssetMaster.php?msg=$msg");

	  }

	?>

