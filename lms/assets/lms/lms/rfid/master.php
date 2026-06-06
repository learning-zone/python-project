 <?php
	session_start();
	include("../db.php");
	$val=$_GET['val'];
	if($_GET['val'])
	{
		$val1=explode(',',$val)	;
		$sem=$val1[0];
		$branch=$val1[1];
		$programe=$val1[2];
		$class_section_id=$val1[3];
		$batch=$val1[4];
		$sports=$val1[5];
		$level=$val1[6];

	}
	else
	{
		$sem=$_REQUEST['sem'];
		$branch=$_REQUEST['branch'];
		$programe=$_REQUEST['programe'];
		$class_section_id=$_REQUEST['class_section_id'];
		$batch=$_REQUEST['batch'];
		$sports=$_REQUEST['sports'];
		$level=$_REQUEST['level'];
	}
function weekname($mon)
{
	if($mon == 1) return("MON");
	if($mon == 2) return("TUE");
	if($mon == 3) return("WED");
	if($mon == 4) return("THU");
	if($mon == 5) return("FRI");
	if($mon == 6) return("SAT");
}


$dis=fetcharray(execute("select coursename from course_m where course_id='$branch'"));
$batch1=fetcharray(execute("SELECT batch_name FROM batch_master where id='$batch'"));
$sports1=fetcharray(execute("select name from staff_group where id='$sports'"));
$level1=fetcharray(execute("select subtype_name from subjecttype where subtype_id='$level'"));

?>
<TABLE ALIGN='center' CLASS="forumline" width='100%' CELLPADDING="0" CELLSPACING="0" BORDER="1">

<tr>
<td align='center' width="" class="head">Type</td>
<td align='center' width="" class="head">Reader IP</td>
<td align='center' width="" class="head">Turnstile ID</td>
<td align='center' width="" class="head">Description</td>
</tr>
<tr>
<td align='center' ><select name="time">
<?php

	$rs2=execute("SELECT * FROM `rfid_masters` where status='1' order by name ");
	while($r=fetcharray($rs2))
	{
		echo "<option value='$r[0]' title='$r[2]'>$r[1]</option>";
	}
?></select>
</td>
<td align='center' ><input name="readerip" value="" />
</td>
<td align='center' ><select name="turnstile">
<option value="0">Select</option>
<?php
for($i=1;$i<25;$i++)
{
	echo "<option value='$i'>$i</option>";
}
?>
</select></td>
<td align='center' ><textarea name="desc"></textarea>
</td></TABLE>
