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


<table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="5" >
      <b><?=$_SESSION['SchoolName']?></b></td></tr><tr>
	
     <td align="center" colspan="5" class="head" ><b>KG REPORT&nbsp;-&nbsp;<?php 
	 echo $exam_id_name[0];
	 if($exam_id_name[1])
	 echo ' & ' .$exam_id_name[1];
	 ?></b></td></tr>
              <tr>
                    <td valign="top" colspan="5" align="center" class="head"><b><?php echo $accyeardet; ?>&nbsp;-&nbsp;<?php echo $accyer1; ?></b></td>
                    
    <tr height="25">

     <td align="center" colspan="5"  class="row2" ><b>Students Name :&nbsp;<?=$stundetname1[0]?>  <?=$stundetname1[1]?></b></td>

     </tr>
	  <tr height="25">

     <td align="center" colspan="5"  class="row2" ><b> <?=$classname12[0]?></b></td>

   
    </tr></table>
    <br>
    <br>
    <table width="90%"  align="center" border="1" cellspacing="0" cellpadding="3">
 
    
  
  <tr>
    <td align="center"   ><b>E</b></td>
    <td colspan="<?=$rowwidth+1?>">&nbsp;&nbsp;Excellent&nbsp;/&nbsp;exceeds expectations</td>
  </tr>
  <tr>
    <td align="center" width=""><b>M</b></td>
    <td colspan="<?=$rowwidth+1?>">&nbsp;&nbsp;Expectations fully met</td>
  </tr>
  <tr>
    <td align="center" width=""><b>A</b></td>
    <td colspan="<?=$rowwidth+1?>">&nbsp;&nbsp;Meets expectations at an average level</td>
  </tr>
  <tr>
    <td align="center" width=""><b>B</b></td>
    <td colspan="<?=$rowwidth+1?>">&nbsp;&nbsp;Meets expectations at an beginners level</td>
  </tr>

 
 <tr>
    <td align="center" width="">&nbsp;&nbsp;</td>
    <td colspan="<?=$rowwidth+1?>">&nbsp;&nbsp;</td>
  </tr>

<tr>
   <td align='left' class='row2'>&nbsp;&nbsp;<b> SUBJECT </b></td>
  	<td align='left' class='row2'> &nbsp;&nbsp;<b>SKILL </b></td>
  	<?php
	for($i=0;$i<sizeof($exam_id_name);$i++)
	{
	?>
	<td  align='center' class='row2'  nowrap="nowrap"> &nbsp;&nbsp; <b><?php echo $exam_id_name[$i]; ?></b></td>
    <?php
	}
	?>
	</tr>
<?php

$sql1=execute("SELECT a.subject_id , a.subject_name,a.elective FROM subject_m a, kgskills b where a.course_id='$course' and  a.course_year_id='$sem' and b.acc_year='$accyeardet' and b.sub=a.subject_id  and (a.subject_id!= '75' and a.subject_id!='81' and a.subject_id!='86')  group by b.sub order by a.sub_pre");
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
		$sql2=execute("SELECT id , skill FROM kgskills where class='$sem' and sub='$r2[0]' and acc_year='$accyeardet'  order by posi");
		while($r3=fetcharray($sql2))
		{	
			if($flag)
			{
				echo "<tr> <td nowrap align='left'><b>&nbsp;&nbsp;$r2[1]</b></td>
				<td nowrap align='left'>&nbsp;</td>";
				for($i=0;$i<sizeof($exam_id_name);$i++)
				{
					echo "<td nowrap align='left'>&nbsp;</td>";
				}
				echo "</tr> ";
				$flag=0;
			}
		   
			$skillname=$r3[1];
			$sql4=execute("SELECT id , sub_skill FROM kg_subskills where  master_skill='$r3[0]' and acc_year='$accyeardet' order by posi");
			while($r4=fetcharray($sql4))
			{
				$sql5=fetchrow(execute("SELECT  g_kg FROM gradekg where  student_id='$studentid' and	skill='$r4[0]' and acc_year='$accyeardet' and exam_id='$examid'"));
				echo"<tr><td nowrap align='left'>&nbsp;$skillname</td><td nowrap align='left'>&nbsp;&nbsp;$r4[1]</td>";
				$skillname='';
				for($i=0;$i<sizeof($exam_id_new);$i++)
				{
					$exam_id_new1=fetchrow(execute("SELECT  g_kg FROM gradekg where  student_id='$studentid' and	skill='$r4[0]' and acc_year='$accyeardet' and exam_id='$exam_id_new[$i]'"));
					echo "<td nowrap align='center'>&nbsp;
					$exam_id_new1[0] </td>";
				}
			}
			echo "</tr>";
			
			$skillname='';
			$g_kg='';
			}
		}
	}

for($i=0;$i<sizeof($exam_id_new);$i++)
{
$commt11=fetchrow(execute(" select commt from comment_kg where student_id='$studentid' and acc_year='$accyeardet' and exam_id='$exam_id_new[$i]'"));
?>
<?php
																																																																										
?>
<tr>
<td class="keycell" nowrap="nowrap"><b>&nbsp;<?php echo $exam_id_name[$i]; ?><br>&nbsp;COMMENTS</b></td>
<td colSpan="<?=$rowwidth+2?>" align="justify">&nbsp;<?php echo $commt11[0]?></td>
</tr>
<?php
}																																																																			?>
</table>
<br style="page-break-before: always;" clear="all" />


<?php
//unit of enquery code starts 
			
for($i=0;$i<sizeof($exam_id_new);$i++)
{	
$sql1=execute("SELECT a.subject_id , a.subject_name,a.elective FROM subject_m a, kgskills b where a.course_id='$course' and  a.course_year_id='$sem' and b.acc_year='$accyeardet' and b.sub=a.subject_id and (a.subject_id='75' or a.subject_id='81' or a.subject_id='86') and exam_id='$exam_id_new[$i]'  group by b.sub order by a.sub_pre");
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
		
		$sql2=execute("SELECT id , skill FROM kgskills where exam_id='$exam_id_new[$i]' and  class='$sem' and sub='$r2[0]' and acc_year='$accyeardet'  order by posi");
		while($r3=fetcharray($sql2))
		{	
			
			?>
			<table align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
	
			<?php
			if($flag)
			{
				echo "<tr> 
				<td nowrap align='left' width='30%'><b>&nbsp;&nbsp;$r2[1]</b></td>
				<td nowrap align='left' width='45%'>&nbsp;</td>
				<td nowrap align='left' width='15%'>&nbsp;</td>";
				echo "</tr> ";
				$flag=0;
			}
		  
		   		$unit_kg=fetcharray(execute("select * from unit_kg where student_id='$studentid' and master_skill ='$r3[0]' and acc_year='$accyeardet' and exam_id='$exam_id_new[$i]'"));
		   		$facccoment=$unit_kg[fac_cmt];
				if($unit_kg[theme]=='')
				{
					$unit_kg=fetcharray(execute("select * from unit_kg where student_id='$studentid' and master_skill ='$r3[0]' and acc_year='$accyeardet' and exam_id='$exam_id_new[$i]' limit 1"));
				$facccoment='';
				}
				echo "<tr>
				<input type='hidden' name='mainskill[]' value='$r3[0]'>
					<td>&nbsp;Transdisciplinary Theme</td>
					<td>&nbsp;$unit_kg[theme]</td>
					<td nowrap align='left'>&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;Central idea</td>
				<td>&nbsp;$unit_kg[idea]</td>
				<td nowrap align='left'>&nbsp;</td>";
				$flag=1;
			
			$skillname=$r3[1];
			$sql4=execute("SELECT id , sub_skill FROM kg_subskills where  master_skill='$r3[0]' and acc_year='$accyeardet' order by posi");
			while($r4=fetcharray($sql4))
			{
				$sql5=fetchrow(execute("SELECT  g_kg FROM gradekg where  student_id='$studentid' and	skill='$r4[0]' and acc_year='$accyeardet' and exam_id='$exam_id_new[$i]'"));
				echo"<tr><td nowrap align='left'>&nbsp;$skillname</td><td nowrap align='left'>&nbsp;&nbsp;$r4[1]</td>";
				$skillname='';
				
					$exam_id_new1=fetchrow(execute("SELECT  g_kg FROM gradekg where  student_id='$studentid' and	skill='$r4[0]' and acc_year='$accyeardet' and exam_id='$exam_id_new[$i]'"));
					echo "<td nowrap align='center'>&nbsp;
					$sql5[0]</td>";
					$sql5[0]='';
				
			}
			echo "</tr>";
			
				echo "<tr>
				<td>&nbsp;Focus Skills</td>
				<td>&nbsp;$unit_kg[skill_cm]</td>
			`	<td nowrap align='left'>&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;Focus Profiles</td>
				<td >&nbsp;$unit_kg[profile]</td>
				<td nowrap align='left'>&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;Facilitator's Comments</td>
				<td>&nbsp;$unit_kg[fac_cmt]</td>
				<td nowrap align='left'>&nbsp;</td>
				</tr>";
			$skillname='';
			$g_kg='';
			?>
	</table>
	<br style="page-break-before: always;" clear="all" />

	<?php
			}
			
		}
	}	
	
}



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
?>    <br>
<table width="90%" border="0" align="center" cellspacing="0" cellpadding="0" >

  <tr>
  <td align="left"><b>Promoted to Class&nbsp;:&nbsp;</b></td>
  </tr>
</table>
<br>
<!--<div id="prn" align='center'>
<input  type="button" value=" Print " name="B11" onClick="printReport()" class='bgbutton'></div>--></form>
</body>
</html>
		