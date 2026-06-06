<html>
<head>
<?php
session_start();
include("../db.php");
if($_REQUEST['course'])
{
	$course=$_REQUEST['course'];
	$$accyeardet=$_REQUEST['$accyeardet'];
	$sem=$_REQUEST['sem'];
	$examid=$_REQUEST['examid'];
	$studentid=$_REQUEST['studentid'];
	$class_section_id=$_REQUEST['class_section_id'];
	$stundetname=$_REQUEST['stundetname'];
	$student_id=$_REQUEST['student_id'];
	
}
else
{
	$g_kg=$_POST['g_kg'];
	$commt=$_POST['commt'];
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$examid=$_POST['examid'];
	$studentid=$_POST['studentid'];
	$class_section_id=$_POST['class_section_id'];
	$stundetname=$_POST['stundetname'];
	$student_id=$_POST['student_id'];
	
}
$accyeardet=$_SESSION['AcademicYear'];

$rs_ec=execute("select descr from exam_m where id='$examid'");

while($r1=fetcharray($rs_ec))
{
	$subid=explode(',',$r1['sub_id']);
	$mmks=explode(',',$r1['max_mark']);
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
	$descr=$r1['descr'];
	
}

if(isset($_POST['save']))
{
	
	
	$skillid=$_POST['subarr'];
	$commt=$_POST['commt'];
	
	$Sql66=execute(" select id from comment_kg where student_id='$studentid' and acc_year='$accyeardet' and exam_id='$examid'");
	if(rowcount($Sql66)>0)
	{
		
		$sql33="update comment_kg set `commt`='".addslashes($commt)."' where student_id='$studentid' and acc_year='$accyeardet' and exam_id='$examid'";
		execute($sql33);
	}
	else
	{
		execute("INSERT INTO comment_kg (`class`, `sec`, `student_id`, `acc_year`, `commt`, `exam_id`) VALUES ( '$sem', '$class_section_id', '$studentid', '$accyeardet', '$commt', '$examid')");
	}
	
	$subskill=$_POST['subskill'];
	$skillid=$subskill;
	for($j=0;$j<sizeof($skillid);$j++)
	{
		$idin=$skillid[$j];
		$g_kg=$_POST['g_kg_'.$idin];
		
		$Sql6=execute(" select id from gradekg where student_id='$studentid' and skill='$idin' and acc_year='$accyeardet' and exam_id='$examid'");
		if(rowcount($Sql6)>0)
		{
			execute("update gradekg set  g_kg='$g_kg' where student_id='$studentid' and skill='$idin' and acc_year='$accyeardet' and exam_id='$examid'");
		}
		else
		{	
			execute("INSERT INTO gradekg (exam_id, class, sec, student_id, skill, acc_year,  g_kg) VALUES ('$examid', '$sem', '$class_section_id', '$studentid', '$idin', '$accyeardet', '$g_kg')");
		}		
	
	}
	
	$mainskill=$_POST['mainskill'];
	for($k=0;$k<sizeof($mainskill);$k++)
	{
		$refid=$mainskill[$k];
		$trsns=$_POST['trsns'.$refid];
		$idea=$_POST['idea'.$refid];
		$focus_s=$_POST['focus_s'.$refid];
		$focus_p=$_POST['focus_p'.$refid];
		$fac_cmt=$_POST['fac_cmt'.$refid];

		$Sql9=execute("select id from unit_kg where student_id='$studentid' and master_skill ='$refid' and acc_year='$accyeardet' and exam_id='$examid'");
		if(rowcount($Sql9)>0)
		{
			execute("update unit_kg set theme='".addslashes($trsns)."',idea='".addslashes($idea)."',skill_cm='".addslashes($focus_s)."',profile='".addslashes($focus_p)."',fac_cmt='".addslashes($fac_cmt)."' where student_id='$studentid' and master_skill ='$refid' and acc_year='$accyeardet' and exam_id='$examid'");
		}
		else
		{	
			execute("INSERT INTO unit_kg (exam_id, class,student_id, master_skill , acc_year,theme,idea,skill_cm,profile,fac_cmt) VALUES ('$examid', '$sem', '$studentid', '$refid', '$accyeardet', '".addslashes($trsns)."','".addslashes($idea)."','".addslashes($focus_s)."','".addslashes($focus_p)."','".addslashes($fac_cmt)."')");
		}
	}
	
	?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>		
		<?php
}
?>

<script language='javascript'>
function valid(emark,mrk,varname)
{
	if(isNaN(emark))
	{
		alert("Enter Number only");
		document.getElementsByName(varname)[0].value='';
	}
	else
	{
		if(emark>mrk)
		{
			alert("Scored Mark cannot be greater than max mark");
			document.getElementsByName(varname)[0].value='';
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

?>
<table align="center" width="70%" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="5" > ADD GRADE </td>
</tr> 
 <tr>
   <td align='left' class='row2'><div align='left'>&nbsp;&nbsp; SUBJECT </div></td>
  	<td align='left' class='row2'> <div align='left'>&nbsp;&nbsp;SKILL </div></td>
  	<td  align='left' class='row2'><div align='left'> &nbsp;&nbsp; <?php echo $descr; ?></div></td>
    </tr>
 <?php

		$Sql67=execute(" select * from comment_kg where student_id='$studentid' and acc_year='$accyeardet' and exam_id='$examid'");

		while($rk=fetcharray($Sql67))

		{

			$commt11=$rk['commt'];

			
		}

  ?> 
 
 <?php

$sql1=execute("SELECT a.subject_id , a.subject_name, a.elective FROM subject_m a, kgskills b where a.course_id='$course' and  a.course_year_id='$sem' and b.acc_year='$accyeardet' and b.sub=a.subject_id  group by b.sub order by a.sub_pre ");
while($r2=fetcharray($sql1))
{
	$flag1=1;
	if($r2[2]=='Y')
	{    
		$studentstatus=fetchrow(execute("select id from student_course where stu_id='$studentid' and acc_year='$accyeardet' and sub='$r2[0]'"));
		if(!$studentstatus)
		$flag1=0;	
	}

	$flag=1;
	if($flag1)
	{
		
		if($r2[0]=='75' || $r2[0]=='81' || $r2[0]=='86')
		{
			$newquery=" exam_id='$examid' and ";
		}
		else
		{
			$newquery="";	
		}
		$sql2=execute("SELECT id , skill FROM kgskills where $newquery class='$sem' and sub='$r2[0]' and acc_year='$accyeardet'  order by posi");
		while($r3=fetcharray($sql2))
		{
			if($flag)
			{
				echo "
				<tr> <td nowrap align='left'><b>&nbsp;&nbsp;$r2[1]</b></td>
				<td nowrap align='left'>&nbsp</td>
				<td nowrap align='left'>&nbsp</td>
				</tr> ";
				$flag=0;
			}
			if($r2[0]=='75' || $r2[0]=='81' || $r2[0]=='86')
			{
			
		
				$unit_kg=fetcharray(execute("select * from unit_kg where student_id='$studentid' and master_skill ='$r3[0]' and acc_year='$accyeardet' and exam_id='$examid'"));
				$facccoment=$unit_kg[fac_cmt];
				if($unit_kg[theme]=='')
				{
					$unit_kg=fetcharray(execute("select * from unit_kg where master_skill ='$r3[0]' and acc_year='$accyeardet' and exam_id='$examid' limit 1"));
					$facccoment='';
				}
				
				
				echo "<tr>
					<input type='hidden' name='mainskill[]' value='$r3[0]'>
					<td>&nbsp;Transdisciplinary Theme</td>
					<td colspan='2'><textarea name='trsns$r3[0]' cols='60' rows='1'>$unit_kg[theme]</textarea></td>
				</tr>
				<tr>
					<td>&nbsp;Central idea</td>
					<td colspan='2'><textarea name='idea$r3[0]' cols='60' rows='2'>$unit_kg[idea]</textarea></td>
				</tr>";
				$g_kg='';
				$flag=1;
				
				
			}
			echo " <tr>
			<td  valign='top'> &nbsp;&nbsp;$r3[1]</td>
			<td nowrap align='center'>&nbsp</td>
			<td nowrap align='center'>&nbsp</td></tr>";
				  
			$sql4=execute("SELECT id , sub_skill FROM kg_subskills where   master_skill='$r3[0]' and acc_year='$accyeardet' order by posi");
			while($r4=fetcharray($sql4))
			{
	
				$sql5=fetchrow(execute("SELECT  g_kg FROM gradekg where  student_id='$studentid' and	skill='$r4[0]' and acc_year='$accyeardet' and exam_id='$examid'"));
				echo "<tr>
				<td nowrap align='left'>&nbsp;</td>
				<td nowrap align='left'>&nbsp;$r4[1]</td>
				<td nowrap align='center'> 
				<input type='hidden' name='subskill[]' value='$r4[0]'>
				<input type='text' name='g_kg_$r4[0]' value='$sql5[0]' size='3'  > </td>
				</tr>";
			}
			
			if($r2[0]=='75' || $r2[0]=='81' || $r2[0]=='86')
			{
				echo "<tr>
					<td>&nbsp;Focus Skills</td>
					<td colspan='2'><textarea name='focus_s$r3[0]' cols='60' rows='1'>$unit_kg[skill_cm]</textarea></td>
				</tr>
				<tr>
					<td>&nbsp;Focus Profiles</td>
					<td colspan='2'><textarea name='focus_p$r3[0]' cols='60' rows='1'>$unit_kg[profile]</textarea></td>
				</tr>
				<tr>
					<td>&nbsp;Facilitator's Comments</td>
					<td colspan='2'><textarea name='fac_cmt$r3[0]' cols='60' rows='3'>$facccoment</textarea></td>
				</tr>";
				
			}
		}
	}
}
?>
	<tr>
		<td class="keycell"><b><?php echo $descr;?>&nbsp;COMMENTS</td>
		<td colSpan="3">
		<textarea name="commt" rows="4" cols="60"><?php echo $commt11?></textarea>
		</td>
	</tr>
	</table>
    <br>
 <div align="center">
<input type="submit" name="save" value="Save" class="bgbutton"></div></form>
</body>
</html>
