<?php
	session_start();
	include("../db1.php");
	$StudID=$_POST['StudID'];
	$sem=$_POST['sem'];
	$a_year=$_POST['a_year'];
	$adate=$_POST['adate'];
	$a_year1=$_POST['a_year1'];
	$comments=$_POST['comments'];
	$k=explode('/',$adate);
	$datesert="$k[2]-$k[1]-$k[0]";
	$bdate=$_POST['bdate'];
	$k=explode('/',$bdate);
	$sysdate="$k[2]-$k[1]-$k[0]";
	
	$check=fetchrow(execute("select id from student_LeavingCertificate where student_id='$StudID' "));
	if($check[0])
	{
		execute("update student_LeavingCertificate set gradeCompleted='{$sem}', academicYear='{$a_year}', lastDateOfAttendance='{$datesert}',
		resultEndYear='{$a_year1}',comments='{$comments}',sysdate='$sysdate' where student_id='$StudID' ");	
	}
	else
	{
		execute("INSERT INTO `student_LeavingCertificate` (`student_id`, `gradeCompleted`, `academicYear`, `lastDateOfAttendance`, 
	`resultEndYear`, `comments`, `sysdate`)
	 VALUES ('{$StudID}', '{$sem}', '{$a_year}', '{$datesert}', '{$a_year1}', '{$comments}', '{$sysdate}')");
	}
	$mod="select first_name, last_name, nationality, dob, academic_year, course_yearsem from student_m where id='$StudID'";
	$mod1=execute($mod);
	$r=fetchrow($mod1);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Leaving  Certificate</title>
</head>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<script language="javascript">
function printReport()
{
// prn.style.display="none";
 window.print();
}
</script>
<body style="font-family:'Times New Roman', Times, serif" onLoad="printReport()">
  <div style="background-image:url(http://www.ecole.myschoolone.com/renew/images/watermark.png)">

<form name="frm">
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<table align="center" width="80%">
<tr><td width="100%">
<p align="center"><strong><u><font style="font-size:28px">Leaving  Certificate</font></u></strong></p>
<p>&nbsp;</p>
<p>Name of student: <strong><u><?=ucwords($r[0]).' '.ucwords($r[1])?></u></strong></p>
<p><br>Nationality: 
	<?php
	    $nation=fetchrow(execute("select nation from  nationality where id='$r[2]'"));
    ?>
               <strong><u><?=$nation[0]?></u></strong></p>
<p><br>Date of Birth  (dd/mm/yy): <strong><u>
<?php
$dob=explode('-',$r[3]);
echo "$dob[2]/$dob[1]/$dob[0]";
?>
</u></strong></p>
<p><br>Class to which  he/she was admitted: <strong><u><?=$_SESSION['semname']?>
<?php
	$div=fetchrow(execute("select acc_year, division from  `fee_apply_fee_student` where student_id='$StudID' and status=1 order by division"));
	$divname=fetchrow(execute("select year_name from  `course_year` where year_id='$div[1]' and status=1 "));

echo " ".$divname[0]." ( $div[0]-".++$div[0]." )";
?>
</u></strong></p>
<p><br>The grade  completed: &nbsp;&nbsp;<strong><u><?=$_SESSION['semname']?>
			<?php
				$rs=fetcharray(execute("SELECT year_name FROM course_year where  year_id='$sem'"));
				echo $rs[0];
				$Fyear=$a_year;
				$Tyear=$a_year+1;
				echo " ( $Fyear - $Tyear )";
            ?>
</u></strong></p>
<p><br>Last date of  attendance in school: <strong><u><?=$adate?></u></strong></p>
<p><br>Result at the end  of the academic year:
            <?php
			$Fyear=$a_year1;
			$Tyear=$a_year1+1;
			//echo "$Fyear - $Tyear";
            ?>
<br/>
<strong><u><?=$comments?></u></strong></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>Finbarr O&rsquo;Regan             
<br />
<strong><em>Principal</em></strong></p>
<p align="right">School Stamp</p>
<p>                                    <br />
  Date: <?=$bdate?></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</tr></td></table>
</form>
</div></body>
</html>