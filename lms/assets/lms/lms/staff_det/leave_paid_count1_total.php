<?php
include("../db.php");
echo date('d-m-Y h:m:i');
$user=$_SESSION['user'];
$a_year=$_SESSION['AcademicYear'];
$paid=$_POST['paid'];
$paid_eligible=$_POST['paid_eligible'];
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
{
	$sort_by="f_name";
}
if($sort_type=="")
{
	$sort_type="ASC";
}
	
?>
<Script language="JavaScript">	
	function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
</script>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<li><a href="leavesetup.php?tab=1" >Leave Setup</a></li>
<li><a href="leavestaffsetup.php?tab=2" >Staff Leave Detail</a></li>
<li><a href="staff_calnd.php?tab=3" >Staff Calendar</a></li>
<li><a href="staff_time.php?tab=4" >Staff Timing</a>
<li><a href="att_point.php?tab=5" >Attendance Point</a>
<li class="currentBtn"><a href="leave_paid_count1.php?tab=7" >Paid Leave Update</a>
</li>
<li><a href="leave_acc.php?tab=8">Staff Academic Setup</a></li>
</ul>
</div>
</div>
<br />
 <?php
	$accdispaly=execute("select * from leave_acc_year where status=1 and acc_name!='$a_year' order by acc_name desc");
	while($accdispaly22=fetcharray($accdispaly))
	{
		$test++;
	}
	?>
    <form  method="post" name="frm">
    <table width="100%" border="1" align="center" cellpadding="3"  cellspacing="0">
    <tr>
    <td colspan="<?=10+$test?>" align='center' class="head" nowrap>Paid Leave</td>
    </tr>
    <tr>
    <td align='center' class='rowpic' nowrap>Sl</td>
    <td align='center' class='rowpic' nowrap><a href="<?php echo "leave_paid_count1.php?sort_by=f_name&sort_type=ASC";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font>
</a>Staff Name<a href="<?php echo "leave_paid_count1.php?sort_by=f_name&sort_type=DESC";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font></a></td>
    <td align='center' class='rowpic' nowrap>Staff Id</td>
    <td align='center' class='rowpic' nowrap>Staff Type</td>
    <td align='center' class='rowpic' nowrap>Leave Eligible for the Year<br><?=$a_year?> - <?=$a_year+1?>
    </td>
   
    <td align='center' class='rowpic' nowrap>Leave Availed for the Current Year<br><?=$a_year?> - <?=$a_year+1?></td>
     <td align='center' class='rowpic' nowrap>Unpaid Leave</td>
         <td align='center' class='rowpic' nowrap>Teaching</td>
    <td align='center' class='rowpic' nowrap>Non Teaching</td>
     <td align='center' class='rowpic' nowrap>Unpaid Leave</td>
     <td align='center' class='rowpic' nowrap>Balance</td>
    </tr>
    <?php
	$c=1;
$staff_name_display="SELECT * from staff_det where active='YES' and (recruitment_procedure='User' or recruitment_procedure='')";
$staff_name_display.=" ORDER BY f_name";
$staffname22=execute($staff_name_display);
	while($staff_name_dis1=fetcharray($staffname22))
	{
		
		
		$staffname=fetcharray(execute("select f_name,s_name,group_id,EmployeeCode,category from staff_det  where id='$staff_name_dis1[id]'"));
		$staff_group=fetcharray(execute("select name from staff_group where id='$staffname[2]'"));
		$staff_type=explode('(',$staff_group[0]);
		
		
		$stafftype_nm='';
	if($staffname[4]=='1')
	{
		$stafftype_nm="Teaching";
	}
	if($staffname[4]=='2')
	{
		$stafftype_nm="Non Teaching";
	}
		?>
		<input type="hidden" name="satff[]" value="<?=$staff_name_dis1['id']?>">
		<tr>
		<td align='center'  nowrap><?=$c?></td>
		<td align='center'  nowrap><?=$staffname[0]?> <?=$staffname[1]?></td>
		<td align='center'  nowrap><?=$staffname[3]?> </td>
		<td align='center'  nowrap><?=$stafftype_nm?></td>
        <?php
		$staff_Eligible=fetcharray(execute("select tot_paid from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staff_name_dis1[id]' and acc_id='6'"));
		$mm=6;
		//echo $staff_name_dis1[id]."==".$staff_Eligible[0];
		?>
		  <td align='center'  nowrap>
           <input type="hidden" name="satff_acc<?=$staff_name_dis1['id']?>[]" value="<?=$mm?>">
		  <input type="text" name="paid_eligible<?=$mm?>_<?=$staff_name_dis1[id]?>" value="<?=$staff_Eligible[0]?>" size="3%" /></td>
		
		<!--<td align='center'  nowrap>0</td>-->
        <?php
		$acc_dispaly_insnxt=execute("select * from leave_acc_year where status=1 and acc_name='$a_year'  order by acc_name desc");
		while($acc_dispaly_ins1nxt=fetcharray($acc_dispaly_insnxt))
		{
			$mm=$acc_dispaly_ins1nxt['id'];
			$hai="acc_".$mm;
			$staff_paid_disnxt=fetcharray(execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staff_name_dis1[id]' and acc_id='$mm'"));
			
/////////////////////////////////////////////////////			
$daycount_withdrawn_paid_cnt='';
$daycount_paid='';
$daycount_1=execute("select days from staff_leave where staff_id='$staff_name_dis1[id]' and type='1'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount33=fetcharray($daycount_1))
{
	$daycount_paid=$daycount33[0]+$daycount_paid;
}
		
	$daycount_withdrawn44=execute("select days from staff_leave where staff_id='$staff_name_dis1[id]' and type='1'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_paid=fetcharray($daycount_withdrawn44))
{
	$daycount_withdrawn_paid_cnt=$daycount_withdrawn_paid[0]+$daycount_withdrawn_paid_cnt;
}
///////////////////////end///////////////////////
///////////early exist///////////////
/*$daycount_ee='';
$daycount_withdrawn_ee_cnt='';
$daycount_1_ee=execute("select days from staff_leave where staff_id='$staff_name_dis1[staff_id]' and type='EE'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount_1_ee1=fetcharray($daycount_1_ee))
{
	$daycount_ee++;
}
$daycount_withdrawn_ee=execute("select days from staff_leave where staff_id='$staff_name_dis1[staff_id]' and type='EE'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_ee1=fetcharray($daycount_withdrawn_ee))
{
	$daycount_withdrawn_ee_cnt++;
}*/	
////////////////end////////////////////////	
	
///////////outdoor exist///////////////
/*$daycount_out='';
$daycount_withdrawn_out_cnt='';
$daycount_1_out=execute("select * from staff_leave where staff_id='$staff_name_dis1[staff_id]' and type='6'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount_1_out1=fetcharray($daycount_1_out))
{
	$daycount_out++;
}
$daycount_withdrawn_out=execute("select * from staff_leave where staff_id='$staff_name_dis1[staff_id]' and type='6'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_out1=fetcharray($daycount_withdrawn_out))
{
	$daycount_withdrawn_out_cnt++;
}	
*/////////////////end////////////////////////	
$count_ee_out='';
$leave_count_tot='';
$levae_availde='';
$levae_availde_minus='';
$count_ee_out=$daycount_withdrawn_out_cnt+$daycount_out+$daycount_withdrawn_ee_cnt+$daycount_ee;
$leave_count_tot=$daycount_paid+$daycount_withdrawn_paid_cnt+$count_ee_out;
$levae_availde=$staff_paid_disnxt[paid_vat]+$leave_count_tot;
/////////////////totals//////
			
			
			?>
			 <input type="hidden" name="satff_acc<?=$staff_name_dis1['id']?>[]" value="<?=$mm?>">
             
			<td align='center'  nowrap><input type="text" name="paid<?=$mm?>_<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_disnxt[paid_vat]?>" size="3%" readonly="readonly" /></td>
			<?php
			
		}
		/*$staff_paid_dis_vatnxt=fetcharray(execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staff_name_dis1[id]' and acc_id='6'"));
		$totbalance=$staff_Eligible[0]-$staff_paid_dis_vatnxt[paid_vat];
		
		$levae_availde_minus=$totbalance-$leave_count_tot;*/
		$staff_unpaid=fetcharray(execute("select un_paid,paid_vat from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staff_name_dis1[id]' and acc_id='6'"));
		/*if($levae_availde_minus<0)
		{
			$unpadminus=$levae_availde_minus;
			$unpa_vat=$staff_unpaid[0];
			$levae_availde_minus=0;
		}*/
		
				$staff_paid_local=fetcharray(execute("select a.paid_vat,a.un_paid,b.id from  leave_staff_paid_tot_acc_temp a,staff_det b where a.staff_id='$staff_name_dis1[id]' and a.staff_id=b.id and a.status=1 and a.acc_id=6"));
				$haiss='';
				
			//	$paid_leaves_tot=$staff_paid_local[0]+$staff_unpaid[1];
				//$unpaid_leaves_tot=$staff_paid_local[1]+$staff_unpaid[0];
if($staff_Eligible[0]<=$staff_paid_local[0])
{
	$staff_paid_local[2].$haiss=0;
}
else
{
	$haiss=$staff_Eligible[0]-$staff_paid_local[0];
}

echo "<br>update leave_staff_paid_tot_acc_temp set cur_balance='$haiss' where staff_id='$staff_paid_local[2]' and acc_id='6'";
//execute("update leave_staff_paid_tot_acc_temp set cur_balance='$haiss' where staff_id='$staff_paid_local[2]' and acc_id='6'");
$paid_leaves_tot='';
$unpaid_leaves_tot='';
		?>
		<td align='center'  nowrap><?=$staff_paid_local[3]?>----<?=$unpa_vat?></td> 
		<td align='center'  nowrap><?=$staff_paid_local[1]?></td> 
		<td align='center'  nowrap><?=$staff_paid_local[0]?></td> 
        <td align='center'  nowrap><?=$staff_paid_local[2]?></td>
        <td align='center'  nowrap><?=$haiss?> </td>
		</tr>
		<?php
		$c++;
		$unpa_vat='';
		$totbalance='';
		$staffname[0]='';
		$staffname[1]='';
		$staffname[3]='';
		$staff_type[0]='';
		$total_paid='';
	}
	?>
    </table>
   </form>