<?php
session_start();
require("../db.php");

$rindent = $_POST['rindent'];
$checkid = $_POST['checkid'];
$id = $_POST['id'];

//----------Adde By Shashidhar on 02-06-2006-----
if($id=="")
{
echo"<font color='red' size='3'><b>Please Select radio button for Process</b></font><br>";
echo"<font color='blue' size='2'><a href=ProcessQuotations.php><b>Go Back</b></a></font>";
die();
}
//------------------------------------------
execute("update quotation set status='Processed' where id=$checkid") or die(error_description());

$sql1=execute("select * from quotation where id=$checkid");
$rs1=fetcharray($sql1) or die(error_description());

execute("update requirementindent set quotation_status='YES' where id=$rindent") or die(error_description());

echo "<font color=brown><b>Quotation No : $rs1[QuotNo] is successfully processed !!</b></font>";

?>
