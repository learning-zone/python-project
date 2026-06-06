<?php
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
session_start();
require_once("../db.php");
if($_GET)
{
	$actn=$_REQUEST['actn'];
	$jmsub=$_REQUEST['jmsub'];
}
if($_POST)
{
	
	$id=$_POST['id'];
	$nid=$_POST['nid'];
	$act=$_POST['act'];
	$idttl=$_POST['idttl'];
	$jmsub=$_POST['jmsub'];
	$title=$_POST['title'];
    $du_dd=$_POST['du_dd'];
	$du_mm=$_POST['du_mm'];
	$du_yy=$_POST['du_yy'];
	$su_dd=$_POST['su_dd'];
	$su_mm=$_POST['su_mm'];
	$su_yy=$_POST['su_yy'];
	$copies=$_POST['copies'];
	$amount=$_POST['amount'];
	$source=$_POST['source'];
	$library=$_POST['library'];
    $remarks=$_POST['remarks'];
	$bill_no=$_POST['bill_no'];
    $a_sub_no=$_POST['a_sub_no'];
	$supplier=$_POST['supplier'];
	$language=$_POST['language'];
	$register1=$_POST['register1'];
	$extraAmount=$_POST['extraAmount'];
	$amountMonth=$_POST['amountMonth'];
	$periodicity=$_POST['periodicity'];
	$amount_type=$_POST['amount_type'];
	$bank_details=$_POST['bank_details'];
	
}

$sub_date = "$du_yy-$du_mm-$du_dd";
$due_date = "$su_yy-$su_mm-$su_dd";
//add
if($actn==1)
{
	
    $sql2="SELECT * FROM lib_magazine_subscription WHERE title='$title' and subscription_date='$sub_date' and ssp_type='$jmsub'";
	$rs2=execute($sql2);
	if(rowcount($rs2)==0)
	{    
		$sql="INSERT INTO lib_magazine_subscription (title,language,periodicity,";
		$sql.="due_date,supplier,";
		$sql.="subscription_date,a_sub_no,";
		$sql.="amount_type,amount,bill_no,bank_details,source,copies,amountMonth,extraAmount,remarks,ssp_type,library,register)";
		$sql.=" values ('$title','$language','$periodicity',";
		$sql.="'$due_date','$supplier','$sub_date','$a_sub_no',";
		$sql.="'$amount_type','$amount','$bill_no','$bank_details','$source','$copies','$amountMonth','$extraAmount',";
		$sql.="'$remarks','$jmsub','$library','$register1')";
		$result=execute($sql) or die(mysql_error());
		if($result)
		{
			$msg='Records Inserted';
		    echo "<META HTTP-EQUIV='Refresh' Content='0;URL=subscribe.php?msg=$msg&jmsub=$jmsub&act=$act'>";
		}
		else
		{
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=subscribe.php?msg=$msg&jmsub=$jmsub&act=$act'>";
		}
	}
	else
	{
		echo "<a href=../library/subscribe.php>Go Back</a></td>";
		echo "<br>";
		die("Duplicate Entry");
	}
}
//modify
elseif($actn==2)
{
	$sql="update lib_magazine_subscription set title='$title',language='$language',";
	$sql.="periodicity='$periodicity',due_date='$due_date',supplier='$supplier',";
	$sql.="subscription_date='$sub_date',a_sub_no='$a_sub_no',";
	$sql.="amount_type='$amount_type',amount='$amount',bill_no='$bill_no', bank_details='$bank_details',";
	$sql.=" source='$source',copies='$copies',amountMonth='$amountMonth',extraAmount='$extraAmount', remarks='$remarks' where id='$nid' ";
	//echo "<br>".$sql;
	$result=execute($sql) or die(mysql_error());
	  if($result)
	  {
		  $msg='Records Updated';
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=subscribe.php?msg=$msg&jmsub=$jmsub&act=$act&idttl=$idttl'>";
	  }
	  else
	  {
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=subscribe.php?msg=$msg&jmsub=$jmsub&act=$act&idttl=$idttl'>";
	  }
}
//Inactive
elseif($actn==3)
{
	$sql="update lib_magazine_subscription set stts=0 where id='$nid' ";
	$result=execute($sql) or die(mysql_error());
	  if($result)
	  {
		  $msg='Records Inactivated';
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=subscribe.php?msg=$msg&jmsub=$jmsub&act=$act&idttl=$idttl'>";
	  }
	  else
	  {
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=subscribe.php?msg=$msg&jmsub=$jmsub&act=$act&idttl=$idttl'>";
	  }
}
?>
