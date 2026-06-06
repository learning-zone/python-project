<html>
<head>
<?php
include("../db.php");
$_NUMREC_ = 25; 
if(empty($SeekPos))
{
	$SeekPos = 0;
}
?>
<script language="JavaScript">
function frm_submit()
{
	document.form1.SeekPos.value=0;
}
function prn()
{
	prn1.style.display = "none";
	prn2.style.display = "none";
	window.print(this.form);
}
</script>
</head>
<body>
<?php
if($from_date=='')
{
	$from_date = "$FYear-$FMon-$FDay";
}
if($course!=0)
{
	$tsql=execute("select * from subject_m where course_id=$course and course_year_id=$sem and status <> 0");
	$row1=rowcount($tsql);
	$row3=$row1+3;
	$sql="select * from course_m where course_id=$course";
	$rs=execute($sql) or die("<font color=red><b>Please enter course details</b></font>");
	$r_c=fetcharray($rs,0);
	$sql1="select * from course_year where year_id=$sem";
	$rs1=execute($sql1) or die("<font color=red><b>Please enter year details</b></font>");
	$r1=fetcharray($rs1,0);
	if($course_section==0)
	{
		$secname="No Section";
	}
	else
	{
		$sql4="select section_name from class_section where id=$course_section";
		$rs4=execute($sql4) or die("<font color=red><b>Please enter section details</b></font>");
		$r5=fetcharray($rs4,0);
		$secname=$r5[0]."  Section";
	}
	$tsql=execute("select * from subject_m where course_id=$course and course_year_id=$sem and status <> 0");
	$ch_flg=0;
	for($aaz=0;$aaz<rowcount($tsql);$aaz++)
	{
		$rsql12=fetcharray($tsql,$aaz);
		$sub_det=$r_c[course_abbr]."_".$rsql12[subject_id];
		$qry_yy=execute("select $sub_det from daily_att_".$course."_".$sem." where adate='$from_date' and class_section_id=$course_section");
		while($rs_tot=fetcharray($qry_yy))
		{
			if($rs_tot[0]=='Yes' or $rs_tot[0]=='No')
				$ch_flg=1;
		}
	}
	if($ch_flg !=1)
	{
		echo "<font color=red><b>NO ATTENDANCE AVAILABLE ON THIS DAY</b></font>";
		die();
	}
	else
	{
		echo "<table cellspacing=0 cellpadding=1 class=forumline align=center border=1>";
		echo "<tr><td class=head colspan=".($row1+3)." align=center><b>DAYANANDA SAGAR COLLEGE OF ENGINEERING</b></td></tr>";
		echo "<tr><td colspan=".($row3/3+1)." class=row3>Course & Department : $r_c[coursename]</td>";
		echo "<td class=row3 colspan=".($row3/3)." class=row3>Year/Semester : $r1[year_name]</td>";
		echo "<td class=row3 colspan=".($row3/3+1)." class=row3 align=center>Section : $secname</td></tr>";
		echo "<tr><td colspan=".($row1+3)." align=center class=row3>Attendance Report : ".date('d-m-Y',strtotime($from_date))."</td></tr>";
		echo "<tr><td class=row3>Sl No</td><td class=row3>Name</td><td class=row3>Register No</td>";
		$tsql=execute("select * from subject_m where course_id=$course and course_year_id=$sem and status <> 0");
		for($aaz=0;$aaz<rowcount($tsql);$aaz++)
		{
			$rsql12=fetcharray($tsql,$aaz);
			echo "<td nowrap class=row3 align=center><b>$rsql12[subject_code]</b></td>";
		}
		echo "</tr>";
		
		$count_slno=$SeekPos + 1;
		$qur_4=execute("select * from student_m where course_admitted=$course and course_yearsem=$sem and class_section_id=$course_section and archive='N' order by student_id asc");
		$countRS = rowcount($qur_4);
		if($countRS==0)
		{
			die("<font color=red>Data Not Found.</font>");
		}
		data_seek($qur_4,$SeekPos); //Move the data pointer to the next position.
		if( ($SeekPos + $_NUMREC_) > $countRS)
		{
			$MAX = $countRS;
		}
		else
		{
			$MAX = $SeekPos + $_NUMREC_ ;
		}
		if( ($SeekPos + $_NUMREC_) >= $countRS)
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
		$PAGES = $countRS / $_NUMREC_;
		if($countRS % $_NUMREC_)
		{
			$PAGES++;
		}
		$LAST = ((int) $PAGES - 1) * $_NUMREC_;
		
		for($mm=$SeekPos;$mm<$MAX;$mm++)
		{
			$RS1=fetcharray($qur_4,$mm);
			echo "<tr><td>$count_slno</td><td nowrap>$RS1[first_name]</td><td>$RS1[student_id]</td>";
			
			$tsql=execute("select * from subject_m where course_id=$course and course_year_id=$sem and status <> 0");
			$row3=rowcount($tsql);
			for($aaz=0;$aaz<rowcount($tsql);$aaz++)
			{
				$rsql12=fetcharray($tsql,$aaz);
				$att="---";
				$sub_det=$r_c[course_abbr]."_".$rsql12[subject_id];
				$qry_yy=execute("select $sub_det from daily_att_".$course."_".$sem." where adate='$from_date' and stud_reg_no='$RS1[student_id]' and class_section_id=$course_section");
				while($rs_tot=fetcharray($qry_yy))
				{
					if($rs_tot[0]=='Yes' and $att!='Present')
						$att="Present";
					elseif($rs_tot[0]=='No' and $att!='Present')
						$att="Absent";
					elseif($att!='Present' and $att!="Absent")
						$att="---";
				}
				if($att=='Present')
					echo "<td align=center><font color=green>$att</font></td>";
				elseif($att=='Absent')
					echo "<td align=center><font color=red>$att</font></td>";
				else
					echo "<td align=center>$att</td>";
			}
			$count_slno++;
			echo "</tr>";
		}
	}
}
else
//For First Year Code Starts Here
{
	$tsql_1=execute("select distinct(maj_id) from major_master where section_id=$course_section and sem_id=$sem");
	$tsql=execute("select * from common_m where course_year_id=$sem and status <> 0");
	for($ki=0;$ki<rowcount($tsql);$ki++)
	{
		$trs=fetcharray($tsql,$ki);
		$MySubCodeArray[$ki]="common_m_".$trs["subject_id"];
		$SubjectName[$ki]=$trs["subject_code"];
	}
	$rs_tgsql1=fetcharray($tsql_1);
	$tsql1=execute("select * from major where major_id=$rs_tgsql1[maj_id] and course_year_id=$sem and status <> 0");
	for($kii=0;$kii<rowcount($tsql1);$kii++)
	{
		$trs1=fetcharray($tsql1,$kii);
		$MySubCodeArray[$ki]="major_".$trs1["id"];
		$SubjectName[$ki]=$trs1["subject_code"];
		$ki++;
	}
	$ch_flg=0;
	while(list(,$value)=each($MySubCodeArray))
	{
		$qry_yy=execute("select $value from daily_attendance_1_".$course_section." where adate='$from_date'");
		while($rs_tot=fetcharray($qry_yy))
		{
			if($rs_tot[0]=='Yes' or $rs_tot[0]=='No')
				$ch_flg=1;
		}
	}
	if($ch_flg !=1)
	{
		echo "<font color=red><b>NO ATTENDANCE AVAILABLE ON THIS DAY</b></font>";
		die();
	}
	else
	{
		$row1=$ki;
		$row3=$row1+3;
		$sql1="select * from course_year where year_id=$sem";
		$rs1=execute($sql1) or die("<font color=red><b>Please enter year details</b></font>");
		$r1=fetcharray($rs1,0);
		if($course_section==0)
		{
			$secname="No Section";
		}
		else
		{
			$sql4="select section_name from class_section where id=$course_section";
			$rs4=execute($sql4) or die("<font color=red><b>Please enter section details</b></font>");
			$r5=fetcharray($rs4,0);
			$secname=$r5[0]."  Section";
		}
		echo "<table cellspacing=0 cellpadding=1 class=forumline align=center border=1>";
		echo "<tr><td class=head colspan=".($row1+3)." align=center><b>DAYANANDA SAGAR COLLEGE OF ENGINEERING</b></td></tr>";
		echo "<tr><td class=row3 colspan=".($row3/3+1)." class=row3 align=center>First Year</td>";
		echo "<td class=row3 colspan=".($row3/3)." class=row3>Year/Semester : $r1[year_name]</td>";
		echo "<td class=row3 colspan=".($row3/3+1)." class=row3 align=center>Section : $secname</td></tr>";
		echo "<tr><td colspan=".($row1+3)." align=center class=row3>Attendance Report From : ".date('d-m-Y',strtotime($from_date))."</td></tr>";
		echo "<tr><td class=row3>Sl No</td><td class=row3>Name</td><td class=row3>Register No</td>";

		while(list(,$SubCode)=each($SubjectName))
		{
			echo "<td  nowrap class=row3 align=center><b>$SubCode</b></td>";
		}
		echo "</tr>";
		$count_slno=$SeekPos + 1;
		$qur_4=execute("select a.first_name,a.student_id from student_m a where a.course_yearsem=$sem and a.class_section_id=$course_section and a.archive='N' order by student_id asc") or die(error_description()."error1");
		$countRS = rowcount($qur_4);
		if($countRS==0)
		{
			die("<font color=red>Data Not Found.</font>");
		}
		data_seek($qur_4,$SeekPos); //Move the data pointer to the next position.
		if( ($SeekPos + $_NUMREC_) > $countRS)
		{
			$MAX = $countRS;
		}
		else
		{
			$MAX = $SeekPos + $_NUMREC_ ;
		}
		if( ($SeekPos + $_NUMREC_) >= $countRS)
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
		$PAGES = $countRS / $_NUMREC_;
		if($countRS % $_NUMREC_)
		{
			$PAGES++;
		}
		$LAST = ((int) $PAGES - 1) * $_NUMREC_;
		
		for($mm=$SeekPos;$mm<$MAX;$mm++)
		{
			$RS1=fetcharray($qur_4,$mm);
			echo "<tr><td>$count_slno</td><td nowrap>$RS1[first_name]</td><td>$RS1[student_id]</td>";
			reset($MySubCodeArray);
			while(list(,$value)=each($MySubCodeArray))
			{
				$att="---";
				$qry_yy=execute("select $value from daily_attendance_1_".$course_section." where adate='$from_date' and stud_reg_no='$RS1[student_id]' ");
				while($rs_tot=fetcharray($qry_yy))
				{
					if($rs_tot[0]=='Yes' and $att!='Present')
						$att="Present";
					elseif($rs_tot[0]=='No' and $att!='Present')
						$att="Absent";
					elseif($att!='Present' and $att!="Absent")
						$att="---";
				}
				if($att=='Present')
					echo "<td align=center><font color=green>$att</font></td>";
				elseif($att=='Absent')
					echo "<td align=center><font color=red>$att</font></td>";
				else
					echo "<td align=center>$att</td>";
			}
			$count_slno++;
			echo "</tr>";
		}
	}
}
echo "</table>";
?>
<font color=brown><b><small>* CH - Classes Held &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* CA - Classes Attended </small></b></font>
<script language="JavaScript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function fun_go_to()
{
	if((document.frm.go_to.value==0)||(document.frm.go_to.value=="")||(parseInt(document.frm.go_to.value) > parseInt(document.frm.PAGES.value) ))
	{
		alert("Page not found");
	}
	else
	{
		document.frm.SeekPos.value = (parseInt(document.frm.go_to.value)-1)* 25;
		document.frm.submit();
	}
}
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
	i = "<?php echo $NEXT?>";
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
function last()
{
	var i;
	i = "<?php echo $LAST?>";
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
</script>
<form name="frm" action="view_dailyreport.php">
<input type="hidden" name="from_date" value="<?php echo $from_date?>">
<input type="hidden" name="SeekPos">
<input type="hidden" name="course" value="<?php echo $course?>">
<input type="hidden" name="sem" value="<?php echo $sem?>">
<input type="hidden" name="course_section" value="<?php echo $course_section?>">
<input type="hidden" name="PAGES" value="<?php echo $PAGES?>">
<div id='prn2' align="center">
<table width="10%" border="0">
<tr><td colspan="2" align="right"><font face='Lucida Sans' size='1.8'>Go To</font></td>
<td colspan="2" align="left">
<input type="text" name="go_to" value="<?php echo  ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()" class=bgbutton></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0" alt="First"></a></td>
<td><a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0"   alt="Previous"></a></td>
<td><a href="Javascript:next()">
<img src="../images/nextbtn.gif" border="0" alt="Next" onMouseOver="Javascript:status='Next Page';"></a></td>
<td><a href="Javascript:last()">
<img src="../images/lastbtn.gif" border="0" alt="Last" onMouseOver="Javascript:status='Last Page';"> </a></td></tr>
</table>
</div>
<div align="right">
<font face='Lucida Sans' size='1.8'>Page <?php echo ($SeekPos / $_NUMREC_)+1?> of <?php echo (int) $PAGES?></font></div>
</form>
<div align=center id=prn1><INPUT TYPE="button" NAME="print" class='bgbutton' VALUE="<< PRINT >>" OnClick="prn()"></div>
</body>
</html>
