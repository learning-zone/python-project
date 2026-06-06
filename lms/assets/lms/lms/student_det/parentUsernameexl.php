<?php
session_start();
header("Content-type: application/ms-excel");
header("Content-Disposition: attachment; filename=Password.xls");
header("Pragma: no-cache");
header("Expires: 0");


include("../db.php");
$academic_year=$_SESSION['AcademicYear'];
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$app_no=$_POST['app_no'];
	$studfname=$_POST['studfname'];	


?>

<html>
<head>
<title>Student details Modify form</title>
</head>

<body>
<script LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='parentUsernameexl.php';
	document.frm.submit();
}

</script>

<?php
if(!$_POST['studdet'] and ! $_REQUEST)
die();
	$sql="select id,student_id, usn, first_name, last_name, admission_id, parent_username, parent_password from student_m where id is not null and archive='N' and academic_year='$academic_year'";
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
		$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs)==0)
	{
		echo "<font><b>No Records Found !!</b></font>";
		die();
	}

?>

<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr><td align='center' class='head' colspan='6'><font size="4"><b>Parent Username & Password Details</b></font></td>
</tr>
<tr height='25' >
    <td Class="rowpic" align='center'>Sl No</td>
    <td Class="rowpic" align='center'>Student ID</td>
    <td Class="rowpic" align='center'>Admission No</td>
    <td Class="rowpic" align='center'>Student Name</td>
    <td Class="rowpic" align='center'>Parent Username</td>
    <td Class="rowpic" align='center'>Parent Password </td>
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
		<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>
         <TD align="center"><?=$r['parent_username']?></TD>
		 <TD align="center"><?=$r['parent_password']?></TD>
		
        </tr>
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
?>
</table>
</body>
</html>