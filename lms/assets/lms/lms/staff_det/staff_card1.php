<html>
<?php
session_start();	
include("../db2.php");
?>
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
<form name='frm' method='post' action='staff_card1.php'>
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
		$sqlt=mysql_fetch_array(mysql_query("select City from company"));
		$col_city=$sqlt[0];
		while( list(,$Value) = each($stid) )
		{
			$r1=mysql_fetch_array(mysql_query("select id,slno,f_name,s_name,subj,type_id,bg,dob,addr_pres,ct_pres,pin_pres,st_pres,mobileno,email,img_col  from staff_det where id='$Value' "));

			$p_textEnc = strtoupper(rawurlencode($r1[slno]));
			$p_charGap = 1;
			$dest = "wrapper.php?p_bcType=1&p_text=$p_textEnc" . 
							"&p_xDim=1&p_w2n=2&p_charGap=$p_charGap&p_invert='N'&p_charHeight=30" .
							"&p_type=1&p_label='Y'&p_rotAngle=0&p_checkDigit='Y'";		

			$name = $r1[f_name] . " " .  $r1[s_name];
			$date=explode("-",$r1[dob]);
			$date1=$date[2]."/".$date[1]."/".$date[0];
			$temp = $r1[addr_pres];
		
			?>
            
			<td width='50%'>
				<table border="0" width='100%' bordercolor='black' background="../images/logo123.jpg">
					<tr><td  align='center' colspan='4'><font size='5' color='blue'><b><?php echo $col_name ?></b></font></td>
					</tr>
					<tr>
						<td  align='center' colspan='4'><font size='2'><b><?php echo $col_addr; ?></b></font></td>
					</tr>
					<tr>
						<td  align='center' colspan='4'><font size='2'><b><?php echo $col_city.' - '.$col_pin; ?></b></font></td>
					</tr>
					<tr>
						<td colspan='4' align='center'><font size='2'><b>Tel- <?php echo $col_phone ?>, Email : <?php echo $email ?> </b></font></td>
					</tr>
					

					<tr>
					<td colspan='4'><hr color='black' size='0.5'></td>
					</tr>
					<tr>
            <td colspan='4' align='center'><font size='2'><b><u>STAFF ID CARD</u></b></font></td>
					</tr>
					<tr>
					<td rowspan='4' align='center' width='20%'><img src="<?php echo $r1[img_col] ?>" width='100' height='90'></td>
						<td width='15%' nowrap><font size='1.7'><b>&nbsp;&nbsp;STAFF NAME</b></font></td>
						<td>:&nbsp;&nbsp;<font size='2'><b><?php echo $name ?></b></font></td>
					</tr>
					<tr>
						<td nowrap><font size='1.7'><b>&nbsp;&nbsp;STAFF ID</b></font></td>
						<td>:&nbsp;&nbsp;<font size='2'><b><?php echo $r1[slno] ?></b></font></td>
					</tr>
					<tr>
						<td><font size='1.7'><b>&nbsp;&nbsp;DEPT</b></font></td>
						<?php
							$sql=mysql_fetch_array(mysql_query("select dept_code from dept_no where dpt_id='$r1[subj]'"));
						?>
						<td>:&nbsp;&nbsp;<font size='2'><b><?php echo $sql[0] ?></b></font></td>
					</tr>
					<tr>
						<td><font size='1.7'><b>&nbsp;&nbsp;DESIG</b></font></td>
						<?php
							$sql1=mysql_fetch_array(mysql_query("select d_name from staff_des where d_id='$r1[type_id]'"));
						?>
						<td>:&nbsp;&nbsp;<font size='2'><b><?php echo $sql1[0] ?></b></font></td>
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
						<td align="left"><font size='1.7'><b>BLOOD GROUP :</b></font><font size='2'>&nbsp;&nbsp;<?php echo $r1[bg] ?></font></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='1.7'><b>ADDRESS :</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
				<tr>
						<td colspan='3' valign='top'>&nbsp;&nbsp;<font size='2'><?php echo $temp ?></font><br>
						<font size='2'>&nbsp;&nbsp;<?php echo $r1[ct_pres] ?>, <?php echo $r1[st_pres] ?> - <?php echo $r1[pin_pres] ?></font></td>
					</tr>
					<tr height='6'>
						<td colspan='3'></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='1.7'><b>PHONE :</b></font>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
						<font size='2'><?php echo $r1[mobileno] ?></font></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='1.7'><b>E_MAIL :</b></font>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
						<font size='2'><?php echo $r1[email] ?></font></td>
					</tr>
					<tr height='70' valign='bottom'>
					<td colspan='3' align='center' valign='bottom'>			
						<IMG SRC="<?php echo $dest;?>" ALT="<? echo strtoupper($r1[student_id]); ?>"></td></tr>
						<tr height='30' valign='bottom'>
					<td colspan='3' align='right' valign='bottom' nowrap>		
						<font size='2'>Staff Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
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