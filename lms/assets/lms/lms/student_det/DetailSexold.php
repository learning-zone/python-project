<?php
include("../db.php");
$sex=$_REQUEST['sex'];
$semid=$_REQUEST['semid'];
$academic_year=$_SESSION['AcademicYear'];
?>


<HTML>
<HEAD>
</HEAD>
<script language="JavaScript">
		function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
</script>
<BODY>

<?php

$sql2 = "select col_name from college ";
$rs2 = execute($sql2);
$row2 = rowcount($rs2);
$r2 = fetcharray($rs2,0);
$colname = $r2["col_name"];
?>
<table class='forumline' width="400" align=center>
<?php



function GetCourseName($id)
{

	$sql = "SELECT coursename FROM course_m where course_id='$id'";

	$rs = execute($sql);

	$num = rowcount($rs);
	if($num){
		$ar = fetcharray($rs,0);
		return($ar[0]);
	}else{
		return("Unknown Course $id");
	}
}

function GetCourseYear($id)
{

	$sql = "SELECT year_name FROM course_year WHERE year_id='$id'";

	$rs = execute($sql);

	$num = rowcount($rs);

	if($num){
		$ar = fetcharray($rs,0);
		return($ar[0]);
	}else{
		return("Unknown Year $id");
	}
}
$temp_sem=$semid;
$temp_sex=$sex;
if($semid!=0)
{
	
	$sql45 = "SELECT student_id , first_name  from student_m  ";
	if($temp_sex=='M')
	$sql45.=" where gender='M' and archive='N' and course_yearsem='$semid'  and academic_year='$academic_year'  order by first_name";
	elseif($temp_sex=='F')
	$sql45.=" where gender='F' and archive='N'  and course_yearsem='$semid'  and academic_year='$academic_year'  order by first_name";
	else
	$sql45.=" where archive='N'  and course_yearsem='$semid'  and academic_year='$academic_year'   order by first_name";
}


if($sex=='M')
$dis='Male';
if($sex=='F')
$dis='Female';
if($sex=='ALL')
$dis='Male and Female';
$i=1;
if($semid=='ALL')
$disvalue='ALL Class';
else
{
	$sql3=execute("select year_name from course_year where year_id='$temp_sem'");
	$tempval=fetchrow($sql3);
	$disvalue=$tempval[0];
}
?>

<table class='forumline' width="60%" align=center  border="1">

<tr height =50>
    <td align=center class = head colspan=4>Gender Wise Report<br>
    Class : <?php echo $disvalue; ?> 
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
SEX : <?php echo $dis; ?>   </td>
</tr>
  
	<tr height =25>
		<td class="rowpic" align="center">&nbsp;&nbsp;Sl.No</td>
	  	<td class="rowpic">&nbsp;&nbsp;Registration No.	</td>
	  	<td class="rowpic">&nbsp;&nbsp;Name	</td>
	 </tr>
     <?php
if($semid==0)
{
	$sql45 = "SELECT student_id , first_name  from student_m  ";
	if($temp_sex=='M')
	$sql45.=" where gender='M' and archive='N'  and academic_year='$academic_year'  order by first_name";
	elseif($temp_sex=='F')
	$sql45.=" where gender='F' and archive='N'  and academic_year='$academic_year'  order by first_name";
	else
	$sql45.=" where archive='N'  and academic_year='$academic_year'  order by course_yearsem , first_name";
}
	$sql=execute($sql45);
 	while($row=fetcharray($sql))
	 {
	 ?>
     <tr height =20>
		<td>&nbsp;&nbsp;<?php echo $i; 
		$i++; ?></td>
	  	<td>&nbsp;&nbsp;<?php echo $row[0]; ?>	</td>
	  	<td>&nbsp;&nbsp;<?php echo $row[1]; ?>	</td>
	 </tr>
<?php
	 }

	 ?>
</Table>
<br>

<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
</div>
</form>
</BODY>
</HTML>
