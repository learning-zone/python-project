<html>
<head>
<Script language="JavaScript">
function RefreshMe(val)
	{
		document.MyFrm.action="assessment.php";
		document.MyFrm.submit();
	}
	</script>
    <script>
function goBack()
  {
  window.history.back()
  }
</script></head>
<body>   
<?php
session_start();
include("../db.php");

$accyeardet=$_SESSION['AcademicYear'];

if($_POST)
{
		$filetype=$_POST['filetype'];
		$priority=$_POST['priority'];
		$type=$_POST['type'];
		$description=$_POST['description'];
}
if($_GET)
{
		  $title_id=$_REQUEST['title_id'];
		  $subject=$_REQUEST['subject'];
		  $unit=$_REQUEST['unit'];
		  $filename=$_REQUEST['filename'];
		  $title_id=$_REQUEST['title_id'];
		  $menu=$_REQUEST['menu'];
		  $course=$_REQUEST['course'];
		  $sem=$_REQUEST['sem'];
		  $class_section_id=$_REQUEST['class_section_id'];
}


?>
<form method="post" name="MyFrm">
<input type="hidden" name="class_section_id" value="<?=$class_section_id?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<p><input type="button"  class="bgbutton" value="Back" onClick="goBack()">
</p>
<table border="0" cellspacing="0" align='left' height="600" cellpadding="0" >
<tr>
<td valign="top" background="../bgy.png">
<table border="0" align='left' width='230' cellpadding="5">
<?
//title name
$title_name=execute("select unit_name from lms_units where id='$unit'");
$title_name1=fetcharray($title_name);
?>
<tr>
	<td align='center' class="head" colspan="2"><?=$title_name1[0]?></td>
</tr>
<tr>

<?
$menutype=execute("SELECT type FROM `lms_units` where id='$unit'");
while($menutype1=fetcharray($menutype))
{
	
	if($menutype1[0]=='1')
	{
		?>
		<tr>
			<td align='left' class='rowpic' nowrap>&nbsp;&nbsp;
				<a href= "assessment.php?path=OnlineAss/declare_exam.php&unit=<?=$unit?>&title_id=<?=$title_id?>&subject=<?=$subject?>&course=<?=$course?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>"><b>Declare Quiz</b></a>
			</td>
		</tr>
		
		<tr>
			<td align='left'  class='rowpic' nowrap>&nbsp;&nbsp;
				<a href= "assessment.php?path=OnlineAss/add_questions.php&unit=<?=$unit?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$type?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>"><b>Add Quiz Question</b></a>
			</td>
		</tr>
		
	<?
	}
	?>
</table>
</td>
<td>    
<?php
	if($_GET['path'])
	{
		$unit=$_GET['unit'];
		$path=$_GET['path'];
		?>
		<iframe width="900" height="600" src="<?=$path?>?unit=<?=$unit?>&subtitle_id=<?=$subtitle_id?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$type?>&course=<?=$course?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>"></iframe>
		<?
	}	
	

	
}

?>		
    </td></tr></table> 
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="title_id" value="<?=$title_id?>">
<input type="hidden" name="class_section_id" value="<?=$class_section_id?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="course" value="<?=$course?>">  

</form>
</body>
</html>
