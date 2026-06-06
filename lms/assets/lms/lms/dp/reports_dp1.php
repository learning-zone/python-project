<html>
<head>
<?php
session_start();
include("../db1.php");
$accyeardet=$_SESSION['AcademicYear'];
$accyer1=$accyeardet+1; 
if($_REQUEST['course'])
{
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$subject=$_REQUEST['subject'];
	$examid=$_REQUEST['examid'];
	$studentid=$_REQUEST['studentid'];
	$class_section_id=$_REQUEST['class_section_id'];
	$stundetname=$_REQUEST['stundetname'];
	$student_id=$_REQUEST['student_id'];	
}
else
{
	$course=$_POST['course'];
	$subject=$_REQUEST['subject'];
	$sem=$_POST['sem'];
	$examid=$_POST['examid'];
	$studentid=$_POST['studentid'];
	$class_section_id=$_POST['class_section_id'];
	$stundetname=$_POST['stundetname'];
	$student_id=$_POST['student_id'];
	
}
$atttable='att_'.$sem;
$sql=execute("select id,descr  from exam_m where accyear='$accyeardet' and class='$sem' and id<='$examid'");
while($r=fetcharray($sql))
{
	$exam_id_new[]=$r[0];
	$exam_id_name[]=$r[1];
}

$rowwidth=sizeof($exam_id_new);
//student
$studenname=execute("select first_name,last_name,dob,parent_name,m_name,per_address,sms_mobile from student_m where id='$studentid'");
$stundetname1=fetcharray($studenname);
$classname=execute("select year_name from  course_year where year_id='$sem'");
$classname12=fetchrow($classname);

$section=execute("select section_name from class_section where id='$class_section_id'");
$section1=fetchrow($section);
//end

$rs_ec=execute("select * from exam_m where id='$examid'");
while($r1=fetcharray($rs_ec))
{
	$subid=explode(',',$r1['sub_id']);
	$mmks=explode(',',$r1['max_mark']);
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
	$descr=$r1['descr'];
}

$nq2=execute("SELECT count( mor ) , count(after), sum( mor ) , sum(after) FROM $atttable where stu_id='$studentid' and sec='$class_section_id' and att_date between '$fdate' and '$tdate'");
	while($nr2=fetcharray($nq2))
	{
		$cc=$nr2[0]+$nr2[1];
		$ca=$nr2[2]+$nr2[3];
		$ca=$cc-$ca;
		$cc=$cc/2;
		$ca=$ca/2;
	}
?>
</head>
<body>
<form name="frm" action="" method="post">
<?php
echo "
<input type='hidden' name='course' value='$course'>
<input type='hidden' name='sem' value='$sem'>
<input type='hidden' name='examid' value='$examid'>
<input type='hidden' name='studentid' value='$studentid'>
<input type='hidden' name='stundetname' value='$stundetname'>
<input type='hidden' name='student_id' value='$student_id'>
<input type='hidden' name='class_section_id' value='$class_section_id'>";

?>

	<?php
    	$subj=execute("select subject_name,level from subject_m where subject_id=$subject");
		$subj1=fetcharray($subj);
    ?>

        <table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
        <tr>
   <td  align='left'  width="20%">&nbsp;&nbsp;<input  type="image"  src="sys.PNG"/>&nbsp;&nbsp;</td>
  	<td  align='center'  width="50%"> &nbsp;&nbsp;<input type="image"  src="sys name.PNG"/>&nbsp;&nbsp;</td>
  	<td align='right' width="20%">&nbsp;&nbsp;<input  type="image"  src="dp.PNG"/>&nbsp;&nbsp;</td>
    </tr>
    </table>
    <br>
    <br>
        <br>
    <br>
     <table align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
        <tr height="30">
        <td align="center" colspan="7" class="head" ><b>Consolidated Class Test Report - May <?php echo $accyeardet; ?></b></td>
        </tr>
       
        
        <tr height="30">
        <td colspan="7">
        <?
		$dplvl=execute("select level from dp_levels where id='$subj1[1]'");
		$dplvl1=fetcharray($dplvl);
		?>
        <center>
        Name&nbsp;<b>-&nbsp;<?=$stundetname1[0]?> <?=$stundetname1[1]?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subject&nbsp;<b>-&nbsp;<?=$subj1[0];?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Level&nbsp;<b>-&nbsp;<?=$dplvl1[0];?></b>
        </center>
        </td>
        </tr>
<tr><td width='50%' valign="top" style="border-bottom:none; border-top:none; border-left:none; border-right:none;">
<table width='100%' border='1' cellpadding="0" cellspacing="0"><tr>
   <td align='center'  style="border-top:hidden" nowrap >&nbsp;&nbsp;<b> SN </b></td>
  	<td align='center'  style="border-top:hidden" nowrap> &nbsp;&nbsp;<b>Month </b></td>
    <td align='center'  style="border-top:hidden" nowrap>&nbsp;&nbsp;<b> Class Test No </b></td>
  	<td align='center'  style="border-top:hidden" nowrap> &nbsp;&nbsp;<b>Maximum Marks </b></td>
    </tr>
  <?
  $yearname=date("Y");
 ?>  
<?php
$s=1;
$sub_exm=execute("select id, exam_name,mark from dp_exam_sub_sub_m where masterexam='$examid' and class='$sem' and sub_id='$subject'");
while($sub_exm1=fetcharray($sub_exm))
	{
	echo "<tr>
   	<td align='center' width='10%'>&nbsp;&nbsp;$s</td>
  	<td align='left' width='50%'> &nbsp;&nbsp;$sub_exm1[1]</td>
	<td align='center' width='10%'>&nbsp;&nbsp;$s</td>
	<td align='center' width='50%'>&nbsp;&nbsp;$sub_exm1[2]</td></tr>";
	$s++;
	}
	echo "</table></td>";
	?>
<td width='50%' valign="top">
<table width='100%' border='1' cellpadding="0" cellspacing="0" bordercolor="#FF0000" style="border-bottom:none; border-top:none; border-left:none; border-right:none;"><tr>
   <td align='center'  style="border-top:hidden">&nbsp;&nbsp;<b> Scored Marks </b></td>
  	<td align='center'  style="border-top:hidden"> &nbsp;&nbsp;<b> %</b></td>
    <td align='center'  style="border-top:hidden">&nbsp;&nbsp;<b> Grade</b></td>
    <?
	$yearpoint=execute("SELECT name FROM `dp_grade_point` where (('$totmak' between from_point and to_point) or (from_point='$totmak' or to_point='$totmak')) and level_id");
			$yearpoint1=fetchrow($yearpoint);	
  ?>  
	<?
	$percen='';
	
$mark_exm=execute("select mark,maxmark from dp_marks where sem_id='$examid' and student_id='$studentid' and subject_id='$subject'");
while($mark_exm1=fetcharray($mark_exm))
	{	
	$percen=($mark_exm1[0]*100)/$mark_exm1[1];
	$percen1=round($percen,0);
	
	
	$yearpoint=execute("SELECT tot_point FROM `dp_grade_point` where (('$percen1' between from_point and to_point) or (from_point='$percen1' or to_point='$percen1')) and level_id='$subj1[1]'");
			$yearpoint1=fetchrow($yearpoint);	
	
	
echo  "<tr><td align='center' width='30%'>&nbsp;&nbsp;$mark_exm1[0]</td>
			<td align='center' width='30%'>&nbsp;&nbsp;$percen1</td>
			<td align='center' width='30%'>&nbsp;&nbsp;$yearpoint1[0]</td></tr>";
	
	}
	echo "</table></td>";
?>  	

</table>	
<br>	
<br>	
<br>	
<br>	
<br>	  
<table width="90%" border="0" align="center" cellspacing="0" cellpadding="0" >
  <tr>
    <td  align="center">------------------</td>
    <td  align="center">------------------</td>
    <td  align="center">------------------</td>
    <td  align="center">------------------</td>
  </tr>
  <tr>
    <td align="center"><strong>Faculty</strong></td>
    <td align="center"><strong>DPC</strong></td>
    <td align="center"><strong>Parent</strong></td>
    <td  align="center"><strong>Student</strong></td>
  </tr>
  </table>
 