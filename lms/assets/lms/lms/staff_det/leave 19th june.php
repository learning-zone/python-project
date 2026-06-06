<html>
<head>
<Script language="JavaScript">

	function RefreshMe(val)
	{
		document.frm.action="leave.php";
		document.frm.submit();
	}
	
	function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}

function OpenWind3(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<?php
	session_start();
	include("../db.php");
	
	//print_r($_POST);
	$user=$_SESSION['user'];
	$acc_year=$_SESSION['AcademicYear'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$type=$_POST['type'];
	$teacher=$_POST['teacher'];
	$avl=$_POST['avl'];
	$manager=$_POST['manager'];
	$reason=$_POST['reason'];
	$backup=$_POST['backup'];
	$days=$_POST['days'];
	$contact=$_POST['contact'];
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
?>
<link rel="stylesheet" type="text/css" href="css/tab.css" />

<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
</head>
<?php
if($_POST['save'])
{
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	$ttdate=explode('/',$bdate);
	$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];
	
  $qry=mysql_query("INSERT INTO staff_leave (user,avl, reason, manager,type, f_date, t_date, backup, notify, days, contact,acc_year, status) VALUES ('$user','$avl','$reason', '$manager','$type','$fdate','$tdate','$backup', '$teacher', '$days','$contact','$acc_year','1')");
?>
<script language="javascript">
alert("Inserted Sucessfully");
</script>
<?php
}
?>
<body>
<form name="frm"  method="post">
<input type="hidden" name="tab" value="<?=$p?>"/>
<input type="hidden" name="avl" value="<?=$avl?>"/>
<input type="hidden" name="contact" value="<?=$contact?>"/>
<input type="hidden" name="type" value="<?=$type?>"/>
<input type="hidden" name="reason" value="<?=$reason?>"/>
<input type="hidden" name="backup" value="<?=$backup?>"/>
<br>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==1){
		?>
        <li class="currentBtn"><a href="leave.php?tab=1" >Apply Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=1" >Apply Leave</a></li>
        <?
	}
?>
<?
	if($p==2 || $p==4 || $p==5  || $p==6){
		?>
        <li class="currentBtn"><a href="leave.php?tab=2" >Leave Approval</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=2" >Leave Approval</a></li>
        <?
	}
?>



</ul>
</div>
</div>
<fieldset style="height:auto">
<?php
if($p==1)
	{
?>
<br>
<fieldset style="height:auto">
<legend>Leave Form</legend>

<table align='center'  width='100%' border="0" cellpadding="3" cellspacing="0">
    <tr>
        <td style="font-size:14px" align="left" width="10%">AVL Comp Off</td>
        <td align="left"  width="25%"><input type="text" name="avl" value="<?=$avl?>" size="3" style="background-color: #FFFFCC"> </td>
        <td style="font-size:14px" align="left"  width="10%">Manager</td>
        <td style="font-size:14px" align="left" width="25%"><input type="text" name="manager" value=""  readonly style="background-color: #FFFFCC"></td>
        <td style="font-size:14px" align="left" colspan="2"><a href="javascript:void(0);" onClick ="OpenWind2('staff.php', 'OpenWind2',400,500)">Notify Others</a></td>
    </tr>
    <tr>
        <td style="font-size:14px" align="left">Leave Type*</td>
        <td><select name="type" style="background-color: #FFFFCC"  onchange="RefreshMe(0)">
        <option value='0'>Select Leave Type</option>
        <?
		$chech1='';
		$chech2='';
        if($type=='Earned Leave')
		{
			$chech1='selected';
		}
		if($type=='Paternity Leave')
		{
			$chech2='selected';
		}
		?>
        <option value='Earned Leave' <?=$chech1?>>Earned Leave</option>
        <option value='Paternity Leave' <?=$chech2?>>Paternity Leave</option>
        </select></td>
        <td  style="font-size:14px" align="left"> Leave Duration* </td>
        <td style="font-size:14px" align="left" nowrap>
        <input type="text" readonly name="adate" value="<?php echo $adate?>" size="10" style="background-color: #FFFFCC" required > &nbsp;
        <a href="javascript:showCal('Calendar1')"><img src="Calendar.gif" align="absmiddle"></a>
        &nbsp;&nbsp;-&nbsp;&nbsp;
        <input type="text" readonly name="bdate" value="<?php echo $bdate?>" size="10" style="background-color: #FFFFCC" required>&nbsp;
        <a href="javascript:showCal('Calendar2')"><img src="Calendar.gif" align="absmiddle"></a>
        </td>
        <td style="font-size:14px" align="left">No. Days</td>
        <td align="left"><input type="number" name="days" value="" size="3" style="background-color: #FFFFCC"> </td>
    </tr>
    <tr>
        <td  style="font-size:14px" align="left">Reason* </td>
        <td><textarea rows="3" cols="30" name='reason'  style="background-color: #FFFFCC" required><?=$reason?></textarea></td>
        <td  style="font-size:14px" align="left">Backup Resource</td>
        <td align="left"><input type="text" name="backup" value="<?=$backup?>" style="background-color: #FFFFCC"> </td>
        <td style="font-size:14px" align="left">Alt Contact #</td>
        <td align="left"><input type="text" name="contact" value="<?=$contact?>" size="20" style="background-color: #FFFFCC" > </td>
    </tr>
</table>
</fieldset>
<br>
<div align='center' >
  <input type="submit" name="save" value="Save"  class='bgbutton'>
  </div>
<?
	}
?>
<?php
if($p==2 || $p==4)
	{
?>
<br>
<input type="hidden" name="tab" value="<?=$p?>"/>
<fieldset style="height:auto">
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==4){
		?>
        <li class="currentBtn"><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
</ul>
</div>
</div>

<legend>Leave Approval</legend>
<br>
<?
if($p==4)
{
?>
<input type="hidden" name="tab" value="<?=$p?>"/>
<div style="max-height:600px; overflow-y:auto" align="center">
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <tr>
  <td class="head" align="center">Sel</td>
    <td class="head" align="center">Employee Code</td>
    <td class="head" align="center">Employee Name</td>
    <td class="head" align="center">Leave Type</td>
    <td class="head" align="center">From Date</td>
    <td class="head" align="center">To Date</td>
    <td class="head" align="center">Total Days</td>
    <td class="head" align="center">Reason</td>
  </tr>
  <?php
	$viewss=mysql_query("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno from staff_leave a,users b,staff_det c where a.status=1 and a.user=b.username and b.srid=c.id");
	while($viewss1=mysql_fetch_array($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
	?>
    <tr>
 <td align="center"><input type="checkbox" name="manager" value=""></td>
        <td align="center"><?=$viewss1[7]?></td>
        <td>&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td align="center"><?=$viewss1[0]?></td>
        <td align="center"><?=$fdate21?></td>
        <td align="center"><?=$tdate21?></td>
        <td align="center"><?=$viewss1[3]?></td>
        <td>&nbsp;<?=$viewss1[4]?></td>
    </tr>
   <?	
	}
}
	?>
</table>
<br>
<?
$sql43=mysql_query("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno from staff_leave a,users b,staff_det c where a.status=1 and a.user=b.username and b.srid=c.id");
if(mysql_num_rows($sql43)>=1)
{	
if($p==4)
{
?>
<div align='center' >
  <input type="submit" name="appr" value="Approve"  class='bgbutton'>&nbsp;&nbsp;
  <input type="submit" name="rej" value="Reject"  class='bgbutton'>
  </div>
  <?
}
}
  ?>
</div>
</fieldset>
<?
	}
?>
<?php
if($p==5)
	{
?>
<br>
<input type="hidden" name="tab" value="<?=$p?>"/>
<fieldset style="height:auto">

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==4){
		?>
        <li class="currentBtn"><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
</ul>
</div>
</div>
<legend>Leave Approval</legend>
<br>
<div style="max-height:600px; overflow-y:auto" align="center">
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <tr>
        <td class="head" align="center">Sel</td>
    <td class="head" align="center">Employee Code</td>
    <td class="head" align="center">Employee Name</td>
    <td class="head" align="center">Leave Type</td>
    <td class="head" align="center">From Date</td>
    <td class="head" align="center">To Date</td>
    <td class="head" align="center">Total Days</td>
    <td class="head" align="center">Reason</td>
  </tr>
  <?php
	$viewss=mysql_query("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno from staff_leave a,users b,staff_det c where a.approved=1 and a.status=1 and a.user=b.username and b.srid=c.id");
	while($viewss1=mysql_fetch_array($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
	?>
    <tr>
 <td align="center"><input type="checkbox" name="manager" value=""></td>
        <td align="center"><?=$viewss1[7]?></td>
        <td>&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td align="center"><?=$viewss1[0]?></td>
        <td align="center"><?=$fdate21?></td>
        <td align="center"><?=$tdate21?></td>
        <td align="center"><?=$viewss1[3]?></td>
        <td>&nbsp;<?=$viewss1[4]?></td>
    </tr>
   <?	
	}
	?>
</table>
</div>
</fieldset>

<?
	}
?>
  <br>
   <?php
if($p==1)
	{
$sql3=mysql_query("select id,type,f_date,t_date,backup,days,reason from staff_leave where user='$user' and status=1");
if(mysql_num_rows($sql3)>=1)
{	
	?>
  <fieldset style="height:auto">
<legend>Applied Leave Details</legend>
<div style="max-height:600px; overflow-y:auto" align="center">
<table align='center'  width='100%' border="0" cellpadding="3" cellspacing="0">
    <td class="head" align="center">Sel</td>
    <td class="head" align="center">Leave Type</td>
    <td class="head" align="center">From Date</td>
    <td class="head" align="center">To Date</td>
    <td class="head" align="center">No. Of Days</td>
    <td class="head" align="center">Status</td>
    <td class="head" align="center">Backup Resource</td>
  </tr>
  
 <?php
  while($r6=mysql_fetch_array($sql3))
	{
		$tfdate1=explode('-',$r6[2]);
		$fdate1=$tfdate1[2]."-".$tfdate1[1]."-".$tfdate1[0];
		$ttdate1=explode('-',$r6[3]);
		$tdate1=$ttdate1[2]."-".$ttdate1[1]."-".$ttdate1[0];
 ?>
  <tr>
  <td align='center'  nowrap><input type='checkbox' name='cid[]' value=<?=$r6[0]?></td>
    <td align="center" title="<?=$r6[6]?>"><?=$r6[1]?></td>
    <td align="center" title="<?=$r6[6]?>"><?=$fdate1?></td>
    <td align="center" title="<?=$r6[6]?>"><?=$tdate1?></td>
    <td align="center" title="<?=$r6[6]?>"><?=$r6[5]?></td>
    <td align="center" title="Modify"><a href="javascript:void(0);" onClick ="OpenWind3('update1.php?id=<?=$r6[0]?>', 'OpenWind3',400,400)">Submitted</a></td>
    <td align="center" title="<?=$r6[6]?>"><?=$r6[4]?></td>
  </tr>
  <?
	}

?>
</table>

<br>
<div align='center' >
  <input type="submit" name="del" value="Delete"  class='bgbutton'>
  </div>
 
  </div>
<?
}
	}
  ?>
  <?php
if($p==6)
	{
?>
<input type="hidden" name="tab" value="<?=$p?>"/>
<fieldset style="height:auto">

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==4){
		?>
        <li class="currentBtn"><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
</ul>
</div>
</div>
<legend>Leave Approval</legend>
<br>
<div style="max-height:600px; overflow-y:auto" align="center">
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <tr>
      <td class="head" align="center">Sel</td>
    <td class="head" align="center">Employee Code</td>
    <td class="head" align="center">Employee Name</td>
    <td class="head" align="center">Leave Type</td>
    <td class="head" align="center">From Date</td>
    <td class="head" align="center">To Date</td>
    <td class="head" align="center">Total Days</td>
    <td class="head" align="center">Reason</td>
  </tr>
  <?php
	$viewss=mysql_query("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno from staff_leave a,users b,staff_det c where a.reject=1 and a.status=1 and a.user=b.username and b.srid=c.id");
	while($viewss1=mysql_fetch_array($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
	?>
    <tr>
     <td align="center"><input type="checkbox" name="manager" value=""></td>
        <td align="center"><?=$viewss1[7]?></td>
        <td>&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td align="center"><?=$viewss1[0]?></td>
        <td align="center"><?=$fdate21?></td>
        <td align="center"><?=$tdate21?></td>
        <td align="center"><?=$viewss1[3]?></td>
        <td>&nbsp;<?=$viewss1[4]?></td>
    </tr>
   <?	
	}
	?>
</table>
</div>
</fieldset>

<?
	}
?>
</fieldset>
</fieldset>
</form>
</body>
</html>

