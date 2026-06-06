<?php
/*$file_type = "vnd.ms-excel";
$file_name= "Govt Info.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");
*/
session_start();
include("../db1.php");
$academic_year=$_SESSION['AcademicYear'];

?>

<html>
<head>
<!--<style type="text/css">
 p.vertical
  {
     writing-mode:tb-lr;
     -webkit-transform:rotate(270deg);
     -moz-transform:rotate(270deg);
     -o-transform: rotate(270deg);
     white-space:nowrap;
     display:block;
     bottom:0;
     width:90px;
     height:120px; 
     position:relative;
     left:110px;
     top:0px;
 }
</style>-->
</head>
<body>
<form name="frm">
<table cellspacing="0" cellpadding="0" border="1">

  <tr>
    <td  width="" nowrap="nowrap">Sr. No.</td>
    <td width="" nowrap="nowrap">Name of Student</td>
    <td width="" nowrap="nowrap">Name of    Father/Guardian</td>
    <td width="" nowrap="nowrap">Name of Mother</td>
    <td width="" nowrap="nowrap">Habitation</td>
    <td width="">Aadhaar UID No.</td>
    <td width="">Date of Birth    DD/MM/YY</td>
    <td width="">Date of Admission    DD/MM/YY</td>
    <td width="">Admission Number</td>
    <td width="">Gender    (Boys=1/Girls=2)</td>
    <td width="">Social Category* Note:- 10</td>
    <td width="">Minority* If any Note:-11</td>
    <td width="">Whether belong to weaker section  (BPL x Yes=1, No=2)</td>
    <td width="">Disadvantage Group (NA=0, Yes=1, No=2)</td>
    <td width="">Whether the child is getting free education in unaided school as per RTE Act. (NA=0, Yes=1,    No=2)</td>
    <td width="">Studying in class (1,2,3,4,5,6,7,8,9,10,11,12,0-Pre Primary)</td>
    <td width="">Class Studied previous year (1,2,3,4,5,6,7,8,9,10,11,12,0-Pre Primary, None=99)</td>
    <td width="">If studying in class 1, status of previous year* Note:-17</td>
    <td width="">No. of days child attended school in previous year</td>
    <td width="">Medium of instruction* Note:-19</td>
    <td width="">Disability, if any* (NA=0) Note:-20</td>
    <td width="">Facilities provided to CWSN* (previous academic year) Note:-21</td>
    <td width="">Complete set of free Text books (NA=0, Yes=1, No=2)</td>
    <td width="">No. of Uniform sets provided (None=0, One set=1, Two sets=2, NA=99)</td>
    <td width="">Free Transport Facility (NA=0, Yes=1, No=2)</td>
    <td width="">Free Escort Facility (NA=0, Yes=1, No=2)</td>
    <td width="">Free hostel facility* (NA=0) Note 26</td>
    <td width="">Whether child attended special Training (NA=0, Residential=1, Non-residential=2)</td>
    <td width="">Whether the child is homeless* (NA=0) Note:- 28</td>
  </tr>
<?php

$sql1=mysql_query("select student_id,first_name,last_name,g_num,parent_name,m_name,admission_date,dob,g_mail,g_name,sms_mobile,mnum,course_yearsem, gender from student_m where id is not null and archive='N' and academic_year='$academic_year' order by course_admitted, course_yearsem, class_section_id, first_name");
$k=0;
while($r=mysql_fetch_array($sql1))
{
	$k++;
	$cgrade=mysql_fetch_row(mysql_query("select year_name from course_year where year_id=$r[course_yearsem]"));


$academic_year;
if($academic_year<date('Y'))
$nyear=$academic_year-1;
else
$nyear=$academic_year-2;

$ny=explode('-',$r[admission_date]);

if($nyear<=$ny[0])
$nid=$r[course_yearsem]-1;
else
$nid=0;

$cgrade1=mysql_fetch_row(mysql_query("select year_name 	 from course_year where year_id='$nid'"));


?>  
  <tr>
    <td align="right"><?=$k?></td>
    <td nowrap="nowrap">&nbsp;<?=$r[first_name]?> <?=$r[last_name]?></td>
    <td>&nbsp;<?=$r[parent_name]?></td>
    <td>&nbsp;<?=$r[m_name]?></td>
    <td>&nbsp;</td>
    <td>NotApplicable</td>
    <td>&nbsp;<?=$r[admission_date]?></td>
    <td>&nbsp;<?=$r[dob]?></td>
    <td>&nbsp;<?=$r[student_id]?></td>
    <td>&nbsp;<?=$r[gender]?></td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td>&nbsp;<?=$cgrade[0]?></td>
    <td>&nbsp;<?=$cgrade1[0]?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
    <td >NotApplicable</td>
  </tr>
<?php
}
?>
</table>
</form>
</body>
</html>
