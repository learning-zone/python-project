<?php
	session_start();	
include("../../db.php");
$dept = $_POST['dept'];
$date4 = $_POST['date4'];
$date3 = $_POST['date3'];

	$ToDay=explode("-",date("d-m-Y"));
?>
<html>
<head><title>Consumables -- Departmentwise Issues Report</title></head>
<script language="javascript" src="../cal2.js"></script>
  <script language="javascript" src="../cal_conf2.js"></script>
<body>
<form method="post" name=frm action="DepartmentwiseItemIssuesReport.php">
<table border=1 align=center class=forumline>
<tr><td Class=head colspan=2 align=center>View Departmentwise Item Issues Report</td></tr>
<tr><td Class=rowpic>Select Department</td><td class=row2><select name="dept">
<option value="-1">ALL</option>
<?php
	$sql=execute("select * from dept_no where Dept<>'Central Stores'");
   for($i=0;$i<rowcount($sql);$i++)
	{
		$r=fetcharray($sql,$i);
		echo "<option value=$r[dpt_id]>$r[Dept]</option>";
	}
?>
</select>
</td>
</tr>
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
<center><input type="submit" class=bgbutton value="View Departmentwise Report"></center>
