<?php
session_start();
	include("../adminunlockdb.php");
$file_type = "vnd.ms-excel";
$file_name= "Admission_Details.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");
if($branch!='' && $sem!=0)
{
?>
 <BODY>
  
  <?php
$var=mysql_query("select coursename from course_m where course_id=$branch") or die(mysql_error());
$branch1=mysql_fetch_array($var);

$var1=mysql_query("select year_name from course_year where year_id=$sem");
$sem1=mysql_fetch_array($var1);

$var2=mysql_query("select section_name from class_section where id=$section");
$section1=mysql_fetch_array($var2);

$kumar="select intake as intak from intake where course_id='$branch' and course_year_id='$sem' and quota='mgmt' ";
//echo $kumar;
$kumar1=mysql_query($kumar) or die (mysql_error());
$kumar2=mysql_fetch_array($kumar1);
$sanction=$kumar2[intak];

$kumar3="select count(id) as adm from student_m where course_admitted='$branch' and course_yearsem='$sem' and quota_id='mgmt'  and academic_year='$a_year' and dipl_q='N' ";
//echo $kumar3;
$kumar4=mysql_query($kumar3) or die (mysql_error());
$kumar5=mysql_fetch_array($kumar4);
$admitted=$kumar5[adm];

$vacancy=$sanction - $admitted;
?>
<table border=0 width="150%" cellspacing=0 cellpadding=0>
 <tr>
    <td align=center><font size=3><b>ADMISSION TO FIRST YEAR B.E FOR THE YEAR <?php echo $a_year?>-<?php echo $a_year+1?></b></font></td>
	<td align=right><b>MANAGEMENT SEATS</b></td>
 </tr>
 </table>
 <table border=0 width=150% cellspacing=0 cellpadding=0>
 <tr>
   <td align=left><br><b>Name of the College:  VIDYAVARDHAKA COLLEGE OF ENGINEERING, MYSORE 
   <br><br>
   <b>Branch: <?php echo $branch1[coursename] ?><br><br></td>
 </tr>
  </table>
<table border=0 width=150% cellspacing=0 cellpadding=0>
<tr>
  <td><b>SANCTIONED INTAKE :<?php echo $sanction ?> </b></td>
  <td align=center><b>ACTUAL ADMITTED :<?php echo $admitted ?></b></td>
  <td align=right><b>VACANCY :<?php echo $vacancy ?> </b></td>
</tr>
</table>
<table border=1 width="150%" cellspacing=0 cellpadding=0>
<tr>
   <td align=center><b>SL. NO</b></td>
   <td align=center><b>NAME OF THE CANDIDATE</b></td>
   <td align=center><b>DT. OF BIRTH</b></td>
   <td align=center><b> QUAL. EXAM PASS</b></td>
   <td align=center><b>YEAR OF PASS</b></td>
   <td align=center><b> CAT</b></td>
   <td align=center><b>NAME OF THE BOARD</b></td>
   <td align=center><b>STATE</b></td>
   <td align=center><b>PCM.<br>MARKS</b></td>
   <td align=center><b>PCM %</b></td>
   <td align=center><b>CET/<br>COMEDK/<br>AIEEE RANK</b></td>
   <td align=center><b>DT.OF ADMIN</b></td>
   <td align=center><b>FEE REC.NO<br> & DATE</b></td>
   <td align=center><b>FEE AMOUNT COLLECTED AT CELL/COLLEGE</b></td>
   <td align=center><b>REMARKS</b></td>
</tr>

<?php
$nam = "select id,first_name,last_name,dob,cetcategory,cor_state,cetrank,cetno,admission_date,cetreceiptno,cetfee from student_m  where course_admitted='$branch' and course_yearsem='$sem' and quota_id='mgmt' and dipl_q='N' order by id";



$name=mysql_query($nam) or die(mysql_error());
$name1 = mysql_num_rows($name);
for($i=0;$i<$name1;$i++)
 {
		$n = mysql_fetch_array($name);
          $res = mysql_query("select exam_pass,12_passing,12_board,puc_state,12_total,12_perc from academic_details where id='$n[id]'");
		$row = mysql_fetch_array($res);
		$cetcategory=$n["cetcategory"];
        $kum=mysql_query("select name from category where id='$cetcategory'"); 
		$kum1=mysql_fetch_array($kum); 
		?>
		    <tr >
			   <td align=center> <?php echo $i+1?></td>
			   <td align=center> <?php echo $n["first_name"] ." ".$n["last_name"] ?></td>
			   <td align=center> <?php echo $n["dob"]?> </td>
			   <td align=center> <?php echo $row["exam_pass"]?> </td>
			   <td align=center> <?php echo $row["12_passing"]?> </td>
			   <td align=center> <?php echo $kum1["name"]?> </td>
			   <td align=center> <?php echo $row["12_board"]?> </td>
			   <td align=center> <?php echo $row["puc_state"]?> </td>
			   <td align=center> <?php echo $row["12_total"]?> </td>
               <td align=center> <?php echo $row["12_perc"]?> </td>
			   <td align=center> <?php echo $n["cetrank"]?> </td>
	           <td align=center> <?php echo $n["admission_date"]?> </td>
			   <td align=center> <?php echo $n["cetreceiptno"]?> </td>
			   <td align=center> <?php echo $n["cetfee"]?> </td>
			   <td></td>
			 </tr>
		<?php							
 }
		if($name1<=0)
	{
		echo "<tr height=50 >";
		echo " <td colspan=15 align='center'><font color=red>No Records Found In $branch1[coursename] and $sem1[year_name] under MGMT quota</font></td></tr>";
	}

 }
else
{
	header("Location:student_detail_report2.php?action=fail&flag=0&branch=$branch&sem=$sem");
}
?>

</table>
 </BODY>
</HTML>
