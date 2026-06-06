<?php
session_start();
include("../db.php");
include("../urlaccess.php");
$dept=$_GET['$dept'];
$agroup=$_GET['agroup'];
$id=$_GET['id'];
$vendorname=$_GET['vendorname'];
	
	$address=$_GET['address'];
	$contactperson=$_GET['contactperson'];
	$phone=$_GET['phone'];
	$fax=$_GET['fax'];
	$email=$_GET['email'];
	$suppliersfor=$_GET['suppliersfor'];
?>
<?php
    //echo "SELECT a.id, a.dept_id, a.item_code, b.asset_name, a.unitprice, a.current_value, a.date_of_purchase, a.vendor,b.asset_group_id FROM individual_asset_details a INNER JOIN asset_master b ON a.id = b.id WHERE a.dept_id='$dept' AND b.asset_group_id='$agroup'";

	$sql = "SELECT a.id, a.dept_id, a.item_code, b.asset_name, a.unitprice, a.current_value, a.date_of_purchase, a.vendor,b.asset_group_id FROM individual_asset_details a INNER JOIN asset_master b ON a.id = b.id WHERE a.dept_id='$dept' AND b.asset_group_id='$agroup'";
	$rs = execute($sql);
	$num = rowcount($rs);
	if($num)
	{
		?>
        <br>
		<table class=forumline align=center width="80%">
		<tr><td Class="head" colspan=9 align=center>Modify Vendor Details</td></tr>
		<tr height='20'><td class="rowpic" align=center>Select</td><td class="rowpic" align=center>Asset Code</td><td class="rowpic" align=center>Asset Name</td><td class="rowpic" align=center>Purchase Value</td><td class="rowpic" align=center>Depreciated Value</td><td class="rowpic" align=center>Purchase Date</td><td class="rowpic" align=center>Vendor</td></tr>

		<?php
		for($i=0;$i<$num;$i++)
		{
			$r = fetcharray($rs,$i);
			$x=stripslashes
			?>
			<tr><td align="center"><input type="checkbox" name="mid[]" Value="<?=$r["id"]?>"></td>
            <td><input type="text" size=20 name="vname<?=$r[id]?>" value="<?=stripslashes($r[item_code])?>" readonly></td>
            <td><input type="text" size=20 name="aname<?=$r[id]?>" value="<?=stripslashes($r[asset_name])?>" readonly></td>
			<td><input type="text" size=20 name="vname<?=$r[id]?>" value="<?=stripslashes($r[unitprice])?>"></td>
			<td><input type="text" size=20 name="vcontact_person<?=$r[id]?>" value="<?=stripslashes($r[current_value])?>"></td>
			
			<td><input type="text" size=20 name="vemail<?=$r[id]?>" value="<?=stripslashes($r[date_of_purchase])?>"></td>
            <?
           // $satisfied=fetcharray(execute("select name from vendormaster_assets where `id`='$r[vendor]'"));
			?>
           
			<td><select name="vendor">

	<?php

	$sql22=execute("select * from vendormaster_assets where status='1' order by name");



	for($j=0;$j<rowcount($sql22);$j++)

	{

		$r22=fetcharray($sql22,$j);

          //echo $r22['name'];
		//  echo $vendor;
		if($vendor==$r22['name'])
		echo "<option value=$r22[id] selected>$r22[name]</option>";
		else
		echo "<option value=$r22[id]>$r22[name]</option>";

	}

	?>


			<?php
		}
		?>
		</table>
        <br>
        <div align="center"><input Type="Button" class=bgbutton Value="MODIFY" onClick="moddata()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input Type="Button" class=bgbutton Value="DELETE" onClick="deldata()"></div>
		<?php
	}

	

?>