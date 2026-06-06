<html>
<head>
<?php
session_start();
include("../db.php");
if($_REQUEST['course'])
{
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$examid=$_REQUEST['examid'];
	$studentid=$_REQUEST['studentid'];
	$class_section_id=$_REQUEST['class_section_id'];
	$stundetname=$_REQUEST['stundetname'];
	$student_id=$_REQUEST['student_id'];	
}
else
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$examid=$_POST['examid'];
	$studentid=$_POST['studentid'];
	$class_section_id=$_POST['class_section_id'];
	$stundetname=$_POST['stundetname'];
	$student_id=$_POST['student_id'];
	
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

if(isset($_POST['save']))
{
	$skillid=$_POST['subarr'];
	$desc1=$_POST['desc1'];
	$desc2=$_POST['desc2'];
	$desc3=$_POST['desc3'];
	$desc4=$_POST['desc4'];
	$desc5=$_POST['desc5'];
	
		$Sql66=execute(" select id from skill_grade_desc where student_id='$studentid' and acc_year='$accyeardet'");
		if(rowcount($Sql66)>0)
		{
			execute("update skill_grade_desc set `desc1`='$desc1', `desc2`='$desc2', `desc3`='$desc3', `desc4`='$desc4', `desc5`='$desc5' where student_id='$studentid' and acc_year='$accyeardet'");
		}
		else
		{
			
		execute("INSERT INTO skill_grade_desc (`div`, `class`, `sec`, `student_id`, `acc_year`, `desc1`, `desc2`, `desc3`, `desc4`, `desc5`) VALUES ( '$course', '$sem', '$class_section_id', '$studentid', '$accyeardet', '$desc1', '$desc2', '$desc3', '$desc4', '$desc5')");
		}
		
		
	for($j=0;$j<sizeof($skillid);$j++)
	{
		$idin=$skillid[$j];
		$eval1=$_POST['eval1_'.$idin];
		$eval2=$_POST['eval2_'.$idin];
		
		$Sql6=execute(" select id from skill_grade where student_id='$studentid' and skill='$idin' and acc_year='$accyeardet'");
		if(rowcount($Sql6)>0)
		{
			execute("update skill_grade set eval1='$eval1', eval2='$eval2' where student_id='$studentid' and skill='$idin' and acc_year='$accyeardet'");
		}
		else
		{
			execute("INSERT INTO skill_grade (id, divi, class, sec, student_id, skill, acc_year, eval1, eval2) VALUES (NULL, '$course', '$sem', '$class_section_id', '$studentid', '$idin', '$accyeardet', '$eval1', '$eval2')");
		}
	}
	?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php
}
?>
<table align="center" width="70%" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="5" > Add Skills </td>
</tr> 

   
  <?php
  echo '
  <tr height="25">
    <td align="center" colspan="5"  class="row2" >Name : '.$stundetname.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Id : '.$student_id.' </td>
  </tr>';
		$Sql67=execute(" select * from skill_grade_desc where student_id='$studentid' and acc_year='$accyeardet'");
		while($rk=fetcharray($Sql67))
		{
			$desc11=$rk['desc1'];
			$desc12=$rk['desc2'];
			$desc13=$rk['desc3'];
			$desc14=$rk['desc4'];
			$desc15=$rk['desc5'];
		}
  ?>
     <tr height="24">
        <td align="left" class="row2" colspan="5" > <div align="left">How your child displayed the Learner Profile and PYP attitudes:</div></td>
    </tr>
    <tr>
        <td align="center" colspan="5" ><textarea name="desc1" rows="2" cols="80">  <?php echo $desc11; ?></textarea></td>
    </tr>
<tr height="24">
    <td align="left" class="row2" colspan="5" > <div align="left">How your child demonstrated an understanding of the knowledge and concepts taught in this unit:</div></td>
  </tr>
<tr>
    <td align="center" colspan="5" ><textarea name="desc2" rows="2" cols="80">  <?php echo $desc12; ?></textarea></td>
</tr>
<tr height="24">
    <td align="left" class="row2" colspan="5" ><div align="left">How your child demonstrated an understanding of the knowledge and concepts taught in this unit:</div></td>
  </tr>
<tr>
    <td align="center" colspan="5" ><textarea name="desc3" rows="2" cols="80">  <?php echo $desc13; ?></textarea></td>
</tr>
<tr height="24">
    <td align="left" class="row2" colspan="5" > <div align="left">How your child demonstrated an understanding of the knowledge and concepts taught in this unit:</div></td>
  </tr>
<tr>
    <td align="center" colspan="5" ><textarea name="desc4" rows="2" cols="80">  <?php echo $desc14; ?></textarea></td>
</tr>
<tr height="24">
    <td align="left" class="row2" colspan="5" > <div align="left">Goals and Recommendations:</div></td>
</tr>
<tr>
    <td align="center" colspan="5" ><textarea name="desc5" rows="2" cols="80">  <?php echo $desc15; ?></textarea></td>
</tr> 
  
  <?php

$sql1=execute("SELECT a.subject_id , a.subject_name FROM subject_m a, master_skills b where a.course_id='$course' and  a.course_year_id='$sem' and b.sub=a.subject_id  group by b.sub ");

 //echo "SELECT * FROM master_skills where divi='$course' and class='$sem'";
while($r2=fetcharray($sql1))
{

  echo " <tr>
    <td nowrap width='75%' colspan='2' class='row2'><strong>  $r2[1] </strong></td>
  	<td nowrap align='center' class='row2'> SEMESTER-1 </td>
  	<td nowrap align='center' class='row2'> SEMESTER-2 </td>
    </tr> ";
  $k=1;
	$sql2=execute("SELECT id , skill FROM master_skills where divi='$course' and class='$sem' and sub='$r2[0]' order by posi");
	while($r3=fetcharray($sql2))
	{
			echo " <tr>
						<td nowrap width='3%' align='center' valign='top'> $k</td>
						<td  valign='top'>  $r3[1]  :-  ";
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
						<td nowrap align='center'> <input type='text' name='eval1_$r3[0]' value='$eval1' size='3'  > </td>
						<td nowrap align='center'> <input type='text' name='eval2_$r3[0]' value='$eval2' size='3'  > </td>
						
					  </tr>";
	}
}
?>


	</table
><br><div align="center">
<input type="submit" name="save" value="Save" class="bgbutton"></div></form>
</body>
</html>
