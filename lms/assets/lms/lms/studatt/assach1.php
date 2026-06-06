<HTML>
<HEAD>
<title>Continueous Internal Evaluation</title>
<?php
session_start();
include("../db.php");
/* This file is used to Add/Modify marks achieved by students in different assesments*/
?>
<SCRIPT ID="clientEventHandlersJS" LANGUAGE=javascript>
function changeMs(i)
{
	if(i)
	{
		document.all.sl.style.color='blue'
	}
	else
	{
		document.all.sl.style.color='brown'
	}
}
function selectMe()
{
	i = document.ModifyM.length;
	for(j=0;j<i;j++)
	{
		if(document.ModifyM[j].type == "checkbox")
		{
			flag = document.ModifyM[j].checked;
			document.ModifyM[j].checked = !flag;
		}
	}
}
function checker(studid,ind)
{
	var m=parseInt(document.getElementsByName("mmk"+ind)[0].value);
	var m1=parseFloat(document.getElementsByName(ind+"assmk"+studid)[0].value);
	if(isNaN(m1))
	{
		var m1=document.getElementsByName(ind+"assmk"+studid)[0].value;
		if(m1 !='Ab' && m1 !="")
		{
			alert("For Absent enter exactly as 'Ab' only");
			document.getElementsByName(ind+"assmk"+studid)[0].value='';
			document.getElementsByName(ind+"assmk"+studid)[0].focus();
			return false;
		}
	}
	else
	{
		if(m1>m)
		{
			alert("Entered Marks cannot be greater than Max Marks..");
			document.getElementsByName(ind+"assmk"+studid)[0].value='';
			document.getElementsByName(ind+"assmk"+studid)[0].focus();
			return false;
		}
	}
	var cnt=parseInt(document.ModifyM.nocie.value);
	var ciemks=parseInt(document.ModifyM.cie_mxmks.value);
	var twtg=0;
	var tmmk=0;
	var fmk=0;
	for(i=1;i<=cnt;i++)
	{
		var mm=parseInt(document.getElementsByName("mmk"+i)[0].value);
		var ww=parseInt(document.getElementsByName("wtg"+i)[0].value);
		var am=parseFloat(document.getElementsByName(i+"assmk"+studid)[0].value);
		if(isNaN(am))
		{
			var am=document.getElementsByName(i+"assmk"+studid)[0].value;
			if(am =='Ab')
				twtg=twtg+ww;
		}
		else
		{
			if(mm>0)
			{
				tmmk=tmmk+(am*ww/mm);
				twtg=twtg+ww;
			}
		}
	}
	if(twtg>0)
	{
		fmk=tmmk*ciemks/twtg;
		fmk=Math.round(fmk);
	}
	else
		fmk=0;
	document.getElementsByName("imk"+studid)[0].value=fmk;
}
function adddata()
{
	document.ModifyM.action="ins_assach1.php";
	document.ModifyM.submit();
}
</SCRIPT>
</HEAD>
<BODY topmargin=0 >
<Form Name="ModifyM" method="post">
<input type="hidden" name="prm" value="<?=$prm?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="sec" value="<?=$sec?>">
<input type="hidden" name="subn" value="<?=$subn?>">
<input type="hidden" name="practical_batch" value="<?=$bid?>">
<?php
$cyr=$curyr1;
$sqlstr="Select subject_id,subject_code,subject_name,sub_type,elective,b.coursename,c.year_name from subject_m a, course_m b, course_year c where a.status=1 and a.course_year_id=c.year_id and a.course_id=b.course_id and a.subject_id=$subn AND a.course_id=$prm and a.course_year_id = $sem";
$rs = execute($sqlstr);
$num = rowcount($rs);
if($num == 0)
{
	die("Subject Details not found...!!");
}
else
{
	$r = fetcharray($rs);
	$prm_name=$r[coursename];
	$sem_name=$r[year_name];
	if($r[elective] =='Y')
		$flag=1;
	else
		$flag=0;
	if($r[sub_type] !=2)
	{
		$practical_batch=0;
		$sub_name=$r[subject_name];
	}
	else
	{
		$practical_batch=$bid;
		$sub_name=$r[subject_name]." ".$bn1;
	}
	if($sec==0)
	{
		$section_name='No Section';
	}
	else
	{
		$rs_section=execute("select section_name from class_section where id=$sec");
		$r_section=fetcharray($rs_section);
		$section_name=$r_section[section_name]." - Section";
	}
	mysql_free_result($rs);
	mysql_free_result($rs_section);
	if($practical_batch =="" or $practical_batch =='0')
	{
		if($flag==1)
		{
			$sqlstr="select a.id,a.student_id,a.first_name,a.last_name from student_m a ";
			$sqlstr.=" left join elective b on b.subject_id=$subn and b.student_id=a.id ";
			$sqlstr.=" where a.course_admitted=$prm and a.course_yearsem=$sem and archive='N' and ";
			$sqlstr.="b.student_id is not null order by first_name";
		}
		else
		{
			$sqlstr="select a.id,a.student_id,a.first_name,a.last_name from student_m a ";
			$sqlstr.=" where a.class_section_id=$sec and a.course_admitted=$prm and ";
			$sqlstr.=" a.course_yearsem=$sem and  archive='N' order by first_name";
		}
	}
	else
	{
		if($flag==1)
		{
			$sqlstr="select a.id,a.student_id,a.first_name,a.last_name from student_m a,batch_det c ";
			$sqlstr.=" left join elective b on b.subject_id=$subn and b.student_id=a.id";
			$sqlstr.=" where c.subject_id=$subn and c.student_id=a.id and a.course_admitted=$prm and a.course_yearsem=$sem ";  
			$sqlstr.="and c.batch_id=$practical_batch and archive='N' and ";
			$sqlstr.="b.student_id is not null order by first_name";
		}
		else
		{
			$sqlstr="select a.id,a.student_id,a.first_name,a.last_name from student_m a ,batch_det c ";
			$sqlstr.=" where c.subject_id=$subn and a.course_admitted=$prm and a.course_yearsem=$sem and c.student_id=a.id "; 
			$sqlstr.="and c.batch_id=$practical_batch and a.class_section_id=$sec and archive='N' order by first_name";
		}

	}
}
$rs2 = execute($sqlstr);
$num2 = rowcount($rs2);
if($num2==0)
{
	die("<br><font face='Arial' color='red' size='3'><b>NO STUDENTS TO ADD DETAILS..!!</b></font>");
}
else
{
	echo $sqlstr="select * from cie_det where accyr='$cyr' and c_id='$prm' and sem_id='$sem' and sub_id='$subn' and sec_id='$sec'";
	$rs3=execute($sqlstr);
	if(rowcount($rs3)==0)
	{
		die("<br><font face='Arial' color='red' size='3'><b>NO ASSESMENT DETAILS ..!!</b></font>");
	}
	else
	{
		$r3=fetcharray($rs3);
		$nocie=$r3[num_cie];
		?>
		<input type="hidden" name="bid" value="<?=$practical_batch?>">
		<input type="hidden" name="nocie" value="<?=$nocie?>">
		<Table Align="center"  class='forumline'>
		<tr><td colspan=6 align='center' class='head'>Enter Students Mark</td></tr>
		<tr><td align='center' class='row3'>Program</td><td><font color='brown'><?=$prm_name?></font></td><td align='center' class='row3'>Term</td><td><font color='brown'><?=$sem_name?></font></td><td align='center' class='row3'>Section</td><td><font color='brown'><?=$section_name?></font></td></tr>
		<tr><td align='center' class='row3'>Subject</td><td colspan=5><font color='brown'><?=$sub_name?></font></td></tr>
		<tr><td colspan='6' align='center'>
		<Table Align="center"  class='forumline'>
		<tr><td rowspan=2 align='center'><div id="sl" onClick="selectMe()" onMouseOver="changeMs(1)" onMouseOut="changeMs(0)"><font size='2.5'><b>Select</b></font></div></td><td rowspan=2 align='center' nowrap>Sl No</td><td rowspan=2 align='center'>Student Name</td><td rowspan=2 align='center'>SR Number</td>
		<?
		for($i=1;$i<=$nocie;$i++)
		{
			$ass_det="ass".$i;
			echo "<td align='center'>$r3[$ass_det]</td>";
		}
		echo "<td align='center'>Final Internal<br>Marks Acheived</td>";
		echo "<td rowspan=2 align='center'>CIE Remarks</td></tr><tr>";
		for($i=1;$i<=$nocie;$i++)
		{
			$ass_det="ass_max".$i;
			$mx[$i]=$r3[$ass_det];
			$ass_wg="ass_wt".$i;
			$wg[$i]=$r3[$ass_wg];
			echo "<td align='center' nowrap><font color=red>$mx[$i]</font></td>";
			?>
			<input type="hidden" Name="mmk<?=$i?>" value="<?=$mx[$i]?>">
			<input type="hidden" Name="wtg<?=$i?>" value="<?=$wg[$i]?>">
			<?php
		}
		$sql_s1=execute("select marks_cie from subject_m where course_id=$prm and course_year_id=$sem and status=1 and subject_id='$subn'");
		$ass_det=fetcharray($sql_s1);
		$cie_mxmks=$ass_det[0];
		?>
		<input type="hidden" Name="cie_mxmks" value="<?=$cie_mxmks?>">
		<?php
		echo "<td align='center' nowrap><font color=red>Out of $cie_mxmks</font></td>";
		for($i=0;$i<$num2;$i++)
		{
			$r2=fetcharray($rs2,$i);
			$cnum=$i+1;
			if($cnum<10)
				$cnum="0".$cnum;
			?>
			</tr><TR><TD class='row3' align='center'><input type="checkbox" name="ST_ID[]" value="<?=$r2[0]?>" checked></TD><TD class='row3' align='center'><?=$cnum?></TD>
			<TD>&nbsp;&nbsp;<?=$r2[2]?>&nbsp;<?=$r2[3]?></TD><TD nowrap>&nbsp;&nbsp;<?=$r2[1]?></TD>
			<?php
			$sql4=execute("select * from marks_".$prm."_".$sem." where studid='$r2[0]' and subid=$subn and accyr='$cyr'");
			if(rowcount($sql4)>0)
			{
				$r4=fetcharray($sql4);
				$remarks1=$r4[remks];
				$remarks=stripslashes($remarks1);
			}
			else
			{
				$remarks="";
			}
			$ciewgmks=0;
			$ciemks=0;
			$assm=0;
			for($j=1;$j<=$nocie;$j++)
			{
				if(rowcount($sql4)>0)
				{
					$ass="assmk".$j;
					$assm=$r4[$ass];
					if($assm!="")
					{
						$ciewgmks=$ciewgmks+$wg[$j];
						if($assm!='Ab')
						{
							if($assm>0)
								$ciemks=$ciemks+($assm/$mx[$j]*$wg[$j]);
							else
								$assm=0;
						}
					}
					else
						$assm="";
				}
				else
					$assm="";
				?>
				<td align='center'><input type="Text" Name="<?=$j?>assmk<?=$r2[0]?>" size="5" maxlength="5" value="<?=$assm?>" onchange="return checker('<?=$r2[0]?>','<?=$j?>')"></td>
				<?php
			}
			$ciemsk=round(($ciemks/$ciewgmks*$cie_mxmks),0);
			?>
			<td align='center'><input type="text" Name="imk<?=$r2[0]?>" size="3" maxlength="3" value="<?=$ciemsk?>" readonly></td>
			<td><textarea  Name="remks<?=$r2[0]?>"><?=$remarks?></textarea></td></tr>
			<?php
		}
		echo "</table></td></tr>";
	}
	?>
	</table><br>
	<div align='center'><Input Type="button" Value="<< Add/Modify >>" class='bgbutton' onclick='adddata()'></div>
	<?php
}
?>
</FORM>
</BODY>
</HTML>