<?php
include_once("../db.php");
$register=$_POST['register'];
?>
<html>
<head>
<script language="JavaScript">
function frm_submit()
{
	document.form1.action='view_stock_verification_rep.php';
	document.form1.submit();
}
</script>
</head>
<body>
<?php
	echo "<form name=form1 method=post >";
	echo "<table  align='center' border=1 cellspacing=0 class=forumline width='47%'>";
	echo "<tr><td class='head' align='center'colspan=3>Stock Verification Report</td></tr>";
	echo "<tr>";
	/*
	echo "<td>";
	echo "<div align=left>Register";
	echo "</td>";
	echo "<td>";
		$qry="select * from lib_register ";
		echo "<select name=register onChange='javascript:document.form1.submit()'>";
		echo "<option value='0'>----  All----</option>";
		$ls=execute($qry) or die(error_description());
		for($ii=0;$ii < rowcount($ls);$ii++)
		{
			$lr=fetcharray($ls,$ii);
			if($lr[id]==$register)
			{
				$sel = "selected";
			}
			else
				$sel = "";
			echo "<option value=$lr[id] $sel>$lr[register]</option>";
		}
		echo "</select>";
		echo "</td>";
		*/
				$Register=1;
		echo "</tr>";
		echo "<tr>";
		echo "<td colspan=2 align=center>";
		echo "<input type=button name=button value='Generate Report' onClick='frm_submit()' class=bgbutton>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo "</form>";
?>
</BODY>
</HTML>

