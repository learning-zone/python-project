<html>
<head>
<?php
session_start();
include("../db.php");
$mid=$_REQUEST['mid'];
?>
<SCRIPT LANGUAGE="JavaScript">
function prnfee()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = "";
}
</script>
</head>
<body>
<form name='frm' method='post'>
<?php
$sql=fetcharray(execute("select * from fee_master where id=$mid"));
$rs=fetcharray(execute("select course_abbr from course_m where course_id='$sql[pid]'"));
$rs1=fetcharray(execute("select year_name from course_year where year_id='$sql[sid]'"));
$rs2=fetcharray(execute("select student_id,first_name,last_name from student_m where id='$sql[studid]'"));
$rs3=fetcharray(execute("select max(catid) from fee_cat"));
for($i=1;$i<=$rs3[0];$i++)
{
	$dmdttl[$i]=0;
	$pdttl[$i]=0;
}
$sql1=fetcharray(execute("select max(fee_id) from fee_type"));
for($i=1;$i<=$sql1[0];$i++)
{
	//echo "select catid from fee_type where fee_id=$i";
	$catid=fetcharray(execute("select catid from fee_type where fee_id=$i"));
	$cid=$catid[0];
	$damt="dtfee".$i;
	$dmdamt=$sql[$damt];
	$pamt="ptfee".$i;
	$pdamt=$sql[$pamt];
	$dmdttl[$cid]+=$dmdamt;
	$pdttl[$cid]+=$pdamt;
}
?>
<table class='forumline' border=1 align=center>
<tr height="30"><td align=center class=head colspan=5><font size='3'>FEE DUE REPORT</font></TD></TR>
<tr height="25"><td align=center colspan=5><br><?=$_SESSION['branchname']?> : <?=$rs[0]?> , <?=$_SESSION['semname']?> : <?=$rs1[0]?></td></tr>
<tr height="25"><td align=center colspan=5><br>SR Number : <?=$rs2[0]?> , Name : <?=$rs2[1]?> <?=$rs2[2]?></td></tr>
<tr height="25"><td align=center>Sl.No</td><td align=center>Fee Category</td><td align=center>Demanded Amount</td><td align=center>Paid Amount</td><td align=center>Balance</td></tr>
<?php
$rs3=execute("select * from fee_cat order by catid");
$rcnt=rowcount($rs3);
$sno=1;
for($i=1;$i<=$rcnt;$i++)
{
	$r=fetcharray($rs3);
	if($sno<10)
		$sno="0".$sno;
	echo "<tr height='25'><td align='center'>$sno</td>";
	echo "<td>&nbsp;&nbsp;$r[cat_name]</td>";
	$amt=number_format($dmdttl[$i],2);
	$amt1=number_format($pdttl[$i],2);
	$amt2=number_format(($dmdttl[$i]-$pdttl[$i]),2);
	$ttl1+=$dmdttl[$i];
	$ttl2+=$pdttl[$i];
	$ttl3+=$dmdttl[$i]-$pdttl[$i];
	echo "<td align='right'>$amt</td>";
	echo "<td align='right'>$amt1</td>";
	echo "<td align='right'>$amt2</td></tr>";
	$sno++;
}
?>
<tr><td align='right' colspan='2'>Total&nbsp;&nbsp;</td>
<td align='right'><?=number_format($ttl1,2)?></td>
<td align='right'><?=number_format($ttl2,2)?></td>
<td align='right'>
<?=number_format($ttl3,2)?>
</td></tr>
<?php
if($sql[cenamt]>0)
{
	?>
	<tr><td align='right' colspan='4'>Concession Amount&nbsp;&nbsp;</td><td align='right'><?=number_format($sql[cenamt],2)?></td></tr>
	<tr><td align='right' colspan='4'>Due Amount&nbsp;&nbsp;</td><td align='right'><?=number_format(($ttl3-$sql[cenamt]),2)?></td></tr>
	<?php
}
?>
</table><br>
<div id="prn" align="center"><input type="button" name="prnfeest" value="PRINT" class="bgbutton" onClick="prnfee()"></div>
<div id='1'><font color="#FFFFFF"><b><< <a href='feerpt2.php?stud_id=<?=$sql[studid]?>'>BACK</a></b></font><div>
</form>
</body>
</html>