<html>
<?php
	session_start();
$con  = mysql_pconnect("localhost","root","")
		 or die("<b>Cannot open connection to database</b>.");
	mysql_select_db("rnsit")
		 or die("<b>could not select database</b>.");
$_NUMREC_ = 05; 
if(empty($SeekPos))
{
        $SeekPos = 0;
}
	require("core.php");

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
	$sql.=" and id not in(select s_id from h_stud_m)";
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
function prn()
{
	prn1.style.display = "none";
	prn2.style.display = "none";
	window.print(this.form);
	prn1.style.display = "";
	prn2.style.display = "";
}
</script>
</head>
<body >
<form name='frm' method='post' action='id_card1.php'>
<table border="1" width='100%' align='center'  valign='top
colspan='2' cellspacing=0 cellpadding=2  bordercolor='black' >
<tr >
<?php
if($num>0)
{
	  //data_seek($rs,$SeekPos);
	  mysql_data_seek($rs,$SeekPos);

	  if( ($SeekPos + $_NUMREC_) > $num)
		{
			$MAX = $num;
		}
	  else
	    {
			$MAX = $SeekPos + $_NUMREC_ ;
	    }
	  if( ($SeekPos + $_NUMREC_) >= $num)
	    {
			$NEXT = $SeekPos;
	    }
     else
	   {
			$NEXT  = $SeekPos + $_NUMREC_ ;
       }
	 if( ($SeekPos - $_NUMREC_)  > 0)
	   {
			$PREV = $SeekPos - $_NUMREC_;
	   }
	 else
	   {
	 		$PREV = 0;
	   }
	 $PAGES = $num / $_NUMREC_;
	 if($num % $_NUMREC_)
	   {
	        $PAGES++;
	   }
	 $LAST = ((int) $PAGES - 1) * $_NUMREC_;
	 for($i=$SeekPos;$i<$MAX;$i++)
	 {
			$r1=fetcharray($rs);
			if($r1[usn]!="")
			{
				$studId = $r1[usn];
			}
			else
			{
				$studId = $r1[student_id];
			}
			
			$p_textEnc = strtoupper(rawurlencode($studId));
			
			/*$p_charGap = 1;
			$p_bcType=1;
			$p_xDim=1;
			$p_charGap = $p_xDim;
			$dest = "wrapper.php?p_bcType=$p_bcType&p_text=$p_textEnc" . 
					"&p_xDim=$p_xDim&p_w2n=2&p_charGap=$p_charGap&p_invert=N&p_charHeight=50" .
					"&p_type=1&p_label='Y'&p_rotAngle=0&p_checkDigit='Y'";*/

			$dest = "wrapper.php?p_bcType=1&p_text=$p_textEnc" . 
					"&p_xDim=1&p_w2n=3&p_charGap=2&p_invert=N&p_charHeight=30" .
					"&p_type=1&p_label=Y&p_rotAngle=0&p_checkDigit=N";

			$name = $r1[first_name] . " " .  $r1[last_name];
			$ac = $r1[academic_year];
			$aca = $r1[academic_year]+1;
			$aca1 = substr($aca,2);
			$date=explode("-",$r1[dob]);
			$date1=$date[2]."/".$date[1]."/".$date[0];
			$temp = $r1[addr];
			?>
			<td width='50%'>
				<table border="0" width='100%' height='100' cellspacing=0 cellpadding=0 background="../images/rnsit11.jpg" >
					<tr>
						<td align='center' colspan='3'><font size='5' color='blue'><b>R N S I T<b></font></td>
					</tr>
					<tr>
						<td  align='left' colspan='3'><font size='2'>Channasandra,Subramanyapura PO,Bengaluru-560 061. Tel:28611880/1</font></td>
					</tr>
					<tr>
						<td colspan='2'><font size='2'>E-mail : rnsit@vsnl.in</font></td>
						<td align='right'><font size='2'>Website : www.rnsit.in</font>&nbsp;</td>
					</tr>
					<tr>
					<td colspan='3'><hr color='black' size='0.5'></td>
					</tr>
					<tr > 
						<td rowspan='4' align='center' ><img src="<?php echo $r1[img1] ?>" width='75' height='80'></td>
						<td valign='top' >&nbsp;&nbsp;<font size='0.8'><b>NAME</b></font>&nbsp;&nbsp;</td>
						<td>:&nbsp;<font size='0.8'><b><?php echo $name ?></b></font></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;<font size='0.8'><b>USN</b></font>&nbsp;&nbsp;</td>
						<td>:&nbsp;<font size='0.8'><b><?php echo $studId ?></b></font></td>
					</tr>
					<tr>
						<?php
							$sql=fetcharray(execute("select course_abbr from course_m where course_id='$r1[course_admitted]'"));
						?>
						<td>&nbsp;&nbsp;<font size='0.8'><b>Course</b></font>&nbsp;&nbsp;</td>
						<td>
							:&nbsp;<font size='0.8'><b>B.E</b></font>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<font size='0.8'><b>Branch</b></font>&nbsp;&nbsp;&nbsp;:&nbsp;
							<font size='0.8'><b><?php echo substr($sql[0],0,2) ?></b></font></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;<font size='0.8'><b>Adm Year</b></font>&nbsp;&nbsp;</td>
						<td>:&nbsp;<font size='0.8'><b><?php echo $ac ?>-<?php echo $aca1 ?></b></font>
							&nbsp;&nbsp;&nbsp;<font size='0.8'><b>Duration&nbsp;&nbsp;&nbsp;:&nbsp;4 Years</b></font>
															
						</td>
					</tr>
					<tr height='30' >
						<td></td>
						<td></td>
						<td align='center' valign='bottom'><img src="../images/signature.JPG" width='120' height='30'></td>
					</tr>
					<tr valign='bottom'>
						<td align='center'>Student Sign</td>
						<td></td>
						<td align='center'>Director Sign</td>
					</tr>
				</table>
			</td>

			<td width='50%' valign='top' >
				<table border='0' width='100%' cellspacing=0 cellpadding=0 background="../images/rnsit11.jpg">
					<tr height='6'>
						<td colspan='3'></td>
					</tr>
					<tr>
						<td align='left' colspan='2'>&nbsp;&nbsp;<font size='1.5'><b>Date Of Birth :</b></font> 
							<font size='0.8'><?php echo $date1 ?></font></td>
						<td><font size='0.8'><b>Blood Group :</b></font><font size='2'><?php echo $r1[blood_group] ?></font></td>
					</tr>
					
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='0.8'><b>Address :</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr height='60'>
						<td colspan='3' valign='top'>&nbsp;&nbsp;<font size='0.8'><?php echo $temp ?></font><br>
						<font size='0.8'>&nbsp;&nbsp;<?php echo $r1[state] ?>-<?php echo $r1[pin] ?></font></td>
					</tr>
					
					<tr>
						<td colspan='3'>&nbsp;&nbsp;<font size='0.8'><b>Phone :</b></font>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<font size='0.8'><?php echo $r1[phone] ?></font></td>
					</tr>
						
					<tr >
					<td colspan='3' align='center' >			
						<IMG SRC="<?php echo $dest;?>" ALT="<? echo strtoupper($row[student_id]); ?>" >						
					</td>
					</tr>
					<tr>
						<td colspan='3' align='center' valign='bottom'>
							<font color='red' size='1.6'>Note : Student must wear their ID card inside the College Premises</font>
						</td>
					</tr>
				</table>
			</td> 
		</tr>
		<?php
	}
}
		?>
	</table>
<script language="JavaScript">
	function first()
		{
			var i;
            i = 0;
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
	function prev()
		{
			var i;
            i = "<?php echo $PREV?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
    function next()
		{
		    var i;
            i = "<?=$NEXT?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
	function last()
		{
            var i;
            i = "<?=$LAST?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
</script>
<br>
   <input type="hidden" name="app_no" value="<?php echo $app_no?>">
	   <input type="hidden" name="branch" value="<?php echo $branch?>">
	   <input type="hidden" name="sem" value="<?php echo $sem?>">
	   <input type="hidden" name="studfname" value="<?php echo $studfname?>">
	   <input type="hidden" name="a_year" value="<?php echo $a_year?>">
	    <input type="hidden" name="SeekPos">
	<div id='prn1'>
	<table align="center">
			<tr>
				<td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0" alt="First"></a></td>
				<td><a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0" alt="Previous"></a></td>
				<td><a href="Javascript:next()"><img src="../images/nextbtn.gif" border="0" alt="Next"></a></td>
				<td><a href="Javascript:last()"><img src="../images/lastbtn.gif" border="0" alt="Last"></a></td>
			</tr>
	</table>
	</div>
	<div align="right">
<font face='Lucida Sans' size='2.5'>Page <?php echo ($SeekPos / $_NUMREC_)+1?> of <?php echo (int) $PAGES?></font></div>
	<br>	

	<div id="prn2" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="prn()" style='font-weight: bold; background-color: #86BAF9; color: #000080; border-style: solid; border-width: 1'></div>

</body>
</html>
