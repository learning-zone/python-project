<html>

<HEAD>

<SCRIPT LANGUAGE="JavaScript">

function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}

function reload()

{

	document.frm.action='skillset_report.php';

	document.frm.submit();

}



</SCRIPT>

</HEAD>



<body>

<form name="frm" action="" method="post">

<?php

session_start();

require("../db.php");

if(!$_POST and !$_REQUEST)

{

	$branch=$_SESSION['branch'];

	$sem=$_SESSION['sem'];	

}

else

{

	$branch=$_POST['branch'];

	$sem=$_POST['sem'];

}

$examname=$_POST['examname'];

$class_section_id=$_POST['class_section_id'];



?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="2" align="center" class="head">Skill Set Report card</td>

    </tr>

     

  <tr>

    <td>&nbsp;<?php echo $_SESSION['branchname']; ?></td>

		<td>&nbsp;<select name="branch" onChange="reload()">

			<option value="0">------Select-----</option>

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

   <td>&nbsp;<?php echo $_SESSION['semname']; ?></td>

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

   

  <tr>

  <td height="28">&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="reload()">

<?

$rs_section=execute("select * from class_section");

echo "<option value='-1'>--Select--</option>";

for($i=0;$i<rowcount($rs_section);$i++)

{

	$r_section=fetcharray($rs_section,$i);

	if($class_section_id==$r_section[id])

	echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";

	else

	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";



}

?>

</select>

</td>

  </tr>

    <tr>

    <td>&nbsp;Select Exam</td>

  <?php

  

$accyear=$_SESSION['AcademicYear'];

$rs_ec=execute("select id, descr  from exam_m where accyear='$accyear' and curriculam='$branch' and class='$sem' and sts=1");

?>

    <td>&nbsp;<select name='examname' onChange="reload()">

<?

echo "<option value=''>--Select--</option>";

for($i=0;$i<rowcount($rs_ec);$i++)

{

	$r_sec=fetcharray($rs_ec,$i);

	if($r_sec['id']==$examname)

	echo "<option value='$r_sec[id]' selected>$r_sec[descr]</option>";

	else

	echo "<option value='$r_sec[id]'>$r_sec[descr]</option>";



}

?>

</select></td>

  </tr>

</table>



  <?php

  if($examname=='')

  die();



  if($class_section_id=='-1')

  die();

  if($sem=='0' || $sem=='')

	die();

  $sql123.="select id,student_id,first_name,last_name from student_m where id is not null and archive='N'";

	if($branch!=0)

	{

	$sql123.=" and course_admitted=$branch";

	}

	if($sem!=0)

	{

	$sql123.=" and course_yearsem=$sem";

	}

	if($class_section_id!='')

	{

	$sql123.=" and class_section_id=$class_section_id  ";

	}

	

	$sql123.=" order by gender desc,first_name";

	$rs=execute($sql123) or die(mysql_error());

  ?><br>

  

  <div align="center" >

  	<input type="button" name="Print" value="Print All" class="bgbutton" onClick="printall()">&nbsp;&nbsp;&nbsp;

  	<input type="button" name="export" value="Export All" class="bgbutton" onClick="exportall()">

  

  </div>

  

  <br>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">

  <tr height="25">

    <td width="10%" class="row3">Sl No.</td>

    <td width="40%" align="center" class="row3">Name</td>

    <td width="20%" align="center" class="row3">Student Id</td>

    <td width="23%" align="center" class="row3">Action</td>

   <!-- <td width="7%" align="center">Sel</td>-->

  </tr>

  <?php

  $i=1;

  while($r1=mysql_fetch_array($rs))

  { 

  echo "<tr>

    <td nowrap>&nbsp;$i</td>

    <td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>

    <td nowrap align='center'>&nbsp;$r1[student_id]</td>

    <td nowrap align='center'>&nbsp;";

	$studentname="$r1[first_name] $r1[last_name]";

	?><a href= "javascript:OpenWind2('skillset_report1.php?course=<?=$branch?>&sem=<?=$sem?>&examid=<?=$examname?>&studentid=<?=$r1[id]?>&class_section_id=<?=$class_section_id?>&stundetname=<?=$studentname?>&student_id=<?=$r1[student_id]?>')">Print		

</a>

&nbsp;&nbsp;



<a href= "javascript:OpenWind2('skillset_reportword.php?course=<?=$branch?>&sem=<?=$sem?>&examid=<?=$examname?>&studentid=<?=$r1[id]?>&class_section_id=<?=$class_section_id?>&stundetname=<?=$studentname?>&student_id=<?=$r1[student_id]?>')">Export Word		

</a> </td> <!--<td align="center">

	<input type="checkbox" name="check[]" value="<?=$r1[id]?>" checked>

    <input type="hidden" name="stuid<?=$r1[id]?>" value="<?=$r1[student_id]?>">

     <input type="hidden" name="stuname<?=$r1[id]?>" value="<?=$r1[first_name]?>">

      <input type="hidden" name="admissionid<?=$r1[id]?>" value="<?=$r1[admission_id]?>">

    </td>-->

  </tr><?php

$i++;  }

  ?>

  

</table>

<br>

<!--<div align="center"><input type="button" name="open" value="View All" onClick="reload1()"></div>	-->			

</form>	

</body>

</html>

