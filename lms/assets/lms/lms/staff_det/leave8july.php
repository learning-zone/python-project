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
	$totdays=$_POST['totdays'];
	
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
		if($adate!='' && $bdate!='' && $type!='0')
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
			<? 
			}
		else
		{
			?>
			<script language="javascript">
			alert("Please Enter From Date & To Date");
			</script>
			<?
		}
    }
    ?>
<?php
if($_POST['appr'])
{

	$manager=$_POST['manager'];
	for($m=0;$m<sizeof($manager);$m++)
	{
        mysql_query("update staff_leave set approved='1' where id='$manager[$m]'");	
	}
		?>
		<Script language="JavaScript">
		alert("Approved");
		</Script>
        <?
}
		?>
        <?php
if($_POST['rej'])
{

	$manager=$_POST['manager'];
	for($c=0;$c<sizeof($manager);$c++)
	{
        mysql_query("update staff_leave set reject='1',approved='0' where id='$manager[$c]'");	
	}
		?>
		<Script language="JavaScript">
		alert("Rejected !");
		</Script>
        <?
}
		?>
        
        <?php
if($_POST['del'])
{

	$cid=$_POST['cid'];
	for($g=0;$g<sizeof($cid);$g++)
	{
        mysql_query("update staff_leave set status='0' where id='$cid[$g]'");	
	}
		?>
		<Script language="JavaScript">
		alert("Deleted Sucessfully");
		</Script>
        <?
}
		?>
<body>
<form name="frm2"  method="post">
<input type="hidden" name="tab" value="<?=$p?>"/>
<input type="hidden" name="avl" value="<?=$avl?>"/>
<input type="hidden" name="contact" value="<?=$contact?>"/>
<input type="hidden" name="type" value="<?=$type?>"/>
<input type="hidden" name="reason" value="<?=$reason?>"/>
<input type="hidden" name="backup" value="<?=$backup?>"/>
<input type="hidden" name="days" value="<?=$totdays?>"/>
<?
$staffname1=mysql_fetch_array(mysql_query("SELECT DATEDIFF(day,'2008-06-05','2008-08-05') AS DiffDate"));
echo $staffname1[0];
?>
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
	if($p==2 || $p==4 || $p==5  || $p==6 || $p==7){
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
</form>

<form name="frm"  method="post">
<?php
if($p==1)
	{
?>

<fieldset style="height:auto">
<legend><b>Leave Form</b></legend>


<?php
	$fromdate=explode('/',$adate);
	$pfdate=$fromdate[2]."-".$fromdate[1]."-".$fromdate[0];
	$totdate=explode('/',$bdate);
	$ptdate=$totdate[2]."-".$totdate[1]."-".$totdate[0];
	
//no of days	
$date_entered_email_sec=strtotime($ptdate);
$date_modified_email_sec=strtotime($pfdate); 
$turn_around_time_sec = $date_entered_email_sec - $date_modified_email_sec;
 
$daysTotal = ceil((date("z") - date("w")) / 7);
$daysTotal = ceil((date("j") - date("w")) / 7); 
$tot_day = floor($turn_around_time_sec / 86400)+1;

//no of sundays
	$date1 = $pfdate;
	$date2 = $ptdate;

for ($i = 0; $i < ((strtotime($date2) - strtotime($date1)) / 86400); $i++)
{
	if(date('l',strtotime($date1) + ($i * 86400)) == 'Sunday')
	{
		$num_sundays++;
	}
}

if($adate!='' && $bdate!='')
{
	$totdays=$tot_day-$num_sundays;
}

$staffname=mysql_fetch_array(mysql_query("select b.f_name,b.s_name from users a,staff_det b where   a.srid=b.id and a.username='$user'"));
?>

<table align='center'  width='100%' border="0" cellpadding="3" cellspacing="0">
    <tr>
        <td style="font-size:14px" align="left" width="10%">Name :</td>
        <td align="left"  width="25%">&nbsp;
        <?php
        if($user!='administrator')
        {
        ?>
         <?=$staffname[0]?>&nbsp;<?=$staffname[1]?>
        <?php
        }
        if($user=='administrator')
        {
        ?>
       		Administrator
        <?php
        }
        ?>
        </td>
        <td style="font-size:14px" align="left"  width="10%">Reporting Mgr</td>
        <td style="font-size:14px" align="left" width="25%"><input type="text" name="managername" value=""  readonly style="background-color: #FFFFCC"></td>
        <td style="font-size:14px" align="left" colspan="2">
	<?php        
    if($adate!='' && $bdate!='')
    {
    ?>
    <a href="javascript:void(0);" onClick ="OpenWind2('staff.php?&pfdate=<?=$pfdate?>&ptdate=<?=$ptdate?>', 'OpenWind2',400,500)">Notify Others</a>
    <?
    }
    ?>
</td>
    </tr>
    <tr>
        <td style="font-size:14px" align="left">Leave Type*</td>
        <td><select name="type" style="background-color: #FFFFCC">
        <option value='0'>Select Leave Type</option>
        <?
		$chech1='';
		$chech2='';
		$chech3='';
        	if($type=='Causal Leave')
		{
			$chech1='selected';
		}
		if($type=='Sick Leave')
		{
			$chech2='selected';
		}
		if($type=='Paternity Leave')
		{
			$chech3='selected';
		}
		?>
        <option value='Causal Leave' <?=$chech1?>>Causal Leave</option>
        <option value='Sick Leave' <?=$chech2?>>Sick Leave</option>
        <option value='Paternity Leave' <?=$chech3?>>Paternity Leave</option>
        </select></td>
        <td  style="font-size:14px" align="left"> Leave Duration* </td>
        <td style="font-size:14px" align="left" nowrap>
        <input type="text" readonly name="adate" value="<?php echo $adate?>" size="10" style="background-color: #FFFFCC"  onFocus="RefreshMe(0)" required> &nbsp;
        <a href="javascript:showCal('Calendar1')"><img src="Calendar.gif" align="absmiddle"></a>
        &nbsp;&nbsp;-&nbsp;&nbsp;
        <input type="text" readonly name="bdate" value="<?php echo $bdate?>" size="10" style="background-color: #FFFFCC" onFocus="RefreshMe(0)"  required>&nbsp;
        <a href="javascript:showCal('Calendar2')"><img src="Calendar.gif" align="absmiddle"></a>
        </td>
        <td style="font-size:14px" align="left">No. Days</td>
        <td align="left"><input type="number" name="days" value="<?=$totdays?>" size="3" style="background-color: #FFFFCC" readonly> </td>
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
	if($p==4 || $p==2){
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
<?
	if($p==7){
		?>
        <li class="currentBtn"><a href="leave.php?tab=7">Approve Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=7" >Approve Leave</a></li>
        <?
	}
?>
</ul>
</div>
</div>

<legend><b>Leave Approval</b></legend>
<br>
<?
if($p==4 || $p==2)
{
?>
<input type="hidden" name="tab" value="<?=$p?>"/>
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <tr>
  <td class="head" align="center" width="3%">Sel</td>
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="10%">Staff Name</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="10%">Total Days</td>
    <td class="head" align="center" width="10%">Reason</td>
    <td class="head" align="center" width="1%"></td>
  </tr>
  </table>
<div style="max-height:300px; overflow-y:auto" align="center">
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <!--<tr>
   <td class="head" align="center" width="5%">Sel</td>
    <td class="head" align="center" width="5%">Staff Code</td>
    <td class="head" align="center" width="10%">Staff Name</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="5%">From Date</td>
    <td class="head" align="center" width="5%">To Date</td>
    <td class="head" align="center" width="5%">Total Days</td>
    <td class="head" align="center" width="11%">Reason</td>
  </tr>-->
  <?php
	$viewss=mysql_query("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno,a.id from staff_leave a,users b,staff_det c where a.status=1 and a.approved='0' and a.reject='0' and a.user=b.username and b.srid=c.id");
	while($viewss1=mysql_fetch_array($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];

	?>
    <tr>
 <td align="center" width="3%"><input type="checkbox" name="manager[]" value="<?=$viewss1[8]?>"></td>
        <td align="center" width="10%"><?=$viewss1[7]?></td>
        <td width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td align="center" width="10%"><?=$viewss1[0]?></td>
        <td align="center" width="10%"><?=$fdate21?></td>
        <td align="center" width="10%"><?=$tdate21?></td>
        <td align="center"width="10%"><?=$viewss1[3]?></td>
        <td width="10%">&nbsp;<?=$viewss1[4]?></td>
    </tr>
   <?	
	}
}
	?>
</table>
</div>
<br>
<?
if($p==4 || $p==2)
{
$values=mysql_query("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno from staff_leave a,users b,staff_det c where a.status=1 and a.approved='0' and a.reject='0' and a.user=b.username and b.srid=c.id");
if(mysql_num_rows($values)>=1)
{		
	
?>
<div align='center' >
  <input type="submit" name="appr" value="Approve"  class='bgbutton'>&nbsp;&nbsp;
 <input type="submit" name="rej" value="Reject"  class='bgbutton' ></a>
  </div>
  <?
}
}
  ?>
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
<?
	if($p==7){
		?>
        <li class="currentBtn"><a href="leave.php?tab=7">Approve Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=7" >Approve Leave</a></li>
        <?
	}
?>
</ul>
</div>
</div>
<legend><b>Leave Approval</b></legend>
<br>
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <tr>
  <td class="head" align="center" width="3%">Sel</td>
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="10%">Staff Name</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="10%">Total Days</td>
    <td class="head" align="center" width="10%">Reason</td>
    <td class="head" align="center" width="1%"></td>
  </tr>
  </table>
<div style="max-height:300px; overflow-y:auto" align="center">
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <!--<tr>
  <td class="head" align="center" width="3%">Sel</td>
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="10%">Staff Name</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="10%">Total Days</td>
    <td class="head" align="center" width="10%">Reason</td>
    <td class="head" align="center" width="1%"></td>
  </tr>-->
  <?php
	$viewss=mysql_query("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno,a.id from staff_leave a,users b,staff_det c where a.approved=1 and a.status=1 and a.user=b.username and b.srid=c.id");
	while($viewss1=mysql_fetch_array($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
	?>
    <tr>
 <td align="center" width="3%"><input type="checkbox" name="manager[]" value="<?=$viewss1[8]?>"></td>
        <td align="center"  width="10%"><?=$viewss1[7]?></td>
        <td width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td align="center" width="10%"><?=$viewss1[0]?></td>
        <td align="center" width="10%"><?=$fdate21?></td>
        <td align="center" width="10%"><?=$tdate21?></td>
        <td align="center" width="10%"><?=$viewss1[3]?></td>
        <td  width="10%">&nbsp;<?=$viewss1[4]?></td>
    </tr>
   <?	
	}
	?>
</table>
</div>
<br>
<?
if($p==5)
{
$values=mysql_query("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno from staff_leave a,users b,staff_det c where a.status=1 and a.approved=1 and a.user=b.username and b.srid=c.id");
if(mysql_num_rows($values)>=1)
{		
?>
<div align='center' >
  <input type="submit" name="rej" value="Reject"  class='bgbutton'>
  </div>
  <?
}
}
  ?>
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
    </form>
<form name="frm1"  method="post">
  <fieldset style="height:auto">
<legend><b>Applied Leave Details</b></legend>
<table align='center'  width='100%' border="0" cellpadding="3" cellspacing="0">
    <td class="head" align="center" width="5%">Sel</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="5%">No. Of Days</td>
    <td class="head" align="center" width="5%">Status</td>
    <td class="head" align="center" width="10%">Backup Resource</td>
    <td class="head" align="center" width="1%"></td>
  </tr>
  </table>
<div style="max-height:200px; overflow-y:auto" align="center">
<table align='center'  width='100%' border="0" cellpadding="3" cellspacing="0">
<!--<tr>
   <td class="head" align="center" width="5%">Sel</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="5%">No. Of Days</td>
    <td class="head" align="center" width="5%">Status</td>
    <td class="head" align="center" width="10%">Backup Resource</td>
  </tr>-->
  
 <?php
  while($r6=mysql_fetch_array($sql3))
	{
		$tfdate1=explode('-',$r6[2]);
		$fdate1=$tfdate1[2]."-".$tfdate1[1]."-".$tfdate1[0];
		$ttdate1=explode('-',$r6[3]);
		$tdate1=$ttdate1[2]."-".$ttdate1[1]."-".$ttdate1[0];
 ?>
  <tr>
  <td align='center'  width="5%"><input type='checkbox' name='cid[]' value=<?=$r6[0]?></td>
    <td align="center" title="<?=$r6[6]?>" width="10%"><?=$r6[1]?></td>
    <td align="center" title="<?=$r6[6]?>" width="10%"><?=$fdate1?></td>
    <td align="center" title="<?=$r6[6]?>" width="10%"><?=$tdate1?></td>
    <td align="center" title="<?=$r6[6]?>" width="5%"><?=$r6[5]?></td>
    <td align="center" title="Modify" width="5%"><a href="javascript:void(0);" onClick ="OpenWind3('update1.php?id=<?=$r6[0]?>', 'OpenWind3',400,400)">Submitted</a></td>
    <td align="center" title="<?=$r6[6]?>" width="10%"><?=$r6[4]?></td>
  </tr>
  <?
	}

?>
</table>
</div>
<br>
<div align='center' >
  <input type="submit" name="del" value="Delete"  class='bgbutton'>
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
<?
	if($p==7){
		?>
        <li class="currentBtn"><a href="leave.php?tab=7">Approve Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=7" >Approve Leave</a></li>
        <?
	}
?>
</ul>
</div>
</div>
<legend><b>Leave Approval</b></legend>
<br>
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <tr>
 <!-- <td class="head" align="center" width="3%">Sel</td>-->
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="10%">Staff Name</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="10%">Total Days</td>
    <td class="head" align="center" width="10%">Reason</td>
    <td class="head" align="center" width="1%"></td>
  </tr>
  </table>
<div style="max-height:300px; overflow-y:auto" align="center">
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <!--<tr>
    <td class="head" align="center">Sel</td>
    <td class="head" align="center">Staff Code</td>
    <td class="head" align="center">Staff Name</td>
    <td class="head" align="center">Leave Type</td>
    <td class="head" align="center">From Date</td>
    <td class="head" align="center">To Date</td>
    <td class="head" align="center">Total Days</td>
    <td class="head" align="center">Reason</td>
  </tr>-->
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
    <!-- <td align="center"><input type="checkbox" name="manager" value=""></td>-->
        <td align="center" width="10%"><?=$viewss1[7]?></td>
        <td width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td align="center" width="10%"><?=$viewss1[0]?></td>
        <td align="center" width="10%"><?=$fdate21?></td>
        <td align="center" width="10%"><?=$tdate21?></td>
        <td align="center" width="10%"><?=$viewss1[3]?></td>
        <td width="10%">&nbsp;<?=$viewss1[4]?></td>
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


<?
if($p==7 )
{
?>
<input type="hidden" name="tab" value="<?=$p?>"/>
<fieldset style="height:auto">
<legend><b>Leave Approval</b></legend>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==4 || $p==2){
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
<?
	if($p==7){
		?>
        <li class="currentBtn"><a href="leave.php?tab=7">Approve Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=7" >Approve Leave</a></li>
        <?
	}
?>
</ul>
</div>
</div>
<br>
<input type="hidden" name="tab" value="<?=$p?>"/>
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <tr>
  <td class="head" align="center" width="5%">Sel</td>
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="20%">Staff Name</td>
    <td class="head" align="center" width="10%">Staff Group</td>
    <td class="head" align="center" width="10%">Department</td>
    <td class="head" align="center" width="10%">Designation</td>
    <td class="head" align="center" width="10%">Mobile Number </td>
    <td class="head" align="center" width="1%"></td>
  </tr>
  </table>
<div style="max-height:300px; overflow-y:auto" align="center">
<table align='center'  width='100%' border="1" cellpadding="3" cellspacing="0">
  <!--<tr>
  <td class="head" align="center" width="5%">Sel</td>
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="20%">Staff Name</td>
    <td class="head" align="center" width="10%">Staff Group</td>
    <td class="head" align="center" width="10%">Department</td>
    <td class="head" align="center" width="10%">Designation</td>
    <td class="head" align="center" width="10%">Mobile Number </td>
  </tr>-->
  <?php
	$staffnm=mysql_query("select a.id, a.f_name,a.s_name,a.slno,a.mobileno,a.subj,a.type_id,a.group_id from staff_det a,users b where  b.srid=a.id order by a.f_name");
	while($staffnms=mysql_fetch_array($staffnm))
	{
		$staff_des1=mysql_fetch_row(mysql_query("select d_name from staff_des where d_id=$staffnms[6]"));
		$dept_no1=mysql_fetch_row(mysql_query("select Dept from dept_no where dpt_id=$staffnms[5]"));
		$staff_group1=mysql_fetch_row(mysql_query("select name from staff_group where id=$staffnms[7]"));

	?>
    <tr>
 <td align="center" width="5%"><input type="checkbox" name="staff_id1[]" value="<?=$staffnms[0]?>"></td>
        <td align="center" width="10%"><?=$staffnms[3]?></td>
        <td width="20%">&nbsp;<?=$staffnms[1]?>&nbsp;<?=$staffnms[2]?></td>
        <td align="center" width="10%"><?=$staff_group1[0]?></td>
        <td align="center" width="10%"><?=$dept_no1[0]?></td>
        <td align="center" width="10%"><?=$staff_des1[0]?></td>
        <td align="center" width="10%"><?=$staffnms[4]?></td>
    </tr>
   <?	
	}
}
	?>
</table>
</div>
<br>
<?php
if($p=='7')
{
?>
<div align='center' >
  <input type="submit" name="send" value="Send"  class='bgbutton' title="Send to HR">
  </div>
  <?
}
  ?>
</fieldset>

</form>
</fieldset>
</body>
</html>

