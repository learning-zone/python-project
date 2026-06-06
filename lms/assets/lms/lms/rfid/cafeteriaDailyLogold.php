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
	$d = explode('/', $adate);
	
	$sysdate="$d[2]-$d[1]-$d[0]";
	

}
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

</script>
</head>

<body>
<form method="post" name="frm" action="">
<table cellspacing="3" cellpadding="0" border="1" align="center" width="100%">
  <tr>
    <td colspan="17" class="head">Mercedes-Benz International School</td>
  </tr>
  <tr>
    <td colspan="17" class="head">Daily Cafeteria for for Date :
   <input type="text" name="adate" value="<?php if($adate==""){$adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>

 <input type="submit" value="Go" name="Go" class='bgbutton'></td>


  <tr>
    <td align="center" class="head" nowrap="nowrap">Sl No</td>
    <td align="center" class="head" nowrap="nowrap">Code</td>
    <td align="center" class="head" nowrap="nowrap">Name</td>
    <td align="center" class="head" nowrap="nowrap">Category</td>
    
    <td align="center" class="head" nowrap="nowrap">Meal Type</td>
 	<td align="center" class="head" nowrap="nowrap">Break Fast</td>
    <td align="center" class="head" nowrap="nowrap">Time</td>
    
    <td align="center" class="head" nowrap="nowrap">Meal Type</td>
 	<td align="center" class="head" nowrap="nowrap">Lunch</td>
    <td align="center" class="head" nowrap="nowrap">Time</td>
    
    <td align="center" class="head" nowrap="nowrap">Meal Type</td>
 	<td align="center" class="head" nowrap="nowrap">Snack/Tea</td>
    <td align="center" class="head" nowrap="nowrap">Time</td>

    <td align="center" class="head" nowrap="nowrap">Meal Type</td>
 	<td align="center" class="head" nowrap="nowrap">Dinner</td>
    <td align="center" class="head" nowrap="nowrap">Time</td>
   </tr>
  <?php
  $i=1;
  $sql=execute("SELECT b.user, a.rfidno, b.user_type FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$sysdate'  and b.status=1 and (a.controllerip='192.168.0.33' and (a.readerno='1' or a.readerno='2')) group by b.rfid order by b.user_type");
  while($r=fetcharray($sql))
  {
	 
	 
	
	 
	  $staffif=trim($r[1]);
	  if($r[2]==1)
	  {
	  	$stfname=fetchrow(execute("select first_name, last_name, student_id from student_m where id='$r[0]'"));
		$cat='Student';
	  }
	  if($r[2]==2)
	  {
	  	$stfname=fetchrow(execute("select f_name, s_name, slno from staff_det where id='$r[0]'"));
		$cat='Staff';
	  }
	if($stfname[0])
	{
	  ?>
	  <tr  bgcolor='<?=$bgcolor?>'>
		<td>&nbsp;<?=$i?></td>
		<td><?=$stfname[2]?></td>
		<td><?=$stfname[0]?> <?=$stfname[1]?></td>
		
		<td><?=$cat?></td>
        <td align="center"  nowrap="nowrap">CommonMenu</td>
        <td align="center"  nowrap="nowrap">--</td>
<?php
 $intime=fetchrow(execute("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$r[1]' and `att_date`='$sysdate'  and (controllerip='192.168.0.33' and (`readerno`='1' or `readerno`='2')) and (att_time>'07:00:00' and att_time<'10:30:00')  ORDER BY `id` limit 1"));
?>

        <td align="center"  nowrap="nowrap"><?=$intime[0]?></td>
        
        <td align="center"  nowrap="nowrap">CommonMenu</td>
        <td align="center"  nowrap="nowrap">--</td>
<?php
 $intime=fetchrow(execute("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$r[1]' and `att_date`='$sysdate'  and (controllerip='192.168.0.33' and (`readerno`='1' or `readerno`='2')) and (att_time>'11:30:00' and att_time<'14:30:00')  ORDER BY `id` limit 1"));
?>

        <td align="center"  nowrap="nowrap"><?=$intime[0]?></td>
        
        <td align="center"  nowrap="nowrap">CommonMenu</td>
        <td align="center"  nowrap="nowrap">--</td>
<?php
 $intime=fetchrow(execute("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$r[1]' and `att_date`='$sysdate'  and (controllerip='192.168.0.33' and (`readerno`='1' or `readerno`='2')) and (att_time>'15:00:00' and att_time<'17:00:00')  ORDER BY `id` limit 1"));
?>        <td align="center"  nowrap="nowrap"><?=$intime[0]?></td>
        
        <td align="center"  nowrap="nowrap">CommonMenu</td>
        <td align="center"  nowrap="nowrap">--</td>
<?php
 $intime=fetchrow(execute("SELECT `att_time` FROM `rfidupdate` where `rfidno`='$r[1]' and `att_date`='$sysdate'  and (controllerip='192.168.0.33' and (`readerno`='1' or `readerno`='2')) and (att_time>'19:00:00' and att_time<'22:30:00')  ORDER BY `id` limit 1"));
?>        
        <td align="center"  nowrap="nowrap"><?=$intime[0]?></td>
	  </tr>
	<?php
		$i++;
	}
}
?>
</table>
</form>
</body>
</html>