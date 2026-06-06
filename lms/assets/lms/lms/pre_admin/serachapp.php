<?php
session_start();
require_once("../db.php");
$academic_year=$_SESSION['AcademicYear'];
if(!$_POST)
{
	$sem=$_SESSION['sem'];
	$branch=$_SESSION['branch'];
}
elseif($_POST)
{
	$sem=$_POST['sem'];
	$app_no=$_POST['app_no'];
	$branch=$_POST['branch'];
	$studfname=$_POST['studfname'];
	$class_section_id=$_POST['class_section_id'];	

}
else
{
	$sem=$_REQUEST['sem'];
	$branch=$_REQUEST['branch'];
	$class_section_id=$_REQUEST['class_section_id'];

}
?>
<html>
<head>
<title>Student Applied online</title>
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
</script>
<?php
$rs = execute("SELECT * FROM student_m_online limit 1");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' action="serachapp.php" name="frm" >
    <table class='forumline' align='center' width="90%" >
    <tr>
    	<td Class="Head" colspan='7' align='center'>APPLICATION</td>
    </tr>
	<tr height='30'>
		<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
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
	<tr height='30'>

	<td>&nbsp;&nbsp;Application No</td>

		<td><input type='text' name='app_no' value=""></td>

		<td>Student Name</td>

		<td colspan="3" ><input type='text' name='studfname' value=""></td></tr>

	</table><br>

	<div align=center>

	<input type="submit" class='bgbutton' value="Search" name="studdet">

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
	$sql="select id,first_name,admission_date,course_yearsem from student_m_online where id is not null and archive='N' ";

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

	if($class_section_id!='')

	{

		$sql.=" and class_section_id='$class_section_id'  ";

	}

	

	if($studfname!='')

	{

	 	$sql.=" and first_name like '$studfname%'";

	}

 $sql.=" order by first_name";

// echo $sql;

		$rs=execute($sql);


	if(rowcount($rs)==0)
	{
		//echo "<center>No Records Found !! </center>";
		?>
        <script language="javascript">
		alert("No Record Found");
		</script>
        <?php		
		die();
	}
?>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr>
	<td align='center' class='head' colspan='6'>Student Details</td>
</tr>
<tr height='25' >
      <td Class="rowpic" align='center'>Sl No</td>
      <td Class="rowpic" align='center'>Application Id</td>
      <td Class="rowpic" align='center'>Student Name</td>
      <td Class="rowpic" align='center'> <?php echo $_SESSION['semname']; ?></td>
      <td Class="rowpic" align='center'>Application Date</td>
      <td Class="rowpic" align='center'>Action</td>
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
			echo "<tr class='clsname' >";
		else
			echo "<tr >";

		?>
		<td   align='center' ><?=$sno?></td>

		<td align="center">&nbsp;&nbsp;<?=$r[id]?></td>

		<td>&nbsp;&nbsp;<?=$r[first_name]?></td>

        <td align="center">&nbsp;&nbsp;<?php

		$course_yearsem=fetchrow(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));

		echo $course_yearsem[0];

		?></td>

        <td align="center">&nbsp;<? print( date("d-M-Y", strtotime($r['admission_date'])) ); ?></td>

        <td align="center">

        <A HREF='approve.php?studId=<?php echo $r[id]?>'><?php echo view?></A>

        </td>

        </tr>

		<?php

		$sno++;

		$rowclass = 1 - $rowclass;

	}

?>
</table>
</body>
</html>