<?php
session_start();
include("../../db.php");

$hostel = $_POST['hostel'];

$fee = $_POST['fee'];
$installment = $_POST['installment'];
$fee_amt = $_POST['fee_amt'];
$term = $_POST['term'];

$due_dd = $_POST['due_dd'];
$due_mm = $_POST['due_mm'];
$due_yy = $_POST['due_yy'];

$row = $_POST['row'];

$student = $_POST['student'];

$apply = $_POST['apply'];
 
$stud_id = $_POST['stud_id'];

/*
if($user=='')
{
	header("Location:login.php");
}
else
{
	$p_th=$_SERVER['SCRIPT_NAME'];
	$qry=execute("select * from usermenu where username='$user' and access='Yes' and linkpath='$p_th'");
	if(rowcount($qry)==0)
	{
		header("Location:login.php");
	}
}

*/
// THIS PART IS FOR APPLYING THE FEES BY HOSTEL STUDENTS.
if (isset($apply))
{
	//echo $fee;
//	echo "inside";
	while(list($key, $value) = each($student))
	{
		//echo "inside 2";
		$query  = "SELECT * FROM student_m WHERE id='$value'";
		//echo $value;
		$res1 = execute($query) or die("QUERY $query " . error_description());
		//echo $res1;
		if (rowcount($res1) == 0)
		{
			//echo $value;
			$query  = "SELECT * FROM additional_student WHERE student_id='$value'";
			$res1 = execute($query) or die("QUERY $query " . error_description());
			$row1 = fetcharray($res1);
			$stud_id = $row1["id"];
			mysql_free_result($res1);
		}
		else
		{
			$row1 = fetcharray($res1);
			$stud_id = $row1["id"];
			$term = $row1["academic_year"];
			mysql_free_result($res1);
		}

		while(list($ky,$val) = each($fee))
		{
			// DO NOT APPLY FEE IF THE FEE HAS NOT BEEN PAID.
			//$fee_amt = "fee_amt$val";
			//$fee_amt = $$fee_amt;
			$fee_amt = $_POST["fee_amt".$val];

			//$day_temp = "due_dd$val";
			//$day_temp = $$day_temp;
			$day_temp = $_POST["due_dd".$val];
			//$month_temp = "due_mm$val";
			//$month_temp = $$month_temp;
			$month_temp = $_POST["due_mm".$val];
			//$year_temp = "due_yy$val";
			//$year_temp = $$year_temp;
			$year_temp = $_POST["due_yy".$val];
			$due_date=$year_temp."-".$month_temp."-".$day_temp;

			//$inst = "installment$val";
			$inst = $_POST["installment".$val];

			//$term = "term$val";
            //$term = $$term;
			//$term = $_POST["term".$val];

			$query  = "SELECT * FROM hostel_fee_m WHERE id=$val";

			$res1 = execute($query) or die("QUERY $query " . error_description());
			$row1 = fetcharray($res1);
			$fee_id = $row1["fee_id"];
			mysql_free_result($res1);

			$query  = "SELECT * FROM fee_h_det WHERE stud_id=$stud_id AND fee_id=$fee_id AND ";
			$query .= "installment=$inst AND hostel_type='Y'";

			$res1 = execute($query) or die("QUERY $query " . error_description());
			if (rowcount($res1) == 0)
			{
//				echo $term;
				$sql  = "INSERT INTO fee_h_det (stud_id, fee_id, installment, amt, due_date, ";
				$sql .= "fee_amount, paid, hostel_type, academic_term) VALUES($stud_id, $fee_id, ";
				$sql .= "$inst, $fee_amt, '$due_date', $fee_amt,'No', 'Y', '$term')";
				execute($sql) or die("QUERY $sql " . error_description());
				$lst = 1;
			}
			else
			{
				$sql  = "UPDATE fee_h_det SET fee_amount=$fee_amt, due_date='$due_date', ";
				$sql .= "academic_term='$term' WHERE stud_id=$stud_id AND fee_id=$fee_id";
				execute($sql) or die("QUERY $sql " . error_description());
				$lst = 1;
			}
		}
		reset($fee);

		if($lst)
		{
			// FEES ALREADY APPLIED.
			$app++;
		}
		$lst = 0;
	}
	//echo "<DIV ALIGN='CENTER'>";
	//echo "Fees Applied Successfully !!</DIV>";
	?>
    <script type="text/javascript">
	alert("Fees Applied Successfully !!")
	</script>
    <?php
//	echo "<BR><DIV ALIGN='LEFT'><B>";
//	echo "Selected Fees applied to $app of $num_student Students !!</B></DIV>";
//	echo "<BR><DIV ALIGN='LEFT'><B>";
//	echo "The figure indicates a collective figure, all the fees might not have been applied ";
//	echo "to the above listed number of students. The reason being that the fees might already ";
//	echo "have been applied to that student !!</B></DIV>";
}
// ENDS HERE.

$mesg  = "<BR><BR><DIV ALIGN='CENTER' CLASS='LABEL'>";
$mesg .= "To Add the fee Amount to all students, Select the Hostel then click Apply button.";
$mesg .= "</DIV><HR>";
?>
<HTML>
<HEAD>
<TITLE>APPLY FEE BY HOSTEL</TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
function formSubmit(frm)
{
	if(document.frm.hostel.selectedIndex != 0)
	{
		document.frm.submit();
		return true;
	}
	else
	{
		alert("Please select a Hostel!!");
		return false;
	}
}
//-->
</SCRIPT>
</HEAD>
<BODY>
<CENTER>
<FORM METHOD="POST" ACTION="SelectFee.php" NAME="frm" onSubmit="return formSubmit(this.form)">
<TABLE CLASS="forumline" ALIGN="CENTER" CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="90%">
<TBODY>
<TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="3">APPLY FEE BY HOSTEL</TD></TR>
<TR>
	<TD align="LEFT">&nbsp;Hostel</TD>
	<TD align="LEFT"><SELECT NAME="hostel" SIZE="1">
		<OPTION VALUE="0">-- Select Hostel--</OPTION>
		<?php
		$query = "SELECT * FROM hostel_m";
		$rs = execute($query) or die("QUERY $query " . error_description());
		if (rowcount($rs) != 0)
		{
			while ($row = fetcharray($rs))
			{
				if ($row["id"] == $hostel)
					echo "<OPTION VALUE='$row[id]' SELECTED>$row[hostel_name]</OPTION>";
				else
					echo "<OPTION VALUE='$row[id]'>$row[hostel_name]</OPTION>";
			}
			mysql_free_result($rs);
		}
		?>
		</SELECT>
	</TD>
    </TBODY>
</TABLE>
<br>
    <div>
    <center>
	<INPUT TYPE="SUBMIT" NAME="<< SUBMIT >>" CLASS="bgbutton" VALUE="Submit">
    </center>
    </div>

<?=$mesg?>
<?
if ((!empty($hostel)) || ($hostel != 0))
{
	
	// FOR TAKING HOSTEL NAME
	$query  = "SELECT hostel_name FROM hostel_m WHERE id=$hostel";
	$rs = execute($query) or die("Select a Hostel");
	$row = fetcharray($rs);
	$HostelName = $row["hostel_name"];
	mysql_free_result($rs);
	// ENDS HERE.
	//echo $hostel;
	echo "<TABLE CLASS='forumline' CELLPADDING='0' CELLSPACING='0' BORDER='0' WIDTH='90%'>";
	echo "<TBODY>";
	echo "<TR><TD CLASS='head' WIDTH='90%' COLSPAN='5' ALIGN='CENTER'><B>APPLY FEE BY HOSTEL</B><TD></TR>";
	echo "<TR>";
		echo "<TD CLASS='rowpic' WIDTH='10%' ALIGN='CENTER'>Select</TD>";
		echo "<TD CLASS='rowpic' WIDTH='35%' ALIGN='CENTER'>Fees</TD>";
		echo "<TD CLASS='rowpic' WIDTH='15%' ALIGN='CENTER'>Amount (Rs.)</TD>";
		echo "<TD CLASS='rowpic' WIDTH='25%' ALIGN='CENTER'>Due Date</TD>";
		echo "<TD CLASS='rowpic' WIDTH='15%' ALIGN='CENTER'>Term</TD>";
	echo "</TR>";

	// FOR DISPLAYING THE FEES STRUCTURE FOR ACTUAL DATABASE,
	$sql  = "SELECT a.id, a.s_id, a.first_name, a.last_name, a.domain, b.student_id FROM ";
	$sql .= "h_stud_m a, student_m b WHERE a.h_id=$hostel AND a.archive='N' AND a.s_id=b.student_id";
	$result = execute($sql) or die("QUERY $sql " . error_description());

	//if (rowcount($result) != 0)
	{
		$query  = "SELECT a.*, b.fee_name FROM hostel_fee_m a, hostel_fee_type b WHERE ";
		$query .= "b.status=1 AND a.hostel_id=$hostel AND a.fee_id=b.fee_id ORDER BY ";
		$query .= "a.due_date";
//$query ="select fee_name from hostel_fee_type   where fee_id=7";
		$res1 = execute($query) or die("QUERY $query " . error_description());
		$i=0;
		while ($rw = fetcharray($res1))
		{
		  if($i%2)
               echo "        <tr class='clsname'> ";
               else
               echo "        <tr > ";
			   
			   $i++;
		  echo "<TD WIDTH='10%' ALIGN='CENTER'><INPUT TYPE='CHECKBOX' NAME='fee[]' VALUE='$rw[id]' CHECKED></TD>";
		  echo "<INPUT TYPE='HIDDEN' NAME='installment$rw[id]' VALUE='$rw[installment]'>";
		  if($rw["installment"] > 0)
			 $name = $rw["fee_name"] . " - Installment No. " . $rw["installment"] ;
		  else
			  $name = $rw["fee_name"] ;
		  echo "<TD WIDTH='20%' ALIGN='CENTER'>$name</TD>";
		  echo "<TD WIDTH='20%' ALIGN='CENTER'><INPUT TYPE='TEXT'  NAME='fee_amt$rw[id]' VALUE='$rw[amt]'>";
				$due_date=explode("-",$rw["due_date"]);
				$dd=$due_date[2];
				$mm=$due_date[1];
				$yy=$due_date[0];
			echo "<TD WIDTH='20%' ALIGN='CENTER'>";
			echo "<INPUT TYPE='TEXT' NAME='due_dd$rw[id]' VALUE='$dd' MAXLENGTH='2' SIZE='2'>-";
			echo "<INPUT TYPE='TEXT' NAME='due_mm$rw[id]' VALUE='$mm' MAXLENGTH='2' SIZE='2'>-";
			echo "<INPUT TYPE='TEXT' NAME='due_yy$rw[id]' VALUE='$yy' MAXLENGTH='4' SIZE='4'>";
			echo "</TD>";
			echo "<TD WIDTH='20%' ALIGN='CENTER'><INPUT TYPE='TEXT' NAME='term$rw[id]' SIZE='10'></TD>";
			echo "</TR>";
		}
		mysql_free_result($res1);
	}
	// ENDS HERE

$sql  = "SELECT id, s_id, first_name, last_name, domain FROM ";
	$sql .= "h_stud_m  WHERE h_id=$hostel AND archive='N' ";

	$result = execute($sql) or die("QUERY $sql " . error_description());
	echo "</TBODY>";
	echo "</TABLE>";

	echo "<BR><BR>";

	echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0' WIDTH='90%' CLASS='forumline'>";
	echo "<TBODY>";
	echo "<TR><TD COLSPAN='3' ALIGN='CENTER' CLASS='head' WIDTH='90%'>LIST OF STUDENTS OF $HostelName</TD></TR>";
	echo "<TR>";
		echo "<TD CLASS='row2' WIDTH='10%'>Select</TD>";
		echo "<TD CLASS='row2' WIDTH='40%'>Student ID</TD>";
		echo "<TD CLASS='row2' WIDTH='50%'>Student Name</TD>";
	echo "</TR></TBODY>";
	// FOR DISPLAYING THE LIST OF STUDENTS IN ACTUAL DATABASE.
	$sql  = "SELECT id, s_id, first_name, last_name, domain FROM ";
	$sql .= "h_stud_m  WHERE h_id=$hostel AND archive='N' ";
//	echo $hostel;
	$result = execute($sql) or die("QUERY $sql " . error_description());
	if (rowcount($result) != 0)
	{
		//echo "inside2" ;
		$num = rowcount($result);
		echo "<INPUT TYPE='HIDDEN' NAME='num_student' VALUE='$num'>";
		$i=0;
		while ($row = fetcharray($result))
		{
			//echo " inside3 " ;
            // echo $row ;
			echo "<INPUT TYPE='HIDDEN' NAME='domain$row[s_id]' VALUE='$row[domain]'>";
			if($i%2)
               echo "        <tr class='clsname'> ";
               else
               echo "        <tr > ";
			   $i++;
				echo "<TD WIDTH='10%' ALIGN='CENTER'><INPUT TYPE='CHECKBOX' NAME='student[]' VALUE='$row[s_id]'></TD>";
//echo "<TD WIDTH='20%' ALIGN='CENTER'>$row[student_id]</TD>";
		echo "<TD WIDTH='20%' ALIGN='CENTER'>$row[s_id]</TD>";
				echo "<TD WIDTH='60%' ALIGN='CENTER'>$row[first_name] $row[last_name]</TD>";
			echo "</TR>";
		}
		mysql_free_result($result);
	}
	// ENDS HERE.

	// FOR DISPLAYING THE LIST OF STUDENTS IN ADDITIONAL COLLEGES.
	$sql  = "SELECT a.id, a.s_id, a.first_name, a.last_name, a.domain, b.student_id FROM ";
	$sql .= "h_stud_m a, additional_student b WHERE a.h_id=$hostel AND a.archive='N' ";
	$sql .= "AND a.s_id=b.student_id";
	$result = execute($sql) or die("QUERY $sql " . error_description());
	if (rowcount($result) != 0)
	{
		$num += rowcount($result);
		echo "<INPUT TYPE='HIDDEN' NAME='num_student' VALUE='$num'>";
		while ($row = fetcharray($result))
		{
			echo "<INPUT TYPE='HIDDEN' NAME='domain$row[s_id]' VALUE='$row[domain]'>";
			echo "<TR>";
				echo "<TD><INPUT TYPE='CHECKBOX' NAME='student[]' VALUE='$row[s_id]' CHECKED></TD>";
				echo "<TD>$row[student_id]</TD>";
				echo "<TD>$row[first_name] $row[last_name]</TD>";
			echo "</TR>";
		}
		mysql_free_result($result);
	}
	// ENDS HERE.
	?>
</TBODY>
</TABLE>
<br>
<center>
<INPUT TYPE='SUBMIT' NAME='apply' VALUE='Apply Fees' CLASS='bgbutton'>
</center>
<INPUT TYPE='HIDDEN' NAME='hostel' VALUE='$hostel'>
<?php
}
?>
</FORM>
</CENTER>
</BODY>
</HTML>