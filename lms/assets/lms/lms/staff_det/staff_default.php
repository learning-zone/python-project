<html>
<?php
session_start();
include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$a_year=$_SESSION['AcademicYear'];

$time_in=$_POST['time_in'];
$time_out=$_POST['time_out'];
$reason=$_POST['reason'];

$mon=$_REQUEST['mon'];
$yer=$_REQUEST['yer'];
$day=$_REQUEST['day'];

$date1 = date("Y-m-d");
$sysdate="$yer-$mon-$day";	
$readate="$day-$mon-$yer";

$staff_id=fetcharray(execute("SELECT srid FROM users where username='$user'"));
$staff_id=$staff_id[0];
?>
<?php
if($_POST['save'])
{
	$Sql66=execute(" select id from staff_default where d_date='$sysdate' and staff_id='$staff_id' and status=1");
	if(mysql_num_rows($Sql66)>0)
	{
		$reason=mysql_real_escape_string("$reason");
	$sql33="update staff_default set reason='$reason',user='$user',time_in='$time_in',time_out='$time_out' where d_date='$sysdate' and staff_id='$staff_id' and status=1";
	execute($sql33);
	}
	else
	{
		$reason=mysql_real_escape_string("$reason");
	execute("INSERT INTO staff_default (staff_id, user, reason, d_date, time_in,time_out,ins_date,status) VALUES ( '$staff_id', '$user', '$reason','$sysdate', '$time_in', '$time_out','$date1','1')");
	}
}
?>
<title>Update Attendance</title>
<!----timecode---->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/datetimepicker.css" rel="stylesheet" media="screen">

<!---time_end--->
<br>

<body>
<form name="frm"  method="post">
<?php
$allvalues=fetcharray(execute(" select * from staff_default where d_date='$sysdate' and staff_id='$staff_id' and status=1"));

$reason=$allvalues['reason'];
$time_in=$allvalues['time_in'];
$time_out=$allvalues['time_out'];
?>
    <table  class='forumline' align='center' width="50%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="5" class="head" align="center">Update Attendance</td>
	</tr>
    <tr>
    <td align="center" colspan="2">&nbsp;<b>Date&nbsp;-&nbsp;<?=$readate?></b></td>
    </tr>
    <tr>
        <td align="center">In Time<br />
        <div class="control-group">
        <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="time_in" data-link-format="hh:ii">
        <input type="text" name="time_in" value="<?=$time_in?>" style="width:60px; height:30px" readonly required>
        <span class="add-on"><i class="icon-remove"></i></span>
        <span class="add-on"><i class="icon-th"></i></span>
        </div>
        </div>
        </td>
    
    <td align="center">Out Time<br />
    <div class="control-group">
    <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="time_out" data-link-format="hh:ii">
    <input type="text" name="time_out" value="<?=$time_out?>" style="width:60px; height:30px" readonly required>
    <span class="add-on"><i class="icon-remove"></i></span>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
    </td>
    </tr>
    <tr>
    <td align="center" colspan="2">Reason<br /><textarea rows="3" cols="30" name='reason'  style="background-color: #FFFFCC" placeholder="Reason*" required ><?=stripslashes($reason)?></textarea></td>
    </tr>
</table>
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
<br>
<div align='center' >
  <input type="submit" name="save" value="Save"  class='bgbutton'>
  </div>
</form>
<!----timecode end---->
</BODY>
</HTML>