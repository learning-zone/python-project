<html>
<head>
<?php
session_start();
include("../db.php");
//print_r($_POST);
//print_r($_GET);
if($_GET['course'])
{
    $g_pyp=$_REQUEST['g_pyp'];
    $crit=$_REQUEST['crit'];
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
    $g_pyp=$_POST['g_pyp'];
	$crit=$_POST['crit'];
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

	$crt22_id=$_POST['crt22_id'];
	$crt11=$_POST['crt11'];
	$crt22_id=$crt11;
	for($j=0;$j<sizeof($crt22_id);$j++)
	{
		$idin=$crt22_id[$j];
		$crit=$_POST['crit_'.$idin];
		
		
		$Sql6=execute(" select id from  criteria_m where student_id='$studentid' and acc_year='$accyeardet' and exam_id='$examid' and criteria_id='$idin'");
		if(rowcount($Sql6)>0)
		{
			;
			execute("update  criteria_m set  mark='$crit' where student_id='$studentid.'  and  criteria_id='$idin' and  acc_year='$accyeardet' and exam_id='$examid' ");
		}
		else
		{	
		
		
		
			execute("INSERT INTO  criteria_m (exam_id, class, sec, student_id, criteria_id, acc_year, mark) VALUES ('$examid', '$sem', '$class_section_id', '$studentid', '$idin', '$accyeardet', '$crit')");
		
	 }
	}
	 
	
	$ideas_sub=$_POST['ideas_sub'];
    for($j=0;$j<sizeof($ideas_sub);$j++)
	{
		 $idinc=$ideas_sub[$j];
		 $g_pyp=$_POST['g_pyp_'.$idinc];
		
		
		$Sql7=execute(" select id from centralidea_pyp where student_id='$studentid' and idea_id='$idinc' and acc_year='$accyeardet' and exam_id='$examid'");
		if(rowcount($Sql7)>0)
		{
			
			execute("update centralidea_pyp set  g_pyp='$g_pyp'  where student_id='$studentid' and idea_id='$idinc' and acc_year='$accyeardet' and exam_id='$examid' ");
		}
		else
		{	
			
			
			
			execute("INSERT INTO centralidea_pyp (exam_id, class, student_id, idea_id, acc_year, g_pyp) VALUES ('$examid', '$sem', '$studentid', '$idinc', '$accyeardet', '$g_pyp')");		
		}
	}	
	$ideas_txt=$_POST['ideas_txt'];
	for($j=0;$j<sizeof($ideas_txt);$j++)
	{
		$idinc1=$ideas_txt[$j];
		$idea_cmid1=$_POST['idea_cmid1'.$idinc1];
		$idea_cmid2=$_POST['idea_cmid2'.$idinc1];
		$idea_cmid3=$_POST['idea_cmid3'.$idinc1];
		 
		  
		$Sql8=execute(" select id from centralideacomt_pyp where student_id='$studentid'  and idea_cmid='$idinc1' and acc_year='$accyeardet' and exam_id='$examid'");
		if(rowcount($Sql8)>0)
		{
			
			execute("update centralideacomt_pyp set   idea_cm='".addslashes($idea_cmid1)."' , idea_cm1='".addslashes($idea_cmid2)."' ,idea_cm2='".addslashes($idea_cmid3)."' where student_id='$studentid' and idea_cmid='$idinc1' and acc_year='$accyeardet' and exam_id='$examid' ");
		}
		else
		{	
			
			execute("INSERT INTO centralideacomt_pyp (exam_id, class, student_id,  acc_year, idea_cm,idea_cm1,idea_cm2,idea_cmid) VALUES ('$examid', '$sem', '$studentid', '$accyeardet','".addslashes($idea_cmid1)."' ,'".addslashes($idea_cmid2)."' ,'".addslashes($idea_cmid3)."','$idinc1')");		
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

  <tr>
    <td align="center" width="70%">Criteria</td>
    <td align="center" width="20%"><?php echo $descr; ?></td>
  </tr>

<?php
$crt=execute("select id, criteria from criteria where head='1'");
while($crt1=fetcharray($crt))
{
	$sq99=execute("SELECT  mark FROM criteria_m where  student_id='$studentid' and  criteria_id='$crt1[0]'	 and acc_year='$accyeardet' and exam_id='$examid'");
	while($r9=fetcharray($sq99))
	{  
		$crit=$r9[0];
	} 
	
	$crit1='';
	if($crit==1)
	$crit1='checked';
	echo"<tr>
	<td align='center'>$crt1[1]</td>
	<td align='center'><input type='hidden' name='crt11[]' value='$crt1[0]'>
	<input type='checkbox' name='crit_$crt1[0]' value='1' $crit1></td>
	</tr>";
	$crit='';
}
?>
 </table>

 <br>
 <br>
  
<?php
$cen_i=execute("select idea,theme,id from ideas where exam_id='$examid' and class='$sem'");
while($cen_i1=fetcharray($cen_i))
{
	echo ' <table width="70%"  align="center" border="1" cellspacing="0" cellpadding="3">';
	echo "<tr>
			<td align='left' colspan='5' ><strong>Centeral Idea :</strong> &nbsp;$cen_i1[0]</td>
		</tr>
		<tr>
			<td align='left' colspan='5'><strong>Organizing Theme :</strong> &nbsp;$cen_i1[1]</td>
		</tr>";
		
		
		echo "<tr><td class='row2'>&nbsp;</td>
			<td nowrap class='row2' align='center'>E</td>
			<td nowrap class='row2' align='center'>M</td>
			<td nowrap class='row2' align='center'>B</td>
			<td nowrap class='row2' align='center'>T</td>
		</tr>";
	
	$cen_id=execute("select id,idea from ideas_1 where class='$sem' and master_ideas='$cen_i1[2]'");
	while($cen_id1=fetcharray($cen_id))
	{
	
		$sq55=execute("SELECT  g_pyp FROM centralidea_pyp where  student_id='$studentid' and idea_id='$cen_id1[0]'  and acc_year='$accyeardet' and exam_id='$examid'");
		while($r9=fetcharray($sq55))
		{
			$g_pyp=$r9[0];
		
		}
		$g_pyp1='';
		$g_pyp2='';
		$g_pyp3='';
		$g_pyp4='';
		
		if($g_pyp==1)
		$g_pyp1='checked';
		if($g_pyp==2)
		$g_pyp2='checked';
		if($g_pyp==3)
		$g_pyp3='checked';
		if($g_pyp==4)
		$g_pyp4='checked';
		
		
		echo "<tr><td>$cen_id1[1]</td>
		<td align='center'><input type='hidden' name='ideas_sub[]' value='$cen_id1[0]'>
		                    <input type='radio' name='g_pyp_$cen_id1[0]' value='1' $g_pyp1></td>
		<td align='center'> <input type='radio' name='g_pyp_$cen_id1[0]' value='2' $g_pyp2></td>
		<td align='center'> <input type='radio' name='g_pyp_$cen_id1[0]' value='3' $g_pyp3></td>
		<td align='center'> <input type='radio' name='g_pyp_$cen_id1[0]' value='4' $g_pyp4></td></tr>";
		$g_pyp='';
		}
	
	$Sql8=execute(" select idea_cm, idea_cm1,idea_cm2 from centralideacomt_pyp where student_id='$studentid'  and idea_cmid='$cen_i1[2]' and acc_year='$accyeardet' and exam_id='$examid'");
	while($r11=fetcharray($Sql8))
	{
		$idea_cmid1=$r11[0];
		$idea_cmid2=$r11[1];
		$idea_cmid3=$r11[2];
	}
	echo "<input type='hidden' name='ideas_txt[]' value='$cen_i1[2]'>
	<td align='left'><b>Skill Covered&nbsp;:</b></td>
	
	<td colspan='4'><textarea name='idea_cmid1".$cen_i1[2]."'  rows='2' cols='57' >$idea_cmid1</textarea></td>
	</tr>
	<tr>
	<td align='left'><b>Student Performance on Skills Covered&nbsp;:</u></b></td>
	<td colspan='4'><textarea name='idea_cmid2".$cen_i1[2]."'  rows='2' cols='57' >$idea_cmid2</textarea></td>
	</tr>
	<tr>
	<td align='left'><b>Facilitator's Comments&nbsp;:</b></td>
	<td colspan='4'><textarea name='idea_cmid3".$cen_i1[2]."' rows='2' cols='57' >$idea_cmid3</textarea></td>
	</tr>";
$idea_cmid1='';
$idea_cmid2='';
$idea_cmid3='';	
echo '</table><br>';
}
  ?>
  
  


    <br>
 <div align="center">
<input type="submit" name="save" value="Save" class="bgbutton"></div></form>
</body>
</html>