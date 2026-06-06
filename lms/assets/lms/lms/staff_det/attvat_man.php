<html>
<title>Update Attendance</title>
 <?php

	session_start();
	include("../db.php");

	//print_r($_POST);

	$staffids=$_REQUEST['staffids'];
	$adate=$_REQUEST['adate'];
	$type=$_POST['type'];
	$ttimess=date('H:i:s');
$with_date_test=date('Y-m-d');
$staffrigtss=fetcharray(execute("SELECT shortname FROM `users` where username='$user'"));
	$stafftime_val=strtotime('17:00');

	?>

<head>

<script language="javascript" src="cal2.js"></script>

<script language="javascript" src="cal_conf2.js"></script>



</head>

<?php

			$tdatess=$adate;

	if($_POST['subn'])

	{

		

		$Sql66=mysql_query(" select id from staff_att_updt where toddate='$tdatess' and staff_id='$staffids'");

		if(mysql_num_rows($Sql66)>0)

		{

			$sql33="update staff_att_updt set type='$type',insert_date='$with_date_test',user='$user',todtime='$ttimess' where toddate='$tdatess' and staff_id='$staffids'";

			mysql_query($sql33);

		}

		else

		{

		mysql_query("INSERT INTO staff_att_updt (staff_id, user, type, toddate, todtime,insert_date) VALUES ( '$staffids', '$user', '$type', '$tdatess', '$ttimess','$with_date_test')");

		}

		?>

        <Script language="JavaScript">

        alert("Updated Sucessfully!");

		window.opener.location.href='staffdetvew_rprts.php?tab=33';

		window.close();

        </Script>

        <?



	}

?>

<body>

<form Name="frm"  method="post">

<input type="hidden" name="staffids" value="<?=$staffids?>"/>

<br>  

<table  align='center' border="0" width="50%" cellpadding="3" cellspacing="0">

<tr><td colspan="2" class="head" align="center">&nbsp;<b>Update Attendance</b></td></tr>

	<?php
$update_attenc=execute("SELECT * FROM `leave_att_point` WHERE status=1");
while($update_attenc1=fetcharray($update_attenc))
{
	
	$r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$tdatess' and staff_id='$staffids' and type='$update_attenc1[id]'"));	

			if($r5[0])
			$check11='checked';
			else
			$check11='';
	?>

	<tr>

	<td title="<?=$update_attenc1['full_name']?>">&nbsp;<b><?=$update_attenc1[name]?></b></td>
    

	<td title="<?=$update_attenc1['full_name']?>"><input title="<?=$update_attenc1['full_name']?>" type="radio" name="type" value="<?=$update_attenc1[id]?>" <?=$check11?>>

    </td>

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
			
		 $manager_admin=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid=b.mng_id)");

	 
	if(strtotime($tdatess)<strtotime($from_date_pay) && mysql_num_rows($manager_admin)<1 && $staffrigtss[0]!='admin')
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

