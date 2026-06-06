<?php
session_start();
$per00=$_SESSION['per00'];
include("../db.php");
$academic_year=$_SESSION['AcademicYear'];
$sem=$_SESSION['sem'];
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
  document.frm.action='classannouncementRep1.php';
  document.frm.submit();
}
</script>
<script type="text/javascript">
function poponload()
{
    testwindow = window.open("", "mywindow", "location=1,status=1,scrollbars=1,width=100,height=100");
    testwindow.moveTo(0, 0);
}
</script>
</head>
<body>

<FORM NAME='frm' METHOD=POST >

<table align="center" border="1" cellSpacing="0" width="70%" height="455"  >
<tr >
	   <td colSpan="7"  align="center" class='headc2'>
	   Class Announcements  </td>
</tr>
<tr>
<td colspan="2" align="right" class="row4">Month&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td  colspan="2"><select name='mont' onChange="go()">
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
<td></td><td></td><td></td>
</tr>
<tr>
<td align="right" colspan="2" class="row4">Year&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
<td></td><td></td><td></td>
</tr>
       <tr class="keyrow">
					<td class="row3" height="16" width=""  align="center">Sun</td>
					<td class="row3"  height="16" width=""  align="center">Mon</td>
					<td class="row3"  height="16" width=""  align="center">Tue</td>
					<td class="row3"  height="16" width=""  align="center">Wed</td>
					<td class="row3"  height="16" width=""  align="center">Thu</td>
					<td  class="row3" height="16" width=""  align="center">Fri</td>
					<td  class="row3" height="16" width=""  align="center">Sat</td>
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
								   		 	$newbgcolor='class="headc1"';
												$sql3=mysql_query("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td  <?php echo $newbgcolor; ?> height="" vAlign="center" >
                                    <b><font color="#FF0000">
									<div Align="center" ></div></font>
									<div Align="center" >
									<font color="#FF0000"><?php echo $i?>
									</font></div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
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
								   		 	$newbgcolor='class="headc1"';
												$sql3=mysql_query("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td>&nbsp;</td><td <?php echo $newbgcolor; ?> height="" vAlign="center" ><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?> 
									</div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
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
								   		 	$newbgcolor='class="headc1"';
												$sql3=mysql_query("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td <?php echo $newbgcolor; ?> height="" vAlign="center" width=""><b>
									<div Align="center" ></div>
									<div Align="center" ><?php echo $i?>
									</div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
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
								   		 	$newbgcolor='class="headc1"';
												$sql3=mysql_query("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td <?php echo $newbgcolor; ?> height="" vAlign="center" width=""><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?>
									</div>  </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
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
								   		 	$newbgcolor='class="headc1"';
												$sql3=mysql_query("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td <?php echo $newbgcolor; ?> height="" vAlign="center" width=""><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?>
									</div>  </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
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
								   		 	$newbgcolor='class="headc1"';

												$sql3=mysql_query("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td <?php echo $newbgcolor; ?> height="" vAlign="center" width=""><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?> 
									</div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
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
								   		 	$newbgcolor='class="headc1"';
												$sql3=mysql_query("SELECT id  FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td  <?php echo $newbgcolor; ?> height="" vAlign="center" width=""><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?></div> </b>
											
									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
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
								   ?><tr height=""><?php
								   $bgcolor='red';
							   }
							   else
									$bgcolor='';
												
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='class="headc1"';
										
												$sql3=mysql_query("SELECT id  FROM `announcement_class` where class='$sem' and (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
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
								<td <?php echo $newbgcolor; ?> color="<?php echo $bgcolor; ?>" align="center" height="" vAlign="center" width="">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php echo $i?>
                                   <br>
								<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement_class` where class='$sem' and  (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate') )");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
								
									?>
									 <?php
									if($countapp!=0)
									{
										
									?>
                                    <a href="javascript:void(0)"  title="hi how are \n
                                    i am good
                                    jahahah" onClick="window.open('viewannouncement_class.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    <?php $countapp;?><img src="../images/announcementicon.jpg" height="19" width="29" title="School announcement "></a>
                                    <?php
									}
									?>
									</td>
									
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
				</tr>
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
