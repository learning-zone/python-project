<html>
<head>
<title>Leave Submitted Report</title>

<?php

	session_start();
	include("../db1.php");
?>
<script language='javascript'>
function printReport()
{
	window.print();
}
</script>
<body onLoad="printReport()"><table align='center'  width='100%' border="1" cellpadding="0" cellspacing="0">
<tr>
  <td class="head" align="center" width="3%" nowrap>Sel No.</td>
  <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center" width="10%" nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center" width="40%"  nowrap>Reason</td>
     <td class="head" align="center" width="10%" nowrap>Withdrawn</td>
  </tr>
  <?php
  $mm=1;
	 $mang_hr=execute("select id from staff_det where active='YES'");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{

	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.EmployeeCode,a.id,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.manager,a.status_approve,a.status_with_staff,a.inserted_date,a.submit_with from staff_leave a,staff_det c where a.status=1  and a.approved='0' and a.reject='0' and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id  and a.status_approve!=2");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));


$daycount=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[9]' and type='$viewss1[0]' and approved='0'   and status='1' and reject='0' and status_reason!='2'"));
		
	$daycount_withdrawn=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[9]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'"));
		
$daysvat=fetcharray(execute("select tot_paid,paid_vat from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$viewss1[9]' and acc_id='6'"));

	$alltot=$daysvat[0]-$daycount[0]-$daycount_withdrawn[0]-$daysvat[1];


if($alltot>0)
{
$alltot1=$alltot;
}
if($alltot<=0)
{
$alltot1=0;
}

if($viewss1[19]==2)
	{
	$trcolor="leavewith";
	}
	else
	{
		$trcolor='';
	}
/////////starts///////////////
$hd_time_vw_in='';
$hd_time_vw_out='';
$hd_ee_date=explode('-',$viewss1[12]);
$hd_ee_daft_date=$hd_ee_date[2]."-".$hd_ee_date[1]."-".$hd_ee_date[0];
if($viewss1[0]=='HD')
{
	$hd_time_vw_in=date(" h:i a",strtotime($viewss1[10]));
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[11]));
	
	$staflavty[0]='Half Day'."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='EE')
{
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[11]));

	$staflavty[0]='Early Exit'."<br>"."(".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='6')
{
	$hd_time_vw_in=date(" h:i a",strtotime($viewss1[10]));
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[11]));
	
	$staflavty[0]=$staflavty[0]."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}

////////end/////////

$status_check=" ";
$status_text=" ";
$view_status="1";
$with_staus_date='1';

 if($viewss1[16]=='2')
	{
	$with_staus_date='0';
	$status_check="disabled";
	$status_text="readonly";
	$view_status="";
	}
	else
	{
	$with_staus_date='1';
	 $status_check="";
	 $status_text="";
	 $view_status="1";
	}
	if($view_status==1)
	{
	?>
    <tr>
 <td class="<?=$trcolor?>" align="center" width="3%" nowrap><?=$mm?>&nbsp;</td>
 <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[18])); ?>&nbsp;</td>
        <td class="<?=$trcolor?>" align="center" width="10%" nowrap><?=$viewss1[7]?>&nbsp;</td>
        <td class="<?=$trcolor?>" width="10%" nowrap>&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td class="<?=$trcolor?>" align="center" width="10%" nowrap><?=$staflavty[0]?>
       <?php
		if($viewss1[0]=='1')
		{
		?>
        (<?=$daysvat[0]?>)
        <?php
		}
		?>
         <?php
		if($viewss1[0]=='7')
		{
		?>
        (7)
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>" align="center">
		 <?php
		if($viewss1[0]=='1')
		{
		?>
		<?=$alltot1?>
        <?php
		}
		?>&nbsp;</td>
        <td class="<?=$trcolor?>" align="center" nowrap width="10%"><?=$fdate21?>&nbsp;</td>
        <td class="<?=$trcolor?>" align="center" nowrap width="10%"><?=$tdate21?> 
        <?php
        if($viewss1[13])
		{
		?>
        (<?=$viewss1[13]?>)
        <?php
		}
		?>&nbsp;
        </td>
        <td class="<?=$trcolor?>" nowrap align="center"width="10%"><?=$viewss1[3]?>&nbsp;</td>
        <td class="<?=$trcolor?>"  align="justify">&nbsp;<?=stripslashes($viewss1[4])?>&nbsp;</td>
        <td class="<?=$trcolor?>" nowrap align="center" title="Withdrawn Status">
	<?php
	$staff_name_withdrawn=fetcharray(execute("select * from staff_det where id='$viewss1[15]' and active='YES'"));
    if($viewss1[14]=='0')
	{
		echo "<font color='#0033FF'>Pending</font>";
	}
	elseif($viewss1[14]=='2')
	{
		if($viewss1[19]==1)
		{
			$date_staff_withdrawn=date("d-m-Y h:i a",strtotime($viewss1[17]));
		echo '<font color="#006600">Leave Withdrawn<br>'."$date_staff_withdrawn".'</font>';
		}
		else
		{
		echo '<font color="#006600">Approved on<br>'."$staff_name_withdrawn[f_name]&nbsp;$staff_name_withdrawn[s_name]".'</font>';
		}
	}
	elseif($viewss1[14]=='3')
	{
		echo '<font color="#FF0000">Rejected on<br>'."$staff_name_withdrawn[f_name]&nbsp;$staff_name_withdrawn[s_name]".'</font>';
	}
	else
	{
		echo "-";
	}
	?>&nbsp;</td>
    </tr>
   <?
   $mm++;
	}
	}
	}

	?>
</table>
<br>
</body>
</html>

