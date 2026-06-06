<html>
<head>
<?php
session_start();
require("../db.php");
$academic_year=$_SESSION['AcademicYear'];
$nPromote=$_POST['nPromote'];
$bDemote=$_POST['bDemote'];
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$ToYear=$_POST['ToYear'];
$studID=$_POST['studID'];
$academic_year=$academic_year+1;
?>
</head>
<body>
<?php
if(!is_array($studID))
{
	die("<b>Please select the Students..</b>");
}
$num = sizeof($studID);
if($bDemote==1)
{
	echo "<table align=center  class=forumline border='1' width=50%>";
	echo "<tr><td colspan=4 class=head align=center>Archived Students Report (Failed)</td></tr>";
	echo "<tr><td >Slno</td><td >Student Id</td><td >Student Name</td></tr>";
	$sno=1;
	while(list(,$value)=each($studID))
	{
		$sql1="select first_name,last_name,usn,student_id from student_m  where id='$value'";
		$rs1=execute($sql1);
		$r=fetcharray($rs1);
		
		        
		$sql="update student_m set archive='F' where id='$value'";
		execute($sql) or die(error_description());
		?>
		<tr><td ><?php if($sno<10) echo "0".$sno; else echo $sno; ?></td><td><?=$r[student_id]?></td><td><?=$r[first_name] ?> <?=$r[last_name] ?></td></tr>
		<?php
		$sno++;
	}
	echo "</table>";
	$str=" Archived.";
}
elseif($bDemote==2)
{
	echo "<table align=center  class=forumline border='1' width=50%>";
	echo "<tr><td colspan=4 class=head align=center>Archived Students Report (Ex)</td></tr>";
	echo "<tr><td >Slno</td><td >Student Id</td><td >Student Name</td></tr>";
	$sno=1;
	while(list(,$value)=each($studID))
	{
		$sql1="select first_name,last_name,usn,student_id from student_m  where id='$value'";
		$rs1=execute($sql1);
		$r=fetcharray($rs1);
	
		$sql="update student_m set archive='Y' where id='$value'";
		execute($sql) or die(error_description());

		$sql="insert into archive_student select * from student_m where id='$value' ";
		execute($sql) or die(error_description());

		$sql="delete from student_m where id='$value'";
		execute($sql) or die(error_description());

		?>
		<tr><td ><?php if($sno<10) echo "0".$sno; else echo $sno; ?></td><td><?=$r[student_id]?></td><td><?=$r[first_name] ?> <?=$r[last_name] ?></td></tr>
		<?php
		$sno++;
	}
	echo "</table>";
	$str=" Archived.";
}
elseif($bDemote==3)
{	
		$sql101=execute("select head_id from course_m where course_id='$branch'") or die(error_description());
		$rs101=fetcharray($sql101);
		$sem;
		$sql2="select max(year_id) from course_year ";
		$rs2=execute($sql2);
		$row2=mysql_fetch_row($rs2);
		
		if($row2[0]==$sem)
		{
			die("<b> You Can't Promote this student.as student(s) is/are in final year.</b>");	
		}
		else
		{
			$sql21="select max(year_id) from course_year where head_id='$rs101[0]' ";
			$rs21=execute($sql21);
			$row21=mysql_fetch_row($rs21);
			if($row21[0]==$sem)
			{
				$branch++;
				$ToYear++;
				echo "<table align=center border='1'  class=forumline width=50%>";
				echo "<tr><td colspan=4 class=head>Promoted Student List</td></tr>";
				echo "<tr><td >Slno</td><td >Student Id</td><td >Student Name</td></tr>";
				$sno=1;
				while(list(,$value) = each($studID))
				{
					$sql1="select first_name,last_name,usn,student_id from student_m  where id='$value'";
					$rs1=execute($sql1);
					$r=fetcharray($rs1);
	
					$sql = "UPDATE student_m set course_yearsem='$ToYear' ,course_admitted='$branch' , academic_year='$academic_year'  WHERE id='$value'";
					execute($sql) or die(error_description());
					?>
					<tr><td ><?php if($sno<10) echo "0".$sno; else echo $sno; ?>
                    </td><td><?=$r[student_id]?></td><td><?=$r[first_name] ?> <?=$r[last_name] ?></td></tr>
					<?php
					$sno++;
				}
				echo "</table>";
				$str=" Promoted.";
			}
			else
			{
				$ToYear++;
				echo "<table align=center  class=forumline width=50%>";
				echo "<tr><td colspan=4 class=head>Promoted Student List</td></tr>";
				echo "<tr><td >Slno</td><td >Student Id</td><td >Student Name</td></tr>";
				$sno=1;
				while(list(,$value) = each($studID))
				{
					$sql1="select first_name,last_name,usn,student_id from student_m  where id='$value'";
					$rs1=execute($sql1);
					$r=fetcharray($rs1);
	
					$sql = "UPDATE student_m set course_yearsem='$ToYear', academic_year='$academic_year' WHERE id='$value'";
					execute($sql) or die(error_description());
					?>
					<tr><td ><?php if($sno<10) echo "0".$sno; else echo $sno; ?></td><td><?=$r[student_id]?></td><td><?=$r[first_name] ?> <?=$r[last_name] ?></td></tr>
					<?php
					$sno++;
				}
				echo "</table>";
				$str=" Promoted.";
			}
		}

}
echo "<hr><br><div align=\"center\"><b>$num student(s) <u>$str</u></b></div><br><hr>";
?>
</body>
</html>