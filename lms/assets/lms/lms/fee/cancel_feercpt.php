<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<?php
session_start();
include("../db.php");
?>
<script language="javascript" type="text/javascript">
function clswnd()
{
	window.close();
}
</script>
</head>
<body>
<?php
$uid=fetcharray(execute("select id from users where username='$user'"));

$sql="select * from fee_payment where id='$mid' ";
$rs=execute($sql) or die(mysql_error());
$r=fetcharray($rs);

$sql1="select * from fee_master where id='$r[fmid]' ";
$rs1=execute($sql1) or die(mysql_error());
$r1=fetcharray($rs1);

if($r[bfexeamt]>0)
{
	$sql2=fetcharray(execute("select id from fee_master where studid='$r[studid]' and id != '$r[fmid]' order by id desc limit 1 ")) or die(mysql_error());
	$sql3=execute("update fee_master set exeamt='$r[bfexeamt]' where id='$sql2[0]'") or die(mysql_error());
	$sql4=execute("update fee_master set status=1,exeamt=0,pstatus=0,refundsts=1,scl_st=1,balamt=0  where id='$r[fmid]'") or die(mysql_error());
}
else
{
	$balamt=$r1[balamt]+$r[docamt]-$r[fnamt];
	if($r[cexeamt]>0)
		$exeamt=$r[cexeamt];
	else
		$exeamt=$r1[exeamt]-$r[exeamt];
	$fnamt=$r1[fnamt]-$r[fnamt];
	$cenamt=$r1[cenamt]-$r[cenamt];
	
	if($fnamt<0)
		$fnamt=0;
	if($cenamt<0)
		$cenamt=0;
	if($exeamt<0)
		$exeamt=0;

	execute("update fee_master set fnamt='$fnamt',cenamt='$cenamt',balamt='$balamt',exeamt='$exeamt',pstatus='1' where id='$r1[id]'") or die(mysql_error());
	for($i=1;$i<=$r[noffeetype];$i++)
	{
		$fid1="fid".$i;
		$fid=$r[$fid1];
		$famt1="famt".$i;
		$famt=$r[$famt1];
		$a="pfee".$fid;
		$pfee=$r1[$a]-$famt;
		if($pfee<0)
			$pfee=0;
		execute("update fee_master set $a='$pfee' where id='$r1[id]'") or die(mysql_error());
	}
}
$sql="update fee_payment set recptstatus=1,canuid='$uid[0]' where id='$mid' ";
$rs=execute($sql) or die(mysql_error());
echo "<font color='blue'><b>Fee Receipt Cancelled ...</b></font>";
?>
<br><br><div id="prn" align='center'><input type="button" name='clse' value="<< Close >>" class='bgbutton' onclick="clswnd()"></div>
</body>
</html>