<?php
include('ps_pagination.php');
require('includes/functions.php'); 
require('includes/dbconnect.php'); 
$error = array(); 
$message = '';

$errmsg = '';
if ( count( $error ) > 0 ) { 
    $errmsg = '<div>Errors:<br /><ul>';
    foreach( $error as $err ) { 
        $errmsg .= "<li>{$err}</li>";
    }
    $errmsg .= '</ul></div>';
}
?>

<html>
  <head>
    <title>Add Staff Members</title>
		<script type="text/javascript">
		function confirmSubmit(e)
	{
	var agree=confirm("Do you want to delete this user");
	if (agree){
	
		window.testform.action="addStaff.php?tempid="+e;
		document.testform.submit();
	}
	else
		return true;
	}

			function AjaxFindStaffName(productName)
			{
				var httpxml;
				try
				  {
					 
					  httpxml=new XMLHttpRequest();
				  }
				  catch (e)
				  {
			  	     
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
						
						document.getElementById('productExists').innerHTML = "";
						for (i=0;i<myarray.length;i++)
						{
								var str = myarray[i];
								
								document.getElementById('productExists').innerHTML = "<font style='font:normal 12px verdana; color=red'><b><u> "+ str + "</u></b></font>";

						}
			      	}
			    }
			   
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
					 
					  httpxml=new XMLHttpRequest();
				  }
				  catch (e)
				  {
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
						
						document.getElementById('productCodeExists').innerHTML = "";
						for (i=0;i<myarray.length;i++)
						{
								var str = myarray[i];
								
								document.getElementById('productCodeExists').innerHTML = "<font style='font:normal 12px verdana; color=red'><b><u> "+ str + "</u></b></font>";

						}
			      	}
			    }
			   
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
				  httpxml=new XMLHttpRequest();
			  }
			  catch (e)
			  {
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
					
					document.getElementById('addStaffStatus').innerHTML = "<font style='font:normal 12px verdana; color=blue'><b><u> "+ myarray[0] + "</u></b></font>";
					document.testform.firstName.value = "";
					document.testform.lastName.value = "";
					
				}
		    }

			var url="addStaffAjax.php";
			url=url+"?firstName="+document.testform.firstName.value;
			url=url+"&lastName="+document.testform.lastName.value;
			url=url+"&phone="+document.testform.phone.value;
			url=url+"&email="+document.testform.email.value;
			url=url+"&address="+document.testform.address.value;
			url=url+"&age="+document.testform.age.value;
			url=url+"&sex="+document.testform.sex.value;
			url=url+"&sid="+Math.random();
			httpxml.onreadystatechange=stateck;
			httpxml.open("GET",url,true);
			httpxml.send(null);

		  }

		function check_length(my_form)
		{
			maxLen = 500; 
			if (my_form.notes.value.length >= maxLen) {
			
			var msg = "You have reached your maximum limit of characters allowed";
			
			my_form.notes.value = my_form.notes.value.substring(0, maxLen);
			}
			else{ 
			my_form.text_num.value = maxLen - my_form.notes.value.length;}
		}


		function validateForm(){
			
			var completeErrorMsg = "";
			var errorStr = "";

			var name = document.testform.custName.value;
			var phone = document.testform.phone.value;
			var email = document.testform.email.value;

			if(name != null && name != "")
			{
				
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
	 if($_REQUEST[tempid])
	 {
	mysql_query("DELETE FROM users WHERE USER_ID='$_REQUEST[tempid]'");
	 }
	 ?>
    <link href="newStyles.css" rel="stylesheet" type="text/css" />
  </head>
  <body onLoad="BodyLoad();" width="100%" >
<?php //include "validUserHeader.php"; ?>
<table width="100%" border="0" cellpadding=0 cellspacing=0>
  	<tr>
  		<td class="bottomborder" colspan="2" height="22" valign="top">
  		<?php include "topMenu.php"; ?> <!--<script SRC="JS/myCRM_Top_Menu.js"></script>-->
  		</td>
  	</tr>
	<tr>
		<td width="10%" height="400" border="1" valign="top"><!-- Left hand navigation bar-->
			<!--<?php include "leftNavigation.php"; ?>-->&nbsp;
		</td>
        <td width="90%" height="400" valign="top" align="left"><!-- Center of the page -->
		<?php
		if($_POST[add])
		{
			$enpass=md5($_POST[password]);
			$insertQuery = mysql_query("INSERT INTO users(FIRST_NAME, LAST_NAME, PHONE, EMAIL, ADDRESS,USER_NAME,PASSWORD,PRIVILEGE_ID,AGE,SEX) VALUES('$_POST[firstName]','$_POST[lastName]','$_POST[phone]','$_POST[email]','$_POST[address]','$_POST[username]','$enpass','$_POST[usertype]','$_POST[age]','$_POST[sex]')");
			
		}
		
		
		?>
        	<form name="testform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table width="100%" valign="top" align="left">
                <tr>
					<td valign="top" align="left">&nbsp;
						
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
						<div style="padding: 10px; width: 700px">
							<fieldset>
        						<legend><font style='font:normal 14px verdana'><b>Add Staff</b></font> </legend>
								<table width="100%" align="left">
									<tr>
										<td colspan="4" align="center">
											<div id="addStaffStatus"></div>
										</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'><b>First Name:</b> </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="firstName"  size="20"/>
										</td>
										<td width="25%"><div id="staffExists"></div></td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'><b>Last Name:</b> </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="lastName" size="20"/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'><b>Phone:</b> </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="phone" size="15"/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'><b>Email:</b> </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="email" size="20"/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'><b>Address: </b></font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="address" size="40"/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'><b>Age: </b></font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="age" size='2'/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'><b>Gender: </b></font>
										</td>
										<td width="45%" align="left">
										<font style='font:normal 11px verdana'>Male<input name="sex" type="radio" value="1" checked="checked">
											&nbsp;&nbsp;Female</font>
										<input name="sex" type="radio" value="2">
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3" align="right">&nbsp;
											
										</td>
									</tr>
									<tr>
										<td class="topborder" colspan="3" align="right">&nbsp;
											
										</td>
									</tr>																		
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'><b>User Type: </b></font>
										</td>
										<td width="45%" align="left">
											<font style='font:normal 11px verdana'>User
											<input name="usertype" type="radio" value="2" checked="checked"/>&nbsp;&nbsp;
											Admin<input name="usertype" type="radio" value="1"/>
											</font>
								        </td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'><b>User Name: </b></font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="username" size="15"/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'><b>Password: </b></font>
										</td>
										<td width="45%" align="left">
											<input type="password" name="password" size="15"/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4" align="right">&nbsp;
											
										</td>
									</tr>
									<tr>
										<td colspan="4" align="center">
											<!--<input type="button" name="add" value="Add" onClick="AjaxAddStaff()"/>-->
											<input type="Submit" name="add" value="Add" />
										</td>
									</tr>
								</table>
							</fieldset>
					  </div>
					</td>
                </tr>
                <tr>
					<td align="center" valign="top" width="100%" border="1">

					</td>
                </tr>
				<?php
						$error = array();
						// GET 'PRODUCT ID'

								$queryStatement = "SELECT * FROM USERS ORDER BY FIRST_NAME ASC";

								//print $queryStatement;

								/**----------------------------------------------------
								Pagination Implementation
								---------------------------------------------------- **/
								$paramValues = "status=".$status;
								$pager = new PS_Pagination($con, $queryStatement, 25, 5, $paramValues);
								$pager->setDebug(true);

								$searchProductQuery = $pager->paginate();
								if($searchProductQuery){
								//print "abc";
								?>
								</form>
                <tr>
                	<td align="left" valign="top">
		  <form name="sendMsg" method="post" action="">
										<div>
											<fieldset>
											<legend><font style='font:normal 14px verdana'><b>Staff</b></font> </legend>
												<table class="boxtable" width="100%" border="0">
													<tr bgcolor="#3C74E6">
														<td width="5%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>ID</b></font>
														</td>
														<td width="20%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>NAME</b></font>
														</td>
														<td width="10%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>USER TYPE</b></font>
														</td>														
														<td width="10%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>PHONE</b></font>
														</td>
														<td width="15%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>EMAIL</b></font>
														</td>
														<td width="25%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>ADDRESS</b></font>
														</td>
														<!--
														<td width="15%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>Amount</b></font>
														</td>
														-->
														<td width="10%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>Edit/Delete</b></font>
														</td>

													</tr>
														<?php
															$i = 1;
															while ($row = mysql_fetch_array($searchProductQuery, MYSQL_ASSOC)) {
																$i++;
																$bcolor = '#FFFFFF';
																$userType = "";
																if($i%2 == 0){
																	$bcolor = '#C3D9FF';
																}
																print "<tr bgcolor=".$bcolor.">";
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["USER_ID"] ."</font></td> \n";
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["FIRST_NAME"] .' ' .$row["LAST_NAME"].  "</font></td>\n";
																if($row["PRIVILEGE_ID"] == 1){
																	$userType = "User";
																}
																elseif($row["PRIVILEGE_ID"] == 2){
																	$userType = "Admin";
																}
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$userType.  "</font></td>\n";
																
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["PHONE"] . "</font></td> \n";
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["EMAIL"] . "</font></td> \n";
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["ADDRESS"] . "</font></td> \n";
														?>
																<td>
																	<a href="javascript:void(0)" onClick="window.open('editStaffInfo.php?userID=<?php echo $row['USER_ID']; ?>','editstaff', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><font style='font:normal 9px verdana'>&nbsp;<b>EDIT</b></font></a>
																	&nbsp;/&nbsp;
																	<a href='#' onClick="return confirmSubmit(<?php echo $row['USER_ID']; ?>)"><font style='font:normal 9px verdana'><b> DELETE </b></font></a>
																	<a href="javascript:void(0)" onClick="window.open('changepass.php?userID=<?php echo $row['USER_ID']; ?>','editstaff', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><font style='font:normal 9px verdana'>&nbsp;<b>CHANGE PASSWORD</b></font></a>
																</td>
														<?php
																print "</tr>";
															}
															mysql_free_result($searchProductQuery);
														?>
													<tr>
															<td colspan="8" width="100%">&nbsp;
																
															</td>
													</tr>
												
													</tr>
													<tr>
														<td colspan="8" width="100%">&nbsp;
															
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
	<?php
	}
	?>
  </body>
</html>

