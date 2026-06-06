<?php
session_start();
include("../adminunlockdb.php");
$file_type = "vnd.ms-excel";
$file_name= "Admission_Details.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");
if($branch!='' && $a_year!='')
{
?>
<?php
$var=mysql_query("select coursename from course_m where course_id=$branch") or die(mysql_error());
$branch1=mysql_fetch_array($var);

$kumar="select intake  from sanction_intake where course_id='$branch' ";

$kumar1=mysql_query($kumar) or die (mysql_error());
$kumar2=mysql_fetch_array($kumar1);
$sanction=$kumar2[intake];

$kumar3="select count(id) as adm from student_m where course_admitted='$branch' and academic_year='$a_year' and quota_id='cet' ";
$kumar4=mysql_query($kumar3) or die (mysql_error());
$kumar5=mysql_fetch_array($kumar4);
$admitted=$kumar5[adm];
//echo $admitted;
$vacancy=$sanction - $admitted;


?>
<table border=0 width="150%" cellspacing=0 cellpadding=0>
 <tr>
    <td align=center colspan="3"><h1>ADMISSION TO FIRST YEAR B.E FOR THE ACADEMIC YEAR <?php echo $a_year ?>-<?php echo $a_year+1 ?></h1></td>
 </tr>
 <tr>
   <td align=center><h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of the College:  VIDYAVARDHAKA COLLEGE OF ENGINEERING, MYSORE </h3> </td>
   <td>&nbsp;</td>
   <td align=right><b>ANNEXURE-I<br>CAT-1/ SEATS</b></td>
   </tr>
 <tr>
     <td colspan="3" align='center'><h3>Branch: <?php echo $branch1[coursename] ?></h3><br><br></td>
 </tr>
<tr>
  <td><b>SANCTIONED INTAKE :<?php echo $sanction ?> </b></td>
  <td align=center><b>ACTUAL ADMITTED :<?php echo $admitted ?></b></td>
  <td align=right><b>VACANCY :<?php echo $vacancy ?> </b></td>
</tr>
<tr><td align="center" colspan="3">
<table border=1  width="150%" cellspacing=0 cellpadding=0>
<tr>
   <td align=center><b>SL. NO</b></td>
   <td align=center nowrap><b>NAME OF THE CANDIDATE</b></td>
   <td align=center nowrap><b>DT. OF BIRTH</b></td>
   <td align=center nowrap><b> QUAL.<br> EXAM PASS</b></td>
   <td align=center nowrap><b>YEAR OF PASS</b></td>
   <td align=center nowrap><b> CAT</b></td>
   <td align=center nowrap><b>NAME OF THE BOARD</b></td>
   <td align=center nowrap><b>STATE</b></td>
   <td align=center nowrap><b>PCM<br>MARKS</b></td>
   <td align=center nowrap><b>% OF MARKS</b></td>
   <td align=center nowrap><b>CET RANK</b></td>
   <td align=center nowrap><b>CET/DIP.AD.Ltr.<br>No.& date</b></td>
   <td align=center nowrap><b>DT.OF ADMIN</b></td>
   <td align=center nowrap><b>FEE REC.NO<br> & DATE</b></td>
   <td align=center ><b>FEE AMOUNT COLLECTED AT CELL/COLLEGE</b></td>
   <td align=center nowrap><b>STUDENT SIGNATURE</b></td>
   
   

<?php

$nam = "select id,first_name,last_name,dob,cetcategory,cor_state,cetrank,cetno,admission_date,cetreceiptno,cetfee,img_source_s from student_m  where course_admitted='$branch'  and 	academic_year='$a_year' ";
$name=mysql_query($nam) or die(mysql_error());
$name1 = mysql_num_rows($name);
for($i=0;$i<$name1;$i++)
 {
		$n = mysql_fetch_array($name);
		$cetcategory=$n["cetcategory"];
		$res = mysql_query("select exam_pass,12_passing,12_board,puc_state,12_total,12_perc from academic_details where id='$n[id]'");
		$row = mysql_fetch_array($res);
        $kum=mysql_query("select name from category where id='$cetcategory'"); 
		$kum1=mysql_fetch_array($kum); 
		$dates=explode("-",$n["dob"]);
		$dob=$dates[2]."-".$dates[1]."-".$dates[0];
		?>
		    <tr >
			   <td>&nbsp; <?php echo $i+1?></td>
			   <td>&nbsp; <?php echo $n["first_name"] ." ".$n["last_name"] ?></td>
			   <td>&nbsp; <?php echo $dob?> </td>
			   <td>&nbsp; <?php echo $row["exam_pass"]?> </td>
			   <td>&nbsp; <?php echo $row["12_passing"]?> </td>
			   <td nowrap>&nbsp; <?php echo $kum1["name"]?> </td>
			   <td>&nbsp; <?php echo $row["12_board"]?> </td>
			   <td> &nbsp;<?php echo $row["puc_state"]?> </td>
			   <td>&nbsp; <?php echo $row["12_total"]?> </td>
               <td>&nbsp; <?php echo $row["12_perc"]?> </td>
			   <td>&nbsp; <?php echo $n["cetrank"]?> </td>
			   <td>&nbsp;<?php echo $n["cetno"]?> </td>
			   <td>&nbsp; <?php echo $n["admission_date"]?> </td>
			   <td>&nbsp; <?php echo $n["cetreceiptno"]?> </td>
			   <td>&nbsp; <?php echo $n["cetfee"]?> </td>
               <td>&nbsp;<?php  echo "&nbsp;"?></td>
			 </tr>
		<?php							
 }
		if($name1<=0)
	{
		echo "<tr height=50 >";
		echo " <td colspan=15 align='center'><font color=red>No Records Found In $branch1[coursename] under CET quota</font></td></tr>";
	}

 }
else
{
	header("Location:student_detail_report2.php?action=fail&flag=0&branch=$branch&sem=$sem");
}
?>
</table>
</td></tr>



