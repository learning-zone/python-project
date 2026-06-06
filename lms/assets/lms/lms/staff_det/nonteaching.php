<html>
<head>
<?php
session_start();
include("../db.php");
?>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<script language=javascript>
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = "";
}
</script>
</head>
<body>
<table border='1' width='80%' align=center border='1'>

<tr><td colspan=6 class=head align=center>Contact Information of Non Teaching Staff</td></tr>
<tr><td align=center class="row2">Sl. No.</td><td align=center class="row2">Staff Name</td><td align=center class="row2">Department</td><td align=center class="row2">Designation</td><td align=center class="row2">Telephone No</td><td align=center class="row2">E-Mail ID</td></tr>
<?php

$sql=execute("select * from staff_group where name like 'Non Teaching%' and status=1");
$fs=fetcharray($sql);

$mm=execute("select f_name,s_name,type_id,mobileno,subj, email from staff_det a,staff_des b where a.group_id='$fs[0]' and a.type_id=b.d_id  order by a.type_id,a.f_name");
if(rowcount($mm)==0)
{
	echo "No Non Teaching Staff Records";
	die();
}
$slno=1;
for($i=0;$i<rowcount($mm);$i++)
{
	$fmm=fetcharray($mm);
	if($slno<10)
		$slno="0".$slno;
		if($i%2)
	echo "        <tr class='clsname'> ";
	else
	echo "        <tr > ";
	echo "<td align='center'>$slno</td>";
	echo "<td nowrap>&nbsp;&nbsp;$fmm[f_name] $fmm[s_name]</td>";
	
	$c=fetcharray(execute("select Dept from dept_no where dpt_id='$fmm[subj]' order by dpt_id"));
	echo "<td nowrap>&nbsp;&nbsp;$c[Dept]</td>";
	$d=fetcharray(execute("select * from staff_des where d_id='$fmm[type_id]' order by priority"));
	echo "<td nowrap>&nbsp;&nbsp;$d[d_name]</td>";
	echo "<td nowrap>&nbsp;&nbsp;$fmm[mobileno]</td>";
	echo "<td nowrap>&nbsp;&nbsp;$fmm[email]</td>";
	echo "</tr>";
	$slno+=1;
}
echo "</table>";
?>
<br>
<div id='prn' align='center'>
<input type="button" value="<<  Print  >>" name="B1" onClick="printReport()" class=bgbutton></div>
</body>
</html>