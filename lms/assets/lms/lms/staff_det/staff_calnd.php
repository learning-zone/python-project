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

  document.frm.action='staff_calnd.php';

  document.frm.submit();

}

</script>

</head>

<body>



<form name='frm' method='post' action=''>

<input type='hidden' name='day' value='<?php echo $day?>'>

<input type='hidden' name='yer' value='<?php echo $yr?>'>

<link rel="stylesheet" type="text/css" href="css/tab.css" />
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">

<div class="tabContainer">

<ul class="tabHead">

<li><a href="leavesetup.php?tab=1" >Leave Setup</a></li>

<li><a href="leavestaffsetup.php?tab=2" >Staff Leave Detail</a></li>

<li class="currentBtn"><a href="staff_calnd.php?tab=3" >Staff Calendar</a></li>

<li><a href="staff_time.php?tab=4" >Staff Timing</a></li>
<li><a href="att_point.php?tab=5" >Attendance Point</a></li>
<li><a href="leave_paid_count.php?tab=7" >Paid Leave Update</a>
</li>
<li><a href="leave_acc.php?tab=8">Staff Year Setup</a></li>

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

								   			$newbgcolor='class="clsna"';	

								   			else

								   		 	$newbgcolor='class="colrs"';																					

								   ?>

									<td  <?php echo $newbgcolor; ?> height='75' vAlign="center" width='75'><font color="#FF0000">

									<div Align="center" ></div></font>

									<div Align="center" >

                                    <a href="javascript:void(0);" onClick ="OpenWind2('staff_calnd123.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>','OpenWind2',500,400)"><font color="#FF0000"><?php echo $i?>

									 </font></a></div><br>	

									<?php

								$newdateval="$yr-$mont-$i";

								//echo "select * from staff_calenders where status='1' and fromdate='$newdateval'";

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval'");



								while($sqlnew21=fetcharray($sqlnew12))



								{



								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));



							echo "<br><div Align='left'  style='font-size:11;color:#004000'>$batch1[name] : $sqlnew21[title]</div>";

								



								}

								echo "</td>";



							   }

							   if($das[0]=='Mon')

							   							   {

										$bdate="$yr-$mont-$i";

										if($todayDate==$bdate)



								   			$newbgcolor='class="clsna"';																							              								else



								   		 	$newbgcolor='class="colrs"';

																		

								   ?>

									<td>&nbsp;</td><td <?php echo $newbgcolor; ?> height='75' vAlign="center" width='75' nowrap>

									<div Align="center" ></div>

									<div Align="center">

									<a href="javascript:void(0);" onClick ="OpenWind2('staff_calnd123.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',500,400)"><?php echo $i?></a> 

									</div> <br>									

                          									<?php								

                                

								$newdateval="$yr-$mont-$i";

								//echo "select * from staff_calenders where status='1' and fromdate='$newdateval'";

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval'");



								while($sqlnew21=fetcharray($sqlnew12))



								{



								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));



							echo "<br><div Align='left'  style='font-size:11;color:#004000'>$batch1[name] : $sqlnew21[title]</div>";

								



								}		

									?>

									</td>

									<?php									

							   }

							   if($das[0]=='Tue')

							   {



										$bdate="$yr-$mont-$i";



										if($todayDate==$bdate)

											$newbgcolor='class="clsna"';	

								   			else

								   		 	$newbgcolor='class="colrs"';													

								   ?>

									<td>&nbsp;</td><td>&nbsp;</td>



									<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">

									<div Align="center" ></div>

									<div Align="center" >



									<a href="javascript:void(0);" onClick ="OpenWind2('staff_calnd123.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',500,400)"><?php echo $i?></a> 

									</div> 	<br>

									<?php

								$newdateval="$yr-$mont-$i";

								//echo "select * from staff_calenders where status='1' and fromdate='$newdateval'";

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval'");



								while($sqlnew21=fetcharray($sqlnew12))



								{



								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));



							echo "<br><div Align='left'  style='font-size:11;color:#004000'>$batch1[name] : $sqlnew21[title]</div>";

								



								}



									?>

									</td>

									<?php

									

							   }

							   if($das[0]=='Wed')

							   {

										 $bdate="$yr-$mont-$i";

										if($todayDate==$bdate)

								   			$newbgcolor='class="clsna"';	

								   			else

								   		 	$newbgcolor='class="colrs"';



											

								   ?>

									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>

									<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">

									<div Align="center" ></div>

									<div Align="center" >

									<a href="javascript:void(0);" onClick ="OpenWind2('staff_calnd123.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',500,400)"><?php echo $i?></a>

									</div>  <br>									

									<?php

							$newdateval="$yr-$mont-$i";

								//echo "select * from staff_calenders where status='1' and fromdate='$newdateval'";

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval'");



								while($sqlnew21=fetcharray($sqlnew12))



								{



								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));



							echo "<br><div Align='left'  style='font-size:11;color:#004000'>$batch1[name] : $sqlnew21[title]</div>";

								



								}

								echo "</td>";

							   }

								if($das[0]=='Thu')

							   {

										$bdate="$yr-$mont-$i";

										if($todayDate==$bdate)

								   			$newbgcolor='class="clsna"';	

								   			else

								   		 	$newbgcolor='class="colrs"';

																						



								   ?>

									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>

									<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">

									<div Align="center" ></div>

									<div Align="center" >

									<a href="javascript:void(0);" onClick ="OpenWind2('staff_calnd123.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',500,400)"><?php echo $i?></a>

									</div>  <br>									

									<?php

								$newdateval="$yr-$mont-$i";

								//echo "select * from staff_calenders where status='1' and fromdate='$newdateval'";

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval'");



								while($sqlnew21=fetcharray($sqlnew12))



								{



								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));



							echo "<br><div Align='left'  style='font-size:11;color:#004000'>$batch1[name] : $sqlnew21[title]</div>";

								



								}

								echo "</td>";

							   }

							 if($das[0]=='Fri')

							   {

										$bdate="$yr-$mont-$i";

										if($todayDate==$bdate)

								   		$newbgcolor='class="clsna"';	

								   			else

								   		 	$newbgcolor='class="colrs"';

											



										

								   ?>

									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>

									<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">

									<div Align="center" ></div>

									<div Align="center" >

									<a href="javascript:void(0);" onClick ="OpenWind2('staff_calnd123.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',500,400)"><?php echo $i?></a> 

									</div> 	<br>								

									<?php

								$newdateval="$yr-$mont-$i";

								//echo "select * from staff_calenders where status='1' and fromdate='$newdateval'";

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval'");



								while($sqlnew21=fetcharray($sqlnew12))



								{



								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));



							echo "<br><div Align='left'  style='font-size:11;color:#004000'>$batch1[name] : $sqlnew21[title]</div>";

								



								}

								echo "</td>";

							   }

								if($das[0]=='Sat')

							   {

										$bdate="$yr-$mont-$i";

										if($todayDate==$bdate)

								   			$newbgcolor='class="clsna"';	

								   			else

								   		 	$newbgcolor='class="colrs"';

																					

								   

								   ?>

									<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>

									<td  <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81">

									<div Align="center" ></div>

									<div Align="center" >

									<a href="javascript:void(0);" onClick ="OpenWind2('staff_calnd123.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',500,400)"><?php echo $i?></a> </div> <br>

									<?php



$newdateval="$yr-$mont-$i";

								//echo "select * from staff_calenders where status='1' and fromdate='$newdateval'";

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval'");



								while($sqlnew21=fetcharray($sqlnew12))



								{



								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));



							echo "<br><div Align='left'  style='font-size:11;color:#004000'>$batch1[name] : $sqlnew21[title]</div>";

								



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

								   	$newbgcolor='class="clsna"';	

								   			else

								   		 	$newbgcolor='class="colrs"';

										

																					

							   ?>

								<td <?php echo $newbgcolor; ?> height='75' vAlign="center" width="81"><font color="<?php echo $bgcolor; ?>">

								<div Align="center" ></div>

								</font>&nbsp;&nbsp;&nbsp;&nbsp;<div Align="center" >

								<a href="javascript:void(0);" onClick ="OpenWind2('staff_calnd123.php?mon=<?php echo $mont?>&yer=<?php echo $yr?>&day=<?php echo $i?>', 'OpenWind2',500,400)"><font color="<?php echo $bgcolor; ?>"><?php echo $i?></font></a></div>

								<br>

								<?php

                                $newdateval="$yr-$mont-$i";

								//echo "select * from staff_calenders where status='1' and fromdate='$newdateval'";

								$sqlnew12=execute("select * from staff_calenders where status='1' and fromdate='$newdateval'");



								while($sqlnew21=fetcharray($sqlnew12))



								{



								$batch1=fetcharray(execute("select * from staff_group where id='$sqlnew21[staff_typ]'"));



							echo "<br><div Align='left'  style='font-size:11;color:#004000'>$batch1[name] : $sqlnew21[title]</div>";

								



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

