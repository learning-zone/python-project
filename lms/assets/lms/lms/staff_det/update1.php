<html>
<title>Update Leave Detail</title>
 <?php
	session_start();
	include("../db.php");
	//print_r($_POST);
	$id=$_REQUEST['id'];
	
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$type=$_POST['type'];
	$reason=$_POST['reason'];
	$backup=$_POST['backup'];
	$days=$_POST['days'];
	$contact=$_POST['contact'];
	$half_time_in=$_POST['half_time_in']
	?>
<head>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
<!----timecode---->

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/datetimepicker.css" rel="stylesheet" media="screen">

<!---time_end--->
</head>
<?php
	if($_POST['subn'])
	{
		
		$tfdate21=explode('/',$adate);
		$fdate21=$tfdate21[2]."-".$tfdate21[1]."-".$tfdate21[0];
		$ttdate21=explode('/',$bdate);
		$tdate21=$ttdate21[2]."-".$ttdate21[1]."-".$ttdate21[0];
		
		//no of days	
		$date_entered_email_sec=strtotime($tdate21);
		$date_modified_email_sec=strtotime($fdate21); 
		$turn_around_time_sec = $date_entered_email_sec - $date_modified_email_sec;
		
		$daysTotal = ceil((date("z") - date("w")) / 7);
		$daysTotal = ceil((date("j") - date("w")) / 7); 
		$tot_day = floor($turn_around_time_sec / 86400)+1;
		
		//no of sundays
			$date1 = $fdate21;
			$date2 = $tdate21;
		
			for ($i = 0; $i < ((strtotime($date2) - strtotime($date1)) / 86400); $i++)
			{
				if(date('l',strtotime($date1) + ($i * 86400)) == 'Sunday')
				{
					$num_sundays++;
				}
			}
		
		$totdays1=$tot_day-$num_sundays;
		$staffclan=execute("SELECT * FROM `staff_calenders` WHERE `staff_typ`=1 and ( fromdate between '$fdate21' and '$tdate21')");
while($staffclands=fetcharray($staffclan))
{
	$staffclands_count++;
}
$totdays=$totdays1-$staffclands_count;

		
		execute("UPDATE `staff_leave` SET  `reason` = '$reason',`backup` = '$backup',`days` ='$totdays',`contact` = '$contact',`f_date` = '$fdate21',`t_date` = '$tdate21',`half_time_in`='$half_time_in' WHERE `id` ='$id'");	
	?>
		<Script language="JavaScript">
        alert("Updated Sucessfully!");
		window.opener.location.href='leave.php?tab=1';
		window.close();
        </Script>
	<?
	}
?>
<body>
<form Name="frm"  method="post">
<input type="hidden" name="tab" value="<?=$p?>"/>
<input type="hidden" name="avl" value="<?=$avl?>"/>
<input type="hidden" name="contact" value="<?=$contact?>"/>
<input type="hidden" name="type" value="<?=$type?>"/>
<input type="hidden" name="reason" value="<?=$reason?>"/>
<input type="hidden" name="backup" value="<?=$backup?>"/>
<input type="hidden" name="days" value="<?=$totdays?>"/>


<br>  
<fieldset style="height:auto">   
<legend><font size="+1"><b>Applied Leave</b></font></legend>
<table  align='center' border="0" width="100%" cellpadding="3" cellspacing="0">
	<?php
	$r5=fetcharray(execute("select id,type,f_date,t_date,backup,days,reason,contact,half_time_in from staff_leave where  status=1 and id='$id'"));
	$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$r5[1]'"));
		$tfdate1=explode('-',$r5[2]);
		$fdate1=$tfdate1[2]."/".$tfdate1[1]."/".$tfdate1[0];
		$ttdate1=explode('-',$r5[3]);
		$tdate1=$ttdate1[2]."/".$ttdate1[1]."/".$ttdate1[0];
		$half_time_in=$r5[8];
	?>
	<tr>
	<td nowrap>&nbsp;Leave Type*</td>
	<td nowrap><?=$staflavty[0]?>
    </td>
    </tr>
    <tr>
	<td nowrap>&nbsp;Leave Duration*</td>
	<td nowrap> <input type="text" readonly name="adate" value="<?=$fdate1?>" size="10" style="background-color: #FFFFCC; width:100px"  required> &nbsp;
     <a href="javascript:showCal('Calendar1')"><img src="Calendar.gif" align="absmiddle"></a></td>
    </tr>
    <tr>
	<td nowrap>&nbsp;To Date*</td>
	<td nowrap> <input type="text" readonly name="bdate" value="<?=$tdate1?>" size="10" style="background-color: #FFFFCC;width:100px"   required> &nbsp;
     <a href="javascript:showCal('Calendar2')"><img src="Calendar.gif" align="absmiddle"></a></td>
     </tr>
     <tr>
    <td nowrap>&nbsp;In Time</td>
    <td nowrap>
        <div class="control-group">
        <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="half_time_in" data-link-format="hh:ii">
        <input type="text" name="half_time_in" value="<?=$half_time_in?>" style="width:60px; height:30px" readonly>
        <span class="add-on"><i class="icon-remove"></i></span>
        <span class="add-on"><i class="icon-th"></i></span>
        </div>
        </div>
        </td>
    </tr>
    <!--<tr>
	<td>&nbsp;No. Of Days</td>
	<td><input type="text" name="days" value="<?=$r5[5]?>"  style="background-color: #FFFFCC" readonly></td>
    </tr>-->
      <tr>
	<td nowrap>&nbsp;Reason*</td>
	<td nowrap><input type="text" name="reason" value="<?=$r5[6]?>"  style="background-color: #FFFFCC"></td>
   <!-- <tr>
    <td nowrap  align="left">&nbsp;Backup Resource</td>
        <td align="left" nowrap><input type="text" name="backup" value="<?=$r5[4]?>" style="background-color: #FFFFCC"> </td>
        </tr>-->
        <tr>
        <td align="left" nowrap>&nbsp;Alt Contact #</td>
        <td align="left" nowrap><input type="text" name="contact" value="<?=$r5[7]?>" size="20" style="background-color: #FFFFCC" > </td>
    </tr>
</table>
</fieldset>
<br>
<div align='center'><input type='submit' name='subn' value='Update' class='bgbutton'></div>
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
</form>

</BODY>
</HTML>
