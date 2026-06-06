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

$query = "SELECT username FROM msg group by username  ORDER BY `username` DESC";
$rs = execute($query);
echo "&nbsp;&nbsp;<select name='username' onChange='reload1()'>";
echo "<OPTION VALUE='1'>------ All ------</OPTION>";
while($trow=fetcharray($rs))
{
	//echo "<option value='$trow[0]'>$trow[0]</option>";
	if($username==$trow[username])
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
    <td class="head" align="center">Number</td>
    <td class="head" align="center">MSG</td>
    <td class="head" align="center">Date</td>
    <td class="head" align="center">Time</td>
    <td class="head" align="center">Lenght</td>
    <td class="head" align="center">Status</td>
  </tr>
  
<?php 

$sql="select * from msg where (msg_date between '$fdate' and '$tdate')";

if($username!=1)
$sql.=" and username='$username'";

$sql.=" order by msg_date, msg_time  DESC";
$count=0;

$k=1;
$sq=execute($sql);
while($r=fetcharray($sq))
{
	$dt=explode('-',$r[6]);
if($r[9]==3)
	$status="<font color='#FF0000'>Duplicate</font>";
elseif($r[9]==0)
	$status="Sent";
else
	$status="<font color='#FF0000'>Failed</font>";
		
	$vsize=strlen($r[4])/160;
	
	if($vsize<1)
	$msg=1;
	elseif($vsize<2 and $vsize>1)
	$msg=2;
	elseif($vsize<3 and $vsize>2)
	$msg=3;
	elseif($vsize<4 and $vsize>3)
	$msg=4;
	elseif($vsize==1)
	$msg=1;
	elseif($vsize==2)
	$msg=2;
	elseif($vsize==4)
	$msg=3;
	elseif($vsize==4)
	$msg=4;

if($r[9]==0)
$count=$count+$msg;
else
$msg=0;
		
?>
  <tr>
    <td>&nbsp;<?=$k?></td>
    <td>&nbsp;<?=$r[1]?></td>
    <td>&nbsp;<?=$r[3]?></td>
    <td align="justify">&nbsp;<?=$r[4]?></td>
    <td>&nbsp;<?="$dt[2]-$dt[1]-$dt[0]"?></td>
    <td>&nbsp;<?=$r[7]?></td>
    <td>&nbsp;<?=$msg?></td>
    <td>&nbsp;<?=$status?></td>
  </tr>
<?php
$k++;
}
?>   <tr>
    <td colspan="6" align="right">Total&nbsp;</td>
    <td colspan="2">&nbsp;<?=$count?></td>
  </tr>
</table>
<br>



</form></body></html>
