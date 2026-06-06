<html>
<?php
session_start();
include("../db.php");
$cyr=date("Y");
?>
<head>
<script language='javascript'>
function reloadMe()
{
	document.frm.action="add_addlfee.php";
	document.frm.submit();
}
function chkdata()
{
	if(document.frm.fid.value=='' || document.frm.feeamt.value==0)
	{
		alert("Select Fee type and add amount");
		return false;
	}
}
function clswnd()
{
	window.close();
}
</script>
<style>
	.text{text-align:right;}
</style>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
</head>
<body>
<form name="frm" method="post" action="add_addlfee.php">
<input type="hidden" name="course" value="<?=$course?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="stud_id" value="<?=$stud_id?>">
<input type="hidden" name="adm_id" value="<?=$adm_id?>">
 <?php
 if(isset($addfee))
 {
	$a="dfee".$fid;
	$sql=execute("select id,$a,balamt,exeamt from fee_master where studid='$stud_id'and pid='$course' and sid='$sem' and accyr='$cyr' ");
	if(rowcount($sql)>0)
	{
		$rs=fetcharray($sql);
		$feeamt1=$feeamt+$rs[1];
		$balamt=$rs[balamt]+$feeamt;
		if($rs[exeamt]>0)
		{
			$exeamt=$rs[exeamt]-$balamt;
			if($exeamt<0)
			{
				$balamt=$balamt-$rs[exeamt];
				$exeamt=0;
			}
			else
				$balamt=0;
		}
		else
			$exeamt=0;
		if($balamt>0)
			$pstatus=1;
		else
			$pstatus=0;
		$sql1=execute("update fee_master set $a=$feeamt1,balamt='$balamt',exeamt='$exeamt',pstatus='$pstatus' where id='$rs[id]'") or die ("Failed to update addl fee..");
	}
	else
	{
		$sql1=execute("insert into fee_master (studid,pid,sid,admid,$a,balamt,pstatus,accyr) values ('$stud_id','$course','$sem','$adm_id','$feeamt','$feeamt','1','$cyr')") or die("Failed to insert addl fee..");
	}
	$fid='';
	$feeamt=0;
	echo "<font color='blue'><b>Fee Applied Successfully..</b></font><br>";
 }
 ?>
<br><table class='forumline' align='center' border="0" width='70%'>
<tr><td Class="head" align='center' colspan=4 >Add Additional Fee</td></tr>
<?php
$rs1=fetcharray(execute("select student_id,first_name,last_name from student_m where id='$stud_id'"));
$rs2=fetcharray(execute("select course_abbr from course_m where course_id='$course'"));
$rs3=fetcharray(execute("select year_name from course_year where year_id='$sem'"));
?>
<tr><td>&nbsp;&nbsp;Student ID</td><td>&nbsp;&nbsp;<?=$rs1[0]?></td><td>&nbsp;&nbsp;Student Name</td><td>&nbsp;&nbsp;<?=$rs1[1]?> <?=$rs1[2]?></td></tr>
<tr><td>&nbsp;&nbsp;Program</td><td>&nbsp;&nbsp;<?=$rs2[0]?></td><td>&nbsp;&nbsp;Semester</td><td>&nbsp;&nbsp;<?=$rs3[0]?></td></tr>
<tr><td Class="head" align='center' colspan=4>&nbsp;</td></tr>
<tr><td colspan='2' align='center'>Fee Name</td><td>&nbsp;&nbsp;Amount</td><td rowspan='2' align='center'>
<input type="submit" name='addfee' value="<< APPLY >>" class='bgbutton' onclick="return chkdata()"></tr>
<tr><td colspan='2' align='center'><select name='fid' onchange="reloadMe()">
<option value=''>-- Select --</option>
<?php
$sql=execute("select fee_id,fee_name from fee_type where status=1 order by fee_name");
if($feeamt=="")
	$feeamt=0;
while($rs=fetcharray($sql))
{
	if($rs[0]==$fid)
		echo "<option value='$rs[0]' selected>$rs[1]</option>";
	else
		echo "<option value='$rs[0]'>$rs[1]</option>";		
}
?>
</select></td><td>
<input type='text' class='text' name='feeamt' value='<?php echo $feeamt ?>'></td></tr>
</table><br><br>
<div align="center"><input type="button" name='clse' value="<< Close >>" class='bgbutton' onclick="clswnd()"></div>
</form>
</body>
</html>