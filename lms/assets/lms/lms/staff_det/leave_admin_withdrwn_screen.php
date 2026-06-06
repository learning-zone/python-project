<html>
<head>
<title>Leave Management</title>
<!---time_end--->

<?php

/*$dteof='2014-01-30 18:03:01';
echo date("d-m-Y h:i a",strtotime($dteof));*/

	session_start();
	include("../db.php");
	
	/*print_r($_POST);*/
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
	$cmnts=$_POST['cmnts'];
	$timein=$_POST['timein'];
	$timeout=$_POST['timeout'];
	$hd_ee_date=$_POST['hd_ee_date'];
	$half_time_in=$_POST['half_time_in'];
	$from_am_pm=$_POST['from_am_pm'];
	$to_am_pm=$_POST['to_am_pm'];
	
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
	    $p=123;
	}
		$staff_id_us=fetcharray(execute("SELECT srid FROM users where username='$user'"));

$staffrigtss=fetcharray(execute("SELECT shortname FROM `users` where username='$user'"));


$staffnamevali=fetcharray(execute("select b.f_name,b.s_name,b.group_id,b.category,b.recruitment_procedure,b.id from users a,staff_det b where   a.srid=b.id and a.username='$user'"));

if($staffnamevali[4]=='Nonuser')
{
	echo "<br><center><b>You are a Non User!! You cannot view this link</b></center>";
	die();
}


$leave_add=date('Y-m-d H:i:m');
$with_date_test=date('Y-m-d');
$ttimess=date('H:i:s');
$stafftime_val=strtotime('17:00');
?>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/datetimepicker.css" rel="stylesheet" media="screen">

</head>
<?
 $manager_admin=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid=b.mng_id)");
?>
        <?php
if($_POST['with_manger'])
{

	$cid_with=$_POST['cid_with'];
	for($gm=0;$gm<sizeof($cid_with);$gm++)
	{	
       execute("update staff_leave set status_reason='2',manager='$staff_id_us[0]',user_manager='$user',status_approve_manger='$leave_add' where id='$cid_with[$gm]'");
		?>
		<script language="javascript">
		alert("Withdrawn Leave Approved !");
		</script>
	<?php
	}
}

if($_POST['with_manger_rj'])
{

	$cid_with=$_POST['cid_with'];
	for($gm=0;$gm<sizeof($cid_with);$gm++)
	{
			
       execute("update staff_leave set status_reason='3',user_manager='$user',manager='$staff_id_us[0]',status_approve_manger='$leave_add' where id='$cid_with[$gm]'");
		?>
		<script language="javascript">
		alert("Withdrawn Leave Rejected !");
		</script>
	<?php	
	}
}
?>
<body>
<form name="frm2"  method="post">
<input type="hidden" name="tab" value="<?=$p?>"/>
<br>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">

        <li><a href="leave_admin.php?tab=1" >Leave & Attendance</a></li>
        <li class="currentBtn"><a href="leave_admin.php?tab=2" >Leave Approval</a></li>
        <li><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
        <li><a href="staffdetvew_rprts.php?tab=33" >Staff Attendance Report</a></li>
       <li><a href="stafftime_update.php?tab=111" >Staff Time Sheet Update</a></li>
</ul>
</div>
</div>

</form>

<form name="frm"  method="post">

<input type="hidden" name="tab" value="<?=$p?>"/>
<br />

<fieldset style="height:auto;width:100%">

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
        <li><a href="leave_admin.php?tab=4" >Submitted Leave</a></li>
        <li><a href="leave_admin.php?tab=5">Approved Leave</a></li>
        <li><a href="leave_admin.php?tab=6" >Rejected Leave</a></li>
        <li class="currentBtn"><a href="leave_admin_withdrwn_screen.php" >Withdrawn</a></li>
        <li><a href="leave_admin_default_screen.php">Default</a></li>
      
</ul>
</div>
</div>
<br />
<!--<div align="center" style="font-size:16px;width:100%;background-color:#CDBBE9;height:30px;"><font color="#000000">&nbsp;&nbsp;<b>Default Approval</b></font></div>
<br />
--><div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==123){
		?>
        <li  class="currentBtn"><a href="leave_admin_withdrwn_screen.php?tab=123" >Pending Withdrawn</a></li>
        <?
	}else{
		?>
        <li><a href="leave_admin_withdrwn_screen.php?tab=123" >Pending Withdrawn</a></li>
        <?
	}
?>
<?
	if($p==124){
		?>
        <li  class="currentBtn"><a href="leave_admin_withdrwn_screen.php?tab=124" >Approved Withdrawn</a></li>
        <?
	}else{
		?>
        <li><a href="leave_admin_withdrwn_screen.php?tab=124" >Approved Withdrawn</a></li>
        <?
	}
?>
<?
	if($p==125){
		?>
        <li  class="currentBtn"><a href="leave_admin_withdrwn_screen.php?tab=125" >Rejected Withdrawn</a></li>
        <?
	}else{
		?>
        <li><a href="leave_admin_withdrwn_screen.php?tab=125" >Rejected Withdrawn</a></li>
        <?
	}
?>
</ul>
</div>
</div>

<legend><font style="font-size:16px">&nbsp;&nbsp;<b>Leave Approval</b></font></legend>
<div  style="max-height:300px; width:100%; overflow-y:auto" align="center">
<?php
if($p=='123')
{
?>
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
<tr>
    <td class="head" align="center" width="10%" nowrap>Sl</td>
    <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center"  nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center"  nowrap>Reason</td>
    <td class="head" align="center" nowrap>Leave<br>Status</td>
    <td class="head" align="center"  nowrap>Withdrawn<br>Status</td>
  </tr>
  <?php
	$mang_hr=execute("select id from staff_det where active='YES'");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.EmployeeCode,a.id,a.reject_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.status_with_staff,a.inserted_date,a.with_color,a.submit_with,a.approved,a.reject,a.updated_date,a.inserted_date,a.status_approve_manger  from staff_leave a,staff_det c where a.status=1 and  a.status_approve=2  and c.id='$mang_hr_rgts[0]' and a.status_reason=0 and c.id=a.staff_id");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
$daycount_tot='';		
		$staff_leave_count=execute("select days from staff_leave where staff_id='$viewss1[10]' and type=$viewss1[0]'  and approved='0'   and status='1' and reject='0' and status_reason!='2'");
while($daycount=fetcharray($staff_leave_count))
	{
		$daycount_tot=$daycount[0]+$daycount_tot;
	}

$daycount_withdrawn_tst='';		
	$daycount_widwn=execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'");
	while($daycount_withdrawn=fetcharray($daycount_widwn))
	{
		$daycount_withdrawn_tst=$daycount_withdrawn[0]+$daycount_withdrawn_tst;
	}
	
		
$daysvat=fetcharray(execute("select tot_paid,paid_vat from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$viewss1[10]' and acc_id='6'"));

	//$alltot=$daysvat[0]-$$daycount_tot-$daycount_withdrawn_tst-$daysvat[1];
	$alltot=$daysvat[0]-$daysvat[1];
	
if($alltot>0)
{
$alltot1=$alltot;
}
if($alltot<=0)
{
$alltot1=0;
}

$hd_ee_date=explode('-',$viewss1[13]);
$hd_ee_daft_date=$hd_ee_date[2]."-".$hd_ee_date[1]."-".$hd_ee_date[0];
$hd_time_vw_in='';
$hd_time_vw_out='';
if($viewss1[0]=='HD')
{
	$hd_time_vw_in=date(" h:i a",strtotime($viewss1[11]));
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));

	$staflavty[0]='Half Day'."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='EE')
{
		$hd_time_vw_out=date("d-m-Y h:i a",strtotime($viewss1[12]));

	$staflavty[0]='Early Exit'."<br>"."(".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='6')
{
		$hd_time_vw_in=date(" h:i a",strtotime($viewss1[11]));
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));

	$staflavty[0]=$staflavty[0]."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[19]=='1')
{
	$submited_leave='disabled';
}
else
{
	$submited_leave='';
}
$mang_date_status=date("d-m-Y h:i a",strtotime($viewss1[24]));

if($viewss1[20]=='1')
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[22]));
	$leave_status='Approved on<br>'.$date_leave1;
}
elseif($viewss1[21]=='1')
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[22]));
	$leave_status='Rejected on<br>'.$date_leave1;
}
else
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[23]));
	$leave_status='Submitted by<br>'.$date_leave1;
	$mang_date_status='';
}
if($viewss1[19]==2)
	{
	$trcolor="leavewith";
	}
	else
	{
		$trcolor='';
	}
?>
    <tr>
   <td nowrap class="<?=$trcolor?>" align='center'  width="5%"><input type='checkbox' name='cid_with[]' value='<?=$viewss1[8]?>' <?=$submited_leave?>></td>
   <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[17])); ?></td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[7]?></td>
        <td nowrap class="<?=$trcolor?>" width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
         <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$staflavty[0]?> 
         <?php
		if($viewss1[0]=='1')
		{
		?>
         (<?=$daysvat[0]?>)
         <?php
		}
		 ?>
          <?php
		if($viewss1[0]=='7')
		{
		?>
         (7)
         <?php
		}
		 ?>
         </td>
        <td nowrap class="<?=$trcolor?>" align="center">
         <?php
		if($viewss1[0]=='1')
		{
		?>
		<?=$alltot1?>
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$fdate21?></td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$tdate21?>
        <?php
        if($viewss1[14])
		{
		?>
        (<?=$viewss1[14]?>)
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[3]?></td>
        <td class="<?=$trcolor?>" align="justify">&nbsp;<?=stripslashes($viewss1[4])?></td>
         <td nowrap class="<?=$trcolor?>" align="center">&nbsp;<?=$leave_status?></td>
          <td nowrap class="<?=$trcolor?>" width="10%" align="center">
		  <?php
          if($viewss1[15]=='2')
		  {
			  echo "<font color='#00CC00'>Approved <br> $mang_date_status</font>";
		  }
		  elseif($viewss1[15]=='3')
		  {
			  echo "<font color='#FF0000'>Rejected <br> $mang_date_status</font>";
		  }
		  else
		  {
			    echo "<font color='#0000FF'>Pending</font>";
		  }
		  
		  ?></td>
    </tr>
   <?	
	}
	}
	?>
</table>
<?php
}
?>
<?php
if($p=='124')
{
?>
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
<tr>
    <td class="head" align="center" width="10%" nowrap>Sl</td>
    <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center"  nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center"  nowrap>Reason</td>
    <td class="head" align="center" nowrap>Leave<br>Status</td>
    <td class="head" align="center"  nowrap>Withdrawn<br>Status</td>
  </tr>
  <?php
	$mang_hr=execute("select id from staff_det where active='YES'");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.EmployeeCode,a.id,a.reject_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.status_with_staff,a.inserted_date,a.with_color,a.submit_with,a.approved,a.reject,a.updated_date,a.inserted_date,a.status_approve_manger  from staff_leave a,staff_det c where a.status=1 and  a.status_approve=2  and c.id='$mang_hr_rgts[0]' and a.status_reason=2 and c.id=a.staff_id");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
$daycount_tot='';		
		$staff_leave_count=execute("select days from staff_leave where staff_id='$viewss1[10]' and type=$viewss1[0]'  and approved='0'   and status='1' and reject='0' and status_reason!='2'");
while($daycount=fetcharray($staff_leave_count))
	{
		$daycount_tot=$daycount[0]+$daycount_tot;
	}

$daycount_withdrawn_tst='';		
	$daycount_widwn=execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'");
	while($daycount_withdrawn=fetcharray($daycount_widwn))
	{
		$daycount_withdrawn_tst=$daycount_withdrawn[0]+$daycount_withdrawn_tst;
	}
	
		
$daysvat=fetcharray(execute("select tot_paid,paid_vat from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$viewss1[10]' and acc_id='6'"));

	//$alltot=$daysvat[0]-$$daycount_tot-$daycount_withdrawn_tst-$daysvat[1];
	$alltot=$daysvat[0]-$daysvat[1];
	
if($alltot>0)
{
$alltot1=$alltot;
}
if($alltot<=0)
{
$alltot1=0;
}

$hd_ee_date=explode('-',$viewss1[13]);
$hd_ee_daft_date=$hd_ee_date[2]."-".$hd_ee_date[1]."-".$hd_ee_date[0];
$hd_time_vw_in='';
$hd_time_vw_out='';
if($viewss1[0]=='HD')
{
	$hd_time_vw_in=date(" h:i a",strtotime($viewss1[11]));
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));

	$staflavty[0]='Half Day'."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='EE')
{
		$hd_time_vw_out=date("d-m-Y h:i a",strtotime($viewss1[12]));

	$staflavty[0]='Early Exit'."<br>"."(".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='6')
{
		$hd_time_vw_in=date(" h:i a",strtotime($viewss1[11]));
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));

	$staflavty[0]=$staflavty[0]."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[19]=='1')
{
	$submited_leave='disabled';
}
else
{
	$submited_leave='';
}
$mang_date_status=date("d-m-Y h:i a",strtotime($viewss1[24]));

if($viewss1[20]=='1')
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[22]));
	$leave_status='Approved on<br>'.$date_leave1;
}
elseif($viewss1[21]=='1')
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[22]));
	$leave_status='Rejected on<br>'.$date_leave1;
}
else
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[23]));
	$leave_status='Submitted by<br>'.$date_leave1;
	$mang_date_status='';
}
if($viewss1[19]==2)
	{
	$trcolor="leavewith";
	}
	else
	{
		$trcolor='';
	}
?>
    <tr>
   <td nowrap class="<?=$trcolor?>" align='center'  width="5%"><input type='checkbox' name='cid_with[]' value='<?=$viewss1[8]?>' <?=$submited_leave?>></td>
   <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[17])); ?></td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[7]?></td>
        <td nowrap class="<?=$trcolor?>" width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
         <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$staflavty[0]?> 
         <?php
		if($viewss1[0]=='1')
		{
		?>
         (<?=$daysvat[0]?>)
         <?php
		}
		 ?>
          <?php
		if($viewss1[0]=='7')
		{
		?>
         (7)
         <?php
		}
		 ?>
         </td>
        <td nowrap class="<?=$trcolor?>" align="center">
         <?php
		if($viewss1[0]=='1')
		{
		?>
		<?=$alltot1?>
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$fdate21?></td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$tdate21?>
        <?php
        if($viewss1[14])
		{
		?>
        (<?=$viewss1[14]?>)
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[3]?></td>
        <td class="<?=$trcolor?>" align="justify">&nbsp;<?=stripslashes($viewss1[4])?></td>
         <td nowrap class="<?=$trcolor?>" align="center">&nbsp;<?=$leave_status?></td>
          <td nowrap class="<?=$trcolor?>" width="10%" align="center">
		  <?php
          if($viewss1[15]=='2')
		  {
			  echo "<font color='#00CC00'>Approved <br> $mang_date_status</font>";
		  }
		  elseif($viewss1[15]=='3')
		  {
			  echo "<font color='#FF0000'>Rejected <br> $mang_date_status</font>";
		  }
		  else
		  {
			    echo "<font color='#0000FF'>Pending</font>";
		  }
		  
		  ?></td>
    </tr>
   <?	
	}
	}
	?>
</table>
<?php
}
?>

<?php
if($p=='125')
{
?>
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
<tr>
    <td class="head" align="center" width="10%" nowrap>Sl</td>
    <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center"  nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center"  nowrap>Reason</td>
    <td class="head" align="center" nowrap>Leave<br>Status</td>
    <td class="head" align="center"  nowrap>Withdrawn<br>Status</td>
  </tr>
  <?php
	$mang_hr=execute("select id from staff_det where active='YES'");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.EmployeeCode,a.id,a.reject_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.status_with_staff,a.inserted_date,a.with_color,a.submit_with,a.approved,a.reject,a.updated_date,a.inserted_date,a.status_approve_manger  from staff_leave a,staff_det c where a.status=1 and  a.status_approve=2  and c.id='$mang_hr_rgts[0]' and a.status_reason=3 and c.id=a.staff_id");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
$daycount_tot='';		
		$staff_leave_count=execute("select days from staff_leave where staff_id='$viewss1[10]' and type=$viewss1[0]'  and approved='0'   and status='1' and reject='0' and status_reason!='2'");
while($daycount=fetcharray($staff_leave_count))
	{
		$daycount_tot=$daycount[0]+$daycount_tot;
	}

$daycount_withdrawn_tst='';		
	$daycount_widwn=execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'");
	while($daycount_withdrawn=fetcharray($daycount_widwn))
	{
		$daycount_withdrawn_tst=$daycount_withdrawn[0]+$daycount_withdrawn_tst;
	}
	
		
$daysvat=fetcharray(execute("select tot_paid,paid_vat from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$viewss1[10]' and acc_id='6'"));

	//$alltot=$daysvat[0]-$$daycount_tot-$daycount_withdrawn_tst-$daysvat[1];
	$alltot=$daysvat[0]-$daysvat[1];
	
if($alltot>0)
{
$alltot1=$alltot;
}
if($alltot<=0)
{
$alltot1=0;
}

$hd_ee_date=explode('-',$viewss1[13]);
$hd_ee_daft_date=$hd_ee_date[2]."-".$hd_ee_date[1]."-".$hd_ee_date[0];
$hd_time_vw_in='';
$hd_time_vw_out='';
if($viewss1[0]=='HD')
{
	$hd_time_vw_in=date(" h:i a",strtotime($viewss1[11]));
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));

	$staflavty[0]='Half Day'."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='EE')
{
		$hd_time_vw_out=date("d-m-Y h:i a",strtotime($viewss1[12]));

	$staflavty[0]='Early Exit'."<br>"."(".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='6')
{
		$hd_time_vw_in=date(" h:i a",strtotime($viewss1[11]));
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));

	$staflavty[0]=$staflavty[0]."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[19]=='1')
{
	$submited_leave='disabled';
}
else
{
	$submited_leave='';
}
$mang_date_status=date("d-m-Y h:i a",strtotime($viewss1[24]));

if($viewss1[20]=='1')
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[22]));
	$leave_status='Approved on<br>'.$date_leave1;
}
elseif($viewss1[21]=='1')
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[22]));
	$leave_status='Rejected on<br>'.$date_leave1;
}
else
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[23]));
	$leave_status='Submitted by<br>'.$date_leave1;
	$mang_date_status='';
}
if($viewss1[19]==2)
	{
	$trcolor="leavewith";
	}
	else
	{
		$trcolor='';
	}
?>
    <tr>
   <td nowrap class="<?=$trcolor?>" align='center'  width="5%"><input type='checkbox' name='cid_with[]' value='<?=$viewss1[8]?>' <?=$submited_leave?>></td>
   <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[17])); ?></td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[7]?></td>
        <td nowrap class="<?=$trcolor?>" width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
         <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$staflavty[0]?> 
         <?php
		if($viewss1[0]=='1')
		{
		?>
         (<?=$daysvat[0]?>)
         <?php
		}
		 ?>
          <?php
		if($viewss1[0]=='7')
		{
		?>
         (7)
         <?php
		}
		 ?>
         </td>
        <td nowrap class="<?=$trcolor?>" align="center">
         <?php
		if($viewss1[0]=='1')
		{
		?>
		<?=$alltot1?>
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$fdate21?></td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$tdate21?>
        <?php
        if($viewss1[14])
		{
		?>
        (<?=$viewss1[14]?>)
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[3]?></td>
        <td class="<?=$trcolor?>" align="justify">&nbsp;<?=stripslashes($viewss1[4])?></td>
         <td nowrap class="<?=$trcolor?>" align="center">&nbsp;<?=$leave_status?></td>
          <td nowrap class="<?=$trcolor?>" width="10%" align="center">
		  <?php
          if($viewss1[15]=='2')
		  {
			  echo "<font color='#00CC00'>Approved <br> $mang_date_status</font>";
		  }
		  elseif($viewss1[15]=='3')
		  {
			  echo "<font color='#FF0000'>Rejected <br> $mang_date_status</font>";
		  }
		  else
		  {
			    echo "<font color='#0000FF'>Pending</font>";
		  }
		  
		  ?></td>
    </tr>
   <?	
	}
	}
	?>
</table>
<?php
}
?>


</div>
<br>
<div align='center' >
  <input type="submit" name="with_manger" value="Approve"  class='bgbutton'>&nbsp;&nbsp;
    <input type="submit" name="with_manger_rj" value="Reject"  class='bgbutton'>
  </div>
</fieldset>
</fieldset>
</form>
</fieldset>
<!----timecode---->
<!----timecode end---->
</body>
</html>

