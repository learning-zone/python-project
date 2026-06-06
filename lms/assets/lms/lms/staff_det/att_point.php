<html>
<title>Attendance Point</title>
 <?php
	include("../db.php");
	$staffids=$_POST['staffids'];
	$point_att_vt=$_POST['point_att_vt'];
	$color_code=$_POST['color_code'];
	$ttimess=date('Y-m-d H:i:s');
	?>

<head>
    <script type="text/javascript" src="color/jscolor.js"></script>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<li><a href="leavesetup.php?tab=1" >Leave Setup</a></li>
<li><a href="leavestaffsetup.php?tab=2" >Staff Leave Detail</a></li>
<li><a href="staff_calnd.php?tab=3" >Staff Calendar</a></li>
<li><a href="staff_time.php?tab=4" >Staff Timing</a>
<li class="currentBtn"><a href="att_point.php?tab=5" >Attendance Point</a>
</li>
<li><a href="leave_paid_count.php?tab=7" >Paid Leave Update</a>
</li>
<li><a href="leave_acc.php?tab=8">Staff Year Setup</a></li>

</ul>
</div>
</div>
</head>
<?php
if($_POST['subn'])
{
	$cid=$_POST['cid'];
	for($gm=0;$gm<sizeof($cid);$gm++)
	{
		$point_att_vt=$_POST['point_att_vt'.$cid[$gm]];
		$color_code=$_POST['color_code'.$cid[$gm]];
		
        execute("update leave_att_point set point_att='$point_att_vt',	att_colors='$color_code',username='$user',staff_date_time='$ttimess' where id='$cid[$gm]'");	
	}
	?>
			<script language="javascript">
			alert("Attendance Point Updated Sucessfully");
			</script>
			<? 
}
?>
<body>

<form Name="frm"  method="post">


<br>  

<table  align='center' border="0" width="50%" cellpadding="3" cellspacing="0">

<tr><td colspan="4" class="head" align="center"><b>Attendance Point</b></td></tr>
<tr>
<td class="row3" align="center">Sl</td>
<td class="row3" align="center">Name</td>
<td class="row3" align="center">Point</td>
<td class="row3" align="center">Color</td
></tr>
	<?php
$update_attenc=execute("SELECT * FROM `leave_att_point` WHERE status=1");
while($update_attenc1=fetcharray($update_attenc))
{
	
	$r5=fetcharray(execute("select * from staff_att_updt where toddate='$tdatess' and staff_id='$staffids' and type='$update_attenc1[id]'"));	

			
	?>

	<tr>
 <td align='center'  width="5%"><input type='checkbox' name='cid[]' value='<?=$update_attenc1[id]?>' ></td>
	<td align="center"><b><font color="<?=$update_attenc1[att_colors]?>"><?=$update_attenc1[name]?></font></b></td>

	<td align="center"><input type="text" size="5%" name="point_att_vt<?=$update_attenc1[id]?>" value="<?=$update_attenc1[point_att]?>" >

    </td>
    <td align="center">
    <input type="text" size="15%" name="color_code<?=$update_attenc1[id]?>" class="color" value="<?=$update_attenc1[att_colors]?>" >
    </td>
    </tr>
<?
}
?>
</table>

<br>

<div align='center'><input type='submit' name='subn' value='Update' class='bgbutton'></div>

<br>

</form>

</BODY>

</HTML>

