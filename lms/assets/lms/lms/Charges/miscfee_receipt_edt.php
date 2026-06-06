<?php

echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";

session_start();
include("../db.php");

$user_name=$_SESSION['user'];

if($_POST)
{
   $id=$_POST['id'];
   $Sel=$_POST['Sel'];
   $m_id=$_POST['m_id'];   
   $c_id=$_POST['class'];
   $pdt = $_POST['pdt'];
   $pmt = $_POST['pmt'];
   $pyr = $_POST['pyr']; 
   $m_id = $_POST['m_id'];
   $bank = $_POST['bank']; 
   $ddno = $_POST['ddno'];
   $pydt = $_POST['pydt'];
   $pymt = $_POST['pymt'];
   $pyyr = $_POST['pyyr'];
   $amount = $_POST['amount'];
   $student_mID = $_POST['student_mID'];
   $paymenttype = $_POST['paymenttype'];
   $academic_year = $_POST['academic_year']; 
	
	
}
if($_GET)
{
   $id=$_REQUEST['id'];
   $Sel=$_REQUEST['Sel'];
   $Type=$_REQUEST['Type']; 
	
}

$receipt_no='MBIS'.'/'.date("dmY");

if(trim($Type) == "Add")
{

			
     $sql="INSERT INTO `fee_misc_collect_m` (`user_name`, `c_id`, `student_id`, `amount_date`, `remark`, `cancelled_date`,
	  `receipt_no`, `inserted_date`) VALUES ('$user_name', '$c_id', '$student_id', '$amount_date', '$remark', '$cancelled_date',
	  '$receipt_no', CURDATE())";
	  echo "<br>".$sql;
	   //$result=execute($sql) or die(mysql_error());
      if($result)
	  {
			$msg='Records Added';
			//echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_collect.php?msg=$msg'>";
	  }
	  else
	  {
			//echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_collect.php'>";
	  }
}

if(trim($Type) == "Mod")
{
    //echo "Inside Mod";
	for($i=0;$i<sizeof($Sel);$i++)
	{
		$val=$Sel[$i];
		
		//echo "Selected Values :".$val;
		
		$m_id = $_POST[$val.'m_id'];
		$c_id = $_POST[$val.'class'];		
		$amount = $_POST[$val.'amount'];
	
			
		$sql="UPDATE `fee_misc_collect_m` SET `m_id` = '$m_id', `c_id` = '$c_id', `amount` = '$amount'  WHERE `id` = '$val'";
	   
		echo "<br>".$sql;
	    //$result=execute($sql) or die(mysql_error());
	}
	  if($result)
	  {
		    $msg='Records Updated';
			//echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_collect.php?msg=$msg'>";
	  }
	  else
	  {
			//echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_collect.php'>";
	  }
}

if(trim($Type) == "Del")
{
      //echo "Inside Del";
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sql="UPDATE `fee_misc_collect_m` SET `status` = '0' WHERE `id` = '$val'";
		  //echo "<br>".$sql;
		  $result=execute($sql) or die(mysql_error());
	  }
		  
	  if($result)
	  {
		    $msg='Records Deleted';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_collect.php?msg=$msg'>";
	  }	
	  else
	  {
		    echo "<META HTTP-EQUIV='Refresh' Content='0;URL=miscfee_collect.php'>";
	  }
}
?>
