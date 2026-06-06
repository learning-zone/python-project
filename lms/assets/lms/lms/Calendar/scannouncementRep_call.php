<?php
session_start();
require_once("../db.php");

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
?>
<html>
<head>
<style type="text/css">
<!--
body
{ 
	font-weight: normal;
	font-size: 12px;
	border-collapse: collapse;
	border-spacing: 0px;
	margin-left: 0px;
	margin-top: 0px;
}
.calendar
{
	background-color: #efefef;
	color: #444444;	
	background-image:url('images/dayCellCurrentMonth.png');
	background-repeat:repeat-y;

}
.calendar1
{
	background-color: #cccccc;
	color: #999999;
	background-image:url('images/dayCellOtherMonth.png');
	background-repeat:repeat-y;
}
.calendar2
{
	background-color: #cccccc;
	color: #999999;
	background-image:url('images/dayCellOtherMonth.png');
	background-repeat:repeat-y;
}
-->
</style>
<script language="Javascript">
function reload()
{
  document.frm.action='scannouncementRep_call.php';
  document.frm.submit();
}
</script>
<script language="javascript">
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
</head>
<body>
<form name='frm' method='post' action=''>
<input type='hidden' name='day' value='<?php echo $day?>'>
<input type='hidden' name='yer' value='<?php echo $yr?>'>
<BR><BR>
<table align="center" border="1" cellSpacing="0" style="margin-top:0 px; margin-right:-5 px;" width="70%">
<tr height="30">

	   <td colSpan="7" align="center" class='head'><strong>School Calendar</strong></td>

</tr>
<tr>
<td align="left" colspan="7" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month&nbsp;&nbsp;
<select name='mont' onChange="reload()">
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
  <?php MonthName($mont)?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year

  <select name='yr' onChange="reload()">
    <?php
$yrr=date("Y");
for($i=1;$i<=2;$i++)
{

	if($yrr == $yr)
		echo "<option value='$yrr' selected>" . $yrr . "</option>\n";
	else
		echo "<option value='$yrr'>" .$yrr . "</option>\n";
		$yrr++;
}
?>
  </select></td>
</tr>
<tr class="keyrow" height="25">
    <td class="row3"  width="50" align="center"><font size="2" color="#FF0000">Sun</font></td>
    <td class="row3"  width="50" align="center"><font size="2">Mon</font></td>
    <td class="row3"  width="50" align="center"><font size="2">Tue</font></td>
    <td class="row3"  width="50" align="center"><font size="2">Wed</font></td>
    <td class="row3"  width="50" align="center"><font size="2">Thu</font></td>
    <td class="row3"  width="81" align="center"><font size="2">Fri</font></td>
    <td class="row3"  width="50" align="center"><font size="2">Sat</font></td>
</tr>
	<tr height="60">
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
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='';
												$sql3=execute("SELECT id  FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
												$ro = rowcount($sql3);
												if($ro<=0)
												{
													$avail="No";
												}
												else
												{
													$avail="Yes";
												}												
								   ?>
									<td  <?php echo $newbgcolor; ?> height="20" vAlign="center" width="50" class="calendar" >
									<div Align="center" >
                                    <a href="javascript:void(0);" onClick ="OpenWind2('viewannouncement_call.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',700,400)"><font color="#FF0000"><?php echo $i?></font></a>
									 									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id), title FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
								
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<sup style="color: #3399FF; font-weight: bold;" title="<?=$count[1]?>">New!</sup></div> </td>
									<?php
									}
							   }
							   if($das[0]=='Mon')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='';
												$sql3=execute("SELECT id  FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
												$ro = rowcount($sql3);
												if($ro<=0)
												{
													$avail="No";
												}
												else
												{
													$avail="Yes";
												}												
								   ?>
									<td class="calendar2">&nbsp;</td>
                                    <td <?php echo $newbgcolor; ?> height="20" vAlign="center" width="50" class="calendar">
									
									<div Align="center" >
									
                                    <a href="javascript:void(0);" onClick ="OpenWind2('viewannouncement_call.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',700,400)"><?php echo $i?></a>
                                    
																
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id), title FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<sup style="color: #3399FF; font-weight: bold;" title="<?=$count[1]?>">New!</sup></div> </td>
									<?php
									}
							   }
							   if($das[0]=='Tue')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='';
												$sql3=execute("SELECT id  FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
												$ro = rowcount($sql3);
												if($ro<=0)
												{
													$avail="No";
												}
												else
												{
													$avail="Yes";
												}												
								   ?>
									<td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height="20" vAlign="center" width="81" class="calendar">
									<div Align="center" >
                                    <a href="javascript:void(0);" onClick ="OpenWind2('viewannouncement_call.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',700,400)"><?php echo $i?></a>
																		
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id), title FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<sup style="color: #3399FF; font-weight: bold;" title="<?=$count[1]?>">New!</sup></div> </td>
									<?php
									}
							   }
							   if($das[0]=='Wed')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='';
												$sql3=execute("SELECT id  FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
												$ro = rowcount($sql3);
												if($ro<=0)
												{
													$avail="No";
												}
												else
												{
													$avail="Yes";
												}												
								   ?>
									<td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height="20" vAlign="center" width="81" class="calendar">
									
									<div Align="center" >
									
                                    <a href="javascript:void(0);" onClick ="OpenWind2('viewannouncement_call.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',700,400)"><?php echo $i?></a>
									 									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id), title FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<sup style="color: #3399FF; font-weight: bold;" title="<?=$count[1]?>">New!</sup></div> </td>
									<?php
									}
							   }
								if($das[0]=='Thu')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="headc"';
											
										else
								   		 	$newbgcolor='';
												$sql3=execute("SELECT id  FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
												$ro = rowcount($sql3);
												if($ro<=0)
												{
													$avail="No";
												}
												else
												{
													$avail="Yes";
												}												

								   ?>
									<td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td><td class="calendar2" >&nbsp;</td>
                                    <td class="calendar2" >&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height="20" vAlign="center" width="81" class="calendar">
									
									<div Align="center" >
									
                                    <a href="javascript:void(0);" onClick ="OpenWind2('viewannouncement_call.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',700,400)"><?php echo $i?></a>
                                    
									  									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id), title FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<sup style="color: #3399FF; font-weight: bold;" title="<?=$count[1]?>">New!</sup></div> </td>
									<?php
									}
							   }
							 if($das[0]=='Fri')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='';

												$sql3=execute("SELECT id  FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
												$ro = rowcount($sql3);
												if($ro<=0)
												{
													$avail="No";
												}
												else
												{
													$avail="Yes";
												}												
								   ?>
									<td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height="20" vAlign="center" width="81" class="calendar">
									
									<div Align="center" >
									
                                    <a href="javascript:void(0);" onClick ="OpenWind2('viewannouncement_call.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',700,400)"><?php echo $i?></a>
									 									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id), title FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<sup style="color: #3399FF; font-weight: bold;" title="<?=$count[1]?>">New!</sup></div> </td>
									<?php
									}
							   }
								if($das[0]=='Sat')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='';
												$sql3=execute("SELECT id  FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
												$ro = rowcount($sql3);
												if($ro<=0)
												{
													$avail="No";
												}
												else
												{
													$avail="Yes";
												}												
								   
								   ?>
									<td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td><td class="calendar2">&nbsp;</td>
									<td  <?php echo $newbgcolor; ?> height="20" vAlign="center" width="81" class="calendar">
									
									<div Align="center" >
									
                                    <a href="javascript:void(0);" onClick ="OpenWind2('viewannouncement_call.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',700,400)"><?php echo $i?></a>
                                     
                                    	
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id), title FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<sup style="color: #3399FF; font-weight: bold;" title="<?=$count[1]?>">New!</sup></div></td>
									<?php
									}
							   }
						   }
						   else
						   {
							   if($das[0]=='Sun')
							   {
								   ?><tr height="60"><?php
								   $bgcolor='red';
							   }
							   else
									$bgcolor='';
												
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='';
										
												$sql3=execute("SELECT id  FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
												$ro = rowcount($sql3);
												if($ro<=0)
												{
													$avail="No";
												}
												else
												{
													$avail="Yes";
												}												
							   ?>
							<td <?php echo $newbgcolor; ?> height="20" vAlign="center" width="81" class="calendar">
                            <font color="<?php echo $bgcolor; ?>">	
								</font>&nbsp;&nbsp;&nbsp;&nbsp;<div Align="center" >
                                                              
                               <a href="javascript:void(0);" onClick ="OpenWind2('viewannouncement_call.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',700,400)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a>
                                
                                
                               <!-- </div>-->
								<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id), title FROM `announcement_call` where status=1 and ( grade='$sem' or grade='0') and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
								
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
                                    <sup style="color: #3399FF; font-weight: bold;" title="<?=$count[1]?>">New!</sup></div>
									<!--<div Align="center" >[ <?php echo $countapp;?> ]</div>--> </td>
									
									<?php
								}
						   }
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
					echo "<td class='calendar2'>&nbsp;</td>";
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
