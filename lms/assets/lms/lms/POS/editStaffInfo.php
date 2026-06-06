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

if ( isset( $_POST['submit'] ) ) {
    $error = array();
    array_map( 'stripslashes',$_POST ); //Strips slashes
    array_map( 'mysql_real_escape_string',$_POST ); //Escapes data to protect against sql injection

	$date = date("Y-m-d");

	$userID=$_POST['userID'];
	$firstName=$_POST["firstName"];
	$lastName=$_POST["lastName"];
	$phone=$_POST["phone"];
	$email=$_POST["email"];
	$address=$_POST["address"];
	$PRIVILEGE_ID=$_POST["usertype"];
	$SEX=$_POST["sex"];
	$AGE=$_POST["age"];
	
	//$productCode = $_POST["PRODUCT_CODE"];
	//$amount = $_POST["amount"];

	//if(is_null($amount) || $amount == ''){
	//	$amount = 0;
	//}

	if ( count( $error ) == 0 ) { //if there are no errors, then insert into database
		// Check if this customer exists in DB already
		$queryStr = '';

			$updateProductInfoQuery = "UPDATE users
									SET FIRST_NAME = '{$firstName}',
									LAST_NAME = '{$lastName}',
									PHONE = '{$phone}',
									EMAIL = '{$email}',
									ADDRESS = '{$address}',
									PRIVILEGE_ID='$PRIVILEGE_ID',
									SEX='$SEX',
									AGE='$AGE'
									WHERE USER_ID = '$userID'";

			//print $updateProductInfoQuery;

			$qry = mysql_query($updateProductInfoQuery);

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
								<div style="padding: 10px; width: 700px">
									<fieldset>
		        						<legend><font style='font:normal 14px verdana'><b>Edit Staff Info</b></font> </legend>
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
												$queryStr = "SELECT * FROM USERS WHERE USER_ID='{$userID}'";
												//print $queryStr;

												$query = mysql_query( $queryStr ,$con );

												if ( mysql_num_rows( $query ) > 0 ) {
													$row = mysql_fetch_array($query, MYSQL_ASSOC);

													$firstName = $row["FIRST_NAME"];
													$lastName = $row["LAST_NAME"];
													$phone = $row["PHONE"];
													$email = $row["EMAIL"];
													$address = $row["ADDRESS"];
													$username=$row["USER_NAME"];
													$usertype=$row["PRIVILEGE_ID"];
													$sex=$row["SEX"];
													$age=$row["AGE"];
													//$amount = $row["AMOUNT"];
												}
											}

											?>
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>First Name: </font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="firstName" value="<?php echo $firstName; ?>"/>
													</td>
													<td width="45%">&nbsp;</td>
												</tr>
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>Last Name: </font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="lastName" value="<?php echo $lastName; ?>"/>
													</td>
													<td width="45%" align="left">&nbsp;
														
													</td>
												</tr>
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>Phone: </font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="phone" value="<?php echo $phone; ?>"/>
													</td>
													<td width="45%" align="left">&nbsp;
														
													</td>
												</tr>
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>Email: </font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="email" value="<?php echo $email; ?>"/>
													</td>
													<td width="45%" align="left">&nbsp;
														
													</td>
												</tr>
												<tr>
													<td width="20%" align="right">
														<font size='1' face='verdana'>Address: </font>
													</td>
													<td width="35%" align="left">
														<input type="text" name="address" value="<?php echo $address; ?>"/>
													</td>
													<td width="45%" align="left">&nbsp;
														
													</td>
												</tr><tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'>AGE: </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="age" size='2' value="<?php echo $age; ?>"/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'>Sex: </font>
										</td>
										<td width="45%" align="left">
										<?php
										if($sex=='1')
										{
											$checked="checked";
										}
										else
										{
											$checked1="checked";
										}
										?>
										Male<input name="sex" type="radio" value="1" <?php echo $checked; ?>>&nbsp;&nbsp;Female
										<input name="sex" type="radio" value="2" <?php echo $checked1; ?>>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'>User Type: </font>
											<?php
										if($usertype=='1')
										{
											$checked3="checked";
										}
										else
										{
											$checked4="checked";
										}
										?>
										</td>
										<td width="45%" align="left">
										User
										<input name="usertype" type="radio" value="2" <?php echo $checked4; ?>/>&nbsp;&nbsp;
										Admin<input name="usertype" type="radio" value="1" <?php echo $checked3; ?>/>
											      							   
								        </td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'>User Name: </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="username" readonly size="15" value=" <?php echo $username; ?>"/>
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

