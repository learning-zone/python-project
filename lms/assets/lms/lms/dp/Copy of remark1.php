<html>
<head>
<?php
session_start();
include("../db.php");
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


if(isset($_POST['save']))
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
	
			$Sql66=execute("select id from dp_remark where student_id='$studentid' and exam_id='$examid' and sub='$subject'");
		if(rowcount($Sql66)>0)
		{
			
			echo "update dp_remark set `expect`='".addslashes($expect)."',`expct_grade`='$achieve',`punctuality`='$punct',`behavior`='$behav',`attendance`='$attnd',`Class_part`='$cpart',`suggestion`='".addslashes($sug)."',`submission`='".addslashes($sub)."',`inquirer`='$inquirer', `knowledgeable`='$knowledgeable', `open_minded`='$openminded', `caring`='$caring',`thinker`='$thinker', `balanced`='$balanced',`risk_taker`='$risktaker', `principled`='$principled', `communicator`='$communicator', `reflective`='$reflective',`avg_grade`='$avg_grade' where student_id='$studentid' and exam_id='$examid' and sub='$subject'";
			
			
			$sql33="update dp_remark set `expect`='".addslashes($expect)."',`expct_grade`='$achieve',`punctuality`='$punct',`behavior`='$behav',`attendance`='$attnd',`Class_part`='$cpart',`suggestion`='".addslashes($sug)."',`submission`='".addslashes($sub)."',`inquirer`='$inquirer', `knowledgeable`='$knowledgeable', `open_minded`='$openminded', `caring`='$caring',`thinker`='$thinker', `balanced`='$balanced',`risk_taker`='$risktaker', `principled`='$principled', `communicator`='$communicator', `reflective`='$reflective',`avg_grade`='$avg_grade' where student_id='$studentid' and exam_id='$examid' and sub='$subject'";
			execute($sql33);
		}
		else
		{
			
			execute("INSERT INTO dp_remark(`class`, `sub`, `exam_id`, `student_id`, `expct_grade`, `suggestion`, `submission`, `punctuality`, `behavior`, `attendance`, `Class_part`, `inquirer`, `knowledgeable`, `open_minded`, `caring`, `thinker`, `balanced`, `risk_taker`, `principled`, `communicator`, `reflective`,`expect`,`avg_grade`) VALUES( '$sem','$subject', '$examid', '$studentid', '$achieve','".addslashes($sug)."','".addslashes($sub)."','$punct','$behav','$attnd','$cpart','$inquirer','$knowledgeable','$openminded', '$caring', '$thinker', '$balanced', '$risktaker', '$principled','$communicator', '$reflective','$expect','$avg_grade')");
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
$sored_name=execute("select mark,maxmark from dp_marks where int_id='$examid' and subject_id='$subject'");
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

  ///////////grade end/////////////
 ?>
 
<table align="center" width="70%" border="1" cellspacing="0" cellpadding="3">
<tr>
    <td align="center" class="head" colspan="10" > ADD MARKS </td>
</tr>
<?php
	$subj=execute("select subject_name,level from subject_m where subject_id=$subject");
	$subj1=fetcharray($subj);
?>
 
 <?php
  echo '
  <tr height="25">
    <td align="center" colspan="10"  class="row2" >Name : '.$stundetname.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Id : '.$student_id.' </td>
  </tr>';

$Sql67=execute("select suggestion,submission,expect from dp_remark where student_id='$studentid' and exam_id='$examid' and sub='$subject'");
while($rk=fetcharray($Sql67))
{
$sug=$rk['suggestion'];
$sub=$rk['submission'];
$expect=$rk['expect'];
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

?>
<tr>
    <td>&nbsp;&nbsp;CLASS TEST GRADE&nbsp;-&nbsp;<b><?=$finlname1?></b></td>
    <td colspan="4">&nbsp;&nbsp;EXPECTED GRADE&nbsp;-&nbsp;<input type='text' size="3" name='expect' value='<?=$expect?>'></td>
</tr>
<tr>
    <td align="center">EXPECTED GRADE</td>
    <?
   $expoint=fetchrow(execute("select expct_grade from dp_remark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
   $achieve=$expoint[0];
   ?> 
	<?php
if($achieve==1)
{
	$achieve_se1='checked';
	$achieve_se2='';
}
if($achieve==2)
{
	$achieve_se1='';
	$achieve_se2='checked';
}

?>   
	
    <td align="center" colspan="4">ACHIEVED&nbsp;<input name="achieve" type="radio" value="1" <?=$achieve_se1?> />&nbsp;/&nbsp;NOT ACHIEVED&nbsp;<input name="achieve" type="radio" value="2" <?=$achieve_se2?> /></td>
</tr>
<tr>
    <td class="rowpic" colspan="5">&nbsp;&nbsp;CLASS TESTS CONDUCTED</td>
</tr>
<tr>
<td>&nbsp;&nbsp;CLASS TEST</td>

<?
$tot2=$totl;
$i=1;
while($totl>0)
{
?>
        <td align="center">Class Test <?=$i?> </td>
  
 <?
 	  $i++;
	  $totl--;
}
?>
</tr>
<tr>
    <td>&nbsp;&nbsp;OUT OF</td>
    <?
$i=0;
while($tot2>0)
{
?>
        <td align="center"> <?=$marks[$i]?></td>
  
 <?
 	  $i++;
	  $tot2--;
}
?>
</tr>
<?
$scrd='0';
$sored_exm=execute("select mark,maxmark from dp_marks where int_id='$examid' and subject_id='$subject'");
while($sored_exm1=fetcharray($sored_exm))
	{
		$scr_mark[]=$sored_exm1[0];
		$max_mark[]=$sored_exm1[1];
		$scrd++;
	}

?>
<tr>
    <td>&nbsp;&nbsp;SCORED</td>
     <?
$s=0;
$scrd1=$scrd;
while($scrd>0)
{
?>
        <td align="center"> <?=$scr_mark[$s]?></td>
  		
 <?
 	$gradedp=($scr_mark[$s]*100)/$max_mark[$s];
	$gradedp1=round($gradedp,2);

	$yearpoint=execute("SELECT tot_point FROM `dp_grade_point` where (('$gradedp1' between from_point and to_point) or (from_point='$gradedp1' or to_point='$gradedp1')) and level_id='$subj1[1]'");
			$yearpoint1=fetchrow($yearpoint);
			$grd_mark[]=$yearpoint1[0];
 	  $s++;
	  $scrd--;
}

?>
</tr>
<tr>
    <td>&nbsp;&nbsp;GRADE</td>
    <?
$t=0;
$c=1;
while($scrd1>0)
{
?>
        <td align="center"> <?=$grd_mark[$t]?></td>
  
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
</tr>
<tr>
    <td>&nbsp;&nbsp;ASSESSMENT OBJECTIVE</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr>
<td align='left' class="row2" colspan="10"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;SUGGESTIONS FOR IMPROVEMENT</div></td></tr>
<tr>
<td align='center' colspan='10' ><textarea name='sug' rows='5' cols='80'><?php echo $sug; ?></textarea></td>
</tr>
<tr>
<td align='left' class="row2" colspan="10"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;SUBMISSIONS&nbsp;:&nbsp;</div></td></tr>
<tr>
<td align='center' colspan='10' ><textarea name='sub' rows='5' cols='80'><?php echo $sub; ?></textarea></td>
<?php
$sug1='';
$sub1='';

?>
</tr>
<tr>
	<td align='left' class="row2" colspan="10"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;GENERAL CONDUCT&nbsp;:&nbsp;</div></td></tr>
<tr>
    <?
	
   $punpoint=fetchrow(execute("select punctuality from dp_remark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
   $punct=$punpoint[0];
   ?> 
	<?php
if($punct==1)
{
	$punct_se1='checked';
	$punct_se2='';
	$punct_se3='';
}
if($punct==2)
{
	$punct_se1='';
	$punct_se2='checked';
	$punct_se3='';
}
if($punct==3)
{
	$punct_se1='';
	$punct_se2='';
	$punct_se3='checked';
}
?>   
	<td><b>Punctuality&nbsp;:</b>&nbsp;On Time&nbsp;
    <input name="punct" type="radio" value="1" <?=$punct_se1?>/>&nbsp;/&nbsp;Late&nbsp;
    <input name="punct" type="radio" value="2" <?=$punct_se2?>/>&nbsp;/&nbsp;Always Late&nbsp;
    <input name="punct" type="radio" value="3" <?=$punct_se3?>/>&nbsp;</td>
    
  <?
   $behpoint=fetchrow(execute("select behavior from dp_remark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
   $behav=$behpoint[0];
   ?> 
	<?php
if($behav==1)
{
	$behav_se1='checked';
	$behav_se2='';
	$behav_se3='';
}
if($behav==2)
{
	$behav_se1='';
	$behav_se2='checked';
	$behav_se3='';
}
if($behav==3)
{
	$behav_se1='';
	$behav_se2='';
	$behav_se3='checked';
}
?>          
 <td colspan="9"><b>Behavior&nbsp;:</b>&nbsp;Good&nbsp;
 <input name="behav" type="radio" value="1" <?=$behav_se1?>/>&nbsp;/&nbsp;Fair&nbsp;
 <input name="behav" type="radio" value="2" <?=$behav_se2?>/>&nbsp;/&nbsp;Needs improvement&nbsp;
 <input name="behav" type="radio" value="3" <?=$behav_se3?>/>&nbsp;</td>
</tr>

<tr>

 <?
   $attnpoint=fetchrow(execute("select attendance from dp_remark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
   $attnd=$attnpoint[0];
   ?> 
	<?php
if($attnd==1)
{
	$attnd_se1='checked';
	$attnd_se2='';
	$attnd_se3='';
}
if($attnd==2)
{
	$attnd_se1='';
	$attnd_se2='checked';
	$attnd_se3='';
}
if($attnd==3)
{
	$attnd_se1='';
	$attnd_se2='';
	$attnd_se3='checked';
}
?>  

    <td><b>Attendance&nbsp;:</b>&nbsp;Regular&nbsp;
    <input name="attnd" type="radio" value="1" <?=$attnd_se1?>/>&nbsp;/&nbsp;Irregular&nbsp;
    <input name="attnd" type="radio" value="2" <?=$attnd_se2?>/>&nbsp;/&nbsp;Very Irregular&nbsp;
    <input name="attnd" type="radio" value="3" <?=$attnd_se3?>/>&nbsp;</td>
 
 <?
   $cpartpoint=fetchrow(execute("select Class_part from dp_remark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
   $cpart=$cpartpoint[0];
   ?> 
	<?php
if($cpart==1)
{
	$cpart_se1='checked';
	$cpart_se2='';
	$cpart_se3='';
	$cpart_se4='';
}
if($cpart==2)
{
	$cpart_se1='';
	$cpart_se2='checked';
	$cpart_se3='';
	$cpart_se4='';
}
if($cpart==3)
{
	$cpart_se1='';
	$cpart_se2='';
	$cpart_se3='checked';
	$cpart_se4='';
}
if($cpart==4)
{
	$cpart_se1='';
	$cpart_se2='';
	$cpart_se3='';
	$cpart_se4='checked';
}
?>  
    
 <td colspan="9"><b>Class participation&nbsp;:</b>&nbsp;Very Good&nbsp;
 <input name="cpart" type="radio" value="1" <?=$cpart_se1?>/>&nbsp;/&nbsp;Good&nbsp;
 <input name="cpart" type="radio" value="2" <?=$cpart_se2?>/>&nbsp;/&nbsp;Average&nbsp;
 <input name="cpart" type="radio" value="3" <?=$cpart_se3?>/>&nbsp;/&nbsp;Poor&nbsp;
 <input name="cpart" type="radio" value="4" <?=$cpart_se4?>/>&nbsp;</td>
</tr>
<tr>
	<td align='left' class="row2" colspan="10"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;Lerner Profiles&nbsp;-&nbsp;Your ward has shown the qualities of a</div></td></tr>
</table>
<table align="center" width="70%" border="1" cellspacing="0" cellpadding="3">
<tr>
  <?
   $allcpoint=fetchrow(execute("select inquirer, knowledgeable, open_minded, caring, thinker,  balanced,risk_taker, principled, communicator, reflective from dp_remark where student_id='$studentid' and exam_id='$examid' and sub='$subject'"));
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
		$inquirer_sel='checked';
		
		if($knowledgeable==1)
		$knowledgeable_sel='checked';
		
		if($openminded==1)
		$openminded_sel='checked';
		
		if($caring==1)
		$caring_sel='checked';
		
		if($thinker==1)
		$thinker_sel='checked';
		
		if($balanced==1)
		$balanced_sel='checked';
		
		if($risktaker==1)
		$risktaker_sel='checked';
		
		if($principled==1)
		$principled_sel='checked';
		
		if($communicator==1)
		$communicator_sel='checked';
		
		if($reflective==1)
		$reflective_sel='checked';

?>
    <td>&nbsp;Inquirer</td>
    <td><input name="inquirer" type="checkbox" value="1" <?=$inquirer_sel?>/></td>
    <td>&nbsp;Open-minded</td>
    <td><input name="knowledgeable" type="checkbox" value="1" <?=$knowledgeable_sel?>/></td>
    <td>Thinker</td>
    <td><input name="openminded" type="checkbox" value="1" <?=$openminded_sel?>/></td>
    <td>&nbsp;Risk-taker</td>
    <td><input name="caring" type="checkbox" value="1" <?=$caring_sel?>/></td>
    <td>&nbsp;Communicator</td>
    <td><input name="thinker" type="checkbox" value="1" <?=$thinker_sel?>/></td>
  </tr>
 <tr>
    <td>&nbsp;Knowledgeable</td>
    <td><input name="balanced" type="checkbox" value="1" <?=$balanced_sel?>/></td>
    <td>&nbsp;Caring</td>
    <td><input name="risktaker" type="checkbox" value="1" <?=$risktaker_sel?>/></td>
    <td>&nbsp;Balanced</td>
    <td><input name="principled" type="checkbox" value="1" <?=$principled_sel?>/></td>
    <td>&nbsp;Principled</td>
    <td><input name="communicator" type="checkbox" value="1" <?=$communicator_sel?>/></td>
    <td>&nbsp;Reflective</td>
    <td><input name="reflective" type="checkbox" value="1" <?=$reflective_sel?>/></td>
  </tr>
</table>
    <br>
 <div align="center">
<input type="submit" name="save" value="Save" class="bgbutton"></div></form>
</body>
</html>
