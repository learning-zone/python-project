<?php
session_start();
include("../db.php");
$flag = $_POST['flag'];
$dept = $_POST['dept'];
$group = $_POST['group'];
$subgroup = $_POST['subgroup'];
$check_id = $_POST['check_id'];
$igroup = $_POST['igroup'];
$ExistingQuantity = $_POST['ExistingQuantity'];
$quantity = $_POST['quantity'];
$location_no = $_POST['location_no'];
$submit1 = $_POST['submit1'];
$Delete = $_POST['Delete'];
$igroup = $_POST['igroup'];
$sql=execute("select * from asset_details_temp") or die(error_description());
for($i=0;$i<rowcount($sql);$i++)
{
	$r=fetcharray($sql,$i);
	 $sql1="select a.* from individual_asset_details a,dept_no b where a.dept_id=b.dpt_id and b.Dept='Central Stores' and a.asset_id=$r[asset_id] order by a.id asc limit 0,$r[quantity] ";
	//$sql1="select a.* from individual_asset_details a,dept_no b, a.asset_id=$r[asset_id] order by a.id asc limit 0,$r[quantity] ";
	//$sql1="select * from individual_asset_details where location_id='0' and dept_id='0' limit 0,$r[quantity]"; 
	//echo $sql1;
	$rs1=execute($sql1) or die(error_description());
	for($j=0;$j<rowcount($rs1);$j++)
	{
		$r1=fetcharray($rs1,$j);
		$nsql="update individual_asset_details set dept_id=$r[dept_id],location_id=$r[location_id],item_code='$r[asset_no]' where id=$r1[id]";
		//echo $nsql;
		execute($nsql) or die(error_description());
		echo "<font color=blue><b>Asset Numbers are :$r[asset_no] </b><br></font>";
	}
}
echo "<font color=red><b> All Assets Issued Successfully !! </b></font>";
?>
