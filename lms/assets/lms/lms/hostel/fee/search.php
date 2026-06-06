<?php

session_start();
include("../../db.php");
if($_POST)
{
	$hostel = $_POST['hostel'];
	$action = $_POST['action'];
}
else
{
	$id= $_REQUEST['id'];
	$hostel= $_REQUEST['hostel'];
	$m= $_REQUEST['m'];
	$sid1= $_REQUEST['sid1'];
	$uid= $_REQUEST['uid'];
	$action = $_REQUEST['action'];
}
if ($hostel == 0)
{
	echo "<DIV ALIGN='CENTER'><FONT SIZE='2'><B>";
	echo "Select the Hostel !!</B></FONT></DIV>";
}
?>
<HTML>
<HEAD>
<TITLE>HOSTEL STUDENT SEARCH</TITLE>
</HEAD>
<BODY>
<CENTER>
<?
if($hostel != 0)
{
	//echo $hostel;
	$query  = "SELECT s_id, domain, first_name, last_name FROM h_stud_m WHERE h_id='$hostel' ";
	$query .= "AND archive='N' ORDER BY first_name";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) == 0)
	{
		echo "<DIV ALIGN='CENTER'><FONT SIZE='2'><B>";
		echo "No Student Details Found in the Hostel !!</B></FONT></DIV>";
	}
	else
	{
		echo "<FORM NAME='frm' METHOD='POST'>";
		echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0' WIDTH='30%' CLASS='forumline'>";
		echo "<TBODY>";
		echo "<TR><TD WIDTH='40%' ALIGN = 'CENTER' COLSPAN='2' CLASS='head'><B>Student Details</B></TD></TR>";
		echo "<TR>";
			echo "<TD WIDTH='20%' CLASS='rowpic' ALIGN='CENTER'><B>Student ID</B></TD>";
			echo "<TD WIDTH='40%' CLASS='rowpic' ALIGN='CENTER'><B>Name</B></TD>";
		echo "</TR>";
		$query  = "SELECT DISTINCT(a.student_id) AS unid, a.id, a.first_name, a.last_name, ";
		$query .= "a.student_id FROM student_m a, h_stud_m b WHERE b.s_id=a.id ";
		$query .= "AND b.h_id=$hostel AND b.archive='N' ORDER BY a.first_name";
		//echo $query;

		$res = execute($query) or die("QUERY $query " . error_description());
		if (rowcount($res) != 0)
		{
			//echo "inside";
			while ($row = fetcharray($res))
			{
				echo "<TR>";
					echo "<TD WIDTH='20%' CLASS='row2'><A HREF='$action?id=$row[id]&hostel=$hostel&m=0&sid1=$row[student_id]&uid=$row[unid]'><B>$row[student_id]</B></A></TD>";
					echo "<TD WIDTH='40%' CLASS='row2'><B>$row[first_name] $row[last_name]</B></TD>";
				echo "</TR>";
			}
			mysql_free_result($res);
		}

		$query  = "SELECT DISTINCT(a.student_id) AS unid, a.id, a.first_name, a.last_name, ";
		$query .= "a.student_id FROM additional_student a, h_stud_m b WHERE b.s_id=a.student_id ";
		$query .= "AND b.h_id=$hostel AND b.archive='N' ORDER BY a.first_name";
		//echo $query;
		$res = execute($query) or die("QUERY $query " . error_description());
		if (rowcount($res) != 0)
		{
			while ($row = fetcharray($res))
			{
				echo "<TR>";
					echo "<TD WIDTH='20%' CLASS='row2'><A HREF='$action?id=$row[id]&hostel=$hostel&m=1&sid1=$row[student_id]&uid=$row[unid]'><B>$row[student_id]</B></A></TD>";
					echo "<TD WIDTH='40%' CLASS='row2'><B>$row[first_name] $row[last_name]</B></TD>";
				echo "</TR>";
			}
			mysql_free_result($res);
		}
		echo "</TBODY>";
		echo "</TABLE>";
		echo "</FORM>";
	}
}
?>
</BODY>
</HTML>