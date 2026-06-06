<html>
<head>

<?php
session_start();
include("../db.php");

$accyeardet=$_SESSION['AcademicYear'];
$unit=$_REQUEST['unit'];
$title_id=$_REQUEST['title_id'];
$filetype=$_POST['filetype'];
$filename=$_REQUEST['filename'];
$subject=$_REQUEST['subject'];
$priority=$_POST['priority'];
$title=$_POST['title'];
$type=$_POST['type'];
$description=$_POST['description'];
?>
<br>
<table border="1" align='left' width='20%' cellpadding="5">
<?
//title name
$title_name=execute("select title_a from lms_title where id='$title_id' and sub='$subject'");
$title_name1=fetcharray($title_name);
?>
<tr><td align='center' class="rowpic"><h1><?=$title_name1[0]?></h1></td></tr>
</table>
<br>
<br>
<br>
<table border="1" align='left' width='20%' cellpadding="5">
<tr><td align='center' class='head' nowrap>Assessment</td></tr>

<tr>
<td align='left' class='rowpic' nowrap>&nbsp;&nbsp;<a href= "OnlineAss/online_assessment.php?unit=<?=$unit1[0]?>&title_id=<?=$title_id?>&subject=<?=$subject?>&type=<?=$unit1[2]?>"><b>Assessment</b></a></td>
</tr>

<tr><td align='center'  class='rowpic' nowrap>Add Question</td></tr>
<tr><td align='center'  class='rowpic' nowrap>Evaluvate</td></tr>
 </table></form>
</body>
</html>
