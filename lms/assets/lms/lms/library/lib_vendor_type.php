<?php
require_once("../db.php");
$Sel = $_POST['Sel'];
$button2 = $_POST['button2'];
$ty = $_POST['ty'];
$Type = $_REQUEST['Type'];
//print_r($_GET);
//print_r($_POST);

if(trim("$Type") == "add") {
if($ty == "" ){
die("Data could not be updated since Vendor Type is *NOT* mentioned");
}
$sql=execute("INSERT INTO lib_vendor_type(type) VALUES('" . $ty . "')");
//header("Location:view_lib_vendor_type.php");
echo "<META HTTP-EQUIV='Refresh' Content='0;URL=view_lib_vendor_type.php?msg=Added Successfully'>";
}
elseif(("$Type") == "modify"){
while( list(,$Value) = each($Sel) ){

$ty = $_POST[$Value."ty"];
$sql =execute(" UPDATE lib_vendor_type SET type='" . $ty . "' WHERE id=" .$Value );
}
//header("Location:view_lib_vendor_type.php");
echo "<META HTTP-EQUIV='Refresh' Content='0;URL=view_lib_vendor_type.php?msg=Updated Successfully'>";
}
elseif(("$Type")== "delete"){
while( list(,$Value) = each($Sel) ){
$sql = execute(" DELETE FROM lib_vendor_type WHERE id=" .$Value);
}
//header("Location:view_lib_vendor_type.php");
echo "<META HTTP-EQUIV='Refresh' Content='0;URL=view_lib_vendor_type.php?msg=Deleted Successfully'>";
}
?>
