<?php

	include("../db.php");
	$user=$_SESSION['user'];
	$today_date=date("Y-m-d");
	$yr=date("Y");

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

  document.frm.action='staff_feb2.php';

  document.frm.submit();

}

</script>

</head>

<body>



<form name='frm' method='post' action=''>

<input type='hidden' name='day' value='<?php echo $day?>'>

<input type='hidden' name='yer' value='<?php echo $yr?>'>

<link rel="stylesheet" type="text/css" href="css/tab.css" />
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">

<div class="tabContainer">

<ul class="tabHead">

<li><a href="leavesetup.php?tab=1" >Leave Setup</a></li>

<li><a href="leavestaffsetup.php?tab=2" >Staff Leave Detail</a></li>

<li class="currentBtn"><a href="staff_calnd.php?tab=3" >Staff Calendar</a></li>

<li><a href="staff_time.php?tab=4" >Staff Timing</a></li>
<li><a href="att_point.php?tab=5" >Attendance Point</a></li>
</ul>

</div>

</div>

<?php
$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));

$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));

$staffif=trim($staffrfid[0]);
?>
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

								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div><br>	

									<?php

			$newdateval="$yr-$mont-$i";
			
			$attview = mktime(0,0,0,$mont,$i,$yr);
			
			$viewdate_sunday=date("D", $attview);

								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1"));

$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));

/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$status_find=1;
//school holiday
	if(strtotime($staff_calender[0])==strtotime($newdateval))
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
			$status_find=0;
			
		}
	}
	//manger updated att
	elseif($updated_att_staff[0])
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if(strtotime($today_date)>strtotime($newdateval))
		{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] </b></div>";	
		
		
		$status_find=0;
		}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
			$status_find=0;
			
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]=='1' && $leave_test[4]!='2')
		{		
			echo "<div align='center' style='color:#060'><b>Paid Leave </b></div>";
			$status_find=0;
		 
		}
		//leave without pay
		elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]!='2')
		{
			echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
			$status_find=0;
		
		}
		//withdrawn
		elseif($leave_test[4]=='2')
		{
			//withdrawn pending so its go to leave (paid leave) 
			if($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
			echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
			$status_find=0;
			
			}//withdrawn is rejected (Paid leave) 
			elseif($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
				$status_find=0;
				
			}		
			//withdrawn pending so its go to leave (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
			//withdrawnis rejected (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
			
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{	
		echo "<div align='center' style='color:#F00'><b>A</b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default</b></div>";	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($newdateval))
	{
				
//$staff_in_time='';

if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
		echo "<div align='center' style='color:#060'><b>AM : P</b></div>";
		$staff_working=$point_five+$staff_working;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) <= strtotime($fhl_staff))
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC)</b></div>";
		
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>AM : FHL</b></div>";
	}
	
	//staff_out_time
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		echo "<div align='center' style='color:#060'><b>PM : P</b></div>";
		
	}
	elseif(strtotime($staff_time_attt_out[0]) <= strtotime($shl_staff))
	{
		echo "<div align='center' style='color:#300'><b>PM : SHL</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE)</b></div>";
		
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
	}
}
}


								
								//end/////	
								
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

								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div> <br>									

                          									<?php								

                                

								
     $newdateval="$yr-$mont-$i";

	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1"));

$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));

/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$status_find=1;
//school holiday
	if(strtotime($staff_calender[0])==strtotime($newdateval))
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
			$status_find=0;
			
		}
	}
	//manger updated att
	elseif($updated_att_staff[0])
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if(strtotime($today_date)>strtotime($newdateval))
		{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] </b></div>";	
		
		
		$status_find=0;
		}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
			$status_find=0;
			
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]=='1' && $leave_test[4]!='2')
		{		
			echo "<div align='center' style='color:#060'><b>Paid Leave </b></div>";
			$status_find=0;
		 
		}
		//leave without pay
		elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]!='2')
		{
			echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
			$status_find=0;
		
		}
		//withdrawn
		elseif($leave_test[4]=='2')
		{
			//withdrawn pending so its go to leave (paid leave) 
			if($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
			echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
			$status_find=0;
			
			}//withdrawn is rejected (Paid leave) 
			elseif($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
				$status_find=0;
				
			}		
			//withdrawn pending so its go to leave (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
			//withdrawnis rejected (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
			
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{	
		echo "<div align='center' style='color:#F00'><b>A</b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default</b></div>";	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($newdateval))
	{
				
//$staff_in_time='';

if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
		echo "<div align='center' style='color:#060'><b>AM : P</b></div>";
		$staff_working=$point_five+$staff_working;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) <= strtotime($fhl_staff))
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC)</b></div>";
		
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>AM : FHL</b></div>";
	}
	
	//staff_out_time
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		echo "<div align='center' style='color:#060'><b>PM : P</b></div>";
		
	}
	elseif(strtotime($staff_time_attt_out[0]) <= strtotime($shl_staff))
	{
		echo "<div align='center' style='color:#300'><b>PM : SHL</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE)</b></div>";
		
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
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

								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div>	<br>

									<?php

	$newdateval="$yr-$mont-$i";

	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	

								
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1"));

$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));

/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$status_find=1;
//school holiday
	if(strtotime($staff_calender[0])==strtotime($newdateval))
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
			$status_find=0;
			
		}
	}
	//manger updated att
	elseif($updated_att_staff[0])
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if(strtotime($today_date)>strtotime($newdateval))
		{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] </b></div>";	
		
		
		$status_find=0;
		}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
			$status_find=0;
			
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]=='1' && $leave_test[4]!='2')
		{		
			echo "<div align='center' style='color:#060'><b>Paid Leave </b></div>";
			$status_find=0;
		 
		}
		//leave without pay
		elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]!='2')
		{
			echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
			$status_find=0;
		
		}
		//withdrawn
		elseif($leave_test[4]=='2')
		{
			//withdrawn pending so its go to leave (paid leave) 
			if($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
			echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
			$status_find=0;
			
			}//withdrawn is rejected (Paid leave) 
			elseif($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
				$status_find=0;
				
			}		
			//withdrawn pending so its go to leave (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
			//withdrawnis rejected (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
			
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{	
		echo "<div align='center' style='color:#F00'><b>A</b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default</b></div>";	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($newdateval))
	{
				
//$staff_in_time='';

if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
		echo "<div align='center' style='color:#060'><b>AM : P</b></div>";
		$staff_working=$point_five+$staff_working;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) <= strtotime($fhl_staff))
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC)</b></div>";
		
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>AM : FHL</b></div>";
	}
	
	//staff_out_time
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		echo "<div align='center' style='color:#060'><b>PM : P</b></div>";
		
	}
	elseif(strtotime($staff_time_attt_out[0]) <= strtotime($shl_staff))
	{
		echo "<div align='center' style='color:#300'><b>PM : SHL</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE)</b></div>";
		
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
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

								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div><br>									

									<?php
$newdateval="$yr-$mont-$i";

	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	

								
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1"));

$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));

/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$status_find=1;
//school holiday
	if(strtotime($staff_calender[0])==strtotime($newdateval))
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
			$status_find=0;
			
		}
	}
	//manger updated att
	elseif($updated_att_staff[0])
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if(strtotime($today_date)>strtotime($newdateval))
		{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] </b></div>";	
		
		
		$status_find=0;
		}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
			$status_find=0;
			
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]=='1' && $leave_test[4]!='2')
		{		
			echo "<div align='center' style='color:#060'><b>Paid Leave </b></div>";
			$status_find=0;
		 
		}
		//leave without pay
		elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]!='2')
		{
			echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
			$status_find=0;
		
		}
		//withdrawn
		elseif($leave_test[4]=='2')
		{
			//withdrawn pending so its go to leave (paid leave) 
			if($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
			echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
			$status_find=0;
			
			}//withdrawn is rejected (Paid leave) 
			elseif($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
				$status_find=0;
				
			}		
			//withdrawn pending so its go to leave (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
			//withdrawnis rejected (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
			
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{	
		echo "<div align='center' style='color:#F00'><b>A</b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default</b></div>";	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($newdateval))
	{
				
//$staff_in_time='';

if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
		echo "<div align='center' style='color:#060'><b>AM : P</b></div>";
		$staff_working=$point_five+$staff_working;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) <= strtotime($fhl_staff))
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC)</b></div>";
		
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>AM : FHL</b></div>";
	}
	
	//staff_out_time
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		echo "<div align='center' style='color:#060'><b>PM : P</b></div>";
		
	}
	elseif(strtotime($staff_time_attt_out[0]) <= strtotime($shl_staff))
	{
		echo "<div align='center' style='color:#300'><b>PM : SHL</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE)</b></div>";
		
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
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

								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div><br>									

									<?php

							$newdateval="$yr-$mont-$i";

	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	

								
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1"));

$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));

/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$status_find=1;
//school holiday
	if(strtotime($staff_calender[0])==strtotime($newdateval))
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
			$status_find=0;
			
		}
	}
	//manger updated att
	elseif($updated_att_staff[0])
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if(strtotime($today_date)>strtotime($newdateval))
		{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] </b></div>";	
		
		
		$status_find=0;
		}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
			$status_find=0;
			
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]=='1' && $leave_test[4]!='2')
		{		
			echo "<div align='center' style='color:#060'><b>Paid Leave </b></div>";
			$status_find=0;
		 
		}
		//leave without pay
		elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]!='2')
		{
			echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
			$status_find=0;
		
		}
		//withdrawn
		elseif($leave_test[4]=='2')
		{
			//withdrawn pending so its go to leave (paid leave) 
			if($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
			echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
			$status_find=0;
			
			}//withdrawn is rejected (Paid leave) 
			elseif($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
				$status_find=0;
				
			}		
			//withdrawn pending so its go to leave (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
			//withdrawnis rejected (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
			
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{	
		echo "<div align='center' style='color:#F00'><b>A</b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default</b></div>";	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($newdateval))
	{
				
//$staff_in_time='';

if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
		echo "<div align='center' style='color:#060'><b>AM : P</b></div>";
		$staff_working=$point_five+$staff_working;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) <= strtotime($fhl_staff))
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC)</b></div>";
		
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>AM : FHL</b></div>";
	}
	
	//staff_out_time
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		echo "<div align='center' style='color:#060'><b>PM : P</b></div>";
		
	}
	elseif(strtotime($staff_time_attt_out[0]) <= strtotime($shl_staff))
	{
		echo "<div align='center' style='color:#300'><b>PM : SHL</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE)</b></div>";
		
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
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

								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div><br>								

									<?php

								$newdateval="$yr-$mont-$i";

	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	

								
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1"));

$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));

/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$status_find=1;
//school holiday
	if(strtotime($staff_calender[0])==strtotime($newdateval))
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
			$status_find=0;
			
		}
	}
	//manger updated att
	elseif($updated_att_staff[0])
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if(strtotime($today_date)>strtotime($newdateval))
		{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] </b></div>";	
		
		
		$status_find=0;
		}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
			$status_find=0;
			
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]=='1' && $leave_test[4]!='2')
		{		
			echo "<div align='center' style='color:#060'><b>Paid Leave </b></div>";
			$status_find=0;
		 
		}
		//leave without pay
		elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]!='2')
		{
			echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
			$status_find=0;
		
		}
		//withdrawn
		elseif($leave_test[4]=='2')
		{
			//withdrawn pending so its go to leave (paid leave) 
			if($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
			echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
			$status_find=0;
			
			}//withdrawn is rejected (Paid leave) 
			elseif($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
				$status_find=0;
				
			}		
			//withdrawn pending so its go to leave (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
			//withdrawnis rejected (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
			
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{	
		echo "<div align='center' style='color:#F00'><b>A</b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default</b></div>";	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($newdateval))
	{
				
//$staff_in_time='';

if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
		echo "<div align='center' style='color:#060'><b>AM : P</b></div>";
		$staff_working=$point_five+$staff_working;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) <= strtotime($fhl_staff))
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC)</b></div>";
		
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>AM : FHL</b></div>";
	}
	
	//staff_out_time
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		echo "<div align='center' style='color:#060'><b>PM : P</b></div>";
		
	}
	elseif(strtotime($staff_time_attt_out[0]) <= strtotime($shl_staff))
	{
		echo "<div align='center' style='color:#300'><b>PM : SHL</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE)</b></div>";
		
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
	}
}
}


								
								//end/////	
								
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

								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div><br>

									<?php



$newdateval="$yr-$mont-$i";

	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	

								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1"));

$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));

/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$status_find=1;
//school holiday
	if(strtotime($staff_calender[0])==strtotime($newdateval))
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
			$status_find=0;
			
		}
	}
	//manger updated att
	elseif($updated_att_staff[0])
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if(strtotime($today_date)>strtotime($newdateval))
		{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] </b></div>";	
		
		
		$status_find=0;
		}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
			$status_find=0;
			
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]=='1' && $leave_test[4]!='2')
		{		
			echo "<div align='center' style='color:#060'><b>Paid Leave </b></div>";
			$status_find=0;
		 
		}
		//leave without pay
		elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]!='2')
		{
			echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
			$status_find=0;
		
		}
		//withdrawn
		elseif($leave_test[4]=='2')
		{
			//withdrawn pending so its go to leave (paid leave) 
			if($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
			echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
			$status_find=0;
			
			}//withdrawn is rejected (Paid leave) 
			elseif($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
				$status_find=0;
				
			}		
			//withdrawn pending so its go to leave (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
			//withdrawnis rejected (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
			
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{	
		echo "<div align='center' style='color:#F00'><b>A</b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default</b></div>";	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($newdateval))
	{
				
//$staff_in_time='';

if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
		echo "<div align='center' style='color:#060'><b>AM : P</b></div>";
		$staff_working=$point_five+$staff_working;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) <= strtotime($fhl_staff))
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC)</b></div>";
		
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>AM : FHL</b></div>";
	}
	
	//staff_out_time
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		echo "<div align='center' style='color:#060'><b>PM : P</b></div>";
		
	}
	elseif(strtotime($staff_time_attt_out[0]) <= strtotime($shl_staff))
	{
		echo "<div align='center' style='color:#300'><b>PM : SHL</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE)</b></div>";
		
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
	}
}
}


								
								//end/////	
								
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

								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div>

								<br>

								<?php

	$newdateval="$yr-$mont-$i";

	$attview = mktime(0,0,0,$mont,$i,$yr);
	
	$viewdate_sunday=date("D", $attview);
	
								///code start///
								
								$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve from staff_leave where staff_id='$viewss1[4]' and ( '$newdateval' between f_date and t_date) and status=1"));

$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$viewss1[4]' and toddate='$newdateval'"));

/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$status_find=1;
//school holiday
	if(strtotime($staff_calender[0])==strtotime($newdateval))
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
			$status_find=0;
			
		}
	}
	//manger updated att
	elseif($updated_att_staff[0])
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			if(strtotime($today_date)>strtotime($newdateval))
		{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] </b></div>";	
		
		
		$status_find=0;
		}
		}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($newdateval))
		{
			echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
			$status_find=0;
			
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]=='1' && $leave_test[4]!='2')
		{		
			echo "<div align='center' style='color:#060'><b>Paid Leave </b></div>";
			$status_find=0;
		 
		}
		//leave without pay
		elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]!='2')
		{
			echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
			$status_find=0;
		
		}
		//withdrawn
		elseif($leave_test[4]=='2')
		{
			//withdrawn pending so its go to leave (paid leave) 
			if($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
			echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
			$status_find=0;
			
			}//withdrawn is rejected (Paid leave) 
			elseif($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#060'><b>Paid Leave</b></div>";
				$status_find=0;
				
			}		
			//withdrawn pending so its go to leave (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
			//withdrawnis rejected (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#F00'><b>LWP</b></div>";
				$status_find=0;
			}
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
			
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{	
		echo "<div align='center' style='color:#F00'><b>A</b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default</b></div>";	
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($newdateval))
	{
				
//$staff_in_time='';

if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
		echo "<div align='center' style='color:#060'><b>AM : P</b></div>";
		$staff_working=$point_five+$staff_working;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) <= strtotime($fhl_staff))
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC)</b></div>";
		
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>AM : FHL</b></div>";
	}
	
	//staff_out_time
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		echo "<div align='center' style='color:#060'><b>PM : P</b></div>";
		
	}
	elseif(strtotime($staff_time_attt_out[0]) <= strtotime($shl_staff))
	{
		echo "<div align='center' style='color:#300'><b>PM : SHL</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE)</b></div>";
		
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
	}
}
}


								
								//end/////	
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

