<?php
include("db.php");
session_start();
error_reporting (E_ALL ^ E_NOTICE);
$sysdate=date("d/m/Y");
$adate=$sysdate;
$bdate=$adate;
$adate='0';
$sql=mysql_query("SELECT * FROM camp_info WHERE ID = '$val'");
while($row = mysql_fetch_array($sql))
{
?>
<html>
<head>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
</head>
<body>
<form method=post name="frm" action="update.php">
<table border="1" align="center" bordercolor="#000000" cellpadding='0' cellspacing="0">
<tr><td colspan="3" align="center"><font color="#990000"><b>CAMPAIGNS</b></font> </td></tr>
<tr  height='30'>
<td>&nbsp;&nbsp;Name</font></td>
<td>&nbsp;&nbsp;<input type="text" name="cmp" value="<?php echo $row[CAMP_NAME]?>">
</tr>
<tr height="30">
<td>&nbsp;&nbsp;Start Date</td>
<td>&nbsp;&nbsp;<input type="text" readonly="" name="adate" value="<?php echo $adate;?>">&nbsp;&nbsp;
<a href="javascript:showCal('Calendar1')"><img src="images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
</td>
</tr>
<tr height="30">
<td>&nbsp;&nbsp;End Date</td>
<td>&nbsp;&nbsp;<input type="text" readonly="" name="bdate" value="<?php echo $bdate;?>">&nbsp;&nbsp;
<a href="javascript:showCal('Calendar2')"><img src="images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
</td>
</tr>
<tr  height='30'>
<td>&nbsp;&nbsp;All Sales Happened During This Period </font></td>
<td>&nbsp;&nbsp;<input type="checkbox" name="period" value="1" >
</tr>
<tr  height='30'>
<td>&nbsp;&nbsp;All Enquiries Generated During This Period </font></td>
<td>&nbsp;&nbsp;<input type="checkbox" name="period1" value="1" >	</td>
</tr>
	<?php
	}
	?>
</form>
</table>