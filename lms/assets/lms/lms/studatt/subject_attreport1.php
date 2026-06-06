<HTML>
<head>
<SCRIPT LANGUAGE="JavaScript">
	function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
</script>
</head>
<?php
session_start();
include("../db.php");
?>
<body>
<?
$course=$_POST['course'];
$FromYear=$_POST['FromYear'];
$class_section_id=$_POST['class_section_id'];
$sub=$_POST['sub'];
$table = "marks_".$course."_".$FromYear;
$temp_value_det=date("Y");
$temp_month_detalis=date("m");
if($temp_month_detalis<5)
{
	$temp_year_detalis=$temp_value_det-1;
}
else
{
	$temp_year_detalis=date("Y");
}

$res = execute("select coursename from course_m where course_id='$course'");
$rr = fetcharray($res);
$res2 = execute("select year_name from course_year where year_id='$FromYear'");
$rr1 = fetcharray($res2);
$res3 = execute("select section_name from class_section where id='$class_section_id'");
$rr2 = fetcharray($res3);
$res4 = execute("select subject_name from subject_m where subject_id='$sub'");
$rr3 = fetcharray($res4);

?>
<FORM NAME='frm' METHOD='POST' >
<br>
  <table width="70%" align="center" class='forumline' border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="6" class="head" align="center"><strong>Subject wise Attendance Report </strong>
     </td>
     </tr>
     <tr>
      <td colspan="6" class="head" align="center"><strong>Curriculam : <?php echo $rr[coursename]; ?>  Class : <?php echo $rr1[year_name]; ?>
      Section : <?php echo $rr2[section_name]; ?> Subject : <?php echo $rr3[subject_name]; ?></strong></td>
    </tr>
    <tr>
      <td >SlNo.</td>
      <td  nowrap>Student id</td>
      <td  nowrap>Student Name</td>
      <td  nowrap>Class Conducted</td>
      <td  nowrap>Class Attended</td>
      <td  nowrap>Percentage</td>
    </tr>
	<?php
	 $sql="SELECT a.id, a.student_id,a.first_name FROM student_m a, student_course b where b.div ='$course' and b.sub_sec='$class_section_id' and b.sub='$sub' and a.id=b.stu_id and b.acc_year='$temp_year_detalis'";
	
	 
$rs=execute($sql) or die(mysql_error());
     if(rowcount($rs)==0)
	{
		echo "<font color=brown><b>No Records Found !!</b></font>";
		die();
	}

    $rowclass=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
	 $r=fetcharray($rs);
?>
<?php


$percentage = round($r[ca] * 100 / $r[cc]);

?>
<tr class='row<?php echo $rowclass ?>' height='25'>
		<td align="center" ><?=$i+1?></td>
        <td align="center" ><?=$r[student_id]?></td>
      <td >&nbsp;&nbsp;<?=$r[first_name]?></td>
	   <td nowrap >&nbsp;&nbsp;<?=$r[cc]?>&nbsp;</td>
	   <td nowrap >&nbsp;&nbsp;<?=$r[ca]?>&nbsp;</td>
	    <td nowrap >&nbsp;&nbsp;<?php echo $percentage; ?>&nbsp;</td>
</tr>
<?php
	$rowclass = 1 - $rowclass;
	}
?>
  
  </table>
<br>

<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
</div>
</FORM>
</HTML>