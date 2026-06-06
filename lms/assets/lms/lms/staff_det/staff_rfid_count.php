<?php
/*$dteof='2014-01-30 18:03:01';
echo date("d-m-Y h:i a",strtotime($dteof));
*/
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
if($_POST)
{
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
$dft_leave=$_POST["dft_leave"];
$studfname=$_POST["studfname"];
$saffid=$_POST["saffid"];

}
if($_REQUEST)
{
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
		document.frm.action="staff_rfid_count.php";
		document.frm.submit();
	}
	
	</script>
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
		$topay_validate=date('Y-m-d', strtotime('+1 month', strtotime($from_pay_20)));
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
$staffrigtss=fetcharray(execute("SELECT shortname FROM `users` where username='$user'"));

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
?>
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
 for($c=0;$c<$tot_day;$c++)
{
$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
$viewdate_att=date("d M", $attview);
?>
 <td align="center" class="row3" nowrap="nowrap"><?=$viewdate_att?></td>
<?php
}
?>
<td align="center" class="row3" nowrap="nowrap">Count</td>
<?php	
$tot_work_holiday='0';
$tot_work_sunday='0';
$staff_name_display="SELECT * from staff_det where  active='YES'  and (recruitment_procedure='User' or recruitment_procedure='') order by f_name";

$staffname=mysql_query($staff_name_display);
$s=1;
while($staffnameview=fetcharray($staffname))
{

?>
<tr>
<td align="center" nowrap><?=$s?></td>
<td nowrap>&nbsp;<?=$staffnameview['f_name']?> <?=$staffnameview['s_name']?></td>
<td align="center" nowrap><?=$staffnameview['EmployeeCode']?></td>
<?php
 for($c=0;$c<$tot_day;$c++)
{
$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
$viewdate_att=date("d M", $attview);
$viewdate_att=date("Y-m-d", $attview);
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$staffnameview[id]'"));
$staffif=trim($staffrfid[0]);
	

$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[id]' group by att_time order by att_time asc limit 1"));

$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[id]' group by att_time order by att_time desc limit 1"));

$count=0;
?>
 <td align="center" nowrap="nowrap">
<?php
$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[id]' order by att_time asc ");

$count=0;

$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[id]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}

//applied code
$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve,f_time,to_time,f_date,t_date  ,status_reason from staff_leave where staff_id='$staffnameview[id]' and ( '$viewdate_att' between f_date and t_date) and status=1"));


$status_find=1;
//paid leave approved
	if($leave_test[0]=='1' && $leave_test[2]!='6' && $leave_test[2]!='EE' && $leave_test[4]!='2')
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
			if($first_half!=1)
			{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave ($first_half)</b></div>";
				}
				else
				{
				echo "<div align='center' style='color:#060'><b>Paid Leave ($first_half)</b></div>";	
				}
				$paid_half_leave=$paid_half_leave+"0.5";
			$status_find=0;
			}
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
			if($secnd_half!=1)
			{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave ($secnd_half)</b></div>";
				}
				else
				{
				echo "<div align='center' style='color:#060'><b>Paid Leave ($secnd_half)</b></div>";
				}
				$paid_half_leave=$paid_half_leave+'0.5';
			$status_find=0;
			}
		}
	}
	//nt fromdate nt to date
	if($first_half==1 && $secnd_half==1)
	{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave</b></div>";
				}
				else
				{
	echo "<div align='center' style='color:#060'><b>Paid Leave1_first</b></div>";
				}
	$paid_half_leave++;
	$status_find=0;
	}
	if($date_corrects)
	{
				if($leave_test[2]==3)
				{
		echo "<div align='center' style='color:#060'><b>Maternity leave</b></div>";
				}
				else
				{
	echo "<div align='center' style='color:#060'><b>Paid Leave2_first</b></div>";
				}
	$paid_half_leave++;
	$status_find=0;
	}
	//approved leave end///////////



///outdoor approve
if($leave_test[2]=='6' && $leave_test[0]=='1' && $leave_test[4]!='2')
{
	echo "<div align='center' style='color:#060'><b>Outdoor</b></div>";
	$out_leave_count++;
	$status_find=0;	
}
//end outdoor approved

//EE approved
if($leave_test[2]=='EE'  && $leave_test[0]=='1' && $leave_test[4]!='2')
{
	echo "<div align='center' style='color:#060'><b>EE</b></div>";
	$ee_leave_count++;	
	$status_find=0;
}
//end approve EE


if($status_find)
{
	if($count=='1' || $count=='0')
	{
		//"Default";
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
			//default approval stage & absent
			$satff_default_date=fetcharray(execute("select id from staff_default where staff_id='$staffnameview[id]' and status=1 and d_date='$viewdate_att'"));
			
			$staff_default_sts=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_default_date[0]'"));		
			if($staff_default_sts[0] == '1')
			{
				echo "<div align='center' style='color:#060'><b>&#9733; P </b></div>";
			}
			elseif($staff_default_sts[1]=='1')
			{
				echo "<div align='center' style='color:#F00'><b>&#9733; A </b></div>";	
				$staff_default++;
			}
		}
	}
}
	$status_find=0;
	$date_corrects='';
	$staff_default='';
	$paid_half_leave='';
	$first_half='';
	$secnd_half='';
	$count='';
	$status_find='';
	$out_leave_count='';
	$ee_leave_count='';
?>
 </td>
<?php
}
?>
 <td align="center" nowrap="nowrap">
<?=$fullvalue?>
</td>
<?php
++$s;
}
?>
</tr>

</table>
</form>
</BODY>
</HTML>