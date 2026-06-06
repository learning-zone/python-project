<?php
require_once("../db.php");
$Type=$_REQUEST['Type'];
$media=$_REQUEST['media'];
$acc_no=$_POST['acc_no'];
$id=$_POST['id'];
$library=$_POST['library'];
$register=$_POST['register'];
$author=$_POST['author'];
$rack=$_POST['rack'];
$title=$_POST['title'];
$source_acc_no=$_POST['source_acc_no'];
$acq_dd=$_POST['acq_dd'];
$acq_mm=$_POST['acq_mm'];
$acq_yy=$_POST['acq_yy'];
$key_word1=$_POST['key_word1'];
$key_word2=$_POST['key_word2'];
$key_word3=$_POST['key_word3'];
$key_word4=$_POST['key_word4'];
$key_word5=$_POST['key_word5'];
$sel=$_POST['sel'];
$sel1=$_POST['sel1'];
$sel2=$_POST['sel2'];
$cd_type=$_POST['cd_type'];
$mode=$_POST['mode'];
$remarks=$_POST['remarks'];
$accNo=$_POST['accNo'];
$modDet=$_POST['modDet'];
$media_type=$_POST['media_type'];
?>
<?php
$library_id = $library;
$accNo = $accNo;

if(($acq_dd !="00")||($acq_mm !="00")||($acq_yy !="0000"))
{
	if(!checkdate($acq_mm,$acq_dd,$acq_yy))
	{
		echo "Invalid Acquiring Date.";
		die("</td></tr></table>");
	}
}
$date_of_acquiring="$acq_yy-$acq_mm-$acq_dd";
$sql="update lib_cd_det set ";
$sql.=" title='$title',";

$sql.=" author='$author',";
$sql.=" rack='$rack',";
$sql.=" date_of_acquiring='$date_of_acquiring',";
$sql.=" source_acc_no='$source_acc_no',";
$sql.=" key_word1='$key_word1',";
$sql.=" key_word2='$key_word2',";
$sql.=" key_word3='$key_word3',";
$sql.=" key_word4='$key_word4',";
$sql.=" key_word5='$key_word5', ";
$sql.=" remarks='$remarks' ";

$sql.=" where id=$id";
//echo $sql;
 Execute($sql);
$value = explode(",",$sel);
		for($i=0;$i<sizeof($sel);$i++)
		{
			//$temp_mode = "mode".$sel[$i];
			//$temp_mode=$$temp_mode;
			$temp_mode = $_POST["mode".$sel[$i]];

			//$temp_type = "cd_type".$sel[$i];
			//$temp_type=$$temp_type;
			$temp_type = $_POST["cd_type".$sel[$i]];

			$temp_value=$sel[$i];
			$sql="update lib_cd_acc_det set mode='$temp_mode',cd_type='$temp_type',library=$library,register=$register where id=$temp_value";

			Execute($sql);
		}
	echo "<center>Records Updated Successfully </center>";	
	
?>

