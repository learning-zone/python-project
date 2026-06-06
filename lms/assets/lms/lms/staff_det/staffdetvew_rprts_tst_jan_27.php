<?php

include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$a_year=$_SESSION['AcademicYear'];
$today_date=date("Y-m-d");
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
			document.frm.action='staffdetvew_rprts_execl1.php';
			document.frm.submit();
		}
	</script>

<form name="frm"  method="post">

<?php
//date funtion
/*$bdateview=date('D');
//sunday
if($bdateview=='Sun')
{
 for($m=1;$m<7;$m++)
{
$tmrwbdate = mktime(0,0,0,date("m"),date("d")+$m,date("Y"));
$lastbdate=date("d/m/Y", $tmrwbdate);
}
}
//monday
if($bdateview=='Mon')
{
 for($m=5;$m<6;$m++)
{
$tmrwbdate = mktime(0,0,0,date("m"),date("d")+$m,date("Y"));
 $lastbdate=date("d/m/Y", $tmrwbdate);
}
}
//tuesday
if($bdateview=='Tue')
{
 for($m=4;$m<5;$m++)
{
$tmrwbdate = mktime(0,0,0,date("m"),date("d")+$m,date("Y"));
 $lastbdate=date("d/m/Y", $tmrwbdate);
}
}

//Wednesday
if($bdateview=='Wed')
{
 for($m=3;$m<4;$m++)
{
$tmrwbdate = mktime(0,0,0,date("m"),date("d")+$m,date("Y"));
 $lastbdate=date("d/m/Y", $tmrwbdate);
}
}
//Thursday
if($bdateview=='Thu')
{
 for($m=2;$m<3;$m++)
{
	
$tmrwbdate = mktime(0,0,0,date("m"),date("d")+$m,date("Y"));
 $lastbdate=date("d/m/Y", $tmrwbdate);
}
}

//Friday
if($bdateview=='Fri')
{
 for($m=1;$m<2;$m++)
{
	
$tmrwbdate = mktime(0,0,0,date("m"),date("d")+$m,date("Y"));
 $lastbdate=date("d/m/Y", $tmrwbdate);
}
}
//saturday
if($bdateview=='Sat')
{
 for($m=2;$m<8;$m++)
{
	
$tmrwbdate = mktime(0,0,0,date("m"),date("d")+$m,date("Y"));
 $lastbdate=date("d/m/Y", $tmrwbdate);
}
}*/
$tmrwbdate = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
 $lastbdate=date("d/m/Y", $tmrwbdate);
?>
<?php
//date funtion
$adateview=date("D");
//sunday
if($adateview=='Sun')
{
 for($i=1;$i<2;$i++)
{

$tmrwadate = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$lastadate=date("d/m/Y", $tmrwadate);
}
}
//monday
if($adateview=='Mon')
{
 for($i=0;$i<1;$i++)
{
$tmrwadate = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$lastadate=date("d/m/Y", $tmrwadate);
}
}
//tuesday
if($adateview=='Tue')
{
 for($i=-1;$i<0;$i++)
{
$tmrwadate = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$lastadate=date("d/m/Y", $tmrwadate);
}
}

//Wednesday
if($adateview=='Wed')
{
 for($i=-2;$i<-1;$i++)
{
$tmrwadate = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$lastadate=date("d/m/Y", $tmrwadate);
}
}
//Thursday
if($adateview=='Thu')
{
 for($i=-3;$i<-2;$i++)
{
	
$tmrwadate = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$lastadate=date("d/m/Y", $tmrwadate);
}
}

//Friday
if($adateview=='Fri')
{
 for($i=-4;$i<-3;$i++)
{
	
$tmrwadate = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$lastadate=date("d/m/Y", $tmrwadate);
}
}
//saturday
if($adateview=='Sat')
{
 for($i=2;$i<3;$i++)
{
	
$tmrwadate = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$lastadate=date("d/m/Y", $tmrwadate);
}
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
	    $adate=$lastadate;
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
	    $bdate='';
	}

?>
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
<INPUT TYPE="submit" NAME="go" class='bgbutton' VALUE="Search" >
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
if($today_date>$ptdate)
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
?>
<br>
<table cellspacing="0" cellpadding="0" border="1" align="center" width="100%">
<tr>
    <td align="center" colspan="<?=$tot_day+7?>" class="head" nowrap="nowrap">Staff Attendance Report <?=$adate?> - <?=$bdate?></td>
    </tr>
  <tr>
    <td align="center" class="row3" nowrap="nowrap">Sl</td>
    <td align="center" class="row3" nowrap="nowrap">Name</td>
    <td align="center" class="row3" nowrap="nowrap">Staff ID</td>
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
    <td align="center" class="row3" nowrap="nowrap">Paid Days</td>
    <td align="center" class="row3" nowrap="nowrap">School Holidays</td>
    <td align="center" class="row3" nowrap="nowrap">Total Paid Days</td>
<?php	
$tot_work_holiday='0';
$tot_work_sunday='0';

$staffname=execute("select f_name,s_name,slno,group_id,id from staff_det where  active='YES'  and (recruitment_procedure='User' or recruitment_procedure='') order by f_name");
$s=1;
while($staffnameview=fetcharray($staffname))
{

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
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}

$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$viewdate_att' and staff_typ='$staffnameview[3]'"));

?>
<td align="center" nowrap>
<?php
/*while($staff_time=fetcharray($testtime))
{
echo "<pre>";
echo $staff_time[0];
echo "</pre>";
}*/

if($staff_calender[0]==$viewdate_att)
{
	if($today_date>$viewdate_att)
	{
echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
$tot_work_holiday++;
	}
}
elseif($viewdate_sunday=='Sun')
{
	if($today_date>$viewdate_att)
	{
	echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
$tot_work_sunday++;
	}
}
else
{
if($count=='0')
{
	
	$leave_test=fetcharray(execute("select approved,reject,type,days from staff_leave where staff_id='$viewss1[4]' and ( '$viewdate_att' between f_date and t_date) and status=1"));
	
	$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$viewss1[4]' and toddate='$viewdate_att'"));

	if($today_date>$viewdate_att)
	{
		if($leave_test[0]=='1' && $leave_test[2]=='1')
	{		
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		$tot_work_leave1=$leave_test[3]+$tot_work_leave1;
	}
	elseif($leave_test[0]=='1' && $leave_test[2]!='1')
	{
		echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
		//$tot_work_leave2=$leave_test[3]+$tot_work_leave2;
	}
	elseif($updated_att_staff[0])
	{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name` FROM `leave_att_point` WHERE id='' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1]</b></div>";	
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
	if($today_date>$viewdate_att)
	{
	$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$staffnameview[4]' and status=1 and d_date='$viewdate_att'"));

$staff_default_sts=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_default_date[0]'"));

	if($staff_default_sts[0] == '1')
	{
	echo "<div align='center' style='color:#060'><b>&#9733; P</b></div>";
	$tot_work_leave3='0.5'+$tot_work_leave3;
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
if($today_date>$viewdate_att)
	{		
//$out_timeview='';
	if($staff_time_attt_in[0] <= $in_timeview)
	{
		echo "<div align='center' style='color:#060'><b>AM : P</b></div>";
		$tot_work_leave4='0.5'+$tot_work_leave4;
	}
	elseif($staff_time_attt_in[0]<='12:00:00')
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC)</b></div>";
		$tot_work_leave5='0.5'+$tot_work_leave5;
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>AM : FHL</b></div>";
	}
	if($staff_time_attt_out[0] >= $out_timeview)
	{
		echo "<div align='center' style='color:#060'><b>PM : P</b></div>";
		$tot_work_leave6='0.5'+$tot_work_leave6;
	}
	elseif($staff_time_attt_out[0]<='14:00:00')
	{
		echo "<div align='center' style='color:#300'><b>PM : SHL</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE)</b></div>";
		$tot_work_leave7='0.5'+$tot_work_leave7;
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
	}
}
}
?>

</td>
<?php
}
if($today_date>$ptdate)
{
	$teastone=0;
}
else
{
	$teastone=1;
}

$totday_work_sun_holiday=$tot_work_holiday+$tot_work_sunday;
$final_workng=$tot_day1-$totday_work_sun_holiday-$teastone;
$tot_work_final=$tot_day-$totday_work_sun_holiday;

$tot_work_leave=$tot_work_leave1+$tot_work_leave2+$tot_work_leave3+$tot_work_leave4+$tot_work_leave5+$tot_work_leave6+$tot_work_leave7;

$total_working_day=$final_workng+$totday_work_sun_holiday;
$staff_total_working_day=$tot_work_leave+$totday_work_sun_holiday
?>
 <td align="center"  nowrap="nowrap"><b><?=$final_workng?></b></td>
    <td align="center"  nowrap="nowrap"><b><?=$tot_work_leave?></b></td>
    <td align="center"  nowrap="nowrap"><b><?=$totday_work_sun_holiday?></b></td>
        <td align="center"  nowrap="nowrap"><b><?=$staff_total_working_day?>/<?=$total_working_day?></b></td>

</tr>
<?php
$totday_work_sun_holiday='';
$tot_work_holiday='';
$tot_work_sunday='';
$tot_work_final='';
$tot_work_leave='';
$tot_work_leave1='';
$tot_work_leave2='';
$tot_work_leave3='';
$tot_work_leave4='';
$tot_work_leave5='';
$tot_work_leave6='';
$tot_work_leave7='';
$final_workng='';
$total_working_day='';
$staff_total_working_day='';
++$s;
}
?>
</table>
</form>
</BODY>
</HTML>