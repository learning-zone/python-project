<?php

session_start();

include("../db.php");

$academic_year=$_SESSION['AcademicYear'];

if(!$_POST and !$_REQUEST)

{

	$branch=$_SESSION['branch'];

	$sem=$_SESSION['sem'];

	

}

elseif(!$_POST and $_REQUEST)

{

	$branch=$_REQUEST['branch'];

	$sem=$_REQUEST['sem'];

	$class_section_id=$_REQUEST['class_section_id'];

}

else

{

	$branch=$_POST['branch'];

	$sem=$_POST['sem'];

	$class_section_id=$_POST['class_section_id'];

	$app_no=$_POST['app_no'];

	$studfname=$_POST['studfname'];	

}



?>



<html>

<head>

<title>Student details Modify form</title>

</head>



<body>

<script LANGUAGE="JavaScript">



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

function reload1()

{

	document.frm.action='parentUsernameexl.php';

	document.frm.submit();

}

function reload()

{

	document.frm.action='parentUsername.php';

	document.frm.submit();

}



</script>



<?php



$rs = execute("SELECT * FROM student_m limit 1");

$num = rowcount($rs);

if($num > 0)

{

	?>

	<form method='post' action="parentUsername.php" name="frm" >



    <table class='forumline' align='center' width="90%" ><tr><td Class="Head" colspan='7' align='center'>Search Student Detials</td></tr>

    

	<tr height='30'>

		<td><?php echo $_SESSION['branchname']; ?></td>

		<td><select name="branch" onChange="reload(this.value)">

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

			<td> <?php echo $_SESSION['semname']; ?></td>

		<td><div id="txtHint9" class="inline">

        <select name="sem">

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

	<tr>

	<td>Section</td><td><select name='class_section_id'>

<?

$rs_section=execute("select * from class_section");

echo "<option value=''>--Select--</option>";



for($i=0;$i<rowcount($rs_section);$i++)

{

	$r_section=fetcharray($rs_section,$i);

	if($class_section_id==$r_section[id])

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

	<td>Student Id</td>

		<td><input type='text' name='app_no' value=""></td></tr>

	<tr height='30'>

		

		<td>Student Name</td>

		<td colspan="3" ><input type='text' name='studfname' value=""></td></tr>

	</table><br>

	<div align=center>

	<input type="submit" class='bgbutton' value="Search" name="studdet">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<!--<input type="button" class='bgbutton' value="Export to excel " name="studdet" onClick="reload1()">    -->

	</div>

	</form>

	<?php

}

else

{

	?>

	<td>No studentid Record</td>

	<?php

}

?>

<?php

if(!$_POST['studdet'] and ! $_REQUEST)

die();

	$sql="select id,student_id, usn, first_name, last_name, admission_id, username, password from student_m where id is not null and archive='N' and academic_year='$academic_year'";

	if($app_no!='')

	{

	 $sql.=" and student_id='$app_no'";

	}

	if($sem!=0)

	{

	$sql.=" and course_yearsem=$sem";

	}

	if($class_section_id!='')

	{

	$sql.=" and class_section_id=$class_section_id  ";

	}

	

	if($studfname!='')

	{

	 $sql.=" and (first_name like '$studfname%' or last_name like '$studfname%')";

	}

 $sql.=" order by first_name";

		$rs=execute($sql) or die(mysql_error());



	if(rowcount($rs)==0)

	{

		echo "<font><b>No Records Found !!</b></font>";

		die();

	}



?>



<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>

<tr><td align='center' class='head' colspan='6'>Student Username & Password Details</td>

</tr>

<tr height='25' >

    <td Class="rowpic" align='center'>Sl No</td>

    <td Class="rowpic" align='center'>Student ID</td>

    <td Class="rowpic" align='center'>Admission No</td>

    <td Class="rowpic" align='center'>Student Name</td>

    <td Class="rowpic" align='center'>Username</td>

    <td Class="rowpic" align='center'>Password </td>

</tr>

<?php

  $rowclass=1;

  $sno=1;

	for($i=0;$i<rowcount($rs);$i++)

	{

		$r=fetcharray($rs);

		if($sno<10)

			$sno="0".$sno;

		if($i%2)

		echo "	<tr class='clsname' > ";

		else

		echo "	<tr > ";

		?>

	

		<td   align='center' ><?=$sno?></td>

		<td align="center">

        &nbsp;&nbsp;

        <?=$r[student_id]?></td>

        <TD align="center"><?=$r['admission_id']?></TD>

		<td align="">&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>

         <TD align="center"><?=$r['username']?></TD>

		 <TD align="center"><?=$r['password']?></TD>

		

        </tr>

		<?php

		$sno++;

		$rowclass = 1 - $rowclass;

	}

?>

</table>

</body>

</html>