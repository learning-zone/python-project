<html>&nbsp;
<?php
	 session_start();
     include("db.php");
	 $yr=date('Y');
	 $mont=date('m');
$runq = execute("select * from event_detail where month(event_start)='$mont' and year(event_start)=$yr");
while($runq_r = mysql_fetch_array($runq))
{
$test =execute("SELECT event_start,event_end,(To_days(event_end) - TO_DAYS( event_start)) as d_dif from event_detail where id='$runq_r[id]'") or die(mysql_error());
	 $test_r = mysql_fetch_array($test);
	 for($q=0;$q<=$test_r[d_dif];$q++)
	 {
		$dd1 = explode("-",$test_r[event_start]);
		$get_dates= date("Y-m-d",mktime(0,0,0,$mont,$dd1[2]+$q,$yr));
		$date_array[] = $get_dates;
	 }
	 
}	 
	 function checkMe($var,$ch_date)
     { 
		 foreach($ch_date as $dd)
		 {
			if($var==$dd)
			 {
				$dt_color = 1;
				return $dt_color;
			 }
			
			else
			 {
				$dt_color =0;
			 }
		 }
	 }
?>&nbsp;
<head>&nbsp;
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">&nbsp;
<title>&nbsp;View Events Calendar</title>&nbsp;
</head>&nbsp;
<body>&nbsp;
<form name='frm' method='post' action='content_det.php'>&nbsp;
<input type='hidden' name='day' value='<?php echo $day?>&nbsp;'>&nbsp;
<input type='hidden' name='mont' value='<?php echo $mont?>&nbsp;'>&nbsp;
<input type='hidden' name='yr' value='<?php echo $yr?>&nbsp;'>&nbsp;
<table align="center" border="1" cellSpacing="0" >&nbsp;
<tr>&nbsp;
	   <td colSpan="7" bgcolor="#008000" align="center" class=head>&nbsp;
	   &nbsp;Calendar</td>&nbsp;
</tr>&nbsp;
<tr>&nbsp;
<td>&nbsp;Month&nbsp;</td>&nbsp;
<td>&nbsp;<?php echo MonthName($mont)?>&nbsp;</td>&nbsp;
<td>&nbsp;</td>&nbsp;<td>&nbsp;</td>&nbsp;<td>&nbsp;</td>&nbsp;<td>&nbsp;</td>&nbsp;<td>&nbsp;</td>&nbsp;
</tr>&nbsp;
<tr>&nbsp;
<td>&nbsp;Year&nbsp;</td>&nbsp;
<td>&nbsp;<?php echo $yr?>&nbsp;</td>&nbsp;
<td>&nbsp;</td>&nbsp;<td>&nbsp;</td>&nbsp;<td>&nbsp;</td>&nbsp;<td>&nbsp;</td>&nbsp;<td>&nbsp;</td>&nbsp;
</tr>&nbsp;
<tr class="keyrow">&nbsp;
	<td height="16" width="70">&nbsp;&nbsp;&nbsp;Sun&nbsp;&nbsp;</td>&nbsp;
	<td height="16" width="70">&nbsp;&nbsp;&nbsp;Mon&nbsp;&nbsp;</td>&nbsp;
	<td height="16" width="70">&nbsp;&nbsp;&nbsp;Tue&nbsp;&nbsp;</td>&nbsp;
	<td height="16" width="70">&nbsp;&nbsp;&nbsp;Wed&nbsp;&nbsp;</td>&nbsp;
	<td height="16" width="70">&nbsp;&nbsp;&nbsp;Thu&nbsp;&nbsp;</td>&nbsp;
	<td height="16" width="70">&nbsp;&nbsp;&nbsp;Fri&nbsp;&nbsp;</td>&nbsp;
	<td height="16" width="70">&nbsp;&nbsp;&nbsp;Sat&nbsp;&nbsp;</td>&nbsp;
</tr>&nbsp;
<tr>&nbsp;
<?php
$r=cal_days_in_month(CAL_GREGORIAN,$mont,$yr);
for($i=1;$i<=$r;$i++)
{ 
	$eve_col='';
	$eve_on='';
	if($i<10)
	{
	   $i='0'.$i;
	}
	$dt=$yr."-".$mont."-".$i;
	$da='';
	$fg='';
	$fg=$yr."-".$mont."-".$i;
	$da=date('D-m-Y',strtotime($fg));
	$das=explode("-",$da);
	
	$em=execute("select * from event_detail where event_start between '$fg' and '$fg' || event_end between '$fg' and '$fg' ");
	
    $em_cnt=rowcount($em);
	
	if($i==1)
	{ 
		if($das[0]=='Sun')
			{
			$emm=fetcharray($em);
			$eve_col=$emm[event_color];
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
			?>&nbsp;
			<?php
			$checked = checkMe($dt,$date_array);
            
			if($checked==1)
			{
				echo "<td height='56' vAlign='top' width='95' style='background-color:#AAFAE3'>&nbsp;";
			}
			else
			{
				echo "<td height='56' vAlign='top' width='95' >&nbsp;";
			}
			?>&nbsp;
			&nbsp;<?php echo $i?>&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			while($emm=fetcharray($em))
			{
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
				//echo $eve_srt;
			?>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
    	     }
		}
			?>&nbsp;
					</td>&nbsp;
<?php
		if($das[0]=='Mon')
		{
			$emm=fetcharray($em);
			$eve_col=$emm[event_color];
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
			?>&nbsp;
			<td>&nbsp;&nbsp;</td>&nbsp;
			<?php
			$checked = checkMe($dt,$date_array);
            
			if($checked==1)
			{
				echo "<td height='56' vAlign='top' width='95' style='background-color:#AAFAE3'>&nbsp;";
			}
			else
			{
				echo "<td height='56' vAlign='top' width='95' >&nbsp;";
			}
			?>&nbsp;
			&nbsp;<?php echo $i?>&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			while($emm=fetcharray($em))
			{
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
				//echo $eve_srt;
			?>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			}
			echo "</td>&nbsp;";
		}
		if($das[0]=='Tue')
		{
			$emm=fetcharray($em);
			$eve_col=$emm[event_color];
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
			?>&nbsp;
			<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;
			<?php
			$checked = checkMe($dt,$date_array);
            
			if($checked==1)
			{
				echo "<td height='56' vAlign='top' width='95' style='background-color:#AAFAE3'>&nbsp;";
			}
			else
			{
				echo "<td height='56' vAlign='top' width='95' >&nbsp;";
			}
			?>&nbsp;
			&nbsp;<?php echo $i?>&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			while($emm=fetcharray($em))
			{
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
				//echo $eve_srt;
			?>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			}
			echo "</td>&nbsp;";
		}
		if($das[0]=='Wed')
		{
			$emm=fetcharray($em);
			$eve_col=$emm[event_color];
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
			?>&nbsp;
			<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;
			<?php
			$checked = checkMe($dt,$date_array);
            
			if($checked==1)
			{
				echo "<td height='56' vAlign='top' width='95' style='background-color:#AAFAE3'>&nbsp;";
			}
			else
			{
				echo "<td height='56' vAlign='top' width='95' >&nbsp;";
			}
			?>&nbsp;
			&nbsp;<?php echo $i?>&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			while($emm=fetcharray($em))
			{
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
				//echo $eve_srt;
			?>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			}
			echo "</td>&nbsp;";
		}
		if($das[0]=='Thu')
		{
			$emm=fetcharray($em);
			$eve_col=$emm[event_color];
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
			?>&nbsp;
			<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;
			<?php
			$checked = checkMe($dt,$date_array);
            
			if($checked==1)
			{
				echo "<td height='56' vAlign='top' width='95' style='background-color:#AAFAE3'>&nbsp;";
			}
			else
			{
				echo "<td height='56' vAlign='top' width='95' >&nbsp;";
			}
			?>&nbsp;
			&nbsp;<?php echo $i?>&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			while($emm=fetcharray($em))
			{
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
				//echo $eve_srt;
			?>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			}
			echo "</td>&nbsp;";
		}
		if($das[0]=='Fri')
		{
			$emm=fetcharray($em);
			$eve_col=$emm[event_color];
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
			?>&nbsp;
			<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;
			<?php
			$checked = checkMe($dt,$date_array);
            
			if($checked==1)
			{
				echo "<td height='56' vAlign='top' width='95' style='background-color:#AAFAE3'>&nbsp;";
			}
			else
			{
				echo "<td height='56' vAlign='top' width='95' >&nbsp;";
			}
			?>&nbsp;
			&nbsp;<?php echo $i?>&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			while($emm=fetcharray($em))
			{
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
				//echo $eve_srt;
			?>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			}
			echo "</td>&nbsp;";
		}
		if($das[0]=='Sat')
		{
			$emm=fetcharray($em);
			$eve_col=$emm[event_color];
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
			?>&nbsp;
			<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;<td>&nbsp;&nbsp;</td>&nbsp;
			<?php
			$checked = checkMe($dt,$date_array);
            
			if($checked==1)
			{
				echo "<td height='56' vAlign='top' width='95' style='background-color:#AAFAE3'>&nbsp;";
			}
			else
			{
				echo "<td height='56' vAlign='top' width='95' >&nbsp;";
			}
			?>&nbsp;
			&nbsp;<?php echo $i?>&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			while($emm=fetcharray($em))
			{
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
				//echo $eve_srt;
			?>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			}
			echo "</td>&nbsp;";
		}

	}

	else
	{
		if($das[0]=='Sun')
			{
				?>&nbsp;<tr>&nbsp;<?php
			}
			$emm=fetcharray($em);
			$eve_col=$emm[event_color];
			$eve_on=$emm[event_on];
			$eve_srt=$emm[event_start];
			?>&nbsp;
			<?php
			$checked = checkMe($dt,$date_array);
            
			if($checked==1)
			{
				echo "<td height='56' vAlign='top' width='95' style='background-color:#AAFAE3'>&nbsp;";
			}
			else
			{
				echo "<td height='56' vAlign='top' width='95' >&nbsp;";
			}
			?>&nbsp;
			&nbsp;<?php echo $i?>&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			while($emm=fetcharray($em))
			{
				$eve_on=$emm[event_on];
				$eve_srt=$emm[event_start];
				//echo $eve_srt;
			?>&nbsp;
			<a href="evente.php?mon=<?php echo $mont?>&nbsp;&yer=<?php echo $yr?>&nbsp;&day=<?php echo $i?>&nbsp;&p=<?php echo $eve_on?>&nbsp;" title="<?php echo "Event Starts: ".$emm[event_start]."---"."Event Ends: ".$emm[event_end];?>&nbsp;">&nbsp;&nbsp;<?php echo $eve_on?>&nbsp;</a>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;
			<?php
			}
			echo "</td>&nbsp;";
	} 
}
?>&nbsp;
<td>&nbsp;</td>&nbsp;<td>&nbsp;</td>&nbsp;<td>&nbsp;</td>&nbsp;
</table>&nbsp;
</form>&nbsp;
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
?>&nbsp;
</table>&nbsp;

</body>&nbsp;

</html>&nbsp;