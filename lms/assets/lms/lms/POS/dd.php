<?
$productCode = $_GET['productCode'];
$productName = $_GET['productName'];
$findExistence = $_GET['findExistence'];
$category = $_GET['category'];

$orgID = $_GET['orgID'];

//echo $prod_id_ref2ndLevel;

require "includes/dbconnect.php";// connection to database
require "includes/functions.php";
$str="";

if(!is_null($productCode))
{
	$subcategory = '';
    //print "blah 1 blah 1";
    if($category == 1){
		$q=mysql_query("SELECT * FROM products WHERE PRODUCT_CODE='{$productCode}'");

		echo mysql_error();
		$myarray=array();

		while($nt=mysql_fetch_array($q)){
			if(is_null($findExistence)) {
				$prodID = $nt['PRODUCT_CODE'];
				$prodName = $nt['PRODUCT_NAME'];
				$subcategory = $prodName;
			}
			elseif($findExistence == 'TRUE'){
				$prodID = $nt['PRODUCT_CODE'];
				$subcategory = "'" . $prodID. "' EXISTS";
			}
		$str=$str . "\"$subcategory\"".",";
		//echo $str;
		}
	}elseif($category == 2){

		$q=mysql_query("SELECT * FROM services WHERE SERVICE_CODE='{$productCode}'");

		echo mysql_error();
		$myarray=array();

		while($nt=mysql_fetch_array($q)){
			if(is_null($findExistence)) {
				$prodID = $nt['SERVICE_CODE'];
				$prodName = $nt['SERVICE_NAME'];
				$subcategory = $prodName;
			}
			elseif($findExistence == 'TRUE'){
				$prodID = $nt['SERVICE_CODE'];
				$subcategory = "'" . $prodID. "' EXISTS";
			}
		$str=$str . "\"$subcategory\"".",";
		//echo $str;
		}

	}
}
elseif(!is_null($productName) && !is_null($findExistence) && $findExistence == 'TRUE'){

		if($category == 1){
			$q=mysql_query("SELECT * FROM products WHERE PRODUCT_NAME='{$productName}'");

			echo mysql_error();
			$myarray=array();

			while($nt=mysql_fetch_array($q)){
				$prodName = $nt['PRODUCT_NAME'];
				$subcategory = "'" . $prodName. "' EXISTS";

				$str=$str . "\"$subcategory\"".",";
				//echo $str;
			}
		}elseif($category == 2){

			$q=mysql_query("SELECT * FROM services WHERE SERVICE_NAME='{$productName}'");

			echo mysql_error();
			$myarray=array();

			while($nt=mysql_fetch_array($q)){
				$prodName = $nt['SERVICE_NAME'];
				$subcategory = "'" . $prodName. "' EXISTS";

				$str=$str . "\"$subcategory\"".",";
				//echo $str;
			}
		}
}

$str=substr($str,0,(strLen($str)-1)); // Removing the last char , from the string
echo "new Array($str)";

?>