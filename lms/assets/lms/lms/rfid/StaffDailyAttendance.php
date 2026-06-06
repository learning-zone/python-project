<?php
session_start();
include("../db.php");
$today = date('Y-m-d');

$thisyear = date('Y');

$thismonth = date('m');

$thisday = date('d');

$adate=$_POST['adate'];
 $sysdate=date("Y-m-d");
 if($adate!='')
{
	$date1 = date('Y-m-d', $adate);
	
	$from = (explode(" ",$adate));
	
	$from_date = (explode("/",$from[0]));
	
	$From_date = $from_date[2]."-".$from_date[1]."-".$from_date[0];
	$sysdate= $from_date[2]."-".$from_date[1]."-".$from_date[0];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1//xhDTDtml1-transitional.dtd">
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

</script>
</head>

<body>
<form method="post" name="frm" action="">
<table cellspacing="3" cellpadding="0" border="1" align="center" width="90%">
 
  <tr>
    <td colspan="6" class="head">Staff Daily Attendance for Date :
   <input type="text" name="adate" value="<?php if($adate==""){$adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>

 <input type="submit" value="Go" name="Go" class='bgbutton'></td>


  <tr>
    <td align="center" class="head" nowrap="nowrap">Sl No</td>
    <td align="center" class="head" nowrap="nowrap">Staff Code</td>
    <td align="center" class="head" nowrap="nowrap">Staff Name</td>
    <td align="center" class="head" nowrap="nowrap">IN Time (HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">OUT Time (HH:mm)</td>
  </tr>
  <?php
  $i=1;
  $sql=execute("SELECT * FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1");
  while($r=fetcharray($sql))
  {
	  $staffif=trim($r[1]);
	  $stfname=fetchrow(execute("SELECT `f_name`,`s_name`,slno FROM `staff_det` where id='$r[2]' "));
	  
	 // $intime=fetchrow(execute("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$staffif' and `att_date`='$sysdate' and (`readerno`='1')"));
	$intime1=fetchrow(execute("select att_time from rfid_staff_check_in where rfidno='$staffif' and att_date='$sysdate' "));
	if(!$intime1[0])		
	{ 
		$dissts='Absent';	
		$bgcolor="#FF5B5B"; 
	}
	else
	{
		$intime=fetchrow(execute("select att_time , status from rfid_staff_check_in where rfidno='$staffif' and att_date='$sysdate'  order by att_time  limit 1"));
		
			$outtime=fetchrow(execute("select att_time from rfid_staff_check_in where rfidno='$staffif' and att_date='$sysdate'  order by att_time limit 1,1"));
			
		
	}
  ?>
    <tr  bgcolor='<?=$bgcolor?>'>
    <td align="center">&nbsp;<?=$i?></td>
    <td><?=$stfname[2]?></td>
    <td><?=$stfname[0]?> <?=$stfname[1]?></td>
    
    <td><?=$intime[0]?></td>
    <td><?=$outtime[0]?></td>
  </tr>
	<?php
	$intime[0]='';
	$outtime[0]='';
	$dissts='';
	$i++;
  }
?>
</table>
</form>
</body>
</html>