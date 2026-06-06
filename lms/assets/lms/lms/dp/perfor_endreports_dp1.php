<html>
<head>
<script language="javascript">
function printReport()
{
//	prn.style.display="none";
	window.print();
}
</script>
<body onLoad="printReport()">
</head>
<?php
session_start();
include("../db1.php");
$accyeardet=$_SESSION['AcademicYear'];
$accyer1=$accyeardet+1; 
//print_r($_POST);
//print_r($_GET);

if($_REQUEST['course'])
{
	$course=$_REQUEST['course'];
	$subject=$_REQUEST['subject'];
	$sem=$_REQUEST['sem'];
	$examid=$_REQUEST['examid'];
	$studentid=$_REQUEST['studentid'];
	$class_section_id=$_REQUEST['class_section_id'];
	$stundetname=$_REQUEST['stundetname'];
	$student_id=$_REQUEST['student_id'];
	$expect=$_REQUEST['expect'];
	$achieve=$_REQUEST['achieve'];
	$punct=$_REQUEST['punct'];
	$behav=$_REQUEST['behav'];
	$attnd=$_REQUEST['attnd'];
	$cpart=$_REQUEST['cpart'];
	$inquirer=$_REQUEST['inquirer'];
	$knowledgeable=$_REQUEST['knowledgeable'];
	$openminded=$_REQUEST['openminded'];
	$caring=$_REQUEST['caring'];
	$thinker=$_REQUEST['thinker'];
	$balanced=$_REQUEST['balanced'];
	$risktaker=$_REQUEST['risktaker'];
	$principled=$_REQUEST['principled'];
	$communicator=$_REQUEST['communicator'];
	$reflective=$_REQUEST['reflective'];
	$avg_grade=$_REQUEST['avg_grade'];
	
	
}
else
{
	$course=$_POST['course'];
	$subject=$_POST['subject'];
	$sem=$_POST['sem'];
	$examid=$_POST['examid'];
	$studentid=$_POST['studentid'];
	$class_section_id=$_POST['class_section_id'];
	$stundetname=$_POST['stundetname'];
	$student_id=$_POST['student_id'];
	$sub=$_POST['sub'];
	$sug=$_POST['sug'];	
	$expect=$_POST['expect'];
	$achieve=$_POST['achieve'];
	$punct=$_POST['punct'];
	$behav=$_POST['behav'];
	$attnd=$_POST['attnd'];
	$cpart=$_POST['cpart'];
	$inquirer=$_POST['inquirer'];
	$knowledgeable=$_POST['knowledgeable'];
	$openminded=$_POST['openminded'];
	$caring=$_POST['caring'];
	$thinker=$_POST['thinker'];
	$balanced=$_POST['balanced'];
	$risktaker=$_POST['risktaker'];
	$principled=$_POST['principled'];
	$communicator=$_POST['communicator'];
	$reflective=$_POST['reflective'];
	$avg_grade=$_POST['avg_grade'];
}


if(($_POST['save']))
{

	$sub=$_POST['sub'];
	$sug=$_POST['sug'];
	$expect=$_POST['expect'];
	$achieve=$_POST['achieve'];
	$punct=$_POST['punct'];
	$behav=$_POST['behav'];
	$attnd=$_POST['attnd'];
	$cpart=$_POST['cpart'];
	$inquirer=$_POST['inquirer'];
	$knowledgeable=$_POST['knowledgeable'];
	$openminded=$_POST['openminded'];
	$caring=$_POST['caring'];
	$thinker=$_POST['thinker'];
	$balanced=$_POST['balanced'];
	$risktaker=$_POST['risktaker'];
	$principled=$_POST['principled'];
	$communicator=$_POST['communicator'];
	$reflective=$_POST['reflective'];
	$avg_grade=$_POST['avg_grade'];
	
}
?>
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

<?
$studenname=execute("select first_name,last_name from student_m where id='$studentid'");
$stundetname1=fetcharray($studenname);

$coursename=fetcharray(execute("select year_name from course_year where year_id='$sem'"));
$subname=fetcharray(execute("select subject_name from subject_m where subject_id=$subject"));

$sublevel=fetcharray(execute("select level from subject_m where subject_id=$subject"));
$sublevelname=fetcharray(execute("SELECT level_name FROM `dp_levels` WHERE id='$sublevel[0]'"));

?>

<?php
    ///////////grade strat/////////////

	$subnm=execute("select subject_name,level from subject_m where subject_id=$subject");
	$subnm1=fetcharray($subnm);

$rty='0';
$sub_name=execute("select mark from dp_exam_sub_sub_m where exam_id='$examid' and sub_id='$subject'");
while($sub_name1=fetcharray($sub_name))
	{
		$marksname[]=$sub_name1[0];
		$rty++;
	}

$rty1=$rty;
$g=1;
	while($rty>0)
	{
 	  $g++;
	  $rty--;
	}

$f=0;
	while($rty1>0)
	{
 	  $f++;
	  $rty1--;
	}

$frd='0';
$sored_name=execute("select mark,maxmark from dp_marks where int_id='$examid' and subject_id='$subject' and student_id='$studentid'");
while($sored_name1=fetcharray($sored_name))
	{
		$scr_name[]=$sored_name1[0];
		$max_name[]=$sored_name1[1];
		$frd++;
	}

$y=0;
$frd1=$frd;
while($frd>0)
	{

 	$gradename=($scr_name[$y]*100)/$max_name[$y];
	$gradename1=round($gradename,2);
 	$yearname=execute("SELECT tot_point FROM `dp_grade_point` where (('$gradename1' between from_point and to_point) or (from_point='$gradename1' or to_point='$gradename1')) and level_id='$subnm1[1]'");
			$yearname1=fetchrow($yearname);
			$grd_name[]=$yearname1[0];
 	  		$y++;
	  		$frd--;
	}


$p=0;
$r=1;
while($frd1>0)
{
	$totname=$grd_name[$p]+$totname;
	$finlname=$totname/$r;
	$p++;
	$r++;
	$frd1--;
}

	$finlname1=round($finlname,0);
	echo "<input type='hidden' name='avg_grade' value='$finlname1'>";
//echo "select count(avg_grade) from dp_endremark where exam_id='$examid' and sub='$subject' group by avg_grade order by avg_grade";
  ///////////grade end/////////////
 ?>
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td  align='left'  width="20%">&nbsp;&nbsp;<input  type="image"  src="sys.PNG"/>&nbsp;&nbsp;</td>
    <td  align='center'  width="50%"> &nbsp;&nbsp;<input type="image"  src="sys name.PNG"/>&nbsp;&nbsp;</td>
    <td align='right' width="20%">&nbsp;&nbsp;<input  type="image"  src="dp.PNG"/>&nbsp;&nbsp;</td>
</tr>
</table>	
    <br>
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td  align='center' style="font-size:20px"><b>IBDP Cohort&nbsp;<?=$accyeardet?>&nbsp;-&nbsp;<?=$accyer1?></b></td>
</tr>
<tr>
    <td  align='center' style="font-size:20px" nowrap><b>Performance Reports for Term End Examination</b></td>
</tr>
</table>
<table style="border:1px solid black;" align="center" width="90%" cellspacing="0" cellpadding="3">
<tr>
    <td style="border:1px solid black;" >&nbsp;<b>NAME&nbsp;-&nbsp;<?=$stundetname1[0]?>&nbsp;<?=$stundetname1[1]?></b> </td>
    <td style="border:1px solid black;" ><b>&nbsp;<?=$coursename[0]?></b></td>
    <td style="border:1px solid black;" > <b>MONTHS</b> </td>
    <td style="border:1px solid black;" colspan="2"><b></b></td>
</tr>
<tr>
    <td style="border:1px solid black;" >&nbsp;<b>SUBJECT&nbsp;-&nbsp;<?=$subname[0]?></b> </td>
    <td style="border:1px solid black;" width="18%">&nbsp;<b>LEVEL</b></td>
    <td style="border:1px solid black;" width="18%">&nbsp;<b><?=$sublevelname[0]?></b> </td>
    <td style="border:1px solid black;" colspan="2" nowrap>&nbsp;Diploma/Anticipated Diploma/Certificate</td>
</tr>
<?php
	$subj=execute("select subject_name,level from subject_m where subject_id=$subject");
	$subj1=fetcharray($subj);
?>
 
 <?php
$Sql67=execute("select suggestion,submission,expect,asob,paper2,paper3 from dp_endremark where student_id='$studentid' and exam_id='$examid' and sub='$subject'");
while($rk=fetcharray($Sql67))
{
$sug=$rk['suggestion'];
$paper2=$rk['paper2'];
$paper3=$rk['paper3'];
$sub=$rk['submission'];
$expect=$rk['expect'];
$asob=$rk['asob'];
}			
?>
<?
$totl='0';
$sub_exm=execute("select mark from dp_exam_sub_sub_m where exam_id='$examid' and sub_id='$subject'");
while($sub_exm1=fetcharray($sub_exm))
	{
		$marks[]=$sub_exm1[0];
		
		$totl++;
	}
	//class test avg
$order_id=fetchrow(execute("select  order_id, exam_id from `dp_exam_sub_m` where id='$examid'"));
	$exm_id=fetchrow(execute("select  id from `dp_exam_sub_m` where order_id='$order_id[0]' and exam_id='$order_id[1]' ORDER BY `id` ASC
LIMIT 1 "));
	
$newsql=execute("select expect,avg_grade from dp_remark where student_id='$studentid' and exam_id='$exm_id[0]' and sub='$subject'");
while($newsql1=fetcharray($newsql))
{

	$expect1=$newsql1['expect'];
	$avg_grade1=$newsql1['avg_grade'];
}		

?>
<tr>
    <td style="border:1px solid black;"><b>&nbsp;&nbsp;CLASS TEST GRADE&nbsp;-&nbsp;<?=$avg_grade1?></b></td>
    <td colspan="4" style="border:1px solid black;"><b>&nbsp;&nbsp;EXPECTED GRADE&nbsp;-&nbsp;<?=$expect1?></b></td>
</tr>
<tr>
    <td style="border:1px solid black;"><b>&nbsp;&nbsp;CLASS TEST GRADE&nbsp;-&nbsp;<?=$finlname1?></b></td>
    <td colspan="4" style="border:1px solid black;"><b>&nbsp;&nbsp;EXPECTED GRADE&nbsp;-&nbsp;<?=$expect?></b></td>
</tr>
<tr>
    <td align="center" style="border:1px solid black;"><b>EXPECTED GRADE</b></td>
    <?
   $expoint=fetchrow(execute("select expct_grade from dp_endremark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
   $achieve=$expoint[0];
  
 $achiv=fetchrow(execute("select head from dp_achive where id='$achieve'"));
?> 	
    <td align="center" colspan="4" style="border:1px solid black;"><b><?=$achiv[0]?></b></td>
</tr>
<tr>
    <td class="rowpic" colspan="5" style="border:1px solid black;" bgcolor="#999999"><b>EXAMINATION CONDUCTED FOR</b></td>
</tr>
<tr>
<td style="border:1px solid black;">&nbsp;&nbsp;COMPONENT</td>

<?
$tot2=$totl;
$i=1;
while($totl>0)
{
?>
        <td align="left" style="border:1px solid black;" width="10%" nowrap>&nbsp;&nbsp;Paper <?=$i?> </td>
  
 <?
 	  $i++;
	  $totl--;
}
?>
</tr>
<tr>
    <td style="border:1px solid black;">&nbsp;&nbsp;OUT OF</td>
    <?
$i=0;
while($tot2>0)
{
?>
        <td align="center" style="border:1px solid black;"> <?=$marks[$i]?></td>
  
 <?
 	  $i++;
	  $tot2--;
}
?>
</tr>
<?
$scrd='0';
$sored_exm=execute("select mark,maxmark from dp_marks where int_id='$examid' and subject_id='$subject'  and student_id='$studentid'");
while($sored_exm1=fetcharray($sored_exm))
	{
		$scr_mark[]=$sored_exm1[0];
		$max_mark[]=$sored_exm1[1];
		$scrd++;
	}

?>
<tr>
    <td style="border:1px solid black;">&nbsp;&nbsp;SCORED</td>
     <?
$s=0;
$scrd1=$scrd;
while($scrd>0)
{
?>
        <td align="center" style="border:1px solid black;"> <?=$scr_mark[$s]?></td>
  		
 <?
 	$gradedp=($scr_mark[$s]*100)/$max_mark[$s];
	$gradedp1=round($gradedp,0);
	$yearpoint=execute("SELECT tot_point FROM `dp_grade_point` where (('$gradedp1' between from_point and to_point) or (from_point='$gradedp1' or to_point='$gradedp1')) and level_id='$subj1[1]'");
			$yearpoint1=fetchrow($yearpoint);
			$grd_mark[]=$yearpoint1[0];
			
 	  $s++;
	  $scrd--;
}

?>
</tr>
<tr>
    <td style="border:1px solid black;">&nbsp;&nbsp;GRADE</td>
    <?
$t=0;
$c=1;
while($scrd1>0)
{
?>
        <td align="center" style="border:1px solid black;"> <?=$grd_mark[$t]?></td>
  
 <?
 	$totgrd=$grd_mark[$t]+$totgrd;
	$finlgrad=$totgrd/$c;
	  $c++;
 	  $t++;
	  $scrd1--;
}
	$finlgrad1=round($finlgrad,0);
?>
 <?
 	//echo $finlgrad1;
 ?>
 <?
 $asobj=fetchrow(execute("select asob from dp_endremark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
 ?>  
</tr>
<tr>
    <td style="border:1px solid black;">&nbsp;&nbsp;ASSESSMENT OBJECTIVE</td>
    <td style="border:1px solid black;">&nbsp; AO&nbsp;<?=$asobj[0]?></td>
    <td style="border:1px solid black;">&nbsp;</td>
    <td style="border:1px solid black;">&nbsp;</td>
    <td style="border:1px solid black;">&nbsp;</td>
</tr>

<tr>
<td align='left' class="row2" colspan="10" style="border:1px solid black;" bgcolor="#999999"><div align="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;SUGGESTIONS FOR IMPROVEMENT</b></div></td></tr>
<tr height="60">
<td align='left' colspan='10' style="border:1px solid black;"><b>Paper 1&nbsp;:</b>&nbsp;<?php echo $sug; ?></td>
</tr>
<tr height="60"><td align='left' colspan='10' style="border:1px solid black;"><b>Paper 2&nbsp;:</b>&nbsp;<?php echo $paper2; ?></td>
</tr>
<tr height="60">
<td align='left' colspan='10' style="border:1px solid black;"><b>Paper 3&nbsp;:</b>&nbsp;<?php echo $paper3; ?></td>
</tr>
<tr height="30">
<td align='left' class="row2" colspan="10" style="border:1px solid black;" bgcolor="#999999"><div align="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;SUBMISSIONS&nbsp;:&nbsp;</b></div></td></tr>
<tr height="60">
<td align='left' colspan='10' style="border:1px solid black;">&nbsp;<?php echo $sub; ?></td>
<?php
$sug1='';
$sub1='';

?>
</tr>
<tr>
	<td align='left' class="row2" colspan="10" bgcolor="#999999" style="border:1px solid black;"><b><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;GENERAL CONDUCT&nbsp;:&nbsp;</div></b></td></tr>
<tr>
    <?
	
   $punpoint=fetchrow(execute("select punctuality from dp_endremark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
   $punct=$punpoint[0];
  
 $punname=fetchrow(execute("select head from dp_punch where id='$punct'"));
?>   
	<td style="border:1px solid black;" width="65%"><b>Punctuality&nbsp;:&nbsp;<?=$punname[0]?></b></td>
    
  <?
   $behpoint=fetchrow(execute("select behavior from dp_endremark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
   $behav=$behpoint[0];
   
  $behavame=fetchrow(execute("select head from dp_behave where id='$behav'"));
?>          
 <td colspan="9" style="border:1px solid black;"><b>Behavior&nbsp;:&nbsp;<?=$behavame[0]?></b></td>
</tr>

<tr>

 <?
   $attnpoint=fetchrow(execute("select attendance from dp_endremark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
   $attnd=$attnpoint[0];
 $attanfname=fetchrow(execute("select head from dp_attand where id='$attnd'"));
?>  

    <td style="border:1px solid black;"><b>Attendance&nbsp;:&nbsp;<?=$attanfname[0]?></b></td>
 
 <?
   $cpartpoint=fetchrow(execute("select Class_part from dp_endremark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
   $cpart=$cpartpoint[0];
  $classname=fetchrow(execute("select head from dp_class where id='$cpart'"));
?>  
    
 <td colspan="9" style="border:1px solid black;"><b>Class participation&nbsp;:&nbsp;<?=$classname[0]?></b></td>
</tr>
 </table>
<table align="center" width="90%" cellspacing="0" cellpadding="3" style="border:1px solid black;">
<?
$gradone=fetcharray(execute("select avg_grade,count(avg_grade) from dp_endremark where exam_id='$examid' and avg_grade=1 and sub='$subject' group by avg_grade order by avg_grade"));

$gradtwo=fetcharray(execute("select avg_grade,count(avg_grade) from dp_endremark where exam_id='$examid' and avg_grade=2 and sub='$subject' group by avg_grade order by avg_grade"));

$gradthre=fetcharray(execute("select avg_grade,count(avg_grade) from dp_endremark where exam_id='$examid' and avg_grade=3 and sub='$subject' group by avg_grade order by avg_grade"));

$gradfour=fetcharray(execute("select avg_grade,count(avg_grade) from dp_endremark where exam_id='$examid' and avg_grade=4 and sub='$subject' group by avg_grade order by avg_grade"));

$gradfive=fetcharray(execute("select avg_grade,count(avg_grade) from dp_endremark where exam_id='$examid' and avg_grade=5 and sub='$subject' group by avg_grade order by avg_grade"));

$gradsix=fetcharray(execute("select avg_grade,count(avg_grade) from dp_endremark where exam_id='$examid' and avg_grade=6 and sub='$subject' group by avg_grade order by avg_grade"));

$gradseven=fetcharray(execute("select avg_grade,count(avg_grade) from dp_endremark where exam_id='$examid' and avg_grade=7 and sub='$subject' group by avg_grade order by avg_grade"));

?>
<tr>
    <td class="rowpic" colspan="8" bgcolor="#999999"><b>&nbsp;&nbsp;CLASS-WISE GRADES STATUS&nbsp;:&nbsp;</b></td>
</tr>
 <tr>
    <td style="border:1px solid black;"><b>&nbsp;Grades</b></td>
    <td style="border:1px solid black;" align="center"><b>&nbsp;7</b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;6</b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;5</b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;4</b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;3</b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;2</b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;1</b></td>
  </tr>
  <tr>
    <td style="border:1px solid black;"><b>&nbsp;Candidates</b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;<?=$gradseven[1]?></b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;<?=$gradsix[1]?></b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;<?=$gradfive[1]?></b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;<?=$gradfour[1]?></b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;<?=$gradthre[1]?></b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;<?=$gradtwo[1]?></b></td>
    <td style="border:1px solid black;"align="center"><b>&nbsp;<?=$gradone[1]?></b></td>
  </tr>
<tr>
	<td align='left' class="row2" colspan="10" bgcolor="#999999"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;Lerner Profiles&nbsp;-&nbsp;Your ward has shown the qualities of a</div></td></tr>
    </table>
<table align="center" width="90%" cellspacing="0" cellpadding="3" style="border:1px solid black;">
<tr>
  <?
   $allcpoint=fetchrow(execute("select inquirer, knowledgeable, open_minded, caring, thinker,  balanced,risk_taker, principled, communicator, reflective from dp_endremark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
	$inquirer=$allcpoint[0];
	$knowledgeable=$allcpoint[1];
	$openminded=$allcpoint[2];
	$caring=$allcpoint[3];
	$thinker=$allcpoint[4];
	$balanced=$allcpoint[5];
	$risktaker=$allcpoint[6];
	$principled=$allcpoint[7];
	$communicator=$allcpoint[8];
	$reflective=$allcpoint[9];
	
	  ?> 
<?php
/*
		$inquirer='';
		$knowledgeable='';
		$openminded='';
		$caring='';
		$thinker='';
		$balanced='';
		$risktaker='';
		$principled='';
		$communicator='';
		$reflective='';
*/		
		if($inquirer=="1")
		$inquirer_sel='&#10004';
		
		if($knowledgeable==1)
		$knowledgeable_sel='&#10004';
		
		if($openminded==1)
		$openminded_sel='&#10004';
		
		if($caring==1)
		$caring_sel='&#10004';
		
		if($thinker==1)
		$thinker_sel='&#10004';
		
		if($balanced==1)
		$balanced_sel='&#10004';
		
		if($risktaker==1)
		$risktaker_sel='&#10004';
		
		if($principled==1)
		$principled_sel='&#10004';
		
		if($communicator==1)
		$communicator_sel='&#10004';
		
		if($reflective==1)
		$reflective_sel='&#10004';

?>
    <td style="border:1px solid black;">&nbsp;Inquirer</td>
    <td style="border:1px solid black;" width="5%" align="center">&nbsp;<?=$inquirer_sel?></td>
    <td style="border:1px solid black;">&nbsp;Open-minded</td>
    <td style="border:1px solid black;" width="5%" align="center">&nbsp;<?=$openminded_sel?></td>
    <td style="border:1px solid black;">&nbsp;Thinker</td>
    <td style="border:1px solid black;" width="5%" align="center">&nbsp;<?=$thinker_sel?></td>
    <td style="border:1px solid black;">&nbsp;Risk-taker</td>
    <td style="border:1px solid black;" width="5%" align="center">&nbsp;<?=$risktaker_sel?></td>
    <td style="border:1px solid black;">&nbsp;Communicator</td>
    <td style="border:1px solid black;" width="5%" align="center"> &nbsp;<?=$communicator_sel?></td>
  </tr>
 <tr>
    <td style="border:1px solid black;">&nbsp;Knowledgeable</td>
    <td style="border:1px solid black;" width="5%" align="center">&nbsp;<?=$knowledgeable_sel?></td>
    <td style="border:1px solid black;">&nbsp;Caring</td>
    <td style="border:1px solid black;" width="5%" align="center">&nbsp;<?=$caring_sel?></td>
    <td style="border:1px solid black;">&nbsp;Balanced</td>
    <td style="border:1px solid black;" width="5%" align="center">&nbsp; <?=$balanced_sel?></td>
    <td style="border:1px solid black;">&nbsp;Principled</td>
    <td style="border:1px solid black;" width="5%" align="center">&nbsp;<?=$principled_sel?></td>
    <td style="border:1px solid black;">&nbsp;Reflective</td>
    <td style="border:1px solid black;" width="5%" align="center">&nbsp;<?=$reflective_sel?></td>
  </tr>
</table>
<br>
<br>

<table align="center" width="90%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td  align="left">___________________</td>
    <td  align="left">___________________</td>
    <td  align="left">___________________</td>
    <td  align="left">___________________</td>
  </tr>
  <?
  	$vicepvt=execute("SELECT `f_name`,`s_name` FROM `staff_det` WHERE `type_id`=1");
	$viceplas=fetcharray($vicepvt);
$prant=execute("select parent_name from student_m where id='$studentid'");
$prantname=fetcharray($prant);
  ?>
  <tr>
    <td  align="left"><strong>Facilitator</strong></td>
    <td align="left"><strong>DP Coordinator<br><?=$viceplas[0]?>&nbsp;<?=$viceplas[1]?></strong></td>
    <td  align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Parent<br>&nbsp;&nbsp;&nbsp;&nbsp;<?=$prantname[0]?></strong></td>
    <td  align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Student</strong></td>
  </tr>
  </table>
<br style="page-break-before: always;" clear="all" />
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="3">
  <tr><td style="font-size:15px"><br>
<b>&nbsp;&nbsp;ASSESSMENT OBJECTIVE GRID:</b></td></tr>
</table>
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid black;">
<tr>
<td  align="center" style="border:1px solid black;"><b>NO</b></td>
<td  align="left" style="border:1px solid black;"><strong>&nbsp;&nbsp;ASSESSMENT OBJECTIVE (CRITERIA)</strong></td></tr>
<?
$p=1;
$assessment=execute("select criteria from dpcriteria where class='$sem' and exam_id='$examid'");
while($assessmentname=fetcharray($assessment))
{
?>
<tr>
<td  align="center" style="border:1px solid black;">&nbsp;<?=$p?></td>
<td  align="left" style="border:1px solid black;">&nbsp;<?=$assessmentname[0]?></td>
<?
$p++;
}
?>
</tr>
</table>
<br>
<br>
<br>
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="3">
  <tr><td style="font-size:15px"><br>
<b>&nbsp;&nbsp;SCHOOL GRADE BOUNDARIES:</b></td></tr>
</table>
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid black;" >
<tr>
<td bgcolor="#999999" align="center" style="border:1px solid black;"><b>GRADE</b></td>
<td bgcolor="#999999" align="center" style="border:1px solid black;"><b>1</b></td>
<td bgcolor="#999999" align="center" style="border:1px solid black;"><b>2</b></td>
<td bgcolor="#999999" align="center" style="border:1px solid black;"><b>3</b></td>
<td bgcolor="#999999" align="center" style="border:1px solid black;"><b>4</b></td>
<td bgcolor="#999999"  align="center" style="border:1px solid black;"><b>5</b></td>
<td bgcolor="#999999" align="center" style="border:1px solid black;"><b>6</b></td>
<td bgcolor="#999999" align="center" style="border:1px solid black;"><b>7</b></td>
</tr>
<tr>
<td  align="center" style="border:1px solid black;"><b>SL</b></td>
<td  align="center" style="border:1px solid black;"><b>1-14</b></td>
<td  align="center" style="border:1px solid black;"><b>15-28</b></td>
<td  align="center" style="border:1px solid black;"><b>29-44</b></td>
<td  align="center" style="border:1px solid black;"><b>45-62</b></td>
<td  align="center" style="border:1px solid black;"><b>63-74</b></td>
<td  align="center" style="border:1px solid black;"><b>75-88</b></td>
<td  align="center" style="border:1px solid black;"><b>89-100</b></td>
</tr>
<tr>
<td  align="center" style="border:1px solid black;"><b>HL</b></td>
<td  align="center" style="border:1px solid black;"><b>1-14</b></td>
<td  align="center" style="border:1px solid black;"><b>15-28</b></td>
<td  align="center" style="border:1px solid black;"><b>29-42</b></td>
<td  align="center" style="border:1px solid black;"><b>43-58</b></td>
<td  align="center" style="border:1px solid black;"><b>59-76</b></td>
<td  align="center" style="border:1px solid black;"><b>77-91</b></td>
<td  align="center" style="border:1px solid black;"><b>92-100</b></td>

</tr>
</table>
</form>
</body>
</html>
