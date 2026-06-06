<?php
include("../connection.php");
$esi=$_GET["q"];
$pf=$_GET["p"];
$bpay=$_GET["r"];
$da=$_GET["s"];
$oall=$_GET["t"];
$wd=$_GET["u"];
$ab=$_GET["v"];
$ps=$wd-$ab;
//$ttol=number_format($tot,2);
$sal=$bpay/$wd;
$sded=$sal*$ab;
$tot=$esi+$pf+$sded;
$tots=($sal*$ps)+$pf+$esi+$da+$oall;
$nsal=($sal*$ps)+$da+$oall;
$tot=number_format($tot,2);
echo "<input name=txttotded type=text value='$tot' readonly/>";
?>