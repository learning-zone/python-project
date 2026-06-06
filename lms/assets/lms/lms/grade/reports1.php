<html>
<head>
<style type="text/css">
	p.vertical
	 {
		   writing-mode:tb-lr;
		   -webkit-transform:rotate(270deg);
		   -moz-transform:rotate(270deg);
		   -o-transform: rotate(270deg);
		   white-space:nowrap;
		   display:block;
		   bottom:0;
		   width:90px;
		   height:120px; 
		   position:relative;
		   left:110px;
		   top:0px;
	}
</style>
<?php
session_start();
include("../db1.php");

$name=execute("SELECT *  FROM college");
	 while($rc=fetcharray($name))
	{
		$_SESSION['SchoolName']=$rc['col_name'];
		$_SESSION['SchoolCode']=$rc['col_code'];
		$_SESSION['SchoolAddress']=$rc['col_addr']." ".$rc['col_city']." ".$rc['col_state']." Pin : ".$rc['col_pin'];
	}
	$date1=date("Y-m-d");
	$sql_id=fetchrow(execute("select acc_year from academic_year where  status=1 and ( '$date1' Between from_date and to_date )"));
	
	
	$a_year=$sql_id[0];


//$a_year=$_SESSION['AcademicYear'];
$accname=$a_year+1;
$accname1=$a_year."-".$accname;
//$tablename="comments_".$a_year;
if($_POST['branch']!='')
{
	$stuid=$_POST['stuid'];
	$stuname=$_POST['stuname'];
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$examid=$_POST['examid'];
	$studentid=$_POST['studentid'];
	$class_section_id=$_POST['class_section_id'];
	$stundetname=$_POST['stundetname'];
	$admissionid=$_POST['admissionid'];
	$student_id=$_POST['student_id'];
	$check=$_POST['check'];
}
else
{
	$stuid=$_REQUEST['stuid'];
	$stuname=$_REQUEST['stuname'];
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$examid=$_REQUEST['examid'];
	$studentid=$_REQUEST['studentid'];
	$class_section_id=$_REQUEST['class_section_id'];
	$stundetname=$_REQUEST['stundetname'];
	$admissionid=$_REQUEST['admissionid'];
	$student_id=$_REQUEST['student_id'];
	$masteexamn=$_REQUEST['masteexamn'];
	$unit=$_REQUEST['unit'];

}
?>
<script LANGUAGE="JavaScript">
function setPageBreak()
{
	document.getElementById("footer").style.pageBreakAfter="always";
}
function prn()
{
	pr1.style.display = "none";
	window.print();
}
</script>
</head>
<body>
<style>
body
{ 
  background: url(Logo2.jpg) no-repeat center center ; 
  /*-webkit-background-size: cover;
  -moz-background-size: cover;*/
  -o-background-size: cover;
  background-size: cover;
}
</style>
<?php
$sqlt=execute("select * from college");
while($r=fetcharray($sqlt))
{
	
	$col_name=$r['col_name'];
	$col_code=$r['col_code'];
	$col_addr=$r['col_addr'];
	$col_pin=$r['col_pin'];
	$col_phone=$r['col_phone'];
	$col_fax=$r['col_fax'];
	$email=$r['email'];
}
	$rs_ec=execute("select sub_id, descr, f_date, t_date from exam_m where id='$examid'");
	while($r1=fetcharray($rs_ec))
	{
		$subid=explode(',',$r1['sub_id']);
		$examnamed1=$r1['descr'];
		$exam_des=$r1['exam_des'];
		$f_date=$r1['f_date'];
		$t_date=$r1['t_date'];
	}
	$att_table='att_'.$sem;


?>
<br>
<table cellpadding="5" cellspacing="0" border="0" width="80%" align="center">
<tr>
<td align="center" ><img src="oberoilogo.png" width="150" title=""><br></td>
    <?php
	$studenname=execute("select first_name,last_name,dob from student_m where id='$student_id'");
$stundetname1=fetcharray($studenname);
	$section_name=fetchrow(execute("select section_name from class_section where id='$class_section_id'"));
	$course_year=fetchrow(execute("select year_name from course_year where year_id='$sem'"));
	$course_m=fetchrow(execute("select course_id from course_m where course_id='$branch'"));
	?>
    <tr>
        <td colspan="5" align="center"  style="font-size:23px">
        <?php
		$examnsme=fetcharray(execute("select * from dp_exam_sub_m where id='$examid'"));
	   ?>
        <b><?=$examnsme[exam_name]?></b>        
    </td>
    </tr>
    	<tr>
       <td colspan="5" align="center"><?=$dt=date('d/m/Y',strtotime($examnsme[to]));?></td>
        </tr>
        </table>
        
            <table cellpadding="5" cellspacing="0" border="0" width="80%" align="center">

        <tr>
       <td colspan="5" align="left"><b>Student name : <?=$stundetname1[0]?>&nbsp;<?=$stundetname1[1]?></b></td>
        </tr>
        <?
		
		$stucourse=execute("SELECT sub_sec FROM `student_course` WHERE stu_id='$student_id' and acc_year='$a_year' and class='$sem'");
	$stucourse2=fetcharray($stucourse);
	
	$staffcourse=execute("SELECT home_teac FROM `all_teachers` WHERE  section='$stucourse2[0]'");
	$staffcourse2=fetcharray($staffcourse);
	
			$vicepvt=execute("SELECT `f_name`,`s_name` FROM `staff_det` WHERE `id`='$staffcourse2[0]' and active='YES'");
			$viceplas=fetcharray($vicepvt);
	
		?>
    <tr>
        <td width="40%" nowrap><b>Grade : <?php
        $sql5=execute("SELECT year_name FROM course_year where year_id='$sem'");
        $grade_name=fetchrow($sql5);
        echo $grade_name[0];
        ?></b></td>
    </tr>
    <tr>
        <td width="40%" nowrap><b>Homeroom Teacher : 
        <?=$viceplas[0]?>&nbsp;<?=$viceplas[1]?>
        </b></td>
    </tr>
    <tr>
        <td width="40%" nowrap><b>Date of Birth : 
        <?=$dt=date('d/m/Y',strtotime($stundetname1[dob]));?>
        </b></td>
    </tr>
     <tr>
        <td width="40%" nowrap>Dear Parents,<br></td>
    </tr>
    <tr>
        <td colspan='4'>Please find below your child's school end of unit report. The transdisciplinary skills and learner profiles have been discussed in your child's general comment for the Unit of Inquiry (UOI).
        </td>
    </tr>
    </table>
     <?php
		$unitnames=fetcharray(execute("select unit,id from msp_unit where status=1  and id='$unit' order by posi"));
	   ?>
        <br>    
    <table cellpadding="5" cellspacing="0" border="1" width="80%" align="center">
    <tr>
    <td ><b><?=$unitnames[unit]?></b>
    </td>
    </tr>
    <?
	$sql3=execute("select id, idea, theme,keyconc from ideas where acc_year='$a_year' and class='$sem' and exam_id='$examid' and unit='$unit'");
while($r6=fetcharray($sql3))
	{
		$idaers=$r6[1];
		$themess=$r6[2];
		$keyscc=$r6[3];
	}
	?>
    <tr>
    <td><b>Transdisciplinary Theme:</b>&nbsp;&nbsp;<?=$themess?></td>
    </tr>
    <tr>
    <td><b>Central Idea:</b>&nbsp;&nbsp;<?=$idaers?></td>
    </tr>
     <tr>
    <td><b>Key Concepts:</b>&nbsp;&nbsp;<?=$keyscc?></td>
    </tr>
     <tr>
    <td><b>Lines of Inquiry:</b>
    <br>
    <?php
	//and exam_id='$examid' 
	$sqtest=execute("select sub_skill from  pyp_subskills where acc_year='$a_year' and class='$sem' and unit='$unit' and examid='$examid' order by posi");
while($sqtest1=fetcharray($sqtest))
	{
	?>
    &nbsp;&nbsp;&#8226;&nbsp;<?=$sqtest1[0]?><br>
    <?
	}
	?>
    </td>
    </tr>
    <?php
	$sqtestrem=execute("select remarks from obe_skill_mark where student_id='$student_id' and  sem_id='$examid'  and unit='$unit'");
while($sqtestrem2=fetcharray($sqtestrem))
	{
		$remarkds=$sqtestrem2[0];
	}
	?>
     <tr>
    <td><?=$remarkds?>&nbsp;</td>
    </tr>
 </table>
    <br>
<?
//echo "SELECT groupname,srid FROM users WHERE username='$user'";
$usergroup=fetcharray(execute("SELECT groupname,srid FROM users WHERE username='$user'"));

if($usergroup[0]=='ADMIN' or $usergroup[0]=='adminm' or $usergroup[0]=='Admin' )
{
?>
<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
</div>
<?
}
?>
</body>
</html>
