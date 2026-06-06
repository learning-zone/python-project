<?php
session_start();
include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$a_year=$_SESSION['AcademicYear'];

$time_in=$_POST['time_in'];
$time_out=$_POST['time_out'];
$reason=$_POST['reason'];

$leave_add=date('Y-m-d H:i:m');
$with_date_test=date('Y-m-d');
$ttimess=date('H:i:s');
$stafftime_val=strtotime('17:00');

//print_r($_POST);
	$todayDate=date("Y-m-d");
if($_REQUEST)
{
	$mon=$_REQUEST['mon'];
	$yer=$_REQUEST['yer'];
	$day=$_REQUEST['day'];
}
if($_POST)
{
	
	$mon=$_POST['mon'];
	$yer=$_POST['yer'];
	$day=$_POST['day'];
}

	$date1=date('Y-m-d H:i:m');

	$sysdate="$yer-$mon-$day";	
	$adate="$day/$mon/$yer";
	 $today_date=date("Y-m-d");
 $shl_staff='14:00:00';
$fhl_staff='12:00:00';
$newdateval="$yer-$mon-$day";

$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id,a.j_date from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));

		$stafftype=fetcharray(execute("select b.group_id,a.srid,b.f_name,b.s_name,b.slno from users a,staff_det b where   a.srid=b.id and a.username='$user'"));

$staff_id=$stafftype[1];

if($_POST['save'])
{
	$insersts=0;
	$Sql66=execute(" select id from staff_default where d_date='$sysdate' and staff_id='$staff_id' and status=1");
	if(mysql_num_rows($Sql66)>0)
	{
		$reason=mysql_real_escape_string("$reason");
		if(($time_in!='' || $time_out!='') && $reason!='') 
		{
			$insersts=1;
	$sql33="update staff_default set reason='$reason',user='$user',ins_date='$date1',time_in='$time_in',time_out='$time_out' where d_date='$sysdate' and staff_id='$staff_id' and status=1";
	execute($sql33);
		}
		else
		{
		?>
		<script language="javascript">
		alert("Please enter the In-Time/Out-Time and Reason");
		</script>	
		<?
		}
	}
	else
	{
		$reason=mysql_real_escape_string("$reason");
		if(($time_in!='' || $time_out!='') && $reason!='') 
		{
			$insersts=1;
	execute("INSERT INTO staff_default (staff_id, user, reason, d_date, time_in,time_out,ins_date,status) VALUES ( '$staff_id', '$user', '$reason','$sysdate', '$time_in', '$time_out','$date1','1')");
		}
		else
		{
			?>
			<script language="javascript">
			alert("Please enter the In-Time/Out-Time and Reason");
			</script>	
			<?
		}
	}
	if($insersts)
	{
	?>
		<script language="javascript">
        alert("Default Applied Sucessfully");
        </script>	
    <?
	}
}
?>
<html>
<title>View Staff Calendar - <?=$adate?></title>
<head>
<!----timecode---->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/datetimepicker.css" rel="stylesheet" media="screen">

<!---time_end--->	

<style>
.datetimepicker th.switch {
	color:#FFF;
}

.datetimepicker thead tr:first-child th:hover, .datetimepicker tfoot tr:first-child th:hover
{
	background:#FFF;
}

.icon-arrow-right {
    background-position: -264px -96px;
 display:none;
}
.icon-arrow-left {
    background-position: -240px -96px;
 display:none;
}
.today {
    color:#FFF;
}
</style>
</head>
<body>

<form name="frm"  method="post">
<input type="hidden" name="mon" value="<?=$mon?>"/>
<input type="hidden" name="yer" value="<?=$yer?>"/>
<input type="hidden" name="day" value="<?=$day?>"/>
<?php

$vwadtae=explode("/",$adate);

$vwadtae[0];

$vwadtae[1];

$vwadtae[2];

$vwadtae1=$vwadtae[2]."-".$vwadtae[1]."-".$vwadtae[0];

$temsql3=execute("select * from staff_calenders where status='1' and fromdate='$vwadtae1' and staff_typ='$stafftype[0]'");

if(mysql_num_rows($temsql3)>=1)

{	

?>

<br>

    <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">

  <tr>

	<td colspan="5" class="head" align="center">Calender Details</td>

	</tr>

  <tr>

    <td width="10%" align="center" class="rowpic">Sl.No.</td>

    <td align="center" class="rowpic">Title</td>

    <td align="center" class="rowpic">description</td>

    <td align="center" class="rowpic">Staff Type</td>

    <td align="center" class="rowpic">Date</td>

  </tr>

  <?

	$inc=1;

	

	while($r=fetcharray($temsql3))

	{

		$yrnamess =fetcharray(execute("select id,name from staff_group where status=1 and id='$r[staff_typ]'"));

		echo "

		<tr height='25'>

			<td align='center'>$inc</td>

			<td nowrap>&nbsp;&nbsp;

			$r[title]</td>

			<td align='left'>&nbsp;

			$r[description]</td>

			<td align='center' nowrap>$yrnamess[1]

			</td>

			<td align='center' nowrap>";

			echo date("d-m-Y",strtotime($r['fromdate']));

			echo "</td>

			</tr>";

  $inc++;

	}

}

?>

	</table>

<?php



$leavdet=execute("select * from staff_leave where  status='1' and staff_id='$stafftype[1]' and  ('$vwadtae1'  between f_date and t_date)");

if(mysql_num_rows($leavdet)>=1)

{	

?>

    <br>

     <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">

  <tr>

	<td colspan="8" class="head" align="center">Leave Details</td>

	</tr>

  <tr>

    <td width="10%" align="center" class="rowpic" nowrap>Name</td>

    <td align="center" class="rowpic" nowrap>From Date</td>

    <td align="center" class="rowpic" nowrap>To Date</td>

    <td align="center" class="rowpic" nowrap>Leave Type</td>

    <td align="center" class="rowpic" nowrap>Days</td>

    <td align="center" class="rowpic" nowrap>Reason</td>

    <td align="center" class="rowpic" nowrap>Backup Resource</td>

        <td align="center" class="rowpic" nowrap>Status</td>



  </tr>

  <?php

  while($leavdet1=fetcharray($leavdet))

	{

				$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leavdet1[type]'"));

		

		$tfdate1=explode('-',$leavdet1[f_date]);

		$fdate1=$tfdate1[2]."-".$tfdate1[1]."-".$tfdate1[0];

		$ttdate1=explode('-',$leavdet1[t_date]);

		$tdate1=$ttdate1[2]."-".$ttdate1[1]."-".$ttdate1[0];





		?>

  <tr>

    <td align="left"  nowrap>&nbsp;<?=$stafftype[2]?><?=$stafftype[3]?></td>

    <td align="center"  nowrap><?=$fdate1?></td>

    <td align="center"  nowrap><?=$tdate1?></td>

    <td align="center"  nowrap><?=$staflavty[leave_name]?></td>

    <td align="center"  nowrap><?=$leavdet1[days]?></td>

    <td align="justify" ><?=$leavdet1[reason]?></td>

    <td align="center"  nowrap><?=$leavdet1[backup]?></td>

    	<?php

    if($leavdet1[approved]=='1' && $leavdet1[status_approve]!='2')

    {

    ?>

    <td align="center" ><font color="#009900"><b>Approved</b></font></td>

    <?php

    }

    ?>

    <?php

    if($leavdet1[reject]==1 && $leavdet1[status_approve]!='2')

    {

    ?>

    <td align="center" ><font color="#FF0000"><b>Rejected</b></font></td>

    <?php

    }

    ?>

    <?php

    if($leavdet1[reject]=='0' && $leavdet1[approved]=='0'  && $leavdet1[status_approve]!='2')

    {

    ?>

    <td align="center"><font color="#0000FF"><b>Pending</b></font></td>

    <?php

    }

    ?>
	<?php

    if($leavdet1[status_approve]=='2')

    {

    ?>

    <td align="center"><font color="#FF6600"><b>Withdrawn</b></font></td>

    <?php

    }

    ?>



  </tr>

        <?

		

	}

}

?>

  </table>

<br>
<?php
$allvalues=fetcharray(execute(" select * from staff_default where d_date='$sysdate' and staff_id='$staff_id' and status=1"));

$reason=$allvalues['reason'];
$time_in=$allvalues['time_in'];
$time_out=$allvalues['time_out'];

$edit_test=1;
$testin=1;
$testout=1;
$full_edit=1;
if($time_in=='' && $time_out=='')
{
$edit_test=0;
}

if($time_in!='' && $time_out!='')
{
$full_edit=0;
}

if($time_in=='' && $time_out!='')
{
$timeout=0;
}

if($time_in!='' && $time_out=='')
{
$testin=0;
}

?>
<?php
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$stafftype[1]'"));

$staffif=trim($staffrfid[0]);

$absent_test=0;

			$newdateval="$yer-$mon-$day";
			
			$attview = mktime(0,0,0,$mon,$day,$yer);
			
			$viewdate_sunday=date("D", $attview);

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

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));

/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/
$status_find=1;

//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2')
	
	{
		//if(strtotime($today_date)>strtotime($newdateval))
		//{	
			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		if($updated_att_staff[0]==1 && $updated_att_staff[1]!='0' && $leave_test[1]!=1 && $leave_od_ee[1]!=1)
		{
		}
		elseif($updated_att_staff[0]!=1 && $updated_att_staff[1]!='0' && $leave_test[1]!=1 && $leave_od_ee[1]!=1)
		{
		
		}
		else
		{
			
		}
		
		
		$status_find=0;
		//}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($newdateval))
	{
		if($viewdate_sunday=='Sat')
		{
			$status_find=0;
			
		}
		else
		{
			$status_find=0;
		}
		if($leave_test[2]==3)
				{
					$status_find=0;
				
				}
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		//if(strtotime($today_date)>strtotime($newdateval))
		//{
			$status_find=0;
			
		//}
	}
	//leave 
	else
	//if(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2')
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
				}
				else
				{
				}
		
			}
			else
			{
				if($leave_test[2]==3)
				{
				}
				else
				{
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
				}
				else
				{
				}
			
			}
			else
			{
				if($leave_test[2]==3)
				{
				}
				else
				{
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
				}
				else
				{
				}
		
		}
					
			$status_find=0;
		//end///////////
		}
		//od
		if($leave_od_ee[2]=='6' && $leave_od_ee[0]=='1' && $leave_od_ee[4]!='2')
		{
			$status_find=0;
		}
		//EE
		if($leave_od_ee[2]=='EE'  && $leave_od_ee[0]=='1' && $leave_od_ee[4]!='2')
		{
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
		}
		elseif($staff_absent_sts[1]=='1')
		{
		}
		else
		{	
			if(strtotime($viewss1[j_date])>strtotime($newdateval))
			{	
			}
			elseif(!$staffif)
			{
			}
			else
			{
						$absent_test=1;
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
		
		}
		elseif($staff_default_sts[1]=='1')
		{
		}
		else
		{
		$absent_test=1;
		}
	}
}
elseif($count>'1')
{
if(strtotime($today_date)>strtotime($newdateval))
	{
$morng_present=0;
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
$absent_test='1';
}
elseif(strtotime($totspent)<=$hoursdiff2)
{
$absent_test='1';
}
/*elseif($special_date)
{
		
}*/
else
{	
if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{
				$morng_present=1;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_plc[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_plc[1]))
	{
		$morng_present=0;
	}
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_pqd[0]) && strtotime($staff_time_attt_in[0]) <= strtotime($leave_staff_diffrence_pqd[1]))
	{
		$morng_present=0;		
	}
	elseif(strtotime($staff_time_attt_in[0]) >= strtotime($leave_staff_diffrence_fhl[0]))
	{
		$morng_present=0;

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
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_ee[0]) && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_ee[1]))
	{
		$ee_valid=2;
		$eve_present=0;
	}
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_shl[0])  && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_shl[1]))
	{
		$shl_valid=2;
		$eve_present=0;

	}
	elseif(strtotime($staff_time_attt_out[0]) < strtotime($leave_staff_diffrence_shl[0]))
	{
		$shl_valid=2;
		$eve_present=0;

	}
		if($eve_present=='1' && $morng_present=='1')
		{
		}
}
		$ee_valid='';
		$plc_valid='';
	}
}
}




								
								//end/////	
								
								   ?>
     <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">


 <tr>
    
    <td align="center" colspan="10" class="head" nowrap="nowrap"><b><?=$adate?></b></td>
    </tr>
    <tr>
    
    <td align="center" class="head" nowrap="nowrap">Staff Code</td>
    
    <td align="center" class="head" nowrap="nowrap">Staff Name</td>
    
    <td align="center" class="head" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
    
    <td align="center" class="head" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Edit IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    
    <td align="center" class="head" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
    
    <td align="center" class="head" nowrap="nowrap">Edit OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Time Spent</td>
    
    <td align="center" class="head" nowrap="nowrap">Status</td>
    
    </tr>

<?

		$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$stafftype[1]'"));

$staffif=trim($staffrfid[0]);

$count2=0;

$testcount3=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc ");
while($testcountss=fetcharray($testcount3))
{
	++$count2;
}




  ?>

  <tr>

    <td align="center"  nowrap="nowrap"><?=$stafftype[4]?></td>

    <td align="left"  nowrap="nowrap">&nbsp;<?=$stafftype[2]?><?=$stafftype[3]?></td>

    <td align="center"  nowrap="nowrap">
    
    <?php
			$newdateval="$yer-$mon-$day";
			
			$attview = mktime(0,0,0,$mon,$day,$yer);
			
			$viewdate_sunday=date("D", $attview);

	
		$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]'  order by att_time asc limit 1"));

		$acintime1='';
		$acintime2='';
		$acouttime1='';
		$acouttime2='';
		
		
		$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time asc limit 1"));

$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' group by att_time order by att_time desc limit 1"));

/*if(strtotime($staff_time_attt_in[0])==strtotime($staff_time_attt_out[0]))
{
	$staff_time_attt_out[0]='';
}*/
$specl_con='1';
$special_date='';
$staff_time_check_special=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$newdateval' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special)>0)
		{
			echo $in_timeview="09:00";
			$specl_con='';
			$special_date=1;
		}

if($specl_con)
{

       $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
$in_timeview='';	
$out_timeview='';
$special_date=0;
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
		$special_date=0;
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
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

    <td align="center"  nowrap="nowrap">

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
<td align="center"  nowrap="nowrap">
	<?php
    if($absent_test=='1')
{
	
    //"Default";
    if(strtotime($today_date)>strtotime($newdateval))
    {
    
    ?>
    <div class="control-group">
    <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="time_in" data-link-format="hh:ii">
    <input type="text" name="time_in" value="<?=$time_in?>" style="width:60px; height:30px" readonly required>
    <span class="add-on"><i class="icon-remove"></i></span>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>    
    <?	
    }
}
    ?>

</td>

    <td align="center"  nowrap="nowrap">
    <?php
	$specl_con_out='1';
$staff_time_check_special_out=execute("select * from staff_time where status='1'  and date_type=1 and special_nonteac=1 and staff_type='$viewss1[3]'  and ( '$newdateval' between special_nonteac_fdate and special_nonteac_tdate)");
		if(mysql_num_rows($staff_time_check_special_out)>0)
		{
			echo $out_timeview="17:00";
			$specl_con_out='';
		}
		if($specl_con_out)
		{
		$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[3]' and date_type='2' and leave_det=1 and staff_date='$newdateval'"));
$in_timeview='';	
$out_timeview='';
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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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

   	<td align="center"  nowrap="nowrap">
    <?php
		$staff_rfid_count=fetcharray(execute("SELECT count(att_date) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]'"));
		
		$staffrfidout=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$newdateval' and user='$viewss1[4]' order by att_time desc limit 1"));
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
            <td align="center"  nowrap="nowrap">
<?php
if($absent_test=='1')
{
	//"Default";
	if(strtotime($today_date)>strtotime($newdateval))
	{
			
		?>
      <div class="control-group">
    <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="time_out" data-link-format="hh:ii">
    <input type="text" name="time_out" value="<?=$time_out?>" style="width:60px; height:30px" readonly required>
    <span class="add-on"><i class="icon-remove"></i></span>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>

        <?	
	}
}
  ?>
</td>
    <td align="center"  nowrap="nowrap">
	<?php
	if($edit_test==0)
    {
		?>
	<?=$var4?>
    <?php
	}
    ?>
		<?
	if($full_edit=='0')
	{
		$alltime1 = ($time_in);
		$alltime2 = ($time_out);
		$alltime3 = $alltime2 - $alltime1;
		$alltime1_sec=strtotime($alltime1);
		$alltime2_sec=strtotime($alltime2);
		$alltime3_sec=$alltime2_sec-$alltime1_sec;
		if($time_in!='' && $time_out!='')
		{
			echo $alltime_final = gmdate ( 'H:i:s' , $alltime3_sec);
		}
	}
	else
	{
		if($testin=='0')
		{
			$intime1 = ($time_in);
			$intime2 = ($staffrfidout[0]);
			$intime3 = $intime2 - $intime1;
			$intime1_sec=strtotime($intime1);
			$intime2_sec=strtotime($intime2);
			$intime3_sec=$intime2_sec-$intime1_sec;
			if($time_in)
			{
				echo $intime_final = gmdate ( 'H:i:s' , $intime3_sec);
			}
		}
		
		if($testout=='0')
		{
			$outtime1 = ($staffrfidlv[0]);
			$outtime2 = ($time_out);
			$outtime3 = $outtime2 - $outtime1;
			
			$outtime1_sec=strtotime($outtime1);
			$outtime2_sec=strtotime($outtime2);
			$outtime3_sec=$outtime2_sec-$outtime1_sec;
			if($time_out)
			{
				echo $outtime_final = gmdate ( 'H:i:s' , $outtime3_sec);
			}
		}
	}
        ?>
    </td>

    <td align="center"  nowrap="nowrap">
<?php

			$newdateval="$yer-$mon-$day";
			
			$attview = mktime(0,0,0,$mon,$day,$yer);
			
			$viewdate_sunday=date("D", $attview);

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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	$special_date=0;
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

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]' order by id desc"));
			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));

$status_find=1;

//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2' && $leave_test[2]!='7')
	
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
				$staff_working=1+$staff_working;
				$na_staff_det=1+$na_staff_det;
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
	elseif($viewdate_sunday=='Sun' && $leave_test[2]!='7')
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
				$staff_working=1+$staff_working;
				$na_staff_det=1+$na_staff_det;
				$status_find=0;
				}
				else
				{
				echo "<div align='center' style='color:#0000FF'><b>WO</b></div>";
				}
			}			$status_find=0;
			
		}
	}
	//leave 
	else
	//if(strtotime($today_date)>strtotime($newdateval))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]!='7' && $leave_od_ee[2]!='6' && $leave_od_ee[2]!='EE' && $leave_test[4]!='2')
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
			}
			elseif(!$staffif)
			{
				echo "<div align='center' style='color:#F00'><b>RFID Not<br>Issued</b></div>";
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
/*elseif($special_date)
{
	echo "<div align='center' style='color:#CC6600' title='Special day'><b>P </b></div>";
	$staff_working=$staff_working+1;	
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
	elseif(strtotime($staff_time_attt_out[0]) >= strtotime($leave_staff_diffrence_shl[0])  && strtotime($staff_time_attt_out[0]) <= strtotime($leave_staff_diffrence_shl[1])  && $leave_shl!=1)
	{
		$shl_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#00F'><b>SHL</b></div>";

	}
	elseif(strtotime($staff_time_attt_out[0]) < strtotime($leave_staff_diffrence_shl[0])  && $leave_shl!=1)
	{
		$shl_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#00F'><b>SHL</b></div>";

	}
		if($eve_present=='1' && $morng_present=='1')
		{
			echo "<div align='center' style='color:#060'><b>P</b></div>";	
		}
		$ee_valid='';
		$plc_valid='';
}
	}
}
}

								
?>
      </td>



  </tr>


<script type="text/javascript" src="jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
       todayBtn:  1,
	autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>
<br>
<?php
if($absent_test==1)
{
 if(strtotime($today_date)>strtotime($newdateval))
    {
  ?>
  <tr>
  <td>&nbsp;Reason*</td>
  <td colspan="9">&nbsp;<textarea rows="1" cols="100" name='reason'  style="background-color: #FFFFCC; width:500px;" placeholder="Reason*" required><?=stripslashes($reason)?></textarea></td>
  </tr>
    </table>
    <?php	
		/////////////payroll/////////////		

		$from_pay_today=explode('-',$with_date_test);
		
		if($from_pay_today[2]==21)
		{
			$systemtime=strtotime($ttimess);
		}
	
		$from_pay_20=$from_pay_today[0]."-".$from_pay_today[1]."-21";
		
	if((strtotime($with_date_test) > strtotime($from_pay_20)) || ($systemtime>$stafftime_val))
	{
		$topay_validate=date('Y-m-d', strtotime('1 month', strtotime($from_pay_20)));
		//payroll fromdate
		$topay_pay_date1=explode('-',$from_pay_20);
		$topay_mnth_pay=$topay_pay_date1[0]."-".$topay_pay_date1[1]."-21";
		//payroll todate
		$topay_pay_bdate1=explode('-',$topay_validate);
		$topay_mnth_bpay=$topay_pay_bdate1[0]."-".$topay_pay_bdate1[1]."-21";
			
		$from_date_pay=$topay_mnth_pay;
		$to_date_pay=$topay_mnth_bpay;
	}
	else
	{
		$topay_validate=date('Y-m-d', strtotime('-1 month', strtotime($from_pay_20)));
		//payroll fromdate		
		$topay_pay_bdate1=explode('-',$topay_validate);
		$topay_mnth_bpay=$topay_pay_bdate1[0]."-".$topay_pay_bdate1[1]."-21";
		//payroll todate
		$topay_pay_date1=explode('-',$from_pay_20);
		$topay_mnth_pay=$topay_pay_date1[0]."-".$topay_pay_date1[1]."-21";
				
		$from_date_pay=$topay_mnth_bpay;
		$to_date_pay=$topay_mnth_pay;
	}
			
//////////////////////end///////////////////////	

	if(strtotime($sysdate)<strtotime($from_date_pay) )
	{
		
	echo "<br><div align='center'><font color='#FFFFFF' style='font-size:16px'><b>Sorry!! The payroll cycle for this month is already completed.<br>Hence you are not authorized to apply leave.<br>Kindly contact your HOD.</font></b></div>";
       
		
	}
	else
	{
		echo "<br><div align='center'><font color='#FFFFFF' style='font-size:16px'><b>Please enter in time and out time only for the days, when you have been present in the school.</font></b></div>";
	
?>
    <br />
    
<div align='center'>
  <input type="submit" name="save" value="Apply"  class='bgbutton'>
  </div>
<?php
	}
	}
}

?>
</form>
</BODY>

</HTML>