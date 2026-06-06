<?php


session_start();
require("../../db.php");

// VARIABLE DECLARATION
//print_r($_POST);
//echo "<br>";
if($_POST)
{
	$hostel = $_POST['hostel'];
	$id = $_POST['id'];
	$stud_id = $_POST['stud_id'];
	$register_no = $_POST['register_no'];
	$name = $_POST['name'];
	$course_id = $_POST['course_id'];
	$crs = $_POST['crs'];
	$year_id = $_POST['year_id'];
	$yr = $_POST['hostel'];
	$hostel = $_POST[''];
	$save_rc = $_POST['save_rc'];
	$accno = $_POST['accno'];
	$rcno = $_POST['rcno'];
	$comp_no = $_POST['comp_no'];

	$fee = $_POST['fee'];
	$sel1 = $_POST['sel1'];
	$ledger = $_POST['ledger'];
	$sel = $_POST['sel'];
	$amt = $_POST['amt'];
	$tot = $_POST['tot'];
	$payment = $_POST['payment'];
	$bank = $_POST['bank'];
	$branch = $_POST['branch'];
	$instr_no = $_POST['instr_no'];
	
	$date4 = $_POST['date4'];
$date4 = date("Y-m-d", strtotime($date4));
$date3 = $_POST['date3'];
$date3 = date("Y-m-d", strtotime($date3));
	
	$instr_amt = $_POST['instr_amt'];
	$remark = $_POST['remark'];
	$save = $_POST['save'];
}
$cashier_id = $user;

$flag = 0;

$amt = 0;

// ENDS HERE.
//echo "here";
//echo $payment;
if (empty($id))
{
	echo "<DIV ALIGN='CENTER'>";
	echo "Message 1: ID is not Coming !!</DIV>";
	die();
}

/*
if(!checkdate($EMon,$EDay,$EYear))
{
	echo "<DIV ALIGN='CENTER'>";
	echo "Message 2: Invalid Paid Date !!</DIV>";
	die();
}
*/

//$rc = "$EYear-$EMon-$EDay";
$temp_p = explode("-", $payment);
$payment = $temp_p[1];
$pay_id = $temp_p[0];

echo $payment;
echo $pay_id;
echo $temp_p[0];

if($pay_id==CASH)
{
	$pay_id = 0;
}
else if($pay_id == CHEQUE)
{
	$pay_id = 1;
}
else
{
	$pay_id = 2;
}

//echo $pay_id;


if(strtoupper($payment) == "CHEQUE" || strtoupper($payment) == "DD")
{
	if ((empty($bank))	|| (empty($instr_no)))
	{
		echo "<DIV ALIGN='CENTER'>";
		echo "Message 3: Invalid Bank Name / Cheque / DD Number !!</DIV>";
		die();
	}

	if(!checkdate($EMon1,$EDay1,$EYear1))
	{
		echo "<DIV ALIGN='CENTER'>";
	  echo "Message 4: Invalid Cheque / DD Date !!</DIV>";
		die();
	}
	
	//$date1 = "$EYear1-$EMon1-$EDay1";
	$status = "P";
	$sql  = "INSERT INTO doc_instr(doc_id, instr_id, instr_no, instr_dt, amt, status,";
	$sql .= "bank_name, branch_name) VALUES('$date3', $pay_id, '$instr_no', '$date4', ";
	$sql .= "$instr_amt, 'P', '$bank', '$branch')";
	
	execute($sql) or die("INSERT QUERY 1 $query " . error_description());
}

// CHECKING THE CHALLAN NUMBER IS ALREADY PRESENTED OR NOT.
$query  = "SELECT doc_id FROM doc_m WHERE doc_id='$rcno'";
$rs = execute($query) or die("QUERY $query " . error_description());

  if (rowcount($rs) != 0)
{
	echo "<DIV ALIGN='CENTER'>";
	echo "Message 5: Challan $rcno already used !!</DIV>";
	die();
}

$count = $rcno;

// ENDS HERE.

// CHECKING THE RECEIPT_NO NUMBER IS ALREADY PRESENTED OR NOT.

$query1  = "SELECT comp_no FROM doc_m WHERE comp_no='$comp_no'";
$rs1 = execute($query1) or die("QUERY $query " . error_description());

if (rowcount($rs1) != 0)
{
	echo "<DIV ALIGN='CENTER'>";
	echo "Message 5: Receipt $comp_no already used !!</DIV>";
	die();
}

$count1 = $comp_no;

// ENDS HERE.

if(strtoupper($payment) == "CASH")

					$status = "C";

else if($payment == "Advance Fee")

					$status = "A";
//echo "hi";
//echo $sel;
if (sizeof($sel) != 0)
{
	//echo "inside";
	$jj=0;
	$x=0;
	while(list($key, $value) = each($sel))
	{
		$temp1 = "fee$value";
		$temp2 = "amt$value";
		
		$query  = "SELECT * FROM fee_h_det WHERE id=$value";
		
		$rs = execute($query) or die("QUERY $query " . error_description());

		if (rowcount($rs) != 0)
		{
			while ($row = fetcharray($rs))
			{
					$stud_id1 = $row["stud_id"];

					$fee_id = $row["fee_id"];

					$hostel_type = $row["hostel_type"];

					$actual_fee_amt = $row["amt"];

					$academic_term = $row["academic_term"];

					$fee_amount = $row["fee_amount"];

					$due_date = $row["due_date"];
			}

					mysql_free_result($rs);
		}

					$value1 = $fee_id;

					$jj++;

if(!$flag)

{
					$feeName = $$temp1;

					$feeAmt  = $$temp2;

					$flag    = 1;

					$amt     = $$temp2;

}

else
{
					$feeName .= "," . $$temp1;

					$feeAmt  .= "," . $$temp2;

					$amt     += $$temp2;
}

					$temp = $$temp2;
					//echo $temp;

					$temp_value=doubleval($actual_fee_amt) - doubleval($temp);

if($temp_value < 0)

					$temp_amt = $actual_fee_amt;  //IF THE FEE PAYING IS GREATER THEN THE ACTUAL FEE

else

					$temp_amt = $temp;  // IF THE FEE PAYING IS LESS OR EQUAL.
					
					//echo $temp_amt;
					//echo "hi";


					$query  = "INSERT INTO doc_amt (doc_id, fee_id, amt, hostel_type, academic_term) ";

					$query .= "VALUES('$rcno', $value1, $instr_amt, '$hostel_type', '$academic_term')";

					execute($query) or die("QUERY $query " . error_description());

if ($actual_fee_amt == $temp)

{
					$query  = "UPDATE fee_h_det SET paid='Yes', doc_id='$rcno' WHERE id=$value";

					execute($query) or die("QUERY $query " . error_description());
}

else

{

					$TotFeeAmt = $actual_fee_amt - $temp;

					$query  = "UPDATE fee_h_det SET paid='Yes', amt=$instr_amt WHERE id=$value";

					execute($query) or die("QUERY $query " . error_description());

if ($TotFeeAmt > 1)	// IF PAID AMOUNT IS LESS THAN THE ACTUAL AMOUNT <.

{

					$query  = "INSERT INTO fee_h_det (stud_id, fee_id, amt, due_date, paid, ";

					$query .= "fee_amount, doc_id, hostel_type, academic_term) VALUES(";

					$query .= "$stud_id1, $fee_id, $instr_amt, '$due_date', 'No', $fee_amount, ";

					$query .= "'$rcno', '$hostel_type', '$academic_term')";

					execute($query) or die("QUERY $query " . error_description());

}

else	// IF PAID AMOUNT IS GREATER THAN THE ACTUAL AMOUNT - EXCESS AMOUNT.

{

					$query  = "SELECT * FROM advance_fee WHERE stud_id=$stud_id1 ORDER BY id DESC LIMIT 0,1";

					$rs = execute($query) or die("QUERY $query "  . error_description());

					$row = fetcharray($rs);

// IF THE STUDENT IS ALREADY PAID THE ADVANCE FEE THEN GET THE CLOSING BALANCE

// OF THE ADVANCE FEE ACCOUNT.

					$advance_fee_amt = $temp - $actual_fee_amt;

					$balance = $row["balance"];

					$AccBalance = $advance_fee_amt + $balance;

if ($hostel_type == "N")

					$sql  = "SELECT fee_name FROM fee_type WHERE fee_id=$fee_id";

else

					$sql  = "SELECT fee_name FROM hostel_fee_type WHERE fee_id=$fee_id";

					$res = execute($sql) or die("QUERY $sql " . error_description());

					$rw = fetcharray($res);

					$remarks = "Advance Fee From $rw[fee_name] Head ";

					mysql_free_result($res);

					$ReceiptDate = $date3;

					$query  = "INSERT INTO advance_fee(stud_id, particulars, type, amount, ";

					$query .= "transdate, balance, receipt_no) VALUES($stud_id1, '$remarks', ";

					$query .= "'CREDIT', $advance_fee_amt, '$ReceiptDate', $AccBalance,'$rcno')";

					execute($query) or die("QUERY $query " . error_description());
			}

	}

					$x++;

	}


					$sql  = "INSERT INTO doc_m(doc_id, doc_status, mode_id, doc_amt, cashier_id, stud_id, ";

					$sql .= "remark, doc_type, print_org, print_dup, doc_date, comp_no,course_id, year_id) VALUES(";

					$sql .= "'$rcno', '$status', $pay_id, $instr_amt, '$cashier_id', $id, '$remark', 'R', 1, 0, ";

					$sql .= "'$date3', $comp_no,$course_id, $year_id)";

					execute($sql) or die("QUERY $sql " . error_description());
}




//}

					echo "<DIV ALIGN='CENTER'>";

					echo "";

					echo "MESSAGE 6: The generated receipt no. $rcno and $comp_no has been saved successfully !!</DIV>";
?>