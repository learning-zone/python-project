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

	document.frm.action='studentcourse2.php';

	document.frm.submit();

	

}

function selectMe()

{

	var i = document.frm.length;

	for(j=0;j<i;j++)

	{

		if(document.frm[j].Sel != "CheckBox")

		{

			flag = document.frm[j].checked;

			document.frm[j].checked = !flag;

		}

	}

}	

</SCRIPT>

</HEAD>



<body>

<?php 

session_start();

require("../db.php");

$academic_year=$_SESSION['AcademicYear'];

if(!$_POST)

{

	$branch=$_SESSION['branch'];

	$sem=$_SESSION['sem'];	

}

else

{



	$branch=$_POST['branch'];

	$sem=$_POST['sem'];

}

$temp_year_detalis=$_SESSION['AcademicYear'];

$examname=$_POST['examname'];

$class_section_id=$_POST['class_section_id'];

$class_section=$_POST['class_section'];

$sess=$_POST['sess'];

$tablename="student_course";

$sysdate=date("Y-m-d");



if($_POST['open'])

{

	$check=$_POST['check'];

	$studentid=$_POST['studentid'];

	for($i=0;$i<sizeof($studentid);$i++)

	{

		$tt=0;

		for($j=0;$j<sizeof($check);$j++)

		{

			if($check[$j]==$studentid[$i])

			$tt=1;

		}

		$sql5=execute(" select sub_sec,sub from $tablename where acc_year='$temp_year_detalis' and stu_id='$studentid[$i]' and sub='$sess'");

		if(mysql_num_rows($sql5)>0)

		{

			if($tt==1)

			{

				$sql1="update $tablename set `sub_sec`='$class_section' where acc_year='$temp_year_detalis' and stu_id='$studentid[$i]' and sub='$sess'";

			}

			else

			{

				$rowcountdet=mysql_fetch_row($sql5);

				if($rowcountdet[1]==$sess)

				{

				$sql1="delete  from $tablename  where acc_year='$temp_year_detalis' and stu_id='$studentid[$i]' and sub='$sess' ";

				}

			}

		}

		else

		{

			

			if($tt==1)

			{

				$sql1="insert into $tablename (`div`, `class`, `sub`, `sub_sec`, `acc_year`, `stu_id`) values('$branch', '$sem', '$sess' , '$class_section','$temp_year_detalis', '$studentid[$i]')";

			}

		}		

	execute($sql1);	

	}

	?>

	<SCRIPT LANGUAGE="JavaScript">

	alert("Updated Successfully");

	</SCRIPT>

	<?php

}

?>
<form name="frm" action="" method="post" >
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="2" align="center" class="head">Apply Course </td>

    </tr>

     

  <tr>

    <td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>

		<td>&nbsp;<select name="branch" onChange="reload()">

			<option value="0">------Select-----</option>
				<?
				$vatnaw='';
				if($branch=='ALL')
				{
				$vatnaw='selected';
				}
				?>
				<option value='ALL' <?=$vatnaw?>>-- ALL--</option>

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

   <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>

		<td>&nbsp;<select name="sem" onChange="reload()">

			<option value='0'>-----Select----</option>

			<?php

				if($branch=='ALL')
              			  {
					$rs=execute("SELECT year_name,year_id FROM course_year");
				}
				else
				{
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				}
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

<?
$namesrt=mysql_query("SELECT * FROM student_m a,class_section b WHERE a.archive='N' and a.class_section_id=b.id and course_yearsem='$sem' group by b.id");
	if(mysql_num_rows($namesrt)!=0)
	{
?>

  <tr>

  <td height="28">&nbsp;&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="reload()">

<?

$rs_section=execute("SELECT * FROM student_m a,class_section b WHERE a.archive='N' and a.class_section_id=b.id and course_yearsem='$sem' group by b.id");

echo "<option value=''>-- ALL --</option>";

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
<?
}
?>
  <tr>

  <td height="28">&nbsp;&nbsp;Course</td>

  <td>&nbsp;<select name='sess'  onChange="reload()">

<?

if($branch=='ALL')
	{
			$rs_section=execute("select subject_id,subject_name,subject_code subject_name from subject_m where course_id='0' and course_year_id='0'  and status=1");
	}
	else
	{
	$rs_section=execute("select subject_id , subject_name,subject_code from subject_m where course_id='$branch' and course_year_id='$sem' and elective='Y' and status=1");
	}

echo "<option value=''>--Select--</option>";

for($i=0;$i<rowcount($rs_section);$i++)

{

	$r_section=fetcharray($rs_section,$i);

	if($sess==$r_section[0])

	echo "<option value='$r_section[0]' selected>$r_section[1] - $r_section[2]</option>";

	else

	echo "<option value='$r_section[0]'>$r_section[1] - $r_section[2]</option>";



}

?>

</select>

</td>

  </tr>

<!--   <tr>

  <td height="28">&nbsp;&nbsp;Course Section</td>

  <td>&nbsp;<select name='class_section'  onChange="reload()">

<?

$rs_section=execute("select * from class_section");

for($i=0;$i<rowcount($rs_section);$i++)

{

	$r_section=fetcharray($rs_section,$i);

	if($class_section==$r_section[id])

	{

		echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";

	}

	else

	{

	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

	}

}

?>

</select>

</td>

  </tr>-->

</table>

<br>

<div align="center"><input class="bgbutton" type="submit" name="open" value="UPDATE" ></div><br>

  <?php

  if($branch=='0'or $branch=='')

	die();

	if($sem=='0' or $sem=='')

	die();

   $sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N' and academic_year='$academic_year' ";

	//if($branch!=0)

	//{

	//$sql123.=" and course_admitted=$branch";

	//}

	if($sem!=0)

	{

	$sql123.=" and course_yearsem=$sem";

	}

	if($class_section_id!='')

	{

	$sql123.=" and class_section_id=$class_section_id  ";

	}

	

	$sql123.=" order by first_name";

	

	$rs=execute($sql123) or die(mysql_error());

  ?>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">

  <tr height="25">

    <td width="10%" class="head">Sl No.</td>

    <td width="40%" align="center" class="head">Name</td>

    <td width="20%" align="center" class="head">Student Id</td>

    <!--<td width="23%" align="center">Action</td>-->

    <td width="7%" align="center" class="head" nowrap><div id="checkAll" onMouseOver="this.style.backgroundColor='blue';

this.style.cursor='hand';this.style.color='white'"

onMouseOut="this.style.backgroundColor='';this.style.cursor='default';this.style.color='black'"

onClick="selectMe()" Title="Click to Select all Students"><b>Select All</b></div></td>



  </tr>

  <?php

  $i=1;

  while($r1=mysql_fetch_array($rs))

  { 


echo "select id from $tablename where acc_year='$temp_year_detalis' and stu_id='$r1[id]' and sub='$sess' ";
$sql5=execute("select id from $tablename where acc_year='$temp_year_detalis' and stu_id='$r1[id]' and sub='$sess' ");

  $checkiddet=mysql_fetch_row($sql5);

  if($checkiddet[0]!='' or $checkiddet[0]!=0)

  $statuschek='checked';

  else

  $statuschek='';

  echo "<tr>

    <td nowrap>&nbsp;$i</td>

    <td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>

    <td nowrap align='center'>&nbsp;$r1[student_id]</td>

    ";

	?>

	  <td align="center">

	<input type="checkbox" name="check[]" value="<?php echo $r1[id]; ?>" <?php echo $statuschek; ?> >

    <input type="hidden" name="studentid[]" value="<?php echo $r1[id]; ?>" >

    </td>

  </tr><?php

$i++;  }

  ?>

  

</table>

				

</form>	

</body>

</html>