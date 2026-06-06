<?php

    include("../db.php");
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
function reload()
{
  document.frm.action='scannouncementRep.php';
  document.frm.submit();
}
</script>
</head>
<body>

<form name='frm' method='post' action=''>
<input type='hidden' name='day' value='<?php echo $day?>'>
<input type='hidden' name='yer' value='<?php echo $yr?>'>
<br>

<table align="center" border="1" cellSpacing="0" width=""  >
<tr height="30">
	   <td colSpan="7" bgcolor="#6987CB" align="center" class='head'>
	   <font color="#ffffff" size="4">Announcement  </font></td>
</tr>
<tr>
<td align="right"><font face='Lucida Sans' color='blue' size='2'><b>Month</b>&nbsp;&nbsp;</font></td>
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
<td align="right">&nbsp;&nbsp;<font face='Lucida Sans' color='blue' size='2'><b>Year</b></font></td>
<td colspan="2">
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
<td></td><td></td><td></td><td></td>
</tr>
                    <tr class="keyrow">
					<td class="row3" height="16" width="50" bgcolor="red" align="center"><font size="2" ><b>Sun</b></font></td>
					<td class="row3"  height="16" width="50" bgcolor="#ADAAF2" align="center"><font size="2"><b>Mon</b></font></td>
					<td class="row3"  height="16" width="50" bgcolor="#ADAAF2" align="center"><font size="2"><b>Tue</b></font></td>
					<td class="row3"  height="16" width="50" bgcolor="#ADAAF2" align="center"><font size="2"><b>Wed</b></font></td>
					<td class="row3"  height="16" width="50" bgcolor="#ADAAF2" align="center"><font size="2"><b>Thu</b></font></td>
					<td  class="row3" height="16" width="81" bgcolor="#ADAAF2" align="center"><font size="2"><b>Fri</b></font></td>
					<td  class="row3" height="16" width="50" bgcolor="#ADAAF2" align="center"><font size="2"><b>Sat</b></font></td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
												$ro = mysql_num_rows($sql3);
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
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><font color="#FF0000"><?php echo $i?>
									 </font></a></div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >( <?php echo $countapp;?> )</div> </b></td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
												$ro = mysql_num_rows($sql3);
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
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><?php echo $i?></a> 
									</div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >( <?php echo $countapp;?> )</div> </b></td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
												$ro = mysql_num_rows($sql3);
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
									<div Align="center" >
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><?php echo $i?></a> 
									</div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >( <?php echo $countapp;?> )</div> </b></td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
												$ro = mysql_num_rows($sql3);
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
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><?php echo $i?></a>
									</div>  </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >( <?php echo $countapp;?> )</div> </b></td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
												$ro = mysql_num_rows($sql3);
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
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><?php echo $i?></a>
									</div>  </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >( <?php echo $countapp;?> )</div> </b></td>
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

												$sql3=mysql_query("SELECT id  FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
												$ro = mysql_num_rows($sql3);
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
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><?php echo $i?></a> 
									</div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >( <?php echo $countapp;?> )</div> </b></td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
												$ro = mysql_num_rows($sql3);
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
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><?php echo $i?></a> </div> </b>
											
									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >( <?php echo $countapp;?> )</div> </b></td>
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
										
												$sql3=mysql_query("SELECT id  FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
												$ro = mysql_num_rows($sql3);
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
								<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div>
								
								<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<div Align="center" >( <?php echo $countapp;?> )</div> </b></td>
									
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
