<?php
session_start();
       require("../../db.php");
$id = $_POST['id'];
$itemname = $_REQUEST['itemname'];
$quantity_type = $_POST['quantity_type'];
$stock = $_POST['stock'];

$Types = $_REQUEST['Types'];
	   
      if($id)
      {
		while( list(,$Value) = each($id) )
		{
			$IName = $_POST["itemname" . $Value];
			//$item_name="itemname" . $Value;
			//$IName=$$item_name;
			
			$Iquantity_type = $_POST["quantity_type" . $Value];
			//$quantity_type="quantity_type" . $Value;
			//$Iquantity_type=$$quantity_type;
			
		    $ItemId = $_POST["stock" . $Value];
			//$item_unit="stock" . $Value;
			//$ItemId=$$item_unit;
			
			if($Types == "Mod")
			{
				
				/*$sqlstr="Update h_item_master set item_name='" . trim($IName) . "',quantity_type='" . trim($Iquantity_type) . "', 
				stock='" . trim($ItemId) . "' where id=" . trim($Value) ;*/
				
				$sqlstr="Update h_item_master set item_name='" . trim($IName) . "',quantity_type='" . trim($Iquantity_type) . "', 
				stock='" . trim($ItemId) . "' where id=$Value" ;
				//echo "$sqlstr";
				execute($sqlstr) or die(mysql_error());
			    echo "<b>Updated Successfuly...!</b><br>";
			   // echo "<b><a href=ItemMaster.php>Back</a></b>";
			   header("Location: ItemMaster.php?flag_modify=1");
				
			}
			
		

			if($Types == "Del")
			{
				if($ItemId!='0')
				{
				$sqlstrdel="delete from  h_item_master where id='$Value'";
				//echo $sqlstrdel;
				execute($sqlstrdel) or die(error_description());
				header("Location: ItemMaster.php?flag_modify=1");
				}
				else
				{
              echo "<b>cannot delete this record</b><br>";

				}				
			}
	    }
	  }
		else
		{
		echo "<b>Please Select The Check Box....!</b><br>";
		echo "<b><a href=ItemMaster.php>Back</a></b>";
		}
		
	//header("Location: ItemMaster.php");
	//exit;
?>
