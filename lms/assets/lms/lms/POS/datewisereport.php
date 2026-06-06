<?php


error_reporting (E_ALL ^ E_NOTICE);

/*
if($_SESSION['userID'] == null)
{
	header('Location: login.php');
}
*/
// Breadcrumb

//include("./Breadcrumb.php");
//$trail = new Breadcrumb();
//$trail->add('Add Products', addProducts, 1);

// END of Breadcrumb


require('includes/functions.php'); //include functions
require('includes/dbconnect.php'); //include db connection

$error = array(); //define $error to prevent error later in script
$message = '';

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
    <title>Products Inventory</title>
		<script type="text/javascript">

			function AjaxFindProductName(productName)
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

		  function AjaxAddProduct()
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
					document.getElementById('addProductStatus').innerHTML = "";
					var myarray=eval(httpxml.responseText);
					//document.testform1.level2ProdName.value = "";
					document.getElementById('addProductStatus').innerHTML = "<font style='font:normal 12px verdana; color=blue'><b><u> "+ myarray[0] + "</u></b></font>";
					document.testform.prodName.value = "";
					document.testform.prodCode.value = "";
					document.testform.amount.value = "";
				}
		    }
			//alert("CATEGORY : "+getCheckedValue(document.testform.category));

			var url="addProductsAjax.php";
			url=url+"?productName="+document.testform.prodName.value;
			url=url+"&prodCode="+document.testform.prodCode.value;
			url=url+"&amount="+document.testform.amount.value;
			url=url+"&quantity="+document.testform.quantity.value;
			url=url+"&category="+getCheckedValue(document.testform.category);
			url=url+"&sid="+Math.random();
			httpxml.onreadystatechange=stateck;
			httpxml.open("GET",url,true);
			httpxml.send(null);

		  }

			function getCheckedValue(radioObj) {
				if(!radioObj)
					return "";
				var radioLength = radioObj.length;
				if(radioLength == undefined)
					if(radioObj.checked)
						return radioObj.value;
					else
						return "";
				for(var i = 0; i < radioLength; i++) {
					if(radioObj[i].checked) {
						return radioObj[i].value;
					}
				}
				return "";
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
        	<form name="testform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table width="100%" valign="top" align="left">
                <tr>
					<td valign="top" align="left">
						<?php
						/*
							//Sample CSS
							echo "
							<style>
							#breadcrumb ul li{
							   list-style-image: none;
							   display:inline;
							   padding: 0 3px 0 0;
							   margin: 3px 0 0 0;
							}
							#breadcrumb ul{
							   margin:0;padding:0;
							   list-style-type: none;
							   padding-left: 1em;
							}
							</style>
							";

							//Now output the navigation.
							$trail->output();
						*/
						?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
						<div style="padding: 10px; width: 700px">
							<fieldset>
        						<legend><font style='font:normal 14px verdana'><b>Products Inventory</b></font> </legend>
								<table width="100%" align="left">
									<tr>
										<td colspan="4" align="center">
											<div id="addProductStatus"></div>
										</td>
									</tr>
									<tr>
										<td colspan="4" align="center">&nbsp;
											
										</td>
									</tr>
									<tr>
										<td colspan="4" align="center">&nbsp;
											
										</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'>Service Name: <font color="red" size="4"><b>*</b></font></font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="prodName"  size="40"/>
										</td>
										<td width="25%"><!--<div id="productExists"></div>--></td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'>Service Code: </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="prodCode" size="10" />
										</td>
										<td width="25%"><!--<div id="productCodeExists"></div>--></td>
									</tr>
									<!--
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'>Price: </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="amount" size="10"/>
										</td>
										<td width="15%" align="left">
											&nbsp;
										</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											<font style='font:normal 12px verdana'>Quantity: </font>
										</td>
										<td width="45%" align="left">
											<input type="text" name="quantity" size="10"/>
										</td>
										<td width="15%" align="left">
											&nbsp;
										</td>
									</tr>
									-->
									<tr>
										<td colspan="4" align="right">&nbsp;
											
										</td>
									</tr>
									<tr>
										<td colspan="4" align="center">
											<input type="button" name="search" value="Search"/>
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
                <tr>
                	<td align="left" valign="top">
						<div id="productList" style="padding: 10px; width: 700px" scrollbar="yes">
							<fieldset>
        						<legend><font style='font:normal 14px verdana'><b>Services</b></font> </legend>
								<table width="100%" align="left">
									<tr bgcolor="#3C74E6">
										<td width="20%" align="left">
											<font style='font:normal 12px verdana; color:#FFFFFF'><b>Code</b></font>
										</td>
										<td width="60%" align="left">
											<font style='font:normal 12px verdana; color:#FFFFFF'><b>Service Name</b></font>
										</td>
										<td width="20%" align="left">
											<font style='font:normal 12px verdana; color:#FFFFFF'><b>Price</b></font>
										</td>
										<!--
										<td width="20%" align="left">
											<font style='font:normal 12px verdana; color:#FFFFFF'><b>In Stock</b></font>
										</td>
										-->
									</tr>
								  <?php

									  //$orgID = $_SESSION['orgID'];

									  $query1 = "SELECT * FROM products ";
									  $query2 = " WHERE CATEGORY=2 ";
									  $query3 = " ORDER BY PRODUCT_NAME ASC";

									  $query = $query1 . $query2 . $query3;
									  $q=mysql_query($query);

									  echo mysql_error();
									  $i = 1;
									  while($n=mysql_fetch_assoc($q)){
										  $prodName = $n[PRODUCT_NAME];
										  $prodCode = $n[PRODUCT_CODE];
										  $prodAmount = $n[AMOUNT];
										  $prodQuantity = $n[QUANTITY];
										$i++;
											$bcolor = '#FFFFFF';
											if($i%2 == 0){
												$bcolor = '#C3D9FF';
											}
									  ?>
										<tr bgcolor='<?php echo $bcolor; ?>'>
											<td width="20%" align="left">
												<font style='font:normal 12px verdana'><?php echo $prodCode; ?></font>
											</td>
											<td width="60%" align="left">
												<font style='font:normal 12px verdana'><?php echo $prodName; ?></font>
											</td>
											<td width="60%" align="left">
												<font style='font:normal 12px verdana'><?php echo $prodAmount; ?></font>
											</td>
											<!--
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
            </form>
        </td>
    </tr>
  </table>
  </body>
</html>

