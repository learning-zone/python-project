
<?php

 //start session so we can login
session_start();
session_destroy();
 session_start();
require('includes/functions.php'); //include functions
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'retailpos';
$con = mysql_connect( $host,$user,$pass ) or die('Unable to connect');
mysql_select_db( $dbname ) or die('Unable to select database');

//$min_form_time = 5; //in seconds
//$max_form_time = 30; //in seconds

$error = array(); //define $error to prevent error later in script.
if ( isset( $_POST['submit'] ) ) 
{
    $error = array();
    array_map( 'stripslashes',$_POST ); //Strips slashes
    array_map( 'mysql_real_escape_string',$_POST ); //Escapes data to protect against sql injection
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $privID = $_POST['privilegeID'];
    $token = $_POST['token'];
        if ( empty( $user ) ) 
		{ //check if username is blank
                $error[] = 'Username is blank';
            }
            elseif ( strlen( $user ) > 30 ) 
			{ //make sure the username is not longer than 30 chars
                $error[] = 'Username is longer than 30 characters';
            }
            if ( empty( $pass ) ) 
			{ //check if password is blank
                $error[] = 'Password is blank';
            }
           //elseif ( !preg_match( "/^.*(?=.{3,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/",$pass ) ) 
		 //  { //check to see if its a valid password
              //  $error[] = 'Password invalid - it must contain at least 1 number, 1 uppercase letter, 1 lowercase letter';
          // }
            if ( count( $error ) == 0 ) 
			{ //if everything is ok so far, keep going (i do this because i dont want to hit the database if the username or password is blank)
            	$user = $_POST['username'];
				echo $pass =md5($pass);
				$sqlStatement = "SELECT USER_NAME, PASSWORD,FIRST_NAME, LAST_NAME, PRIVILEGE_ID FROM USERS WHERE USER_NAME = '{$user}' AND PASSWORD='$pass'";
            	$query = mysql_query( $sqlStatement );	
                if ( mysql_num_rows( $query ) !== 1 ) 
				{ //checks to see if a row was found with username provided by user
                    $error[] = 'Username /or Password incorrect'; //never be specific with errors, makes it hard to crack
                }
                else 
				{
                    while($r1=mysql_fetch_array($query))
					{ //if now errors found, then set session for login
                    	// ********** Declare a global variable for $query and remove this line **********
                    	session_register('user');
						//session_register('privID');
                        $_SESSION['userName'] = $row['FIRST_NAME']. " " . $row['LAST_NAME'];
                        $privID= $r1['PRIVILEGE_ID'];
						session_register('privID');
                       
                        header('Location: generateReceipt.php'); //redirect to <strong class="highlight">secure</strong> area
                        exit; //exit script since we are redirecting anyway
                    }
                }
            }
   
}

$errmsg = '';
if ( count( $error ) > 0 ) { //if there are errors, build the error list to be displayed.
    $errmsg = "<div><font style='font:normal 9px verdana'>Errors: </font><br/>";
    foreach( $error as $err ) { //loop through errors and put then in the list
        $errmsg .= "<font style='font:normal 9px verdana'><li>{$err}</li></font>";
    }
    $errmsg .= '</div>';
}

$token = md5(uniqid(rand(),true));
$_SESSION['token'] = $token;
$_SESSION['time'] = time();

//$html =<<<HTML
?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
-->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Invoice software</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<link href="newStyles.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <?php include "header.php"; ?>
  <table width="100%" valign="top" border="0">
  	<tr>
		<td width="85%" align="center" valign="top">
			&nbsp;
			<!--
			<img src="images/CustomerIntelligence_BB_edit.jpg" height="200" width="730"/>
			<br>
			<font style='font:normal 20px Footlight MT Light; color:#3C74E6'><b>Stay On Top Of Your Customer&#146;s Mind All The Time</b></font>
			-->
		</td>
  		<td width="15%" align="right" valign="top">
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
				<div style="padding: 20px; width: 220px">
					<fieldset>
					<legend><font style='font:normal 14px verdana'><b>MEMBER LOGIN</b></font> </legend>
						<table width="30%" align="center">
							<tr>
								<td colspan="2" align="center">
									<font style="font:normal 9px verdana" color="red"><b><?php echo $errmsg; ?></b></font>
								</td>
							<tr>
								<td align="right">
									<font style="font:normal 11px verdana"> Username:</font>
								</td>
								<td>
									<font style="font:normal 11px verdana"> <input type="text" name="username" /></font>
								</td>
							</tr>
							<tr>
								<td align="right">
									<font style="font:normal 11px verdana"> Password:</font>
								</td>
								<td>
									<input type="password" name="password" />
								</td>
							</tr>
							
							<tr>
								<td colspan="2" align="center">
									<input type="hidden" name="token" value="{$token}" />
									<input type="submit" name="submit" value="Login" />
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">&nbsp;
									
								</td>
							</tr>
						</table>
					</fieldset>
				</div>
			</form>
		</td>
	</tr>
	</table>
	<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
	<p id="legal">Copyright &copy; 2008-2014 ThoughtWiz Solutions. All Rights Reserved.</p>
	<!--<p id="links"><a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>-->
	<?php //echo "Date :" . date("Y-m-d H:i:s.u ", time());
		  //$date = date("Y-m-d H:i:s.u ", time() +45000);
		  //echo "Indian date time : " . $date;
	?>
</div>
</body>
</html>
<?php
//HTML;

//echo $html;

?>

