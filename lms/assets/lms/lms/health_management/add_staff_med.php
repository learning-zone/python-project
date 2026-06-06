<html>

<head>
<script language="javascript">
function OpenWind2(k2)
{

 var finalVar ;

 finalVar=k2 ;

 window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}
</script>
</head>
<?php

	session_start();

	include("../db.php");

	//print_r($_POST);



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



<script language="javascript">

function cli()

{

	document.form1.action="edit_stud.php";

	document.form1.submit();

}

function send(id)

{

	document.form1.action='edit_next.php?id='+id;

	document.form1.submit();

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

<meta http-equiv="Content-Language" content="en-us">

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">

<title>New Page 1</title>

</head>

<body>

<p>&nbsp;</p>

<form name="form1" method="post" action="edit_medical_rep.php">

  <table class='forumline' align='center' width="90%" >

<tr><td align=center colspan=4  class=head>Edit Student Medical Report</td></tr>

	<tr height='30'>

		<td><?php echo $_SESSION['branchname']; ?></td>

		<td><select name="branch" onChange="reload(this.value)">

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

</table>

<br>

<div align="center"><input type="button" name="Submit" value="Submit" class="bgbutton" onClick="cli()"  ></div> 

<br>

<?php



	$sql="select id, student_id,  usn, first_name, last_name, course_admitted, academic_year, course_yearsem from student_m where id is not null and archive='N' and academic_year='$academic_year'";

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

	 $sql.=" and first_name like '$studfname%'";

	}

	$sql.=" order by first_name";

$dv=execute($sql);



	if(rowcount($dv)==0)

	{

		echo "<font><b>No Records Found !!</b></font>";

		die();

	}

$dv1=execute($sql);



$grade=$sem;

?>

<input type=hidden name='grade' value='<?php echo $grade?>'>



<table class='forumline' cellspacing=0 width="90%" align=center> 

		<tr><td colspan=7 align=center  class=head>Student Details</td></tr>

		<tr><td align=center nowrap>&nbsp;Student Name</td>

			<td align=center nowrap>&nbsp;Identification Number</td>

			<td align=left nowrap>Sex</td>

			<td align=center nowrap>&nbsp;Age(Yrs.)</td>

			<td align=center nowrap>&nbsp;Admission Type</td>

			<td align=center nowrap>&nbsp;Academic Year</td>			
            <td align=left nowrap>View</td>

		</tr>

		<?php

	while($r=fetcharray($dv1))

	{	

		$studentid=$r['id'];

		

		  $df=execute("select * from doc_detail where stud_id='$studentid' group by stud_id");

			$rc=rowcount($df);

		     while($ddf=fetcharray($df))

		       {

		         $mm=$ddf[adm_type];

			 $ecc=execute("select * from admission where id='$mm'");

			 $ec=fetcharray($ecc);

			 $dv=execute("select * from student_m where id='$ddf[stud_id]' and archive='N'");

			 $dvv=fetcharray($dv);

			 $fname=$dvv[first_name]." ".$dvv[last_name];

			 

			 

			 

		?>

		<input type=hidden name='stud' value='<?php echo $dvv[id]?>'>

		<input type=hidden name='fs' value='<?php echo $fname?>'>

		<input type=hidden name='grade'value='<?php echo $ddf[course_id]?>'>

		<input type=hidden name='ad' value='<?php echo $ddf[acc_year]?>'>

		<input type=hidden name='dat' value='<?php echo $dg[d_date]?>'>

		<input type=hidden name='ag' value='<?php echo $ddf[age]?>'>

		<input type=hidden name='gen' value='<?php echo $ddf[sex]?>'>

		<input type=hidden name='adm' value='<?php echo $ec[name]?>'>

		<tr>

			<td align="center"><?php echo $fname?></td>

			<td align=center>

			<!-- <a href='edit_next.php?stud=<?php echo $dvv[id]?>&fs=<?php echo $fname?>&grade=<?php echo $ddf[course_id]?>&ad=<?php echo $ddf[acc_year]?>&dat=<?php echo $dg[d_date]?>&ag=<?php echo $ddf[age]?>&gen=<?php echo $ddf[sex]?>&adm=<?php echo $ec[name]?>'> -->

			<?php echo $dvv[id]?></td>

			<td ><?php 

			if($dvv[gender]=='M')

			echo "Male";

			else

			echo "Female";

			?></td>

			<td >&nbsp;&nbsp;&nbsp;<?php echo $ddf[age]?></td>

			<td >&nbsp;<?php echo $ec[name]?></td>

			<td align=center><?php echo $ddf[acc_year]?></td>

			<!--<td align=center><select style="WIDTH: 185px" name="dts" onchange='send(this.value)'>

			<option value='0'>Select Date</option>-->

<?php

/*$dv=execute("select id,d_date  from doc_detail where stud_id='$studentid'");

					

$rcp=rowcount($dv);

for($i=0;$i<$rcp;$i++)

{

$dg=fetcharray($dv);

$dt=date('d-m-Y',strtotime($dg[d_date]));

if($dts==$dg[id])

{

echo("<option value='$dg[id]' selected>$dt</option>");

}

else

{

echo("<option value='$dg[id]'>$dt</option>");

}                                        

}

		*/			

?>

<!--</select></td>-->

<td><a href="javascript:OpenWind2('add_staff_med1.php?studentid=<?=$studentid?>')" >View

</a></td>
			

</tr>



	<?php

		   }

	}

	?>	

	</table>

</form>

</body>

</html>

