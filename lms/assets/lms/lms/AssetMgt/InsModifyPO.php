<html>
<head>
<?php
session_start();
require("../db.php");

$print = $_POST['print'];
$PONum = $_POST['PONum'];
$search_po = $_POST['search_po'];

?>
</head>
<script language="Javascript">
function printReport()
{
	prn.style.display="none";	
	print(this.form);
	prn.style.display="";	
}
</script>
<body>
<form method="post" >
<?php
$PODate="$POYear-$POMon-$PODay";
$subject = $text1."#*".$text2."#*".$text3."#*".$text4."#*".$text5."#*".$text6;
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
$sql1="update PurchaseOrderMaster set PODate='$PODate',additional_charges=$add_charges,total_bill_amount=$total_bill_amount,";
$sql1.=" raised_by='$PersonName',remarks='$subject',conditions='$conditions' where id=$poid";
execute($sql1) or die(error_description());
while( list(,$Value) = each($id) )
{
	//$Qty="quantity".$Value;
//	$OrderQty=$$Qty;
		$OrderQty = $_POST["quantity" . $Value];
	//$UPrice="unitprice".$Value;
//	$UnitPrice=$$UPrice;
		$UnitPrice = $_POST["unitprice" . $Value];
	//$TPrice="totalprice".$Value;
//	$TotalPrice=$$TPrice;
		$TotalPrice = $_POST["totalprice" . $Value];
	$sql2="update PurchaseOrderDetails set unitprice=$UnitPrice,quantity=$OrderQty,";
	$sql2.=" totalprice=$TotalPrice where id=$Value";

	execute($sql2) or die(error_description());
}
$vensql=execute("select * from VendorMaster_Assets where id=$vendorid") or die(error_description());
$vsql=fetcharray($vensql);
$CollegeName=fetcharray(execute("select * from college"));

$Caption=strtoupper($CollegeName["col_name"]);
$SubHead=$CollegeName["col_name"];

?>
<center><b><?=$Caption?></B><br>
<p>
<br>

Ref : <?=$SubHead?>/PO/<?=strtoupper($PONum)?>         /           /                                Date : <?=date("d-m-Y",strtotime($PODate))?><br>
To,<br>
	Mr.<?=$vsql[contact_person]?><br>
	<?=$vsql[name]?><br>
	<?=$vsql[address]?><br>
<br>

<center><b>PURCHASE ORDER</B></center>


<?php
$sql=execute("select * from PurchaseOrderMaster where id=$poid");
$r=fetcharray($sql);
$x=explode("#*",$r["remarks"]);
for($g=0;$g<8;$g++)
{
echo $x[$g]."<br>";
}
?>
<table border =1 cellspacing=0>
<tr><td>Sl No </td><td>Description</td><td>Qty</td><td>Rate</td><td>Amount</td><td>Total</td></tr>
<?php
	$sql3=execute("select b.asset_name,a.quantity,a.unitprice,a.totalprice from PurchaseOrderDetails a,asset_master b where a.PO_ID=$poid and a.asset_id=b.id");
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
		if ($key == "asset_name")
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
			if($var_len[$k]>0)
			{
			$temp = $templen / $var_len[$k];
			}
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
		$l = 0;
	}
}
?>
</table>
<br><br>
<b>Additional Charges : Rs.<?=$add_charges?><br>
<font color=blue><b>Total value of the Bill Rs.<?=$total_bill_amount?></b></font><br>
<br><br>
<center><b>TERMS & CONDITIONS</B></CENTER>

<?php
echo "<tr><td align='left'><font color=blue>" ;
$x=explode("#*",$r["conditions"]);
for($i=0;$i<10;$i++)
{
	echo "$x[$i] <br>";
}
echo " </font>" ;
echo "</td></tr>";
?>
<br>
<br>
Thanking You,<br>
Yours truly,<br>
<p>
<p>
Principal
<br>
<input type="button"  id=prn value="Print Purchase Order" name="print" class='bgbutton' onclick='printReport()'>
</form>
</body>
</html>

