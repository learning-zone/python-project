<html>
<head>
<?php
session_start();
include("../db.php");
?>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
</head>
<body>
<form name='frm' method='post' action='feesum1.php'>
<table class='forumline' border=1 align=center>
<tr height="30"><td align=center class=head colspan=4>FEE COLLECTION SUMMARY</TD></TR>
<?php	
$cdt1=date("d");
$cmt1=date("m");
$cyr1=date("Y");
$cdt2=date("d");
$cmt2=date("m");
$cyr2=date("Y");
?>
<tr height="30"><td class=row2>&nbsp;&nbsp;From Date</td><td nowrap>
<select name='cdt1'>
<?php
for($i=1;$i<=31;$i++)
{
	if($i == $cdt1)
		echo "<option value='$i'selected >$i</option>";
	else
		echo "<option value='$i'>$i</option>";
}
echo "</select>";
//Month
echo "<select name='cmt1'>";
for($i=1;$i<=12;$i++)
{
	if($i == $cmt1)
		echo "<option value='$i' selected>" . MonthName($i) . "</option>";
	else
		echo "<option value='$i'>" . MonthName($i) . "</option>";
}
echo "</select>";
//Year
$maxYr =$cyr1;
$minYr =$cyr1-2;
echo "<select name='cyr1'>";
for($i=$minYr;$i<=$maxYr;$i++)
{
	if($i == $cyr1)
		echo "<option value='$i'selected>$i</option>\n";
	else
		echo "<option value='$i' >$i</option>\n";
}
echo "</select></td>";
?>
<td class=row2>&nbsp;&nbsp;To Date</td><td nowrap>
<select name='cdt2'>
<?php
for($i=1;$i<=31;$i++)
{
	if($i == $cdt2)
		echo "<option value='$i'selected >$i</option>";
	else
		echo "<option value='$i'>$i</option>";
}
echo "</select>";
//Month
echo "<select name='cmt2'>";
for($i=1;$i<=12;$i++)
{
	if($i == $cmt2)
		echo "<option value='$i' selected>" . MonthName($i) . "</option>";
	else
		echo "<option value='$i'>" . MonthName($i) . "</option>";
}
echo "</select>";
//Year
$maxYr =$cyr2;
$minYr =$cyr2-2;
echo "<select name='cyr2'>";
for($i=$minYr;$i<=$maxYr;$i++)
{
	if($i == $cyr2)
		echo "<option value='$i'selected>$i</option>\n";
	else
		echo "<option value='$i' >$i</option>\n";
}
echo "</select></td></tr>";
echo "<tr height='30'><td colspan='4' align='center'><input type='submit' name='viewrpt' value='<< VIEW >>'>";
echo "</table>";

function MonthName($mon)
{
        if($mon == 1) return("Jan");
        if($mon == 2) return("Feb");
        if($mon == 3) return("Mar");
        if($mon == 4) return("Apr");
        if($mon == 5) return("May");
        if($mon == 6) return("Jun");
        if($mon == 7) return("Jul");
        if($mon == 8) return("Aug");
        if($mon == 9) return("Sep");
        if($mon == 10) return("Oct");
        if($mon == 11) return("Nov");
        if($mon == 12) return("Dec");
}
?>
</form>
</body>
</html>