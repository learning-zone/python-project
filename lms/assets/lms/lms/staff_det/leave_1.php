<html>
<head>
<title>Leave Management</title>
<Script language="JavaScript">

	function RefreshMe(val)
	{
		document.frm.action="leave_1.php";
		document.frm.submit();
	}
	
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
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<!----timecode---->

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/datetimepicker.css" rel="stylesheet" media="screen">

<!---time_end--->
<style>
tr .leavewith
{	
background: -webkit-gradient(linear, left top, left bottom, from( #FF884F), to( #EA7500));
background: -moz-linear-gradient(center top , #FF884F , #EA7500) repeat scroll 0 0 transparent;	
}
</style>
<?php

	
/*$dteof='2014-01-30 18:03:01';
echo date("d-m-Y h:i a",strtotime($dteof));*/

	session_start();
	include("../db.php");
	
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


$staffnamevali=fetcharray(execute("select b.f_name,b.s_name,b.group_id,b.category,b.recruitment_procedure,b.id from users a,staff_det b where  a.srid=b.id and a.username='$user' and b.active='YES'"));

if($staffnamevali[4]=='Nonuser')
{
	echo "<br><center><b>You are a Non User!! You cannot view this link</b></center>";
	die();
}


$leave_add=date('Y-m-d H:i:m');
$with_date_test=date('Y-m-d');
$ttimess=date('H:i:s');
$stafftime_val=strtotime('17:00');

$mang_hr_mails=execute("select b.hr_id,b.mng_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");


$staff_mang_names=fetcharray(execute("SELECT b.f_name,b.s_name,b.id FROM staff_hr_grup a,staff_det b,staff_leave_manger c where a.mng_id =b.id and a.mng_id=c.manger_id and c.status=1 and a.status=1  and a.staff_id='$staff_id_us[0]' and b.active='YES'"));

$name_dis_manger=$staff_mang_names[0]." ".$staff_mang_names[1];
$name_dis_staff=$staffnamevali[0]." ".$staffnamevali[1];
?>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<script LANGUAGE="JavaScript">

function reload(str)
{
var url="leavecunt.php";
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
<link rel="stylesheet" href="LightBox/lightbox.css" />
<script src="LightBox/jquery/1.10.2/jquery.min.js"></script>
<script src="LightBox/jquery/jquery.lightbox.js"></script>
<script>
    $(document).ready(function(){
        //Assign the lightbox event to elements
        $(".iframe").lightbox({iframe:true, width:"60%", height:"60%"});                                
        //Preserving a JavaScript event for inline calls.
        $("#click").click(function(){ 
            $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
            return false;
        });
    });
</script>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
</head>
<?
 $manager_admin=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid=b.mng_id)");
?>

	<?php
    if($_POST['save'])
    {
		$flag_true=0;
		if($type==6 || $type=='HD' || $type=='EE' )
		{
			if($hd_ee_date!='' && ($timein!='' || $timeout!=''))
			{
			$flag_true=1;
			}
		}
		if($adate!='' && $bdate!='' && $type!='0')
		{
			$flag_true=2;
		}
		if($flag_true)
		{
			$tfdate=explode('/',$adate);
			$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
			$ttdate=explode('/',$bdate);
			$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];
			
			$reason=mysql_real_escape_string("$reason");
			$backup=mysql_real_escape_string("$backup");
						
			//$ins_leave="INSERT INTO staff_leave (user,avl, reason, manager,type, f_date, t_date, backup, notify, days, contact,acc_year,staff_id, status,in_time,out_time,hd_ee_da_date,half_time_in,f_time,to_time,inserted_date,status_approve,status_reason) VALUES ('$user','$avl','{$reason}', '$manager','$type','$fdate','$tdate','{$backup}', '$teacher', '$days','$contact','$acc_year','$staff_id_us[0]','1','$timein','$timeout','$hd_ee_date','$half_time_in','$from_am_pm','$to_am_pm','$leave_add','1','1')";
			//$ins_leave_final=execute($ins_leave);
            //$ins_leave_id=fetchInsertId($ins_leave_final);

$leave_type_name=fetcharray(execute("SELECT leave_name FROM `staff_leave_type` WHERE status=1 and id='$type'"));
if($type=='EE')
{
$leave_type_name[0]='Early Exist';
}

$msg= "Dear ".$name_dis_manger.",<br><br>".$name_dis_staff." has applied for ".$leave_type_name[0]." from ".$adate." to ".$bdate.", i.e for ". $days." day . Kindly click to <a class='iframe' href='http://oberoi.myschoolone.com/renew/staff_det/date_approval_email.php?insids=834&user='$user'>approve</a> / <a class='iframe' href='http://oberoi.myschoolone.com/renew/staff_det/date_approval_email.php?insids=834'>reject</a> the leave request on the LMS.";

/**********************************/

$from="Suresh <sureshduggaladka@yahoo.com>";

$to="Suresh <sureshduggaladka@gmail.com>";
$bcc="sandhyatr126@gmail.com";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html;  charset=iso-8859-1' . "\r\n";
 //This two steps to help avoid spam
$headers .= "Message-ID: <".gettimeofday()." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n";
$headers .= "X-Mailer: PHP v".phpversion()."\r\n";
 //With message
$headers .= "From: ".$from."\r\n";
$headers .= "Reply-to: ".$from."\r\n";
$headers .= "Cc:".$cc. "\r\n";
$headers .= "Bcc:".$bcc. "\r\n";
$subject="Test";

$mail_sent = @mail( $to, $subject, $msg, $headers );

/**********************************/			
		
			$avl='';
			$reason='';
			$type='';
			$adate='';
			$backup='';
			$bdate='';
			$days='';
			$contact='';
			$from_am_pm='';
			$to_am_pm='';
			?>
			<script language="javascript">
			alert("Inserted Sucessfully");
			</script>
			<? 
			}
		else
		{
			?>
			<script language="javascript">
			alert("Please Enter the Date");
			</script>
			<?
		}
    }
    ?>
<?php
if($_POST['appr'])
{

	$manager=$_POST['manager'];
	for($m=0;$m<sizeof($manager);$m++)
	{
		$cmnts=$_POST['cmnts'.$manager[$m]];
		$cmnts=mysql_real_escape_string("$cmnts");
		
		$flag=0;
		//if($cmnts)
//		{
			
			$pay_roll_out_ee='';
		
		$leave_type_pay=fetcharray(execute("SELECT type FROM `staff_leave` WHERE status=1 and id='$manager[$m]'"));
if($leave_type_pay[0]=='EE' || $leave_type_pay[0]=='6')
{
	$pay_roll_out_ee=1;
}

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
	 $leave_pay_roll=fetcharray(execute("SELECT hd_ee_da_date FROM `staff_leave` WHERE status=1 and id='$manager[$m]'"));
if((strtotime($leave_pay_roll[0])<strtotime($from_date_pay)))
	{
		$pay_nt_authorized=1;
	}
}
else
{
		$leave_pay_roll=fetcharray(execute("SELECT f_date,t_date FROM `staff_leave` WHERE status=1 and id='$manager[$m]'"));
		if((strtotime($leave_pay_roll[0])<strtotime($from_date_pay)) || (strtotime($leave_pay_roll[1])<strtotime($from_date_pay)))
		{
			$pay_nt_authorized=1;
		}
}

if(mysql_num_rows($manager_admin)>=1 || $staffrigtss[0]=='admin')
{
	$pay_nt_authorized='0';
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
			$flag=1;	
      //  execute("update staff_leave set approved='1',reject='0',user_manager='$user',updated_date='$leave_add',user_id='$staff_id_us[0]',approve_reason='{$cmnts}' where id='$manager[$m]'");	
}
		/*}
		else
		{*/
		?>
		<!--<Script language="JavaScript">
		alert("Enter the reason for Approving!");
		</Script>-->
        <?
		//}
	}
	if($flag)
	{
		?>
		<Script language="JavaScript">
		alert("Approved");
		</Script>
        <?
		}
}
		?>
        <?php
if($_POST['rej'])
{

	$manager=$_POST['manager'];
	for($c=0;$c<sizeof($manager);$c++)
	{
		$cmnts=$_POST['cmnts'.$manager[$c]];
		$cmnts=mysql_real_escape_string("$cmnts");
		
		$flag=0;
		/*if($cmnts)
		{*/
		
		$pay_roll_out_ee='';
		
		$leave_type_pay=fetcharray(execute("SELECT type FROM `staff_leave` WHERE status=1 and id='$manager[$c]'"));
if($leave_type_pay[0]=='EE' || $leave_type_pay[0]=='6')
{
	$pay_roll_out_ee=1;
}

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
	 $leave_pay_roll=fetcharray(execute("SELECT hd_ee_da_date FROM `staff_leave` WHERE status=1 and id='$manager[$c]'"));
if(strtotime($leave_pay_roll[0])<strtotime($from_date_pay))
	{
		$pay_nt_authorized=1;
	}
}
else
{
		$leave_pay_roll=fetcharray(execute("SELECT f_date,t_date FROM `staff_leave` WHERE status=1 and id='$manager[$c]'"));
		if((strtotime($leave_pay_roll[0])<strtotime($from_date_pay)) || (strtotime($leave_pay_roll[1])<strtotime($from_date_pay)))
		{
			$pay_nt_authorized=1;
		}
}


if(mysql_num_rows($manager_admin)>=1 || $staffrigtss[0]=='admin')
{
	$pay_nt_authorized='0';
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
			
			$flag=1;
       execute("update staff_leave set reject='1',approved='0',user_manager='$user',updated_date='$leave_add',user_id='$staff_id_us[0]',reject_reason='{$cmnts}'  where id='$manager[$c]'");
}

		/*}
		else
		{*/
		?>
		<!--<Script language="JavaScript">
		alert("Enter the reason for Rejecting !");
		</Script>-->
        <?
		//}
	}
	if($flag)
	{
		?>
		<Script language="JavaScript">
		alert("Rejected !");
		</Script>
        <?
	}
}
		?>
        

<body>
<form name="frm2"  method="post">
<input type="hidden" name="tab" value="<?=$p?>"/>
<input type="hidden" name="avl" value="<?=$avl?>"/>
<input type="hidden" name="contact" value="<?=$contact?>"/>
<input type="hidden" name="type" value="<?=$type?>"/>
<input type="hidden" name="reason" value="<?=$reason?>"/>
<input type="hidden" name="backup" value="<?=$backup?>"/>
<input type="hidden" name="days" value="<?=$totdays?>"/>
<br>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==1){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=1" >Leave & Attendance</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=1" >Leave & Attendance</a></li>
        <?
	}
?>
<?
$statsv=1;
$mang_hrrt=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  if(mysql_num_rows($mang_hrrt)>0 && $staffrigtss[0]!='admin')
	{
		$statsv=0;
	if($p==2 || $p==4 || $p==5  || $p==6 || $p==99 || $p==88){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=2" >Leave Approval</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=2" >Leave Approval</a></li>
        <?
	}
?>
<?
	if($p==12){
		?>
        <li class="currentBtn"><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
        <?
	}else{
		?>
        <li><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
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
	if($p==111){
		?>
       <li class="currentBtn"><a href="stafftime_update.php?tab=111" >Staff Time Sheet Update</a></li>
        <?
	}else{
		?>
       <li><a href="stafftime_update.php?tab=111" >Staff Time Sheet Update</a></li>
        <?
	}
}
?>
<?php
$statsv=1;
  if($staffrigtss[0]=='admin' && $statsv=='1')
	{
		
	if($p==2 || $p==4 || $p==5  || $p==6 || $p==99 || $p==88){
		?>
        <li class="currentBtn"><a href="leave_admin.php?tab=2" >Leave Approval</a></li>
        <?
	}else{
		?>
        <li><a href="leave_admin.php?tab=2" >Leave Approval</a></li>
        <?
	}
?>

<?
	if($p==12){
		?>
        <li class="currentBtn"><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
        <?
	}else{
		?>
        <li><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
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
	if($p==111){
		?>
       <li class="currentBtn"><a href="stafftime_update.php?tab=111" >Staff Time Sheet Update</a></li>
        <?
	}else{
		?>
       <li><a href="stafftime_update.php?tab=111" >Staff Time Sheet Update</a></li>
        <?
	}
}
?>

<?
if($staffrigtss[0]!='admin')
{
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
<?
	if($p==65){
		?>
        <li class="currentBtn"><a href="leave_count.php?tab=65" >Leave Details</a></li>
        <?
	}else{
		?>
        <li><a href="leave_count.php?tab=65" >Leave Details</a></li>
        <?
	}
}
?>
</ul>
</div>
</div>
</form>
<?php	
	$fromdate_pay=explode('/',$adate);
	$pfdate_pay=$fromdate_pay[2]."-".$fromdate_pay[1]."-".$fromdate_pay[0];
	$totdate_pay=explode('/',$bdate);
	$ptdate_pay=$totdate_pay[2]."-".$totdate_pay[1]."-".$totdate_pay[0];
	
    	/////////////payroll/////////////		

		$from_pay_today=explode('-',$with_date_test);
		
		if($from_pay_today[2]==21)
		{
			$systemtime=strtotime($ttimess);
		}
	
		$from_pay_20=$from_pay_today[0]."-".$from_pay_today[1]."-21";
		
	if((strtotime($with_date_test) > strtotime($from_pay_20)) || ($systemtime>$stafftime_val))
	{
		$topay_validate=date('Y-m-d', strtotime('1 month', strtotime($from_pay_20)));
		//payroll fromdate
		$topay_pay_date1=explode('-',$from_pay_20);
		$topay_mnth_pay=$topay_pay_date1[0]."-".$topay_pay_date1[1]."-21";
		//payroll todate
		$topay_pay_bdate1=explode('-',$topay_validate);
		$topay_mnth_bpay=$topay_pay_bdate1[0]."-".$topay_pay_bdate1[1]."-21";
			
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
		$topay_mnth_pay=$topay_pay_date1[0]."-".$topay_pay_date1[1]."-21";
				
		$from_date_pay=$topay_mnth_bpay;
		$to_date_pay=$topay_mnth_pay;
	}
			
//////////////////////end///////////////////////	

	
	if(strtotime($pfdate_pay)<strtotime($from_date_pay) || strtotime($ptdate_pay)<strtotime($from_date_pay))
	{
		if($adate!='' && $bdate!='')
	{
	?>
		<Script language="JavaScript">
        alert("Sorry, The payroll cycle for this month is already completed.\n Hence you are not authorized for this leave.\n Kindly contact your HOD.");
        </Script>
        <?php
		$adate='';
		$bdate='';
	}
	}
	if($type=='6' || $type=='EE')
	{
		if(strtotime($hd_ee_date)<strtotime($from_date_pay))
		{
			if($hd_ee_date!='')
			{
			?>
				<Script language="JavaScript">
				alert("Sorry, The payroll cycle for this month is already completed.\n Hence you are not authorized for this leave.\n Kindly contact your HOD.");
				</Script>
				<?php
				$hd_ee_date='';
				$timein='';
				$timeout='';
			}
		}
	}
	
?>
<?
/*if($adate)
{
	$currentDate=date('Y-m-d');
	$fadate=explode("/",$adate);
	$fadatefll="$fadate[2]-$fadate[1]-$fadate[0]";
	if(strtotime($currentDate) > strtotime($fadatefll))
	{
		$adate='';
		?>
		<script language="javascript">
		alert("Please Select Day Beyond the Current Date");
		</script>
		<?     
	}
}
if($bdate)
{
	$curreDate=date('Y-m-d');
	$lbdate=explode("/",$bdate);
	$fbdatefll="$lbdate[2]-$lbdate[1]-$lbdate[0]";
	if(strtotime($curreDate) > strtotime($fbdatefll))
	{
		$bdate='';
		?>
		<script language="javascript">
		alert("Please Select Day Beyond the Current Date");
		</script>
		<?     
	}
}*/

?>
<?
        $staflavty1=fetcharray(execute("select leave_name from staff_leave_type  where  status=1  and id='$type'"));

    $fromdate1=explode('/',$adate);
	$pfdate1=$fromdate1[2]."-".$fromdate1[1]."-".$fromdate1[0];
	$totdate1=explode('/',$bdate);
	$ptdate1=$totdate1[2]."-".$totdate1[1]."-".$totdate1[0];
   if($adate!='' || $bdate!='')
	{
   if($type=='0')
   {
	   $adate='';
	   $bdate='';
	   $totdays='';
	    ?>
		<Script language="JavaScript">
		alert("Please select the Leave Type");
		</Script>
        <?
   }
	}
	 if($adate!='' && $bdate!='')
	{
	 if(strtotime($pfdate1) > strtotime($ptdate1))
   {
	   ?>
       <Script language="JavaScript">
		alert("From Date Cannot Be Greater Than To Date");
		</Script>
       <?
	   $adate='';
	   $bdate='';
  }
	}
	
   $leave_validate_f_date=execute("SELECT * FROM `staff_leave` WHERE status=1  and (approved='1' or approved='0') and reject!='1' and staff_id='$staff_id_us[0]' and status_reason!='2' and ( '$pfdate1' between f_date and t_date) and status_approve!=2");
   if(mysql_num_rows($leave_validate_f_date)>=1)
   {
	   if($adate)
	   {
	  ?>
		<Script language="JavaScript">
		alert("You have already applied leave on <?=$adate?> !");
		</Script>
        <?
		$adate='';
	   }
   }
   
    $leave_validate_t_date=execute("SELECT * FROM `staff_leave` WHERE status=1 and (approved='1' or approved='0') and reject!='1' and staff_id='$staff_id_us[0]' and status_reason!='2' and ( '$ptdate1' between f_date and t_date) and status_approve!=2");
if(mysql_num_rows($leave_validate_t_date)>=1)
   {
	   if($bdate)
	   {
	    ?>
		<Script language="JavaScript">
		alert("You have already applied leave on <?=$bdate?> !");
		</Script>
        <?
		$bdate='';
	   }
   }
		?>
         <?php
		 
		$leave_validate_f_date1=execute("SELECT * FROM `staff_leave` WHERE status=1  and (approved='1' or approved='0') and reject!='1' and staff_id='$staff_id_us[0]' and status_reason!='2'  and  ( hd_ee_da_date between '$pfdate1' and '$ptdate1') and status_approve!=2");
   if(mysql_num_rows($leave_validate_f_date1)>=1)
   {
	  
	   if($adate)
	   {
		   
	  ?>
		<Script language="JavaScript">
		alert("You have already applied leave between <?=$adate?> and  <?=$bdate?>!");
		</Script>
        <?
		$adate='';
		$bdate='';
	   }
   }
   
    $leave_validate_t_date1=execute("SELECT * FROM `staff_leave` WHERE status=1 and (approved='1' or approved='0') and reject!='1' and staff_id='$staff_id_us[0]' and status_reason!='2' and hd_ee_da_date='$hd_ee_date'  and status_approve!=2");
if(mysql_num_rows($leave_validate_t_date1)>=1)
   {
	   if($hd_ee_date)
	   {
	    ?>
		<Script language="JavaScript">
		alert("You have already applied leave on <?=$hd_ee_date?> !");
		</Script>
        <?
		$hd_ee_date='';
	   }
   }
    $leave_validate_t_date1=execute("SELECT * FROM `staff_leave` WHERE status=1 and (approved='1' or approved='0') and reject!='1' and staff_id='$staff_id_us[0]' and status_reason!='2' and ( '$hd_ee_date' between f_date and t_date) and status_approve!=2");
if(mysql_num_rows($leave_validate_t_date1)>=1)
   {
	   if($hd_ee_date)
	   {
	    ?>
		<Script language="JavaScript">
		alert("You have already applied leave on <?=$hd_ee_date?> !");
		</Script>
        <?
		$hd_ee_date='';
	   }
   }
    $leave_validate_t_date23=execute("SELECT * FROM `staff_leave` WHERE status=1 and (approved='1' or approved='0') and reject!='1' and staff_id='$staff_id_us[0]' and status_reason!='2' and '$pfdate1' <= f_date and '$ptdate1' >= t_date and status_approve!=2");
if(mysql_num_rows($leave_validate_t_date23)>=1)
   {
	   if($bdate && $adate)
	   {
	    ?>
		<Script language="JavaScript">
		alert("You have already applied leave between <?=$adate?> and  <?=$bdate?>!");
		</Script>
        <?
		$bdate='';
		$adate='';
	   }
   }
		
 			//default approval
        $satff_absent_date_val=fetcharray(execute("select id from staff_default where staff_id='$staff_id_us[0]' and status=1 and ( d_date between '$pfdate1' and '$ptdate1')"));

		$staff_absent_sts_val=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_absent_date_val[0]'"));		
		if($staff_absent_sts_val[0] == '1' || $satff_absent_date_val[0]!='')
		{
			if($bdate && $adate && $staff_absent_sts_val[1]!=1)
	   		{
		?>
			<Script language="JavaScript">
			alert("You have already applied Default between <?=$adate?> and  <?=$bdate?>!");
			</Script>
		<?
				$adate='';
				$bdate='';
			}
		}
		//default approval
		$satff_absent_date_single=fetcharray(execute("select id from staff_default where staff_id='$staff_id_us[0]' and status=1 and  d_date='$hd_ee_date' "));

		$staff_absent_sts_single=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$satff_absent_date_single[0]'"));		
		if($staff_absent_sts_single[0] == '1' || $satff_absent_date_single[0]!='')
		{
			if($hd_ee_date && $staff_absent_sts_single[1]!='1')
	   		{
		?>
			<Script language="JavaScript">
			alert("You have already applied Default on <?=$hd_ee_date?> !");
			</Script>
		<?
				$hd_ee_date='';
			}
		}
		?>
        	<?php
	$satff_calender_status=execute("select * from staff_calenders where status='1' and (fromdate between  '$pfdate1' and '$ptdate1') and staff_typ='$staffnamevali[3]'");
	if(mysql_num_rows($satff_calender_status)>=1)
	{
	if($adate && $bdate)
	{
		if($type!='3')
{
	?>
		<Script language="JavaScript">
		alert("School Holiday between <?=$adate?> and  <?=$bdate?>!");
		</Script>
		<?
}
	}
	}
	?>

<form name="frm"  method="post">
<?php
if( strtotime($pfdate1) == strtotime($ptdate1) )
		{
			$timediffers='';
		if($from_am_pm=='0.5_ain' && $to_am_pm=='0.5_aout')
		{
			$timediffers='0.5';
		}
		elseif($from_am_pm=='0.5_pin' && $to_am_pm=='0.5_pout')
		{
			$timediffers='0.5';
		}
		elseif($from_am_pm=='' && $to_am_pm=='')
		{
		}
		else
		{
		?>
			<script language="javascript">
		alert("You are selecting wrong duration leave timings.\nIf you are on leave for full day select full day for first half select FHL,\nsecond half select SHL.");
		</script>
        <?php
		}
		}
		else
		{
			$timediffers='';
			if($from_am_pm=='0.5_pin' && $to_am_pm=='0.5_aout')
		{
			$timediffers='1';
		}
		elseif($from_am_pm=='' && $to_am_pm=='0.5_aout')
		{
			$timediffers='0.5';
		}
		elseif($from_am_pm=='0.5_pin' && $to_am_pm=='')
		{
			$timediffers='0.5';
		}
		elseif($from_am_pm=='' && $to_am_pm=='')
		{
			
		}
		else
		{
			?>
			<script language="javascript">
		alert("You are selecting wrong duration leave timings.\nIf you are on leave for full day select full day for first half select FHL,\nsecond half select SHL.");
		</script>
        <?php
		}
		
		}
if($p==1)
	{
?>

<fieldset style="height:auto;width:100%">
<legend><font style="font-size:16px"><b>Leave Form</b></font></legend>


<?php
$staffname=fetcharray(execute("select b.f_name,b.s_name,b.group_id,b.category from users a,staff_det b where   a.srid=b.id and a.username='$user' and b.active='YES'"));

	$fromdate=explode('/',$adate);
	$pfdate=$fromdate[2]."-".$fromdate[1]."-".$fromdate[0];
	$totdate=explode('/',$bdate);
	$ptdate=$totdate[2]."-".$totdate[1]."-".$totdate[0];
	
	//maternity
if($type=='3')
	{
		$newdate1 = strtotime ( '+83 Day' , strtotime ( $pfdate ) ) ;
		$newdate123 = date ( 'Y-m-d' , $newdate1 );
		if($adate)
		{
			$bdate=date ( 'd/m/Y' , $newdate1 );
		}
		
		$ptdate=$newdate123;
	}
// maternity end

if($type=='7')
{
	$newdate1 = strtotime ( '+6 days' , strtotime ( $pfdate ) ) ;
	$newdate123 = date ( 'Y-m-d' , $newdate1 );
	if($adate)
	{
	$bdate=date ( 'd/m/Y' , $newdate1 );
	}
	$ptdate=$newdate123;

	$fromdate_vac=$pfdate;
	$todate_vac=$newdate123;
	$vaction=0;
	$fromvacs="2014-06-16";
	$tovacs="2014-07-19";
	
	$applied_vacation=execute("select * from staff_leave where type='7' and status=1  and (approved='1' or approved='0') and reject!='1'  and staff_id='$staff_id_us[0]' and status_reason!='2'");
	if(mysql_num_rows($applied_vacation)>0)
	{
		
		$adate='';
		$bdate='';
	?>
		<Script language="JavaScript">
        alert("You can't apply Vacation Leave more than once for an acadamic year !");
        </Script>
	<?
	}
	else
	{
//	echo "<br>".strtotime($fromdate_vac)."<".strtotime($fromvacs);	
	if($fromdate_vac<$fromvacs || $todate_vac>$tovacs)
	{
		$vaction=1;
	}
	if($vaction==1 && $adate!='' && $bdate!='')
	{
		$adate='';
		$bdate='';
	?>
		<Script language="JavaScript">
        alert("Continuous Vacation leave can be taken only for a period of 7 days during June 16th to July 19th");
        </Script>
	<?
	}
	}
}
//end
	
//no of days	
$date_entered_email_sec=strtotime($ptdate);
$date_modified_email_sec=strtotime($pfdate); 
$turn_around_time_sec = $date_entered_email_sec - $date_modified_email_sec;
 $maternity_count='';
$daysTotal = ceil((date("z") - date("w")) / 7);
$daysTotal = ceil((date("j") - date("w")) / 7); 
$tot_day = floor($turn_around_time_sec / 86400)+1;
$maternity_count=$tot_day;

$present=0;
$default_count=0;

//no of sundays
for($c=0;$c<$tot_day;$c++)
	{
		$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
		$viewdate_sunday=date("Y-m-d", $attview);
	
		////////////////////start//////////////////////
		if(strtotime($with_date_test)!=strtotime($viewdate_sunday))
{
	$staffrfid_count=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$staff_id_us[0]'"));
	$staffif_count1=trim($staffrfid_count[0]);
	
	$count_rfid=0;
	$testtimecount=execute("SELECT * FROM `rfid_staff_check_in` WHERE rfidno='$staffif_count1' and att_date='$viewdate_sunday' and user='$staff_id_us[0]' group by att_time order by att_time asc ");
	
	while($testtimecountss=fetcharray($testtimecount))
	{
		$count_rfid++;
	}
	
	if($count_rfid > 1)
	{
		$present++;
	}
	
	if($count_rfid==1)
	{
		$default_count++;
	}
}
	////end//
		
		
		$viewdate_sunday=date("D", $attview);
		if($viewdate_sunday=='Sun')
		{
			$num_sundays++;	
		}
	}
if(strtotime($with_date_test)>strtotime($pfdate))
{
	if($adate!='' && $bdate!='')
	{
		if($present!='' || $default_count!='')
		{
			//$adate='';
			//$bdate='';
		?>
			<Script language="JavaScript">
			//alert("In the timeframe selected there is already\n(<?=$default_count?>)default & (<?=$present?>)present captured in the system");
			</Script>
		<?php
		}
	}
}
if($adate!='' && $bdate!='')
{
	$totdays1=$tot_day-$num_sundays;
}
$staffclan=execute("SELECT * FROM `staff_calenders` WHERE status=1 and `staff_typ`='$staffname[2]' and ( fromdate between '$pfdate' and '$ptdate')");
while($staffclands=fetcharray($staffclan))
{

$fntcolors=$staffclands[fromdate];
$sundatess=date('D', strtotime($fntcolors));
if($sundatess!='Sun')
{
$staffclands_count++;
}

}
$totdays=$totdays1-$staffclands_count;
if($type=='3' || $type=='7')
{
	if($adate!='')
{
	
$totdays=$maternity_count;
}
}
////////////////// start early exit outdoor///////////////////
$dispaly_out_ee=date("d-m-Y",strtotime($hd_ee_date));

$staff_clander_out_ee='';
$leave_out_ee_validate1='';
 $leave_validate_out_ee=execute("SELECT * FROM `staff_leave` WHERE status=1  and (approved='1' or approved='0') and reject!='1'  and staff_id='$staff_id_us[0]' and status_reason!='2' and ( '$hd_ee_date' between f_date and t_date)  and status_approve!=2");
   if(mysql_num_rows($leave_validate_out_ee)>=1)
   {
	   if($hd_ee_date)
	   {
		   $leave_out_ee_validate1=1;
	   }
   }
$leave_validate_out_ee=execute("SELECT * FROM `staff_leave` WHERE status=1  and (approved='1' or approved='0') and reject!='1'  and staff_id='$staff_id_us[0]' and status_reason!='2' and ( '$hd_ee_date' between f_date and t_date)  and status_approve!=2");
   if(mysql_num_rows($leave_validate_out_ee)>=1)
   {
	   if($hd_ee_date)
	   {
		   $leave_out_ee_validate1=1;
	   }
   }

$staffclan_out_ee=execute("SELECT * FROM `staff_calenders` WHERE status=1 and `staff_typ`='$staffname[2]' and  fromdate='$hd_ee_date'");
if(mysql_num_rows($staffclan_out_ee)>=1)
   {
	   $staff_clander_out_ee=1;
   }
   
$out_ee=$hd_ee_date;
$out_ee_final=date('D', strtotime($out_ee));
if($out_ee_final=='Sun')
{
	?>
		<Script language="JavaScript">
        alert("<?=$dispaly_out_ee?> is a Sunday!");
        </Script>
	<?php
	$hd_ee_date='';
}
elseif($staff_clander_out_ee)
{
	if($type!='3')
{
	?>
		<Script language="JavaScript">
        alert("<?=$dispaly_out_ee?> is a School Holiday!");
        </Script>
	<?php
	$hd_ee_date='';
}
}
elseif($leave_out_ee_validate1)
{
	?>
	<Script language="JavaScript">
	alert("You have already applied leave on <?=$dispaly_out_ee?> !");
	</Script>
	<?php
	$hd_ee_date='';
}
else
{
}
//////////////////////end out early exist/////////////////////
?>

<table align='center'  width='95%' border="0" cellpadding="2" cellspacing="0">
    <tr>
        <td style="font-size:13px" align="left" width="10%">Name :</td>
        <td align="left"  width="25%" colspan="2">&nbsp;
        <?php
        if($user!='administrator')
        {
        ?>
         <?=$staffname[0]?>&nbsp;<?=$staffname[1]?>
        <?php
        }
        if($user=='administrator')
        {
        ?>
       		Administrator
        <?php
        }
        $staff_mang=fetcharray(execute("SELECT b.f_name,b.s_name,b.id FROM staff_hr_grup a,staff_det b,staff_leave_manger c where a.mng_id =b.id and a.mng_id=c.manger_id and c.status=1 and a.status=1  and a.staff_id='$staff_id_us[0]' and b.active='YES'"));
        ?>
        </td>
        <td style="font-size:13px" align="left"  width="10%" nowrap>Reporting Mgr</td>
        <td style="font-size:13px" align="left" width="20%"><font color="#0000FF"><?=$staff_mang[0]?>&nbsp;<?=$staff_mang[1]?></font></td>
        <td style="font-size:13px" align="left" colspan="3">
	<?php        
    if($adate!='' && $bdate!='')
    {
    ?>
    <!--<a href="javascript:void(0);" onClick ="OpenWind2('staff.php?&pfdate=<?=$pfdate?>&ptdate=<?=$ptdate?>', 'OpenWind2',400,500)">Notify Others</a>-->
    <?
    }
    ?>
</td>
    </tr>
    <tr>
        <td style="font-size:13px" align="left" nowrap>Leave Type*</td>
        <td  nowrap width="20%"><select name="type" style="background-color: #FFFFCC; width:140px;" onChange="RefreshMe(0)">
        <option value='0'>Select Leave Type</option>
       
<?
$typesv=execute("select b.id,b.leave_name,a.days from leave_staff_day a,staff_leave_type b  where   b.status=1 and a.status=1 and a.staff_type='$staffname[3]' and a.leave_type=b.id group by b.id");
for($i=0;$i<rowcount($typesv);$i++)
{
	$typesv1=fetcharray($typesv,$i);
	if($type==$typesv1[id])
	{
		if($typesv1[id]==6)
		{
		echo "<option value='$typesv1[id]' selected>$typesv1[leave_name]</option>";
		}
		else
		{
		echo "<option value='$typesv1[id]' selected>$typesv1[leave_name]  </option>";
		}
	}
	else
	{
		if($typesv1[id]==6)
		{
		echo "<option value='$typesv1[id]'>$typesv1[leave_name]</option>";
		}
		else
		{
			echo "<option value='$typesv1[id]'>$typesv1[leave_name] </option>";
		}
	}
}
?>
<?

$typesv_special=execute("select id,leave_name from staff_leave_type   where   status='1' and special_type='2'");
for($gg=0;$gg<rowcount($typesv_special);$gg++)
{
	$typesv_special1=fetcharray($typesv_special,$gg);
	
			$stcds=fetcharray(execute("select id from staff_leave_type_group where staff_id='$staffnamevali[5]' and leave_type='$typesv_special1[id]' and status=1"));
			if($stcds[0])
			{
				if($type==$typesv_special1[id])
				{
				echo "<option value='$typesv_special1[id]' selected>$typesv_special1[leave_name]</option>";
				}
				else
				{
				echo "<option value='$typesv_special1[id]'>$typesv_special1[leave_name] </option>";
				}	
			}
}
			?>
<?
if($type=='HD')
{
	$hdselect='selected';
}
if($type=='EE')
{
	$eeselect='selected';
}
?>
<!--<option value='HD' <?=$hdselect?>>Half Day</option>-->
<option value='EE' <?=$eeselect?>>Early Exit</option>
</select>
<!--&nbsp;
<img src="help.png" title="If you are a non teaching staff and your Privilege Leaves are over for the current academic year, the Privilege Leave will be taken account of from the balance of your previous academic year leaves!" width='20px'>--></td>   
       <td nowrap width="1%">
       
<div id="txtHint9" class="inline">&nbsp;
        
<?
		$vatype='';
		if($type=='1')
		{
			$vatype='1';
		}
		if($type=='2')
		{
			$vatype='2';
		}
		if($type=='3')
		{
			$vatype='3';
		}
		

 $acc_view_id1=fetcharray(execute("select id from leave_acc_year where acc_name='$acc_year'"));
 
  $paid_tot_count1=fetcharray(execute("SELECT tot_paid from leave_staff_paid_tot_acc_temp where acc_id='$acc_view_id1[0]' and staff_id='$staff_id_us[0]'"));
  
$daycount_withdrawn_paid_cnt1='';
$daycount_paid1='';
$daycount_11=execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='1'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount331=fetcharray($daycount_11))
{
	$daycount_paid1=$daycount331[0]+$daycount_paid1;
}
		
	$daycount_withdrawn441=execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='1'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_paid1=fetcharray($daycount_withdrawn441))
{
	$daycount_withdrawn_paid_cnt1=$daycount_withdrawn_paid1[0]+$daycount_withdrawn_paid_cnt1;
}
///////////////////////end///////////////////////

///////////early exist///////////////
/*$daycount_ee1='';
$daycount_withdrawn_ee_cnt1='';
$daycount_1_ee1=execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='EE'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount_1_ee11=fetcharray($daycount_1_ee1))
{
	$daycount_ee1++;
}

$daycount_withdrawn_ee1=execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='EE'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_ee11=fetcharray($daycount_withdrawn_ee1))
{
	$daycount_withdrawn_ee_cnt1++;
}	*/

////////////////end////////////////////////	
	

///////////outdoor exist///////////////
/*$daycount_out1='';
$daycount_withdrawn_out_cnt1='';
$daycount_1_out1=execute("select * from staff_leave where staff_id='$staff_id_us[0]' and type='6'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount_1_out11=fetcharray($daycount_1_out1))
{
	$daycount_out1++;
}

$daycount_withdrawn_out1=execute("select * from staff_leave where staff_id='$staff_id_us[0]' and type='6'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_out11=fetcharray($daycount_withdrawn_out1))
{
	$daycount_withdrawn_out_cnt1++;
}	*/
////////////////end////////////////////////	
$count_ee_out1='';
$count_ee_out1=$daycount_withdrawn_out_cnt1+$daycount_out1+$daycount_withdrawn_ee_cnt1+$daycount_ee1;
/////////////////totals//////

$staff_paid_dis_vat12=fetcharray(execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staff_id_us[0]' and acc_id='$acc_view_id1[0]'"));
	
	$alltot=$paid_tot_count1[0]-$daycount_paid1-$daycount_withdrawn_paid_cnt1-$staff_paid_dis_vat12[paid_vat]-$count_ee_out1;
$realsvat=$alltot;
if($alltot>0)
{
$alltot1=$alltot;
$fnt_colrs='#009900';
}
if($alltot<=0)
{
$alltot1=0;
$fnt_colrs='#FF0000';
}
		
/*$daycount=fetcharray(execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='$type'  and status='1' and reject='0' and status_reason!='2'"));
		
	$daycount_withdrawn=fetcharray(execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='$type'  and status='1' and approved='1' and status_reason!='2'"));
		
$daysvat=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$type'"));

	$alltot=$daysvat[0]-$daycount[0]-$daycount_withdrawn[0];
	if($alltot>0)
	{
		$alltot1=$alltot;
	}
	if($alltot<=0)
	{
		$alltot1=0;
	}
*/	if($type!='')
{
	$daydisp=fetcharray(execute("select lv_ty from staff_leave_type where  id='$type'  and status=1 "));
	if(!$daydisp[0])
	{
		if($type!=6 && $type!='HD' && $type!='EE' )
{
	$alltot1
?>           
    <!--  Available&nbsp;<input type="text" name="daysval" value="<?=$alltot1?>"  readonly style="background-color: #FFFFCC;width:40px;" size="3">-->
        <?
}
	}
}
		?>
        </div>
      
        
        </td>
        <?
if($type==6 || $type=='HD' )
{
?>
<td  style="font-size:13px" align="center" valign="bottom" width='20%' nowrap>
<font color="#009900">In Time</font><br>
<div class="control-group">
<div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="timein" data-link-format="hh:ii">
<input type="text" name="timein" value="<?=$timein?>" style="width:60px; height:30px" readonly>
<span class="add-on"><i class="icon-remove"></i></span>
<span class="add-on"><i class="icon-th"></i></span>
</div>
<input type="hidden" id="timein" />
</div>
</td>
<?
}
if($type==6 || $type=='HD' || $type=='EE' )
{
	$colspans_vt='';
	if($type=='EE')
	{
		$colspans_vt='2';
	}	
?>
<td colspan="<?=$colspans_vt?>"  style="font-size:13px" align="center" nowrap width='20%'>
<font color="#009900">Out Time</font><br>
<div class="control-group">
<div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="timeout" data-link-format="hh:ii">
<input type="text" name="timeout" value="<?=$timeout?>" style="width:60px; height:30px" readonly>
<span class="add-on"><i class="icon-remove"></i></span>
<span class="add-on"><i class="icon-th"></i></span>
</div>
<input type="hidden" id="timeout" />
</div>
</td>
<td  style="font-size:13px" align="left" nowrap>
Date
</td>
<td  style="font-size:13px" align="left"  nowrap>

<div class="control-group">
<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="hd_ee_date" data-link-format="yyyy-mm-dd">
<span class="add-on"><i class="icon-th"></i></span>
<input size="16"  name="hd_ee_date" type="text" value="<?=$hd_ee_date?>" style="width:100px; height:30px" onChange="RefreshMe(0)" readonly>
<span class="add-on"><i class="icon-remove"></i></span>

</div>
<input type="hidden" id="hd_ee_date" value="<?=$hd_ee_date?>" />
</div>
</td>
<?
}
else
{
?>
        <td  style="font-size:13px" align="left" nowrap> Leave Duration* </td>
        <?php
	$prvs_acc='';
	$alltot1_final='';
	$staff_prvies_year=execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staff_id_us[0]' and acc_id!='$acc_view_id1[0]'");
while($staff_prvies_year1=fetcharray($staff_prvies_year))
{
$prvs_acc=$staff_prvies_year1[paid_vat]+$prvs_acc;
}
		/*$frmdatesam=explode('_',$from_am_pm);
		$todatesam=explode('_',$to_am_pm);
		$timediffers=$frmdatesam[0]+$todatesam[0];
		*/$totdays=$totdays-$timediffers;
		
		$unpaid_leave_count=execute("select days from leave_staff_day  where status=1 and staff_type='$staffnamevali[3]' and leave_type='$type'");
			if(mysql_num_rows($unpaid_leave_count)>=1)
			{
				if($type!=1)
				{
				$unpaid_leave_count1=fetcharray($unpaid_leave_count);
				$alltot1_final=$unpaid_leave_count1[0];
				}
			}
		if($type==1)
		{
			$alltot1_final=$realsvat+$prvs_acc;
		}
		 if($totdays > $alltot1_final)
        {
        $daydisp=fetcharray(execute("select lv_ty from staff_leave_type where  id='$type'  and status=1"));
if(!$daydisp[0])
	{
	 	/*$totdays=0;
        $totdays=0;
		$adate='';
		$bdate='';*/
		if($type!=1)
				{
        ?>
		<Script language="JavaScript">
		//alert("Exceeded the number of <?=$staflavty1[0]?>!");
		</Script>
        <?
				}
        }
        }
		
        ?>
        <td style="font-size:13px" align="center" width='20%' nowrap>
        <input type="text" readonly name="adate" value="<?php echo $adate?>" size="10" style="background-color: #FFFFCC;width:100px;"  onFocus="RefreshMe(0)" placeholder="From Date" required> &nbsp;
        <a href="javascript:showCal('Calendar1')"><img src="Calendar.gif" align="absmiddle"></a>
        <br>
        <?php
		$frm_check='';
		$frm_check1='';
		
		if($from_am_pm=='0.5_ain')
		{
			$frm_check='selected';
		}
		if($from_am_pm=='0.5_pin')
		{
			$frm_check1='selected';
		}
		if($type!=3 && $type!=7)
		{
		?>
        <select name="from_am_pm" style="width:80px" onChange="RefreshMe(0)" title="
        FHL : First Half Leave
        SHL : Second Half Leave ">
         <option value=''>Full day</option>
            <option value='0.5_ain' <?=$frm_check?>>FHL</option>
            <option value='0.5_pin' <?=$frm_check1?>>SHL</option>
            </select>
         <?php
		}
		 ?>
            </td>
        <td style="font-size:13px" width='20%' align="center" nowrap>
        <input type="text" readonly name="bdate" value="<?php echo $bdate?>" size="10" style="background-color: #FFFFCC;width:100px;" onFocus="RefreshMe(0)" placeholder="To Date"  required>&nbsp;
        <a href="javascript:showCal('Calendar2')"><img src="Calendar.gif" align="absmiddle"></a>
         <br>
         <?php
		$to_check='';
		$to_check1='';
		
		if($to_am_pm=='0.5_aout')
		{
			$to_check='selected';
		}
		if($to_am_pm=='0.5_pout')
		{
			$to_check1='selected';
		}
		if($type!=3 && $type!=7)
		{
		?>
             <select name="to_am_pm"  style="width:80px" onChange="RefreshMe(0)" title="
             FHL : First Half Leave
             SHL : Second Half Leave ">
              <option value=''>Full day</option>
            <option value='0.5_aout' <?=$to_check?>>FHL</option>
            <option value='0.5_pout' <?=$to_check1?>>SHL</option>
            </select> 
            <?php
		}
			?>
        </td>
        <td style="font-size:13px" align="left" width="8%" nowrap>No. Days</td>
        <td align="left"  width="8%" nowrap>
        <?php
       if($totdays<0)
       {
       $totdays='';
       }
	   ?>
        <input type="text" name="days" value="<?=$totdays?>" size="6" style="background-color: #FFFFCC;width:50px;"   readonly>
        &nbsp;
<img src="help.png" title="No. Days : Working days (Excluding Sunday & School Holidays)" width='20px'>
        </td>
        <?php
}
		?>
    </tr>
    <tr>
        <td  style="font-size:13px" align="left" nowrap>Reason* </td>
        <td colspan="2" nowrap><textarea rows="3" cols="30" name='reason'  style="background-color: #FFFFCC" placeholder="Reason*" required ><?=stripslashes($reason)?></textarea></td>
       
        <td style="font-size:13px" align="left" nowrap>Alt Contact #</td>
        <td align="left"  colspan="4" nowrap><input type="text" name="contact" value="<?=$contact?>" placeholder="Alt Contact #" size="20" style="background-color: #FFFFCC;width:150px; height:30px;" > </td>
    </tr>
</table>
</fieldset>
<br>
<div align='center' >
  <input type="submit" name="save" value="Apply"  class='bgbutton'>
  </div>
<?
	}
?>
<?php
if($p==2 || $p==4)
	{
?>
<br>
<input type="hidden" name="tab" value="<?=$p?>"/>
<fieldset style="height:auto;width:100%">
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==4 || $p==2){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
<?
	if($p==99){
		?>
        <li class="currentBtn"><a href="leave_withdrwn_screen.php?tab=123">Withdraw</a></li>
        <?
	}else{
		?>
        <li><a href="leave_withdrwn_screen.php?tab=123" >Withdraw</a></li>
        <?
	}
?>
<?
	if($p==88){
		?>
        <li class="currentBtn"><a href="leave_default_screen.php">Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_default_screen.php" >Default</a></li>
        <?
	}
?>
</ul>
</div>
</div>

<legend><font style="font-size:16px"><b>Leave Approval</b></font></legend>
<br>
<?
if($p==4 || $p==2)
{
?>
<input type="hidden" name="tab" value="<?=$p?>"/>
 <!--<table align='center'  width='100%' border="1" cellpadding="0" cellspacing="0">
 <tr>
  <td class="head" align="center" width="3%">Sel</td>
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="10%">Staff Name</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="10%">Total Days</td>
    <td class="head" align="center" width="10%">Reason</td>
    <td class="head" align="center" width="1%"></td>
  </tr>
  </table>-->
<div style="max-height:300px; width:100%; overflow-y:auto" align="center">
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
<tr>
  <td class="head" align="center" width="3%" nowrap>Sel</td>
  <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center" width="5%" nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center"  nowrap>Reason</td>
     <td class="head" align="center" width="10%" nowrap>Withdrawn</td>
    <td class="head" align="center" nowrap>Approve Note</td>
    <td class="head" align="center" nowrap>Action</td>
  </tr>
  <?php
  
	 $mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{

	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.EmployeeCode,a.id,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.manager,a.status_approve,a.status_with_staff,a.inserted_date,a.submit_with from staff_leave a,staff_det c where a.status=1  and a.approved='0' and a.reject='0' and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id and a.status_approve!=2 and c.active='YES'");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));

$daycount_tot='';
$staff_leave_count=execute("select days from staff_leave where staff_id='$viewss1[9]' and type='$viewss1[0]' and approved='0'   and status='1' and reject='0' and status_reason!='2'");
	 while($daycount=fetcharray($staff_leave_count))
	{
		$daycount_tot=$daycount[0]+$daycount_tot;
	}
		$daycount_withdrawn_tst='';
	$daycount_widwn=execute("select days from staff_leave where staff_id='$viewss1[9]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'");
	while($daycount_withdrawn=fetcharray($daycount_widwn))
	{
		$daycount_withdrawn_tst=$daycount_withdrawn[0]+$daycount_withdrawn_tst;
	}
		
$daysvat=fetcharray(execute("select tot_paid,paid_vat from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$viewss1[9]' and acc_id='6'"));

	//$alltot=$daysvat[0]-$daycount_tot-$daycount_withdrawn_tst-$daysvat[1];
$alltot=$daysvat[0]-$daysvat[1];

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
 <td class="<?=$trcolor?>" align="center" width="3%" nowrap><input type="checkbox" name="manager[]" value="<?=$viewss1[8]?>" <?=$status_check?>></td>
 <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[18])); ?></td>
        <td class="<?=$trcolor?>" nowrap align="center" width="10%"><?=$viewss1[7]?></td>
        <td class="<?=$trcolor?>" nowrap width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td class="<?=$trcolor?>" nowrap align="center" width="10%"><?=$staflavty[0]?>
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
		?>
        </td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$fdate21?></td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$tdate21?> 
        <?php
        if($viewss1[13])
		{
		?>
        (<?=$viewss1[13]?>)
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>" align="center"width="10%"><?=$viewss1[3]?></td>
        <td  class="<?=$trcolor?>" align="justify">&nbsp;<?=stripslashes($viewss1[4])?></td>
        <td nowrap class="<?=$trcolor?>" align="center" title="Withdrawn Status">
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
	?></td>
        <td class="<?=$trcolor?>" align="center">
         <textarea placeholder="Enter No. of Paid and Unpaid leave / Reason" cols="20" rows="2" name="cmnts<?=$viewss1[8]?>" <?=$status_text?>></textarea></td>
         <td class="<?=$trcolor?>" align="center" nowrap>
          <?php
		 if($with_staus_date)
		 {
			 if($viewss1[0]!='EE' && $viewss1[0]!='6' && $viewss1[0]!='7' )
		 {
		 ?>
         <a href="javascript:void(0);" onClick ="OpenWind3('date_approval.php?insids=<?=$viewss1[8]?>', 'OpenWind3',900,400)">Date Approval</a>
         <?php
		 }
		 }
		 ?>
         </td>
    </tr>
   <?
	}
	}
	}
}
	?>
</table>
</div>
<br>
<?
if($p==4 || $p==2)
{
 $mang_hrrg=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
if(mysql_num_rows($mang_hrrg)>=1)
{	
?>
<div align='center' >
  <input type="submit" name="appr" value="Approve"  class='bgbutton'>&nbsp;&nbsp;
 <input type="submit" name="rej" value="Reject"  class='bgbutton' >&nbsp;&nbsp;
 <a href="javascript:void(0);" style="text-decoration:none" onClick ="OpenWind3('leave_submit.php', 'OpenWind3',900,400)">
 <input type="button" name="prints" value="Print"  class='bgbutton' ></a>
  </div>
  <?
}
}
  ?>
</fieldset>
<?
	}
?>
<?php
if($p==5)
	{
?>
<br>
<input type="hidden" name="tab" value="<?=$p?>"/>
<fieldset style="height:auto;width:100%">

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==4){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
<?
	if($p==99){
		?>
        <li class="currentBtn"><a href="leave_withdrwn_screen.php?tab=123">Withdraw</a></li>
        <?
	}else{
		?>
        <li><a href="leave_withdrwn_screen.php?tab=123" >Withdraw</a></li>
        <?
	}
?>
<?
	if($p==88){
		?>
        <li class="currentBtn"><a href="leave_default_screen.php">Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_default_screen.php" >Default</a></li>
        <?
	}
?>
</ul>
</div>
</div>
<legend><font style="font-size:16px"><b>Leave Approval</b></font></legend>
<br>
<!-- <table align='center'  width='100%' border="1" cellpadding="0" cellspacing="0">
 <tr>
  <td class="head" align="center" width="3%">Sel</td>
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="10%">Staff Name</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="10%">Total Days</td>
    <td class="head" align="center" width="10%">Reason</td>
    <td class="head" align="center" width="1%"></td>
  </tr>
  </table>-->
<div style="max-height:300px; width:100%; overflow-y:auto" align="center">
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
   <tr>
  <td class="head" align="center" width="3%" nowrap>Sel</td>
  <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center" width="5%" nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
     <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center"  nowrap>Reason</td>
    <td class="head" align="center" width="10%" nowrap>Withdrawn</td>
    <td class="head" align="center" nowrap>Approve Note</td>
    <td class="head" align="center" nowrap>Action</td>
  </tr>
  <?php
	 $mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.EmployeeCode,a.id,a.approve_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.status_approve,a.manager,a.submit_with,a.status_approve_manger,a.inserted_date from staff_leave a,staff_det c where a.status=1  and a.approved='1' and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id and c.active='YES'");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
		
	$daycount_tot='';
	$staff_leave_count=execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]' and approved='0'  and status='1' and reject='0' and status_reason!='2'");
	while($daycount=fetcharray($staff_leave_count))
	{
		$daycount_tot=$daycount[0]+$daycount_tot;
	}
	$daycount_withdrawn_tst='';	
	$daycount_widwn=execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'");
	while($daycount_withdrawn=fetcharray($daycount_widwn))
	{
		$daycount_withdrawn_tst=$daycount_withdrawn[0]+$daycount_withdrawn_tst;
	}
	
		
$daysvat=fetcharray(execute("select tot_paid,paid_vat from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$viewss1[10]' and acc_id='6'"));

	//$alltot=$daysvat[0]-$daycount_tot-$daycount_withdrawn_tst-$daysvat[1];
	$alltot=$daysvat[0]-$daysvat[1];
	
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

$hd_time_vw_in='';
$hd_time_vw_out='';

$hd_ee_date=explode('-',$viewss1[13]);
$hd_ee_daft_date=$hd_ee_date[2]."-".$hd_ee_date[1]."-".$hd_ee_date[0];
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
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));

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
	$with_after_approve='1';
	 $status_check="";
	 $status_text="";
	}

?>
    <tr>
 <td nowrap align="center" class="<?=$trcolor?>"  width="3%"><input type="checkbox" name="manager[]" value="<?=$viewss1[8]?>" <?=$status_check?>></td>
 <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[20])); ?></td>
        <td nowrap class="<?=$trcolor?>"  align="center"  width="10%"><?=$viewss1[7]?></td>
        <td nowrap class="<?=$trcolor?>" >&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td nowrap class="<?=$trcolor?>"  align="center" width="10%"><?=$staflavty[0]?> 
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
        <td nowrap class="<?=$trcolor?>"  align="center">
		 <?php
		if($viewss1[0]=='1')
		{
		?>
		<?=$alltot1?>
         <?php
		}
		?>
        </td>
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
        <td class="<?=$trcolor?>"  align="center">
         <textarea placeholder="Enter the reason for Rejecting" cols="20" rows="2" name="cmnts<?=stripslashes($viewss1[8])?>" <?=$status_text?>><?=$viewss1[9]?></textarea></td>
         <td class="<?=$trcolor?>" align="center" nowrap>
          <?php
		 if($with_after_approve)
		 {
			  if($viewss1[0]!='EE' && $viewss1[0]!='6' && $viewss1[0]!='7' )
		 {
		 ?>
         <a href="javascript:void(0);" onClick ="OpenWind3('date_approved_after.php?insids=<?=$viewss1[8]?>', 'OpenWind3',900,400)">Date Approval</a>
         <?php
		 }
		 }
		 ?>
         </td>
    </tr>
   <?	
	}
	}
	?>
</table>
</div>
<br>
<?
if($p==5)
{
 $mang_hrrg=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
if(mysql_num_rows($mang_hrrg)>=1)
{			
?>
<div align='center' >
  <input type="submit" name="rej" value="Reject"  class='bgbutton'>
  </div>
  <?
}
}
  ?>
</fieldset>

<?
	}
?>
   <?php
if($p==1)
	{
$sql3=execute("select id,type,f_date,t_date,backup,days,reason,approved,reject,user_id,approve_reason,reject_reason,hd_ee_da_date,in_time,out_time,half_time_in,status_reason,manager,status_approve,status_approve_manger,status_with_staff,inserted_date,with_color,submit_with,updated_date from staff_leave where status=1  and staff_id='$staff_id_us[0]'  order by id desc");
if(mysql_num_rows($sql3)>=1)
{	
	?>
    </form>
<form name="frm1"  method="post">
  <fieldset style="height:auto;width:100%">
<legend><b><font style="font-size:16px">Applied Leave Details</font></b></legend>
<!--<table align='center'  width='100%' border="0" cellpadding="0" cellspacing="0">
<tr>
    <td class="head" align="center" width="5%" nowrap>Sel</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="5%" nowrap>No. Of Days</td>
    <td class="head" align="center" width="5%" nowrap>Status</td>
    <td class="head" align="center" width="10%" nowrap>Backup Resource</td>
    <td class="head" align="center" width="1%">Reason for Approving/Rejecting</td>
  </tr>
  </table>-->
<div style="max-height:200px; width:100%; overflow-y:auto" align="center">
<table align='center'  width='90%' border="0" cellpadding="0" cellspacing="0">
<tr>
<td nowrap style="background:none;">
<?php
$cc=1;
 $acc_view_id=fetcharray(execute("select id from leave_acc_year where acc_name='$acc_year'"));
 
  $paid_tot_count=fetcharray(execute("SELECT tot_paid from leave_staff_paid_tot_acc_temp where acc_id='$acc_view_id[0]' and staff_id='$staff_id_us[0]'"));
  
/*$leavtype=execute("select b.id,b.leave_name,a.days from leave_staff_day a,staff_leave_type b  where   b.status=1 and a.status=1 and a.staff_type='$staffname[2]' and a.leave_type=b.id and b.id='1' group by b.id");
while($leavty_vw=fetcharray($leavtype))
{*/
////////////////////////paid leave////////////////////////
$daycount_withdrawn_paid_cnt='';
$daycount_paid='';
$daycount_1=execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='1'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount33=fetcharray($daycount_1))
{
	$daycount_paid=$daycount33[0]+$daycount_paid;
}
		
	$daycount_withdrawn44=execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='1'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_paid=fetcharray($daycount_withdrawn44))
{
	$daycount_withdrawn_paid_cnt=$daycount_withdrawn_paid[0]+$daycount_withdrawn_paid_cnt;
}
///////////////////////end///////////////////////

///////////early exist///////////////
/*$daycount_ee='';
$daycount_withdrawn_ee_cnt='';
$daycount_1_ee=execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='EE'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount_1_ee1=fetcharray($daycount_1_ee))
{
	$daycount_ee++;
}

$daycount_withdrawn_ee=execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='EE'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_ee1=fetcharray($daycount_withdrawn_ee))
{
	$daycount_withdrawn_ee_cnt++;
}*/	

////////////////end////////////////////////	
	

///////////outdoor exist///////////////
/*$daycount_out='';
$daycount_withdrawn_out_cnt='';
$daycount_1_out=execute("select * from staff_leave where staff_id='$staff_id_us[0]' and type='6'  and status='1' and approved='0' and reject='0' and status_reason!='2'");
while($daycount_1_out1=fetcharray($daycount_1_out))
{
	$daycount_out++;
}

$daycount_withdrawn_out=execute("select * from staff_leave where staff_id='$staff_id_us[0]' and type='6'  and status='1' and approved='1' and status_reason!='2'");
while($daycount_withdrawn_out1=fetcharray($daycount_withdrawn_out))
{
	$daycount_withdrawn_out_cnt++;
}	*/
////////////////end////////////////////////	
$count_ee_out='';
$count_ee_out=$daycount_withdrawn_out_cnt+$daycount_out+$daycount_withdrawn_ee_cnt+$daycount_ee;
/////////////////totals//////



$staff_paid_dis_vat2=fetcharray(execute("select * from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staff_id_us[0]' and acc_id='$acc_view_id[0]'"));

	$alltotii=$paid_tot_count[0]-$daycount_paid-$daycount_withdrawn_paid_cnt-$staff_paid_dis_vat2[paid_vat]-$count_ee_out;

if($alltotii>0)
{
$alltot1cc=$alltotii;
$fnt_colrs='#009900';
}
if($alltotii<=0)
{
$alltot1cc=0;
$fnt_colrs='#FF0000';
}
?>
&nbsp;&nbsp;<!--<font color="#0000FF">Privilege Leave&nbsp;(<b><?=$paid_tot_count[0]?></b>)&nbsp;&nbsp;=&nbsp;&nbsp;</font><b><font color="<?=$fnt_colrs?>"><?=$alltot1cc?> (Available)</font></b>-->
<?php
//}
?>
</td>
</tr>
</table>
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0" >
<tr>
    <td class="head" align="center" width="8%" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="2%" nowrap>No. Of Days</td>
    <td class="head" align="center" width="10%" nowrap>Status</td>
    <td class="head" align="center" width="10%"  nowrap>Withdraw</td>
    <td class="head" align="center" nowrap>Approve Note</td>
  </tr>  
 <?php
  while($r6=fetcharray($sql3))
	{
		$tfdate1=explode('-',$r6[2]);
		$fdate1=$tfdate1[2]."-".$tfdate1[1]."-".$tfdate1[0];
		$ttdate1=explode('-',$r6[3]);
		$tdate1=$ttdate1[2]."-".$ttdate1[1]."-".$ttdate1[0];
		$stafnameap=fetcharray(execute("select f_name,s_name from staff_det  where  active='YES' and id='$r6[9]'"));
		
		$withcheck='';
		if($r6[7]==1)
		{
			$staff_app=date("d-m-Y h:i a",strtotime($r6[24]));
			$reason_ofmanger=$r6[10];
			$dischecks='disabled';
			$withcheck='';
			$titlereason='Approved';
			$vatnames11='<font color="#006600">Approved on<br>'."$staff_app".'</font>';
		}
		if($r6[8]==1)
		{
			$staff_rej=date("d-m-Y h:i a",strtotime($r6[24]));
			$reason_ofmanger=$r6[11];
			$dischecks='disabled';
			$withcheck='1';
			$titlereason='Rejected';
			$vatnames11='<font color="#FF0000">Rejected on<br>'."$staff_rej".'</font>';
		}
		
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$r6[1]'"));
		
		$hd_ee_date=explode('-',$r6[12]);
		$hd_ee_daft_date=$hd_ee_date[2]."-".$hd_ee_date[1]."-".$hd_ee_date[0];
		$pay_roll_out_ee='';
	$hd_time_vw_in='';
	$hd_time_vw_out='';

if($r6[1]=='HD')
{
	$hd_time_vw_in=date(" h:i a",strtotime($r6[13]));
	$hd_time_vw_out=date(" h:i a",strtotime($r6[14]));

	$staflavty[0]='Half Day'."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate1=$hd_ee_daft_date;
	$tdate1='';
	$r6[5]='';
	$pay_roll_out_ee=1;
}
if($r6[1]=='EE')
{
	$hd_time_vw_out=date(" h:i a",strtotime($r6[14]));

	$staflavty[0]='Early Exit'."<br>"."(".$hd_time_vw_out.")";
	$fdate1=$hd_ee_daft_date;
	$tdate1='';
	$r6[5]='';
	$pay_roll_out_ee=1;
}
if($r6[1]=='6')
{
	$hd_time_vw_in=date(" h:i a",strtotime($r6[13]));
	$hd_time_vw_out=date(" h:i a",strtotime($r6[14]));

	$staflavty[0]=$staflavty[0]."<br>"."(".$hd_time_vw_in." - ".$hd_time_vw_out.")";
	$fdate1=$hd_ee_daft_date;
	$tdate1='';
	$r6[5]='';
	$pay_roll_out_ee=1;
}
 
 $status_check=" ";

 if($r6[18]=='2')
	{
	$status_check="disabled";
	}
	else
	{
	 $status_check="";
	}
	
 ?>
<?
	if($r6[23]==2)
	{
	$trcolor="leavewith";
	}
	else
	{
		$trcolor='';
	}
?>
  <tr>
  <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($r6[21])); ?></td>
    <td nowrap align="center"  class="<?=$trcolor?>"  title="<?=$r6[6]?>" width="10%"><?=$staflavty[0]?></td>
    <td nowrap align="center"  class="<?=$trcolor?>"  title="<?=$r6[6]?>" width="10%"><?=$fdate1?></td>
    <td nowrap align="center"  class="<?=$trcolor?>"  title="<?=$r6[6]?>" width="10%"><?=$tdate1?>
    <?php
        if($r6[15])
		{
		?>
        (<?=$r6[15]?>)
        <?php
		}
		?>
    </td>
    <td nowrap align="center"   class="<?=$trcolor?>"  title="<?=$r6[6]?>" width="5%"><?=$r6[5]?></td>
    <td  align="center"  class="<?=$trcolor?>"   width="5%" title="<?=$r6[6]?>" nowrap>
	<?php
	$staff_name_withdrawn=fetcharray(execute("select * from staff_det where id='$r6[17]' and active='YES'"));
    if($r6[16]=='0')
	{
		echo "<font color='#0033FF'>Leave Withdrawn Pending</font>";
	}
	elseif($r6[16]=='2')
	{
		if(strtotime($r6[19]))
		{
		$date_manger=date("d-m-Y h:i a",strtotime($r6[19]));
		}
		if($r6[23]==1)
		{
			echo '<font color="#006600">Leave Withdrawn</font>';
		}
		else
		{
		echo '<font color="#006600">Leave Withdrawn Approved on<br>'."$date_manger".'</font>';
		}
	}
	elseif($r6[16]=='3')
	{
		if(strtotime($r6[19]))
		{
		$date_manger=date("d-m-Y h:i a",strtotime($r6[19]));
		}
		
		echo '<font color="#FF0000">Leave Withdrawn Rejected on<br>'."$date_manger".'</font>';
	}
	
	elseif($vatnames11)
	{
	echo "<div title='$titlereason'>";
	?>
	<?=$vatnames11?>
	<?php
	echo "</div>";
	}
	else
	{
	
?>
Submitted
   <!-- <a href="javascript:void(0);" title="Modify" onClick ="OpenWind3('update1.php?id=<?=$r6[0]?>', 'OpenWind3',400,400)"></a>-->
    	<?
	}
	$vatnames11='';
	$dischecks='';
	?>
    </td>
    <td  class="<?=$trcolor?>"  align="center" title="Withdraw" nowrap>
    <?php
    $staff_name_withdrawn=fetcharray(execute("select * from staff_det where id='$r6[17]' and active='YES'"));
    if($r6[16]=='1')
	{
		if(!$withcheck)
		{
		/////////////payroll/////////////		

		$from_pay_today=explode('-',$with_date_test);
		
		if($from_pay_today[2]==21)
		{
			$systemtime=strtotime($ttimess);
		}
	
		$from_pay_20=$from_pay_today[0]."-".$from_pay_today[1]."-21";
		
	if((strtotime($with_date_test) > strtotime($from_pay_20)) || ($systemtime>$stafftime_val))
	{
		$topay_validate=date('Y-m-d', strtotime('1 month', strtotime($from_pay_20)));
		//payroll fromdate
		$topay_pay_date1=explode('-',$from_pay_20);
		$topay_mnth_pay=$topay_pay_date1[0]."-".$topay_pay_date1[1]."-21";
		//payroll todate
		$topay_pay_bdate1=explode('-',$topay_validate);
		$topay_mnth_bpay=$topay_pay_bdate1[0]."-".$topay_pay_bdate1[1]."-21";
			
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
		$topay_mnth_pay=$topay_pay_date1[0]."-".$topay_pay_date1[1]."-21";
				
		$from_date_pay=$topay_mnth_bpay;
		$to_date_pay=$topay_mnth_pay;
	}
			
//////////////////////end///////////////////////	
	
$pay_nt_authorized='';
if($pay_roll_out_ee)
{
	$leave_pay_roll=fetcharray(execute("SELECT hd_ee_da_date FROM `staff_leave` WHERE status=1 and id='$r6[0]'"));
	if(strtotime($leave_pay_roll[0])<strtotime($from_date_pay))
	{
		$pay_nt_authorized=1;
	}
}
else
{
	$leave_pay_roll=fetcharray(execute("SELECT f_date,t_date FROM `staff_leave` WHERE status=1 and id='$r6[0]'"));
	if(strtotime($leave_pay_roll[0])<strtotime($from_date_pay) || strtotime($leave_pay_roll[1])<strtotime($from_date_pay))
	{
		$pay_nt_authorized=1;
	}
}

if($pay_nt_authorized)
{
	?>
     <a href="javascript:void(0);" style="text-decoration:none" title="Withdraw" onClick ="alert('Sorry, The payroll cycle for this month is already completed.\n Hence you are not authorized for this leave.\n Kindly contact your HOD.')">
    <img src="remove.png" width="25%"></a>
        <?php
	}		
	else
	{		
			
		?>	
    <a href="javascript:void(0);" style="text-decoration:none" title="Withdraw" onClick ="OpenWind3('withdraw_reason.php?id=<?=$r6[0]?>', 'OpenWind3',400,200)">
    <img src="remove.png" width="25%"></a>
    <?php
		}
		}
	}
	else
	{
			echo date("d-m-Y h:i a",strtotime($r6[20]));
    }
	?>
	</td>
    <td  class="<?=$trcolor?>"  align="justify" >&nbsp;<?=stripslashes($reason_ofmanger)?></td>
  </tr>
  <?
  $reason_ofmanger='';
	}

?>
</table> 
</div> 
<?
}
	}
  ?>
  <?php
if($p==6)
	{
?>
<input type="hidden" name="tab" value="<?=$p?>"/>
<fieldset style="height:auto;width:100%">

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==4){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
<?
	if($p==99){
		?>
        <li class="currentBtn"><a href="leave_withdrwn_screen.php?tab=123">Withdraw</a></li>
        <?
	}else{
		?>
        <li><a href="leave_withdrwn_screen.php?tab=123" >Withdraw</a></li>
        <?
	}
?>
<?
	if($p==88){
		?>
        <li class="currentBtn"><a href="leave_default_screen.php">Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_default_screen.php" >Default</a></li>
        <?
	}
?>
</ul>
</div>
</div>
<legend><font style="font-size:16px"><b>Leave Approval</b></font></legend>
<br>
 <!--  <table align='center'  width='100%' border="1" cellpadding="0" cellspacing="0">
 <tr>
<td class="head" align="center" width="3%">Sel</td>
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="10%">Staff Name</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="10%">Total Days</td>
    <td class="head" align="center" width="10%">Reason</td>
    <td class="head" align="center" width="1%"></td>
  </tr>
  </table>-->
<div style="max-height:300px; width:100%; overflow-y:auto" align="center">
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
<tr>
<td class="head" align="center" nowrap>Sl</td>

<td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>

    <td class="head" align="center"  nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center" nowrap>Reason</td>
    <td class="head" align="center" width="10%" nowrap>Withdrawn</td>
    <td class="head" align="center" nowrap>Approve Note</td>
  </tr>
  <?php
	$mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.EmployeeCode,a.id,a.reject_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.status_approve,a.manager,a.inserted_date  from staff_leave a,staff_det c where a.status=1 and a.reject='1' and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id and c.active='YES'");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
$daycount_tot='';		
$staff_leave_count=execute("select days from staff_leave where staff_id='$viewss1[10]' and type=$viewss1[0]' and approved='0'  and status='1' and reject='0' and status_reason!='2'");
 while($daycount=fetcharray($staff_leave_count))
	{
		$daycount_tot=$daycount[0]+$daycount_tot;
	}
		
	$daycount_withdrawn_tst='';	
	$daycount_widwn=execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'");
		while($daycount_withdrawn=fetcharray($daycount_widwn))
	{
		$daycount_withdrawn_tst=$daycount_withdrawn[0]+$daycount_withdrawn_tst;
	}
	
$daysvat=fetcharray(execute("select tot_paid,paid_vat from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$viewss1[10]' and acc_id='6'"));

	//$alltot=$daysvat[0]-$daycount_tot-$daycount_withdrawn_tst-$daysvat[1];
	$alltot=$daysvat[0]-$daysvat[1];

if($alltot>0)
{
$alltot1=$alltot;
}
if($alltot<=0)
{
$alltot1=0;
}

	$hd_time_vw_in='';
	$hd_time_vw_out='';

$hd_ee_date=explode('-',$viewss1[13]);
$hd_ee_daft_date=$hd_ee_date[2]."-".$hd_ee_date[1]."-".$hd_ee_date[0];
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
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));

	$staflavty[0]='Early Exit'."<br>"."(".$hd_time_vw_out[12].")";
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
<td nowrap align="center" class="<?=$trcolor?>"  width="3%"><input type="checkbox" name="manager[]" value="<?=$viewss1[8]?>" <?=$status_check?>></td>
    <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[18])); ?></td>
        <td nowrap align="center" width="10%"><?=$viewss1[7]?></td>
        <td nowrap width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
         <td nowrap align="center" width="10%"><?=$staflavty[0]?> 
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
        <td nowrap align="center">
		<?php
		if($viewss1[0]=='1')
		{
		?>
        <?=$alltot1?>
         <?php
		}
		 ?>
		</td>
        <td nowrap align="center" width="10%"><?=$fdate21?></td>
        <td nowrap align="center" width="10%"><?=$tdate21?>
        <?php
        if($viewss1[14])
		{
		?>
        (<?=$viewss1[14]?>)
        <?php
		}
		?>
        </td>
        <td nowrap align="center" width="10%"><?=$viewss1[3]?></td>
        <td align="justify">&nbsp;<?=stripslashes($viewss1[4])?></td>
        <td nowrap align="center" title="Withdrawn Status">
	<?php
	
	$staff_name_withdrawn=fetcharray(execute("select * from staff_det where id='$viewss1[17]' and active='YES'"));
    if($viewss1[15]=='0')
	{
		echo "<font color='#0033FF'>Pending</font>";
	}
	elseif($viewss1[15]=='2')
	{
		echo '<font color="#006600">Approved on<br>'."$staff_name_withdrawn[f_name]&nbsp;$staff_name_withdrawn[s_name]".'</font>';
	}
	elseif($viewss1[15]=='3')
	{
		echo '<font color="#FF0000">Rejected on<br>'."$staff_name_withdrawn[f_name]&nbsp;$staff_name_withdrawn[s_name]".'</font>';
	}
	else
	{
		echo "-";
	}
	?></td>
         <td align="justify"><textarea placeholder="" cols="20" rows="2" name="cmnts<?=stripslashes($viewss1[8])?>" <?=$status_text?>><?=$viewss1[9]?></textarea></td>
    </tr>
   <?	
	}
	}
	?>
</table>
</div>
<br>
<?
if($p==6)
{
	 $mang_hrrg=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
if(mysql_num_rows($mang_hrrg)>=1)
{
?>
<div align='center' >
  <input type="submit" name="appr" value="Approve"  class='bgbutton'>
  </div>
  <?
}
	}
?>
</fieldset>

<?
	}
?>
<?php
if($p==99)
	{
?>
<br>
<input type="hidden" name="tab" value="<?=$p?>"/>
<fieldset style="height:auto;width:100%">

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==4){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
<?
	if($p==99){
		?>
        <li class="currentBtn"><a href="leave_withdrwn_screen.php?tab=123">Withdraw</a></li>
        <?
	}else{
		?>
        <li><a href="leave_withdrwn_screen.php?tab=123" >Withdraw</a></li>
        <?
	}
?>
<?
	if($p==88){
		?>
        <li class="currentBtn"><a href="leave_default_screen.php">Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_default_screen.php" >Default</a></li>
        <?
	}
?>
</ul>
</div>
</div>
<legend><font style="font-size:16px"><b>Leave Approval</b></font></legend>
<br>
<!-- <table align='center'  width='100%' border="1" cellpadding="0" cellspacing="0">
 <tr>
  <td class="head" align="center" width="3%">Sel</td>
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="10%">Staff Name</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="10%">Total Days</td>
    <td class="head" align="center" width="10%">Reason</td>
    <td class="head" align="center" width="1%"></td>
  </tr>
  </table>-->
<div style="max-height:300px; width:100%; overflow-y:auto" align="center">
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
<tr>
    <td class="head" align="center" width="10%" nowrap>Sl</td>
    <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center"  nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center"  nowrap>Reason</td>
    <td class="head" align="center" nowrap>Leave<br>Status</td>
    <td class="head" align="center"  nowrap>Withdrawn<br>Status</td>
  </tr>
  <?php
	$mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.EmployeeCode,a.id,a.reject_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.status_with_staff,a.inserted_date,a.with_color,a.submit_with,a.approved,a.reject,a.updated_date,a.inserted_date,a.status_approve_manger  from staff_leave a,staff_det c where a.status=1 and  a.status_approve=2  and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id and c.active='YES'");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
		$daycount_tot='';
		$staff_leave_count=execute("select days from staff_leave where staff_id='$viewss1[10]' and type=$viewss1[0]' and approved='0'  and status='1' and reject='0' and status_reason!='2'");
		while($daycount=fetcharray($staff_leave_count))
	{
		$daycount_tot=$daycount[0]+$daycount_tot;
	}
	
		$daycount_withdrawn_tst='';
	$daycount_widwn=execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'");
	while($daycount_withdrawn=fetcharray($daycount_widwn))
	{
		$daycount_withdrawn_tst=$daycount_withdrawn[0]+$daycount_withdrawn_tst;
	}
		
$daysvat=fetcharray(execute("select tot_paid,paid_vat from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$viewss1[9]' and acc_id='6'"));

	//$alltot=$daysvat[0]-$daycount_tot-$daycount_withdrawn_tst-$daysvat[1];
	$alltot=$daysvat[0]-$daysvat[1];
if($alltot>0)
{
$alltot1=$alltot;
}
if($alltot<=0)
{
$alltot1=0;
}

	$hd_time_vw_in='';
	$hd_time_vw_out='';
	
$hd_ee_date=explode('-',$viewss1[13]);
$hd_ee_daft_date=$hd_ee_date[2]."-".$hd_ee_date[1]."-".$hd_ee_date[0];
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
	$hd_time_vw_out=date(" h:i a",strtotime($viewss1[12]));
	
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
if($viewss1[19]=='1')
{
	$submited_leave='disabled';
}
else
{
	$submited_leave='';
}
$mang_date_status=date("d-m-Y h:i a",strtotime($viewss1[24]));

if($viewss1[20]=='1')
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[22]));
	$leave_status='Approved on<br>'.$date_leave1;
}
elseif($viewss1[21]=='1')
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[22]));
	$leave_status='Rejected on<br>'.$date_leave1;
}
else
{
	$date_leave1=date("d-m-Y h:i a",strtotime($viewss1[23]));
	$leave_status='Submitted by<br>'.$date_leave1;
	$mang_date_status='';
}
if($viewss1[19]==2)
	{
	$trcolor="leavewith";
	}
	else
	{
		$trcolor='';
	}
?>
    <tr>
   <td nowrap class="<?=$trcolor?>" align='center'  width="5%"><input type='checkbox' name='cid_with[]' value='<?=$viewss1[8]?>' <?=$submited_leave?>></td>
   <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[17])); ?></td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[7]?></td>
        <td nowrap class="<?=$trcolor?>" width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
         <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$staflavty[0]?> 
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
		 ?>
		
        </td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$fdate21?></td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$tdate21?>
        <?php
        if($viewss1[14])
		{
		?>
        (<?=$viewss1[14]?>)
        <?php
		}
		?>
        </td>
        <td nowrap class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[3]?></td>
        <td  class="<?=$trcolor?>" align="justify">&nbsp;<?=stripslashes($viewss1[4])?></td>
         <td nowrap class="<?=$trcolor?>" align="center">&nbsp;<?=$leave_status?></td>
          <td nowrap class="<?=$trcolor?>" width="10%" align="center">
		  <?php
          if($viewss1[15]=='2')
		  {
			  echo "<font color='#00CC00'>Approved <br> $mang_date_status</font>";
		  }
		  elseif($viewss1[15]=='3')
		  {
			  echo "<font color='#FF0000'>Rejected <br> $mang_date_status</font>";
		  }
		  else
		  {
			    echo "<font color='#0000FF'>Pending</font>";
		  }
		  
		  ?></td>
    </tr>
   <?	
	}
	}
	?>
</table>
</div>
<br>
<?
if($p==99)
{
 $mang_hrrg=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
if(mysql_num_rows($mang_hrrg)>=1)
{			
?>
<div align='center' >
  <input type="submit" name="with_manger" value="Approve"  class='bgbutton'>&nbsp;&nbsp;
    <input type="submit" name="with_manger_rj" value="Reject"  class='bgbutton'>
  </div>
  <?
}
	}
?>
<br>
<?
if($p==5)
{
 $mang_hrrg=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
if(mysql_num_rows($mang_hrrg)>=1)
{			
?>
<div align='center' >
  <input type="submit" name="rej" value="Reject"  class='bgbutton'>
  </div>
  <?
}
}
  ?>
</fieldset>

<?
	}
?>
<?php
if($p==88)
	{
?>
<input type="hidden" name="tab" value="<?=$p?>"/>
<fieldset style="height:auto;width:100%">

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==4){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave_1.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_1.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
<?
	if($p==99){
		?>
        <li class="currentBtn"><a href="leave_withdrwn_screen.php?tab=123">Withdraw</a></li>
        <?
	}else{
		?>
        <li><a href="leave_withdrwn_screen.php?tab=123" >Withdraw</a></li>
        <?
	}
?>
<?
	if($p==88){
		?>
        <li class="currentBtn"><a href="leave_default_screen.php">Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_default_screen.php" >Default</a></li>
        <?
	}
?>
</ul>
</div>
</div>
<legend><font style="font-size:16px"><b>Leave Approval</b></font></legend>
<br>
 <!--  <table align='center'  width='100%' border="1" cellpadding="0" cellspacing="0">
 <tr>
<td class="head" align="center" width="3%">Sel</td>
    <td class="head" align="center" width="10%">Staff Code</td>
    <td class="head" align="center" width="10%">Staff Name</td>
    <td class="head" align="center" width="10%">Leave Type</td>
    <td class="head" align="center" width="10%">From Date</td>
    <td class="head" align="center" width="10%">To Date</td>
    <td class="head" align="center" width="10%">Total Days</td>
    <td class="head" align="center" width="10%">Reason</td>
    <td class="head" align="center" width="1%"></td>
  </tr>
  </table>-->
<div style="max-height:300px; width:100%; overflow-y:auto" align="center">
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
    <tr>
    <td class="head" align="center" width="10%" nowrap>Sel</td>
    <td class="head" align="center" nowrap>Applied Date</td>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center"  nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="10%" nowrap>Date</td>
    <td align="center" class="head" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Edit IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Edit OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Time Spent</td>
    <td class="head" align="center"  nowrap>Reason</td>
     <td class="head" align="center" width="10%" nowrap>Status</td>
    </tr>
  <?php
	$mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.id,a.EmployeeCode,a.f_name,a.s_name,b.d_date,a.group_id,b.time_in,b.time_out,b.reason,b.id,b.ins_date from staff_det a,staff_default b where b.staff_id=a.id and b.status=1 and b.staff_id='$mang_hr_rgts[0]' and c.active='YES'");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[d_date]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[0]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewss1[d_date]' and user='$viewss1[0]'  order by att_time asc limit 1"));

	$staffrfiout=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewss1[d_date]' and user='$viewss1[0]'  order by att_time desc limit 1"));	
	
	$staff_default_sts=fetcharray(execute("SELECT approved ,reject,inserted_date  FROM `staff_default_status` where staff_id_ins='$viewss1[9]'"));

?>
  <?php
$absnts1=1;
$absnts2=1;
if($staffrfidlv[0])
{
$absnts1=0;
}
if($staffrfiout[0]!=$staffrfidlv[0])
{
$absnts2=0;
}
?>
  
    <tr>
     <td align="center" width="10%" nowrap><input type='checkbox' name='default[]' value='<?=$viewss1[9]?>' ></td>
     <td  align='center' nowrap  class="<?=$trcolor?>"  width="8%"><?php echo date("d-m-Y h:i a",strtotime($viewss1[10])); ?></td>
        <td  align="center" width="10%" nowrap><?=$viewss1[EmployeeCode]?></td>
        <td nowrap>&nbsp;<?=$viewss1[f_name]?>&nbsp;<?=$viewss1[s_name]?></td>
         <td align="center" width="10%" nowrap> 
         <?php
		 if($absnts1=='1' && $absnts2=='1')
		 {
		 ?>
         <font color="#FF0000"><b>Absent</b></font>
		<?php
		 }
		 else
		 {
		?>
         <b>Default</b>
         <?php
		 }
		 ?>
         </td>
          <td align="center" width="10%" nowrap><?=$fdate21?></td>
           <td align="center" width="10%" nowrap>
           <font color="#0033FF">
        <?php
        $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[5]' and date_type='2' and leave_det=1 and staff_date='$viewss1[d_date]'"));
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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[5]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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
        </font>
        </td>
        <td align="center">
		<font color="#006600">
        <?php
		$testin=0;
        $testout=0;
        if($staffrfidlv[0])
        {
        $testin=1;
		echo $staffrfidlv[0];
        }
        ?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
		<font color='#FF0000'>
		<?php
		$edit_timein='0';
        if($viewss1[6])
		{
			$edit_timein='1';
			echo $viewss1[6]; 
		}	
		?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
        <font color="#0033FF">
        <?php
       $staff_time_check_date=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime,staff_date from staff_time where status='1' and staff_type='$viewss1[5]' and date_type='2' and leave_det=1 and staff_date='$viewss1[d_date]'"));

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
		$staff_time_check=fetcharray(execute("select intime,ex_intime,outtime,ex_outtime from staff_time where status='1' and staff_type='$viewss1[5]' and date_type=1 and leave_det=1 and staff_date=''"));
	
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
        </font>
        </td>
        <td align="center" width="10%" nowrap>
		<font color="#006600">
        <?php
		echo $staffrfiout[0];
		if($staffrfiout[0]!=$staffrfidlv[0])
		{
		$testout=1;
		
        }
		?>
        </font>
        </td>
        <td align="center" nowrap>
		<font color='#FF0000'>
        <?php
		$edit_timeout='0';
        if($viewss1[7])
		{
			$edit_timeout='1';
			echo $viewss1[7]; 
		}	
		?>

        </font>
        </td>
        <td align="center" nowrap>
        <?
	if($edit_timein=='1' && $edit_timeout=='1')
	{
		$in_edit_time=$viewss1[6];
		$out_edit_time=$viewss1[7];
		
		$alltime1 = ($viewss1[6]);
		$alltime2 = ($viewss1[7]);
		$alltime3 = strtotime($alltime2) - strtotime($alltime1);
		$alltime1_sec=strtotime($alltime1);
		$alltime2_sec=strtotime($alltime2);
		$alltime3_sec=$alltime2_sec-$alltime1_sec;
		
			echo $alltime_final = gmdate ( 'H:i:s' , $alltime3_sec);
		
	}
	else
	{
		if($edit_timein=='1' && $edit_timeout=='0')
		{
			$in_edit_time=$viewss1[6];
			$out_time=$staffrfiout[0];
		
			$intime1 = ($viewss1[6]);
			$intime2 = ($staffrfiout[0]);
			$intime3 = strtotime($intime2) - strtotime($intime1);
			$intime1_sec=strtotime($intime1);
			$intime2_sec=strtotime($intime2);
			$intime3_sec=$intime2_sec-$intime1_sec;
				echo $intime_final = gmdate ( 'H:i:s' , $intime3_sec);
			
		}
		
		if($edit_timein=='0' && $edit_timeout=='1')
		{
			$in_time=$staffrfidlv[0];
			$out_edit_time=$viewss1[7];
			
			$outtime1 = ($staffrfidlv[0]);
			$outtime2 = ($viewss1[7]);
			$outtime3 = strtotime($outtime2) - strtotime($outtime1);
			
			$outtime1_sec=strtotime($outtime1);
			$outtime2_sec=strtotime($outtime2);
			$outtime3_sec=$outtime2_sec-$outtime1_sec;
			
				echo $outtime_final = gmdate ( 'H:i:s' , $outtime3_sec);
		}
	}
        ?>
         </td>
         <td align="justify">&nbsp;<?=$viewss1[8]?></td>
          <td align="center" nowrap>
         <?php
		 $app_reje_datess=date("d-m-Y h:i a",strtotime($staff_default_sts[2]));
		 if($staff_default_sts[0]==1)
		 {
			 echo "<font color='#003300'><b>Approved on</b><br>$app_reje_datess</font>";
		 }
		 elseif($staff_default_sts[1]==1)
		 {
			  echo "<font color='#FF0000'><b>Rejected on</b><br>$app_reje_datess</font>";
		 }
		 else
		 {
			 echo "<font color='#0000FF'><b>Pending</b></font>";
		 }
         ?> 
         </td>
    </tr>
   <?	
	}
	}
	}
	?>
</table>
<br>

<?php
if($p==88)
	{
		 $deafault_1=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
if(mysql_num_rows($deafault_1)>=1)
{
?>
<div align='center' >
  <input type="submit" name="appr_default" value="Approve"  class='bgbutton'>&nbsp;&nbsp;
 <input type="submit" name="rej_default" value="Reject"  class='bgbutton' ></a>
  </div>
  <?php
}
	}
  ?>
</div>

</fieldset>
</fieldset>
</form>
</fieldset>
    <!----timecode---->

<script type="text/javascript" src="jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
       todayBtn:  1,
	autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>

<!----timecode end---->
</body>
</html>

