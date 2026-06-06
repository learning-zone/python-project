<?php
session_start();
require("../db.php");
?>
<HTML>
<HEAD>
<TITLE>REPORTS</TITLE>
<script langauge="javascript">
function go()
{
	document.frm.action="student_detail_report2.php";
	document.frm.submit();
}
</script>
</HEAD>
<BODY leftmargin=0 topmargin=0>
<form method="POST"  name="frm">
<table width="40%" border="1" cellspacing=0 align='center' class=forumline>
<tr><td class=head align=center colspan=2>Student Admission Details Report</td></tr>
<?php
$rsBR = execute("SELECT course_id,coursename  FROM course_m ");
$countBR = rowcount($rsBR);
$rsSM = execute("select * from course_year where status=1 ");
$countSM = rowcount($rsSM);

?>
<br>
<tr>
<td ><b>Branch</b></td>
<td align="left" width="300">
<?
$qry=execute("select * from course_m order by coursename") or die();
echo "<select name='branch'>";
echo "<option value=''>Select Branch</option>";
while($qry1=fetcharray($qry))
  {
      if($qry1[0]==$branch)
        {
             echo"<option value=$qry1[course_id] selected>$qry1[coursename]</option>";
        }
       else
        {
             echo"<option value=$qry1[course_id]>$qry1[coursename]</option>";
        }
   }
?>

</select>
</td>
</tr>
<tr>
<td>Academic Year</td>
		<td><select name="a_year" onChange="go()">
			<option value=''> select academic year</option>
			<?php
			   $MyYear=date('Y')-5;
			   $CurrentYr=date("Y")+5;
			   for($i=$MyYear;$i<$CurrentYr;$i++)
				 {
					$Fyear=$i;
					$Tyear=$i+1;
					$Tyear=substr($Tyear,2);
					$sele="";
					if($a_year==0)
					 {
						if($i==date('Y'))
						 {
							$sele="selected";
						 }
					 }
					 else 
					 {
						 if($i==$a_year)
						$sele="selected";
					 }
					 
				  ?>
				  	 <option value="<?=$i?>" <?=$sele?>><?=$Fyear?>-<?=$Tyear?></option>
					<?php
				}
				 

	   ?>
             </select></td></tr>
</table>
<br>
<table border=0 width=53% align=center class=forumline >
<tr height=30>
<td class=head align=center colspan=4>Select a Report</td>
</tr>
<tr height='25'>
	<td> 1. </td>
	<td> CET ADMISSION  REPORT </td>
	<td><a href="stud_det4.php?branch=<?=$branch?>&a_year=<?=$a_year?>"> DTE </a></td>
	<td><a href="stud_det5.php?branch=<?=$branch?>&a_year=<?=$a_year?>">VTU </a></td>
</tr>
<tr height='25'>
	<td> 2. </td>
	<td> COMEDK ADMISSION  REPORT </td>
	<td><a href="stud_det2.php?branch=<?=$branch?>&a_year=<?=$a_year?>">DTE </a></td>
	<td><a href="stud_det3.php?branch=<?=$branch?>&a_year=<?=$a_year?>">VTU </a></td>
</tr>
<tr height='25'>
	<td> 3. </td>
	<td> MGMT ADMISSION  REPORT </td>
	<td><a href="stud_det6.php?branch=<?=$branch?>&a_year=<?=$a_year?>"> DTE </a></td>
	<td><a href="stud_det7.php?branch=<?=$branch?>&a_year=<?=$a_year?>"> VTU </a></td>
</tr>
<tr height='25'>
	<td> 4. </td>
	<td> DIPLOMA ADMISSION  REPORT </td>
	<td><a href="stud_det.php?branch=<?=$branch?>&a_year=<?=$a_year?>">DTE</a></td>
	<td><a href="stud_det1.php?branch=<?=$branch?>&a_year=<?=$a_year?>">VTU</a></td>
</tr>
</table>

</form>
</body>
</html>
<?php
if($action=='fail')
{
  if($flag==0)
  {
	 echo "<script language='javascript'>";
	 echo "alert('Please select both Branch and acdemic year')";
	 echo "</script>";

	 $action='asd';
	 $flag='sdf';
  }
}
  ?>