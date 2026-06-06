		<script type="text/javascript">

			function AjaxFindStaffName(productName)
			{
				var httpxml;
				try
				  {
					  // Firefox, Opera 8.0+, Safari
					  httpxml=new XMLHttpRequest();
				  }
				  catch (e)
				  {
			  	     // Internet Explorer
					  try
						{
					 		httpxml=new ActiveXObject("Msxml2.XMLHTTP");
						}
						catch (e)
						{
							try
								{
									httpxml=new ActiveXObject("Microsoft.XMLHTTP");
						 		}
								catch (e)
								{
									alert("Your browser does not support AJAX!");
									return false;
								}
						}
			  	  }
				function stateck()
			    {
			    	if(httpxml.readyState==4)
			      	{

						var myarray=eval(httpxml.responseText);
						//alert(myarray);
						//document.testform["productExists"].value = "";
						document.getElementById('productExists').innerHTML = "";
						for (i=0;i<myarray.length;i++)
						{
								var str = myarray[i];
								//alert(str);
								//document.testform["productExists"].value = str;
								document.getElementById('productExists').innerHTML = "<font style='font:normal 12px verdana; color=red'><b><u> "+ str + "</u></b></font>";

						}
			      	}
			    }
			    //alert(productName);
				//alert(prod_id_ref);
				var url="dd.php";
				url=url+"?productName="+productName;
				url=url+"&findExistence=TRUE";
				url=url+"&sid="+Math.random();
				httpxml.onreadystatechange=stateck;
				httpxml.open("GET",url,true);
				httpxml.send(null);
			}

			function AjaxFindProductCode(productCode)
			{
				var httpxml;
				try
				  {
					  // Firefox, Opera 8.0+, Safari
					  httpxml=new XMLHttpRequest();
				  }
				  catch (e)
				  {
			  	     // Internet Explorer
					  try
						{
					 		httpxml=new ActiveXObject("Msxml2.XMLHTTP");
						}
						catch (e)
						{
							try
								{
									httpxml=new ActiveXObject("Microsoft.XMLHTTP");
						 		}
								catch (e)
								{
									alert("Your browser does not support AJAX!");
									return false;
								}
						}
			  	  }
				function stateck()
			    {
			    	if(httpxml.readyState==4)
			      	{

						var myarray=eval(httpxml.responseText);
						//alert(myarray);
						//document.testform["productExists"].value = "";
						document.getElementById('productCodeExists').innerHTML = "";
						for (i=0;i<myarray.length;i++)
						{
								var str = myarray[i];
								//alert(str);
								//document.testform["productExists"].value = str;
								document.getElementById('productCodeExists').innerHTML = "<font style='font:normal 12px verdana; color=red'><b><u> "+ str + "</u></b></font>";

						}
			      	}
			    }
			    //alert(productCode);
				//alert(prod_id_ref);
				var url="dd.php";
				url=url+"?productCode="+productCode;
				url=url+"&findExistence=TRUE";
				url=url+"&sid="+Math.random();
				httpxml.onreadystatechange=stateck;
				httpxml.open("GET",url,true);
				httpxml.send(null);
			}

		  function AjaxAddStaff()
		  {
			var httpxml;
			try
			  {
				  // Firefox, Opera 8.0+, Safari
				  httpxml=new XMLHttpRequest();
			  }
			  catch (e)
			  {
				 // Internet Explorer
				  try
					{
						httpxml=new ActiveXObject("Msxml2.XMLHTTP");
					}
					catch (e)
					{
						try
							{
								httpxml=new ActiveXObject("Microsoft.XMLHTTP");
							}
							catch (e)
							{
								alert("Your browser does not support AJAX!");
								return false;
							}
					}
		  	  }

			function stateck()
			{

				if(httpxml.readyState==4)
				{
					document.getElementById('addStaffStatus').innerHTML = "";
					var myarray=eval(httpxml.responseText);
					//alert(myarray[0]);
					//document.testform1.level2ProdName.value = "";
					document.getElementById('addStaffStatus').innerHTML = "<font style='font:normal 12px verdana; color=blue'><b><u> "+ myarray[0] + "</u></b></font>";
					document.testform.firstName.value = "";
					document.testform.lastName.value = "";
					//document.testform.amount.value = "";
				}
		    }

			var url="addStaffAjax.php";
			url=url+"?firstName="+document.testform.firstName.value;
			url=url+"&lastName="+document.testform.lastName.value;
			url=url+"&sid="+Math.random();
			httpxml.onreadystatechange=stateck;
			httpxml.open("GET",url,true);
			httpxml.send(null);

		  }

		function check_length(my_form)
		{
			maxLen = 500; // max number of characters allowed
			if (my_form.notes.value.length >= maxLen) {
			// Alert message if maximum limit is reached.
			// If required Alert can be removed.
			var msg = "You have reached your maximum limit of characters allowed";
			//alert(msg);
			// Reached the Maximum length so trim the textarea
			my_form.notes.value = my_form.notes.value.substring(0, maxLen);
			}
			else{ // Maximum length not reached so update the value of my_text counter
			my_form.text_num.value = maxLen - my_form.notes.value.length;}
		}


		function validateForm(){
			//alert("INSIDE");
			var completeErrorMsg = "";
			var errorStr = "";

			var name = document.testform.custName.value;
			var phone = document.testform.phone.value;
			var email = document.testform.email.value;

			if(name != null && name != "")
			{
				//var fullName = document.getElementById("register:orgName").value;
				errorStr = validAlphaNumeric(name, 1, 30, "Name");
				completeErrorMsg = completeErrorMsg + errorStr;
			}
			else
			{
				errorStr = "'Name' cannot be blank \n";
				completeErrorMsg = completeErrorMsg + errorStr;
			}

			// Validation for "PHONE NUMBER"
			if(phone != null && phone != "")
			{
				//var fullName = document.getElementById("register:orgName").value;
				errorStr = checkNumber(phone, "Phone Number");
				completeErrorMsg = completeErrorMsg + errorStr;
			}

			if(email != null && email != "")
			{
				//var fullName = document.getElementById("register:orgName").value;
				errorStr = checkMail(email, "EMail");
				completeErrorMsg = completeErrorMsg + errorStr;
			}

			if((phone == null || phone == "") && (email == null || email == ""))
			{
				errorStr = "Either customer's 'Phone Number' or 'Email' should be entered \n";
				completeErrorMsg = completeErrorMsg + errorStr;
			}

			// Validation for "approxAmount"
			if(approxAmount != null && approxAmount != "")
			{
				//var fullName = document.getElementById("register:orgName").value;
				errorStr = checkNumber(approxAmount, "Approximate Amount");
				completeErrorMsg = completeErrorMsg + errorStr;
			}
			//else
			//{
			//	errorStr = "'Approximate Amount' cannot be blank \n";
			//	completeErrorMsg = completeErrorMsg + errorStr;
			//}

			// Validation for "AGE"
			if(age != null && age != "")
			{
				//var fullName = document.getElementById("register:orgName").value;
				errorStr = checkNumber(age, "Age Of Customer");
				completeErrorMsg = completeErrorMsg + errorStr;
			}


			if(productName != null && productName != "")
			{
				//var fullName = document.getElementById("register:orgName").value;
				errorStr = validAlphaNumeric(productName, 0, 500, "Product Name");
				completeErrorMsg = completeErrorMsg + errorStr;
			}

			if(notes != null && notes != "")
			{
				//var fullName = document.getElementById("register:orgName").value;
				errorStr = validAlphaNumeric(notes, 0, 500, "Notes");
				completeErrorMsg = completeErrorMsg + errorStr;
			}


			if(completeErrorMsg != null && completeErrorMsg != "")
			{
				alert("Please correct the following errors before submitting \n\n" + completeErrorMsg );
				return false;
			}
		}

	   function validAlphaNumeric(str, min, max, fieldName){
			var strCheck = str;
			var strCheckForAlphaNumeric = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890,._ ";
			var blnRet = true;
			var errMsg = "";

			if(strCheck != null && strCheck != "")
			{
					for(i=0; i< strCheck.length && blnRet == true; i++)
					{
							if(strCheckForAlphaNumeric.indexOf(strCheck.charAt(i)) == -1)
							{
									//errMsg = "'" + fieldName + "'" + " cannot have Special Characters(`~!@#$%^&*+=\|[]{}:;) and Double Quotes \n";
									errMsg = "'" + fieldName + "'" + " can have Alphabets, Numbers,  Special Characters (.,_) and Space ONLY \n";
									blnRet = false;
							}
					}
			}
			else if(min == 0 && (strCheck == null || strCheck == ""))
					errMsg = "";
			else if(min != 0 && (strCheck == null || strCheck == ""))
					errMsg = "'" + fieldName + "'" + " cannot be blank \n";

			if(max != 0 && strCheck != null && strCheck != "")
			{
					if(strCheck.length > max)
							errMsg = "'" + fieldName + "'" + " should not be more than " + max +  " characters \n";
			}

			return errMsg;
		}

		function checkMail(str, fieldName){
			var errMsg = "";

			if (str.length >0) {
				 i=str.indexOf("@")
				 j=str.indexOf(".",i)
				 k=str.indexOf(",")
				 kk=str.indexOf(" ")
				 jj=str.lastIndexOf(".")+1
				 len=str.length

				if ((i>0) && (j>(1+1)) && (k==-1) && (kk==-1) && (len-jj >=2) && (len-jj<=3)) {
				}
				else {
					//alert("Please enter an exact email address.\n" +
					//document.register.fieldname.value + " is invalid.");
					//return false;
					errMsg = "'" + fieldName + "'" + " is incorrect \n";
				}
			 }


			 return errMsg;
		}

		function checkSpecialChars(){

			var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?";

			  for (var i = 0; i < document.formname.fieldname.value.length; i++) {
				if (iChars.indexOf(document.formname.fieldname.value.charAt(i)) != -1) {
					alert ("Your username has special characters. \nThese are not allowed.\n Please remove them and try again.");
					return false;
				}
			  }
		}

		function checkNumber(str, fieldName){
			 var errMsg = "";
			//alert on finding all numbers
			var nonums = /^[0-9]*$/;
			if (nonums.test(str)) {
			     //alert("Please enter at least one letter in the \"username\" field.");
			     //return false;
			      errMsg = "";
			}
			else{
					 errMsg = "'" + fieldName + "'" + " should have only numbers (0-9) \n";
			}

			return  errMsg;

		}

		function ShowDiv(divid)
		{
		   if (document.layers) document.layers[divid].visibility="show";
		   else document.getElementById(divid).style.visibility="visible";
		}

		function HideDiv(divid)
		{
		   if (document.layers) document.layers[divid].visibility="hide";
		   else document.getElementById(divid).style.visibility="hidden";
		}

		function BodyLoad()
		{
			HideDiv("autocomplete");

			document.testform.custName.focus();

		}

			//if (this.name!='fullscreen'){
			//	window.open(location.href,'fullscreen','fullscreen,scrollbars')
			//}


    </script>

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
          	<td width="10%" height="300" border="0" valign="top"><!-- Left hand navigation bar-->
				&nbsp;
        	</td>
			<td width="80%" height="300" valign="top">
				<div>
					<fieldset width="800">
						<legend align="center"><font style='font:normal 14px verdana'><b>Add Staff Member</b></font> </legend>
						    <font size='1' face='verdana' color='red'><u><?php echo $errmsg; ?></u></font>
						    <!--<div align="right">-->
						        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
									<table width="100%" height="300" align="left" border="0">
										<tr>
											<td colspan="2" align="center">
												<div id="addStaffStatus"></div>
											</td>
										</tr>
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 10px verdana'>First Name :</font>
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
												<font style='font:normal 10px verdana'>Last Name : </font>
											</td>
											<td width="60%" align="left">
												<input type="text" name="lastName" />
											</td>
										</tr>
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 10px verdana'>Privilege ID : </font>
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
												<font style='font:normal 12px verdana'><b>Create Login Credentials</b></font>
											</td>
										</tr>
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 10px verdana'>User ID : </font>
											</td>
											<td width="60%" align="left">
												<input type="text" name="username" />
											</td>
										</tr>
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 10px verdana'>Password : </font>
											</td>
											<td width="60%" align="left">
												<input type="password" name="password" />
											</td>
										</tr>
										<tr>
											<td width="40%" align="right">
												<font style='font:normal 10px verdana'>Confirm Password :</font>
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
						            			<input type="submit" name="submit" value="Create" onclick="AjaxAddStaff()"/>
											</td>

										</tr>
									</table>
						        </form>
					  	</fieldset>
					</div>
    				<div align="center"><font size='2' face='verdana' color="blue"><u><?php echo $message; ?></u></font></div>
				</td>
				<td width="10%" height="400" border="1" valign="top"><!-- Left hand navigation bar-->
					&nbsp;
        		</td>
			</tr>
		</table>
		<table width="100%" align="center">
      		<tr>
				<td align="center" valign="top">
					<div id="productList" style="padding: 10px; width: 900px" scrollbar="yes">
						<fieldset>
							<legend><font style='font:normal 14px verdana'><b>Staff</b></font> </legend>
							<table width="100%" align="left">
								<tr bgcolor="#3C74E6">
									<td width="20%" align="left">
										<font style='font:normal 12px verdana; color:#FFFFFF'><b>ID</b></font>
									</td>
									<td width="60%" align="left">
										<font style='font:normal 12px verdana; color:#FFFFFF'><b>Name</b></font>
									</td>
								</tr>
							  <?php

								  //$orgID = $_SESSION['orgID'];

								  $q=mysql_query("SELECT * FROM users ORDER BY FIRST_NAME ASC");

								  echo mysql_error();
								  $i = 1;
								  while($n=mysql_fetch_assoc($q)){
									  $firstName = $n[FIRST_NAME];
									  $lastName = $n[LAST_NAME];
									  $ID = $n[USER_ID];
									  //$prodQuantity = $n[QUANTITY];
									$i++;
										$bcolor = '#FFFFFF';
										if($i%2 == 0){
											$bcolor = '#C3D9FF';
										}
								  ?>
									<tr bgcolor='<?php echo $bcolor; ?>'>
										<td width="20%" align="left">
											<font style='font:normal 12px verdana'><?php echo $ID; ?></font>
										</td>
										<td width="60%" align="left">
											<font style='font:normal 12px verdana'><?php echo $firstName. ' ' .$lastName; ?></font>
										</td>
										<!--
										<td width="60%" align="left">
											<font style='font:normal 12px verdana'><?php echo $prodAmount; ?></font>
										</td>
										<td width="60%" align="left">
											<font style='font:normal 12px verdana'><?php echo $prodQuantity; ?></font>
										</td>
										-->
									</tr>

								  <?php
								  }

								?>

							</table>
						</fieldset>
						</div>
				</td>
			</tr>
		</table>
</body>
</html>
<?php
//HTML;

//echo $html;

?>