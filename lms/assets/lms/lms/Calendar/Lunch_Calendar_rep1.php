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
  document.frm.action='Lunch_Calendar_rep.php';
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
	   <td colSpan="7" align="center" class='head'><strong>Calendar</strong></td>
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
<td></td><td></td><td></td><td></td>
</tr>
                    <tr class="keyrow">
					<td class="row3" height="16" width="150" bgcolor="red" align="center"><font size="2" ><b>Sun</b></font></td>
					<td class="row3"  height="16" width="150" bgcolor="#ADAAF2" align="center"><font size="2"><b>Mon</b></font></td>
					<td class="row3"  height="16" width="150" bgcolor="#ADAAF2" align="center"><font size="2"><b>Tue</b></font></td>
					<td class="row3"  height="16" width="150" bgcolor="#ADAAF2" align="center"><font size="2"><b>Wed</b></font></td>
					<td class="row3"  height="16" width="150" bgcolor="#ADAAF2" align="center"><font size="2"><b>Thu</b></font></td>
					<td  class="row3" height="16" width="150" bgcolor="#ADAAF2" align="center"><font size="2"><b>Fri</b></font></td>
					<td  class="row3" height="16" width="150" bgcolor="#ADAAF2" align="center"><font size="2"><b>Sat</b></font></td>
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
																		
									?>
									<td align="center"  <?php echo $newbgcolor; ?> height="165" vAlign="top" width="150">
									<b>
									<font color="#FF0000">
									<?php echo $i?>
									</font>
                                    </b>									
									<br>
									<?php
									$new=fetcharray(execute("select Breakfast_Menu, Lunch_Menu from `lunch_menu_master` where `menu_date`='$bdate'"));
									if($new[0])
									{
										echo "<font color='#003300'><b>Breakfast Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[0]</font><br>
										<font color='#003300'><b>Lunch Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[1]</font>";
									}
									?>
									</td>
									<?php
									
							   }
							   if($das[0]=='Mon')
							   {
										$bdate="$yr-$mont-$i";
										if($todayDate==$bdate)
								   			$newbgcolor='class="headc"';
										else
								   		 	$newbgcolor='';
																						
								   ?>									
                                   <td>&nbsp;</td>
                                   <td align="center"  <?php echo $newbgcolor; ?> height="165" vAlign="top" width="150">
                                    <b>
                                    <?php echo $i?>
									</b>
                                    <br>									
									<?php
								$new=fetcharray(execute("select Breakfast_Menu, Lunch_Menu from `lunch_menu_master` where `menu_date`='$bdate'"));
								if($new[0])
								{
									echo "<font color='#003300'><b>Breakfast Menu : </b></font>
									<font style='font-size:12px' color='#003300'>$new[0]</font><br>
									 <font color='#003300'><b>Lunch Menu : </b></font>
									 <font style='font-size:12px' color='#003300'>$new[1]</font>";
								}
									?>
                                    </td>
							   <?php
                               }
								if($das[0]=='Tue')
								{
									$bdate="$yr-$mont-$i";
									if($todayDate==$bdate)
									$newbgcolor='class="headc"';
									else
									$newbgcolor='';
									
																				
									?>
									<td>&nbsp;</td><td>&nbsp;</td>
									<td align="center"  <?php echo $newbgcolor; ?> height="165" vAlign="top" width="150">
									<b>
									<?php echo $i?>
									</b>
                                    <br>									
									<?php
									$new=fetcharray(execute("select Breakfast_Menu, Lunch_Menu from `lunch_menu_master` where `menu_date`='$bdate'"));
									if($new[0])
									{
										echo "<font color='#003300'><b>Breakfast Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[0]</font><br>
										<font color='#003300'><b>Lunch Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[1]</font>";
									}
									?>
									</td>
									<?php
								}
								
								if($das[0]=='Wed')
								{
									$bdate="$yr-$mont-$i";
									if($todayDate==$bdate)
									$newbgcolor='class="headc"';
									else
									$newbgcolor='';
																				
									?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td align="center"  <?php echo $newbgcolor; ?> height="165" vAlign="top" width="150">
									<b>
									<?php echo $i?>
									</b>
                                    <br>									
									<?php
									$new=fetcharray(execute("select Breakfast_Menu, Lunch_Menu from `lunch_menu_master` where `menu_date`='$bdate'"));
									if($new[0])
									{
										echo "<font color='#003300'><b>Breakfast Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[0]</font><br>
										<font color='#003300'><b>Lunch Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[1]</font>";
									}
									?>
									</td>
									<?php
								}
								
								if($das[0]=='Thu')
								{
									$bdate="$yr-$mont-$i";
									if($todayDate==$bdate)
									$newbgcolor='class="headc"';
									else
									$newbgcolor='';
									
									?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td align="center"  <?php echo $newbgcolor; ?> height="165" vAlign="top" width="150">
									<b>
									<?php echo $i?>
									</b>
                                    <br>									
									<?php
									$new=fetcharray(execute("select Breakfast_Menu, Lunch_Menu from `lunch_menu_master` where `menu_date`='$bdate'"));
									if($new[0])
									{
										echo "<font color='#003300'><b>Breakfast Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[0]</font><br>
										<font color='#003300'><b>Lunch Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[1]</font>";
									}
									?>
									</td>
									<?php
								}
								if($das[0]=='Fri')
								{
									$bdate="$yr-$mont-$i";
									if($todayDate==$bdate)
									$newbgcolor='class="headc"';
									else
									$newbgcolor='';
									
									?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td align="center"  <?php echo $newbgcolor; ?> height="165" vAlign="top" width="150">
									<b>
									<?php echo $i?>
									</b>	
                                    <br>								
									<?php
									$new=fetcharray(execute("select Breakfast_Menu, Lunch_Menu from `lunch_menu_master` where `menu_date`='$bdate'"));
									if($new[0])
									{
										echo "<font color='#003300'><b>Breakfast Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[0]</font><br>
										<font color='#003300'><b>Lunch Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[1]</font>";
									}
									?>
									</td>
									<?php
								}

								if($das[0]=='Sat')
								{
									$bdate="$yr-$mont-$i";
									if($todayDate==$bdate)
									$newbgcolor='class="headc"';
									else
									$newbgcolor='';
											
									
									?>
									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									<td align="center"  <?php echo $newbgcolor; ?> height="165" vAlign="top" width="150">
									<b>
									<?php echo $i?>
									</b>	
                                    <br>								
									<?php
									$new=fetcharray(execute("select Breakfast_Menu, Lunch_Menu from `lunch_menu_master` where `menu_date`='$bdate'"));
									if($new[0])
									{
										echo "<font color='#003300'><b>Breakfast Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[0]</font><br>
										<font color='#003300'><b>Lunch Menu : </b></font>
										<font style='font-size:12px' color='#003300'>$new[1]</font>";
									}
									?>
									</td>
									<?php
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
										
																						
							   ?>
								<td <?php echo $newbgcolor; ?> height="165" vAlign="top" width="81">
                                <div Align="center" >
                                    <font color="<?php echo $bgcolor; ?>">
                                    <?php echo $i?>
                                    </font>
                                </div>
                                
								<?php
								$new=fetcharray(execute("select Breakfast_Menu, Lunch_Menu from `lunch_menu_master` where `menu_date`='$bdate'"));
								if($new[0])
								{
									echo "<font color='#003300'><b>Breakfast Menu : </b></font>
									<font style='font-size:12px' color='#003300'>$new[0]</font><br>
									 <font color='#003300'><b>Lunch Menu : </b></font>
									 <font style='font-size:12px' color='#003300'>$new[1]</font>";
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
