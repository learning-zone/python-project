<?php
include("../connection.php");

$eid=$_POST['txtid'];
$jdate=isset($_REQUEST["datejoin"]) ? $_REQUEST["datejoin"] : "";
$name=$_POST['txtename'];
$add=$_POST['txtadd'];
$contact=$_POST['txtcno'];
$email=$_POST['txtmail'];
$dob=isset($_REQUEST["datedob"]) ? $_REQUEST["datedob"] : "";
$gender=$_POST['rdgen'];
$age=$_POST['txtage'];
$rel=$_POST['txtrel'];
$cast=$_POST['txtcast'];
$rem=$_POST['txtrmrk'];
$desig=$_POST['jtype'];
$pos=$_POST['txtjob'];
$bpay=$_POST['txtbp'];
$ta=$_POST['txtta'];
$da=$_POST['txtda'];
$hra=$_POST['txthra'];
if($gender==0)
{
$gen="Male";
}
else
{
$gen="Female";
}
//echo $gender;
mysql_query("insert into emp_details(vemp_id,demp_jdate,vemp_name,vemp_address,iemp_cno,vemp_email,demp_dob,vemp_gender,iemp_age,vemp_religion,vemp_cast,vemp_designation,iemp_jposition,vemp_jtype,femp_bp,femp_ta,femp_da,femp_hra) values('".$eid."','".$jdate."','".$name."','".$add."','".$contact."','".$email."','".$dob."','".$gen."','".$age."','".$rel."','".$cast."','".$desig."','".$pos."','".$rem."','".$bpay."','".$ta."','".$da."','".$hra."')");
echo "<script>alert('Data added successfully');window.location.href='addemp.php';</script>";

?>