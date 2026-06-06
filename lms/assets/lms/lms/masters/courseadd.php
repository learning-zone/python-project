<?php
session_start();
require("../db.php");
?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">
function activate()
{
	document.changestatus.action="AlterCourse.php?Types=Act";
	document.changestatus.submit();
}
function EditClick()
{
	document.form1.action="AlterCourse.php?Types=Mod";
	document.form1.submit();
}
function DeleteClick()
{
	document.form1.action="AlterCourse.php?Types=Del";
	document.form1.submit();
}
</script></head>
<body  Class="bodyline">
<?php
$query = "SELECT *  FROM course_m where status=1";
$rs = execute($query);
$row=rowcount($rs);
if($row)
{
	?>
	<form method="post" id="form1" name="form1">
    <br>
	<table class='forumline' align=center width="90%" border="1">
	<tr><td Class="head" colspan=3 align=center>Information Center Details</td></tr>
	<tr><td class="row3" width="10%">Select</td>
	<td class="row3" align="center">Information Center Name</td>
	<td class="row3" align="center">Information Center Code</td></tr>
	<?php
	for($i=0;$i<$row;$i++)
	{
		$r = fetchrow($rs);
		$exe=execute("select * from course_m where course_id='$r[0]'");
		
		$exe1=fetcharray($exe);
		if($i%2)
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
		?><td class="CBody" align="center"><input type="checkbox" name="cid[]" Value="<?=$r[0]?>"></td>
		<?
		if($r[0])
		{
			?>
			<td  align="center" class="CBody"><input type="text" size=40 name="CName<?=$r[0]?>" value="<?=$r[1]?>"></td>
			<td class="CBody" align="center"><input type="text" size="10" name="Cabbr<?=$r[0]?>" value="<?=$r[2]?>" ></td>
		<?}?>
		<input type="hidden" size=8 name="Cintak<?=$r[0]?>" value="<?=$r[3]?>"></tr>
		<?php
	}
	?></table><br>
	<div align=center>
	<input type="button" onClick="EditClick()" value="Modify" class='bgbutton'>
	</div></form>
	<?php
}
else
{
	echo "<p align=\"left\"><b><font face=\"Arial\">No CI Division Details..</font></b></p>";
}
?>
<form Name="AddCourse" action="addcourse.php" method="GET">
<table class='forumline' width="90%" align=center>
<tr><td Class="head" colspan=2 align=center>Add Information Center Details</td></tr>
<tr><td class="rowpic" align=center>Information Center Name</td>
<td class="rowpic" align=center>Information Center Code</td>
</thead>
<tr><td class="CBody" align="center">
<input type="text" size="40" name="CourseName">
</td>
<td class="CBody" align="center">
<input type="text" size="10" name="CourseAbbr">
</td></tr></table><br>
<div align=center><input type="Submit" value="ADD" class='bgbutton'></div></form>

<?php
$sql = "SELECT course_id,coursename FROM course_m WHERE status=0";
$rs = execute($sql);

$num = rowcount($rs);

if($num){
?>

<div align="left">

  <form name="changestatus" method="post" action="alterfeetype.php">
  <table border="0" cellspacing="1" width="300" class='forumline'>
    <tr>
      <td width="20%" colspan="2" class='head'><b>Deleted
        Course Types</b></td></tr>
    <tr>
      <td width="20%" class="rowpic"><b>Select</b></td>
      <td class="rowpic"><b>Course Name</b></td></tr>

<?php
	for($i=0;$i<$num;$i++){
		$rsdf = fetcharray($rs,$i);
?>

    <tr>
      <td width="20%" class="cbody"><input type="checkbox" name="cname[]" value="<?=$rsdf["course_id"]?>"></td>
      <td class="cbody"><?=$rsdf["coursename"]?> </td></tr>

<?php
	}

?>
    <tr>
      <td colspan="2" > <input type="button" onClick = "activate()" value="<< Activate >>" class='bgbutton'></td></tr></table></div>

<?php
}

?>
</form></body></html>
