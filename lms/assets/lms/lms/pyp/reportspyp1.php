<html>
<head>
<?php
session_start();
include("../db1.php");
//print_r($_POST);
//print_r($_GET);
$accyeardet=$_SESSION['AcademicYear'];
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
$atttable='att_'.$sem;

$sql=execute("select id,descr  from exam_m where accyear='$accyeardet' and class='$sem' and id<='$examid'");
while($r=fetcharray($sql))
{
	$exam_id_new[]=$r[0];
	$exam_id_name[]=$r[1];
}


$rowwidth=sizeof($exam_id_new);



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


?>	

<script language="javascript">
function printReport()
{
//	prn.style.display="none";
	window.print();
}
</script>
<body onLoad="printReport()">


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


<!--<table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="5" >
      <b>SYMBIOSIS INTERNATIONAL SCHOOL</b></td></tr><tr>
     <td align="center" colspan="5" class="head" ><b>KG REPORT&nbsp;-&nbsp;<?php echo $exam_id_name[$l]; ?></b></td></tr>
              <tr>
                    <td valign="top" colspan="5" align="center" class="head"><b><?php echo $accyeardet; ?>&nbsp;-&nbsp;<?php echo $accyer1; ?></b></td>
                    
    <tr height="25">

     <td align="center" colspan="5"  class="row2" ><b> <?=$classname12[0]?> <?=$section1[0]?> &nbsp;-&nbsp;<?=$stundetname1[0]?>  <?=$stundetname1[1]?></b></td>

     </tr>
    </tr></table>!-->
    <br>
	<br>
	<br>
	<br>
	<table width="90%"  align="center" border="0" cellspacing="0" cellpadding="3">
 
   <tr>
    <td align="left"><h2><i>&#8220;Assesment is the gathering and analysis of information about student performance. It identifies what student know,undestand,can do and feel at different stages in the learning process&#8221;</i></h2></td>
    </tr>
	 <tr>
    <td align="left" ><i><h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;IBO Assessment Handbook</h2></i></td>
    
  </tr>
  <tr>
    <td align="center" ><h2><u>Grading Key</u></h2></td>
    
  </tr>
  </table>
  


  
   
    <table width="90%"  align="center" border="1" cellspacing="0" cellpadding="3"> 
  
  <tr>
    <td align="left"  width="10%" ><h3>&nbsp;&nbsp;E</h3></td>
    <td colspan="2"><h3>&nbsp;&nbsp;Excellent&nbsp;/&nbsp;exceeds expectations</h3></td>
  </tr>
  <tr>
    <td align="left"  width="10%"><h3>&nbsp;&nbsp;M</h3></td>
    <td colspan="2"><h3>&nbsp;&nbsp;Expectations fully met</h3></td>
  </tr>
  <tr>
    <td align="left"  width="10%"><h3>&nbsp;&nbsp;B</h3></td>
    <td colspan="2"><h3>&nbsp;&nbsp;Meets expectations at beginners level</h3></td>
  </tr>
  <tr>
    <td align="left"  width="10%"><h3>&nbsp;&nbsp;T</h3></td>
    <td colspan="2"><h3>&nbsp;&nbsp;More time and experiences needed</h3></td>
  </tr>
    </table>
  <br>
    <br>
	  <br>
	    <br>
		
<table style="border:2px solid black;" width="90%" align="center" border="1" cellspacing="0" cellpadding="3"> 
<tr>
   <td style="border:2px solid black;" align='center'  width="30%"><input  type="image"  src="smiley.PNG"/>&nbsp;&nbsp;<input  type="image"  src="smiley.PNG"/>&nbsp;&nbsp;<input  type="image"  src="smiley.PNG"/></td>
  	<td style="border:2px solid black;" align='center'  width="30%"> <input type="image"  src="smiley.PNG"/>&nbsp;&nbsp;<input  type="image"  src="smiley.PNG"/></td>
  	<td  style="border:2px solid black;" align='center' width="30%"><input  type="image"  src="smiley.PNG"/></td>
    </tr>
  </table>
  <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="3"> 
<tr>
   <td align='center'  width="30%"><h3>Mostly</h3></td>
  	<td align='center'  width="30%"><h3>Usually</h3></td>
  	<td  align='center' width="30%"><h3>Rarely</h3></td>
    </tr>
  </table>

  <br style="page-break-before: always;" clear="all" />
<?php
//loop for multiple exams strats here 

for($l=0;$l<sizeof($exam_id_new);$l++)
{
	$examid=$exam_id_new[$l];
?>  
     <br>
	<br>
	<br>
	<br>
	<br>
	
	
  <table  width="90%"  align="center" border="0" cellspacing="0" cellpadding="3">
  <tr>
  <td  align='center' width="30%"><input  type="image"  src="habits.PNG"/></td>
    </tr>
	<tr>
    <td align="center" colspan="2"><h3>Work Habits/Scoial Development Record</h3></td>
   
  </tr>
  </table>
  <table width="90%"   align="center" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <td align="center"  width="70%">Criteria</td>
    <td align="center" width="20%"><?php echo $exam_id_name[$l]; ?></td>
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
				$crit1='&#10004;';
				

		
							
		echo"<tr height='40'>
		<td align='center'>$crt1[1]</td>
		<td align='center'><input type='hidden' name='crt11[]' value='$crt1[0]'>
		 &nbsp;$crit1</td>
		</tr>";
		$crit='';
	 }
?>
</table>
<br>
  <br style="page-break-before: always;" clear="all" />
  <br>
	
  
    <?php
$cen_i=execute("select idea,theme,id from ideas where exam_id='$examid' and class='$sem'");
while($cen_i1=fetcharray($cen_i))
{
	echo ' <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="3">';
	echo "<tr><td align='center'> <input  type='image'  src='ideas.PNG'/></td></tr><tr>
			<td align='left' colspan='5' ><strong>Centeral Idea :</strong> &nbsp;$cen_i1[0]</td>
		</tr>
		<tr>
			<td align='left' colspan='5'><strong>Organizing Theme :</strong> &nbsp;$cen_i1[1]</td>
		</tr>";
		echo '</table>';
		echo' <table width="90%"  align="center" border="1" cellspacing="0" cellpadding="3">';
		
		echo "<tr><td class='row2' width='50%'>&nbsp;</td>
			<td nowrap class='row2' align='center' width='10%'>E</td>
			<td nowrap class='row2' align='center' width='10%'>M</td>
			<td nowrap class='row2' align='center' width='10%'>B</td>
			<td nowrap class='row2' align='center' width='10%'>T</td>
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
		$g_pyp1='&#10004';
		if($g_pyp==2)
		$g_pyp2='&#10004';
		if($g_pyp==3)
		$g_pyp3='&#10004';
		if($g_pyp==4)
		$g_pyp4='&#10004';
		
		
		echo "<tr><td>$cen_id1[1]</td>
		<td align='center'><input type='hidden' name='ideas_sub[]' value='$cen_id1[0]'>
		                    &nbsp;$g_pyp1</td>
		<td align='center'> &nbsp;$g_pyp2</td>
		<td align='center'>&nbsp; $g_pyp3</td>
		<td align='center'>&nbsp; $g_pyp4</td></tr>";
		$g_pyp='';
		}
	
	$Sql8=execute(" select idea_cm, idea_cm1,idea_cm2 from centralideacomt_pyp where student_id='$studentid'  and idea_cmid='$cen_i1[2]' and acc_year='$accyeardet' and exam_id='$examid'");
	while($r11=fetcharray($Sql8))
	{
		$idea_cmid1=$r11[0];
		$idea_cmid2=$r11[1];
		$idea_cmid3=$r11[2];
	}
	echo"</table>";
	echo"<br>";
	
	echo ' <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="3">';
	echo "<tr height='10'><input type='hidden' name='ideas_txt[]' value='$cen_i1[2]'>
	<td align='left'><b><u>Skill Covered&nbsp;:</u></b>
	
	&nbsp;$idea_cmid1</td>
	</tr>
	<tr height='70'>
	<td align='left'><b><u><i>Student Performance on Skills Covered&nbsp;:</i></u></b>
	&nbsp;$idea_cmid2</td>
	</tr>
	<tr height='70'>
	<td align='left'><b><u>Facilitator's Comments&nbsp;:</u></b>
	&nbsp;$idea_cmid3</td>
	</tr>";
$idea_cmid1='';
$idea_cmid2='';
$idea_cmid3='';	
echo '</table> <br style="page-break-before: always;" clear="all" />';
}
  ?>
  
<br>
<br>

<table align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
 
<tr>
    <td class="row2" align="left"><b>&nbsp;&nbsp;Student Name&nbsp;:&nbsp;<?php echo $stundetname1[0]  ?> <?php echo $stundetname1[1]  ?></b></td ><td colspan="4" class="row2" align="right"><b>&nbsp;&nbsp;Grade&nbsp;:&nbsp;<?php echo $classname12[0] ?> - <?php echo $section1[0] ?>&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
</tr>
 <br>
<br>
<br>
 

 <?php

$sql1=execute("SELECT a.subject_id , a.subject_name,a.elective FROM subject_m a, pypskills b where a.course_id='$course' and  a.course_year_id='$sem' and b.acc_year='$accyeardet' and b.sub=a.subject_id and b.exam_id='$examid' group by b.sub ");
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
			<td nowrap width='50%' colspan='4' align='center'><strong>$exam_id_name[$l]</strong></td>
		
	</tr> ";
	

	$sql2=execute("SELECT id , skill FROM pypskills where class='$sem' and sub='$r2[0]' and acc_year='$accyeardet'  and exam_id='$examid' order by posi");
	while($r3=fetcharray($sql2))
	{
			echo " <tr>
						
						<td  valign='top'>&nbsp;&nbsp;$r3[1]</td>
						<td nowrap align='center'>E</td>
						<td nowrap align='center'>M</td>
						<td nowrap align='center'>B</td>
						<td nowrap align='center'>T</td></tr>";
					  
	  
			  
		$sql4=execute("SELECT id , sub_skill FROM pyp_subskills where  master_skill='$r3[0]' and acc_year='$accyeardet'  order by posi");
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
										$g_kg1='&#10004';
										 if($g_kg==2)
										$g_kg2='&#10004';
										 if($g_kg==3)
										$g_kg3='&#10004;';
										 if($g_kg==4)
										$g_kg4='&#10004;';

	 
		echo "<tr>
						
						
						<td nowrap align='left'> &nbsp;&nbsp;$r4[1]</td>
						<td nowrap align='center'>
						<input type='hidden' name='subskill[]' value='$r4[0]'>
						                           &nbsp;$g_kg1</td>
						 <td nowrap align='center'>&nbsp;$g_kg2</td>
						<td nowrap align='center'>&nbsp;$g_kg3</td>
						<td nowrap align='center'> &nbsp;$g_kg4</td>
						
						
					  </tr>";
					                    $g_kg='';
										$g_kg='';
										$g_kg='';
										$g_kg='';
					

		}
}
				  
			
              echo "<tr height='70'>
					<td ><b>&nbsp;$descr&nbsp;&nbsp;<u>Facilitator's Remarks&nbsp;:</u></b></td>
					<td colSpan='4' valign='top'>&nbsp;&nbsp;
					$commt11
		            </td>
		            </tr>";	
				   
				   $commt11='';	
				  
	}				  
}
?>
      
</table>
     <br>
       <br>
	    <br style="page-break-before: always;" clear="all" />
<?php
}
?>		

<?php
for($i=0;$i<sizeof($exam_id_new);$i++)
{
	$sql=execute("select f_date, t_date from exam_m where id='$exam_id_new[$i]'");
	while($r=fetcharray($sql))	
	{
		$f_date=$r['f_date'];
		$t_date=$r['t_date'];
	}
	$fromdate=explode('-',$f_date);
	$todate=explode('-',$t_date);
	
	$totalclass=fetchrow(execute("SELECT count(id) FROM $atttable where sec='$class_section_id' and att_date between '$fdate' and '$tdate'"));
	$totalper=fetchrow(execute("SELECT count(id) FROM $atttable where sec='$class_section_id' and att_date between '$fdate' and '$tdate' and stu_id='$studentid' and mor=1"));
?>
     <br>
       <br>
<table width="90%" border="0" align="center" cellspacing="0" cellpadding="0" >
  <tr>
		  <td  align="left"><b><u>Class Record &nbsp;:&nbsp;<?php echo $exam_id_name[$i]; ?></u></b></td>
   
  </tr>
  <tr>
    <td height="70"  align="left" colspan="2" >From&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $fromdate[2].'-'.$fromdate[1].'-'.$fromdate[0]; ?></td>
    <td height="70"  align="left" colspan="2">To&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $todate[2].'-'.$todate[1].'-'.$todate[0]; ?></td>
    </tr>
  <tr>
    <td height="70"  align="left">No.of Working Days&nbsp;:</td>
    <td height="70"  align="left">&nbsp;<?php echo $totalclass[0]; ?></td>
     <td height="70"  align="left">No.of Days Present&nbsp;:</td>
    <td height="70"  align="left">&nbsp;<?php echo $totalper[0]; ?></td>
  </tr>


<tr>
  <td nowrap height="70" align="left" valign="top"><b>Signature of&nbsp;:</b></td>
   
  </tr>
<br>
<br>
  <tr>
    <td  align="left">------------------</td>
    <td  align="left">------------------</td>
    <td  align="left">------------------</td>
    <td  align="left">------------------</td>
  </tr>
  <tr>
    <td  align="left"><strong>(Class Teacher)</strong></td>
    <td align="left"><strong>(Coordinator)</strong></td>
    <td  align="left"><strong>(Principal)</strong></td>
    <td  align="left"><strong> (Parent)</strong></td>
  </tr>
  </table>
  <br>
  <br>
<?php
}
?>
<br>

<table width="90%" border="0" align="center" cellspacing="0" cellpadding="0" >

  <tr>
  <td align="left"><b>Promoted to Class&nbsp;:&nbsp;</b></td>
  </tr>
</table>
</form>
</body>
</html>
