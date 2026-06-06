<html>
<head><title>View Log Report</title>
<script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
</head>
<body class='bodyline'>
<?php
	include("../db.php");
	
	$username = $_POST['username'];
	$adate = $_POST['adate'];
	$bdate = $_POST['bdate'];
	$f=explode('/',$adate);
	$t=explode('/',$bdate);
	$fdate="$f[2]-$f[1]-$f[0]";
	$tdate="$t[2]-$t[1]-$t[0]";
?>

<form method="post" name="frm">

<table class='forumline' align='center'>

<tr><td Class="head" align='center'colspan="4">View Log Report</td></tr>

<td align='left' >&nbsp;&nbsp;User Name</td>
<TD WIDTH=45% ALIGN=LEFT>
<?php

$query = "SELECT user FROM mail_logs group by user";
$rs = execute($query);
echo "&nbsp;&nbsp;<select name='username' onChange='reload1()'>";
echo "<OPTION VALUE='1'>------ All ------</OPTION>";
while($trow=fetcharray($rs))
{
	//echo "<option value='$trow[0]'>$trow[0]</option>";
	if($username==$trow[0])
	{
		echo "<option value='$trow[0]' selected>$trow[0]</option>";
	}
	else
	{
		echo "<option value='$trow[0]'>$trow[0]</option>";
	}
}
echo "</select></TD>";
?>
</tr>

<tr>
<td >&nbsp;&nbsp;From Date
<td nowrap>&nbsp;&nbsp;<input type="text" readonly name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg"  ></a>
        </td>
        <tr>
        <td >&nbsp;&nbsp;To Date
        <td nowrap>&nbsp;&nbsp;<input type="text" readonly name="bdate" value="<?php echo $bdate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg"></a>
        </td>
        </tr>
</table>
<br>
<div align='center'><input type="submit" name='submit11' value="View Detailed Log Report" class='bgbutton'></div>
<?php
if(!$adate)
die();

?>
<br>
<table width="90%" border="1" align="center" cellspacing="5" cellpadding="5">
  <tr>
    <td class="head" align="center" nowrap>Sl No</td>
    <td class="head" align="center">User</td>
    <td class="head" align="center">Mail id</td>
    <td class="head" align="center">Date</td>
    <td class="head" align="center">Time</td>
    <td class="head" align="center">Status</td>
    <td class="head" align="center">Count</td>
  </tr>
  
<?php 

$sql="select * from mail_logs where (mail_date between '$fdate' and '$tdate')";

if($username!=1)
$sql.=" and user='$username'";

$sql.=" order by mail_date, mail_time  DESC";
$count=0;

$k=1;
$todaydate=date("Y-m-d");
$sq=execute($sql);
while($r=fetcharray($sq))
{
	$dt=explode('-',$r[mail_date]);
	$mail=explode('Mail sent',$r[3]);
	if(sizeof($mail) >= 2)
	$status='Sent';
	else
	{
		if($r[mail_date]==$todaydate)
		$status="<font color='#FF0000'>Pending</font>";
		else
		$status="<font color='#FF0000'>Failed</font>";
	}

?>
  <tr>
    <td align="center">&nbsp;<?=$k?></td>
    <td align="center">&nbsp;<?=$r[user]?></td>
    <td>&nbsp;<?=$r[to_mail]?></td>
    <td align="center">&nbsp;<?="$dt[2]-$dt[1]-$dt[0]"?></td>
    <td align="center">&nbsp;<?=$r[mail_time]?></td>
	<td align="center" title="<?=$r[3]?>">&nbsp;<?=$status?></td>
    <td align="center">&nbsp;<?=$r[viewed]?></td>
  </tr>
<?php
$k++;
}
?>  
</table>
<br>



</form></body></html>
