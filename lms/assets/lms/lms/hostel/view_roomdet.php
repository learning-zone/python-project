
<HTML>
<HEAD>
<TITLE>VIEW THE ROOM DETAILS</TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
function win_close()
{
	window.close();
}
//-->
</SCRIPT>
</HEAD>
<BODY>
<CENTER>
<FORM NAME="frm" METHOD="POST">
<?php
session_start();
require("../db.php");
$id = $_REQUEST['id'];
$row = $_GET['row'];
$sql = "SELECT s_id, domain FROM h_stud_m WHERE room_no=$id";
//echo $sql;
$rs = execute($sql) or die("QUERY $sql " . error_description());
if(rowcount($rs) != 0){
?>
	<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="1" WIDTH="100%" CLASS="forumline">
	<TBODY>
	<TR>
		<TD WIDTH="15%" CLASS="head" ALIGN="CENTER"><B>Student ID</B></TD>
		<TD WIDTH="30%" CLASS="head" ALIGN="CENTER"><B>Name</B></TD>
		<TD WIDTH="25%" CLASS="head" ALIGN="CENTER"><B>Course</B></TD>
		<TD WIDTH="15%" CLASS="head" ALIGN="CENTER"><B>Term / Year</B></TD>
		<TD WIDTH="15%" CLASS="head" ALIGN="CENTER"><B>State</B></TD>
	</TR>
<?	while ($row = fetcharray($rs))
	{		if ($row["domain"] == -1)
		{
			$table1 = "student_m";
			$table2 = "course_m";
			$table3 = "course_year";
			$field1 = "id";
		}
		elseif ($row["domain"] == -2)
		{
			$table1 = "student_m";
			$table2 = "course_m";
			$table3 = "course_year";
			$field1 = "id";
		}
		elseif ($row["domain"] == -3)
		{
			$table1 = "student_m";
			$table2 = "course_m";
			$table3 = "course_year";
			$field1 = "id";
		}
		elseif ($row["domain"] > 0)	// FOR ADDITIONAL COLLEGES </
		{
			$table1 = "additional_student";
			$table2 = "additional_course";
			$table3 = "additional_term";
			$field1 = "id";
		}
		$query  = "SELECT student_id, first_name, last_name, course_admitted, course_yearsem, ";		$query .= "per_state FROM $database.$table1 WHERE $field1='$row[s_id]'";
		$res = execute($query) or die("QUERY $query " . error_description());
		$rw = fetcharray($res);

		$query  = "SELECT coursename FROM $database.$table2 WHERE course_id=$rw[course_admitted]";
		$result = execute($query) or die("QUERY $query " . error_description());
		$rw1 = fetcharray($result);
		$course = $rw1["coursename"];
		mysql_free_result($result);

		$query  = "SELECT year_name FROM $database.$table3 WHERE year_id=$rw[course_yearsem]";
		$result = execute($query) or die("QUERY $query " . error_description());
		$rw1 = fetcharray($result);
		$term = $rw1["year_name"];
		mysql_free_result($result);

		echo "<TR>";
			echo "<TD WIDTH='15%'><B>$rw[student_id]</B></TD>";
			echo "<TD WIDTH='30%'><B>$rw[first_name] $rw[last_name]</B></TD>";
			echo "<TD WIDTH='25%'><B>$course</B></TD>";
			echo "<TD WIDTH='15%'><B>$term</B></TD>";
			echo "<TD WIDTH='15%'><B>$rw[per_state]</B></TD>";
		echo "</TR>";	}
		}
		else{

	echo "<DIV ALIGN='CENTER'>";
	echo "<B>Room is Empty !!</B></TD>";
	echo "</DIV>";
}?>
<INPUT TYPE="BUTTON" NAME="b1" VALUE="<< Close >>" onClick="win_close()" CLASS="bgbutton"></FORM>

</CENTER>
</BODY></HTML>

