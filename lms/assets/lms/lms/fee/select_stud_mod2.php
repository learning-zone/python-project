<?php
session_start();
include("../db.php");
?>
<html>
<head><LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<title>Student details Modify form</title>
</head>
<body>
<script LANGUAGE="JavaScript">
function send()
{
	if(document.frm.studfname.value=='' && document.frm.student_id.value=='' && document.frm.sem.value==0)
	{
		alert ("Enter StudentID or Student Name or Semester Details...");
		return false;
	}
	document.frm.action='studlist.php';
	document.frm.submit();
}
function frm_reload()
{
	document.frm.action='select_stud_mod2.php';
	document.frm.submit();
} 
</script>
<?php
$rs = execute("SELECT * FROM student_m");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' action="studlist.php" name="frm" >
	<center>
    <table class='forumline' align='center' ><tr><td Class="Head" colspan='5' align='center'>Search Student Detials</td></tr>
    </center>
	<tr>
	<td>Program </td>
		<td>
			<select name="branch" onchange='frm_reload()'>
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
		<td><font color='red'><b>&nbsp;&nbsp;AND&nbsp;&nbsp;</b></font></td>
			<td >Semester </td>
		<td><select name="sem">
			<option value='0'>---- Select ----</option>
			<?php
				$rs1=execute("select * from course_m where course_id=$branch");
				$hdid=fetcharray($rs1);
				$hd_id=$hdid[head_id];
				$rs=execute("SELECT year_name,year_id FROM course_year where head_id='$hd_id'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
					}
				}
			?>
			</select>
		</td></tr>
		<tr><td colspan='5' align='center'><font color='red'><b>OR</b></font></td></tr>
		<tr>
		<td>SR Number </td>
		<td align='center'><input type='text' name='student_id' value=""></td>
		<td><font color='red'><b>&nbsp;&nbsp;OR&nbsp;&nbsp;</b></font></td>
		<td>Student Name </td>
		<td align='center'><input type='text' name='studfname' value=""></td>
		</tr>
	</table><br>
	<div align='center'>
	<td ><input type="submit" class='bgbutton' value="Submit" name="studdet" OnClick=" return send()"></td>
	</div>
	<table align=center border=0>
	</form>
	<?php
}
else
{
	?>
	<td><b>NO STUDENT DATA ...!! </td>
	<?php
}
?>
</body>
</html>