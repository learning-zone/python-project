<?php
$file_type = "vnd.ms-excel";
$file_name= "TolerancesReport.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");


?>
<html>
<head>
<script  LANGUAGE="JavaScript">
function reloadme()
	{
		document.frm.action="class_reports_print.php";
		document.frm.submit();
	}
</script>
<SCRIPT LANGUAGE="JavaScript">
function printReport()
{
//	prn.style.display="none";
	//window.print();
}
</SCRIPT>
<style type="text/css">
table.fntstyles
{ 
  font-family: Calibri;
}
</style>
</head>
 <?php
	session_start();
	include("../db.php");
//	print_r($_POST);
	$academic_year=$_SESSION['AcademicYear'];
	$section=$_REQUEST['section'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$daysless=$_POST['daysless'];
	
	
	$per=$_POST['per'];
	if($per)
	{
		$type=1;
	}
	else
	$type=2;
	$days=$_POST['days'];
	
	$section1=$_POST['section'];
	$code=$_POST['code'];
	
	$f=explode('/',$adate);
	$t=explode('/',$bdate);
	$fd="$f[2]-$f[1]-$f[0]";	
	$td="$t[2]-$t[1]-$t[0]";	
	?>

<body onLoad="printReport()">
<form Name="frm"  method="post"> 
<input type="hidden" name="section" value="<?=$section?>"/>

		<div align='center' style="font-family:Calibri; font-size:22px"><b>Tolerances Report</b></div>
		<br>
<?php
for($m=0;$m<sizeof($code);$m++)
{  
	for($k=0;$k<sizeof($section1);$k++) 
	{ 
		echo "<br>";
		$section=$section1[$k]; 
		$sectvats = fetchrow(execute("select codename,section_name,grade,sub from class_section where id='$section'")); 
		
		
		$classnames1q= fetchrow(execute("select sub_teac,sub_teac2 from all_teachers where section='$section' and ( sub_teac!=0 or sub_teac2!=0)"));
		if(!$classnames1q[0])
		$classnames1q[0]=$classnames1q[1];
		
		$allteac= fetchrow(execute("select f_name,s_name from staff_det where id='$classnames1q[0]'"));
		
		$yearnames= fetchrow(execute("select year_name from course_year where year_id='$sectvats[2]'"));
		
		$subjectsnames= fetchrow(execute("select subject_name from subject_m where subject_id='$sectvats[3]'"));
		
		$sql123="select a.id,a.student_id,a.first_name, a.last_name, a.admission_id, a.course_yearsem from student_m a,student_course b,student_m c  where b.stu_id=a.id and b.sub_sec='$section'  and c.archive='N' and c.id=b.stu_id   and b.acc_year='$academic_year' ";
		
		$sql123.=" group by b.stu_id order by a.first_name";
		
		$rs=execute($sql123);
		
		$i=1;
		while($r1=fetcharray($rs))
		{  
			$coursssvat = fetchrow(execute("select year_name from course_year where year_id='$r1[course_yearsem]'")); 
			$fd;
			$td;
			$tablename="att_$sectvats[2]";
			$section;
			$r1[id];
			$tcount=fetchrow(execute("select count(id) from $tablename where (att_date between '$fd' and '$td') and sec='$section'  and  stu_id='$r1[id]' "));
			$c=$code[$m];
			$scount=fetchrow(execute("select count(id) from $tablename where (att_date between '$fd' and '$td') and  sec='$section' and mor='$c' and stu_id='$r1[id]'  "));
			$sts=1;
			if($scount[0])
			{
				$totper1=0;
				$totper=0;
				if($per)
				{
					//total=nof days 25 - ab  4
					$totper1=$tcount[0]-$scount[0];  // total days $tcount[0]
					$totper=($totper1*100)/$tcount[0];
					if($per>=$totper)
					$sts=0;
				}
				else if($daysless)
				{
					if($days>=$scount[0])
					$sts=0;
				}
				else
				{
					//$totper=$tcount[0]-$scount[0];
					if($days<=$scount[0])
					$sts=0;
				}
			}
			if(!$sts)
			{
				
				$codename=fetchrow(execute("select Description from attendance_points where order_id='$code[$m]'"));
				?>
                <br>
                <table align='center' border="1" width="90%" cellpadding="0" cellspacing="0" class="fntstyles">
                <tr>
                <td colspan="2" align='center' ><b>Class&nbsp;:&nbsp;<?=$sectvats [0]?>-<?=$sectvats[1]?></b></td>
                <td align='center' ><b>Course&nbsp;:&nbsp;<?=$yearnames[0]?></b></td>
                <td align='center' ><b>Subject&nbsp;:&nbsp;<?=$subjectsnames[0]?></b></td>
                <td align='center' ><b>Code&nbsp;:&nbsp;<?=$codename[0]?></b></td>
                </tr>
                
                <tr>
                <td width="3%"   align="center"   nowrap>Sl No.</td>
                <td width="10%"   align="center"  nowrap>Name</td>
                <td  width="10%"   align="center" nowrap>Student Id</td>
                <td  width="10%"   align="center" nowrap>Date</td>
                <td  width="10%"   align="center" nowrap>Des</td>
                </tr>
                    
                <?php
				$sql5=execute("select att_date, att_desc from $tablename where stu_id='$r1[id]' and sec='$section' and mor='$c' and (att_date between '$fd' and '$td') and stu_id='$r1[id]'");
				while($r5=fetcharray($sql5))
				{
					echo "<tr>
					<td align='center' nowrap>&nbsp;$i</td>
					<td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
					<td nowrap align='center'>&nbsp;$r1[student_id] </td>
					<td nowrap align='center'>&nbsp;$r5[0]</td>
					<td nowrap align='center'>&nbsp;$r5[1]</td></tr>
					";
					$i++;  
				}
			?>
            
            </table>
            <?php
			}
			
		}
		 
	}
}
?> 
</form>
</div>
</BODY>
</HTML>
