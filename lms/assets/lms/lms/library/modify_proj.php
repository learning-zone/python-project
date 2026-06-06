<?php
require_once("../db.php");
$media=$_REQUEST['media'];
$acc_no=$_POST['acc_no'];
$library=$_POST['library'];
$register=$_POST['register'];
$author=$_POST['author'];
$rack=$_POST['rack'];
$title=$_POST['title'];
$call_no=$_POST['call_no'];
$college=$_POST['college'];
$year=$_POST['year'];
$no_of_pages=$_POST['no_of_pages'];
$course=$_POST['course'];
$class_name=$_POST['class_name'];
$acq_dd=$_POST['acq_dd'];
$acq_mm=$_POST['acq_mm'];
$acq_yy=$_POST['acq_yy'];
$guide_name=$_POST['guide_name'];
$key_word1=$_POST['key_word1'];
$key_word2=$_POST['key_word2'];
$key_word3=$_POST['key_word3'];
$key_word4=$_POST['key_word4'];
$key_word5=$_POST['key_word5'];
$sel=$_POST['sel'];
$sel1=$_POST['sel1'];
$sel2=$_POST['sel2'];
$id=$_POST['id'];
$mode=$_POST['mode'];
$book_type=$_POST['book_type'];
$remarks=$_POST['remarks'];
$modDet=$_POST['modDet'];
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
$sql="update lib_project_report_det set ";
$sql.=" title='$title',";
$sql.=" call_no='$call_no',";

$sql.=" author='$author',";

$sql.=" college='$college',";

$sql.=" year='$year',";
$sql.=" rack='$rack',";

$sql.=" no_of_pages='$no_of_pages',";
$sql.=" date_of_acquiring='$date_of_acquiring',";
$sql.="guide_name='$guide_name',";
$sql.="class_name='$class_name',";
$sql.="course='$course',";
$sql.=" key_word1='$key_word1',";
$sql.=" key_word2='$key_word2',";
$sql.=" key_word3='$key_word3',";
$sql.=" key_word4='$key_word4',";
$sql.=" key_word5='$key_word5', ";
$sql.=" remarks='$remarks' ";

$sql.=" where id=$id";
//echo $sql;
execute($sql);
$value = explode(",",$sel);
		for($i=0;$i<sizeof($sel);$i++)
		{
			//$temp_mode = "mode".$sel[$i];
			//$temp_mode=$$temp_mode;
			$temp_mode = $_POST["mode".$sel[$i]];

			//$temp_type = "book_type".$sel[$i];
			//$temp_type=$$temp_type;
			$temp_type = $_POST["book_type".$sel[$i]];

			$temp_value=$sel[$i];
			$sql="update lib_proj_acc_det set mode='$temp_mode',book_type='$temp_type',library=$library,register=$register where id=$temp_value";

			execute($sql);

		}
		echo "<center>Records Updated Successfully </center>";		
?>
