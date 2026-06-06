<?php
session_start();
include("../db.php");
?>
<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<title>Refund Fee</title>
<script language="javascript" type="text/javascript">
function clswnd()
{
	window.close();
}
</script>
</head>
<body>
<?php
$cyr=$curyr1;
$ins_dt=date("Y-m-d");
$chdt=$pyr."-".$pmt."-".$pdt;

$uid=fetcharray(execute("select id from users where username='$user'"));

$sql="insert into refundfee (mid,studid,pid,sid,reftype,refchg,refamt,refmod,bkid,chno,chdt,ins_dt,accyr,uid) values ('$mid','$stud_id','$course','$sem','$reftype','$refcharge','$ttlamt','$refmode','$bkid','$chno','$chdt','$ins_dt','$cyr','$uid[0]')";

execute($sql) or die("Failed to update refunded fee details...");

$msg="Refund";

if($reftype==1)
	$sql="update fee_master set refundsts=1 where studid='$stud_id' and pid='$course'";
elseif($reftype==2)
	$sql="update fee_master set status=1,refundsts=1,exeamt=0 where id='$mid'";
elseif($reftype==3)
	$sql="update fee_master set exeamt=0 where id='$mid'";
elseif($reftype==4)
{
	$amt=$ttlamt;
	$r=fetcharray(execute("select * from fee_master where id='$mid'"));
	if($r[exeamt]>0)
	{
		$ttlbal=$r[balamt]+$amt-$r[exeamt];
		$ttlexe=0;
	}
	else
	{
		$ttlbal=$r[balamt]+$amt;
		$ttlexe=0;
	}
	$sql1=execute("select fee_id from fee_type where catid!=4 order by catid desc,fee_id desc");
	$rcnt=rowcount($sql1);
	for($i=0;$i<$rcnt;$i++)
	{
		if($amt>0)
		{
			$r1=fetcharray($sql1);
			$pat="pfee".$r1[0];
			$pamt=$r[$pat];
			if($pamt>0)
			{
				$amt1=$amt-$pamt;
				if($amt1<0)
				{
					$apamt=$pamt-$amt;
					$amt=0;
				}
				else
				{
					$amt=$amt1;
					$apamt=0;
				}
				execute("update fee_master set $pat='$apamt' where id='$mid'") or die("Failed to update fee details ...");
			}
		}
		else
			break;
	}
	if($amt>0)
	{
		$sql1=execute("select fee_id from fee_type where catid=4 order by fee_id desc");
		$rcnt=rowcount($sql1);
		for($i=0;$i<$rcnt;$i++)
		{
			if($amt>0)
			{
				$r1=fetcharray($sql1);
				$pat="pfee".$r1[0];
				$pamt=$r[$pat];
				if($pamt>0)
				{
					execute("update fee_master set $pat=0 where id='$mid'") or die("Failed to update fee details ...");
					$amt-=$pamt;
				}
			}
			else
				break;
		}
	}
	$sql="update fee_master set lsclamt='$ttlamt',balamt='$ttlbal',exeamt='$ttlexe' where id='$mid'";
	$msg="Loan";
}

execute($sql) or die("Failed to update refund fee details ...");

echo "<font color='blue' size='3'><b>$msg Details recorded successfully..</b></font>";
?>
<br><br><div id="prn" align='center'><input type="button" name='clse' value="<< Close >>" class='bgbutton' onclick="clswnd()"></div>
</body>
</html>