<?php
   	session_start();
	include("../db.php");
	$user=$_SESSION['user'];

	$yr=date("Y");
	if($_POST)
	{

		$mont=$_POST['mont'];
		$yr=$_POST['yr'];
	}
	else
	{
		$mont=date("m");
		$yr=date("Y");
	}
	$day=date("d");
	$mon=$mont;
	$todayDate=date("Y-m-d");
	
	$stafftype=fetcharray(execute("select b.group_id,srid from users a,staff_det b where   a.srid=b.id and a.username='$user'"));

?>
<html>
<head>
<script language="Javascript">

function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}

function reload()
{
  document.frm.action='staff_profiletest.php';
  document.frm.submit();
}
</script>
<title></title>
</head>
<body>

<form name='frm' method='post' action=''>
<input type='hidden' name='day' value='<?php echo $day?>'>
<input type='hidden' name='yer' value='<?php echo $yr?>'>

<br>
<link rel="stylesheet" type="text/css" href="css/tab.css" />

<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
        <li><a href="leave.php?tab=1" >Leave & Attendance</a></li>
        
       <?php
	   echo "select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)";
		$mang_hrrt=execute("select b.staff_id from users a,staff_hr_grup b where b.status=1 and a.username='$user' and a.srid IN ( b.hr_id,b.mng_id)");
 if(mysql_num_rows($mang_hrrt)>0  || $staffrigtss[0]=='admin')
	{

		?>
        <li><a href="leave.php?tab=2" >Leave Approval</a></li>
        <li><a href="stafftime.php?tab=12" >Staff Time Sheet</a></li>
        <?php
	}
		?>
        <li class="currentBtn"><a href="staff_profile.php?tab=20" >My Time Sheet</a></li>
</ul>
</div>
</div>
<table align="center" border="1" cellSpacing="0" width="95%"  >
<tr height="30">
	   <td colSpan="7" align="center" class='head'>Calendar</td>
</tr>

<tr>
<td align="right"><font face='Lucida Sans' color='blue' size='2'>Month&nbsp;&nbsp;</font></td>
<td colspan="2" ><select name='mont' onChange="reload()">
  <?php
 $d=getdate();
$MyMonth=$mont;
 for($i=1;$i<=12;$i++)
{
        if($i<10)
	{
	  $i='0'.$i;
	}
	if($i == $MyMonth)
		echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
	else
		echo "<option value='$i'>" . MonthName($i) . "</option>\n";
}
?>
  </select>
  <?php MonthName($mont)?></td>
<td></td><td></td><td></td><td></td>
</tr>
<tr>
<td align="right">&nbsp;&nbsp;<font face='Lucida Sans' color='blue' size='2'>Year&nbsp;&nbsp;</font></td>
<td colspan="2">
  <select name='yr' onChange="reload()">
    <?php
$yrr=date("Y")-1;
for($i=1;$i<=3;$i++)
{

	if($yrr == $yr)

		echo "<option value='$yrr' selected>" . $yrr . "</option>\n";

	else

		echo "<option value='$yrr'>" .$yrr . "</option>\n";

		$yrr++;
}

?>
  </select></td>

<td></td><td></td><td></td><td></td></tr>
                    <tr class="keyrow">
					<td class="row3" height="16" width='75' bgcolor="" align="center"><font size="2" color="#FF0000">Sun</font></td>
					<td class="row3"  height="16" width='75' bgcolor="#ADAAF2" align="center"><font size="2">Mon</font></td>
					<td class="row3"  height="16" width='75' bgcolor="#ADAAF2" align="center"><font size="2">Tue</font></td>
					<td class="row3"  height="16" width='75' bgcolor="#ADAAF2" align="center"><font size="2">Wed</font></td>
					<td class="row3"  height="16" width='75' bgcolor="#ADAAF2" align="center"><font size="2">Thu</font></td>
					<td  class="row3" height="16" width="81" bgcolor="#ADAAF2" align="center"><font size="2">Fri</font></td>
					<td  class="row3" height="16" width='75' bgcolor="#ADAAF2" align="center"><font size="2">Sat</font></td>
				</tr>
				<tr>
				
				<?php
				       $r=cal_days_in_month(CAL_GREGORIAN,$mont,$yr);
				       for($i=1;$i<=$r;$i++)
				       {
						   $da='';
						   $fg='';
						   if($i<10)
						   {
						      $i='0'.$i;
						   }				   
						   $fg=$yr."-".$mont."-".$i;

						   $da=date('D-m-Y',strtotime($fg));

						   $das=explode("-",$da);
						if($i==1 )
						{
							   if($das[0]=='Sun')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   		 	$newbgcolor='class="colrs"';
											else
											$newbgcolor='';																					
								   ?>
									<td  <?php echo $newbgcolor; ?> height='75' vAlign="center" width='75'><font color="#FF0000">
									<div Align="center" ></div></font>
									<div Align="center" >
                                    <a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>','OpenWind2',900,500)"><font color="#FF0000"><?php echo $i?>
									 </font></a></div><br>	
                                     
									<?php
									$newdateval="$yr-$mont-$i";

////////////////////////////////////////////////////
$pfdate="$yr-$mont-$i";
//echo "select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,user b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name";

$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' "));
		
	$stsss=1;	
       $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
	if($type=$r5[0])	
	{
		$stsss=0;

		if($type==1)
		{
		?>
        <div align='center'><font color='#006600'>
		<b>P</b>
        </font></div>
		<?
		}
        if($type==2)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		A</b>
        </font></div>
		<?
		}
        if($type==3)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		WO</b>
        </font></div>
		<?
		}
        if($type==4)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		H</b>
        </font></div>
		<?
		}
		if($type==5)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		H</b>
        </font></div>
		<?
		}
        if($type==6)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		FHL</b>
        </font></div>
		<?
		}
        if($type==7)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		SHL</b>
        </font></div>
		<?
		}
        if($type==8)
		{
		?>
        <div align='center'><font color='#FF9900'>
		<b>
		LOP</b>
        </font></div>
		<?
		}
        if($type==9)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(EE)</b>
        </font></div>
		<?
		}
        if($type==10)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(LC)</b>
        </font></div>
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
<b><div align='center'><font color='#006600'>P</font>
</div></b>
<?
}
}
if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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
<div align='center'><font color='#006600'><b>P</b></font></div>
<?
}
}
if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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


///////////////////////////////////////////////////

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$stafftype[0]'");

								while($sqlnew21=fetcharray($sqlnew12))

								{

								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));

							echo "<div Align='center'  style='font-size:11;color:#004000'> &nbsp;$sqlnew21[title]</div>";
								

								}
								echo "</td>";

							   }
							   if($das[0]=='Mon')
							   							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   		 $newbgcolor='class="colrs"';							                                         else									
										 $newbgcolor='';
																		
								   ?>
									<td>&nbsp;</td><td <?php echo $newbgcolor; ?> height='75' vAlign="center" width='75' nowrap>
									<div Align="center" ></div>
									<div Align="center">
									<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><?php echo $i?></a>
									</div> <br>									
                          									<?php								
                                
								$newdateval="$yr-$mont-$i";
								
								////////////////////////////////////////////////////
$pfdate="$yr-$mont-$i";
//echo "select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,user b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name";

$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' "));
		
	$stsss=1;	
       $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
	if($type=$r5[0])	
	{
		$stsss=0;

		if($type==1)
		{
		?>
        <div align='center'><font color='#006600'>
		<b>P</b>
        </font></div>
		<?
		}
        if($type==2)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		A</b>
        </font></div>
		<?
		}
        if($type==3)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		WO</b>
        </font></div>
		<?
		}
        if($type==4)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		H</b>
        </font></div>
		<?
		}
		if($type==5)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		H</b>
        </font></div>
		<?
		}
        if($type==6)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		FHL</b>
        </font></div>
		<?
		}
        if($type==7)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		SHL</b>
        </font></div>
		<?
		}
        if($type==8)
		{
		?>
        <div align='center'><font color='#FF9900'>
		<b>
		LOP</b>
        </font></div>
		<?
		}
        if($type==9)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(EE)</b>
        </font></div>
		<?
		}
        if($type==10)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(LC)</b>
        </font></div>
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
<b><div align='center'><font color='#006600'>P</font>
</div></b>
<?
}
}
if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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
<div align='center'><font color='#006600'><b>P</b></font></div>
<?
}
}
if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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


///////////////////////////////////////////////////

								
								
								
								
								
$leavdet2=fetcharray(execute("select * from staff_leave where  status='1' and staff_id='$stafftype[1]' and approved=1 and  ('$newdateval'  between f_date and t_date)"));
	
	$staflavty=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leavdet2[type]'"));
								
echo "<div Align='center'  style='font-size:11;color:#FF0000'> &nbsp;$staflavty[leave_name]</div>";		

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$stafftype[0]'");

								while($sqlnew21=fetcharray($sqlnew12))

								{

								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));

							echo "<div Align='center'  style='font-size:11;color:#004000'>&nbsp;$sqlnew21[title]</div>";
								}
									?>
									</td>
									<?php									
							   }
							   if($das[0]=='Tue')
							   {

										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   		 	$newbgcolor='class="colrs"';							                                            else									
											$newbgcolor='';													
								   ?>
									<td>&nbsp;</td><td>&nbsp;</td>

									<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">
									<div Align="center" ></div>
									<div Align="center" >

									<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><?php echo $i?></a> 
									</div> 	<br>
									<?php
									 $newdateval="$yr-$mont-$i";
									 
									 
									 ////////////////////////////////////////////////////
$pfdate="$yr-$mont-$i";
//echo "select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,user b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name";

$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' "));
		
	$stsss=1;	
       $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
	if($type=$r5[0])	
	{
		$stsss=0;

		if($type==1)
		{
		?>
        <div align='center'><font color='#006600'>
		<b>P</b>
        </font></div>
		<?
		}
        if($type==2)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		A</b>
        </font></div>
		<?
		}
        if($type==3)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		WO</b>
        </font></div>
		<?
		}
        if($type==4)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		H</b>
        </font></div>
		<?
		}
		if($type==5)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		H</b>
        </font></div>
		<?
		}
        if($type==6)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		FHL</b>
        </font></div>
		<?
		}
        if($type==7)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		SHL</b>
        </font></div>
		<?
		}
        if($type==8)
		{
		?>
        <div align='center'><font color='#FF9900'>
		<b>
		LOP</b>
        </font></div>
		<?
		}
        if($type==9)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(EE)</b>
        </font></div>
		<?
		}
        if($type==10)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(LC)</b>
        </font></div>
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
<b><div align='center'><font color='#006600'>P</font>
</div></b>
<?
}
}
if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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
<div align='center'><font color='#006600'><b>P</b></font></div>
<?
}
}
if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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


///////////////////////////////////////////////////

									 
									 
								$leavdet3=fetcharray(execute("select * from staff_leave where  status='1'  and approved=1 and staff_id='$stafftype[1]' and  ('$newdateval'  between f_date and t_date)"));

$staflavty3=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leavdet3[type]'"));
								
echo "<div Align='center'  style='font-size:11;color:#FF0000'> &nbsp;$staflavty3[leave_name]</div>";
								
								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$stafftype[0]'");

								while($sqlnew21=fetcharray($sqlnew12))

								{

								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));

							echo "<div Align='center'  style='font-size:11;color:#004000'>&nbsp;$sqlnew21[title]</div>";
								

								}
									?>
									</td>
									<?php
									
							   }
							   if($das[0]=='Wed')
							   {
										 $bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   		 	$newbgcolor='class="colrs"';							                    						else					
											$newbgcolor='';

											
								   ?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?>  height='75' vAlign="center" width="81">
									<div Align="center" ></div>
									<div Align="center" >
									<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><?php echo $i?></a>
									</div>  <br>									
									<?php
									 $newdateval="$yr-$mont-$i";
									 ////////////////////////////////////////////////////
$pfdate="$yr-$mont-$i";
//echo "select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,user b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name";

$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' "));
		
	$stsss=1;	
       $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
	if($type=$r5[0])	
	{
		$stsss=0;

		if($type==1)
		{
		?>
        <div align='center'><font color='#006600'>
		<b>P</b>
        </font></div>
		<?
		}
        if($type==2)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		A</b>
        </font></div>
		<?
		}
        if($type==3)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		WO</b>
        </font></div>
		<?
		}
        if($type==4)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		H</b>
        </font></div>
		<?
		}
		if($type==5)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		H</b>
        </font></div>
		<?
		}
        if($type==6)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		FHL</b>
        </font></div>
		<?
		}
        if($type==7)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		SHL</b>
        </font></div>
		<?
		}
        if($type==8)
		{
		?>
        <div align='center'><font color='#FF9900'>
		<b>
		LOP</b>
        </font></div>
		<?
		}
        if($type==9)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(EE)</b>
        </font></div>
		<?
		}
        if($type==10)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(LC)</b>
        </font></div>
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
<b><div align='center'><font color='#006600'>P</font>
</div></b>
<?
}
}
if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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
<div align='center'><font color='#006600'><b>P</b></font></div>
<?
}
}
if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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


///////////////////////////////////////////////////

								$leavdet4=fetcharray(execute("select * from staff_leave where  status='1'  and approved=1 and staff_id='$stafftype[1]' and  ('$newdateval'  between f_date and t_date)"));
	$staflavty4=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leavdet4[type]'"));
								
echo "<div Align='center'  style='font-size:11;color:#FF0000'> &nbsp;$staflavty4[leave_name]</div>";						
								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$stafftype[0]'");

								while($sqlnew21=fetcharray($sqlnew12))

								{

								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));

							echo "<div Align='center'  style='font-size:11;color:#004000'> &nbsp;$sqlnew21[title]</div>";
								}
								echo "</td>";
							   }
								if($das[0]=='Thu')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   		 	$newbgcolor='class="colrs"';							                                          else									
											$newbgcolor='';
																						

								   ?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?>  height='75' vAlign="center" width="81">
									<div Align="center" ></div>
									<div Align="center" >
									<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><?php echo $i?></a>
									</div>  <br>									
									<?php
		 						$newdateval="$yr-$mont-$i";
		////////////////////////////////////////////////////
$pfdate="$yr-$mont-$i";
//echo "select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,user b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name";

$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' "));
		
	$stsss=1;	
       $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
	if($type=$r5[0])	
	{
		$stsss=0;

		if($type==1)
		{
		?>
        <div align='center'><font color='#006600'>
		<b>P</b>
        </font></div>
		<?
		}
        if($type==2)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		A</b>
        </font></div>
		<?
		}
        if($type==3)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		WO</b>
        </font></div>
		<?
		}
        if($type==4)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		H</b>
        </font></div>
		<?
		}
		if($type==5)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		H</b>
        </font></div>
		<?
		}
        if($type==6)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		FHL</b>
        </font></div>
		<?
		}
        if($type==7)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		SHL</b>
        </font></div>
		<?
		}
        if($type==8)
		{
		?>
        <div align='center'><font color='#FF9900'>
		<b>
		LOP</b>
        </font></div>
		<?
		}
        if($type==9)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(EE)</b>
        </font></div>
		<?
		}
        if($type==10)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(LC)</b>
        </font></div>
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
<b><div align='center'><font color='#006600'>P</font>
</div></b>
<?
}
}
if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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
<div align='center'><font color='#006600'><b>P</b></font></div>
<?
}
}
if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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


///////////////////////////////////////////////////

		$leavdet5=fetcharray(execute("select * from staff_leave where  status='1' and staff_id='$stafftype[1]'  and approved=1 and  ('$newdateval'  between f_date and t_date)"));
	
	$staflavty5=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leavdet5[type]'"));
								
echo "<div Align='center'  style='font-size:11;color:#004000'> &nbsp;$staflavty5[leave_name]</div>";

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$stafftype[0]'");

								while($sqlnew21=fetcharray($sqlnew12))

								{

								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));

							echo "<div Align='center'  style='font-size:11;color:#004000'> &nbsp;$sqlnew21[title]</div>";
								}
							echo "</td>";
							   }
							 if($das[0]=='Fri')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   		 	$newbgcolor='class="colrs"';							                                           else									
											$newbgcolor='';
								   ?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">
									<div Align="center" ></div>
									<div Align="center" >
									<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><?php echo $i?></a> 
									</div><br>								
									<?php
		 $newdateval="$yr-$mont-$i";
		 ////////////////////////////////////////////////////
$pfdate="$yr-$mont-$i";
//echo "select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,user b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name";

$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' "));
		
	$stsss=1;	
       $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
	if($type=$r5[0])	
	{
		$stsss=0;

		if($type==1)
		{
		?>
        <div align='center'><font color='#006600'>
		<b>P</b>
        </font></div>
		<?
		}
        if($type==2)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		A</b>
        </font></div>
		<?
		}
        if($type==3)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		WO</b>
        </font></div>
		<?
		}
        if($type==4)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		H</b>
        </font></div>
		<?
		}
		if($type==5)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		H</b>
        </font></div>
		<?
		}
        if($type==6)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		FHL</b>
        </font></div>
		<?
		}
        if($type==7)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		SHL</b>
        </font></div>
		<?
		}
        if($type==8)
		{
		?>
        <div align='center'><font color='#FF9900'>
		<b>
		LOP</b>
        </font></div>
		<?
		}
        if($type==9)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(EE)</b>
        </font></div>
		<?
		}
        if($type==10)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(LC)</b>
        </font></div>
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
<b><div align='center'><font color='#006600'>P</font>
</div></b>
<?
}
}
if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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
<div align='center'><font color='#006600'><b>P</b></font></div>
<?
}
}
if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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


///////////////////////////////////////////////////

		 $leavdet6=fetcharray(execute("select * from staff_leave where  status='1' and staff_id='$stafftype[1]' and approved=1 and  ('$newdateval'  between f_date and t_date)"));

$staflavty6=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leavdet6[type]'"));
								
echo "<div Align='center'  style='font-size:11;color:#FF0000'> &nbsp;$staflavty6[leave_name]</div>";
								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$stafftype[0]'");

								while($sqlnew21=fetcharray($sqlnew12))

								{

								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));

							echo "<div Align='center'  style='font-size:11;color:#004000'> &nbsp;$sqlnew21[title]</div>";
								

								}
								echo "</td>";
							   }
								if($das[0]=='Sat')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   		 	$newbgcolor='class="colrs"';																	                                            else									
											$newbgcolor='';
																					
								   
								   ?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?>  height='75' vAlign="center" width="81">
									<div Align="center" ></div>
									<div Align="center" >
									<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><?php echo $i?></a> </div><br>
									<?php
								$newdateval="$yr-$mont-$i";
								////////////////////////////////////////////////////
$pfdate="$yr-$mont-$i";
//echo "select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,user b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name";

$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' "));
		
	$stsss=1;	
       $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
	if($type=$r5[0])	
	{
		$stsss=0;

		if($type==1)
		{
		?>
        <div align='center'><font color='#006600'>
		<b>P</b>
        </font></div>
		<?
		}
        if($type==2)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		A</b>
        </font></div>
		<?
		}
        if($type==3)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		WO</b>
        </font></div>
		<?
		}
        if($type==4)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		H</b>
        </font></div>
		<?
		}
		if($type==5)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		H</b>
        </font></div>
		<?
		}
        if($type==6)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		FHL</b>
        </font></div>
		<?
		}
        if($type==7)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		SHL</b>
        </font></div>
		<?
		}
        if($type==8)
		{
		?>
        <div align='center'><font color='#FF9900'>
		<b>
		LOP</b>
        </font></div>
		<?
		}
        if($type==9)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(EE)</b>
        </font></div>
		<?
		}
        if($type==10)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(LC)</b>
        </font></div>
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
<b><div align='center'><font color='#006600'>P</font>
</div></b>
<?
}
}
if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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
<div align='center'><font color='#006600'><b>P</b></font></div>
<?
}
}
if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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


///////////////////////////////////////////////////

								$leavdet7=fetcharray(execute("select * from staff_leave where  status='1'  and approved=1 and staff_id='$stafftype[1]' and  ('$newdateval'  between f_date and t_date)"));
	$staflavty7=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leavdet7[type]'"));
								
echo "<div Align='center'  style='font-size:11;color:#FF0000'> &nbsp;$staflavty7[leave_name]</div>";
								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$stafftype[0]'");

								while($sqlnew21=fetcharray($sqlnew12))

								{

								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));

							echo "<div Align='center'  style='font-size:11;color:#004000'> &nbsp;$sqlnew21[title]</div>";
								

								}
								echo "</td>";
							   }
						   }
						   else
						   {
							   if($das[0]=='Sun')
							   {
								   ?><tr><?php
								   $bgcolor='red';
							   }
							   else
									$bgcolor='';
												
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   		 	$newbgcolor='class="colrs"';
											else
											$newbgcolor='';
										
																					
							   ?>
								<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81"><font color="<?php echo $bgcolor; ?>">
								<div Align="center" ></div>
								</font>&nbsp;&nbsp;&nbsp;&nbsp;<div Align="center" >
								<a href="javascript:void(0);" onClick ="OpenWind2('staff_pf_vw.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',900,500)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div>
								<br>
								<?php
                                $newdateval="$yr-$mont-$i";
				////////////////////////////////////////////////////
$pfdate="$yr-$mont-$i";
//echo "select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,user b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name";

$viewss1=fetcharray(execute("select a.f_name,a.s_name,a.slno,a.group_id,a.id from staff_det a,users b where  a.active='YES' and b.username='$user' and b.srid=a.id order by a.f_name"));
		
$staffrfid=fetcharray(execute("SELECT rfid FROM `rfid_enrolment_user` where `user_type`=2 and `status`=1 and user='$viewss1[4]'"));
$staffif=trim($staffrfid[0]);

$staffrfidlv=fetcharray(execute("SELECT att_time,att_date FROM `rfid_staff_check_in` WHERE rfidno='$staffif' and att_date='$pfdate' and user='$viewss1[4]' "));
		
	$stsss=1;	
       $r5=fetcharray(execute("select type,id from staff_att_updt where toddate='$pfdate' and staff_id='$viewss1[4]'"));
	if($type=$r5[0])	
	{
		$stsss=0;

		if($type==1)
		{
		?>
        <div align='center'><font color='#006600'>
		<b>P</b>
        </font></div>
		<?
		}
        if($type==2)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		A</b>
        </font></div>
		<?
		}
        if($type==3)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		WO</b>
        </font></div>
		<?
		}
        if($type==4)
		{
		?>
        <div align='center'><font color='#FF0000'>
		<b>
		H</b>
        </font></div>
		<?
		}
		if($type==5)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		H</b>
        </font></div>
		<?
		}
        if($type==6)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		FHL</b>
        </font></div>
		<?
		}
        if($type==7)
		{
		?>
        <div align='center'><font color='#0000FF'>
		<b>
		SHL</b>
        </font></div>
		<?
		}
        if($type==8)
		{
		?>
        <div align='center'><font color='#FF9900'>
		<b>
		LOP</b>
        </font></div>
		<?
		}
        if($type==9)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(EE)</b>
        </font></div>
		<?
		}
        if($type==10)
		{
		?>
        <div align='center'><font color='#FFFF00'>
		<b>
		P(LC)</b>
        </font></div>
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
<b><div align='center'><font color='#006600'>P</font>
</div></b>
<?
}
}
if(($staffrfidlv[0] > '07:30:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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
<div align='center'><font color='#006600'><b>P</b></font></div>
<?
}
}
if(($staffrfidlv[0] > '08:00:59')  && ($staffrfidlv[0] <= '12:00:59'))
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#FFFF00'><b>P(LC)</b></font></div>
<?
}
}
if($staffrfidlv[0] > '12:00:59')
{
if($staffrfidlv[0])
{
	$stsss=0;

?>
<div align='center'><font color='#0000FF'><b>FHL</b></font></div>
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


///////////////////////////////////////////////////

				$leavdet9=fetcharray(execute("select * from staff_leave where  status='1'  and approved=1 and staff_id='$stafftype[1]' and  ('$newdateval'  between f_date and t_date)"));
	$staflavty9=fetcharray(execute("select leave_name from staff_leave_type  where  status=1 and id='$leavdet9[type]'"));
if($das[0]!='Sun')
{								
echo "<div Align='center'  style='font-size:11;color:#FF0000'> &nbsp;$staflavty9[leave_name]</div>";
}
								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval' and staff_typ='$stafftype[0]'");

								while($sqlnew21=fetcharray($sqlnew12))

								{

								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));

							echo "<div Align='center'  style='font-size:11;color:#004000'> &nbsp;$sqlnew21[title]</div>";
								

								}
								echo "</td>";						   }
				  }
				$toc=$das[0];
				if($toc=='Sun')
				$countnum=6;
				elseif($toc=='Mon')
				$countnum=5;
				elseif($toc=='Tue')
				$countnum=4;
				elseif($toc=='Wed')
				$countnum=3;
				elseif($toc=='Thu')
				$countnum=2;
				elseif($toc=='Fri')
				$countnum=1;
				else
				$countnum=0;
				
				for($k=0;$k<$countnum;$k++)
				{
					echo "<td>&nbsp;</td>";
				}
				

				?>
				
			</table>
	</form>
	<?php
	function MonthName($mont)
{
        if($mont == 1) return("January");
        if($mont == 2) return("February");
        if($mont == 3) return("March");
        if($mont == 4) return("April");
        if($mont == 5) return("May");
        if($mont == 6) return("June");
        if($mont == 7) return("July");
        if($mont == 8) return("August");
        if($mont == 9) return("September");
        if($mont == 10) return("October");
        if($mont == 11) return("November");
        if($mont == 12) return("December");
}
?>
</table>

</body>

</html>
