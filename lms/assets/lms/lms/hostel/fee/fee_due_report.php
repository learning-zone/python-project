<?php
session_start();
include("../../db.php");
$hostel = $_POST['hostel'];
$search = $_POST['search'];
/*  if($user=='')
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
}  */

// VARIABLE DECLARATIONS
$college_head_display = 0;
$grand_total = 0;
$serial = 1;
$total = 0;
$i = 4;
$k = 1;
// ENDS HERE.
?>
<HTML>
<HEAD>
<TITLE>HOSTEL FEE DUE REPORT</TITLE>

<SCRIPT>
function printReport()
{
	window.print();
}
</script>
</HEAD>
<BODY>
<CENTER>
<FORM NAME="frm" METHOD="POST" ACTION="fee_due_report.php">
<TABLE CLASS="forumline" CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="30%">
<TBODY>
<TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="3"><B>HOSTEL DETAILS</B></TD></TR>
<TR>
	<TD CLASS="rowpic" WIDTH="100%"><B>Hostel Name</B></TD>
	<TD CLASS="rowpic" WIDTH="100%">
		<SELECT NAME="hostel" SIZE="1">
			<OPTION VALUE="0">--- SELECT HOSTEL ---</OPTION>
			<?
			$query  = "SELECT * FROM hostel_m";
			$rs = execute($query) or die("QUERY $query " . error_description());
			if (rowcount($rs) != 0)
			{
				while ($row = fetcharray($rs))
				{
					if ($hostel == $row["id"])
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
	<center><INPUT TYPE="SUBMIT" NAME="search" VALUE="SEARCH" CLASS="bgbutton"></center>

</FORM>

<?
if (isset($search))
{
	$query  = "SELECT * FROM hostel_fee_type WHERE status=1 ORDER BY fee_id ASC";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) != 0)
	{
		while ($row = fetcharray($rs))
		{
			$hostel_fee_id[$k] = $row["fee_id"];
			$hostel_fee_name[$k] = $row["fee_name"];
			$k++;
		}
		mysql_free_result($rs);
		$no_of_fees = $k - 1;
		$no_of_fields = $no_of_fees + 4;
		if (($no_of_fields % 2) == 0)
		{
			$first_half_fields = $no_of_fields / 2;
			$second_half_fields = $no_of_fields / 2;
		}
		else
		{
			$first_half_fields = ($no_of_fields -2) / 2;
			$second_half_fields = $first_half_fields - 1;
		}
	}
	else
	{
		//echo "<DIV ALIGN='CENTER'>";
		//echo "Enter Fee Structure Details !!</DIV>";
		?>
        <script type="text/javascript">
		alert("Enter Fee Structure Details !!");
		</script>
        <?
		die();
	}


	$query  = "SELECT * FROM hostel_m WHERE id=$hostel";
	$rs = execute($query) or die("QUERY $query " . error_description());
	$row = fetcharray($rs);
	$hostel_name = $row["hostel_name"];
	if ($row["hostel_type"] == "G")	$hostel_type = "Girls";
	elseif ($row["hostel_type"] == "B")	$hostel_type = "Boys";
	mysql_free_result($rs);

	$college_id[1] = "-1";
	$college[1] = "DENTAL COLLEGE";
	$database[1] = "dmist";
	$query  = "SELECT * FROM college";
	$rs = execute($query) or die("QUERY $query " . error_description());
	while ($row = fetcharray($rs))
	{
		$college_id[2] = "-2";
		$college[2] = $row["col_name"];
		
		$i++;
	}
	mysql_free_result($rs);
	$college_id[3] = "-3";
	$college[3] = "MANAGEMENT COLLEGE";
	$database[3] = "dsman";

	$query  = "SELECT * FROM additional_college";
	$rs = execute($query) or die("QUERY $query " . error_description());
	while ($row = fetcharray($rs))
	{
		$college_id[$i] = $row["col_id"];
		$college[$i] = $row["col_name"];
		
		$i++;
	}

	mysql_free_result($rs);

	echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='1' WIDTH='100%' CLASS='forumline'>";
	echo "<TBODY>";
	echo "<TR>";
	$num=$no_of_fields+1;
		echo "<TD WIDTH='80%' COLSPAN='$num' ALIGN='CENTER' CLASS='head'>";
		echo "HOSTEL FEE DUE REPORT AS ON ".date('d-m-Y g:i a')."</TD>";
	echo "</TR>";
	echo "<TR>";
		echo "<TD WIDTH='50%' ALIGN='LEFT' COLSPAN='$first_half_fields' CLASS='rowpic'>";
		echo "Hostel Name: $hostel_name</TD>";
		echo "<TD WIDTH='50%' ALIGN='RIGHT' COLSPAN='$second_half_fields' CLASS='rowpic'>";
		echo "Hostel Type: $hostel_type</TD>";
	echo "</TR>";
	echo "<TR>";
		echo "<TD WIDTH='05%' ALIGN='CENTER' CLASS='row2'>Sl.</TD>";
		echo "<TD WIDTH='20%' ALIGN='CENTER' CLASS='row2'>Student Name</TD>";
		echo "<TD WIDTH='15%' ALIGN='CENTER' CLASS='row2'>Course</TD>";
		echo "<TD WIDTH='10%' ALIGN='CENTER' CLASS='row2'>Term/Year</TD>";
		echo "<TD WIDTH='40%' ALIGN='CENTER' CLASS='row2' COLSPAN='$no_of_fees'>Fee Names</TD>";
		echo "<TD WIDTH='10%' ALIGN='CENTER' CLASS='row2'>Total (Rs.)</TD>";
	echo "</TR>";
	echo "<TR>";
		echo "<TD WIDTH='50%' COLSPAN='$first_half_fields' CLASS='row2' ALIGN='CENTER'>&nbsp;</TD>";
		for ($jj=1;$jj<=$no_of_fees;$jj++)
			echo "<TD CLASS='row2' ALIGN='CENTER'>$hostel_fee_name[$jj]</TD>";
		echo "<TD WIDTH='10%' ALIGN='CENTER' CLASS='row2'>&nbsp;</TD>";
	echo "</TR>";

	for ($j=1;$j<$i;$j++)
	{
		//echo " test   ";
		//echo  $college_id[$j];
		//echo " test   ";
		//echo  $hostel ; 
		$college_head_display = 0;
		$total_head_display = 0;
		$query  = "SELECT * FROM h_stud_m WHERE archive='N' AND h_id=$hostel AND domain='$college_id[$j]' ";
		$query .= "ORDER BY first_name ASC";
		$rs = execute($query) or die("QUERY $query " . error_description());
		if (rowcount($rs) != 0)
		{
$i=0;
			while ($row = fetcharray($rs))
			{
				//echo "test 3 ";
				//echo $row[s_id];
				$sql  = "SELECT id, course_admitted, course_yearsem FROM student_m ";
				$sql .= "WHERE id='$row[s_id]'";
				$res = execute($sql); //or die("QUERY $sql " . error_description());
				//echo $sql;
				//echo "test 3 ";
				if (rowcount($res) == 0)
				{
					//echo "inside if ";
					/*
					$sql  = "SELECT id,course_admitted, course_yearsem FROM additional_student ";
					$sql .= "WHERE student_id='$row[s_id]' AND college_id=$college_id[$j]";
					*/
					//$sql  = "SELECT id,course_admitted, course_yearsem FROM additional_student ";
					//$sql .= "WHERE student_id='$row[s_id]'";
					$sql  = "SELECT id,course_admitted, course_yearsem FROM additional_student ";
					$sql .= "WHERE id='$row[s_id]'";
					$res = execute($sql);// or die("QUERY $sql " . error_description());
				}
				if (rowcount($res) != 0)
				{
					//echo "inside if2 ";
					while ($rw = fetcharray($res))
					{
						$student_id = $rw["id"];
						$course_id  = $rw["course_admitted"];
						$term_id = $rw["course_yearsem"];
						$total_head_display = 1;
					}
					mysql_free_result($res);

					$sql1  = "SELECT course_abbr FROM course_m WHERE course_id=$course_id ";
					$sql1 .= "AND status=1";
					$result = execute($sql1) or die("QUERY $sql1 " . error_description());
					if (rowcount($result) == 0)
					{
						$sql1  = "SELECT course_abbr FROM additional_course WHERE course_id=";
						$sql1 .= "$course_id AND status=1 AND college_id=$college_id[$j]";
						$result = execute($sql1) or die("QUERY $sql1 " . error_description());
					}
					if (rowcount($result) != 0)
					{
						$rw1 = fetcharray($result);
						$course_name = $rw1["course_abbr"];
						mysql_free_result($result);
					}

					$sql1  = "SELECT year_name FROM course_year WHERE year_id=$term_id ";
					$sql1 .= "AND status=1";
					$result = execute($sql1) or die("QUERY $sql1 " . error_description());
					if (rowcount($result) == 0)
					{
						$sql1  = "SELECT year_name FROM additional_term WHERE year_id=$term_id ";
						$sql1 .= "AND status=1 AND college_id=$college_id[$j]";
						$result = execute($sql1) or die("QUERY $sql1 " . error_description());
					}
					if (rowcount($result) != 0)
					{
						$rw1 = fetcharray($result);
						$term_name = $rw1["year_name"];
						mysql_free_result($result);
					}

					if ($college_head_display == 0)
					{
						echo "<TR>";
							echo "<TD WIDTH='100%' ALIGN='LEFT' COLSPAN='$no_of_fields' CLASS='rowpic'>";
							echo "College Name: $college[$j]</TD>";
						echo "</TR>";
						$college_head_display = 1;
					}
					if($i%2)
               echo "        <tr class='clsname' height='25'> ";
               else
               echo "        <tr height='25'> ";
						echo "<TD WIDTH='05%'  ALIGN='CENTER'>$serial</TD>";
						echo "<TD WIDTH='20%'  ALIGN='LEFT'>$row[first_name] $row[last_name]</TD>";
						echo "<TD WIDTH='15%'  ALIGN='LEFT'>$course_name</TD>";
						echo "<TD WIDTH='10%'  ALIGN='LEFT'>$term_name</TD>";
						
						for ($jj=1;$jj<=$no_of_fees;$jj++)
						{
							//echo $student_id;
							//echo $hostel_fee_id[$jj];
							$sql2  = "SELECT b.*, a.fee_name FROM fee_h_det b, hostel_fee_type a ";
							$sql2 .= "WHERE  a.status=1 AND b.hostel_type='Y' AND b.stud_id=";
							$sql2 .= "$student_id AND b.paid='No' AND b.fee_id=$hostel_fee_id[$jj] ";
							$sql2 .= "AND a.fee_id=b.fee_id ORDER BY b.fee_id ASC";
							$result = execute($sql2) or die("QUERY $sql2 " . error_description());
							if (rowcount($result) != 0)
							{
								$temp_amt = 0;
								while ($rw1 = fetcharray($result))
									$temp_amt += $rw1["amt"];
								mysql_free_result($result);
								$total += $temp_amt;
								$sub_total[$jj] += $temp_amt;
								$temp_amt = number_format($temp_amt, 2, ".", "");
								echo "<TD ALIGN='RIGHT'>$temp_amt</TD>";
							}
							else
							{
								$sub_total[$jj] += 0;
								echo "<TD ALIGN='RIGHT' >0.00</TD>";
							}
						}
						echo "<TD WIDTH='10%' ALIGN='RIGHT'>".number_format($total,2,".","")."</TD>";
						$grand_total += $total;
						$serial++;
						$total = 0;
					echo "</TR>";
				}
				$i = $i+1;
			}
			mysql_free_result($rs);
			if ($total_head_display == 1)
			{
				echo "<TR>";
					echo "<TD WIDTH='50%' ALIGN='RIGHT' COLSPAN='$first_half_fields' CLASS='row3'>GRAND TOTAL</TD>";
					for ($jj=1;$jj<=$no_of_fees;$jj++)
					{
						echo "<TD ALIGN='RIGHT' CLASS='row3'>".number_format($sub_total[$jj],2,".","")."</TD>";
					}
					echo "<TD WIDTH='10%' ALIGN='RIGHT' CLASS='row3'>".number_format($grand_total,2,".","")."</TD>";
				echo "</TR>";
				$total_head_dispaly = 0;
			}
		}
	}
	echo "</TBODY>";
	echo "</TABLE>";
}
?>
<table class='forumline' align=center>
<br>
      <center	<INPUT TYPE="SUBMIT" class='bgbutton' NAME="print" VALUE="PRINT THE REPORT"
onclick="printReport()"></center>
<br></br>
</CENTER>
</BODY>
</HTML>