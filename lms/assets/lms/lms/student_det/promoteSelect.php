<?php

session_start();

print_r($_REQUE);

?>

<html>

<head>

<?

require("../db.php");

$academic_year=$_SESSION['AcademicYear'];

?>

<title>View </title>

<script language="JavaScript">

window.status = "Select a Course and Year to Promote...";

function validate()

{

	if(document.frm.branch.selectedIndex == -1 )

	{



		alert("Please select a course.");

	}

	else if(document.frm.sem.selectedIndex ==0)

	{

		alert("Please select a Course Year.");

	}



	else

	{

		document.frm.submit();

	}

}

function go()

{

document.frm.action="promoteSelect.php?";

document.frm.submit();

}

function reload(str)

{

var url="../sessionbranchfile.php";

url=url+"?q="+str;

url=url+"&sid="+Math.random();



if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET",url,true);

xmlhttp.send();

}

</script>

</head>

<?php

if(!$_POST)

{

	$branch=$_SESSION['branch'];

	$sem=$_SESSION['sem'];

}

else

{

	$branch=$_GET['branch'];

	$sem=$_GET['sem'];

	$class_section_id=$_GET['class_section_id'];

}

?>

<body topmargin="0" leftmargin="0">

<form method="POST" action="promote.php" name="frm">

<table border="0" width="90%" class='forumline' align=center>

<tr><td colspan="4" align="center" class="head">Promotion Details</td></tr>

<?

$sql1 = "SELECT * FROM course_m where status=1";

?>

<tr>

<td><?php echo $_SESSION['branchname']; ?></td>

<td colspan="2" align="left">

<select name="branch" size="1" OnChange='reload(this.value)'>

<option selected value="-1">----- Select--------</option>

<?php

$rs1 = execute($sql1);

$num = rowcount($rs1);

for($i=0;$i<$num;$i++)

{

	$r1 = fetcharray($rs1,$i);

	if($branch==$r1[0])

	{

		echo "<option value='$r1[0]' selected>$r1[1]</option>";

	}

	else

	{

		echo "<option value='$r1[0]'>$r1[1]</option>";

	}

}

?>

</select> </td>

</tr>

<tr>

<td><?php echo $_SESSION['semname']; ?></td>

<td colspan=2><div id="txtHint9" class="inline">   

<select name="sem" >

<?php

$sq=fetcharray(execute("select *from course_m where course_id='$branch'"));

$cname=$sq[head_id];

$sql2 = "SELECT * FROM course_year where status=1 and head_id='$cname'";

$rs2 = execute($sql2);

$num = rowcount($rs2);

echo "<option value=\"0\">-- Select Class --</option>";

for($i=0;$i<$num;$i++){

$r2 = fetcharray($rs2,$i);

if($sem==$r2[0])

echo "<option value=\"$r2[0]\" selected>$r2[1]</option>";

else

echo "<option value=\"$r2[0]\">$r2[1]</option>";



}



?> </select></div> </td></tr>

<tr><td>Section</td><td colspan='2'><select name='class_section_id'>
<option value='0'>-----All----</option>

<?

$rs_section=execute("select * from class_section");



for($i=0;$i<rowcount($rs_section);$i++)

{

	$r_section=fetcharray($rs_section,$i);

	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";



}

?>

</select>

</td>

</tr>



</table><br>

<div align='center'>

<input type="button" class='bgbutton' value="View Student List" name="B1" onClick="validate()"> 

</div><br>

</form>



</body>

</html>

