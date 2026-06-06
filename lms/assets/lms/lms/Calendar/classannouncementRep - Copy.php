<?php

session_start();
include("../db.php");
$academic_year=$_SESSION['AcademicYear'];
if(!$_POST and !$_REQUEST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
}
elseif(!$_POST and $_REQUEST)
{
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
}
else
{

	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
}
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
<script language="Javascript">
function go()
{
  document.frm.action='classannouncementRep.php';
  document.frm.submit();
}
</script>
</head>
<body>

<FORM NAME='frm' METHOD=POST >
	<table class='forumline' align='center' width="50%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td  colspan="2" class="head" align="center">Announcements </td>
	</tr>
	<tr>
	<td width="30%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
	<td  align="left">&nbsp;
	<select name="branch" size="1" OnChange=go()>
	<option value='' >-- Select --</option>
	<?
	$tempstr="SELECT course_id ,coursename FROM  course_m ";
	$rs_course=execute($tempstr);
	while($r1=fetcharray($rs_course))
	{
	if($branch==$r1[0])
		{
			echo "<option value='$r1[0]' selected>$r1[1]</option>";
		}
		else
		{
			echo "<option value='$r1[0]'>$r1[1]</option>";
		}
	}
	?>
	</select></td></tr>
	
	  <tr>
	<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
	<td colspan="2">&nbsp;
	<select name="sem" OnChange=go()>
	<?php
	$sql2 = "SELECT * FROM course_year where status=1 and head_id='$branch' ";
	$rs2 = execute($sql2);
	$num = rowcount($rs2);
	echo "<option value=''>-- Select --</option>";
	for($i=0;$i<$num;$i++)
	{
		$r2 = fetcharray($rs2,$i);
		if($sem==$r2[0])
		echo "<option value=\"$r2[0]\" selected>$r2[1]</option>";
		else
		echo "<option value=\"$r2[0]\">$r2[1]</option>";
	}
	?> </select> </td></tr></table>
    <br>
<input type='hidden' name='day' value='<?php echo $day?>'>
<input type='hidden' name='yer' value='<?php echo $yr?>'>
<br>

<table align="center" border="1" cellSpacing="0" width=""  >
<tr height="30">
	   <td colSpan="7"  align="center" class='head'>
	   Announcements  </td>
</tr>
<tr>
<td align="right"><font face='Lucida Sans' color='blue' size='2'><b>Month</b>&nbsp;&nbsp;</font></td>
<td colspan="2" ><select name='mont' onChange="go()">
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
<td align="right">&nbsp;&nbsp;<font face='Lucida Sans' color='blue' size='2'><b>Year</b></font></td>
<td colspan="2">
  <select name='yr' onChange="go()">
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
<td></td><td></td><td></td><td></td>
</tr>
                    <tr class="keyrow">
					<td class="row3" height="16" width="50"  align="center"><font size="2" ><b>Sun</b></font></td>
					<td class="row3"  height="16" width="50"  align="center"><font size="2"><b>Mon</b></font></td>
					<td class="row3"  height="16" width="50"  align="center"><font size="2"><b>Tue</b></font></td>
					<td class="row3"  height="16" width="50"  align="center"><font size="2"><b>Wed</b></font></td>
					<td class="row3"  height="16" width="50"  align="center"><font size="2"><b>Thu</b></font></td>
					<td  class="row3" height="16" width="81"  align="center"><font size="2"><b>Fri</b></font></td>
					<td  class="row3" height="16" width="50"  align="center"><font size="2"><b>Sat</b></font></td>
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
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='';
												$sql3=execute("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td  <?php echo $newbgcolor; ?> height="65" vAlign="center" width="50"><b><font color="#FF0000">
									<div Align="center" ></div></font>
									<div Align="center" >
									<font color="#FF0000"><?php echo $i?>
									 </font></div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" ><a href="javascript:void(0)" onClick="window.open('viewannouncement_class.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">( <?php echo $countapp;?> )
                                    </a></div> </b></td>
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
												$sql3=execute("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td>&nbsp;</td><td <?php echo $newbgcolor; ?> height="65" vAlign="center" width="50"><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?> 
									</div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" ><a href="javascript:void(0)" onClick="window.open('viewannouncement_class.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    ( <?php echo $countapp;?> )</a>
                                    </div> </b></td>
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
												$sql3=execute("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height="65" vAlign="center" width="81"><b>
									<div Align="center" ></div>
									<div Align="center" ><?php echo $i?>
									</div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >
									<a href="javascript:void(0)" onClick="window.open('viewannouncement_class.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">( <?php echo $countapp;?> )</a></div> </b></td>
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
												$sql3=execute("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height="65" vAlign="center" width="81"><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?>
									</div>  </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >
                                    <a href="javascript:void(0)" onClick="window.open('viewannouncement_class.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    ( <?php echo $countapp;?> )</a>
                                    </div> </b></td>
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
												$sql3=execute("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height="65" vAlign="center" width="81"><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?>
									</div>  </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >
                                    <a href="javascript:void(0)" onClick="window.open('viewannouncement_class.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    ( <?php echo $countapp;?> )
                                    </a></div> </b></td>
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

												$sql3=execute("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td <?php echo $newbgcolor; ?> height="65" vAlign="center" width="81"><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?> 
									</div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" ><a href="javascript:void(0)" onClick="window.open('viewannouncement_class.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    ( <?php echo $countapp;?> )</a>
                                    </div> </b></td>
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
												$sql3=execute("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td  <?php echo $newbgcolor; ?> height="65" vAlign="center" width="81"><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?></div> </b>
											
									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
								
									?>
									<div Align="center" >
                                    <?php
									if($countapp!=0)
									{
									?>
<a href="javascript:void(0)" onClick="window.open('viewannouncement_class.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    ( <?php echo $countapp;?> )
                                    <?php
									}
									?>
                                    </a>
                                    </div> </b></td>
									<?php
									}
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
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='';
										
												$sql3=execute("SELECT id  FROM `announcement_class` where class='$sem' and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
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
								<td <?php echo $newbgcolor; ?> height="65" vAlign="center" width="81"><b><font color="<?php echo $bgcolor; ?>">
								<div Align="center" ></div>
								</font>&nbsp;&nbsp;&nbsp;&nbsp;<div Align="center" >
								<font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></div>
								
								<?php
								if($avail=="Yes")
								{
								$getcountappointments=execute("SELECT count(id) FROM `announcement_class` where class='$sem' and  (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate') )");
								$count=fetchrow($getcountappointments);
								$countapp=$count[0];
								
									?>
									<div Align="center" >
                                    <?php
									if($countapp!=0)
									{
									?>
                                    <a href="javascript:void(0)" onClick="window.open('viewannouncement_class.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    ( <?php echo $countapp;?> )</a>
                                    <?php
									}
									?>
									</div> </b></td>
									
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
