<?php
require('../db.php'); //include db connection

if ( isset( $_POST['submit'] ) ) {
    $error = array();
    array_map( 'stripslashes',$_POST ); //Strips slashes
    array_map( 'mysql_real_escape_string',$_POST ); //Escapes data to protect against sql injection

	//$date = date("Y-m-d");

	$serviceTax = $_POST['serviceTax'];

	if(is_null($serviceTax) || $serviceTax == ''){
		$serviceTax = 0;
	}

	if ( count( $error ) == 0 ) { //if there are no errors, then insert into database
		// Check if this customer exists in DB already
		$queryStr = '';
			if(!is_null($serviceTax) && $serviceTax !== '' && $serviceTax !== 0)
			{
				$updateProductInfoQuery = "UPDATE settings
										SET SETTING_VALUE = '{$serviceTax}'
										WHERE SETTING_ID = 1";

				//print $updateProductInfoQuery;

				$qry = mysql_query($updateProductInfoQuery, $con);
			}
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
<html>
  <head>
    <title>Settings</title>
  </head>
  <body>
<br>
						<form name="sendMsg" method="post" action="">
									<table width="50%" align="center"  cellpadding="10" cellspacing="5">
										<?php

											$serviceTax = '';

											$queryStr = "SELECT * FROM settings";
											//print $queryStr;

											$query = mysql_query( $queryStr ,$con );

											if ( mysql_num_rows( $query ) > 0 ) {
												$row = mysql_fetch_array($query, MYSQL_ASSOC);

												$settingID = $row["SETTING_ID"];
												if($settingID == 1){
													$serviceTax = $row["SETTING_VALUE"];
												}
											}

										?>
										<tr>
											<td class="head" colspan="2" align="center">
												Service Tax
											</td>
										</tr>
                            			<tr>
											<td width="40%" align="right">
												Service Tax: 
											</td>
											<td width="60%"  align="left">
												<input type="text" name="serviceTax" value="<?php echo $serviceTax; ?>" />
											</td>
										</tr>
									
									</table><br>
										<div  align="center">
												<input type="submit" name="submit" value="Save" class="bgbutton"/>
											</div>
						</form>
  </body>
</html>
