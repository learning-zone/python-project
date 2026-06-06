<?php
session_start();
include("../db.php");
$adate=$_POST['adate'];

  $sysdate=date("Y-m-d");
  
  $b_year=$_POST['b_year'];

$b_month=$_POST['b_month'];

$b_day=$_POST['b_day'];

$v_year=$_POST['v_year'];

$v_month=$_POST['v_month'];

$v_day=$_POST['v_day'];

$var123 = str_replace('/','-',$adate);

$date123 = Date("Y-m-d",strtotime($var123));

$dob = $b_year."-".$b_month."-".$b_day;

$vdt= $v_year."-".$v_month."-".$v_day;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance</title>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>

<script language="javascript" src="../js/cal2.js"></script>

<script language="javascript" src="../js/cal_conf2.js"></script>

<script language="javascript" type="text/javascript">
</script>
<script language='javascript'>

function msg()

{

	//document.frm.action = 'allreport_ticket.php';

	document.frm.action = 'staffDailyAttebdance.php';

	document.frm.submit();

}

</script>
</head>

<body>
<form method="post" name="frm" action="">
<table cellspacing="3" cellpadding="0" border="1" align="center" width="90%">
  <tr>
    <td colspan="6" class="head">Mercedes-Benz International School</td>
  </tr>
  <tr>
    <td colspan="6" class="head">Staff Daily Attendance for Date :
   <input type="text" name="adate" value="<?php if($adate==""){$adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

  </tr>
 <tr><td align="center" colspan="6"><input type="button" class="button" value="G0" onClick="msg()"></td></tr>

</table>
<table cellspacing="3" cellpadding="0" border="1" align="center" width="90%">
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
  $sql=mysql_query("SELECT * FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1");
  while($r=mysql_fetch_array($sql))
  {
	  $staffif=trim($r[1]);
	  $stfname=mysql_fetch_row(mysql_query("SELECT `f_name`,`s_name`,slno FROM `staff_det` where id='$r[2]' "));
	  
	 // $intime=mysql_fetch_row(mysql_query("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$staffif' and `att_date`='$sysdate' and (`readerno`='1')"));
	 $intime=mysql_fetch_row(mysql_query("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$staffif' and `att_date`='$sysdate' and ((controllerip='192.168.0.31' and (`readerno`='1' or `readerno`='5')) or (controllerip='192.168.0.32' and (`readerno`='1' or `readerno`='5'))) ORDER BY `id` limit 1"));
	 $intime1=mysql_fetch_row(mysql_query("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$staffif' and `att_date`='$sysdate' and ((controllerip='192.168.0.31' and (`readerno`='1' or `readerno`='5')) or (controllerip='192.168.0.32' and (`readerno`='1' or `readerno`='5'))) ORDER BY `id` DESC limit 1"));
	 $outtime=mysql_fetch_row(mysql_query("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$staffif' and `att_date`='$sysdate' and ((controllerip='192.168.0.31' and (`readerno`='4' or `readerno`='8')) or (controllerip='192.168.0.32' and (`readerno`='4' or `readerno`='8'))) ORDER BY `id` DESC limit 1"));
if($intime[0]=='' and $outtime[0]=='')
{
	$dissts='Absent';	
	$bgcolor="#FF5B5B";
}
else
{
	if($intime1[0]>$outtime[0])
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
</form>
</body>
</html>