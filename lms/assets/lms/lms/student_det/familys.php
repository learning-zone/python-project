<?php
session_start();
include("../db.php");
$academic_year=$_SESSION['AcademicYear'];

	$stuid=$_REQUEST['stuid'];
?>
<script language="javascript">
 function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<title>Family Members</title>
</head>
<body>
<form method='post' action="familys.php" name="frm" >
<input type="hidden" name="stuid" value="<?=$stuid?>"/>
<?
$parntsname=mysql_fetch_row(mysql_query("SELECT parent_name,m_name,g_name FROM `student_m` where `id`='$stuid'"));
$fmcodesname=mysql_fetch_array(mysql_query("SELECT family_code,family_name FROM `stud_sibling` where `stud`='$stuid' and `status`=1"));

?>
<table width="40%" border="1" cellpadding="3" cellspacing="0" align="center">
 <tr>
    <td class="head" colspan="5"  align="center">Family Member Detail</td>
  </tr>
  <tr>
    <td nowrap>&nbsp;<b>Family Name</b></td>
    <td nowrap colspan="2">&nbsp;<?=$fmcodesname[1]?></td>
    <td nowrap>&nbsp;<b>Family code</b></td>
    <td nowrap >&nbsp;<?=$fmcodesname[0]?></td>
  </tr>
  <tr>
    <td colspan="2" nowrap>&nbsp;<b>Father</b></td>
    <td colspan="3" nowrap>&nbsp;<?=$parntsname[0]?></td>
   </tr>
   <tr>
    <td colspan="2" nowrap>&nbsp;<b>Mother</b></td>
    <td colspan="3" nowrap>&nbsp;<?=$parntsname[1]?></td>
   </tr>
   <tr>
    <td colspan="2" nowrap>&nbsp;<b>Guardian</b></td>
    <td colspan="3" nowrap>&nbsp;<?=$parntsname[2]?></td>
  </tr>
   <tr>
    <td class="head" colspan="5"  align="center">Student Information</td>
  </tr>
  <tr>
    <td class="rowpic" colspan="2"  align="center">Name</td>
    <td class="rowpic"  align="center">Grade</td>
    <td class="rowpic"  align="center">Section</td>
     <td class="rowpic"  align="center">Photo</td>
  </tr>
<?php
$fmcodes=mysql_fetch_array(mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$stuid' and `status`=1"));
$fanilyname=mysql_query("SELECT a.family_name,a.stud FROM stud_sibling a,student_m b where a.family_code='$fmcodes[0]' and a.status=1 and a.stud=b.id and b.archive='N'");
while($familnms=mysql_fetch_array($fanilyname))
{
	
$studname=mysql_fetch_row(mysql_query("SELECT first_name,last_name,course_yearsem,class_section_id,img_source FROM `student_m` where `id`='$familnms[1]'"));
$section=mysql_fetch_row(mysql_query("SELECT section_name FROM `class_section` where `id`='$studname[3]'"));
$grade=mysql_fetch_row(mysql_query("SELECT year_name FROM `course_year` where `year_id`='$studname[2]' and `status`=1"));

?>
  <tr>
    <td nowrap colspan="2">&nbsp;<?=$studname[0]?>&nbsp;<?=$studname[1]?></td>
    <td align="center" nowrap>&nbsp;<?=$grade[0]?></td>
    <td align="center" nowrap>&nbsp; <?=$section[0]?></td>
    <td align="center" nowrap><img src="<?php echo $studname[4]?>"  height='80'></td>
  </tr>
  <?
}
  ?>
</table>
<br>
<div align="center">
<a href="stud_siblings.php?stuid=<?=$stuid?>">
<input type="button" class="bgbutton" value="Add/Remove Siblings">
</a></div>

</form>
</body>
</html>