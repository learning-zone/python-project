<?php
session_start();
include("../db.php");
$academic_year=$_SESSION['AcademicYear'];
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$section=$_POST['section'];
?>
<HTML>
<HEAD>
<script language="Javascript">
function prn()
{
	pr1.style.display="none";	
	print(this.form);
}
</script>
</HEAD>
<BODY>
<form name="frm1" method="POST"> 

<?php

function GetCourseName($id)
{
    $sql = "SELECT coursename FROM course_m where course_id=$id";
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
    $sql = "SELECT year_name FROM course_year WHERE year_id=$id";
	$rs = execute($sql);
	$num = rowcount($rs);
	if($num){
		$ar = fetcharray($rs,0);
		return($ar[0]);
	}else{
		return("Unknown Year $id");
	}
}
$temp_sem=$sem;
$rs_sql=execute("select * from college");
$r_sql=fetcharray($rs_sql);
if(rowcount($rs_sql)==0)
{
	die("<font size=4>Collage Details Not Found.</font>");
}
$collage_name=$r_sql[col_name];
mysql_free_result($rs_sql);



$query1 = execute("select coursename from course_m where course_id='$branch'");
$row11  = mysql_fetch_row($query1);
$query2 = execute("select year_name from course_year where year_id='$temp_sem'");
$row21  = mysql_fetch_row($query2);

/*$rsq = execute("select academic_year from student_m where course_admitted='$branch' and academic_year='$aca'");
$rsq1 = mysql_fetch_row($rsq);
$ayearnext = $aca+1;*/

if($section != 0)
{
	$query3 = execute("select section_name from class_section where id='$section'");
	$row31  = mysql_fetch_row($query3);
	$row41 = $row31[0];
}
else
{
	$row41 = "No Section";
}

?>
<FORM NAME="frm" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="filename" VALUE="<?=$filename;?>">
<INPUT TYPE="HIDDEN" NAME="branch" VALUE="<?=$branch;?>">
<INPUT TYPE="HIDDEN" NAME="temp_sem" VALUE="<?=$temp_sem;?>">
<INPUT TYPE="HIDDEN" NAME="temp_sec" VALUE="<?=$temp_sec;?>">
<INPUT TYPE="HIDDEN" NAME="temp_aca" VALUE="<?=$temp_aca;?>">


<table  ALIGN='center' width="60%" cellspacing="0" cellpadding="0"  class="forumline" border="0">
<tr height=30>
   <td colspan='3' align='center' class='head'>ARCHIVED STUDENT LIST</td>
</tr>
<tr height=30>
   <td colspan='3' align='center' class='head'>AS ON :<?=date("d-m-Y g:i a")?> </td>
</tr>
<tr height=25>
<td class='rowpic'>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> : <?php echo $row11[0] ?></td>
<td class='rowpic'>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?>  : <?php echo $row21[0] ?></td>
<td class='rowpic'>&nbsp;&nbsp;SECTION  <?php echo $row41?></td>
</tr>
<tr><td colspan='3'><table class='forumline' width='100%' cellspacing='0' cellpadding='0'>
<tr height=30>
   <td ALIGN='CENTER' width='10%'><font size='2.5' WIDTH='5%'>Sl. No.</td>
   <td align='center'><font size='2.5'>&nbsp;&nbsp;Student ID</td>
   <td><font size='2.5'>&nbsp;&nbsp;&nbsp;&nbsp;Student Name</td>
</tr>
<?
 $var = "select student_id,first_name,last_name from student_m where course_admitted='$branch' and course_yearsem='$temp_sem' and class_section_id='$section' and academic_year='$academic_year' and  archive!='N' order by student_id,first_name ASC";
   $rowclass = 1;
   $res  = mysql_query($var) or die(mysql_error());
   $num1 = mysql_num_rows($res);
   for($i=1;$i<=$num1;$i++)
	{
		$row = mysql_fetch_array($res);
		
		?>
        <tr height=25>
			<td  align='center' class="row<?php echo $rowclass ?>">&nbsp;&nbsp;<?php echo $i ?></td>
			<td  align='center'class="row<?php echo $rowclass ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row[student_id] ?></td>
			<td  class="row<?php echo $rowclass ?>"><?php echo $row[first_name].".".$row[last_name]?></td>
      <!--  <?php 
				   $ayearnext=$row["academic_year"]+1;
			?>
			<td  class="row<?php echo $rowclass ?>">&nbsp;&nbsp;<?php echo $row["academic_year"] ." - "."  ".$ayearnext ."<br>" ?> </td> -->
			</tr>
		<?php
       $rowclass = 1 - $rowclass;	
	}
	?>
</Table></td></tr>
</table>
<br>
<div id=pr1 align=center><INPUT TYPE="button" NAME="print" class='bgbutton' VALUE="PRINT THE REPORT" OnClick="prn()"></div>
</form>
</BODY>
</HTML>	