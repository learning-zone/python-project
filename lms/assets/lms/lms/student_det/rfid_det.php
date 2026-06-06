<html>
<head>
</head>
<?php
	session_start();

	include("../db.php");
	$schoolid=$_SESSION['schoolid'];
	$user=$_SESSION['user'];
	$sem=$_REQUEST['sem'];
	$StudID=$_REQUEST['StudID'];
	$app_nu=$_REQUEST['app_nu'];
	$branch=$_REQUEST['branch'];
	$a_year=$_REQUEST['a_year'];
	$studfname=$_REQUEST['studfname'];
	
	$controllerip1=$_POST['controllerip1'];
	$readerno1=$_POST['readerno1'];
	$rfidno1=$_POST['rfidno1'];
	$att_date1=$_POST['att_date1'];
	$att_time1=$_POST['att_time1'];
	?>
<?php

$stname=mysql_fetch_array(mysql_query("select first_name,last_name from student_m where id='$StudID'"));

$stgrd=mysql_fetch_array(mysql_query("select course_yearsem from student_m where id='$StudID'"));

$stsection=mysql_fetch_array(mysql_query("select class_section_id from student_m where id='$StudID'"));

$stgrdname=mysql_fetch_array(mysql_query("select year_name from course_year where year_id='$stgrd[0]'"));

$stsectionname=mysql_fetch_array(mysql_query("select section_name from class_section where id='$stsection[0]'"));

$stadmit=mysql_fetch_array(mysql_query("select admission_id from student_m where id='$StudID'"));

$ststudid=mysql_fetch_array(mysql_query("select student_id from student_m where id='$StudID'"));

$imagesst=mysql_fetch_array(mysql_query("select img_source from student_m where id='$StudID'"));

$bdate=date("Y-m-d"); 

?>

<?php
if($_POST['save'])
{
	$Sql66=mysql_query("select id from rfid_stud where studid='$StudID' and delt='N'");
	if(mysql_num_rows($Sql66)>0)
	{
		$sql33="update rfid_stud set `controllerip`='$controllerip1' , `readerno`='$readerno1',`rfidno`='$rfidno1' , `att_date`='$att_date1',`att_time`='$att_time1',to_day_date='$bdate' where studid='$StudID' and delt='N'";
		mysql_query($sql33);
	}
	else
	{
	 mysql_query("INSERT INTO rfid_stud (`controllerip`, `readerno`, `rfidno`, `att_date`, `att_time`, `studid`,to_day_date,delt) VALUES ( '$controllerip1', '$readerno1', '$rfidno1', '$att_date1', '$att_time1','$StudID','$bdate','N')");
	}
	
	?>
	<Script language="JavaScript">
	alert("Updated successfully");
	</Script>
	<?
}
?>

<?php
if($_POST['save'])
{
$rfstats="update rfidupdate set `status`='1' where controllerip='$controllerip1' and readerno='$readerno1' and rfidno='$rfidno1'";
mysql_query($rfstats);
}

if($_POST['delts'])
{
	echo "update rfid_stud set `delt`='Y' where controllerip='$controllerip1' and readerno='$readerno1' and rfidno='$rfidno1' and studid='$StudID'";
$rfsdet="update rfid_stud set `delt`='Y' where controllerip='$controllerip1' and readerno='$readerno1' and rfidno='$rfidno1' and studid='$StudID'";
mysql_query($rfsdet);

$rforg="update rfidupdate set `status`='0' where controllerip='$controllerip1' and readerno='$readerno1' and rfidno='$rfidno1'";
mysql_query($rforg);

}
?>

<form name="frm" action="" method="post">
<table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
<tr><td colspan=3 align='center' class='head'>Student Details</td></tr>
<tr>
<td align="left"><b>&nbsp;Name :</b></td>
<td align="left">&nbsp;<?=$stname[0]?> &nbsp;&nbsp;<?=$stname[1]?></td>
<td align="center" rowspan="3"><img src="<?=$imagesst[0]?>" width="100" height='100'></td>
</tr>
<tr >
<td align="left"><b>&nbsp;Grade :</b></td>
<td align="left">&nbsp;<?=$stgrdname[0]?></td>
</tr>
<tr >
<td align="left"><b>&nbsp;Section :</b></td>
<td align="left">&nbsp;<?=$stsectionname[0]?></td>
</tr>
<tr >
<td align="left"><b>&nbsp;Student ID :</b></td>
<td align="left">&nbsp;<?=$ststudid[0]?></td>
<td align="left"><b>&nbsp;</b></td>
</tr>
<tr >
<td align="left"><b>&nbsp;Admission No :</b></td>
<td align="left">&nbsp;<?=$stadmit[0]?></td>
<td align="left"><b>&nbsp;</b></td>
</tr>
</table>
<br>
<br>
<table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
<tr>
<td align='center' class='head'>Controller ID</td>
<td align='center' class='head'>Reader No</td>
<td align='center' class='head'>RFID No</td>
<td align='center' class='head'>Date</td>
<td align='center' class='head'>Time</td>
<td align='center' class='head'>Status</td>
</tr>
<?php
 
$rfids=mysql_fetch_array(mysql_query("select controllerip,readerno,rfidno,att_date,att_time from rfidupdate where status='0' order by id desc LIMIT 1"));

	
	$datesss=explode('-',$rfids[3]);
	$yy11=$datesss[0];
	$mm11=$datesss[1];
	$dd11=$datesss[2];
	$dates11="$dd11-$mm11-$yy11";

?>
<input type="hidden" value="<?=$rfids[0]?>" name="controllerip1">
<input type="hidden" value="<?=$rfids[1]?>" name="readerno1">
<input type="hidden" value="<?=$rfids[2]?>" name="rfidno1">
<input type="hidden" value="<?=$rfids[3]?>" name="att_date1">
<input type="hidden" value="<?=$rfids[4]?>" name="att_time1">

<td align='center'><?=$rfids[0]?></td>
<td align='center'><?=$rfids[1]?></td>
<td align='center'><?=$rfids[2]?></td>
<td align='center'><?=$dates11?></td>
<td align='center'><?=$rfids[4]?></td>
<td align='center'><b>Inactive</b></td>
</tr>
</table>
<br>
 <div align="center">
<input type="submit" name="save" value="Assign To Student" class="bgbutton"></div>
<br>
<?
$studact=mysql_fetch_array(mysql_query("select studid from rfid_stud where studid='$StudID' and delt='N'"));
if($studact[0])
{
	?>
<table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
<tr>
<td align='center' class='head' colspan="6">Assigned RFID Details</td>
</tr>
<tr>
<td align='center' class='head'>Controller ID</td>
<td align='center' class='head'>Reader No</td>
<td align='center' class='head'>RFID No</td>
<td align='center' class='head'>Date</td>
<td align='center' class='head'>Time</td>
<td align='center' class='head'>Status</td>
</tr>
<?php
$studeat=mysql_query("select controllerip,readerno,rfidno,att_date,att_time from rfid_stud where studid='$StudID' and delt='N'");
while($studetails=mysql_fetch_array($studeat))
{
	$stdut=explode('-',$studetails[3]);
	$yr=$stdut[0];
	$mth=$stdut[1];
	$dy=$stdut[2];
	$fullday="$dy-$mth-$yr";
?>
<tr>
<td align='center'><?=$studetails[0]?></td>
<td align='center'><?=$studetails[1]?></td>
<td align='center'><?=$studetails[2]?></td>
<td align='center'><?=$fullday?></td>
<td align='center'><?=$studetails[4]?></td>
<td align='center'><b>Active</b></td>
</tr>
<?	
}
?>
</table>
<br>
 <div align="center">
<input type="submit" name="delts" value="Inactive" class="bgbutton"></div>
<?
}
?>
<input type="hidden" value="<?=$StudID?>" name="StudID">
<?
echo "<META http-equiv='refresh' content='60;URL=rfid_det.php?StudID=$StudID' target='_parent'>";
?>
</form>
</body>
</html>

