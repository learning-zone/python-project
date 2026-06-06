<?php
require_once("../db.php");
$Sel = $_POST['Sel'];
$button2 = $_POST['button2'];
$na = $_POST['na'];
$ad = $_POST['ad'];
$te = $_POST['te'];
$em = $_POST['em'];
$ur = $_POST['ur'];
$re = $_POST['re'];
$button3 = $_POST['button3'];
$type = $_POST['type'];
$Type = $_REQUEST['Type'];

if(trim("$Type") == "add") {
if($type == "" || $na == "" ||$ad == "" || $te == ""){
die("Data could not be updated since Vendor Details is *NOT* mentioned");
}
$sql= execute("INSERT INTO lib_vendor_m (type,name,address,telephone,email,url,remark) VALUES(" . $type . ",'" . $na . "','" . $ad . "','" . $te . "','" . $em . "','" . $ur . "','" . $re . "')");
//header("Location:view_lib_vendor_m.php");
echo "<META HTTP-EQUIV='Refresh' Content='0;URL=view_lib_vendor_m.php?msg=Added Successfully'>";
}
elseif(trim("$Type") == "modify"){
while( list(,$Value) = each($Sel) )
{
$name = $_POST[$Value."na"];
$address = $_POST[$Value."ad"];
$te=$_POST[$Value."te"];
$em = $_POST[$Value."em"]; 
$re = $_POST[$Value."re"];
$type = $_POST[$Value."ty"];
$ur =$_POST[$Value."ur"];
$sql = " UPDATE lib_vendor_m SET type=".$type.",name='" .$name. "',address = '" .$address. "',telephone = '" .$te. "',email = '" .$em. "',url='".$ur."',remark = '".$re."'";
$sql .= " WHERE id=" . $Value ;
execute($sql);
}
//header("Location:view_lib_vendor_m.php");
echo "<META HTTP-EQUIV='Refresh' Content='0;URL=view_lib_vendor_m.php?msg=Updated Successfully'>";
}
elseif(trim("$Type")== "delete"){
while( list(,$Value) = each($Sel) ){
$sql ="DELETE FROM lib_vendor_m WHERE id=". $Value;
execute($sql);
}
//header("Location:view_lib_vendor_m.php");
echo "<META HTTP-EQUIV='Refresh' Content='0;URL=view_lib_vendor_m.php?msg=Deleted Successfully'>";
}
?>

