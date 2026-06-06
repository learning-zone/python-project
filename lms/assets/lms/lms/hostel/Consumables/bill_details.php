<?php
	session_start();
	include("../../db.php");
	
$supplier = $_POST['supplier'];
$date4 = $_POST['date4'];
$date3 = $_POST['date3'];
	$ToDay=explode("-",date("d-m-Y"));
?>
<html>
<head><title>Consumables -- Stock Register</title></head>
<script language="javascript" src="../cal2.js"></script>
  <script language="javascript" src="../cal_conf2.js"></script>
<body>
<form method="post" name=frm action="bill_details_report.php">
<table border=0 class='forumline' align=center>
<tr><td Class=head colspan=2 align=center>View Bill Details</td></tr>
<tr>
<td class="rowpic" align="center" >Select Supplier</td>
<td class="row2">
<select name="supplier">
<option value=''>------ALL-------</option>
<?php
$sql=execute("select * from h_suplier_master ") or die(error_description());
for($i=0;$i<rowcount($sql);$i++)
{
	$r=fetcharray($sql,$i);
	if($r[id]==$supplier)
	{
		echo "<option value='$r[id]' selected>$r[name]</option>";
	}
	else
	{
		echo "<option value=$r[id]>$r[name]</option>";
	}
}
?>
</select></td></tr>

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
</table>
<br>
<center><input type="submit" value="View Bill Details" class='bgbutton'></center>
