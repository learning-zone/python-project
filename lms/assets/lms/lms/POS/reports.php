<?php
require('includes/functions.php'); //include functions
require('includes/dbconnect.php'); //include db connection

error_reporting (E_ALL ^ E_NOTICE);
if($_SESSION[privID]==2)
die("<font color='#FF0000' size='+2'><b>User don’t have access to generate reports</b></font>");
/*
if($_SESSION['userID'] == null)
{
	header('Location: login.php');
}
*/




$userID = $_SESSION['userID'];
$userFullName = $_SESSION['userName'];
$privID = $_SESSION['privID'];

if ( isset( $_POST['submit'] ) ) {
    $error = array();
    array_map( 'stripslashes',$_POST ); //Strips slashes
    array_map( 'mysql_real_escape_string',$_POST ); //Escapes data to protect against sql injection

	//$date = date("Y-m-d");
/*
	$serviceTax = $_POST['serviceTax'];

	if(is_null($serviceTax) || $serviceTax == ''){
		$serviceTax = 0;
	}

	if ( count( $error ) == 0 ) { //if there are no errors, then insert into database
		// Check if this customer exists in DB already
		$queryStr = '';
			if(!is_null($serviceTax) && $serviceTax !== '' && $serviceTax !== 0)
			{
				$updateProductInfoQuery = "UPDATE SETTINGS
										SET SETTING_VALUE = '{$serviceTax}'
										WHERE SETTING_ID = 1";

				//print $updateProductInfoQuery;

				$qry = mysql_query($updateProductInfoQuery, $con);
			}
			$error[] = 'Details updated for existing customer';
		}

		*/
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
<html>
  <head>
    <title>Reports</title>
    <link href="newStyles.css" rel="stylesheet" type="text/css" />
  </head>
  <body>

<?php //include "validUserHeader.php"; ?>
<table width="100%" border="0" cellpadding=0 cellspacing=0>
  	<tr>
  		<td class="bottomborder" colspan="2" height="22" valign="top">
  		<?php include "topMenu.php"; ?> <!--<script SRC="JS/myCRM_Top_Menu.js"></script>-->
  		</td>
  	</tr>
    <tr>
        <td width="10%" height="400" border="1" valign="top"><!-- Left hand navigation bar-->
  			<?php //include "leftNavigation.php"; ?>
  			<!--<script SRC="JS/leftNavigation.js"></script>-->
        </td>
        <td width="90%" height="400" valign="top"><!-- Center of the page -->
			<table width="100%" align="left" valign="top">
				<tr>
							<td valign="top" align="left">&nbsp;
								
							</td>
				</tr>
				<tr>
					<td align="left">&nbsp;
						
					</td>
				</tr>
				<tr>
					<td>
						<form name="sendMsg" method="post" action="">
							<div>
								<fieldset>
									<legend><font style='font:normal 14px verdana'><b>Reports</b></font> </legend>
									<table width="100%" align="center" valign="top" cellpadding="10" cellspacing="5">
										<tr>
											<td align="left">&nbsp;
												
											</td>
										</tr>
										<tr>
											<td align="left">
												<font style='font:normal 12px verdana'> <img src="images/big_30.gif"> <a href="productInventoryReport.php">Product Inventory Report</a></font>
											</td>
										</tr>
										<tr>
											<td align="left">
												<font style='font:normal 12px verdana'> <img src="images/big_30.gif"> <a href="serviceInventoryReport.php">Services Report</a></font>
											</td>
										</tr>
										<tr>
											<td align="left">
												<font style='font:normal 12px verdana'> <img src="images/big_30.gif"> <a href="billingReport.php">Billing/Receipts Report</a></font>
											</td>
										</tr>
										<tr>
											<td align="left">
												<font style='font:normal 12px verdana'> <img src="images/big_30.gif"> <a href="empdaywisereport.php">User/Staff Reports</a></font>
											</td>
										</tr>
									</table>
								</fieldset>
							</div>
						</form>
					</td>
				</tr>
			</table>
        </td>
    </tr>
  </table>
  </body>
</html>
