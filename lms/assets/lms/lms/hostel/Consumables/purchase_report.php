<?php
	session_start();
	include("../../db.php");
	
$item = $_POST['item'];

$date4 = $_POST['date4'];
$date3 = $_POST['date3'];

	$ToDay=explode("-",date("d-m-Y"));
?>
<html>
<head><title>Consumables -- Stock Register</title></head>
<script language="javascript" src="../cal2.js"></script>
  <script language="javascript" src="../cal_conf2.js"></script>
<script language=javascript>
function dispvalue1()
{
var a1=document.frm.item.value;
var x1 = window.open("open_item2.php?item="+a1,"width=500,height=500,scrollbars=yes,status=no,toolbar=no,menubar=no,sizeable=0,left=550,top=150");
}
</script>
<body>
<form method="post" name=frm action="purchase_report_details.php">
<table  width="90%" border=0 class='forumline' align=center>
<tr><td Class=head colspan='3' align=center>View Purchase Register</td></tr>
<tr>
<td>Enter From Date</td>
<td nowrap align="LEFT">
		<input type="text" readonly="" name="date3" value="<?php echo $date3?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar3')"><img src="../../images/calendar.jpg" align="absmiddle" ></a>
        </td>
</tr>
<tr>				
<td>Enter To Date</td>
<td nowrap align="LEFT">
		<input type="text" readonly="" name="date4" value="<?php echo $date4?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar4')"><img src="../../images/calendar.jpg" align="absmiddle" ></a>
        </td>
</tr>
<tr><td>Enter the Item Name</td>
<td ><input type=text name=item id=item size=20><input type=button value=search name=search id=search onClick='javascript:dispvalue1();'><input type=hidden name=um value='$um'></td>
</tr>
</table>
<br>
<center><input type="submit" value="View Purchase Register" class='bgbutton'></center>

