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
$userID = $_GET['userID'];
//print $productID;

if ( isset( $_POST['submit'] ) ) 
{
    $error = array();
    array_map( 'stripslashes',$_POST ); //Strips slashes
    array_map( 'mysql_real_escape_string',$_POST ); //Escapes data to protect against sql injection

	$date = date("Y-m-d");

	$userID=$_POST['userID'];

	$PASSWORD=md5($_POST["newpassword"]);
	//$productCode = $_POST["PRODUCT_CODE"];
	//$amount = $_POST["amount"];

	//if(is_null($amount) || $amount == ''){
	//	$amount = 0;
	//}

	if ( count( $error ) == 0 ) 
	{ //if there are no errors, then insert into database
		// Check if this customer exists in DB already
		$queryStr = '';

			 $updateProductInfoQuery = "UPDATE USERS
									SET PASSWORD='$PASSWORD'
									WHERE USER_ID = '$userID'";

			//print $updateProductInfoQuery;

			$qry = mysql_query($updateProductInfoQuery);

			$error[] = 'Details updated for existing customer';
		}
		echo "<font color='#0000FF' style='font:normal 14px verdana'><b>Modified successfully</b></font> ";
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
function addToBill()
{
	var mmarks= document.getElementsByName("newpassword")[0].value;
	var oldpassword= document.getElementsByName("password")[0].value;
	if(mmarks!=oldpassword)
	{
		document.getElementsByName("password")[0].value='';
		alert("Both the password not matching ");
	}
}
</script>
<html>
  <head>
    <title>Edit Staff Info</title>
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
								<div style="padding: 10px; width: 300px">
									<fieldset>
		        						<legend><font  style='font:normal 14px verdana'><b>Edit Staff Info</b></font> </legend>
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

											if(!is_null($userID) && $userID !== ''){
												$queryStr = "SELECT * FROM users WHERE USER_ID='{$userID}'";
												//print $queryStr;

												$query = mysql_query( $queryStr ,$con );

												if ( mysql_num_rows( $query ) > 0 ) {
													$row = mysql_fetch_array($query, MYSQL_ASSOC);
													$password=$row["PASSWORD"];
												}
											}

											?>
												
									<tr>
										<td width="30%" align="right" nowrap="nowrap">
											<font style='font:normal 12px verdana'>New Password: </font>										</td>
										<td width="45%" align="left">
											<input type="password" name="newpassword" size="15" value="" />
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right" nowrap="nowrap">
											<font style='font:normal 12px verdana'>Retype Password: </font>
										</td>
										<td width="45%" align="left">
											<input type="password" name="password" size="15" onBlur="addToBill()"/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4" align="right">&nbsp;
											
										</td>
									</tr>
									<tr>
												<!--
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>Amount: </font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="amount"  value="<?php echo $amount; ?>"/>

													</td>
													<td width="45%" align="left">

														&nbsp;
													</td>
												</tr>
												-->
												<tr>
													<td width="20%" align="right">&nbsp;
														
													</td>
													<td width="35%" align="left">&nbsp;
														
													</td>
													<td width="45%" valign="top">&nbsp;
														
													</td>
												</tr>
												<tr>
													<td colspan="3" width="100%" align="center">
														<input type="submit" name="submit" value="Save"/>
													<input type="button" name="close" value="Close" onClick="windowClose();"/></td>
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
							<td align="center" valign="top" width="100%" border="1">&nbsp;
								
							</td>
		                </tr>
		            </table>
		            <!--<input type="hidden" name="orgID" value="<?php echo $orgID; ?>" />-->
				    <input type="hidden" name="userID" value="<?php echo $userID; ?>" />
		            </form>
		        </td>
		    </tr>
  		</table>
  </body>
</html>

