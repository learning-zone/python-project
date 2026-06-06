<?php
/*
page info : In student_m_online table if archieve  = 'F' the student is rejected, if student is approved the archieve status will be 'Y'


*/
session_start();
$file_type = "vnd.ms-excel";
$file_name= "student_AppliedOnline_report.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");

include("../db.php");

$school_name = $_SESSION['SchoolName'];
$academic_year = $_SESSION['AcademicYear'];

$branch = $_POST['branch'];
$sem = $_POST['sem'];
$class_section_id = $_POST['class_section_id'];
$status = $_POST['status'];


$sql="select id,first_name,admission_date,age from student_m_online where id is not null and academic_year = '$academic_year'";
	if($status=='1')
	{
	$sql.= " and archive ='N'";
	}
	else if($status=='2')
	{
	 $sql.= " and archive = 'Y'";
	}
	else
	{
	 $sql.= " and archive = 'F'";
	}	
	if($branch!=0)
	{
	$sql.=" and course_admitted='$branch'";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem='$sem'";
	}	
 $sql.=" order by first_name";
// echo $sql;
		$rs=execute($sql) or die(mysql_error());

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
<html>
<head></head>
<body>
<form method="post" name="frm" action="onlinerepdis.php">
<input type="hidden" name="branch" value="<?php echo $branch; ?>" />
<input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
<input type="hidden" name="sem" value="<?php echo $sem; ?>" />
<input type="hidden" name="class_section_id" value="<?php echo $class_section_id; ?>" />
<input type="hidden" name="status" value="<?php echo $status; ?>" />
<?php
$sql = "select coursename from course_m where course_id = '$branch'";
$rs=execute($sql);
while($r=fetcharray($rs))
{
	$branchname = $r[coursename];
}
$sql1 = "select year_name from course_year where year_id = '$sem'";
$rs1=execute($sql1);
while($r1=fetcharray($rs1))
{
	$semname = $r1[year_name];
}
?>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr><td align='center' class='head' colspan='5'><?php echo $school_name; ?></td></tr>
<tr><td align='center' class='head' colspan='5'>List of Students Applied Online for - <?php echo $branchname . "-". $semname ; ?> </td></tr>
<tr height='25' >
<td Class="rowpic" align='center'>Sl No</td>
<td Class="rowpic" align='center'>Application Id</td>
<td Class="rowpic" align='center'>Student Name</td>
<td Class="rowpic" align='center'>Age</td>
<td Class="rowpic" align='center'>Application Date</td>
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
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<?=$r[first_name]?></td>
        <td align="center"><?=$r[age]?></td>
        <td align="center">&nbsp;&nbsp;<?=$r[admission_date]?></td>
        </tr>
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
?>
</table>
<br />
</body>
</html>