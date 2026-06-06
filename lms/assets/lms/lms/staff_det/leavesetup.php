<html>
<head>
</head>

 <?php
	session_start();
	include("../db.php");
	//print_r($_GET);
	$p=$_POST['p'];
	
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
	$a_year = $_SESSION['AcademicYear'];

	?> 
<Script language="JavaScript">
    function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

</script>
  
<body>
<form Name="frm"  method="post">  
<link rel="stylesheet" type="text/css" href="css/tab.css" />

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<li class="currentBtn"><a href="leavesetup.php?tab=1" >Leave Setup</a></li>
<li><a href="leavestaffsetup.php?tab=2" >Staff Leave Detail</a></li>
<li><a href="staff_calnd.php?tab=3" >Staff Calendar</a></li>
<li><a href="staff_time.php?tab=4" >Staff Timing</a></li>
<li><a href="att_point.php?tab=5" >Attendance Point</a></li>
<li><a href="leave_paid_count.php?tab=7" >Paid Leave Update</a>
</li>
<li><a href="leave_acc.php?tab=8">Staff Year Setup</a></li>
</ul>
</div>
</div>
<table  align='center' border="1" width="50%" cellpadding="0" cellspacing="0">
<tr>
<td Class="head" align='center' colspan="2">Leave Setup</td>
</tr>
<tr>
<td align="center" >
<a href="javascript:void(0);" onClick ="OpenWind2('hrset.php?sem=<?=$sem?>&accyear=<?=$a_year?>', 'OpenWind2',500,500)">Assign HR</a>
</td>
<td align="center">
<a href="javascript:void(0);" onClick ="OpenWind2('mangsetup.php?sem=<?=$sem?>&accyear=<?=$a_year?>', 'OpenWind2',500,500)">Assign Manger</a>
</td>
</tr>
</table>
<br>
    <div align='center' >
     <a href="javascript:void(0);" style="text-decoration:none;" onClick ="OpenWind2('reporting_staff_det.php', 'OpenWind2',1200,500)">
  <input type="button"  name="paid" value="View Report"  class='bgbutton'>  </a>
  </div>
  <br>
<table  align='center' border="1" width="50%" cellpadding="0" cellspacing="0">
<tr>
<td Class="head" align='center' colspan="2">Leave Setup Detail View</td>
</tr>
<tr>
<td Class="rowpic" align='center' width='25%'>HR</td>
<td Class="rowpic" align='center' width='25%'>Manger</td>
</tr>
<tr>
<td align='center' width='25%' valign="top">
<table  align='center' border="1" width="100%" cellpadding="0" cellspacing="0">
<tr>
<td  align='center' Class="rowpic" width="10%">Sl</td>
<td  align='center' Class="rowpic">Name</td>
</tr>
<?php
$g=1;
$mangers=mysql_query("SELECT b.f_name,b.s_name FROM staff_leave_hr a,staff_det b where a.hr_id=b.id and status=1 group by a.hr_id order by b.f_name");
	while($mangers2=mysql_fetch_array($mangers))
	{
?>
<tr>
<td  align='center' width="10%"><?=$g?></td>
<td  align='left'><?=$mangers2[0]?>&nbsp;<?=$mangers2[1]?></td>
</tr>
<?php
$g++;
	}
?>
</table>
</td>
<td align='center' width='25%' valign="top">
<table  align='center' border="1" width="100%" cellpadding="0" cellspacing="0">
<tr>
<td  align='center' Class="rowpic"  width="10%">Sl</td>
<td  align='center' Class="rowpic">Name</td>
</tr>
<?php
$i=1;
$hr1=mysql_query("SELECT b.f_name,b.s_name FROM staff_leave_manger a,staff_det b where a.manger_id=b.id and status=1 group by a.manger_id  order by b.f_name");
	while($hr2=mysql_fetch_array($hr1))
	{
?>
<tr>
<td  align='center'><?=$i?></td>
<td  align='left'>&nbsp;<?=$hr2[0]?>&nbsp;<?=$hr2[1]?></td>
</tr>
<?php
$i++;
	}
?>
</table>
</td>
</tr>
</table>
</form>
</BODY>
</HTML>
