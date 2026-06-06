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
$start_from = ($page-1) * 10;

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
		document.frm.action="stafftime_jan29.php";
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
?>
<br>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==1){
		?>
        <li class="currentBtn"><a href="leave.php?tab=1" >Leave & Attendance</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=1" >Leave & Attendance</a></li>
        <?
	}
?>
<?
	if($p==2 || $p==4 || $p==5  || $p==6){
		?>
        <li class="currentBtn"><a href="leave.php?tab=2" >Leave Approval</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=2" >Leave Approval</a></li>
        <?
	}
?>
<?
	if($p==12){
		?>
        <li class="currentBtn"><a href="stafftime_jan29.php?tab=12" >Staff Time Sheet</a></li>
        <?
	}else{
		?>
        <li><a href="stafftime_jan29.php?tab=12" >Staff Time Sheet</a></li>
        <?
	}
?>
<?
	if($p==33){
		?>
        <li class="currentBtn"><a href="staffdetvew_rprts.php?tab=33" >Staff Attendance Report</a></li>
        <?
	}else{
		?>
        <li><a href="staffdetvew_rprts.php?tab=33" >Staff Attendance Report</a></li>
        <?
	}
?>
<?
	if($p==20){
		?>
        <li class="currentBtn"><a href="staff_profile.php?tab=20" >My Time Sheet</a></li>
        <?
	}else{
		?>
        <li><a href="staff_profile.php?tab=20" >My Time Sheet</a></li>
        <?
	}
?>
</ul>
</div>
</div>
<table cellspacing="0" cellpadding="0" border="1" align="center" width="100%">
  <tr>
    <td colspan="11" class="head">Staff Daily Attendance for Date :   <input type="text" name="adate" value="<?php if($adate==""){$adate=date("d/m/Y"); } echo $adate?>" readonly onFocus="RefreshMe(0)">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle"></a><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick ="OpenWind4('staffdetvew_rprts.php', 'OpenWind4',1000,500)"><input type="button" name="rprts" value="Staff Attendance Report"  class='bgbutton'></a>--></td>
  </tr>
  <tr>
    <td align="center" class="row3" nowrap="nowrap">Sl No</td>
    <td align="center" class="row3" nowrap="nowrap"><a href="<?php echo "stafftime_jan29.php?sort_by=slno&sort_type=ASC&adate=".$adate."";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px">&#9650;</font>
</a>Staff Code<a href="<?php echo "stafftime_jan29.php?sort_by=slno&sort_type=DESC&adate=".$adate."";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px">&#9660;</font></a></td>
    <td align="center" class="row3" nowrap="nowrap"><a href="<?php echo "stafftime_jan29.php?sort_by=f_name&sort_type=ASC&adate=".$adate."";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px">&#9650;</font>
</a>Staff Name<a href="<?php echo "stafftime_jan29.php?sort_by=f_name&sort_type=DESC&adate=".$adate."";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px">&#9660;</font></a></td>
    <td align="center" class="row3" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
     <td align="center" class="row3" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
   	<td align="center" class="row3" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    <td align="center" class="row3" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
    <td align="center" class="row3" nowrap="nowrap">Time Spent</td>
    <td align="center" class="row3" nowrap="nowrap">Current Status</td>
    <td align="center" class="row3" nowrap="nowrap">Update Status</td>
        <td align="center" class="row3" nowrap="nowrap">Details</td>

  </tr>
<?php
$s=1;

$staff_name_display="SELECT * from staff_det where  active='YES'  and (recruitment_procedure='User' or recruitment_procedure='') ";
$staff_name_display.=" ORDER BY $sort_by $sort_type LIMIT $start_from, 10";

$staffname=mysql_query($staff_name_display);

	/*$viewss=execute("select f_name,s_name,slno,group_id,id from staff_det where  active='YES'  and (recruitment_procedure='User' or recruitment_procedure='') order by f_name");*/
	while($viewss1=fetcharray($staffname))
	{
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


       $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type='2' and leave_det=1 and staff_date='$viewdate_att'"));
$in_timeview='';	
$out_timeview='';
	if($staff_time_check_date[4])
	{
		if($staff_time_check_date[1])
		{
			echo $in_timeview=$staff_time_check_date[1];
		}
		else
		{
			echo $in_timeview=$staff_time_check_date[0];		
		}
	}
	else
	{
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type=1 and leave_det=1 and staff_date=''"));
	
		if($staff_time_check[1])
		{
			echo $in_timeview=$staff_time_check[1];
		}
		else
		{
			echo $in_timeview=$staff_time_check[0];		
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
		$staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$staffnameview[3]' and date_type='2' and leave_det=1 and staff_date='$viewdate_att'"));
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

$testtime=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' order by att_time asc ");

$count=0;
$testtimecount=execute("SELECT count(att_time) FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewdate_att' and user='$staffnameview[4]' group by att_time order by att_time asc ");
while($testtimecountss=fetcharray($testtimecount))
{
	++$count;
}

$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$viewdate_att' and staff_typ='$staffnameview[3]'"));

$leave_test=fetcharray(execute("select approved,reject,type,days,status_approve from staff_leave where staff_id='$viewss1[4]' and ( '$viewdate_att' between f_date and t_date) and status=1"));


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
		}
	}
	//manger updated att
	elseif($updated_att_staff[0])
	{
		$view_att_staff=fetcharray(execute("SELECT `att_colors`,`name`,`point_att` FROM `leave_att_point` WHERE id='$updated_att_staff[0]' and status=1"));
		
		echo "<div align='center' style='color:$view_att_staff[0]'><b>$view_att_staff[1] ($view_att_staff[2])</b></div>";	
		
		$status_find=0;
	}
	//sunday
	elseif($viewdate_sunday=='Sun')
	{
		if(strtotime($today_date)>strtotime($viewdate_att))
		{
			echo "<div align='center' style='color:#FF0000'><b>Sun</b></div>";
			$status_find=0;
		}
	}
	//leave 
	elseif(strtotime($today_date)>strtotime($viewdate_att))
	{
		//paid leave
		if($leave_test[0]=='1' && $leave_test[2]=='1' && $leave_test[4]!='2')
		{		
			echo "<div align='center' style='color:#060'><b>Paid Leave (1)</b></div>";
			$status_find=0;
		
		}
		//leave without pay
		elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]!='2')
		{
			echo "<div align='center' style='color:#F00'><b>LWP (0)</b></div>";
			$status_find=0;
		
		}
		//withdrawn
		elseif($leave_test[4]=='2')
		{
			//withdrawn pending so its go to leave (paid leave) 
			if($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
			echo "<div align='center' style='color:#060'><b>Paid Leave (1)</b></div>";
			$status_find=0;
			}//withdrawn is rejected (Paid leave) 
			elseif($leave_test[0]=='1' && $leave_test[2]=='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#060'><b>Paid Leave (1)</b></div>";
				$status_find=0;
			}		
			//withdrawn pending so its go to leave (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='0')
			{
				echo "<div align='center' style='color:#F00'><b>LWP (0)</b></div>";
				$status_find=0;
			}
			//withdrawnis rejected (leave without pay) 
			elseif($leave_test[0]=='1' && $leave_test[2]!='1'  && $leave_test[4]=='2' && $leave_test[0]=='3')
			{
				echo "<div align='center' style='color:#F00'><b>LWP (0)</b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P (1)</b></div>";	
		}
		elseif($staff_absent_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A (0)</b></div>";	
		}
		else
		{	
		echo "<div align='center' style='color:#F00'><b>A (0)</b></div>";
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
		echo "<div align='center' style='color:#060'><b>&#9733; P (1)</b></div>";
		$tot_work_leave3='1'+$tot_work_leave3;
		}
		elseif($staff_default_sts[1]=='1')
		{
		echo "<div align='center' style='color:#F00'><b>&#9733; A (0)</b></div>";	
		}
		else
		{
		echo "<div align='center' style='color:#C2780A'><b>Default (0)</b></div>";	
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
		echo "<div align='center' style='color:#060'><b>AM : P (0.5)</b></div>";
	}
	
	elseif(strtotime($staff_time_attt_in[0]) <= strtotime($fhl_staff))
	{
		echo "<div align='center' style='color:#F60'><b>AM : P(LC) (0.5)</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>AM : FHL (0)</b></div>";
	}
	
	//staff_out_time
	if(strtotime($staff_time_attt_out[0]) >= strtotime($out_timeview))
	{
		echo "<div align='center' style='color:#060'><b>PM : P (0.5)</b></div>";
	}
	elseif(strtotime($staff_time_attt_out[0]) <= strtotime($shl_staff))
	{
		echo "<div align='center' style='color:#300'><b>PM : SHL (0)</b></div>";
	}
	else
	{
		echo "<div align='center' style='color:#93C'><b>PM : P(EE) (0.5)</b></div>";
	}
	//echo "<div align='center'><b>".$staff_time_attt_out[0]."</b></div>";
	}
}
}
?>
</td>
 <td align="center" nowrap>
	<?php
    $stsss=1;	
    $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
    
    $rowgreatone=execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'");
	
	$update_attenc=fetcharray(execute("SELECT att_colors,name FROM `leave_att_point` WHERE status=1 and id='$r5[0]'"));
    if(mysql_num_rows($rowgreatone)>=1)
    {
    ?>
    <a href="javascript:void(0);" onClick ="OpenWind2('attvat.php?staffids=<?=$viewss1[4]?>&adate=<?=$adate?>', 'OpenWind3',400,400)"><font color='#006600'>
    <b><font color="<?=$update_attenc[0]?>"><?=$update_attenc[1]?></font></b>
    </font></a>
    <?
    }
	else
	{
    ?>
     <a href="javascript:void(0);" onClick ="OpenWind2('attvat.php?staffids=<?=$viewss1[4]?>&adate=<?=$adate?>', 'OpenWind3',400,400)">Update</a>
    <?php
	}
	?>
        </td>
        
        <td align="center" nowrap><a href="javascript:void(0);" onClick ="OpenWind4('staffdetvew.php?staffid=<?=$viewss1[4]?>', 'OpenWind4',1000,500)"><input type="button" name="del" value="Detail"  class='bgbutton'></a></td>
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

 $total_pages = ceil($total_records / 10);

  

 echo "<p align='center'>";

 if($page==1)
  echo "First&nbsp;";
 else
  echo "<a href='stafftime_jan29.php?page=1&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to First page..'  > First </a> &nbsp;";

 $prv=$page-1;

 if($prv>0)
  echo "<a href='stafftime_jan29.php?page=".$prv."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to Previous page..'  > Previous </a> &nbsp;";
 else
  echo "&#9668;";

 echo "&nbsp;(Page $page of $total_pages)&nbsp;";

 $nxt=($page+1); 

 if($nxt<=$total_pages)
  echo "<a href='stafftime_jan29.php?page=".$nxt."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to Next page..'  > Next </a> &nbsp;"; 
 else
  echo "&#9658;";

 if($page==$total_pages)
  echo "&nbsp;Last&nbsp;";
 else
  echo "<a href='stafftime_jan29.php?page=".$total_pages."&sort_by=".$sort_by."&sort_type=".$sort_type."&adate=".$adate."&bdate=".$bdate."' title='Click to go to Last page..' >Last</a> &nbsp;";

  echo "<br>Total $total_records Staff(s)</p>";
?>

 </td>
 </tr>
</table>
</form>
</body>
</html>

