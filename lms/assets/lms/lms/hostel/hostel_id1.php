<?php
session_start();
require("../db.php");
		
//require("core.php");

$hname = $_POST['hname'];
$rname = $_POST['rname'];
$branch = $_POST['branch'];
$sem = $_POST['sem'];
$studfname = $_POST['studfname'];

$p_bcType = $_POST['p_bcType'];
$p_text = $_POST['p_text'];
$p_xDim = $_POST['p_xDim'];
$p_w2n = $_POST['p_w2n'];
$p_charGap = $_POST['p_charGap'];
$p_invert = $_POST['p_invert'];
$p_charHeight = $_POST['p_charHeight'];
$p_type = $_POST['p_type'];
$p_label = $_POST['p_label'];
$p_rotAngle = $_POST['p_rotAngle'];
$p_checkDigit = $_POST['p_checkDigit'];

$B1 = $_POST['B1'];

$_NUMREC_ = 05; 
if(empty($SeekPos))
{
	$SeekPos = 0;
}
	
//	echo "HELLO";
	$sql.="select a.id,a.student_id,a.first_name,a.last_name,a.course_admitted,a.course_yearsem,a.usn,a.dob,a.blood_group,a.cor_address as addr,a.academic_year,a.cor_state as state,a.cor_pincode as pin ,a.cor_phone as phone,a.img_source as img1 ,b.s_id,b.h_id,b.room_no,b.bid from student_m a,h_stud_m b where a.id=b.s_id AND b.archive='N'";
	
	if($branch!=0)
	{
	$sql.=" and a.course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql.=" and a.course_yearsem=$sem";
	}
	if($studfname!='')
	{
	 $sql.=" and a.first_name='$studfname'";
	}
    if($hname!=0)
	{  
	 $sql.=" and b.h_id='$hname'";
	}
	if($rname!=0)
	{
	 $sql.=" and b.room_no='$rname'";
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
function prn()
{
	prn1.style.display = "none";
	prn2.style.display = "none";
	window.print(this.form);
	}
</script>
</head>
<body >
<form name='frm' method='post' action='hostel_id1.php'>
<table border="1" width='50%' align='center'  valign='top
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
			if($r1[usn]=="")
			{
				$studId = $r1[student_id];
			}
			else
			{
				$studId = $r1[usn];
			}
			
			$p_textEnc = strtoupper(rawurlencode($studId));
			
			
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
			
			//echo colleadress();
			?>
			<td width='50%'>
				<table border="0" width='100%' height='100' cellspacing=0 cellpadding=0 background="../images/logo.jpg" >
					<tr>
						<td align='center' colspan='3'><font size='5'><b><?php echo collegecode(); ?><b></font></td>
					</tr>
					<tr>
						<td  align='left' colspan='3'><font size='2'><?php echo colleadress(); ?></font></td>
					</tr>
                    <?php
					/*
					<tr>
						   <td colspan='2'><font size='2'><?php echo collegemail(); ?></font></td>
						<td align='right'><font size='2'>Website : <?php echo collegesite(); ?></font>&nbsp;</td>
					</tr>
					*/
                    ?>
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
				<table border='0' width='100%' cellspacing=0 cellpadding=0 background="../images/logo.jpg">
					<tr height='6'>
						<td colspan='3'></td>
					</tr>
					<tr>
						<td align='left' colspan='2'>&nbsp;&nbsp;<font size='1.5'><b>Date Of Birth :</b></font> 
							<font size='0.8'><?php echo $date1 ?></font></td>
						<td><font size='0.8'><b>Blood Group :</b></font><font size='2'><?php echo $r1[blood_group] ?></font></td>
					</tr>
					
					<tr>
					  <td colspan='3'>&nbsp;&nbsp;
					    <p><font size='0.8'><b>Address :</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size='0.8'><?php echo $temp ?><?php echo $r1[state] ?><?php echo $r1[pin] ?></font></p>
					    <p>&nbsp;</p></td>
					
						<td colspan='3' valign='top'>&nbsp;&nbsp;<br>
					  <font size='0.8'>&nbsp;&nbsp;-</font></td>
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
							<font color='red' size='1.6'>Note : Student must wear their ID card inside the Hostel Premises</font>
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

	<div id="prn2" align='center'><input class='bgbutton' type="button" value=" PRINT " name="B1" onClick="prn()" ></div>

</body>
</html>