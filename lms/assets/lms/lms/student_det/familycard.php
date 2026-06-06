<html>
<head>
<?php
	session_start();
	include("../db.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$app_no=$_POST['app_no'];
	$studfname=$_POST['studfname'];
	$academic_year=$_SESSION['AcademicYear'];
	
	//print_r($_POST);
?>
<script language='javascript'>


function reload_frm()
{
	<!--document.frm1.action='viewphotodet.php?student_id=$stid';-->
	document.frm1.submit();
}
</script>

</head>
<body>
<?php
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$app_no=$_POST['app_no'];
$stid=$_POST['stid'];
$a_year=$_POST['a_year'];
$un=$_POST['un'];
$studfname=$_POST['studfname'];
	$sql="select a.id,a.student_id,a.student_id,a.first_name,a.last_name,a.course_yearsem,a.parent_name,a.m_name from student_m a,stud_sibling b where b.stud=a.id and b.status=1 and  a.id is not null and a.archive='N' and a.academic_year='$academic_year' ";
	if($app_no!='')
	{
	 $sql.=" and a.student_id='$app_no'";
	}
	
	if($sem!=0)
	{
	$sql.=" and a.course_yearsem=$sem";
	}
	if($studfname!='')
	{
	 $sql.=" and a.first_name like '$studfname%'";
	}
	 $sql.=" group by b.family_code order by a.course_yearsem, a.first_name";
	$rs=execute($sql);

	if(rowcount($rs)==0)
	{
		echo "<font>No Records Found !!";
		die();
	}

?>
<form method='post' action="viewphotodet.php" name="frm1" >
<input type="hidden" name="app_no" value="<?php echo $app_no?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
<input type="hidden" name="sem" value="<?php echo $sem ?>">
<input type="hidden" name="studfname" value="<?php echo $studfname ?>">
<input type="hidden" name="a_year" value="<?php echo $a_year?>">
<input type="hidden" name="un" value="<?php echo $un ?>">
<br>
<table border=1 class=forumline align=center width='70%' cellspacing=0 cellpadding=0>
<tr><td align='center' class='head' colspan='6'>Select Sibling Student</td>
</tr>
<tr height='25'>

<td Class="rowpic">SL.No</td>
<td Class="rowpic">Student Id</td>
<td Class="rowpic">Father Name</td>
<td Class="rowpic">Mother Name</td>
<td Class="rowpic">Grade</td>

<td width="15%" align='center' Class="rowpic">Select</td></tr>
<?php
    $rowclass=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs);
		$clnam=fetcharray(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));

		
		if($i%2)
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
		?>
		<td>&nbsp;<?php echo ($i+1) ?></td>
		<td>&nbsp; <?php if($r[student_id]!="") echo $r[student_id]; else echo $r[student_id]; ?></td>
		<td>&nbsp;&nbsp;<?=$r[parent_name]?></td>
		<td>&nbsp;&nbsp;<?=$r[m_name]?></td>
		<td>&nbsp;&nbsp;<?=$clnam[0]?></td>
		<td align='center'>
        <input type='radio' name='stid' value='<?=$r[id]?>' onChange="reload_frm(0)"></td>


</tr>
<?php
	$rowclass = 1 - $rowclass;
	}
?></table>
<br>


<?php
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$app_no=$_POST['app_no'];
$stid=$_POST['stid'];
$a_year=$_POST['a_year'];
$un=$_POST['un'];
$studfname=$_POST['studfname'];
	$sql="select a.id,a.student_id,a.student_id,a.first_name,a.last_name,a.course_yearsem,a.parent_name,a.m_name from student_m a,stud_sibling b where b.stud!=a.id and b.status!=1 and  a.id is not null and a.archive='N' and a.academic_year='$academic_year' ";
	if($app_no!='')
	{
	 $sql.=" and a.student_id='$app_no'";
	}
	
	if($sem!=0)
	{
	$sql.=" and a.course_yearsem=$sem";
	}
	if($studfname!='')
	{
	 $sql.=" and a.first_name like '$studfname%'";
	}
	$sql.="group by a.id order by a.course_yearsem, a.first_name";
	$rs=execute($sql);

	if(rowcount($rs)==0)
	{
		echo "<font>No Records Found !!";
		die();
	}

?>
<form method='post' action="viewphotodet.php" name="frm1" >
<input type="hidden" name="app_no" value="<?php echo $app_no?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
<input type="hidden" name="sem" value="<?php echo $sem ?>">
<input type="hidden" name="studfname" value="<?php echo $studfname ?>">
<input type="hidden" name="a_year" value="<?php echo $a_year?>">
<input type="hidden" name="un" value="<?php echo $un ?>">
<br>
<table border=1 class=forumline align=center width='70%' cellspacing=0 cellpadding=0>
<tr><td align='center' class='head' colspan='6'>Select Non-Sibling Student</td>
</tr>
<tr height='25'>

<td Class="rowpic">SL.No</td>
<td Class="rowpic">Student Id</td>
<td Class="rowpic">Father Name</td>
<td Class="rowpic">Mother Name</td>
<td Class="rowpic">Grade</td>

<td width="15%" align='center' Class="rowpic">Select</td></tr>
<?php
    $rowclass=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs);
		$clnam=fetcharray(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));

		
		if($i%2)
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
		?>
		<td>&nbsp;<?php echo ($i+1) ?></td>
		<td>&nbsp; <?php if($r[student_id]!="") echo $r[student_id]; else echo $r[student_id]; ?></td>
		<td>&nbsp;&nbsp;<?=$r[parent_name]?></td>
		<td>&nbsp;&nbsp;<?=$r[m_name]?></td>
		<td>&nbsp;&nbsp;<?=$clnam[0]?></td>
		<td align='center'>
        <input type='radio' name='stid' value='<?=$r[id]?>' onChange="reload_frm(0)"></td>


</tr>
<?php
	$rowclass = 1 - $rowclass;
	}
?></table>
<br>
<!--<div align='center'><input type="submit" class='bgbutton' value="Submit" name="studdet"></div>
--></form>
</body>
</html>
