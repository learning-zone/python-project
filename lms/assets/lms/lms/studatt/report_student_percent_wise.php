<HTML>
<HEAD>
<?
session_start();
include("../db.php");
// FUNCTION FOR TAKING THE MONTH NAME //
function Month_Name($mont)
{
	switch($mont)
	{
		case '01': return "JANUARY"; break;
		case '02': return "FEBRUARY"; break;
		case '03': return "MARCH"; break;
		case '04': return "APRIL"; break;
		case '05': return "MAY"; break;
		case '06': return "JUNE"; break;
		case '07': return "JULY"; break;
		case '08': return "AUGUST"; break;
		case '09': return "SEPTEMBER"; break;
		case '10': return "OCTOBER"; break;
		case '11': return "NOVEMBER"; break;
		case '12': return "DECEMBER"; break;
	}
}

// VARIABLE DECLARATIONS & DEFINITIONS.
$serial = 1;
$count = 1;
$total_marks = 0;
$max_marks=0;
?>

<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = "";
}
</script>
<TITLE>WELCOME TO EMIST</TITLE>
</HEAD>
<BODY>
<CENTER>
<?
	// TAKING THE COURSE NAME FROM COURSE ID.
	$query  = "SELECT coursename, course_abbr FROM course_m WHERE course_id=$course";
	$rs = execute($query) or die("QUERY $query " .error_description());
	if (rowcount($rs) == 0)
	{
		echo "<DIV ALIGN=CENTER><B><FONT COLOR=#FF0000>NO COURSES DEFINED!!</B></FONT></DIV>";
		die();
	}
	else
	{
		$row = fetcharray($rs);
		$course_name = $row["coursename"];
		$course_abbr = $row["course_abbr"];
		mysql_free_result($rs);
	}

	// TAKING THE COURSE YEAR / SEMESTER NAME FROM COURSE YEAR ID.
	$query  = "SELECT year_name FROM course_year WHERE year_id=$course_year";
	$rs = execute($query) or die("QUERY $query " .error_description());
	if (rowcount($rs) == 0)
	{
		echo "<DIV ALIGN=CENTER><B><FONT COLOR=#FF0000>NO YEARS / SEMESTERS DEFINED!!</B></FONT></DIV>";
		die();
	}
	else
	{
		$row = fetcharray($rs);
		$year_name = $row["year_name"];
		mysql_free_result($rs);
	}



	// TAKING THE SESSIONAL DETAILS FROM SESSIONAL NAME.
	$fld = "SlNo. \tReg.No. \tName                    \t";
	$sesdate = Sessional_Date($Sessions, $course, $acayr, $course_year);
	$temp = explode(":", $sesdate);
	$start_Date = date("d-m-Y", strtotime($temp[0]));
	$end_Date = date("d-m-Y", strtotime($temp[1]));
	$MONTH1 = Month_Name(substr($start_Date, 3, 2));
	$MONTH2 = Month_Name(substr($end_Date, 3, 2));
	$YEAR1 = substr($start_Date, 6, 4);
	$YEAR2 = substr($end_Date, 6, 4);
	if ($YEAR1 == $YEAR2)
		$year_flag = 0;
	else
 		$year_flag = 1;

	// FOR TAKING THE COLLEGE NAME TO DISPLAY.
	$query  = "SELECT col_name, col_addr FROM college";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) == 0)
	{
		echo "<DIV ALIGN=CENTER><B><FONT COLOR=#FF0000>NO COLLEGES FOUND!!</B></FONT></DIV>";
		die();
	}
	else
	{
		$row = fetcharray($rs);
		$college = $row["col_name"] .",". $row["col_addr"];
		mysql_free_result($rs);
	}
	$rcount=0;
	while(list($key,$val) = each($subject))
	{
		$rcount=$rcount+1;
	}
	$rcount=$rcount+4;
	reset($subject);
	?>
	<TABLE  class=forumline>
	<TBODY>
	<TR>
	<TD ALIGN="CENTER" class=head colspan=<?=$rcount?>><B>
	View Students Percentage Wise </B></TD>

	</TR>
	<TR>
	<TD ALIGN="CENTER" class=row3 colspan=<?=$rcount?>><B>Percentage <?=$per_from?>% To <?=$per_to?>%
	</B></TD>
	</TR>
	<TR>
	<TD ALIGN="CENTER" colspan=<?=$rcount?> class=row3><B>
	<?
	echo "INTERNAL ASSESSMENT MARKS - $year_name $course_abbr, EXAM - ";
	if ($year_flag == 0)
		echo "$MONTH1 / $MONTH2 $YEAR1";
	else
		echo "$MONTH1 $YEAR1 / $MONTH2 $YEAR2";

	if($course_section !=0)
	{
		$rs_section=execute("select section_name from class_section where id=$course_section");
		$r_section=fetcharray($rs_section);
		$section_name=$r_section[0]." - Section";
	}
	else
	{
		$section_name='No Section';
	}
	?>
	</B>
	</TD>
	</TR>
	<TR><TD colspan=<?=$rcount?>>&nbsp;</TD></TR>
	<TR>
	<TD ALIGN="LEFT" class=row3 colspan=<?=$rcount?>><B>COLLEGE : <?=$college;?></B></TD>
	</TR>
	<FORM NAME="frm" METHOD="POST">
	<INPUT TYPE="HIDDEN" NAME="filename" VALUE="<?=$filename;?>">
	<INPUT TYPE="HIDDEN" NAME="branch_id" VALUE="<?=$branch_id;?>">
	<INPUT TYPE="HIDDEN" NAME="course" VALUE="<?=$course;?>">
	<INPUT TYPE="HIDDEN" NAME="course_year" VALUE="<?=$course_year;?>">
	<TR><TD colspan=<?=$rcount?>>&nbsp;</TD></TR>
	<TR>
	<TD class=row2 ALIGN="LEFT" colspan=<?=$rcount?>><B>BRANCH : <?=$course_name;?>/<?=$section_name?>
	</B></TD>
	</TR>

	<TR>
	<TD CLASS=ROWPIC><B>Sl. No.</B></TD>
	<TD CLASS=ROWPIC><B>Reg. No.</B></TD>
	<TD CLASS=ROWPIC><B>Name</B></TD>
	<?
	// TAKING THE SUBJECT NAMES TO DISPLAY.
	$flag=0;
	while(list($key,$val) = each($subject))
	{
		if($flag==0)
		{
			$sql1= " (subject_id=$val ";
			$flag=1;
		}
		else
		{
			$sql1.=" or subject_id=$val ";
		}
	}
	$sql1.=" ) ";

	//Loop thru all selected fees.

	$query  = "SELECT * FROM subject_m WHERE course_id=$course AND ";
	$query.= $sql1;
	$query .= " and course_year_id=$course_year ORDER BY subject_id ASC";

	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs)==0)
	{
		echo "<DIV ALIGN=CENTER><B><FONT COLOR=#FF0000 SIZE=2>NO SUBJECTS FOUND !!</B>";
		echo "</DIV>";
		die();
	}
	else
	{
		while ($row = fetcharray($rs))
		{
			echo "<TD CLASS=ROWPIC><B>$row[subject_code]</B></TD>";
			$fld.=$row[subject_code]."\t";

			$subject_code[$count] = $row["subject_id"];
			$count++;
		}
		mysql_free_result($rs);
	}
	?>
	<TD CLASS=ROWPIC><B>Total</B></TD>
	</TR>
	<?
	if($course_section==0)
	{
		$query  = "SELECT first_name, last_name, student_id FROM student_m WHERE ";
		$query .= "course_admitted=$course AND course_yearsem=$course_year AND ";
		$query .= "academic_year=$acayr  and archive='N' ORDER BY student_id ASC";
	}
	else
	{
		$query  = "SELECT first_name, last_name, student_id FROM student_m WHERE ";
		$query .= "course_admitted=$course AND course_yearsem=$course_year AND ";
		$query .= "academic_year=$acayr  and archive='N' and class_section_id=$course_section ORDER BY student_id ASC";
	}
	
	$rs = execute($query) or die("QUERY $query " . error_description());
	$sql_echo="";
	while ($row = fetcharray($rs))
	{
		$new_flag=0;
		$sql_echo .= "<TR>";
		$sql_echo .= "<TD ALIGN=CENTER><B>$serial</B></TD>";
		$sql_echo .= "<TD ALIGN=LEFT><B>$row[student_id]</B></TD>";
		$sql_echo .= "<TD ALIGN=LEFT NOWRAP><B>$row[first_name] $row[last_name]</B></TD>";
		for ($i=1;$i<$count;$i++)
		{
			$query  = "SELECT marks_attained FROM marks_m WHERE student_id=";
			$query .= "'$row[student_id]' AND subject_id=$subject_code[$i] AND " ;
			$query .= "course_year_id=$course_year AND academic_year=$acayr AND ";
			$query .= "sessional='$Sessions'";
			$res = execute($query) or die("QUERY $query " . error_description());
			$rw = fetcharray($res);

			$rs_subject_m=execute("select total_marks from subject_m where subject_id=$subject_code[$i]");
			$r_subject_m=fetcharray($rs_subject_m);
			$max_marks=$r_subject_m[0];



			$marks = $rw["marks_attained"];
			if($marks=="")
			{
				$marks="-";

				$display_marks="-";

			}
			else
			{
				$marks_per=number_format((($marks/$max_marks)*100),1);
				if($marks_per >= $per_from and $marks_per <= $per_to)
				{
					$new_flag=1;
				}
				$display_marks=$marks."/".$max_marks;
				$total_max=$total_max + $max_marks;

			}

			$color_dd=marks_color($max_marks,$marks);

			$sql_echo .= "<TD ALIGN=RIGHT><font color='$color_dd'><B>$display_marks</B></font></TD>";

			if($marks=="-")
			{
				$marks="0";

			}
			$total_marks += $marks;




		}
		$color_dd=marks_color($total_max,$total_marks);
		$sql_echo .= "<TD ALIGN=RIGHT><font color='$color_dd'><B>$total_marks/$total_max</B></font></TD>";
		$sql_echo .= "</TR>";
		if($new_flag==1)
		{
			echo $sql_echo;
			$new_flag=0;
			$sql_echo="";
			$serial++;
		}
		else
		{
			$sql_echo="";
		}

		$total_marks = 0;
		$total_max=0;
	}
	echo "<br>";

?>
</TBODY></TABLE></TD></TR></TBODY></TABLE>
<br>
</CENTER>
<?php
include("marks_color_table.php");

?>
</BODY></HTML>