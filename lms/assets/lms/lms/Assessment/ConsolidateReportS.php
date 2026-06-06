<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='ConsolidateReportS.php';
	document.frm.submit();
	
}
function reload1()
{
	document.frm.action='ReportCard1.php';
	document.frm.submit();
	
}

</SCRIPT>
</HEAD>

<body>
<?php

session_start();
require("../db.php");

if($_POST)
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$a_year=$_POST['a_year'];
	$subject=$_POST['subject'];
}
else
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$a_year=$_SESSION['AcademicYear'];
} 
$maintablename="marks_".$a_year."_".$sem;
$class_section_id=$_POST['class_section_id'];
echo '<form name="frm" action="" method="post" >';	
?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head" nowrap>Subject Wise Consolidate Report card</td>
  </tr>
  <tr height="25">
<td nowrap>&nbsp;&nbsp;Academic Year</td>
            <td>&nbsp;<select name="a_year" id="a_year" onchange='reload()'>
                <option value='0'>--Select--</option>
                <?php
				   $MyYear=date('Y')-1;
				   $CurrentYr=date("Y")+2;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}

						?>
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php
					 }
						   ?>
              </select></td>
  </tr>
   
  <tr>
    <td>&nbsp;&nbsp;School Division</td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">------Select-----</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=fetcharray($rs);

						if($branch==$r[course_id])
						{
							?>
							<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
							<?php
						}
						else
						{
							?>
							<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
							<?php
						}
					}
				?>
			</select>
	</td>
		
  </tr>
  <tr>
   <td>&nbsp;&nbsp;Class </td>
		<td>&nbsp;<select name="sem" onChange="reload()">
			<option value='-1'>-----Select----</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected> $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'> $r[year_name]</option>";
					}
				}
			?>
			</select>

		</td>
  </tr>
  <tr>
  <td height="28">&nbsp;&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="reload()">
<?
$rs_section=execute("select * from class_section");
echo "<option value='-1'>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($class_section_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

}
?>
</select>
</td>
  </tr>
  <tr>
	<td>&nbsp;&nbsp;Subject Name</td><td>&nbsp;<select name="subject" onChange="reload()">
	<option value="0">Select Subject </option>
<?php
	$sql3=execute("select subject_id, subject_name from subject_m where course_id='$branch' and course_year_id='$sem' and status='1' order by sub_pre") or die(mysql_error());
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[0]==$subject)
		{
			echo "<option value=$r3[0] selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value=$r3[0]>$r3[1]</option>";
		}
	}
?>
</select>
</td>
</tr>
</table>
 <br>

<table  border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <?php
  if($class_section_id=='-1' or $class_section_id=='')
  die();
  $sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N'";
	if($branch!=0)
	{
	$sql123.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	$sql123.=" order by gender desc,first_name";
	$rs=execute($sql123) or die(mysql_error());
	
	
	$sql12="select count(id) from student_m where id is not null and archive='N'";
	if($sem!=0)
	{
	$sql12.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql12.=" and class_section_id=$class_section_id  ";
	}
//code for counnt

		$stdetncount=fetcharray(fetcharray($sql12));

		$yearstt=execute("SELECT id , per_info, mark, exam_name, exam_sub_name
FROM `exam_year_m` where`acc_year`='$a_year' and `class`='$sem' and status=1 order by order_id");
	
$km1=0;
	while($yearstt1=fetcharray($yearstt))
	{			
		
		$yearsub=execute("SELECT id , subject_id , exam_sub_name , per_info , mark
FROM `exam_sub_m` where`acc_year`='$a_year' and `class`='$sem' and exam_id='$yearstt1[0]' and subject_id='$subject' and section='$class_section_id' and status=1 order by order_id");
		while($yearsub1=fetcharray($yearsub))
		{	  
			$km1++;	
			$yearsubsub=execute("SELECT id , exam_sub_name , per_info , mark
FROM `exam_sub_sub_m` where exam_id='$yearsub1[0]' and status=1 order by order_id");
			while($yearsubsub1=fetcharray($yearsubsub))
			{	 
   							
				if(rowcount($yearsubsub)!=1)
				{
					$km1++;
				}
			}
   				

		}
		$km1=$km1+2;
	}
$sql3name=fetchrow(execute("select subject_name from subject_m where subject_id='$subject'"));
echo "<tr>
    <td class='head'>&nbsp;</td>
    <td class='head'>&nbsp;</td>
	    <td class='head'>&nbsp;</td>
   <td  class='head' colspan='$km1' align='center'>$sql3name[0]</td></tr>";
//count end 

?>
<tr>
    <td   class="row3" nowrap>Sl No.</td>
    <td align="center" class="row3" nowrap>Name</td>
    <td align="center" class="row3" nowrap>Student Id</td>
    
<?php
		$stdetncount=fetcharray(fetcharray($sql12));

		$yearstt=execute("SELECT id , per_info, mark, exam_name, exam_sub_name
FROM `exam_year_m` where`acc_year`='$a_year' and `class`='$sem' and status=1 order by order_id");

	while($yearstt1=fetcharray($yearstt))
	{			
		
		$yearsub=execute("SELECT id , subject_id , exam_sub_name , per_info , mark
FROM `exam_sub_m` where`acc_year`='$a_year' and `class`='$sem' and exam_id='$yearstt1[0]' and subject_id='$subject' and section='$class_section_id' and status=1 order by order_id");
		while($yearsub1=fetcharray($yearsub))
		{	  
			$yearsubsub=execute("SELECT id , exam_sub_name , per_info , mark
FROM `exam_sub_sub_m` where exam_id='$yearsub1[0]' and status=1 order by order_id");
			while($yearsubsub1=fetcharray($yearsubsub))
			{	 
   								
				if(rowcount($yearsubsub)!=1)
				{
					echo "<td align='center' class='row3' nowrap>$yearsubsub1[exam_sub_name]</td>";
				}
			}
   				echo "<td align='center' class='row3' nowrap>$yearsub1[exam_sub_name]</td>";

		}
		
		echo "<td align='center' class='row3' nowrap>$yearstt1[exam_name]</td>";
		
		echo "<td align='center' class='row3' nowrap>Grade</td>";
	}

echo "</tr>";
  $i=1;
  while($r1=fetcharray($rs))
  { 
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name]</td>
    <td align='center' nowrap>&nbsp;$r1[student_id]</td>
    ";
	
	
	
		$yearstt=execute("SELECT id , per_info, mark, exam_name, exam_sub_name
FROM `exam_year_m` where`acc_year`='$a_year' and `class`='$sem' and status=1 order by order_id");
$m=1;
	while($yearstt1=fetcharray($yearstt))
	{			
		$semmax=$yearstt1['mark'];
		$yearsub=execute("SELECT id , subject_id , exam_sub_name , per_info , mark
FROM `exam_sub_m` where`acc_year`='$a_year' and `class`='$sem' and exam_id='$yearstt1[0]' and subject_id='$subject' and section='$class_section_id' and status=1 order by order_id");
		$s=1;
		$tablename="sem".$m;
		while($yearsub1=fetcharray($yearsub))
		{	  
			$tablename="sem".$m."_int".$s;
			$semsubmax=$yearsub1['mark'];
			$yearsubsub=execute("SELECT id , exam_sub_name , per_info , mark
FROM `exam_sub_sub_m` where exam_id='$yearsub1[0]' and status=1 order by order_id");
			$ss=1;
			$tot='';
			$semsubsubmaxtot=0;
			$semsubsubmax=0;
			while($yearsubsub1=fetcharray($yearsubsub))
			{	 
   				
				$semsubsubmax=$yearsubsub1['mark'];
				$tablename="sem".$m."_int".$s."_tst".$ss;
				$studentmark1=fetchrow(execute("select $tablename from $maintablename where class_section='$class_section_id' and student_id='$r1[id]' and subject_id='$subject'"));
				
				echo "<td align='center' nowrap>$studentmark1[0] </td>";
				
				if($studentmark1[0]!='A')
				{
					$semsubsubmaxtot=$semsubsubmax+$semsubsubmaxtot;
					$tot=$studentmark1[0]+$tot;
				}
				else
				$tot="A";
				$ss++;
				}
				if($semsubmax==$semsubsubmaxtot)
				{
					echo "<td align='center' nowrap><b>$tot<b></td>";
					$maxtotal=$tot+$maxtotal;
					
				}
				else
				{
					echo "<td align='center' nowrap><b>".round((($tot*$semsubmax)/$semsubsubmaxtot),1)."<b></td>";
					$maxtotal=round((($tot*$semsubmax)/$semsubsubmaxtot),1)+$maxtotal;
				}
			$consolitedmark=$semsubmax+$consolitedmark;
			$s++;
		}
		if($consolitedmark==$semmax)
		{
		
			echo "<td align='center' nowrap>".round($maxtotal)."</td>";
			$mxam=execute("SELECT name FROM grade WHERE $maxtotal BETWEEN g_from AND g_to");	
			$maxmark=fetchrow($mxam);
			
			echo "<td align='center' nowrap>$maxmark[0]</td>";
		}
		else
		{
			echo "<td align='center' nowrap>".round($maxtotal)."</td>";
			$mxam=execute("SELECT name FROM grade WHERE $maxtotal BETWEEN g_from AND g_to");	
			$maxmark=fetchrow($mxam);
			echo "<td align='center' nowrap>$maxmark[0]</td>";
		}
	$m++;
	
	$maxtotal=0;
	$consolitedmark=0;
	}

	
	?>  </tr><?php

$i++;  }
  ?>
  
</table>
<!--
<br>
<div align="center"><input type="button" name="open" value="View All" onClick="reload1()"></div>-->				
</form>
</body>
</html>
