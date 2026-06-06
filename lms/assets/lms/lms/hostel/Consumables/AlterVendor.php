<?php
session_start();
require("../../db.php");
//$Types = $_REQUEST['Types'];
print_r($_GET);
if($_REQUEST)
{
$Types = $_REQUEST['Types'];
}
else
{
$vendor_id = $_GET['vendor_id'];
$vendor_name = $_GET['vendor_name'];
$address = $_GET['address'];
$contact_person = $_GET['contact_person'];
$phone = $_GET['phone'];
$fax = $_GET['fax'];
$email = $_GET['email'];
$remarks = $_GET['remarks'];
}

//echo "hi";
//echo $vendor_id;
if( is_array($vendor_id) )
{
	//echo "1 " ;
	//echo $vendor_id;
	//echo "2 " ;
	while( list(,$Value) = each($vendor_id) )
	{
		//echo "hello " ;
		//echo $Types ;
		//$vendor_id = $_POST["vendor_id" . $Value];
//		echo $vendor_id ;
		$VName = $_GET["vendor_name" . $Value];
		$DAddress = $_GET["address".$Value];
		$Vcontact_person = $_GET["contact_person".$Value];
		$VPhone = $_GET["phone".$Value];
		$Vfax = $_GET["fax".$Value];
		$Vemail = $_GET["email".$Value];
		$VRemarks = $_GET["remarks".$Value];

		
		$query  = "SELECT ledger_id FROM h_suplier_master WHERE id=$Value";
		$rs = execute($query) or die("QUERY $query " . error_description());
		$row = fetcharray($rs);
		$ldid = $row["ledger_id"];
		mysql_free_result($rs);
		//echo "outside";
		if($Types == "Mod")
		{
			//echo "inside";
			$mvname=strtoupper($VName);
			echo $mvname;
			$chkquery0="select * from LD where LID='$ldid'";
			$chkquery1=execute($chkquery0) or die(error_description());
            if(rowcount($chkquery1)==0)
		       {
				//echo "<br><B>DUPLICATE VENDOR NAME, TRY AGAIN !!!</B>";
				?>
                <script type="text/javascript">
				alert("DUPLICATE VENDOR NAME, TRY AGAIN !!!")
				</script>
                <?
                echo "<a href=SuplierMaster.php><u>Back</u></a>";
		    	die();

		       }
      $sqlstr = "Update h_suplier_master set name='" . trim($VName) . "',address='".trim($DAddress) ."',contact_person='$Vcontact_person',phone='$VPhone',fax='$Vfax',email='$Vemail' ,remarks='$VRemarks' where id=" . $Value ;
		}
		echo $sqlstr;
			execute($sqlstr);
	}
    echo "<b>Updated Successfully..!</b><br>";
		//echo $Types ;
	echo "<b><a href=SuplierMaster.php><u>Back</u></a></b>";
}
//else
{
//echo "<b>Please Select The Check Box...!</b><BR>";
//echo "<b><a href=SuplierMaster.php><u>Back</u></a></b>";
}
?>