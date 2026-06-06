<?php
session_start();
include("../db.php");
//$AcademicYear=$_SESSION['AcademicYear'];

$academic_year=$_SESSION['AcademicYear'];

$AcademicYear = $academic_year;

if(!$_POST)

{

	$branch=$_SESSION['branch'];

	$sem=$_SESSION['sem'];

}

elseif($_POST)

{

	$branch=$_POST['branch'];

	$sem=$_POST['sem'];

	$track=$_POST['track'];	

}

else

{

	$branch=$_REQUEST['branch'];

	$sem=$_REQUEST['sem'];

}



				

if(isset($_POST['studdet']))

{	



		//echo "select id from interview where class='$sem' and acc_year='$academic_year' order by id";

		$rs=execute("select id from interview order by id");

		$i=1;

		while($r=fetcharray($rs))

		{

			//echo "inside while";

			if($track==$r[id])

			{

				//echo "inside if";

				$trackcount=$i;

				//exit;

			}

			$i++;

		}

		//echo "here";

		$newst=$_POST['studentid'];

		for($i=0;$i<sizeof($newst);$i++)

		{

			$nid = $newst[$i];

			$app=$_POST["app".$nid];

			$nid=$newst[$i];

			$desc=$_POST["desc".$nid];

			$mark=$_POST["mark".$nid];

			execute("INSERT INTO admissiontrack(id, student_id, desdet, trackid, mark) VALUES (NULL,  '$newst[$i]', '$desc', '$track' ,'$mark')");

			if($app == '1')

			{			

				

				execute("update student_m_pre set class_section_id='$trackcount' where id='$newst[$i]'");

			}

			if($app == '2')

			{

				execute("update student_m_pre set archive='F',class_section_id='$trackcount' where id='$newst[$i]'");

			}

		}

		?>

		<Script language="JavaScript">

		alert("Updated successfully");

		</Script>

		<?php		



}

?>



<html>

<head>

<title>Student Application form</title>

</head>



<body>

<script LANGUAGE="JavaScript">

function reload()

{

	document.frm.action='admissionRecords.php';

	document.frm.submit();

	

}

</script>
<?php
$rs = execute("SELECT * FROM student_m_pre limit 1");

$num = rowcount($rs);

if($num > 0)
{
	?>
<form method='post' action="" name="frm" >
  <table class='forumline' align='center' width="70%" >
    <tr>
    	<td Class="Head" colspan='2' align='center'>ADMISSION RECORDS</td>
    </tr>
	<tr height='30'>

		<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>

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

			</td></tr>

           <tr height='30'>

			<td> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>

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

			<td> &nbsp;&nbsp;&nbsp;&nbsp;Tracking Items</td>

		<td>

        <select name="track" onChange="reload()">

			<?php

			//echo "select * from interview where class='$sem' and acc_year='$AcademicYear' order by id"; 

				$rs=execute("select * from interview order by id");

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

	</tr></table>

 

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

if(!$track)

$track=1;



$track1=$track-1;



$rs=execute("select name, description, mark from interview where id='$track'");

while($r=fetchrow($rs))

{

	$trackdet0=$r[0];

	$trackdet1=$r[1];

	$trackdet2=$r[2];



}





	$sql="select id,first_name,admission_date from student_m_pre where id is not null and archive='Y' and academic_year = '$academic_year'";

	if($app_no!='')

	{

	 $sql.=" and id='$app_no'";

	}

	if($branch!=0)

	{

	$sql.=" and course_admitted='$branch'";

	}

	if($sem!=0)

	{

	$sql.=" and course_yearsem='$sem'";

	}



	$sql.=" and class_section_id='$track1'";

	

	if($studfname!='')

	{

	 $sql.=" and first_name like '$studfname%'";

	}

	$sql.=" and academic_year = '$academic_year'";

 $sql.=" order by first_name";

	//echo $sql;

		$rs=execute($sql) or die(mysql_error());



	if(rowcount($rs)==0)

	{

		echo "<center>No Records Found !! </center>";

		die();

	}



?>

<br>

<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>



<tr><td align="justify"  colspan='8'>

<?php

if($trackdet0!='')

{

	echo "Description : $trackdet0<br>";

}

if($trackdet2!=0)

{

	echo "Mark : $trackdet2<br>";

	

}

if($trackdet1!='')

{

	echo "Notes : $trackdet1";

	

}

?>

</td>

</tr>

<tr height='25' >

<td Class="rowpic" align='center'>Sl No</td>

<td Class="rowpic" align='center'>Application Id</td>

<td Class="rowpic" align='center'>Student Name</td>

<td Class='rowpic' align='center'>Application Date</td>

<?php

if($trackdet2)

{

	echo "<td Class='rowpic' align='center'>Mark </td>";

	

}

	echo "<td Class='rowpic' align='center'>Notes </td>";

	



?>

<td Class='rowpic' align='center'>Approve</td>

<td Class='rowpic' align='center'>Disapprove</td>

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

		<td align="center">&nbsp;&nbsp;<?=$r[id]?></td>

		<td>&nbsp;&nbsp;<?=$r[first_name]?></td>

        <td>&nbsp;&nbsp;<?=$r[admission_date]?></td>



        <?php

if($trackdet2)

{

?>

<td  align='center'><?php echo $trackdet[1]; ?>&nbsp;&nbsp;

  <input type='mark<?=$r[id]?>' value="" size="5" width="5"> </td>

<?php	

}

?>



	<td align='center'>

    	<textarea name="desc<?=$r[id]?>" cols="40" rows="3"></textarea></td>

	<td align="center">

       <input type="radio" name="app<?=$r[id]?>" value="1">

    </td>

    <td align="center">

       <input type="radio" name="app<?=$r[id]?>" value="2">

    </td>

    <input type="hidden" name="studentid[]" value="<?=$r[id]?>"> 

    

 </tr>

		<?php

		$sno++;

		$rowclass = 1 - $rowclass;

	}

?>

</table>

<br>

	<div align=center>

	<input type="submit" class='bgbutton' value="SAVE" name="studdet">

	</div>

    	</form>

        </body>

</html>