<?php
require('../db.php'); //include db connection
?>

<html>
  <head>
    <title>Add Products</title>
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
								document.getElementById('productExists').innerHTML = "<font style='font:normal 12px verdana; color=red'><b><u> "+ str + "</u></b>";

						}
			      	}
			    }
			    //alert(productName);
				//alert(prod_id_ref);
				var url="dd.php";
				url=url+"?productName="+productName;
				url=url+"&category="+getCheckedValue(document.testform.category);
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
								document.getElementById('productCodeExists').innerHTML = "<font style='font:normal 12px verdana; color=red'><b><u> "+ str + "</u></b>";

						}
			      	}
			    }
			    //alert(productCode);
				//alert(prod_id_ref);
				var url="dd.php";
				url=url+"?productCode="+productCode;
				url=url+"&category="+getCheckedValue(document.testform.category);
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
					document.getElementById('addProductStatus').innerHTML = "<font style='font:normal 12px verdana; color=blue'><b><u> "+ myarray[0] + "</u></b>";
					document.testform.prodName.value = "";
					document.testform.prodCode.value = "";
					document.testform.amount.value = "";
					document.testform.quantity.value = "";
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

function addToBill1()
{
	var mmarks= parseInt(document.getElementsByName("quantity")[0].value);
	var mmarks1=parseInt(document.getElementsByName("reorder")[0].value);
	if(mmarks>mmarks1)
	{
	}
	else
	{
	alert("Enter Valid Re-Order Level");
	document.getElementsByName("reorder")[0].value=0;
	}
	
}
function frmreload()
{
	window.testform.submit();
	
}
    </script>
  </head>
  <body  >
<?php //include "validUserHeader.php"; 
if($_POST[add])
{
$productName =$_POST['prodName'];
$productCode =$_POST['prodCode'];
$amount =$_POST['amount'];
$quantity =$_POST['quantity'];
$category =$_POST['category'];
$reorder=$_POST['reorder'];
$str="";

$queryStatement;
	if($quantity=='')
	$quantity = 0;
	if($amount=='')
	$amount='0';
	
			$insertQuery = mysql_query("INSERT INTO products(PRODUCT_NAME, PRODUCT_CODE, AMOUNT, QUANTITY, CATEGORY,REORDERLEVEL) VALUES('{$productName}','{$productCode}','{$amount}','{$quantity}', '{$category}', '{$reorder}')");
	


?>
<script type='text/javascript'> 
alert('Added Successfully');
</SCRIPT>
<?PHP
}
?> 	
<form name="testform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       				<input type='hidden' name="category" value="1" >
                    		
        						
								<table width="50%" align="center">
									<tr>
										<td colspan="4" align="center" class="head">
											<b>Add Products</b> 
                                            <div id="addProductStatus"></div>
										</td>
									</tr>
									<tr>
										<td colspan="4" align="center">&nbsp;
											
										</td>
									</tr>
									
									<tr>
										<td width="30%" align="right">
											Product:</td>
										<td width="45%" align="left">
											<input type="text" name="prodName"  size="40" onChange="AjaxFindProductName(this.value);"/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											Product Code: 
										</td>
										<td width="45%" align="left">
										<?php
										 $q3=mysql_fetch_row(mysql_query("SELECT max(PRODUCT_ID) FROM PRODUCTS"));
										?>
											<input type="text" name="prodCode" value="<?php echo $q3[0]+1; ?>" size="10" readonly/>
										</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											Price: 
										</td>
										<td width="45%" align="left">
											<input type="text" name="amount" size="10"/>
										</td>
										<td width="15%" align="left">&nbsp;</td>
									</tr>
									<?php
									if($_POST['category']==2)
									{
									?>
		<input type="hidden" name="reorder" size="10"  value="5" onBlur="addToBill1()"/>
		<input type="hidden" name="quantity" size="10" value="1"/>
									<?php
									}
									else
									{
									?>
									<tr>
										<td width="30%" align="right">
											Quantity: 
										</td>
										<td width="45%" align="left">
									
											<input type="<?php echo $text1; ?>" name="quantity" size="10" value="<?php echo $val1; ?>"/>
										</td>
										<td width="15%" align="left">&nbsp;</td>
									</tr>
									<tr>
										<td width="30%" align="right">
											Re-order level : 
										</td>
										<td width="45%" align="left">
											<input type="<?php echo $text1; ?>" name="reorder" size="10"  value="<?php echo $recal1; ?>" onBlur="addToBill1()"/>
										</td>
										<td width="15%" align="left">&nbsp;</td>
									</tr>
										<?php
									}
									?>
									<tr>
										<td colspan="4" align="right">&nbsp;
											
										</td>
									</tr>
								</table>
<br>
<div align="center"><input type="submit" name="add" value="Add" class='bgbutton' /></div>
	<br>			
                
<table width="50%" align="center">
									<tr >
										<td colspan="4" align="center" class="head">Products in database
                                    	</td>
                                    </tr>    
                                    <tr >
										<td width="20%" align="left" class="row3">
											<b>Code</b>
										</td>
										<td width="60%" align="left" class="row3">
											<b>Product</b>
										</td>
										<td width="20%" align="left" class="row3">
											<b>Price</b>
										</td>
										<td width="20%" align="left" class="row3">
											<b>Stock</b>
										</td>
									</tr>
								  <?php

									  //$orgID = $_SESSION['orgID'];

									  $q=mysql_query("SELECT * FROM products where CATEGORY=1 ORDER BY PRODUCT_NAME ASC");

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
												<?php echo $prodCode; ?>
											</td>
											<td width="60%" align="left">
												<?php echo $prodName; ?>
											</td>
											<td width="60%" align="left">
												<?php echo $prodAmount; ?>
											</td>
											<td width="60%" align="left">
												<?php echo $prodQuantity; ?>
											</td>
										</tr>

									  <?php
									  }

									?>

								</table>
  </form>
        
  </body>
</html>

