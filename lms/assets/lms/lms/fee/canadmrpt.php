<?php
session_start();
include("../db.php");
?>
<html>
<head><LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<title>Admission Cancelled Report</title>
</head>
<body>
<script LANGUAGE="JavaScript">
function send()
{
	if(document.frm.sem.value==0)
	{
		alert ("Select Details...");
		return false;
	}
	document.frm.action='canadmrpt1.php';
	document.frm.submit();
}
function frm_reload()
{
	document.frm.action='canadmrpt.php';
	document.frm.submit();
} 
</script>
<?php
$rs = execute("SELECT * FROM student_m");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form name="frm" method='post'>
	<center>
    <table class='forumline' align='center' ><tr><td Class="Head" colspan='2' align='center'>Cancelled Admission Report</td></tr>
    </center>
	<tr height='30'>
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
		</td></tr>
			<tr height='30'><td >Semester </td>
		<td><select name="sem">
			<option value='0'>--------Select-------</option>
			<?php
				$rs1=execute("select * from course_m where course_id=$branch");
				$hdid=fetcharray($rs1);
				$hd_id=$hdid[head_id];
				$rs=execute("SELECT year_name,year_id FROM course_year where head_id='$hd_id'");
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
		</td></tr>
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