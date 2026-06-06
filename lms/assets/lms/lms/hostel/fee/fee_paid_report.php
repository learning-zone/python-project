<?php
session_start();
include("../../db.php");

$college = $_POST['college'];
$hostel = $_POST['hostel'];
$feename = $_POST['feename'];

$FDay = $_POST['FDay'];
$FMon = $_POST['FMon'];
$FYear = $_POST['FYear'];

$TDay = $_POST['TDay'];
$TMon = $_POST['TMon'];
$TYear = $_POST['TYear'];

$generate = $_POST['generate'];
/*
if($user=='')
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
}

*/
$query  = "SELECT fee_id, fee_name FROM hostel_fee_type WHERE status=1";
$rs = execute($query) or die("QUERY $query " . error_description());
if (rowcount($rs) == 0)
{
	//echo "<DIV ALIGN='CENTER'>";
	//echo "Describe Fee Structure !!</B>";
	?>
    <script type="text/javascript">
	alert("Describe Fee Structure !!");
	</script>
    <?
	die();
}
?>
<HTML>
<HEAD>
<TITLE>HOSTEL FEE PAID REPORT</TITLE>
</HEAD>
<BODY>
<CENTER>
<FORM METHOD="POST" ACTION="fee_paid_by_student.php" NAME="frm">
<TABLE CLASS="forumline" ALIGN="CENTER">
<TBODY>
<TR><TD CLASS="head" COLSPAN="2" WIDTH="100%" ALIGN="CENTER">FEE PAID REPORT</TD></TR>
<TR>
	<TD ALIGN="LEFT" CLASS="row2" WIDTH="20%">Select College:</TD>
	<TD ALIGN="LEFT" CLASS="row2" WIDTH="80%">
		<SELECT NAME="college" SIZE="1">
			<?//<OPTION VALUE="0">ALL</OPTION>?>
<!--
			<OPTION VALUE="-1/dmist">DENTAL</OPTION>
			<OPTION VALUE="-2/col">ENGINEERING</OPTION>
			<OPTION VALUE="-3/dsman">MANAGEMENT</OPTION>
-->
			<OPTION VALUE="-1">DENTAL</OPTION>
			<OPTION VALUE="-2">ENGINEERING</OPTION>
			<OPTION VALUE="-3">MANAGEMENT</OPTION>

			<?
			$query  = "SELECT * FROM additional_college ORDER BY col_id ASC";
			//echo $query;
			$res = execute($query) or die("QUERY $query " . error_description());
			if (rowcount($res) != 0)
			{
				while ($row = fetcharray($res))
				{
					//echo "<OPTION VALUE='$row[col_id]/col'>$row[col_name]</OPTION>";
					echo "<OPTION VALUE='$row[col_id]'>$row[col_name]</OPTION>";
		

				}
				mysql_free_result($res);
			}
			?>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD CLASS="row2" WIDTH="20%">Select Hostel</TD>
	<TD CLASS="row2" WIDTH="80%">
		<SELECT NAME='hostel'>
			<OPTION VALUE='0'>All</OPTION>
			<?
			$query  = "SELECT * FROM hostel_m";
			$res = execute($query) or die("QUERY $query " . error_description());
			if(rowcount($res) != 0)
			{
				while ($row = fetcharray($res))
				{
					echo "<OPTION VALUE='$row[id]'>$row[hostel_name]</OPTION>";
				}
				mysql_free_result($res);
			}
			?>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD CLASS="row2" WIDTH="20%">Fees</TD>
	<TD CLASS="row2" WIDTH="80%">
		<SELECT NAME="feename">
			<OPTION VALUE="0">All</OPTION>
			<?php
			while ($row = fetcharray($rs))
			{
				echo("<OPTION VALUE='$row[fee_id]'>$row[fee_name]</OPTION>\n");
			}
			mysql_free_result($rs);
			?>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD CLASS="row2" WIDTH="20%">From Date</TD>
	<TD CLASS="row2" WIDTH="80%">
		<INPUT TYPE="TEXT" NAME="FDay" SIZE="2" MAXLENGTH="2">-
		<INPUT TYPE="TEXT" NAME="FMon" SIZE="2" MAXLENGTH="2">-
		<INPUT TYPE="TEXT" NAME="FYear" SIZE="4" MAXLENGTH="4"><BR>
		DD-MM-YYYY
	</TD>
</TR>
<TR>
	<TD CLASS="row2" WIDTH="20%">To Date</TD>
	<TD CLASS="row2" WIDTH="80%">
		<INPUT TYPE="TEXT" NAME="TDay" SIZE="2" MAXLENGTH="2">-
		<INPUT TYPE="TEXT" NAME="TMon" SIZE="2" MAXLENGTH="2">-
		<INPUT TYPE="TEXT" NAME="TYear" SIZE="4" MAXLENGTH="4"><BR>
		DD-MM-YYYY
	</TD>
</TR>
</TBODY>
</TABLE>
<br>
<CENTER>
	<INPUT TYPE="SUBMIT" NAME="generate" CLASS="bgbutton" VALUE="Generate Report"></TD>
</CENTER>

</FORM>
</CENTER>
</BODY>
</HTML>