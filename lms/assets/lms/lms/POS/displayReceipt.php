<?php include("includes/dbconnect.php");
error_reporting (E_ALL ^ E_NOTICE);
$receiptNumber=$_REQUEST['receiptNumber'];
$reorderpro='';
?>
<html >
<head>
<link href="newStyles.css" rel="stylesheet" type="text/css" />
    	<script src="JS/calendar.js" type="text/javascript"></script>
		<link href="JS/calendar.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">

function prn()
{
	//alert(self.opener.location);
	//self.opener.location.reload(1);
	//parent.opener.location.reload();
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

<body>
<table width="30%" border="0" align="center">
<?php
$sql1=mysql_query("SELECT * FROM company");
while($r2=mysql_fetch_array($sql1))
{

		echo "<tr><td class='bottomborder' align='center' colspan='6'>
        <font style='font:normal 20px verdana;color=blue'><b>$r2[1]</b></font></td></tr>";
		echo "<tr><td align='center' colspan='6'>
        <font style='font:normal 13px verdana;color=blue'>$r2[2]</font></td></tr>";
		echo "<tr><td  align='center' colspan='6'>
        <font style='font:normal 13px verdana;color=blue'>$r2[3]</font></td></tr>";
		echo "<tr><td class='bottomborder'  align='center' colspan='6' nowrap>
        <font style='font:normal 13px verdana;color=blue'>PH : $r2[phone_num1]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 TIN :  $r2[tin_number]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 Web site : $r2[website]</font></td></tr>";

}
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

							$query1=mysql_query("SELECT * FROM receipt_details WHERE RECEIPT_ID='{$receiptNumber}'");
							$tinc=1;
							while($r1=mysql_fetch_array($query1))
							{
								$productname=mysql_fetch_row(mysql_query("SELECT PRODUCT_NAME FROM PRODUCTS WHERE PRODUCT_CODE='$r1[1]'"));
							$sub=($r1[5]*$r1[4]);
								echo "<tr height='24'>
									<td  nowrap>
										$tinc
									</td>
									<td align='left' nowrap>
										$r1[3]            
									</td>
									<td align='left' nowrap>
										$r1[4]     </td>
									<td align='left' nowrap>
										$r1[5]              				
									</td>
									<td align='left' nowrap>
										$r1[6]				
									</td>
									<td align='left' nowrap>
										$sub			
									</td>
								</tr>";
									$tinc++;
								}
								$getReceiptTotals=mysql_fetch_row(mysql_query("SELECT TOTAL_PAYABLE FROM receipt_totals WHERE RECEIPT_ID='{$receiptNumber}'"));
								$getReceiptDiscount=mysql_fetch_row(mysql_query("SELECT TOTAL_DISCOUNT FROM receipt_totals WHERE RECEIPT_ID='{$receiptNumber}'"));
								echo "<tr height='24'>
                				<td class='bottomtopborder' colspan='5' align='right'>
                					<font style='font:normal 11px verdana'><b>Discount&nbsp;&nbsp;&nbsp;</b></font>                				
								</td>
                 				<td class='bottomtopborder' nowrap>
                					 $getReceiptDiscount[0]  				
								</td>
                			</tr>
							<tr height='24'>
                				<td  colspan='5' align='right'>
                					<font style='font:normal 11px verdana'><b>TOTAL&nbsp;&nbsp;&nbsp;</b></font>                				
								</td>
                 				<td  nowrap>
                					 $getReceiptTotals[0]           				
								</td>
                			</tr>";
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

