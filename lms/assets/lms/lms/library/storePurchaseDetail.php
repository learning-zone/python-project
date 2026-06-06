<?php
require_once("../db.php");
$order=$_POST['order'];
$bill_no = $_POST['bill_no'];
$dd = $_POST['dd'];
$mm = $_POST['mm'];
$yy = $_POST['yy'];
$library = $_POST['library'];
$vendor = $_POST['vendor'];
$tid = $_POST['tid'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$title = $_POST['title'];
$copies = $_POST['copies'];
$unit = $_POST['unit'];
$pending = $_POST['pending'];
$received = $_POST['received'];
$paytype = $_POST['paytype'];
$submit1 = $_POST['submit1'];
if(!checkdate($mm,$dd,$yy))
	{
		echo "Invalid Recieved Date.";
		die("</td></tr></table>");
	}
$p_dt = "$yy-$mm-$dd";
$sql="select * from lib_purchase_m where purchaseno='".$bill_no."'";
$rs=execute($sql);
$row=rowcount($rs);
if ($row >0)
{
	echo "Bill Number already exits";
	die("");
}
$purchased_amount=0;
$total_copies=0;
while(list(,$id_value) = each($tid))
{
	//$unit="unit".$id_value;
	//$unit=$$unit;
	$unit=$_POST["unit".$id_value];

	//$received="received".$id_value;
	//$received=$$received;
	$received=$_POST["received".$id_value];

	$total_copies=$total_copies+$received;
	
	$p_amount=$unit*$received;
	
	$purchased_amount=$purchased_amount+$p_amount;
}
$sql = "INSERT INTO lib_purchase_m(order_id,purchaseNo,copies,delivery_date,amt,library,ptype)";
$sql .= "VALUES(".$order.",'".$bill_no."',".$total_copies.",'".$p_dt."','".$purchased_amount."',".$library.",'".$paytype."')" ;
execute($sql);
$r_id=fetchInsertId();
reset($tid);
while(list(,$id_value)=each($tid))
{
	//$au="author$id_value";
	//$au=$$au;
	$au=$_POST["author".$id_value];

	//$pu="publisher$id_value";
	//$pu=$$pu;
	$pu=$_POST["publisher".$id_value];

	//$tit="title$id_value";
	//$tit=$$tit;
	$tit=$_POST["title".$id_value];

	//$copies="copies$id_value";
	//$copies=$$copies;
	$copies=$_POST["copies".$id_value];

	//$received="received$id_value";
	//$received=$$received;
	$received=$_POST["received".$id_value];

	//$pending="pending$id_value";
	//$pending=$$pending;
	$pending=$_POST["pending".$id_value];

	//$amt="unit$id_value";
	//$amt=$$amt;
	$amt=$_POST["unit".$id_value];

	$balance=$pending-$received;

	$qry="insert into lib_purchase_det(purchase_id,title,copies,author,publisher,apprate,received,balance) values('$r_id','$tit',$copies,'$au','$pu','$amt',$received,$balance)";
	execute($qry);
	$received_copy=($copies-$balance);
	execute("update lib_order_det set received_copies=$received_copy where id=$id_value");
}
echo("Purchase order entered");
?>
