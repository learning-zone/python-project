<?php
session_start();	
include("../db1.php");
$stid=$_POST['stid'];
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$app_no=$_POST['app_no'];
$a_year=$_POST['a_year'];
$un=$_POST['un'];
$studfname=$_POST['studfname'];
?>
<html>
<head>
<script language="JavaScript">
	function printReport()
	{
		prn.style.display="none";
		window.print();
	}
	function sendMe()
	{
		document.frm.action='GenerateEXCELFile.php';
		document.frm.submit();
	}
</script>
</head>
<body>
<form name='frm' method='post' action='id_card1.php'>
<table border="1" width='100%' align='center'  colspan='2' cellspacing=0 cellpadding=1 bordercolor='black' >
	<tr>
		<?php
		$sqlt=mysql_query("select * from college");
		while($r=mysql_fetch_array($sqlt))
		{
			
			$col_name=$r[col_name];
			$col_code=$r[col_code];
			$col_addr=$r[col_addr];
			$col_pin=$r[col_pin];
			$col_phone=$r[col_phone];
			$col_fax=$r[col_fax];
			$email=$r[email];
		}
		while( list(,$Value) = each($stid) )
		{
			$r1=mysql_fetch_array(mysql_query("select * from student_m where id='$Value' "));

			if($r1[usn]!="")
				$p_textEnc = strtoupper(rawurlencode($r1[usn]));
			else
				$p_textEnc = strtoupper(rawurlencode($r1[student_id]));
			$p_charGap = 1;
			$dest = "wrapper.php?p_bcType=1&p_text=$p_textEnc" . 
							"&p_xDim=1&p_w2n=2&p_charGap=$p_charGap&p_invert='N'&p_charHeight=30" .
							"&p_type=1&p_label='Y'&p_rotAngle=0&p_checkDigit='Y'";		

			$name = $r1[first_name] . " " .  $r1[last_name];
			$date=explode("-",$r1[dob]);
			$date1=$date[2]."/".$date[1]."/".$date[0];
			$temp = $r1[addr];
			?>
			<td width='50%'>
				<table border="0" width='100%' bordercolor='black' background="../images/logo123.jpg">
					<tr><td  align='center' colspan='4'><font size='5' color='blue'><b><?php echo $col_name ?></b></font></td>
					</tr>
					<tr>
						<td  align='center' colspan='4'><font size='2'><b><?php echo $col_addr.' '.$col_pin; ?></b></font></td>
					</tr>
					<tr>
						<td colspan='4' align='center'><font size='2'><b>Tel- <?php echo $col_phone ?>, Email : <?php echo $email ?> </b></font></td>
					</tr>
					

					<tr>
					<td colspan='4'><hr color='black' size='0.5'></td>
					</tr>
					<tr>
            <td colspan='4' align='center'><font size='2'><b><u>STUDENT ID CARD</u></b></font></td>
					</tr>
					<tr>
					<td rowspan='4' align='center' width='20%'><img src="<?php echo $r1[img_source] ?>" width='100' height='90'></td>
						<td width='15%'><font size='1.7'><b>&nbsp;&nbsp;NAME</b></font></td>
						<td>:&nbsp;&nbsp;<font size='2'><b><?php echo $name ?></b></font></td>
					</tr>
					<tr>
						<td nowrap><font size='1.7'><b>&nbsp;&nbsp;STUDENT ID</b></font></td>
						<td>:&nbsp;&nbsp;<font size='2'><b><?php echo $r1[student_id] ?></b></font></td>
					</tr>
					<tr>
						<td><font size='1.7'><b>&nbsp;&nbsp;School Division</b></font></td>
						<?php
							$sql=mysql_fetch_array(mysql_query("select coursename from course_m where course_id='$r1[course_admitted]'"));
						?>
						<td>:&nbsp;&nbsp;<font size='2'><b><?php echo $sql[0] ?></b></font></td>
					</tr>
					<tr>
						<td><font size='1.7'><b>&nbsp;&nbsp;CLASS</b></font></td>
						<?php
							$sql22=mysql_fetch_array(mysql_query("select year_name from course_year where year_id='$r1[course_yearsem]'"));
						?>
						<td>:&nbsp;&nbsp;<font size='2'><b><?php echo $sql22[0] ?></b></font></td>
					</tr>
					
					<tr height='20' valign='bottom'>
						<td colspan='3'>&nbsp;</td>
						<td align='right' nowrap><font size='2'>Principal Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
					</tr>
				</table>
			</td>

			<td width='50%' valign='top'>
				<table border='0' bordercolor='black' width='100%'>
					<tr>
						<td align='left' colspan='2'>&nbsp;&nbsp;<font size='1.7'><b>DOB:</b></font> 
							<font size='2'><?php echo $date1 ?></font></td>
						<td align="left"><font size='1.7'><b>BLOOD GROUP :</b></font><font size='2'>&nbsp;&nbsp;<?php echo $r1[blood_group] ?></font></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='1.7'><b>ADDRESS :</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
				<tr>
						<td colspan='3' valign='top'>&nbsp;&nbsp;<font size='2'><?php echo $r1[per_address]?></font><br>
						<font size='2'>&nbsp;&nbsp;<?php echo $r1[state] ?>-<?php echo $r1[pin] ?></font></td>
					</tr>
					<tr height='6'>
						<td colspan='3'></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='1.7'><b>PHONE :</b></font>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
						<font size='2'><?php echo $r1[per_phone] ?></font></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='1.7'><b>E_MAIL :</b></font>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
						<font size='2'><?php echo $r1[img_source_s] ?></font></td>
					</tr>
					<tr height='70' valign='bottom'>
					<td colspan='2' align='left' valign='bottom'>			
						<IMG SRC="<?php echo $dest;?>" ALT="<? echo strtoupper($r1[student_id]); ?>"></td>
						<td align='right' nowrap><font size='2'>Student Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
					</tr>
					
				</table>
			</td>
		</tr>
		<tr height='25'><td colspan='2'>&nbsp;</td></tr>
	<?php
		}
	?>
</table><br>
	<!-- <input type='button' name='button' value='Export To File' onclick='sendMe()'> -->
	<div id="prn" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="printReport()" style='font-weight: bold; background-color: #86BAF9; color: #000080; border-style: solid; border-width: 1'></div>
</form>
</body>
</html>

<html>
<head>
<script language="JavaScript">
	function printReport()
	{
		prn.style.display="none";
		window.print();
	}
	function sendMe()
	{
		document.frm.action='GenerateEXCELFile.php';
		document.frm.submit();
	}
</script>
</head>
<body>
<form name='frm' method='post' action='../student_det/id_card2.php'>

</form>
</body>
</html>