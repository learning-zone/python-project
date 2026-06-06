<?php

include("../db.php");
$user=$_SESSION['user'];
//$academic_year=$_SESSION['AcademicYear'];
//$acc_year=$_SESSION['AcademicYear'];
//$a_year=$_SESSION['AcademicYear'];

$academic_year=2013;
$acc_year=2013;
$a_year=2013;

$today_date=date("Y-m-d");
if(($_GET["page"])) //$_page
{ 
	$page  = $_GET["page"]; 
} 
else 
{ 
	$page=1; 
};
$start_from = ($page-1) * 10;
$sort_by = $_REQUEST['sort_by'];
$sort_type = $_REQUEST['sort_type'];
if($_POST)
{
$staff_group_id=$_POST['staff_group_id'];
$leave_point=$_POST['leave_point'];
$p_leave=$_POST["p_leave"];
$a_leave=$_POST["a_leave"];
$wo_leave=$_POST["wo_leave"];
$h_leave=$_POST["h_leave"];
$l_leave=$_POST["l_leave"];
$fhl_leave=$_POST["fhl_leave"];
$shl_leave=$_POST["shl_leave"];
$lwp_leave=$_POST["lwp_leave"];
$pee_leave=$_POST["pee_leave"];
$plc_leave=$_POST["plc_leave"];
$pqd_leave=$_POST["pqd_leave"];
$pod_leave=$_POST["pod_leave"];
$dft_leave=$_POST["dft_leave"];
$studfname=$_POST["studfname"];
$saffid=$_POST["saffid"];
$leav_cunt=$_POST["leav_cunt"];
}
if($_REQUEST)
{
$staff_group_id=$_REQUEST['staff_group_id'];
$leave_point=$_REQUEST['leave_point'];
$p_leave=$_REQUEST["p_leave"];
$a_leave=$_REQUEST["a_leave"];
$wo_leave=$_REQUEST["wo_leave"];
$h_leave=$_REQUEST["h_leave"];
$l_leave=$_REQUEST["l_leave"];
$fhl_leave=$_REQUEST["fhl_leave"];
$shl_leave=$_REQUEST["shl_leave"];
$lwp_leave=$_REQUEST["lwp_leave"];
$pee_leave=$_REQUEST["pee_leave"];
$plc_leave=$_REQUEST["plc_leave"];
$pqd_leave=$_REQUEST["pqd_leave"];
$dft_leave=$_REQUEST["dft_leave"];
$pod_leave=$_REQUEST["pod_leave"];
}
if($sort_by=="")
	$sort_by="f_name";
if($sort_type=="")
	$sort_type="ASC";
?>
<title>Staff Attendance Report</title>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
  <script>
function RefreshMe(val)
	{	
		document.frm.action="staffdetvew_rprts_tst.php";
		document.frm.submit();
	}
	function gen_excel()
		{
			document.frm.action='staffdetvew_rprts_execl.php';
			document.frm.submit();
		}
		function gen_excel_test()
		{
			document.frm.action='staffdetvew_rprts_execl_point.php';
			document.frm.submit();
		}
	</script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
  $("#flip1").click(function(){
    $("#panel1").slideToggle("fast");
  });
});
</script>
<style type="text/css"> 
#panel1,#flip1
{
padding:3px;
text-align:center;
background: -webkit-gradient(linear, left top, left bottom, from( #CCC), to( #CCC));
background: -moz-linear-gradient(center top , #FFF , #FFF) repeat scroll 0 0 transparent;	
border:solid 1px  #000000;
color:rgb(0,0,0);
}
#panel1
{
padding:3px;
display:none;
}
</style>
<script LANGUAGE="JavaScript">
function reload(str)
{
var url="leave_points.php";
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
<form name="frm"  method="post">
<?php
$from_pay_today=explode('-',$today_date);
	$from_pay_20=$from_pay_today[0]."-".$from_pay_today[1]."-20";
	
	if($today_date > $from_pay_20)
	{
		$topay_validate=date('Y-m-d', strtotime('1 month', strtotime($from_pay_20)));
		$topay_validate_final=explode('-',$topay_validate);
		$topay_mnth=$topay_validate_final[0]."-".$topay_validate_final[1]."-20";
		
			$topay_pay_date1=explode('-',$from_pay_20);
			$topay_mnth_pay=$topay_pay_date1[2]."/".$topay_pay_date1[1]."/".$topay_pay_date1[0];
			
			$topay_pay_bdate1=explode('-',$topay_mnth);
			$topay_mnth_bpay=$topay_pay_bdate1[2]."/".$topay_pay_bdate1[1]."/".$topay_pay_bdate1[0];
		
		$adate_pay=$topay_mnth_pay;
		$bdate_pay=$topay_mnth_bpay;
	}
	else
	{
		$topay_validate=date('Y-m-d', strtotime('-1 month', strtotime($from_pay_20)));
		$topay_validate_final=explode('-',$topay_validate);
		$topay_mnth=$topay_validate_final[0]."-".$topay_validate_final[1]."-20";
		
		
		
		$topay_pay_date1=explode('-',$from_pay_20);
			$topay_mnth_pay=$topay_pay_date1[2]."/".$topay_pay_date1[1]."/".$topay_pay_date1[0];
			
			$topay_pay_bdate1=explode('-',$topay_mnth);
			$topay_mnth_bpay=$topay_pay_bdate1[2]."/".$topay_pay_bdate1[1]."/".$topay_pay_bdate1[0];
	
		$adate_pay=$topay_mnth_bpay;
		$bdate_pay=$topay_mnth_pay;
	}
?>
<?php
if($_GET['adate']!='')
	{
	   $adate=$_GET['adate'];
	}
	elseif($_POST['adate']!='')
	{
	   $adate=$_POST['adate'];
	}
	else
	{
	    $adate_pay;
		$payfromdate_1=explode("/",$adate_pay);
		$adate="21/".$payfromdate_1[1]."/".$payfromdate_1[2];
	}
if($_GET['bdate']!='')
	{
	   $bdate=$_GET['bdate'];
	}
	elseif($_POST['bdate']!='')
	{
	   $bdate=$_POST['bdate'];
	}
	else
	{
	    $bdate=$bdate_pay;
	}
$staffrigtss=fetcharray(execute("SELECT shortname,srid FROM `users` where username='$user'"));
?>
<br>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<li><a href="leave.php?tab=1" >Leave & Attendance</a></li>
<?php
if($staffrigtss[0]=='admin')
{
?>
<li><a href="leave_admin.php?tab=2" >Leave Approval</a></li>
<?php
}
else
{
?>
<li><a href="leave.php?tab=2" >Leave Approval</a></li>
<?php
}
?>
<li><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
<li class="currentBtn"><a href="staffdetvew_rprts_tst.php?tab=33" >Staff Attendance Report</a></li>
 <li><a href="stafftime_update.php?tab=111" >Staff Time Sheet Update</a></li>
<?php
if($staffrigtss[0]!='admin')
{
?>
<li><a href="staff_profile.php?tab=20" >My Time Sheet</a></li>
<li ><a href="leave_count.php?tab=65" >Leave Details</a></li>  
<?php
}
?> 
</ul>
</div>
</div>
<br />
<table width="70%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Select Date</td>
    </tr>
   <tr>
		<td nowrap>&nbsp;&nbsp;From &nbsp;<input type="text" readonly name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle"></a>
        </td>
		<td nowrap>
        &nbsp;&nbsp;To &nbsp;<input type="text" readonly name="bdate" value="<?php echo $bdate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle"></a>
        </td>
	</tr>  
    <tr>
    <?php
	$first_point='';
	$secnd_point='';
	if($leave_point==1)
	{
		$first_point='selected';
	}
	if($leave_point==2)
	{
		$secnd_point='selected';
	}
	$grupid1='';
	$grupid2='';
	if($staff_group_id==1)
	{
		$grupid1='selected';
	}
	if($staff_group_id==2)
	{
		$grupid2='selected';
	}
	?>
    <td colspan="2" nowrap="nowrap">&nbsp;Select &nbsp;
    <select name="leave_point" onChange="reload(this.value)">
    <option value='1' <?=$first_point?>>Select</option>
    <option value='2' <?=$secnd_point?>>Leave Type</option>		
    </select>
     &nbsp;&nbsp;
    Staff Name
    <input type="text" name="studfname" value="<?=$studfname?>">
    &nbsp;
      &nbsp;&nbsp;
    Staff Id
    <input type="text" name="saffid" value="<?=$saffid?>">
     &nbsp;&nbsp;
      <select name="staff_group_id">
    <option value='' >Staff Type</option>
    <option value='1' <?=$grupid1?>>Teaching</option>		
    <option value='2' <?=$grupid2?>>Non Teaching</option>		
    </select>
     &nbsp;&nbsp;
    No of days >= 
    <input type="text" size="3" name="leav_cunt" value="<?=$leav_cunt?>">
    &nbsp;
    <div id="txtHint9" class="inline">
    <?php
	if($leave_point=='2')
	{ 
	$pchecked="";
	$achecked="";
	$wochecked="";
	$hchecked="";
	$lchecked="";
	$fhlchecked="";
	$shlchecked="";
	$lwpchecked="";
	$peechecked="";
	$plcchecked="";
	$pqdchecked="";
	$dchecked="";
	$podchecked="";
	if($p_leave==1)
	{
		$pchecked="checked";
	}
	if($a_leave==2)
	{
		$achecked="checked";
	}
	if($wo_leave==3)
	{
		$wochecked="checked";
	}
	if($h_leave==4)
	{
		$hchecked="checked";
	}
	if($l_leave==5)
	{
		$lchecked="checked";
	}
	if($fhl_leave==6)
	{
		$fhlchecked="checked";
	}
	if($shl_leave==7)
	{
		$shlchecked="checked";
	}
	if($lwp_leave==8)
	{
		$lwpchecked="checked";
	}
	if($pee_leave==9)
	{
		$peechecked="checked";
	}
	if($plc_leave==10)
	{
		$plcchecked="checked";
	}
	if($pqd_leave==11)
	{
		$pqdchecked="checked";
	}
	if($dft_leave==12)
	{
		$dchecked="checked";
	}
	if($pod_leave==13)
	{
		$podchecked="checked";
	}
	?>
    <b>Leave Points : </b>
    <input type="checkbox" name="dft_leave" value="12" <?=$dchecked?> />&nbsp;Default
    <input type="checkbox" name="p_leave" value="1" <?=$pchecked?>  />&nbsp;P
    <input type="checkbox" name="a_leave" value="2" <?=$achecked?> />&nbsp;A
    <input type="checkbox" name="wo_leave" value="3" <?=$wochecked?> />&nbsp;WO
    <input type="checkbox" name="h_leave" value="4" <?=$hchecked?> />&nbsp;H
    <input type="checkbox" name="l_leave" value="5" <?=$lchecked?> />&nbsp;L
    <input type="checkbox" name="fhl_leave" value="6" <?=$fhlchecked?>  />&nbsp;FHL
    <input type="checkbox" name="shl_leave" value="7" <?=$shlchecked?> />&nbsp;SHL
    <input type="checkbox" name="lwp_leave" value="8" <?=$lwpchecked?> />&nbsp;LWP
    <input type="checkbox" name="pee_leave" value="9" <?=$peechecked?> />&nbsp;P(EE)
    <input type="checkbox" name="plc_leave" value="10" <?=$plcchecked?> />&nbsp;P(LC)
    <input type="checkbox" name="pqd_leave" value="11" <?=$pqdchecked?>  />&nbsp;P(QD)
	<input type="checkbox" name="pod_leave" value="13" <?=$podchecked?>  />&nbsp;P(OD)
    <?php
	}
	?>
    </div>
    </td>
    </tr>
</table> 
<br>
<div align='center'>
<INPUT TYPE="button" NAME="go" onclick="RefreshMe(0)" class='bgbutton' VALUE="Search" >
</div>
<?php
$vwadtae=explode("/",$adate);
$vwadtae[0];
$vwadtae[1];
$vwadtae[2];
$vwadtae1=$vwadtae[2]."-".$vwadtae[1]."-".$vwadtae[0];
$bvwadtae=explode("/",$bdate);
$bvwadtae[0];
$bvwadtae[1];
$bvwadtae[2];
$bvwadtae1=$bvwadtae[2]."-".$bvwadtae[1]."-".$bvwadtae[0];
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
//no working of days
if(strtotime($today_date)>strtotime($ptdate))
{
	$datetoss=$ptdate;
}
else
{
	$datetoss=$today_date;
}
$date_entered_email_sec1=strtotime($datetoss);
$date_modified_email_sec1=strtotime($pfdate); 
$turn_around_time_sec1 = $date_entered_email_sec1 - $date_modified_email_sec1;
$daysTotal1 = ceil((date("z") - date("w")) / 7);
$daysTotal1 = ceil((date("j") - date("w")) / 7); 
$tot_day1 = floor($turn_around_time_sec1 / 86400)+1;
$shl_staff='14:00:00';
$fhl_staff='12:00:00';
if($leave_point=='2')
	{ 
?>
<br>
<br>
<table cellspacing="0" cellpadding="0" border="1" align="center" width="100%">
<tr>
    <td align="center" colspan="<?=$tot_day+10?>" class="head" nowrap="nowrap">Staff Attendance Report <?=$adate?> - <?=$bdate?></td>
    </tr>
  <tr>
    <td align="center" class="row3" nowrap="nowrap">Sl</td>
    <td align="center" class="row3" nowrap="nowrap">Name</td>
    <td align="center" class="row3" nowrap="nowrap">Staff ID</td>
<?php
/* for($c=0;$c<$tot_day;$c++)
{
$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
$viewdate_att=date("d M", $attview);
?>
 <td align="center" class="row3" nowrap="nowrap"><?=$viewdate_att?></td>
<?php
}*/
?>
 <td align="center" class="row3" nowrap="nowrap">Working Days</td>
<?php 
 if($dft_leave==12)
	{
   ?> 
 <td align="center" class="row3" nowrap="nowrap">Default</td>
 <?php
	}
 if($p_leave==1)
	{
   ?> 
  <td align="center" class="row3" nowrap="nowrap">Present Days</td>
  <?php
	}
	 if($a_leave==2)
	{
  ?>
    <td align="center" class="row3" nowrap="nowrap">Absent</td>
    <?php
	}
	 if($wo_leave==3)
	{
	?>
  <td align="center" class="row3" nowrap="nowrap">Week Off</td>
  <?php
	}
	 if($h_leave==4)
	{
  ?>
      <td align="center" class="row3" nowrap="nowrap">School Holidays</td>
      <?php
	}
	 if($l_leave==5)
	{
	  ?>
  <td align="center" class="row3" nowrap="nowrap">Leave</td>
<?php
	}
	 if($fhl_leave==6)
	{
?>
   <td align="center" class="row3" nowrap="nowrap">First Half Leave</td>
    <?php
	}
	 if($shl_leave==7)
	{
	?>
    <td align="center" class="row3" nowrap="nowrap">Second Half Leave</td>
    <?php
	}
	 if($lwp_leave==8)
	{
	?>
    <td align="center" class="row3" nowrap="nowrap">Leave Without Pay</td>
    <?php
	}
	 if($pee_leave==9)
	{
	?>
    <td align="center" class="row3" nowrap="nowrap">Early Exist</td>
    <?php
	}
	 if($plc_leave==10)
	{
		?>
    <td align="center" class="row3" nowrap="nowrap">Late Coming</td>
    <?php
	}
	 if($pqd_leave==11)
	{
	?>
	<td align="center" class="row3" nowrap="nowrap">Quarter Days</td>
<?php
	}
	 if($pod_leave==13)
	{
	?>
	<td align="center" class="row3" nowrap="nowrap">Outdoor</td>
    <?php
	}
$tot_work_holiday='0';
$tot_work_sunday='0';
$manger_rights='';
$staff_right_vw=execute("select * from staff_leave_manger where manger_id='$staffrigtss[1]' and status=1 and acc_year='$acc_year'");
if(rowcount($staff_right_vw)>0)
{
	$manger_rights=1;
}
if($user=='pujas')
{
	$manger_rights='';
}
if($manger_rights)
{
$staff_name_display="select a.f_name,a.s_name,a.EmployeeCode,a.group_id,a.id from staff_det a,users b,staff_hr_grup c where c.status=1 and b.username='$user' and b.srid=c.mng_id and a.id=c.staff_id and a.active='YES' and a.id!='$staffrigtss[1]'  and (a.recruitment_procedure='User' or a.recruitment_procedure='')";
	if($staff_group_id!='')
	{
	
	$staff_name_display.=" and a.group_id='$staff_group_id'";
	
	}
	if($studfname!='')
	{
	
	$staff_name_display.=" and a.f_name like '$studfname%' or a.s_name like '$studfname%'";
	
	}
	if($saffid!='')
	{
	
	$staff_name_display.=" and a.EmployeeCode like '$saffid%'";
	
	}
	
	$staff_name_display.=" group by c.staff_id order by a.f_name";
}
else
{
$staff_name_display="SELECT * from staff_det where  active='YES'  and (recruitment_procedure='User' or recruitment_procedure='') and id!='$staffrigtss[1]'";
	if($staff_group_id!='')
	{
	
	$staff_name_display.=" and group_id='$staff_group_id'";
	
	}
	if($studfname!='')
	{
	
	$staff_name_display.=" and f_name like '$studfname%' or s_name like '$studfname%'";
	
	}
	if($saffid!='')
	{
	
	$staff_name_display.=" and EmployeeCode like '$saffid%'";
	
	}
	$staff_name_display.=" group by id order by f_name";
}
$staffname=execute($staff_name_display);
$s=1;
while($staffnameview=fetcharray($staffname))
{
$staffnameview[0]=$staffnameview['f_name'];
$staffnameview[1]=$staffnameview['s_name'];
$staffnameview[2]=$staffnameview['EmployeeCode'];
$staffnameview[3]=$staffnameview['group_id'];
$staffnameview[4]=$staffnameview['id'];
$viewss1['0']=$staffnameview['f_name'];
$viewss1['1']=$staffnameview['s_name'];
$viewss1['2']=$staffnameview['EmployeeCode'];
$viewss1['3']=$staffnameview['group_id'];
$viewss1['4']=$staffnameview['id'];
?>
<tr>
<?php 
$totday_sun_holiday='';
 for($c=0;$c<$tot_day;$c++)
{
$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
$viewdate_att=date("Y-m-d", $attview);
$viewdate_sunday=date("D", $attview);
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$staffnameview[4]'"));
$staffif=trim($staffrfid[0]);
	
	$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type='2' and leave_det=1 and staff_date='$viewdate_att'"));
$in_timeview='';	
$out_timeview='';
	if($staff_time_check_date[4])
	{
		if($staff_time_check_date[1])
		{
			$in_timeview=$staff_time_check_date[1];
		}
		else
		{
			$in_timeview=$staff_time_check_date[0];		
		}
		if($staff_time_check_date[3])
		{
			$out_timeview=$staff_time_check_date[3];
		}
		else
		{
			$out_timeview=$staff_time_check_date[2];		
		}	
	}
	else
	{
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[1])
		{
			$in_timeview=$staff_time_check[1];
		}
		else
		{
			$in_timeview=$staff_time_check[0];		
		}
		if($staff_time_check[3])
		{
			$out_timeview=$staff_time_check[3];
		}
		else
		{
			$out_timeview=$staff_time_check[2];		
		}
		
	}
/*$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' order by att_time asc ");*/
$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc limit 1"));
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time desc limit 1"));
$count=0;
/*$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$viewdate_att' and staff_typ='$staffnameview[3]'"));*/
?>
<!--<td align="center" nowrap>
--><?php
$point_five='0.5';
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' order by att_time asc ");
$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$viewdate_att' and staff_typ='$staffnameview[3]'"));
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$viewdate_att' between f_date and t_date) and status=1 and status_approve!=2 order by id desc"));
$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$viewdate_att' and status=1 and status_approve!=2 order by id desc"));
$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$viewdate_att'"));
/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));

$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee!='EE' && $leave_od_ee!='6' && $leave_update_att[4]!='2' && $leave_test[1]!=1 && $leave_od_ee[1]!=1)
	{
		
		
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`update_points` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		
		$staff_working=$view_att_staff[2]+$staff_working;
		
		$status_find=0;
		
			if($updated_att_staff[0]==1)
			{
				$count_presnt++;
			}
			if($updated_att_staff[0]==2)
			{
				$count_absent++;
			}
			if($updated_att_staff[0]==3)
			{
				$count_wo++;
			}
			if($updated_att_staff[0]==4)
			{
				$count_holdyas++;
			}
			if($updated_att_staff[0]==5)
			{
				$count_l++;
			}
			if($updated_att_staff[0]==6)
			{
				$count_fhl++;
			}
			if($updated_att_staff[0]==7)
			{
				$count_shl++;
			}
			if($updated_att_staff[0]==8)
			{
				$count_lwp++;
			}
			if($updated_att_staff[0]==9)
			{
				$count_pee++;
			}
			if($updated_att_staff[0]==10)
			{
				$count_plc++;
			}
			if($updated_att_staff[0]==11)
			{
				$count_pqd++;
			}
			if($updated_att_staff[0]==12)
			{
				$count_pod++;
			}
		
		}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($viewdate_att))
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
			
			$status_find=0;
			$totday_sun_holiday++;
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
		
			$status_find=0;
			$totday_sun_holiday++;
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($viewdate_att))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if(strtotime($leave_test[7])==strtotime($viewdate_att))
		{
			$date_corrects=0;
			if($leave_test[5])
			{
				$from_half_day=explode('_',$leave_test[5]);
				if($from_half_day[1]=='ain')
				{
					$count_fhl++;
				$first_half='FHL';
				}
				if($from_half_day[1]=='pin')
				{
					$count_shl++;
				$first_half='SHL';
				}
			}
			else
			{
				$first_half=1;
			}
			if($first_half!=1)
			{
				if($leave_test[2]==3)
				{
				}
				else
				{
				}
		$tot_paid_holiday=0.5+$tot_paid_holiday;
			}
			else
			{
				if($leave_test[2]==3)
				{
				}
				else
				{
				}
				$tot_paid_holiday++;
			}
		}
		
		//to date in FHL or SHL
		if(strtotime($leave_test[8]==$viewdate_att) && strtotime($leave_test[7])!=strtotime($leave_test[8]))
		{
			$date_corrects=0;
			if($leave_test[6])
			{
				$secnd_half_day=explode('_',$leave_test[6]);
				if($secnd_half_day[1]=='aout')
				{
					$count_fhl++;
					$secnd_half='FHL';
				}
				if($secnd_half_day[1]=='pout')
				{
					$count_shl++;
					$secnd_half='SHL';
				}
			}
			else
			{
				$secnd_half=1;
			}
			if($secnd_half!=1)
			{
				if($leave_test[2]==3)
				{
				}
				else
				{
				}
			$tot_paid_holiday=0.5+$tot_paid_holiday;
			}
			else
			{
				if($leave_test[2]==3)
				{
				}
				else
				{
				}
				$tot_paid_holiday++;
			}
		}
		
		if($date_corrects)
		{
			if($leave_test[2]==3)
				{
				}
				else
				{
				}
		$tot_paid_holiday++;
		}
					
			$status_find=0;
		//end///////////
		}
		//od
		if($leave_od_ee[2]=='6' && $leave_od_ee[0]=='1' && $leave_od_ee[4]!='2')
		{
			$count_pod++;
			$status_find=0;
		}
		//EE
		if($leave_od_ee[2]=='EE'  && $leave_od_ee[0]=='1' && $leave_od_ee[4]!='2')
		{
			$count_pee++;
			$status_find=0;
		}
	}
	
if($status_find)
{
if($count=='0')
{
	if(strtotime($today_date)>strtotime($viewdate_att))
	{
		//Absent approval stage(its in same in default stage)
		$satff_absent_date=fetcharray(execute("select id from staff_default where staff_id='$staffnameview[4]' and status=1 and d_date='$viewdate_att'"));
		
		$staff_absent_sts=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_absent_date[0]'"));		
		if($staff_absent_sts[0] == '1')
		{
		
		$staff_working=1+$staff_working;
			
		}
		elseif($staff_absent_sts[1]=='1')
		{
			
		$count_absent++;
		}
		else
		{	
		
		$count_absent++;
		}
	}
}
elseif($count=='1')
{
	//"Default";
	if(strtotime($today_date)>strtotime($viewdate_att))
	{
		//default approval stage
		$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$staffnameview[4]' and status=1 and d_date='$viewdate_att'"));
		
		$staff_default_sts=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_default_date[0]'"));		
		if($staff_default_sts[0] == '1')
		{
		
		$staff_working=1+$staff_working;
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		
		$count_absent++;	
		}
		else
		{
		$staff_working++;
		$default_count++;	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($viewdate_att))
	{
$morng_present=0;
$plc_valid=1;
$fhl_valid=0;
$fhl_time_staff="11:45";	

$leave_staff_diffrence_plc=fetcharray(execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='1'"));
 $leave_staff_diffrence_pqd=fetcharray(execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='2'"));
 $leave_staff_diffrence_fhl=fetcharray(execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='3'"));
 $leave_staff_diffrence_shl=fetcharray(execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='4'"));
 $leave_staff_diffrence_tqd=fetcharray(execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='5'"));
 $leave_staff_diffrence_ee=fetcharray(execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='6'"));


			
//$staff_in_time='';	
if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
				$morng_present=1;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_plc[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_plc[1]))
	{
		$morng_present=0;
		
						$staff_working=1+$staff_working;
						$count_plc++;

	}
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_pqd[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_pqd[1]))
	{
		$morng_present=0;
		
						$staff_working=$staff_working-0.25;
						$count_pqd++;

		
	}
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_fhl[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_fhl[1]))
	{
		$morng_present=0;
		
						$staff_working=$staff_working-0.5;
						$count_fhl++;

	}
	$ee_valid=1;
	//staff_out_time
	$eve_present=0;
	$shl_valid=0;
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		$eve_present=1;
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1]))
	{
		$eve_present=0;
		
		$staff_working=$staff_working-0.25;
		$count_pqd++;
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_ee[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_ee[1]))
	{
		$ee_valid=2;
		$eve_present=0;
		
						$staff_working=$staff_working-0.5;
						$count_pee++;
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_shl[0])  && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_shl[1]))
	{
		$shl_valid=2;
		$eve_present=0;
		
						$staff_working=$staff_working-0.5;
						$count_shl++;

	}
	elseif(strtotime($staff_time_attt_out[0]) < strtotime($leave_staff_diffrence_shl[0]))
	{
		$shl_valid=2;
		$eve_present=0;
		
						$staff_working=$staff_working-0.5;
						$count_shl++;

	}
		if($eve_present=='1' && $morng_present=='1')
		{
			
				$staff_working=1+$staff_working;
		}
		
	}
}
}
?>
<!--</td>
--><?php
}
$staff_working_tot=$tot_paid_holiday+$staff_working+$count_presnt;
$final_working=$tot_day1-$totday_sun_holiday;
$final_staff_working=$staff_working_tot+$totday_sun_holiday;
$final_working_all=$final_working+$totday_sun_holiday+$count_holdyas;
if($dft_leave==12)
{
$hai= $default_count;
}
if($p_leave==1)
{
 $hai1= $staff_working;
}
if($a_leave==2)
{
$hai2= $count_absent;
}
if($wo_leave==3)
{
$hai3= $count_wo;
}
if($h_leave==4)
{
$hai4= $totday_sun_holiday;
}
if($l_leave==5)
{
$hai5=  $tot_paid_holiday;
}
if($fhl_leave==6)
{
$hai6=  $count_fhl;
}
if($shl_leave==7)
{
$hai7=  $count_shl;
}
if($lwp_leave==8)
{
$lwp_tot=$lwp_count+$count_lwp;
$hai8=  $lwp_tot;
}
if($pee_leave==9)
{
$hai9=  $count_pee;
}
if($plc_leave==10)
{
$hai10=  $count_plc;
}
if($pqd_leave==11)
{
$hai11=  $count_pqd;
}
if($pod_leave==13)
{
$hai13=  $count_pod;
}
if($hai>=$leav_cunt || $hai1>=$leav_cunt || $hai2>=$leav_cunt  || $hai3>=$leav_cunt || $hai4>=$leav_cunt || $hai5>=$leav_cunt || $hai6>=$leav_cunt || $hai7>=$leav_cunt || $hai8>=$leav_cunt || $hai9>=$leav_cunt || $hai10>=$leav_cunt || $hai11>=$leav_cunt || $hai13>=$leav_cunt)
{
	
?>
<td align="center" nowrap><?=$s?></td>
<td nowrap>&nbsp;<?=$staffnameview[0]?> <?=$staffnameview[1]?></td>
<td align="center" nowrap><?=$staffnameview[2]?></td>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($final_working>0)
{
echo $final_working;
}
?>
</b>
</td>
<?php
 if($dft_leave==12)
	{
    ?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($default_count)
{
echo $default_count;
}
?>
</b>
</td>
<?php
	}
	 if($p_leave==1)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($staff_working>=0)
{
echo $staff_working;
}
?>
</b>
</td>
<?php
	}
	 if($a_leave==2)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($count_absent>=0)
{
echo $count_absent;
}
?>
</b>
</td>
<?php
	}
	 if($wo_leave==3)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($count_wo>0)
{
echo $count_wo;
}
?>
</b>
</td>
<?php
	}
	 if($h_leave==4)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($totday_sun_holiday>0)
{
echo $totday_sun_holiday;
}
?>
</b>
</td>
<?php
	}
	 if($l_leave==5)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($tot_paid_holiday>=0)
{
echo $tot_paid_holiday;
}
?>
</b>
</td>
<?php
	}
	 if($fhl_leave==6)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($count_fhl>0)
{
echo $count_fhl;
}
?>
</b>
</td>
<?php
	}
	 if($shl_leave==7)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($count_shl>0)
{
echo $count_shl;
}
?>
</b>
</td>
<?php
	}
	 if($lwp_leave==8)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
$lwp_tot=$lwp_count+$count_lwp;
if($lwp_tot>0)
{
echo $lwp_tot;
}
?>
</b>
</td>
<?php
	}
	 if($pee_leave==9)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($count_pee>0)
{
echo $count_pee;
}
?>
</b>
</td>
<?php
	}
	 if($plc_leave==10)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($count_plc>0)
{
echo $count_plc;
}
?>
</b>
</td>
<?php
	}
 if($pqd_leave==11)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($count_pqd>0)
{
echo $count_pqd;
}
?>
</b>
</td>
<?php
	}
 if($pod_leave==13)
	{
?>
<td align="center"  nowrap="nowrap">
<b>
<?php
if($count_pod>0)
{
echo $count_pod;
}
?>
</b>
</td>
<?php
	}
?>
</tr>
<?php
$lwp_tot='';
$lwp_count='';
$final_working='';
$staff_working='';
$final_working_all='';
$final_staff_working='';
$staff_working_tot='';
$point_five='';
$totday_sun_holiday='';
$tot_paid_holiday='';
$default_count='';
$count_presnt='';
$count_absent='';
$count_wo='';
$count_holdyas='';
$count_l='';
$count_fhl='';
$count_shl='';
$count_lwp='';
$count_pee='';
$count_plc='';
$count_pqd='';
$count_pod='';
++$s;
}
}
?>
<!--<tr>
 <td class="row3"  colspan="<?=$tot_day+10?>">
<?php
 $tempsql=$staff_name_display;
 $tempsql1=explode("SELECT *", $tempsql);
 $tempsql2=explode(" LIMIT ", $tempsql1[1]);
 $tempsql1 = $tempsql2[0];
 $sql ="SELECT COUNT(id) ".$tempsql1;
 $rs_result = execute($sql);
 $row = fetchrow($rs_result);
 $total_records = $row[0];
 $total_pages = ceil($total_records / 10);
  
 echo "<p align='center'>";
 if($page==1)
  echo "First&nbsp;";
 else
  echo "<a href='staffdetvew_rprts_tst.php?page=1&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."&p_leave=".$p_leave."&a_leave=".$a_leave."&wo_leave=".$wo_leave."&h_leave=".$h_leave."&l_leave=".$l_leave."&fhl_leave=".$fhl_leave."&lwp_leave=".$lwp_leave."&pee_leave=".$pee_leave."&plc_leave=".$plc_leave."&pqd_leave=".$pqd_leave."&dft_leave=".$dft_leave."&leave_point=".$leave_point."' title='Click to go to First page..'  > First </a> &nbsp;";
 $prv=$page-1;
 if($prv>0)
  echo "<a href='staffdetvew_rprts_tst.php?page=".$prv."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."&p_leave=".$p_leave."&a_leave=".$a_leave."&wo_leave=".$wo_leave."&h_leave=".$h_leave."&l_leave=".$l_leave."&fhl_leave=".$fhl_leave."&lwp_leave=".$lwp_leave."&pee_leave=".$pee_leave."&plc_leave=".$plc_leave."&pqd_leave=".$pqd_leave."&dft_leave=".$dft_leave."&leave_point=".$leave_point."' title='Click to go to Previous page..'  > Previous </a> &nbsp;";
 else
  echo "&#9668;";
 echo "&nbsp;(Page $page of $total_pages)&nbsp;";
 $nxt=($page+1); 
 if($nxt<=$total_pages)
  echo "<a href='staffdetvew_rprts_tst.php?page=".$nxt."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."&p_leave=".$p_leave."&a_leave=".$a_leave."&wo_leave=".$wo_leave."&h_leave=".$h_leave."&l_leave=".$l_leave."&fhl_leave=".$fhl_leave."&lwp_leave=".$lwp_leave."&pee_leave=".$pee_leave."&plc_leave=".$plc_leave."&pqd_leave=".$pqd_leave."&dft_leave=".$dft_leave."&leave_point=".$leave_point."' title='Click to go to Next page..'  > Next </a> &nbsp;"; 
 else
  echo "&#9658;";
 if($page==$total_pages)
  echo "&nbsp;Last&nbsp;";
 else
  echo "<a href='staffdetvew_rprts_tst.php?page=".$total_pages."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."&p_leave=".$p_leave."&a_leave=".$a_leave."&wo_leave=".$wo_leave."&h_leave=".$h_leave."&l_leave=".$l_leave."&fhl_leave=".$fhl_leave."&lwp_leave=".$lwp_leave."&pee_leave=".$pee_leave."&plc_leave=".$plc_leave."&pqd_leave=".$pqd_leave."&dft_leave=".$dft_leave."&leave_point=".$leave_point."' title='Click to go to Last page..' >Last</a> &nbsp;";
  echo "<br>Total $total_records Staff(s)</p>";
?>
 </td>
 </tr>-->
</table>
<br />
<br />
<div align='center'>
	<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="EXCEL EXPORT" OnClick="gen_excel()">&nbsp;&nbsp;
      <INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="Print" OnClick="gen_excel_test()">
</div>
<?php
	}
	else
	{
?>
<br />
<table cellspacing="0" cellpadding="0" border="1" align="center" width="100%">
<tr>
    <td align="center" colspan="<?=$tot_day+12?>" class="head" nowrap="nowrap">Staff Attendance Report <?=$adate?> - <?=$bdate?></td>
    </tr>
  <tr>
    <td align="center" class="row3" nowrap="nowrap">Sl</td>
    <td align="center" class="row3" nowrap="nowrap">
    <?php
    $staff_right_vw=execute("select * from staff_leave_manger where manger_id='$staffrigtss[1]' and status=1 and acc_year='$acc_year'");
if(rowcount($staff_right_vw)>0)
{
	$manger_rights=1;
}
if($user=='pujas')
{
	$manger_rights='';
}
if(!$manger_rights)
{
	?>
  <a href="<?php echo "staffdetvew_rprts_tst.php?sort_by=f_name&sort_type=ASC&adate=".$adate."&bdate=".$bdate."&staff_group_id=".$staff_group_id."";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font>
</a>Name<a href="<?php echo "staffdetvew_rprts_tst.php?sort_by=f_name&sort_type=DESC&adate=".$adate."&bdate=".$bdate."&staff_group_id=".$staff_group_id."";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font></a>
<?php
}
else
{
?>
Name
<?php
}
?>
</td>
    <td align="center" class="row3" nowrap="nowrap">
     <?php
    $staff_right_vw=execute("select * from staff_leave_manger where manger_id='$staffrigtss[1]' and status=1 and acc_year='$acc_year'");
if(rowcount($staff_right_vw)>0)
{
	$manger_rights=1;
}
if($user=='pujas')
{
	$manger_rights='';
}
if(!$manger_rights)
{
	?>
    <a href="<?php echo "staffdetvew_rprts_tst.php?sort_by=EmployeeCode&sort_type=ASC&adate=".$adate."&bdate=".$bdate."&staff_group_id=".$staff_group_id."";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font></a>Staff ID<a href="<?php echo "staffdetvew_rprts_tst.php?sort_by=EmployeeCode&sort_type=DESC&adate=".$adate."&bdate=".$bdate."&staff_group_id=".$staff_group_id."";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font></a>
    <?php
}
else
{
	?>
    Staff ID
    <?php
}
	?>
    </td>
    <td align="center" class="row3" nowrap="nowrap">Group</td>
<?php
 for($c=0;$c<$tot_day;$c++)
{

$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
$viewdate_att=date("d M", $attview);
?>
 <td align="center" class="row3" nowrap="nowrap"><?=$viewdate_att?></td>
<?php
}
?>
 <td align="center" class="row3" nowrap="nowrap">Working Days</td>
 <td align="center" class="row3" nowrap="nowrap">Default</td>
  <td align="center" class="row3" nowrap="nowrap">Present Days</td>
   <td align="center" class="row3" nowrap="nowrap">Privilege Leaves</td>
    <td align="center" class="row3" nowrap="nowrap">LWP</td>
    <td align="center" class="row3" nowrap="nowrap">School Holidays</td>
    <td align="center" class="row3" nowrap="nowrap">Maternity Leave</td>    
    <td align="center" class="row3" nowrap="nowrap">Total Paid Days</td>
<?php	
$tot_work_holiday='0';
$tot_work_sunday='0';
$manger_rights='';
$staff_right_vw=execute("select * from staff_leave_manger where manger_id='$staffrigtss[1]' and status=1 and acc_year='$acc_year'");
if(rowcount($staff_right_vw)>0)
{
	$manger_rights=1;
}
if($user=='pujas')
{
	$manger_rights='';
}
if($manger_rights)
{
$staff_name_display="select a.f_name,a.s_name,a.EmployeeCode,a.group_id,a.id,a.category from staff_det a,users b,staff_hr_grup c where c.status=1 and b.username='$user' and b.srid=c.mng_id and a.id=c.staff_id and a.active='YES' and a.id!='$staffrigtss[1]'  and (a.recruitment_procedure='User' or a.recruitment_procedure='')";
	if($staff_group_id!='')
	{
	
	$staff_name_display.=" and a.category='$staff_group_id'";
	
	}
	if($studfname!='')
	{
	
	$staff_name_display.=" and a.f_name like '$studfname%' or a.s_name like '$studfname%'";
	
	}
	if($saffid!='')
	{
	
	$staff_name_display.=" and a.EmployeeCode like '$saffid%'";
	
	}
	$staff_name_display.=" group by c.staff_id order by a.f_name";
}
else
{
$staff_name_display="SELECT * from staff_det where  active='YES'  and (recruitment_procedure='User' or recruitment_procedure='') and id!='$staffrigtss[1]'";
	if($staff_group_id!='')
	{
	
	$staff_name_display.=" and category='$staff_group_id'";
	
	}
	if($studfname!='')
	{
	
	$staff_name_display.=" and f_name like '$studfname%' or s_name like '$studfname%'";
	
	}
	if($saffid!='')
	{
	
	$staff_name_display.=" and EmployeeCode like '$saffid%'";
	
	}
     $staff_name_display.=" ORDER BY f_name,category";
	// $staff_name_display.=" ORDER BY $sort_by $sort_type LIMIT $start_from, 10";
}
$staffname=execute($staff_name_display);
$s=1;
while($staffnameview=fetcharray($staffname))
{
$staffnameview[0]=$staffnameview['f_name'];
$staffnameview[1]=$staffnameview['s_name'];
$staffnameview[2]=$staffnameview['EmployeeCode'];
$staffnameview[3]=$staffnameview['group_id'];
$staffnameview[4]=$staffnameview['id'];
$viewss1['0']=$staffnameview['f_name'];
$viewss1['1']=$staffnameview['s_name'];
$viewss1['2']=$staffnameview['EmployeeCode'];
$viewss1['3']=$staffnameview['group_id'];
$viewss1['4']=$staffnameview['id'];

$rfid_nt_issed='';
$staff_group_nm='';

if($staffnameview['category']==1)
{
  $staff_group_nm='Teaching';
}

if($staffnameview['category']==2)
{
  $staff_group_nm='Non Teaching';
}

?>
<tr>
<td align="center" nowrap><?=$s?></td>
<td nowrap>&nbsp;<?=$staffnameview[0]?> <?=$staffnameview[1]?></td>
<td align="center" nowrap><?=$staffnameview[2]?></td>
<td align="center" nowrap><?=$staff_group_nm?></td>
<?php 
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$staffnameview[4]'"));
$staffif=trim($staffrfid[0]);
if(!$staffif)
{
//echo "<br>".$staffnameview[0]."  ".$staffnameview[1].$staffif;
}
$na_staff_det='';
 for($c=0;$c<$tot_day;$c++)
{
$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
$viewdate_att=date("Y-m-d", $attview);
$viewdate_sunday=date("D", $attview);
	
	$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type='2' and leave_det=1 and staff_date='$viewdate_att'"));
$in_timeview='';	
$out_timeview='';
$special_date=0;
	if($staff_time_check_date[4])
	{
		$special_date=1;
		if($staff_time_check_date[1])
		{
			$in_timeview=$staff_time_check_date[1];
		}
		else
		{
			$in_timeview=$staff_time_check_date[0];		
		}
		if($staff_time_check_date[3])
		{
			$out_timeview=$staff_time_check_date[3];
		}
		else
		{
			$out_timeview=$staff_time_check_date[2];		
		}	
	}
	else
	{
		$special_date=0;
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[1])
		{
			$in_timeview=$staff_time_check[1];
		}
		else
		{
			$in_timeview=$staff_time_check[0];		
		}
		if($staff_time_check[3])
		{
			$out_timeview=$staff_time_check[3];
		}
		else
		{
			$out_timeview=$staff_time_check[2];		
		}
		
	}
	$specl_con_out='1';
	$specl_test='';
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$viewdate_att' between special_nonteac_fdate and special_nonteac_tdate)");
		if(rowcount($staff_time_check_special_out)>0)
		{
			$specl_test='Special';
			$special_date=1;
			$in_timeview="09:00";
			$out_timeview="17:00";
			$specl_con_out='';
		}
/*$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' order by att_time asc ");*/
$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc limit 1"));
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time desc limit 1"));
$count=0;
/*$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$viewdate_att' and staff_typ='$staffnameview[3]'"));*/
?>
<td align="center" nowrap>
<?php
echo "<br>".$specl_test;
echo "<br>".$staff_time_attt_in[0];
echo "<br>".$staff_time_attt_out[0];

$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' order by att_time asc ");
$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$viewdate_att' and staff_typ='$staffnameview[3]'"));
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$viewdate_att' between f_date and t_date) and status=1  and status_approve!=2 order by id desc"));
$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$viewdate_att' and status=1 and status_approve!=2 order by id desc"));
$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$viewdate_att'"));
			
$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));


$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2' && $leave_test[2]!='7')
	
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{	
		if($updated_att_staff[0]==1 && $updated_att_staff[1]!='0' && $leave_test[1]!=1 && $leave_od_ee[1]!=1)
		{
		$first_half='';
			if(strtotime($leave_test[7])==strtotime($leave_test[8]))
			{
				$from_half_day=explode('_',$leave_test[5]);
				if($from_half_day[1]=='ain')
				{
					$staff_working=$staff_working+0.5;
				$first_half='FHL';
				}
				if($from_half_day[1]=='pin')
				{
					$staff_working=$staff_working+0.5;
				$first_half='SHL';
				}
			}
			elseif(strtotime($leave_test[7])==strtotime($viewdate_att))
			{
				$from_half_day=explode('_',$leave_test[5]);
				if($from_half_day[1]=='ain')
				{
					$staff_working=$staff_working+0.5;
				$first_half='FHL';
				}
				if($from_half_day[1]=='pin')
				{
					$staff_working=$staff_working+0.5;
				$first_half='SHL';
				}
				
			}
			elseif(strtotime($leave_test[8])==strtotime($viewdate_att))
			{
				$from_half_day=explode('_',$leave_test[6]);
				if($from_half_day[1]=='aout')
				{
					$staff_working=$staff_working+0.5;
				$first_half='FHL';
				}
				if($from_half_day[1]=='pout')
				{
					$staff_working=$staff_working+0.5;
				$first_half='SHL';
				}
			}
			else
			{
				$first_half='';
				
			}
			if(strtotime($staff_calender[0])==strtotime($viewdate_att))
			{
				$view_holidays='';
				if($viewdate_sunday=='Sat' || $viewdate_sunday=='Sun')
				{
					$view_holidays='WO';
				}
				else
				{
					$view_holidays='H';
				}
				if($leave_test[2]==3)
				{
					$view_holidays='Maternity Leave';
				
				}
				
				echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
				$status_find=0;
				$totday_sun_holiday=$totday_sun_holiday+1;
			}
			elseif($viewdate_sunday=='Sun')
			{
				if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
			}
				$status_find=0;
				$totday_sun_holiday=$totday_sun_holiday+1;
			}
			else
			{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>Leave";
			if($first_half)
				{
				echo "($first_half)";
				}
			}
		echo "</b></div>";	
		}
		elseif($updated_att_staff[0]!=1 && $updated_att_staff[1]!='0' && $leave_test[1]!=1 && $leave_od_ee[1]!=1)
		{
			$first_half='';
			if(strtotime($leave_test[7])==strtotime($leave_test[8]))
			{
				$from_half_day=explode('_',$leave_test[5]);
				if($from_half_day[1]=='ain')
				{

				$first_half='FHL';
				$staff_working=$staff_working+0.5;
				//$lwp_count=$lwp_count+0.5;
				}
				if($from_half_day[1]=='pin')
				{
				$first_half='SHL';
				$staff_working=$staff_working+0.5;
				//$lwp_count=$lwp_count+0.5;
				}
			}

			elseif(strtotime($leave_test[7])==strtotime($viewdate_att))
			{
				$from_half_day=explode('_',$leave_test[5]);
				if($from_half_day[1]=='ain')
				{
				$first_half='FHL';
				$staff_working=$staff_working+0.5;
				//$lwp_count=$lwp_count+0.5;
				}
				if($from_half_day[1]=='pin')
				{
				$first_half='SHL';
				$staff_working=$staff_working+0.5;
				//$lwp_count=$lwp_count+0.5;
				}
				
			}
			elseif(strtotime($leave_test[8])==strtotime($viewdate_att))
			{
				$from_half_day=explode('_',$leave_test[6]);
				if($from_half_day[1]=='aout')
				{
				$first_half='FHL';
				$staff_working=$staff_working+0.5;
				//$lwp_count=$lwp_count+0.5;
				}
				if($from_half_day[1]=='pout')
				{
				$first_half='SHL';
				$staff_working=$staff_working+0.5;
				//$lwp_count=$lwp_count+0.5;
				}
			}
			else
			{
				$first_half='';
				//$lwp_count++;
				
			}
			if(strtotime($staff_calender[0])==strtotime($viewdate_att))
			{
				$view_holidays='';
				if($viewdate_sunday=='Sat' || $viewdate_sunday=='Sun')
				{
					$view_holidays='WO';
				}
				else
				{
					$view_holidays='H';
				}
			
				if($leave_test[2]==3)
				{
					$view_holidays='Maternity Leave';
				}	
				echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
				$totday_sun_holiday=$totday_sun_holiday+1;
				$status_find=0;
			}
			elseif($viewdate_sunday=='Sun')
			{
				if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
			}
			$totday_sun_holiday=$totday_sun_holiday+1;
			$status_find=0;
			}
			else
			{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]"; 
				if($first_half)
				{
				echo "($first_half)";
				}
			}
		echo "</b></div>";	
		}
		else
		{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] </b></div>";	
			if($updated_att_staff[0]==8)
			{
				$lwp_count=$lwp_count+1;
			}
			elseif($updated_att_staff[0]==4 || $updated_att_staff[0]==3)
			{
			$staff_working=$staff_working+$view_att_staff[2];
			$totday_sun_holiday=$totday_sun_holiday+1;
			}
			else
			{
			$staff_working=$staff_working+$view_att_staff[2];
			}
				
		}
		
		
		$status_find=0;
		}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($viewdate_att) && $leave_test[2]!='7')
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
		
			$view_holidays='';
		if($viewdate_sunday=='Sun' || $viewdate_sunday=='Sat')
		{
			$view_holidays='WO';
		}
		else
		{
			$view_holidays='H';
		}
		if($leave_test[2]==3)
			{
				$view_holidays='Maternity Leave';
			}
			if(strtotime($staffnameview[j_date])>strtotime($viewdate_att))
			{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$staff_working=1+$staff_working;
				$na_staff_det=1+$na_staff_det;
				$status_find=0;
			}
			else
			{
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
			$totday_sun_holiday=$totday_sun_holiday+1;
			}
		
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun' && $leave_test[2]!='7')
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
			if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			$status_find=0;
			$totday_sun_holiday=$totday_sun_holiday+1;
			}
			else
			{
				if(strtotime($staffnameview[j_date])>strtotime($viewdate_att))
				{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$staff_working=1+$staff_working;
				$na_staff_det=1+$na_staff_det;
				$status_find=0;
				}
				else
				{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				$status_find=0;
			$totday_sun_holiday=$totday_sun_holiday+1;
				}
			}
			
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($viewdate_att))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='7' && $leave_od_ee[2]!='6' && $leave_od_ee[2]!='EE' && $leave_test[4]!='2')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if(strtotime($leave_test[7])==strtotime($viewdate_att))
		{
			$date_corrects=0;
			if($leave_test[5])
			{
				$from_half_day=explode('_',$leave_test[5]);
				if($from_half_day[1]=='ain')
				{
				$first_half='FHL';
				}
				if($from_half_day[1]=='pin')
				{
				$first_half='SHL';
				}
			}
			else
			{
				$first_half=1;
			}
			if($first_half!=1)
			{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave ($first_half)</b></div>";
		$maternity=$maternity+0.5;
				}
				else
				{
		echo "<div align='center' style='color:#060'><b>Leave ($first_half)</b></div>";
				}
		$staff_working=$staff_working+0.5;
			}
			else
			{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave</b></div>";
		$maternity=$maternity+1;
				}
				else
				{
		echo "<div align='center' style='color:#060'><b>Leave</b></div>";
				}
				
			}
		}
		
		//to date in FHL or SHL
		if(strtotime($leave_test[8]==$viewdate_att) && strtotime($leave_test[7])!=strtotime($leave_test[8]))
		{
			$date_corrects=0;
			if($leave_test[6])
			{
				$secnd_half_day=explode('_',$leave_test[6]);
				if($secnd_half_day[1]=='aout')
				{
					$secnd_half='FHL';
				}
				if($secnd_half_day[1]=='pout')
				{
					$secnd_half='SHL';
				}
			}
			else
			{
				$secnd_half=1;
			}
			if($secnd_half!=1)
			{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave ($secnd_half)</b></div>";
		$maternity=$maternity+0.5;
				}
				else
				{
			echo "<div align='center' style='color:#060'><b>Leave ($secnd_half)</b></div>";
				}
			$staff_working=$staff_working+0.5;
			}
			else
			{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave</b></div>";
		$maternity=$maternity+1;
				}
				else
				{
		echo "<div align='center' style='color:#060'><b>Leave</b></div>";
				}
				
			}
		}
		
		//nt fromdate nt to date
		/*if($first_half==1 && $secnd_half==1)
		{
			if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave</b></div>";
				}
				else
				{
		echo "<div align='center' style='color:#060'><b>Leave</b></div>";
				}
		$tot_paid_holiday++;
		}*/
		if($date_corrects)
		{
			if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave</b></div>";
		$maternity=$maternity+1;
				}
				else
				{
		echo "<div align='center' style='color:#060'><b>Leave</b></div>";
				}
		
		}
					
			$status_find=0;
		//end///////////
		}
		//od
		if($leave_od_ee[2]=='6' && $leave_od_ee[0]=='1' && $leave_od_ee[4]!='2'  && $leave_od_ee[2]!='7')
		{
			if($view_att_staff[1])
			{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";
			$staff_working=$staff_working+$view_att_staff[2];
			}
			else
			{
				echo "<div align='center' style='color:#060'><b>P(OD)</b></div>";
				$staff_working=$staff_working+1;
			}
			$status_find=0;
			
		}
		//EE
		if($leave_od_ee[2]=='EE'  && $leave_od_ee[0]=='1' && $leave_od_ee[4]!='2'  && $leave_od_ee[2]!='7')
		{
			if($view_att_staff[1])
			{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";
			$staff_working=$staff_working+$view_att_staff[2];
			}
			else
			{
			echo "<div align='center' style='color:#060'><b>P(EE)</b></div>";
			$staff_working=$staff_working+1;
			}
			$status_find=0;			
		}
		if($leave_test[2]=='7'  && $leave_test[0]=='1' && $leave_test[4]!='2')
		{
			if($view_att_staff[1])
			{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";
			$staff_working=$staff_working+$view_att_staff[2];
			}
			else
			{
			echo "<div align='center' style='color:#060'><b>Leave(Vac)</b></div>";
			$staff_working=$staff_working+1;
			}
			$status_find=0;
		}
	}
if($status_find)
{
	$morng_present=0;
$plc_valid=1;
$fhl_valid=0;
$fhl_time_staff="11:45";			
//$staff_in_time='';


$leave_plc="";
$leave_pqd="";
$leave_fhl="";
$leave_shl="";
$leave_tqd="";
$leave_ee="";

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(rowcount($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(rowcount($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(rowcount($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(rowcount($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(rowcount($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(rowcount($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}

//special day
if($special_date)
{
	$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$staffnameview[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(rowcount($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$staffnameview[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(rowcount($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$staffnameview[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(rowcount($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$staffnameview[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(rowcount($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$staffnameview[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(rowcount($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$staffnameview[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(rowcount($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
}
//end
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$staffnameview[3];


$intime_staff='';
$outtime_staff='';
$totaltime='';
//echo $staff_time_attt_in[0];
//echo $staff_time_attt_out[0];
$intime_staff = strtotime($staff_time_attt_in[0]);
$outtime_staff = strtotime($staff_time_attt_out[0]);

$totaltime=$outtime_staff-$intime_staff;
$hoursdiff4=strtotime('04:00');
$hoursdiff2=strtotime('02:00');
$totspent = gmdate ( 'H:i:s' , $totaltime);

if($count=='0')
{
	if(strtotime($today_date)>strtotime($viewdate_att))
	{
		//Absent approval stage(its in same in default stage)
		$satff_absent_date=fetcharray(execute("select id from staff_default where staff_id='$staffnameview[4]' and status=1 and d_date='$viewdate_att'"));
		
		$staff_absent_sts=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_absent_date[0]'"));		
		if($staff_absent_sts[0] == '1')
		{
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		$staff_working=1+$staff_working;	
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{
			
			if(strtotime($staffnameview[j_date])>strtotime($viewdate_att))
			{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$staff_working=1+$staff_working;
				$na_staff_det=1+$na_staff_det;
			}
			elseif(!$staffif)
			{
				echo "<div align='center' style='color:#F00'><b>RFID Not<br>Issued</b></div>";
				$rfid_nt_issed=1+$rfid_nt_issed;
				$staff_working=1+$staff_working;
			}
			else
			{
				echo "<div align='center' style='color:#F00'><b>A</b></div>";
			}
		}
	}
}
elseif($count=='1')
{
	//"Default";
	if(strtotime($today_date)>strtotime($viewdate_att))
	{
		//default approval stage
		$satff_default_date=fetcharray(execute("select id,time_in,time_out from staff_default where staff_id='$staffnameview[4]' and status=1 and d_date='$viewdate_att'"));
		echo "<br>Default ".$satff_default_date[1];
		echo "<br>Default ".$satff_default_date[2];
		
		$staff_default_sts=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_default_date[0]'"));		
		if($staff_default_sts[0] == '1')
		{
		echo "<div align='center' style='color:#060'><b>P(D)</b></div>";
		$staff_working=1+$staff_working;
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>A(D)</b></div>";	
		}
		else

		{
		echo "<div align='center' style='color:#C2780A'><b>Default</b></div>";
		$staff_working=$staff_working+1;
		$default_count=$default_count+1;
	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($viewdate_att))
	{

if(strtotime($totspent)<=$hoursdiff4 && strtotime($totspent)>=$hoursdiff2)
{
	$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$staffnameview[4]' and status=1 and d_date='$viewdate_att'"));
		
		$staff_default_sts=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_default_date[0]'"));		
		if($staff_default_sts[0] == '1')
		{
		echo "<div align='center' style='color:#060'><b>P(D)</b></div>";
		$staff_working=1+$staff_working;
		}
		else
		{
	echo "<div align='center' style='color:#F00'><b>Default<br>($totspent)</b></div>";
		$staff_working=$staff_working+1;
		$default_count=$default_count+1;
		}
}
elseif(strtotime($totspent)<=$hoursdiff2)
{
	$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$staffnameview[4]' and status=1 and d_date='$viewdate_att'"));
		
		$staff_default_sts=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_default_date[0]'"));		
		if($staff_default_sts[0] == '1')
		{
		echo "<div align='center' style='color:#060'><b>P(D)</b></div>";
		$staff_working=1+$staff_working;
		}
		else
		{
	echo "<div align='center' style='color:#F00'><b>A<br>($totspent)</b></div>";
		}
}
/*elseif($special_date)
{
	echo "<div align='center' style='color:#CC6600' title='Special day'><b>P </b></div>";
	$staff_working=$staff_working+1;	
}
*/
else
{
	$morng_present=1;
	$cal_rfid=0;
if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
				$morng_present=1;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_plc[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_plc[1]) && $leave_plc!=1)
	{
		$morng_present=0;
		echo "<div align='center' style='color:#F60'><b>P(LC)</b></div>";
						$staff_working=1+$staff_working;
						$cal_rfid=1;

	}
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_pqd[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_pqd[1]) && $leave_pqd!=1)
	{
		$morng_present=0;
		echo "<div align='center' style='color:#F60'><b>P(QD)</b></div>";
						$staff_working=$staff_working+0.75;
						$cal_rfid=0.75;

		
	}
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_fhl[0])  && $leave_fhl!=1)
	{
		$morng_present=0;
		echo "<div align='center' style='color:#00F'><b>FHL</b></div>";
						$staff_working=$staff_working+0.5;
						$cal_rfid=0.5;

	}
	$ee_valid=1;
	//staff_out_time
	$eve_present=1;
	$shl_valid=0;
	$all_cal_rfid=0;
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		$eve_present=1;
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1])  && $leave_tqd!=1)
	{
		$eve_present=0;
		echo "<div align='center' style='color:#93C'><b>&#9733; P(QD)</b></div>";
		if($cal_rfid==1)
		{
		$staff_working=$staff_working-0.25;
		}
		elseif($cal_rfid==0.75)
		{
			$staff_working=$staff_working-0.25;
		}
		elseif($cal_rfid==0.5)
		{
			$staff_working=$staff_working-0.25;
		}
		else
		{
			$staff_working=$staff_working+0.75;
		}
		
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_ee[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_ee[1]) && $leave_ee!=1)
	{
		$ee_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#93C'><b>EE</b></div>";
		if($cal_rfid==1)
		{
		$staff_working=$staff_working;
		}
		elseif($cal_rfid==0.75)
		{
			$staff_working=$staff_working;
		}
		elseif($cal_rfid==0.5)
		{
			$staff_working=$staff_working;
		}
		else
		{
			$staff_working=$staff_working+1;
		}
		
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_shl[0])  && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_shl[1]) && $leave_shl!=1)
	{
		$shl_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#00F'><b>SHL</b></div>";
		if($cal_rfid==1)
		{
		$staff_working=$staff_working-0.5;
		}
		elseif($cal_rfid==0.75)
		{
			$staff_working=$staff_working-0.5;
		}
		elseif($cal_rfid==0.5)
		{
			$staff_working=$staff_working-0.5;
		}
		else
		{
			$staff_working=$staff_working+0.5;
		}
 	}
	elseif(strtotime($staff_time_attt_out[0]) < strtotime($leave_staff_diffrence_shl[0]) && $leave_shl!=1)
	{
		$shl_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#00F'><b>SHL</b></div>";
		if($cal_rfid==1)
		{
		$staff_working=$staff_working-0.5;
		}
		elseif($cal_rfid==0.75)
		{
			$staff_working=$staff_working-0.5;
		}
		elseif($cal_rfid==0.5)
		{
			$staff_working=$staff_working-0.5;
		}
		else
		{
			$staff_working=$staff_working+0.5;
		}
	}
		if($eve_present=='1' && $morng_present=='1')
		{
			echo "<div align='center' style='color:#060'><b>P</b></div>";	
				$staff_working=1+$staff_working;
				
		}
}
		$ee_valid='';
		$plc_valid='';
	}
}
}
?>
</td>
<?php
}

$staff_working=$maternity+$staff_working;
$final_working=$tot_day1-$totday_sun_holiday;
$final_staff_working=$staff_working_tot+$totday_sun_holiday;
$final_working_all=$final_working+$totday_sun_holiday;
$privilage_leave_last=$final_working-$staff_working;
$privilage_leave_last1=$final_working-$staff_working;
?>
 <td align="center"  nowrap="nowrap">
 <b>
 <?php
 $paid_all_staff='';
$finaltotleave='';
$staff_paid_test='';
$privilage_leave_final='';
$finaltotleave='';
$satff_acc_year=fetcharray(execute("select id from leave_acc_year where acc_name='$academic_year'"));
$viewadate_att=date("m", strtotime($pfdate));
$viewbdate_att=date("m", strtotime($ptdate));
$final_date_vw=$viewadate_att."-".$viewbdate_att;

if($staffnameview[category]==1)
{
$staff_Eligible=fetcharray(execute("select tot_paid,cur_balance,paid_vat from  leave_staff_paid_tot_acc_month where status=1 and staff_id='$staffnameview[4]' and acc_id='$satff_acc_year[0]' and pay_month='$final_date_vw' and pay_acc='$academic_year'"));
if($staff_Eligible[0]<=$staff_Eligible[2])
{	
	$lwp_count=$privilage_leave_last+$lwp_count;
	$privilage_leave_last=0;
	$finaltotleave=$staff_working+$totday_sun_holiday;
	
}
else
{
	$paid_all_staff=$privilage_leave_last+$staff_Eligible[2];
	if($staff_Eligible[0]==$paid_all_staff)
	{
		
		$privilage_leave_last=$privilage_leave_last;
		$finaltotleave=$staff_working+$totday_sun_holiday+$privilage_leave_last;
		
	}
	elseif($staff_Eligible[0]<$paid_all_staff)
	{
		
	$staff_paid_test=$staff_Eligible[0]-$staff_Eligible[2];
	$privilage_leave_final=$staff_paid_test;
	$privilage_leave_last=$privilage_leave_final;
	$lwp_count=$privilage_leave_last1-$privilage_leave_final;
	$finaltotleave=$staff_working+$totday_sun_holiday+$privilage_leave_last;	
	}
	else
	{
		
		$privilage_leave_last=$privilage_leave_last;
		$finaltotleave=$staff_working+$totday_sun_holiday+$privilage_leave_last;	
	}
	
}
}
if($staffnameview[category]==2)
{
	 $finaltotleave=$staff_working+$totday_sun_holiday+$privilage_leave_last;
}

 if($final_working>0)
 {
 echo $final_working;
 }
 ?>
 </b>
 </td>
 <td align="center"  nowrap="nowrap">
    <b>
	<?php
	if($default_count)
	{
	echo $default_count;
	}
	?>
    </b>
    </td>
    <td align="center"  nowrap="nowrap">
    <b>
	<?php
	if($staff_working>=0)
	{
		$na_rfid_matrty=$na_staff_det+$rfid_nt_issed+$maternity;
		echo $staff_working-$na_rfid_matrty;
	}
	?>
    </b>
    </td>
    <td align="center"  nowrap="nowrap">
    <b>
	<?php
	if($privilage_leave_last>0)
	{
    echo $privilage_leave_last;
	}
	?>
    </b>
    </td>
    <td align="center"  nowrap="nowrap">
    <b>
	<?php
	if($lwp_count>0)
	{
	echo $lwp_count;
	}
	?>
    </b>
    </td>
    <td align="center"  nowrap="nowrap">
    <b>
	<?php
	if($totday_sun_holiday>0)
	{
    echo $totday_sun_holiday;
	}
	?>
    </b>
    </td>
    <td align="center"  nowrap="nowrap">
    <b>
	<?php
	if($maternity)
	{
    echo $maternity+$totday_sun_holiday;
	}
	?>
    </b>
    </td>
        <td align="center"  nowrap="nowrap">
        <b>
		<?php
		
		$na_rfid=$na_staff_det+$rfid_nt_issed;
		echo $finaltotleave-$na_rfid;

		?>
        /
		<?php
		if($final_working_all>0)
	{
		echo $final_working_all;
	}
	$na_rfid='';
	$na_rfid_matrty='';
		?>
        </b></td>
</tr>
<?php
/*$staff_f_name=$staffnameview[0]." ".$staffnameview[1];
echo "<br>INSERT INTO `leave_payroll_total_temp`(`staff_id`,`Employee_id`,`staff_name`,`lwp`,`paid_vat`,`default`,`status`) VALUES ('$viewss1[4]','$staffnameview[2]','".addslashes($staff_f_name)."','$lwp_count','$privilage_leave_last','$default_count','1')";
execute("INSERT INTO `leave_payroll_total_temp`(`staff_id`,`Employee_id`,`staff_name`,`lwp`,`paid_vat`,`default`,`status`) VALUES ('$viewss1[4]','$staffnameview[2]','".addslashes($staff_f_name)."','$lwp_count','$privilage_leave_last','$default_count','1')");*/

$staff_f_name='';
$maternity='';
$privilage_leave_last='';
$privilage_leave_last1='';
$privilage_leave='';
$lwp_count='';
$final_working='';
$staff_working='';
$final_working_all='';
$final_staff_working='';
$staff_working_tot='';
$point_five='';
$totday_sun_holiday='';
$tot_paid_holiday='';
$default_count='';
++$s;
}
$manger_rights='';
$staff_right_vw=execute("select * from staff_leave_manger where manger_id='$staffrigtss[1]' and status=1 and acc_year='$acc_year'");
if(rowcount($staff_right_vw)>0)
{
	$manger_rights=1;
}
if($user=='pujas')
{
	$manger_rights='';
}
if(!$manger_rights)
{
?>
<tr>
 <td class="row3"  colspan="<?=$tot_day+12?>">
<?php
 $tempsql=$staff_name_display;
 $tempsql1=explode("SELECT *", $tempsql);
 $tempsql2=explode(" LIMIT ", $tempsql1[1]);
 $tempsql1 = $tempsql2[0];
 $sql ="SELECT COUNT(id) ".$tempsql1;
 $rs_result = execute($sql);
 $row = fetchrow($rs_result);
 $total_records = $row[0];
 $total_pages = ceil($total_records / 10);
  
 echo "<p align='center'>";
 if($page==1)
  echo "First&nbsp;";
 else
  echo "<a href='staffdetvew_rprts_tst.php?page=1&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."&staff_group_id=".$staff_group_id."' title='Click to go to First page..'  > First </a> &nbsp;";
 $prv=$page-1;
 if($prv>0)
  echo "<a href='staffdetvew_rprts_tst.php?page=".$prv."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."&staff_group_id=".$staff_group_id."' title='Click to go to Previous page..'  > Previous </a> &nbsp;";
 else
  echo "&#9668;";
 echo "&nbsp;(Page $page of $total_pages)&nbsp;";
 $nxt=($page+1); 
 if($nxt<=$total_pages)
  echo "<a href='staffdetvew_rprts_tst.php?page=".$nxt."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."&staff_group_id=".$staff_group_id."' title='Click to go to Next page..'  > Next </a> &nbsp;"; 
 else
  echo "&#9658;";
 if($page==$total_pages)
  echo "&nbsp;Last&nbsp;";
 else
  echo "<a href='staffdetvew_rprts_tst.php?page=".$total_pages."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."&staff_group_id=".$staff_group_id."' title='Click to go to Last page..' >Last</a> &nbsp;";
  echo "<br>Total $total_records Staff(s)</p>";
?>

 </td>
 </tr>
</table>
<br />
<div align='center'>
	<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="EXCEL EXPORT" OnClick="gen_excel()">
    &nbsp;&nbsp;
      <INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="Print" OnClick="gen_excel_test()">
</div>
</table>

<?php
}
	}
?>
</form>
</BODY>
</HTML>