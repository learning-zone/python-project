<?php include("../db1.php");
error_reporting (E_ALL ^ E_NOTICE);
$receiptNumber=$_REQUEST['receiptNumber'];
$reorderpro='';
		$query2=mysql_query("SELECT DESCRIPTION FROM temp_rec GROUP BY DESCRIPTION");
		while($r2=mysql_fetch_array($query2))
		{
				$productname=mysql_fetch_row(mysql_query("SELECT PRODUCT_NAME FROM products WHERE PRODUCT_CODE='$r2[0]'"));
		}
		$query1=mysql_query("SELECT * FROM temp_rec ORDER BY ID");
		$tinc=1;
		while($r1=mysql_fetch_array($query1))
		{
		$productname=mysql_fetch_row(mysql_query("SELECT PRODUCT_NAME FROM products WHERE PRODUCT_CODE='$r1[1]'"));
		if($suntot=='')
			{
				$suntot1=$r1[2];
				$suntot2=$r1[4];
				$suntot3=$r1[5];
				$suntot4=$r1[6];
				$suntot=$r1[7];
			}
			else
			{
				$suntot1=$suntot1+$r1[2];
				$suntot2=$suntot2+$r1[4];
				$suntot3=$suntot3+$r1[5];
				$suntot4=$suntot4+$r1[6];
				$suntot=$suntot+$r1[7];
			}
			$tinc++;
			$uernamet=$r1['USERNAME'];
			$datedet=date('Y-m-d');
			$timedet=date('H-i-s', time() +45000);
			//echo "INSERT INTO RECEIPT_DETAILS(RECEIPT_ID,SL_NO,PRODUCT_ID,PRODUCT_NAME,QUANTITY,AMOUNT,TAX,DISCOUNT,PAYABLE,USER_NAME,DATE_OF_PURCHASE, TIME_OF_PURCHASE) values('$receiptNumber','$tinc','$r1[1]','$productname[0]','$r1[2]','$r1[AMOUNT]','$r1[SERVICETAXAMOUNT]','$r1[DISCOUNTAMOUNT]','$r1[TOTAL]','$r1[USERNAME]','$datedet','$timedet')";


			mysql_query("INSERT INTO receipt_details(RECEIPT_ID,SL_NO,PRODUCT_ID,PRODUCT_NAME,QUANTITY,AMOUNT,TAX,DISCOUNT,PAYABLE,USER_NAME,DATE_OF_PURCHASE, TIME_OF_PURCHASE) values('$receiptNumber','$tinc','$r1[1]','$productname[0]','$r1[2]','$r1[AMOUNT]','$r1[SERVICETAXAMOUNT]','$r1[DISCOUNTAMOUNT]','$r1[TOTAL]','$r1[USERNAME]','$datedet','$timedet')");
		mysql_query("UPDATE products SET QUANTITY=(QUANTITY-'$r1[2]') WHERE PRODUCT_CODE='$r1[1]' ");
		$reorderlevel=mysql_fetch_row(mysql_query("SELECT PRODUCT_NAME FROM products WHERE PRODUCT_CODE='$r1[1]' AND CATEGORY=1 AND QUANTITY<=REORDERLEVEL"));
		if($reorderpro=='')
		$reorderpro=$reorderlevel[0];
		else
		$reorderpro=$reorderpro.", ".$reorderlevel[0];
		}
		$reorderpro;
		
			mysql_query("INSERT INTO receipt_totals(RECEIPT_ID,TOTAL_QUANTITY,TOTAL_AMOUNT,TOTAL_TAX,TOTAL_DISCOUNT,TOTAL_PAYABLE,USER_NAME,DATE_OF_PURCHASE, TIME_OF_PURCHASE) VALUES('$receiptNumber','$suntot1','$suntot2','$suntot4','$suntot3','$suntot','$uernamet','$datedet','$timedet')");

//************************************inventory from student **************************************
	$ttlamt=$suntot2;
	$newRemarks=$comets;
	$dddate1=date('Y-m-d');
		$u1=mysql_query("select * from ac_voucher where iIdx_vouchermaster=6");
		$ru1=mysql_num_rows($u1);
		if($ru1>0)
		{
			$n1=$ru1/2;
			if($n1>9)
			{
				$n2='00'.($n1+1);
			}
			else
			{
				$n2='000'.($n1+1);
			}
		}
		else
		{
			$n2='0001';
		}

/*		
$cashdetBal=mysql_query("select fopbal from ac_ledger where iIdx_ledger=53");
$traildetBal=mysql_query("select fopbal from ac_ledger where iIdx_ledger=40");
$cashdetBal1=mysql_fetch_row($cashdetBal);
$traildetBal1=mysql_fetch_row($traildetBal);

$newcashdetBal1=$cashdetBal1[0]+$ttlamt;
$newtraildetBal1=$traildetBal1[0]-$ttlamt;
$newRemarks=strtoupper($amt_str);

mysql_query("update ac_ledger set fopbal='$newcashdetBal1' where iIdx_ledger=53");
mysql_query("update ac_ledger set fopbal='$newtraildetBal1' where iIdx_ledger=40");

mysql_query("INSERT INTO ac_opbal (opdate, Vledger, fopbal, iId_grp, vins, Dr_Cr, iIdx_organization) VALUES
('$dddate1', 'Supreme Enterprises', $newtraildetBal1, 32, 'Bangalore School', 'Cr', 1),
('$dddate1', 'VAT input account', $newcashdetBal1, 30, 'Bangalore School', 'Dr', 1)");

mysql_query("INSERT INTO ac_voucher ( iIdx_ledger, iIdx_vouchermaster, iIdx_institution, ddate, Dr_Cr, particulars, chequedd_no, chequedd_date, fdebit, fcredit, vvoucherno, vnarration, acc, iIdx_group, istatus, iIdx_organization, vbillno, dbilldate) VALUES
(54, 6, 1, '$dddate1', 'Dr', 'By VAT input account', '', '0000-00-00', '$ttlamt', '0.00', '$n2', '$newRemarks', 'VAT input account', 30, 0, 1, '$docid', '$dddate1'),
(40, 6, 1, '$dddate1', 'Cr', 'To Supreme Enterprises', '', '0000-00-00', '0.00', '$ttlamt', '$n2', '$newRemarks', 'Supreme Enterprises', 32, 0, 1, '$docid', '$dddate1')");



*/
//********************vat starts ********************
	$ttlamt=$suntot4+$ttlamt;

	$u1=mysql_query("select * from ac_voucher where iIdx_vouchermaster=6");
		$ru1=mysql_num_rows($u1);
		if($ru1>0)
		{
			$n1=$ru1/2;
			if($n1>9)
			{
				$n2='00'.($n1+1);
			}
			else
			{
				$n2='000'.($n1+1);
			}
		}
		else
		{
			$n2='0001';
		}


		
$cashdetBal=mysql_query("select fopbal from ac_ledger where iIdx_ledger=53");
$traildetBal=mysql_query("select fopbal from ac_ledger where iIdx_ledger=58");
$cashdetBal1=mysql_fetch_row($cashdetBal);
$traildetBal1=mysql_fetch_row($traildetBal);

$newcashdetBal1=$cashdetBal1[0]+$ttlamt;
if($traildetBal1[0]>0)
$newtraildetBal1=$traildetBal1[0]-$ttlamt;
else
$newtraildetBal1=$traildetBal1[0]+$ttlamt;
$newRemarks=strtoupper($amt_str);

mysql_query("update ac_ledger set fopbal='$newcashdetBal1' where iIdx_ledger=53");
mysql_query("update ac_ledger set fopbal='$newtraildetBal1' where iIdx_ledger=58");

mysql_query("INSERT INTO ac_opbal (opdate, Vledger, fopbal, iId_grp, vins, Dr_Cr, iIdx_organization) VALUES
('$dddate1', 'MBIS131 Fee a/c', $newtraildetBal1, 24, 'Bangalore School', 'Cr', 1),
('$dddate1', 'Inventory-stationery', $newcashdetBal1, 18, 'Bangalore School', 'Dr', 1)");

mysql_query("INSERT INTO ac_voucher ( iIdx_ledger, iIdx_vouchermaster, iIdx_institution, ddate, Dr_Cr, particulars, chequedd_no, chequedd_date, fdebit, fcredit, vvoucherno, vnarration, acc, iIdx_group, istatus, iIdx_organization, vbillno, dbilldate) VALUES
(58, 6, 1, '$dddate1', 'Dr', 'To MBIS131 Fee a/c', '', '0000-00-00', '$ttlamt', '0.00', '$n2', '$newRemarks', 'MBIS131 Fee a/c', 24, 0, 1, '$docid', '$dddate1'),
(53, 6, 1, '$dddate1', 'Cr', 'By Inventory-stationery', '', '0000-00-00', '0.00', '$ttlamt', '$n2', '$newRemarks', 'Inventory-stationery', 18, 0, 1, '$docid', '$dddate1')");




//*******************************************code end *********************************************

//*******************************************code end *********************************************



?>
<html >
<head>
    	<script src="JS/calendar.js" type="text/javascript"></script>
<script type="text/javascript">

function prn()
{
	//alert(self.opener.location);
	//self.opener.location.reload(1);
	parent.opener.location.reload();
    window.close();
}

function printReceipt()
{
	
	pr1.style.display = "none";
	window.print();
	pr1.style.display = "block";
}

</script>
</head>

<body onLoad="printReceipt()">
<table width="30%" border="0" align="center">
<?php
//$sql1=mysql_query("SELECT * FROM COMPANY");
//while($r2=mysql_fetch_array($sql1))
//{

		echo "<tr><td class='bottomborder' align='center' colspan='6'>
        <font style='font:normal 20px verdana;color=blue'><b>Bangalore School</b></font></td></tr>";
		echo "<tr><td align='center' colspan='6'>
        <font style='font:normal 13px verdana;color=blue'>Address1</font></td></tr>";
		echo "<tr><td  align='center' colspan='6'>
        <font style='font:normal 13px verdana;color=blue'>Address2</font></td></tr>";
		echo "<tr><td class='bottomborder'  align='center' colspan='6' nowrap>
        <font style='font:normal 13px verdana;color=blue'>PH : blrsch@gmail.com&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 TIN :  677665&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 Web site : sample.com</font></td></tr>";

//}
									$suntot1=0;
									$suntot2=0;
									$suntot3=0;
									$suntot4=0;
									$suntot=0;
?>
                			<tr height="24">
                				<td class="bottomborder" align="left" colspan="6">
                					<font style='font:normal 12px verdana;color=blue'><b>Receipt No :    				
                				
                					<?php echo $receiptNumber; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Date :  <?php echo date("d-m-Y"); ?></b></font>             </td>           				
                			</tr>
                			<tr height="24">
                				<td width="43" >
                					<font style='font:normal 10px verdana'><b>Sl No</b></font>                				</td>
                				<td width="111" >
                					<font style='font:normal 10px verdana'><b>Item</b></font>                				</td>
                				<td width="58" >
                					<font style='font:normal 10px verdana'><b>Qty</b></font>                				</td>
                				<td width="56">
                					<font style='font:normal 10px verdana'><b>MRP</b></font>                				</td>
                				<td width="67" >
                					<font style='font:normal 10px verdana'><b>Tax</b></font>                				</td>
                			
                				<td width="114" >
                					<font style='font:normal 10px verdana'><b>Payable</b></font>                				</td>
                			</tr>
                			<?php 
							if($_REQUEST['actionid']);
							{
								$tede=$_REQUEST['actionid'];
								mysql_query("DELETE FROM temp_rec WHERE ID='$tede'");
							}
							if($_POST[Save])
							{
								$query2=mysql_query("SELECT DESCRIPTION FROM temp_rec GROUP BY DESCRIPTION");
								while($r2=mysql_fetch_array($query2))
								{
									$productname=mysql_fetch_row(mysql_query("SELECT PRODUCT_NAME FROM products WHERE PRODUCT_CODE='$r2[0]'"));
								}
							}
							$query1=mysql_query("SELECT * FROM temp_rec ORDER BY ID");
							$tinc=1;
							while($r1=mysql_fetch_array($query1))
							{
							$productname=mysql_fetch_row(mysql_query("SELECT PRODUCT_NAME FROM products WHERE PRODUCT_CODE='$r1[1]'"));
							$sub=($r1[2]*$r1[3]);
							echo "<tr height='24'>
                				<td  nowrap>$tinc
								</td>
                				<td align='left' nowrap>
                					$productname[0]            </td>
                				<td align='left' nowrap>
                					$r1[2]     </td>
                				<td align='left' nowrap>
                					$r1[3]              				</td>
                				<td align='left' nowrap>
                					$r1[6]				</td>
                				<td align='left' nowrap>
                					$sub           				</td>
                			</tr>";
								if($suntot=='')
								{
									$suntot1=$r1[2];
									$suntot2=$r1[4];
									$suntot3=$r1[5];
									$suntot4=$r1[6];
									$suntot=$r1[7];
								}
								else
								{
									$suntot1=$suntot1+$r1[2];
									$suntot2=$suntot2+$r1[4];
									$suntot3=$suntot3+$r1[5];
									$suntot4=$suntot4+$r1[6];
									$suntot=$suntot+$r1[7];
								}
								$tinc++;
								$datedet=date('Y-m-d');
								$timedet=date('H-i-s');
								
							}
							
								          			echo "<tr height='24'>
                				<td class='bottomtopborder' colspan='5' align='right'>
                					<font style='font:normal 11px verdana'><b>Discount&nbsp;&nbsp;&nbsp;</b></font>                				</td>
                				              				
                 				<td class='bottomtopborder' nowrap>
                					 $suntot3  				</td>
                			</tr>
							<tr height='24'>
                				<td  colspan='5' align='right'>
                					<font style='font:normal 11px verdana'><b>TOTAL&nbsp;&nbsp;&nbsp;</b></font>                				</td>
                				              				
                 				<td  nowrap>
                					 $suntot           				</td>
                			</tr>";
							
							$uernamet;
							$suntot;
							$balsql=mysql_query("select bal_amount ,col_amount,spent_amount from spl_advances_coll where student_id='$uernamet' and status=1");
							while($balamt=mysql_fetch_array($balsql))
							{
								$bal_amount=$balamt['bal_amount'];
								$col_amount=$balamt['col_amount'];
								$spent_amount=$balamt['spent_amount'];
							}
							$newbal=$bal_amount-$suntot;
							$newspentamt=$spent_amount+$suntot;
							mysql_query(" update spl_advances_coll set bal_amount='$newbal' ,spent_amount='$newspentamt'  where student_id='$uernamet' and status=1");
							?>
							<tr>
                				<td align="center" colspan="6">
                					<br><br></td>           				
                			</tr>
							<tr>
                				<td align="center"colspan="6">
                					<font style='font:normal 12px verdana;color=blue'>Thank You. Visit Again</font>             </td>           				
                			</tr></table>
							<br>
							<br>
							<div id='pr1' align="center"><INPUT TYPE="button" class=bgbutton NAME="CLOSE" VALUE="CLOSE" onclick='prn()'></div>
						
						
</html>
<?php
	mysql_query("TRUNCATE temp_rec");
?>