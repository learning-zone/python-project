<?php
include("../db.php");
if($branch!='' && $a_year!=0)
{
	
?>
<HTML>
 <HEAD>
   <script language="Javascript">
	function prn()
	{
		pr1.style.display="none";	
		print(this.form);
	}
	  function gen_excel()
	{
		document.frm.action='ex_stud_det5.php';
		document.frm.submit();
	}
</script>
</HEAD>

<BODY>
  <FORM NAME="frm" METHOD="POST">
	<INPUT TYPE="HIDDEN" NAME="branch" VALUE="<?php echo $branch ?>">
	<INPUT TYPE="HIDDEN" NAME="sem" VALUE="<?php echo $sem ?>">
	<INPUT TYPE="HIDDEN" NAME="section" VALUE="<?php echo $section ?>">
	<INPUT TYPE="HIDDEN" NAME="a_year" VALUE="<?php echo $a_year ?>">

   <?php
$var=mysql_query("select coursename from course_m where course_id=$branch") or die(mysql_error());
$branch1=mysql_fetch_array($var);
$kumar="select intake  from sanction_intake ";
$kumar1=mysql_query($kumar) or die (mysql_error());
$kumar2=mysql_fetch_array($kumar1);
$sanction=$kumar2[intake];
$kumar3="select count(id) as adm from student_m where course_admitted='$branch' and academic_year='$a_year' and admission_type='1'";

$kumar4=mysql_query($kumar3) or die (mysql_error());
$kumar5=mysql_fetch_array($kumar4);
$admitted=$kumar5[adm];

$vacancy=$sanction - $admitted;

?>

<table border='0' width="150%" cellspacing=0 cellpadding=0>
 <tr>
    <td align=center><font size=4><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;APPROVAL LIST- <?php echo $sem1[year_name] ?></b></font></td><td align=right> ANNEXURE-II</td>
 </tr><br>
</table>

<table border='0' width="150%" cellspacing=0 cellpadding=0>
<tr>

  <td align=center ><b>ACADEMIC YEAR <?php echo $a_year?>-<?php echo $a_year+1?></b></td>
  <td align=right>CATEGORY: <b>COMEDK SEATS</b></td>
</tr>
</table>

<table border='0'width="150%" cellspacing=0 cellpadding=0>
 <tr>
   <td align=left><br><b>Name of the College:  VIDYAVARDHAKA COLLEGE OF ENGINEERING, MYSORE 
   <br><br>
   <b>Branch: <?php echo $branch1[coursename] ?> <br><br></td>
 </tr>
</table>

<table border='0' width="150%" cellspacing=0 cellpadding=0>
<tr>
  <td><b>SANCTIONED INTAKE :<?php echo $sanction ?> </b></td>
  <td align=center><b>ACTUAL ADMITTED :<?php echo $admitted ?></b></td>
  <td align=right><b>VACANCY :<?php echo $vacancy ?> </b></td>
</tr>
</table>

<table border='1' width="150%" cellspacing=0 cellpadding=0>
  <!--DWLayoutTable-->
  <tr> 
    <td  align=center><b>SL. NO</b></td>
    <td  align=center nowrap><b>NAME OF THE CANDIDATE</b></td>
    <td  align=center><b>Sex<br>
      (M/F)</b></td>
    <td  align=center><b> QUAL. EXAM PASSED</b></td>
    <td  align=center><b> BOARD</b></td>
    <td  align=center><b>STATE FROM <br>
      WHICH 10+2<br>
      IS PASSED</b></td>
    <td  align=center><b>Kar/<br>
      NKR/<br>
      FN</b></td>
    <td  align=center><b>ELIGIB<br>
      ILITY % AT 10+2</b></td>
    <td  align=center><b>Caste</b></td>
    <td  align=center><b> CAT</b></td>
    <td  align=center><b>COMED RANK</b></td>
    <td  align=center><b>TUITION FEES PAID DURING ADMISSION</b></td>
    <td  align=center><b>FEE REC.NO<br>
      & DATE</b></td>
    <td  align=center><b>SIGNATURE OF THE STUDENT</b></td>
  </tr>
  <?php

$nam = "select id,first_name,last_name,dob,cetcategory,cor_state,cetrank,cetno,admission_date,cetreceiptno,cetfee,img_source_s from student_m  where course_admitted='$branch'  and academic_year='$a_year' and admission_type='1' ";
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
  
  </tr>
  <?php							
 }
		if($name1<=0)
	{
		echo "<tr height=50 >";
		echo " <td colspan=15 align='center'><font color=red>No Records Found In $branch1[coursename] under Management quota</font></td></tr>";
	}

 }
else
{
	header("Location:student_detail_report2.php?action=fail&flag=0&branch=$branch");
}
?>
</table>
<br>
<div id='pr1' align='center'>
	<INPUT TYPE="button" NAME="print" class='bgbutton' VALUE="PRINT THE REPORT" OnClick="prn()">&nbsp;&nbsp;
	<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="EXCEL REPORT" OnClick="gen_excel()">
</div>
 </BODY>
</HTML>