<?php

session_start();

require("../db.php");
$college = $_POST['college'];
$hname = $_POST['hname'];
$studFName = $_POST['studFName'];
$state = $_POST['state'];
$country = $_POST['country'];
$sreps = $_POST['sreps'];
$action1 = $_POST['action1'];
switch($college)
{
	case -1:
		$sel1 = "SELECTED";
		$sel2 = "";
		$sel3 = "";
		break;
	case -2:
		$sel1 = "";
		$sel2 = "SELECTED";
		$sel3 = "";
		break;
	case -3:
		$sel1 = "";
		$sel2 = "";
		$sel3 = "SELECTED";
		break;
	default:
		$sel1 = "";
		$sel2 = "";
		$sel3 = "";
		break;
}
?>
<HTML>
<HEAD>
<TITLE>Student Search</TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
function validate()
{
	var flag,str;
	flag = 0;
	str = "";
	if ( document.studret.hname.selectedIndex != 0 && flag!= 1)
	{
		flag = 1;
	}
	else
	{
		alert("Please Select Hostel");
	}
	if(flag == 1)
	{
		document.studret.action="view_archive.php";
		document.studret.submit();
	}
}

function reload()
{
	document.studret.submit();
	return true;
}
//-->
</SCRIPT>
</HEAD>
<BODY>
<CENTER>
<FORM METHOD="POST" NAME="studret">
<INPUT TYPE="HIDDEN" NAME="action1" VALUE="view_archive.php">
<TABLE WIDTH="30%" BORDER="0" CELLPADDING="0" CELLSPACING="0" CLASS="forumline">
<TR><TD ALIGN="CENTER" COLSPAN="3" CLASS="head">VIEW ARCHIVED STUDENTS</TD></TR>
<TR>
	<TD ALIGN="LEFT" WIDTH="35%">
	Select College:</TD>
	<TD ALIGN="LEFT" COLSPAN="2" WIDTH="65%">
		<SELECT NAME="college" SIZE="1" onChange="return reload()">
			<OPTION VALUE="0">--Select--</OPTION>
			<OPTION VALUE="-1" <?=$sel1;?>>DENTAL</OPTION>
			<OPTION VALUE="-2" <?=$sel2;?>>ENGINEERING</OPTION>
			<OPTION VALUE="-3" <?=$sel3;?>>MANAGEMENT</OPTION>
			<?
			$query  = "SELECT * FROM additional_college ORDER BY col_id ASC";
			$rs = execute($query) or die("QUERY $query " . error_description());
			if (rowcount($rs) != 0)
			{
				while ($row = fetcharray($rs))
				{
					if ($row["col_id"] == $college)
						echo "<OPTION VALUE='$row[col_id]' SELECTED>$row[col_name]</OPTION>";
					else
						echo "<OPTION VALUE='$row[col_id]'>$row[col_name]</OPTION>";
				}
				mysql_free_result($rs);
			}
			?>
		</SELECT>
	</TD>
</TR>
<?
if (($college != "Nill") && (!empty($college)))
{	// IF BEGINS.
?>
	<TR>
		<TD ALIGN="LEFT" WIDTH="35%">Select Hostel:</TD>
		<TD ALIGN="LEFT" WIDTH="65%" COLSPAN="2">Student First Name:</TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT" WIDTH="35%">
			<SELECT NAME="hname" SIZE="1">
				<OPTION VALUE="0">-:- Select a Hostel -:-</OPTION>
				<?php
				$sql = "SELECT * FROM hostel_m";
				$rs=execute($sql) or die("QUERY $sql " . error_description());
				$row=rowcount($rs);
				for($i=0;$i<$row;$i++)
				{
					$r=fetcharray($rs,$i);
					echo("<OPTION VALUE='".$r["id"]."'>".$r["hostel_name"]."</OPTION>");
				}
				?>
			</SELECT>
		</TD>
		<TD WIDTH="65%" COLSPAN="2"><INPUT TYPE="TEXT" NAME="studFName" SIZE="20" VALUE="<?=$studFName?>"></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT" WIDTH="35%">State</TD>
		<TD ALIGN="LEFT" COLSPAN="2" WIDTH="65%">Country</TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT" WIDTH="35%"><INPUT TYPE="TEXT" NAME="state" SIZE="20"></TD>
		<TD ALIGN="LEFT" WIDTH="45%"><INPUT TYPE="TEXT" NAME="country" SIZE="20"></TD>
		<TD ALIGN="LEFT" WIDTH="20%"><input TYPE="BUTTON" NAME="sreps" CLASS="bgbutton" VALUE="Search" onClick="validate()"></TD>
	</TR>
<?
}	// END IF
?>
</TBODY>
</TABLE>
</FORM>
</CENTER>
</BODY>
</HTML>