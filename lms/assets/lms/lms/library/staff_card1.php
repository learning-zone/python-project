<html>
<?php
	session_start();	
	$con  = mysql_pconnect("localhost","root","")
			or die("<b>Cannot open connection to database</b>.");
			mysql_select_db("rnsit")
			or die("<b>could not select database</b>.");

	require("core.php");
	$sql.="select id,slno,f_name,s_name,subj,type_id,bg,dob,addr_perm as addr,st_perm as state,pin_perm as pin,ph_perm as phone,email,img_col as image from staff_det where id is not null and active='YES'";
	if($app_no!='')
	{
	 $sql.=" and slno='$app_no'";
	}
	if($branch!=0)
	{
	$sql.=" and subj=$branch";
	}
	if($studfname!='')
	{
	 $sql.=" and f_name='$studfname'";
	}
	$rs=execute($sql) or die(mysql_error());
	$num = rowcount($rs);
	if($num==0)
	{
		echo "<font color=brown><b>No Records Found !!</b></font>";
		die();
	}
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
<table border="1" width='100%' align='center'  colspan='2' cellspacing=0 cellpadding=1 bordercolor='black'>
	<tr>
		<?php
		for($i=1;$i<=$num;$i++)
		{
			$r1=fetcharray($rs);

			$p_textEnc = strtoupper(rawurlencode($r1[slno]));
			$p_charGap = 1;
			$dest = "wrapper.php?p_bcType=1&p_text=$p_textEnc" . 
							"&p_xDim=1&p_w2n=2&p_charGap=$p_charGap&p_invert='N'&p_charHeight=30" .
							"&p_type=1&p_label='Y'&p_rotAngle=0&p_checkDigit='Y'";		

			$name = $r1[f_name] . " " .  $r1[s_name];
			$date=explode("-",$r1[dob]);
			$date1=$date[2]."/".$date[1]."/".$date[0];
			$temp = $r1[addr];
			?>
			<td width='50%'>
				<table border="0" width='100%' bordercolor='black' background="../images/rnsit11.jpg">
					<tr>
						<td align='center' colspan='3'><font size='3'><b>R.N.S.I.T</b></font></td>
					</tr>
					<tr>
						<td  align='center' colspan='3'><font size='1.2'>Channasandra, Subramanyapura PO,banglore - 560 061. Tel : 28611880/1/3</font></td>
					</tr>
					<tr>
						<td colspan='2' align='center'><font size='1.2'>E-mail : rnsit@vsnl.in</font></td>
						<td align='center'><font size='1.2'>Website : www.rnsit.in</font></td>
					</tr>
					<tr  height='5'>
						<td colspan='3'><hr color='black'></td>
					</tr>
					<tr>
						<td colspan='3' align='center'><font size='2'><b>STAFF ID</b></font></td>
					</tr>
					<tr>
						<td rowspan='4' align='center' width='20%'><img src="<?php echo $r1[image] ?>" width='100' height='90'></td>
						<td width='20%'><font size='1.7'><b>NAME</b></font></td>
						<td>:&nbsp;<font size='2'><?php echo $name ?></font></td>
					</tr>
					<tr>
						<td><font size='1.7'><b>ID</b></font></td>
						<td>:&nbsp;<font size='2'><?php echo $r1[slno] ?></font></td>
					</tr>
					<tr>
						<td><font size='1.7'><b>Dept</b></font></td>
						<?php
							$sql=fetcharray(execute("select dept_code from dept_no where dpt_id='$r1[subj]'"));
						?>
						<td>:&nbsp;<font size='2'><?php echo $sql[0] ?></font></td>
					</tr>
					<tr>
						<td><font size='1.7'><b>Desig</b></font></td>
						<?php
							$sql1=fetcharray(execute("select d_name from staff_des where d_id='$r1[type_id]'"));
						?>
						<td>:&nbsp;<font size='2'><?php echo $sql1[0] ?></font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td align='center' valign='bottom'><img src="../images/signature.JPG" width='120' height='30'></td>
					</tr>
					<tr height='20' valign='bottom'>
						<td colspan='2'></td>
						<td align='center'><font size='2'>Director Sign</font></td>
					</tr>
				</table>
			</td>

			<td width='50%' valign='top'>
				<table border='0' width='100%' background="../images/rnsit11.jpg">
					<tr>
						<td align='left' colspan='2'>&nbsp;&nbsp;<font size='1.7'><b>Date Of Birth :</b></font> 
							<font size='2'><?php echo $date1 ?></font></td>
						<td><font size='1.7'><b>Blood Group :</b></font><font size='2'><?php echo $r1[bg] ?></font></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='1.7'><b>Address :</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr>
						<td colspan='3' valign='top'>&nbsp;&nbsp;<font size='2'><?php echo $temp ?></font><br>
						<font size='2'>&nbsp;&nbsp;<?php echo $r1[state] ?>-<?php echo $r1[pin] ?></font></td>
					</tr>
					<tr height='6'>
						<td colspan='3'></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='1.7'><b>Phone :</b></font>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
						<font size='2'><?php echo $r1[phone] ?></font></td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='1.7'><b>E_mail :</b></font>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
						<font size='2'><?php echo $r1[email] ?></font></td>
					</tr>
					<tr height='30'>
					<td colspan='6' align='center' valign='bottom'>			
						<IMG SRC="<?php echo $dest;?>" ALT="<? echo strtoupper($r1[slno]); ?>"></td></tr?
						<tr><td colspan='6' align='right'><font size='2'>Holders Sign&nbsp;&nbsp;</font></td>
					</tr>
				</table>
			</td>
		</tr>
	<?php
		}
	?>
</table>
	<!-- <input type='button' name='button' value='Export To File' onclick='sendMe()'> -->
	<div id="prn" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="printReport()" style='font-weight: bold; background-color: #86BAF9; color: #000080; border-style: solid; border-width: 1'></div>
</form>
</body>
</html>
