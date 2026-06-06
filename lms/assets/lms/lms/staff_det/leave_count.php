<?php
include("../db.php");
$user=$_SESSION['user'];
$a_year=$_SESSION['AcademicYear'];


$staffname=fetcharray(execute("select b.f_name,b.s_name,b.group_id,b.EmployeeCode,b.id,b.category from users a,staff_det b where a.srid=b.id and a.username='$user'"));
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
         <li><a href="stafftime_update.php?tab=111" >Staff Time Sheet Update</a></li>
        <?
	}
		?>
       
        <li><a href="staff_profile.php?tab=20" >My Time Sheet</a></li>
         <li  class="currentBtn"><a href="leave_count.php?tab=65" >Leave Details</a></li>
        
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
    <td align='center' class='rowpic' nowrap><!--Leave Eligible for the Year<br><br><?=$a_year?> - <?=$a_year+1?>-->Leave Eligible for the Current Year 
    </td>
     <?php
	 if($staffname[5]!=1)
	 {
	$acc_dispaly=execute("select * from leave_acc_year where status=1 and acc_name!='$a_year'  and id!=7 order by acc_name desc");
	while($acc_dispaly1=fetcharray($acc_dispaly))
	{
	?>
<!--    <td align='center' class='rowpic' nowrap><?=$acc_dispaly1['acc_year']?></td>
-->   <?php
   $count_acc++;
	}
	 }
	 if($staffname[5]!=1)
	 {				

   ?>
    <td align='center' class='rowpic' nowrap>Leave from Prev <?=$count_acc?> Years</td>
    <?
	 }
	?>
    <!--<td align='center' class='rowpic' nowrap>Leave Availed for the Current Year<br><br><?=$a_year?> - <?=$a_year+1?></td>-->
    <td align='center' class='rowpic' nowrap>Current Year Leave Balance</td>
  <!--   <td align='center' class='rowpic' nowrap>Unpaid Leave</td> 
      <td align='center' class='rowpic' nowrap>Default</td> 
  -->  </tr>
    <?php
	$stafftype_nm='';
	if($staffname[5]=='1')
	{
		$stafftype_nm="Permanent";
	}
	if($staffname[5]=='2')
	{
		$stafftype_nm="Contractual";
	}
	
	?>
    <tr>
    <td align='center'  nowrap><?=$staffname[0]?> <?=$staffname[1]?></td>
    <td align='center'  nowrap><?=$staffname[3]?> </td>
    <td align='center'  nowrap><?=$stafftype_nm?></td>
    <?php
	$paid_tot_count1=fetcharray(execute("SELECT tot_paid from leave_staff_paid_tot_acc_temp where acc_id='6' and staff_id='$staffname[4]'"));
	?>
    <td align='center'  nowrap><?=$paid_tot_count1[0]?></td>
    <?php
	if($staffname[5]!=1)
	 {
		$acc_dispaly_ins=execute("select * from leave_acc_year where status=1  and acc_name!='$a_year' and id!=7  order by acc_name desc");
		while($acc_dispaly_ins1=fetcharray($acc_dispaly_ins))
		{
			$mm=$acc_dispaly_ins1['id'];
			$hai="acc_".$mm;
			$staff_paid_dis=fetcharray(execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staffname[4]' and acc_id='$mm'"));
			?>
             
			<!--<td align='center'  nowrap><?=$staff_paid_dis['paid_vat']?></td>-->
			<?php
			$total_paid=$total_paid+$staff_paid_dis['paid_vat'];
		}
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

$prvsyear1='';
$final_prvyear1='';
		$prvsyear1=$levae_availde2-$paid_tot_count1[0];
		if($prvsyear1>0 && $total_paid>0)
		{
			$final_prvyear1=$total_paid-$prvsyear1;
		}
		else
		{
			$final_prvyear1=$total_paid;
		}

$staff_unpaid_leave=fetcharray(execute("select  Apr_13,May_13,June_13,	July_13,Aug_13,Sep_13,Oct_13,Nov_13,Dec_13,Jan_14,Feb_14,March_14,id from unpaid_leave_data_m20 where staff_id='$staffname[4]'"));
		$total_unpaid_exl='';
				$total_unpaid_exl=$staff_unpaid_leave['May_13']+$staff_unpaid_leave['June_13']+$staff_unpaid_leave['July_13']+$staff_unpaid_leave['Aug_13']+$staff_unpaid_leave['Sep_13']+$staff_unpaid_leave['Oct_13']+$staff_unpaid_leave['Nov_13']+$staff_unpaid_leave['Dec_13']+$staff_unpaid_leave['Jan_14']+$staff_unpaid_leave['Feb_14']+$staff_unpaid_leave['March_14'];
if($staffname[5]!=1)
	 {				
		?>
    <td align='center'  nowrap><?=$final_prvyear1?></td>
    <?
	 }
	?>
<!--    <td align='center'  nowrap><?=$staff_paid_dis_vat[paid_vat]?></td>
-->    <td align='center'  nowrap>
	<?
	$unpaid_cnt_s2='';
	$flgass2=0;
	if($levae_availde_minus2<=0)
	{
	//echo "0";
	$flgass2=1;	
	}
	if($levae_availde_minus2>'0')
	{
	?>
	<!--$levae_availde_minus2-->
    <?
	}
	?>
    <?=$staff_paid_dis_vat[cur_balance]?>
	</td>
 <!--    <td align='center'  nowrap>
	 <?php
	 if($flgass2==1 && $total_paid==0)
	{
		
		$unpaid_cnt_s2=$levae_availde2-$paid_tot_count1[0];
		//echo $unpaid_cnt_s2=$total_unpaid_exl+$unpaid_cnt_s2;
		//$unpaid_cnt_s=$levae_availde_minus*("-1");
	}
	$staff_paid_dis_vat[un_paid]
	?>
     </td> 
      <td align='center'  nowrap>0</td> 
 -->   </tr>
    </table>
    <br>
    <br>
<?php
  $mang_hr=execute("select c.staff_id from staff_det a,users b,staff_hr_grup c where c.status=1 and b.username='$user' and a.id=c.staff_id and a.active='YES'  and (a.recruitment_procedure='User' or a.recruitment_procedure='')  and b.srid IN ( c.hr_id,c.mng_id) group by c.staff_id order by a.f_name
");
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
    <td align='center' class='rowpic' nowrap><!--Leave Eligible for the Year<br><?=$a_year?> - <?=$a_year+1?>-->Leave Eligible for the Current Year
    </td>
     <?php
	 
	$acc_dispaly=execute("select * from leave_acc_year where status=1 and acc_name!='$a_year' and id!=7 order by acc_name desc");
	while($acc_dispaly1=fetcharray($acc_dispaly))
	{
	?>
    <!--<td align='center' class='rowpic' nowrap><?=$acc_dispaly1['acc_year']?></td>-->
   <?php
   $count_acc3++;
	}
   ?>
    <td align='center' class='rowpic' nowrap>Leave from Prev <?=$count_acc3?>  Years</td>
<!--    <td align='center' class='rowpic' nowrap>Leave Availed for the Current Year<br><?=$a_year?> - <?=$a_year+1?></td>-->
   <td align='center' class='rowpic' nowrap>Current Year Leave Balance</td>
<!--     <td align='center' class='rowpic' nowrap>Unpaid Leave</td> 
      <td align='center' class='rowpic' nowrap>Default</td> 
-->    </tr>
    <?php
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
		$staffname_rprts=fetcharray(execute("select f_name,s_name,group_id,EmployeeCode,category from staff_det where id='$mang_hr_rgts[0]'"));
$staff_group_rprts=fetcharray(execute("select name from staff_group where id='$staffname_rprts[2]'"));

	$staff_type_rprts=explode('(',$staff_group_rprts[0]);
	
	$stafftype_nm1='';
	if($staffname_rprts[4]=='1')
	{
		$stafftype_nm1="Permanent";
	}
	if($staffname_rprts[4]=='2')
	{
		$stafftype_nm1="Contractual";
	}
	?>
    <tr>
    <td align='center'  nowrap><?=$staffname_rprts[0]?> <?=$staffname_rprts[1]?></td>
    <td align='center'  nowrap><?=$staffname_rprts[3]?> </td>
    <td align='center'  nowrap><?=$stafftype_nm1?></td>
    <?php
    $paid_tot_count2=fetcharray(execute("SELECT tot_paid from leave_staff_paid_tot_acc_temp where acc_id='6' and staff_id='$mang_hr_rgts[0]'"));
    ?>
    <td align='center'  nowrap><?=$paid_tot_count2[0]?></td>
    <?php
		$acc_dispaly_ins=execute("select * from leave_acc_year where status=1  and acc_name!='$a_year'  and id!=7  order by acc_name desc");
		while($acc_dispaly_ins1=fetcharray($acc_dispaly_ins))
		{
			$mm=$acc_dispaly_ins1['id'];
			$hai="acc_".$mm;
			$staff_paid_dis=fetcharray(execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$mang_hr_rgts[0]' and acc_id='$mm'"));
			?>
             
<!--			<td align='center'  nowrap><?=$staff_paid_dis['paid_vat']?></td>
-->			<?php
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
$prvsyear='';
$final_prvyear='';
		$prvsyear=$levae_availde-$paid_tot_count2[0];
		if($prvsyear>0 && $total_paid22>0)
		{
			$final_prvyear=$total_paid22-$prvsyear;
		}
		else
		{
			$final_prvyear=$total_paid22;
		}
		
		$staff_unpaid_leave1=fetcharray(execute("select  Apr_13,May_13,June_13,	July_13,Aug_13,Sep_13,Oct_13,Nov_13,Dec_13,Jan_14,Feb_14,March_14,id from unpaid_leave_data_m20 where staff_id='$mang_hr_rgts[0]'"));
		$total_unpaid_exl1='';
				$total_unpaid_exl1=$staff_unpaid_leave1['May_13']+$staff_unpaid_leave1['June_13']+$staff_unpaid_leave1['July_13']+$staff_unpaid_leave1['Aug_13']+$staff_unpaid_leave1['Sep_13']+$staff_unpaid_leave1['Oct_13']+$staff_unpaid_leave1['Nov_13']+$staff_unpaid_leave1['Dec_13']+$staff_unpaid_leave1['Jan_14']+$staff_unpaid_leave1['Feb_14']+$staff_unpaid_leave1['March_14'];

		?>
    <td align='center'  nowrap><?=$final_prvyear?></td>
<!--    <td align='center'  nowrap><?=$staff_paid_dis_vat2[paid_vat]?></td>
-->    <td align='center'  nowrap>
	<?
	$unpaid_cnt_s='';
	$flgass=0;
	if($levae_availde_minus<=0)
	{
	//echo "0";
	$flgass=1;	
	}
	if($levae_availde_minus>'0')
	{
	?>
	<!--$levae_availde_minus-->
    <?
	}
	?>
    <?=$staff_paid_dis_vat2[cur_balance]?>
    </td>
     <!--<td align='center'  nowrap>
     <?php
	 if($flgass==1 && $total_paid22==0)
	{
		
		$unpaid_cnt_s=$levae_availde-$paid_tot_count2[0];
		//echo $unpaid_cnt_s=$total_unpaid_exl1+$unpaid_cnt_s;
		//$unpaid_cnt_s=$levae_availde_minus*("-1");
	}
	$staff_paid_dis_vat2[un_paid]
	?>
	 </td> 
      <td align='center'  nowrap>0</td> -->
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