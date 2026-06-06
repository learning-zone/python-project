<?php
session_start();
require("../db.php");

$academic_year=$_SESSION['AcademicYear'];

if(!$_POST and !$_REQUEST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}

else
{
	
	$branch=$_POST['branch'];
	
	$sem=$_POST['sem'];
	
	$section=$_POST['section'];

}

?>
<HTML>
<HEAD>
<script language="javascript">
function send()
{
	document.frm.action="viewstudent_archive.php";
	document.frm.submit();

}
function getbranch()
{
	document.frm.action="search_archive_det.php";	
	document.frm.submit();
}
</script>
<TITLE>Register of Fee Receipts</TITLE>
</HEAD>
<BODY leftmargin=0 topmargin=0>
<?php



//Get Branches.

//echo ("SELECT course_id,coursename,head_id FROM course_m");





//Branch details not found.







//Get semesters.





//Sem details not found



//Get semesters.

$rsSecM = execute("select * from class_section order by id");

$countSecM = rowcount($rsSecM);



//Sem details not found

if(!$countSecM){

	//die("<div class='label'>Please enter Section details.</div>");

}



//-- Display Form --

?>

<form method="POST" action="viewstudent_archive.php"  name="frm">



<table class='forumline' align=center width="70%">

<tr><td Class="head" align='center' colspan=2>Archived Student Details Report</td></tr>

<tr>



		<td><?php echo $_SESSION['branchname']; ?></td>

		<td><select name="branch" onChange="getbranch()">

			<option value="0">---------------Select---------------</option>

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

<!--Semester-->

<tr>

      <td ><?php echo $_SESSION['semname']; ?></td>

<td >

<select name="sem">

<option value=0>Select</option>

<?php

$rsSM = execute("SELECT * FROM course_year  where head_id='$branch'");

$countSM = rowcount($rsSM);

	for($i=0;$i<$countSM;$i++)

	{

	$rSM = fetcharray($rsSM,$i);

	if($rSM[0]==$sem)

		{

			echo("<option value='$rSM[0]' selected>$rSM[1]</option>\n");

		}

		else

		{

			echo("<option value='$rSM[0]'>$rSM[1]</option>\n");

		}

	}

?>



</select>

</td>

</tr>

<!--Section-->

<tr>

<td >Section</td>

<td><select name="section" >

<?php

echo "<option value=''>--Select All--</option>";

for($i=0;$i<$countSecM;$i++)

	{

		$rSecM = fetcharray($rsSecM,$i);

		if($section==$rSecM[0])

		{

		echo("<option value='$rSecM[0]' selected>$rSecM[1]</option>\n");

	}

	else

		{

		echo("<option value='$rSecM[0]'>$rSecM[1]</option>\n");

		}

}

?>

</select>

</td>

</tr>

<!--Submit-->



</table><br>

<div align='center' ><input type="button" class='bgbutton' value="VIEW"    OnClick="send()";></div>

<input type="hidden" name="branchName">

<input type="hidden" name="semName">

</form>

</body>

</html>



