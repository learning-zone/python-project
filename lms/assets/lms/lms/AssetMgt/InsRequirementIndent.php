<?php
session_start();
require("../db.php");
$dept = $_POST['dept'];
$agroup = $_POST['agroup'];
$adesc = $_POST['adesc'];
$qty = $_POST['qty'];
$user = $_POST['user'];
$college = $_POST['college'];
//Added by shashidhar on 02-06-2006 to avoid the entry of blank values
//******************************************************************
if($dept=="" || $agroup=="" || $adesc=="" || $qty=="")
{
	echo"<font color='red' size='3'><b>Enter the Proper Parameters ..!Cannot Save Details</b<br>";
	echo"<font color='blue' size='2'><a href=RequirementIndent.php><b>Go Back</b></a></font>";
	die();
}
//*******************************************************************
//------------------------------------MODIFIED BY ANURAJ_____________________
$today=date("Y-m-d");
$sql1=execute("select * from dept_no where dpt_id=$dept");
$sql2=fetcharray(execute("select * from college"));
$rs1=fetcharray($sql1);
$sql="insert into requirementindent(RDate,College,person,asset_id,quantity,dept_id) values('$today',";
$sql.=" '$sql2[col_code] ','$user',$adesc,$qty,$dept)";
$rs=execute($sql) or die(error_description());
$id=fetchInsertId();
$RiNo=$rs1["dept_code"].$id;
execute("update requirementindent set RINumber='$RiNo' where id=$id");
echo "<font color='blue' size='3'><b>Requirement Indent No is : ".$RiNo."</b></font><br>";

?>
