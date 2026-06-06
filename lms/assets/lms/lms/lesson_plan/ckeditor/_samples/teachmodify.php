<?php
session_start();
include("../../../db.php");

	$accyeardet=$_SESSION['AcademicYear'];
	$unit=$_REQUEST['unit'];
	$title_id=$_REQUEST['title_id'];
	$filename=$_REQUEST['filename'];
	$subject=$_REQUEST['subject'];
	$subtitle_id=$_REQUEST['subtitle_id'];
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
$title_name=mysql_query("select title_a from lms_title where id='$title_id' and sub='$subject'");
$title_name1=mysql_fetch_array($title_name);
?>

<?
//unit name

$unit_name=mysql_query("select unit_name from lms_units where id='$unit'");
$unit_name1=mysql_fetch_array($unit_name);
?>

<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;
<a href= "teacherlesson1.php?unit=<?=$unit?>&title_id=<?=$title_id?>&subject=<?=$subject?>"><input type='button' align='center' class='bgbutton' value='Back'></a></div>
<br>

<table align="center" width="73%" border="1" cellspacing="0" cellpadding="5">
<tr>
    <td align="center" class="head" colspan="2"><?=$title_name1[0]?></td>
</tr> 
 <?php

echo "<input type='hidden' name='action' value='$action'>";
 
	$master=mysql_query("select img_source,description,sub_title,summary from lms_lesson_master where unit_id='$unit' and title_id='$title_id' and sub='$subject' and status=1 and id='$subtitle_id'");
	while($master1=mysql_fetch_array($master))
{
?>
 <div align="center">
 <?
    if($master1[0]!='')
    {
		
		$master1=$master1[0];
			$img_path=explode("/", $master1);
			$img_path=$img_path[1]; 
		?>
		    <iframe src="lmsintroduction/<?=$master1[0]?>&embedded=true" style="width:900px; height:600px;" frameborder="0"></iframe>
        <?
    }
?>
</div>
<tr><td align='center' class="rowpic"><?=$master1[2]?></td></tr>
</table>
<table align="center" width="73%" border="0" cellspacing="0" cellpadding="59">
<tr><td align='left'><?=$master1[1]?></td></tr>
</table>
<br>
<?
}

?>
<?

$masterudate=mysql_query("select summary from lms_lesson_master where unit_id='$unit' and title_id='$title_id' and sub='$subject' and status=1 and id='$subtitle_id'");

$summary=mysql_fetch_array(mysql_query("select summary from lms_lesson_master where unit_id='$unit' and title_id='$title_id' and sub='$subject' and status=1 and id='$subtitle_id'"));
if($summary[0]!='')
{

?>
<?
while($masterudate1=mysql_fetch_array($masterudate))	
{

?>
<table align="center" width="73%" border="0" cellspacing="0" cellpadding="0">
<tr><td align='center' class='head'>Summary</td></tr>
</table>
<table align="center" width="73%" border="0" cellspacing="0" cellpadding="59">
<tr><td align='left'><?=$masterudate1[0]?></td></tr>
</table>
<?
}
}
?>

<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;
<a href= "lmsintroduction/download.php?img_path=<?=$img_path?>"><input type='button' align='center' class='bgbutton' value='download'></a></div>
</div>

</table>
</form>
</body>
</html>
