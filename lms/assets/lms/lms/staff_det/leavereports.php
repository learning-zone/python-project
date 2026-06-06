<?php
include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$acc_year=$_SESSION['AcademicYear'];
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
<script>
	function gen_excel()
		{
			document.frm.action='staff_rfid_rprts.php';
			document.frm.submit();
		}
	</script>
    <script language="javascript" src="../js/cal2.js"></script>

<script language="javascript" src="../js/cal_conf2.js"></script>

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
<br \>
<div align='center'>
<INPUT TYPE="submit" NAME="go" class='bgbutton' VALUE="Search" >
</div>
<br \>
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
?>

<table cellspacing="0" cellpadding="0" border="1" align="center" width="60%">
<tr>
    <td align="center" colspan="3" class="head" nowrap="nowrap">Consolidated Staff Attendance Report <?=$adate?> - <?=$bdate?></td>
    </tr>
  <tr>
    <td align="center" class="row3" nowrap="nowrap">Date</td>
    <td align="center" class="row3" nowrap="nowrap">Total Staff</td>    
    <td align="center" class="row3" nowrap="nowrap">Total Present Staff</td>
    </tr>
<?php 

 for($c=0;$c<$tot_day;$c++)
{
	
$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
$viewdate_att=date("Y-m-d", $attview);
$viewdate_dis=date("d-m-Y", $attview);

$viewdate_sunday=date("D", $attview);


$staff_name_display="SELECT * from staff_det where  active='YES'  and (recruitment_procedure='User' or recruitment_procedure='') and id!='$staffrigtss[1]'";
$staffname=execute($staff_name_display);
while($staffnameview=fetcharray($staffname))
{

$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$staffnameview[id]'"));
$staffif=trim($staffrfid[0]);

$staff_time_attt_in=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[id]' group by att_time order by att_time asc limit 1"));
	
$staff_time_attt_out=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[id]' group by att_time order by att_time desc limit 1"));

$updated_att_staff=fetcharray(execute("select type from staff_att_updt where staff_id='$staffnameview[id]' and toddate='$viewdate_att' and leave_approval=0"));

$pres_sts=1;
if($updated_att_staff[0]==1)
{
	$presents++;
	$pres_sts=0;
}
if($pres_sts)
{
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[id]' group by att_time order by att_time asc ");
if(rowcount($testtimecount)>0)
{
	$presents++;
}

}

}

$count_att_staff=fetcharray(execute("select count(id) from staff_det where j_date<='$viewdate_att' and active='YES' and (recruitment_procedure='User' or recruitment_procedure='')"));
	
?>
<tr>
<td align="center" nowrap><?=$viewdate_dis?></td> 
<td align="center" nowrap><?=$count_att_staff[0]?></td> 
<td align="center" nowrap><?=$presents?></td> 
</tr>
<?
$presents=0;
$absents=0;
$pres_sts=0;
}
?>
</table>
<br />
<div align='center'>
	<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="Excel Export" OnClick="gen_excel()">
</div>
</form>
</BODY>
</HTML>