<?php

session_start();
include("../../db.php");

$apply = $_POST['apply'];
$modify = $_POST['modify'];
$delete = $_POST['delete'];


$hostel = $_POST['hostel'];
$action = $_REQUEST['action'];


//echo $hostel;
if ($hostel == 0)
{
	echo "<DIV ALIGN='CENTER'><FONT  SIZE='2'><B>";
	echo "Select the Hostel !!</B></FONT></DIV>";
}

// THIS PART IS FOR APPLYING THE FEES IN TABLE.
if (isset($apply))
 { 
 echo "hello";
    $array1=gettype($fee);
	if($array1=='array')
	{
		while(list($key, $value) = each($fee))
		{
			//$temp = "fee_amt$value";
			$amt = $_POST["fee_amt".$value];
	
			if(strlen($amt) == 0)
			{
				echo "<DIV ALIGN='CENTER'><FONT  SIZE='2'><B>";
				echo "Enter Fee Amount !!</B></FONT></DIV>";
				die();
			}
			//$due_dd="due_dd$value";
			//$due_dd=$$due_dd;
			//$due_mm="due_mm$value";
			//$due_mm=$$due_mm;
			//$due_yy="due_yy$value";
			//$due_yy=$$due_yy;
			
			$due_dd = $_POST["due_dd".$value];			
			$due_mm = $_POST["due_mm".$value];			
			$due_yy = $_POST["due_yy".$value];
			
			if(!checkdate($due_mm,$due_dd,$due_yy))
			{
				echo "<DIV ALIGN='CENTER'><FONT  SIZE='2'><B>";
				echo "Invalid Date !!</B></FONT></DIV>";
				die();
			}
			$dt=$due_yy."-".$due_mm."-".$due_dd;
	
			//$inst = "installment$value";
			//$inst = $$inst;
			$amt = $_POST["installment".$value];
	
			//$term = "term$value";
			$term = $_POST["term".$value];
			$academic_term = $term;
	
			$query  = "SELECT * FROM hostel_fee_m WHERE id=$value";
			$rs = execute($query) or die("QUERY $query " . error_description());
			$row = fetcharray($rs);
			$fee_id = $row["fee_id"];
			mysql_free_result($rs);
	
			$query  = "SELECT * FROM fee_det WHERE stud_id=$id AND fee_id=$fee_id AND paid='NO' ";
			$query .= "AND installment=$inst AND hostel_type='Y'";
			$rs = execute($query) or die("QUERY $query " . error_description());
			if (rowcount($rs) != 0)
			{
				echo "<DIV ALIGN='CENTER'><FONT  SIZE='2'><B>";
				echo "Fee Details already applied !!</B></FONT></DIV>";
			}
			else
			{
				if	(($inst == 0) || ($inst == ""))
				{
					$query  = "INSERT INTO fee_det (stud_id, fee_id, amt, due_date, fee_amount, ";
					$query .= "hostel_type, academic_term) VALUES($id, $fee_id, $amt, '$dt', $amt, ";
					$query .= "'Y', '$academic_term')";
					execute($query) or die("QUERY $query " . error_description());
				}
				else
				{
					$query  = "INSERT INTO fee_det (stud_id, fee_id, amt, installment, due_date, ";
					$query .= "fee_amount, hostel_type, academic_term) VALUES($id, $fee_id, ";
					$query .= "$amt, $inst, '$dt', $amt, 'Y', '$academic_term')";
					execute($query) or die("QUERY $query " . error_description());
				}
			}
		}
		echo "<DIV ALIGN='CENTER'><FONT  SIZE='2'><B>";
		echo "Fees Applied Successfully !!</B></FONT></DIV>";
      }
	  else
	  {?>
	  <script language="javascript">
	     alert("Please Select The Fee Name");
	  </script>
	 <?php }
	}
// ENDS HERE.

// THIS PART IS FOR MODIFYING THE FEE DETAILS IN TABLE.
if (isset($modify))
{
	 
    $array1=gettype($sel);
	if($array1=='array')
	{
		while(list($key, $value) = each($sel))
		{
			$temp = "amt$value";
			$amt = $$temp;
	
			$day_temp = "dd_due$value";
			$day_temp = $$day_temp;
			$month_temp = "mm_due$value";
			$month_temp = $$month_temp;
			$year_temp = "yy_due$value";
			$year_temp = $$year_temp;
			$due = $year_temp."-".$month_temp."-".$day_temp;

			$term = "term$value";
			$term = $$term;
	
			$query  = "UPDATE fee_det SET amt=$amt, due_date='$due', academic_term='$term' WHERE id=$value";
			execute($query) or die("QUERY $query " . error_description());
		}
		echo "<DIV ALIGN='CENTER'><FONT  SIZE='2'><B>";
		echo "Details Modified Successfully !!</B></FONT></DIV>";
	}
    else
	  {?>
	  <script language="javascript">
	     alert("Please Select The Fee Name");
	  </script>
	 <?php }
}
// ENDS HERE.

//THIS PART IS FOR DELETING THE FEE DETAILS IN TABLE.
if (isset($delete))
{
    $array1=gettype($sel);
	if($array1=='array')
	{
		while( list($key, $value) = each($sel))
		{
			$sql = "DELETE FROM fee_det WHERE id=$value";
			execute($sql);
		}
		// RE-INDEX THE INSTALLMENT NUMBER.
		$sql  = "SELECT DISTINCT(fee_id) FROM fee_det WHERE stud_id=$id AND paid='No' AND ";
		$sql .= "hostel_type='Y'";
		$rs = execute($sql) or die("QUERY $sql " . error_description());
		if (rowcount($rs) != 0)
		{
			while ($row = fetcharray($rs))
			{
				$query  = "SELECT * FROM fee_det WHERE stud_id=$id AND hostel_type='Y' AND ";
				$query .= "fee_id=$row[fee_id] ORDER BY due_date";
				$res = execute($query) or die("QUERY $query " . error_description());
				if (rowcount($res) == 1)
				{
					$rw = fetcharray($res);
					$id2 = $rw["id"];
					$sql = "UPDATE fee_det SET installment=0 WHERE id=$rw[id]";
					execute($sql) or die("QUERY $sql " . error_description());
					mysql_free_result($res);
				}
				else if($num > 1)
				{
					$i = 0;
					while ($rw = fetcharray($res))
					{
						$inst = $i+1;
						$sql = "UPDATE fee_det SET installment=$inst WHERE id= $rw[id]";
						execute($sql) or die("QUERY $sql " . error_description());
					}
					mysql_free_result($res);
				}
			}
		}
		echo "<DIV ALIGN='CENTER'><FONT SIZE='2'><B>";
		echo "Details Removed Successfully !!</B></FONT></DIV>";
      }
	  else
	  {?>
	  <script language="javascript">
	     alert("Please Select The Fee Name");
	  </script>
	 <?php }

}
// ENDS HERE.
?>
<HTML>
<HEAD>
<TITLE>HOSTEL STUDENT SEARCH</TITLE>
</HEAD>
<BODY>
<CENTER>
<FORM NAME="fees" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="id" VALUE="<?=$id?>">
<INPUT TYPE="HIDDEN" NAME="hostel" VALUE="<?=$hostel?>">
<?php
if ($m == 0)
{
	echo "testing inside if ";
	echo $id;
	echo "id";
	$query  = "SELECT a.first_name, a.last_name, a.student_id, c.year_id, c.year_name, ";
	$query .= "b.course_id, b.coursename FROM student_m a, course_m b, course_year c ";
	$query .= "WHERE a.id='$id' AND a.course_admitted=b.course_id AND a.course_yearsem=";
	$query .= "c.year_id AND a.archive='N'";
}
elseif ($m == 1)
{
	echo "testing inside else";
	
	$query  = "SELECT a.first_name, a.last_name, a.student_id, c.year_id, c.year_name, ";
	$query .= "b.course_id, b.coursename FROM additional_student a, additional_course b, ";
	$query .= "additional_term c WHERE a.id='$id' AND a.course_admitted=b.course_id AND ";
	$query .= "a.course_yearsem=c.year_id";
}
//here
else
{
	echo "testing";
}
//ends here
$rs = execute($query) or die("QUERY $query " . error_description());
if (rowcount($rs) == 0)
{
	echo "<DIV ALIGN='CENTER'><FONT SIZE='2'><B>";
	echo "No Student Details Found !!</B></FONT></DIV>";
}
else
{
	$row = fetcharray($rs);
	$stud_id = $row["student_id"];
	$stud_name = $row["first_name"] ." ". $row["last_name"];
	$course_id = $row["course_id"];
	$course_name = $row["coursename"];
	$term_id = $row["year_id"];
	$term_name = $row["year_name"];
	mysql_free_result($rs);
	echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0' WIDTH='100%' CLASS='forumline'>";
	echo "<TBODY>";
	echo "<TR>";
		echo "<TD WIDTH='15%' CLASS='rowpic'><B>Name</B></TD>";
		echo "<TD WIDTH='50%' CLASS='row2'><B>$stud_name</B></TD>";
		echo "<TD WIDTH='15%' CLASS='rowpic'><B>Registration No.</B></TD>";
		echo "<TD WIDTH='20%' CLASS='row2'><B>$stud_id</B></TD>";
	echo "</TR>";
	echo "<TR>";
		echo "<TD WIDTH='15%' CLASS='rowpic'><B>Course</B></TD>";
		echo "<TD WIDTH='50%' CLASS='row2'><B>$course_name</B></TD>";
		echo "<TD WIDTH='15%' CLASS='rowpic'><B>Term / Year</B></TD>";
		echo "<TD WIDTH='20%' CLASS='row2'><B>$term_id</B></TD>";
	echo "</TR>";
	echo "</TBODY>";
	echo "</TABLE>";

	echo "<BR>";

	// THIS PART IS FOR MODIFY / DELETE THE FEE STRUCTURE.
	$query  = "SELECT a.*, b.fee_name FROM fee_det a, hostel_fee_type b WHERE a.stud_id=$id AND ";
	$query .= "a.fee_id=b.fee_id AND a.paid='No' AND a.hostel_type='Y' AND b.status=1 ORDER BY id ";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) != 0)
	{
		echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0' WIDTH='100%' CLASS='forumline'>";
		echo "<TBODY>";
		echo "<TR>";
			echo "<TD WIDTH='10%' CLASS='rowpic' ALIGN='CENTER'><B>Select</B></TD>";
			echo "<TD WIDTH='20%' CLASS='rowpic' ALIGN='CENTER'><B>Fee Name</B></TD>";
			echo "<TD WIDTH='20%' CLASS='rowpic' ALIGN='CENTER'><B>Amount (Rs.)</B></TD>";
			echo "<TD WIDTH='30%' CLASS='rowpic' ALIGN='CENTER'><B>Due Date</B></TD>";
			echo "<TD WIDTH='20%' CLASS='rowpic' ALIGN='CENTER'><B>Term</B></TD>";
		echo "</TR>";
		while ($row = fetcharray($rs))
		{
			if ($row["installment"] > 0)
				$name = $row["fee_name"] ." - Inst ". $row["installment"];
			else
				$name = $row["fee_name"];
			$due_date = explode("-",$row["due_date"]);
			$dd = $due_date[2];
			$mm = $due_date[1];
			$yy = $due_date[0];
			echo "<TR>";
				echo "<TD WIDTH='10%' CLASS='row2' ALIGN='CENTER'><INPUT TYPE='CHECKBOX' NAME='sel[]' VALUE='$row[id]'></TD>";
				echo "<TD WIDTH='20%' CLASS='row2' ALIGN='LEFT'><B>$name</B></TD>";
				echo "<TD WIDTH='20%' CLASS='row2' ALIGN='CENTER'><INPUT TYPE='TEXT' SIZE='10' NAME='amt$row[id]' VALUE='$row[amt]'></TD>";
				echo "<TD WIDTH='30%' CLASS='row2' ALIGN='CENTER'>";
					echo "<INPUT TYPE='TEXT' NAME='dd_due$row[id]' VALUE='$dd' SIZE='2' MAXLENGTH='2'>-";
					echo "<INPUT TYPE='TEXT' NAME='mm_due$row[id]' VALUE='$mm' SIZE='2' MAXLENGTH='2'>-";
					echo "<INPUT TYPE='TEXT' NAME='yy_due$row[id]' VALUE='$yy' SIZE='4' MAXLENGTH='4'>";
				echo "</TD>";
				echo "<TD WIDTH='20%' CLASS='row2' ALIGN='CENTER'><INPUT TYPE='TEXT' SIZE='10' NAME='term$row[id]' VALUE='$row[academic_term]'></TD>";
			echo "</TR>";
		}
		mysql_free_result($rs);
		echo "<TR>";
			echo "<TD COLSPAN='3' ALIGN='CENTER'>";
			echo "<INPUT TYPE='SUBMIT' VALUE='Modify' NAME='modify' CLASS='bgbutton'></TD>";
			echo "<TD COLSPAN='2' ALIGN='CENTER'>";
			echo "<INPUT TYPE='SUBMIT' VALUE='Delete' NAME='delete' CLASS='bgbutton'></TD>";
		echo "</TR>";
		echo "</TBODY>";
		echo "</TABLE>";
	}
	else
	{
		echo "<DIV ALIGN='CENTER'><FONT SIZE='2'><B>";
		echo "Student has cleared all dues / Fee details are yet to be added.</B></FONT></DIV>";
	}
	// ENDS HERE.

	echo "<BR><BR>";

	// THIS PART IS FOR DISPLAY THE FEE STRUCTURE FOR APPLYING FEES.
	$query  = "SELECT a.*, b.fee_name FROM hostel_fee_m a, hostel_fee_type b LEFT JOIN ";
	$query .= "fee_det c ON b.fee_id=c.fee_id AND c.stud_id='$id' AND c.paid='NO' AND ";
	$query .= "c.installment=a.installment AND c.hostel_type='Y' WHERE b.status=1 AND ";
	$query .= "c.fee_id IS NULL AND a.hostel_id=$hostel AND a.fee_id=b.fee_id ORDER BY ";
	$query .= "a.due_date";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) != 0)
	{
		echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0' WIDTH='100%' CLASS='forumline'>";
		echo "<TBODY>";
		echo "<TR>";
			echo "<TD CLASS='rowpic' ALIGN='CENTER' WIDTH='10%'><B>Select</B></TD>";
			echo "<TD CLASS='rowpic' ALIGN='CENTER' WIDTH='20%'><B>Fee Name</B></TD>";
			echo "<TD CLASS='rowpic' ALIGN='CENTER' WIDTH='20%'><B>Amount (Rs.)</B></TD>";
			echo "<TD CLASS='rowpic' ALIGN='CENTER' WIDTH='30%'><B>Due Date</B></TD>";
			echo "<TD CLASS='rowpic' ALIGN='CENTER' WIDTH='20%'><B>Term</B></TD>";
		echo "</TR>";
		while ($row = fetcharray($rs))
		{
			if ($row["installment"] > 0)
				$name = $row["fee_name"] . " - Inst. " . $row["installment"];
			else
				$name = $row["fee_name"] ;
			$due_date = explode("-",$row["due_date"]);
			$dd = $due_date[2];
			$mm = $due_date[1];
			$yy = $due_date[0];
			echo "<TR>";
				echo "<TD CLASS='row2' ALIGN='CENTER' WIDTH='10%'><INPUT TYPE='CHECKBOX' NAME='fee[]' VALUE='$row[id]'></TD>";
				echo "<INPUT TYPE='HIDDEN' NAME='installment$row[id]' VALUE='$row[installment]'>";
				echo "<TD CLASS='row2' ALIGN='LEFT' WIDTH='20%'><B>$name</B></TD>";
				echo "<TD CLASS='row2' ALIGN='CENTER' WIDTH='20%'><INPUT TYPE='TEXT' NAME='fee_amt$row[id]' VALUE='$row[amt]'></TD>";
				echo "<TD CLASS='row2' ALIGN='CENTER' WIDTH='30%'>";
					echo "<INPUT TYPE='TEXT' NAME='due_dd$row[id]' VALUE='$dd' SIZE='2' MAXLENGTH='2'>-";
					echo "<INPUT TYPE='TEXT' NAME='due_mm$row[id]' VALUE='$mm' SIZE='2' MAXLENGTH='2'>-";
					echo "<INPUT TYPE='TEXT' NAME='due_yy$row[id]' VALUE='$yy' SIZE='4' MAXLENGTH='4'>";
				echo "</TD>";
				echo "<TD WIDTH='20%' CLASS='row2' ALIGN='CENTER'><INPUT TYPE='TEXT' SIZE='10' NAME='term$row[id]'></TD>";
			echo "</TR>";
		}
		mysql_free_result($rs);
		echo "<TR>";
			echo "<TD COLSPAN='5' CLASS='row2' ALIGN='CENTER'>";
			echo "<INPUT TYPE='SUBMIT' NAME='apply' CLASS='bgbutton' VALUE='Apply Fee'></TD>";
		echo "</TR>";
		echo "</TBODY>";
		echo "</TABLE>";
	}
	// ENDS HERE.
}
?>
</FORM>
</CENTER>
</BODY>
</HTML>