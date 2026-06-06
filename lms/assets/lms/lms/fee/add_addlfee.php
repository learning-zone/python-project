<html>
<?php
session_start();
include("../db.php");
$mid=$_REQUEST['mid'];

?>
<head>
<title>Fee Structure</title>
<script language='javascript'>
function reloadMe()
{
	document.frm.action="add_addlfee.php";
	document.frm.submit();
}
function clswnd()
{
	window.close();
}
function calamt(a,b)
{
	var a1=parseFloat(a);
	var b1=parseFloat(b);
	var tamt=parseFloat(document.frm.ttlamt1.value);
	if(a!=b)
	{
		tamt=tamt-a1+b1;
		document.frm.ttlamt1.value=tamt;
	}
}
</script>
<style>
	.text{text-align:right;}
</style>
</head>
<body>
<form name="frm" method="post" action="add_addlfee.php">
<input type="hidden" name="mid" value="<?=$mid?>">
 <?php

$fid=$_REQUEST['fid'];
$addfee=$_REQUEST['addfee'];



 if(isset($addfee))
 {
	while(list($key,$Value) = each($fid))
	{
		$fid1[$key]=$Value;
	}
	$size_first = sizeof($fid);
	$flg=0;
	for($i=0;$i<$size_first;$i++)
	{
		$fid=$fid1[$i];
		$feeamt=$_POST["feeamt".$fid];
		$amt=$feeamt;
		$a="T".$fid."dmd".$fid;
		$ccid=fetcharray(execute("select catid from fee_type where fee_id='$fid' "));
		$b="dtptfee".$fid;
		$sql=execute("select $a from fee_dmd where fmid='$mid' ");
		$rs=fetcharray($sql);
		if($rs[0]!=$amt)
		{
			$ssq=fetcharray(execute("select balamt,exeamt,$b,ttldmd from fee_master where id='$mid' "));
			$dtf=$ssq[2]+$amt-$rs[0];
			
			$tdmdf=$ssq[ttldmd]+$amt-$rs[0];
						
			$balamt=$ssq[balamt]+$amt-$rs[0];
			if($ssq[exeamt]>0)
			{
				$exeamt=$ssq[exeamt]-$balamt;
				if($exeamt<0)
				{
					$balamt=$balamt-$ssq[exeamt];
					$exeamt=0;
				}
				else
					$balamt=0;
			}
			else
			{
				if($balamt>0)
					$exeamt=0;
				else
				{
					$exeamt=$rs[0]-$amt-$ssq[balamt];
					$balamt=0;
				}
			}
			if($balamt>0)
				$pstatus=1;
			else
				$pstatus=0;
		
			$sql1=execute("update fee_dmd set $a=$amt where studid='$mid'") or die ("Failed to update fee details..1");
			$sql1=execute("update fee_master set balamt='$balamt',exeamt='$exeamt',pstatus='$pstatus',$b='$dtf',fnamt='$tdmdf' where id='$mid'") or die ("Failed to update fee details..");
		}
	}
	echo "<b>Fee Applied Successfully..</b><br>";
 }
 ?>
<table class='forumline' align='center' border="0" width='70%'>
<tr><td colspan='4'>
<table class='forumline' align='center' border="0" width='100%'>
<tr><td Class="head" align='center' colspan=4 >Add/Modify Student Fee Structure</td></tr>
<?php
$rs=fetcharray(execute("select studid from fee_master where id='$mid'"));
$rs1=fetcharray(execute("select student_id,first_name,last_name,course_admitted,course_yearsem from student_m where id='$rs[studid]'"));
$rs2=fetcharray(execute("select course_abbr from course_m where course_id='$rs1[course_admitted]'"));
$rs3=fetcharray(execute("select year_name from course_year where year_id='$rs1[course_yearsem]'"));
?>
<tr><td nowrap>&nbsp;&nbsp;Student ID</td><td nowrap>&nbsp;&nbsp;<?=$rs1[0]?></td><td nowrap>&nbsp;&nbsp;Student Name</td><td nowrap>&nbsp;&nbsp;<?=$rs1[1]?> <?=$rs1[2]?></td></tr>
<tr><td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td><td>&nbsp;&nbsp;<?=$rs2[0]?></td><td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td><td>&nbsp;&nbsp;<?=$rs3[0]?></td></tr>
</table></td></tr>
<tr><td colspan='4'>
<table class='forumline' align='center' border="0" width='100%'>
<tr><td Class="head" align='center'>Fee Name</td><td Class="head" align='center'>Fee Catogery</td><td Class="head" align='center'>Fee Type</td><td Class="head">&nbsp;&nbsp;Amount</td></tr>
<?php
$ttlamt=0;
$sql=execute("select fee_id,fee_name,catid,ftype from fee_type where status=1 order by catid,fee_name");
while($rs=fetcharray($sql))
{
	$feeamt=0;
	$d="dmd".$rs[0];
	$sqamt=fetcharray(execute("select $d from fee_dmd where fmid='$mid'"));
	if($sqamt[0]>0)
	{
		$feeamt=$sqamt[0];
		$ttlamt+=$feeamt;
	}
	if($rs[ftype]==0)
		$ftype="Floating Fee";
	elseif($rs[ftype]==1)
		$ftype="Fixed Fee";
	elseif($rs[ftype]==2)
		$ftype="One Time Fee";
	$rs4=fetcharray(execute("select cat_name from fee_cat where catid=$rs[catid]"));
	echo "<input type='hidden' name='fid[]' value=$rs[0]>";
	echo "<tr><td>&nbsp;&nbsp;$rs[1]</td>";
	echo "<td>&nbsp;&nbsp;$rs4[0]</td>";
	echo "<td>&nbsp;&nbsp;$ftype</td>";
	echo "<td><input type='text' class='text' name='feeamt$rs[0]' value='$feeamt' onchange='calamt($feeamt,this.value)'></td></tr>";
}
echo "<tr><td align='right' colspan='3'>Total Fee Amount&nbsp;&nbsp;</td>";
echo "<td><input type='text' class='text' name='ttlamt1' value='$ttlamt' readonly></td></tr>";
?>
</table></td></tr></table><br><br>
<div align="center"><input type="submit" name='addfee' value=" APPLY " class='bgbutton'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name='clse' value="Close" class='bgbutton' onClick="clswnd()"></div>
</form>
</body>
</html>