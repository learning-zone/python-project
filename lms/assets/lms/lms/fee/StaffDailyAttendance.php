<?php
session_start();
include("../db.php");
  $disdate=date("d-m-Y");
  $sysdate=date("Y-m-d");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance</title>
</head>

<body>
<table cellspacing="3" cellpadding="0" border="1" align="center" width="90%">
  <tr>
    <td colspan="6" class="head">Mercedes-Benz International School</td>
  </tr>
  <tr>
    <td colspan="6" class="head">Staff Daily Attendance for Date : <?=$disdate?></td>
  </tr>
  <tr>
    <td align="center" class="head" nowrap="nowrap">Sl No</td>
    <td align="center" class="head" nowrap="nowrap">Staff Code</td>
    <td align="center" class="head" nowrap="nowrap">Staff Name</td>
    <td align="center" class="head" nowrap="nowrap">IN Time (HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">OUT Time (HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Current Status</td>
  </tr>
  <?php
  $i=1;
  $sql=execute("SELECT * FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1");
  while($r=fetcharray($sql))
  {
	  $staffif=trim($r[1]);
	  $stfname=fetchrow(execute("SELECT `f_name`,`s_name`,slno FROM `staff_det` where id='$r[2]' "));
	  $intime=fetchrow(execute("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$staffif' and `att_date`='$sysdate' and `readerno`='1'"));
	 $outtime=fetchrow(execute("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$staffif' and `att_date`='$sysdate' and `readerno`='4'"));
if($intime[0]=='' and $outtime[0]=='')
{
	$dissts='Absent';	
	$bgcolor="#FF5B5B";
}
else
{
	if($intime[0]>$outtime[0])
	{
		$dissts='In School, Present';
		$bgcolor="#35FF35";
	}
	else
	{
		$dissts='Out of School';
		$bgcolor="#A4A4FF";
	}
}
  ?>
  <tr  bgcolor='<?=$bgcolor?>'>
    <td>&nbsp;<?=$i?></td>
    <td><?=$stfname[2]?></td>
    <td><?=$stfname[0]?> <?=$stfname[1]?></td>
    
    <td><?=$intime[0]?></td>
    <td><?=$outtime[0]?></td>
    <td nowrap="nowrap"><?=$dissts?></td>
  </tr>
<?php
	$i++;
  }
?>
</table>
</body>
</html>