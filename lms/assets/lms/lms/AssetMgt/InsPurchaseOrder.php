<html>
<head>
<?php
session_start();
require("../db.php");

$vendor = $_POST['vendor'];
$idr = $_POST['idr'];
$quant1 = $_POST['quant1'];
$quant2 = $_POST['quant2'];
$id = $_POST['id'];
$total_bill_amount = $_POST['total_bill_amount'];

?>
</head>
<body>
<script>
function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display='';
}
</script>
<form method="post" >
<!--<input type=text name='iddt' value=<?=$idr?>>
<input type=text name='ghyt' value=<?=$quant?>>-->

<?php
$today=date("Y-m-d");
$mxtd=fetcharray(execute("select max(id) from quotation")) or die("llowqaa");
$dyup=fetcharray(execute("select *from quotation where id='$mxtd[0]'")) or die("lloolo");
$qnop=$dyup[QuotNo];
//$dtdpp=$today;
$qtdddt=$dyup[QuotDate];
$dtdpp=date('d-m-Y',strtotime($qtdddt));
//$filename="../printmodule/PurchaseOrder".$today.".txt";
//$f = fopen($filename, "w") or die("Could not open the file !!");
$subject = $text1."#*".$text2."#*".$text3."#*".$text4.$qnop."/".$dtdpp."#*".$text5."#*".$text6;
if(!empty($text7))
{
	$subject.="#*".$text7."#*";
}
if(!empty($text8))
{
	$subject.="#*".$text8;
}
$conditions=$condition1."#*".$condition2."#*".$condition3."#*".$condition4."#*".$condition5."#*".$condition6."#*".$condition7."#*".$condition8;
if(!empty($condition9))
{
	$conditions.="#*".$condition9."#*";
}
if(!empty($condition10))
{
	$conditions.="#*".$condition10;
}
$add_chargeshead=$add_charges."#*".$oth_charges;
// $sql1="insert into PurchaseOrderMaster(PODate,additional_charges,total_bill_amount,raised_by,";
// $sql1.=" vendor_id,remarks,conditions,POType,status) values('$today',$add_charges,$total_bill_amount,'$personname',";
// $sql1.=" $vendor,'$subject','$conditions','NEW','Pending')";

//-----------------------------ADDED BY ANURAJ-------------------------------------------
if(isset($id))			
{
if($total_bill_amount=="")
{
die("<font color=red><b>Please Enter The Total Amount...!</b></font><br><font color=blue><b><a href=PurchaseOrder.php><u>Back</u></a></b></font>");
}
//-----------------------------------------------------*****************-------------------------------------------
$sql1="insert into purchaseordermaster(PODate,additional_chargeshead,additional_charges,total_bill_amount,raised_by,";
$sql1.=" vendor_id,remarks,conditions,POType,status) values('$today','$add_chargeshead','$add_charges','$total_bill_amount','$personname',";
$sql1.=" '$vendor','$subject','$conditions','NEW','Pending')";
//echo $sql1;
execute($sql1) or die("<font color=red><b>Please Select the Check Box..adf.!</b></font><br><font color=blue><b><a href=PurchaseOrder.php><u>Back</u></a></b></font>");
$POID=fetchInsertId();
//echo $POID."<br>";
$temp_sql=execute("select * from college");
$temp_r=fetcharray($temp_sql);
$college=$temp_r[col_code];
mysql_free_result($temp_sql);
$PONumber=strtoupper($college)."PO".$POID;
}
//-----------------------------ADDED BY ANURAJ-------------------------------------------
else
{
die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=PurchaseOrder.php><u>Back</u></a></b></font>");
}
//-----------------------------***************-------------------------------------------
if(isset($id))
//-----------------------------ADDED BY ANURAJ-------------------------------------------
{
	if(is_array($id))
	{
while( list(,$Value) = each($id) )
{
	$i=explode("-",$Value);
	$QID=$i[0];
	$RID=$i[1];
	//$AssetId=$i[2];
	//$Qty="quantity".$Value;
//	$OrderQty=$$Qty;
			$OrderQty = $_POST["quantity" . $Value];
	//$UPrice="unitprice".$Value;
//	$UnitPrice=$$UPrice;
			$UnitPrice = $_POST["unitprice" . $Value];
	//$astdd="asstd".$Value;
//	$AssetId=$$astdd;
			$AssetId = $_POST["asstd" . $Value];
	?>
<input type=hidden name=ghyt1 value=<?=$quant1?>>
<input type=hidden name=ghyt2 value=<?=$quant2?>>
	<?
	//$TPrice="totalprice".$Value;
//	$TotalPrice=$$TPrice;
	$TotalPrice = $_POST["totalprice" . $Value];
	$sql2="insert into purchaseorderdetails(PO_ID,RID,QID,asset_id,unitprice,quantity,";
	$sql2.="totalprice) values($POID,$quant1,$QID,$AssetId,'$UnitPrice',$OrderQty,'$TotalPrice')";
	//echo $sql2;
	execute($sql2) or die(error_description()."error2");
	execute("update quotation set POStatus='Raised' where id=$QID") or die("yyyyyy");
	execute("update requirementindent set POStatus='Raised' where id=$quant1") or die("wwwww");
}
}
}
//-----------------------------ADDED BY ANURAJ--------------------------------------------------
else
{
die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=PurchaseOrder.php><u>Back</u></a></b></font>");
}
//-------------------------------------------------***************-----------------------------------------
$vensql=execute("select * from vendormaster_assets where id=$vendor") or die("gggggggg");
$vsql=fetcharray($vensql);
execute("update purchaseordermaster set PONumber='$PONumber' where id=$POID") or die("ssss");
$CollegeName=fetcharray(execute("select * from college")) or die("oooooo");
$Caption=strtoupper($CollegeName["col_name"]);
$SubHead=$CollegeName["col_name"];
?>
<center><b><?=$Caption?></B><br></center>
<p><br>Ref : <?=$SubHead?>/PO/<?=$PONumber?>         /           /                               Date : <?=date("d-m-Y",strtotime($today))?><br>
To,<br>Mr.<?=$vsql[contact_person]?><br><?=$vsql[name]?><br><?=$vsql[address]?><br><br>
<c enter><b>PURCHASE ORDER</B></center>
<?php
$sql=execute("select * from purchaseordermaster where id=$POID") or die("dddd");
$r=fetcharray($sql);
$x=explode("#*",$r["remarks"]);
for($g=0;$g<8;$g++)
{
	echo $x[$g]."<br>";
	//printf("$x[$g] \n");
}
?>
<table border =1 cellspacing=0>
<tr><td>Sl No </td><td>Description</td><td>Qty</td><td>Rate</td><td>Amount</td><td>Total</td></tr>
<?php
	$sql3=execute("select b.asset_name,a.quantity,a.unitprice,a.totalprice from purchaseorderdetails a,asset_master b where a.PO_ID=$POID and a.asset_id=b.id") or die("ffffffff");
	//echo  ("select b.asset_name,a.quantity,a.unitprice,a.totalprice from PurchaseOrderDetails a,asset_master b where a.PO_ID=$POID and a.asset_id=b.id");
	$slno=1;
	$serial = 0;
	while ($r3=fetcharray($sql3, MYSQL_ASSOC))
	{
		echo "<tr><td>$slno</td><td>$r3[asset_name]</td><td>$r3[quantity]</td><td>$r3[unitprice]</td><td>$r3[totalprice]</td><td>$r3[totalprice]</td></tr>";
		$slno++;
	$k = 1;
	$l = 0;
	$highest_no_of_lines = 1;
	$line[$l] = "";
	$startofline = 0;
	$templinelength = 0;
	$linelength = 0;
	$serial++;
	
	if     (($serial > 9) && ($serial <=99))        $line[0] = $serial . "     ";
	elseif (($serial > 99) && ($serial <= 999))     $line[0] = $serial . "    ";
	elseif (($serial > 999)&& ($serial <= 9999))    $line[0] = $serial . "   ";
	elseif (($serial > 9999) && ($serial <= 99999)) $line[0] = $serial . "  ";
	else $line[0] = $serial . "      ";
	while (list($key, $value) = each($r3))
	{
		$tempp = "";
		if ($key == "asset_description")
		{
			$d = strlen(trim($value));
			for ($a=0;$a<$d;$a++)
			{
				if ($value[$a] == chr(13))
				{
					$tempp .= " ";
					if ($value[$a+1] == " ")
						$tempp .= "";
				}
				elseif ($value[$a] == " ")
					$tempp .= " ";
				else
					$tempp .= trim($value[$a]);
			}
			$value = trim($tempp);
		}
		/*
		if (strlen($value) < $var_len[$k])
		{
			$line[$l] .= $value;
			$temp = $var_len[$k] - strlen($value);
			for ($a=1;$a<=$temp;$a++)
			{
				$line[$l] .= " ";		//BLANK FOR REMAINING CHARACTERS-POSTFIX.
			}
			$line[$l] .= "\t";
		}
		elseif (strlen($value) > $var_len[$k])
		{
			$var_start = 0;
			$eol = 1;
			$templen = strlen($value);
			$temp = $templen / $var_len[$k];
			$no_of_lines = intval($temp);
			$temp1 = ($temp - $no_of_lines) * 10;
			if (($temp1) != 0)
				$no_of_lines++;

			if ($highest_no_of_lines < $no_of_lines)
				$highest_no_of_lines = $no_of_lines;

			for ($xy=1;$xy<=$no_of_lines;$xy++)
			{
				if ($xy > 1)
				{
					for ($y=$startofline;$y<=$linelength;$y++)
					{
						$line[$l] .= " ";		// BLANK FOR LINE 2, 3 ETC. - PREFIX.
					}
					if ($startofline == 0) $line[$l] .= "\t";	// THIS TAB FOR ADJUSTED SPACES IN LINE 2, 3 ETC. INSTEAD OF SERIAL NOS.
				}
				$templinelength = $linelength + $var_len[$k];
				for ($a=$var_start;$a<$var_len[$k]*$eol;$a++)
				{
					if (!empty($value[$a]))
						$line[$l] .= $value[$a];
					else
						$line[$l] .= " ";	// BLANK FOR REMAINING CHARACTERS-POSTFIX.
				}
				$var_start = $a;
				$line[$l] .= "\t";
				$eol++;
				$l++;
			}
		}
		elseif (strlen($value) == $var_len[$k])
		{
			$line[$l] .= $value;
			$line[$l] .= "\t";
		}
		$linelength = $linelength + $var_len[$k] + 6;
		$startofline = $templinelength;
		$k++;
		$l = 0;*/
	}
	for ($z=0;$z<$highest_no_of_lines;$z++)
	{
		$line[$z] = "";
	}
}
?>
</table>
<br><br>
<b>Tax Amount: Rs.<?=$add_charges?><br>
<b>Other Charges : Rs.<?=$oth_charges?><br>
<font color=blue><b>Total value of the Bill Rs.<?=$total_bill_amount?></b></font><br>
<br><br>
<center><b>TERMS & CONDITIONS</B></CENTER>
<?php
$x=explode("#*",$r["conditions"]);

for($i=0;$i<10;$i++)
{
	echo "$x[$i] <br>";
}

?>
<br>
<br>
Thanking You,<br>
Yours truly,<br>
<p>
<p>
Principal
<br>
<div align=center id=prn>
<input type="button" value="Print Purchase Order" name="print" onclick='printReport()' class=bgbutton>
</div>
</form>
</body>
</html>
