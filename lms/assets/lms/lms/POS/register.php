<?php



require('includes/functions.php'); //include functions
require('includes/dbconnect.php'); //include db connection

//$min_form_time = 5; //in seconds
//$max_form_time = 30; //in seconds
/*
if($_SESSION['step1'] !== 'done'){
	header('Location: wrongRegistrationPage.php');
}
*/
$error = array(); //define $error to prevent error later in script
$message = '';
if ( isset( $_POST['submit'] ) ) {
    $error = array();
    array_map( 'stripslashes',$_POST ); //Strips slashes
    array_map( 'mysql_real_escape_string',$_POST ); //Escapes data to protect against sql injection
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $confirmPass = $_POST['confirmPassword'];
    $firstName = $_POST['firstName'];
    //$middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $privID = $_POST['privilegeID'];
	//$orgID = $_SESSION['orgID'];

    $token = $_POST['token'];
    //if ( $token !== $_SESSION['token'] ) {
    //    $error[] = 'Token is invalid';
    //}
    //else {
            if ( empty( $user ) ) { //check if username is blank
                $error[] = 'Username is blank';
            }
            elseif ( strlen( $user ) > 30 ) { //make sure the username is not longer than 30 chars
                $error[] = 'Username cannot be longer than 30 characters';
            }
            else { //if there aren't any errors with $user at this point, check to make sure no one else has the same username
                //$query = mysql_query( "SELECT * FROM ORG_USERS WHERE SUPER_ADMIN_ID = '{$user}' AND ORG_ID= '$orgID' ",$con );
                $query = mysql_query( "SELECT * FROM users WHERE USER_NAME = '{$user}' ",$con );
                if ( mysql_num_rows( $query ) > 0 ) {
                    $error[] = 'Username already exists';
                }
            }
            if ( empty( $pass ) ) { //check if password is blank
                $error[] = 'Password is blank';
            }
            //elseif ( strlen( $pass ) < 9 ) { //make sure password is longer than 8 characters
            //    $error[] = 'Password must be longer than 8 characters';
            //}
            elseif ( !preg_match( "/^.*(?=.{3,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/",$pass ) ) { //check to see if its a valid password
                $error[] = 'Password invalid - it must contain at least 1 number, 1 uppercase letter, 1 lowercase letter';
            }
    		elseif ($pass !== $confirmPass){ //check to see if password AND CONFIRM PASSWORD ARE MATCHING
                $error[] = 'Password and Confirm Password must be same';
            }
            if ( count( $error ) == 0 ) { //if there are no errors, then insert into database
                $pass = encryptPassword( $pass ); //hash password before inserting into database
                $query = mysql_query( "INSERT INTO users(USER_NAME,PASSWORD, FIRST_NAME, LAST_NAME, PRIVILEGE_ID) VALUES ('{$user}','{$pass}','{$firstName}' ,'{$lastName}' ,'{$privID}')",$con );
                //echo 'SQL query error is : ' . mysql_error();
                $message = 'User registration successful!';
                $_SESSION['step2'] = 'done';
                header('Location: register3.php');
    			exit;
            }
        //}
   // }
}

$errmsg = '';
if ( count( $error ) > 0 ) { //if there are errors, build the error list to be displayed.
    $errmsg = '<div>Errors:<br /><ul>';
    foreach( $error as $err ) { //loop through errors and put then in the list
        $errmsg .= "<li>{$err}</li>";
    }
    $errmsg .= '</ul></div>';
}

$token = md5(uniqid(rand(),true));
$_SESSION['token'] = $token;
$_SESSION['time'] = time();

//$html =<<<HTML
?>
<html>
<head>
<title>Registration</title>
<link href="newStyles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<table width="100%" border="0" cellpadding=0 cellspacing=0>
  	<tr height="15">
  		<td colspan="3" height="15">
  		&nbsp;
  		<!--<script SRC="JS/myCRM_Top_Menu.js">
  		</script>-->
  		</td>
  	</tr>
		<tr>
          	<td width="20%" height="300" border="0" valign="top"><!-- Left hand navigation bar-->
				&nbsp;
        	</td>
			<td width="50%" height="300" valign="top">
				<div>
					<fieldset width="600">
						<legend align="center"><font style='font:normal 14px verdana'><b>Create User</b></font> </legend>
						    <font size='1' face='verdana' color='red'><u><?php echo $errmsg; ?></u></font>
						    <!--<div align="right">-->
						        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
									<table width="100%" height="300" align="left" border="0">
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 12px verdana'>First Name :</font>
											</td>
											<td width="60%" align="left">
												<input type="text" name="firstName" />
											</td>
										</tr>
										<!--
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 12px verdana'>Middle Name : </font>
											</td>
											<td width="60%" align="left">
												<input type="text" name="middleName" />
											</td>
										</tr>
										-->
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 12px verdana'>Last Name : </font>
											</td>
											<td width="60%" align="left">
												<input type="text" name="lastName" />
											</td>
										</tr>
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 12px verdana'>Privilege ID : </font>
											</td>
											<td width="60%" align="left">
												<select name="privilegeID" id="privilegeID">
													<option value="00">--Select--</option>
													<option value="01">Admin</option>
													<option value="02">User</option>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="2" align="center">
												&nbsp;
											</td>
										</tr>
										<tr>
											<td class="bottomtopborder" colspan="2" align="center">
												<font style='font:normal 14px verdana'><b>Create Admin Login Credentials</b></font>
											</td>

										</tr>
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 12px verdana'>User ID : </font>
											</td>
											<td width="60%" align="left">
												<input type="text" name="username" />
											</td>
										</tr>
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 12px verdana'>Password : </font>
											</td>
											<td width="60%" align="left">
												<input type="password" name="password" />
											</td>
										</tr>
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 12px verdana'>Confirm Password :</font>
											</td>
											<td width="60%" align="left">
												<input type="password" name="confirmPassword" />
											</td>
										</tr>
										<tr>
											<td colspan="2" align="center">
												&nbsp;
											</td>
										</tr>
										<tr>
											<td colspan="2" align="center">
												<input type="hidden" name="token" value="{$token}" />
						            			<input type="submit" name="submit" value="Create" />
											</td>

										</tr>
									</table>
						        </form>
					  	</fieldset>
					</div>
    				<div align="center"><font size='2' face='verdana' color="blue"><u><?php echo $message; ?></u></font></div>
				</td>
				<td width="30%" height="400" border="1" valign="top"><!-- Left hand navigation bar-->
					&nbsp;
        		</td>
			</tr>
		</table>
</body>
</html>
<?php
//HTML;

//echo $html;

?>