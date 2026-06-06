<html>
<head>
<?php
session_start();
include("../db.php");
//print_r($_POST);
//print_r($_GET);
if($_REQUEST['course'])
{
    $g_kg=$_REQUEST['g_kg'];
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
	$g_kg=$_POST['g_kg'];
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$examid=$_POST['examid'];
	$studentid=$_POST['studentid'];
	$class_section_id=$_POST['class_section_id'];
	$stundetname=$_POST['stundetname'];
	$student_id=$_POST['student_id'];
	
}
$accyeardet=$_SESSION['AcademicYear'];
$studenname=execute("select first_name,last_name from student_m where id='$studentid'");
$stundetname1=fetcharray($studenname);
$classname=execute("select year_name from  course_year where year_id='$sem'");
$classname12=fetchrow($classname);
$section=execute("select section_name from class_section where id='$class_section_id'");
$section1=fetchrow($section);

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
	$sub_id=$_POST['sub_id'];
	for($j=0;$j<sizeof($sub_id);$j++)
	{
		$newid=$sub_id[$j];
	    $commt1=$_POST['commt_'.$newid];
		$Sql66=execute(" select id from comment_pyp where student_id='$studentid' and acc_year='$accyeardet' and sub='$newid' and exam_id='$examid'");
		if(rowcount($Sql66)>0)
		{
			
			
			$sql33="update comment_pyp set commt1='".addslashes($commt1)."' where student_id='$studentid' and acc_year='$accyeardet' and sub='$newid' and exam_id='$examid'";
			execute($sql33);
		}
		else
		{
		
		 
		execute("INSERT INTO comment_pyp (class, sec, student_id, acc_year, commt1, exam_id ,sub) VALUES ( '$sem', '$class_section_id', '$studentid', '$accyeardet', '".addslashes($commt1)."', '$examid','$newid')");
		}
	
	}
	$subskill=$_POST['subskill'];
	$skillid=$subskill;
	for($j=0;$j<sizeof($skillid);$j++)
	{
		$idin=$skillid[$j];
		$g_kg=$_POST['g_kg_'.$idin];
		
		
		$Sql6=execute(" select id from gradepyp where student_id='$studentid' and skill='$idin' and acc_year='$accyeardet' and exam_id='$examid'");
		if(rowcount($Sql6)>0)
		{
			
			execute("update gradepyp set  g_kg='$g_kg' where student_id='$studentid' and skill='$idin' and acc_year='$accyeardet' and exam_id='$examid' ");
		}
		else
		{	
		
		
		
			execute("INSERT INTO gradepyp (exam_id, class, sec, student_id, skill, acc_year,  g_kg) VALUES ('$examid', '$sem', '$class_section_id', '$studentid', '$idin', '$accyeardet', '$g_kg')");
		
		
		
		}
	}
	?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>

<?php
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
<table align="center" width="70%" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="6" > ADD GRADE </td>
</tr> 
<tr>
    <td class="row2" align="left">Student Name&nbsp;:&nbsp;<?php echo $stundetname1[0]  ?> <?php echo $stundetname1[1]  ?></td ><td colspan="5" class="row2" align="left">Grade&nbsp;:&nbsp;<?php echo $classname12[0] ?> - <?php echo $section1[0] ?></td>
</tr>
 <?php

$sql1=execute("SELECT a.subject_id , a.subject_name,a.elective FROM subject_m a, pypskills b where a.course_id='$course' and  a.course_year_id='$sem' and b.acc_year='$accyeardet' and b.sub=a.subject_id  group by b.sub ");
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
	  
		$newid=$r2[0];
		$Sql67=execute(" select * from comment_pyp where student_id='$studentid' and sub='$newid' and  acc_year='$accyeardet' and exam_id='$examid'");
		while($rk=fetcharray($Sql67))
		{

			$commt11=$rk['commt1'];

			
		}

		echo "<input type='hidden' name='sub_id[]' value='$r2[0]'>
	<tr> <td nowrap  align='left'><b>&nbsp;&nbsp;$r2[1]</b></td>
			<td nowrap width='50%' colspan='6' align='center'>$descr</td>
		
	</tr> ";
	

	$sql2=execute("SELECT id , skill FROM pypskills where class='$sem' and sub='$r2[0]' and acc_year='$accyeardet'  order by posi");
	while($r3=fetcharray($sql2))
	{
			echo " <tr>
						
						<td  valign='top'>&nbsp;&nbsp;$r3[1]</td>
						<td nowrap align='center'>E</td>
						<td nowrap align='center'>M</td>
						<td nowrap align='center'>B</td>
						<td nowrap align='center'>T</td></tr>";
					  
	  
			  
		$sql4=execute("SELECT id , sub_skill FROM pyp_subskills where  master_skill='$r3[0]' and acc_year='$accyeardet' order by posi");
		while($r4=fetcharray($sql4))
		{

			$sql5=execute("SELECT  g_kg FROM gradepyp where  student_id='$studentid' and	skill='$r4[0]'  and acc_year='$accyeardet' and exam_id='$examid'");
			while($r5=fetcharray($sql5))
			{
				
			  $g_kg=$r5[0];
				
			}
										$g_kg1='';
										$g_kg2='';
										$g_kg3='';
										$g_kg4='';
										
										if($g_kg==1)
										$g_kg1='checked';
										 if($g_kg==2)
										$g_kg2='checked';
										 if($g_kg==3)
										$g_kg3='checked';
										 if($g_kg==4)
										$g_kg4='checked';
 
	 
		echo "<tr>
						
						
						<td nowrap align='left'> &nbsp;&nbsp;$r4[1]</td>
						<td nowrap align='center'>
						<input type='hidden' name='subskill[]' value='$r4[0]'>
						                           <input type='radio' name='g_kg_$r4[0]' value='1' $g_kg1></td>
						 <td nowrap align='center'><input type='radio' name='g_kg_$r4[0]' value='2' $g_kg2></td>
						<td nowrap align='center'><input type='radio' name='g_kg_$r4[0]' value='3' $g_kg3></td>
						<td nowrap align='center'><input type='radio' name='g_kg_$r4[0]' value='4'  $g_kg4></td>
						
					  </tr>";
					                    $g_kg='';
										$g_kg='';
										$g_kg='';
										$g_kg='';

		}
}
				  
			
              echo "<tr>
					<td><b>&nbsp;$descr&nbsp;&nbsp;<u>Facilitator's Remarks&nbsp;:</u></b></td>
					<td colSpan='4'>
					<textarea name='commt_".$r2[0]."' rows='3' cols='57'>$commt11</textarea>
		            </td>
		            </tr>";	
				   
				   $commt11='';	
				  
	}			   		  
}
?>

</table>
    <br>
 <div align="center">
<input type="submit" name="save" value="Save" class="bgbutton"></div></form>
</body>
</html>