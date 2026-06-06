<?php

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=skillset.doc");
header("Pragma: no-cache");
header("Expires: 0");

?>
<html>
<head>
<?php
session_start();
include("../db1.php");
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
$accyeardet=$_SESSION['AcademicYear'];
$accyer1=$accyeardet+1;

$att_table='att_'.$sem;

$rs_ec=execute("select * from exam_m where id='$examid'");
while($r1=fetcharray($rs_ec))
{
	$subid=explode(',',$r1['sub_id']);
	$mmks=explode(',',$r1['max_mark']);
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
	$f_date=$r1['f_date'];
	$t_date=$r1['t_date'];
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

 <br>
    <br>
    <br>
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="5" >
      <b>SYMBIOSIS INTERNATIONAL SCHOOL, PUNE</b></td></tr><tr>
     <td align="center" colspan="5" class="head" ><b>REPORT CARD</b></td></tr>
              <tr>
                    <td valign="top" colspan="5" align="center" class="head"><b>YEAR&nbsp;:&nbsp;<?php echo $accyeardet; ?>&nbsp;-&nbsp;<?php echo $accyer1; ?></b></td>
                    
    </tr></table>
    <br>
    <br>
    <br>
    <table width="90%" align="center" border="1" cellspacing="0" cellpadding="0">
   <tr height="35">
    <td  >&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Name</b> : <b><?=$stundetname?></b>
    </td>
   <td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Grade :   <?php
    $sql5=execute("SELECT year_name FROM course_year where year_id='$sem'");
 $grade_name=fetchrow($sql5);
 echo $grade_name[0];
   ?></b>
    </td>
  </tr>
</table>
    
    <table width="90%" align="center" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="90%" colspan="2" align="center"><b>Overall grading is based on the  scale of 1-7 for the SIS MSP</b></td>
    </tr>
  <tr>
    <td align="center" ><b>Grade</b></td>
    <td align="center"><b>Description</b></td>
  </tr>
  <tr>
    <td align="center">7</td>
    <td>&nbsp;&nbsp;Excellent</td>
  </tr>
  <tr>
    <td align="center">6</td>
    <td>&nbsp;&nbsp;Very good</td>
  </tr>
  <tr>
    <td align="center">5</td>
    <td>&nbsp;&nbsp;Good</td>
  </tr>
  <tr>
    <td align="center">4</td>
    <td>&nbsp;&nbsp;Average</td>
  </tr>
  <tr>
    <td align="center">3</td>
    <td>&nbsp;&nbsp;Developing</td>
  </tr>
  <tr>
    <td align="center"> 1&2 </td>
    <td>&nbsp;&nbsp;Emerging</td>
  </tr>
  <tr >
    <td align="center">N</td>
    <td>&nbsp;&nbsp;No grade *</td>
  </tr>
  <tr>
    <td colspan="2"><b>&nbsp;&nbsp;* Awarded due to various reasons</b></td>
</tr>
</table>

<table align="center" width="90%" border="1" cellspacing="0" cellpadding="10">
<?php
 
$examsub=fetchrow(execute("select sub_id from exam_m where id='$examid'"));
$examidsub1=explode(',',$examsub[0]);

for($g=0;$g<sizeof($examidsub1);$g++)
{
//start		

	$electiveid=fetchrow(execute("SELECT elective FROM subject_m where subject_id='$examidsub1[$g]'"));
	
	$flagel=1;
	if($electiveid[0]=='Y')
	{
		$studentstatus=fetchrow(execute("select id from student_course where stu_id='$studentid' and acc_year='$accyeardet' and sub='$examidsub1[$g]'"));
		if(!$studentstatus)
		$flagel=0;
	}
	if($flagel)	
	{
		$flag=1;
		$newid=$examidsub1[$g];
		$Sql67=execute(" select * from skill_grade_desc where student_id='$studentid' and acc_year='$accyeardet'  and sub='$newid' and exam_id='$examid'");
		while($rk=fetcharray($Sql67))
		{
			$desc11=$rk['desc1'];
			
		}

	$sql1=execute("SELECT a.subject_id , a.subject_name FROM subject_m a, master_skills b where a.course_id='$course' and  a.course_year_id='$sem' and b.exam_id='$examid' and b.sub=a.subject_id and a.subject_id='$examidsub1[$g]'  group by b.sub ");
	while($r2=fetcharray($sql1))
	{
			$flag=0;
		
	 if($r2[0]==13)
	 {
		echo "<tr height='30'>
			<td align='justify' colspan=4>
			ESL (English as a Second Language) students follow a pathway of development in learning 
			English that is different from students for whom English is their first language. 
			ESL students are placed in one of the three broad bands: 
			B  (Beginner), I (Intermediate) and A  (Advanced)
 
			</td>
			</tr> "; 
	 }
	  echo "<input type='hidden' name='sub_id[]' value='$r2[0]'>
	   <tr height='30'>
		<td align='center' nowrap>
		<strong>Subject </strong></td>
		<td align='center' nowrap>
		<strong>Skills</strong></td>
		<td nowrap align='center' class='row2'><b> Max Level</b> </td>
		<td nowrap align='center' class='row2'> <b>$descr</b></td>
		</tr> ";

		echo "<tr height='30'>
		<td >&nbsp; </td>
		<td >&nbsp; </td>
		<td nowrap align='center' class='row2'>&nbsp; </td>
		<td nowrap align='center' class='row2'> Scored</td>
		</tr> ";
	   $k=1;
	   $totmax=0;
	   $totmak=0;
	   $grade=0;
	   $subjectname=$r2[1];
		$sql2=execute("SELECT id , skill,mark FROM master_skills where class='$sem' and sub='$r2[0]' and exam_id='$examid' order by posi");
		while($r3=fetcharray($sql2))
		{
				
				
				echo "<tr height='30'>
						<td nowrap width='3%' align='center' valign='top'><b> $subjectname</b></td>
						<td  valign='top'>&nbsp;&nbsp;$r3[1]";
							
						  $k++;
						 
			$sql5=execute("SELECT eval1, eval2,	eval3 FROM skill_grade where  student_id='$studentid' and	skill='$r3[0]' and acc_year='$accyeardet'");
			while($r5=fetcharray($sql5))
			{
				$eval1=$r5[0];
				$eval2=$r5[1];
				$totmax=$totmax+$r3[2];
				if($eval2!='N')
				$totmak=$totmak+$eval2;
				 
				
				 
			}
			echo "</td><input type='hidden' name='subarr[]' value='$r3[0]'>
							<td nowrap align='center'>&nbsp;$r3[2] </td>
							
							<td nowrap align='center'>&nbsp;$eval2 </td>
							
						  </tr>";
						  
		$eval2='';
		$subjectname='&nbsp;';
		}
				echo "<tr height='30'>
						<td nowrap align='center'>&nbsp;</td>
						<td nowrap align='right'><strong>&nbsp;</strong></td>
						
						<td nowrap align='center'>MAX = $totmax</td>
						<td nowrap align='center'>&nbsp;$totmak</td>
						
					  </tr>";
	
	
	
	
		$yearpoint=execute("SELECT tot_point FROM `exam_grade_point` where`acc_year`='$accyeardet' and `sem`='$sem' and exam_id='$examid' and subject_id='$newid' and (('$totmak' between from_point and to_point) or (from_point='$totmak' or to_point='$totmak'))");
		$yearpoint1=fetchrow($yearpoint);	
	
					echo "<tr height='30'>
								<input type='hidden' name='subarr[]' value='$r3[0]'>
	
								<td nowrap align='center'>&nbsp;</td>
								<td nowrap align='right'>&nbsp;</td>	
								<td nowrap align='center'><strong>GRADE<strong></td>
								<td nowrap align='center'><b>&nbsp;$yearpoint1[0]<b></td>
								</tr>";
				$pointdetails='';
				$yearpoint2=execute("SELECT tot_point, from_point,to_point  FROM `exam_grade_point` where`acc_year`='$accyeardet' and `sem`='$sem' and exam_id='$examid' and subject_id='$newid'");								
				while($r6=fetcharray($yearpoint2))
				{
					$pointdetails.=" $r6[0] - ( $r6[1] - $r6[2] ) ";	
				}
					echo "<tr  height='30'>
					<td align='justify' class='row2' colspan='4' nowrap>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<b>Grade Boundaries</b> $pointdetails</td>
					</tr>";
					
					echo "<tr  height='30'>
					<td align='center' class='row2' colspan='4'> <div align='center'><b>$descr COMMENTS<b></div></td>
					</tr>";
					
					echo "<tr>
					<td align='justify' colspan='4' >&nbsp;&nbsp;$desc11</td></tr>";
		}
		if($flag)
		{
					$subjectname=fetchrow(execute("SELECT subject_name FROM subject_m where subject_id='$examidsub1[$g]'"));

					echo "<tr  height='30'>
					<td align='center'>
					<b>$subjectname[0]</b>
					</td>
					<td align='justify' class='row2' colspan='3'><b>$descr COMMENTS :- </b>&nbsp;&nbsp;$desc11</td>
					</tr>";
					
					
		}
		$desc11='';
	}
	//close
}

$totalcalss=fetchrow(execute("select count(id) from $att_table where ( att_date between '$f_date' and '$t_date') and  sec='$class_section_id' group by att_date"));

$present=fetchrow(execute("select count(id) from $att_table where ( att_date between '$f_date' and '$t_date') and  sec='$class_section_id' and stu_id='$studentid' and mor='1'"));
$absent=fetchrow(execute("select count(id) from $att_table where ( att_date between '$f_date' and '$t_date') and  sec='$class_section_id' and stu_id='$studentid' and ( mor='0' )"));
?>
	</table>
    <br>
    <br>
    <br>
<table border="1" align="center" cellspacing="0" cellpadding="0"  >
  <tr  height='30'>
    <td width="174" class="head" valign="top"><p align="center">ATTENDANCE</p></td>
    <td width="168" class="head" valign="top"><p align="center">I TERM</p></td>
  </tr>
  <tr  height='30'>
    <td width="174" valign="top"><p align="center">Total Instructional days</p></td>
    <td width="168" valign="top"><p align="center">&nbsp;<?php echo $totalcalss[0]; ?></p></td>
  </tr>
   <tr  height='30'>
    <td width="174" valign="top"><p align="center">Present</p></td>
    <td width="168" valign="top"><p align="center">&nbsp;<?php echo $present[0]; ?></p></td>
  </tr>
  <tr  height='30'>
    <td width="174" valign="top"><p align="center">Absent</p></td>
    <td width="168" valign="top"><p align="center">&nbsp;<?php echo $absent1=$totalcalss[0]-$present[0]; ?></p></td>
  </tr>
</table>

<p></p>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
$ds=fetchrow(execute("select teacher from class_teacher where grade='$sem' and sect='$class_section_id' order by id limit 1"));
$ss2=execute("select f_name,s_name from staff_det where id='$ds[0]'");
$ss2ft=fetcharray($ss2);	


?>
<table border="0" align="center" cellspacing="0" cellpadding="0" >



  <tr>
    <td width="300" valign="top" nowrap><p align="center"><strong>Home room facilitator
        <br>( 
        <?php
        echo $ss2ft[f_name].' '.$ss2ft[s_name];
        ?> )</strong></p>
    </td>
    <?php
    $ss2=execute("select f_name,s_name from staff_det where type_id='30'");
	$ss2ft=fetcharray($ss2);	
	?>
    <td width="300" valign="top" nowrap><p align="center"><strong> MSP Coordinator 
        <br>( 
        <?php
        echo $ss2ft[f_name].' '.$ss2ft[s_name];
        ?> )</strong></p>
    </td>
    <?php
    $ss2=execute("select f_name,s_name from staff_det where type_id='28'");
	$ss2ft=fetcharray($ss2);	
	?>
    <td width="300" valign="top" nowrap><p align="center"><strong>Principal
        <br>( 
        <?php
        echo $ss2ft[s_name];
        ?> )</strong></p>
    </td>
    <td width="300" valign="top" nowrap><p align="center"><strong> Parent's Sign 	</strong></p></td>
  </tr>
</table>
<br>
<!--<div id="prn" align='center'>
<input  type="button" value=" Print " name="B11" onClick="printReport()" class='bgbutton'></div>--></form>
</body>
</html>
