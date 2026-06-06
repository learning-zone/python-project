<?php

include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$a_year=$_SESSION['AcademicYear'];
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
		document.frm.action="staff_payroll_calculate.php";
		document.frm.submit();
	}
	function gen_excel()
		{
			document.frm.action='staffdetvew_rprts_execl.php';
			document.frm.submit();
		}
	</script>

<form name="frm"  method="post">

<?php
	$from_pay_today=explode('-',$today_date);
	$from_pay_20=$from_pay_today[0]."-".$from_pay_today[1]."-20";
	
	if($today_date > $from_pay_20)
	{
		$topay_validate=date('Y-m-d', strtotime('1 month', strtotime($today_date)));
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
		$topay_validate=date('Y-m-d', strtotime('-1 month', strtotime($today_date)));
		$topay_validate_final=explode('-',$topay_validate);
		$topay_mnth=$topay_validate_final[0]."-".$topay_validate_final[1]."-20";
		
		
		
		$topay_pay_date1=explode('-',$from_pay_20);
			$topay_mnth_pay=$topay_pay_date1[2]."/".$topay_pay_date1[1]."/".$topay_pay_date1[0];
			
			$topay_pay_bdate1=explode('-',$topay_mnth);
			$topay_mnth_bpay=$topay_pay_bdate1[2]."/".$topay_pay_bdate1[1]."/".$topay_pay_bdate1[0];
	
		$adate_pay=$topay_mnth_bpay;
		$bdate_pay=$topay_mnth_pay;
	}
	
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
	    $adate=$adate_pay;
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

?>
<br>
<link rel="stylesheet" type="text/css" href="css/tab.css" />

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<li><a href="leave.php?tab=1" >Leave & Attendance</a></li>
<li><a href="leave.php?tab=2" >Leave Approval</a></li>
<li><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
<li class="currentBtn"><a href="staff_payroll_calculate.php?tab=33" >Staff Attendance Report</a></li>
<li><a href="staff_profile.php?tab=20" >My Time Sheet</a></li>
<li ><a href="leave_count.php?tab=65" >Leave Details</a></li>   
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
</table> 
<br>
<div align='center'>
<INPUT TYPE="button" NAME="go" onclick="RefreshMe(0)" class='bgbutton' VALUE="Search" >
&nbsp;&nbsp;&nbsp;
	<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="EXCEL EXPORT" OnClick="gen_excel()">
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
?>
<br>
<table cellspacing="0" cellpadding="0" border="1" align="center" width="100%">
<tr>
    <td align="center" colspan="<?=$tot_day+10?>" class="head" nowrap="nowrap">Staff Attendance Report <?=$adate?> - <?=$bdate?></td>
    </tr>
  <tr>
    <td align="center" class="row3" nowrap="nowrap">Sl</td>
    <td align="center" class="row3" nowrap="nowrap"><a href="<?php echo "staff_payroll_calculate.php?sort_by=f_name&sort_type=ASC&adate=".$adate."&bdate=".$bdate."";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font>
</a>Name<a href="<?php echo "staff_payroll_calculate.php?sort_by=f_name&sort_type=DESC&adate=".$adate."&bdate=".$bdate."";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font></a></td>
    <td align="center" class="row3" nowrap="nowrap"><a href="<?php echo "staff_payroll_calculate.php?sort_by=slno&sort_type=ASC&adate=".$adate."&bdate=".$bdate."";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font></a>Staff ID<a href="<?php echo "staff_payroll_calculate.php?sort_by=slno&sort_type=DESC&adate=".$adate."&bdate=".$bdate."";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font></a></td>
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
    <td align="center" class="row3" nowrap="nowrap">Total Paid Days</td>
<?php	
$tot_work_holiday='0';
$tot_work_sunday='0';

$staff_name_display="SELECT * from staff_det where  active='YES'  and id='249'  and (recruitment_procedure='User' or recruitment_procedure='') ";
$staff_name_display.=" ORDER BY $sort_by $sort_type LIMIT $start_from, 10";

$staffname=mysql_query($staff_name_display);
$s=1;
while($staffnameview=fetcharray($staffname))
{
$staffnameview[0]=$staffnameview['f_name'];
$staffnameview[1]=$staffnameview['s_name'];
$staffnameview[2]=$staffnameview['slno'];
$staffnameview[3]=$staffnameview['group_id'];
$staffnameview[4]=$staffnameview['id'];

$viewss1['0']=$staffnameview['f_name'];
$viewss1['1']=$staffnameview['s_name'];
$viewss1['2']=$staffnameview['slno'];
$viewss1['3']=$staffnameview['group_id'];
$viewss1['4']=$staffnameview['id'];

?>
<tr>
<td align="center" nowrap><?=$s?></td>
<td nowrap>&nbsp;<?=$staffnameview[0]?> <?=$staffnameview[1]?></td>
<td align="center" nowrap><?=$staffnameview[2]?></td>
<?php 
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
<td align="center" nowrap>
<?php
$point_five='0.5';
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' order by att_time asc ");

$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}

$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$viewdate_att' and staff_typ='$staffnameview[3]'"));

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$viewdate_att' between f_date and t_date) and status=1"));

$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$viewss1[4]' and toddate='$viewdate_att'"));

/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$status_find=1;
//school holiday
	if(strtotime($staff_calender[0])==strtotime($viewdate_att))
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
			echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
			$status_find=0;
			$totday_sun_holiday++;
		}
	}
	//manger updated att
	elseif($updated_att_staff[0])
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] </b></div>";	
		$staff_working=$view_att_staff[2]+$staff_working;
		
		$status_find=0;
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
			echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
			$status_find=0;
			$totday_sun_holiday++;
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($viewdate_att))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]=='1' && $leave_test[4]!='2')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if($leave_test[7]==$viewdate_att)
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
			
		echo "<div align='center' style='color:#060'><b>Paid Leave ($first_half)</b></div>";	
		$tot_paid_holiday++;	
		}
		
		//to date in FHL or SHL
		if($leave_test[8]==$viewdate_att)
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
			echo "<div align='center' style='color:#060'><b>Paid Leave ($secnd_half)</b></div>";
			$tot_paid_holiday++;
		}
		
		//nt fromdate nt to date
		if($date_corrects)
		{
			
		echo "<div align='center' style='color:#060'><b>Paid Leave </b></div>";
		$tot_paid_holiday++;
		}
					
			$status_find=0;
		//end///////////
		}
		//leave without pay
		elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]!='2')
		{
			echo "<div align='center' style='color:#F00'><b>LWP </b></div>";
			$status_find=0;
			$lwp_count++;
		
		}
		//withdrawn
		elseif($leave_test[4]=='2')
		{
			//withdrawn pending so its go to leave (paid leave) 
			if($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[9]=='0')
			{
							
			/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if($leave_test[7]==$viewdate_att)
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
			
		echo "<div align='center' style='color:#060'><b>Paid Leave ($first_half)</b></div>";	
		$tot_paid_holiday++;	
		}
		
		//to date in FHL or SHL
		if($leave_test[8]==$viewdate_att)
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
			echo "<div align='center' style='color:#060'><b>Paid Leave ($secnd_half)</b></div>";
			$tot_paid_holiday++;
		}
		
		//nt fromdate nt to date
		if($date_corrects)
		{
			
		echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
		$tot_paid_holiday++;
		}
			
			
			
			
			$status_find=0;
			
			}//withdrawn is rejected (Paid leave) 
			elseif($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[9]=='3')
			{
				
				
				/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if($leave_test[7]==$viewdate_att)
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
			
		echo "<div align='center' style='color:#060'><b>Paid Leave ($first_half)</b></div>";	
		$tot_paid_holiday++;	
		}
		
		//to date in FHL or SHL
		if($leave_test[8]==$viewdate_att)
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
			echo "<div align='center' style='color:#060'><b>Paid Leave ($secnd_half)</b></div>";
			$tot_paid_holiday++;
		}
		
		//nt fromdate nt to date
		if($date_corrects)
		{
			
		echo "<div align='center' style='color:#060'><b>Paid Leave </b></div>";
		$tot_paid_holiday++;
		}
				
				$status_find=0;
				
				
			}		
			//withdrawn pending so its go to leave (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[9]=='0')
			{
				echo "<div align='center' style='color:#F00'><b>LWP </b></div>";
				$lwp_count++;
				$status_find=0;
			}
			//withdrawnis rejected (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[9]=='3')
			{
				echo "<div align='center' style='color:#F00'><b>LWP </b></div>";
				$lwp_count++;
				$status_find=0;
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P </b></div>";
		$staff_working=1+$staff_working;	
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A </b></div>";	
		}
		else
		{	
		echo "<div align='center' style='color:#F00'><b>A </b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P </b></div>";
		$staff_working=1+$staff_working;
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A </b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default </b></div>";
		$default_count++;	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($viewdate_att))
	{
				
//$staff_in_time='';

if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
		echo "<div align='center' style='color:#060'><b>AM : P </b></div>";
		$staff_working=$point_five+$staff_working;
	}
	
	else
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC) </b></div>";
		$staff_working=$point_five+$staff_working;
	}
	
	
	//staff_out_time
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		echo "<div align='center' style='color:#060'><b>PM : P </b></div>";
		$staff_working=$point_five+$staff_working;
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE) </b></div>";
		$staff_working=$point_five+$staff_working;
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
	}
}
}
?>

</td>
<?php
}
$staff_working_tot=$tot_paid_holiday+$staff_working;
$final_working=$tot_day1-$totday_sun_holiday;
$final_staff_working=$staff_working_tot+$totday_sun_holiday;
$final_working_all=$final_working+$totday_sun_holiday;

?>
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
	echo $staff_working;
	}
	?>
    </b>
    </td>
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
		//if($final_staff_working>0)
	//{
		echo $final_staff_working;
	//}
		?>
        /
		<?php
		if($final_working_all>0)
	{
		echo $final_working_all;
	}
		?>
        </b></td>

</tr>
<?php
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
?>
<tr>
 <td class="row3"  colspan="<?=$tot_day+10?>">
<?php
 $tempsql=$staff_name_display;
 $tempsql1=explode("SELECT *", $tempsql);
 $tempsql2=explode(" LIMIT ", $tempsql1[1]);
 $tempsql1 = $tempsql2[0];
 $sql ="SELECT COUNT(id) ".$tempsql1;

 $rs_result = mysql_query($sql);

 $row = mysql_fetch_row($rs_result);

 $total_records = $row[0];

 $total_pages = ceil($total_records / 10);

  

 echo "<p align='center'>";

 if($page==1)
  echo "First&nbsp;";
 else
  echo "<a href='staff_payroll_calculate.php?page=1&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to First page..'  > First </a> &nbsp;";

 $prv=$page-1;

 if($prv>0)
  echo "<a href='staff_payroll_calculate.php?page=".$prv."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to Previous page..'  > Previous </a> &nbsp;";
 else
  echo "&#9668;";

 echo "&nbsp;(Page $page of $total_pages)&nbsp;";

 $nxt=($page+1); 

 if($nxt<=$total_pages)
  echo "<a href='staff_payroll_calculate.php?page=".$nxt."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to Next page..'  > Next </a> &nbsp;"; 
 else
  echo "&#9658;";

 if($page==$total_pages)
  echo "&nbsp;Last&nbsp;";
 else
  echo "<a href='staff_payroll_calculate.php?page=".$total_pages."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to Last page..' >Last</a> &nbsp;";

  echo "<br>Total $total_records Staff(s)</p>";
?>

 </td>
 </tr>

</table>
</form>
</BODY>
</HTML>