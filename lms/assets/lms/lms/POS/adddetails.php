<?php

require('includes/dbconnect.php'); 
error_reporting (E_ALL ^ E_NOTICE);
$customername=0;
$temp=mysql_query("SELECT * FROM COMPANY");
if(mysql_num_rows($temp)>0)
{
	
}
else
{
	mysql_query("INSERT INTO company(COMPANY_NAME,COMPANY_ADDRESS1,COMPANY_ADDRESS2,EMAIL_ID,PHONE_NUM1,PHONE_NUM2,PHONE_NUM3,WEBSITE,FAX,COMPNY_SNAME) Values('$_POST[$customername]','$_POST[customername]','$_POST[phone_num]','$_POST[phone_num1]','$_POST[phone_num2]','$_POST[email]','$_POST[address1]','$_POST[address2]','$_POST[website]','$_POST[fax]')");
}
?>
