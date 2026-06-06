<?php
require('includes/functions.php'); //include functions
require('../db.php'); //include db connection
$error = array(); //define $error to prevent error later in script
$message = '';
$orgID = $_SESSION['orgID'];

if ( isset( $_POST['submit'] ) ) {

	print "INSIDE";

    $error = array();
    array_map( 'stripslashes',$_POST ); //Strips slashes
    array_map( 'mysql_real_escape_string',$_POST ); //Escapes data to protect against sql injection

	$date = date("Y-m-d", time() + 45000);

	// Customer Information
    $custName = $_POST['custName'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$receiptID = $_POST['receiptNumber'];
	 for ($i=1; $i<=10; $i++)
		  {

		  	$SlNo = $_POST['SlNo'.$i];
		  	print "<br>" . $_POST['SlNo'.$i] . "<br>";
		  	if(!is_null($SlNo) && $SlNo != '') {
				$billProduct = $_POST['billProduct'.$i];
				$billQuantity = $_POST['billQuantity'.$i];
				$pricePerQuantity = $_POST['pricePerQuantity'.$i];
				$tax = $_POST['tax'.$i];
				$discount = $_POST['discount'.$i];
				$billAmount = $_POST['billAmount'.$i];
				if($billProduct!='' and $billQuantity!=0 and $billQuantity!='' and  $pricePerQuantity!='' and $pricePerQuantity!=0)
				{
			//	print "INSERT INTO receipt_details(RECEIPT_ID, SL_NO, PRODUCT_NAME, QUANTITY, AMOUNT, TAX, DISCOUNT, PAYABLE)	VALUES('{$receiptID}','{$SlNo}', '{$billProduct}','{$billQuantity}','{$pricePerQuantity}','{$tax}','{$discount}','{$billAmount}')";
				$query3 = mysql_query( "INSERT INTO receipt_details(RECEIPT_ID, SL_NO,  PRODUCT_NAME, QUANTITY, AMOUNT, TAX, DISCOUNT, PAYABLE)	VALUES('{$receiptID}','{$SlNo}', '{$billProduct}','{$billQuantity}','{$pricePerQuantity}','{$tax}','{$discount}','{$billAmount}')", $con);
				$SlNo = '';
				//$i++;
				}
			}
		  }


		//$query3 = mysql_query( "INSERT INTO _CUSTOMER_VISIT_INFO(ORG_ID, OUTLET_ID, ENQUIRY_FLAG, QUANTITY_ENQUIRED, CUSTOMER_ID, NOTES_COMMENTS, VISIT_ID, OUTLET_USER_ID, DATE_OF_ENTRY, NAME_OF_PRODUCT, SAMPLES_GIVEN, PROJECT_ENQUIRY) VALUES('{$orgID}', '{$outletID}', 'YES', '{$approxQty}', '{$custID}', '{$notes}', '{$visitID1}', '{$userID}', '{$date}', '{$nameOfProduct}', '{$samplesGiven}', '{$projectEnquiryFlag}')", $con);

		$error[] = 'New customer created';
	//}
}



// END - SAVE INFO INTO THE DATABASE




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
    <title>Generate Receipt</title>
    		<script src="JS/calendar.js" type="text/javascript"></script>
		<script type="text/javascript">
		function valid(id)
		{
			var mmarks= document.getElementsByName("m_mark" + id)[0].value;
			var obt_mark = parseInt(document.getElementsByName("mark" + id)[0].value);
			if(isNaN(obt_mark))
			{
				alert("Enter number only. For Absentees enter as 0");
				document.getElementsByName("mark" + id)[0].value='';
			}
			else
			{
				if(obt_mark>mmarks)
				{
					alert("Scored Mark cannot be greater than max mark");
					document.getElementsByName("mark" + id)[0].value='';
				}
			}
		}
		
			function printReceipt()
			{
				saveReceiptInfo();
           }

			function saveReceiptInfo()
			{

				alert("INSIDE saveReceipt FUNCTION");

				var receiptNumber = document.testform.receiptNumber.value;

				var customerName = document.testform.custName.value;
				var customerPhone = document.testform.phone.value;
				var customerEmail = document.testform.email.value;

				var totalQty = document.testform.totalQty.value;
				var totalMRP = document.testform.totalMRP.value;
				var totalServiceTaxPayable = document.testform.totalTax.value;
				var totalDiscount = document.testform.totalDiscount.value;
				var totalAmountPayable = document.testform.totalAmountPayable.value;

				var prod1 = document.testform.billProduct1.value;
				var prod2 = document.testform.billProduct2.value;
				var prod3 = document.testform.billProduct3.value;
				var prod4 = document.testform.billProduct4.value;
				var prod5 = document.testform.billProduct5.value;
				var prod6 = document.testform.billProduct6.value;
				var prod7 = document.testform.billProduct7.value;
				var prod8 = document.testform.billProduct8.value;

				var qty1 = document.testform.billQuantity1.value;
				var qty2 = document.testform.billQuantity2.value;
				var qty3 = document.testform.billQuantity3.value;
				var qty4 = document.testform.billQuantity4.value;
				var qty5 = document.testform.billQuantity5.value;
				var qty6 = document.testform.billQuantity6.value;
				var qty7 = document.testform.billQuantity7.value;
				var qty8 = document.testform.billQuantity8.value;

				var mrp1 = document.testform.pricePerQuantity1.value;
				var mrp2 = document.testform.pricePerQuantity2.value;
				var mrp3 = document.testform.pricePerQuantity3.value;
				var mrp4 = document.testform.pricePerQuantity4.value;
				var mrp5 = document.testform.pricePerQuantity5.value;
				var mrp6 = document.testform.pricePerQuantity6.value;
				var mrp7 = document.testform.pricePerQuantity7.value;
				var mrp8 = document.testform.pricePerQuantity8.value;

				var tax1 = document.testform.tax1.value;
				var tax2 = document.testform.tax2.value;
				var tax3 = document.testform.tax3.value;
				var tax4 = document.testform.tax4.value;
				var tax5 = document.testform.tax5.value;
				var tax6 = document.testform.tax6.value;
				var tax7 = document.testform.tax7.value;
				var tax8 = document.testform.tax8.value;

				var discount1 = document.testform.discount1.value;
				var discount2 = document.testform.discount2.value;
				var discount3 = document.testform.discount3.value;
				var discount4 = document.testform.discount4.value;
				var discount5 = document.testform.discount5.value;
				var discount6 = document.testform.discount6.value;
				var discount7 = document.testform.discount7.value;
				var discount8 = document.testform.discount8.value;

				var payable1 = document.testform.billAmount1.value;
				var payable2 = document.testform.billAmount2.value;
				var payable3 = document.testform.billAmount3.value;
				var payable4 = document.testform.billAmount4.value;
				var payable5 = document.testform.billAmount5.value;
				var payable6 = document.testform.billAmount6.value;
				var payable7 = document.testform.billAmount7.value;
				var payable8 = document.testform.billAmount8.value;

				var prodArray1 = new Array();
				var prodArrayVal1;
				var prodArray2;
				var prodArray3;
				var prodArray4;
				var prodArray5;
				var prodArray6;
				var prodArray7;
				var prodArray8;

				if(prod1 != null && prod1 != '')
				{
					//prodArray1 = new Array(prod1, qty1, mrp1, tax1, discount1, payable1);
					prodArray1[0]=prod1;
					prodArray1[1]=qty1;
					prodArray1[2]=mrp1;
					prodArray1[3]=tax1;
					prodArray1[4]=discount1;
					prodArray1[5]=payable1;
					js_array_to_php_array
					//prodArray1.toString();
				}

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
						alert(myarray[0]);
					}
				}
				//alert(document.testform.orgID.value);
				alert(prodArray1);
				var url="AjaxSaveReceipts.php";
				url=url+"?prodArray1="+prodArray1;
				url=url+"&receiptNumber="+receiptNumber;
				url=url+"&custName="+customerName;
				url=url+"&custPhone="+customerPhone;
				url=url+"&custEmail="+customerEmail;
				url=url+"&sid="+Math.random();
				alert(url);
				httpxml.onreadystatechange=stateck;
				httpxml.open("GET",url,true);
				httpxml.send(null);
			}

		function js_array_to_php_array (a)
		{
				// This converts a javascript array to a string in PHP serialized format.
				// This is useful for passing arrays to PHP. On the PHP side you can
				// unserialize this string from a cookie or request variable. For example,
				// assuming you used javascript to set a cookie called "php_array"
				// to the value of a javascript array then you can restore the cookie
				// from PHP like this:
				//    <?php
				//    
				//    $my_array = unserialize(urldecode(stripslashes($_COOKIE['php_array'])));
				//    print_r ($my_array);
				//    ?>
				// This automatically converts both keys and values to strings.
				// The return string is not URL escaped, so you must call the
		// Javascript "escape()" function before you pass this string to PHP.

			var a_php = "";
			var total = 0;
			for (var key in a)
			{
				++ total;
				a_php = a_php + "s:" +
						String(key).length + ":\"" + String(key) + "\";s:" +
						String(a[key]).length + ":\"" + String(a[key]) + "\";";
			}
			a_php = "a:" + total + ":{" + a_php + "}";
			return a_php;
		}


			function AjaxFunctionForCode(productCode, productDescription)
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
						// Before adding new we must remove previously loaded elements
						/*
						for(j=document.testform["level"+nextLevel].options.length-1;j>=0;j--)
						{
							document.testform["level"+nextLevel].remove(j);
						}
						*/
						document.testform["description"+productDescription].value = "";
						for (i=0;i<myarray.length;i++)
						{
								//var optn = document.createElement("OPTION");
								//optn.text = myarray[i]; //substr($str,0,(indexOf(":")));
								//optn.value = myarray[i]; // substr($str,indexOf(":")+1,(strLen(myarray[i])));
								var str = myarray[i];
								//document.getElementByIDproductDescription.value=str;
								document.testform["description"+productDescription].value = str;
								//alert(str);
								//alert(str.substr(str.indexOf(":")+1,(str.length)));
								//optn.value = str.substr(0,(str.indexOf(":")))
								//optn.text = str.substr(str.indexOf(":")+1,(str.length));

								//document.testform["level"+nextLevel].options.add(optn);
						}
			      	}
			    }
			    //alert(document.testform.orgID.value);
				//alert(prod_id_ref);
				var url="dd.php";
				url=url+"?productCode="+productCode;
				url=url+"&sid="+Math.random();
				httpxml.onreadystatechange=stateck;
				httpxml.open("GET",url,true);
				httpxml.send(null);
			}


			function AjaxFunctionSuggest(productDescription)
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

						//httpxml.responseText);
						//alert(myarray);
						//alert(httpxml.responseText);
						if(httpxml.responseText=="")
							HideDiv("autocomplete");
						else
						{
							ShowDiv("autocomplete");
							document.getElementById("autocomplete").innerHTML =
															  httpxml.responseText;

						}

			      	}
			    }
			    //alert(document.testform.orgID.value);
				//alert(prod_id_ref);
				var url="dd1.php";
				url=url+"?productDescription="+productDescription;
				url=url+"&sid="+Math.random();
				httpxml.onreadystatechange=stateck;
				httpxml.open("GET",url,true);
				httpxml.send(null);
			}

   		function AjaxFunctionSearchPhone()
		  {
		  	var phoneNum = document.testform.phone.value;
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
					// Before adding new we must remove previously loaded elements
					//for(j=document.testform.phoneNum.options.length-1;j>=0;j--)
					//{
					//	document.testform["level"+nextLevel].remove(j);
					//}

					/**
					for (i=0;i<myarray.length;i++)
					{
							var optn = document.createElement("OPTION");
							optn.text = myarray[i];
							optn.value = myarray[i];
							document.testform["level"+nextLevel].options.add(optn);

					}
					**/
					/**
					for (i=0;i<myarray.length;i++)
					{
							var optn = document.createElement("OPTION");
							//optn.text = myarray[i]; //substr($str,0,(indexOf(":")));
							//optn.value = myarray[i]; // substr($str,indexOf(":")+1,(strLen(myarray[i])));
							var str = myarray[i];
							//alert(str);
							//alert(str.substr(str.indexOf(":")+1,(str.length)));
							optn.value = str.substr(0,(str.indexOf(":")))
							optn.text = str.substr(str.indexOf(":")+1,(str.length));

							document.testform["level"+nextLevel].options.add(optn);
					}
					**/
					document.testform.custName.value = myarray[0];
					document.testform.email.value = myarray[1];
					//document.testform.loyaltyPoints.value = myarray[2];
					document.testform.gender.value = myarray[3];
					document.testform.customerAge.value = myarray[4];
						if(document.testform.custName.value != null && document.testform.custName.value != ''){
							document.testform.DOB.disabled = true;
							document.testform.anniversary.disabled = true;
						}

					}
			  }
			//alert(phoneNum)
			var url="ajaxFunctions.php";
			url=url+"?phoneNum="+phoneNum;
			url=url+"&orgID="+document.testform.orgID.value;
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
			//var approxAmount = document.testform.approxAmount.value;
			//var productName = document.testform.nameOfProduct.value;
			//var age = document.testform.customerAge.value;
			//var notes = document.testform.notes.value;

			if(name != null && name != "")
			{
				//var fullName = document.getElementById("register:orgName").value;
				errorStr = validAlphaNumeric(name, 1, 30, "Name");
				completeErrorMsg = completeErrorMsg + errorStr;
			}

			// Validation for "PHONE NUMBER"
			if(phone != null && phone != "")
			{
				//var fullName = document.getElementById("register:orgName").value;
				errorStr = checkPhoneNumber(phone, "Phone Number");
				completeErrorMsg = completeErrorMsg + errorStr;
			}

			if(email != null && email != "")
			{
				//var fullName = document.getElementById("register:orgName").value;
				errorStr = checkMail(email, "EMail");
				completeErrorMsg = completeErrorMsg + errorStr;
			}

			if(completeErrorMsg != null && completeErrorMsg != "")
			{
				alert("Please correct the following errors before submitting \n\n" + completeErrorMsg );
				return false;
			}
		}

		function checkPhoneNumber(str, fieldName){
			var strCheck = str;
			//alert(strCheck.charCodeAt(1));
			var strCheckForAlphaNumeric = "1234567890- ";
			var strNotAllowed = ":'`";
			var blnRet = true;
			var errMsg = "";

			if(strCheck != null && strCheck != "")
			{
					for(i=0; i< strCheck.length && blnRet == true; i++)
					{
						if(strCheck.charCodeAt(i) != 13 && strCheck.charCodeAt(i) != 10){
							if(strCheckForAlphaNumeric.indexOf(strCheck.charAt(i)) == -1)
							{
								//errMsg = "'" + fieldName + "'" + " cannot have Double Quotes \n";
								errMsg = "'" + fieldName + "'" + " cannot have '" + strCheck.charAt(i) + "' character\n";
								blnRet = false;
							}
						}
					}
			}


			return errMsg;

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

			/**
			if (document.register.fieldname.value.length >0) {
				 i=document.register.fieldname.value.indexOf("@")
				 j=document.register.fieldname.value.indexOf(".",i)
				 k=document.register.fieldname.value.indexOf(",")
				 kk=document.register.fieldname.value.indexOf(" ")
				 jj=document.register.fieldname.value.lastIndexOf(".")+1
				 len=document.register.fieldname.value.length

				if ((i>0) && (j>(1+1)) && (k==-1) && (kk==-1) && (len-jj >=2) && (len-jj<=3)) {
				}
				else {
					alert("Please enter an exact email address.\n" +
					document.register.fieldname.value + " is invalid.");
					return false;
				}
			 }
			 **/

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


		function checkEmptyBox(){
			if (document.formname.fieldname.value.length == 0) {
			          alert("Please fill out your name.\n");
				  return false;
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
		function formReload()		
		{
			
			calculateTotal();
			
			document.testform.action="updt.php";
			
			document.testform.submit();
		}
		

			//if (this.name!='fullscreen'){
			//	window.open(location.href,'fullscreen','fullscreen,scrollbars')
			//}


			function calculateTotal()
			{
				//alert("1");

				var numHundred = parseFloat(100, 10);

				var quantity = document.testform.qty.value;
				var amount = document.testform.amount.value;
				var netAmount = (quantity * amount);
				var serviceTaxDeclared = document.testform.sTax.value;
				var serviceTaxAmount = 0;
				var discount = document.testform.discount.value;
				var discountAmount = 0;

				var costBeforeServiceTax;

				if(discount != null && discount != '')
				{
					//alert("2");
					discountAmount = ((discount/100)*(netAmount));
					netAmount = netAmount - discountAmount;
				}
				if(serviceTaxDeclared != null && serviceTaxDeclared != '')
				{
					//alert("3");
					costBeforeServiceTax = (netAmount * eval(numHundred))/(eval(numHundred) + eval(serviceTaxDeclared));
					serviceTaxAmount = (netAmount - costBeforeServiceTax);
				}

				document.testform.subTotal.value = roundNumber(costBeforeServiceTax, 2);
				document.testform.serviceTaxAmount.value = roundNumber(serviceTaxAmount, 2);
				document.testform.total.value = roundNumber(netAmount, 2);
				document.testform.discountAmount.value = roundNumber(discountAmount, 2);


		}

		function calculateSubTotal(costPerProduct)
		{
			var numHundred = parseFloat(100, 10);

			var quantity = document.testform.qty.value;
			var amount = document.testform.amount.value;
			var netAmount = (quantity * amount);
			var serviceTaxDeclared = document.testform.sTax.value;
			var discount = document.testform.discount.value;
			if(discount != null && discount != '')
			{
				netAmount = netAmount - discount;
			}
			//alert("SERVICE TAX DECLARED : " + serviceTaxDeclared);
			//document.testform.subTotal.value = (quantity * amount);

			// ADDED CODE
			//alert(netAmount * eval(numHundred));
			//alert(eval(numHundred) + eval(serviceTaxDeclared));
			//alert((netAmount * eval(numHundred))/(eval(numHundred) + eval(serviceTaxDeclared)));

			var costBeforeServiceTax = (netAmount * eval(numHundred))/(eval(numHundred) + eval(serviceTaxDeclared));
			var serviceTax	=	(netAmount - costBeforeServiceTax);
			var amountPayable = netAmount;

			//alert("COST BEFORE SERVICE TAX : " + costBeforeServiceTax);
			//alert("SERVICE TAX  : " + serviceTax);
			//alert("NET AMOUNT : " + amountPayable);
			document.testform.subTotal.value = roundNumber(costBeforeServiceTax, 2);
			//document.testform.discount.value =
			document.testform.serviceTaxAmount.value = roundNumber(serviceTax, 2);
			document.testform.total.value = roundNumber(amountPayable, 2);

			//alert(" : " + );
			//alert(" : " + );

		}

		function roundNumber(num, dec) {
			var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
			return result;
		}

		function calculateDiscount(discount)
		{
			var quantity = document.testform.qty.value;
			var amount = document.testform.amount.value;
			var subTotal = document.testform.subTotal.value;
			var discount = document.testform.discount.value;

			//document.testform.discountAmount.value = ((discount/100)*subTotal);
			document.testform.discountAmount.value = roundNumber(((discount/100)*(quantity*amount)), 2);
			calculateSubTotal(amount);

		}

		function calculateServiceTax()
		{
			var subTotal = document.testform.subTotal.value;
			var discount = document.testform.discountAmount.value;
			var serviceTax = document.testform.serviceTax.value;

			var serviceTaxAmount = ((serviceTax/100) * (subTotal-discount));

			document.testform.serviceTaxAmount.value = serviceTaxAmount;


			document.testform.total.value = (subTotal - discount) + serviceTaxAmount;
		}


  		function AjaxFunctiongetProductName(productCode, textBoxNumber)
		  {
		  	//alert(productCode);
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
					var prodName = myarray[0];
					document.testform["billProduct"+textBoxNumber].value = prodName;
					//document.getElementById(''+textBoxName+'').value = prodName;
					//document.getElementById('service1').innerHTML = ""+ prodName + "";
					//alert(prodName);
					//return prodName;
					}
			  }
			//alert(phoneNum)
			var url="ajaxgetProducts.php";
			url=url+"?prodID="+productCode;
			url=url+"&sid="+Math.random();
			httpxml.onreadystatechange=stateck;
			httpxml.open("GET",url,true);
			httpxml.send(null);
  		}

	function printReceipt(){
		alert("INSIDE");
		window.print();

	}
	
		function addToBill()
		{
			var mmarks= parseInt(document.getElementsByName("description")[0].value);
			var mmarks1=parseInt(document.getElementsByName("a" + mmarks)[0].value);
			var qty=parseInt(document.getElementsByName("qty")[0].value);
			if(qty>mmarks1)
			{
				alert("Available quantity " + mmarks1);
				document.getElementsByName("qty")[0].value=mmarks1;
			}
			calculateTotal();
			 
		//	if(qty='NaN')
			//{
			//	alert("**** Enter valid numbers  ****");
			//	document.getElementsByName("qty")[0].value=mmarks1;
			//}
		}
		function addToBill1()
		{
			var mmarks= parseInt(document.getElementsByName("description")[0].value);
			var mmarks1=parseInt(document.getElementsByName("b" + mmarks)[0].value);
			document.getElementsByName("amount")[0].value=mmarks1;
			addToBill();
		}
function calreload()
{
	document.testform.action='';
	document.testform.submit();
}
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=700,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
	    </script>
  </head>
  <body width="100%" >


	<?php
	if($_POST['clearFields'])
	{
		$suntot1=0;
		$suntot2=0;      
		$suntot3=0;
		$suntot4=0;
		$suntot=0;
		mysql_query("TRUNCATE temp_rec");
	}
	
	 $description=$_POST['description'];

	?><form name='testform' action='' method='post'>
	


	   <table width="70%" valign="top" align="center" border="0">
				<tr>
                	<td align="left" width="507"valign="top">
						
								<table width="100%" align="left">
										<?php
										$category=1;
										$cat=1;
										echo "<input type='hidden' name='category' value='$category'>
										<input type='hidden' name='cat' value='$cat'>";
										?>
											
										
                                        <tr>
                                            <td class="head" colspan="5" align="center">&nbsp;
                                                Receipt
                                            </td>
                                        </tr>
									<tr>
										<td width="20%" align="center">&nbsp;
											
										</td>
										<td width="30%" align="center">
											Item
										</td>
										<td width="10%" align="center">
											Qty
										</td>
										<td width="20%" align="center">
											Price
										</td>
										<td width="20%" align="center">
											Amount
										</td>
									</tr>
									
									<tr>
										<td width="20%" align="left">
											Item: </legend>
										</td>
										<td width="30%" align="left">
											<!--<input type="text" name="description" size="40"/>-->
											<?php
											if($_POST[category]==2)
											{
												$catid=2;
											}
											else
											{
												$catid=1;
											}
											?>
											   <select name="description" id="description" width="250" onChange="addToBill1()"  STYLE="width: 250px" size="0">
												  <option value="00">--Select--</option>
												  <?php
														$q=mysql_query("SELECT * FROM products WHERE CATEGORY='$catid' AND QUANTITY>0");
													  	echo mysql_error();

													  while($n=mysql_fetch_assoc($q))
													  {
													  $prodCode = $n[PRODUCT_CODE];
													  $prodName = $n[PRODUCT_NAME];
													   $prodCode1[] = $n[PRODUCT_CODE];
													   $pQUANTITY1[] = $n[QUANTITY];
													  $pprice[] = $n[AMOUNT];
													echo "<option value=$prodCode>$prodName</option>";
													  }

												?>
											   </select>
											   <?php
											    echo "<input type='hidden' name='prodName12' value='$prodName12'>";
											   for($i=0;$i<sizeof($prodCode1);$i++)
											   {
											   
											   
											   echo "<input type='hidden' name='a$prodCode1[$i]' value='$pQUANTITY1[$i]'>";
											     echo "<input type='hidden' name='b$prodCode1[$i]' value='$pprice[$i]'>";
											   }
											   ?>
										</td>
										<td width="10%" align="left">
											<!--<input type="text" name="qty" size="10" onchange="calculateSubTotal(this.value);"/>-->
											<?php
										
										$chek12=1;
										
										?>
											<input type="text" name="qty" value="<?php echo $chek12; ?>" size="5" onBlur="addToBill()"/>
										</td>
										<td width="20%" align="left">
											<!--<input type="text" name="amount" size="20" onchange="calculateSubTotal(this.value);"/>-->
											<input type="text" name="amount" size="10" />
										</td>
										<td width="20%" align="left">
											<input type="text" name="subTotal" size="10" onBlur="calculateTotal()" readonly/>
										</td>
									</tr>
									<tr>
										<td width="20%" align="left">
											Discount:
										</td>
										<td width="30%" align="left">
											<!--<input type="text" name="discount" size="10" onmousedown="calculateDiscount();" onmouseup="calculateDiscount();" onkeyup="calculateDiscount();" onchange="calculateDiscount();"/>-->
											<input type="text" name="discount" size="5"  onblur="calculateTotal()" />%
										</td>
										<td width="10%" align="left">&nbsp;
											
										</td>
										<td width="20%" align="left">&nbsp;
											
										</td>
										<td width="20%" align="left">
											<!--<input type="text" name="discountAmount" size="20" onclick="calculateDiscount();"/>-->
											<input type="text" name="discountAmount"  onblur="calculateTotal()" readonly size="10"/>
										</td>
									</tr>
									  <?php
										  $q=mysql_query("SELECT * FROM settings WHERE SETTING_ID=1");
										  echo mysql_error();
										  $serviceTax;
										  while($rowTax=mysql_fetch_assoc($q)){
										  $serviceTax = $rowTax[SETTING_VALUE];
										  }

									?>
									<input type="hidden" name="sTax" value="<?php echo $serviceTax;?>"  onblur="calculateTotal()" />
									<tr>
										<td width="20%" align="left">
											Service Tax:
										</td>
										<td width="40%" align="left">
											<input type="text" name="serviceTax"  onblur="calculateTotal()" value="<?php echo $serviceTax;?>" size="5"/>%
										</td>
										<td width="20%" align="left">&nbsp;
											
										</td>
										<td width="20%" align="left">&nbsp;
											
										</td>
										<td width="20%" align="left">
											<input type="text" name="serviceTaxAmount"  onblur="calculateTotal()" readonly size="10"/>
										</td>
									</tr>
									<tr>
										<td width="20%" align="left">
											<!-- Attended By: -->
										</td>
										<td width="30%" align="left">
                                        <input type="hidden" name="attendedBy" value="<?php echo $_REQUEST['stud_id']; ?>" >
											  <!-- <select name="attendedBy">
												  <option value="00">--Select--</option>
												  <?php
													  $orgID = $_SESSION['orgID'];
													  $q=mysql_query("SELECT * FROM USERS");
													  echo mysql_error();

													  while($n=mysql_fetch_assoc($q)){
														  $userId = $n["USER_ID"];
														  $firstName = $n["FIRST_NAME"];
														  $lastName = $n["LAST_NAME"];
														  if($_REQUEST[aaa]==$userId)
														  echo "<option value=$userId selected>". $firstName . " " . $lastName . "</option>";
														  else
														  echo "<option value=$userId>". $firstName . " " . $lastName . "</option>";
													  }
												?>
											   </select>-->
										</td>
										<td width="10%" align="left">&nbsp;
											
										</td>
										<td width="20%" align="right">
											Total:
										</td>
										<td width="20%" align="left">
											<input type="text" name="total" size="10"  onblur="calculateTotal()" readonly/>
										</td>
									</tr>
									<tr>
										<td class="bottomborder" colspan="5">&nbsp;
											
										</td>
									</tr>
									<tr>
										<td colspan="5" align="center">
											
											<input type="button" class="bgbutton" name="add" value="Add" onClick="formReload()" />
										</td>
										
									</tr>
								</table>
                                <br>
						
					  <?php
					  $query2=mysql_query("SELECT DESCRIPTION FROM temp_rec limit 1");
					  if(mysql_num_rows($query2)==0)
					  die();
					  ?>
               	  </td>
					
                </tr>
               
                 <?php
                	//$receiptNumber = "124";

					$query1 = mysql_query( "SELECT MAX(RECEIPT_ID) FROM receipt_totals");
					$row1 = mysql_fetch_row($query1);
					$receiptNumber = $row1[0] + 1;

                	//$slNo1 = $_POST['slNo1'];
                	//$slNo2 = $_POST['slNo2'];
                	//$slNo3 = $_POST['slNo3'];

                ?>
                <br>
                		<table width="70%" align="center" border="0">
                							
                			<tr>
                				<td align="right" colspan="2" nowrap="nowrap">
                					Receipt No :                				</td>
                				<td colspan="5" align="left">
                					<input type="text" name="receiptNumber" value="<?php echo $receiptNumber; ?>" readonly/>                				</td>
                			</tr>
                										
                			<tr>
                				<td align="center" class="row3">
                					Sl No                				</td>
                				<td align="center" class="row3">
                					Item                				</td>
                				<td align="center" class="row3">
                					Qty                				</td>
                				<td align="center" class="row3">
                					  Amount              				</td>
                				<td align="center" class="row3">
                					Tax                				</td>
                				<td align="center" class="row3">
                					Discount                				</td>
                				<td align="center" class="row3">
                					Payable                				</td>
                			</tr>
                									
                			<?php 
							if($_REQUEST['actionid']);
							{
								$tede=$_REQUEST['actionid'];
								mysql_query("DELETE FROM temp_rec WHERE ID='$tede'");
							}
							if($_POST[Save])
							{
								$query2=mysql_query("SELECT description FROM temp_rec GROUP BY DESCRIPTION");
								while($r2=mysql_fetch_array($query2))
								{
									$productname=mysql_fetch_row(mysql_query("SELECT PRODUCT_NAME FROM products WHERE PRODUCT_CODE='$r2[0]'"));
								}
							}
							$query1=mysql_query("SELECT * FROM temp_rec ORDER BY ID");
							$tinc=1;
							while($r1=mysql_fetch_array($query1))
							{
							$productname=mysql_fetch_row(mysql_query("SELECT PRODUCT_NAME FROM products WHERE PRODUCT_CODE='$r1[1]'"));
							
							echo "<tr>
                				<td align='center'><input type='text' name='ss' value='$tinc' size='3' readonly/>
								<input type='hidden' name='SlNo1' value='$r1[0]' size='3' readonly/></td>
                				<td align='center'>
                					<input type='text' name='billProduct$r1[0]' id='billProduct1' value='$productname[0]' size='25' readonly/>            </td>
                				<td align='center'>
                					<input type='text' name='billQuantity$r1[0]' value='$r1[2]' size='5' readonly/>         </td>
                				<td align='center'>
                					<input type='text' name='pricePerQuantity$r1[0]' value='$r1[4]' size='10' readonly/>                				</td>
                				<td align='center'>
                					<input type='text' name='tax$r1[0]' value='$r1[6]' size='10' readonly/>                				</td>
                				<td align='center'>
                					<input type='text' name='discount$r1[0]' value='$r1[5]' size='10' readonly/>                				</td>
                				<td align='center' nowrap>
                					<input type='text' name='billAmount$r1[0]' value='$r1[7]' size='15' readonly/> <a href='generateReceipt.php?actionid=$r1[0]'> <img src='images/delete.gif' width='13' height='13' border='0'></a>              				</td>
                			</tr>";
								if($suntot=='')
								{
									$suntot1=$r1[2];
									$suntot2=$r1[4];
									$suntot3=$r1[6];
									$suntot4=$r1[5];
									$suntot=$r1[7];
								}
								else
								{
									$suntot1=$suntot1+$r1[2];
									$suntot2=$suntot2+$r1[3];
									$suntot3=$suntot3+$r1[6];
									$suntot4=$suntot4+$r1[5];
									$suntot=$suntot+$r1[7];
								}
								$tinc++;
							}
							
							echo "  <tr>
                						<td colspan=7 class='bottomborder'align=left>
                						&nbsp;
										</td>
                					</tr>											
                				<tr bgcolor='#C3D9FF'>
									<td colspan='2' align='left'>
										TOTAL                				</td>
									<td align='center'>
										<input type='text' name='totalQty' value='$suntot1' size='5'  readonly/>                				</td>
									<td align='center'>
										<input type='text' name='totalMRP' value='$suntot2' size='10' readonly/>                				</td>
									<td align='center'>
										<input type='text' name='totalTax' value='$suntot3' size='10' readonly/>                				</td>
									<td align='center'>
										<input type='text' name='totalDiscount' value='$suntot4' size='10'  readonly/>                				</td>
									<td align='center' nowrap>
										 <input type='text' name='totalAmountPayable' value='$suntot' size='15'  readonly/> &nbsp;&nbsp;&nbsp;&nbsp;              				</td>
                				</tr>";
							?>
                            
                            
                				<!-- PRINT: stop -->
                				<td  align="center" colspan="8"><a href="javascript:OpenWind2('printreceipt.php?receiptNumber=<?php echo $receiptNumber; ?>')" >
									<img src="images/print_icon.gif" width="35" height="21" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                					<input type="submit" name="clearFields" class="bgbutton" value="Clear" />
                				</td>
                			</tr>
                		</table>
                	
            <input type="hidden" name="slNo1" value="<?php echo $slNo1; ?>"/>
            <input type="hidden" name="slNo2" value="<?php echo $slNo2; ?>"/>
            <input type="hidden" name="slNo3" value="<?php echo $slNo3; ?>"/>

	
    </form>
  </body>
</html>

