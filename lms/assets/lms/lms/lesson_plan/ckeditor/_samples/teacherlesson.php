<html>

<head>

<Script language="JavaScript">

function RefreshMe(val)

	{

		document.MyFrm.action="teacherlesson.php";

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



?>

<form method="post" name="MyFrm">

<input type="hidden" name="title_id" value="<?=$title_id?>">

<input type="hidden" name="subject" value="<?=$subject?>">

<input type="hidden" name="type" value="<?=$type?>">

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

$title_name=mysql_query("select title_a from lms_title where id='$title_id' and sub='$subject'");

$title_name1=mysql_fetch_array($title_name);

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



	$sql3=execute("select DISTINCT a.id, unit_name,b.unit_id as unit_id from lms_units  a INNER JOIN lms_lesson_master b ON a.id=b.unit_id where b.status=1 order by a.posi");

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

$menutype=mysql_query("SELECT type FROM `lms_units` where id='$menu'");

while($menutype1=mysql_fetch_array($menutype))

{

	if($menutype1[0]=='0')

	{ 

		//lesson master title

		$s=1;

		$lesson_name=mysql_query("select sub_title,id from lms_lesson_master where title_id='$title_id' and sub='$subject' and unit_id ='$menu' and status=1");

		while($lesson_name1=mysql_fetch_array($lesson_name))

		{

			?>

			<td align='center' background="../bg4.png"><b><?=$s?></b></td>

			<td align="left" background="../bg4.png">&nbsp;&nbsp;&nbsp;&nbsp;<a href="ckeditor/_samples/teacherlesson.php?unit=<?=$menu?>&menu=<?=$menu?>&title_id=<?=$title_id?>&subtitle_id=<?=$lesson_name1[1]?>&subject=<?=$subject?>"><b><?=$lesson_name1[0]?></b></a>

			</td></tr>

			<?

			$s++;

		}



	}

	if($menutype1[0]=='1')

	{

		?>
		<tr>
			<td align='left'  class='rowpic' nowrap>&nbsp;&nbsp;
				<a href= "teacherlesson.php?path=OnlineAss/teach_add_questions.php&menu=<?=$menu?>&unit=<?=$unit1[0]?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$unit1[2]?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>"><b>Take Quiz</b></a>

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

		$subtitle_id=$_GET['subtitle_id'];

		$path=$_GET['path'];

		?>

		<iframe width="900" height="600" src="<?=$path?>?unit=<?=$unit?>&subtitle_id=<?=$subtitle_id?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$menutype1[0]?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>"></iframe>

		<?

	}	

	if($_GET['unit'])

	{

		$unit=$_GET['unit'];

		$subtitle_id=$_GET['subtitle_id'];

		?>

		<iframe width="900" height="600" src="ckeditor/_samples/teachmodify.php?unit=<?=$unit?>&subtitle_id=<?=$subtitle_id?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$menutype1[0]?>"></iframe>

		<?

	}	



	if($menutype1[0]=='2')

	{

		?>

		<iframe width="900" height="600" src="feedback1.php?unit=<?=$menu?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$menutype1[0]?>"></iframe>

		<?

	}

	

	if($menutype1[0]=='3')

	{

		?>

		<div align="right">

		<iframe width="900" height="600" src="introview.php?unit=<?=$menu?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$menutype1[0]?>">

		</iframe></div>

		<?

	}

}



?>		

    </td></tr></table>   



</form>

</body>

</html>

