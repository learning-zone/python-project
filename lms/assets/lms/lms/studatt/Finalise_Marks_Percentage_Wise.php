<HTML>
<HEAD>
</HEAD>
<BODY>
<?php
session_start();
include("../db.php"); V
$current_date = date("d-m-Y", strtotime($_STARTOFDAY_));		
$getyearn=$getyear+1;
$serial = 1;
$total = 0;
$j = 0;

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

$serial = 1;
$count = 1;
$total_marks = 0;
?>
<HTML>
<HEAD>
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
    $query  = "SELECT coursename, course_abbr FROM course_m WHERE course_id=0";
	$rs = execute($query) or die("QUERY $query " .error_description());
	if (rowcount($rs) == 0)
	{
		$course_name = "";
		$course_abbr = "";
	}
	else
	{
		$row = fetcharray($rs);
		$course_name = $row["coursename"];
		$course_abbr = $row["course_abbr"];
		mysql_free_result($rs);
	}

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


		if($course_section!='0')
		{
			$query  = "SELECT section_name FROM class_section WHERE id=$course_section";
			$rs = execute($query) or die("QUERY $query " .error_description());
			if (rowcount($rs) == 0)
			{
				echo "<DIV ALIGN=CENTER><B><FONT COLOR=#FF0000>NO YEARS / SEMESTERS DEFINED!!</B></FONT></DIV>";
				die();
			}
			else
			{
				$row = fetcharray($rs);
				$section_name = $row["section_name"];
				mysql_free_result($rs);
			}
		}
		else
		{
			$section_name='No Section';
		}


	$fld = "SlNo. \tReg.No. \tName                    \t";
	$course=0;
	$acayr=0;
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
	$rcount=$rcount+10;
	reset($subject);
?>
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="1" class=forumline>
<TBODY>
<TR><TD   ALIGN="CENTER" class=row3 colspan=<?=$rcount?>><B>INTERNAL EXAMINATION SECTION	</B></TD>
</TR>
</TR>
	<TR>
		<TD ALIGN="CENTER" class=row3 colspan=<?=$rcount?>><B>Percentage <?=$per_from?>% To <?=$per_to?>%
		</B>
		</TD>
	</TR>
<TR>
	<TD ALIGN="CENTER" colspan=<?=$rcount?> class=row3><B>
	<?php
	echo "INTERNAL ASSESSMENT MARKS - $year_name $course_abbr, EXAM - ";
	if ($year_flag == 0)
		echo "$MONTH1 / $MONTH2 $YEAR1";
	else
		echo "$MONTH1 $YEAR1 / $MONTH2 $YEAR2";
	?>
	</B></TD>
</TR>
<TR>
	<TD colspan=<?=$rcount?>>&nbsp;</TD>
</TR>
<TR>
	<TD ALIGN="LEFT" class=row3 colspan=<?=$rcount?>><B>COLLEGE : <?=$college;?></B></TD>
</TR>
	        <FORM NAME="frm" METHOD="POST">
	        <INPUT TYPE="HIDDEN" NAME="branch_id" VALUE="<?=$branch_id;?>">
            <INPUT TYPE="HIDDEN" NAME="course" VALUE="<?=$course;?>">
			<INPUT TYPE="HIDDEN" NAME="course_year" VALUE="<?=$course_year;?>">
<TR>
	<TD colspan=<?=$rcount?>>&nbsp;</TD>
</TR>
<TR>
	<TD class=row2 ALIGN="LEFT" colspan=<?=$rcount?>><B>Sem : <?=$year_name;?>/<?=$section_name;?>
	</B>
	</TD>
</TR>
<TR>
	<TR>
	<TD CLASS=ROWPIC><B>Sl. No.</B></TD>
	<TD CLASS=ROWPIC><B>Reg. No.</B></TD>
	<TD CLASS=ROWPIC><B>Name</B></TD>
	<?php

		$flag=0;
while(list($key,$val) = each($subject))
{
	if($flag==0)
	{
		$sql1= " (subject_id=$val ";
		$sql21= " (id=$val ";
		$flag=1;
	}
	else
	{
		$sql1.=" or subject_id=$val ";
		$sql21.=" or id=$val ";
	}
}
$sql1.=" ) ";
$sql21.=" ) ";

	$MySubCodeArray=array();
	$SubjectName=array();
	if($course==0)
	{
			$tsql_1=execute("select distinct(maj_id) from major_master where section_id=$course_section");
			$rs_tgsql1=fetcharray($tsql_1);
			$tsql=execute("select * from common_m where course_year_id=$course_year and $sql1");
			for($ki=0;$ki<rowcount($tsql);$ki++)
			{
				$trs=fetcharray($tsql,$ki);
				$MySubCodeArray[$ki]="common_m_".$trs["subject_id"];
				$SubjectName[$ki]=$trs["subject_code"];
				$SubjectID[$ki]=$trs["subject_id"];
				$MajorID[$ki]=0;
			}
			$majorid=$rs_tgsql1[0];
			$tsql1=execute("select * from major where major_id=$rs_tgsql1[0] and course_year_id=$course_year and $sql21");
			for($kii=0;$kii<rowcount($tsql1);$kii++)
			{
				$trs1=fetcharray($tsql1,$kii);

				$MySubCodeArray[$ki]="major_".$trs1["id"];
				$SubjectName[$ki]=$trs1["subject_code"];
				$SubjectID[$ki]=$trs1["id"];
				$MajorID[$ki]=$trs1["major_id"];
				$ki++;
			}
	}
if($course==0)
{
for($dd=0;$dd<$ki;$dd++)
{
	echo "<TD CLASS=ROWPIC><B>$SubjectName[$dd]</B></TD>";
}
}

	?>
	<TD CLASS=ROWPIC><B>Total</B></TD>
	</TR>
<?php
$line_marks="";
if($course==0)
{
	$query  = "SELECT first_name, last_name, student_id FROM student_m WHERE ";
	$query .= "course_yearsem=$course_year AND ";
	$query .= "archive='N' and class_section_id=$course_section ORDER BY student_id ASC";
}
$rs = execute($query) or die("QUERY $query " . error_description());
while ($row = fetcharray($rs))
{
	$total_max=0;
	$sql_echo="<TR>";
	
		$sql_echo.="<TD ALIGN=CENTER><B>$serial</B></TD><TD ALIGN=LEFT><B>$row[student_id]</B></TD><TD ALIGN=LEFT NOWRAP><B>$row[first_name], $row[last_name]</B></TD>";
		for ($i=0;$i<$ki;$i++)
		{
			$query  = "SELECT marks_attained FROM marks_m WHERE student_id=";
			$query .= "'$row[student_id]'";
			$res = execute($query) or die("QUERY $query " . error_description());
			$rw = fetcharray($res);
			$maximum1_marks=$trs1[total_marks];
			if($course==0)
			{
				$max_marks=25;
			}
			$marks = $rw["marks_attained"];
			if($marks=="")
			{
				$marks="-";
				$display_marks="-";
			}
			else
			{
				$marks_per=number_format((($marks/$maximum1_marks)*100),1);
				if($marks_per >= $per_from and $marks_per <= $per_to)
				{
					$new_flag=1;
				}
				$display_marks=$marks."/".$maximum1_marks;
				$total_max=$total_max + $maximum1_marks;
			}
				$color_dd=marks_color($max_marks,$marks);
			
			$sql_echo.="<TD ALIGN=RIGHT><font color='$color_dd'><B>$display_marks</B></font></TD>";			
			if($marks=="-")
			{
				$marks="0";
			}
			else
			{
				$total_max=$total_max+$maximum1_marks;
			}
			$total_marks += $marks;
			$name=$row["first_name"]." ".$row["last_name"];
		}
		$line_marks.=$total_marks."";
		$sql_echo.= "<TD ALIGN=RIGHT><B>$total_marks/$total_max</B></TD></TR>";
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
}
echo "<br>";
?>
</TBODY>
</TABLE>
</TD>
</TR>
</TBODY>
</TABLE>
<br>
</CENTER>
<?php
	include("marks_color_table.php");
?>
<BR>
<div id=prn align=center>
<INPUT TYPE="button" NAME="print" class=bgbutton VALUE="PRINT THE REPORT" onclick='printReport()'>
</div>
</BODY>
</HTML>