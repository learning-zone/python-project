<html>
<HEAD>
</HEAD>
<BODY>
<?php
require("../db.php");
?>
<?php
$library_id = $library;
$accNo = $accNo;

if(($acq_dd !="00")||($acq_mm !="00")||($acq_yy !="0000"))
{
	if(!checkdate($acq_mm,$acq_dd,$acq_yy))
	{
		echo "<font color=royalblue;><b>Invalid Acquiring Date.</b> </font>";
		die("</td></tr></table>");
	}
}
$date_of_acquiring="$acq_yy-$acq_mm-$acq_dd";

if(($pub_dd !="00")||($pub_mm !="00")||($pub_yy !="0000"))
{
	if(!checkdate($pub_mm,$pub_dd,$pub_yy))
	{
		echo "<font color=royalblue;><b>Invalid Publication  Date.</b> </font>";
		die("</td></tr></table>");
	}
}
$publication_date = "$pub_yy-$pub_mm-$pub_dd";

$sql="update lib_cd_det set ";
$sql.=" title='$title',";
$sql.=" source='$source',";

$sql.=" month='$month',";
$sql.=" year='$year',";
$sql.=" volume='$volume',";
$sql.=" issue='$issue',";
$sql.=" rack='$rack',";
$sql.=" date_of_acquiring='$date_of_acquiring',";
$sql.=" publication_date='$publication_date',";
$sql.=" price='$price',";
$sql.=" key_word1='$key_word1',";
$sql.=" key_word2='$key_word2',";
$sql.=" key_word3='$key_word3',";
$sql.=" key_word4='$key_word4',";
$sql.=" key_word5='$key_word5', ";
$sql.=" remarks='$remarks' ";

$sql.=" where id=$id";
echo $sql;
execute($sql);
$value = explode(",",$sel);
		for($i=0;$i<sizeof($sel);$i++)
		{
			$temp_mode = "mode".$sel[$i];

			$temp_mode=$$temp_mode;

			$temp_type = "cd_type".$sel[$i];

			$temp_type=$$temp_type;

			$temp_value=$sel[$i];
			$sql="update lib_cd_acc_det set mode='$temp_mode',cd_type='$temp_type',library=$library,register=$register where id=$temp_value";

			execute($sql);

		}
		header("Location:modify_other_cd_det.php?acc_no=$acc_no");

?>
</BODY>
</HTML>

