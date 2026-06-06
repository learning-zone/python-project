<html>
<head>
<?php
session_start();
require("../db.php");

$PONum = $_POST['PONum'];
$username = $_POST['username'];
$POStatus = $_POST['POStatus'];
$vendor = $_POST['vendor'];
$filename = $_POST['filename'];
$printpo = $_POST['printpo'];
$id= $_POST['id'];
$f1= $_POST['f1'];

//-------------Adde By Shashidhar 0n 02-06-06--------

if($id=="")
{
	echo "<b>Please Select Check Box</b><br>";
	echo "<a href=ReceiveAssets.php><b>Go Back</b></a>";
	die();
}
//-----------------------------------------
?>
</head>
<body>
<form method="post" action="../PrintPO.php">
<?php
$today=date("Y-m-d");
/*$filename="../printmodule/MRReport$today.txt";
$f = fopen($filename, "w") or die("Could not open the file !!");*/
$sql1=execute("select * from dept_no where Dept='CENTRAL STORES'");
$rs1=fetcharray($sql1);
$DeptId=$rs1["dpt_id"];
$sql1=execute("select * from location_master where location='CENTRAL STORES'");
$rs1=fetcharray($sql1);
$LocationId=$rs1["id"];
$sql1=execute("select * from assetstatusmaster where condition='Not Installed'");
$rs1=fetcharray($sql1);
$ConditionId=$rs1["id"];
$sql1=execute("select * from purchaseordermaster where id=$PONum");
$rs1=fetcharray($sql1);
$sql22=execute("select * from vendormaster_assets where id=$vendor");
$rs22=fetcharray($sql22);
$CollegeName=fetcharray(execute("select * from college"));
$Caption=strtoupper($CollegeName["col_name"]);
echo "<center><b>$Caption</B></center><br>";
fwrite($f,"                  $Caption                \n");
echo "<center><b>MATERIAL RECEIVED RECEIPT</b></center><br><br>";
fwrite($f,"\n");
fwrite($f,"\n");
fwrite($f,"              MATERIAL RECEIVED RECEIPT                \n");
printf ("\t\t Received the items to <b>Central Stores</b> as per our P.O.No.:$rs1[PONumber] dated ".date("d-m-Y",strtotime($rs1["PODate"]))."<br>");
printf(" from M/s.$rs22[name] and the materials are subject to inspection.");
fwrite($f,"Received the items to Central Stores as per our P.O.No.:$rs1[PONumber] dated ".date("d-m-Y",strtotime($rs1["PODate"]))."\n");
fwrite($f,"from M/s.$rs22[name] and the materials are subject to inspection.\n\n\n");
echo "<br>";
echo "<br>";
echo "<table class=forumline align=center>";
echo "<tr><td class=rowpic>Sl No</td><td class=rowpic>Asset Name</td><td class=rowpic>Quantity</td></tr>";
fwrite($f,"______________________________________________________________________________________\n");
fwrite($f,"Sl No\tAsset Name\t\t\t\t\t\t\tQuantity\n");
fwrite($f,"______________________________________________________________________________________\n");
$slno=1;
while( list(,$Value) = each($id) )
{
	$ID = explode("-",$Value);
	$POID=$ID[0];
	$AssetId=$ID[1];
	//$QTY="quantity-".$Value;
//	$ReceivedQty=$$QTY;
			$ReceivedQty = $_POST["quantity-" . $Value];
	$sql1="insert into asset_received_details(po_number,received_date,asset_id,received_qty)";
	$sql1.=" values($POID,'$today',$AssetId,$ReceivedQty)";
	//echo $sql1;
	execute($sql1) or die(error_description()."error1");
	$sql2=execute("select * from purchaseorderdetails where PO_ID=$POID and asset_id=$AssetId") or die(error_description()."error1");
	//echo ("select * from PurchaseOrderDetails where PO_ID=$POID and asset_id=$AssetId") ;	
	//echo $rs2; 
	$rs2=fetcharray($sql2);
	for($k=0;$k<$ReceivedQty;$k++)
	{
		$sql2="insert into individual_asset_details(asset_id,unitprice,location_id,dept_id,current_value,asset_status_id,conditions,status,PO_ID,vendor) ";
		$sql2.="values('$AssetId','$rs2[unitprice]','$LocationId','$DeptId','$rs2[unitprice]','$ConditionId','Not Installed','false','$POID','$vendor')";
		//echo $sql2;
		execute($sql2) or die(error_description()."error3");
	}

	$sql2=execute("select a.*,b.* from purchaseorderdetails a,asset_master b where a.asset_id=b.id and a.PO_ID=$PONum and a.asset_id=$AssetId");
	$rs2=fetcharray($sql2);
	echo "<tr><td>$slno</td><td>$rs2[asset_name]</td><td>$ReceivedQty</td></tr>";
	fwrite($f,"$slno\t$rs2[asset_name]\t\t\t\t\t\t$ReceivedQty\n");
	$slno++;
}
fwrite($f,"______________________________________________________________________________________\n");
echo "</table>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<b>Manager</b>";
fwrite($f,"\n\n\n");
fwrite($f,"Manager");
if($POStatus=="Partly Received")
{
	$sql1=execute("select * from purchaseorderdetails where PO_ID=$PONum") or die(error_description()."error2");
	$ar[]=0;
	for($i=0;$i<rowcount($sql1);$i++)
	{
		$rs1=fetcharray($sql1,$i);
		$ar[$i]=$rs1["quantity"];
		$sql2=execute("select sum(received_qty) as rqty from asset_received_details where po_number=$PONum and asset_id=$rs1[asset_id]") or die(error_description()."error1");
		$rs2=fetcharray($sql2);
		if($rs2["rqty"]=="NULL")
		{
			$rr[$i]=0;
		}
		else
		{
			$rr[$i]=$rs2["rqty"];
		}
		if($i==0)
		{
			if(($ar[$i]==$rr[$i]))
			{
				$f1=true;
			}
			else
			{
				$f1=false;
				break;
			}
		}
		elseif ($i>0)
		{
			if(($i)==(rowcount($sql1)-1))
			{
				if(($ar[$i]==$rr[$i]))
				{
					$f1=true;
				}
				else
				{
					$f1=false;
					break;
				}
			}
			else
			{
				if(($ar[$i]==$rr[$i]))
				{
					$f1=true;
				}
				else
				{
					$f1=false;
					break;
				}
			}
		}
	}
	if($f1)
	{
		execute("update purchaseordermaster set status='Completely Received' where id=$PONum") or die(error_description());
	}
	else
	{
		execute("update purchaseordermaster set status='Partly Received' where id=$PONum") or die(error_description());
	}
}
elseif($POStatus=="Pending")
{
	$sql1=execute("select * from purchaseorderdetails where PO_ID=$PONum");
	$ar[]=0;
	for($i=0;$i<rowcount($sql1);$i++)
	{
		$rs1=fetcharray($sql1,$i);
		$ar[$i]=$rs1["quantity"];
		$sql2=execute("select sum(received_qty) as rqty from asset_received_details where po_number=$PONum and asset_id=$rs1[asset_id]") or die(error_description());
		$rs2=fetcharray($sql2);
		if($rs2["rqty"]=="NULL")
		{
			$rr[$i]=0;
		}
		else
		{
			$rr[$i]=$rs2["rqty"];
		}
		if($i==0)
		{
			if(($ar[$i]==$rr[$i]))
			{
				$f1=true;
			}
			else
			{
				$f1=false;
				break;
			}
		}
		elseif ($i>0)
		{
			if(($i)==(rowcount($sql1)-1))
			{
				if(($ar[$i]==$rr[$i]))
				{
					$f1=true;
				}
				else
				{
					$f1=false;
					break;
				}
			}
			else
			{
				if(($ar[$i]==$rr[$i]))
				{
					$f1=true;
				}
				else
				{
					$f1=false;
					break;
				}
			}
		}
	}
	if($f1)
	{
		execute("update purchaseordermaster set status='Completely Received' where id=$PONum") or die(error_description());
	}
	else
	{
		execute("update purchaseordermaster set status='Partly Received' where id=$PONum") or die(error_description());
	}
}
?>
<br>
<input type="hidden" name="filename" value="<?=$filename?>">
<tr><td align='center'><input type="submit" name="printpo" value="Print Report" class=bgbutton></td></tr>
</form>
</body>
</html>
