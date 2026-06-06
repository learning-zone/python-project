<?php
include("../db.php");
$user=$_SESSION['user'];
$a_year=$_SESSION['AcademicYear'];


$staffname=fetcharray(execute("select b.f_name,b.s_name,b.group_id,b.slno,b.id from users a,staff_det b where a.srid=b.id and a.username='$user'"));
$staff_group=fetcharray(execute("select name from staff_group where id='$staffname[2]'"));
?>
<br>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">

        <li><a href="leave.php?tab=1" >Leave & Attendance</a></li>
       <?php

		$mang_hrrt=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");

 if(mysql_num_rows($mang_hrrt)>0  || $staffrigtss[0]=='admin')

	{



		?>
        <li><a href="leave.php?tab=2" >Leave Approval</a></li>
       
        <li><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
        
        <li><a href="staffdetvew_rprts.php?tab=33" >Staff Attendance Report</a></li>
        <?
	}
		?>
       
        <li><a href="staff_profile.php?tab=20" >My Time Sheet</a></li>
         <li  class="currentBtn"><a href="leave_count11.php?tab=65" >Leave Details</a></li>
        
</ul>
</div>
</div>
<br>
<?php
	$accdispaly=execute("select * from leave_acc_year where status=1 and acc_name!='$a_year' order by acc_name desc");
	while($accdispaly22=fetcharray($accdispaly))
	{
		$test++;
	}
	?>
    <table width="100%" border="1" align="center" cellpadding="0"  cellspacing="0">
    <tr>
    <td colspan="<?=10+$test?>" align='center' class="head" nowrap>Paid Leave</td>
    </tr>
    <tr>
    <td align='center' class='rowpic' nowrap>Staff Name</td>
    <td align='center' class='rowpic' nowrap>Staff Id</td>
    <td align='center' class='rowpic' nowrap>Staff Type</td>
    <td align='center' class='rowpic' nowrap>Leave Eligible for the Year<br><br><?=$a_year?> - <?=$a_year+1?>
    </td>
     <?php
	$acc_dispaly=execute("select * from leave_acc_year where status=1 and acc_name!='$a_year' order by acc_name desc");
	while($acc_dispaly1=fetcharray($acc_dispaly))
	{
	?>
    <td align='center' class='rowpic' nowrap><?=$acc_dispaly1['acc_year']?></td>
   <?php
   $count_acc++;
	}
   ?>
    <td align='center' class='rowpic' nowrap>Leave from Prev <?=$count_acc?> Years</td>
    <td align='center' class='rowpic' nowrap>Leave Availed for the Current Year<br><br><?=$a_year?> - <?=$a_year+1?></td>
    <td align='center' class='rowpic' nowrap>Current Leave Balance</td>
     <td align='center' class='rowpic' nowrap>Unpaid Leave</td> 
      <td align='center' class='rowpic' nowrap>Default</td> 
    </tr>
    <?php
	$staff_type=explode('(',$staff_group[0]);
	?>
    <tr>
    <td align='center'  nowrap><?=$staffname[0]?> <?=$staffname[1]?></td>
    <td align='center'  nowrap><?=$staffname[3]?> </td>
    <td align='center'  nowrap><?=$staff_type[0]?></td>
    <?php
	$paid_tot_count1=fetcharray(execute("SELECT tot_paid from leave_staff_paid_tot_acc_temp where acc_id='6' and staff_id='$staffname[4]'"));
	?>
    <td align='center'  nowrap><?=$paid_tot_count1[0]?></td>
    <?php
		$acc_dispaly_ins=execute("select * from leave_acc_year where status=1  and acc_name!='$a_year'   order by acc_name desc");
		while($acc_dispaly_ins1=fetcharray($acc_dispaly_ins))
		{
			$mm=$acc_dispaly_ins1['id'];
			$hai="acc_".$mm;
			$staff_paid_dis=fetcharray(execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staffname[4]' and acc_id='$mm'"));
			?>
             
			<td align='center'  nowrap><?=$staff_paid_dis['paid_vat']?></td>
			<?php
			$total_paid=$total_paid+$staff_paid_dis['paid_vat'];
		}
		$staff_paid_dis_vat=fetcharray(execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staffname[4]' and acc_id='6'"));
		$sec_totleave2=$paid_tot_count1[0]-$staff_paid_dis_vat[paid_vat];
/////////////////////////////////////////		
$daycount_withdrawn_paid_cnt1='';
$daycount_paid1='';
$daycount_11=execute("select days from staff_leave where staff_id='$staffname[4]' and type='1'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount331=fetcharray($daycount_11))
{
	$daycount_paid1=$daycount331[0]+$daycount_paid1;
}
		
	$daycount_withdrawn441=execute("select days from staff_leave where staff_id='$staffname[4]' and type='1'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_paid1=fetcharray($daycount_withdrawn441))
{
	$daycount_withdrawn_paid_cnt1=$daycount_withdrawn_paid1[0]+$daycount_withdrawn_paid_cnt1;
}
///////////////////////end///////////////////////

///////////early exist///////////////
/*$daycount_ee1='';
$daycount_withdrawn_ee_cnt1='';
$daycount_1_ee1=execute("select days from staff_leave where staff_id='$staffname[4]' and type='EE'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount_1_ee11=fetcharray($daycount_1_ee1))
{
	$daycount_ee1++;
}

$daycount_withdrawn_ee1=execute("select days from staff_leave where staff_id='$staffname[4]' and type='EE'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_ee11=fetcharray($daycount_withdrawn_ee1))
{
	$daycount_withdrawn_ee_cnt1++;
}	*/

////////////////end////////////////////////	
	

///////////outdoor exist///////////////
/*$daycount_out1='';
$daycount_withdrawn_out_cnt1='';
$daycount_1_out1=execute("select * from staff_leave where staff_id='$staffname[4]' and type='6'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount_1_out11=fetcharray($daycount_1_out1))
{
	$daycount_out1++;
}

$daycount_withdrawn_out1=execute("select * from staff_leave where staff_id='$staffname[4]' and type='6'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_out11=fetcharray($daycount_withdrawn_out1))
{
	$daycount_withdrawn_out_cnt1++;
}	*/
////////////////end////////////////////////	
	
$count_ee_out2='';
$leave_count_tot2='';
$levae_availde2='';
$levae_availde_minus2='';
$count_ee_out2=$daycount_withdrawn_out_cnt1+$daycount_out1+$daycount_withdrawn_ee_cnt1+$daycount_ee1;

$leave_count_tot2=$daycount_paid1+$daycount_withdrawn_paid_cnt1+$count_ee_out2;
$levae_availde2=$staff_paid_dis_vat[paid_vat]+$leave_count_tot2;
$levae_availde_minus2=$sec_totleave2-$leave_count_tot2;

		?>
    <td align='center'  nowrap><?=$total_paid?></td>
    <td align='center'  nowrap>
	<?php
    if($paid_tot_count1[0] >= $levae_availde2)
    {
    echo $levae_availde2;
    }
    else
    {
    echo "30";
    }
    ?>
</td>
    <td align='center'  nowrap>
    <?php
	if($levae_availde_minus2>0)
	{
	echo $levae_availde_minus2;
	}
	else
	{
	echo "0";
	}
	?>
    </td>
     <td align='center'  nowrap>0</td> 
      <td align='center'  nowrap>0</td> 
    </tr>
    </table>
    <br>
    <br>
<?php

  $mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
	if(mysql_num_rows($mang_hr)>=1)
{	
?>
    <table width="100%" border="1" align="center" cellpadding="0"  cellspacing="0">
     <tr>
    <td colspan="<?=10+$test?>" align='center' class="head" nowrap>Reportees</td>
    </tr>
    <tr>
    <td colspan="<?=10+$test?>" align='center' class="head" nowrap>Paid Leave</td>
    </tr>
    <tr>
    <td align='center' class='rowpic' nowrap>Staff Name</td>
    <td align='center' class='rowpic' nowrap>Staff Id</td>
    <td align='center' class='rowpic' nowrap>Staff Type</td>
    <td align='center' class='rowpic' nowrap>Leave Eligible for the Year<br><?=$a_year?> - <?=$a_year+1?>
    </td>
     <?php
	$acc_dispaly=execute("select * from leave_acc_year where status=1 and acc_name!='$a_year' order by acc_name desc");
	while($acc_dispaly1=fetcharray($acc_dispaly))
	{
	?>
    <td align='center' class='rowpic' nowrap><?=$acc_dispaly1['acc_year']?></td>
   <?php
   $count_acc3++;
	}
   ?>
    <td align='center' class='rowpic' nowrap>Leave from Prev <?=$count_acc3?>  Years</td>
    <td align='center' class='rowpic' nowrap>Leave Availed for the Current Year<br><?=$a_year?> - <?=$a_year+1?></td>
    <td align='center' class='rowpic' nowrap>Current Leave Balance</td>
     <td align='center' class='rowpic' nowrap>Unpaid Leave</td> 
      <td align='center' class='rowpic' nowrap>Default</td> 
    </tr>
    <?php
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
		$staffname_rprts=fetcharray(execute("select f_name,s_name,group_id,slno from staff_det where id='$mang_hr_rgts[0]'"));
$staff_group_rprts=fetcharray(execute("select name from staff_group where id='$staffname_rprts[2]'"));

	$staff_type_rprts=explode('(',$staff_group_rprts[0]);
	?>
    <tr>
    <td align='center'  nowrap><?=$staffname_rprts[0]?> <?=$staffname_rprts[1]?></td>
    <td align='center'  nowrap><?=$staffname_rprts[3]?> </td>
    <td align='center'  nowrap><?=$staff_type_rprts[0]?></td>
    <?php
    $paid_tot_count2=fetcharray(execute("SELECT tot_paid from leave_staff_paid_tot_acc_temp where acc_id='6' and staff_id='$mang_hr_rgts[0]'"));
    ?>
    <td align='center'  nowrap><?=$paid_tot_count2[0]?></td>
    <?php
		$acc_dispaly_ins=execute("select * from leave_acc_year where status=1  and acc_name!='$a_year'  order by acc_name desc");
		while($acc_dispaly_ins1=fetcharray($acc_dispaly_ins))
		{
			$mm=$acc_dispaly_ins1['id'];
			$hai="acc_".$mm;
			$staff_paid_dis=fetcharray(execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$mang_hr_rgts[0]' and acc_id='$mm'"));
			?>
             
			<td align='center'  nowrap><?=$staff_paid_dis['paid_vat']?></td>
			<?php
			$total_paid22=$total_paid22+$staff_paid_dis['paid_vat'];
		}
		$staff_paid_dis_vat2=fetcharray(execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$mang_hr_rgts[0]' and acc_id='6'"));
		$sec_totleave=$paid_tot_count2[0]-$staff_paid_dis_vat2[paid_vat];
/////////////////////start///////////////////////////		
$daycount_withdrawn_paid_cnt='';
$daycount_paid='';
$daycount_1=execute("select days from staff_leave where staff_id='$mang_hr_rgts[0]' and type='1'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount33=fetcharray($daycount_1))
{
	$daycount_paid=$daycount33[0]+$daycount_paid;
}
		
	$daycount_withdrawn44=execute("select days from staff_leave where staff_id='$mang_hr_rgts[0]' and type='1'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_paid=fetcharray($daycount_withdrawn44))
{
	$daycount_withdrawn_paid_cnt=$daycount_withdrawn_paid[0]+$daycount_withdrawn_paid_cnt;
}
///////////////////////end///////////////////////

///////////early exist///////////////
/*$daycount_ee='';
$daycount_withdrawn_ee_cnt='';
$daycount_1_ee=execute("select days from staff_leave where staff_id='$mang_hr_rgts[0]' and type='EE'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount_1_ee1=fetcharray($daycount_1_ee))
{
	$daycount_ee++;
}

$daycount_withdrawn_ee=execute("select days from staff_leave where staff_id='$mang_hr_rgts[0]' and type='EE'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_ee1=fetcharray($daycount_withdrawn_ee))
{
	$daycount_withdrawn_ee_cnt++;
}*/	

////////////////end////////////////////////	
	

///////////outdoor exist///////////////
/*$daycount_out='';
$daycount_withdrawn_out_cnt='';
$daycount_1_out=execute("select * from staff_leave where staff_id='$mang_hr_rgts[0]' and type='6'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount_1_out1=fetcharray($daycount_1_out))
{
	$daycount_out++;
}

$daycount_withdrawn_out=execute("select * from staff_leave where staff_id='$mang_hr_rgts[0]' and type='6'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_out1=fetcharray($daycount_withdrawn_out))
{
	$daycount_withdrawn_out_cnt++;
}*/	
////////////////end////////////////////////	
$count_ee_out='';
$leave_count_tot='';
$levae_availde='';
$levae_availde_minus='';
$count_ee_out=$daycount_withdrawn_out_cnt+$daycount_out+$daycount_withdrawn_ee_cnt+$daycount_ee;

$leave_count_tot=$daycount_paid+$daycount_withdrawn_paid_cnt+$count_ee_out;
$levae_availde=$staff_paid_dis_vat2[paid_vat]+$leave_count_tot;
$levae_availde_minus=$sec_totleave-$leave_count_tot;

/////////////////totals//////

		
		?>
    <td align='center'  nowrap><?=$total_paid22?></td>
    <td align='center'  nowrap><?=$levae_availde?></td>
    <td align='center'  nowrap><?=$levae_availde_minus?></td>
     <td align='center'  nowrap>0</td> 
      <td align='center'  nowrap>0</td> 
    </tr>
     <?php
	 $total_paid22='';
	 $sec_totleave='';
	 $paid_tot_count2[0]='';
	}
	
	?>
    </table>
    <?php
}
	?>