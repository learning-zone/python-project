<html>
<head>
<?php 
session_start();
include("../db.php");
?>
<script language='javascript'>
function reload()
{
	document.tempfrm.action='update_usn.php';
	document.tempfrm.submit();
}
function sendME()
{
	document.tempfrm.action='updt_usn.php';
	document.tempfrm.submit();
}
</script>
</head>
<body class='bodyline' >
<form method='post' name='tempfrm'>
<table align='center' class='forumline'>
<tr><td colspan='4' align='center' class='head'>UPDATE STUDENT USN</td></tr>
	<tr>
		<td nowrap>&nbsp;&nbsp;Course : </td>
		<td><select name='branch' onchange="reload()">
			<option value='0'> Select Course</option>
			<?php
			$res  = mysql_query("select * from course_m where status=1 order by head_id");
			$num = mysql_num_rows($res);
				for($i=1;$i<=$num;$i++)
				{
					$row123 = mysql_fetch_array($res);
					if($row123[course_id]==$branch)
					{
						echo "<option value='$row123[course_id]' selected>$row123[coursename]</option>";
					}
					else
					{
						echo "<option value='$row123[course_id]'>$row123[coursename]</option>";
					}
				}
			?>
			</select></td>
		<td nowrap>&nbsp;&nbsp;Semester : </td>
		<td><select name='sem' onchange="reload()">
			<option value='0'> Select Semester</option>
			<?php
			$res1  = mysql_query("select a.* from course_year a,course_m b where a.status=1 and a.head_id=b.head_id and b.course_id='$branch'");
			$num1 = mysql_num_rows($res1);
				for($i=1;$i<=$num1;$i++)
				{
					$row123 = mysql_fetch_array($res1);
					if($row123[year_id]==$sem)
					{
						echo "<option value='$row123[year_id]' selected>$row123[year_name]</option>";
					}
					else
					{
						echo "<option value='$row123[year_id]'>$row123[year_name]</option>";
					}
				}
			?>
			</select></td>
	</tr>	
</table>	
<br>
<?php
if($msg==1)
echo "<div><font color='brown'><b>Updated USN details..</b></font></div><br>";
if($branch!='0' && $sem!='0' && $branch!='' && $sem!='')
{
	$var = "select id,student_id,usn,first_name,last_name from student_m where course_admitted='$branch' and course_yearsem='$sem' and archive='N' order by first_name";
	?>
	 <table align='center' border=1 class='forumline' width='70%' cellspacing='1' cellpadding='1'>
		<tr height='30'>
		<td align='center' class='head' nowrap>Sl No</td>
			<td align='center' class='head' nowrap>Student Name</td>
			<td align='center' class='head' nowrap>Student ID</td>
			<td align='center' class='head'>USN</td>
		</tr>		
		<?php
		$res = mysql_query($var);
	$sno=1;
		while($row = mysql_fetch_array($res))
		{
			if($sno<10)
				$sno="0".$sno;
			?>
			<input type='hidden' name='s_id[]' value='<?php echo $row[id] ?>'>
			<tr><td align="center"><?php echo $sno ?></td>
				<td >&nbsp;&nbsp;<?php echo $row[first_name] ?> <?php echo $row[last_name] ?></td>
				<td align='center'>&nbsp;&nbsp;<?php echo $row[student_id] ?></td>
				<td align='center'>
					<input type='text' name='usn<?php echo $row[id] ?>' value='<?php echo $row[usn]?>'>
				</td>
			</tr>
			<?php
				$sno++;
		}
?>
</table><br>
<center>
	<input type='button' name='saveme' value=' UPDATE ' onclick='sendME()'>
</center>
<?php
}
?>
</form>
</body>
</html>
