<html>
<head>
<?php
session_start();
include("../db.php");
if($_REQUEST['course'])
{
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$studentid=$_REQUEST['studentid'];
	$class_section_id=$_REQUEST['class_section_id'];
	$stundetname=$_REQUEST['stundetname'];
	$student_id=$_REQUEST['student_id'];	
}
else
{
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$studentid=$_REQUEST['studentid'];
	$class_section_id=$_REQUEST['class_section_id'];
	$stundetname=$_REQUEST['stundetname'];
	$student_id=$_REQUEST['student_id'];
	
}
if(date("m")>5)
$accyeardet=date("Y");
else
$accyeardet=date("Y")-1;
?>
<script language='javascript'>
function valid(id)
{
	var mmarks= document.getElementsByName("m_mark" + id)[0].value;
	var obt_mark = parseInt(document.getElementsByName("mark" + id)[0].value);
	if(isNaN(obt_mark))
	{
		alert("Enter number only. For Absentees enter as 0");
		document.getElementsByName("mark" + id)[0].value='';
	}
	else
	{
		if(obt_mark>mmarks)
		{
			alert("Scored Mark cannot be greater than max mark");
			document.getElementsByName("mark" + id)[0].value='';
		}
	}
}
function valid1()
{
	var mmarks= parseInt(document.getElementsByName("cc")[0].value);
	var obt_mark = parseInt(document.getElementsByName("ca")[0].value);
	if(isNaN(mmarks))
	{
		alert("Enter number only.");
		document.getElementsByName("cc")[0].value='';
	}
	if(isNaN(obt_mark))
	{
		alert("Enter number only.");
		document.getElementsByName("ca")[0].value='';
	}
	else
	{
		if(obt_mark>mmarks)
		{
			alert("Attended class cannot be greater than conducted class");
			document.getElementsByName("ca")[0].value='';
		}
	}
}
</script>
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

$rs_ec=execute("select * from exam_m where id='$examid'");
while($r1=fetcharray($rs_ec))
{
	$subid=explode(',',$r1['sub_id']);
	$mmks=explode(',',$r1['max_mark']);
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
}

?>
<table align="center" width="50%" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="5" > Skill Set  </td>
  </tr>
  <?php
  echo '
  <tr height="25">
    <td align="center" colspan="5" >Name : '.$stundetname.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Id : '.$student_id.' </td>
  </tr>';
$sql1=execute("SELECT a.subject_id , a.subject_name FROM subject_m a, master_skills b where a.course_id='$course' and  a.course_year_id='$sem' and b.sub=a.subject_id  group by b.sub ");

 //echo "SELECT * FROM master_skills where divi='$course' and class='$sem'";
while($r2=fetcharray($sql1))
{

  echo " <tr>
    <td nowrap width='40%' colspan='2'><strong>  $r2[1] </strong></td>
  	<td nowrap> EVALUATION-1 </td>
  	<td nowrap> EVALUATION-2 </td>
  	<td nowrap> EVALUATION-3 </td>
  </tr> ";
  $k=1;
	$sql2=execute("SELECT id , skill FROM master_skills where divi='$course' and class='$sem' and sub='$r2[0]' order by posi");
	while($r3=fetcharray($sql2))
	{
			echo " <tr>
						<td nowrap width='5%' valign='top'> $k </td>
						<td nowrap width='40%' valign='top'>  $r3[1]  ";
					  $k++;
		$sql4=execute("SELECT id , sub_skill FROM sub_skills where  master_skill='$r3[0]' order by posi");
		while($r4=fetcharray($sql4))
		{
			echo "  <br>&nbsp;  &nbsp;*  &nbsp;$r4[1] ";
		}
		$sql5=execute("SELECT eval1, eval2,	eval3 FROM skill_grade where  student_id='$studentid' and	skill='$r3[0]' and acc_year='$accyeardet'");
		while($r5=fetcharray($sql5))
		{
			$eval1=$r5[0];
			$eval2=$r5[1];
			$eval3=$r5[2];
		}
		echo "</td><input type='hidden' name='subarr[]' value='$r3[0]'>
						<td nowrap align='center'> $eval1 </td>
						<td nowrap align='center'>$eval2 </td>
						<td nowrap align='center'> $eval3 </td>
					  </tr>";
	}
}
?>


	</table
><br><div align="center">
<input type="submit" name="save" value="Save"></div></form>
</body>
</html>
