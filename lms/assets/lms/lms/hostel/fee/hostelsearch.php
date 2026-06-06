<?php
session_start();
include("../../db.php");
$hostel = $_POST['hostel'];
/*  if($user=='')
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
}  */
?>
<HTML>
<HEAD>
<TITLE>HOSTEL ACCOMODATION REPORT</TITLE>
</HEAD>
<BODY>
<CENTER>

<FORM NAME="frm" METHOD="POST" ACTION="accomodation.php">
<TABLE CLASS="forumline" CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="60%">
<TBODY>
<TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="2"><B>HOSTEL DETAILS</B></TD></TR>
<TR>
	<TD CLASS="rowpic" WIDTH="25%"><B>Hostel Name</B></TD>
	<TD CLASS="rowpic" WIDTH="35%">
		<SELECT NAME="hostel" SIZE="1">
			<OPTION VALUE="0">--- SELECT HOSTEL ---</OPTION>
			<?
			$query  = "SELECT * FROM hostel_m";
			$rs = execute($query) or die("QUERY $query " . error_description());
			if (rowcount($rs) != 0)
			{
				while ($row = fetcharray($rs))
				{
					if ($hostel == $row["id"])
						echo "<OPTION VALUE='$row[id]' SELECTED>$row[hostel_name]</OPTION>";
					else
						echo "<OPTION VALUE='$row[id]'>$row[hostel_name]</OPTION>";
				}
				mysql_free_result($rs);
			}
			?>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD CLASS="row2" WIDTH="25%" ALIGN="CENTER">
	<INPUT TYPE="SUBMIT" NAME="acc1" VALUE="ACCOMODATED DETAILS" CLASS="bgbutton"></TD>
	<TD CLASS="row2" WIDTH="35%" ALIGN="CENTER">
	<INPUT TYPE="SUBMIT" NAME="acc2" VALUE="ACCOMODATION AVAILABILITY" CLASS="bgbutton"></TD>
</TR>
</TBODY>
</TABLE>
</FORM>
</CENTER>
</BODY>
</HTML>