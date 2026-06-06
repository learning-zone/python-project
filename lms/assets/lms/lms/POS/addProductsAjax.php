<?
$productName = $_GET['productName'];
$productCode = $_GET['prodCode'];
$amount = $_GET['amount'];
$quantity = $_GET['quantity'];
$category = $_GET['category'];
require "includes/dbconnect.php";
require "includes/functions.php";
$str="";

$queryStatement;

if(!is_null($productName) && !is_null($category))
{
	if(is_null($amount) || $amount == ''){
		$amount = 0;
	}
	if(is_null($quantity) || $quantity == ''){
			$quantity = 0;
	}
	
		$insertQuery = mysql_query("INSERT INTO products(PRODUCT_NAME, PRODUCT_CODE, AMOUNT, QUANTITY, CATEGORY) VALUES('{$productName}','{$productCode}','{$amount}','{$quantity}', '{$category}')");
	
}

echo "new Array('Added Successfully')";

?>