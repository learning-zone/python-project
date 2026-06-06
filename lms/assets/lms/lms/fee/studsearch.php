<html>
<head>
<?php
session_start();
include("../db.php");
include("../urlaccess.php");
?>


<script LANGUAGE="JavaScript">
function send()
{
	if(document.frm.studfname.value=='' && document.frm.student_id.value=='' && document.frm.sem.value==0)
	{
		alert ("Enter Student ID or Name or Semester Details ... ");
		return false;
	}

	if(document.frm.tmid.value=='')
	{
		alert ("Select Installment ... ");
		return false;
	}
	document.frm.action='mod2.php';
	document.frm.submit();
}
function frm_reload()
{
	document.frm.action='studsearch.php';
	document.frm.submit();
} 
</script>
</head>
<body>
<form method='post' action="mod2.php" name="frm" >

<table class='forumline' align='center' width='60%'><tr><td Class="Head" colspan='5' align='center'>Search Student Detials</td></tr>

<tr>
<td>&nbsp;&nbsp;Curriculam</td>
	<td>
		<select name="branch" onchange='frm_reload()'>
		<option value="0">---- Select ----</option>
			<?php
			$sql1=("insert into fee_payment(duedate) values ('$duedate')");
			$insidd=fetchInsertId();
				$sql="select course_id,coursename from course_m order by head_id,coursename";
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
		<td>&nbsp;&nbsp;Semester</td>
	<td><select name="sem">
		<option value='0'>------ Select -----</option>
		<?php
			$rs1=execute("select * from course_m where course_id=$branch");
			$hdid=fetcharray($rs1);
			$hd_id=$hdid[head_id];
			$rs=execute("SELECT year_name,year_id FROM course_year where head_id='$hd_id'");
			while($r=fetcharray($rs))
			{
				if($sem==$r[year_id])
				{
					echo "<option value='$r[year_id]' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
				}
				else
				{
					echo "<option value='$r[year_id]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
				}
			}
		?>
		</select>
	</td></tr>
		<tr><td colspan='5' align='center'><font color='red'><b>OR</b></font></td></tr>
	<tr>
	<td >&nbsp;&nbsp;Student ID</td>
	<td><input type='text' name='student_id' value=""></td>
	<td><font color='red'><b>&nbsp;&nbsp;OR&nbsp;&nbsp;</b></font></td>
	<td nowrap>&nbsp;&nbsp;Student Name</td>
	<td align='center'><input type='text' name='studfname' value=""></td>
	<tr><td colspan='5' align='center'><font color='red'><b>AND</b></font></td></tr>
  <tr> 
    <td align='right'>Installment&nbsp;&nbsp;</td>
    <td colspan='2'><select name='tmid'>
        <option value="">-- Select --</option>
        <option value="1">First</option>
        <option value="2">Second</option>
        <option value="3">Third</option>
      </select></td>
    <?php
	$cdt1=date("d");
	$cmt1=date("m");
	$cyr1=date("Y");
	?>
    <td align="center">Due Date:</td>
    <?php
	echo "<td nowrap ><select name='cdt1'>";
for($i=1;$i<=31;$i++)
{
	if($i<10)
	{
		$i='0'.$i;
	}
	if($i == $cdt1)
		echo "<option value='$i'selected >$i</option>";
	else
		echo "<option value='$i'>$i</option>";
}
echo "</select>";
//Month
echo "<select name='cmt1'>";
for($i=1;$i<=12;$i++)
{
	if($i == $cmt1)
		echo "<option value='$i' selected>" . date('M',mktime(0,0,0,$i)). "</option>";
	else
		echo "<option value='$i'>" .date('M',mktime(0,0,0,$i)). "</option>";
}
echo "</select>";
//Year
$maxYr =$cyr1+3;
$minYr =$cyr1-3;
echo "<select name='cyr1'>";
for($i=$minYr;$i<=$maxYr;$i++)
{
	
	if($i == $cyr1)
		echo "<option value='$i'selected>$i</option>\n";
	else
		echo "<option value='$i' >$i</option>\n";
}
echo "</select></td></tr></table>";
?>
    <br>
    <div align='center'> 
      <td ><input type="submit" class='bgbutton' value="Submit" name="studdet" OnClick="return send()"></td>
    </div>
</form>
</body>
</html>