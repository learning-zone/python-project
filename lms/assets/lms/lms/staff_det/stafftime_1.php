<html>
<head>
<Script language="JavaScript">

	
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
function OpenWind4(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
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
	if($_GET)
	{
		$adate=$_GET['adate'];
	}
 $disdate=date("d-m-Y");
  $sysdate=date("Y-m-d");
   $today_date=date("Y-m-d");
 $shl_staff='14:00:00';
$fhl_staff='12:00:00';

if(($_GET["page"])) //$_page
{ 
	$page  = $_GET["page"]; 
} 
else 
{ 
	$page=1; 
};
$start_from = ($page-1) * 20;

$sort_by = $_REQUEST['sort_by'];
$sort_type = $_REQUEST['sort_type'];

if($sort_by=="")
	$sort_by="f_name";

if($sort_type=="")
	$sort_type="ASC";
?>
<link rel="stylesheet" type="text/css" href="css/tab.css" />

</head>
<body>
<script language="javascript">
	function RefreshMe(val)
	{
		document.frm.action="stafftime_1.php";
		document.frm.submit();
	}
</script>
<script language="javascript" src="../js/cal2.js"></script>

<script language="javascript" src="../js/cal_conf2.js"></script>

<form name="frm"  method="post">
<input type="hidden" name="tab" value="<?=$p?>"/>
<input type="hidden" name="avl" value="<?=$avl?>"/>
<input type="hidden" name="contact" value="<?=$contact?>"/>
<input type="hidden" name="type" value="<?=$type?>"/>
<input type="hidden" name="reason" value="<?=$reason?>"/>
<input type="hidden" name="backup" value="<?=$backup?>"/>
<input type="hidden" name="days" value="<?=$totdays?>"/>
<?
/*$staffname1=mysql_fetch_array(mysql_query("SELECT DATEDIFF(day,'2008-06-05','2008-08-05') AS DiffDate"));
echo $staffname1[0];*/
$staffrigtss=fetcharray(execute("SELECT shortname,srid FROM `users` where username='$user'"));

?>
<br>
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
        <li class="currentBtn"><a href="stafftime_1.php?tab=12" >Staff Time Sheet</a></li>
        
        <li><a href="staffdetvew_rprts.php?tab=33" >Staff Attendance Report</a></li>
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
<?php
$manger_rights='';
$staff_right_vw=execute("select * from staff_leave_manger where manger_id='$staffrigtss[1]' and status=1 and acc_year='$acc_year'");
if(mysql_num_rows($staff_right_vw)>0)
{
	$manger_rights=1;
}
if($user=='pujas')
{
	$manger_rights='';
}
if($manger_rights)
{
?>

<table cellspacing="0" cellpadding="0" border="1" align="center" width="100%">
  <tr>
    <td colspan="12" class="head">Staff Daily Attendance for Date :   <input type="text" name="adate" value="<?php if($adate==""){$adate=date("d/m/Y"); } echo $adate?>" readonly onFocus="RefreshMe(0)">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle"></a><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick ="OpenWind4('staffdetvew_rprts.php', 'OpenWind4',1000,500)"><input type="button" name="rprts" value="Staff Attendance Report"  class='bgbutton'></a>--></td>
  </tr>
  <tr>
    <td align="center" class="row3" nowrap="nowrap">Sl No</td>
    <td align="center" class="row3" nowrap="nowrap">Staff Code</td>
    <td align="center" class="row3" nowrap="nowrap">Staff Name</td>
    <td align="center" class="row3" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
     <td align="center" class="row3" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
   	<td align="center" class="row3" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    <td align="center" class="row3" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
    <td align="center" class="row3" nowrap="nowrap">Time Spent</td>
    <td align="center" class="row3" nowrap="nowrap">Current Status</td>
    <td align="center" class="row3" nowrap="nowrap">Update Status</td>
     <?php
        if($staffrigtss[0]=='admin')
        {
        ?>
    <td align="center" class="row3" nowrap="nowrap">Updated By</td>
        <?
		}
		?>
<!--        <td align="center" class="row3" nowrap="nowrap">Details</td>
-->
  </tr>
<?php
$s=1;
$staff_validate=execute(("select c.staff_id from staff_det a,users b,staff_hr_grup c where c.status=1 and b.username='$user' and a.id!='$staffrigtss[1]'  and b.srid=c.mng_id and a.id=c.staff_id group by c.staff_id order by a.f_name"));
while($staff_validate1=fetcharray($staff_validate))
	{
		
$staff_name_display="SELECT * from staff_det where  active='YES' and id='$staff_validate1[0]'  and (recruitment_procedure='User' or recruitment_procedure='') ";

$staffname=mysql_query($staff_name_display);

	/*$viewss=execute("select f_name,s_name,EmployeeCode,group_id,id from staff_det where  active='YES'  and (recruitment_procedure='User' or recruitment_procedure='') order by f_name");*/
	while($viewss1=fetcharray($staffname))
	{
$viewss1['0']=$viewss1['f_name'];
$viewss1['1']=$viewss1['s_name'];
$viewss1['2']=$viewss1['EmployeeCode'];
$viewss1['3']=$viewss1['group_id'];
$viewss1['4']=$viewss1['id'];

$staffnameview[0]=$viewss1['0'];
$staffnameview[1]=$viewss1['1'];
$staffnameview[2]=$viewss1['2'];
$staffnameview[3]=$viewss1['3'];
$staffnameview[4]=$viewss1['4'];
/*echo "<br>select * from staff_det a,users b,staff_hr_grup c where c.status=1 and b.username='$user' and b.srid=c.mng_id and a.id=c.mng_id and  c.staff_id='$viewss1[4]'";
$staff_validate=execute(fetcharray("select c.staff_id from staff_det a,users b,staff_hr_grup c where c.status=1 and b.username='$user' and b.srid=c.mng_id and a.id=c.mng_id and  c.staff_id='$viewss1[4]'"));
if($staff_validate[0]==$viewss1[4])
{
}
*/	?>
    <tr>
 <td align="center" width="3%"><?=$s?></td>
        <td align="center" width="10%"><?=$viewss1[2]?></td>
        <td width="10%" nowrap>&nbsp;<?=$viewss1[0]?>&nbsp;<?=$viewss1[1]?></td>
        <td align="center" width="10%">jjjjjjjjjjjj
		<?php
	$fromdate=explode('/',$adate);
	$pfdate=$fromdate[2]."-".$fromdate[1]."-".$fromdate[0];
	$viewdate_att=$pfdate;
	
	$attview = mktime(0,0,0,$fromdate[1],$fromdate[0],$fromdate[2]);
	$viewdate_sunday=date("D", $attview);

	
		$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]'  order by att_time asc limit 1"));

		$acintime1='';
		$acintime2='';
		$acouttime1='';
		$acouttime2='';
		
		
		$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc limit 1"));

$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time desc limit 1"));

/*if(strtotime($staff_time_attt_in[0])==strtotime($staff_time_attt_out[0]))
{
	$staff_time_attt_out[0]='';
}*/
$in_timeview='';	
$out_timeview='';
$special_date=0;

$specl_con='1';
$special_date='';
$staff_time_check_special=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$staffnameview[3]'  and ( '$viewdate_att' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special)>0)
		{
			echo $in_timeview="9:00";
			$specl_con='';
			$special_date=1;
		}

if($specl_con)
{
       $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type='2' and leave_det=1 and staff_date='$viewdate_att'"));

	if($staff_time_check_date[4])
	{
		$special_date=1;
		echo $staff_time_check_date[0];
		if($staff_time_check_date[1])
		{
			$in_timeview=$staff_time_check_date[1];
		}
		else
		{
			$in_timeview=$staff_time_check_date[0];		
		}
	}
	else
	{
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type=1 and leave_det=1 and staff_date=''"));
		$special_date=0;
	echo $staff_time_check[0];	
		if($staff_time_check[1])
		{
			$in_timeview=$staff_time_check[1];
		}
		else
		{
			$in_timeview=$staff_time_check[0];		
		}
		
	}
}
?>[[[[[[[[[[[[[[[[[[[[[[
        </td>
        <td align="center" width="10%">kkkkkkkkkkkkkk
		<?php
		
		if(strtotime($staff_time_attt_in[0])<=strtotime($in_timeview))
		{
			echo "<font color='#003300'>$staff_time_attt_in[0]</font>";
		}
		else
		{
			echo "<font color='#FF0000'>$staff_time_attt_in[0]</font>";
		}
		?>
        </td>
        <td align="center" width="10%">
		<?php
		$specl_con_out='1';
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$staffnameview[3]'  and ( '$viewdate_att' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			echo $out_timeview="17:00";
			$specl_con_out='';
		}
		if($specl_con_out)
		{
		$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type='2' and leave_det=1 and staff_date='$viewdate_att'"));

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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[3])
		{
			echo $out_timeview=$staff_time_check[3];
		}
		else
		{
			echo $out_timeview=$staff_time_check[2];		
		}
		
	}
		}
}
?>
        </td>
        <td align="center" width="10%">
        <?php
		$staff_rfid_count=fetcharray(execute("SELECT count(att_date) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]'"));
		
		$staffrfidout=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' order by att_time desc limit 1"));
$var1 = ($staffrfidlv[0]);
$var2 = ($staffrfidout[0]);
//$var7='05:30:00';
//$var9 = strtotime($var7);
$var3 = $var2 - $var1;

$var1_sec=strtotime($var1);
$var2_sec=strtotime($var2);
$var3_sec=$var2_sec-$var1_sec;

$var4 = gmdate ( 'H:i:s' , $var3_sec);

		
		if(strtotime($staff_time_attt_out[0])>=strtotime($out_timeview))
		{
			echo "<font color='#003300'>$staff_time_attt_out[0]</font>";
		}
		else
		{
			echo "<font color='#FF0000'>$staff_time_attt_out[0]</font>";
		}
		?>
        </td>
        <td align="center" width="10%"><?=$var4?></td>
        <td align="center" width="10%">
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$viewdate_att' between f_date and t_date) and status=1 and status_approve!=2"));

$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$viewdate_att' and status=1 and status_approve!=2"));


$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$viewdate_att'"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]'"));
	$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));


$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2' && $leave_test[2]!='7')
	
	{
		if($updated_att_staff[0]==1 && $updated_att_staff[1]!='0' && $leave_test[1]!=1 && $leave_od_ee[1]!=1)
		{
		$first_half='';
			if(strtotime($leave_test[7])==strtotime($leave_test[8]))
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
			elseif(strtotime($leave_test[7])==strtotime($viewdate_att))
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
			elseif(strtotime($leave_test[8])==strtotime($viewdate_att))
			{
				$from_half_day=explode('_',$leave_test[6]);
				if($from_half_day[1]=='aout')
				{
				$first_half='FHL';
				}
				if($from_half_day[1]=='pout')
				{
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
				
				echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
				$status_find=0;
			}
			elseif($viewdate_sunday=='Sun')
			{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				$status_find=0;
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
				}
				if($from_half_day[1]=='pin')
				{
				$first_half='SHL';
				}
			}
			elseif(strtotime($leave_test[7])==strtotime($viewdate_att))
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
			elseif(strtotime($leave_test[8])==strtotime($viewdate_att))
			{
				$from_half_day=explode('_',$leave_test[6]);
				if($from_half_day[1]=='aout')
				{
				$first_half='FHL';
				}
				if($from_half_day[1]=='pout')
				{
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
				
				echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
				$status_find=0;
			}
			elseif($viewdate_sunday=='Sun')
			{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
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
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
			
		}
		
		$status_find=0;
		
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($viewdate_att) && $leave_test[2]!='7')
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
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
	}
	//sunday
	elseif($viewdate_sunday=='Sun' && $leave_test[2]!='7')
	{
		//if(strtotime($today_date)>strtotime($viewdate_att))
		//{
			echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
			$status_find=0;
			
		//}
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
				}
				else
				{
		echo "<div align='center' style='color:#060'><b>Leave ($first_half)</b></div>";
				}
		
			}
			else
			{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave</b></div>";
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
				}
				else
				{
			echo "<div align='center' style='color:#060'><b>Leave ($secnd_half)</b></div>";
				}
			
			}
			else
			{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave</b></div>";
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
			}
			else
			{
				echo "<div align='center' style='color:#060'><b>P(OD)</b></div>";
			}
			$status_find=0;
		}
		//EE
		if($leave_od_ee[2]=='EE'  && $leave_od_ee[0]=='1' && $leave_od_ee[4]!='2'  && $leave_od_ee[2]!='7')
		{
			if($view_att_staff[1])
			{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";
			}
			else
			{
			echo "<div align='center' style='color:#060'><b>P(EE)</b></div>";
			}
			$status_find=0;
		}
		if($leave_test[2]=='7'  && $leave_test[0]=='1' && $leave_test[4]!='2')
		{
			if($view_att_staff[1])
			{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";
			}
			else
			{
			echo "<div align='center' style='color:#060'><b>Leave(Vac)</b></div>";
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P </b></div>";
			
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
		echo "<div align='center' style='color:#060'><b>P(D)</b></div>";
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>A(D)</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default </b></div>";
		
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($viewdate_att))
	{
$morng_present=1;
$plc_valid=1;
$fhl_valid=0;
$fhl_time_staff="11:45";			
//$staff_in_time='';
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];

$leave_plc="";
$leave_pqd="";
$leave_fhl="";
$leave_shl="";
$leave_tqd="";
$leave_ee="";

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(mysql_num_rows($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(mysql_num_rows($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(mysql_num_rows($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(mysql_num_rows($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(mysql_num_rows($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(mysql_num_rows($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$staffnameview[3];
$intime_staff='';
$outtime_staff='';
$totaltime='';
$intime_staff = strtotime($staffrfidlv[0]);
$outtime_staff = strtotime($staffrfidout[0]);

$totaltime=$outtime_staff-$intime_staff;
$hoursdiff4=strtotime('04:00');
$hoursdiff2=strtotime('02:00');
$totspent = gmdate ( 'H:i:s' , $totaltime);

if(strtotime($totspent)<=$hoursdiff4 && strtotime($totspent)>=$hoursdiff2)
{
	echo "<div align='center' style='color:#F00'><b>Default<br>($totspent)</b></div>";
}
elseif(strtotime($totspent)<=$hoursdiff2)
{
	echo "<div align='center' style='color:#F00'><b>A<br>($totspent)</b></div>";
}
elseif($special_date)
{
	echo "<div align='center' style='color:#CC6600' title='Special day'><b>P </b></div>";
	$staff_working=$staff_working+1;	
}
else
{	

if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
				$morng_present=1;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_plc[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_plc[1]) && $leave_plc!=1)
	{
		$morng_present=0;
		echo "<div align='center' style='color:#F60'><b>P(LC)</b></div>";

	}
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_pqd[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_pqd[1]) && $leave_pqd!=1)
	{
		$morng_present=0;
		echo "<div align='center' style='color:#F60'><b>P(QD)</b></div>";

		
	}
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_fhl[0])  && $leave_fhl!=1)
	{
		$morng_present=0;
		echo "<div align='center' style='color:#00F'><b>FHL</b></div>";

	}
	$ee_valid=1;
	//staff_out_time
	$eve_present=1;
	$shl_valid=0;
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		$eve_present=1;
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1]) && $leave_tqd!=1)
	{
		$eve_present=0;
		echo "<div align='center' style='color:#93C'><b>&#9733; P(QD)</b></div>";
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_ee[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_ee[1])  && $leave_ee!=1)
	{
		$ee_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#93C'><b>EE</b></div>";
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_shl[0])  && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_shl[1]) && $leave_shl!=1)
	{
		$shl_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#00F'><b>SHL</b></div>";

	}
	elseif(strtotime($staff_time_attt_out[0]) < strtotime($leave_staff_diffrence_shl[0]) && $leave_shl!=1)
	{
		$shl_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#00F'><b>SHL</b></div>";

	}
		if($eve_present=='1' && $morng_present=='1')
		{
			echo "<div align='center' style='color:#060'><b>P</b></div>";	
		}
}
		$ee_valid='';
		$plc_valid='';
	}
}
}
?>
</td>
 <td align="center" nowrap>
	<?php
    $stsss=1;	
    $r5=fetcharray(execute("select type,id,user from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
    
    $rowgreatone=execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'");
	
	$update_attenc=fetcharray(execute("SELECT att_colors,name FROM `leave_att_point` WHERE status=1 and id='$r5[0]'"));
    if(mysql_num_rows($rowgreatone)>=1 &&  $leave_update_att[4]!='2' && $leave_update_att[1]!=1)
    {
    ?>
    <a href="javascript:void(0);" onClick ="OpenWind2('attvat_up.php?staffids=<?=$viewss1[4]?>&adate=<?=$day_view_date?>&staff_ids=<?=$staff_ids?>&bdate=<?=$bdate?>&adate_old=<?=$adate?>', 'OpenWind3',400,400)">
    <?php
	if(strtotime($staff_calender[0])==strtotime($viewdate_att))
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
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
			echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
			$status_find=0;
	}
    elseif($updated_att_staff[1]!='0' && $updated_att_staff[0]=='1')
    {
	?>
    <b><font color="<?=$update_attenc[0]?>">Paid Leave</font></b>
    <?php
    }
    else
    {
	?>	
     <b><font color="<?=$update_attenc[0]?>"><?=$update_attenc[1]?></font></b>
    <?
    }
	?>
    </a>
    <?
    }
	else
	{
    ?>
     <a href="javascript:void(0);" onClick ="OpenWind2('attvat_up.php?staffids=<?=$viewss1[4]?>&adate=<?=$day_view_date?>&staff_ids=<?=$staff_ids?>&bdate=<?=$bdate?>&staff_ids=<?=$staff_ids?>&adate_old=<?=$adate?>', 'OpenWind3',400,400)">Update</a>
    <?php
	}
	?>
        </td>
         <?php
        if($staffrigtss[0]=='admin')
        {
        ?>
        <td align="left" nowrap>&nbsp;<?=$r5[2]?></td>
        <?
		}
		?>
        <!--<td align="center" nowrap><a href="javascript:void(0);" onClick ="OpenWind4('staffdetvew.php?staffid=<?=$viewss1[4]?>', 'OpenWind4',1000,500)"><input type="button" name="del" value="Detail"  class='bgbutton'></a></td>-->
    </tr>
   <?
   $s++;	
	}

	?>
</table>
<?php
}
else
{
?>
<table cellspacing="0" cellpadding="0" border="1" align="center" width="100%">
  <tr>
    <td colspan="12" class="head">Staff Daily Attendance for Date :   <input type="text" name="adate" value="<?php if($adate==""){$adate=date("d/m/Y"); } echo $adate?>" readonly onFocus="RefreshMe(0)">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle"></a><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick ="OpenWind4('staffdetvew_rprts.php', 'OpenWind4',1000,500)"><input type="button" name="rprts" value="Staff Attendance Report"  class='bgbutton'></a>--></td>
  </tr>
  <tr>
    <td align="center" class="row3" nowrap="nowrap">Sl No</td>
    <td align="center" class="row3" nowrap="nowrap"><a href="<?php echo "stafftime_1.php?sort_by=EmployeeCode&sort_type=ASC&adate=".$adate."";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font>
</a>Staff Code<a href="<?php echo "stafftime_1.php?sort_by=EmployeeCode&sort_type=DESC&adate=".$adate."";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font></a></td>
    <td align="center" class="row3" nowrap="nowrap"><a href="<?php echo "stafftime_1.php?sort_by=f_name&sort_type=ASC&adate=".$adate."";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font>
</a>Staff Name<a href="<?php echo "stafftime_1.php?sort_by=f_name&sort_type=DESC&adate=".$adate."";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font></a></td>
    <td align="center" class="row3" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
     <td align="center" class="row3" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
   	<td align="center" class="row3" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    <td align="center" class="row3" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
    <td align="center" class="row3" nowrap="nowrap">Time Spent</td>
    <td align="center" class="row3" nowrap="nowrap">Current Status</td>
    <td align="center" class="row3" nowrap="nowrap">Update Status</td>
 <?php
        if($staffrigtss[0]=='admin')
        {
        ?>
    <td align="center" class="row3" nowrap="nowrap">Updated By</td>
        <?
		}
		?>
<!--        <td align="center" class="row3" nowrap="nowrap">Details</td>
-->
  </tr>
<?php
$s=1;

$staff_name_display="SELECT * from staff_det where  active='YES' and id!='$staffrigtss[1]'  and (recruitment_procedure='User' or recruitment_procedure='') ";
$staff_name_display.=" ORDER BY $sort_by $sort_type LIMIT $start_from, 20";

$staffname=mysql_query($staff_name_display);

	/*$viewss=execute("select f_name,s_name,EmployeeCode,group_id,id from staff_det where  active='YES'  and (recruitment_procedure='User' or recruitment_procedure='') order by f_name");*/
	while($viewss1=fetcharray($staffname))
	{
$viewss1['0']=$viewss1['f_name'];
$viewss1['1']=$viewss1['s_name'];
$viewss1['2']=$viewss1['EmployeeCode'];
$viewss1['3']=$viewss1['group_id'];
$viewss1['4']=$viewss1['id'];

$staffnameview[0]=$viewss1['0'];
$staffnameview[1]=$viewss1['1'];
$staffnameview[2]=$viewss1['2'];
$staffnameview[3]=$viewss1['3'];
$staffnameview[4]=$viewss1['4'];
	?>
    <tr>
 <td align="center" width="3%"><?=$s?></td>
        <td align="center" width="10%"><?=$viewss1[2]?></td>
        <td width="10%" nowrap>&nbsp;<?=$viewss1[0]?>&nbsp;<?=$viewss1[1]?></td>
        <td align="center" width="10%">
		<?php
	$fromdate=explode('/',$adate);
	$pfdate=$fromdate[2]."-".$fromdate[1]."-".$fromdate[0];
	$viewdate_att=$pfdate;
	
	$attview = mktime(0,0,0,$fromdate[1],$fromdate[0],$fromdate[2]);
	$viewdate_sunday=date("D", $attview);

	
		$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]'  order by att_time asc limit 1"));

		$acintime1='';
		$acintime2='';
		$acouttime1='';
		$acouttime2='';
		
		
		$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc limit 1"));

$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time desc limit 1"));

/*if(strtotime($staff_time_attt_in[0])==strtotime($staff_time_attt_out[0]))
{
	$staff_time_attt_out[0]='';
}*/
$in_timeview='';	
$out_timeview='';
$special_date=0;

$specl_con='1';
$special_date='';
$staff_time_check_special=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$staffnameview[3]'  and ( '$viewdate_att' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special)>0)
		{
			echo $in_timeview="9:00";
			$specl_con='';
			$special_date=1;
		}

if($specl_con)
{
       $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type='2' and leave_det=1 and staff_date='$viewdate_att'"));

	if($staff_time_check_date[4])
	{
		$special_date=1;
		echo $staff_time_check_date[0];
		if($staff_time_check_date[1])
		{
			$in_timeview=$staff_time_check_date[1];
		}
		else
		{
			$in_timeview=$staff_time_check_date[0];		
		}
	}
	else
	{
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	$special_date=0;
	echo $staff_time_check[0];	
		if($staff_time_check[1])
		{
			$in_timeview=$staff_time_check[1];
		}
		else
		{
			$in_timeview=$staff_time_check[0];		
		}
		
	}
}
?>
        </td>
        <td align="center" width="10%">
		<?php
		
		if(strtotime($staff_time_attt_in[0])<=strtotime($in_timeview))
		{
			echo "<font color='#003300'>$staff_time_attt_in[0]</font>";
		}
		else
		{
			echo "<font color='#FF0000'>$staff_time_attt_in[0]</font>";
		}
		?>
        </td>
        <td align="center" width="10%">
		<?php
		$specl_con_out='1';
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$staffnameview[3]'  and ( '$viewdate_att' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			echo $out_timeview="17:00";
			$specl_con_out='';
		}
		if($specl_con_out)
		{
		$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type='2' and leave_det=1 and staff_date='$viewdate_att'"));

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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[3])
		{
			echo $out_timeview=$staff_time_check[3];
		}
		else
		{
			echo $out_timeview=$staff_time_check[2];		
		}
		
	}
		}
?>
        </td>
        <td align="center" width="10%">
        <?php
		$staff_rfid_count=fetcharray(execute("SELECT count(att_date) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]'"));
		
		$staffrfidout=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' order by att_time desc limit 1"));
$var1 = ($staffrfidlv[0]);
$var2 = ($staffrfidout[0]);
//$var7='05:30:00';
//$var9 = strtotime($var7);
$var3 = $var2 - $var1;

$var1_sec=strtotime($var1);
$var2_sec=strtotime($var2);
$var3_sec=$var2_sec-$var1_sec;

$var4 = gmdate ( 'H:i:s' , $var3_sec);

		
		if(strtotime($staff_time_attt_out[0])>=strtotime($out_timeview))
		{
			echo "<font color='#003300'>$staff_time_attt_out[0]</font>";
		}
		else
		{
			echo "<font color='#FF0000'>$staff_time_attt_out[0]</font>";
		}
		?>
        </td>
        <td align="center" width="10%"><?=$var4?></td>
        <td align="center" width="10%">
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$viewdate_att' between f_date and t_date) and status=1 and status_approve!=2"));

$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$viewdate_att' and status=1 and status_approve!=2"));


$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$viewdate_att'"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]'"));

			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

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
				$first_half='FHL';
				}
				if($from_half_day[1]=='pin')
				{
				$first_half='SHL';
				}
			}
			elseif(strtotime($leave_test[7])==strtotime($viewdate_att))
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
			elseif(strtotime($leave_test[8])==strtotime($viewdate_att))
			{
				$from_half_day=explode('_',$leave_test[6]);
				if($from_half_day[1]=='aout')
				{
				$first_half='FHL';
				}
				if($from_half_day[1]=='pout')
				{
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
				
				echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
				$status_find=0;
			}
			elseif($viewdate_sunday=='Sun')
			{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				$status_find=0;
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
				}
				if($from_half_day[1]=='pin')
				{
				$first_half='SHL';
				}
			}
			elseif(strtotime($leave_test[7])==strtotime($viewdate_att))
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
			elseif(strtotime($leave_test[8])==strtotime($viewdate_att))
			{
				$from_half_day=explode('_',$leave_test[6]);
				if($from_half_day[1]=='aout')
				{
				$first_half='FHL';
				}
				if($from_half_day[1]=='pout')
				{
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
				
				echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
				$status_find=0;
			}
			elseif($viewdate_sunday=='Sun')
			{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
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
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
			
		}
		
		
		$status_find=0;
		}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($viewdate_att))
	{
		/*if(strtotime($today_date)>strtotime($viewdate_att))
		{*/
		
			$view_holidays='';
		if($viewdate_sunday=='Sun' || $viewdate_sunday=='Sat')
		{
			$view_holidays='WO';
		}
		else
		{
			$view_holidays='H';
		}
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
			
		
		//}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		/*if(strtotime($today_date)>strtotime($viewdate_att))
		{*/
			echo "<div align='center' style='color:#FF0000'><b>WO</b></div>";
			$status_find=0;
			
		//}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($viewdate_att))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2'  && $leave_test[2]!='7')
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
				}
				else
				{
		echo "<div align='center' style='color:#060'><b>Leave ($first_half)</b></div>";
				}
		
			}
			else
			{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave</b></div>";
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
				}
				else
				{
			echo "<div align='center' style='color:#060'><b>Leave ($secnd_half)</b></div>";
				}
			
			}
			else
			{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave</b></div>";
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
			}
			else
			{
				echo "<div align='center' style='color:#060'><b>P(OD)</b></div>";
			}
			$status_find=0;
		}
		//EE
		if($leave_od_ee[2]=='EE'  && $leave_od_ee[0]=='1' && $leave_od_ee[4]!='2'  && $leave_od_ee[2]!='7')
		{
			if($view_att_staff[1])
			{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";
			}
			else
			{
			echo "<div align='center' style='color:#060'><b>P(EE)</b></div>";
			}
			$status_find=0;
		}
		if($leave_test[2]=='7'  && $leave_test[0]=='1' && $leave_test[4]!='2')
		{
			if($view_att_staff[1])
			{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";
			}
			else
			{
			echo "<div align='center' style='color:#060'><b>Leave(Vac)</b></div>";
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P </b></div>";
			
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
		echo "<div align='center' style='color:#060'><b>P(D)</b></div>";
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>A(D)</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default </b></div>";
		
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($viewdate_att))
	{
$morng_present=1;
$plc_valid=1;
$fhl_valid=0;
$fhl_time_staff="11:45";			
//$staff_in_time='';
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];

$leave_plc="";
$leave_pqd="";
$leave_fhl="";
$leave_shl="";
$leave_tqd="";
$leave_ee="";

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(mysql_num_rows($leave_staff_diffrence_plc1)<1)
{

	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(mysql_num_rows($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(mysql_num_rows($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(mysql_num_rows($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(mysql_num_rows($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$staffnameview[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(mysql_num_rows($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$staffnameview[3];
$intime_staff='';
$outtime_staff='';
$totaltime='';
$intime_staff = strtotime($staffrfidlv[0]);
$outtime_staff = strtotime($staffrfidout[0]);

$totaltime=$outtime_staff-$intime_staff;
$hoursdiff4=strtotime('04:00');
$hoursdiff2=strtotime('02:00');
$totspent = gmdate ( 'H:i:s' , $totaltime);

if(strtotime($totspent)<=$hoursdiff4 && strtotime($totspent)>=$hoursdiff2)
{
	echo "<div align='center' style='color:#F00'><b>Default<br>($totspent)</b></div>";
}
elseif(strtotime($totspent)<=$hoursdiff2)
{
	echo "<div align='center' style='color:#F00'><b>A<br>($totspent)</b></div>";
}
elseif($special_date)
{
	echo "<div align='center' style='color:#CC6600' title='Special day'><b>P </b></div>";
	
}
else
{	
if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
				$morng_present=1;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_plc[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_plc[1])  && $leave_plc!=1)
	{
		$morng_present=0;
		echo "<div align='center' style='color:#F60'><b>P(LC)</b></div>";

	}
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_pqd[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_pqd[1])  && $leave_pqd!=1)
	{
		$morng_present=0;
		echo "<div align='center' style='color:#F60'><b>P(QD)</b></div>";

		
	}
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_fhl[0]) && $leave_fhl!=1)
	{
		$morng_present=0;
		echo "<div align='center' style='color:#00F'><b>FHL</b></div>";

	}
	$ee_valid=1;
	//staff_out_time
	$eve_present=1;
	$shl_valid=0;
	
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		$eve_present=1;
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1]) && $leave_tqd!=1)
	{
		$eve_present=0;
		echo "<div align='center' style='color:#93C'><b>&#9733; P(QD)</b></div>";
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_ee[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_ee[1]) && $leave_ee!=1)
	{
		$ee_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#93C'><b>EE</b></div>";
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_shl[0])  && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_shl[1]) && $leave_shl!=1)
	{
		$shl_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#00F'><b>SHL</b></div>";

	}
	elseif(strtotime($staff_time_attt_out[0]) < strtotime($leave_staff_diffrence_shl[0]) && $leave_shl!=1)
	{
		$shl_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#00F'><b>SHL</b></div>";

	}
		if($eve_present=='1' && $morng_present=='1')
		{
			echo "<div align='center' style='color:#060'><b>P</b></div>";	
		}
}
		$ee_valid='';
		$plc_valid='';
	}
}
}
?>
</td>
 <td align="center" nowrap>
	<?php
    $stsss=1;	
    $r5=fetcharray(execute("select type,id,user from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
    
    $rowgreatone=execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'");
	
	$update_attenc=fetcharray(execute("SELECT att_colors,name FROM `leave_att_point` WHERE status=1 and id='$r5[0]'"));
    if(mysql_num_rows($rowgreatone)>=1 &&  $leave_update_att[4]!='2' && $leave_update_att[1]!=1)
    {
    ?>
    <a href="javascript:void(0);" onClick ="OpenWind2('attvat_up.php?staffids=<?=$viewss1[4]?>&adate=<?=$day_view_date?>&staff_ids=<?=$staff_ids?>&bdate=<?=$bdate?>&adate_old=<?=$adate?>', 'OpenWind3',400,400)">
    <?php
	if(strtotime($staff_calender[0])==strtotime($viewdate_att))
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
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
			echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
			$status_find=0;
	}
    elseif($updated_att_staff[1]!='0' && $updated_att_staff[0]=='1')
    {
	?>
    <b><font color="<?=$update_attenc[0]?>">Paid Leave</font></b>
    <?php
    }
    else
    {
	?>	
     <b><font color="<?=$update_attenc[0]?>"><?=$update_attenc[1]?></font></b>
    <?
    }
	?>
    </a>
    <?
    }
	else
	{
    ?>
     <a href="javascript:void(0);" onClick ="OpenWind2('attvat_up.php?staffids=<?=$viewss1[4]?>&adate=<?=$day_view_date?>&staff_ids=<?=$staff_ids?>&bdate=<?=$bdate?>&staff_ids=<?=$staff_ids?>&adate_old=<?=$adate?>', 'OpenWind3',400,400)">Update</a>
    <?php
	}
	?>
        </td>
        <?php
        if($staffrigtss[0]=='admin')
        {
        ?>
        <td align="left" nowrap>&nbsp;<?=$r5[2]?></td>
        <?
		}
		?>
        <!--<td align="center" nowrap><a href="javascript:void(0);" onClick ="OpenWind4('staffdetvew.php?staffid=<?=$viewss1[4]?>', 'OpenWind4',1000,500)"><input type="button" name="del" value="Detail"  class='bgbutton'></a></td>-->
    </tr>
   <?
   $s++;	
	}
	?>
    <tr>
 <td class="row3"  colspan="11">
<?php
 $tempsql=$staff_name_display;
 $tempsql1=explode("SELECT *", $tempsql);
 $tempsql2=explode(" LIMIT ", $tempsql1[1]);
 $tempsql1 = $tempsql2[0];
 $sql ="SELECT COUNT(id) ".$tempsql1;

 $rs_result = mysql_query($sql);

 $row = mysql_fetch_row($rs_result);

 $total_records = $row[0];

 $total_pages = ceil($total_records / 20);

  

 echo "<p align='center'>";

 if($page==1)
  echo "First&nbsp;";
 else
  echo "<a href='stafftime_1.php?page=1&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to First page..'  > First </a> &nbsp;";

 $prv=$page-1;

 if($prv>0)
  echo "<a href='stafftime_1.php?page=".$prv."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to Previous page..'  > Previous </a> &nbsp;";
 else
  echo "&#9668;";

 echo "&nbsp;(Page $page of $total_pages)&nbsp;";

 $nxt=($page+1); 

 if($nxt<=$total_pages)
  echo "<a href='stafftime_1.php?page=".$nxt."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to Next page..'  > Next </a> &nbsp;"; 
 else
  echo "&#9658;";

 if($page==$total_pages)
  echo "&nbsp;Last&nbsp;";
 else
  echo "<a href='stafftime_1.php?page=".$total_pages."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to Last page..' >Last</a> &nbsp;";

  echo "<br>Total $total_records Staff(s)</p>";
?>

 </td>
 </tr>
</table>
<?php
}
?>
</form>
</body>
</html>

