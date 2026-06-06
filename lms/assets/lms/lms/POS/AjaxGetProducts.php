<?
$prodID =$_GET['prodID'];

//echo $prod_id_ref2ndLevel;

require "includes/dbconnect.php";// connection to database
require "includes/functions.php";
$str="";

if(!is_null($prodID))
{
    //print "blah 1 blah 1";
	$q=mysql_query("SELECT PRODUCT_NAME FROM products WHERE PRODUCT_CODE = '{$prodID}'");

	echo mysql_error();
	$myarray=array();

	$nt=mysql_fetch_array($q);
	$prodName = $nt['PRODUCT_NAME'];

	$str=$str . "\"$prodName\"".",";
}

$str=substr($str,0,(strLen($str)-1)); // Removing the last char , from the string
echo "new Array($str)";

//echo $result;

?>