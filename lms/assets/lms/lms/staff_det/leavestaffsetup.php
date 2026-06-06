<html>
<head>
</head>

 <?php
	session_start();
	include("../db.php");
	//print_r($_GET);
	$p=$_POST['p'];
	$days=$_POST['days'];
	$type=$_POST['type'];
	$stafftype=$_POST['stafftype'];

	if($_GET['tab']!='')
	{
	   $p=$_GET['tab'];
	}
	elseif($_POST['tab']!='')
	{
	   $p=$_POST['tab'];
	}
	else
	{
	    $p=1;
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
<? 
if($_POST['save'])
{
	mysql_query("INSERT INTO `leave_staff_day` (`days`,`leave_type`,`staff_type`,`status`) VALUES ('$days','$type','$stafftype','1')");
	?>
		<Script language="JavaScript">
        alert("Inserted successfully");
        </Script>
	<?php
}

if ($_POST['modi'])

{
	$cid=$_POST['Sel'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$days1=$_POST['days'.$cid[$i]];
		$type1=$_POST['type'.$cid[$i]];
		$stafftype1=$_POST['stafftype'.$cid[$i]];
		
		mysql_query("update leave_staff_day set `days`='$days1',leave_type='$type1',staff_type='$stafftype1' where id='$cid[$i]'");	
	}
	?>
		<Script language="JavaScript">
        alert("Updated successfully");
        </Script>
	<?php		
}
?>
 <Script language="JavaScript">	
	function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
</script> 
<body>
<form Name="frm"  method="post">  
<link rel="stylesheet" type="text/css" href="css/tab.css" />

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<li><a href="leavesetup.php?tab=1" >Leave Setup</a></li>
<li class="currentBtn"><a href="leavestaffsetup.php?tab=2" >Staff Leave Detail</a></li>
<li><a href="staff_calnd.php?tab=3" >Staff Calendar</a></li>
<li><a href="staff_time.php?tab=4" >Staff Timing</a></li>
<li><a href="att_point.php?tab=5" >Attendance Point</a>
</li>
<li><a href="leave_paid_count.php?tab=7" >Paid Leave Update</a>
</li>
<li><a href="leave_acc.php?tab=8">Staff Year Setup</a></li>
</ul>
</div>
</div>
<table  align='center' border="1" width="40%" cellpadding="3" cellspacing="0">
<tr>
<td Class="head" align='center' colspan="2">Staff Leave Detail</td>
</tr>
<tr>
<td align='left' nowrap>Leave Type</td>
<td align="left" nowrap>&nbsp;
<select name='type' style="width:40%">
<option value='0'>--Leave Type--</option>
<?
$typesv=execute("select id,leave_name from staff_leave_type where status='1' and special_type='1'");
for($i=0;$i<rowcount($typesv);$i++)
{
	$typesv1=fetcharray($typesv,$i);
	if($type==$typesv1[id])
	{
		echo "<option value='$typesv1[id]' selected>$typesv1[leave_name]</option>";
	}
	else
	{
		echo "<option value='$typesv1[id]'>$typesv1[leave_name]</option>";
	}
}
?>
</select>
&nbsp;<a href="javascript:void(0);" onClick ="OpenWind2('add_lev_ty.php', 'OpenWind2',500,400)" style="text-decoration:none;">
<img src="button-add.png" align="top" title="Add Leave Type"  height="25" width="25"></a></td>
</tr>
<tr>
<td align='left' nowrap>Staff Type</td>
<td align="left" nowrap>&nbsp;
<select name='stafftype' style="width:40%">
<option value='0'>--Staff Type--</option>
<option value='1'>Teaching</option>
<option value='2'>Non Teaching</option>
<?
/*$typesv22=execute("select id,name from staff_group where status=1");
for($i=0;$i<rowcount($typesv22);$i++)
{
	$typesv23=fetcharray($typesv22,$i);
	if($stafftype==$typesv23[id])
	{
		echo "<option value='$typesv23[id]' selected>$typesv23[name]</option>";
	}
	else
	{
		echo "<option value='$typesv23[id]'>$typesv23[name]</option>";
	}
}
*/?>
</select>
&nbsp;<a href="javascript:void(0);" onClick ="OpenWind2('add_staf_ty.php', 'OpenWind2',500,400)" style="text-decoration:none;">
<img src="button-add.png" align="top" title="Add Staff Type"  height="25" width="25"></a>
</td>
</tr>
<tr>
<td align='left' nowrap>No of Days</td>
<td align='left' nowrap>&nbsp;<input type="text" name="days" size="3" required></td>
</tr>
</table>
<br>
<div align='center' >
  <input type="submit" name="save" value="Save"  class='bgbutton'>
  </div>
</form>

<form Name="frm1"  method="post">
<?
$sql22=mysql_query("select id,days,leave_type,staff_type from leave_staff_day  where status=1");
if(mysql_num_rows($sql22)>0)
{  
?>
<table  align='center' border="1" width="60%" cellpadding="3" cellspacing="0">
<tr>
<td Class="head" align='center' colspan="7">Modify Staff Leave Detail</td>
</tr>
<tr>
<td align='center' class="rowpic" nowrap>Sel</td>
<td align='center' class="rowpic" nowrap>Leave Type</td>
<td align='center' class="rowpic" nowrap>Staff Type</td>
<td align='center' class="rowpic" nowrap>No of Days</td>
</tr>
<?
$viewss=mysql_query("select id,days,leave_type,staff_type from leave_staff_day  where status=1");
	while($viewss1=mysql_fetch_array($viewss))
	{
		$type=$viewss1[2];
		$stafftype_sele=$viewss1[3];
?>
<tr>
<td align="center" nowrap><input type="checkbox" name="Sel[]" Value="<?=$viewss1[0]?>"></td>
<?
$aaa='';
$specialtype=fetcharray(execute("select special_type from staff_leave_type where status=1 and id='$type'"));
if($specialtype[0]==1)
{
	$aaa='Normal Leave';
}
if($specialtype[0]==2)
{
	$aaa='Special  Leave';
}
?>
<td align="center" nowrap title="<?=$aaa?>">&nbsp;
<select name='type<?=$viewss1[0]?>' >
<option value='0'>--Leave Type--</option>
<?
$typesv=execute("select id,leave_name from staff_leave_type where status='1'  and special_type='1'");
for($i=0;$i<rowcount($typesv);$i++)
{
	$typesv1=fetcharray($typesv,$i);
	if($type==$typesv1[id])
	{
		echo "<option value='$typesv1[id]'  title='$typesv1[leave_name]' selected>$typesv1[leave_name]</option>";
	}
	else
	{
		echo "<option value='$typesv1[id]' title='$typesv1[leave_name]'>$typesv1[leave_name]</option>";
	}
}
?>
</select>
</td>
<?
$staff_ty_sel2='';
$staff_ty_sel1='';
if($stafftype_sele==1)
{
	$staff_ty_sel1='selected';
}
if($stafftype_sele==2)
{
	$staff_ty_sel2='selected';	
}
?>
<td align="center" nowrap>&nbsp;
<select name='stafftype<?=$viewss1[0]?>' style="width:50%">
<option value='0'>--Staff Type--</option>
<option value='1' <?=$staff_ty_sel1?>>Permanent</option>
<option value='2' <?=$staff_ty_sel2?>>Contractual</option>
<?
/*$typesv22=execute("select id,name from staff_group where status=1");
for($i=0;$i<rowcount($typesv22);$i++)
{
	$typesv23=fetcharray($typesv22,$i);
	if($stafftype==$typesv23[id])
	{
		echo "<option value='$typesv23[id]' title='$typesv23[name]' selected>$typesv23[name]</option>";
	}
	else
	{
		echo "<option value='$typesv23[id]' title='$typesv23[name]' >$typesv23[name]</option>";
	}
}*/
?>
</select>
</td>
<td align='center' nowrap>&nbsp;<input type="text" name="days<?=$viewss1[0]?>" size="3" value="<?=$viewss1[1]?>"></td>
</tr>
<?
}
?>
</table>
<br>
<div align='center' >
  <input type="submit" name="modi" value="Modify"  class='bgbutton'>
  </div>
  <?
}
  ?>
</form>
</BODY>
</HTML>
