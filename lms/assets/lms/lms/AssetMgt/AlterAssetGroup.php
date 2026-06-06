<?php

session_start();

require("../db1.php");

$Types = $_REQUEST['Types'];

$assetgroup_name = $_POST['assetgroup_name'];

$asset_abbr=$_POST['asset_abbr'];

$Add=$_POST['Add'];

$id = $_POST['id'];

$assetgroupname=$_POST['assetgroupname'];

$assetabr=$_POST['assetabr'];
//print_r($_POST);

if(is_array($id) )

{
	while( list(,$Value) = each($id) )

	{
		$IName = $_POST["assetgroupname" . $Value];

        if($IName=="")
		{

		 $msg="Asset Group should not be Blank";
		 header("Location:AssetGroup.php?msg=$msg");
		}

		$IAame = $_POST["assetabr" . $Value];		

		if($IAame=="")
		{
		    $msg="Asset Abbreviation should not be Blank";
			 header("Location:AssetGroup.php?msg=$msg");
		}
		if($Types == "Add")
        {
  
			$sql="insert into asset_group(assetgroupname,abbrevation,status) values('$assetgroup_name','$asset_abbr','1')";
			execute($sql);
			$msg="Details inserted..";
			header("Location:AssetGroup.php?msg=$msg");

	
}
		
	   if($Types == "Mod")
		{
           $sql = "Update asset_group set assetgroupname='" . trim($IName) . "',abbrevation='".$IAame."' where id=" . $Value ;
		   execute($sql);
	       $msg="Updated Successfuly...!";    
		   header("Location:AssetGroup.php?msg=$msg");
			
        }
		 if($Types == "Del")
		{
           $sql = "Update asset_group set status=0 where id=" . $Value ;
		   execute($sql);
	       $msg="Deleted Successfuly.!";    
		   header("Location:AssetGroup.php?msg=$msg");
			
        }



	}
	$msg="Updated Successfuly...!";
	 header("Location:AssetGroup.php?msg=$msg");

}


else

{

$msg="Please Select The Check Box...!";
header("Location:AssetGroup.php?msg=$msg");

}

?>

