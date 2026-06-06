<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
/*
page info : In student_m_online table if archieve  = 'F' the student is rejected, if student is approved the archieve status will be 'Y'
*/
session_start();
require_once("../db.php");

$school_name = $_SESSION['SchoolName'];
$academic_year = $_SESSION['AcademicYear'];

$sem = $_POST['sem'];
$toDate = $_POST['bdate'];
$branch = $_POST['branch'];
$status = $_POST['status'];
$fromDate = $_POST['adate'];
$class_section_id = $_POST['class_section_id'];

	$dateArray=explode('/',$fromDate);
	$yy=$dateArray[2];
	$mm=$dateArray[1];
	$dd=$dateArray[0];
	$fromDate="$yy-$mm-$dd";
	
	//echo $fromDate;
	
	$dateArray1=explode('/',$toDate);
	$yy1=$dateArray1[2];
	$mm1=$dateArray1[1];
	$dd1=$dateArray1[0];
	$toDate="$yy1-$mm1-$dd1";
	
	//echo $toDate;

$sqlCourse = "select coursename from course_m where course_id = '$branch'";

$rs=execute($sqlCourse);

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
$sqlDisplay="SELECT `id`, `first_name`, `admission_date`, `dob` FROM `student_m_online` WHERE id is not null AND academic_year = '$academic_year' AND `enquiry_type`='Online'";

    if($fromDate!='' and $toDate!='' and $fromDate!='--' and $toDate!='--')
	{

	 $sqlDisplay.= " and inserted_date >= '$fromDate' and inserted_date <= '$toDate'";

	}
	if($status=='1')
	{

	 $sqlDisplay.= " and archive ='N'";

	}
	else if($status=='2')
	{
	 
	 $sqlDisplay.= " and archive = 'Y'";

	}
	else if($status=='3')
	{
		
	  $sqlDisplay.= " and archive = 'F'";

	}
	if($branch!=0)
	{

	  $sqlDisplay.=" and course_admitted='$branch'";

	}
	if($sem!=0)
	{

	  $sqlDisplay.=" and course_yearsem='$sem'";

	}	

 $sqlDisplay.=" order by first_name";

   //echo $sqlDisplay;

	$rsDisplay=execute($sqlDisplay) or die(mysql_error());

	if(rowcount($rsDisplay)==0)
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
<head>
<script language="javascript">
function redirect()
{
	document.frm.action = "onlinerepdis_xl.php";
	document.frm.submit();
}
function printReport()
{

	prn.style.display = "none";
	window.print();
}
</script>
</head>
<body>

<!-- <form method="post" name="frm" action="onlinerepdis_xl.php"> -->

<form method="post" name="frm">

<input type="hidden" name="branch" value="<?php echo $branch; ?>" />

<input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />

<input type="hidden" name="sem" value="<?php echo $sem; ?>" />

<input type="hidden" name="class_section_id" value="<?php echo $class_section_id; ?>" />

<input type="hidden" name="status" value="<?php echo $status; ?>" />



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
	for($i=0;$i<rowcount($rsDisplay);$i++)
	{

		$r=fetcharray($rsDisplay);

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
        <?
			$date1=date("Y-m-d");
			$date2=$r['dob'];
			
			$dt1 = strtotime($date1);
			$dt2 = strtotime($date2);

            $age = $dt1 - $dt2;
			
		?>
        <td align="center"><? echo floor($age/3600/24/365); ?></td>
        <td align="center">&nbsp;&nbsp;<? print( date("d-M-Y", strtotime($r['admission_date'])) ); ?></td>
        </tr>
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
?>
</table>
<br />
<div align="center" id="prn">
<input class="bgbutton" type="button" value="Print" name="B1" onClick="printReport()" >
<input class="bgbutton" type="button" name="excel" value="Export to Excel" onClick="redirect()" />
</div>
</body>
</html>