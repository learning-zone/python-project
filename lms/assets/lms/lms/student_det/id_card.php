<?php
session_start();
include("../db.php");
?>
<html>
<head>
<title>Student details Modify form</title>
</head>

<body>
<script LANGUAGE="JavaScript">
function reload()
{
	document.frm1.action='id_card.php';
	document.frm1.submit();
}
/*function send()
	{
		document.frm.action='modify_stud_det.php';
		document.frm.submit();
	} */
</script>

<?php

if(!$_POST and !$_REQUEST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
}
else
{
	$branch=$_POST[branch];
	$sem=$_POST[sem];
	$app_no=$_POST[app_no];
	$studfname=$_POST[studfname];
}
$rs = execute("SELECT * FROM student_m");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' action="id_card1.php" name="frm1" >

    <table class='forumline' align='center' width="90%" ><tr><td Class="Head" colspan='7' align='center'>Search Student List</td></tr>
    
	<tr height='30'>
		<td><?php echo $_SESSION['branchname']; ?></td>
		<td><select name="branch" onChange="reload()">
			<option value="0">---------------Select---------------</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=mysql_fetch_array($rs);

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
			<td><?php echo $_SESSION['semname']; ?></td>
		<td><select name="sem">
			<option value='0'>----------Select---------</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
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

		</td>
	</tr>
	<tr height='30'>
		<td>Student Id :</td>
		<td><input type='text' name='app_no' value=""></td>
		<td>Student Name :</td>
		<td ><input type='text' name='studfname' value=""></td></tr>
	</table><br>
	<div align=center>
	<input type="submit" class='bgbutton' value="Submit" name="studdet">
	</div>
	</form>
	<?php
}
else
{
	?>
	<td>No studentid Record</td>
	<?php
}
?>
</body>
</html>