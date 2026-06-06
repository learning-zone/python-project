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
	$table = main_att."_".$ctype."_".$sem;
?>
<body>
<?
$course=$_POST['course'];

$FromYear=$_POST['FromYear'];

$adate=$_POST['adate'];

$sem=$_POST['sem'];

$sub=$_POST['sub'];
$tempdate=explode('/',$adate);
$adate=$tempdate[2]."-".$tempdate[1]."-".$tempdate[0];
$class_section_id=$_POST['class_section_id'];
		$res = execute("select coursename from course_m where course_id='$ctype'");
		$rr = fetcharray($res);
		$res2 = execute("select year_name from course_year where year_id='$sem'");
		$rr1 = fetcharray($res2);
		$res3 = execute("select section_name from class_section where id='$section'");
		$rr2 = fetcharray($res3);
		$res4 = execute("select subject_name from subject_m where subject_id='$sub'");
		
		$rr3 = fetcharray($res4);
		$res4 = execute("select adate from $table where adate='$adate'");
		$rr4 = fetcharray($res4);

?>
<FORM NAME=frm METHOD=POST >
<table width="70%" align="center" class='forumline' border="1" cellspacing="0" cellpadding="0">
<tr>
<td colspan="6" class="head" align="center"><strong>Daywise Attendance Report
<br/><strong>Curriculam :<?php echo $rr[coursename]?>&nbsp;&nbsp;Class:<?php echo $rr1[year_name]; ?>
&nbsp;&nbsp;Section : <?php echo $rr2[section_name]; ?>&nbsp;&nbsp; Subject:<?php echo $rr3[subject_name]; ?>&nbsp;&nbsp;Date:<?php echo $rr4[adate]; ?></strong>
</td>
</tr>
<tr>
<td >SlNo.</td>
<td  nowrap>Student id</td>
<td  nowrap>Student Name</td>
 <td  nowrap>Class Conducted</td>
 <td  nowrap>Class Attended</td>
</tr>
<?php
 $sql="SELECT id , student_id , first_name FROM student_m where course_admitted ='$ctype' and course_yearsem='$sem' and class_section_id='$section' order by student_id ";
 $rs=execute($sql) or die(mysql_error());
      if(rowcount($rs)==0)
	{
		echo "<font color=brown><b>No Records Found !!</b></font>";
		die();
}

echo $class;
$rowclass=1;
for($i=0;$i<rowcount($rs);$i++)
{
$r=fetcharray($rs);
?>

<tr class='row<?php echo $rowclass ?>' height='25'>
		<td align="center" ><?=$i+1?></td>
        <td align="center" ><?=$r[student_id]?></td>
      <td >&nbsp;&nbsp;<?=$r[first_name]?></td>
	  <?php
	      $sql124=execute("select count(tot_class) from $table where adate='$adate' and stat_s=1");
	        $noofclass=fetchrow($sql124);
	  ?>
	   <td nowrap >&nbsp;&nbsp;<?php echo $noofclass[0]; ?>&nbsp;</td>
	   <?php
            	 $sql123=execute("select cc,ca,s abs_stu_id from $table where adate='$adate' and stat_s=1 and tot_abs >0 ");
				  $absstudent=fetchrow($sql123);
				  $data=explode(',',$absstudent[0]);
				  for($i=0;$i<count($data);$i++)
				  {
				   $data[$i]."<br>";
				  }
			?> 

     <td nowrap >&nbsp;&nbsp;&nbsp;</td>
	    
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