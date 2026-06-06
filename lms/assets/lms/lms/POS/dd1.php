<?
$productDescription =$_GET['productDescription'];
$orgID = $_GET['orgID'];

//echo $prod_id_ref2ndLevel;

require "includes/dbconnect.php";// connection to database
require "includes/functions.php";
$str="";

if(!is_null($productDescription))
{
    //print "blah 1 blah 1";
    $queryStr = "SELECT * FROM products WHERE PRODUCT_NAME LIKE '%{$productDescription}%'";
	$q=mysql_query($queryStr);

	echo mysql_error();
	//$myarray=array();


	while($nt=mysql_fetch_array($q)){
		$prodCode = $nt['PRODUCT_CODE'];
		$prodName = $nt['PRODUCT_NAME'];
		//$subcategory = $prodName;

		//$str=$str . $subcategory;
		//$str1 = "<strong>". $prodCode . "</strong> <i>";
        $str2 = "<i>" . $prodName . "</i> <br>";

		$str = $str . $str2;
	}
	//$str=$queryStr;
}


//$str=substr($str,0,(strLen($str)-1)); // Removing the last char , from the string
//echo "new Array($str)";
echo $str;

?>