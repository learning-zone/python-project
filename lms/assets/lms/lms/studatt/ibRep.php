<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IB REPORT CARD</title>
</head>
<style>
body {
	background:#DFE0FC url(../wmark.jpg) repeat-y;
	}
</style>
<script language="javascript">
	function print1()
	{
		window.print();
	}
</script>

<body class="body" onLoad="print1()">
<?php
/*
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=Ibskillset.doc");
header("Pragma: no-cache");
header("Expires: 0");
*/
session_start();
require("../db1.php");
$stuid=$_REQUEST['stuid'];
$stuname=$_REQUEST['stuname'];
$branch=$_REQUEST['branch'];
$sem=$_REQUEST['sem'];
$examid=$_REQUEST['examid'];
$studentRowId=$_REQUEST['studentid'];
$class_section_id=$_REQUEST['class_section_id'];
$sqlema=execute("select t_date, descr from exam_m where id='$examid'");
$exmadet=fetchrow($sqlema);
$Curr_Date=$exmadet[0];
$CCur_Date=explode("-",$Curr_Date);
	$CMonth=$CCur_Date[1];
	$CYear=$CCur_Date[0];
?>
    <br>
    <div align="center">
		<img src="../logonew.gif" width="259" height="243">    
    </div>
    <br>
    <div align="center"><h1>
		<?php
        echo collegename();
        ?>
        </h1>
    </div>
    <br>
    
<table align="center" width="100%" border="2" cellspacing="0" cellpadding="3" >
      <tr>
        <td align="center">
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="55%"><strong>&nbsp;Name :  <?php echo $stuname; ?></strong></td>
                <td width="45%">&nbsp;</td>
              </tr>
             <tr>
                <td><strong>&nbsp;Year : <?php 
						$rs=execute("SELECT year_name FROM course_year where year_id='$sem'");
	$classname=fetchrow($rs);
	echo $classname[0];
				
				?></strong></td>
                <td>&nbsp;</td>
              </tr>
             <tr>
                <td><strong>&nbsp;Date : <?php echo date("F ", mktime(0, 0, 0, $CMonth, 32, $CYear)).' '.$CYear;
 ?></strong></td>
                <td><strong>&nbsp; <?php echo $exmadet[1]; ?></strong></td>
              </tr>
             <tr>
                <td nowrap><strong>&nbsp;Class Teacher(S) : <?php 
				$sql=execute("select a.f_name from staff_det a,class_teacher b where a.id=b.teacher and b.grade='$sem' and b.sect='$class_section_id'")or die(mysql_error());
				
				$teacher=fetchrow($sql);
				echo $teacher[0];
				 ?></strong></td>
                <td>&nbsp;</td>
              </tr>

		</table>
        
        </td>
      </tr>
</table>

<br>
    <div align="center"><h3>
		<?php 		$sql=execute("select coursename from course_m where course_id='$branch'");
	$branchname=fetchrow($sql);
	echo $semname=$branchname[0];  ?>
        </h3>
    </div>
 <br style="page-break-before: always;" clear="all" />
<!-- MARKS CODE Starts -->

<?php
$course=$branch;
$studentid=$studentRowId;

$stundetname=$stuname;
$student_id=$stuid;
$temp_value_det=date("Y");
$temp_month_detalis=date("m");
if($temp_month_detalis<5)
{
	$temp_year_detalis=$temp_value_det-1;
}
else
{
	$temp_year_detalis=date("Y");
}
$accyeardet=$temp_year_detalis;
	$sqmr=execute(" select sub from student_course  where acc_year='$accyeardet' and  stu_id='$studentid'");
while($mr=fetcharray($sqmr))
{
$subject_id=$mr[0];
?>
<div align="center">
		<font size='6'><strong>
			<?php
             $name=execute("SELECT col_name  FROM college");
			 $colname=fetchrow($name);
			 echo $colname[0];
            ?>
        </strong></font>
    </div>
<hr>
  <?php

	$sql1=execute("SELECT a.subject_id , a.subject_name , b.mark FROM subject_m a, master_skills b where a.course_id='$course' and  a.course_year_id='$sem' and b.sub=a.subject_id and a.subject_id=$subject_id  group by b.sub ");
$maxtotal=0;
while($r2=fetcharray($sql1))
{
	$alpha=array('','A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');  
	echo"<div align='center' ><font size='5'><strong> $r2[1] </strong></font></div> ";

 $newsql=execute("select a.f_name, a.s_name from staff_det a, staff_rights b where b.subject_id='$r2[0]' and b.class_section_id='$class_section_id' and b.StaffID=a.slno
");
 $staffname=fetchrow($newsql);
  
  echo '<div style="float: left;" >&nbsp;&nbsp;&nbsp;&nbsp;<strong>Name : '.$stundetname.'</div><div style="float: right;" > Year :';
						echo $semname;
						echo ' 
		</strong>&nbsp;&nbsp;&nbsp;&nbsp;</div><br>
		<div style="float: left;" >&nbsp;&nbsp;&nbsp;&nbsp;<strong>Teacher : '.$staffname[0].$staffname[1].'</div><div style="float: right;">'.$exmadet[1].'</strong>&nbsp;&nbsp;&nbsp;&nbsp;</div>
		';
  echo "
  <table align='center' width='100%' border='1' cellspacing='0' cellpadding='0' style='font-size:11px; font-family:Arial, Helvetica, sans-serif'>";

  $k=1;
	$sql2=execute("SELECT id , skill FROM master_skills where divi='$course' and class='$sem' and sub='$r2[0]' order by posi");
	while($r3=fetcharray($sql2))
	{
			echo " <tr>
						<td width='14%' valign='top'>&nbsp;<br>CRITERION $alpha[$k]<br> $r3[1] <br>&nbsp;</td>
					<td  valign='top'width='70%' >";
					 
		$sql4=execute("SELECT id , sub_skill FROM sub_skills where  master_skill='$r3[0]' order by posi");
		while($r4=fetcharray($sql4))
		{
			echo "<br>$r4[1] <br>&nbsp;";
		}

		$sql5=execute("select skill$k ,totalmark, ibgrade from skill_grade_ib  where student_id='$studentid' and acc_year='$accyeardet'  and exam='$examid' and subject='$subject_id'");
		while($r5=fetcharray($sql5))
		{
			$eval1=$r5[0];
			$total=$r5[1];
			$ibgrade=$r5[2];
		}
		echo "</td><input type='hidden' name='subarr[]' value='$r3[0]'>
			<td nowrap align='center' width='8%'> 
				&nbsp;$eval1
			</td>
			<td nowrap align='center' width='8%'> 
				&nbsp;$r2[2]
			</td>
		</tr>";
		 $k++;
	echo "<input type='hidden' name='skillenth' value='$k'>";
	$maxtotal=$maxtotal+$r2[2];
	}
}

 echo " <tr>
    		<td nowrap align='right' colspan='2' >&nbsp;
				<br>
				<strong>  TOTAL  </strong> &nbsp;&nbsp;&nbsp;<br>&nbsp;</td>
	<td align='center'>
		$total
	</td>
		<td align='center'>$maxtotal</td>
    </tr> ";
	 echo " <tr>
    		<td nowrap align='right' colspan='2' >
				<br>
				<strong>  INTERNATIONL BACCALAUREATE GRADE  </strong> &nbsp;&nbsp;&nbsp;<br>&nbsp;</td>
	<td colspan='2' align='center'>$ibgrade</td>

    </tr> ";
?>
</table>
<br>
<table align='center' width='100%' border='1' cellspacing='0' cellpadding='0' style='font-size:11px; font-family:Arial, Helvetica, sans-serif'>
<tr height="26">
    <td align="center" class="row2" >Approaches to Learning </td>
    <td align="center" class="row2" >Improvement Needed</td>
    <td align="center" class="row2" >Satisfactory </td>
    <td align="center" class="row2" >Good </td>
    <td align="center" class="row2" >Excellent </td>

</tr> 
<?php

 $k=1;
	$sql2=execute("SELECT id , skill FROM master_approaches where divi='$course' and class='$sem' and sub='$subject_id' order by posi");
	while($r3=fetcharray($sql2))
	{

		$sql5=execute("select aproach$k ,comments from skill_grade_ib  where student_id='$studentid' and acc_year='$accyeardet'  and exam='$examid' and subject='$subject_id'");
		while($r5=fetcharray($sql5))
		{
			$appval=$r5[0];
			$coments=$r5[1];
		}
		if($appval==1)
		{
			$appdis1='&#8730;';
			$appdis2='';
			$appdis3='';
			$appdis4='';
		}
		if($appval==2)
		{
			$appdis2='&#8730;';
			$appdis3='';
			$appdis4='';
			$appdis1='';
		}
		if($appval==3)
		{
			$appdis3='&#8730;';
			$appdis4='';
			$appdis1='';
			$appdis2='';
		}
		if($appval==4)
		{
			$appdis4='&#8730;';
			$appdis1='';
			$appdis2='';
			$appdis3='';
		}
		echo "	<tr>
					<td >$r3[1]</td>
					<td align='center'>&nbsp;$appdis1</td>
					<td align='center'>&nbsp;$appdis2</td>
					<td align='center'>&nbsp;$appdis3</td>
					<td align='center'>&nbsp;$appdis4</td>
				</tr>"; 
	$k++;
	}
	echo "<input type='hidden' name='applenth' value='$k'>";
?>

</table>
<br>
<table align='center' width='100%' border='1' cellspacing='0' cellpadding='0' style='font-size:11px; font-family:Arial, Helvetica, sans-serif'>
<tr>
    <td width="100%" align='center'>
    <div align="left" >Comment :</div>
    <div align="left" style="border-width:thin">
	&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo $coments; ?></textarea></div> </td>
</tr> 



</table>
<div style="float: right;">Report/<?php echo $exmadet[1]
."/";
echo date("F ", mktime(0, 0, 0, $CMonth, 32, $CYear)).' '.$CYear; ?>
</div>

<br>
<hr>
 <br style="page-break-before: always;" clear="all" />


<?php
}

?>
<!-- MARKS CODE END -->
</body>
</html>