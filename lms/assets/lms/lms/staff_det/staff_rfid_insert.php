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
		document.frm.action="staff_rfid_insert.php";
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


/*for($i=6; $i>0; $i--)
{
	$staffrigtss=fetcharray(execute("SELECT * FROM `leave_staff_paid_tot_acc_temp` where staff_id='238' and acc_id='$i'"));

	
	$total=number_format(floatval($staffrigtss[tot_paid]),2);
	$remining=number_format(floatval($staffrigtss[paid_vat]),2);
	echo "<br>".$total;
	echo "<br>".$remining;
	if($total > $staffrigtss[paid_vat])
	{
		if($i==$staffrigtss[acc_id])
		{
	echo "hai<br>".$i;
		}
	}
	else
	{
		echo "byes<br>".$i;
	}
}*/

//sdie();
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
<td align="center" nowrap><?=$s?></td>
<td nowrap>&nbsp;<?=$staffnameview[0]?> <?=$staffnameview[1]?></td>
<td align="center" nowrap><?=$staffnameview[2]?></td>
<?php 
 for($c=0;$c<$tot_day;$c++)
{
		$ee_valid='';
		$plc_valid='';
		$rfid_code_h='';
		$rfid_code_hh='';
		$rfid_code_a='';
		$rfid_code_lc='';
		$rfid_code_d='';
		$rfid_code_lca='';
		$rfid_code_ee='';
		$rfid_code_p='';
		$rfid_points_lc='';
		$rfid_points_1='';
		
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
//$count_leave_ridus='';

$leave_minus_val=fetcharray(execute("SELECT * FROM `leave_staff_attand` WHERE status=1 and staff_id='$staffnameview[id]'  and  rfid_date='$viewdate_att' order by id desc"));

$count_leave_ridus=$leave_minus_val['att_point_rfid']+$count_leave_ridus;

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

$status_find=1;
//school holiday
	if(strtotime($staff_calender[0])==strtotime($viewdate_att))
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
			echo "<div align='center' style='color:#0000FF'><b>H</b></div>";
			
			$rfid_code_h='H';
			$rfid_points='0';
			$status_find=0;
			
			//*********************************//
			$Sql66_h=execute(" select id from leave_staff_attand where rfid_date='$viewdate_att' and staff_id='$viewss1[4]' and att_code_rfid='$rfid_code_h'");
			if(mysql_num_rows($Sql66_h)>0)
			{
			
			$leave_up_h="update leave_staff_attand set expect_rfid_in='$in_timeview',rfid_in='$staff_time_attt_in[0]',expect_rfid_out='$out_timeview',rfid_out='$staff_time_attt_out[0]',att_code_rfid='$rfid_code_h',att_point_rfid='$rfid_points' where rfid_date='$viewdate_att' and staff_id='$viewss1[4]' and att_code_rfid='$rfid_code_h'";
			execute($leave_up_h);	
			}
			else
			{
				
			execute("INSERT INTO  leave_staff_attand (staff_id,a_year,rfid_date,expect_rfid_in,rfid_in,expect_rfid_out,rfid_out,att_code_rfid,att_point_rfid,rfid_number,status) VALUES ('$viewss1[4]','$a_year','$viewdate_att','$in_timeview','$staff_time_attt_in[0]','$out_timeview','$staff_time_attt_out[0]','$rfid_code_h','$rfid_points','$staffif','1')");
			}
			//********************************//
			
			
		}
	}

	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
			echo "<div align='center' style='color:#FF0000'><b>H</b></div>";
			$rfid_code_hh='H';
			$rfid_points='0';
			$status_find=0;
			
			
			//*********************************//
			$Sql66_hh=execute(" select id from leave_staff_attand where rfid_date='$viewdate_att' and staff_id='$viewss1[4]' and att_code_rfid='$rfid_code_hh'");
			if(mysql_num_rows($Sql66_hh)>0)
			{
			
			$leave_up_hh="update leave_staff_attand set expect_rfid_in='$in_timeview',rfid_in='$staff_time_attt_in[0]',expect_rfid_out='$out_timeview',rfid_out='$staff_time_attt_out[0]',att_code_rfid='$rfid_code_hh',att_point_rfid='$rfid_points' where rfid_date='$viewdate_att' and staff_id='$viewss1[4]'  and att_code_rfid='$rfid_code_hh'";
			execute($leave_up_hh);	
			}
			else
			{
				
			execute("INSERT INTO  leave_staff_attand (staff_id,a_year,rfid_date,expect_rfid_in,rfid_in,expect_rfid_out,rfid_out,att_code_rfid,att_point_rfid,rfid_number,status) VALUES ('$viewss1[4]','$a_year','$viewdate_att','$in_timeview','$staff_time_attt_in[0]','$out_timeview','$staff_time_attt_out[0]','$rfid_code_hh','$rfid_points','$staffif','1')");
			}
			//********************************//
			
		}
	}
	
	
if($status_find)
{
if($count=='0')
{
	if(strtotime($today_date)>strtotime($viewdate_att))
	{
		
		echo "<div align='center' style='color:#F00'><b>A </b></div>";
			$rfid_code_a='A';
			$rfid_points='1';
			//*********************************//
			$Sql66_a=execute(" select id from leave_staff_attand where rfid_date='$viewdate_att' and staff_id='$viewss1[4]' and att_code_rfid='$rfid_code_a'");
			if(mysql_num_rows($Sql66_a)>0)
			{
			
			$leave_up_a="update leave_staff_attand set expect_rfid_in='$in_timeview',rfid_in='$staff_time_attt_in[0]',expect_rfid_out='$out_timeview',rfid_out='$staff_time_attt_out[0]',att_code_rfid='$rfid_code_a',att_point_rfid='$rfid_points' where rfid_date='$viewdate_att' and staff_id='$viewss1[4]'  and att_code_rfid='$rfid_code_a'";
			execute($leave_up_a);	
			}
			else
			{
				
			execute("INSERT INTO  leave_staff_attand (staff_id,a_year,rfid_date,expect_rfid_in,rfid_in,expect_rfid_out,rfid_out,att_code_rfid,att_point_rfid,rfid_number,status) VALUES ('$viewss1[4]','$a_year','$viewdate_att','$in_timeview','$staff_time_attt_in[0]','$out_timeview','$staff_time_attt_out[0]','$rfid_code_a','$rfid_points','$staffif','1')");
			}
			//********************************//
	}
}
elseif($count=='1')
{
	//"Default";
	if(strtotime($today_date)>strtotime($viewdate_att))
	{
	
		echo "<div align='center' style='color:#C2780A'><b>P(D)</b></div>";
		$rfid_code_d='P(D)';
		$rfid_points='0';
		
		//*********************************//
			$Sql66_d=execute(" select id from leave_staff_attand where rfid_date='$viewdate_att' and staff_id='$viewss1[4]' and att_code_rfid='$rfid_code_d'");
			if(mysql_num_rows($Sql66_d)>0)
			{
			
			$leave_up_d="update leave_staff_attand set expect_rfid_in='$in_timeview',rfid_in='$staff_time_attt_in[0]',expect_rfid_out='$out_timeview',rfid_out='$staff_time_attt_out[0]',att_code_rfid='$rfid_code_d',att_point_rfid='$rfid_points' where rfid_date='$viewdate_att' and staff_id='$viewss1[4]'  and att_code_rfid='$rfid_code_d'";
			execute($leave_up_d);	
			}
			else
			{
				
			execute("INSERT INTO  leave_staff_attand (staff_id,a_year,rfid_date,expect_rfid_in,rfid_in,expect_rfid_out,rfid_out,att_code_rfid,att_point_rfid,rfid_number,status) VALUES ('$viewss1[4]','$a_year','$viewdate_att','$in_timeview','$staff_time_attt_in[0]','$out_timeview','$staff_time_attt_out[0]','$rfid_code_d','$rfid_points','$staffif','1')");
			}
			//********************************//
			
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
//$staff_in_time='';
if(strtotime($staff_time_attt_in[0]) <= strtotime($in_timeview))
	{		
		$morng_present=1;
	}
	
	elseif(strtotime($staff_time_attt_in[0]) > strtotime($in_timeview) && strtotime($staff_time_attt_in[0]) <= strtotime($fhl_time_staff))
	{
		$morng_present=0;
		echo "<div align='center' style='color:#F60'><b>P(LC)</b></div>";
		$plc_valid=2;
		$rfid_code_plc='P(LC)';
		$rfid_points='1';
		
			//*********************************//
			$Sql66_p=execute(" select id from leave_staff_attand where rfid_date='$viewdate_att' and staff_id='$viewss1[4]' and att_code_rfid='$rfid_code_plc'");
			if(mysql_num_rows($Sql66_p)>0)
			{
			
			$leave_up_p="update leave_staff_attand set expect_rfid_in='$in_timeview',rfid_in='$staff_time_attt_in[0]',expect_rfid_out='$out_timeview',rfid_out='$staff_time_attt_out[0]',att_code_rfid='$rfid_code_plc',att_point_rfid='$rfid_points' where rfid_date='$viewdate_att' and staff_id='$viewss1[4]'  and att_code_rfid='$rfid_code_plc'";
			execute($leave_up_p);	
			}
			else
			{
				
			execute("INSERT INTO  leave_staff_attand (staff_id,a_year,rfid_date,expect_rfid_in,rfid_in,expect_rfid_out,rfid_out,att_code_rfid,att_point_rfid,rfid_number,status) VALUES ('$viewss1[4]','$a_year','$viewdate_att','$in_timeview','$staff_time_attt_in[0]','$out_timeview','$staff_time_attt_out[0]','$rfid_code_plc','$rfid_points','$staffif','1')");
			}
			//********************************//
	
		
	}
	elseif(strtotime($staff_time_attt_in[0]) > strtotime($fhl_time_staff))
	{
		$morng_present=0;
		echo "<div align='center' style='color:#00F'><b>FHL</b></div>";	
		$fhl_valid=1;
		
		$rfid_code_fhl='FHL';
		$rfid_points='0.5';
		
			//*********************************//
			$Sql66_p=execute(" select id from leave_staff_attand where rfid_date='$viewdate_att' and staff_id='$viewss1[4]' and att_code_rfid='$rfid_code_fhl'");
			if(mysql_num_rows($Sql66_p)>0)
			{
			
			$leave_up_p="update leave_staff_attand set expect_rfid_in='$in_timeview',rfid_in='$staff_time_attt_in[0]',expect_rfid_out='$out_timeview',rfid_out='$staff_time_attt_out[0]',att_code_rfid='$rfid_code_fhl',att_point_rfid='$rfid_points' where rfid_date='$viewdate_att' and staff_id='$viewss1[4]'  and att_code_rfid='$rfid_code_fhl'";
			execute($leave_up_p);	
			}
			else
			{
				
			execute("INSERT INTO  leave_staff_attand (staff_id,a_year,rfid_date,expect_rfid_in,rfid_in,expect_rfid_out,rfid_out,att_code_rfid,att_point_rfid,rfid_number,status) VALUES ('$viewss1[4]','$a_year','$viewdate_att','$in_timeview','$staff_time_attt_in[0]','$out_timeview','$staff_time_attt_out[0]','$rfid_code_fhl','$rfid_points','$staffif','1')");
			}
			//********************************//
	
		
	}
	
	//staff_out_time
	$ee_valid=1;
	$eve_present=0;
	$shl_valid=0;
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		$eve_present=1;
	}
	elseif(strtotime($staff_time_attt_out[0]) < strtotime($out_timeview) && strtotime($staff_time_attt_out[0]) > strtotime($fhl_time_staff))
	{
		$ee_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#93C'><b>EE</b></div>";
		
		$rfid_code_ee='EE';
		$rfid_points='0.5';
		
			//*********************************//
			$Sql66_p=execute(" select id from leave_staff_attand where rfid_date='$viewdate_att' and staff_id='$viewss1[4]' and att_code_rfid='$rfid_code_ee'");
			if(mysql_num_rows($Sql66_p)>0)
			{
			
			$leave_up_p="update leave_staff_attand set expect_rfid_in='$in_timeview',rfid_in='$staff_time_attt_in[0]',expect_rfid_out='$out_timeview',rfid_out='$staff_time_attt_out[0]',att_code_rfid='$rfid_code_ee',att_point_rfid='$rfid_points' where rfid_date='$viewdate_att' and staff_id='$viewss1[4]'  and att_code_rfid='$rfid_code_ee'";
			execute($leave_up_p);	
			}
			else
			{
				
			execute("INSERT INTO  leave_staff_attand (staff_id,a_year,rfid_date,expect_rfid_in,rfid_in,expect_rfid_out,rfid_out,att_code_rfid,att_point_rfid,rfid_number,status) VALUES ('$viewss1[4]','$a_year','$viewdate_att','$in_timeview','$staff_time_attt_in[0]','$out_timeview','$staff_time_attt_out[0]','$rfid_code_ee','$rfid_points','$staffif','1')");
			}
			//********************************//
	}
	elseif(strtotime($staff_time_attt_out[0]) < strtotime($fhl_time_staff))
	{
		$shl_valid=2;
		$eve_present=0;
		echo "<div align='center' style='color:#00F'><b>SHL</b></div>";
		
		$rfid_code_shl='SHL';
		$rfid_points='0.5';
		
			//*********************************//
			$Sql66_p=execute(" select id from leave_staff_attand where rfid_date='$viewdate_att' and staff_id='$viewss1[4]' and att_code_rfid='$rfid_code_shl'");
			if(mysql_num_rows($Sql66_p)>0)
			{
			
			$leave_up_p="update leave_staff_attand set expect_rfid_in='$in_timeview',rfid_in='$staff_time_attt_in[0]',expect_rfid_out='$out_timeview',rfid_out='$staff_time_attt_out[0]',att_code_rfid='$rfid_code_shl',att_point_rfid='$rfid_points' where rfid_date='$viewdate_att' and staff_id='$viewss1[4]'  and att_code_rfid='$rfid_code_shl'";
			execute($leave_up_p);	
			}
			else
			{
				
			execute("INSERT INTO  leave_staff_attand (staff_id,a_year,rfid_date,expect_rfid_in,rfid_in,expect_rfid_out,rfid_out,att_code_rfid,att_point_rfid,rfid_number,status) VALUES ('$viewss1[4]','$a_year','$viewdate_att','$in_timeview','$staff_time_attt_in[0]','$out_timeview','$staff_time_attt_out[0]','$rfid_code_shl','$rfid_points','$staffif','1')");
			}
			//********************************//
			
	}
		if($eve_present=='1' && $morng_present=='1')
		{
			echo "<div align='center' style='color:#060'><b>P</b></div>";
			
			$rfid_code_p='P';
			$rfid_points='1';
		
			//*********************************//
			$Sql66_p=execute(" select id from leave_staff_attand where rfid_date='$viewdate_att' and staff_id='$viewss1[4]' and att_code_rfid='$rfid_code_p'");
			if(mysql_num_rows($Sql66_p)>0)
			{
			
			$leave_up_p="update leave_staff_attand set expect_rfid_in='$in_timeview',rfid_in='$staff_time_attt_in[0]',expect_rfid_out='$out_timeview',rfid_out='$staff_time_attt_out[0]',att_code_rfid='$rfid_code_p',att_point_rfid='$rfid_points' where rfid_date='$viewdate_att' and staff_id='$viewss1[4]'  and att_code_rfid='$rfid_code_p'";
			execute($leave_up_p);	
			}
			else
			{
				
			execute("INSERT INTO  leave_staff_attand (staff_id,a_year,rfid_date,expect_rfid_in,rfid_in,expect_rfid_out,rfid_out,att_code_rfid,att_point_rfid,rfid_number,status) VALUES ('$viewss1[4]','$a_year','$viewdate_att','$in_timeview','$staff_time_attt_in[0]','$out_timeview','$staff_time_attt_out[0]','$rfid_code_p','$rfid_points','$staffif','1')");
			}
			//********************************//
				
		}
		$ee_valid='';
		$plc_valid='';
	}
}
}
$rfid_points='';
$rfid_code='';
?>

</td>
<?php
}
?>
<td align="center" nowrap="nowrap"><?=$count_leave_ridus?></td>
<?
++$s;
$count_leave_ridus='';
}
?>
</tr>

</table>
</form>
</BODY>
</HTML>