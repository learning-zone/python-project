<html>
<head>
<Script language="JavaScript">

	function RefreshMe(val)
	{
		document.frm.action="leave.php";
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
<?php
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
						
			$qry=execute("INSERT INTO staff_leave (user,avl, reason, manager,type, f_date, t_date, backup, notify, days, contact,acc_year,staff_id, status,in_time,out_time,hd_ee_da_date,half_time_in) VALUES ('$user','$avl','{$reason}', '$manager','$type','$fdate','$tdate','{$backup}', '$teacher', '$days','$contact','$acc_year','$staff_id_us[0]','1','$timein','$timeout','$hd_ee_date','$half_time_in')");
			$avl='';
			$reason='';
			$type='';
			$adate='';
			$backup='';
			$bdate='';
			$days='';
			$contact='';
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
			
        execute("update staff_leave set approved='1',user='$user',user_id='$staff_id_us[0]',approve_reason='{$cmnts}' where id='$manager[$m]'");	
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
        execute("update staff_leave set reject='1',approved='0',user='$user',user_id='$staff_id_us[0]',reject_reason='{$cmnts}'  where id='$manager[$c]'");
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
if($_POST['del'])
{

	$cid=$_POST['cid'];
	for($g=0;$g<sizeof($cid);$g++)
	{
        execute("update staff_leave set status='0',user='$user' where id='$cid[$g]'");	
	}
		?>
		<Script language="JavaScript">
		alert("Deleted Sucessfully");
		</Script>
        <?
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
        <li class="currentBtn"><a href="leave.php?tab=1" >Leave & Attendance</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=1" >Leave & Attendance</a></li>
        <?
	}
?>
<?

$mang_hrrt=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  if(mysql_num_rows($mang_hrrt)>0 || $staffrigtss[0]=='admin')
	{
		
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
        <li class="currentBtn"><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
        <?
	}else{
		?>
        <li><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
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
$staffclan=execute("SELECT * FROM `staff_calenders` WHERE status=1 and `staff_typ`=1 and ( fromdate between '$pfdate' and '$ptdate')");
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
$staffname=fetcharray(execute("select b.f_name,b.s_name,b.group_id from users a,staff_det b where   a.srid=b.id and a.username='$user'"));
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
    <a href="javascript:void(0);" onClick ="OpenWind2('staff.php?&pfdate=<?=$pfdate?>&ptdate=<?=$ptdate?>', 'OpenWind2',400,500)">Notify Others</a>
    <?
    }
    ?>
</td>
    </tr>
    <tr>
        <td style="font-size:13px" align="left" nowrap>Leave Type*</td>
        <td  nowrap width="10%"><select name="type" style="background-color: #FFFFCC; width:140px;" onChange="RefreshMe(0)">
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
<option value='HD' <?=$hdselect?>>Half Day</option>
<option value='EE' <?=$eeselect?>>Early Exit</option>
</select>
     </td>   
       <td nowrap>
       
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
		
				
$daycount=fetcharray(execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='$type'  and status=1 and reject='0'"));
		
		
$daysvat=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$vatype'"));

	$alltot=$daysvat[0]-$daycount[0];
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
	$daydisp=fetcharray(execute("select lv_ty from staff_leave_type where  id='$type'  and status=1"));
	if(!$daydisp[0])
	{
		if($type!=5 && $type!='HD' && $type!='EE' )
{
?>           
      Available&nbsp;<input type="text" name="daysval" value="<?=$alltot1?>"  readonly style="background-color: #FFFFCC;width:40px;" size="3">
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
        <select name="from_am_pm" style="width:80px">
         <option value=''>Time</option>
            <option value='1'>AM</option>
            <option value='2'>PM</option>
            </select>
            </td>
        <td style="font-size:13px" align="center" nowrap>
        <input type="text" readonly name="bdate" value="<?php echo $bdate?>" size="10" style="background-color: #FFFFCC;width:100px;" onFocus="RefreshMe(0)" placeholder="To Date"  required>&nbsp;
        <a href="javascript:showCal('Calendar2')"><img src="Calendar.gif" align="absmiddle"></a>
         <br>
             <select name="to_am_pm"  style="width:80px">
              <option value=''>Time</option>
            <option value='1'>AM</option>
            <option value='2'>PM</option>
            </select> 
        </td>
        <td style="font-size:13px" align="left" nowrap>No. Days</td>
        <?
        $staflavty1=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$type'"));
        
        if($totdays>$alltot1)
        {
        $daydisp=fetcharray(execute("select lv_ty from staff_leave_type where  id='$type'  and status=1"));
if(!$daydisp[0])
	{
 $totdays=0;
        $totdays=0;
        ?>
		<Script language="JavaScript">
		alert("Exceded the number of <?=$staflavty1[0]?>!");
		</Script>
        <?
        	$adate='';
		$bdate='';
        }
        }
        ?>
        <td align="left" nowrap><input type="number" name="days" value="<?=$totdays?>" size="3" style="background-color: #FFFFCC;width:40px;"   readonly></td>
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
        <li class="currentBtn"><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=6" >Rejected Leave</a></li>
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
<div style="max-height:300px; width:1000px; overflow-y:auto" align="center">
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
    <td class="head" align="center" width="10%" nowrap>Reason</td>
    <td class="head" align="center" nowrap>Reason for<br>Approving/Rejecting</td>
  </tr>
  <?php
  
	 $mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{

	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno,a.id,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in from staff_leave a,staff_det c where a.status=1 and a.approved='0' and a.reject='0' and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));

$daysvat=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$viewss1[0]'"));

$daycount=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[9]' and type='$viewss1[0]'  and status=1 and reject='0'"));

$alltot=$daysvat[0]-$daycount[0];
if($alltot>0)
{
$alltot1=$alltot;
}
if($alltot<=0)
{
$alltot1=0;
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


	?>
    <tr>
 <td align="center" width="3%"><input type="checkbox" name="manager[]" value="<?=$viewss1[8]?>"></td>
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
        if($viewss1[13])
		{
		?>
        (<?=$viewss1[13]?>)
        <?php
		}
		?>
        </td>
        <td align="center"width="10%"><?=$viewss1[3]?></td>
        <td width="10%">&nbsp;<?=$viewss1[4]?></td>
        <td width="10%">
         <textarea placeholder="Enter the reason for Approving/Rejecting" cols="20" rows="2" name="cmnts<?=$viewss1[8]?>"></textarea></td>
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
        <li class="currentBtn"><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=6" >Rejected Leave</a></li>
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
<div style="max-height:300px; width:1000px; overflow-y:auto" align="center">
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
    <td class="head" align="center" width="10%" nowrap>Reason</td>
    <td class="head" align="center" nowrap>Reason for<br>Approving/Rejecting</td>
  </tr>
  <?php
	 $mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno,a.id,a.approve_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in from staff_leave a,staff_det c where a.status=1 and a.approved='1' and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
	
	$daysvat=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$viewss1[0]'"));

$daycount=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status=1 and reject='0'"));

$alltot=$daysvat[0]-$daycount[0];
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
 <td align="center" width="3%"><input type="checkbox" name="manager[]" value="<?=$viewss1[8]?>"></td>
        <td align="center"  width="10%"><?=$viewss1[7]?></td>
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
        <td  width="10%">&nbsp;<?=$viewss1[4]?></td>
        <td width="10%">
         <textarea placeholder="Enter the reason for Rejecting" cols="20" rows="2" name="cmnts<?=stripslashes($viewss1[8])?>"><?=$viewss1[9]?></textarea></td>
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
$sql3=execute("select id,type,f_date,t_date,backup,days,reason,approved,reject,user_id,approve_reason,reject_reason,hd_ee_da_date,in_time,out_time,half_time_in from staff_leave where status=1 and staff_id='$staff_id_us[0]'  order by id desc");
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
<div style="max-height:200px; width:1000px; overflow-y:auto" align="center">
<table align='center'  width='90%' border="0" cellpadding="0" cellspacing="0">
<tr>
<td nowrap style="background:none;">
<?php
$cc=1;
//$leavtype=execute("select b.id,b.leave_name,a.days from leave_staff_day a,staff_leave_type b  where   b.status=1 and a.status=1 and a.staff_type='$staffname[2]' and a.leave_type=b.id group by b.id");
$leavtype=execute("select b.id,b.leave_name,a.days from leave_staff_day a,staff_leave_type b  where   b.status=1 and a.status=1 and a.staff_type='$staffname[2]' and a.leave_type=b.id and (b.id='1' or b.id='5') group by b.id");
while($leavty_vw=fetcharray($leavtype))
{

$daycount22=fetcharray(execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='$leavty_vw[0]'  and status=1 and reject='0'"));

$alltotii=$leavty_vw[2]-$daycount22[0];
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
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
<tr>
    <td class="head" align="center" width="5%" nowrap>Sel</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="2%" nowrap>No. Of Days</td>
    <td class="head" align="center" width="2%" nowrap>Status</td>
   <!-- <td class="head" align="center" width="10%" nowrap>Backup Resource</td>-->
    <td class="head" align="center" width="10%" nowrap>Reason for<br> Approving/Rejecting</td>
  </tr>  
 <?php
  while($r6=fetcharray($sql3))
	{
		$tfdate1=explode('-',$r6[2]);
		$fdate1=$tfdate1[2]."-".$tfdate1[1]."-".$tfdate1[0];
		$ttdate1=explode('-',$r6[3]);
		$tdate1=$ttdate1[2]."-".$ttdate1[1]."-".$ttdate1[0];
		$stafnameap=fetcharray(execute("select f_name,s_name from staff_det  where  active='YES' and id='$r6[9]'"));
		
		
		if($r6[7]==1)
		{
			$reason_ofmanger=$r6[10];
			$dischecks='disabled';
			$titlereason='Approved';
			$vatnames11='<font color="#006600">Approved by<br>'."$stafnameap[0]&nbsp;$stafnameap[1]".'</font>';
		}
		if($r6[8]==1)
		{
			$reason_ofmanger=$r6[11];
			$dischecks='disabled';
			$titlereason='Rejected';
			$vatnames11='<font color="#FF0000">Rejected by<br>'."$stafnameap[0]&nbsp;$stafnameap[1]".'</font>';
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
 ?>
  <tr>
  <td align='center'  width="5%"><input type='checkbox' name='cid[]' value='<?=$r6[0]?>' ></td>
    <td align="center" title="<?=$r6[6]?>" width="10%"><?=$staflavty[0]?></td>
    <td align="center" title="<?=$r6[6]?>" width="10%"><?=$fdate1?></td>
    <td align="center" title="<?=$r6[6]?>" width="10%"><?=$tdate1?>
    <?php
        if($r6[15])
		{
		?>
        (<?=$r6[15]?>)
        <?php
		}
		?>
    </td>
    <td align="center" title="<?=$r6[6]?>" width="5%"><?=$r6[5]?></td>
    <td align="center"  width="5%">
	<?php
	if($vatnames11)
	{
	echo "<div title='$titlereason'>";
	?>
	<a href="javascript:void(0);" title="Modify" onClick ="OpenWind3('update1.php?id=<?=$r6[0]?>', 'OpenWind3',400,400)"><?=$vatnames11?></a>
	<?php
	echo "</div>";
	}
	else
	{
	
if($r6[1]=='5' || $r6[1]=='HD' || $r6[1]=='EE')
{
	?>
    <?
}
else
{
?>
    <a href="javascript:void(0);" title="Modify" onClick ="OpenWind3('update1.php?id=<?=$r6[0]?>', 'OpenWind3',400,400)">Submitted</a>
    	<?
}
	}
	$vatnames11='';
	$dischecks='';
	?>
    </td>
   <!-- <td align="center" title="<?=$r6[6]?>" width="10%"><?=$r6[4]?></td>-->
    <td align="justify" >&nbsp;<?=$reason_ofmanger?></td>
  </tr>
  <?
  $reason_ofmanger='';
	}

?>
</table>
</div>
<br>
<div align='center' >
  <input type="submit" name="del" value="Withdraw"  class='bgbutton'>
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
        <li class="currentBtn"><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=4" >Submitted Leave</a></li>
        <?
	}
?>
<?
	if($p==5){
		?>
        <li class="currentBtn"><a href="leave.php?tab=5" >Approved Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=5">Approved Leave</a></li>
        <?
	}
?>
<?
	if($p==6){
		?>
        <li class="currentBtn"><a href="leave.php?tab=6">Rejected Leave</a></li>
        <?
	}else{
		?>
        <li><a href="leave.php?tab=6" >Rejected Leave</a></li>
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
<div style="max-height:300px; width:1000px; overflow-y:auto" align="center">
<table align='center'  width='90%' border="1" cellpadding="0" cellspacing="0">
<tr>
    <td class="head" align="center" width="10%" nowrap>Staff Code</td>
    <td class="head" align="center" width="10%" nowrap>Staff Name</td>
    <td class="head" align="center" width="10%" nowrap>Leave Type</td>
    <td class="head" align="center" width="5%" nowrap>Available<br>Leave</td>
    <td class="head" align="center" width="10%" nowrap>From Date</td>
    <td class="head" align="center" width="10%" nowrap>To Date</td>
    <td class="head" align="center" width="10%" nowrap>Total Days</td>
    <td class="head" align="center" width="10%" nowrap>Reason</td>
    <td class="head" align="center" nowrap>Reason for<br>Approving/Rejecting</td>
  </tr>
  <?php
	$mang_hr=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
  while($mang_hr_rgts=fetcharray($mang_hr))
	{
	$viewss=execute("select a.type,a.f_date,a.t_date,a.days,a.reason,c.f_name,c.s_name,c.slno,a.id,a.reject_reason,c.id,a.in_time,a.out_time,a.hd_ee_da_date,a.half_time_in  from staff_leave a,staff_det c where a.status=1 and a.reject='1' and c.id='$mang_hr_rgts[0]' and c.id=a.staff_id");
	while($viewss1=fetcharray($viewss))
	{
		$tfdate21=explode('-',$viewss1[1]);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('-',$viewss1[2]);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$viewss1[0]'"));
		
		$daysvat=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$viewss1[0]'"));

$daycount=fetcharray(execute("select days from staff_leave where staff_id='$viewss1[10]' and type='$viewss1[0]'  and status=1 and reject='0'"));

$alltot=$daysvat[0]-$daycount[0];
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
        <td width="10%">&nbsp;<?=$viewss1[4]?></td>
         <td width="10%">&nbsp;<?=$viewss1[9]?></td>
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

