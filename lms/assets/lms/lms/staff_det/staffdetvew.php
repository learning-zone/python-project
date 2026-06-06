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
	$bdate=$_REQUEST['bdate'];
	$ename=$_REQUEST['ename'];
	$type=$_REQUEST['type'];
	$mon=$_REQUEST['mon'];
	$yer=$_REQUEST['yer'];
	$day=$_REQUEST['day'];
	$adate=$_REQUEST['adate'];
	$staffid=$_REQUEST['staffid'];
}
else
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$update=$_POST['update'];
	$save=$_POST['save'];
	$subid=$_POST['subid'];
	$rcot=$_POST['rcot'];
	$descr=$_POST['descr'];
	$date3=$_POST['date3'];
	$adate=$_POST['adate'];
	$ename=$_POST['ename'];
	$type=$_POST['type'];
	$mon=$_POST['mon'];
	$yer=$_POST['yer'];
	$day=$_POST['day'];
	$bdate=$_POST['bdate'];
	$adate=$_POST['adate'];
	$staffid=$_POST['staffid'];

}
if($day)
{
	$adate="$day/$mon/$yer";
}



	$date1 = date("d/m/Y");
	$sysdate="$yer-$mon-$day";	
	

			$stafftype=fetcharray(execute("select group_id,id,f_name,s_name,slno from staff_det where  active='YES' and id='$staffid' order by f_name"));

	//	$stafftype=fetcharray(execute("select b.group_id,a.srid,b.f_name,b.s_name,b.slno from users a,staff_det b where   a.srid=b.id and a.username='$user'"));

?>
<title>Staff Details</title>
<script language="javascript" src="../js/cal2.js"></script>

<script language="javascript" src="../js/cal_conf2.js"></script>

  <script>
function RefreshMe(val)
	{	
		document.frm.action="staffdetvew.php";
		document.frm.submit();
	}
	</script>
    <form name="frm"  method="post">

<input type="hidden" name="staffid" value="<?=$staffid?>"/>
<?php
//date funtion
$vatnames=date("D");
//sunday
if($vatnames=='Sun')
{
 for($i=1;$i<2;$i++)
{
$tomorrow = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$fntcolors=date("d/m/Y", $tomorrow);
}
}
//monday
if($vatnames=='Mon')
{
 for($i=0;$i<1;$i++)
{
$tomorrow = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$fntcolors=date("d/m/Y", $tomorrow);
}
}
//tuesday
if($vatnames=='Tue')
{
 for($i=-1;$i<0;$i++)
{
$tomorrow = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$fntcolors=date("d/m/Y", $tomorrow);
}
}

//Wednesday
if($vatnames=='Wed')
{
 for($i=-2;$i<-1;$i++)
{
$tomorrow = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$fntcolors=date("d/m/Y", $tomorrow);
}
}
//Thursday
if($vatnames=='Thu')
{
 for($i=-3;$i<-2;$i++)
{
$tomorrow = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$fntcolors=date("d/m/Y", $tomorrow);
}
}

//Friday
if($vatnames=='Fri')
{
 for($i=-4;$i<-3;$i++)
{
$tomorrow = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$fntcolors=date("d/m/Y", $tomorrow);
}
}
//saturday
if($vatnames=='Sat')
{
 for($i=2;$i<3;$i++)
{
$tomorrow = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
$fntcolors=date("d/m/Y", $tomorrow);
}
}
if($_GET['adate']!='')
	{
	   $adate=$_GET['adate'];
	}
	elseif($_POST['adate']!='')
	{
	   $adate=$_POST['adate'];
	}
	else
	{
	    $adate=$fntcolors;
	}
if($_POST['bdate']=='')
{
	$bdate=date("d/m/Y");
}

?>
<table width="70%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Select Date</td>
    </tr>
   <tr>
		<td nowrap>&nbsp;&nbsp;From &nbsp;<input type="text" readonly name="adate" value="<?php echo $adate?>" onFocus="RefreshMe(0)">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle"></a>
        </td>
		<td nowrap>
        &nbsp;&nbsp;To &nbsp;<input type="text" readonly name="bdate" value="<?php echo $bdate?>" onFocus="RefreshMe(0)">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle"></a>
        </td>
	</tr>  
</table> 

<?php
$vwadtae=explode("/",$adate);
$vwadtae[0];
$vwadtae[1];
$vwadtae[2];
$vwadtae1=$vwadtae[2]."-".$vwadtae[1]."-".$vwadtae[0];

$bvwadtae=explode("/",$bdate);
$bvwadtae[0];
$bvwadtae[1];
$bvwadtae[2];
$bvwadtae1=$bvwadtae[2]."-".$bvwadtae[1]."-".$bvwadtae[0];

$temsql3=execute("select * from staff_calenders where status='1' and staff_typ='$stafftype[0]'  and (fromdate  between '$vwadtae1' and '$bvwadtae1') order by fromdate desc");
if(mysql_num_rows($temsql3)>=1)
{	
?>
<br>
    <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="5" class="head" align="center">Calender Details</td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic"  nowrap>Sl.No.</td>
    <td align="center" class="rowpic" nowrap>Title</td>
    <td align="center" class="rowpic" nowrap>description</td>
    <td align="center" class="rowpic" nowrap>Staff Type</td>
    <td align="center" class="rowpic" nowrap>Date</td>
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
<br />

<table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="5" class="head" align="center">Leave Type</td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic"  nowrap>Sl.No.</td>
    <td align="center" class="rowpic" nowrap>Leave Type</td>
    <td align="center" class="rowpic" nowrap>Total</td>
    <td align="center" class="rowpic" nowrap>Available Leave</td>
<!--    <td align="center" class="rowpic">Used<br>Leaves</td>
-->  </tr>
<?php
$cc=1;
$leavtype=execute("select b.id,b.leave_name,a.days from leave_staff_day a,staff_leave_type b  where   b.status=1 and a.status=1 and a.staff_type='$stafftype[0]' and a.leave_type=b.id group by b.id");
while($leavty_vw=fetcharray($leavtype))
{

$daycount=fetcharray(execute("select days from staff_leave where staff_id='$staffid' and type='$leavty_vw[0]'  and status=1 and reject='0'"));

$alltot=$leavty_vw[2]-$daycount[0];
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
?>
    <tr>
    <td align="center" nowrap><?=$cc?></td>
    <td nowrap>&nbsp;<?=$leavty_vw[1]?></td>
    <td align="center"  nowrap><b><?=$leavty_vw[2]?></b></td>
    <td align="center" nowrap><b><font color="<?=$fnt_colrs?>"><?=$alltot1?></font></b></td>
    </tr>
<?php
$cc++;
}
?>
  </table>
  
<?php

$leavdet=execute("select * from staff_leave where  status='1' and staff_id='$stafftype[1]' and (( f_date between '$vwadtae1' and '$bvwadtae1') or (t_date  between '$vwadtae1' and '$bvwadtae1') ) order by f_date");
if(mysql_num_rows($leavdet)>=1)
{	
?>
    <br>
     <table  class='forumline' align='center' width="100%" border="1" cellspacing="0" cellpadding="0">
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
    <td align="center" ><?=$fdate1?></td>
    <td align="center" ><?=$tdate1?></td>
    <td align="center" ><?=$staflavty[leave_name]?></td>
    <td align="justify" ><?=$leavdet1[days]?></td>
    <td align="center" ><?=$leavdet1[reason]?></td>
    <td align="center" ><?=$leavdet1[backup]?></td>
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
<table cellspacing="0" cellpadding="0" border="1" align="center" width="100%">
 <tr>
    <td align="center" class="head" colspan="5" nowrap="nowrap">Name : <?=$stafftype[2]?>&nbsp;<?=$stafftype[3]?></td>
    <td align="center" class="head" colspan="4" nowrap="nowrap">Staff Code : <?=$stafftype[4]?></td> 
  </tr>
  <tr>
    <td align="center" class="head" nowrap="nowrap">Sl No</td>
    <td align="center" class="head" nowrap="nowrap">Date</td>
    <td align="center" class="head" nowrap="nowrap">Actual IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Expected IN Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Actual OUT Time<br>(HH:mm)</td>
   	<td align="center" class="head" nowrap="nowrap">Expected OUT Time<br>(HH:mm)</td>
    <td align="center" class="head" nowrap="nowrap">Time Spent</td>
    <td align="center" class="head" nowrap="nowrap">Current Status</td>
    <td align="center" class="head" nowrap="nowrap" width="10%">Update Status</td>
  </tr>
<?php
$s=1;
	$allattdates=execute("SELECT att_time,att_date FROM `rfid_staff_check_in` where  (att_date  between '$vwadtae1' and '$bvwadtae1') group by att_date order by att_date desc");
	while($allattdate1=fetcharray($allattdates))
	{
	if($allattdate1[1]!='0000-00-00')
	{
	$pfdate=$allattdate1[1];
	$rtfrtdate=explode('-',$pfdate);
	$rtfrtdatefl=$rtfrtdate[2]."-".$rtfrtdate[1]."-".$rtfrtdate[0];
			$viewss1=fetcharray(execute("select f_name,s_name,slno,group_id,id from staff_det where  active='YES' and id='$staffid' order by f_name"));

	?>
    <tr>
 <td align="center" width="3%"><?=$s?></td>
        <td align="center" width="10%" nowrap><?=$rtfrtdatefl?></td>
        <td align="center" width="10%">
		<?php
	
		$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);
//echo "SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]'";
$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' "));

		$acintime1='';
		$acintime2='';
		$acouttime1='';
		$acouttime2='';
        if($viewss1[3]=='1')
        {
        echo $acintime1='7:30';
        }
        if($viewss1[3]=='2')
        {
        echo $acintime2='8:00';
        }
        ?>
        </td>
        <td align="center" width="10%">
		<?php
		
		if($viewss1[3]=='1')
        {
			if($staffrfidlv[0]<='07:30:59')
			{
				echo "<font color='#006600'>$staffrfidlv[0]</font>";
			}
			else
			{
				echo "<font color='#FF0000'>$staffrfidlv[0]</font>";
			}
		}
		if($viewss1[3]=='2')
        {
			if($staffrfidlv[0]<='08:00:59')
			{
				echo "<font color='#006600'>$staffrfidlv[0]</font>";
			}
			else
			{
				echo "<font color='#FF0000'>$staffrfidlv[0]</font>";
			}
		}
		?>
        </td>
        <td align="center" width="10%">
		<?php
        if($viewss1[3]=='1')
        {
        echo $acouttime1='16:10';
        }
        if($viewss1[3]=='2')
        {
        echo $acouttime2='17:00';
        }
        ?>
        </td>
        <td align="center" width="10%">
        <?php
		$staffrfidout=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' order by id desc"));
$var1 = ($staffrfidlv[0]);
$var2 = ($staffrfidout[0]);
//$var7='05:30:00';
//$var9 = strtotime($var7);
$var3 = $var2 - $var1;

$var1_sec=strtotime($var1);
$var2_sec=strtotime($var2);
$var3_sec=$var2_sec-$var1_sec;

$var4 = gmdate ( 'H:i:s' , $var3_sec);



		if($viewss1[3]=='1')
        {
			if($staffrfidout[0] > '15:00:00')
			{
				echo "$staffrfidout[0]";
			}
		}
		if($viewss1[3]=='2')
        {
			if($staffrfidout[0] > '16:00:00')
			{
				echo "$staffrfidout[0]";
			}
		}
		
		?>
        </td>
        <td align="center" width="10%"><?=$var4?></td>
        <td align="center" width="10%">
<?php
$curtsts=1;
        				if($viewss1[3]=='1')
        {
			if($staffrfidlv[0]<='07:30:59')
			{
				$curtsts=0;
				if($staffrfidlv[0])
				echo "<font color='#006600'><b>P</b></font>";
			}
			if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))
			{
				$curtsts=0;
				if($staffrfidlv[0])
				echo "<font color='#CC6600'><b>P(LC)</b></font>";
			}
			if($staffrfidlv[0] > '12:00:59')
			{
				$curtsts=0;
				if($staffrfidlv[0])
				echo "<font color='#0000FF'><b>FHL</b></font>";
			}
		}
		if($viewss1[3]=='2')
        {
			if($staffrfidlv[0]<='08:00:59')
			{
				$curtsts=0;
				if($staffrfidlv[0])
				echo "<font color='#006600'><b>P</b></font>";
			}
			if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))
			{
				$curtsts=0;
				if($staffrfidlv[0])
				echo "<font color='#CC6600'><b>P(LC)</b></font>";
			}
			if($staffrfidlv[0] > '12:00:59')
			{
				$curtsts=0;
				if($staffrfidlv[0])
				echo "<font color='#0000FF'><b>FHL</b></font>";
			}
		}
		if($curtsts)
		{
			//echo "<font color='#CC6600'><b>A</b></font>";
		}
?>
        </td>
 <td align="center" nowrap>
        <?php
	$stsss=1;	
       $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
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
        <font color='#CC6600'>
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
		?>
        <font color='#0000FF'>
		<b>
		FHL</b>
        </font>
		<?
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
		LOP</b>
        </font>
		<?
		}
        if($type==9)
		{
		?>
        <font color='#CC6600'>
		<b>
		P(EE)</b>
        </font>
		<?
		}
        if($type==10)
		{
		?>
        <font color='#CC6600'>
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
if($viewss1[3]=='1')
{
if($staffrfidlv[0]<='07:30:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<b><font color='#006600'>P</font>
</b>
<?
}
}
if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<font color='#CC6600'><b>P(LC)</b></font>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
$stsss=0;

?>
<font color='#0000FF'><b>FHL</b></font>
<?
}
}
}
if($viewss1[3]=='2')
{
if($staffrfidlv[0]<='08:00:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<font color='#006600'><b>P</b></font>
<?
}
}
if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<font color='#CC6600'><b>P(LC)</b></font>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<font color='#0000FF'><b>FHL</b></font>
<?
}
}
}
	}
if($stsss)
{
	 $leaveaprs=fetcharray(execute("select approved,reject from staff_leave where staff_id='$viewss1[4]' and ( '$pfdate' between f_date and t_date)"));
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
   <?
   $s++;
	}
	}
	?>
</table>
</form>
</BODY>
</HTML>