<?php
$file_name= "Leave_approve.xls";

header("Content-Type: application/$file_type");

header("Content-Disposition: attachment; filename=$file_name");

include("../db1.php");
	
	/*print_r($_POST);*/
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
	$cmnts=$_POST['cmnts'];
	$timein=$_POST['timein'];
	$timeout=$_POST['timeout'];
	$hd_ee_date=$_POST['hd_ee_date'];
	$half_time_in=$_POST['half_time_in'];
	$from_am_pm=$_POST['from_am_pm'];
	$to_am_pm=$_POST['to_am_pm'];
	
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
		$staff_id_us=fetcharray(execute("SELECT srid FROM users where username='$user'"));

$staffrigtss=fetcharray(execute("SELECT shortname FROM `users` where username='$user'"));


$staffnamevali=fetcharray(execute("select b.f_name,b.s_name,b.group_id,b.category,b.recruitment_procedure,b.id from users a,staff_det b where   a.srid=b.id and a.username='$user'"));

if($staffnamevali[4]=='Nonuser')
{
	echo "<br><center><b>You are a Non User!! You cannot view this link</b></center>";
	die();
}


$leave_add=date('Y-m-d H:i:m');
$with_date_test=date('Y-m-d');
?>
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
   <tr>
  <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center" width="10%" nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
     <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center"  nowrap>Reason</td>
    <td class="head" align="center" width="10%" nowrap>Withdrawn</td>
    <td class="head" align="center" nowrap>Reason for<br>Approving/Rejecting</td>
  </tr>
  <?php
	 $mang_hr=execute("select id from staff_det where active='YES'");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.EmployeeCode,a.id,a.approve_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.status_approve,a.manager,a.submit_with,a.status_approve_manger,a.inserted_date from staff_leave a,staff_det c where a.status=1 and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id and a.f_date>'2014-04-21'");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
	
	$daycount=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and approved='0'   and status='1' and reject='0' and status_reason!='2'"));
		
	$daycount_withdrawn=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'"));
		
$daysvat=fetcharray(execute("select tot_paid from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$viewss1[10]' and acc_id='6'"));

	$alltot=$daysvat[0]-$daycount[0]-$daycount_withdrawn[0];

	
	if($viewss1[18]==2)
	{
	$trcolor="leavewith";
	}
	else
	{
		$trcolor='';
	}

if($alltot>0)
{
$alltot1=$alltot;
}
if($alltot<=0)
{
$alltot1=0;
}


$hd_ee_date=explode('-',$viewss1[13]);
$hd_ee_daft_date=$hd_ee_date[2]."-".$hd_ee_date[1]."-".$hd_ee_date[0];

$hd_time_vw_in='';
$hd_time_vw_out='';

if($viewss1[0]=='HD')
{
	$hd_time_vw_in=date(" h:i a",strtotime($viewss1[11]));
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));

	$staflavty[0]='Half Day'."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='EE')
{
	$hd_time_vw_out=date("d-m-Y h:i a",strtotime($viewss1[12]));

	$staflavty[0]='Early Exit'."<br>"."(".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='6')
{
	$hd_time_vw_in=date(" h:i a",strtotime($viewss1[11]));
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));

	$staflavty[0]=$staflavty[0]."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}

$status_check=" ";
$status_text=" ";
	$with_after_approve='1';
 if($viewss1[16]=='2')
	{
	$status_check="disabled";
	$status_text="readonly";
	$with_after_approve='0';
	}
	else
	{
	 $status_check="";
	 $status_text="";
	 $with_after_approve='1';
	}

?>
    <tr>
 <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[20])); ?></td>
        <td nowrap class="<?=$trcolor?>"  align="center"  width="10%"><?=$viewss1[7]?></td>
        <td nowrap class="<?=$trcolor?>"  width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td nowrap class="<?=$trcolor?>"  align="center" width="10%"><?=$staflavty[0]?> 
        <?php
		if($viewss1[0]!='EE' && $viewss1[0]!='6' && $viewss1[0]!='HD')

		{
		?>
        (<?=$daysvat[0]?>)
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>"  align="center"><?=$alltot1?></td>
        <td nowrap class="<?=$trcolor?>"  align="center" width="10%"><?=$fdate21?></td>
        <td nowrap class="<?=$trcolor?>"  align="center" width="10%"><?=$tdate21?>
        <?php
        if($viewss1[14])
		{
		?>
        (<?=$viewss1[14]?>)
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>"  align="center" width="10%"><?=$viewss1[3]?></td>
        <td class="<?=$trcolor?>"  align="justify">&nbsp;<?=stripslashes($viewss1[4])?></td>
        <td nowrap class="<?=$trcolor?>"  align="center" title="Withdrawn Status">
	<?php
	$staff_name_withdrawn=fetcharray(execute("select * from staff_det where id='$viewss1[17]' and active='YES'"));
    if($viewss1[15]=='0')
	{
		echo "<font color='#0033FF'>Pending</font>";
	}
	elseif($viewss1[15]=='2')
	{
		$date_manger=date("d-m-Y h:i a",strtotime($viewss1[19]));
		echo '<font color="#006600">Approved on<br>'."$date_manger".'</font>';
	}
	elseif($viewss1[15]=='3')
	{
		$date_manger=date("d-m-Y h:i a",strtotime($viewss1[19]));
		echo '<font color="#FF0000">Rejected on<br>'."$date_manger".'</font>';
	}
	else
	{
		echo "-";
	}
	?></td>
        <td class="<?=$trcolor?>"  align="justify">
       <?=$viewss1[9]?></td>
          
    </tr>
   <?	
	}
	}
	?>
</table>
</body>
</html>

