<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
session_start();
require_once("../db.php");
if($_GET)
{
	$Type=$_REQUEST['Type'];
	$action=$_REQUEST['action'];
	
}
if($_POST)
{
	$media=$_POST['media'];
	$id=$_POST['id'];
	$library=$_POST['library'];
	$accNo=$_POST['accNo'];
	$media_type=$_POST['media_type'];
	$register=$_POST['register'];
	$title=$_POST['title'];
	$class_no=$_POST['class_no'];
	$book_no=$_POST['book_no'];
	$author=$_POST['author'];
	$author_details=$_POST['author_details'];
	$publisher=$_POST['publisher'];
	$edition=$_POST['edition'];
	$year=$_POST['year'];
	$rack=$_POST['rack'];
	$purchase_type=$_POST['purchase_type'];
	$supplier=$_POST['supplier'];
	$no_of_pages=$_POST['no_of_pages'];
	$pyment_type=$_POST['pyment_type'];
	$payment_details=$_POST['payment_details'];
	$bill_no=$_POST['bill_no'];
	$bill_dd=$_POST['bill_dd'];
	$bill_mm=$_POST['bill_mm'];
	$bill_yy=$_POST['bill_yy'];
	$acq_dd=$_POST['acq_dd'];
	$acq_mm=$_POST['acq_mm'];
	$acq_yy=$_POST['acq_yy'];
	$price_type=$_POST['price_type'];
	$price=$_POST['price'];
	$isbn=$_POST['isbn'];
	$subject=$_POST['subject'];
	$key_word1=$_POST['key_word1'];
	$key_word2=$_POST['key_word2'];
	$key_word3=$_POST['key_word3'];
	$key_word4=$_POST['key_word4'];
	$key_word5=$_POST['key_word5'];
	$sel=$_POST['sel'];
	$sel1=$_POST['sel1'];
	$sel2=$_POST['sel2'];
	$mode=$_POST['mode'];
	$book_type=$_POST['book_type'];
	$acc_no=$_POST['acc_no'];
	$remarks=$_POST['remarks'];
	$SeekPos=$_POST['SeekPos'];
	$PAGES=$_POST['PAGES'];
	$modDet=$_POST['modDet'];
	$LAST=$_POST['LAST'];
	
}
     
$library_id = $library;
$accNo = $accNo;
$bill_date=$bill_yy."-".$bill_mm."-".$bill_dd;
$date_of_acquiring=$acq_yy."-".$acq_mm."-".$acq_dd;

$var=preg_split("/(\d+)/", $accNo, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE); //split string into string and integer

if($var[0]=='P') //PYP LIBRARY BOOK
{
	//$library=1;
	$register=1;
	$accNo=$var[1];	
}
elseif($var[0]=='PT') //PYP TEXT BOOK
{
	//$library=1;
	$register=3;
	$accNo=$var[1];
}
elseif($var[0]=='M') //MYP LIBRARY BOOK
{	
	//$library=2;
	$register=2;
	$accNo=$var[1];
}
elseif($var[0]=='MT') //MYP TEXT BOOK
{
	//$library=2;
	$register=4;
	$accNo=$var[1];	
}

$sql="update lib_book_details set ";
$sql.=" title='{$title}',";
$sql.=" class_no='$class_no',";
$sql.=" book_no='$book_no',";
$sql.=" author='{$author}',";
//$sql.=" author_details='$author_details',";
$sql.=" publisher='$publisher',";
$sql.=" edition='$edition',";
$sql.=" year='$year',";
$sql.=" rack='$rack',";
//$sql.=" purchase_type='$purchase_type',";
$sql.=" supplier='$supplier',";
$sql.=" no_of_pages='$no_of_pages',";
//$sql.=" pyment_type='$pyment_type',";
//$sql.=" payment_details='$payment_details',";
$sql.=" bill_no='$bill_no',";
$sql.=" bill_date='$bill_date',";
$sql.=" date_of_acquiring='$date_of_acquiring',";
//$sql.=" price_type='$price_type',";
$sql.=" price='$price',";
$sql.=" isbn='$isbn',";
$sql.=" subject='{$subject}',";
$sql.=" key_word1='{$key_word1}',";
$sql.=" key_word2='{$key_word2}',";
$sql.=" key_word3='{$key_word3}',";
$sql.=" key_word4='{$key_word4}',";
$sql.=" key_word5='{$key_word5}',";
$sql.=" remarks='$remarks'";
$sql.=" where id=$id";

//echo "<BR>".$sql;

//die();

  $result = execute($sql) or die(mysql_error());
  //execute($sql);
  
$value = explode(",",$sel);
//echo $value."<br>".$sel;
for($i=0;$i<sizeof($sel);$i++)
{
	$temp_mode = $_POST['mode'.$sel[$i]];

	//$temp_type = "book_type".$sel[$i];
	//$temp_type=$$temp_type;
	$temp_type = $_POST['book_type'.$sel[$i]];

	$temp_value=$sel[$i];

	if($temp_mode=='W')
	{
		//$sqlUpdateW="update lib_acc_details set mode='$temp_mode',book_status=2,acc_no='$sel1[$i]',call_no='$sel2[$i]',book_type='$temp_type',register='$register' where id=$temp_value";
		$sqlUpdateW="UPDATE lib_acc_details SET mode='$temp_mode',book_status=2,call_no='$sel2[$i]',book_type='$temp_type',register='$register' where id=$temp_value";
		//echo "<BR>".$sqlUpdateW;

		$resultUpdateW = execute($sqlUpdateW);
	}
	else
	{
		//$sqlUpdate="update lib_acc_details set mode='$temp_mode',acc_no='$sel1[$i]',call_no='$sel2[$i]',book_type='$temp_type',register='$register' where id=$temp_value";
		
		$sqlUpdate="UPDATE lib_acc_details SET mode='$temp_mode',call_no='$sel2[$i]',book_type='$temp_type',register='$register' where id=$temp_value";
		//echo "<BR>".$sqlUpdate;

	    $resultUpdate = execute($sqlUpdate);
	}
	
	   
}

	//header("Location:modifyMediaDet.php?accNo=$accNo&SeekPos=$SeekPos&media_type=1&library=$library&dismsg='Updated successfully'");
/*	if($resultUpdateW || $resultUpdate)
	{
		$msg="Updated Sucessfully";	
		echo "<META http-equiv='refresh' content='0;URL=modifyMediaDet.php?msg=$msg&accNo=$accNo'>";
	
	}*/
	echo "<p align=center>Records Updated</p>";

?>
