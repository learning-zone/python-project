<?php



/*
if($_SESSION['userID'] == null)
{
	header('Location: login.php');
}
*/
require('includes/functions.php'); //include functions
require('includes/dbconnect.php'); //include db connection

$error = array(); //define $error to prevent error later in script
$message = '';

$userID = $_SESSION['userID'];
$userFullName = $_SESSION['userName'];
$privID = $_SESSION['privID'];
$productID = $_GET['productID'];
//print $productID;

if ( isset( $_POST['submit'] ) ) {
    $error = array();
    array_map( 'stripslashes',$_POST ); //Strips slashes
    array_map( 'mysql_real_escape_string',$_POST ); //Escapes data to protect against sql injection

	$date = date("Y-m-d");

	$productID = $_POST['productID'];
	$productName = $_POST["productName"];
	//$productCode = $_POST["PRODUCT_CODE"];
	$amount = $_POST["amount"];

	if(is_null($amount) || $amount == ''){
		$amount = 0;
	}

	if ( count( $error ) == 0 ) { //if there are no errors, then insert into database
		// Check if this customer exists in DB already
		$queryStr = '';

			$updateProductInfoQuery = "UPDATE products
									SET PRODUCT_NAME = '{$productName}',
									AMOUNT = '{$amount}'
									WHERE PRODUCT_ID = '{$productID}'";

			//print $updateProductInfoQuery;

			$qry = mysql_query($updateProductInfoQuery, $con);

			$error[] = 'Details updated for existing customer';
		}
}

$errmsg = '';
if ( count( $error ) > 0 ) { //if there are errors, build the error list to be displayed.
    $errmsg = '<div>Errors:<br /><ul>';
    foreach( $error as $err ) { //loop through errors and put then in the list
        $errmsg .= "<li>{$err}</li>";
    }
    $errmsg .= '</ul></div>';
}
?>


<script language="javascript" type="text/javascript">

	function windowClose()
	{
		window.close();
		if (window.opener && !window.opener.closed)
		{
			window.opener.location.reload();
		}
	}

</script>
<html>
  <head>
    <title>Edit Product</title>
    <link href="newStyles.css" rel="stylesheet" type="text/css" />
  </head>
  <body width="100%" >
		<table width="100%" border="0" cellpadding=0 cellspacing=0 valign="top">
		  	<tr height="15">
		  		<td colspan="2" height="15"><?php //include "topMenu.php"; ?> <!--<script SRC="JS/myCRM_Top_Menu.js"></script>-->
		  		</td>
		  	</tr>
			<tr>
		        <td width="100%" height="400" valign="top"><!-- Center of the page -->
		        	<form name="testform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		            <table width="100%">
						<tr>
							<td align="center" valign="top">
								<div style="padding: 10px; width: 700px">
									<fieldset>
		        						<legend><font style='font:normal 14px verdana'><b>Edit Product/Service</b></font> </legend>
											<table width="100%" align="left">
												<!--
												<tr>
													<td colspan="3" align="left">
														<h3><font size='2' face='verdana' color="blue"><u>Create Info</u></font></h3>
													</td>
												</tr>
												-->
											<?php

											$productName = '';
											$productCode = '';
											$amount = '';

											if(!is_null($productID) && $productID !== ''){
												$queryStr = "SELECT * FROM products WHERE PRODUCT_ID='{$productID}'";
												//print $queryStr;

												$query = mysql_query( $queryStr ,$con );

												if ( mysql_num_rows( $query ) > 0 ) {
													$row = mysql_fetch_array($query, MYSQL_ASSOC);

													$productName = $row["PRODUCT_NAME"];
													$productCode = $row["PRODUCT_CODE"];
													$amount = $row["AMOUNT"];
												}
											}

											?>
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>Name: <font color="red" size="4"><b>*</b></font></font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="productName" value="<?php echo $productName; ?>"/>
													</td>
													<td width="45%">&nbsp;</td>
												</tr>
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>Code: </font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="productCode" value="<?php echo $productCode; ?>" readonly/>
														<!--<input type="button" name="searchUser" value="Search"  onclick="AjaxFunctionSearchPhone();"/>-->
													</td>
													<td width="45%" align="left">
														<!--<input type="button" name="searchUser" value="Search"  onclick="AjaxFunctionSearchPhone();"/>-->
														&nbsp;
													</td>
												</tr>
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>Amount: </font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="amount"  value="<?php echo $amount; ?>"/>
														<!--<input type="button" name="searchUser1" value="Search" onclick="AjaxFunctionSearchEMail();"/>-->
													</td>
													<td width="45%" align="left">
														<!--<input type="button" name="searchUser1" value="Search" onclick="AjaxFunctionSearchEMail();"/>-->
														&nbsp;
													</td>
												</tr>
												<tr>
													<td width="20%" align="right">
														&nbsp;
													</td>
													<td width="35%" align="left">
														&nbsp;
													</td>
													<td width="45%" valign="top">
														&nbsp;
													</td>
												</tr>
												<tr>
													<td colspan="2" width="100%" align="center">
														<input type="submit" name="submit" value="Save"/>
													</td>
													<td width="45%"><input type="button" name="close" value="Close" onClick="windowClose();"/></td>
												</tr>
												<tr>
													<td colspan="2" align="center">
														<input type="hidden" name="token" value="{$token}" />
													</td>
													<td width="45%">&nbsp;</td>
												</tr>
											</table>
										</fieldset>
									</div>
							</td>
		                </tr>
		                <tr>
							<td align="center" valign="top" width="100%" border="1">
								&nbsp;
							</td>
		                </tr>
		            </table>
		            <!--<input type="hidden" name="orgID" value="<?php echo $orgID; ?>" />-->
				    <input type="hidden" name="productID" value="<?php echo $productID; ?>" />
		            </form>
		        </td>
		    </tr>
  		</table>
  </body>
</html>

