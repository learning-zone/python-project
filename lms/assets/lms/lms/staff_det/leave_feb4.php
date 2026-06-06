<html>
<head>
<Script language="JavaScript">

	function RefreshMe(val)
	{
		document.frm.action="leave_feb4.php";
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>
<script> 
$(document).ready(function(){
  $("#flip1").click(function(){
    $("#panel1").slideToggle("fast");
  });
});
$(document).ready(function(){
  $("#flip2").click(function(){
    $("#panel2").slideToggle("fast");
  });
});
$(document).ready(function(){
  $("#flip3").click(function(){
    $("#panel3").slideToggle("fast");
  });
});

$(document).ready(function(){
  $("#flip4").click(function(){
    $("#panel4").slideToggle("fast");
  });
});

$(document).ready(function(){
  $("#flip5").click(function(){
    $("#panel5").slideToggle("fast");
  });
});

$(document).ready(function(){
  $("#flip6").click(function(){
    $("#panel6").slideToggle("fast");
  });
});

</script>

<style type="text/css"> 
#panel1,#flip1
{
padding:3px;
text-align:center;
background-color: #FFC;
border:solid 1px  #000000;
color:rgb(0,0,0);
}
#panel1
{
padding:3px;
display:none;
}
#panel2,#flip2
{
padding:3px;
text-align:center;
background-color: #FFE2C5;
border:solid 1px #000000;
color:rgb(0,0,0);
}
#panel2
{
padding:3px;
display:none;
}
#panel3,#flip3
{
padding:3px;
text-align:center;
background-color: #FFE2C5;
border:solid 1px #000000;
color:rgb(0,0,0);
}
#panel3
{
padding:3px;
display:none;
}#panel4,#flip4
{
padding:3px;
text-align:center;
background-color: #FFE2C5;
border:solid 1px #000000;
color:rgb(0,0,0);
}
#panel4
{
padding:3px;
display:none;
}

#panel5
{
padding:3px;
display:none;
}

#panel6
{
padding:3px;
display:none;
}

#panel5,#flip5
{
padding:3px;
text-align:center;
background-color: #FFE2C5;
border:solid 1px #000000;
color:rgb(0,0,0);
}

#panel6,#flip6
{
padding:3px;
text-align:center;
background-color: #FFE2C5;
border:solid 1px #000000;
color:rgb(0,0,0);
}

</style>
<?php
for($n=1;$n<7; $n++)
{
?>
<div id="flip<?=$n?>">
<div align="center" style="widows:inherit">
Click Here To View Favourite Address
</div>
<div id="panel<?=$n?>" style="width:100%; overflow-y:auto">
    <table width="100%" border="1" align="center">
    <tr>
    <th colspan="7" align="center" class="newalign">Favourite Address</th>
    </tr>
    <tr>
    <th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th>
    <th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th><th align='center'>No.</th>
    <th align='center'>Favourite ID</th>
    <th align='center'>Date Created</th>
    <th align='center'>Name</th>
    <th align='center'>Address</th>
    </tr>
    </table>
    </div>
    </div>
 <?
 }
 ?>   
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

$staffrigtss=fetcharray(execute("SELECT groupname FROM `users` where username='$user'"));
$leave_add=date('Y-m-d H:i:m');
$with_date_test=date('Y-m-d');
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
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
</head>
<?
	if($_POST['appr_default'])
	{
		
		$default=$_POST['default'];
		for($d=0;$d<sizeof($default);$d++)
		{
			$Sql66=execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$default[$d]'");
	if(mysql_num_rows($Sql66)>0)
	{
		 execute("update staff_default_status set approved='1',reject='',inserted_date='$leave_add'  where staff_id_ins='$default[$d]'");
	}
	else
	{
		execute("INSERT INTO staff_default_status (`user`,`inserted_date`,`staff_id_ins`,`type`,`in_time`,`in_edit_time`,`out_time`,`out_edit_time`,`manager_id`,`default_date`,`default_id`,`approved`,`reject`,`acc_year`) VALUES ('$user','$leave_add','$default[$d]', 'D','$in_time','$in_edit_time','$in_edit_time','$out_edit_time', '$staff_id_us[0]', '$default_date','$default_id','1','','$acc_year')");
	}
		
		}
	
	}
	if($_POST['rej_default'])
	{
		
		$default=$_POST['default'];
		for($d=0;$d<sizeof($default);$d++)
		{
		$Sql66=execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$default[$d]'");
	if(mysql_num_rows($Sql66)>0)
	{
		 execute("update staff_default_status set reject='1',approved='',inserted_date='$leave_add' where staff_id_ins='$default[$d]'");
	}
	else
	{	
		execute("INSERT INTO staff_default_status (`user`,`inserted_date`,`staff_id_ins`,`type`,`in_time`,`in_edit_time`,`out_time`,`out_edit_time`,`manager_id`,`default_date`,`default_id`,`approved`,`reject`,`acc_year`) VALUES ('$user','$leave_add','$default[$d]', 'D','$in_time','$in_edit_time','$in_edit_time','$out_edit_time', '$staff_id_us[0]', '$default_date','$default_id','','1','$acc_year')");
	}
		
		}
	
	}
?>
	<?php
    if($_POST['save'])
    {
		$flag_true=0;
		if($type==5 || $type=='HD' || $type=='EE' )
		{
			$flag_true=1;
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
						
			execute("INSERT INTO staff_leave (user,avl, reason, manager,type, f_date, t_date, backup, notify, days, contact,acc_year,staff_id, status,in_time,out_time,hd_ee_da_date,half_time_in,f_time,to_time,inserted_date,status_approve,status_reason) VALUES ('$user','$avl','{$reason}', '$manager','$type','$fdate','$tdate','{$backup}', '$teacher', '$days','$contact','$acc_year','$staff_id_us[0]','1','$timein','$timeout','$hd_ee_date','$half_time_in','$from_am_pm','$to_am_pm','$leave_add','1','1')");
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
			alert("Please Enter From Date & To Date");
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
			
        execute("update staff_leave set approved='1',user_manager='$user',updated_date='$leave_add',user_id='$staff_id_us[0]',approve_reason='{$cmnts}' where id='$manager[$m]'");	
	}
		?>
		<Script language="JavaScript">
		alert("Approved");
		</Script>
        <?
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
		if($cmnts)
		{
			$flag=1;
        execute("update staff_leave set reject='1',approved='0',user_manager='$user',updated_date='$leave_add',user_id='$staff_id_us[0]',reject_reason='{$cmnts}'  where id='$manager[$c]'");
		}
		else
		{
		?>
		<Script language="JavaScript">
		alert("Enter the reason for Rejecting !");
		</Script>
        <?
		}
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
        

        <?php
if($_POST['with_manger'])
{

	$cid_with=$_POST['cid_with'];
	for($gm=0;$gm<sizeof($cid_with);$gm++)
	{
        execute("update staff_leave set status_reason='2',manager='$staff_id_us[0]',user_manager='$user',status_approve_manger='$leave_add' where id='$cid_with[$gm]'");	
	}
}

if($_POST['with_manger_rj'])
{

	$cid_with=$_POST['cid_with'];
	for($gm=0;$gm<sizeof($cid_with);$gm++)
	{
        execute("update staff_leave set status_reason='3',user_manager='$user',manager='$staff_id_us[0]',status_approve_manger='$leave_add' where id='$cid_with[$gm]'");	
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
<?
if($adate)
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
}

?><br>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<?
	if($p==1){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=1" >Leave & Attendance</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=1" >Leave & Attendance</a></li>
        <?
	}
?>
<?

$mang_hrrt=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  if(mysql_num_rows($mang_hrrt)>0 || $staffrigtss[0]=='admin')
	{
		
	if($p==2 || $p==4 || $p==5  || $p==6 || $p==99 || $p==88){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=2" >Leave Approval</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=2" >Leave Approval</a></li>
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
</form>

<form name="frm"  method="post">
<?php
if($p==1)
	{
?>

<fieldset style="height:auto;width:100%">
<legend><font style="font-size:16px"><b>Leave Form</b></font></legend>


<?php
$staffname=fetcharray(execute("select b.f_name,b.s_name,b.group_id from users a,staff_det b where   a.srid=b.id and a.username='$user'"));

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

//no of sundays
	$date1 = $pfdate;
	$date2 = $ptdate;

for ($i = 0; $i < ((strtotime($date2) - strtotime($date1)) / 86400); $i++)
{
	if(date('l',strtotime($date1) + ($i * 86400)) == 'Sunday')
	{
		$num_sundays++;
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
        $staff_mang=fetcharray(execute("SELECT b.f_name,b.s_name,b.id FROM staff_hr_grup a,staff_det b,staff_leave_manger c where a.mng_id =b.id and a.mng_id=c.manger_id and c.status=1 and a.status=1  and a.staff_id='$staff_id_us[0]'"));
        ?>
        </td>
        <td style="font-size:13px" align="left"  width="10%" nowrap>Reporting Mgr</td>
        <td style="font-size:13px" align="left" width="25%"><font color="#0000FF"><?=$staff_mang[0]?>&nbsp;<?=$staff_mang[1]?></font></td>
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
$typesv=execute("select b.id,b.leave_name,a.days from leave_staff_day a,staff_leave_type b  where   b.status=1 and a.status=1 and a.staff_type='$staffname[2]' and b.id!=5 and a.leave_type=b.id group by b.id");
for($i=0;$i<rowcount($typesv);$i++)
{
	$typesv1=fetcharray($typesv,$i);
	if($type==$typesv1[id])
	{
		if($typesv1[id]==5)
		{
		echo "<option value='$typesv1[id]' selected>$typesv1[leave_name]</option>";
		}
		else
		{
		echo "<option value='$typesv1[id]' selected>$typesv1[leave_name]  ($typesv1[days])</option>";
		}
	}
	else
	{
		if($typesv1[id]==5)
		{
		echo "<option value='$typesv1[id]'>$typesv1[leave_name]</option>";
		}
		else
		{
			echo "<option value='$typesv1[id]'>$typesv1[leave_name] ($typesv1[days])</option>";
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
<!--<option value='HD' <?=$hdselect?>>Half Day</option>
<option value='EE' <?=$eeselect?>>Early Exit</option>
--></select>
     </td>   
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
		
			
$daycount=fetcharray(execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='$type'  and status='1' and reject='0' and status_reason!='2'"));
		
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
	if($type!='')
{
	$daydisp=fetcharray(execute("select lv_ty from staff_leave_type where  id='$type'  and status=1 "));
	if(!$daydisp[0])
	{
		if($type!=5 && $type!='HD' && $type!='EE' )
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
if($type==5 || $type=='HD' || $type=='EE' )
{
?>
<td  style="font-size:13px" align="center" valign="bottom" nowrap>
<font color="#009900">In Time</font><br>
<div class="control-group">
<div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="timein" data-link-format="hh:ii">
<input type="text" name="timein" value="" style="width:60px; height:30px" readonly>
<span class="add-on"><i class="icon-remove"></i></span>
<span class="add-on"><i class="icon-th"></i></span>
</div>
<input type="hidden" id="timein" />
</div>
</td>
<td  style="font-size:13px" align="center" nowrap>
<font color="#009900">Out Time</font><br>
<div class="control-group">
<div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="timeout" data-link-format="hh:ii">
<input type="text" name="timeout" value="" style="width:60px; height:30px" readonly>
<span class="add-on"><i class="icon-remove"></i></span>
<span class="add-on"><i class="icon-th"></i></span>
</div>
<input type="hidden" id="timeout" />
</div>
</td>
<td  style="font-size:13px" align="left" nowrap>
Date
</td>
<td  style="font-size:13px" align="center" nowrap>
<div class="control-group">
<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="hd_ee_date" data-link-format="yyyy-mm-dd">
<span class="add-on"><i class="icon-th"></i></span>
<input size="16"  name="hd_ee_date" type="text" value="" style="width:100px; height:30px" readonly>
<span class="add-on"><i class="icon-remove"></i></span>

</div>
<input type="hidden" id="hd_ee_date" value="" />
</div>
</td>
<?
}
else
{
?>
        <td  style="font-size:13px" align="left" nowrap> Leave Duration* </td>
        <td style="font-size:13px" align="center" nowrap>
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
		?>
        <select name="from_am_pm" style="width:80px" onChange="RefreshMe(0)">
         <option value=''>Full day</option>
            <option value='0.5_ain' <?=$frm_check?>>FHL</option>
            <option value='0.5_pin' <?=$frm_check1?>>SHL</option>
            </select>
            </td>
        <td style="font-size:13px" align="center" nowrap>
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
		?>
             <select name="to_am_pm"  style="width:80px" onChange="RefreshMe(0)">
              <option value=''>Full day</option>
            <option value='0.5_aout' <?=$to_check?>>FHL</option>
            <option value='0.5_pout' <?=$to_check1?>>SHL</option>
            </select> 
        </td>
        <td style="font-size:13px" align="left" width="8%" nowrap>No. Days</td>
        <?
        $staflavty1=fetcharray(execute("select leave_name from staff_leave_type  where  status=1  and id='$type'"));
        
        if($totdays>$alltot1)
        {
        $daydisp=fetcharray(execute("select lv_ty from staff_leave_type where  id='$type'  and status=1"));
if(!$daydisp[0])
	{
 $totdays=0;
        $totdays=0;
		$adate='';
		$bdate='';
        ?>
		<Script language="JavaScript">
		alert("Exceded the number of <?=$staflavty1[0]?>!");
		</Script>
        <?
        	
        }
        }
		$frmdatesam=explode('_',$from_am_pm);
		$todatesam=explode('_',$to_am_pm);
		$timediffers=$frmdatesam[0]+$todatesam[0];
		$totdays=$totdays-$timediffers;
        ?>
        <td align="left"  width="8%" nowrap>
       
        <input type="text" name="days" value="<?=$totdays?>" size="3" style="background-color: #FFFFCC;width:40px;"   readonly></td>
        <?php
}
		?>
    </tr>
    <tr>
        <td  style="font-size:13px" align="left" nowrap>Reason* </td>
        <td colspan="2" nowrap><textarea rows="3" cols="30" name='reason'  style="background-color: #FFFFCC" placeholder="Reason*" required ><?=stripslashes($reason)?></textarea></td>
       
        <td style="font-size:13px" align="left" nowrap>Alt Contact #</td>
        <td align="left"  colspan="4" nowrap><input type="text" name="contact" value="<?=$contact?>" placeholder="Alt Contact #" size="20" style="background-color: #FFFFCC;width:150px;" > </td>
    </tr>
</table>
</fieldset>
<br>
<div align='center' >
  <input type="submit" name="save" value="Save"  class='bgbutton'>
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
        <li class="currentBtn"><a href="leave_feb4.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
<?
	if($p==99){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=99">Withdraw</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=99" >Withdraw</a></li>
        <?
	}
?>
<?
	if($p==88){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=88">Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=88" >Default</a></li>
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
  
	 $mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{

	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno,a.id,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.manager,a.status_approve,a.status_with_staff,a.inserted_date,a.submit_with from staff_leave a,staff_det c where a.status=1  and a.approved='0' and a.reject='0' and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));


$daycount=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[9]' and type='$viewss1[0]'  and status='1' and reject='0' and status_reason!='2'"));
		
	$daycount_withdrawn=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[9]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'"));
		
$daysvat=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$viewss1[0]'"));

	$alltot=$daysvat[0]-$daycount[0]-$daycount_withdrawn[0];


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

$hd_ee_date=explode('-',$viewss1[12]);
$hd_ee_daft_date=$hd_ee_date[2]."-".$hd_ee_date[1]."-".$hd_ee_date[0];
if($viewss1[0]=='HD')
{
	$staflavty[0]='Half Day'."<br>"."(".$viewss1[10]." - ".$viewss1[11].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='EE')
{
	$staflavty[0]='Early Exit'."<br>"."(".$viewss1[10]." - ".$viewss1[11].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='5')
{
	$staflavty[0]=$staflavty[0]."<br>"."(".$viewss1[10]." - ".$viewss1[11].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}

////////end/////////

$status_check=" ";
$status_text=" ";
 if($viewss1[16]=='2')
	{
	$status_check="disabled";
	$status_text="readonly";
	}
	else
	{
	 $status_check="";
	 $status_text="";
	}
	?>
    <tr>
 <td class="<?=$trcolor?>" align="center" width="3%"><input type="checkbox" name="manager[]" value="<?=$viewss1[8]?>" <?=$status_check?>></td>
        <td class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[7]?></td>
        <td class="<?=$trcolor?>" width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td class="<?=$trcolor?>" align="center" width="10%"><?=$staflavty[0]?>
        <?php
		if($viewss1[0]!='EE' && $viewss1[0]!='5' && $viewss1[0]!='HD')
		{
		?>
        (<?=$daysvat[0]?>)
        <?php
		}
		?>
        </td>
        <td class="<?=$trcolor?>" align="center"><?=$alltot1?></td>
        <td class="<?=$trcolor?>" align="center" width="10%"><?=$fdate21?></td>
        <td class="<?=$trcolor?>" align="center" width="10%"><?=$tdate21?> 
        <?php
        if($viewss1[13])
		{
		?>
        (<?=$viewss1[13]?>)
        <?php
		}
		?>
        </td>
        <td class="<?=$trcolor?>" align="center"width="10%"><?=$viewss1[3]?></td>
        <td class="<?=$trcolor?>" align="justify">&nbsp;<?=$viewss1[4]?></td>
        <td class="<?=$trcolor?>" align="center" title="Withdrawn Status">
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
         <textarea placeholder="Enter the reason for Approving/Rejecting" cols="20" rows="2" name="cmnts<?=$viewss1[8]?>" <?=$status_text?>></textarea></td>
    </tr>
   <?	
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
 <input type="submit" name="rej" value="Reject"  class='bgbutton' ></a>
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
        <li class="currentBtn"><a href="leave_feb4.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
<?
	if($p==99){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=99">Withdraw</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=99" >Withdraw</a></li>
        <?
	}
?>
<?
	if($p==88){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=88">Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=88" >Default</a></li>
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
	 $mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno,a.id,a.approve_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.status_approve,a.manager,a.submit_with,a.status_approve_manger from staff_leave a,staff_det c where a.status=1  and a.approved='1' and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
	
	$daycount=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and reject='0' and status_reason!='2'"));
		
	$daycount_withdrawn=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'"));
		
$daysvat=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$viewss1[0]'"));

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
if($viewss1[0]=='HD')
{
	$staflavty[0]='Half Day'."<br>"."(".$viewss1[11]." - ".$viewss1[12].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='EE')
{
	$staflavty[0]='Early Exit'."<br>"."(".$viewss1[11]." - ".$viewss1[12].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='5')
{
	$staflavty[0]=$staflavty[0]."<br>"."(".$viewss1[11]." - ".$viewss1[12].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}

$status_check=" ";
$status_text=" ";
 if($viewss1[16]=='2')
	{
	$status_check="disabled";
	$status_text="readonly";
	}
	else
	{
	 $status_check="";
	 $status_text="";
	}

?>
    <tr>
 <td align="center" class="<?=$trcolor?>"  width="3%"><input type="checkbox" name="manager[]" value="<?=$viewss1[8]?>" <?=$status_check?>></td>
        <td class="<?=$trcolor?>"  align="center"  width="10%"><?=$viewss1[7]?></td>
        <td class="<?=$trcolor?>"  width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
        <td class="<?=$trcolor?>"  align="center" width="10%"><?=$staflavty[0]?> 
        <?php
		if($viewss1[0]!='EE' && $viewss1[0]!='5' && $viewss1[0]!='HD')
		{
		?>
        (<?=$daysvat[0]?>)
        <?php
		}
		?>
        </td>
        <td class="<?=$trcolor?>"  align="center"><?=$alltot1?></td>
        <td class="<?=$trcolor?>"  align="center" width="10%"><?=$fdate21?></td>
        <td class="<?=$trcolor?>"  align="center" width="10%"><?=$tdate21?>
        <?php
        if($viewss1[14])
		{
		?>
        (<?=$viewss1[14]?>)
        <?php
		}
		?>
        </td>
        <td class="<?=$trcolor?>"  align="center" width="10%"><?=$viewss1[3]?></td>
        <td class="<?=$trcolor?>"  align="justify">&nbsp;<?=$viewss1[4]?></td>
        <td class="<?=$trcolor?>"  align="center" title="Withdrawn Status">
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
//$leavtype=execute("select b.id,b.leave_name,a.days from leave_staff_day a,staff_leave_type b  where   b.status=1 and a.status=1 and a.staff_type='$staffname[2]' and a.leave_type=b.id group by b.id");
$leavtype=execute("select b.id,b.leave_name,a.days from leave_staff_day a,staff_leave_type b  where   b.status=1 and a.status=1 and a.staff_type='$staffname[2]' and a.leave_type=b.id and (b.id='1' or b.id='5') group by b.id");
while($leavty_vw=fetcharray($leavtype))
{


$daycount33=fetcharray(execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='$leavty_vw[0]'  and status='1' and reject='0' and status_reason!='2'"));
		
	$daycount_withdrawn44=fetcharray(execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='$leavty_vw[0]'  and status='1' and approved='1' and status_reason!='2'"));
		
$daysvat55=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$leavty_vw[0]'"));

	$alltotii=$daysvat55[0]-$daycount33[0]-$daycount_withdrawn44[0];

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
&nbsp;&nbsp;<font color="#0000FF"><?=$leavty_vw[1]?>&nbsp;(<b><?=$leavty_vw[2]?></b>)&nbsp;&nbsp;=&nbsp;&nbsp;</font><b><font color="<?=$fnt_colrs?>"><?=$alltot1cc?></font>,</b>
<?php
}
?>
</td>
</tr>
</table>
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0" >
<tr>
    <td class="head" align="center" width="8%" nowrap>Submited Date</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="2%" nowrap>No. Of Days</td>
    <td class="head" align="center" width="10%" nowrap>Status</td>
    <td class="head" align="center" width="10%"  nowrap>Withdraw</td>
    <td class="head" align="center" nowrap>Reason for Approving/Rejecting</td>
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
if($r6[1]=='HD')
{
	$staflavty[0]='Half Day'."<br>"."(".$r6[13]." - ".$r6[14].")";
	$fdate1=$hd_ee_daft_date;
	$tdate1='';
	$r6[5]='';
}
if($r6[1]=='EE')
{
	$staflavty[0]='Early Exit'."<br>"."(".$r6[13]." - ".$r6[14].")";
	$fdate1=$hd_ee_daft_date;
	$tdate1='';
	$r6[5]='';
}
if($r6[1]=='5')
{
	$staflavty[0]=$staflavty[0]."<br>"."(".$r6[13]." - ".$r6[14].")";
	$fdate1=$hd_ee_daft_date;
	$tdate1='';
	$r6[5]='';
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
    <td align="center"  class="<?=$trcolor?>"  title="<?=$r6[6]?>" width="10%"><?=$staflavty[0]?></td>
    <td align="center"  class="<?=$trcolor?>"  title="<?=$r6[6]?>" width="10%"><?=$fdate1?></td>
    <td align="center"  class="<?=$trcolor?>"  title="<?=$r6[6]?>" width="10%"><?=$tdate1?>
    <?php
        if($r6[15])
		{
		?>
        (<?=$r6[15]?>)
        <?php
		}
		?>
    </td>
    <td align="center"   class="<?=$trcolor?>"  title="<?=$r6[6]?>" width="5%"><?=$r6[5]?></td>
    <td align="center"  class="<?=$trcolor?>"   width="5%" title="<?=$r6[6]?>" nowrap>
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
		?>	
    <a href="javascript:void(0);" style="text-decoration:none" title="Withdraw" onClick ="OpenWind3('withdraw_reason.php?id=<?=$r6[0]?>', 'OpenWind3',400,200)">
    <img src="remove.png" width="25%"></a>
    <?php
		}
	}
	else
	{
			echo date("d-m-Y h:i a",strtotime($r6[20]));
    }
	?>
	</td>
    <td  class="<?=$trcolor?>"  align="justify" >&nbsp;<?=$reason_ofmanger?></td>
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
        <li class="currentBtn"><a href="leave_feb4.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
<?
	if($p==99){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=99">Withdraw</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=99" >Withdraw</a></li>
        <?
	}
?>
<?
	if($p==88){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=88">Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=88" >Default</a></li>
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
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center"  nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center" nowrap>Reason</td>
    <td class="head" align="center" width="10%" nowrap>Withdrawn</td>
    <td class="head" align="center" nowrap>Reason for<br>Approving/Rejecting</td>
  </tr>
  <?php
	$mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno,a.id,a.reject_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.status_approve,a.manager  from staff_leave a,staff_det c where a.status=1 and a.reject='1' and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);

		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
		
$daycount=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[10]' and type=$viewss1[0]'  and status='1' and reject='0' and status_reason!='2'"));
		
	$daycount_withdrawn=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'"));
		
$daysvat=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$viewss1[0]'"));

	$alltot=$daysvat[0]-$daycount[0]-$daycount_withdrawn[0];

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
if($viewss1[0]=='HD')
{
	$staflavty[0]='Half Day'."<br>"."(".$viewss1[11]." - ".$viewss1[12].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='EE')
{
	$staflavty[0]='Early Exit'."<br>"."(".$viewss1[11]." - ".$viewss1[12].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='5')
{
	$staflavty[0]=$staflavty[0]."<br>"."(".$viewss1[11]." - ".$viewss1[12].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}



?>
    <tr>
    <!-- <td align="center"><input type="checkbox" name="manager" value=""></td>-->
        <td align="center" width="10%"><?=$viewss1[7]?></td>
        <td width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
         <td align="center" width="10%"><?=$staflavty[0]?> 
         <?php
		if($viewss1[0]!='EE' && $viewss1[0]!='5' && $viewss1[0]!='HD')
		{
		?>
         (<?=$daysvat[0]?>)
         <?php
		}
		 ?>
         </td>
        <td align="center"><?=$alltot1?></td>
        <td align="center" width="10%"><?=$fdate21?></td>
        <td align="center" width="10%"><?=$tdate21?>
        <?php
        if($viewss1[14])
		{
		?>
        (<?=$viewss1[14]?>)
        <?php
		}
		?>
        </td>
        <td align="center" width="10%"><?=$viewss1[3]?></td>
        <td align="justify">&nbsp;<?=$viewss1[4]?></td>
        <td align="center" title="Withdrawn Status">
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
         <td align="justify">&nbsp;<?=$viewss1[9]?></td>
    </tr>
   <?	
	}
	}
	?>
</table>
</div>
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
        <li class="currentBtn"><a href="leave_feb4.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
<?
	if($p==99){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=99">Withdraw</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=99" >Withdraw</a></li>
        <?
	}
?>
<?
	if($p==88){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=88">Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=88" >Default</a></li>
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
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno,a.id,a.reject_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in,a.status_reason,a.status_with_staff,a.inserted_date,a.with_color,a.submit_with,a.approved,a.reject,a.updated_date,a.inserted_date,a.status_approve_manger  from staff_leave a,staff_det c where a.status=1 and  a.status_approve=2  and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
		
		$daycount=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[10]' and type=$viewss1[0]'  and status='1' and reject='0' and status_reason!='2'"));
		
	$daycount_withdrawn=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status='1' and approved='1' and status_reason!='2'"));
		
$daysvat=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$viewss1[0]'"));

	$alltot=$daysvat[0]-$daycount[0]-$daycount_withdrawn[0];
	
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
if($viewss1[0]=='HD')
{
	$staflavty[0]='Half Day'."<br>"."(".$viewss1[11]." - ".$viewss1[12].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='EE')
{
	$staflavty[0]='Early Exit'."<br>"."(".$viewss1[11]." - ".$viewss1[12].")";
	$fdate21=$hd_ee_daft_date;
	$tdate21='';
	$viewss1[3]='';
	$alltot1='';
}
if($viewss1[0]=='5')
{
	$staflavty[0]=$staflavty[0]."<br>"."(".$viewss1[11]." - ".$viewss1[12].")";
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
   <td class="<?=$trcolor?>" align='center'  width="5%"><input type='checkbox' name='cid_with[]' value='<?=$viewss1[8]?>' <?=$submited_leave?>></td>
        <td class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[7]?></td>
        <td class="<?=$trcolor?>" width="10%">&nbsp;<?=$viewss1[5]?>&nbsp;<?=$viewss1[6]?></td>
         <td class="<?=$trcolor?>" align="center" width="10%"><?=$staflavty[0]?> 
         <?php
		if($viewss1[0]!='EE' && $viewss1[0]!='5' && $viewss1[0]!='HD')
		{
		?>
         (<?=$daysvat[0]?>)
         <?php
		}
		 ?>
         </td>
        <td class="<?=$trcolor?>" align="center"><?=$alltot1?></td>
        <td class="<?=$trcolor?>" align="center" width="10%"><?=$fdate21?></td>
        <td class="<?=$trcolor?>" align="center" width="10%"><?=$tdate21?>
        <?php
        if($viewss1[14])
		{
		?>
        (<?=$viewss1[14]?>)
        <?php
		}
		?>
        </td>
        <td class="<?=$trcolor?>" align="center" width="10%"><?=$viewss1[3]?></td>
        <td class="<?=$trcolor?>" align="justify">&nbsp;<?=$viewss1[4]?></td>
         <td class="<?=$trcolor?>" align="center">&nbsp;<?=$leave_status?></td>
          <td class="<?=$trcolor?>" width="10%" align="center">
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
        <li class="currentBtn"><a href="leave_feb4.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=6" >Rejected Leave</a></li>
        <?
	}
?>
<?
	if($p==99){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=99">Withdraw</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=99" >Withdraw</a></li>
        <?
	}
?>
<?
	if($p==88){
		?>
        <li class="currentBtn"><a href="leave_feb4.php?tab=88">Default</a></li>
        <?
	}else{
		?>
        <li><a href="leave_feb4.php?tab=88" >Default</a></li>
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
	$viewss=execute("select a.id,a.slno,a.f_name,a.s_name,b.d_date,a.group_id,b.time_in,b.time_out,b.reason,b.id from staff_det a,staff_default b where b.staff_id=a.id and b.status=1 and b.staff_id='$mang_hr_rgts[0]'");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[d_date]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[0]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewss1[d_date]' and user='$viewss1[0]'  order by att_time asc limit 1"));

	$staffrfiout=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$viewss1[d_date]' and user='$viewss1[0]'  order by att_time desc limit 1"));	
	
	$staff_default_sts=fetcharray(execute("SELECT approved ,reject  FROM `staff_default_status` where staff_id_ins='$viewss1[9]'"));

?>
    <tr>
     <td align="center" width="10%" nowrap><input type='checkbox' name='default[]' value='<?=$viewss1[9]?>' ></td>
        <td align="center" width="10%" nowrap><?=$viewss1[slno]?></td>
        <td nowrap>&nbsp;<?=$viewss1[f_name]?>&nbsp;<?=$viewss1[s_name]?></td>
         <td align="center" width="10%" nowrap> 
         <b>Default</b>
         </td>
          <td align="center" width="10%" nowrap><?=$fdate21?></td>
           <td align="center" width="10%" nowrap>
           <font color="#0033FF">
        <?php
         if($viewss1[5]=='1')
        {
        echo $acintime1='7:30';
        }
        if($viewss1[5]=='2')
        {
        echo $acintime2='8:00';
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
		<?=$viewss1[6]?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
        <font color="#0033FF">
        <?php
        if($viewss1[5]=='1')
        {
        echo $acouttime1='16:10';
        }
        if($viewss1[5]=='2')
        {
        echo $acouttime2='17:00';
        }
        ?>
        </font>
        </td>
        <td align="center" width="10%" nowrap>
		<font color="#006600">
        <?php
		if($staffrfiout[0]!=$staffrfidlv[0])
		{
		$testout=1;
		echo $staffrfiout[0];
        }
		?>
        </font>
        </td>
        <td align="center" nowrap>
		<font color='#FF0000'>
		<?=$viewss1[7]?>
        </font>
        </td>
        <td align="center" nowrap>
        <?
	if($testin=='0' && $testout=='0')
	{
		$in_edit_time=$viewss1[6];
		$out_edit_time=$viewss1[7];
		
		$alltime1 = ($viewss1[6]);
		$alltime2 = ($viewss1[7]);
		$alltime3 = $alltime2 - $alltime1;
		$alltime1_sec=strtotime($alltime1);
		$alltime2_sec=strtotime($alltime2);
		$alltime3_sec=$alltime2_sec-$alltime1_sec;
		
			echo $alltime_final = gmdate ( 'H:i:s' , $alltime3_sec);
		
	}
	else
	{
		if($testin=='0')
		{
			$in_edit_time=$viewss1[6];
			$out_time=$staffrfiout[0];
		
			$intime1 = ($viewss1[6]);
			$intime2 = ($staffrfiout[0]);
			$intime3 = $intime2 - $intime1;
			$intime1_sec=strtotime($intime1);
			$intime2_sec=strtotime($intime2);
			$intime3_sec=$intime2_sec-$intime1_sec;
			
				echo $intime_final = gmdate ( 'H:i:s' , $intime3_sec);
			
		}
		
		if($testout=='0')
		{
			$in_time=$staffrfidlv[0];
			$out_edit_time=$viewss1[7];
			
			$outtime1 = ($staffrfidlv[0]);
			$outtime2 = ($viewss1[7]);
			$outtime3 = $outtime2 - $outtime1;
			
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
		 if($staff_default_sts[0]==1)
		 {
			 echo "<font color='#003300'><b>Approved</b></font>";
		 }
		 elseif($staff_default_sts[1]==1)
		 {
			  echo "<font color='#FF0000'><b>Rejected</b></font>";
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

