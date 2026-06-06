<?php
session_start();
require("../db1.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$a_year=$_POST['a_year'];
	$subject=$_POST['subject'];

$file_type = "vnd.ms-excel";
$file_name= "ConsolidateReport.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");

?><html>
<HEAD>

<body>
<?php


$maintablename="marks_".$a_year."_".$sem;
$class_section_id=$_POST['class_section_id'];
echo '<form name="frm" action="" method="post" >';	
?>

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


$sqname=execute("select a.subject_id, a.subject_name from subject_m a, $maintablename b where a.course_id='$branch' and a.course_year_id='$sem' and a.status='1' and a.subject_id=b.subject_id and b.class_section='$class_section_id' group by b.subject_id  order by a.sub_pre");
while($subjectid1=fetcharray($sqname))
{
		$subject=$subjectid1[0];
		$subject_id[]=$subject;
		$subjectname1[]=$subjectid1[1];


		$yearstt=execute("SELECT id , per_info, mark, exam_name, exam_sub_name
FROM `exam_year_m` where`acc_year`='$a_year' and `class`='$sem' and status=1 order by order_id");
	
	$km1=0;
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
					$km1++;
				}
			}
   			$km1++;

		}
		$km1=$km1+2;
		
	}
	$km2[]=$km1;
}
$sql3name=fetchrow(execute("select subject_name from subject_m where subject_id='$subject'"));
echo "<tr>
    <td class='head'>&nbsp;</td>
    <td class='head'>&nbsp;</td>
	    <td class='head'>&nbsp;</td>";
   
   for($kmi=0;$kmi<sizeof($subjectname1);$kmi++)
   {
   		echo "<td  class='head' colspan='".$km2[$kmi]."' align='center' nowrap >$subjectname1[$kmi]</td>";
   
   }
//count end 

?></tr>
<tr>
    <td   class="row3" nowrap>Sl No.</td>
    <td align="center" class="row3" nowrap>Name</td>
    <td align="center" class="row3" nowrap>Student Id</td>
    
<?php
$stdetncount=fetcharray(fetcharray($sql12));
$sqname=execute("select a.subject_id, a.subject_name from subject_m a, $maintablename b where a.course_id='$branch' and a.course_year_id='$sem' and a.status='1' and a.subject_id=b.subject_id and b.class_section='$class_section_id' group by b.subject_id  order by a.sub_pre");
while($subjectid1=fetcharray($sqname))
{
		$subject=$subjectid1['subject_id'];
		$subjectname1[]=$subjectid1['subject_name'];

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
}
echo "</tr>";
  $i=1;

	$rs=execute($sql123) or die(mysql_error());
	 while($r1=fetcharray($rs))
	  { 
	  echo "<tr>
		<td nowrap>&nbsp;$i</td>
		<td nowrap>&nbsp;$r1[first_name]</td>
		<td align='center' nowrap>&nbsp;$r1[student_id]</td>
		";
		
for($kmi=0;$kmi<sizeof($subject_id);$kmi++)
{
	
	$subject=$subject_id[$kmi];
		
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
				$studentmark=fetchrow(execute("select $tablename from $maintablename where class_section='$class_section_id' and student_id='$r1[id]' and subject_id='1' order by order_id"));
				$tot='';
				$semsubsubmaxtot=0;
				$semsubsubmax=0;
				while($yearsubsub1=fetcharray($yearsubsub))
				{	 
					
					$semsubsubmax=$yearsubsub1['mark'];
					$tablename="sem".$m."_int".$s."_tst".$ss;
					$studentmark1=fetchrow(execute("select $tablename from $maintablename where class_section='$class_section_id' and student_id='$r1[id]' and subject_id='1'"));
					
				if(rowcount($yearsubsub)!=1)
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
		$m++;
		$maxtotal=0;
		$consolitedmark=0;
		}
	  
}

		echo "</tr>";
	$i++;  
	}
	  




?>  
</table>
		
</form>
</body>
</html>
