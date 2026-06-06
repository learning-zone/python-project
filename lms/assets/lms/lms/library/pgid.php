<?php
session_start();
include("../db.php");
?>
<html>
<body>
<?php
$rs = execute("SELECT * FROM student_m");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' action="pgid1.php" name="frm1" >
    <table class='forumline' align='center'>
		<tr>
			<td Class="Head" colspan='7' align='center'>Search Student Detials</td>
		</tr>
		<tr>
			<td>Application No:</td>
			<td><input type='text' name='app_no' value=""></td>
			<td>Branch:</td>
			<td><select name="branch" >
				<option value="0">---------------Select---------------</option>
					<?php
						$sql="select course_id,coursename,head_id from course_m where head_id='2'";
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
		</tr>
		<tr>
			<td>USN:</td>
			<td><input type='text' name='un' value=""></td>
			<td>Semester:</td>
			<td><select name="sem">
				<option value='0'>----------Select---------</option>
				<?php
					$rs=execute("SELECT year_name,year_id,head_id FROM course_year where head_id='2' order by year_id");
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
	<tr>
		<td>Student First Name:</td>
		<td><input type='text' name='studfname' value=""></td>
		<td>Academic Year</td>
		<td><select name="a_year" >
			<option value='0'> select academic year</option>
			<?php
				   $MyYear=date('Y')-5;
				   $CurrentYr=date("Y")+5;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($mod2[i]==date('Y'))
							$sele="selected";
					  ?>
						 <option value="<?=$i?>" <?=$sele?>><?=$Fyear?>-<?=$Tyear?></option>
						<?php
					}
		   ?>
		  </select>
		</td>
	</tr>
</table>
<div align='center'><td><input type="submit" class='bgbutton' value="Submit" name="studdet"></td></div>
<table align=center border=0>
	<tr><td><u> Note:</u></td><td>Enter or select any one from above or all</td></tr>
</table>
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