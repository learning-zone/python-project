<html>

<head>

<Script language="JavaScript">

function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}


</script>

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
	$class_section_id=$_REQUEST['class_section_id'];
	$sem=$_REQUEST['sem'];
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
<input type='hidden' name='unit' value='$unit'>
<input type='hidden' name='sem' value='$sem'>
<input type='hidden' name='class_section_id' value='$class_section_id'>";

?>
<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;
<a href= "javascript:OpenWind2('teacherlesson.php?title_id=<?=$title_id?>&subject=<?=$subject?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>')"><input type='button' align='center' class='bgbutton' value='Menu'></a></div>
<br>
 <?php
	$titleimages=execute("SELECT titleimage FROM `lms_title` where id='$title_id'");
	while($titleimages1=fetcharray($titleimages))
{
	
?>
 <div align="center">
 <?
    if($titleimages1[0]!='')
    {
			$titleimages1=$titleimages1[0];
			$img_path=explode("/", $titleimages1);
			$nameimage=$img_path[1];
		?>
		
		    <iframe src="http://mbis.myschoolone.com/renew/lesson_plan/menuimage/<?=$nameimage?>"style="width:900px; height:600px;" frameborder="0"></iframe>
        <?
    }
}
?>
<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;
<a href= "menuimage/download.php?img_path=<?=$nameimage?>"><input type='button' align='center' class='bgbutton' value='download'></a></div>

</div>
</form>
</body>
</html>
