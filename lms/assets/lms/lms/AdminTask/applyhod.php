<?php
session_start();
include("../db.php");

$curtype=$_POST['curtype'];
$branch=$_POST['branch'];
$Section=$_POST['Section'];
$teacher=$_POST['teacher'];

?>
<html>
<head>
<script>
function reload()
{
	document.frm.action="applyhod.php";
	document.frm.submit();
}
</script>
</head>
<body>
<?php
  if(isset($_POST['del']))
  {
		$chks=$_POST['chks']; 
		 while( list(,$Value) = each($chks) )
		  {
			  $upd=execute("delete from class_teacher where id='$Value'");
		  }
	}
if(isset($_POST['subn']))
{
	$ps=execute("select * from class_teacher where curri_type='$curtype' and grade='$branch' and sect='$Section' and teacher='$teacher'");
	$pscnt=rowcount($ps);
	
			$sqq=execute("insert into class_teacher(id,curri_type,grade,sect,teacher) values('','$curtype','$branch','$Section','$teacher')");

	
}
?>
<form Name="frm" action="applyhod.php" method="post">
<table class='forumline' align='center' border="1" width="70%">

<tr><td Class="head" align=center colspan=2>Allocate Class Teacher</td></tr>

<tr>

    <td>&nbsp;&nbsp;

    <?

	echo $_SESSION['branchname']

	?>

    </td>

		<td>&nbsp;<select name="curtype" onChange="reload()">

			<option value="0">---SELECT---</option>

				<?php

					$sql="select course_id,coursename from course_m";

					$rs=execute($sql) or die(error_description());

					for($i=0;$i<rowcount($rs);$i++)

					{

					  $r=fetcharray($rs);



						if($curtype==$r[course_id])

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

   <td>&nbsp;&nbsp;

   <?php

   echo $_SESSION['semname'];

   ?>

   </td>

		<td>&nbsp;<select name="branch" onChange="reload()">

			<option value='0'>---SELECT---</option>

			<?php

				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$curtype'");

				while($r=fetcharray($rs))

				{

					if($branch==$r[year_id])

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

  <td height="28">&nbsp;&nbsp;Section</td><td>&nbsp;<select name='Section'  onChange="reload()">

<?

$rs_section=execute("SELECT * FROM student_m a,class_section b WHERE a.archive='N' and a.class_section_id=b.id and course_yearsem='$branch' group by b.id");

echo "<option value='-1'>--SELECT--</option>";

for($i=0;$i<rowcount($rs_section);$i++)

{

	$r_section=fetcharray($rs_section,$i);

	if($Section==$r_section[id])

	echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";

	else

	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";



}

?>

</select>

</td>

  </tr>

<tr>

<td  >&nbsp;&nbsp;Teacher</td>

<td >&nbsp;<select name="teacher" size="1">

<option value="0">---SELECT---</option>

<?php



$dd1=execute("select id, f_name,s_name from staff_det where group_id='1'");

$countBR1=rowcount($dd1);

for($i1=0;$i1<$countBR1;$i1++)

{

	$rBR1 = fetcharray($dd1);

	if($teacher==$rBR1[id])

	{

		echo("<option value='$rBR1[id]' selected>$rBR1[f_name] $rBR1[s_name]</option>\n");

	}

	else

	{

		echo("<option value='$rBR1[id]'>$rBR1[f_name] $rBR1[s_name]</option>\n");

	}

}

?>

</select>

</td>

</tr></table>

<br>

<div align='center'><input type='submit' name='subn' value='Submit' class='bgbutton'></div>





<br>

<table class='forumline' align='center' width="70%" border="1">

<tr><td colspan=5 class='head' align='center'>Class Teacher</td></tr>

<tr>

<td align="center" class="row2">Select</td>

<td align="center" class="row2"><? echo $_SESSION['branchname']; ?></td>

<td align="center" class="row2"><? echo $_SESSION['semname']; ?></td>

<td align="center" class="row2">Section</td>

<td align="center" class="row2">Class Teacher</td></tr>

<?php 

$ds=execute("select * from class_teacher order by grade");

$dscnt=rowcount($ds);

for($t=1;$t<=$dscnt;$t++)

{

	if($t%2)

	echo "<tr class='clsname'> ";

	else

	echo "<tr> ";

	$dss=fetcharray($ds);

	?>

	<td align="center"><input type='checkbox' name='chks[]' value='<?php echo $dss[id]?>'></td>

	<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php

	$ss1=execute("select coursename from course_m where course_id='$dss[curri_type]'");

	$ss1ft=fetcharray($ss1);

	echo $ss1ft[coursename];?></td>

	<td align="center">&nbsp;&nbsp;<?php 

	$ss2=execute("select year_name from course_year where year_id='$dss[grade]'");

	$ss2ft=fetcharray($ss2);	

	echo $ss2ft[year_name]?></td>

	<td align="center">&nbsp;&nbsp;<?php 

	$ss2=execute("select section_name from class_section where id='$dss[sect]'");

	$ss2ft=fetcharray($ss2);	

	echo $ss2ft[section_name]?></td>

	<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php 

	$ss2=execute("select f_name,s_name from staff_det where id='$dss[teacher]'");

	$ss2ft=fetcharray($ss2);	

	echo $ss2ft[f_name].' '.$ss2ft[s_name];?></td></tr>

	<?php 

}

?></table>

<br><div align='center'><input type='submit' name='del' value='Delete' class='bgbutton'></div>



</BODY>

</HTML>

