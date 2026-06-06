<?php
session_start();
include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$a_year=$_SESSION['AcademicYear'];
	
	if(!$_POST and !$_REQUEST)
	{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
	}
	elseif(!$_POST and $_REQUEST)
	{
	$timein=$_REQUEST['timein'];
	$timeout=$_REQUEST['timeout'];
	$ex_timein=$_REQUEST['ex_timein'];
	$ex_timeout=$_REQUEST['ex_timeout'];
	$date_type=$_REQUEST['date_type'];
	
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$stu_id=$_REQUEST['stu_id'];
	$action=$_REQUEST['action'];
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$update=$_REQUEST['update'];
	$save=$_REQUEST['save'];
	$subid=$_REQUEST['subid'];
	$rcot=$_REQUEST['rcot'];
	$descr=$_REQUEST['descr'];
	$date3=$_REQUEST['date3'];
	$adate=$_REQUEST['adate'];
	$bdate=$_REQUEST['bdate'];
	$ename=$_REQUEST['ename'];
	$type=$_REQUEST['type'];
	$leave_det=$_REQUEST['leave_det'];	
	}
	else
	{
	$date_type=$_POST['date_type'];
	
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$update=$_POST['update'];
	$save=$_POST['save'];
	$subid=$_POST['subid'];
	$rcot=$_POST['rcot'];
	$descr=$_POST['descr'];
	$date3=$_POST['date3'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$ename=$_POST['ename'];
	$type=$_POST['type'];
	$timein=$_POST['timein'];
	$timeout=$_POST['timeout'];
	$dts=$_POST['dts'];
	$ex_timein=$_POST['ex_timein'];
	$ex_timeout=$_POST['ex_timeout'];
	$leave_det=$_POST['leave_det'];
	}
$date1 = date("d/m/Y");
?>
<HTML>
<head>
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
</HEAD>

<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="staff_time.php";
	document.frm.submit();
}


</SCRIPT>
<script LANGUAGE="JavaScript">

function reload(str)
{
	
var url="leave_staff_time.php";
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
<BODY>

<?php
$save=$_REQUEST['save'];
$delete=$_POST['delete'];
if(($delete))
{
	execute("update staff_time set status=0,username='$user' where id='$editid' ");
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Deleted successfully");
	</script>
	<?php
}


if($update)
{
	
	$editid=$_POST['editid'];
	$enter_date=date('Y-m-d');
	$stf_day=explode('/',$adate);
	
	if($stf_day[2])
	{
	$adate=$stf_day[2]."-".$stf_day[1]."-".$stf_day[0];
	}
	
	if($timein!='' && $timeout!='' && $ex_timein!='' && $ex_timeout!='')
	{
execute("update staff_time set intime='$timein' ,outtime='$timeout',ex_intime='$ex_timein',ex_outtime='$ex_timeout',title='{$ename}',username='$user',enter_date='$enter_date',staff_date='$adate',date_type='$date_type',leave_det='$leave_det' where id='$editid' ");
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Updated successfully");
	</script>
	<?php
	}
	else
	{
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("In and Out Time Not Null");
		</script>
		<?php	
	}
	
}
?>

<!----timecode---->

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/datetimepicker.css" rel="stylesheet" media="screen">

<!---time_end--->

<link rel="stylesheet" type="text/css" href="css/tab.css" />
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<li><a href="leavesetup.php?tab=1" >Leave Setup</a></li>
<li><a href="leavestaffsetup.php?tab=2" >Staff Leave Detail</a></li>
<li><a href="staff_calnd.php?tab=3" >Staff Calendar</a></li>
<li class="currentBtn"><a href="staff_time.php?tab=4" >Staff Timing</a></li>
<li><a href="att_point.php?tab=5" >Attendance Point</a></li>
<li><a href="leave_paid_count.php?tab=7" >Paid Leave Update</a>
</li>
<li><a href="leave_acc.php?tab=8">Staff Year Setup</a></li>

</ul>
</div>
</div>

<?
if($stu_id!='')
{
	
?>
<FORM NAME='frm' METHOD='POST'>
    <input type="hidden" name='stu_id' value="<?=$stu_id?>">
    <table align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
    <tr>
    	<td class="head" align="center" colspan="2">Modify Timing</td>
    </tr>
    <tr >
    	<td nowrap>&nbsp;&nbsp;Staff Type</td>
    <td >&nbsp;&nbsp;
    <?php
    
    $temsql3=execute("select * from staff_time where  id=$stu_id");
    while($r=fetcharray($temsql3))
    {
    $editid=$r['id'];
    $classid=$r['staff_type'];
    $ename=$r['title'];
    $time_in=$r['intime'];
    $ex_time_in=$r['ex_intime'];
    $time_out=$r['outtime'];
	$ex_time_out=$r['ex_outtime'];
	$datetypes=$r['date_type'];
	$adate=$r['staff_date'];
	$leave_detname=$r['leave_det']; 
	
	$tfdate=explode('-',$adate);
	$adate=$tfdate[2]."/".$tfdate[1]."/".$tfdate[0];
		 
   /* $timeinexp=explode("-",$time_in);
    $timeoutexp=explode("-",$time_out);*/
    }        
    
    $semname =fetcharray(execute("select id,name from staff_group where status=1 and id='$classid'"));
    
    ?>
    <?=$semname[1]?>
    </td>
    </tr>
    <tr>
    	<td nowrap>&nbsp;&nbsp;Leave Detail</td>
        <td nowrap>&nbsp;
			<?php
            $lv_sel_date1='';
            $lv_sel_date2='';
			$lv_sel_date3='';
            if($leave_detname==1)
            {
            $lv_sel_date1='selected';
            }
            if($leave_detname==2)
            {
            $lv_sel_date2='selected';
            }
			if($leave_detname==3)
            {
            $lv_sel_date3='selected';
            }
            ?>
            <select name="leave_det"  required>
            <option value='1' <?=$lv_sel_date1?>>Full Day</option>
           <!--<option value='2' <?=$lv_sel_date2?>>Half Day</option>
             <option value='3' <?=$lv_sel_date3?>>Quarter Day</option>-->
            </select> 
        </td>
    </tr>
   	 <input type="hidden" name="editid" value="<?=$editid?>"/>
    <tr>
    <td nowrap align="center">In Time
    <div class="control-group">
    <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="timein" data-link-format="hh:ii">
    <input type="text" name="timein" value="<?=$time_in?>" style="width:60px; height:30px" readonly>
    <span class="add-on"><i class="icon-remove"></i></span>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    <input type="hidden"   id="timein"/>
    </div>
    </td>
    <td nowrap align="center">Expected IN Time
    <div class="control-group">
    <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="ex_timein" data-link-format="hh:ii">
    <input type="text" name="ex_timein" value="<?=$ex_time_in?>" style="width:60px; height:30px" readonly>
    <span class="add-on"><i class="icon-remove"></i></span>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    <input type="hidden"   id="ex_timein"/>
    </div>   
    </td>
    </tr>
    <tr>
    <td nowrap align="center">Out Time
    <div class="control-group">
    <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="timeout" data-link-format="hh:ii">
    <input type="text" name="timeout" value="<?=$time_out?>" style="width:60px; height:30px" readonly>
    <span class="add-on"><i class="icon-remove"></i></span>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    <input type="hidden" id="timeout" />
    </div>
    </td>
    <td nowrap align="center">Expected OUT Time
    <div class="control-group">
    <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="ex_timeout" data-link-format="hh:ii">
    <input type="text" name="ex_timeout" value="<?=$ex_time_out?>" style="width:60px; height:30px" readonly>
    <span class="add-on"><i class="icon-remove"></i></span>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    <input type="hidden" id="ex_timeout" />
    </div>
    </td>
    </tr>
    <tr>
    <td nowrap>&nbsp;&nbsp;Date</td>
    <td nowrap>
    <?php
	$sel_date1='';
	$sel_date2='';
	if($datetypes==1)
	{
		$sel_date1='selected';
	}
	if($datetypes==2)
	{
		$sel_date2='selected';
	}
	?>
    <select name="date_type" onChange="reload(this.value)">
    <option value='1' <?=$sel_date1?>>Default</option>
    <option value='2' <?=$sel_date2?>>Date</option>
    </select>
    <?php
	if($datetypes==2)
	{
	?>
      <br><input type="text" name="adate" value="<?php echo $adate?>" size="10" style="height:30px" placeholder="dd/mm/yyyy" readonly> &nbsp;
        <a href="javascript:showCal('Calendar1')"><img src="Calendar.gif" align="absmiddle"></a>
     <?php
	}
	else
	{
	 ?>
    <div id="txtHint9" class="inline"></div>
    <?php
	}
	?>
    </td>
    </tr>
    <tr>
    <td nowrap>&nbsp;&nbsp;Title</td>
    <td nowrap>&nbsp;
    <input type="text" name="ename" id="ename1" value="<?php echo $ename; ?>" style="height:30px">
    &nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    </table>
<br>
<div align="center">
<input class="bgbutton" type="submit" name="update" value="Update">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="bgbutton" type="submit" name="delete" value="Delete">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="staff_time.php" class='topictitle1'><input type="button" name="Add New" value="Add New" class="bgbutton">
</a></div>
</FORM>
	<?php
}

if($_POST['save'])
{
	$timr=$penal_hr."-".$penal_sec."-".$ams;
	//$timr1=$penal_hr1."-".$penal_sec1."-".$ams1;
	//$timr2=$penal_hr2."-".$penal_sec2."-".$ams2;
	$timr3=$penal_hr3."-".$penal_sec3."-".$ams3;
	$ti2=$_POST['penal_hr2'];
	$tim2=$_POST['penal_sec2'];
	$tims2=$_POST['ams2'];
	$time_in=$ti2."-".$tim2."-".$tims2;
	$ti3=$_POST['penal_hr3'];
	$tim3=$_POST['penal_sec3'];
	$tims3=$_POST['ams3'];
	$time_out=$ti3."-".$tim3."-".$tims3;
	
	$enter_date=date('Y-m-d');
	
	$tfdate=explode('/',$adate);
	if($tfdate[2])
	{
	$adate_vals=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	}
	
	if($timein!='' && $timeout!='' && $ex_timein!='' && $ex_timeout!='')
	{
		execute("insert into staff_time (staff_type,username,intime,outtime,ex_intime,ex_outtime,title,status,acc_year,enter_date,staff_date,date_type,leave_det) values('$sem','$user','$timein','$timeout','$ex_timein','$ex_timeout','{$ename}', 1,'$a_year','$enter_date','$adate_vals','$date_type','$leave_det')");
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Added successfully");
		</script>
		<?php
	}
	else
	{
	?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("In and Out Time Not Null");
		</script>
		<?php	
	}
}
if($action=='' and $stu_id=='') 
{
	?>
    
<FORM NAME='frm' METHOD='POST' >   
<table align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
    <tr>
    	<td colspan="2" class="head" align="center">Declare Timing</td>
    </tr>
    <tr>
    	<td nowrap>&nbsp;&nbsp;Staff Type</td>
        <td nowrap>&nbsp;
            <select name="sem" onChange="go()"  required>
            <option value=''>-- Select --</option>
            <?php
            $sql21=execute("select id,name from staff_group where status=1");
            while($r2=fetcharray($sql21))
            {
            if($sem==$r2[0])
            echo "<option value='$r2[0]' selected>$r2[1]</option>";
            else
            echo "<option value='$r2[0]'>$r2[1]</option>";
            }
            
            ?>
            </select> 
        </td>
    </tr>
    <tr>
    	<td nowrap>&nbsp;&nbsp;Leave Detail</td>
        <td nowrap>&nbsp;
            <select name="leave_det"  required>
            <option value='1'>Full Day</option>
           <!-- <option value='2'>Half Day</option>
            <option value='3'>Quarter Day</option>-->
            </select> 
        </td>
    </tr>
    <tr>
    	<td nowrap align="center">In Time
        <div class="control-group">
        <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="timein" data-link-format="hh:ii">
        <input type="text" name="timein" style="width:60px; height:30px" readonly>
        <span class="add-on"><i class="icon-remove"></i></span>
        <span class="add-on"><i class="icon-th"></i></span>
        </div>
        <input type="hidden"   id="timein"/>
        </div>
        </td>
        <td nowrap align="center">Expected IN Time
        <div class="control-group">
        <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="ex_timein" data-link-format="hh:ii">
        <input type="text" name="ex_timein" style="width:60px; height:30px" readonly  >
        <span class="add-on"><i class="icon-remove"></i></span>
        <span class="add-on"><i class="icon-th"></i></span>
        </div>
        <input type="hidden"   id="ex_timein"/>
        </div>
        </td>
    </tr>
    <tr>
    <td nowrap align="center">Out Time
    <div class="control-group">
    <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="timeout" data-link-format="hh:ii">
    <input type="text" name="timeout" style="width:60px; height:30px" readonly  >
    <span class="add-on"><i class="icon-remove"></i></span>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    <input type="hidden" id="timeout" />
    </div>
    </td>
    <td nowrap align="center">Expected OUT Time
    <div class="control-group">
    <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="ex_timeout" data-link-format="hh:ii">
    <input type="text" name="ex_timeout" style="width:60px; height:30px" readonly  >
    <span class="add-on"><i class="icon-remove"></i></span>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    <input type="hidden" id="ex_timeout" />
    </div>
    </td>
    </tr>
<tr>
<td nowrap>&nbsp;&nbsp;Date</td>
<td nowrap>
<select name="date_type" onChange="reload(this.value)">
<option value='1'>Default</option>
<option value='2'>Change</option>
</select>
<div id="txtHint9" class="inline"></div>
</td>
</tr>
<tr>
<td nowrap>&nbsp;&nbsp;Title</td>
<td >
<input type="text" name="ename" id="ename" value="" style="height:30px" >&nbsp;&nbsp;&nbsp;&nbsp;
</td></tr>
</table>
<br>
<div align="center">
<input type="submit" name="save" value="Save"  class='bgbutton'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>

</FORM>
	<?php
}
if($sem)
{
	$alltypess="and staff_type='$sem'";
}
else
{
	$alltypess="";
}

$temsql3=execute("select * from staff_time where status='1' $alltypess");
if(mysql_num_rows($temsql3)>=1)
{	
?>
<br>
    <table align='center' width="70%" border="1" cellspacing="0" cellpadding="2">
    <tr>
    	<td colspan="10" class="head" align="center">Modify Timing</td>
    </tr>
    <tr>
        <td width="10%" align="center" class="rowpic" nowrap>Sl.No.</td>
        <td align="center" class="rowpic" nowrap>Title</td>
        <td align="center" class="rowpic" nowrap>Staff Type</td>
        <td align="center" class="rowpic" nowrap>Leave Detail</td>
        <td align="center" class="rowpic" nowrap>Expected IN Time</td>
        <td align="center" class="rowpic" nowrap>In Time</td>
        <td align="center" class="rowpic" nowrap>Expected OUT Time</td>
        <td align="center" class="rowpic" nowrap>Out Time</td>
     <td align="center" class="rowpic" nowrap>Date</td>
        <td align="center" class="rowpic" nowrap>Action</td>
    </tr>
  <?
	$inc=1;
	
	while($r=fetcharray($temsql3))
	{
		$yrnamess =fetcharray(execute("select id,name from staff_group where status=1 and id='$r[staff_type]'"));
		if($r[date_type]==1)
		{
			$vw_staff_date='Default';
			$fntcolor='#009900';
		}
		else
		{
			$vw_staff_date2=$r[staff_date];
			$vw_staff_date=date('d-m-Y', strtotime($vw_staff_date2));
			$fntcolor='#FF0000';
		}
		if($r[leave_det]==1)
		{
			$leave_det_name='Full Day';
		}
		if($r[leave_det]==2)
		{
			$leave_det_name='Half Day';
		}
		if($r[leave_det]==3)
		{
			$leave_det_name='Quarter Day';
		}
		echo "
		<tr>
			<td align='center' nowrap>$inc</td>
			<td align='center' nowrap>$r[title]</td>
			<td align='center' nowrap>$yrnamess[1]</td>
			<td align='center' nowrap>$leave_det_name</td>
			<td align='center' nowrap>$r[intime]</td>
			<td align='center' nowrap>$r[ex_intime]</td>
			<td align='center' nowrap>$r[outtime]</td>
			<td align='center' nowrap>$r[ex_outtime]</td>
			<td align='center' nowrap><b><font color='$fntcolor'>$vw_staff_date</font></b></td>
			<td align='center' nowrap><a href='staff_time.php?stu_id=$r[id]'>Modify</a></td>
		</tr>";
  $inc++;
	}
}
	?>
	</table>
    <br>
    <br>
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

</BODY>
</HTML>