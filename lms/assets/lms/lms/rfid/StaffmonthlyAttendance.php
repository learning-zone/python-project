<?php
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
function RefreshMe(val)
{
	document.frm.action="StaffmonthlyAttendanceexcel.php";
	document.frm.submit();
}
function RefreshMe1()
{
	document.frm.action="StaffmonthlyAttendance.php";
	document.frm.submit();
}
</script>
</head>

<body>
<form method="post" name="frm" action="">



<?php
$sql6=execute("SELECT att_date FROM rfid_staff_check_in where (att_date between '$fdate' and '$todate') group by att_date order by att_date");
$size=rowcount($sql6);		
$col=4+$size;
?>
<table cellspacing="3" cellpadding="0" border="1" align="center" width="98%">
  
  <tr>
    <td colspan="<?=$col?>" class="head">Staff Attendance for Date :
   <input type="text" name="adate" value="<?php if($adate==""){$adate=date("d/m/Y"); } echo $adate?>" onblur="RefreshMe1()" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;To&nbsp;&nbsp;
 <input type="text" name="bdate" value="<?php if($bdate==""){$bdate=date("d/m/Y"); } echo $bdate?>" onblur="RefreshMe1()" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>

 <input type="submit" value="Go" name="Go" class='bgbutton'></td>


  <tr>
    <td align="center" class="head" nowrap="nowrap">Sl No</td>
    <td align="center" class="head" nowrap="nowrap">Staff Code</td>
    <td align='center' class='head' nowrap='nowrap'>Staff Name</td>
<?php
while($k=fetcharray($sql6))
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
  $sql=execute("SELECT id,`f_name`,`s_name`,slno FROM `staff_det` where active='YES' order by f_name");
  while($r=fetcharray($sql))
  {	   
	   
	if($i%2)
	$bgcolor="#FF5B5B"; 
	echo " <tr  bgcolor='$bgcolor'>
    <td>&nbsp;$i</td>
    <td nowrap>$r[slno]</td>
    <td nowrap>$r[f_name] $r[s_name] </td>
 ";
 $sql6=execute("SELECT att_date FROM rfid_staff_check_in where (att_date between '$fdate' and '$todate') group by att_date order by att_date");
$m=0;
$m1=0;
	while($k=fetcharray($sql6))
	{ 
		$m++;
		$intime1=fetchrow(execute("select id from rfid_staff_check_in where user='$r[id]' and att_date='$k[att_date]' and type=2 limit 1"));
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
	echo "<td>$m1/$m</td></tr>";
	$i++;
  }

  ?>
</table>
<p align="center"><input type="button" name="ExporttoExcel" value="Export to Excel" onClick="RefreshMe()" class="bgbutton"/></p>
</form>
</body>
</html>