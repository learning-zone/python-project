<html>
<head>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
</head>
<?php
session_start();
include("../db.php");
//print_r($_POST);
//print_r($_GET);
if($_GET['course'])
{
    $g_dp=$_REQUEST['g_dp'];
    $name=$_REQUEST['name'];
	$mobile=$_REQUEST['mobile'];
    $email=$_REQUEST['email'];
    $adate=$_REQUEST['adate'];
    $bdate=$_REQUEST['bdate'];
    $comments=$_REQUEST['comments'];
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
    $g_dp=$_POST['g_dp'];
    $name=$_REQUEST['name'];
	$mobile=$_REQUEST['mobile'];
    $email=$_REQUEST['email'];
    $adate=$_REQUEST['adate'];
    $bdate=$_REQUEST['bdate'];
    $comments=$_REQUEST['comments'];
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

if(isset($_POST['save']))
{

	
	$ideas_sub=$_POST['ideas_sub'];
    for($j=0;$j<sizeof($ideas_sub);$j++)
	{
		 $idinc=$ideas_sub[$j];
		 $g_dp=$_POST['g_dp_'.$idinc];
		
		
		$Sql7=execute(" select id from dp_grdper where student_id='$studentid' and  per_id='$idinc' and  g_dp='$g_dp' and exam_id='$examid'");
		if(mysql_num_rows($Sql7)>0)
		{
			
			execute("update dp_grdper set  g_dp='$g_dp'  where student_id='$studentid' and class='$sem' and exam_id='$examid' and per_id='$idinc'");
		}
		else
		{	
			
			
			
			execute("INSERT INTO dp_grdper (exam_id, class, student_id, per_id, g_dp) VALUES ('$examid', '$sem', '$studentid', '$idinc', '$g_dp')");		
		}
	}	
		
		$comments=$_POST['comments'.$idinc1];
		$name=$_POST['name'.$idinc1];
		$mobile=$_POST['mobile'.$idinc1];
		$email=$_POST['email'.$idinc1];
		$adate=$_POST['adate'.$idinc1];
		$bdate=$_POST['bdate'.$idinc1];
		 
		  
		$Sql8=execute(" select id from dp_grade where student_id='$studentid' and exam_id='$examid'");
		if(mysql_num_rows($Sql8)>0)
		{
			
		$tfdate=explode('/',$adate);
		$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
		$ttdate=explode('/',$bdate);
		$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];

			
			execute("update dp_grade set  comments='".addslashes($comments)."',name='$name',mobile='$mobile',email='$email',adate='$fdate',bdate='$tdate' where student_id='$studentid'  and exam_id='$examid' ");
		}
		else
		{	
		
		$tfdate=explode('/',$adate);
		$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
		$ttdate=explode('/',$bdate);
		$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];
			
			execute("INSERT INTO dp_grade (exam_id, class, student_id, name,mobile,email,adate,bdate,comments) VALUES ('$examid', '$sem', '$studentid','$name','$mobile','$email','$fdate','$tdate','".addslashes($comments)."')");		
		}
		
	?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
<body>
<?
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
<table align="center" width="90%" border="1" cellspacing="0" cellpadding="5">
<tr>
    <td align="center" class="head" colspan="6" >ADD GRADE</td>
</tr> 
<tr>
    <td class="row2" align="left">Student Name&nbsp;:&nbsp;<?php echo $stundetname1[0]  ?> <?php echo $stundetname1[1]  ?></td ><td colspan="5" class="row2" align="left">Year&nbsp;:&nbsp;<?=$accyeardet?>&nbsp;&nbsp;Grade&nbsp;:&nbsp;<?php echo $classname12[0] ?> - <?php echo $section1[0] ?></td>
</tr>
<tr>
    <td nowrap class='row2' align='center' width='10%'>Pefromance</td>
    <td nowrap class='row2' align='center' width='10%'>Very Good</td>
    <td nowrap class='row2' align='center' width='10%'>Good</td>
    <td nowrap class='row2' align='center'width='10%'>Average</td>
    <td nowrap class='row2' align='center' width='10%'>Below Average</td>
    <td nowrap class='row2' align='center' width='10%'>No Evidence</td>
</tr
	><?php
	$cen_id=execute("select id,name from dp_evalu where status='1'");
	while($cen_id1=fetcharray($cen_id))
	{
		$sq55=execute("SELECT g_dp FROM dp_grdper where  student_id='$studentid' and per_id='$cen_id1[0]' and exam_id='$examid'");
		while($r9=fetcharray($sq55))
		{
			$g_dp=$r9[0];
		
		}
		$g_dp1='';
		$g_dp2='';
		$g_dp3='';
		$g_dp4='';
		$g_dp5='';
		
		if($g_dp==1)
		$g_dp1='checked';
		if($g_dp==2)
		$g_dp2='checked';
		if($g_dp==3)
		$g_dp3='checked';
		if($g_dp==4)
		$g_dp4='checked';
		if($g_dp==5)
		$g_dp5='checked';
		
		
		echo "<tr><td width='40%'>$cen_id1[1]</td>
		<td align='center'><input type='hidden' name='ideas_sub[]' value='$cen_id1[0]'>
		                    <input type='radio' name='g_dp_$cen_id1[0]' value='1' $g_dp1></td>
		<td align='center'> <input type='radio' name='g_dp_$cen_id1[0]' value='2' $g_dp2></td>
		<td align='center'> <input type='radio' name='g_dp_$cen_id1[0]' value='3' $g_dp3></td>
		<td align='center'> <input type='radio' name='g_dp_$cen_id1[0]' value='4' $g_dp4></td>
		<td align='center'> <input type='radio' name='g_dp_$cen_id1[0]' value='5' $g_dp5></td></tr>";
		$g_dp='';
		}
	?>
    </table>
<table align="center" width="90%" border="0" cellspacing="0" cellpadding="5">
    <?
	$Sql8=execute(" select name,mobile,email,adate,bdate,comments from dp_grade where student_id='$studentid' and exam_id='$examid'");
	while($r11=fetcharray($Sql8))
	{
		$comments=$r11[5];
		$name=$r11[0];
		$mobile=$r11[1];
		$email=$r11[2];
		$adate=$r11[3];
		$bdate=$r11[4];
	}
	?>

	<tr><td align='left' colspan='6'>Name of organisation or place&nbsp;:&nbsp;&nbsp;<input type='text' size='70%' name='name' value='<?=$name?>'></td>
	</tr>
	<tr>
	<td align='left'  colspan='6'>Mobile number of Supervisor&nbsp;:&nbsp;&nbsp;<input type='text' size='70%' name='mobile' value='<?=$mobile?>'></td>
	</tr>
	<tr>
	<td align='left'  colspan='6'>Email address of Supervisor&nbsp;:&nbsp;&nbsp;<input type='text' size='70%' name='email' value='<?=$email?>'></td>
	</tr>
	<td align='left'>Date of Commencement&nbsp;:&nbsp;&nbsp;
        <input type="text" name="adate" size="10%" value="<?=$adate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
    </td>
	<td colspan='5'>End Date&nbsp;:&nbsp;&nbsp;
<input type="text"  size="10%" name="bdate" value="<?=$bdate?>">&nbsp;&nbsp;<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>    </td>
	</tr>
	<tr>
	<td align='left' colspan='6'>Additional Comments&nbsp;:<br>
	<textarea name='comments' rows='2' cols='70' ><?=$comments?></textarea></td>
	</tr>
</table><br>
    <br>
 <div align="center">
<input type="submit" name="save" value="Save" class="bgbutton"></div></form>
</body>
</html>