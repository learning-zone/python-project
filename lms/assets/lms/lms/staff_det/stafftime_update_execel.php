<?php
$disdate=date("d-m-Y");
$file_name= "Staff_Time_Sheet_update_Report_$disdate.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");

	session_start();
	include("../db1.php");
	
	//print_r($_POST);
	$user=$_SESSION['user'];
	$acc_year=$_SESSION['AcademicYear'];
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
	$staff_ids=$_POST['staff_ids'];
	
	if($_GET)
	{
	  $staff_ids=$_GET['staff_ids'];
	}
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
		$payfromdate_1=explode("/",$adate_pay);
		$adate="21/".$payfromdate_1[1]."/".$payfromdate_1[2];
	   // $adate=$adate_pay;
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
<html>
<head>
<title>Staff_Time_Sheet_update_Report</title>
</head>
<body>

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

    <?
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
	?>
    
 
<table cellspacing="0" cellpadding="0" border="1" align="center" width="100%">
   
  <tr>
    <td align="center" class="row3" nowrap="nowrap">Sl No</td>
    <td align="center" class="row3" nowrap="nowrap">Staff Name</td>
    <td align="center" class="row3" nowrap="nowrap">Staff Type</td>    
    <td align="center" class="row3" nowrap="nowrap">Employee Code</td>
    <td align="center" class="row3" nowrap="nowrap">Manager</td>
    <td align="center" class="row3" nowrap="nowrap">Date</td>
    <td align="center" class="row3" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
     <td align="center" class="row3" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
   	<td align="center" class="row3" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    <td align="center" class="row3" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
    <td align="center" class="row3" nowrap="nowrap">Time Spent</td>
    <td align="center" class="row3" nowrap="nowrap">Current Status</td>
    <td align="center" class="row3" nowrap="nowrap">Update Status</td>
    <td align="center" class="row3" nowrap="nowrap">Updated By</td>
    <td align="center" class="row3" nowrap="nowrap">Leave Status</td> 
  </tr>
<?php
$s=1;

$staff_name_display="SELECT * from staff_det where  active='YES' and (recruitment_procedure='User' or recruitment_procedure='') order by f_name";

$staffname=mysql_query($staff_name_display);

	/*$viewss=execute("select f_name,s_name,slno,group_id,id from staff_det where  active='YES'  and (recruitment_procedure='User' or recruitment_procedure='') order by f_name");*/
	while($viewss1=fetcharray($staffname))
	{
		
		$staff_hr_mang=fetcharray(execute("select hr_id,mng_id from staff_hr_grup where status=1 and staff_id='$viewss1[id]'"));

		
		$staffname_mang=fetcharray(execute("select f_name,s_name,group_id,EmployeeCode from staff_det  where id='$staff_hr_mang[mng_id]' and active='YES'"));
		
		
		 $stafftypess='';
		 $staff_n=fetcharray(execute("SELECT * from staff_det where id='$viewss1[id]'"));
		if($staff_n[category]==1)
		{
			$stafftypess="Teaching";
		}
		if($staff_n[category]==2)
		{
			$stafftypess="Non Teaching";
		}
		
		 for($c=0;$c<$tot_day;$c++)

	{
$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
$viewdate_att=date("Y-m-d", $attview);
$day_view_date=date("d-M-Y", $attview);
$viewdate_sunday=date("D", $attview);
$pfdate=$viewdate_att;

$viewss1['0']=$viewss1['f_name'];
$viewss1['1']=$viewss1['s_name'];
$viewss1['2']=$viewss1['slno'];
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
  <td width="3%" nowrap>&nbsp;<?=$staff_n[f_name]?>&nbsp;<?=$staff_n[s_name]?></td>
 <td align="center" width="3%" nowrap><?=$staff_n[EmployeeCode]?></td>
 <td align="center" width="3%" nowrap><?=$stafftypess?></td>
        <td width="10%" align="center" nowrap><?=$staffname_mang[f_name]?>&nbsp;<?=$staffname_mang[s_name]?></td>

        <td width="10%" align="center" nowrap><?=$day_view_date?></td>
        
        <td align="center" width="10%">
		<?php
	/*$fromdate=explode('/',$adate);
	$pfdate=$fromdate[2]."-".$fromdate[1]."-".$fromdate[0];
	$viewdate_att=$pfdate;
	
	$attview = mktime(0,0,0,$fromdate[1],$fromdate[0],$fromdate[2]);
	$viewdate_sunday=date("D", $attview);*/

	
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
			echo $in_timeview="09:00";
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

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and ( '$viewdate_att' between f_date and t_date) and status=1 and status_approve!=2  order by id desc"));

$leave_od_ee=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$viewdate_att' and status=1 and status_approve!=2  order by id desc"));


$updated_att_staff=fetcharray(execute("select type,leave_approval from staff_att_updt where staff_id='$viewss1[4]' and toddate='$viewdate_att'"));

$leave_update_att=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where id='$updated_att_staff[1]'  order by id desc"));

			$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));


$status_find=1;
//manger updated att
if($updated_att_staff[0]!='' && $leave_od_ee[2]!='EE' && $leave_od_ee[2]!='6' && $leave_update_att[4]!='2' && $leave_test[2]!='7')	
	{
		//if(strtotime($today_date)>strtotime($viewdate_att))
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
				if($leave_test[2]==3)
				{
					$view_holidays='Maternity Leave';
				
				}
				
				echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
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
				$status_find=0;
			}
			else
			{
		echo "<div align='center' style='color:$view_att_staff[0]'><b>Paid Leave";
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
				if($leave_test[2]==3)
				{
					$view_holidays='Maternity Leave';
				}
				echo "<div align='center' style='color:#0000FF'><b>$view_holidays</b></div>";
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
		//}
	}
	//school holiday
	elseif(strtotime($staff_calender[0])==strtotime($viewdate_att))
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
			if(strtotime($viewss1[j_date])>strtotime($viewdate_att))
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
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if($leave_test[2]==3)
			{
			echo "<div align='center' style='color:#0000FF'><b>Maternity Leave</b></div>";
			}
			else
			{
						if(strtotime($viewss1[j_date])>strtotime($viewdate_att))
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

			}
			$status_find=0;
			
		//}
	}
	//leave if(strtotime($today_date)>strtotime($viewdate_att))
	else
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
		if(strtotime($viewss1[j_date])>strtotime($viewdate_att))
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
	$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$staffnameview[4]' and status=1 and d_date='$viewdate_att'"));
		
		$staff_default_sts=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_default_date[0]'"));		
		if($staff_default_sts[0] == '1')
		{
		echo "<div align='center' style='color:#060'><b>P(D)</b></div>";
		$staff_working=1+$staff_working;
		}
		else
		{
	echo "<div align='center' style='color:#F00'><b>Default&nbsp;($totspent)</b></div>";
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
	echo "<div align='center' style='color:#F00'><b>A&nbsp;($totspent)</b></div>";
		}
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
    <?php
  if($updated_att_staff[1]!='0' && $updated_att_staff[0]=='1')
    {
	?>
    <b><font color="<?=$update_attenc[0]?>">Paid Leave
			<?php
            if($first_half)
            {
            echo "($first_half)";
            }
            ?>
    </font></b>
    <?php
    }
    elseif($updated_att_staff[1]!='0' && $updated_att_staff[0]!='1')
    {
	?>	
     <b><font color="<?=$update_attenc[0]?>"><?=$update_attenc[1]?>
			<?php
            if($first_half)
            {
            echo "($first_half)";
            }
            ?>
     </font></b>
    <?
    }
	elseif($updated_att_staff[1]=='0')
	{
		?>
         <b><font color="<?=$update_attenc[0]?>"><?=$update_attenc[1]?></font></b>
        <?
	}
	elseif(strtotime($staff_calender[0])==strtotime($viewdate_att))
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
	?>
    </a>
    <?
    }
	else
	{
    ?>
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
	$leavdet1=fetcharray(execute("select * from staff_leave where staff_id='$viewss1[4]' and ( '$viewdate_att' between f_date and t_date)  and status=1 and status_approve!=2 order by id desc"));

$leave_od_ee=fetcharray(execute("select * from staff_leave where staff_id='$viewss1[4]' and hd_ee_da_date='$viewdate_att' and status=1 and status_approve!=2 order by id desc"));

	$staff_default=fetcharray(execute("SELECT * FROM `staff_default` where staff_id='$viewss1[4]' and d_date='$viewdate_att'"));

	$staff_default_sts=fetcharray(execute("SELECT approved ,reject,inserted_date,user  FROM `staff_default_status` where staff_id_ins='$staff_default[id]'"));

$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leavdet1[type]'"));

$staflavty_ee_od=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leave_od_ee[type]'"));
	
	if($leave_od_ee[type]=="EE")
	{
		$staflavty_ee_od[0]="Early Exist";
	}
	
	
	$default_tst='';
	
	$defalt_val=execute("SELECT * FROM `staff_default` where staff_id='$viewss1[4]' and d_date='$viewdate_att'");
if(mysql_num_rows($defalt_val)>=1)
{
	$default_tst=1;
}

    ?>
        <td align="center" nowrap>
		<?php
		
        if($leavdet1[approved]==1 && $leavdet1[status_approve]!=2)
        {
				


			echo $staflavty[0]." : Approved by ".$leavdet1[user_manager]."&nbsp;".date("d-M-Y h:i a",strtotime($leavdet1[updated_date]));
        }
        ?>
        <?php
        if($leavdet1[reject]==1  && $leavdet1[status_approve]!=2)
        {
			echo $staflavty[0]." : Rejected by ".$leavdet1[user_manager]."&nbsp;".date("d-M-Y h:i a",strtotime($leavdet1[updated_date]));
        }
        ?>
        <?php
       if($leavdet1[reject]=='0' && $leavdet1[approved]=='0'  && $leavdet1[status_approve]!=2)
        {
			echo $staflavty[0]." : Pending";
        }
        ?>
        <?php
       if($leavdet1[status_approve]==2 || $leave_update_att[4]=='2')
        {
			echo $staflavty[0]." : Withdrawn";
        }
        ?>
        <?php
        if($leave_od_ee[approved]==1 && $leave_od_ee[status_approve]!=2)
        {
			echo $staflavty_ee_od[0]." : Approved by ".$leave_od_ee[user_manager]."&nbsp;".date("d-M-Y h:i a",strtotime($leave_od_ee[updated_date]));
        }
        ?>
        <?php
        if($leave_od_ee[reject]==1  && $leave_od_ee[status_approve]!=2)
        {
			echo  $staflavty_ee_od[0]." : Rejected by ".$leave_od_ee[user_manager]."&nbsp;".date("d-M-Y h:i a",strtotime($leave_od_ee[updated_date]));
        }
        ?>
        <?php
       if($leave_od_ee[reject]=='0' && $leave_od_ee[approved]=='0'  && $leave_od_ee[status_approve]!=2)
        {
			echo  $staflavty_ee_od[0]." : Pending";
        }
        ?>
        <?php
       if($leave_od_ee[status_approve]==2)
        {
			echo  $staflavty_ee_od[0]." : Withdrawn";
        }
        ?>
        
        <?php
        if($staff_default_sts[approved]==1)
        {
			echo "Default : Approved by ".$staff_default_sts[user]."&nbsp;".date("d-M-Y h:i a",strtotime($staff_default_sts[inserted_date]));
			$default_tst='';
        }
        ?>
        <?php
        if($staff_default_sts[reject]==1)
        {
			echo "Default : Rejected by ".$staff_default_sts[user]."&nbsp;".date("d-M-Y h:i a",strtotime($staff_default_sts[inserted_date]));
			$default_tst='';
        }
        ?>
        <?php
       if($default_tst)
        {
			echo "Default : Pending";
        }
        ?>
  
        </td>
        <?
		}
		?>
    </tr>
   <?
   $s++;	
	}
	}
	?>
  
</table>
</form>
</body>
</html>

