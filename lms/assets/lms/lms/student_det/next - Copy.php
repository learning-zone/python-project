<html>
<head>
<?php
session_start();
require("../db.php");
?>
</head>
<body>
<?php
if(!is_array($studID))
{
	die("<font color='red'><b>Please select the Students..</b></font>");
}
$num = sizeof($studID);
if($bDemote==1)
{
	echo "<table align=center  class=forumline width=50%>";
	echo "<tr><td colspan=4 class=head align=center>Archived Students Report (Failed)</td></tr>";
	echo "<tr><td align='center'>Slno</td><td align='center'>Student Id</td><td align='center'>Student Name</td><td align='center'>USN</td></tr>";
	$sno=1;
	while(list(,$value)=each($studID))
	{
		$sql1="select first_name,last_name,usn,student_id from student_m  where id='$value'";
		$rs1=execute($sql1);
		$r=fetcharray($rs1);
		
		        
		$sql="update student_m set archive='F' where id='$value'";
		execute($sql) or die(error_description());
		?>
		<tr><td align='center'><font color=red><?php if($sno<10) echo "0".$sno; else echo $sno; ?></font></td><td><font color=red><?=$r[student_id]?></font></td><td><font color=red><?=$r[first_name] ?> <?=$r[last_name] ?></font></td><td><font color=red><?=$r[usn]?></font></td></tr>
		<?php
		$sno++;
	}
	echo "</table>";
	$str=" Archived.";
}
elseif($bDemote==2)
{
	echo "<table align=center  class=forumline width=50%>";
	echo "<tr><td colspan=4 class=head align=center>Archived Students Report (Ex)</td></tr>";
	echo "<tr><td align='center'>Slno</td><td align='center'>Student Id</td><td align='center'>Student Name</td><td align='center'>USN</td></tr>";
	$sno=1;
	while(list(,$value)=each($studID))
	{
		$sql1="select first_name,last_name,usn,student_id from student_m  where id='$value'";
		$rs1=execute($sql1);
		$r=fetcharray($rs1);
	
		$sql="update student_m set archive='Y' where id='$value'";
		execute($sql) or die(error_description());

		$sql="insert into student_archive select * from student_m where id='$value' ";
		execute($sql) or die(error_description());

		$sql="delete from student_m where id='$value'";
		execute($sql) or die(error_description());

		?>
		<tr><td align='center'><font color=blue><?php if($sno<10) echo "0".$sno; else echo $sno; ?></font></td><td><font color=blue><?=$r[student_id]?></font></td><td><font color=blue><?=$r[first_name] ?> <?=$r[last_name] ?></font></td><td><font color=blue><?=$r[usn]?></font></td></tr>
		<?php
		$sno++;
	}
	echo "</table>";
	$str=" Archived.";
}
elseif($bDemote==3)
{	
		$sql101=execute("select head_id from course_m where course_id='$FromCourse'") or die(error_description());
		$rs101=fetcharray($sql101);
		
		$sql2="select * from course_year where head_id='$rs101[0]' and year_id='$ToYear'";
		$rs2=execute($sql2);
		$row2=rowcount($rs2);
		
		if($row2>0)
		{
			echo "<table align=center  class=forumline width=50%>";
			echo "<tr><td colspan=4 class=head>Promoted Student List</td></tr>";
			echo "<tr><td align='center'>Slno</td><td align='center'>Student Id</td><td align='center'>Student Name</td><td align='center'>USN</td></tr>";
			$sno=1;
			while(list(,$value) = each($studID))
			{
				$sql1="select first_name,last_name,usn,student_id from student_m  where id='$value'";
				$rs1=execute($sql1);
				$r=fetcharray($rs1);

				$sql = "UPDATE student_m set course_yearsem='$ToYear' WHERE id='$value'";
				execute($sql) or die(error_description());
				?>
				<tr><td align='center'><font color=green><?php if($sno<10) echo "0".$sno; else echo $sno; ?></font></td><td><font color=green><?=$r[student_id]?></font></td><td><font color=green><?=$r[first_name] ?> <?=$r[last_name] ?></font></td><td><font color=green><?=$r[usn]?></font></td></tr>
				<?php
				$sno++;
			}
			echo "</table>";
			$str=" Promoted.";
		}
		else
		{
			die("<font color=red><b> You Can't Promote this student.as student(s) is/are in final sem/year.</b></font>");
		}
}
echo "<hr><br><div align=\"center\"><b>$num student(s) <u>$str</u></b></div><br><hr>";
?>
</body>
</html>