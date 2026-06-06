<?php
session_start();
include("../db.php");

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
	$id=$_REQUEST['id'];

?>

<!--content end-->

<body class="samplebody">

<form  action="studintroview.php" method="post">
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
<table align="center" width="100%" border="1" cellspacing="0" cellpadding="5">
<tr>
    <td align="center" class="head" colspan="2"><?=$title_name1[0]?></td>
</tr> 
<?php
$master=execute("select img_source,description,sub_title,summary,file_type from lms_lesson_master where unit_id='$unit' and title_id='$title_id' and sub='$subject' and status=1");
while($master1=fetcharray($master))
{ 
	
	?>
	<div align="center">
	
	<?
    if($master1[4]==4 || $master1[4]==5)
    {
		if($master1[0])
		{
			$master4=$master1[0];
			$img_path=explode("/", $master4);
			$img_path=$img_path[1];
			
		?>
		
		   <iframe src="http://docs.google.com/gview?url=http://demo.myschoolone.com/renew/lesson_plan/ckeditor/_samples/lmsintroduction/<?=$img_path?>&embedded=true" style="width:900px; height:600px;" frameborder="0"></iframe>
        <?
		}
    }
	else
  	{
		if($master1[0])
		{
			$master4=$master1[0];
			$img_path=explode("/", $master4);
			$img_path=$img_path[1];	
		?>
		    <iframe src="http://demo.myschoolone.com/renew/lesson_plan/ckeditor/_samples/lmsintroduction/<?=$img_path?>" style="width:900px; height:600px;" frameborder="0"></iframe>
        <?
		}
    }
?>

	</div>
	<br>
	
	<tr><td align='center' class="rowpic"><?=$master1[2]?>
    </td></tr>
    <tr><td align='left'><?=$master1[1]?></td></tr>

	<?
	if($master1[summary]!='')
	{
		?><tr height="20"><td align='center' style="background:none;" >&nbsp;</td></tr>
		<tr><td align='center' class='head'>Summary</td></tr>
        <tr><td align='left'><?=$master1[summary]?></td></tr>
    	<?php
	}
}
?>
</table>
<br>
	<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;
<a href= "ckeditor/_samples/lmsintroduction/download.php?img_path=<?=$img_path?>"><input type='button' align='center' class='bgbutton' value='download'></a></div>
</div>
</table>
</form>
</body>
</html>
