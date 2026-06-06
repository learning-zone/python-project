<?php
$file_type = "vnd.ms-excel";
$file_name= "Student_Class_Wise_Report.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");

	session_start();
	include("../db.php");
	//print_r($_POST);
	$academic_year=$_SESSION['AcademicYear'];
	$grdes=$_POST['grdes'];
	$test=$_POST['test'];
	$alls=$_POST['alls'];

	$staffrigtss=fetcharray(execute("SELECT groupname FROM `users` where username='$user'"));

	?>
<html>
<head>
<title>Student Class Wise Report</title>
</head>
<body>
<form Name="frm"  method="post">     
<input type="hidden" name="test" value="<?=$test?>"/>
<input type="hidden" name="grdes" value="<?=$grdes?>"/>
  <br>

  <?php
 
  $allstrud = "select a.id,a.codename,a.section_name,a.sub,a.grade,b.stu_id from class_section a,student_course b,student_m c where a.status=1 and a.id=b.sub_sec and b.acc_year='$academic_year' and c.archive='N' and c.id=b.stu_id  group by a.id,b.stu_id order by a.grade,a.codename,a.section_name ";
	 $rs22=execute($allstrud) ;
  ?>
  <br>
  <?php
   $m=1;
  while($r3=fetcharray($rs22))
  { 
   $allteacds44= fetchrow(execute("select first_name,last_name,student_id from student_m where id='$r3[5]'"));
  
 
  $classnames1= fetchrow(execute("select sub_teac,sub_teac2 from all_teachers where section='$r3[0]' and ( sub_teac!=0 or sub_teac2!=0)"));
  if(!$classnames1[0])
  $classnames1[0]=$classnames1[1];
  
   $clasnm1= fetchrow(execute("select f_name,s_name from staff_det where id='$classnames1[0]'"));
    
   $classection= fetchrow(execute("select codename,section_name from class_section where id='$r3[0]'"));
  $tempnew=$classection[0].$classection[1];
	if($newstaff!=$tempnew)
	{
		?></table><br>
          <br style="page-break-before: always;" clear="all" />

   <table width="60%" border="1" cellspacing="0"  align="center" cellpadding="0">
  <tr>
      <td colspan="5" class="head" align="center"nowrap>Class&nbsp;:&nbsp;<?=$classection[0]?>-<?=$classection[1]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Faculty&nbsp;:&nbsp;<?=$clasnm1[0]?>&nbsp;<?=$clasnm1[1]?></td>
  </tr> 
<tr>
    <td width="3%"  class="head" align="center"   nowrap>Sl No.</td>
    <td width="10%" class="head"  align="center"  nowrap>Name</td>
    <td  width="10%" class="head"  align="center" nowrap>Student Id</td>
    <td  width="10%" class="head"  align="center" nowrap>Course</td>
     <td  width="10%" class="head"  align="center" nowrap>Faculty</td>   
    </tr>     
        <?php
		 $m=1;
	}
	
 
  echo "<tr>
    <td align='center' nowrap>&nbsp;$m</td>
    <td nowrap>&nbsp;$allteacds44[0] $allteacds44[1]</td>
    <td nowrap align='center'>&nbsp;$allteacds44[2]</td>
    <td nowrap align='center'>$classection[0]-$classection[1]</td>
<td nowrap >&nbsp;$clasnm1[0]&nbsp;$clasnm1[1]</td>
    ";
	?>
  </tr><?php
  
  $newstaff=$classection[0].$classection[1];
  
$m++;  }
  ?>
  </table>

</form>
</BODY>
</HTML>
