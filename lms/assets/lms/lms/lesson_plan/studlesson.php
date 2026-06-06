<html>
<head>
<Script language="JavaScript">
function RefreshMe(val)
	{
		document.MyFrm.action="studlesson.php";
		document.MyFrm.submit();
	}
	</script>
    <script>
function goBack()
  {
  window.history.back()
  }
</script>
    
    
    
<?php
session_start();
include("../db.php");

$accyeardet=$_SESSION['AcademicYear'];


$title_id=$_REQUEST['title_id'];
$subject=$_REQUEST['subject'];

$unit=$_REQUEST['unit'];
$filetype=$_POST['filetype'];
$filename=$_REQUEST['filename'];
$priority=$_POST['priority'];
$title=$_POST['title'];
$type=$_POST['type'];
$description=$_POST['description'];
$menu=$_REQUEST['menu'];
$class_section_id=$_REQUEST['class_section_id'];
$sem=$_REQUEST['sem'];
$course=$_REQUEST['course'];
?>
<form method="post" name="MyFrm">
<input type="hidden" name="title_id" value="<?=$title_id?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="class_section_id" value="<?=$class_section_id?>">
<input type="hidden" name="type" value="<?=$type?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="course" value="<?=$course?>">
<p><input type="button"  class="bgbutton" value="Back" onClick="goBack()">
</p>
<table border="0" cellspacing="0" align='left' height="600" cellpadding="0" >
<tr>
<td valign="top" background="../bgy.png">
<table border="0" align='left' width='230' cellpadding="5">
<?
//title name
$title_name=execute("select title_a from lms_title where id='$title_id' and sub='$subject'");
$title_name1=fetcharray($title_name);
?>
<tr>
	<td align='center' class="head" colspan="2"><?=$title_name1[0]?></td>
</tr>

<tr>
	<td align='center' class='head' colspan="2" >Menu</td>
</tr>
<tr>
<td align="center" colspan="2" class="rowpic"><select name="menu" onChange="RefreshMe(0)">
	<option value="0">--------------Select-------------</option>
<?php

	echo $sql3=execute("select DISTINCT a.id, unit_name,b.unit_id as unit_id from lms_units  a INNER JOIN lms_lesson_master b ON a.id=b.unit_id where b.status=1 order by a.posi");
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[0]==$menu)
		{
			echo "<option value=$r3[0] selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value=$r3[0]>$r3[1]</option>";
		}
	}
?>
</select>
</td>
</tr>
<tr>

<?
$menutype=execute("SELECT type FROM `lms_units` where id='$menu'");
while($menutype1=fetcharray($menutype))
	{

?>

<?php

	 if($menutype1[0]=='0')
	{ 
	 
	?>
       
  <?
//lesson master title
		$s=1;
		$lesson_name=execute("select sub_title,id from lms_lesson_master where title_id='$title_id' and sub='$subject' and unit_id ='$menu' and status=1");
		while($lesson_name1=fetcharray($lesson_name))
		{
			?>
			
			<td align='center' background="../bg4.png"><b><?=$s?></b></td>
			<td align="left" background="../bg4.png">&nbsp;&nbsp;&nbsp;&nbsp;<a href="studlesson.php?unit=<?=$menu?>&menu=<?=$menu?>&title_id=<?=$title_id?>&subtitle_id=<?=$lesson_name1[1]?>&subject=<?=$subject?>"><b><?=$lesson_name1[0]?></b></a>
			</td></tr>
			<?
            $s++;
		}
		?>  
		
		<?
	}
	?>
   
</table>
</td>
<td>    
    <?php
		if($_GET['unit'])
		{
			$unit=$_GET['unit'];
			$subtitle_id=$_GET['subtitle_id'];
			?>
			<iframe width="900" height="600" src="studmodify.php?unit=<?=$unit?>&subtitle_id=<?=$subtitle_id?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$menutype1[0]?>"></iframe>
			<?
		}	
	
		if($menutype1[0]=='2')
		{
		
			?>
			<iframe width="900" height="600" src="studlist.php?unit=<?=$menu?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$menutype1[0]?>"></iframe>
			<?
		}
		
		if($menutype1[0]=='1')
		{

?>
<iframe width="900" height="600" src="OnlineAss/teach_add_questions.php?unit=<?=$menu?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$menutype1[0]?>&subject=<?=$subject?>&course=<?=$course?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>">
</iframe>
			<?
		}
		if($menutype1[0]=='3')
		{
			?>
			<div align="right">
			<iframe width="900" height="600" src="studintroview.php?unit=<?=$menu?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$menutype1[0]?>">
			</iframe></div>
			<?
		}
	}

?>		
    </td></tr></table>   

</form>
</body>
</html>
