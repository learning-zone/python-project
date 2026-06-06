<?php


/*
if($_SESSION['userID'] == null)
{
	header('Location: login.php');
}
*/
// Breadcrumb

include("./Breadcrumb.php");
$trail = new Breadcrumb();
$trail->add('Generate Receipt', generateReceipt, 1);

// END of Breadcrumb


require('includes/functions.php'); //include functions
require('includes/dbconnect.php'); //include db connection
//require('PhpPrinter/print.php');


$error = array(); //define $error to prevent error later in script
$message = '';

// START - SAVE INFO INTO THE DATABASE
print "OUTSIDE";

if ( isset( $_POST['submit'] ) ) {

	print "INSIDE";

    $error = array();
    array_map( 'stripslashes',$_POST ); //Strips slashes
    array_map( 'mysql_real_escape_string',$_POST ); //Escapes data to protect against sql injection

	$date = date("Y-m-d", time() + 45000);

	// Customer Information
    $custName = $_POST['custName'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$receiptID = $_POST['receiptNumber'];


	if ( count( $error ) == 0 ) { //if there are no errors, then insert into database



		 for ($i=1; $i<=10; $i++)
		  {

		  	$SlNo = $_POST['SlNo'.$i];
		  	if(!is_null($SlNo)) {
				$billProduct = $_POST['billProduct'.$i];
				$billQuantity = $_POST['billQuantity'.$i];
				$pricePerQuantity = $_POST['pricePerQuantity'.$i];
				$tax = $_POST['tax'.$i];
				$discount = $_POST['discount'.$i];
				$billAmount = $_POST['billAmount'.$i];

				//print "INSERT INTO receipt_details(RECEIPT_ID, SL_NO, PRODUCT_ID, PRODUCT_NAME, QUANTITY, AMOUNT, TAX, DISCOUNT, PAYABLE)	VALUES('{$receiptID}','{$SlNo}', '{$billProduct}','{$billProduct}','{$billQuantity}','{$pricePerQuantity}','{$tax}','{$discount}','{$billAmount}')";
				$query3 = mysql_query( "INSERT INTO receipt_details(RECEIPT_ID, SL_NO, PRODUCT_ID, PRODUCT_NAME, QUANTITY, AMOUNT, TAX, DISCOUNT, PAYABLE)	VALUES('{$receiptID}','{$SlNo}', '{$billProduct}','{$billProduct}','{$billQuantity}','{$pricePerQuantity}','{$tax}','{$discount}','{$billAmount}')", $con);
				$i++;
			}
		  }


		//$query3 = mysql_query( "INSERT INTO _CUSTOMER_VISIT_INFO(ORG_ID, OUTLET_ID, ENQUIRY_FLAG, QUANTITY_ENQUIRED, CUSTOMER_ID, NOTES_COMMENTS, VISIT_ID, OUTLET_USER_ID, DATE_OF_ENTRY, NAME_OF_PRODUCT, SAMPLES_GIVEN, PROJECT_ENQUIRY) VALUES('{$orgID}', '{$outletID}', 'YES', '{$approxQty}', '{$custID}', '{$notes}', '{$visitID1}', '{$userID}', '{$date}', '{$nameOfProduct}', '{$samplesGiven}', '{$projectEnquiryFlag}')", $con);

		$error[] = 'New customer created';
	}
}



// END - SAVE INFO INTO THE DATABASE




$errmsg = '';
if ( count( $error ) > 0 ) { //if there are errors, build the error list to be displayed.
    $errmsg = '<div>Errors:<br /><ul>';
    foreach( $error as $err ) { //loop through errors and put then in the list
        $errmsg .= "<li>{$err}</li>";
    }
    $errmsg .= '</ul></div>';
}
?>

<html>
  <head>
    <title>Generate Receipt</title>

    <link href="newStyles.css" rel="stylesheet" type="text/css" />
  </head>
  <body width="100%" >
<?php //include "validUserHeader.php"; ?>
<table width="100%" border="0" cellpadding=0 cellspacing=0>
  	<tr>
  		<td class="bottomborder" colspan="2" height="22" valign="top">
  		<?php include "topMenu.php"; ?> <!--<script SRC="JS/myCRM_Top_Menu.js"></script>-->
  		</td>
  	</tr>
	<tr>
		<!--
		<td width="10%" height="400" border="1" valign="top">
			<?php //include "leftNavigation.php"; ?>&nbsp;
		</td>
		-->
        <td width="100%" height="400" valign="top" align="left"><!-- Center of the page -->
        	<form name="testform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table width="100%" valign="top" align="left" border="0">
				<tr>
                	<td align="left" width="400"valign="top">
						<div style="padding: 5px; width: 400px" scrollbar="yes">
							<fieldset>
        						<legend><font style='font:normal 14px verdana'><b>Receipt</b></font> </legend>
								<table width="100%" align="left">
									<tr>
										<td width="20%" align="center">
											&nbsp;
										</td>
										<td width="30%" align="center">
											<font style='font:normal 12px verdana'><b>Item</b></font>
										</td>
										<td width="10%" align="center">
											<font style='font:normal 12px verdana'><b>Qty</b></font>
										</td>
										<td width="20%" align="center">
											<font style='font:normal 12px verdana'><b>Price</b></font>
										</td>
										<td width="20%" align="center">
											<font style='font:normal 12px verdana'><b>Amount</b></font>
										</td>
									</tr>
									<tr>
										<td width="20%" align="left">
											<font style='font:normal 10px verdana'>Item:</font> </legend>
										</td>
										<td width="30%" align="left">
											<!--<input type="text" name="description" size="40"/>-->
											   <select name="description" id="description" width="250" STYLE="width: 250px" size="0">
												  <option value="00">--Select--</option>
												  <?php
														/*
													  $orgID = $_SESSION['orgID'];
													  if($privID == 1){
													  	$q=mysql_query("SELECT USER_ID FROM OUTLET_USERS WHERE ORG_ID='{$orgID}'");
													  }
													  else{
													  	$q=mysql_query("SELECT USER_ID FROM OUTLET_USERS WHERE ORG_ID='{$orgID}' AND OUTLET_ID='{$outletID}'");
													  }
													  */
													  $q=mysql_query("SELECT * FROM PRODUCTS");
													  echo mysql_error();

													  while($n=mysql_fetch_assoc($q)){
													  $prodCode = $n[PRODUCT_CODE];
													  $prodName = $n[PRODUCT_NAME];
													  echo "<option value=$prodCode>$prodName</option>";

													  }

												?>
											   </select>
										</td>
										<td width="10%" align="left">
											<!--<input type="text" name="qty" size="10" onchange="calculateSubTotal(this.value);"/>-->
											<input type="text" name="qty" size="5"/>
										</td>
										<td width="20%" align="left">
											<!--<input type="text" name="amount" size="20" onchange="calculateSubTotal(this.value);"/>-->
											<input type="text" name="amount" size="10"/>
										</td>
										<td width="20%" align="left">
											<input type="text" name="subTotal" size="10"/>
										</td>
									</tr>
									<tr>
										<td width="20%" align="left">
											<font style='font:normal 10px verdana'>Discount:</font>
										</td>
										<td width="30%" align="left">
											<!--<input type="text" name="discount" size="10" onmousedown="calculateDiscount();" onmouseup="calculateDiscount();" onkeyup="calculateDiscount();" onchange="calculateDiscount();"/>-->
											<input type="text" name="discount" size="5"/><font style='font:normal 10px verdana'>%</font>
										</td>
										<td width="10%" align="left">
											&nbsp;
										</td>
										<td width="20%" align="left">
											&nbsp;
										</td>
										<td width="20%" align="left">
											<!--<input type="text" name="discountAmount" size="20" onclick="calculateDiscount();"/>-->
											<input type="text" name="discountAmount" size="10"/>
										</td>
									</tr>
									  <?php
										  $q=mysql_query("SELECT * FROM settings WHERE SETTING_ID=1");
										  echo mysql_error();
										  $serviceTax;
										  while($rowTax=mysql_fetch_assoc($q)){
										  $serviceTax = $rowTax[SETTING_VALUE];
										  }

									?>
									<input type="hidden" name="sTax" value="<?php echo $serviceTax;?>"/>
									<tr>
										<td width="20%" align="left">
											<font style='font:normal 10px verdana'>Service Tax:</font>
										</td>
										<td width="40%" align="left">
											<!--<input type="text" name="serviceTax" value="<?php echo $serviceTax;?>" size="10"  onmousedown="calculateServiceTax();" onmouseup="calculateServiceTax();" onkeyup="calculateServiceTax();" onchange="calculateServiceTax();"/>-->
											<input type="text" name="serviceTax" value="<?php echo $serviceTax;?>" size="5"/><font style='font:normal 10px verdana'>%</font>
										</td>
										<td width="20%" align="left">
											&nbsp;
										</td>
										<td width="20%" align="left">
											&nbsp;
										</td>
										<td width="20%" align="left">
											<!--<input type="text" name="serviceTaxAmount" size="20" onclick="calculateServiceTax();"/>-->
											<input type="text" name="serviceTaxAmount" size="10"/>
										</td>
									</tr>
									<tr>
										<td width="20%" align="left">
											<font style='font:normal 10px verdana'>Attended By:</font>
										</td>
										<td width="30%" align="left">
											   <select name="attendedBy">
												  <option value="00">--Select--</option>
												  <?php
														/*
													  $orgID = $_SESSION['orgID'];
													  if($privID == 1){
													  	$q=mysql_query("SELECT USER_ID FROM OUTLET_USERS WHERE ORG_ID='{$orgID}'");
													  }
													  else{
													  	$q=mysql_query("SELECT USER_ID FROM OUTLET_USERS WHERE ORG_ID='{$orgID}' AND OUTLET_ID='{$outletID}'");
													  }
													  echo mysql_error();

													  while($n=mysql_fetch_assoc($q)){
													  $userId = $n[USER_ID];
													  $userName = $n[USER_ID];
													  echo "<option value=$userId>$userName</option>";
													  }
														*/
													  $orgID = $_SESSION['orgID'];
													  $q=mysql_query("SELECT * FROM USERS");
													  echo mysql_error();

													  while($n=mysql_fetch_assoc($q)){
														  $userId = $n[USER_ID];
														  $firstName = $n[FIRST_NAME];
														  $lastName = $n[LAST_NAME];
														  echo "<option value=$userId>". $firstName . " " . $lastName . "</option>";
													  }
												?>
											   </select>
										</td>
										<td width="10%" align="left">
											&nbsp;
										</td>
										<td width="20%" align="right">
											<font style='font:normal 12px verdana'><b>Total:</b></font>
										</td>
										<td width="20%" align="left">
											<input type="text" name="total" size="10"/>
										</td>
									</tr>
									<tr>
										<td class="bottomborder" colspan="5">
											&nbsp;
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right">
											<input type="button" name="add" value="Add" onclick="addToBill();"/>
										</td>
										<td colspan="3" align="left">
											<input type="button" name="calculate" value="Calculate" onclick="calculateTotal();"/>
										</td>
									</tr>
								</table>
							</fieldset>
							</div>
                	</td>
					<td valign="top" align="left">
						<div style="padding: 5px; width: 300px">
							<fieldset>
        						<legend><font style='font:normal 14px verdana'><b>Customer Information</b></font> </legend>
								<table width="100%" align="left">
									<tr>
										<td width="20%" align="right">
											<font style='font:normal 12px verdana'>Name: </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="custName"  size="20"/>
										</td>
										<td width="35%"><div id="loyaltyPoints"></div></td>
									</tr>
									<tr>
										<td width="20%" align="right">
											<font style='font:normal 12px verdana'>Phone: </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="phone" size="20"/>
											<!--<input type="button" name="searchUser" value="Search" onclick="AjaxFunctionSearchPhone();"/>-->
										</td>
										<td width="35%" align="left">
											<!--<input type="button" name="searchUser" value="Search"  onclick="AjaxFunctionSearchPhone();"/>-->
											&nbsp;
										</td>
									</tr>
									<tr>
										<td width="20%" align="right">
											<font style='font:normal 12px verdana'>EMail: <!--<font color="red" size="4"><b>*</b></font>--></font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="email"  size="20"/>
											<!--<input type="button" name="searchUser1" value="Search" onclick="AjaxFunctionSearchEMail();"/>-->
										</td>
										<td width="35%" align="left">
											<!--<input type="button" name="searchUser1" value="Search" onclick="AjaxFunctionSearchEMail();"/>-->
											&nbsp;
										</td>
									</tr>
								</table>
							</fieldset>
							</div>
					</td>
                </tr>
                <tr>
					<td colspan="2" align="center" valign="top" width="100%" border="1">

					</td>
                </tr>
                 <?php
                	//$receiptNumber = "124";

					$query1 = mysql_query( "SELECT MAX(RECEIPT_ID) RECEIPT_NUMBER FROM receipt_totals", $con);
					$row1 = mysql_fetch_assoc($query1);
					$rID = $row1['RECEIPT_NUMBER'];

					$receiptNumber = $rID + 1;

                	$slNo1 = $_POST['slNo1'];
                	$slNo2 = $_POST['slNo2'];
                	$slNo3 = $_POST['slNo3'];



                ?>
                <tr>


                	<td align="left" width="700">
                		<table width="400" border="0">
                			<tr>
                				<td class="bottomborder" align="right" colspan="2">
                					<font style='font:normal 12px verdana;color=blue'><b>Receipt No :</b></font>
                				</td>
                				<td class="bottomborder" colspan="5" align="left">
                					<!--<font style='font:normal 12px verdana;color=blue'><b><?php echo $receiptNumber; ?></b></font>-->
                					<input type="text" name="receiptNumber" value="<?php echo $receiptNumber; ?>" readonly/>
                				</td>
                			</tr>
                			<tr>
                				<td align="center">
                					<font style='font:normal 10px verdana'><b>Sl No</b></font>
                				</td>
                				<td align="center">
                					<font style='font:normal 10px verdana'><b>Item</b></font>
                				</td>
                				<td align="center">
                					<font style='font:normal 10px verdana'><b>Qty</b></font>
                				</td>
                				<td align="center">
                					<font style='font:normal 10px verdana'><b>MRP</b></font>
                				</td>
                				<td align="center">
                					<font style='font:normal 10px verdana'><b>Tax</b></font>
                				</td>
                				<td align="center">
                					<font style='font:normal 10px verdana'><b>Discount</b></font>
                				</td>
                				<td align="center">
                					<font style='font:normal 10px verdana'><b>Payable</b></font>
                				</td>
                			</tr>
                			<tr>
                				<td align="center">
                					<input type="text" name="SlNo1" value="<?php echo $slNo1; ?>" size="3" />
                				</td>
                				<td align="center">
                					<input type="text" name="billProduct1" id="billProduct1" value="" size="25" />
                				</td>
                				<td align="center">
                					<input type="text" name="billQuantity1" value="" size="5" />
                				</td>
                				<td align="center">
                					<input type="text" name="pricePerQuantity1" value="" size="10" />
                				</td>
                				<td align="center">
                					<input type="text" name="tax1" value="" size="10" />
                				</td>
                				<td align="center">
                					<input type="text" name="discount1" value="" size="10" />
                				</td>
                				<td align="center">
                					<input type="text" name="billAmount1" value="" size="15" />
                				</td>
                			</tr>
                			<tr>
                				<td align="center">
                					<input type="text" name="SlNo2" value="<?php echo $slNo2; ?>" size="3" />
                				</td>
                				<td align="center">
                					<input type="text" name="billProduct2" id="billProduct2"  value="" size="25" />
                				</td>
                				<td align="center">
                					<input type="text" name="billQuantity2" value="" size="5" />
                				</td>
                				<td align="center">
                					<input type="text" name="pricePerQuantity2" value="" size="10" />
                				</td>
                				<td align="center">
                					<input type="text" name="tax2" value="" size="10" />
                				</td>
                				<td align="center">
                					<input type="text" name="discount2" value="" size="10" />
                				</td>
                				<td align="center">
                					<input type="text" name="billAmount2" value="" size="15" />
                				</td>
                			</tr>
                			<tr>
                				<td align="center">
                					<input type="text" name="SlNo3" value="<?php echo $slNo3; ?>" size="3"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billProduct3" id="billProduct3"  value="" size="25"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billQuantity3" value="" size="5"/>
                				</td>
                				<td align="center">
                					<input type="text" name="pricePerQuantity3" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="tax3" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="discount3" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billAmount3" value="" size="15"/>
                				</td>
                			</tr>
                			<tr>
                				<td align="center">
                					<input type="text" name="SlNo4" value="" size="3"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billProduct4" id="billProduct4"  value="" size="25"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billQuantity4" value="" size="5"/>
                				</td>
                				<td align="center">
                					<input type="text" name="pricePerQuantity4" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="tax4" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="discount4" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billAmount4" value="" size="15"/>
                				</td>
                			</tr>
                			<tr>
                				<td align="center">
                					<input type="text" name="SlNo5" value="" size="3"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billProduct5" id="billProduct5"  value="" size="25"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billQuantity5" value="" size="5"/>
                				</td>
                				<td align="center">
                					<input type="text" name="pricePerQuantity5" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="tax5" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="discount5" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billAmount5" value="" size="15"/>
                				</td>
                			</tr>
                			<tr>
                				<td align="center">
                					<input type="text" name="SlNo6" value="" size="3"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billProduct6" id="billProduct6"  value="" size="25"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billQuantity6" value="" size="5"/>
                				</td>
                				<td align="center">
                					<input type="text" name="pricePerQuantity6" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="tax6" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="discount6" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billAmount6" value="" size="15"/>
                				</td>
                			</tr>
                			<tr>
                				<td align="center">
                					<input type="text" name="SlNo7" value="" size="3"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billProduct7" id="billProduct7"  value="" size="25"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billQuantity7" value="" size="5"/>
                				</td>
                				<td align="center">
                					<input type="text" name="pricePerQuantity7" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="tax7" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="discount7" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billAmount7" value="" size="15"/>
                				</td>
                			</tr>
                			<tr>
                				<td align="center">
                					<input type="text" name="SlNo8" value="" size="3"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billProduct8" id="billProduct8"  value="" size="25"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billQuantity8" value="" size="5"/>
                				</td>
                				<td align="center">
                					<input type="text" name="pricePerQuantity8" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="tax8" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="discount8" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="billAmount8" value="" size="15"/>
                				</td>
                			</tr>
                			<tr>
                				<td class="bottomtopborder" colspan="2" align="left">
                					<font style='font:normal 11px verdana'><b>TOTAL</b></font>
                				</td>
                				<td align="center">
                					<input type="text" name="totalQty" value="" size="5"/>
                				</td>
                				<td align="center">
                					<input type="text" name="totalMRP" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="totalTax" value="" size="10"/>
                				</td>
                				<td align="center">
                					<input type="text" name="totalDiscount" value="" size="10"/>
                				</td>
                 				<td class="bottomtopborder" align="center">
                					<input type="text" name="totalAmountPayable" value="" size="15"/>
                				</td>
                			</tr>
                		</table>
                	</td>

                	<td width="300">
                		<!--<a href="http://localhost:8081/POSSquare/PhpPrinter/print.php" target="_blank" ><strong>print</strong></a>-->
                		<a href="#" target="_blank" onclick="printReceipt()"><strong>print</strong></a>
                	</td>
                </tr>
                <div id="printable"></div>
                <!--
				<tr>
					<td class="bottomborder" colspan="3">
						&nbsp;
					</td>
				</tr>
				-->

                <tr>
                	<td align="left" colspan="6">
                		<table width="600" border="0">
                			<tr>
                				<td width="40%" align="right">
                					<input type="submit" name="save" value="Save"/>
                				</td>
                				<!-- PRINT: start -->
                				<td width="20%" align="center">
                					<input type="button" name="print" value="Print"/> <!-- onclick="printReceipt();"/>-->
                				</td>
                				<!-- PRINT: stop -->
                				<td width="40%" align="lsft">
                					<input type="button" name="clearFields" value="Clear" /> <!-- onclick="return validateForm();"/>-->
                				</td>
                			</tr>
                		</table>
                	</td>
                </tr>
            </table>
            <input type="hidden" name="slNo1" value="<?php echo $slNo1; ?>"/>
            <input type="hidden" name="slNo2" value="<?php echo $slNo2; ?>"/>
            <input type="hidden" name="slNo3" value="<?php echo $slNo3; ?>"/>
            </form>
        </td>
    </tr>
  </table>
  </body>
</html>

