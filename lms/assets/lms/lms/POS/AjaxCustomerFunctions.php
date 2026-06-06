<?
$productID =$_GET['productID'];
$serviceID =$_GET['serviceID'];

require "includes/dbconnect.php";// connection to database
require "includes/functions.php";
$str="";

if(!is_null($productID))
{
	// DELETE CUSTOMER_INFO FROM ALL TABLES CONCERNED


	$q=mysql_query("DELETE FROM products WHERE PRODUCT_ID = '{$productID}'");
	/*
	$q1=mysql_query("DELETE FROM _CUSTOMER_VISIT_INFO WHERE CUSTOMER_ID = '{$customerID}' AND ORG_ID='{$orgID}'");
	$q2=mysql_query("DELETE FROM _CUSTOMER_PURCHASE_DETAIL_INFO WHERE CUSTOMER_ID = '{$customerID}' AND ORG_ID='{$orgID}'");
	$q3=mysql_query("DELETE FROM _CUSTOMER_ENQUIRY_DETAIL_INFO WHERE CUSTOMER_ID = '{$customerID}' AND ORG_ID='{$orgID}'");
	$q4=mysql_query("DELETE FROM _CUSTOMER_POTENTIAL_DETAIL_INFO WHERE CUSTOMER_ID = '{$customerID}' AND ORG_ID='{$orgID}'");
	$q5=mysql_query("DELETE FROM _CUSTOMER_INFO WHERE CUSTOMER_ID = '{$customerID}' AND ORG_ID='{$orgID}'");
	$q8=mysql_query("DELETE FROM _CUSTOMER_FOLLOWUP WHERE CUSTOMER_ID = '{$customerID}' AND ORG_ID='{$orgID}'");
	*/
	echo mysql_error();

	$str1 = "Success";
	$str = $str . "\"$str1\"".",";

}

$str=substr($str,0,(strLen($str)-1)); // Removing the last char , from the string
echo "new Array($str)";

?>