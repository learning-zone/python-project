<?php
session_start();
include("../db.php");
if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
elseif($_POST)
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$app_no=$_POST['app_no'];
	$studfname=$_POST['studfname'];	
	
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
<title>Student details Modify form</title>
</head>

<body>
<script LANGUAGE="JavaScript">
function reload()
{
	document.frm1.action='select_stud_mod2.php';
	document.frm1.submit();
}

</script>

<?php

$rs = execute("SELECT * FROM student_m limit 1");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' action="select_stud_mod2.php" name="frm1" >
	
    <table class='forumline' align='center' ><tr><td Class="Head" colspan='7' align='center'>Search Student Detials</td></tr>
    
	<tr height='30'>
		<td>School Division:</td>
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
			<td>Class :</td>
		<td><select name="sem">
			<option value='0'>----------Select---------</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
					}
				}
			?>
			</select>

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
	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

}
?>
</select>
</td><td>Student Id :</td>
		<td><input type='text' name='app_no' value=""></td></tr>
	<tr height='30'>
		
		<td>Student Name :</td>
		<td colspan="3" ><input type='text' name='studfname' value=""></td></tr>
	</table><br>
	<div align=center>
	<input type="submit" class='bgbutton' value="Submit" name="studdet">
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

if(isset($_POST['studdet']) or $_REQUEST)
{	
	$sql="select id,student_id,usn,first_name,last_name from student_m where id is not null and archive='N'";
	if($app_no!='')
	{
	 $sql.=" and student_id='$app_no'";
	}
	if($branch!=0)
	{
	$sql.=" and course_admitted=$branch";
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
		$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs)==0)
	{
		echo "<font color=brown><b>No Records Found !!</b></font>";
		die();
	}

?>
<form name="frm" method="post">
<input type="hidden" name="app_no" value="<?php echo $app_no?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
<input type="hidden" name="sem" value="<?php echo $sem ?>">
<input type="hidden" name="studfname" value="<?php echo $studfname ?>">
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='50%'>
<tr><td align='center' class='head' colspan='5'><font size="4"><b>Modify Student Details</b></font></td>
</tr>
<tr height='25'>
<td Class="rowpic" align='center'>Sl No</td>
<td Class="rowpic" align='center'>Student ID</td>
<td Class="rowpic" align='center'>Student Name</td></tr>
<?php
  $rowclass=1;
  $sno=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
		$row=fetcharray($rs);
		if($sno<10)
			$sno="0".$sno;
		?>
		<tr class='row<?php echo $rowclass ?>' height='30'> 
		<td align='center'><?=$sno?></td>
		<td>&nbsp;&nbsp;
        <A HREF='add_hostel_stud.php?studId=<?php echo $row[id]?>&studFName=<?php echo $row[first_name]?>&c_name=<?php echo $c_name?>&c_year=<?php echo $c_year?>Studentid=<?php echo $row[student_id]?>'><?php echo $row[student_id]?></A></td>
		<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td></tr>
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
?>
</table>
<?php
}
?>
</form>
</body>
</html>