<html>
<head>
<title>Students Review Sheet (PYP)</title>
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
	$subject=$_REQUEST['subject'];
	$factsign=$_REQUEST['factsign'];

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
	$subject=$_POST['subject'];
}
$atttable='att_'.$sem;

$sql=execute("select id,descr  from exam_m where accyear='$accyeardet' and class='$sem' and id<='$examid' and sts=1");
while($r=fetcharray($sql))
{
	$exam_id_new[]=$r[0];
	$exam_id_name[]=$r[1];
}
$rowwidth=sizeof($exam_id_new);
$studenname=execute("select first_name,last_name from student_m where id='$studentid'");
$stundetname1=fetcharray($studenname);
$classname=execute("select year_name from  course_year where year_id='$sem'");
$classname12=mysql_fetch_row($classname);
$section=execute("select section_name from class_section where id='$class_section_id'");
$section1=mysql_fetch_row($section);
$rs_ec=execute("select descr from exam_m where id='$examid' and sts='1'");
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
<!--<body onLoad="printReport()">
-->

</head>

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
                    
    <tr >

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
  


  
   
    <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="3" style="border:1px solid black;"> 
  
  <tr>
    <td  style="border:1px solid black;"align="left"  width="10%" ><h3>&nbsp;&nbsp;E</h3></td>
    <td  style="border:1px solid black;"colspan="2"><h3>&nbsp;&nbsp;Excellent&nbsp;/&nbsp;exceeds expectations</h3></td>
  </tr>
  <tr>
    <td  style="border:1px solid black;"align="left"  width="10%"><h3>&nbsp;&nbsp;M</h3></td>
    <td  style="border:1px solid black;"colspan="2"><h3>&nbsp;&nbsp;Expectations fully met</h3></td>
  </tr>
  <tr>
    <td  style="border:1px solid black;"align="left"  width="10%"><h3>&nbsp;&nbsp;B</h3></td>
    <td  style="border:1px solid black;"colspan="2"><h3>&nbsp;&nbsp;Meets expectations at beginners level</h3></td>
  </tr>
  <tr>
    <td  style="border:1px solid black;"align="left"  width="10%"><h3>&nbsp;&nbsp;T</h3></td>
    <td  style="border:1px solid black;"colspan="2"><h3>&nbsp;&nbsp;More time and experiences needed</h3></td>
  </tr>
    </table>
  <br>
    <br>
	  <br>
	    <br>
		
<table style="border:2px solid black;" width="90%" align="center" border="1" cellspacing="0" cellpadding="3"> 
<tr>
   <td style="border:2px solid black;" align='center'  width="30%" nowrap><input  type="image"  src="smiley.PNG"/>&nbsp;&nbsp;<input  type="image"  src="smiley.PNG"/>&nbsp;&nbsp;<input  type="image"  src="smiley.PNG"/></td>
  	<td style="border:2px solid black;" align='center'  width="30%" nowrap> <input type="image"  src="smiley.PNG"/>&nbsp;&nbsp;<input  type="image"  src="smiley.PNG"/></td>
  	<td  style="border:2px solid black;" align='center' width="30%" nowrap><input  type="image"  src="smiley.PNG"/></td>
    </tr>
  </table>
  <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="3"> 
<tr>
   <td   align='center'  width="30%"><h3>Mostly</h3></td>
  	<td align='center'  width="30%"><h3>Usually</h3></td>
  	<td align='center' width="30%"><h3>Rarely</h3></td>
    </tr>
  </table>

  <br style="page-break-before: always;" clear="all" />
<?php
//loop for multiple exams strats here 

for($l=0;$l<sizeof($exam_id_new);$l++)
{
	$examid=$exam_id_new[$l];
?>  
  <table  width="90%"  align="center" border="0" cellspacing="0" cellpadding="3">
  <tr>
  <td  align='center' width="30%"><input  type="image"  src="habits.PNG"/></td>
    </tr>
	<tr>
    <td align="center" colspan="2"><h3>Work Habits/Scoial Development Record</h3></td>
   
  </tr>
  </table>
  <table width="90%"   align="center" border="0" cellspacing="0" cellpadding="0" style="border:1px solid black;">
  <tr>
    <td  style="border:1px solid black;"align="center"  width="70%"><b>Criteria</b></td>
    <td  style="border:1px solid black;"align="center" width="20%"><b><?php echo $exam_id_name[$l]; ?></b></td>
  </tr>

<?php
$crt=execute("select id, criteria from criteria where class='$sem' and exam_id='$examid'");
while($crt1=fetcharray($crt))
{
	
				$sq99=execute("SELECT  a.mark,b.image_path FROM criteria_m a,pyp_smily b where  a.student_id='$studentid' and  a.criteria_id='$crt1[0]' and a.acc_year='$accyeardet' and a.exam_id='$examid' and a.mark=b.id");
				while($r9=fetcharray($sq99))
			     
				  {  
				  $crit=$r9[0];
				 $critimg=$r9[1];
				  }
		echo"<tr>
		<td  style='border:1px solid black;'align='center'>$crt1[1]</td>
		<td  style='border:1px solid black;'align='center' nowrap>&nbsp;<input type='hidden' name='crt11[]' value='$crt1[0]'>";
		if($critimg!='')
		{
		echo "<input  type='image'  src='$critimg'/>";
		}
		echo "</td></tr>";
		$crit='';
		$critimg='';
	 }
	 
?>
</table>
<br>
 <br style="page-break-before: always;" clear="all" />

 <?php

//main subject strat
$sql1=execute("SELECT a.subject_id , a.subject_name,a.elective FROM subject_m a, pypskills b where a.course_id='$course' and  a.course_year_id='$sem' and b.acc_year='$accyeardet' and b.sub=a.subject_id and b.exam_id='$examid' and a.pypesl!='1' and a.subject_id='$subject' group by a.subject_id");
while($r2=fetcharray($sql1))
	{
	$flag1=1;
	if($r2[2]=='Y')
	{
		$studentstatus=mysql_fetch_row(execute("select id from student_course where stu_id='$studentid' and acc_year='$accyeardet' and sub='$r2[0]'"));
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
		if($r2[0]=='93' || $r2[0]=='128' || $r2[0]=='148' || $r2[0]=='301' || $r2[0]=='302')
			{
				$unit_pyp33=mysql_query("select * from unit_pyp_uoi where sub ='$r2[0]' and acc_year='$accyeardet' and exam_id='$examid' order by unit");
				while($unit_pyp=mysql_fetch_array($unit_pyp33))
		{
			
					echo "<input type='hidden' name='unit_id[]' value='$unit_pyp[unit]'>";
					 echo "<table align='center' width='90%' border='0' cellspacing='0' cellpadding='3'>";			

					echo "<tr><td align='center'> <input  type='image'  src='ideas.PNG'/></td></tr></table><br>";
					 echo "<table align='center' width='90%' border='1' cellspacing='0' cellpadding='3' style='border:1px solid black;'>";			

			echo "
			<tr>
			<td nowrap  align='left' style='border:1px solid black;'><b>&nbsp;&nbsp;Unit of Inquiry</b></td>
			<td nowrap width='50%' colspan='7' align='center' style='border:1px solid black;'>&nbsp;</td>
			</tr>";
			echo " <tr>
			<td  valign='top' style='border:1px solid black;'>&nbsp;Transdisciplinary Theme</td>
			<td nowrap style='border:1px solid black;'>&nbsp;$unit_pyp[theme]</td>
			</tr>";	
			echo " <tr>
			<td nowrap style='border:1px solid black;'>&nbsp;Central Idea</td>
			<td nowrap style='border:1px solid black;'>&nbsp;$unit_pyp[idea]</td>
			</tr>";	
			
					echo " <tr>
						<td  valign='top'  align='left' style='border:1px solid black;'>&nbsp;</td>
						<td  valign='top'  align='center' style='border:1px solid black;'>$descr</td>
						</tr>";
			
				$sql2=mysql_query("SELECT id , skill FROM pypskills where class='$sem' and sub='$r2[0]' and acc_year='$accyeardet' and units='$unit_pyp[unit]'  and exam_id='$examid'  and status=1  order by posi");
	while($r3=mysql_fetch_array($sql2))
	{
				
			
			
					echo " <tr>
						<td  valign='top'  align='left' style='border:1px solid black;'>&nbsp;<b>$r3[1]</b></td>
						<td nowrap align='center' style='border:1px solid black;'><b></b></td>
						</tr>";
						
			  
		$sql4=mysql_query("SELECT id , sub_skill FROM pyp_subskills where  master_skill='$r3[0]' and acc_year='$accyeardet'   and status=1 order by posi");
		while($r4=mysql_fetch_array($sql4))
		{

			$sql5=mysql_query("SELECT  g_kg FROM gradepyp where  student_id='$studentid' and skill='$r4[0]'  and acc_year='$accyeardet' and exam_id='$examid'");
			while($r5=mysql_fetch_array($sql5))
			{
				
			  $g_kg=$r5[0];
				
			}
				if($g_kg==1)
				$g_kgs='E';
				if($g_kg==2)
				$g_kgs='M';
				if($g_kg==3)
				$g_kgs='B';
				if($g_kg==4)
				$g_kgs='T';
				if($g_kg==5)
				$g_kgs='NA';
	 
				echo "<tr>
						<td  style='border:1px solid black;' nowrap align='left'> &nbsp;&nbsp;$r4[1]</td>
						<td  style='border:1px solid black;' nowrap align='center'>&nbsp;<b.$g_kgs</b></td>
					  </tr>";
				
				$g_kgs='';
		}
}
			
			
		$testallcomnts=mysql_fetch_array(mysql_query(" select * from comment_pyp where student_id='$studentid' and sub='$r2[0]' and  acc_year='$accyeardet' and exam_id='$examid' and unit='$unit_pyp[unit]'"));	
				
			echo " <tr>
			<td  valign='top' style='border:1px solid black;'>&nbsp;Unit Concepts</td>
			<td style='border:1px solid black;'>&nbsp;$unit_pyp[unit_cmt]</td>
			</tr>";	
			echo " <tr>
			<td nowrap style='border:1px solid black;'>&nbsp;Focus Skills</td>
			<td style='border:1px solid black;'>&nbsp;$unit_pyp[skill_cm]</td>
			</tr>";
			echo " <tr>
			<td nowrap style='border:1px solid black;'>&nbsp;Focus Profiles</td>
			<td style='border:1px solid black;'>&nbsp;$unit_pyp[profile_cm]</td>
			</tr>";	
			echo "<tr>
					<td><b>&nbsp;$descr&nbsp;&nbsp;<u>Facilitator's Remarks&nbsp;:</u></b></td>
					<td  align='justify' style='border:1px solid black;'>
					$testallcomnts[commt1]&nbsp;</td>
		            </tr>";	
				   $testallcomnts[commt1]='';	
				   ?>
</table>
<br>
<br style="page-break-before: always;" clear="all" />
<table align='center' width='90%' border='1' cellspacing='0' cellpadding='3' style='border:1px solid black;'>
<?
			
			}		
			}
if($r2[0]!='93' and $r2[0]!='128' and $r2[0]!='148' and $r2[0]!='301' and $r2[0]!='302')
			{

?>
 
<table align="center" width="90%" border="0" cellspacing="0"  cellpadding="0">

<?
	$subimag=execute("select * from  subject_image where `subject`='$subject' and class='$sem' and status=1");
$subimages=fetcharray($subimag);
	?>
    <tr><td   nowrap  align='left'><img src="<?php echo $subimages[s_photo]?>" height='70'></td>
	    <td align='center'>&nbsp;</td>
	    
	</tr>

    <tr >
    <td class="row2" align="left"><b>&nbsp;&nbsp;Name&nbsp;:&nbsp;<?php echo $stundetname1[0]  ?> <?php echo $stundetname1[1]  ?></b></td ><td colspan="4" class="row2" align="right"><b>&nbsp;&nbsp;Grade&nbsp;:&nbsp;<?php echo $classname12[0] ?> - <?php echo $section1[0] ?>&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
    </tr>
    
    </table>
    <br>
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="3">
	   <tr><td  align='left'>&nbsp;&nbsp;<b><?=$r2[1]?></b></td>
	    <td align='left' colspan="5"><strong><?=$exam_id_name[$l]?></strong></td>
	</tr>
    </table>
    <br>
    <table align="center" width="90%" border="1" cellspacing="0" cellpadding="3"  style='border:1px solid black;'> 
<?

	$sql2=execute("SELECT id , skill FROM pypskills where class='$sem' and sub='$r2[0]' and acc_year='$accyeardet'  and exam_id='$examid' order by posi");
	while($r3=fetcharray($sql2))
	{
				echo " <tr>
						<td  style='border:1px solid black;' valign='top' width='50%'><b>&nbsp;&nbsp;$r3[1]</b></td>
						<td  style='border:1px solid black;' nowrap align='center'  width='10%'><b>E</b></td>
						<td  style='border:1px solid black;' nowrap align='center'  width='10%'><b>M</b></td>
						<td  style='border:1px solid black;' nowrap align='center'  width='10%'><b>B</b></td>
						<td  style='border:1px solid black;' nowrap align='center'  width='10%'><b>T</b></td>
									<td  style='border:1px solid black;' nowrap align='center'  width='10%'><b>NA</b></td></tr>";
					  
	  
			  
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
				$g_kg5='';
				
				if($g_kg==1)
				$g_kg1='&#10004';
				if($g_kg==2)
				$g_kg2='&#10004';
				if($g_kg==3)
				$g_kg3='&#10004;';
				if($g_kg==4)
				$g_kg4='&#10004;';
	 			if($g_kg==5)
				$g_kg5='&#10004;';
	 
				echo "<tr>
						<td  style='border:1px solid black;' nowrap align='left'> &nbsp;&nbsp;$r4[1]</td>
						<td  style='border:1px solid black;' nowrap align='center'>&nbsp;$g_kg1</td>
						 <td  style='border:1px solid black;' nowrap align='center'>&nbsp;$g_kg2</td>
						<td  style='border:1px solid black;' nowrap align='center'>&nbsp;$g_kg3</td>
						<td  style='border:1px solid black;' nowrap align='center'> &nbsp;$g_kg4</td>
						<td  style='border:1px solid black;' nowrap align='center'> &nbsp;$g_kg5</td>
					  </tr>";
				
										$g_kg='';
		}
}
echo "</table>";
echo "<table align='center' width='90%' border='0' cellspacing='0' cellpadding='3'>";			
echo "<tr>
<td colspan='6'><b><u>$descr:<br>Facilitator's Remarks&nbsp;:</u></b>&nbsp;&nbsp;$commt11
</td>
</tr>";	
?>
</table>
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="3">
<tr>
<?php
$rprtss=fetcharray(execute("select sign_rprt from staff_report_sigs where sub='$subject' and class='$sem'  and examid='$examid' and status=1"));
$sectchec=fetcharray(execute("select id from staff_report_rights where  sub='$subject' and class='$sem' and sec='$class_section_id'  and examid='$examid' and status=1"));

	if ($rprtss[0]==1)
	{
?>
<td colspan='6'><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<?
	}
	if ($rprtss[0]==2)
		{
?>
<td colspan='3' align="left"><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<td colspan='3' align="right"><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<?
	}
if ($rprtss[0]==3)
		{
?>
<td colspan='2' align="left"><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<td colspan='2' align="center"><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<td colspan='2' align="right"><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<?
	}
?>
</tr>
</table>
<br>
<br>
<table align="center" width="90%" border="1" cellspacing="0" cellpadding="3"  style='border:1px solid black;'>
<?				  
}
echo "<br style='page-break-before:always;' clear='all' />";
}
	}
?>     
</table>
<br>
<!--<br style="page-break-before: always;" clear="all" />-->
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="3">
<?
// ESL Code Starts

$english=execute("SELECT a.subject_id , a.subject_name,a.elective FROM subject_m a, pypskills b where a.course_id='$course' and  a.course_year_id='$sem' and b.acc_year='$accyeardet' and b.sub=a.subject_id and a.pypesl='1' and a.subject_id='$subject'  and b.exam_id='$examid' group by b.exam_id");
while($seenglish=fetcharray($english))
	{
		
		  $flag1=1;
	if($seenglish[2]=='Y')
	{
		$studestatus=mysql_fetch_row(execute("select id from student_course where stu_id='$studentid' and acc_year='$accyeardet' and sub='$seenglish[0]'"));
		if(!$studestatus)
		$flag1=0;
	}
		$flag=1;
		
	if($flag1)
	{
	  
		$sudid=$seenglish[0];
		$compyp=execute(" select * from comment_pyp where student_id='$studentid' and sub='$sudid' and  acc_year='$accyeardet' and exam_id='$examid'");
		while($comp=fetcharray($compyp))
		{
			$commt11=$comp['commt1'];
			$comt_ach=$comp['esl_stud_ach'];
			$comt_stud=$comp['esl_stud'];
			$comt_esl=$comp['esl_intro'];
		}
?>

</table>
<br>
<table align='center' width='90%' border='0' cellspacing='0' cellpadding='3'>
	<?
	$subimag=execute("select * from  subject_image where `subject`='$subject' and class='$sem' and status=1");
$subimages=fetcharray($subimag);
	?>
    <tr><td   nowrap  align='left'><img src="<?php echo $subimages[s_photo]?>" height='70'></td>
	    <td align='center'>&nbsp;</td>
	    
	</tr>
<tr>
<td  nowrap  align='left'><b>Name&nbsp;&nbsp;:&nbsp;&nbsp;<?=$stundetname1[0]?>&nbsp;<?=$stundetname1[1]?></b></td><td  nowrap  align='center' width='50%'><b><?=$exam_id_name[$l]?></b></td></tr>
</table>
<table align='center' width='90%' border='0' cellspacing='0' cellpadding='3'>
<tr>
<td><?=$comt_esl?></td>
</tr>
</table>
<table align='center' width='90%' border='0' cellspacing='0' cellpadding='3' style='border:1px solid black;'>
	<?
	$pypskl=execute("SELECT id , skill FROM pypskills where class='$sem' and sub='$seenglish[0]' and acc_year='$accyeardet'  and exam_id='$examid'  order by posi");
	while($pypsklnm=fetcharray($pypskl))
	{
		echo " <tr><td style='border:1px solid black;' valign='top'><b>&nbsp;&nbsp;$pypsklnm[1]<b></td>";
	
	$titlen="SELECT id , sub_skill FROM pyp_title where  master_skill='$pypsklnm[0]' and acc_year='$accyeardet' order by posi";
		$newrs = execute($titlen);
		$countn = mysql_num_rows($newrs);
		while($titlenm=fetcharray($newrs))
		{
	
			
					echo "<td style='border:1px solid black;'  nowrap align='center'><b>$titlenm[1]</b></td>";
					  
	}
			  
		$subskil=execute("SELECT id , sub_skill FROM pyp_subskills where  master_skill='$pypsklnm[0]' and acc_year='$accyeardet' order by posi");
		while($subskilks=fetcharray($subskil))
		{

			$grdopp=execute("SELECT  g_kg FROM gradepyp where  student_id='$studentid' and	skill='$subskilks[0]'  and acc_year='$accyeardet' and exam_id='$examid'");
			while($grdpyp=fetcharray($grdopp))
			{
				
			  $g_kg=$grdpyp[0];
				
			}
				
				 
echo "<tr>
	<td style='border:1px solid black;'  nowrap align='left'> &nbsp;&nbsp;$subskilks[1]</td>
		<input type='hidden' name='subskill[]' value='$subskilks[0]'>";
	for($i=1;$i<=$countn;$i++)
	{
		if($g_kg == $i)
		{
			$g_kg1='&#10004';
			echo "<td style='border:1px solid black;'  nowrap align='center'>$g_kg1</td>";
		}
		else
		{
			echo "<td style='border:1px solid black;'  nowrap align='center'>&nbsp;</td>";
		}
	}
	echo "</tr>";
					                   
		}
		echo "</table>";
echo "<br>";
echo "<br>";
echo"<table align='center' width='90%' border='0' cellspacing='0' cellpadding='3'  style='border:1px solid black;'>";
}
echo "<br>";
echo"<table align='center' width='90%' border='0' cellspacing='0' cellpadding='3' style='border:1px solid black;'>";			  
echo "<tr>
	<td style='border:1px solid black;'  colspan='6'><b>&nbsp;&nbsp;Student's Achievement&nbsp;:</b>&nbsp;$comt_stud
	</td>
</tr>
<tr>
	<td style='border:1px solid black;'  colspan='6'><b>&nbsp;&nbsp;Facilitator's Comment:&nbsp;</b>$comt_ach
	</td>
</tr>";
//<tr>
	//<td style='border:1px solid black;'  width='10%'><b>&nbsp;&nbsp;Facilitator&nbsp;:</b>&nbsp;$commt11
//</td>
//</tr>
					$commt11='';	
					$comt_ach='';
					$esl_stud='';
		?>
        </table>
        <table align='center' width='90%' border='0' cellspacing='0' cellpadding='3' >
<?php
$rprtss=fetcharray(execute("select sign_rprt from staff_report_sigs where sub='$subject' and class='$sem'  and examid='$examid' and status=1"));
$sectchec=fetcharray(execute("select id from staff_report_rights where  sub='$subject' and class='$sem' and sec='$class_section_id'  and examid='$examid' and status=1"));

	if ($rprtss[0]==1)
	{
?>
<td colspan='6'><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<?
	}
	if ($rprtss[0]==2)
		{
?>
<td colspan='3' align="left"><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<td colspan='3' align="right"><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<?
	}
if ($rprtss[0]==3)
		{
?>
<td colspan='2' align="left"><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<td colspan='2' align="center"><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<td colspan='2' align="right"><br><br><b>_____________________<br>Facilitator's Signature</b>
</td>
<?
	}
echo '<br style="page-break-before: always;" clear="all" />';

}
			
	}			   		  
}
?>
</table>

<?php
for($i=0;$i<sizeof($exam_id_new);$i++)
{
	$sql=execute("select f_date, t_date from exam_m where id='$exam_id_new[$i]' and sts=1");
	while($r=fetcharray($sql))	
	{
		$f_date=$r['f_date'];
		$t_date=$r['t_date'];
	}
	$fromdate=explode('-',$f_date);
	$todate=explode('-',$t_date);
	
	$totalclass=mysql_fetch_row(execute("SELECT count(id) FROM $atttable where sec='$class_section_id' and att_date between '$fdate' and '$tdate'"));
	$totalper=mysql_fetch_row(execute("SELECT count(id) FROM $atttable where sec='$class_section_id' and att_date between '$fdate' and '$tdate' and stu_id='$studentid' and mor=1"));
?>
     <br>
     
<table width="90%" border="0" align="center" cellspacing="0" cellpadding="5" >
  <tr>
		  <td  align="left"><b><u>Class Record &nbsp;:&nbsp;<?php echo $exam_id_name[$i]; ?></u></b></td>
   
  </tr>
  <tr>
    <td height="70"  align="left" colspan="2" >From&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $fromdate[2].'-'.$fromdate[1].'-'.$fromdate[0]; ?></td>
    <td  height="70"  align="left" colspan="2">To&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $todate[2].'-'.$todate[1].'-'.$todate[0]; ?></td>
    </tr>
  <tr  height='70%'>
    <td height="70"   align="left">No.of Working Days&nbsp;:</td>
    <td height="70"   align="left">&nbsp;<?php echo $totalclass[0]; ?></td>
     <td height="70"   align="left">No.of Days Present&nbsp;:</td>
    <td height="70"  align="left">&nbsp;<?php echo $totalper[0]; ?></td>
  </tr>


<tr>
  <td nowrap height="70"  align="left" valign="top"><b>Signature of&nbsp;:</b></td>
   
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
