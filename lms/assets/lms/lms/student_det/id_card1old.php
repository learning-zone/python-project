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
?>
<script language='javascript'>
function selectMe()
{
	var i = document.frm1.length;
	for(j=0;j<i;j++)
	{
		if(document.frm1[j].Sel != "CheckBox")
		{
			flag = document.frm1[j].checked;
			document.frm1[j].checked = !flag;
		}
	}
}

function reload_frm()
{
	document.frm1.action='id_card1.php'
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
	$sql.="select id,student_id,student_id,first_name,last_name from student_m where id is not null and archive='N' and academic_year='$academic_year' ";
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
	if($studfname!='')
	{
	 $sql.=" and first_name like '$studfname%'";
	}
	$sql.=" order by first_name";
	$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs)==0)
	{
		echo "<font>No Records Found !!";
		die();
	}

?>
<form method='post' action="id_card2.php" name="frm1" >
<input type="hidden" name="app_no" value="<?php echo $app_no?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
<input type="hidden" name="sem" value="<?php echo $sem ?>">
<input type="hidden" name="studfname" value="<?php echo $studfname ?>">
<input type="hidden" name="a_year" value="<?php echo $a_year?>">
<input type="hidden" name="un" value="<?php echo $un ?>">
<br>
<table border=1 class=forumline align=center width='90%' cellspacing=0 cellpadding=0>
<tr><td align='center' class='head' colspan='4'>Select Student</td>
</tr>
<tr height='25'>

<td Class="rowpic">SL.No</td>
<td Class="rowpic">Student Id</td>
<td Class="rowpic">Student Name</td>
<td width="23" align='center' Class="rowpic"><div id="checkAll" onMouseOver="this.style.backgroundColor='green';
this.style.cursor='hand';this.style.color='white'"
onMouseOut="this.style.backgroundColor='#E9D0B6';this.style.cursor='default';this.style.color='black'"
onClick="selectMe()" Title="Click to Select all Students">X</div></td></tr>
<?php
    $rowclass=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
	 $r=fetcharray($rs);

		if($i%2)
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
		?>
		<td>&nbsp;<?php echo ($i+1) ?></td>
		<td>&nbsp; <?php if($r[student_id]!="") echo $r[student_id]; else echo $r[student_id]; ?></td>
		<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>
		<td align='center'>
        <input type='checkbox' name='stid[]' value='<?=$r[id]?>'></td>


</tr>
<?php
	$rowclass = 1 - $rowclass;
	}
?></table>
<br>
<div align='center'><input type="submit" class='bgbutton' value="Submit" name="studdet"></div>
</form>
</body>
</html>
