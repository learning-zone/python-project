<html>
<head>
<?php
require('includes/functions.php'); 
require('includes/dbconnect.php'); 
error_reporting (E_ALL ^ E_NOTICE);
?>
<?php
$sysdate=date("d/m/Y");
$adate=$sysdate;
$bdate=$adate;
?>
<link href="newStyles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="JSScripts/cal2.js"></script>
<script language="javascript" src="JSScripts/cal_conf2.js"></script>
<script language="javascript">
function prn()
{
	pr1.style.display = "none";
	window.print();
}
</script>
</head>
<body  >
<?php //include "validUserHeader.php"; ?>
<table width="100%" border="0" cellpadding=0 cellspacing=0 align="center">
<tr>
<td class="bottomborder" colspan="2" height="22" valign="top">
<?php include "topMenu.php"; ?> <!--<script SRC="JS/myCRM_Top_Menu.js"></script>-->
</td>
</tr>
<tr>
<td width="90%" height="400" valign="top" align="left"><!-- Center of the page -->
<form name="frm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<br>
<br>
<table width="100%" valign="top" align="left">
<tr>
<td valign="top" align="left">
<div style="padding: 10px; width: 700px" align="left">
<fieldset><legend><font style='font:normal 14px verdana'><b>Daywise Inventory</b></font> </legend>
								<table width="100%" align="left">
									<tr>
										<td colspan="4" align="center">
											<div id="addProductStatus"></div>
										</td>
									</tr>
									<tr>
										<td colspan="4" align="center">&nbsp;
											
										</td>
									</tr>
									<tr>
										<td colspan="4" align="center">&nbsp;
											
										</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'>Select From Date <font color="red" size="4"><b>*</b></font></font>
										</td>
										
                                  <td>&nbsp;&nbsp;<input type="text" readonly="" name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
<a href="javascript:showCal('Calendar1')"><img src="images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'>Select To Date <font color="red" size="4"><b>*</b></font></font>
										</td>
										 <td>&nbsp;&nbsp;<input type="text" readonly="" name="bdate" value="<?php echo $bdate?>">&nbsp;&nbsp;
<a href="javascript:showCal('Calendar2')"><img src="images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
</td>
										<td width="25%">
									</tr>
								
									<tr>
										<td colspan="4" align="right">&nbsp;
											
										</td>
									</tr>
									<tr>
										<td colspan="4" align="center">
											<input type="submit" name="search" value="Search"/>
										</td>
									</tr>
								</table>
							</fieldset>
							</div>
		
           
<tr>
 <td align="left" valign="top">
   <div id="productList" style="padding: 10px; width: 700px" scrollbar="yes">
							<fieldset>
        						<legend><font style='font:normal 14px verdana'><b>Datewise Inventory Report</b></font> </legend>
								<table width="100%" align="left">
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
                                    if(isset($_POST['search'])){
									$adate = "$_POST[adate]"; 
								    $adate1 = explode('/',$adate);
									$adate=$adate1[2]."-".$adate1[1]."-".$adate1[0];
									$bdate = "$_POST[bdate]";
								     $bdate1 = explode('/',$bdate);
									$bdate=$bdate1[2]."-".$bdate1[1]."-".$bdate1[0];
									
								    $temp=mysql_query("SELECT * FROM receipt_totols WHERE DATE_OF_PURCHASE BETWEEN '$adate' AND '$bdate' ");
									 echo mysql_error();
									  $i = 1;
									  while($n=mysql_fetch_assoc($temp)){
									  
									      
										  $RECEIPT_ID = $n[RECEIPT_ID];
										  $TOTAL_QUANTITY = $n[TOTAL_QUANTITY];
										  $TOTAL_AMOUNT = $n[TOTAL_AMOUNT];
										  $DATE_OF_PURCHASE = $n[DATE_OF_PURCHASE];
										$i++;
											$bcolor = '#FFFFFF';
											if($i%2 == 0){
												$bcolor = '#C3D9FF';
											}
									  ?>
										<tr bgcolor='<?php echo $bcolor; ?>'>
											<td width="20%" align="left">
												<font style='font:normal 12px verdana'><?php echo $RECEIPT_ID; ?></font>
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
}
									?> 
						
 </form>
								</table>
							</fieldset>
							</div>
							<table align="center">
           <div id=pr1 align="center"><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'></div>
		   </table>
   </table>
 

  </body>
</html>

