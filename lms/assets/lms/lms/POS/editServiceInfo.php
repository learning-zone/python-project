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
$serviceID = $_GET['serviceID'];
//print $productID;

if ( isset( $_POST['submit'] ) ) {
	$message = '';

    $error = array();
    array_map( 'stripslashes',$_POST ); //Strips slashes
    array_map( 'mysql_real_escape_string',$_POST ); //Escapes data to protect against sql injection

	$date = date("Y-m-d");

	$serviceID = $_POST['serviceID'];
	$serviceName = $_POST["serviceName"];
	//$productCode = $_POST["PRODUCT_CODE"];
	$amount = $_POST["amount"];

	if(is_null($amount) || $amount == ''){
		$amount = 0;
	}

	if ( count( $error ) == 0 ) { //if there are no errors, then insert into database
		// Check if this customer exists in DB already
		$queryStr = '';

			$updateProductInfoQuery = "UPDATE services
									SET SERVICE_NAME = '{$serviceName}',
									AMOUNT = '{$amount}'
									WHERE SERVICE_ID = '{$serviceID}'";

			//print $updateProductInfoQuery;

			$qry = mysql_query($updateProductInfoQuery, $con);

			$message = 'Saved Successfully';
		}
}

$errmsg = '';
if ( $message != '' ) { //if there are errors, build the error list to be displayed.
    $message1 = '<div><br /><ul>';

        $message1 .= "<li>{$message}</li>";

    $message1 .= '</ul></div>';
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
    <title>Edit Service</title>
    <link href="newStyles.css" rel="stylesheet" type="text/css" />
  </head>
  <body width="100%" >
		<table width="100%" border="0" cellpadding=0 cellspacing=0 valign="top">
		  	<tr height="15">
		  		<td colspan="2" height="15">
		  		<font style='font:normal 14px verdana'><b><?php echo $message1; ?></b></font>
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
		        						<legend><font style='font:normal 14px verdana'><b>Edit Service</b></font> </legend>
											<table width="100%" align="left">
												<!--
												<tr>
													<td colspan="3" align="left">
														<h3><font size='2' face='verdana' color="blue"><u>Create Info</u></font></h3>
													</td>
												</tr>
												-->
											<?php

											$serviceName = '';
											$serviceCode = '';
											$amount = '';

											if(!is_null($serviceID) && $serviceID !== ''){
												$queryStr = "SELECT * FROM services WHERE SERVICE_ID='{$serviceID}'";
												//print $queryStr;

												$query = mysql_query( $queryStr ,$con );

												if ( mysql_num_rows( $query ) > 0 ) {
													$row = mysql_fetch_array($query, MYSQL_ASSOC);

													$serviceName = $row["SERVICE_NAME"];
													$serviceCode = $row["SERVICE_CODE"];
													$amount = $row["AMOUNT"];
												}
											}

											?>
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>Name: <font color="red" size="4"><b>*</b></font></font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="serviceName" value="<?php echo $serviceName; ?>"/>
													</td>
													<td width="45%">&nbsp;</td>
												</tr>
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>Code: </font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="serviceCode" value="<?php echo $serviceCode; ?>" readonly/>
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
				    <input type="hidden" name="serviceID" value="<?php echo $serviceID; ?>" />
		            </form>
		        </td>
		    </tr>
  		</table>
  </body>
</html>

