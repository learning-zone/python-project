<?

		
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];


//$amount = $_GET['amount'];
//$quantity = $_GET['quantity'];

require "includes/dbconnect.php";// connection to database
require "includes/functions.php";
$str="";

$queryStatement;

if(!is_null($firstName))
{
	/*
	if(is_null($amount) || $amount == ''){
		$amount = 0;
	}
	if(is_null($quantity) || $quantity == ''){
			$quantity = 0;
	}
	*/
	//$queryStatement = "INSERT INTO PRODUCTS(ORG_ID, CATEGORY_ID, PRODUCT_NAME, PRODUCT_LEVEL, PRODUCT_ID_REF) VALUES('{$orgID}', '{$categoryID}', '{$productName}','{$prod2ndLevel}','{$prodIdRef}')";
	//print $queryStatement;
    $insertQuery = mysql_query("INSERT INTO users(FIRST_NAME, LAST_NAME, PHONE, EMAIL, ADDRESS) VALUES('{$firstName}','{$lastName}','{$phone}','{$email}','{$address}')", $con);
}

echo "new Array('Added Successfully')";

?>