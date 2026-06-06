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
	window.print();
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
	include("../db1.php");
	//print_r($_POST);
	$academic_year=$_SESSION['AcademicYear'];
	$section=$_REQUEST['section'];

	?>

<body onLoad="printReport()">


<form Name="frm"  method="post">     
<input type="hidden" name="section" value="<?=$section?>"/>
  <?php
   $sectvats = fetchrow(execute("select codename,section_name,grade,sub from class_section where id='$section'")); 
   
   
    $classnames1q= fetchrow(execute("select sub_teac,sub_teac2 from all_teachers where section='$section' and ( sub_teac!=0 or sub_teac2!=0)"));
  if(!$classnames1q[0])
  $classnames1q[0]=$classnames1q[1];
  
   $allteac= fetchrow(execute("select f_name,s_name from staff_det where id='$classnames1q[0]'"));
   
    $yearnames= fetchrow(execute("select year_name from course_year where year_id='$sectvats[2]'"));
    
        $subjectsnames= fetchrow(execute("select subject_name from subject_m where subject_id='$sectvats[3]'"));
        
   	$sql123.="select a.id,a.student_id,a.first_name,a.last_name,a.admission_id,a.course_yearsem from student_m a,student_course b,student_m c  where b.stu_id=a.id and b.sub_sec='$section'  and c.archive='N' and c.id=b.stu_id   and b.acc_year='$academic_year' ";
	
	 $sql123.=" group by b.stu_id order by a.first_name";
	
	$rs=execute($sql123) or die(mysql_error());
  ?>
 <table align='center' border="0" width="90%" cellpadding="0" cellspacing="0">
    <tr>
     <td align='center' style="font-family:Calibri; font-size:22px"><b>Class Report</b></td>
    </tr>
</table>
	<br>

 <table align='center' border="0" width="90%" cellpadding="0" cellspacing="0" class="fntstyles">
    <tr>
     <td align='center' ><b>Class&nbsp;:&nbsp;<?=$sectvats [0]?>-<?=$sectvats[1]?></b></td>
     <td align='center' ><b>Course&nbsp;:&nbsp;<?=$yearnames[0]?></b></td>
    <td align='center' ><b>Subject&nbsp;:&nbsp;<?=$subjectsnames[0]?></b></td>
    <td align='center' ><b>Faculty&nbsp;:&nbsp;<?=$allteac[0]?>&nbsp;<?=$allteac[1]?></b></td>
    </tr>
</table>
	<br>
  <table width="90%" border="1" cellspacing="0"  align="center" cellpadding="0" class="fntstyles">
<tr>
    <td width="3%"   align="center"   nowrap>Sl No.</td>
    <td width="10%"   align="center"  nowrap>Name</td>
    <td  width="10%"   align="center" nowrap>Student Id</td>
    </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  {  
  $coursssvat = fetchrow(execute("select year_name from course_year where year_id='$r1[course_yearsem]'")); 

 
  echo "<tr>
    <td align='center' nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>
    ";
	?>
  </tr><?php
$i++;  }
  ?>
  </table>
</form>
</div>
</BODY>
</HTML>
