<html>
<title>Date Wise Approval</title>
 <?php
	include("../db.php");
	//print_r($_POST);
	$user=$_SESSION['user'];
	$insids=$_REQUEST['insids'];
	$type_point=$_POST['type_point'];
	$ttimess=date('H:i:s');
	$with_date_test=date('Y-m-d');
	$leave_add=date('Y-m-d H:i:m');
	$staff_id_us=fetcharray(execute("SELECT srid FROM users where username='$user'"));
	
	$pay_roll_out_ee='';
		$leave_type_pay=fetcharray(execute("SELECT type FROM `staff_leave` WHERE status=1 and id='$insids'"));
		if($leave_type_pay[0]=='EE' || $leave_type_pay[0]=='6')
		{
		$pay_roll_out_ee=1;
		}
		
		if($pay_roll_out_ee)
		{
		
		$leave_pay_roll_ee=fetcharray(execute("SELECT hd_ee_da_date,staff_id FROM `staff_leave` WHERE status=1 and id='$insids'"));
		$pfdate=$leave_pay_roll_ee[0];
		$ptdate=$leave_pay_roll_ee[0];
		$staffids=$leave_pay_roll_ee[1];
		}
		else
		{
		$leave_pay_roll_nor=fetcharray(execute("SELECT f_date,t_date,staff_id FROM `staff_leave` WHERE status=1 and id='$insids'"));
		$pfdate=$leave_pay_roll_nor[0];
		$ptdate=$leave_pay_roll_nor[1];
		$staffids=$leave_pay_roll_nor[2];
		}
		
		$staffname=fetcharray(execute("select f_name,s_name,group_id,EmployeeCode from staff_det  where id='$staffids'"));	
		
	$staffrigtss=fetcharray(execute("SELECT shortname FROM `users` where username='$user'"));
	
		if($staffrigtss[0]=='admin')
		{
			$code_relods="leave_admin.php";
		}
		else
		{
		$code_relods="leave.php";
		}
	
$stafftime_val=strtotime('17:00');

	?>

<head>

<script language="javascript" src="cal2.js"></script>

<script language="javascript" src="cal_conf2.js"></script>



</head>
<?php
if($_POST['subn'])
{
	$satff=$_POST['satff'];
	for($d=0;$d<sizeof($satff);$d++)
	{		
		$stfid=$satff[$d];
		$type_point_vat=$_POST['type_point'.$stfid];
		
		if($type_point_vat!='')
		{	
			$Sql66=mysql_query(" select id from staff_att_updt where toddate='$stfid' and staff_id='$staffids'");
			if(mysql_num_rows($Sql66)>0)
			{
				$sql33="update staff_att_updt set type='$type_point_vat',leave_approval='$insids',insert_date='$with_date_test',user='$user',todtime='$ttimess'  where toddate='$stfid' and staff_id='$staffids'";
				mysql_query($sql33);
				
			$staff_leave_up="update staff_leave set approved='1',staff_att_approve='1',user_manager='$user',updated_date='$leave_add',user_id='$staff_id_us[0]' where  id='$insids'";
			mysql_query($staff_leave_up);
			}
			else
			{
				$staff_leave_up="update staff_leave set approved='1',staff_att_approve='1',user_manager='$user',updated_date='$leave_add',user_id='$staff_id_us[0]'  where  id='$insids'";
				mysql_query($staff_leave_up);
				
			mysql_query("INSERT INTO staff_att_updt (staff_id, user, type, toddate, todtime,leave_approval,insert_date) VALUES ( '$staffids', '$user', '$type_point_vat', '$stfid', '$ttimess','$insids','$with_date_test')");
			
			}
		}
	}
	?>
	<Script language="JavaScript">
	alert("Updated Sucessfully!");
	</Script>
	<?
}
?>

<body>

<form Name="frm"  method="post">

<input type="hidden" name="staffids" value="<?=$staffids?>"/>

<br>  
<?php

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

$date_from=explode('-',$pfdate);

$leave_types=fetcharray(execute("SELECT type FROM `staff_leave` WHERE status=1 and id='$insids'"));

$leave_namess=fetcharray(execute("select leave_name from staff_leave_type where id='$leave_types[0]'"));
if($leave_types[0]=='EE')
{
	$leave_namess[0]="Early Exit";
}
?>
<!--<table align="center" border="1" cellpadding="0" cellspacing="0" width="70%">
<tr>
<?
/*$k=1;
$daydisp=execute("select full_name,name from leave_att_point where status=1 ");
while($leave_namess=fetcharray($daydisp))
{*/
	?>
    
    	<td style="background:none"><font color="#000000"><?php echo "<b>".$leave_namess[1]."</b> : ".$leave_namess[0]?></font></td>
        <?

// if($k % 5==0)
// {
 	?>
    	</tr>
    <?
 /*}
 $k++;
}*/
?>
</table>-->
<br>
<br>
<table  align='center' border="1" width="80%" cellpadding="3" cellspacing="0">

<tr>
<td colspan="30" class="head" align="center">&nbsp;<b>Date Wise Approval for <?=$staffname[0]?> <?=$staffname[1]?></b></td>
</tr>
<tr>
<td align="center" nowrap class='rowpic'>Leave Type</td>
<td align="center" nowrap class='rowpic'>Date</td>
<td align="center" nowrap class='rowpic' colspan="22">Leave Points</td>
</tr>
<?
 for($c=0;$c<$tot_day;$c++)
{
$attview = mktime(0,0,0,$date_from[1],$date_from[2]+$c,$date_from[0]);
$viewdate_att=date("d/m/Y", $attview);
$apprval_date=date("Y-m-d", $attview);
$viewdate_sunday=date("D", $attview);

$staff_calender=fetcharray(execute("select fromdate from staff_calenders where status='1' and fromdate='$apprval_date' and staff_typ='$staffname[2]'"));
?>
<tr>
<td align="center" nowrap><?=$leave_namess[0]?></td>
<td align="center" nowrap><?=$viewdate_att?></td>
<?php
		if(strtotime($staff_calender[0])==strtotime($apprval_date))
		{
		$view_holidays='';
		if($viewdate_sunday=='Sat' || $viewdate_sunday=='Sun')
		{
		$view_holidays='WO';
		}
		else
		{
		$view_holidays='H';
		}		
?>
<td align="center" colspan="4" nowrap><font color="#0000FF"><b><?=$view_holidays?></b></font></td>
<?
		}
		elseif($viewdate_sunday=='Sun')
		{
?>
<td align="center" colspan="4" nowrap><font color="#0000FF"><b>WO</b></font></td>
<?
}
else
{
	?>
<input type="hidden" name="satff[]" value="<?=$apprval_date?>">
<?php
$update_attenc=execute("SELECT * FROM `leave_att_point` WHERE status=1");
while($update_attenc1=fetcharray($update_attenc))
{
	
	$r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$apprval_date' and staff_id='$staffids' and type='$update_attenc1[id]'"));	

			if($r5[0])
			$check11='checked';
			else
			$check11='';
			
			if($update_attenc1[id]==1)
			{
				$update_attenc1[name]="Paid";
			}
			if($update_attenc1[id]==1 || $update_attenc1[id]==8)
			{
	?>
<!-- <input type="hidden" name="satff_acc<?=$apprval_date?>[]" value="<?=$update_attenc1[id]?>">
--> 
	<td align="center" nowrap>&nbsp;<b><?=$update_attenc1[name]?></b></td>

	<td align="center" nowrap><input type="radio" name="type_point<?=$apprval_date?>" value="<?=$update_attenc1[id]?>" <?=$check11?>>

    </td>
<?
			}
}
}
?>
</tr>
<?
}
?>
</table>
<?php

	/////////////payroll/////////////		

		$from_pay_today=explode('-',$with_date_test);
		
		if($from_pay_today[2]==22)
		{
			$systemtime=strtotime($ttimess);
		}
	
		$from_pay_20=$from_pay_today[0]."-".$from_pay_today[1]."-22";
		
	if((strtotime($with_date_test) > strtotime($from_pay_20)) || ($systemtime>$stafftime_val))
	{
		$topay_validate=date('Y-m-d', strtotime('1 month', strtotime($from_pay_20)));
		//payroll fromdate
		$topay_pay_date1=explode('-',$from_pay_20);
		$topay_mnth_pay=$topay_pay_date1[0]."-".$topay_pay_date1[1]."-21";
		//payroll todate
		$topay_pay_bdate1=explode('-',$topay_validate);
		$topay_mnth_bpay=$topay_pay_bdate1[0]."-".$topay_pay_bdate1[1]."-22";
			
		$from_date_pay=$topay_mnth_pay;
		$to_date_pay=$topay_mnth_bpay;
	}
	else
	{
		$topay_validate=date('Y-m-d', strtotime('-1 month', strtotime($from_pay_20)));
		//payroll fromdate		
		$topay_pay_bdate1=explode('-',$topay_validate);
		$topay_mnth_bpay=$topay_pay_bdate1[0]."-".$topay_pay_bdate1[1]."-21";
		//payroll todate
		$topay_pay_date1=explode('-',$from_pay_20);
		$topay_mnth_pay=$topay_pay_date1[0]."-".$topay_pay_date1[1]."-22";
				
		$from_date_pay=$topay_mnth_bpay;
		$to_date_pay=$topay_mnth_pay;
	}
			
//////////////////////end///////////////////////	
	
$pay_nt_authorized='';
if($pay_roll_out_ee)
{
	
	$leave_pay_roll=fetcharray(execute("SELECT hd_ee_da_date FROM `staff_leave` WHERE status=1 and id='$insids'"));
	if(strtotime($leave_pay_roll[0])<strtotime($from_date_pay))
	{
		$pay_nt_authorized=1;
	}
}
else
{
	
	$leave_pay_roll=fetcharray(execute("SELECT f_date,t_date FROM `staff_leave` WHERE status=1 and id='$insids'"));
	if(strtotime($leave_pay_roll[0])<strtotime($from_date_pay) || strtotime($leave_pay_roll[1])<strtotime($from_date_pay))
	{
		$pay_nt_authorized=1;
	}
}	 

 $manager_admin=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid=b.mng_id)");

if(mysql_num_rows($manager_admin)>=1 || $staffrigtss[0]=='admin')
{
	$pay_nt_authorized=0;
}

		if($pay_nt_authorized)
		{
	   ?>
			<script language="javascript">
            alert("Sorry, The payroll cycle for this month is already completed.");
            </script>
        <?php
   }
   else
   {
	   ?>
<br>

<div align='center'><input type='submit' name='subn' value='Update' class='bgbutton'></div>

<br>
<?php
   }
?>
</form>

</BODY>

</HTML>

