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
	    $p=111;
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
?>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/datetimepicker.css" rel="stylesheet" media="screen">

<script LANGUAGE="JavaScript">

function reload(str)
{
var url="leavecunt.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

</script>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
</head>
<?
 $manager_admin=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid=b.mng_id)");
?>
<?
	if($_POST['appr_default'])
	{	
		$default=$_POST['default'];
		for($d=0;$d<sizeof($default);$d++)
		{	
			$Sql66=execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$default[$d]'");
			if(mysql_num_rows($Sql66)>0)
			{
				execute("update staff_default_status set approved='1',reject='',inserted_date='$leave_add'  where staff_id_ins='$default[$d]'");
				?>
				<script language="javascript">
				alert("Default Leave Approved !");
				</script>
			<?php
			}
			else
			{
				execute("INSERT INTO staff_default_status (`user`,`inserted_date`,`staff_id_ins`,`type`,`in_time`,`in_edit_time`,`out_time`,`out_edit_time`,`manager_id`,`default_date`,`default_id`,`approved`,`reject`,`acc_year`) VALUES ('$user','$leave_add','$default[$d]', 'D','$in_time','$in_edit_time','$in_edit_time','$out_edit_time', '$staff_id_us[0]', '$default_date','$default_id','1','','$acc_year')");
				?>
				<script language="javascript">
				alert("Default Leave Approved !");
				</script>
			<?php	
			}
		}
	}
	
	if($_POST['rej_default'])
	{
		$default=$_POST['default'];
		for($d=0;$d<sizeof($default);$d++)
		{	 
			$Sql66=execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$default[$d]'");
			if(mysql_num_rows($Sql66)>0)
			{
				execute("update staff_default_status set reject='1',approved='',inserted_date='$leave_add' where staff_id_ins='$default[$d]'");
				?>
				<script language="javascript">
				alert("Default Leave Rejected !");
				</script>
				<?php
			}
			else
			{	
				execute("INSERT INTO staff_default_status (`user`,`inserted_date`,`staff_id_ins`,`type`,`in_time`,`in_edit_time`,`out_time`,`out_edit_time`,`manager_id`,`default_date`,`default_id`,`approved`,`reject`,`acc_year`) VALUES ('$user','$leave_add','$default[$d]', 'D','$in_time','$in_edit_time','$in_edit_time','$out_edit_time', '$staff_id_us[0]', '$default_date','$default_id','','1','$acc_year')");
				?>
				<script language="javascript">
				alert("Default Leave Rejected !");
				</script>
				<?php
			}
		}
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
        <li><a href="leave_admin_withdrwn_screen.php?tab=123" >Withdrawn</a></li>
        <li class="currentBtn"><a href="leave_admin_default_screen.php">Default</a></li>
      
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
	if($p==111){
		?>
        <li  class="currentBtn"><a href="leave_admin_default_screen.php?tab=111" >Pending Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_admin_default_screen.php?tab=111" >Pending Default</a></li>
        <?
	}
?>
<?
	if($p==222){
		?>
        <li  class="currentBtn"><a href="leave_admin_default_screen.php?tab=222" >Approved Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_admin_default_screen.php?tab=222" >Approved Default</a></li>
        <?
	}
?>
<?
	if($p==333){
		?>
        <li  class="currentBtn"><a href="leave_admin_default_screen.php?tab=333" >Rejected Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_admin_default_screen.php?tab=333" >Rejected Default</a></li>
        <?
	}
?>
</ul>
</div>
</div>

<legend><font style="font-size:16px">&nbsp;&nbsp;<b>Leave Approval</b></font></legend>
<div  style="max-height:300px; width:100%; overflow-y:auto" align="center">
<?php
if($p=='111')
{
?>
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
    <tr>
    <td class="head" align="center" width="10%" nowrap>Sel</td>
    <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center"  nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="10%" nowrap>Date</td>
    <td align="center" class="head" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Edit IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Edit OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Time Spent</td>
    <td class="head" align="center"  nowrap>Reason</td>
     <td class="head" align="center" width="10%" nowrap>Status</td>
    </tr>
  <?php
	$mang_hr=execute("select id from staff_det where active='YES'");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.id,a.EmployeeCode,a.f_name,a.s_name,b.d_date,a.group_id,b.time_in,b.time_out,b.reason,b.id,b.ins_date from staff_det a,staff_default b where b.staff_id=a.id and b.status=1 and b.staff_id='$mang_hr_rgts[0]'");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[d_date]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[0]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewss1[d_date]' and user='$viewss1[0]'  order by att_time asc limit 1"));

	$staffrfiout=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewss1[d_date]' and user='$viewss1[0]'  order by att_time desc limit 1"));	
	
	$staff_default_sts=fetcharray(execute("SELECT approved ,reject,inserted_date  FROM `staff_default_status` where staff_id_ins='$viewss1[9]'"));

	$pendings=1;
	if($staff_default_sts[0]==1)
		 {
			$pendings=0;
		 }
		 elseif($staff_default_sts[1]==1)

		 {
			  $pendings=0;
		 }
		 else
		 
{
?>
  <?php
$absnts1=1;
$absnts2=1;
if($staffrfidlv[0])
{
$absnts1=0;
}
if($staffrfiout[0]!=$staffrfidlv[0])
{
$absnts2=0;
}
?>
  
    <tr>
     <td align="center" width="10%" nowrap><input type='checkbox' name='default[]' value='<?=$viewss1[9]?>' ></td>
     <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[10])); ?></td>
        <td align="center" width="10%" nowrap><?=$viewss1[EmployeeCode]?></td>
        <td nowrap>&nbsp;<?=$viewss1[f_name]?>&nbsp;<?=$viewss1[s_name]?></td>
         <td align="center" width="10%" nowrap> 
         <?php
		 if($absnts1=='1' && $absnts2=='1')
		 {
		 ?>
         <font color="#FF0000"><b>Absent</b></font>
		<?php
		 }
		 else
		 {
		?>
         <b>Default</b>
         <?php
		 }
		 ?>
         </td>
          <td align="center" width="10%" nowrap><?=$fdate21?></td>
           <td align="center" width="10%" nowrap>
           <font color="#0033FF">
        <?php
        $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[5]' and date_type='2' and leave_det=1 and staff_date='$viewss1[d_date]'"));
$in_timeview='';	
$out_timeview='';
	if($staff_time_check_date[4])
	{
		if($staff_time_check_date[1])
		{
			echo $in_timeview=$staff_time_check_date[1];
		}
		else
		{
			echo $in_timeview=$staff_time_check_date[0];		
		}
	}
	else
	{
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[5]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[1])
		{
			echo $in_timeview=$staff_time_check[1];
		}
		else
		{
			echo $in_timeview=$staff_time_check[0];		
		}
		
	}
        ?>
        </font>
        </td>
        <td align="center">
		<font color="#006600">
        <?php
		$testin=0;
        $testout=0;
        if($staffrfidlv[0])
        {
        $testin=1;
		echo $staffrfidlv[0];
        }
        ?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
		<font color='#FF0000'>
		<?php
		$edit_timein='0';
        if($viewss1[6])
		{
			$edit_timein='1';
			echo $viewss1[6]; 
		}	
		?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
        <font color="#0033FF">
        <?php
       $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[5]' and date_type='2' and leave_det=1 and staff_date='$viewss1[d_date]'"));

	if($staff_time_check_date[4])
	{
		if($staff_time_check_date[3])
		{
			echo $out_timeview=$staff_time_check_date[3];
		}
		else
		{
			echo $out_timeview=$staff_time_check_date[2];		
		}	
	}
	else
	{
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[5]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[3])
		{
			echo $out_timeview=$staff_time_check[3];
		}
		else
		{
			echo $out_timeview=$staff_time_check[2];		
		}
		
	}
        ?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
		<font color="#006600">
        <?php
		echo $staffrfiout[0];
		if($staffrfiout[0]!=$staffrfidlv[0])
		{
		$testout=1;
		
        }
		?>
        </font>
        </td>
        <td align="center" nowrap>
		<font color='#FF0000'>
        <?php
		$edit_timeout='0';
        if($viewss1[7])
		{
			$edit_timeout='1';
			echo $viewss1[7]; 
		}	
		?>

        </font>
        </td>
        <td align="center" nowrap>
        <?
	if($edit_timein=='1' && $edit_timeout=='1')
	{
		$in_edit_time=$viewss1[6];
		$out_edit_time=$viewss1[7];
		
		$alltime1 = ($viewss1[6]);
		$alltime2 = ($viewss1[7]);
		$alltime3 = strtotime($alltime2) - strtotime($alltime1);
		$alltime1_sec=strtotime($alltime1);
		$alltime2_sec=strtotime($alltime2);
		$alltime3_sec=$alltime2_sec-$alltime1_sec;
		
			echo $alltime_final = gmdate ( 'H:i:s' , $alltime3_sec);
		
	}
	else
	{
		if($edit_timein=='1' && $edit_timeout=='0')
		{
			$in_edit_time=$viewss1[6];
			$out_time=$staffrfiout[0];
		
			$intime1 = ($viewss1[6]);
			$intime2 = ($staffrfiout[0]);
			$intime3 = strtotime($intime2) - strtotime($intime1);
			$intime1_sec=strtotime($intime1);
			$intime2_sec=strtotime($intime2);
			$intime3_sec=$intime2_sec-$intime1_sec;
				echo $intime_final = gmdate ( 'H:i:s' , $intime3_sec);
			
		}
		
		if($edit_timein=='0' && $edit_timeout=='1')
		{
			$in_time=$staffrfidlv[0];
			$out_edit_time=$viewss1[7];
			
			$outtime1 = ($staffrfidlv[0]);
			$outtime2 = ($viewss1[7]);
			$outtime3 = strtotime($outtime2) - strtotime($outtime1);
			
			$outtime1_sec=strtotime($outtime1);
			$outtime2_sec=strtotime($outtime2);
			$outtime3_sec=$outtime2_sec-$outtime1_sec;
			
				echo $outtime_final = gmdate ( 'H:i:s' , $outtime3_sec);
		}
	}
        ?>
         </td>
         <td align="justify">&nbsp;<?=stripslashes($viewss1[8])?></td>
          <td align="center" nowrap>
         <?php
		 $app_reje_datess=date("d-m-Y h:i a",strtotime($staff_default_sts[2]));
		 if($staff_default_sts[0]==1)
		 {
			 echo "<font color='#003300'><b>Approved on</b><br>$app_reje_datess</font>";
		 }
		 elseif($staff_default_sts[1]==1)

		 {
			  echo "<font color='#FF0000'><b>Rejected on</b><br>$app_reje_datess</font>";
		 }
		 else
		 {
			 echo "<font color='#0000FF'><b>Pending</b></font>";
		 }
         ?> 
         </td>
    </tr>
   <?	
	}
	}
	}
	?>
</table>
<?php
}
?>
<?php
if($p=='222')
{
?>
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
    <tr>
    <td class="head" align="center" width="10%" nowrap>Sel</td>
    <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center"  nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="10%" nowrap>Date</td>
    <td align="center" class="head" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Edit IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Edit OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Time Spent</td>
    <td class="head" align="center"  nowrap>Reason</td>
     <td class="head" align="center" width="10%" nowrap>Status</td>
    </tr>
  <?php
	$mang_hr=execute("select id from staff_det where active='YES'");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.id,a.EmployeeCode,a.f_name,a.s_name,b.d_date,a.group_id,b.time_in,b.time_out,b.reason,b.id,b.ins_date from staff_det a,staff_default b where b.staff_id=a.id and b.status=1 and b.staff_id='$mang_hr_rgts[0]'");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[d_date]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[0]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewss1[d_date]' and user='$viewss1[0]'  order by att_time asc limit 1"));

	$staffrfiout=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewss1[d_date]' and user='$viewss1[0]'  order by att_time desc limit 1"));	
	
	$staff_default_sts=fetcharray(execute("SELECT approved ,reject,inserted_date  FROM `staff_default_status` where staff_id_ins='$viewss1[9]'"));

	if($staff_default_sts[0]==1)
{
?>
  <?php
$absnts1=1;
$absnts2=1;
if($staffrfidlv[0])
{
$absnts1=0;
}
if($staffrfiout[0]!=$staffrfidlv[0])
{
$absnts2=0;
}
?>
  
    <tr>
     <td align="center" width="10%" nowrap><input type='checkbox' name='default[]' value='<?=$viewss1[9]?>' ></td>
     <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[10])); ?></td>
        <td align="center" width="10%" nowrap><?=$viewss1[EmployeeCode]?></td>
        <td nowrap>&nbsp;<?=$viewss1[f_name]?>&nbsp;<?=$viewss1[s_name]?></td>
         <td align="center" width="10%" nowrap> 
         <?php
		 if($absnts1=='1' && $absnts2=='1')
		 {
		 ?>
         <font color="#FF0000"><b>Absent</b></font>
		<?php
		 }
		 else
		 {
		?>
         <b>Default</b>
         <?php
		 }
		 ?>
         </td>
          <td align="center" width="10%" nowrap><?=$fdate21?></td>
           <td align="center" width="10%" nowrap>
           <font color="#0033FF">
        <?php
        $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[5]' and date_type='2' and leave_det=1 and staff_date='$viewss1[d_date]'"));
$in_timeview='';	
$out_timeview='';
	if($staff_time_check_date[4])
	{
		if($staff_time_check_date[1])
		{
			echo $in_timeview=$staff_time_check_date[1];
		}
		else
		{
			echo $in_timeview=$staff_time_check_date[0];		
		}
	}
	else
	{
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[5]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[1])
		{
			echo $in_timeview=$staff_time_check[1];
		}
		else
		{
			echo $in_timeview=$staff_time_check[0];		
		}
		
	}
        ?>
        </font>
        </td>
        <td align="center">
		<font color="#006600">
        <?php
		$testin=0;
        $testout=0;
        if($staffrfidlv[0])
        {
        $testin=1;
		echo $staffrfidlv[0];
        }
        ?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
		<font color='#FF0000'>
		<?php
		$edit_timein='0';
        if($viewss1[6])
		{
			$edit_timein='1';
			echo $viewss1[6]; 
		}	
		?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
        <font color="#0033FF">
        <?php
       $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[5]' and date_type='2' and leave_det=1 and staff_date='$viewss1[d_date]'"));

	if($staff_time_check_date[4])
	{
		if($staff_time_check_date[3])
		{
			echo $out_timeview=$staff_time_check_date[3];
		}
		else
		{
			echo $out_timeview=$staff_time_check_date[2];		
		}	
	}
	else
	{
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[5]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[3])
		{
			echo $out_timeview=$staff_time_check[3];
		}
		else
		{
			echo $out_timeview=$staff_time_check[2];		
		}
		
	}
        ?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
		<font color="#006600">
        <?php
		echo $staffrfiout[0];
		if($staffrfiout[0]!=$staffrfidlv[0])
		{
		$testout=1;
		
        }
		?>
        </font>
        </td>
        <td align="center" nowrap>
		<font color='#FF0000'>
        <?php
		$edit_timeout='0';
        if($viewss1[7])
		{
			$edit_timeout='1';
			echo $viewss1[7]; 
		}	
		?>

        </font>
        </td>
        <td align="center" nowrap>
        <?
	if($edit_timein=='1' && $edit_timeout=='1')
	{
		$in_edit_time=$viewss1[6];
		$out_edit_time=$viewss1[7];
		
		$alltime1 = ($viewss1[6]);
		$alltime2 = ($viewss1[7]);
		$alltime3 = strtotime($alltime2) - strtotime($alltime1);
		$alltime1_sec=strtotime($alltime1);
		$alltime2_sec=strtotime($alltime2);
		$alltime3_sec=$alltime2_sec-$alltime1_sec;
		
			echo $alltime_final = gmdate ( 'H:i:s' , $alltime3_sec);
		
	}
	else
	{
		if($edit_timein=='1' && $edit_timeout=='0')
		{
			$in_edit_time=$viewss1[6];
			$out_time=$staffrfiout[0];
		
			$intime1 = ($viewss1[6]);
			$intime2 = ($staffrfiout[0]);
			$intime3 = strtotime($intime2) - strtotime($intime1);
			$intime1_sec=strtotime($intime1);
			$intime2_sec=strtotime($intime2);
			$intime3_sec=$intime2_sec-$intime1_sec;
				echo $intime_final = gmdate ( 'H:i:s' , $intime3_sec);
			
		}
		
		if($edit_timein=='0' && $edit_timeout=='1')
		{
			$in_time=$staffrfidlv[0];
			$out_edit_time=$viewss1[7];
			
			$outtime1 = ($staffrfidlv[0]);
			$outtime2 = ($viewss1[7]);
			$outtime3 = strtotime($outtime2) - strtotime($outtime1);
			
			$outtime1_sec=strtotime($outtime1);
			$outtime2_sec=strtotime($outtime2);
			$outtime3_sec=$outtime2_sec-$outtime1_sec;
			
				echo $outtime_final = gmdate ( 'H:i:s' , $outtime3_sec);
		}
	}
        ?>
         </td>
         <td align="justify">&nbsp;<?=stripslashes($viewss1[8])?></td>
          <td align="center" nowrap>
         <?php
		 $app_reje_datess=date("d-m-Y h:i a",strtotime($staff_default_sts[2]));
		 if($staff_default_sts[0]==1)
		 {
			 echo "<font color='#003300'><b>Approved on</b><br>$app_reje_datess</font>";
		 }
		 elseif($staff_default_sts[1]==1)

		 {
			  echo "<font color='#FF0000'><b>Rejected on</b><br>$app_reje_datess</font>";
		 }
		 else
		 {
			 echo "<font color='#0000FF'><b>Pending</b></font>";
		 }
         ?> 
         </td>
    </tr>
   <?	
	}
	}
	}
	?>
</table>
<?php
}
?>

<?php
if($p=='333')
{
?>
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
    <tr>
    <td class="head" align="center" width="10%" nowrap>Sel</td>
    <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center"  nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="10%" nowrap>Date</td>
    <td align="center" class="head" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Edit IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Edit OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Time Spent</td>
    <td class="head" align="center"  nowrap>Reason</td>
     <td class="head" align="center" width="10%" nowrap>Status</td>
    </tr>
  <?php
	$mang_hr=execute("select id from staff_det where active='YES'");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.id,a.EmployeeCode,a.f_name,a.s_name,b.d_date,a.group_id,b.time_in,b.time_out,b.reason,b.id,b.ins_date from staff_det a,staff_default b where b.staff_id=a.id and b.status=1 and b.staff_id='$mang_hr_rgts[0]'");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[d_date]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[0]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewss1[d_date]' and user='$viewss1[0]'  order by att_time asc limit 1"));

	$staffrfiout=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewss1[d_date]' and user='$viewss1[0]'  order by att_time desc limit 1"));	
	
	$staff_default_sts=fetcharray(execute("SELECT approved ,reject,inserted_date  FROM `staff_default_status` where staff_id_ins='$viewss1[9]'"));

	if($staff_default_sts[1]==1)
	{
?>
  <?php
$absnts1=1;
$absnts2=1;
if($staffrfidlv[0])
{
$absnts1=0;
}
if($staffrfiout[0]!=$staffrfidlv[0])
{
$absnts2=0;
}
?>
  
    <tr>
     <td align="center" width="10%" nowrap><input type='checkbox' name='default[]' value='<?=$viewss1[9]?>' ></td>
     <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[10])); ?></td>
        <td align="center" width="10%" nowrap><?=$viewss1[EmployeeCode]?></td>
        <td nowrap>&nbsp;<?=$viewss1[f_name]?>&nbsp;<?=$viewss1[s_name]?></td>
         <td align="center" width="10%" nowrap> 
         <?php
		 if($absnts1=='1' && $absnts2=='1')
		 {
		 ?>
         <font color="#FF0000"><b>Absent</b></font>
		<?php
		 }
		 else
		 {
		?>
         <b>Default</b>
         <?php
		 }
		 ?>
         </td>
          <td align="center" width="10%" nowrap><?=$fdate21?></td>
           <td align="center" width="10%" nowrap>
           <font color="#0033FF">
        <?php
        $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[5]' and date_type='2' and leave_det=1 and staff_date='$viewss1[d_date]'"));
$in_timeview='';	
$out_timeview='';
	if($staff_time_check_date[4])
	{
		if($staff_time_check_date[1])
		{
			echo $in_timeview=$staff_time_check_date[1];
		}
		else
		{
			echo $in_timeview=$staff_time_check_date[0];		
		}
	}
	else
	{
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[5]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[1])
		{
			echo $in_timeview=$staff_time_check[1];
		}
		else
		{
			echo $in_timeview=$staff_time_check[0];		
		}
		
	}
        ?>
        </font>
        </td>
        <td align="center">
		<font color="#006600">
        <?php
		$testin=0;
        $testout=0;
        if($staffrfidlv[0])
        {
        $testin=1;
		echo $staffrfidlv[0];
        }
        ?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
		<font color='#FF0000'>
		<?php
		$edit_timein='0';
        if($viewss1[6])
		{
			$edit_timein='1';
			echo $viewss1[6]; 
		}	
		?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
        <font color="#0033FF">
        <?php
       $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[5]' and date_type='2' and leave_det=1 and staff_date='$viewss1[d_date]'"));

	if($staff_time_check_date[4])
	{
		if($staff_time_check_date[3])
		{
			echo $out_timeview=$staff_time_check_date[3];
		}
		else
		{
			echo $out_timeview=$staff_time_check_date[2];		
		}	
	}
	else
	{
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[5]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[3])
		{
			echo $out_timeview=$staff_time_check[3];
		}
		else
		{
			echo $out_timeview=$staff_time_check[2];		
		}
		
	}
        ?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
		<font color="#006600">
        <?php
		echo $staffrfiout[0];
		if($staffrfiout[0]!=$staffrfidlv[0])
		{
		$testout=1;
		
        }
		?>
        </font>
        </td>
        <td align="center" nowrap>
		<font color='#FF0000'>
        <?php
		$edit_timeout='0';
        if($viewss1[7])
		{
			$edit_timeout='1';
			echo $viewss1[7]; 
		}	
		?>

        </font>
        </td>
        <td align="center" nowrap>
        <?
	if($edit_timein=='1' && $edit_timeout=='1')
	{
		$in_edit_time=$viewss1[6];
		$out_edit_time=$viewss1[7];
		
		$alltime1 = ($viewss1[6]);
		$alltime2 = ($viewss1[7]);
		$alltime3 = strtotime($alltime2) - strtotime($alltime1);
		$alltime1_sec=strtotime($alltime1);
		$alltime2_sec=strtotime($alltime2);
		$alltime3_sec=$alltime2_sec-$alltime1_sec;
		
			echo $alltime_final = gmdate ( 'H:i:s' , $alltime3_sec);
		
	}
	else
	{
		if($edit_timein=='1' && $edit_timeout=='0')
		{
			$in_edit_time=$viewss1[6];
			$out_time=$staffrfiout[0];
		
			$intime1 = ($viewss1[6]);
			$intime2 = ($staffrfiout[0]);
			$intime3 = strtotime($intime2) - strtotime($intime1);
			$intime1_sec=strtotime($intime1);
			$intime2_sec=strtotime($intime2);
			$intime3_sec=$intime2_sec-$intime1_sec;
				echo $intime_final = gmdate ( 'H:i:s' , $intime3_sec);
			
		}
		
		if($edit_timein=='0' && $edit_timeout=='1')
		{
			$in_time=$staffrfidlv[0];
			$out_edit_time=$viewss1[7];
			
			$outtime1 = ($staffrfidlv[0]);
			$outtime2 = ($viewss1[7]);
			$outtime3 = strtotime($outtime2) - strtotime($outtime1);
			
			$outtime1_sec=strtotime($outtime1);
			$outtime2_sec=strtotime($outtime2);
			$outtime3_sec=$outtime2_sec-$outtime1_sec;
			
				echo $outtime_final = gmdate ( 'H:i:s' , $outtime3_sec);
		}
	}
        ?>
         </td>
         <td align="justify">&nbsp;<?=stripslashes($viewss1[8])?></td>
          <td align="center" nowrap>
         <?php
		 $app_reje_datess=date("d-m-Y h:i a",strtotime($staff_default_sts[2]));
		 if($staff_default_sts[0]==1)
		 {
			 echo "<font color='#003300'><b>Approved on</b><br>$app_reje_datess</font>";
		 }
		 elseif($staff_default_sts[1]==1)
		 {
			  echo "<font color='#FF0000'><b>Rejected on</b><br>$app_reje_datess</font>";
		 }
		 else
		 {
			 echo "<font color='#0000FF'><b>Pending</b></font>";
		 }
         ?> 
         </td>
    </tr>
   <?	
	}
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
  <input type="submit" name="appr_default" value="Approve"  class='bgbutton'>&nbsp;&nbsp;
 <input type="submit" name="rej_default" value="Reject"  class='bgbutton' ></a>
  </div>
</fieldset>
</fieldset>
</form>
</fieldset>
    <!----timecode---->

<!----timecode end---->
</body>
</html>

