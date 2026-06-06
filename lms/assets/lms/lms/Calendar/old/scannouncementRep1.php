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
  document.frm.action='scannouncementRep1.php';
  document.frm.submit();
}


</script>

</head>
<body>

<FORM NAME='frm' METHOD=POST >

<table align="center" border="1" cellSpacing="0" width="100%" height="315"  >
<tr height="14" >
	   <td colSpan="7"  align="center" class='headc2'>
	   School Announcements  </td>
</tr>
<tr height="14" >
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
<tr height="14">
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td  <?php echo $newbgcolor; ?> align="center"  height="" vAlign="center" >
                                    
									<?php echo $i?>
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    <?php  $countapp;?>  
                                    <img src="../images/announcementicon.jpg" height="19" width="19"   border="0"></a>
                                    </td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td>&nbsp;</td><td <?php echo $newbgcolor; ?> height="" vAlign="center"  align="center"><b>
									<div Align="center" ></div>
									<div Align="center" >
									<?php echo $i?> 
									</div> </b>									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    <?php  $countapp;?>  
                                    <img src="../images/announcementicon.jpg" height="19" width="19"   border="0"></a>
                                    </td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td <?php echo $newbgcolor; ?> height="" vAlign="center" width="" align="center">
                                    <?php echo $i?>
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><?php  $countapp;?>  
                                    <img src="../images/announcementicon.jpg" height="19" width="19"   border="0"></a>
                                    </td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td align="center" <?php echo $newbgcolor; ?> height="" vAlign="center" width="">
									<?php echo $i?>
								<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    <?php  $countapp;?>  
                                    <img src="../images/announcementicon.jpg" height="19" width="19"   border="0"></a>
                                    </td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td <?php echo $newbgcolor; ?> height="" vAlign="center" width="" align="center"><?php echo $i?>
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?><BR>
									<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><?php  $countapp;?>  
                                    <img src="../images/announcementicon.jpg" height="19" width="19"   border="0"></a>
                                    </td>
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

												$sql3=mysql_query("SELECT id  FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td <?php echo $newbgcolor; ?> height="" vAlign="center" width="" align="center"><b>
									<?php echo $i?> 
									
									<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
									?>
									<br>
                                    <a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, addressbar=no, scrollbars=yes, height=400, width=600'); return false">
                                    <?php  $countapp;?>  
                                    <img src="../images/announcementicon.jpg" height="19" width="19"   border="0"></a>
                                    </td>
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
												$sql3=mysql_query("SELECT id  FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
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
									<td  <?php echo $newbgcolor; ?> height="" vAlign="center" width="" align="center">
                                    <?php echo $i?>
                                    														
																										<?php
								if($avail=="Yes")
								{
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where  ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
								
									?>
									<div Align="center" >
                                    <?php
									if($countapp!=0)
									{
									?><BR>
<a href="javascript:void(0)" onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                    <?php  $countapp;?>  
                                    <img src="../images/announcementicon.jpg" height="19" width="19"   border="0"></a>
                                    
                                    <?php
									}
									?>
                                	</td>
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
										
												$sql3=mysql_query("SELECT id  FROM `announcement` where  (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate'))");
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
								$getcountappointments=mysql_query("SELECT count(id) FROM `announcement` where   (('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate') )");
								$count=mysql_fetch_row($getcountappointments);
								$countapp=$count[0];
								
									?>
									 <?php
									if($countapp!=0)
									{
										
									?>
                                    <a href="javascript:void(0)" onMouseOver="poponload1()"  onClick="window.open('viewannouncement.php?mon=<?php echo $mont?>&sem=<?php echo $sem?>&yer=<?php echo $yr?>&day=<?php echo $i?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
                                     <?php  $countapp;?>  <img src="../images/announcementicon.jpg" height="19" width="19" border="0"></a>
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
