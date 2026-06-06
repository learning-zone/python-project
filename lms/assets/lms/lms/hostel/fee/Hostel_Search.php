<?php

session_start();
include("../../db.php");


$hostel = $_POST['hostel'];
$action = $_POST['action'];
?>
<HTML>
<HEAD>
<TITLE>HOSTEL STUDENT SEARCH</TITLE>
</HEAD>
<?
if ($action == "view_fee_due_by_student.php")	$heading = "STUDENT HOSTEL FEE DUE REPORT";
elseif ($action == "paid_by_student_details.php")	$heading = "STUDENT HOSTEL FEE PAID REPORT";
elseif ($action == "student_details.php")	$heading = "APPLY HOSTEL FEE BY STUDENT";
?>
<BODY>
<CENTER>
<FORM NAME="frm" METHOD="POST" ACTION="search.php" TARGET="footer">
<INPUT TYPE="HIDDEN" NAME="action" VALUE="<?=$action?>">
<TABLE CLASS="forumline" CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="30%">
<TBODY>
<TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="3"><?=$heading;?></TD></TR>
<TR>
	<TD CLASS="rowpic" ALIGN="CENTER"><B>Hostel</B></TD>
	<TD CLASS="rowpic" ALIGN="CENTER">
		<SELECT NAME="hostel" SIZE="1">
			<OPTION VALUE="0">--- SELECT HOSTEL ---</OPTION>
			<?
			$sql = execute("SELECT * FROM hostel_m");
			if(rowcount($sql) == 0)
			{
				echo "<DIV ALIGN='CENTER'><FONT SIZE='2'><B>";
				echo "Enter Hostel Details !!</B></FONT></DIV>";
			}
			else
			{
				while ($row = fetcharray($sql))
				{
					echo "<OPTION VALUE='$row[id]'>$row[hostel_name]</OPTION>";
				}
				mysql_free_result($sql);
			}
			?>
		</SELECT>
	</TD>
	<TD ALIGN="CENTER" CLASS="rowpic"><INPUT CLASS="bgbutton" TYPE="SUBMIT" VALUE="Search"></TD>
</TR>
</TBODY>
</TABLE>
</FORM>
</CENTER>
</BODY>
</HTML>