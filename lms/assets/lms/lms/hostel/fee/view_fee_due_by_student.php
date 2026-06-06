



<?php
/************* FILE DETAILS ******************/
//	MODIFIED BY : MAHESH R

session_start();
require("../../db.php");
/*
View Student's Fees Dues.

All rights Reserved.
*/

function Check_Total($total, $heading, $field_header, $_LINE_, $x, $current_date, $page, $_BLANK_)
{
	if ($total == 61)
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
		$total = 6;
	}
	return $total;
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
	echo "<FONT color=0000FF><B>File is Priniting......</B></FONT><BR>";
	echo "<FONT color=#FF0000><B>The Printing File is  :: </B><B><U>$filename</U></B><BR>";
	exec("lpr $filename");
}
// ENDS //

$rs_sql=execute("SELECT * FROM college");
$r_sql=fetcharray($rs_sql);
$college_name=$r_sql[col_name];

// VARIABLE DECLARATION BEGINS.
$current_date = date("d-m-Y");		// FOR STORING THE CURRENT DATE.
$filename = "../../printmodule/Hostel_Student_Due$current_date.txt";	// FOR STORING THE FILE NAME WITH PATH.
$heading = $college_name;
$headlen = strlen($heading);	// LENGTH FOR REPORT  HEADER.
$fld	 = "Sl. No.|Fee Name                      | Academic Term   | Due Date |Fee Amount(Rs.)|Fee Paid(Rs.)|Fee Due(Rs.)|~~";
$fldlen = strlen($fld);
$page = 1;
$serial = 1;
$total = 0;
$j = 0;
// ENDS

// TEXT FILE OPENING
// BEGINS
$x = fopen($filename, "w") or die("Could not open the file !!");
// ENDS

//	SET THE UNDERLINE CHARACTER VARIABLE.
//	BEGIN	//
for($num=0;$num<$fldlen+12;$num++)
{
	$_LINE_ .= "-";
}
$_LINE_ .= "\n";
//	END	//

//	SET THE BLANK VARIABLE WITH BLANK SPACES.
//	BEGIN	//
for($num=0;$num<$fldlen-25;$num++)
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
fwrite($x, "Hostel Fees Due Report As On $current_date\n");
fwrite($x, "----------------------------------------\n");
$total = 3;
//	END		//
?>
<HTML>
<HEAD>
<TITLE>Due Details</TITLE>
</HEAD>
<?php
if(empty($id))
{
	die("<DIV CLASS='label'>Please follow proper procedure.</DIV>");
}
$sql  = "SELECT a.*,b.coursename,c.year_name FROM student_m a, ";
$sql .= "course_m b,course_year c  WHERE a.id=$id AND ";
$sql .= "a.course_admitted=b.course_id AND a.course_yearsem = c.year_id";
//echo($sql);
$rs = execute($sql);
$num = rowcount($rs);
if($num != 1)
{
	die("<DIV CLASS='label'><U>Error</U>: Incorrect Student I.D.</DIV>");
}
$r = fetcharray($rs,0);
?>
<BODY>
<DIV ALIGN="CENTER"><FONT SIZE="4"><?=$college_name?></FONT></DIV>
<FORM NAME="tempfrm" METHOD="POST" ACTION="view_fee_due_by_student.php">
<INPUT TYPE="HIDDEN" NAME="filename" VALUE="<?=$filename;?>">
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="100%">
<TR>
	<TD WIDTH="100%" ALIGN="RIGHT">
	<INPUT TYPE="SUBMIT" class="bgbutton" NAME="print" VALUE="PRINT THE REPORT"></TD>
</TR>
<TR>
	<TD ALIGN="CENTER" WIDTH="100%">
	<FONT FACE="Arial" COLOR="#0000FF" SIZE="2"><B> HOSTEL FEE DUE REPORT</B></FONT></TD>
</TR>
</TABLE>
<DIV ALIGN='RIGHT'><B>As On:</B> <?=date("d-m-Y : g:i a");?></DIV>
<TABLE BORDER="0"  ALIGN="CENTER" CELLPADDING="0" CELLSPACING="0">
<TR>
	<TD><B>Name</B>:</TD>
	<TD><?=$r["first_name"]?> <?=$r["last_name"]?></TD>
	<TD ><B>I.D.</B>:</TD>
	<TD ><?=$r["student_id"]?></TD>
</TR>
<TR>
	<TD><B>Course</b>:</TD>
	<TD><?=$r["coursename"]?></TD>
	<TD><B>Sem</B>:</TD>
	<TD><?=$r["year_name"]?></TD>
</TR>
</TABLE>
<?php
fwrite($x, "Name : $r[first_name] $r[last_name]\n");
fwrite($x, "ID : $r[student_id]\n");
fwrite($x, "Course : $r[coursename]\n");
fwrite($x, "Semester / Year : $r[year_name]\n");
fwrite($x, $_LINE_);			// INSERT THE LINE TO THE FIELD HEADER.
fwrite($x, $field_header);		// INSERT THE FIELD HEADER IN THE TEXT FILE.
fwrite($x, $_LINE_);			// INSERT THE LINE TO THE FIELD HEADER.
$total += 7;
$str  = "<TABLE BORDER='1' CELLSPACING=0 ALIGN='CENTER'>";
$str .= "<TR>";
$str .= "<TD ALIGN='CENTER'><B>Sl No.</B></TD>";
$str .= "<TD ALIGN='CENTER'><B>Fee Name</B></TD>";
$str .= "<TD ALIGN='CENTER'><B>Academic Term</B></TD>";
$str .= "<TD ALIGN='CENTER'><B>Due Date</B></TD>";
$str .= "<TD ALIGN='CENTER'><B>Fee Amount</B></TD>";
$str .= "<TD ALIGN='CENTER'><B>Fee Paid</B></TD>";
$str .= "<TD ALIGN='CENTER'><B>Fee Due</B></TD>";
$str .= "</TR>";
$tot = 0;
$DueTotal = 0;
$flag = 0;
$sl_no=0;
$sql = "SELECT b.*,a.fee_name FROM fee_det b,hostel_fee_type a  WHERE b.hostel_type='Y' AND b.stud_id = $id AND b.paid='No' AND a.fee_id = b.fee_id";


$rs2 = execute($sql);
$r2Num = rowcount($rs2);
for($j=0;$j<$r2Num;$j++)
{
	$r2 = fetcharray($rs2,$j);
	if($r2[hostel_type]=='N')
	{
		if($r2["installment"] !=0)
		{
			$feename = $r2["fee_name"] . " - Inst " . $r2["installment"];
		}
		else
		{
			$feename = $r2["fee_name"];
		}
	}
	else
	{
		if($r2["installment"] !=0)
		{
			$feename = $r2["fee_name"] . " - Inst " . $r2["installment"];
		}
		else
		{
			$feename = $r2["fee_name"];
		}



	}
	$academic_term=$r2[academic_term];
	$temp=$r2[amt];
	$paid=$r2[fee_amount]-$r2[amt];
	$DueTotal += $temp;
	$paid=number_format($paid, 2, '.', '');
	$sl_no=$sl_no+1;
	$due_date=date('d-m-Y',strtotime($r2[due_date]));
	$fld1 = Insert_Others($var_len[0], $sl_no);
	$fld2 = Insert_Others($var_len[1], $feename);
	$fld3 = Insert_Others($var_len[2], $academic_term);
	$fld4 = Insert_Others($var_len[3], $due_date);
	$fld5 = Insert_Amt($var_len[4], $r2["fee_amount"]);
	$fld6 = Insert_Amt($var_len[5], $paid);
	$fld7 = Insert_Amt($var_len[6], $temp);
	$line = $fld1 ." ". $fld2 ."\t". $fld3 ."\t". $fld4 ."\t". $fld5 ."\t". $fld6 ."\t". $fld7 ."\n";
	fwrite($x, $line);
	$line = "";
	$total++;
	$t = Check_Total($total, $heading, $field_header, $_LINE_, $x, $current_date, $page, $_BLANK_);
	if ($t == $total)
		$total = $t;
	else
	{
		$total = $t + 1;
		$page++;
	}

	$str .= "<TR>";
	$str .= "<TD>$sl_no</TD>";
	$str .= "<TD >" . $feename . "</TD>";
	$str .= "<TD >" . $academic_term . "</TD>";
	$str .= "<TD NOWRAP>$due_date</TD>";
	$str .= "<TD ALIGN='RIGHT'>" . $r2["fee_amount"] . "</TD>";
	$str .= "<TD ALIGN='RIGHT'><FONT COLOR='RED'>$paid</FONT></TD>";
	$str .= "<TD ALIGN='RIGHT'><FONT COLOR='RED'>$temp</FONT></TD>";
	$str .= "</TR>";
	$tot += $r2["fee_amount"];
}

$PaidTotal=$tot-$DueTotal;
$PaidTotal=number_format($PaidTotal,2,'.','');
$tot=number_format($tot,2,'.','');
$DueTotal=number_format($DueTotal,2,'.','');
$fld1 = Insert_Others($var_len[0], "");
$fld2 = Insert_Others($var_len[1], "");
$fld3 = Insert_Others($var_len[2], "");
$fld4 = Insert_Others($var_len[3], "Total");
$fld5 = Insert_Amt($var_len[4], $tot);
$fld6 = Insert_Amt($var_len[5], $PaidTotal);
$fld7 = Insert_Amt($var_len[6], $DueTotal);
$line = $fld1 ." ". $fld2 ."\t". $fld3 ."\t". $fld4 ."\t". $fld5 ."\t". $fld6 ."  ". $fld6."\n";
fwrite($x, $_LINE_);
fwrite($x, $line);
fwrite($x, $_LINE_);
fwrite($x, "Printed On : $current_date");	// INSERT THE PRINTING DATE IN THE TEXT FILE.
fwrite($x, $_BLANK_);
fwrite($x, "PAGE : $page\n\n");		// INSERT THE PAGE NUMBER IN THE TEXT FILE.
fclose($x);
?>
<?=$str?>
<TR>
	<TD ALIGN="RIGHT" COLSPAN="4"><B>Total</B></TD>
	<TD ALIGN="RIGHT"><B><?=$tot?></B></TD>
	<TD ALIGN="RIGHT"><FONT COLOR="BLUE"><B><?=$PaidTotal?></B></FONT></TD>
	<TD ALIGN="RIGHT"><FONT COLOR="RED"><B><?=$DueTotal?></B></FONT></TD>
</TR>
</TABLE>
</FORM>
</BODY>
</HTML>
