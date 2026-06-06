<html>
<body>
<?php
session_start();
include("../../db.php");
if(isset($_POST['date3']))
{
	$date4 = $_POST['date4'];
	$date4 = date("Y-m-d", strtotime($date4));
	
	$bill_num=$_POST['bill_num'];
	$supplier=$_POST['supplier'];
	
	$date3 = $_POST['date3'];
	$date3 = date("Y-m-d", strtotime($date3));
	
	$tax=$_POST['tax'];
	$total_amt=$_POST['total_amt'];
	
	$comments=$_POST['comments'];
	
	//$date_of_purchase=$PurYear."-".$PurMonth."-".$PurDay;
	
	$bill_date=$date3;
	
	
	//echo $date3;
	//die();
	
	$query_count="select count(*) from h_temp_cons_purchase_det ";
	$result_count=execute($query_count);
	while($qc=fetcharray($result_count))
	{
		$count=$qc[0];
	}
	$query_user="select * from users where username='$user'";
	$result_user=execute($query_user);
	while($qu=fetcharray($result_user))
	{
		$userid=$qu[2];
	}
	$query_per="insert into h_cons_purchase_m values('','$date4','$supplier','$bill_num','$bill_date','$count','$tax','$total_amt','$comments','$userid')";
	//echo $query_per;
	$result_per=execute($query_per) or die("data not inserted");
	$q_maxid="select max(id_m) from h_cons_purchase_m";
	$result_maxid=execute($q_maxid);
	while($qmid=fetcharray($result_maxid))
	{
		$maxid=$qmid[0];
	}
	$query_temp="select * from h_temp_cons_purchase_det";
	$result_temp=execute($query_temp);
	while($qdata=fetcharray($result_temp))
	{
		$id_det=$qdata[0];
		$id_m=$qdata[1];
		$itemname_id=$qdata[2];
		$quantity=$qdata[3];
		$quantity_type=$qdata[4];
		$unit_price=$qdata[5];
		$amount=$qdata[6];
		$query_cons="insert into h_cons_purchase_det values('','$maxid','$itemname_id','$quantity','$quantity_type','$unit_price','$amount')";
		//echo $query_cons;
		$result_cons=execute($query_cons);
	}
	$s=execute("select * from h_temp_cons_purchase_det");
	while($r=fetcharray($s))
	{
		$query_it="select * from h_item_master where id='$r[itemname_id]'";
		//echo "select * from item_master where id='$r[itemname_id]'";
		$result_it=execute($query_it);
		while($qit=fetcharray($result_it))
		{
			$stk=$qit[3];
			$total_stk=$stk+$r[quantity];
			$qstock="update h_item_master set stock='$total_stk' where id='$r[itemname_id]'";
			//echo "update item_master set stock='$total_stk' where id='$r[itemname_id]'";
			$result_stk=execute($qstock) or die("not updated");
		}
	}
	echo "<b>Inserted Successfuly...!</b><br>";

	$query_del="delete from h_temp_cons_purchase_det";
	$result_del=execute($query_del);
	
	echo "<a href=PurchaseMaster.php><u>Back</u></a>";
}
?>
</body></html>