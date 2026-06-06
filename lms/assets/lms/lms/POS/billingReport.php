<html>
<head>
<?php
require('../POS/includes/functions.php'); 
require('../db.php'); 
error_reporting (E_ALL ^ E_NOTICE);
?>
<?php
$sysdate=date("d/m/Y");
$adate=$sysdate;
$bdate=$adate;
if($_REQUEST)
$stud_id=$_REQUEST['stud_id'];
else
$stud_id=$_POST['stud_id'];

?>
<script language="javascript" src="../POS/JSScripts/cal2.js"></script>
<script language="javascript" src="../POS/JSScripts/cal_conf2.js"></script>
<script language="javascript">
function prn()
{
	pr1.style.display = "none";
	window.print();
}

function OpenWind3(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=700,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
</head>
<body  >
<form name="frm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<input type="hidden" name="stud_id" value="<?php echo $stud_id; ?>">

								<table width="50%" align="center">
									<tr>
										<td colspan="4" class="head" align="center">Select Date Range
											
										</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											Select From Date *
										</td>
										
                                  <td>&nbsp;&nbsp;<input type="text" readonly="" name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
<a href="javascript:showCal('Calendar1')"><img src="../POS/images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
</td>
									</tr>
									<tr>
										<td width="30%" align="right">
					Select To Date *
										</td>
										 <td>&nbsp;&nbsp;<input type="text" readonly="" name="bdate" value="<?php echo $bdate?>">&nbsp;&nbsp;
<a href="javascript:showCal('Calendar2')"><img src="../POS/images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
</td>
										<td width="25%">
									</tr>
									
								</table>
					<br>
                    <div align="center">
											<input type="submit" name="search" value="Search" class="bgbutton"/>
										</div>
                                        <br>
                                        
 <?php
 if(!$_POST)
 die();
 ?>								<table  align="center">
									<tr >
										<td width="20%" align="left"  class="head" nowrap>
											RECEIPT NUMBER
										</td>
										<td width="50%" align="left"  class="head" nowrap>
											NUMBER OF PRODUCTS			</td>
										<td width="15%" align="left"  class="head" nowrap>
											BILLING DATE
										</td>										
										<td width="15%" align="left"  class="head" nowrap>
											TOTAL BILL AMOUNT
										</td>
									</tr>
								  <?php
                                    if(isset($_POST['search'])){
										$adate = "$_POST[adate]"; 
								    	$adate1 = explode('/',$adate);
										$adate=$adate1[2]."-".$adate1[1]."-".$adate1[0];
										$bdate = "$_POST[bdate]";
								     	$bdate1 = explode('/',$bdate);
										$bdate=$bdate1[2]."-".$bdate1[1]."-".$bdate1[0];
									
								    	$temp=mysql_query("SELECT * FROM receipt_totals WHERE DATE_OF_PURCHASE BETWEEN '$adate' AND '$bdate' ");
									 	echo mysql_error();
										  $i = 1;
										  $totalFinalAmount = 0;
										  while($n=mysql_fetch_assoc($temp)){
									      
											  $RECEIPT_ID = $n[RECEIPT_ID];
											  $TOTAL_QUANTITY = $n[TOTAL_QUANTITY];
											  $TOTAL_AMOUNT = $n[TOTAL_PAYABLE];
											  
											  $DATE_OF_PURCHASE = $n[DATE_OF_PURCHASE];
										  
										  	  $totalFinalAmount = ($totalFinalAmount + $TOTAL_AMOUNT);
										  
											  $i++;
											  $bcolor = '#FFFFFF';
											  if($i%2 == 0){
												$bcolor = '#C3D9FF';
											  }
									  ?>
										<tr bgcolor='<?php echo $bcolor; ?>'>
											<td width="20%" align="left">
												<font style='font:normal 12px verdana'>
												
												<a href="javascript:OpenWind3('../POS/displayReceipt.php?receiptNumber=<?php echo $RECEIPT_ID; ?>')" >
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
									  	} // ENd of WHile
									 ?>
										<tr >
											<td colspan="4" align="right">&nbsp;
												
											</td>
										</tr>									 
										<tr bgcolor='<?php echo $bcolor; ?>'>
											<td colspan="3" align="right" class="bottomtopborder">
												<font style='font:normal 12px verdana'><b>TOTAL Rs :</b></font>
											</td>
											<td align="right" class="bottomtopborder">
												<font style='font:normal 12px verdana'><b><?php echo $totalFinalAmount ; ?></b></font>
											</td>
										</tr>	
										
																																				 
									<?php
									} // End of IF
									?> 
						
 									</form>
								
   </table>
<br>
											<div align="center">
												<INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
											</div>
												

  </body>
</html>

