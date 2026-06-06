<?php
	include("../db.php");
	$user=$_SESSION['user'];
	$today_date=date("Y-m-d");
	$yr=date("Y");
$datefixs="2014-03-20";
	if($_POST)
	{
		$mont=$_POST['mont'];
		$yr=$_POST['yr'];
	}
	else
	{
		$mont=date("m");
		$yr=date("Y");
	}
	$day=date("d");
	$mon=$mont;
	$todayDate=date("Y-m-d");
	$shl_staff='14:00:00';
$fhl_staff='12:00:00';
$staffrigtss=fetcharray(execute("SELECT shortname FROM `users` where username='$user'"));
?>
<html>
<head>
<script language="Javascript">
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
function reload()
{
  document.frm.action='staff_profile.php';
  document.frm.submit();
}
</script>
</head>
<body>
<form name='frm' method='post' action=''>
<input type='hidden' name='day' value='<?php echo $day?>'>
<input type='hidden' name='yer' value='<?php echo $yr?>'>
<br>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
        <li><a href="leave.php?tab=1" >Leave & Attendance</a></li>
        <?php
$stvstra=1;
		$mang_hrrt=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
 if(mysql_num_rows($mang_hrrt)>0  && $staffrigtss[0]!='admin')
	{
$stvstra=0;
		?>
        <li><a href="leave.php?tab=2" >Leave Approval</a></li>
        <li><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
        <li><a href="staffdetvew_rprts.php?tab=33" >Staff Attendance Report</a></li>
         <li><a href="stafftime_update.php?tab=111" >Staff Time Sheet Update</a></li>
        <?php
	}
		?>
        <?php
 if($staffrigtss[0]=='admin' && $stvstra=='1')
	{
		?>
        <li><a href="leave_admin.php?tab=2" >Leave Approval</a></li>
        <li><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
        <li><a href="staffdetvew_rprts.php?tab=33" >Staff Attendance Report</a></li>
         <li><a href="stafftime_update.php?tab=111" >Staff Time Sheet Update</a></li>
        <?php
	}
		?>
        <li class="currentBtn"><a href="staff_profile.php?tab=20" >My Time Sheet</a></li>
 <li><a href="leave_count.php?tab=65" >Leave Details</a></li>
</ul>
</div>
</div>
<?php
$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id,a.j_date from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);
?>
<br>
<table align="center" border="1" cellpadding="0" cellspacing="0" width="95%" style="background-color:#FFF">
<tr>
<?
$k=1;
$daydisp=execute("select full_name,name from leave_att_point where status=1 ");
while($leave_namess=fetcharray($daydisp))
{
	?>
    
    	<td style="background:none"><font color="#000000"><?php echo "<b>".$leave_namess[1]."</b> : ".$leave_namess[0]?></font></td>
        <?
 if($k % 5==0)
 {
 	?>
    	</tr>
    <?
 }
 $k++;
}
?>
</table>
<br>
<table align="center" border="1" cellSpacing="0" width="95%"  >
<tr height="30">
	   <td colSpan="7" align="center" class='head'>Calendar</td>
</tr>
<tr>
<td align="right"><font face='Lucida Sans' color='blue' size='2'>Month&nbsp;&nbsp;</font></td>
<td colspan="2" ><select name='mont' onChange="reload()">
  <?php
 $d=getdate();
$MyMonth=$mont;
 for($i=1;$i<=12;$i++)
{
        if($i<10)
	{
	  $i='0'.$i;
	}
	if($i == $MyMonth)
		echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
	else
		echo "<option value='$i'>" . MonthName($i) . "</option>\n";
}
?>
  </select>
  <?php MonthName($mont)?></td>
<td></td><td></td><td></td><td></td>
</tr>
<tr>
<td align="right">&nbsp;&nbsp;<font face='Lucida Sans' color='blue' size='2'>Year&nbsp;&nbsp;</font></td>
<td colspan="2">
  <select name='yr' onChange="reload()">
    <?php
$yrr=date("Y")-1;
for($i=1;$i<=3;$i++)
{
	if($yrr == $yr)
		echo "<option value='$yrr' selected>" . $yrr . "</option>\n";
	else
		echo "<option value='$yrr'>" .$yrr . "</option>\n";
		$yrr++;
}
?>
  </select></td>
<td></td><td></td><td></td><td></td></tr>
                    <tr class="keyrow">
					<td class="row3" height="16" width='75' bgcolor="" align="center"><font size="2" color="#FF0000">Sun</font></td>
					<td class="row3"  height="16" width='75' bgcolor="#ADAAF2" align="center"><font size="2">Mon</font></td>
					<td class="row3"  height="16" width='75' bgcolor="#ADAAF2" align="center"><font size="2">Tue</font></td>
					<td class="row3"  height="16" width='75' bgcolor="#ADAAF2" align="center"><font size="2">Wed</font></td>
					<td class="row3"  height="16" width='75' bgcolor="#ADAAF2" align="center"><font size="2">Thu</font></td>
					<td  class="row3" height="16" width="81" bgcolor="#ADAAF2" align="center"><font size="2">Fri</font></td>
					<td  class="row3" height="16" width='75' bgcolor="#ADAAF2" align="center"><font size="2">Sat</font></td>
				</tr>
				<tr>
				
				<?php
				       $r=cal_days_in_month(CAL_GREGORIAN,$mont,$yr);
				       for($i=1;$i<=$r;$i++)
				       {
						   $da='';
						   $fg='';
						   if($i<10)
						   {
						      $i='0'.$i;
						   }				   
						   $fg=$yr."-".$mont."-".$i;
						   $da=date('D-m-Y',strtotime($fg));
						   $das=explode("-",$da);
						if($i==1 )
						{
							   if($das[0]=='Sun')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="clsna"';	
								   			else
								   		 	$newbgcolor='class="colrs"';																					
								   ?>
									<td  <?php echo $newbgcolor; ?> height='75' vAlign="center" width='75'>
									<div Align="center" >
			<?php
			$newdateval1="$yr-$mont-$i";
            if(strtotime($newdateval1) > strtotime($datefixs))
            {
            ?>
           
								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a>
            <?php
			}
			else
			{
			?> 
             <font color="<?php echo $bgcolor; ?>"><?php echo $i?></font>
            <?php
            }
            ?>
                                </div><br>	
									<?php
			$newdateval="$yr-$mont-$i";
			
			$attview = mktime(0,0,0,$mont,$i,$yr);
			
			$viewdate_sunday=date("D", $attview);
		if(strtotime($newdateval) > strtotime($datefixs))
		{
								///code start///
								
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$newdateval' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			$special_date=1;
			$in_timeview="09:00";
			$out_timeview="17:00";
			$specl_con_out='';
		}
/*$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");*/
$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc limit 1"));
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time desc limit 1"));
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");
$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$viewss1[3]'"));
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1 and status_approve!=2 order by id desc"));
$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$newdateval' and status=1 and status_approve!=2 order by id desc"));
$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));
/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));

$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2'  && $leave_test[2]!='7')
	
	{
		//if(strtotime($today_date)>strtotime($newdateval))
		//{	
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>Leave";
			if($first_half)
				{
				echo "($first_half)";
				}
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
					}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]"; 
				if($first_half)
				{
				echo "($first_half)";
				}
				}
			}
		echo "</b></div>";	
		}
		else
		{
			if(strtotime($today_date)>strtotime($newdateval))
				{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
				}
		}
		
		
		$status_find=0;
		//}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($newdateval) && $leave_test[2]!='7')
	{
		if(strtotime($today_date)>strtotime($newdateval))
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
			{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
			}
			else
			{
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
			}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
				if(strtotime($viewss1[j_date])>strtotime($newdateval))
				{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
				}
				else
				{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				}
			}
			$status_find=0;
			
		}
	}
	//leave 
	else
	//if(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2'  && $leave_test[2]!='7')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if(strtotime($leave_test[7])==strtotime($newdateval))
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
		if(strtotime($leave_test[8]==$newdateval) && strtotime($leave_test[7])!=strtotime($leave_test[8]))
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
//leave vac
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//Absent approval stage(its in same in default stage)
		$satff_absent_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//default approval stage
		$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
if(strtotime($today_date)>strtotime($newdateval))
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

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(mysql_num_rows($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(mysql_num_rows($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(mysql_num_rows($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(mysql_num_rows($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(mysql_num_rows($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(mysql_num_rows($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$viewss1[3];
$intime_staff='';
$outtime_staff='';
$totaltime='';
$intime_staff = strtotime($staff_time_attt_in[0]);
$outtime_staff = strtotime($staff_time_attt_out[0]);

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
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1])  && $leave_tqd!=1)
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
		}//end/////	
					
echo "</td>";
							   }
							   if($das[0]=='Mon')
							   							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="clsna"';																							              								else
								   		 	$newbgcolor='class="colrs"';
																		
								   ?>
									<td>&nbsp;</td><td <?php echo $newbgcolor; ?> height='75' vAlign="center" width='75' nowrap>
									<div Align="center" >
<?php
$newdateval1="$yr-$mont-$i";
	if(strtotime($newdateval1) > strtotime($datefixs))
	{
	?>
								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a>
     <?php
	}
	else
	{
	?> 
	<font color="<?php echo $bgcolor; ?>"><?php echo $i?></font>
	<?php
	}
	?>                           
                                
                                </div> <br>									
                          									<?php								
                                
								
     $newdateval="$yr-$mont-$i";
	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	if(strtotime($newdateval) > strtotime($datefixs))
					{
								///code start///
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$newdateval' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			$special_date=1;
			$in_timeview="09:00";
			$out_timeview="17:00";
			$specl_con_out='';
		}
/*$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");*/
$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc limit 1"));
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time desc limit 1"));
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");
$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$viewss1[3]'"));
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1 and status_approve!=2 order by id desc"));
$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$newdateval' and status=1 and status_approve!=2 order by id desc"));
$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));
/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));

$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2'  && $leave_test[2]!='7')
	
	{
		//if(strtotime($today_date)>strtotime($newdateval))
		//{	
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>Leave";
			if($first_half)
				{
				echo "($first_half)";
				}
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
					}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]"; 
				if($first_half)
				{
				echo "($first_half)";
				}
				}
			}
		echo "</b></div>";	
		}
		else
		{
			if(strtotime($today_date)>strtotime($newdateval))
				{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
				}
		}
		
		
		$status_find=0;
		//}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($newdateval) && $leave_test[2]!='7')
	{
		if(strtotime($today_date)>strtotime($newdateval))
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
			{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
			}
			else
			{
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
			}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
				if(strtotime($viewss1[j_date])>strtotime($newdateval))
				{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
				}
				else
				{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				}
			}
			$status_find=0;
			
		}
	}
	//leave 
	else
	//if(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2'  && $leave_test[2]!='7')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if(strtotime($leave_test[7])==strtotime($newdateval))
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
		if(strtotime($leave_test[8]==$newdateval) && strtotime($leave_test[7])!=strtotime($leave_test[8]))
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
//leave vac
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//Absent approval stage(its in same in default stage)
		$satff_absent_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//default approval stage
		$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
if(strtotime($today_date)>strtotime($newdateval))
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

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(mysql_num_rows($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(mysql_num_rows($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(mysql_num_rows($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(mysql_num_rows($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(mysql_num_rows($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(mysql_num_rows($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$viewss1[3];
$intime_staff='';
$outtime_staff='';
$totaltime='';
$intime_staff = strtotime($staff_time_attt_in[0]);
$outtime_staff = strtotime($staff_time_attt_out[0]);

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
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1])  && $leave_tqd!=1)
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
					}
					//end/////	
?>
									</td>
									<?php									
							   }
							   if($das[0]=='Tue')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
											$newbgcolor='class="clsna"';	
								   			else
								   		 	$newbgcolor='class="colrs"';													
								   ?>
									<td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">
									<div Align="center" >
<?php
$newdateval1="$yr-$mont-$i";
	if(strtotime($newdateval1) > strtotime($datefixs))
	{
	?>
								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a>
                                
                                <?php
	}
	else
	{
	?> 
	<font color="<?php echo $bgcolor; ?>"><?php echo $i?></font>
	<?php
	}
	?>
                                </div>	<br>
									<?php
	$newdateval="$yr-$mont-$i";
	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	
if(strtotime($newdateval) > strtotime($datefixs))
					{
								///code start///
								
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$newdateval' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			$special_date=1;
			$in_timeview="09:00";
			$out_timeview="17:00";
			$specl_con_out='';
		}
/*$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");*/
$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc limit 1"));
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time desc limit 1"));
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");
$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$viewss1[3]'"));
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1 and status_approve!=2 order by id desc"));
$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$newdateval' and status=1 and status_approve!=2 order by id desc"));
$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));
/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));

$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2'  && $leave_test[2]!='7')
	
	{
		//if(strtotime($today_date)>strtotime($newdateval))
		//{	
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>Leave";
			if($first_half)
				{
				echo "($first_half)";
				}
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
					}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]"; 
				if($first_half)
				{
				echo "($first_half)";
				}
				}
			}
		echo "</b></div>";	
		}
		else
		{
			if(strtotime($today_date)>strtotime($newdateval))
				{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
				}
		}
		
		
		$status_find=0;
		//}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($newdateval) && $leave_test[2]!='7')
	{
		if(strtotime($today_date)>strtotime($newdateval))
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
			{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
			}
			else
			{
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
			}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
				if(strtotime($viewss1[j_date])>strtotime($newdateval))
				{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
				}
				else
				{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				}
			}
			$status_find=0;
			
		}
	}
	//leave 
	else
	//if(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2'  && $leave_test[2]!='7')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if(strtotime($leave_test[7])==strtotime($newdateval))
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
		if(strtotime($leave_test[8]==$newdateval) && strtotime($leave_test[7])!=strtotime($leave_test[8]))
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
//leave vac
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//Absent approval stage(its in same in default stage)
		$satff_absent_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//default approval stage
		$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
if(strtotime($today_date)>strtotime($newdateval))
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

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(mysql_num_rows($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(mysql_num_rows($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(mysql_num_rows($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(mysql_num_rows($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(mysql_num_rows($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(mysql_num_rows($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$viewss1[3];

$intime_staff='';
$outtime_staff='';
$totaltime='';
$intime_staff = strtotime($staff_time_attt_in[0]);
$outtime_staff = strtotime($staff_time_attt_out[0]);

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
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1])  && $leave_tqd!=1)
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
					}
					//end/////	
									?>
									</td>
									<?php
									
							   }
							   if($das[0]=='Wed')
							   {
										 $bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="clsna"';	
								   			else
								   		 	$newbgcolor='class="colrs"';
											
								   ?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">
									<div Align="center" >
<?php
$newdateval1="$yr-$mont-$i";
	if(strtotime($newdateval1) > strtotime($datefixs))
	{
	?>
								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a>
                                
                                <?php
	}
	else
	{
	?> 
	<font color="<?php echo $bgcolor; ?>"><?php echo $i?></font>
	<?php
	}
	?>
                                </div><br>									
									<?php
$newdateval="$yr-$mont-$i";
	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
if(strtotime($newdateval) > strtotime($datefixs))
					{	
								
								///code start///
								
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$newdateval' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			$special_date=1;
			$in_timeview="09:00";
			$out_timeview="17:00";
			$specl_con_out='';
		}
/*$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");*/
$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc limit 1"));
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time desc limit 1"));
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");
$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$viewss1[3]'"));
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1 and status_approve!=2 order by id desc"));
$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$newdateval' and status=1 and status_approve!=2 order by id desc"));
$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));
/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));

$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2'  && $leave_test[2]!='7')
	
	{
		//if(strtotime($today_date)>strtotime($newdateval))
		//{	
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>Leave";
			if($first_half)
				{
				echo "($first_half)";
				}
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
					}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]"; 
				if($first_half)
				{
				echo "($first_half)";
				}
				}
			}
		echo "</b></div>";	
		}
		else
		{
			if(strtotime($today_date)>strtotime($newdateval))
				{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
				}
		}
		
		
		$status_find=0;
		//}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($newdateval) && $leave_test[2]!='7')
	{
		if(strtotime($today_date)>strtotime($newdateval))
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
			{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
			}
			else
			{
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
			}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
				if(strtotime($viewss1[j_date])>strtotime($newdateval))
				{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
				}
				else
				{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				}
			}
			$status_find=0;
			
		}
	}
	//leave 
	else
	//if(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2'  && $leave_test[2]!='7')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if(strtotime($leave_test[7])==strtotime($newdateval))
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
		if(strtotime($leave_test[8]==$newdateval) && strtotime($leave_test[7])!=strtotime($leave_test[8]))
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
//leave vac
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//Absent approval stage(its in same in default stage)
		$satff_absent_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//default approval stage
		$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
if(strtotime($today_date)>strtotime($newdateval))
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

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(mysql_num_rows($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(mysql_num_rows($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(mysql_num_rows($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(mysql_num_rows($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(mysql_num_rows($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(mysql_num_rows($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$viewss1[3];
$intime_staff='';
$outtime_staff='';
$totaltime='';
$intime_staff = strtotime($staff_time_attt_in[0]);
$outtime_staff = strtotime($staff_time_attt_out[0]);

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
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1])  && $leave_tqd!=1)
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
					}
					//end/////	
								
								echo "</td>";
							   }
								if($das[0]=='Thu')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="clsna"';	
								   			else
								   		 	$newbgcolor='class="colrs"';
																						
								   ?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">
									<div Align="center" >
<?php
$newdateval1="$yr-$mont-$i";
	if(strtotime($newdateval1) > strtotime($datefixs))
	{
	?>
								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a>
   <?php
	}
	else
	{
	?> 
	<font color="<?php echo $bgcolor; ?>"><?php echo $i?></font>
	<?php
	}
	?>                             
              </div>                  
                                <br>									
									<?php
							$newdateval="$yr-$mont-$i";
	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	
if(strtotime($newdateval) > strtotime($datefixs))
					{
								
								///code start///
								
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$newdateval' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			$special_date=1;
			$in_timeview="09:00";
			$out_timeview="17:00";
			$specl_con_out='';
		}
/*$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");*/
$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc limit 1"));
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time desc limit 1"));
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");
$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$viewss1[3]'"));
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1 and status_approve!=2 order by id desc"));
$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$newdateval' and status=1 and status_approve!=2 order by id desc"));
$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));
/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));

$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2'  && $leave_test[2]!='7')
	
	{
		//if(strtotime($today_date)>strtotime($newdateval))
		//{	
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>Leave";
			if($first_half)
				{
				echo "($first_half)";
				}
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
					}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]"; 
				if($first_half)
				{
				echo "($first_half)";
				}
				}
			}
		echo "</b></div>";	
		}
		else
		{
			if(strtotime($today_date)>strtotime($newdateval))
				{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
				}
		}
		
		
		$status_find=0;
		//}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($newdateval) && $leave_test[2]!='7')
	{
		if(strtotime($today_date)>strtotime($newdateval))
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
			{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
			}
			else
			{
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
			}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
				if(strtotime($viewss1[j_date])>strtotime($newdateval))
				{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
				}
				else
				{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				}
			}
			$status_find=0;
			
		}
	}
	//leave 
	else
	//if(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2'  && $leave_test[2]!='7')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if(strtotime($leave_test[7])==strtotime($newdateval))
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
		if(strtotime($leave_test[8]==$newdateval) && strtotime($leave_test[7])!=strtotime($leave_test[8]))
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
//leave vac
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//Absent approval stage(its in same in default stage)
		$satff_absent_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//default approval stage
		$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
if(strtotime($today_date)>strtotime($newdateval))
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

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(mysql_num_rows($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(mysql_num_rows($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(mysql_num_rows($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(mysql_num_rows($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(mysql_num_rows($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(mysql_num_rows($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$viewss1[3];

$intime_staff='';
$outtime_staff='';
$totaltime='';
$intime_staff = strtotime($staff_time_attt_in[0]);
$outtime_staff = strtotime($staff_time_attt_out[0]);

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
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1])  && $leave_tqd!=1)
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
					}
								//end/////	
								
								echo "</td>";
							   }
							 if($das[0]=='Fri')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   		$newbgcolor='class="clsna"';	
								   			else
								   		 	$newbgcolor='class="colrs"';
											
										
								   ?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">
									<div Align="center" >
<?php
$newdateval1="$yr-$mont-$i";
	if(strtotime($newdateval1) > strtotime($datefixs))
	{
	?>
								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a>
    <?php
	}
	else
	{
	?> 
	<font color="<?php echo $bgcolor; ?>"><?php echo $i?></font>
	<?php
	}
	?>                            
                                </div>
                                
                                <br>								
									<?php
								$newdateval="$yr-$mont-$i";
	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	
if(strtotime($newdateval) > strtotime($datefixs))
					{
								///code start///
								
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$newdateval' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			$special_date=1;
			$in_timeview="09:00";
			$out_timeview="17:00";
			$specl_con_out='';
		}
/*$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");*/
$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc limit 1"));
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time desc limit 1"));
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");
$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$viewss1[3]'"));
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1 and status_approve!=2 order by id desc"));
$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$newdateval' and status=1 and status_approve!=2 order by id desc"));
$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));
/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));

$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2'  && $leave_test[2]!='7')
	
	{
		//if(strtotime($today_date)>strtotime($newdateval))
		//{	
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>Leave";
			if($first_half)
				{
				echo "($first_half)";
				}
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
					}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]"; 
				if($first_half)
				{
				echo "($first_half)";
				}
				}
			}
		echo "</b></div>";	
		}
		else
		{
			if(strtotime($today_date)>strtotime($newdateval))
				{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
				}
		}
		
		
		$status_find=0;
		//}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($newdateval) && $leave_test[2]!='7')
	{
		if(strtotime($today_date)>strtotime($newdateval))
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
			{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
			}
			else
			{
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
			}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
				if(strtotime($viewss1[j_date])>strtotime($newdateval))
				{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
				}
				else
				{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				}
			}
			$status_find=0;
			
		}
	}
	//leave 
	else
	//if(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2'  && $leave_test[2]!='7')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if(strtotime($leave_test[7])==strtotime($newdateval))
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
		if(strtotime($leave_test[8]==$newdateval) && strtotime($leave_test[7])!=strtotime($leave_test[8]))
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
//leave vac
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//Absent approval stage(its in same in default stage)
		$satff_absent_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//default approval stage
		$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
if(strtotime($today_date)>strtotime($newdateval))
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

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(mysql_num_rows($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(mysql_num_rows($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(mysql_num_rows($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(mysql_num_rows($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(mysql_num_rows($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(mysql_num_rows($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$viewss1[3];
$intime_staff='';
$outtime_staff='';
$totaltime='';
$intime_staff = strtotime($staff_time_attt_in[0]);
$outtime_staff = strtotime($staff_time_attt_out[0]);

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
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1])  && $leave_tqd!=1)
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
					}//end/////	
								
								echo "</td>";
							   }
								if($das[0]=='Sat')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="clsna"';	
								   			else
								   		 	$newbgcolor='class="colrs"';
																					
								   
								   ?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td  <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">
									<div Align="center" >
<?php
$newdateval1="$yr-$mont-$i";
	if(strtotime($newdateval1) > strtotime($datefixs))
	{
	?>
								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a>
                                <?php
	}
	else
	{
	?> 
	<font color="<?php echo $bgcolor; ?>"><?php echo $i?></font>
	<?php
	}
	?>
                                </div><br>
									<?php
$newdateval="$yr-$mont-$i";
	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	
	if(strtotime($newdateval) > strtotime($datefixs))
					{
								///code start///
								
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$newdateval' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			$special_date=1;
			$in_timeview="09:00";
			$out_timeview="17:00";
			$specl_con_out='';
		}
/*$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");*/
$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc limit 1"));
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time desc limit 1"));
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");
$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$viewss1[3]'"));
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1 and status_approve!=2 order by id desc"));
$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$newdateval' and status=1 and status_approve!=2 order by id desc"));
$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));
/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));

$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2'  && $leave_test[2]!='7')
	
	{
		//if(strtotime($today_date)>strtotime($newdateval))
		//{	
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>Leave";
			if($first_half)
				{
				echo "($first_half)";
				}
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
					}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]"; 
				if($first_half)
				{
				echo "($first_half)";
				}
				}
			}
		echo "</b></div>";	
		}
		else
		{
			if(strtotime($today_date)>strtotime($newdateval))
				{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
				}
		}
		
		
		$status_find=0;
		//}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($newdateval) && $leave_test[2]!='7')
	{
		if(strtotime($today_date)>strtotime($newdateval))
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
			{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
			}
			else
			{
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
			}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
				if(strtotime($viewss1[j_date])>strtotime($newdateval))
				{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
				}
				else
				{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				}
			}
			$status_find=0;
			
		}
	}
	//leave 
	else
	//if(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2'  && $leave_test[2]!='7')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if(strtotime($leave_test[7])==strtotime($newdateval))
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
		if(strtotime($leave_test[8]==$newdateval) && strtotime($leave_test[7])!=strtotime($leave_test[8]))
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
//leave vac
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//Absent approval stage(its in same in default stage)
		$satff_absent_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//default approval stage
		$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
if(strtotime($today_date)>strtotime($newdateval))
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

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(mysql_num_rows($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(mysql_num_rows($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(mysql_num_rows($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(mysql_num_rows($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(mysql_num_rows($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(mysql_num_rows($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$viewss1[3];
$intime_staff='';
$outtime_staff='';
$totaltime='';
$intime_staff = strtotime($staff_time_attt_in[0]);
$outtime_staff = strtotime($staff_time_attt_out[0]);

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
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1])  && $leave_tqd!=1)
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
					}//end/////	
								
								echo "</td>";
							   }
						   }
						   else
						   {
							   if($das[0]=='Sun')
							   {
								   ?><tr><?php
								   $bgcolor='red';
							   }
							   else
									$bgcolor='';
												
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   	$newbgcolor='class="clsna"';	
								   			else
								   		 	$newbgcolor='class="colrs"';
										
																					
							   ?>
								<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81"><div Align="center" >
<?php
$newdateval1="$yr-$mont-$i";
	if(strtotime($newdateval1) > strtotime($datefixs))
	{
	?>
								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a>
                                
                                <?php
	}
	else
	{
	?> 
	<font color="<?php echo $bgcolor; ?>"><?php echo $i?></font>
	<?php
	}
	?>
                                </div>
								<br>
								<?php
	$newdateval="$yr-$mont-$i";
	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	
if(strtotime($newdateval) > strtotime($datefixs))
					{
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$newdateval' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			$special_date=1;
			$in_timeview="09:00";
			$out_timeview="17:00";
			$specl_con_out='';
		}
/*$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");*/
$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc limit 1"));
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time desc limit 1"));
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time asc ");
$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}
$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$viewss1[3]'"));
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1 and status_approve!=2 order by id desc"));
$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$newdateval' and status=1 and status_approve!=2 order by id desc"));
$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));
/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));

$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2'  && $leave_test[2]!='7')
	
	{
		//if(strtotime($today_date)>strtotime($newdateval))
		//{	
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>Leave";
			if($first_half)
				{
				echo "($first_half)";
				}
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
			elseif(strtotime($leave_test[7])==strtotime($newdateval))
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
			elseif(strtotime($leave_test[8])==strtotime($newdateval))
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
			if(strtotime($staff_calender[0])==strtotime($newdateval))
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
					}
			}
			elseif($viewdate_sunday=='Sun')
			{
				if(strtotime($today_date)>strtotime($newdateval))
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
				}
			}
			else
			{
				if(strtotime($today_date)>strtotime($newdateval))
				{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]"; 
				if($first_half)
				{
				echo "($first_half)";
				}
				}
			}
		echo "</b></div>";	
		}
		else
		{
			if(strtotime($today_date)>strtotime($newdateval))
				{
			echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
				}
		}
		
		
		$status_find=0;
		//}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($newdateval) && $leave_test[2]!='7')
	{
		if(strtotime($today_date)>strtotime($newdateval))
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
			{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
			}
			else
			{
			echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
			$status_find=0;
			}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
				if(strtotime($viewss1[j_date])>strtotime($newdateval))
				{	
				echo "<div align='center' style='color:#F00'><b>NA</b></div>";
				$status_find=0;
				}
				else
				{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				}
			}
			$status_find=0;
			
		}
	}
	//leave 
	else
	//if(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2'  && $leave_test[2]!='7')
		{		
			
		/////////start//////	
		$date_corrects=1;
		//from date in FHL or SHL
		if(strtotime($leave_test[7])==strtotime($newdateval))
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
		if(strtotime($leave_test[8]==$newdateval) && strtotime($leave_test[7])!=strtotime($leave_test[8]))
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
//leave vac
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//Absent approval stage(its in same in default stage)
		$satff_absent_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
		if(strtotime($viewss1[j_date])>strtotime($newdateval))
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
	if(strtotime($today_date)>strtotime($newdateval))
	{
		//default approval stage
		$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$viewss1[4]' and status=1 and d_date='$newdateval'"));
		
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
if(strtotime($today_date)>strtotime($newdateval))
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

$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(mysql_num_rows($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(mysql_num_rows($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(mysql_num_rows($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(mysql_num_rows($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(mysql_num_rows($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing where staff_type='$viewss1[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(mysql_num_rows($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
//special day
if($special_date)
{
	$leave_staff_diffrence_plc1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$viewss1[3]' and staff_time_type='1'");
$leave_staff_diffrence_plc=fetcharray($leave_staff_diffrence_plc1);
if(rowcount($leave_staff_diffrence_plc1)<1)
{
	$leave_plc=1;
}

 $leave_staff_diffrence_pqd1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$viewss1[3]' and staff_time_type='2'");
$leave_staff_diffrence_pqd=fetcharray($leave_staff_diffrence_pqd1);
if(rowcount($leave_staff_diffrence_pqd1)<1)
{
	$leave_pqd=1;	
}

 
 $leave_staff_diffrence_fhl1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$viewss1[3]' and staff_time_type='3'");
$leave_staff_diffrence_fhl=fetcharray($leave_staff_diffrence_fhl1);
if(rowcount($leave_staff_diffrence_fhl1)<1)
{
	$leave_fhl=1;
}

 $leave_staff_diffrence_shl1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$viewss1[3]' and staff_time_type='4'");
$leave_staff_diffrence_shl=fetcharray($leave_staff_diffrence_shl1);
if(rowcount($leave_staff_diffrence_shl1)<1)
{
	$leave_shl=1;
}

 $leave_staff_diffrence_tqd1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$viewss1[3]' and staff_time_type='5'");
$leave_staff_diffrence_tqd=fetcharray($leave_staff_diffrence_tqd1);
if(rowcount($leave_staff_diffrence_tqd1)<1)
{
	$leave_tqd=1;
}

 $leave_staff_diffrence_ee1=execute("select time_in,time_out from leave_staff_timing_special where staff_type='$viewss1[3]' and staff_time_type='6'");
$leave_staff_diffrence_ee=fetcharray($leave_staff_diffrence_ee1);
if(rowcount($leave_staff_diffrence_ee1)<1)
{
	$leave_ee=1;
}
}
//end
//echo "<br>".$staff_time_attt_in[0];
//echo "<br>".$staff_time_attt_out[0];
//echo "<br>".$viewss1[3];
$intime_staff='';
$outtime_staff='';
$totaltime='';
$intime_staff = strtotime($staff_time_attt_in[0]);
$outtime_staff = strtotime($staff_time_attt_out[0]);

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
/*elseif($special_date)
{
	echo "<div align='center' style='color:#CC6600' title='Special day'><b>P </b></div>";	
}*/
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
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_tqd[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_tqd[1])  && $leave_tqd!=1)
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
								//end/////	
					}
								echo "</td>";						   
								}
				  }
				$toc=$das[0];
				if($toc=='Sun')
				$countnum=6;
				elseif($toc=='Mon')
				$countnum=5;
				elseif($toc=='Tue')
				$countnum=4;
				elseif($toc=='Wed')
				$countnum=3;
				elseif($toc=='Thu')
				$countnum=2;
				elseif($toc=='Fri')
				$countnum=1;
				else
				$countnum=0;
				
				for($k=0;$k<$countnum;$k++)
				{
					echo "<td>&nbsp;</td>";
				}
				
				?>
				
			</table>
	</form>
	<?php
	function MonthName($mont)
{
        if($mont == 1) return("January");
        if($mont == 2) return("February");
        if($mont == 3) return("March");
        if($mont == 4) return("April");
        if($mont == 5) return("May");
        if($mont == 6) return("June");
        if($mont == 7) return("July");
        if($mont == 8) return("August");
        if($mont == 9) return("September");
        if($mont == 10) return("October");
        if($mont == 11) return("November");
        if($mont == 12) return("December");
}
?>
</table>
</body>
</html>
