<?php
session_start();
include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$a_year=$_SESSION['AcademicYear'];

$time_in=$_POST['time_in'];
$time_out=$_POST['time_out'];
$reason=$_POST['reason'];

//print_r($_POST);

if($_REQUEST)
{
	$mon=$_REQUEST['mon'];
	$yer=$_REQUEST['yer'];
	$day=$_REQUEST['day'];
}
if($_POST)
{
	
	$mon=$_POST['mon'];
	$yer=$_POST['yer'];
	$day=$_POST['day'];
}

	$date1 = date("d/m/Y");
	$sysdate="$yer-$mon-$day";	
	$adate="$day/$mon/$yer";

		$stafftype=fetcharray(execute("select b.group_id,a.srid,b.f_name,b.s_name,b.slno from users a,staff_det b where   a.srid=b.id and a.username='$user'"));

$staff_id=$stafftype[1];

if($_POST['save'])
{
	$Sql66=execute(" select id from staff_default where d_date='$sysdate' and staff_id='$staff_id' and status=1");
	if(mysql_num_rows($Sql66)>0)
	{
		$reason=mysql_real_escape_string("$reason");
	$sql33="update staff_default set reason='$reason',user='$user',ins_date='$date1',time_in='$time_in',time_out='$time_out' where d_date='$sysdate' and staff_id='$staff_id' and status=1";
	execute($sql33);
	}
	else
	{
		$reason=mysql_real_escape_string("$reason");
		
	execute("INSERT INTO staff_default (staff_id, user, reason, d_date, time_in,time_out,ins_date,status) VALUES ( '$staff_id', '$user', '$reason','$sysdate', '$time_in', '$time_out','$date1','1')");
	}
}
?>
<html>
<title>View Staff Calendar</title>
<!----timecode---->
<head>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/datetimepicker.css" rel="stylesheet" media="screen">

<style>

.icon-arrow-right {
   
 display:none;
}
.icon-arrow-left {
    
 display:none;
}
.datetimepicker th.switch {
   color:#FFF;
   
}
</style>


</head>
<body>

<!---time_end--->

	
<form name="frm"  method="post">
<input type="hidden" name="mon" value="<?=$mon?>"/>
<input type="hidden" name="yer" value="<?=$yer?>"/>
<input type="hidden" name="day" value="<?=$day?>"/>
<?php

$vwadtae=explode("/",$adate);

$vwadtae[0];

$vwadtae[1];

$vwadtae[2];

$vwadtae1=$vwadtae[2]."-".$vwadtae[1]."-".$vwadtae[0];

$temsql3=execute("select * from staff_calenders where status='1' and fromdate='$vwadtae1' and staff_typ='$stafftype[0]'");

if(mysql_num_rows($temsql3)>=1)

{	

?>

<br>

    <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">

  <tr>

	<td colspan="5" class="head" align="center">Calender Details</td>

	</tr>

  <tr>

    <td width="10%" align="center" class="rowpic">Sl.No.</td>

    <td align="center" class="rowpic">Title</td>

    <td align="center" class="rowpic">description</td>

    <td align="center" class="rowpic">Staff Type</td>

    <td align="center" class="rowpic">Date</td>

  </tr>

  <?

	$inc=1;

	

	while($r=fetcharray($temsql3))

	{

		$yrnamess =fetcharray(execute("select id,name from staff_group where status=1 and id='$r[staff_typ]'"));

		echo "

		<tr height='25'>

			<td align='center'>$inc</td>

			<td nowrap>&nbsp;&nbsp;

			$r[title]</td>

			<td align='left'>&nbsp;

			$r[description]</td>

			<td align='center' nowrap>$yrnamess[1]

			</td>

			<td align='center' nowrap>";

			echo date("d-m-Y",strtotime($r['fromdate']));

			echo "</td>

			</tr>";

  $inc++;

	}

}

?>

	</table>

<?php



$leavdet=execute("select * from staff_leave where  status='1' and staff_id='$stafftype[1]' and  ('$vwadtae1'  between f_date and t_date)");

if(mysql_num_rows($leavdet)>=1)

{	

?>

    <br>

     <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">

  <tr>

	<td colspan="8" class="head" align="center">Leave Details</td>

	</tr>

  <tr>

    <td width="10%" align="center" class="rowpic" nowrap>Name</td>

    <td align="center" class="rowpic" nowrap>From Date</td>

    <td align="center" class="rowpic" nowrap>To Date</td>

    <td align="center" class="rowpic" nowrap>Leave Type</td>

    <td align="center" class="rowpic" nowrap>Days</td>

    <td align="center" class="rowpic" nowrap>Reason</td>

    <td align="center" class="rowpic" nowrap>Backup Resource</td>

        <td align="center" class="rowpic" nowrap>Status</td>



  </tr>

  <?php

  while($leavdet1=fetcharray($leavdet))

	{

				$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leavdet1[type]'"));

		

		$tfdate1=explode('-',$leavdet1[f_date]);

		$fdate1=$tfdate1[2]."-".$tfdate1[1]."-".$tfdate1[0];

		$ttdate1=explode('-',$leavdet1[t_date]);

		$tdate1=$ttdate1[2]."-".$ttdate1[1]."-".$ttdate1[0];





		?>

  <tr>

    <td align="left"  nowrap>&nbsp;<?=$stafftype[2]?><?=$stafftype[3]?></td>

    <td align="center"  nowrap><?=$fdate1?></td>

    <td align="center"  nowrap><?=$tdate1?></td>

    <td align="center"  nowrap><?=$staflavty[leave_name]?></td>

    <td align="center"  nowrap><?=$leavdet1[days]?></td>

    <td align="justify" ><?=$leavdet1[reason]?></td>

    <td align="center"  nowrap><?=$leavdet1[backup]?></td>

    	<?php

    if($leavdet1[approved]==1)

    {

    ?>

    <td align="center" ><font color="#009900"><b>Approved</b></font></td>

    <?php

    }

    ?>

    <?php

    if($leavdet1[reject]==1)

    {

    ?>

    <td align="center" ><font color="#FF0000"><b>Rejected</b></font></td>

    <?php

    }

    ?>

    <?php

    if($leavdet1[reject]=='0' && $leavdet1[approved]=='0')

    {

    ?>

    <td align="center"><font color="#0000FF"><b>Pending</b></font></td>

    <?php

    }

    ?>



  </tr>

        <?

		

	}

}

?>

  </table>

<br>
<?php
$allvalues=fetcharray(execute(" select * from staff_default where d_date='$sysdate' and staff_id='$staff_id' and status=1"));

$reason=$allvalues['reason'];
$time_in=$allvalues['time_in'];
$time_out=$allvalues['time_out'];
?>

     <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">


    <tr>
    
    <td align="center" class="head" nowrap="nowrap">Staff Code</td>
    
    <td align="center" class="head" nowrap="nowrap">Staff Name</td>
    
    <td align="center" class="head" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
    
    <td align="center" class="head" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Edit IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    
    <td align="center" class="head" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
    
    <td align="center" class="head" nowrap="nowrap">Edit OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Time Spent</td>
    
    <td align="center" class="head" nowrap="nowrap">Status</td>
    
    </tr>

<?

		$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$stafftype[1]'"));

$staffif=trim($staffrfid[0]);



$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$vwadtae1' and user='$stafftype[1]' order by att_time asc limit 1"));



$staffrfidout=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$vwadtae1' and user='$stafftype[1]' order by att_time desc limit 1"));

	if($stafftype[0]=='1')

	{

	 $acintime1='7:30';

	}

	if($stafftype[0]=='2')

	{

	 $acintime1='8:00';

	}

	if($stafftype[0]=='1')

	{

       $acouttime1='16:10';

	}

	if($stafftype[0]=='2')

	{

       $acouttime1='16:10';

	}

	

$var1 = ($staffrfidlv[0]);

$var2 = ($staffrfidout[0]);

$var3 = $var2 - $var1;



$var1_sec=strtotime($var1);

$var2_sec=strtotime($var2);

$var3_sec=$var2_sec-$var1_sec;



$var4 = gmdate ( 'H:i:s' , $var3_sec);



  ?>

  <tr>

    <td align="center"  nowrap="nowrap"><?=$stafftype[4]?></td>

    <td align="left"  nowrap="nowrap">&nbsp;<?=$stafftype[2]?><?=$stafftype[3]?></td>

    <td align="center"  nowrap="nowrap"><?=$acintime1?></td>

    <td align="center"  nowrap="nowrap">

	<?php
$testout=0;
$testin=0;
		

if($stafftype[0]=='1')
{
if($staffrfidlv[0]<='07:30:59')
{
if($staffrfidlv[0])
$testin=1;
echo "<font color='#006600'>$staffrfidlv[0]</font>";
}
elseif($staffrfidlv[0]<='11:00:59')
{
if($staffrfidlv[0])
$testin=1;
echo "<font color='#FF0000'>$staffrfidlv[0]</font>";
}
}
if($stafftype[0]=='2')
{
if($staffrfidlv[0]<='08:00:59')
{
if($staffrfidlv[0])
$testin=1;
echo "<font color='#006600'>$staffrfidlv[0]</font>";
}
elseif($staffrfidlv[0]<='11:00:59')
{
if($staffrfidlv[0])
$testin=1;
echo "<font color='#FF0000'>$staffrfidlv[0]</font>";
}
}

	switch ($testin)
	{
	case "0":
	echo $time_in;
	break;
	}
	?>
    </td>
<td align="center"  nowrap="nowrap">
<?php
switch ($testin)
{
case "0":
  ?>
    <div class="control-group">
        <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="time_in" data-link-format="hh:ii">
        <input type="text" name="time_in" value="<?=$time_in?>" readonly required>
        <span class="add-on"><i class="icon-remove"></i></span>
        <span class="add-on"><i class="icon-th"></i></span>
        </div>
        </div>
  <? 
   break;
}
?>

</td>

    <td align="center"  nowrap="nowrap"><?=$acouttime1?></td>

   	<td align="center"  nowrap="nowrap">
    <?php
	
            if($staffrfidout[0]>'15:00:59')
            
            {
				
            $testout=1;
            
            echo "<font color='#006600'>$staffrfidout[0]</font>";
            
            }
			switch ($testout)
			{
			case "0":
			echo $time_out;
			 break;
			}
			?>
            </td>
            <td align="center"  nowrap="nowrap">
 <?php
switch ($testout)
{
case "0":
  ?>
  <div class="control-group">
    <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="time_out" data-link-format="hh:ii">
    <input type="text" name="time_out" value="<?=$time_out?>" style="width:60px; height:30px" readonly required>
    <span class="add-on"><i class="icon-remove"></i></span>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
      <? 
   break;
}
?>
</td>
    <td align="center"  nowrap="nowrap">
	<?php
	if($testout==1 && $testin==1)
    {
		?>
	<?=$var4?>
    <?php
	}
    ?>
		<?
	if($testin=='0' && $testout=='0')
	{
		$alltime1 = ($time_in);
		$alltime2 = ($time_out);
		$alltime3 = $alltime2 - $alltime1;
		$alltime1_sec=strtotime($alltime1);
		$alltime2_sec=strtotime($alltime2);
		$alltime3_sec=$alltime2_sec-$alltime1_sec;
		if($time_in!='' && $time_out!='')
		{
			echo $alltime_final = gmdate ( 'H:i:s' , $alltime3_sec);
		}
	}
	else
	{
		if($testin=='0')
		{
			$intime1 = ($time_in);
			$intime2 = ($staffrfidout[0]);
			$intime3 = $intime2 - $intime1;
			$intime1_sec=strtotime($intime1);
			$intime2_sec=strtotime($intime2);
			$intime3_sec=$intime2_sec-$intime1_sec;
			if($time_in)
			{
				echo $intime_final = gmdate ( 'H:i:s' , $intime3_sec);
			}
		}
		
		if($testout=='0')
		{
			$outtime1 = ($staffrfidlv[0]);
			$outtime2 = ($time_out);
			$outtime3 = $outtime2 - $outtime1;
			
			$outtime1_sec=strtotime($outtime1);
			$outtime2_sec=strtotime($outtime2);
			$outtime3_sec=$outtime2_sec-$outtime1_sec;
			if($time_out)
			{
				echo $outtime_final = gmdate ( 'H:i:s' , $outtime3_sec);
			}
		}
	}
        ?>
    </td>

    <td align="center"  nowrap="nowrap">

        <?php

	$stsss=1;	

       $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$stafftype[1]'"));

	if($type=$r5[0])	

	{

		$stsss=0;



		if($type==1)

		{

		?>

        <font color='#006600'>

		<b>P</b>

        </font>

		<?

		}

        if($type==2)

		{

		?>

        <font color='#FFFF00'>

		<b>

		A</b>

        </font>

		<?

		}

        if($type==3)

		{

		?>

        <font color='#FF0000'>

		<b>

		WO</b>

        </font>

		<?

		}

        if($type==4)

		{

		?>

        <font color='#FF0000'>

		<b>

		H</b>

        </font>

		<?

		}

		if($type==5)

		{

		?>

        <font color='#0000FF'>

		<b>

		H</b>

        </font>

		<?

		}

        if($type==6)

		{
if(($testout==0 && $testin==1) || ($testout==1 && $testin==0))
    {
		?>
	<font color='#0000FF'><b>Default</b></font>	
	<?php
    }
	else
	{
		?>

        <font color='#0000FF'>

		<b>

		FHL</b>

        </font>

		<?
	}
		}

        if($type==7)

		{

		?>

        <font color='#0000FF'>

		<b>

		SHL</b>

        </font>

		<?

		}

        if($type==8)

		{

		?>

        <font color='#FF9900'>

		<b>

		LWP</b>

        </font>

		<?

		}

        if($type==9)

		{

		?>

        <font color='#FFFF00'>

		<b>

		P(EE)</b>

        </font>

		<?

		}

        if($type==10)

		{

		?>

        <font color='#FFFF00'>

		<b>

		P(LC)</b>

        </font>

		<?

		}

	}

	else

	{

        ?>

        <?php

if($stafftype[0]=='1')

{

if($staffrfidlv[0]<='07:30:59')

{

if($staffrfidlv[0])

{

	$stsss=0;

if(($testout==0 && $testin==1) || ($testout==1 && $testin==0))
    {
		?>
	<font color='#0000FF'><b>Default</b></font>	
	<?php
    }
	else
	{

?>

<b><font color='#006600'>P</font>

</b>

<?
	}
}

}

if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))

{

if($staffrfidlv[0])

{

	$stsss=0;

if(($testout==0 && $testin==1) || ($testout==1 && $testin==0))
    {
		?>
	<font color='#0000FF'><b>Default</b></font>	
	<?php
    }
	else
	{

?>

<font color='#FFFF00'><b>P(LC)</b></font>

<?
	}
}

}

if($staffrfidlv[0] > '12:00:59')

{

if($staffrfidlv[0])

{

$stsss=0;

if(($testout==0 && $testin==1) || ($testout==1 && $testin==0))
    {
		?>
	<font color='#0000FF'><b>Default</b></font>	
	<?php
    }
	else
	{

?>

<font color='#0000FF'><b>FHL</b></font>

<?
	}

}

}
if(($testout==0 && $testin==0))
    {
		?>
	<font color='#FF0000'><b>A</b></font>	
	<?php
    }
}

if($stafftype[0]=='2')

{

if($staffrfidlv[0]<='08:00:59')

{

if($staffrfidlv[0])

{

	$stsss=0;

if(($testout==0 && $testin==1) || ($testout==1 && $testin==0))
    {
		?>
	<font color='#0000FF'><b>Default</b></font>	
	<?php
    }
	else
	{

?>

<font color='#006600'><b>P</b></font>

<?
	}
}

}

if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))

{

if($staffrfidlv[0])

{

	$stsss=0;


if(($testout==0 && $testin==1) || ($testout==1 && $testin==0))
    {
		?>
	<font color='#0000FF'><b>Default</b></font>	
	<?php
    }
	else
	{
?>

<font color='#FFFF00'><b>P(LC)</b></font>

<?
	}
}

}

if($staffrfidlv[0] > '12:00:59')

{

if($staffrfidlv[0])

{

	$stsss=0;

if(($testout==0 && $testin==1) || ($testout==1 && $testin==0))
    {
		?>
	<font color='#0000FF'><b>Default</b></font>	
	<?php
    }
	else
	{

?>

<font color='#0000FF'><b>FHL</b></font>

<?
	}
}

}

}
if(($testout==0 && $testin==0))
    {
		?>
	<font color='#FF0000'><b>A</b></font>	
	<?php
    }
	}

if($stsss)

{

	 $leaveaprs=fetcharray(execute("select approved,reject from staff_leave where staff_id='$stafftype[1]' and ( '$pfdate' between f_date and t_date)"));

	 if($leaveaprs[0]==1)

	 {

	 ?>

    	<font color='#006600'><b>&#9733; P</b></font>

     <?

	 }

	 if($leaveaprs[1]==1)

	 {

	 ?>

     <font color='#FF0000'><b>&#9733; A</b></font>

     <?

	 }

}

?>

        </td>



  </tr>


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
<?php
if($testin==0 || $testout==0)
{

  ?>
  <tr>
  <td>&nbsp;Reason*</td>
  <td colspan="9">&nbsp;<textarea rows="1" cols="100" name='reason'  style="background-color: #FFFFCC; width:500px;" placeholder="Reason*" required><?=stripslashes($reason)?></textarea></td>
  </tr>
    </table>
    <br />
<div align='center' >
  <input type="submit" name="save" value="Save"  class='bgbutton'>
  </div>
<?php
}
?>
</form>
</BODY>

</HTML>