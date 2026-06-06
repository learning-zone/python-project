<?php
$file_type = "vnd.ms-excel";
$file_name= "consolidated_report_of_MYP5_Semester_1_Dec_2013.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");
?>
<html>
<head>
<title>Consolidated Report of MYP5 Semester 1 Dec 2013</title>
<?php
session_start();
include("../db1.php");

$course=$_REQUEST['course'];
$sem=$_REQUEST['sem'];
$examid=$_REQUEST['examid'];
$class_section_id=$_REQUEST['class_section_id'];
$studentid=$_REQUEST['studentid'];
$accyeardet=$_SESSION['AcademicYear'];

$descr=fetcharray(execute("select descr,t_date from exam_m where id='$examid'"));
$tidatesss=$descr['t_date'];

$classname=execute("select year_name from  course_year where year_id='$sem'");
$classname12=fetcharray($classname);
//echo $descr[0];

$sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N'";
$sql123.=" and course_yearsem=$sem";
$sql123.=" and academic_year 	='$accyeardet'";
$sql123.=" order by first_name ASC";
$rs=execute($sql123) ;

  ?>
   <?php
	$c=0;
    $subcunt=execute("select subject_name from myp_all_stud where class='$sem' group by sub order by sub_order");
    while($subcunt2=fetcharray($subcunt))
    {
	$c++;
    }
    ?>
  
  <table width="100%" border="1" cellspacing="0"  align="center" cellpadding="3">
<tr>    
    <td colspan="<?=$c+3?>"  align="center" nowrap><b><font size="+2">Consolidated Report of <?=$classname12[0]?> - <?=$descr[0]?> - <?php echo date("M Y",strtotime($tidatesss));  ?></font></b></td>    
</tr>

    <tr>
    <td  nowrap>Sl No.</td>    
    <td align="center"  nowrap>Name</td>
    <td align="center"  nowrap>Student Id</td>
    <td align="center" colspan="<?=$c?>"  nowrap><b>Subjects</b></td>
    </tr>
    <tr>
    <td  nowrap>&nbsp;</td>    
    <td align="center"  nowrap>&nbsp;</td>
    <td align="center"  nowrap>&nbsp;</td>
	<?php
    $subgd=execute("select subject_name from myp_all_stud where class='$sem' group by sub order by sub_order");
    
    while($subgdw=fetcharray($subgd))
    
    {
    ?>
    <td align="center"  nowrap><?=$subgdw[0]?></td>
    <?php
    }
    ?>
  </tr>
 <?php
  $i=1;
  while($r1=mysql_fetch_array($rs))
  { 
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name]&nbsp;$r1[last_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>";
    $submark=execute("select sub from myp_all_stud  where class='$sem' group  by sub order by sub_order");
    while($submark3=fetcharray($submark))
    {
		
		$markg=fetcharray(execute("select grade_last from myp_all_stud where exam_id='$examid' and stud='$r1[0]' and sub='$submark3[0]'"));
	
	/*if($markg[0])
		{
			$markg[0]=$markg[0];
		}
		else
		{
			$markg[0]='NA';
		}*/
	
	echo "<td nowrap align='center'><b>$markg[0]</b></td>";
    }
  
$i++;  
  }
  ?>
  
</table>

</form>
</body>
</html>