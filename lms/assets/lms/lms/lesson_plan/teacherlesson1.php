<?php
session_start();
include("../db.php");

	$accyeardet=$_SESSION['AcademicYear'];
	$unit=$_REQUEST['unit'];
	$title_id=$_REQUEST['title_id'];
	$filename=$_REQUEST['filename'];
	$subject=$_REQUEST['subject'];
	$uploadedfile=$_POST['uploadedfile'];
	$filetype=$_POST['filetype'];
	$priority=$_POST['priority'];
	$title=$_POST['title'];
	$type=$_POST['type'];
	$description1=$_POST['description1'];
	$sub_title=$_POST['sub_title'];
	$action=$_REQUEST['action'];
	$id=$_REQUEST['id'];

?>

<!--content end-->

<body class="samplebody">

<form class="new1" action="output_html.php" method="post" ENCTYPE="multipart/form-data">
<?php


echo "
<input type='hidden' name='id' value='$id'>
<input type='hidden' name='title_id' value='$title_id'>
<input type='hidden' name='subject' value='$subject'>
<input type='hidden' name='titlename' value='$title_id'>
<input type='hidden' name='unit' value='$unit'>";


?>

<?
//title name
$title_name=execute("select title_a from lms_title where id='$title_id' and sub='$subject'");
$title_name1=fetcharray($title_name);
?>

<?
//unit name

$unit_name=execute("select unit_name from lms_units where id='$unit'");
$unit_name1=fetcharray($unit_name);
?>

<table align="left" width="30%" border="0" cellspacing="0" cellpadding="5">
<tr>
    <td align="center" class="head"><?=$title_name1[0]?></td>
</tr> 

<tr>
    <td align="center" class="rowpic" ><b><?=$unit_name1[0]?></b></td>
</tr> 

</table>
<br>
<br>
<br>
<br>
<table align="left" width="30%" border="1" cellspacing="0" cellpadding="10">
<tr><td align='center' class="head" colspan="2">Title</td></tr>

<?
//lesson master title
$s=1;
$lesson_name=execute("select sub_title,id from lms_lesson_master where title_id='$title_id' and sub='$subject' and unit_id ='$unit' and status=1");
while($lesson_name1=fetcharray($lesson_name))
{
	
?>

	<tr>
    <td align='center'><b><?=$s?></b></td>
    <td align="left" >&nbsp;&nbsp;&nbsp;&nbsp;<a href="teachmodify.php?unit=<?=$unit?>&title_id=<?=$title_id?>&subtitle_id=<?=$lesson_name1[1]?>&subject=<?=$subject?>"><b><?=$lesson_name1[0]?></b></a>
    </td>
    </tr> 
<?
$s++;
}
?>


</table>

</form>
</body>
</html>
