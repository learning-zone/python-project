<html>
<HEAD>
<?php
session_start();
require("../db.php");
?>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='Marks_Attendance3.php';
	document.frm.submit();
}
function htmrpt()
{
	if(document.frm.branch.value =="" || document.frm.sem.value =="" || document.frm.examname.value =="" || document.frm.class_section_id.value =="")
	{
		alert("Please select all details...");
		return false;
	}
	document.frm.action="Marks_Attendance_3.php";
	document.frm.submit();
}
function excelrpt()
{
	if(document.frm.branch.value =="" || document.frm.sem.value =="" || document.frm.examname.value =="" || document.frm.class_section_id.value =="")
	{
		alert("Please select all details...");
		return false;
	}
	document.frm.action="Marks_Attendance_33.php";
	document.frm.submit();
}
</SCRIPT>
</HEAD>
<body>
<form name="frm" method="post" >
<div id=pr2 align=center><table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Marks Check List</td>
    </tr>
     
  <tr height='25'>
    <td>&nbsp;School Division:</td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="">------Select-----</option>
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
		
  </tr>
  <tr height='25'>
   <td>&nbsp;Class :</td>
		<td>&nbsp;<select name="sem" onChange="reload()">
			<option value=''>-----Select----</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected> $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'> $r[year_name]</option>";
					}
				}
			?>
			</select>

		</td>
  </tr>
   <tr height='25'>
    <td>&nbsp;Select Exam</td>
  <?php
  
$accyear=date("Y");
if(date('m')<6)
$accyear++;
$rs_ec=execute("select id,exam_name from exam_m where accyear='$accyear' and curriculam='$branch' and class='$sem'");
?>
    <td>&nbsp;<select name='examname'>
<?
echo "<option value=''>--Select--</option>";
for($i=0;$i<rowcount($rs_ec);$i++)
{
	$r_sec=fetcharray($rs_ec,$i);
	if($r_sec['id']==$examname)
	echo "<option value='$r_sec[id]' selected>$r_sec[exam_name]</option>";
	else
	echo "<option value='$r_sec[id]'>$r_sec[exam_name]</option>";
}
?>
</select></td>
  </tr>
  <tr height='25'>
  <td height="28">&nbsp;Section</td><td>&nbsp;<select name='class_section_id'">
<?
$rs_section=execute("select * from class_section");
echo "<option value=''>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($class_section_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

}
?>
</select>
</td>
  </tr>
</table>
  </div><br>
  <div align='center'><input type='button' name='htmlrpt' value='HTML Report' class='bgbutton' onclick='htmrpt()'>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='button' name='exlrpt' value='EXCEL Report' class='bgbutton' onclick='excelrpt()'>
</div>				
</form>	
</body>
</html>