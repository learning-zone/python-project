<?php
session_start();
include("../db.php");
$academic_year=$_SESSION['AcademicYear'];

if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
elseif($_POST)
{

	$branch=$_POST['branch'];

	$sem=$_POST['sem'];

	$track = $_POST['track'];

	$filter = $_POST['filter'];

	$class_section_id=$_POST['class_section_id'];

	$app_no=$_POST['app_no'];

	$studfname=$_POST['studfname'];	

	$appl_no = $_POST['appl_no'];	

}

else

{

	$branch=$_REQUEST['branch'];

	$sem=$_REQUEST['sem'];

	$class_section_id=$_REQUEST['class_section_id'];

}
?>
<html>
<head>
<title>ADMISSION STATUS</title>
</head>
<body>

<script LANGUAGE="JavaScript">

function reload()

{

	document.frm.action='interview_report.php';

	document.frm.submit();	

}

</script>



<form method='post' action="interviewdis.php" name="frm" > 

<table class='forumline' align='center' width="70%" >

<tr><td Class="Head" colspan='4' align='center'>ADMISSION STATUS</td></tr>

<tr height='30'>

<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>

<td><select name="branch" onChange="reload()">

<option value="0">---------------Select---------------</option>

<?php

$sql="select course_id,coursename from course_m";

$rs=execute($sql) or die(error_description());

for($i=0;$i<rowcount($rs);$i++)

{

	$r=fetcharray($rs);

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
<td> &nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>

<td><div id="txtHint9" class="inline">

<select name="sem" onChange="reload()">

<option value='0'>----------Select---------</option>

<?php

$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");

while($r=fetcharray($rs))

{

	if($sem==$r[year_id])

	{

		echo "<option value='$r[year_id]' selected>$r[year_name]</option>";

	}

	else

	{

		echo "<option value='$r[year_id]'>$r[year_name]</option>";

	}

}

?>

</select></div>

</td>

</tr>

<tr height='30'>

<td> &nbsp;&nbsp;Tracking Items</td>

<td><div id="txtHint9" class="inline">

<select name="track" onChange="reload()">

<option value='0'>----------Select---------</option>

<?php

//echo "select * from interview where class='$sem' and acc_year='$AcademicYear' order by id"; 

$rs=execute("select * from interview  order by id");

while($r=fetcharray($rs))

{

	if($track==$r[id])

	{

		echo "<option value='$r[id]' selected>$r[name]</option>";

	}

	else

	{

		echo "<option value='$r[id]'>$r[name]</option>";

	}

}

?>

</select>

</td>

<td>&nbsp; Status</td>

<td> <select name="filter">

                  <option value="0">---- select ----</option>                 

                  <option value="1"> Cleared </option>

                  <option value="2"> Rejected </option>

                  <option value="3"> Elligible </option>

                </select> </td>

</tr>

</tr></table>

<br>

	<div align=center>

	<input type="submit" class='bgbutton' value="Search" name="studdet">

	</div>

	</form>



