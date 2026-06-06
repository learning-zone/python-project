<?php
session_start();
include("../db.php");

$a_year_id=$_POST['a_year_id'];
$f_day=$_POST['f_day'];
$f_month=$_POST['f_month'];
$f_year=$_POST['f_year'];
$t_day=$_POST['t_day'];
$t_month=$_POST['t_month'];
$t_year=$_POST['t_year'];
$staff_group=$_POST['staff_group'];

if($_POST['save'])
{

	$fromdate="$f_year-$f_month-$f_day";
	$todate="$t_year-$t_month-$t_day";
	if($staff_group!='' && $a_year_id!='')
	{
		$sql_id=fetchrow(execute("select id from leave_acc_staff where `a_year_id`='$a_year_id' and `staff_type`='$staff_group' and status=1"));
		if($sql_id[0]>0)		
		{	
	
					execute("UPDATE `leave_acc_staff` SET `frm_date` = '$fromdate', `to_date` = '$todate' WHERE `a_year_id`='$a_year_id' and `staff_type`='$staff_group' and status=1");
	
		}
		else
		{
			execute("INSERT INTO `leave_acc_staff` (`user`, `staff_type`, `a_year_id`, `frm_date`, `to_date`,`status`) VALUES ('$user','$staff_group','$a_year_id', '$fromdate', '$todate','1')");
		}
		?>
		<script language="javascript">
/*		alert('Academic Year Updated successfully'); 
*/		</script>
		<?php
	}
}
?>
<Script language="JavaScript">
    function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<form Name="frm" action="" method="POST">
<link rel="stylesheet" type="text/css" href="css/tab.css" />

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<li><a href="leavesetup.php?tab=1" >Leave Setup</a></li>
<li><a href="leavestaffsetup.php?tab=2" >Staff Leave Detail</a></li>
<li><a href="staff_calnd.php?tab=3" >Staff Calendar</a></li>
<li><a href="staff_time.php?tab=4" >Staff Timing</a></li>
<li><a href="att_point.php?tab=5" >Attendance Point</a>
</li>
<li><a href="leave_paid_count.php?tab=7" >Paid Leave Update</a>
</li>
<li class="currentBtn"><a href="leave_acc.php?tab=8">Staff Year Setup</a></li>
</ul>
</div>
</div>
<table width="80%" class='forumline' align='center' border="1">
<tr height="25">
<td colspan="2" align="center" class="head" nowrap>Staff Year Setup</td>
</tr>
<tr>
<td> Year </td>
<td>
<select name='a_year_id'>
<option value=''>--Select--</option>
<?
$typesv=execute("select * from leave_acc_year where status=1");
for($i=0;$i<rowcount($typesv);$i++)
{
	$typesv12=fetcharray($typesv,$i);
	if($typesv12['id']==$a_year_id)
	{
	echo "<option value='$typesv12[id]' selected>$typesv12[acc_year]</option>";
	}
	else
	{
	echo "<option value='$typesv12[id]'>$typesv12[acc_year]</option>";
	}
}
?>
</select>
&nbsp;<a href="javascript:void(0);" onClick ="OpenWind2('add_accyear.php', 'OpenWind2',500,400)" style="text-decoration:none;">
<img src="button-add.png" align="top" title="Add Leave Type"  height="25" width="25"></a></td>

</td>
</tr>
<tr>
<td>Staff Type</td>
<td>
<select name="staff_group">
<?php
$teac_1="";
$nonteac_1='';
if($staff_group==1)
{
	$teac_1="selected";
}
if($staff_group==2)
{
	$nonteac_1="selected";
}
?>
<option value=''>--Staff Type--</option>
<option value='1' <?=$teac_1?>>Permanent</option>
<option value='2' <?=$nonteac_1?>>Contractual</option>
</select>
</td>
</tr>
<tr>
<td>From Date</td>
<td>
<select name="f_day" onchange='reload()'>
<option value=''>DD</option>
<?php
for($i=1;$i<=31;$i++)
{
if($i<10)
$i="0".$i;
$sel='';
if($f_day==$i)
$sel='selected'; 
echo "<option value='$i' $sel >$i</option>";
}
?>
</select>
<select name="f_month" onchange='reload()'>
<option value=''>MM</option>
<?php
for($i=1;$i<=12;$i++)
{
if($i<10)
$i="0".$i;
$sel='';
if($f_month==$i)
$sel='selected';
echo "<option value='$i' $sel >$i</option>";
} 
?>
</select>
<select name="f_year" id="f_year" onchange='reload()'>
<option value=''>YYYY</option>
<?php
$d=date('Y')-1;
$dd=date('Y')+3;
for($i=$dd;$i>=$d;$i--)
{
$sel='';
if($f_year==$i)
$sel='selected';
echo "<option value=$i $sel >$i</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td>To Date</td>
<td>
<select name="t_day" onchange='reload()'>
<option value=''>DD</option>
<?php
for($i=1;$i<=31;$i++)
{
if($i<10)
$i="0".$i;
$sel='';
if($t_day==$i)
$sel='selected'; 
echo "<option value='$i' $sel >$i</option>";
}
?>
</select>
<select name="t_month" onchange='reload()'>
<option value=''>MM</option>
<?php
for($i=1;$i<=12;$i++)
{
if($i<10)
$i="0".$i;
$sel='';
if($t_month==$i)
$sel='selected';
echo "<option value='$i' $sel >$i</option>";
}
?>
</select>
<select name="t_year" onchange='reload()'>
<option value=''>YYYY</option>
<?php
$d=date('Y')-1;
$dd=date('Y')+3;
for($i=$dd;$i>=$d;$i--)
{
$sel='';
if($t_year==$i)
$sel='selected';
echo "<option value=$i $sel >$i</option>";
}
?>
</select>
</td>
</tr>              
</table>
<br>
<div align="center">
<input type="submit" name="save" value="Update"  class="bgbutton">
</div>
<br>
<?php
$viewstaffacc=execute("select * from leave_acc_staff where status=1");
if(rowcount($viewstaffacc)>0)
{
?>
<table width="80%" class='forumline' align='center' border="1">
<tr>
<td colspan="5" align="center" class="head" nowrap>Staff Academic Year View</td>
</tr>
<tr>
<td align="center" class="rowpic" nowrap>Sl</td>
<td align="center" class="rowpic" nowrap>Staff Type</td>
<td align="center" class="rowpic" nowrap>Academic Year</td>
<td align="center" class="rowpic" nowrap>From Date</td>
<td align="center" class="rowpic" nowrap>To Date</td>
</tr>
<?php
$g=1;
while($viewstaffacc_1=fetcharray($viewstaffacc))
{
	$stafftype_view='';
	if($viewstaffacc_1['staff_type']==1)
	{
		$stafftype_view="Permanent";
	}
	if($viewstaffacc_1['staff_type']==2)
	{
		$stafftype_view="Contractual";
	}
	$viewstaff_acc=fetcharray(execute("select * from leave_acc_year where status=1 and id='$viewstaffacc_1[a_year_id]'"));

?>
<tr>
<td align="center"><?=$g?></td>
<td align="center"><?=$stafftype_view?></td>
<td align="center"><?=$viewstaff_acc['acc_year']?></td>
<td align="center"><?=date('d-m-Y',strtotime($viewstaffacc_1['frm_date']))?></td>
<td align="center"><?=date('d-m-Y',strtotime($viewstaffacc_1['to_date']))?></td>
</tr>
<?php
$g++;
}
}
?>
</table>
</form>

</body>

</html>



