<?php


session_start();
require("../../db.php");

$college = $_POST['college'];
$hostel = $_POST['hostel'];
$feename = $_POST['feename'];

$FDay = $_POST['FDay'];
$FMon = $_POST['FMon'];
$FYear = $_POST['FYear'];

$TDay = $_POST['TDay'];
$TMon = $_POST['TMon'];
$TYear = $_POST['TYear'];
// VARIABLE DECLARATION
$dt1 = ""; 	//DATE FLAG
$FirstTime = 1;
$dtTotal = 0;
$total = 0;
$grand_total = 0;
// ENDS HERE.
//echo "<br>".$hostel ."<br>";
//echo $college;
if (!checkdate($FMon,$FDay,$FYear))
{
	echo "<DIV ALIGN='CENTER'>";
	echo "Invalid From Date !!";
	die();
}

if (!checkdate($TMon,$TDay,$TYear))
{
	echo "<DIV ALIGN='CENTER'>";
	echo "Invalid To Date !!";
	die();
}
$from_date = "$FYear-$FMon-$FDay";
$to_date   = "$TYear-$TMon-$TDay";
$temp_from = date("d-m-Y", strtotime($from_date));
$temp_to   = date("d-m-Y", strtotime($to_date));
//echo "college=$college";
if($college !=0)
{
$temp_college = explode("/",$college);
//echo $college;
//echo $temp_college; 

$database = $temp_college[1];
//echo $database;
//echo "$temp_college[0]";
if ($temp_college[0] < 0 )
{
//	echo "inside if";
	$sql  = "SELECT * FROM college WHERE col_id=1";
	//echo $sql;
	$table1 = "student_m";
	$table2 = "course_m";
	$table3 = "course_year";
	//$college_id = 1;
	$field1 = "id";
	$college_id = $temp_college[0];

}
else
{

	$sql  = "SELECT * FROM $database.additional_college  WHERE col_id=$temp_college[0]";
//	echo $sql;
	$table1 = "additional_student";
	$table2 = "additional_course";
	$table3 = "additional_term";
	//$college_id = 1;
	$field1 = "student_id";
	$college_id = $temp_college[0];

}

/*echo "Col iD == ".$temp_college[0]."<br>";
echo "Database == ".$database."<br>";
echo "table1 == ".$table1."<br>";
echo "table2 == ".$table2."<br>";
echo "table3 == ".$table3."<br>";
echo "field1 == ".$field1."<br>";*/


$res = execute($sql) or die("QUERY $sql " . error_description());

$rw = fetcharray($res);

$college_name = $rw["col_name"];

mysql_free_result($res);

//echo $hostel;

if ($hostel == 0)

	$query  = "SELECT * FROM hostel_m ORDER BY id ASC";

else
	$query  = "SELECT * FROM hostel_m WHERE id=$hostel";

//echo "<br>$query<br>";
$rs = execute($query) or die("QUERY $query " . error_description());
if (rowcount($rs) != 0)
{
	$l = 1;

	while ($row = fetcharray($rs))
	{
		//echo "inside while";
		//echo $college_id;
		//echo $row[id];
		//echo $college;
		$sql  = "SELECT COUNT(*) AS C FROM h_stud_m WHERE h_id=$row[id] AND domain='$college'";
		//echo $sql."<br>";
		$res = execute($sql) or die("QUERY $sql " . error_description());
		$row1 = fetcharray($res);
		if ($row1["C"] != 0)
		{
			$hostel_id[$l]	= $row["id"];

			$hostel_name[$l] = $row["hostel_name"];
			if ($row["hostel_type"] == "G")	$hostel_type[$l] = "Girls";
			elseif ($row["hostel_type"] == "B")	$hostel_type[$l] = "Boys";
			$l++;
		}
		mysql_free_result($res);
	}
	mysql_free_result($rs);
}
?>
<HTML>
<HEAD>
<TITLE>STUDENT FEE PAID REPORT</TITLE>
</HEAD>
<BODY>
<CENTER>
<?php

if ($feename != 0)		// FOR SPECIFIC FEES.
{
	//echo "inside if ";
	$query  = "SELECT fee_id, fee_name FROM hostel_fee_type WHERE fee_id=$feename AND ";
	$query .= "status=1 ORDER BY fee_id ASC";
	//echo "<br>".$query;

}
else		// FOR ALL THE FEES.
{
	//echo "inside else";
	$query  = "SELECT fee_id, fee_name FROM hostel_fee_type WHERE status=1 ORDER BY fee_id";
//echo "SELECT fee_id, fee_name FROM hostel_fee_type WHERE status=1 ORDER BY fee_id";
//echo"<br>".$query;
}
//echo"<br>".$query."<br>";
$rs = execute($query) or die("QUERY $query " . error_description());
if (rowcount($rs) != 0)
{
	$k = 1;
	while ($row = fetcharray($rs))
	{
		$hostel_fee_id[$k] = $row["fee_id"];
		$hostel_fee_name[$k] = $row["fee_name"];
		$k++;

	}
	mysql_free_result($rs);
	$no_of_fees = $k - 1;
	$no_of_fields = $no_of_fees + 7;
	//echo $no_of_fees;
	//echo " ";
	//echo $no_of_fields;
	if (($no_of_fields % 2) == 0)
	{
		$first_half_fields = $no_of_fields / 2;
		$second_half_fields = $no_of_fields / 2;
	}
	else
	{
		$first_half_fields = ($no_of_fields + 1) / 2;
		$second_half_fields = $first_half_fields - 1;
	}
}
elseif (rowcount($rs) == 0)
{
	echo "<DIV ALIGN='CENTER'>";
	echo "Describe Fee Structure !!</DIV>";
	die();
}
//echo  $l;
//for($ll=1;$ll<=$l;$ll++)
{
?>
	<TABLE CELLPADDING="0" CELLSPACING="1" BORDER="0" WIDTH="150%" CLASS="forumline">
	<TBODY>
	<TR>
		<TD ALIGN="CENTER" COLSPAN="<?=$no_of_fields;?>" CLASS="head" WIDTH="150%">
		HOSTEL  FEE PAID REPORT FROM <?=$temp_from;?> TO <?=$temp_to;?></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT" COLSPAN="<?=$first_half_fields;?>" CLASS="rowpic">COLLEGE : <?=$college_name;?></TD>
		<TD ALIGN="RIGHT" COLSPAN="<?=$second_half_fields;?>" CLASS="rowpic">HOSTEL : <?=$hostel_name[$ll];?>-<?=$hostel_type[$ll];?></TD>
	</TR>
	<TR>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="12%">Student ID</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="20%">Student Name</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="10%">Course</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="13%">Term/Year</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="12%">Receipt Date</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="10%">Receipt No.</TD>
		<?php
		for ($jj=1;$jj<=$no_of_fees;$jj++)
		{
			echo "<TD ALIGN='CENTER' CLASS='rowpic' WIDTH='15%'><B>$hostel_fee_name[$jj]</B></TD>\n";
		}
		?>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="15%"><B>Total</B></TD>
	</TR>
	<?
	//echo $hostel_id[$l];

	$query  = "SELECT DISTINCT(a.doc_id) AS doc, a.doc_date, a.stud_id, a.remark FROM ";
	$query .= "doc_m a, $table1 b, doc_amt c, h_stud_m d, ";
	$query .= "hostel_fee_type e WHERE a.stud_id=b.id AND c.hostel_type='Y' AND ";
	$query .= "a.doc_type='R' AND a.doc_id=c.doc_id AND c.fee_id=e.fee_id AND ";
	$query .= "b.$field1=d.s_id AND a.doc_date BETWEEN ";
	$query .= "'$from_date' AND '$to_date'";
	//echo $query;

	/*$query  = "SELECT DISTINCT(a.doc_id) AS doc, a.doc_date, a.stud_id, a.remark FROM ";
		$query .= "$database.doc_m a, $table1 b, $database.doc_amt c, h_stud_m d, ";
		$query .= "hostel_fee_type e WHERE a.stud_id=b.id AND c.hostel_type='Y' AND ";
		$query .= "a.doc_type='R'  AND ";
		$query .= "d.h_id=$hostel_id[$ll] AND b.$field1=d.s_id AND a.doc_date BETWEEN ";
	$query .= "'$from_date' AND '$to_date'";*/
	//echo $query;
	$res = execute($query) or die("QUERY $query " . error_description());
$i=0;
	while ($row = fetcharray($res))
	{
		//echo "inside while ";
		//echo 
		$sql  = "SELECT a.first_name, b.course_id,a.last_name, a.student_id, b.course_abbr, c.year_name ";
		$sql .= "FROM $table1 a, $table2 b, $table3 c WHERE b.course_id=a.course_admitted ";
		$sql .= "AND c.year_id=a.course_yearsem AND a.id=$row[stud_id]";
		//echo "<br>$sql<br>";

		$result = execute($sql) or die("QUERY $sql " . error_description());
		
		while ($rw = fetcharray($result))
		{
				 if($i%2)
               echo "        <tr class='clsname' height='25'> ";
               else
               echo "        <tr height='25'> ";
			   $i = $i+ 1 ;
				echo "<TD  ALIGN='CENTER' WIDTH='12%'><B>$rw[student_id]</B></TD>\n";

				echo "<TD  ALIGN='CENTER' WIDTH='20%'><B>$rw[first_name] $rw[last_name]</B></TD>\n";
				echo "<TD ALIGN='CENTER'  WIDTH='10%'><B>$rw[course_abbr]</B></TD>\n";
				echo "<TD ALIGN='CENTER' WIDTH='13%'><B>$rw[year_name]</B></TD>\n";
				echo "<TD ALIGN='CENTER' WIDTH='12%'><B>".date("d-m-Y", strtotime($row["doc_date"]))."</B></TD>\n";

				echo "<TD ALIGN='CENTER' WIDTH='10%'><B>$row[doc]</B></TD>\n";

				for ($jj=1;$jj<=$no_of_fees;$jj++)
				{
					/*$sql  = "SELECT DISTINCT(a.fee_id), a.amt,c.amt FROM $database.doc_amt a, ";
					$sql .= "$database.fee_det b,fee_det c WHERE a.doc_id='$row[doc]' AND b.fee_id=";
					$sql .= "$hostel_fee_id[$jj] AND a.hostel_type='Y' AND b.fee_id=a.fee_id ";
					$sql .= "AND b.paid='Yes'";*/

					/*$sql  = "SELECT DISTINCT(a.fee_id), a.amt,b.fee_amount FROM $database.doc_amt a, ";
					$sql .= "$database.fee_det b WHERE  a.doc_id='$row[doc]'and b.fee_id=";
					$sql .= "$hostel_fee_id[$jj] AND a.hostel_type='Y' and b.fee_id=a.fee_id  ";
					$sql .= "AND b.paid='Yes'";*/
					//$sql1=fetcharray($sql);
					//echo $sql;

					$sql="select * from fee_h_det where fee_id=$hostel_fee_id[$jj] and stud_id=$row[stud_id] and Paid='Yes' and doc_id='$row[doc]'" ;
					//echo "<br>$sql<br>";
					$res1 = execute($sql) or die("QUERY $sql " . error_description());
					//echo $sql;
					if (rowcount($res1) == 0)
						$paid = "&nbsp;";
					else
					{
						
						//echo "inside";
						$n=1;
						while ($row1 = fetcharray($res1))
						{
							//echo "inside";
							$paid = $row1["amt"];
							//echo "Paid == ".$paid."<br>";
							//echo" <TD ALIGN='RIGHT' CLASS='row2' WIDTH='15%'><B>".number_format($paid, 2, ".", "")."</B></TD>\n";

							$total += $paid;

							$grand_total += $paid;

							$countTotal[$n] += $paid;
							$n++;
						}
						mysql_free_result($res1);
						
					}


					echo "<TD ALIGN='CENTER' WIDTH='15%'><B>".number_format($paid, 2, ".", "")."</B></TD>\n";
				}
				echo "<TD  WIDTH='15%' ALIGN='CENTER'><B>".number_format($total,2,'.','')."</B></TD>\n";
			echo "</TR>\n";
			$dtTotal += $total;
		}
		mysql_free_result($result);
	}
	?>
	</TBODY>
	</TABLE>
<?
}
}

else // FOR ALL COLLAGES
{
	$college=array("-1","-2","-3");
	$collegename=array("DENTAL","ENGINEERING","MANAGEMENT");
//echo $college[2];
	$xx=3;

	$query  = "SELECT * FROM additional_college ";

	$res = execute($query) or die("QUERY $query " . error_description());
				if (rowcount($res) != 0)
				{
					while ($row = fetcharray($res))
					{
							$college[$xx]=$row[col_id];
							//echo $college[$xx];
							$collegename[$xx]=$row[col_name];
							//echo $collegename[$xx];
							$xx++;
					}
					mysql_free_result($res);
			}


while(list(,$col)=each($college))
{

if ($hostel == 0)
{
	$query  = "SELECT * FROM hostel_m ORDER BY id ASC";
	//echo "inside if";
}
else
{
	$query  = "SELECT * FROM hostel_m WHERE id=$hostel";
	//echo "inside ";
}


$rs = execute($query) or die("QUERY $query " . error_description());
$l = 0;
if (rowcount($rs) != 0)
{

	while ($row = fetcharray($rs))
	{
		//$sql  = "SELECT COUNT(*) AS C FROM h_stud_m WHERE h_id=$row[id] AND domain='$col'";
		$sql  = "SELECT COUNT(*) AS C FROM h_stud_m WHERE domain='$col'";
		//echo $col;
		$res = execute($sql) or die("QUERY $sql " . error_description());

		$row1 = fetcharray($res);
		if ($row1["C"] != 0)
		{
			$hostel_id[$l]	= $row["id"];

			$hostel_name[$l] = $row["hostel_name"];

			if ($row["hostel_type"] == "G")
			{
			$hostel_type[$l] = "Girls";
			$l++;
			}
			elseif ($row["hostel_type"] == "B")
			{
			$hostel_type[$l] = "Boys";
			$l++;
			}

		}
		mysql_free_result($res);

	}
	mysql_free_result($rs);
}
}
reset($hostel_id);
reset($college);
$ll=0;
$kk=0;
while(list(,$col)=each($college))
{

?>
<HTML>
<HEAD>
<TITLE>STUDENT FEE PAID REPORT</TITLE>
</HEAD>
<BODY>
<CENTER>
<?php

if ($feename != 0)		// FOR SPECIFIC FEES.
{
	$query  = "SELECT fee_id, fee_name FROM hostel_fee_type WHERE fee_id=$feename AND ";
	$query .= "status=1 ORDER BY fee_id ASC";

}
else		// FOR ALL THE FEES.
{
	$query  = "SELECT fee_id, fee_name FROM hostel_fee_type WHERE status=1 ORDER BY fee_id";

}
$rs = execute($query) or die("QUERY $query " . error_description());
if (rowcount($rs) != 0)
{
	$k = 1;
	while ($row = fetcharray($rs))
	{
		$hostel_fee_id[$k] = $row["fee_id"];

		$hostel_fee_name[$k] = $row["fee_name"];

		$k++;

	}
	mysql_free_result($rs);
	$no_of_fees = $k - 1;
	$no_of_fields = $no_of_fees + 7;
	if (($no_of_fields % 2) == 0)
	{

		$first_half_fields = $no_of_fields / 2;
		$second_half_fields = $no_of_fields / 2;

	}
	else
	{
		$first_half_fields = ($no_of_fields + 1) / 2;
		$second_half_fields = $first_half_fields - 1;

	}
}
elseif (rowcount($rs) == 0)
{
	echo "<DIV ALIGN='CENTER'>";
	echo "Describe Fee Structure !!</DIV>";
	die();
}


//for($ll=1;$ll<$l;$ll++)
//while(list(,$col)=each($college))
//{
//echo $hostel_id[$l];
//echo "collegename[$ll] == ".$collegename[$ll]."<br>";

?>
	<TABLE CELLPADDING="0" CELLSPACING="1" BORDER="0" WIDTH="150%" CLASS="forumline">
	<TBODY>
	<TR>
		<TD ALIGN="CENTER" COLSPAN="<?=$no_of_fields;?>" CLASS="head" WIDTH="150%">
		HOSTEL  FEE PAID REPORT FROM <?=$temp_from;?> TO <?=$temp_to;?></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT" COLSPAN="<?=$first_half_fields;?>" CLASS="rowpic">COLLEGE : <?=$collegename[$ll];?></TD>
	<TD ALIGN="RIGHT" COLSPAN="<?=$second_half_fields;?>" CLASS="rowpic">HOSTEL : <?=$hostel_name[$ll];?>-<?=$hostel_type[$ll];?></TD></tr>
	</TR>
	<TR>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="12%">Student ID</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="20%">Student Name</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="10%">Course</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="13%">Term/Year</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="12%">Receipt Date</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="10%">Receipt No.</TD>
		<?php

		for ($jj=1;$jj<=$no_of_fees;$jj++)
		{
			echo "<TD ALIGN='CENTER' CLASS='rowpic' WIDTH='15%'>$hostel_fee_name[$jj]</TD>\n";

		}
		?>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="15%">Total</TD>
	</TR>
	<?

		if($col== -1)
		{
			$database="dmist";
			$table1 = "student_m";
			$table2 = "course_m";
			$table3 = "course_year";
			$field1 = "id";
		}
		elseif($col== -2)
		{
			
			$table1 = "$database.student_m";
			$table2 = "$database.course_m";
			$table3 = "$database.course_year";
			$field1 = "id";
		}
		elseif($col== -3)
		{

			$database="dsman";
			$table1 = "student_m";
			$table2 = "course_m";
			$table3 = "course_year";
			$field1 = "id";
		}
		elseif($col != 1)
		{
			
			$table1 = "$database.additional_student";
			$table2 = "$database.additional_course";
			$table3 = "$database.additional_term";
			$field1 = "student_id";

		}



/*echo "Col iD == ".$col."<br>";
echo "Database == ".$database."<br>";
echo "table1 == ".$table1."<br>";
echo "table2 == ".$table2."<br>";
echo "table3 == ".$table3."<br>";
echo "field1 == ".$field1."<br>";*/

reset($hostel_id);



?>

<?php

$kk++;


while(list(,$hid) = each($hostel_id))
{	
	$query  = "SELECT DISTINCT(a.doc_id) AS doc, a.doc_date, a.stud_id, a.remark FROM ";
	$query .= "doc_m a, $table1 b, doc_amt c, h_stud_m d, ";
	$query .= "hostel_fee_type e WHERE a.stud_id=b.id AND c.hostel_type='Y' AND ";
	$query .= "a.doc_type='R' AND a.doc_id=c.doc_id AND c.fee_id=e.fee_id AND ";
	$query .= "b.$field1=d.s_id AND a.doc_date BETWEEN ";
	$query .= "'$from_date' AND '$to_date' ";

//echo $query."<br>";


	/*$query  = "SELECT DISTINCT(a.doc_id) AS doc, a.doc_date, a.stud_id, a.remark FROM ";
		$query .= "$database.doc_m a, $table1 b, $database.doc_amt c, h_stud_m d, ";
		$query .= "hostel_fee_type e WHERE a.stud_id=b.id AND c.hostel_type='Y' AND ";
		$query .= "a.doc_type='R'  AND ";
		$query .= "d.h_id=$hostel_id[$ll] AND b.$field1=d.s_id AND a.doc_date BETWEEN ";
		$query .= "'$from_date' AND '$to_date'";*/
	//echo $query;
	$res = execute($query) or die("QUERY $query " . error_description());

	for($i=0;$i<rowcount($res);$i++)
	{
	//while ($row = fetcharray($res))
	//{
	$row=fetcharray($res);
		$sql  = "SELECT a.first_name, a.last_name, a.student_id, b.course_abbr, c.year_name ";
		$sql .= "FROM $table1 a, $table2 b, $table3 c,h_stud_m d WHERE b.course_id=a.course_admitted ";
		$sql .= "AND c.year_id=a.course_yearsem  and a.id=$row[stud_id] and $field1=d.s_id";
		//echo "<br>SQL==".$sql;
		$result = execute($sql) or die("QUERY $sql " . error_description());

		while ($rw = fetcharray($result))
		{
			echo "<TR>\n";

			echo "<TD CLASS='row2' WIDTH='12%'>$rw[student_id]</TD>\n";
			echo "<TD CLASS='row2' WIDTH='20%'>$rw[first_name] $rw[last_name]</TD>\n";
			echo "<TD CLASS='row2' WIDTH='10%'>$rw[course_abbr]</TD>\n";
			echo "<TD CLASS='row2' WIDTH='13%'>$rw[year_name]</TD>\n";
			echo "<TD CLASS='row2' WIDTH='12%'>".date("d-m-Y", strtotime($row["doc_date"]))."</TD>\n";
			echo "<TD CLASS='row2' WIDTH='10%'>$row[doc]</TD>\n";
			//echo $no_of_fees;
				for ($jj=1;$jj<=$no_of_fees;$jj++)
				{
					/*$sql  = "SELECT DISTINCT(a.fee_id), a.amt,c.amt FROM $database.doc_amt a, ";
					$sql .= "$database.fee_det b,fee_det c WHERE a.doc_id='$row[doc]' AND b.fee_id=";
					$sql .= "$hostel_fee_id[$jj] AND a.hostel_type='Y' AND b.fee_id=a.fee_id ";
					$sql .= "AND b.paid='Yes'";*/

					/*$sql  = "SELECT DISTINCT(a.fee_id), a.amt,b.fee_amount FROM $database.doc_amt a, ";
					$sql .= "$database.fee_det b WHERE  a.doc_id='$row[doc]'and b.fee_id=";
					$sql .= "$hostel_fee_id[$jj] AND a.hostel_type='Y' and b.fee_id=a.fee_id  ";
					$sql .= "AND b.paid='Yes'";*/
					//$sql1=fetcharray($sql);
					//echo $sql;

					$sql="select * from fee_det where fee_id=$hostel_fee_id[$jj] and stud_id=$row[stud_id] and Paid='Yes'" ;
					//echo $sql;
					$res1 = execute($sql) or die("QUERY $sql " . error_description());

					if (rowcount($res1) == 0)
					{
						$paid = "&nbsp;";
					}
					else
					{
						$n=1;
						while ($row1 = fetcharray($res1))
						{
							$paid = $row1["amt"];
							//echo "Paid == ".$paid."<br>";
							//echo" <TD ALIGN='RIGHT' CLASS='row2' WIDTH='15%'><B>".number_format($paid, 2, ".", "")."</B></TD>\n";

							$total += $paid;


							$grand_total += $paid;

							$countTotal[$n] += $paid;
							$n++;
						}
						mysql_free_result($res1);
					}
					echo "<TD ALIGN='RIGHT' CLASS='row2' WIDTH='15%'>".number_format($paid, 2, ".", "")."</TD>\n";
				}
				echo "<TD CLASS='row2' WIDTH='15%' ALIGN='RIGHT'>".number_format($total,2,'.','')."</TD>\n";

			$dtTotal += $total;
			echo "</TR>\n";
		}
		mysql_free_result($result);

	}
/*echo"</TBODY>";
	echo"</TABLE>";*/
}
echo"</TBODY>";
echo"</TABLE>";
reset($hostel_id);
//}
$ll++;
}
reset($college);
//$kk++;
}
?>
</CENTER>
</BODY>
</HTML>