<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=stud_id.doc");

/*
$con  = mysql_pconnect("localhost","root","")
or die("<b>Cannot open connection to database</b>.");
mysql_select_db("rnsit")
or die("<b>could not select database</b>.");
*/
    require_once("../db.php");
	require_once("core.php");
	
$id=$_POST['id'];
$student_id=$_POST['student_id'];
$usn=$_POST['usn'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$course_admitted=$_POST['course_admitted'];
$academic_year=$_POST['academic_year'];
$blood_group=$_POST['blood_group'];
$cor_address=$_POST['cor_address'];
$cor_state=$_POST['cor_state'];
$cor_pincode=$_POST['cor_pincode'];
$cor_phone=$_POST['cor_phone'];
$img_source=$_POST['img_source'];
$archive=$_POST['archive'];
$dob=$_POST['dob'];
	


	$sql.="select id,student_id,usn,first_name,last_name,course_admitted,academic_year,blood_group,dob,cor_address as addr,cor_state as state,cor_pincode as pin ,cor_phone as phone,img_source as img1 from student_m where id is not null and archive='N'";
	if($app_no!='')
	{
	 $sql.=" and student_id='$app_no'";
	}
	if($branch!=0)
	{
	$sql.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem=$sem";
	}
	if($studfname!='')
	{
	 $sql.=" and first_name like '$studfname%'";
	}
	if($a_year!=0)
	{
		$sql.=" and academic_year='$a_year'";
	}
	if($un!=0)
	{
        $sql.=" and usn='$un'";
    }
	echo "$sql<br>";
	$rs=execute($sql) or die(mysql_error());
	$num = rowcount($rs);
	if($num==0)
	{
		echo "<font color=brown><b>No Records Found !!</b></font>";
		die();
	}
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
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
<input type='hidden' name='app_no' value='<?php echo $app_no ?>'>
<input type='hidden' name='branch' value='<?php echo $branch ?>'>
<input type='hidden' name='sem' value='<?php echo $sem ?>'>
<input type='hidden' name='studfname' value='<?php echo $studfname ?>'>
<input type='hidden' name='a_year' value='<?php echo $a_year ?>'>
<input type='hidden' name='un' value='<?php echo $un ?>'>

<table border="0" width='90%' align='center'  colspan='2' cellspacing=0 cellpadding=0 bordercolor='black'>
	<tr>
		<?php
		for($i=1;$i<=$num;$i++)
		{
			$r1=fetcharray($rs);
			
					$p_textEnc = strtoupper(rawurlencode($r1[student_id]));
					$p_charGap = 1;
					$dest = "wrapper.php?p_bcType=1&p_text=$p_textEnc" . 
							"&p_xDim=1&p_w2n=2&p_charGap=$p_charGap&p_invert='N'&p_charHeight=30" .
							"&p_type=1&p_label='Y'&p_rotAngle=0&p_checkDigit='Y'";			

			$name = $r1[first_name] . " " .  $r1[last_name];
			$ac = $r1[academic_year];
			$aca = $r1[academic_year]+1;
			$aca1 = substr($aca,2);
			$date=explode("-",$r1[dob]);
			$date1=$date[2]."/".$date[1]."/".$date[0];
			$temp = $r1[addr];
			?>
			<td width='50%'>
				<table border="0" width='100%' bordercolor='black'>
					<tr>
						<td align='center' colspan='3'><font size='3'><b>R.N.S.I.T</b></font></td>
					</tr>
					<tr>
						<td align='center' colspan='3'><font size='1.2'>Channasandra,Subramanyapura PO,banglore-560 061. Tel:28603880/1/3</font></td>
					</tr>
					<tr>
						<td colspan='2' align='center'><font size='1.2'>E-mail : rnsit@vsnl.in</font></td>
						<td align='center'><font size='1.2'>Website : www.rnsit.in</font></td>
					</tr>
					<tr  height='5'>
					<td colspan='3'><hr color='black'></td>
					</tr>
					<tr>
						<td rowspan='4' align='center'  width='20%'><img src="<?php echo $r1[img1] ?>" width='100' height='90'></td>
						<td width='20%'><font size='1.7'><b>NAME</b></font></td>
						<td >:&nbsp;<font size='2'><?php echo $name ?></font></td>
					</tr>
					<tr>
						<td><font size='1.7'><b>USN</b></font></td>
						<td>:&nbsp;<font size='2'><?php echo $r1[usn] ?></font></td>
					</tr>
					<tr>
						<?php
							$sql=fetcharray(execute("select course_abbr from course_m where course_id='$r1[course_admitted]'"));
						?>
						<td><font size='1.7'><b>Course</b></font></td>
						<td>:&nbsp;<font size='1.7'><b>B.E</b></font>
							&nbsp;&nbsp;
							<font size='1.7'><b>Branch</b></font>:
							<font size='2'><?php echo $sql[0] ?></font></td>
					</tr>
					<tr>
						<td colspan='2'><font size='1.7'><b>Adm Year</b></font>&nbsp;&nbsp;
						:&nbsp<font size='2'><?php echo $ac ?>-<?php echo $aca1 ?></font>
						<font size='1.7'><b>&nbsp;&nbsp;Duration&nbsp;:&nbsp;4 Years</b></font>
						</td>
					</tr>
					<tr height='35' valign='bottom'>
						<td align='center'><font size='2'>Student Sign</font></td>
						<td></td>
						<td align='center'><font size='2'>Director Sign</font></td>
					</tr>
				</table>
			</td>

			<td width='50%' valign='top'>
				<table border='0' width='100%'>				
					<tr>
						<td align='left' colspan='2'>&nbsp;&nbsp;<font size='1.7'><b>Date Of Birth :</b></font> 
							<font size='2'><?php echo $date1 ?></font></td>
						<td><font size='1.7'><b>Blood Group :</b></font><font size='2'><?php echo $r1[blood_group] ?></font></td>
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
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<font size='2'><?php echo $r1[phone] ?></font></td>
					</tr>
					<tr height='50'>
					<td colspan='3' align='center'>			
						<IMG SRC="<?php echo $dest;?>" ALT="<? echo strtoupper($r1[student_id]); ?>">						
					</td>
					</tr>
					<tr>
						<td colspan='3' align='center'><font color='red' size='1.6'>Note : Student must wear ID card inside the College Premises</font></td>
					</tr>
				</table>
			</td> 
		</tr>
		<?php
			}
		?>
	</table>
</body>
</html>

?>