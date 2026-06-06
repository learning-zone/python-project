<html>

<HEAD>
<title>Siblings Report</title>
<SCRIPT LANGUAGE="JavaScript">

function prn()
		{
			pr1.style.display = "none";
			window.print();
		}

function reload()

{

	document.frm.action='siblingsmbis1.php';

	document.frm.submit();

}


</SCRIPT>

</HEAD>



<body>

<form name="frm" action="" method="post">

<?php

session_start();

require("../db.php");

//print_r($_POST);

$accyear=$_SESSION['AcademicYear'];



if(!$_POST)

{

	$branch=$_SESSION['branch'];

	$sem=$_SESSION['sem'];

}

else

{

	$subject=$_POST['subject'];

	$exam_id=$_POST['exam_id'];

	$branch=$_POST['branch'];

	$sem=$_POST['sem'];

	$class_section_id=$_POST['class_section_id'];

	$examid=$_POST['examid'];

	$reports=$_POST['reports'];

	$examname_m=$_POST['examname_m'];

	$masteexamn=$_POST['masteexamn'];

	$unit=$_POST['unit'];

	$class=$_POST['class'];

}



	

?>

<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="2" align="center" class="head">Siblings Report</td>

    </tr>

  <tr>

    <td>&nbsp;School Division</td>

		<td>&nbsp;<select name="branch" onChange="reload()">

			<option value="0">---Select---</option>

				<?php

					$sql="select course_id,coursename from course_m";

					$rs=execute($sql) or die(error_description());

					for($i=0;$i<rowcount($rs);$i++)

					{

					  $r=mysql_fetch_array($rs);



						if($branch==$r[course_id])

						{

							?>

							<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>

							<?php

						}

						else

						{

							?>

							<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>

							<?php

						}

					}

				?>

			</select>

			</td>

		

  </tr>

  <tr>

   <td>&nbsp;Class </td>

		<td>&nbsp;<select name="sem" onChange="reload()">

			<option value='0'>-----Select----</option>

			<?php

				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");

				while($r=fetcharray($rs))

				{

					if($sem==$r[year_id])

					{

						echo "<option value='$r[year_id]' selected> $r[year_name]</option>";

					}

					else

					{

						echo "<option value='$r[year_id]'> $r[year_name]</option>";

					}

				}

			?>

			</select>



		</td>

  </tr>

</table>
<br>
<?php
if(!$sem)
die();
?>
<table width="70%" border="1" cellpadding="3" cellspacing="0" align="center">

<tr>
<td nowrap  class='head' align="center"  >&nbsp; Name</td>
<td nowrap  class='head' align="center" >&nbsp; Student Id</td>
<td nowrap class='head' align="center"  >&nbsp; Grade</td>
<td nowrap  class='head' align="center" >&nbsp; Father's Name</td>
<td nowrap class='head'  align="center" >&nbsp; Mother's Name</td>
<td nowrap class='head' align="center"  >&nbsp; Gaurdian Name</td>
<td nowrap  class='head' align="center" >&nbsp; CareGiver</td>
<td nowrap  class='head' align="center" >&nbsp; Sibbling</td>
</tr>

<?

$sql123.="select a.id,a.student_id,a.first_name,a.last_name,a.admission_id,a.course_yearsem from student_m a,stud_sibling b where  b.status=1 and b.stud=a.id and a.academic_year='$accyear' and a.archive='N'  and a.course_yearsem='$sem' group by b.stud  order by a.first_name";

$rs=execute($sql123) ;

  ?><br>

  

  <?php

  $i=1;

  while($r1=fetcharray($rs))

  {

	  $student_id=$r1[id]; 

?>



<?

$parntsname=fetcharray(execute("SELECT parent_name,m_name,g_name FROM `student_m` where `id`='$student_id'"));

$fmcodesname=fetcharray(execute("SELECT family_code,family_name FROM `stud_sibling` where `stud`='$student_id' and `status`=1"));

$details=fetcharray(execute("SELECT * FROM `student_m` WHERE `id`='$student_id' LIMIT 1"));

$studnamealls=fetcharray(execute("SELECT first_name,last_name,student_id FROM `student_m` where `id`='$student_id'"));

$grade2=fetcharray(execute("SELECT year_name FROM `course_year` where `year_id`='$r1[5]' and `status`=1"));

?>

    <tr>

        <td  class='rowborders' nowrap>&nbsp;<?=$studnamealls[0]?>&nbsp;<?=$studnamealls[1]?></td>

        <td  class='rowborders' nowrap align='center'><?=$studnamealls[2]?></td>

        <td  class='rowborders' nowrap align='center'><?=$grade2[0]?></td>

        <td  class='rowborders' nowrap>&nbsp;<?=$parntsname[0]?></td>

        <td  class='rowborders' nowrap>&nbsp;<?=$parntsname[1]?></td>

        <td  class='rowborders' nowrap>&nbsp;<?=$parntsname[2]?></td>
        <td width="100%" valign="top"  class='rowborders'>&nbsp;
    <?php

$other_gurds=mysql_query("select relation,s_name,s_photo,id from student_photo_other where  studid='$student_id' and status=1");
$g=1;
while($other_gurdsts=mysql_fetch_array($other_gurds))

{

	if($other_gurdsts[0])

	{

	?>
    		<table width="100%" border="1" cellpadding="0" cellspacing="0" align="center">

	<tr>
    <td align="center" nowrap><b><?=$g?></b></td>
    <td align="left" nowrap  class='rowborders'>&nbsp;
	<?=$other_gurdsts[1]?></td>
    </tr>
    </table>

    <?
$g++;
	}

}
?>
</td>
        <td width="100%" valign="top"  class='rowborders'>&nbsp;
<?php

$fmcodes=mysql_fetch_array(mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$student_id' and `status`=1"));

$fanilyname=mysql_query("SELECT a.family_name,a.stud FROM stud_sibling a,student_m b where a.family_code='$fmcodes[0]' and a.status=1 and a.stud=b.id and b.archive='N' order by course_yearsem");
$m=1;
while($familnms=mysql_fetch_array($fanilyname))

{

$studname=mysql_fetch_row(mysql_query("SELECT first_name,last_name,course_yearsem,class_section_id ,student_id FROM `student_m` where `id`='$familnms[1]'"));

$section=mysql_fetch_row(mysql_query("SELECT section_name FROM `class_section` where `id`='$studname[3]'"));

$grade=mysql_fetch_row(mysql_query("SELECT year_name FROM `course_year` where `year_id`='$studname[2]' and `status`=1"));



?>

<table width="100%" border="1" cellpadding="0" cellspacing="0" align="center">
<tr>
    <td align="center" nowrap><b><?=$m?></b></td>
    <td  nowrap class='rowborders'>&nbsp;<?=$studname[0]?>&nbsp;<?=$studname[1]?></td>

    <td align="center" nowrap   class='rowborders'>&nbsp;<?=$studname[4]?></td>

    <td align="center" nowrap  class='rowborders' >&nbsp;<?=$grade[0]?></td>
</tr>
</table>

  <?
  $m++;
}
  }
?>
</td>
 </tr>
</table>
  </form>
  <br>	
<div id=pr1 align=center><INPUT TYPE="button" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
</div>

</body>

</html>

