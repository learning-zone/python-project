<?php
error_reporting (E_ALL ^ E_NOTICE);
require('includes/functions.php'); 
require('includes/dbconnect.php'); 
$error = array(); 
$message = '';
$errmsg = '';
if ( count( $error ) > 0 ) { 
$errmsg = '<div>Errors:<br /><ul>';
foreach( $error as $err ) { 
$errmsg .= "<li>{$err}</li>";
    }
    $errmsg .= '</ul></div>';
}
?>
<?php
$sysdate=date("d/m/Y");
$adate=$sysdate;
$bdate=$adate;
?>
<html>
<head>
<title>Employee Report</title>
<script language="javascript" src="JSScripts/cal2.js"></script>
<script language="javascript" src="JSScripts/cal_conf2.js"></script>
<script language="javascript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=700,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
    </script>
  </head>
  <body onLoad="BodyLoad();" width="100%" >
<?php //include "validUserHeader.php"; ?>

<tr><td class="bottomborder" colspan="2" height="22" valign="top">
<?php include "topMenu.php"; ?> 
</td>
</tr>
<tr><td width="10%" height="400" border="1" valign="top"><!--<?php include "leftNavigation.php"; ?>-->&nbsp;</td>
<form name="frm" action="" method="post">
<td valign="top" align="center">
<div style="padding: 10px; width: 700px">
<fieldset><legend><font style='font:normal 14px verdana'><b>Staff Day To Day Activity</b></font> </legend>
<table width="100%" align="left">
<br>
<?php
$sql=mysql_query("SELECT * FROM users");
?>
<tr><td width="11%" align="left"><b>Select Staff</b></td>
<td width="89%">&nbsp;<select name="emp">
<option value='0'>All</option>
<?php
while($row=mysql_fetch_array($sql))
{
	if($row[0]==$_POST[emp])
		echo "<option value='$row[0]' selected>$row[1]</option>";
	else
		echo "<option value='$row[0]'>$row[1]</option>";
}
?>
</select>
</td>
</tr>
<tr><td width="30%" align="left"><font style='font:normal 12px verdana'><b>Select From Date</b> <font color="red" size="4"><b>*</b></font></font></td>
<td>&nbsp;&nbsp;<input type="text" readonly="" name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
<a href="javascript:showCal('Calendar1')"><img src="images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;</td></tr>
</td>
</tr>
<tr><td width="30%" align="left"><font style='font:normal 12px verdana'><b>Select To Date</b> <font color="red" size="4"><b>*</b></font></font>
</td><td>&nbsp;&nbsp;<input type="text" readonly="" name="bdate" value="<?php echo $bdate?>">&nbsp;&nbsp;
<a href="javascript:showCal('Calendar2')"><img src="images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
</td>
<td width="25%">
</tr><tr><td colspan="4" align="center"><input type="submit" name="submit" value="search"/>
</td></tr></table></fieldset></div></td></tr>
</div>
</form>
<br>
<?php
if(isset($_POST['submit']))
{
	?>

	<div id="productList" style="padding: 10px; width: 700px" scrollbar="yes">
	<fieldset>
	<table boarder="1" width="100%" align="center">
			<tr><td align="center"><font size="3" color="#000066"><b>Report From :<?php echo $adate;?>&nbsp;&nbsp;TO&nbsp;&nbsp;<?php echo $bdate; ?></b></font></td>
			</tr>
			</table>
	<?php 
	$adate = "$_POST[adate]"; 
	$adate1 = explode('/',$adate);
	$adate=$adate1[2]."-".$adate1[1]."-".$adate1[0];
	$bdate = "$_POST[bdate]";
	$bdate1 = explode('/',$bdate);
	$bdate=$bdate1[2]."-".$bdate1[1]."-".$bdate1[0];
	if($_POST[emp]==0)
	{
		$temp1=mysql_query("SELECT USER_NAME FROM receipt_totals WHERE DATE_OF_PURCHASE BETWEEN '$adate' AND '$bdate' GROUP BY USER_NAME");
		while($n1=mysql_fetch_array($temp1))
		{
			$temparr[]=$n1[0];
		}
	}
	else
	{
		$temparr[]=$_POST[emp];
	}
	
	for($k=0;$k<sizeof($temparr);$k++)
	{
		$sql44=mysql_fetch_row(mysql_query("SELECT USER_NAME FROM users WHERE USER_ID ='$temparr[$k]'"));
		?>
			<table boarder="1" width="100%" align="center">
			<tr><td align="center"><font size="3" color="#000066"><b>Staff Name:&nbsp;
			<?php echo $sql44[0];?>&nbsp;&nbsp;</b></font></td>
			</tr>
			</table>
			<legend><font style='font:normal 14px verdana'><b>Billing/Receipts Report</b></font> </legend>
		<table width="100%" align="left">
		<tr bgcolor="#3C74E6">
		<td width="20%" align="left" nowrap="nowrap">
		<font style='font:normal 12px verdana; color:#FFFFFF'><b>RECEIPT NUMBER</b></font>
		</td>
		<td width="50%" align="left" nowrap="nowrap">
		<font style='font:normal 12px verdana; color:#FFFFFF'><b>NUMBER OF PRODUCTS/SERVICES</b></font>
		</td>
		<td width="15%" align="left " nowrap="nowrap">
		<font style='font:normal 12px verdana; color:#FFFFFF'><b>BILLING DATE</b></font>
		</td>										
		<td width="15%" align="left" nowrap="nowrap">
		<font style='font:normal 12px verdana; color:#FFFFFF'><b>TOTAL BILL AMOUNT</b></font>
		</td>
		</tr>
		<?php
		$temp=mysql_query("SELECT * FROM receipt_totals WHERE DATE_OF_PURCHASE BETWEEN '$adate' AND '$bdate' AND USER_NAME='$temparr[$k]' ORDER BY USER_NAME");
		$i=1;
		echo mysql_error();
		$totalFinalAmount = 0;
		while($n=mysql_fetch_assoc($temp))
		{
			
			
		?>
		
	
		
		
			<?php
			$RECEIPT_ID = $n[RECEIPT_ID];
			$TOTAL_QUANTITY = $n[TOTAL_QUANTITY];
			$TOTAL_AMOUNT = $n[TOTAL_PAYABLE];
			$DATE_OF_PURCHASE = $n[DATE_OF_PURCHASE];
			
			$totalFinalAmount = ($totalFinalAmount + $TOTAL_AMOUNT);
			
			$i++;
			$bcolor = '#FFFFFF';
			if($i%2 == 0)
			$bcolor = '#C3D9FF';
				?> 
				<tr bgcolor='<?php echo $bcolor; ?>'>
					<td width="20%" align="left">
						<font style='font:normal 12px verdana'>
						<a href="javascript:OpenWind2('displayReceipt.php?receiptNumber=<?php echo $RECEIPT_ID; ?>')" >
						<?php echo $RECEIPT_ID; ?></a>
						</font>
					</td>
					<td width="50%" align="left">
						<font style='font:normal 12px verdana'><?php echo $TOTAL_QUANTITY ; ?></font>
					</td>
					<td width="15%" align="left">
						<font style='font:normal 12px verdana'><?php echo $DATE_OF_PURCHASE; ?></font>
					</td>											
					<td width="15%" align="right">
						<font style='font:normal 12px verdana'><?php echo $TOTAL_AMOUNT; ?></font>
					</td>
				</tr>						 
		
		<?php
		}
		$i++;
			$bcolor = '#FFFFFF';
			if($i%2 == 0)
			$bcolor = '#C3D9FF';
		?>
		
		<tr bgcolor='<?php echo $bcolor; ?>'>
		<td colspan="3" align="right" class="bottomtopborder">
		<font style='font:normal 12px verdana'><b>TOTAL Rs :</b></font>
		</td>
		<td align="right" class="bottomtopborder">
		<font style='font:normal 12px verdana'><b><?php echo $totalFinalAmount ; ?></b></font>
		</td>
		</tr>
		<tr >
		<td colspan="4" align="right">&nbsp;
		
		</td>
		</tr>				
		</table>
		<?php
		
	}
}
?>
</fieldset>
</div>
</table>
</body>
</html>

