<html>
<head>
</head>
<body>
<?php
session_start();
require("../db.php");
$RIN = $_POST['RIN'];
$quantity = $_POST['quantity'];
$unitprice = $_POST['unitprice'];
$totalprice = $_POST['totalprice'];
$vendor_id = $_POST['vendor_id'];
$QuotNo = $_POST['QuotNo'];
$QuotDay = $_POST['QuotDay'];
$QuotMon = $_POST['QuotMon'];
$QuotYear = $_POST['QuotYear'];
$asset_id = $_POST['asset_id'];
//----------Added By shashidhar on 02-06-2006--------
if($unitprice=="" || $quantity=="" || $vendor_id=="" || $QuotNo=="")
{
	echo"<font color='red' size=''3'><b>Enter The Proper Parameters..!Cannot Save Details</b></font><br>";
	echo"<font color='blue' size='2'><a href=Quotation.php><b>Go Back</b></a></font>";
	die();
}
//-------------------------------------------------------------------


?>

<?php
$today="$QuotYear-$QuotMon-$QuotDay";
$sql="insert into quotation(QuotNo,QuotDate,RID,unitprice,quantity,total_price,asset_id,vendor_id) ";
$sql.="values('$QuotNo','$today','$RIN','$unitprice','$quantity','$totalprice','$asset_id','$vendor_id')";
//echo $sql;
$rs=execute($sql) or die(error_description());

echo "<font color=blue><b>Quotation Details of $QuotNo Entered !!</b></font>";

?>
</body>
</html>
