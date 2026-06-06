<?php
require_once("../db.php");
$register=$_POST['register'];
$status=$_POST['status'];
$FDay=$_POST['FDay'];
$FMon=$_POST['FMon'];
$FYear=$_POST['FYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];
?>
<HTML>
<HEAD>
<script language="javascript">
function frm_submit()
{
			document.form1.action='view_book_binding_report.php';
			document.form1.submit();
}
</script>
</HEAD>
<BODY topMargin=0 leftMargin=0>
<form method="POST" action='book_binding_report.php' name="form1">
<table border="0" width="47%" cellspacing="2" cellpadding="0" align='center' class="forumline">
	<tr>
	    <td colspan=3 align='center' Class="head">Book Binding Report</td>
	</tr>
<?php
$slib =execute("SELECT * FROM library_name");
$num = rowcount($slib);
echo "<tr>";
/*
	echo "<td>";
	echo "<div align=left>Register";
	echo "</td>";
	echo "<td>";
	$qry="select * from lib_register ";
	echo "<select  name=register>";
	echo "<option value='0'>ALL</option>";
	$ls=execute($qry) or die(error_description());
	for($ii=0;$ii < rowcount($ls);$ii++)
	{
		$lr=fetcharray($ls,$ii);
		if($lr[id]==$register)
		$sel = "selected";
		else
		$sel = "";
		echo "<option value=$lr[id] $sel>$lr[register]</option>";
	}
	echo "</select>";
	echo "</td>";
	*/
	$Register=1;
echo "</tr>";
?>
<tr>
	<td align="left">&nbsp;&nbsp;&nbsp;Status</td>
	<td align="left">
	<select name=status>
	<option value='D'> Detailed</option>
	<option value='O'> Out Standing</option>
	</td>
</tr>
<tr>
	<td  align="left">&nbsp;&nbsp;&nbsp;From Date</td>
	<td  align="left">
	<?php
	$d=getdate();
	$MyDay=$d["mday"];
	echo "<select name='FDay'>";
	for($i=1;$i<=31;$i++)
	{
		if($i <10)
		{
			$i="0".$i;
		}
		if($i == $MyDay)
		echo "<option value='$i' selected>$i</option>\n";
		else
		echo "<option value='$i'>$i</option>\n";
	}
	echo "</select>";
	$MyMonth=$d["mon"];
	echo "<select name='FMon'>";
	for($i=1;$i<=12;$i++)
	{
		if($i <10)
		{
			$i="0".$i;
		}
		if($i == $MyMonth)
		echo "<option value='$i' selected>" . F367c6aa8($i) . "</option>\n";
		else
		echo "<option value='$i'>" . F367c6aa8($i) . "</option>\n";
	}
	echo "</select>";
	$maxYr =$d["year"]+1;
	$MyYear=$d["year"];
	echo "<select name='FYear'>";
	for($i=1997;$i<=$maxYr;$i++)
		{
			if($i == $MyYear)
			echo "<option value='$i' selected>$i</option>\n";
			else
			echo "<option value='$i' >$i</option>\n";
		}
	echo "</select>";
	?>
	</td>
</tr>
<tr>
	<td  align="left">&nbsp;&nbsp;&nbsp;To Date</td>
	<td  align="left">
	<?php
	$d=getdate();
	$MyDay=$d["mday"];
	echo "<select name='TDay'>";
	for($i=1;$i<=31;$i++)
		{
			if($i < 10)
			{
				$i="0".$i;
			}
			if($i == $MyDay)
			echo "<option value='$i' selected>$i</option>\n";
			else
			echo "<option value='$i'>$i</option>\n";
		}
	echo "</select>";
	$MyMonth=$d["mon"];
	echo "<select name='TMon'>";
	for($i=1;$i<=12;$i++)
		{
			if($i <10)
				{
					$i="0".$i;
				}
			if($i == $MyMonth)
			echo "<option value='$i' selected>" . F367c6aa8($i) . "</option>\n";
			else
			echo "<option value='$i'>" . F367c6aa8($i) . "</option>\n";
		}
	echo "</select>";
	$maxYr =$d["year"]+1;
	$MyYear=$d["year"];
	echo "<select name='TYear'>";
	for($i=1997;$i<=$maxYr;$i++)
		{
			if($i == $MyYear)
			echo "<option value='$i' selected>$i</option>\n";
			else
			echo "<option value='$i' >$i</option>\n";
		}
	echo "</select>";
	?>
	</td>
</tr>
	<td  align=left></td>
	
</tr>
</table>
<br>
<div align=center>
	<input type='button' value='<<  Submit  >>' name='submit1' onClick='frm_submit()' class="bgbutton"></div>
</form>
<?php
function F367c6aa8($mon){
if($mon == '01') return("Jan");
if($mon == '02') return("Feb");
if($mon == '03') return("Mar");
if($mon == '04') return("Apr");
if($mon == '05') return("May");
if($mon == '06') return("Jun");
if($mon == '07') return("Jul");
if($mon == '08') return("Aug");
if($mon == '09') return("Sep");
if($mon == '10') return("Oct");
if($mon == '11') return("Nov");
if($mon == '12') return("Dec");
}
?>
</BODY>
</HTML>