<?php 


$file_type = "vnd.ms-excel";

$file_name= "ATTENDANCE.xls";

header("Content-Type: application/$file_type");

header("Content-Disposition: attachment; filename=$file_name");

session_start();
include("../db.php");
$adate=$_POST['adate'];
$bdate=$_POST['bdate'];
if($adate!='')
{
	$date1 = explode('/', $adate);	
	$fdate= $date1[2]."-".$date1[1]."-".$date1[0];

	$date1 = explode('/', $bdate);	
	$todate= $date1[2]."-".$date1[1]."-".$date1[0];
}
else
{
	$adate="1/".date("m/Y");
	$bdate=date("d/m/Y");
	$fdate=date("Y-m")."-1";
	$todate=date("Y-m-d");
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
<?php
$sql6=mysql_query("SELECT att_date FROM rfid_staff_check_in where (att_date between '$fdate' and '$todate') group by att_date order by att_date");
$size=mysql_num_rows($sql6);		
$col=3+$size;
?>
<table cellspacing="3" cellpadding="0" border="1" align="center" width="90%">
  <tr>
    <td colspan="<?=$col?>" class="head">OBEROI INTERNATIONAL SCHOOL</td>
  </tr>
  <tr>
    <td colspan="<?=$col?>" class="head">Staff Attendance for Date :
   <?php echo $adate?>&nbsp;&nbsp;To&nbsp;&nbsp;<?php echo $bdate?>" &nbsp;&nbsp;</td>


  <tr>
    <td align="center" class="head" nowrap="nowrap" >Sl No</td>
    <td align="center" class="head" nowrap="nowrap">Staff Code</td>
    <td align='center' class='head' nowrap='nowrap'>Staff Name</td>
<?php
while($k=mysql_fetch_array($sql6))
{ 
	$old_date_timestamp = strtotime($k[att_date]);

	$new_date = date('M-d', $old_date_timestamp);

    echo "<td align='center' class='head' nowrap='nowrap'>$new_date</td>";
}
?>
    <td align='center' class='head' nowrap='nowrap'>Total</td>
   </tr>
  <?php
  $i=1;
  $sql=mysql_query("SELECT id,`f_name`,`s_name`,slno FROM `staff_det` where active='YES' order by f_name");
  while($r=mysql_fetch_array($sql))
  {	   
	   
	if($i%2)
	$bgcolor="#CCCCCC"; 
	else
	$bgcolor=""; 
	
	echo " <tr  bgcolor='$bgcolor'>
    <td>&nbsp;$i</td>
    <td nowrap>$r[slno]</td>
    <td nowrap>$r[f_name] $r[s_name] </td>
 ";
 $sql6=mysql_query("SELECT att_date FROM rfid_staff_check_in where (att_date between '$fdate' and '$todate') group by att_date order by att_date");
$m=0;
$m1=0;
	while($k=mysql_fetch_array($sql6))
	{ 
		$m++;
		$intime1=mysql_fetch_row(mysql_query("select id from rfid_staff_check_in where user='$r[id]' and att_date='$k[att_date]' and type=2 limit 1"));
		if(!$intime1[0])		
		{ 
			$dissts='A';
			$m1++;	
		}
		else
		{ 
			$dissts='P';	
		}
		echo "<td>$dissts</td>";
		
	}
	echo "<td>$m/$m1</td></tr>";
	$i++;
  }

  ?>
</table>
</form>
</body>
</html>