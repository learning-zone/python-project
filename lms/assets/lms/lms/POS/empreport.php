<html>
<head>
<script language="javascript">
function prn()
{
	pr1.style.display = "none";
	window.print();
}
</script>
</head>
<body>
<form name="frm" action="" method="post">
<input type="hidden" name="emp" value="<?php echo $_POST['emp']; ?>">
<input type="hidden" name="adate" value="<?php echo $_POST['adate']; ?>">
<input type="hidden" name="bdate" value="<?php echo $_POST['bdate']; ?>">
<?php
require('includes/functions.php'); 
require('includes/dbconnect.php'); 
error_reporting (E_ALL ^ E_NOTICE);
$adate=$_POST[adate];
$bdate=$_POST[bdate];
$employee=$_POST['emp'];
if($employee=='0')
{
	$sql5=mysql_query("SELECT USER_NAME FROM receipt_totals GROUP BY USER_NAME");
	while($row2=mysql_fetch_row($sql5))
	{
		$empid[]=$row2[0];
	}
}
else
$empid[]=$employee;
for($k=0;$k<sizeof($empid);$k++)
{
	$sql2=mysql_query("SELECT * FROM users WHERE USER_ID ='$empid[$k]'");
	while($row=mysql_fetch_assoc($sql2))
	{
		?>
		<table colspan="6" boarder="1" align="center">
		<tr><td align="center"><font size="+1"><b>Staff Name:&nbsp;
		<?php echo $row['USER_NAME'];?>&nbsp;&nbsp;Report From :<?php echo $adate;?>&nbsp;&nbsp;TO&nbsp;&nbsp;<?php echo $bdate; ?></b></font></td>
		</tr>
		</table>
		<?php
	 }
	 ?>
	  

		<table width="50%" align="center" boarder="1">
		<tr bgcolor="#3C74E6">
		<td width="20%" align="left">
		<font style='font:normal 12px verdana; color:#FFFFFF'><b>SL NO</b></font>
		</td>
		<td width="60%" align="left">
		<font style='font:normal 12px verdana; color:#FFFFFF'><b>TOTAL QUANTITY PRODUCTS</b></font>
		</td>
		<td width="20%" align="left">
		<font style='font:normal 12px verdana; color:#FFFFFF'><b>TOTAL_AMOUNT</b></font>
		</td>
		<td width="20%" align="left">
		<font style='font:normal 12px verdana; color:#FFFFFF'><b>DATE_OF_PURCHASE</b></font>
		</td>
		</tr>
		<?php
		
			$adate = "$_POST[adate]"; 
			
			$adate1 = explode('/',$adate);
			$adate=$adate1[2]."-".$adate1[1]."-".$adate1[0];
			$bdate = "$_POST[bdate]";
			 $bdate1 = explode('/',$bdate);
			$bdate=$bdate1[2]."-".$bdate1[1]."-".$bdate1[0];
			if($empid[$k]!='0')
			{
				$temp=mysql_query("SELECT * FROM  receipt_totals WHERE  USER_NAME='$empid[$k]' AND DATE_OF_PURCHASE BETWEEN '$adate' AND '$bdate'");
			}
			else 
			{
				$temp=mysql_query("SELECT * FROM  receipt_totals WHERE DATE_OF_PURCHASE BETWEEN '$adate' AND '$bdate'");
			}
			echo mysql_error();
		  	$i = 0;
		  
		  while($n=mysql_fetch_assoc($temp))
		  {
			  
				  $RECEIPT_ID = $n[RECEIPT_ID];
				  $TOTAL_QUANTITY = $n[TOTAL_QUANTITY];
				  $TOTAL_AMOUNT = $n[TOTAL_PAYABLE];
				  $DATE_OF_PURCHASE = $n[DATE_OF_PURCHASE];
					$i++;
					$bcolor = '#FFFFFF';
					if($i%2 == 0)
					{
					$bcolor = '#C3D9FF';
					}
		  ?>
			<tr bgcolor='<?php echo $bcolor; ?>'>
			<td width="20%" align="left">
				<font style='font:normal 12px verdana'><?php echo $i; ?></font>
			</td>
			<td width="60%" align="left">
				<font style='font:normal 12px verdana'><?php echo $TOTAL_QUANTITY ; ?></font>
			</td>
			<td width="60%" align="left">
				<font style='font:normal 12px verdana'><?php echo $TOTAL_AMOUNT; ?></font>
			</td>
			<td width="60%" align="left">
				<font style='font:normal 12px verdana'><?php echo $DATE_OF_PURCHASE; ?></font>
			</td>
			</tr>
			
<?php
	}
?>
</table>
<br>
<?php
	 	
}
?> 
						
		   
<div id='pr1' align="center"><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'></div></form>
</body>
</html>
