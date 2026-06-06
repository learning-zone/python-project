<?php

session_start();
require("../../db.php");
/*
Displays total money collected from a student.
.
All rights Reserved.
*/

function Check_Total($total_lines, $heading, $field_header, $_LINE_, $x, $current_date, $page, $_BLANK_)
{
	if ($total_lines == 61)
	{
		fwrite($x, $_LINE_);			// LINE NO 62.
		fwrite($x, "Printed On : $current_date");	// INSERT THE PRINTING DATE IN THE TEXT FILE.
		fwrite($x, $_BLANK_);
		fwrite($x, "PAGE : $page\n\n");		// INSERT THE PAGE NUMBER IN THE TEXT FILE.
		fwrite($x, "\n\n\n\n\n\n\n\n\n\n\n\n");	// PAGE EJECT
		fwrite($x, $heading);			// INSERT THE MAIN HEADER IN THE TEXT FILE.
		fwrite($x, "\n");
		fwrite($x, $_LINE_);			// INSERT THE LINE TO THE FIELD HEADER.
		fwrite($x, $main_field_header);	// INSERT THE MAIN FIELD HEADER IN THE TEXT FILE.
		fwrite($x, $field_header);		// INSERT THE FIELD HEADER IN THE TEXT FILE.
		fwrite($x, $_LINE_);			// INSERT THE LINE TO THE FIELD HEADER.
		$total_lines = 6;
	}
	return $total_lines;
}

function Insert_Amt($varlength, $amt)
{
	$ins_line = "";
	$temp = $varlength - strlen(number_format($amt,2,".",""));
	for ($a=1;$a<=$temp;$a++)
		$ins_line .= " ";
	$ins_line .= number_format($amt,2,".","");
	return $ins_line;
}

function Insert_Others($varlength, $oval)
{
	$ins_line = $oval;
	$temp = $varlength - strlen($oval);
	for ($a=1;$a<=$temp;$a++)
		$ins_line .= " ";
	return $ins_line;
}

// THIS PART IS FOR PRINTING THE TEXT COVERTED FILE.
// BEGINS //
if (isset($print))
{
	echo "<FONT ><B>File is Priniting......</B></FONT><BR>";
	echo "<FONT ><B>The Printing File is  :: </B><B><U>$filename</U></B><BR>";
	exec("lpr $filename");
}
// ENDS //

$rs_sql=execute("SELECT * FROM college");
$r_sql=fetcharray($rs_sql);
$college_name=$r_sql[col_name];
mysql_free_result($rs_sql);

// VARIABLE DECLARATION BEGINS.
$current_date = date("d-m-Y");		// FOR STORING THE CURRENT DATE.
$filename = "../../printmodule/Hostel_Fee_Paid$current_date.txt";	// FOR STORING THE FILE NAME WITH PATH.
$heading = $college_name;
$headlen = strlen($heading);	// LENGTH FOR REPORT  HEADER.
$fld	 = "Sl. No.|Receipt No.|   Date   |Cashier            |Particulars                          		|Amount(Rs.)    |~~";
$fldlen = strlen($fld);
$page = 1;
$serial = 1;
$total_lines = 0;
$j = 0;
// ENDS

// TEXT FILE OPENING
// BEGINS
$x = fopen($filename, "w") or die("Could not open the file !!");
// ENDS

//	SET THE UNDERLINE CHARACTER VARIABLE.
//	BEGIN	//
for($num=0;$num<$fldlen+22;$num++)
{
	$_LINE_ .= "-";
}
$_LINE_ .= "\n";
//	END	//

//	SET THE BLANK VARIABLE WITH BLANK SPACES.
//	BEGIN	//
for($num=0;$num<$fldlen-22;$num++)
{
	$_BLANK_ .= " ";
}
//	END	//

//	SET THE BLANK VARIABLE TO DISPLAY THE HEADING IN CENTRE		//
//	BEGIN	//
$len_diff = $fldlen - $headlen;
if ($len_diff % 2 == 0)
	$temp = $len_diff / 2;
else
	$temp = ceil($len_diff/2);

for ($i=1;$i<=$temp;$i++)
	$_BLANK_PART2_ .= " ";

$heading = $_BLANK_PART2_ . "$heading" . $_BLANK_PART2_ . "\n";
//	END	//

// THIS IS FOR SEPARATING THE FIELDS FROM FIELD HEADER PASSED BY THE PREVIOUS FORM AND
// CALCULATING THE LENGTH OF EACH FIELD HEADER AND ALSO NUMBER OF FIELDS.
// BEGINS //
for ($i=0;$i<$fldlen;$i++)
{
	if (($fld[$i] != "|") && ($fld[$i] != "~"))
	{
		$field_header .= $fld[$i];
		$onevariable .= $fld[$i];
	}
	elseif ($fld[$i] == "|")
	{
		if (($onevariable == "Sl. No.") || ($onevariable == "Sl.")) $field_header .= " ";
		else $field_header .= "\t";
		$var_len[$j] = strlen($onevariable);
		$j++;
		$onevariable = "";
	}
	elseif (($fld[$i] == "~") && ($fld[$i+1] == "~"))
	{
		$field_header .= "\n";
	}
}
// ENDS //

//	THIS THREE LINES FOR INSERTING THE HEADER DETAILS ONLY IN FIRST PAGE.
//	BEGIN		//
fwrite($x, $heading);			// INSERT THE MAIN HEADER IN THE TEXT FILE.
fwrite($x, "\n");
fwrite($x, "Hostel Fees Paid Details Report As On $current_date\n");
fwrite($x, "---------------------------------------------------\n");
$total_lines = 3;
//	END		//

//student index not passed to this page
if(empty($id))
{
	die("<DIV CLASS='label'>Please use proper form to view money collected from a student. (1)</DIV>");
}
$stud_id = $id;
$sql  = "SELECT first_name,last_name,course_yearsem,course_admitted,academic_year ";
$sql .= "FROM student_m  WHERE id='$stud_id'";
//echo($sql."<BR>");
$rs = execute($sql);
$count = rowcount($rs);

//student index not found in the database.
if($count == 0)
{
	die("<DIV CLASS='label'>Please use proper form to view money collected from a student. (2)</DIV>");
}
$r = fetcharray($rs,0);
$name = $r[0]." " .$r[1];
$cyr = $r[2];
$course_id=$r[3];
$academic_year=$r[4];

$rs_sql=execute("SELECT * FROM course_year WHERE year_id=$cyr");
if(rowcount($rs_sql)==0)
{
	die("<FONT SIZE=2 ><B>Course Year Data Not Found.</B></FONT>");
}
else
{
	$r_sql=fetcharray($rs_sql);
	$cyr=$r_sql[year_name];
}
mysql_free_result($rs_sql);

$rs_sql=execute("SELECT * FROM course_m WHERE course_id=$course_id");
if(rowcount($rs_sql)==0)
{
	die("<FONT SIZE=2><B>Course Details  Data Not Found.</B></FONT>");
}
else
{
	$r_sql=fetcharray($rs_sql);
	$course_name=$r_sql[coursename];
}
mysql_free_result($rs_sql);
?>
<BODY>
<DIV ALIGN="CENTER"><FONT SIZE="4"><?=$college_name?></FONT></DIV>
<DIV ALIGN="CENTER">
<FONT FACE="Arial" SIZE="2"><B>Hostel Fee Paid Detail Report</B></FONT>
</DIV>
<FORM NAME="tempfrm" METHOD="POST" ACTION="paid_by_student_details.php">
<INPUT TYPE="HIDDEN" NAME="filename" VALUE="<?=$filename;?>">
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="100%">
<TR>
	<TD WIDTH="100%" ALIGN="RIGHT" COLSPAN="2">
	<INPUT TYPE="SUBMIT" NAME="print" class='bgbutton' VALUE="PRINT THE REPORT"></TD>
</TR>
<TR><TD COLSPAN="2"><B>Student Name:</B> <?=$name?></TD></TR>
<TR>
	<TD><B>Course:</B><?=$course_name?></TD>
	<TD><B>Sem:</B><?=$cyr?></TD>
</TR>
<TR><TD COLSPAN="2"><B>Academic Year:</B><?=$academic_year?></TD></TR>
</TABLE>
<CENTER>
<DIV ALIGN="RIGHT"><B>As on:</B><?=date('d-m-Y')?> <B>Time:</B> <?=date('g:i a')?></DIV>
<BR>
<TABLE BORDER="1" WIDTH="500" CELLSPACING="0" CELLPADDING="1">
<TR>
	<TD WIDTH="100" BGCOLOR="#E7C254"><STRONG><FONT FACE="Arial">Sl No.</FONT></STRONG></TD>
	<TD WIDTH="100" BGCOLOR="#E7C254"><STRONG><FONT FACE="Arial">Receipt No.</FONT></STRONG></TD>
	<TD WIDTH="150" BGCOLOR="#E7C254"><STRONG><FONT FACE="Arial">Date</FONT></STRONG></TD>
	<TD WIDTH="150" BGCOLOR="#E7C254"><FONT FACE="Arial"><STRONG>Cashier</STRONG></FONT></TD>
	<TD WIDTH="150" BGCOLOR="#E7C254"><FONT FACE="Arial"><STRONG>Particulars</STRONG></FONT></TD>
	<TD WIDTH="100" BGCOLOR="#E7C254"><FONT FACE="Arial"><STRONG>Amount</STRONG>(<SMALL>in Rs</SMALL>)</FONT></TD>
</TR>
<?php
fwrite($x, "Name : $name\n");
fwrite($x, "Course : $course_name\n");
fwrite($x, "Semester / Year : $cyr\n");
fwrite($x, "Academic Year : $academic_year\n");
fwrite($x, $_LINE_);			// INSERT THE LINE TO THE FIELD HEADER.
fwrite($x, $field_header);		// INSERT THE FIELD HEADER IN THE TEXT FILE.
fwrite($x, $_LINE_);			// INSERT THE LINE TO THE FIELD HEADER.
$total_lines += 7;

$total = 0;
$sql = "SELECT distinct(a.doc_id),a.* FROM doc_m a,doc_amt b WHERE a.stud_id=$stud_id AND a.doc_type='R' and a.doc_id=b.doc_id and b.hostel_type='Y' ORDER BY a.doc_date ";
//echo($sql);
$rs = execute($sql);
$count = rowcount($rs);
if($count == 0)
{
	die("<DIV CLASS='label'><B>$name</B> has not paid any fees.</DIV>");
}
$sl_no=1;
for($i=0;$i<$count;$i++)
{
	$r = fetcharray($rs,$i);

	$new_flag=0;
	$docdate = date("d-m-Y",strtotime($r["doc_date"]));

	$qry_sql  = "SELECT distinct(a.fee_name),b.amt,b.academic_term FROM hostel_fee_type a,doc_amt b WHERE";
	$qry_sql .= " a.fee_id=b.fee_id AND b.hostel_type='Y' AND b.doc_id='$r[doc_id]'";




	$rs_sql=execute($qry_sql);
	if(rowcount($rs_sql)==0)
	{
		//die("<FONT COLOR='RED' SIZE='2'><B> Data Not Found</B></FONT>");
	}
	else
	{
		for($j=0;$j < rowcount($rs_sql);$j++)
		{
			$r_sql=fetcharray($rs_sql,$j);
			$total += $r_sql["amt"];
			if($new_flag==0)
			{
				$fld1 = Insert_Others($var_len[0], $sl_no);
				$fld2 = Insert_Others($var_len[1], $r["doc_id"]);
				$fld3 = Insert_Others($var_len[2], $docdate);
				$fld4 = Insert_Others($var_len[3], $r["cashier_id"]);
				?>
				<TR>
				<TD WIDTH="150"><FONT FACE="Arial"><?=$sl_no?></FONT></TD>
				<TD WIDTH="100"><FONT FACE="Arial"><?=$r["doc_id"]?></FONT></TD>
				<TD WIDTH="150"><FONT FACE="Arial"><?=$docdate?></FONT></TD>
				<TD WIDTH="150"><FONT FACE="Arial"><?=$r["cashier_id"]?></FONT></TD>
				<?
			}
			else
			{
				$fld1 = Insert_Others($var_len[0], $sl_no);
				$fld2 = Insert_Others($var_len[1], "--do--");
				$fld3 = Insert_Others($var_len[2], "--do--");
				$fld4 = Insert_Others($var_len[3], "--do--");
				?>
				<TR>
				<TD WIDTH="150"><FONT FACE="Arial"><?=$sl_no?></FONT></TD>
				<TD ALIGN="CENTER">-"-</TD>
				<TD ALIGN="CENTER">-"-</TD>
				<TD ALIGN="CENTER">-"-</TD>
				<?
			}
			$amount=number_format($r_sql[amt],2,'.','');
			?>
			<TD WIDTH="150"><FONT FACE="Arial"><?=$r_sql[fee_name]?> [<?=$r_sql[academic_term]?>]</FONT></TD>
			<TD WIDTH="100" ALIGN="RIGHT"><FONT FACE="Arial"><?=$amount?></FONT></TD>
			</TR>
			<?php
			$fee_name=$r_sql["fee_name"]." [". $r_sql[academic_term]."]";
			$fld5 = Insert_Others($var_len[4], $fee_name);
			$fld6 = Insert_Amt($var_len[5], $amount);
			$line = $fld1 ."\t". $fld2 ."\t". $fld3 ."\t". $fld4 ."\t". $fld5 ."\t". $fld6 ."\n";
			fwrite($x, $line);
			$line = "";
			$total_lines++;
			$t = Check_Total($total_lines, $heading, $field_header, $_LINE_, $x, $current_date, $page, $_BLANK_);
			if ($t == $total_lines)
				$total_lines = $t;
			else
			{
				$total_lines = $t + 1;
				$page++;
			}
			$new_flag=1;
			$sl_no=$sl_no+1;
		}
	}

}
$total=number_format($total,2,'.','');
$fld1 = Insert_Others($var_len[0], "");
$fld2 = Insert_Others($var_len[1], "");
$fld3 = Insert_Others($var_len[2], "");
$fld4 = Insert_Others($var_len[3], "");
$fld5 = Insert_Others($var_len[4], "Total");
$fld6 = Insert_Amt($var_len[5], $total);
$line = $fld1 ."\t". $fld2 ."\t". $fld3 ."\t". $fld4 ."\t". $fld5 ."\t". $fld6 ."\n";
fwrite($x, $_LINE_);
fwrite($x, $line);
fwrite($x, $_LINE_);
fwrite($x, "Printed On : $current_date");	// INSERT THE PRINTING DATE IN THE TEXT FILE.
fwrite($x, $_BLANK_);
fwrite($x, "PAGE : $page\n\n");		// INSERT THE PAGE NUMBER IN THE TEXT FILE.
fclose($x);
?>
<TR>
<TD COLSPAN="5" align='right'><FONT FACE="Arial"><STRONG><B>Total</B></STRONG></FONT></TD>
<TD align='right'><FONT FACE="Arial"><STRONG><FONT><B><?=$total?></B></FONT></STRONG></FONT></TD>
</TR>
</TABLE>
</FORM>
</CENTER>
</BODY>
</HTML>
