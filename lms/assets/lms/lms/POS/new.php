<?php

error_reporting (E_ALL ^ E_NOTICE);
require('includes/functions.php'); //include functions
require('includes/dbconnect.php'); //include db connection
?>
</head>
<body onLoad="BodyLoad();" width="100%" >
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
<fieldset><legend><font style='font:normal 14px verdana'><b>Productwise Inventory</b></font> </legend>
<table width="100%" align="left">
<tr><td colspan="4" align="center">
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
                                        <a href="javascript:showCal('Calendar2')"><img src="images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;</td>
										<td width="25%">
									</tr>
								
									<tr>
										<td colspan="4" align="right">&nbsp;
											
										</td>
									</tr>
									<tr>
										<td colspan="4" align="center">
											<input type="button" name="search" value="Search"/>
										</td>
									</tr>
								</table>
							</fieldset>
							</div>
		
            </form>