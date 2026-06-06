<?php
session_start();
$file_type = "vnd.ms-excel";
$file_name= "Interviewd_students.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");

include("../db.php");

$school_name = $_SESSION['SchoolName'];
$academic_year = $_SESSION['AcademicYear'];

$branch=$_POST['branch'];
$sem=$_POST['sem'];
$class_section_id=$_POST['class_section_id'];
$track = $_POST['track'];
$filter = $_POST['filter'];

$dd = date('d-M-Y');

$track1 = $track - 1;


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


$rs=execute("select id from interview where class='$sem' and acc_year='$academic_year' order by id");
	$i=1;
	while($r=fetcharray($rs))
	{
		if($track==$r[id])
		{
			$trackcount=$i;
		}
		$i++;
	}
$trackcount1 = $trackcount - 1;
$sql="select id,first_name,admission_date from student_m_pre where id is not null and academic_year = '$academic_year'";
	if($filter=='1')
	{
	$sql.=" and class_section_id='$trackcount' and archive!= 'F'";
	}
	if($filter=='2')
	{
	 $sql.=" and archive = 'F'";
	}
	if($filter=='3')
	{
	 $sql.= " and class_section_id='$trackcount1' and archive!= 'F'";
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
	//echo $sql;
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
<form method="post" name="frm" action="interviewdis_xl.php">

<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr><td align='center' class='head' colspan='5'><?php echo $school_name; ?></td></tr>
<tr><td align='center' class='head' colspan='5'>Date : <?php echo $dd; ?></td></tr>
<tr><td align='center' class='head' colspan='5'>Interview status report of students of - <?php echo  $branchname."-".$semname ; ?> </td></tr>
<tr height='25' >
<td Class="rowpic" align='center' nowrap="nowrap">Sl No</td>
<td Class="rowpic" align='center' nowrap="nowrap">Application Id</td>
<td Class="rowpic" align='center' nowrap="nowrap">Student Name</td>
<td Class="rowpic" align='center' nowrap="nowrap">Remarks</td>
<td Class="rowpic" align='center' nowrap="nowrap">Application Date</td>
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
		$sql1 = "select * from admissiontrack where student_id = '$r[id]' and trackid = '$track'";
		$rs1=execute($sql1) or die(mysql_error());
		if(rowcount($rs)> 0)
		{
			$r1=fetcharray($rs1);
			$desc = $r1[desdet];
		}
		?>
	
		<td   align='center' nowrap="nowrap"><?=$sno?></td>
		<td align="center" nowrap="nowrap">&nbsp;&nbsp;<?=$r[id]?></td>
		<td nowrap="nowrap">&nbsp;&nbsp;<?=$r[first_name]?></td>
        <td align="justify">&nbsp;&nbsp;<? echo $desc?></td>
        <td nowrap="nowrap" align="center">&nbsp;&nbsp;<?=$r[admission_date]?></td>
        </tr>
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
?>
</table>
</body>
</html>