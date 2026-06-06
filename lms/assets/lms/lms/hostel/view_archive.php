<?

session_start();
require("../db.php");
$action1  = $_REQUEST['action1'];
$college = $_POST['college'];
$hname = $_POST['hname'];
$studFName = $_POST['studFName'];
$state = $_POST['state'];
$country = $_POST['country'];
?>
<HTML>
<HEAD>
<TITLE>LIST OF ARCHIVED STUDENTS</TITLE>
</HEAD>
<BODY>
<CENTER>
<?php
$studFName = trim($studFName);
$state = trim($state);
$str = " ";
$country = trim($country);
if ($hname == 0)
{
	echo "<DIV ALIGN='CENTER'><FONT COLOR= SIZE='2'><B>";
	echo "Select the Hostel Name !!</B></FONT></DIV>";
}
if ($college < 0)
{
	$query  = "SELECT DISTINCT(b.s_id), a.first_name, a.last_name, b.h_id, b.room_no, ";
	$query .= "a.course_admitted, a.course_yearsem, b.bid FROM student_m a INNER JOIN ";
	$query .= "h_archive_m b ON a.student_id=b.s_id WHERE b.h_id=$hname ";
}
else
{
	$query  = "SELECT DISTINCT(b.s_id), a.first_name, a.last_name, b.h_id, b.room_no, ";
	$query .= "a.course_admitted, a.course_yearsem, b.bid FROM additional_student a INNER JOIN ";
	$query .= "h_archive_m b ON a.student_id=b.s_id WHERE b.h_id=$hname ";
}

//echo "ssss:$query";
if (strlen($studFName) == 0)
{
	$str = " AND ";
	$query .= $str . "a.first_name LIKE '$studFName%' ";
}
if (strlen($state) == 0)
{
	$str = " AND ";
	$query .= $str . " a.per_state LIKE '$state%' ";
}
if (strlen($country) == 0)
{
	$str = " AND ";
	$query .= $str . " a.per_country LIKE '$country%' ";
}
$rs = execute($query) or die("QUERY $query " . error_description());
if(rowcount($rs) != 0)
{
	echo "<FONT FACE='Arial'><B>Search Results.... rowcount($rs)</B></FONT>";
	echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0' WIDTH='100%' CLASS='forumline'>";
	echo "<TBODY>";
	echo "<TR>";
		echo "<TD COLSPAN='6' WIDTH='100%' ALIGN='CENTER' CLASS='head'><B>VIEW ARCHIVED STUDENT DETAILS</B></TD>";
	echo "</TR>";
	echo "<TR>";
		echo "<TD WIDTH='10%' ALIGN='CENTER' CLASS='rowpic'><B>Sl. No.</B></TD>";
		echo "<TD WIDTH='10%' ALIGN='CENTER' CLASS='rowpic'><B>Student ID</B></TD>";
		echo "<TD WIDTH='30%' ALIGN='CENTER' CLASS='rowpic'><B>Name</B></TD>";
		echo "<TD WIDTH='15%' ALIGN='CENTER' CLASS='rowpic'><B>Course</B></TD>";
		echo "<TD WIDTH='10%' ALIGN='CENTER' CLASS='rowpic'><B>Term / Year</B></TD>";
		echo "<TD WIDTH='25%' ALIGN='CENTER' CLASS='rowpic'><B>Hostel, Block, Room</B></TD>";
	echo "</TR>";
	$k = 1;
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);
		if ($college < 0)
		{
			$sql1  = "SELECT * FROM course_m WHERE course_id=$r[course_admitted]";
			$sql2  = "SELECT * FROM course_year WHERE year_id=$r[course_yearsem]";
		}
		elseif ($college > 0)
		{
			$sql1  = "SELECT * FROM additional_course WHERE course_id=$r[course_admitted]";
			$sql2  = "SELECT * FROM additional_term WHERE year_id=$r[course_yearsem]";
		}
		$sql3  = "SELECT * FROM hostel_m WHERE id=$r[h_id]";
		$rs1 = execute($sql3) or die("SELECT QUERY 3 $sql3 " . error_description());
		$rw1 = fetcharray($rs1);
		$hostel_name = $rw1["hostel_name"];
		mysql_free_result($rs1);

		$sql4  = "SELECT * FROM h_block WHERE id=$r[bid]";
		$rs1 = execute($sql4) or die("SELECT QUERY 4 $sql4 " . error_description());
		$rw1 = fetcharray($rs1);
		$block_name = $rw1["blockname"];
		mysql_free_result($rs1);

		$sql5  = "SELECT room_no FROM h_room_m WHERE id=$r[room_no]";
		$rs1 = execute($sql5) or die("SELECT QUERY 5 $sql5 " . error_description());
		$rw1 = fetcharray($rs1);
		$room_name = $rw1["room_no"];
		mysql_free_result($rs1);

		$rs1 = execute($sql1) or die("SELECT QUERY 1 $sql1 " . error_description());
		$rw1 = fetcharray($rs1);
		$course_name = $rw1["coursename"];
		mysql_free_result($rs1);

		$rs1 = execute($sql2) or die("SELECT QUERY 2 $sql2 " . error_description());
		$rw1 = fetcharray($rs1);
		$term_name = $rw1["year_name"];
		mysql_free_result($rs1);

		echo "<TR>";
			echo "<TD WIDTH='10%' ALIGN='CENTER' CLASS='row2'><B>$k</B></TD>";
			echo "<TD WIDTH='10%' CLASS='row2'><A HREF='view_hstud1.php?college=$college&student_id=$r[s_id]'><B>$r[s_id]</B></A></TD>";
			echo "<TD WIDTH='30%' CLASS='row2'><B>$r[first_name] $r[last_name]</B></TD>";
			echo "<TD WIDTH='15%' CLASS='row2'><B>$course_name</B></TD>";
			echo "<TD WIDTH='10%' CLASS='row2'><B>$term_name</B></TD>";
			echo "<TD WIDTH='25%' CLASS='row2'><B>$hostel_name, $block_name, $room_name</B></TD>";
		echo "</TR>";
		$k = $k + 1;
	}
	echo "</TBODY>";
	echo "</TABLE>";
}
elseif(rowcount($rs) == 0)
{
	echo "<DIV ALIGN='CENTER'><FONT SIZE='2'><B>";
	echo "The Student details not Found !!</B></FONT></DIV>";
}
?>
</CENTER>
</BODY>
</HTML>