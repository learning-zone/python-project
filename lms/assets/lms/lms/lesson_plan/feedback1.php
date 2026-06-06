<html>
<head>
<?php
session_start();
include("../db.php");

$accyeardet=$_SESSION['AcademicYear'];
$unit=$_REQUEST['unit'];
$title_id=$_REQUEST['title_id'];
$subject=$_REQUEST['subject'];
$type=$_REQUEST['type'];
$comment=$_POST['comment'];
$complet=$_POST['complet'];
$student=$_POST['student'];

if(isset($_POST['save']))
{


		$feedb=execute("select id from lms_feedback where title_id='$title_id' and acc_year='$accyeardet' and unit_id='$unit' and sub='$subject' and type='$type' and status=1");
		if(rowcount($feedb)>0)
		{
			

			$fdbk="update lms_feedback set `comment`='".addslashes($comment)."',`complet`='$complet',`student`='$student' where acc_year='$accyeardet' and sub='$subject' and `unit_id`='$unit'";
			execute($fdbk);
		}
		else
		{
			$fedback="INSERT INTO lms_feedback(`comment`, `complet`,`acc_year`, `student`, `title_id`,`sub`,`unit_id`,`type`,`status`) VALUES( '".addslashes($comment)."','$complet','$accyeardet','$student','$title_id','$subject','$unit','$type',1)";
		}
	execute($fedback);
	

	
	?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php
		}

?>

</head>
<body>
<form name="frm" action="" method="post" ENCTYPE="multipart/form-data">

<?php
echo "	<input type='hidden' name='title_id' value='$title_id'>
		<input type='hidden' name='subject' value='$subject'>
		<input type='hidden' name='titlename' value='$title_id'>
		<input type='hidden' name='unit' value='$unit'>";
?>

<table align="center" width="70%" border="1" cellspacing="0" cellpadding="5">
<tr>
    <td align="center" class="head" colspan="2">Feedback</td>
</tr> 
 <?php
  
$feedcommt=execute( "select * from lms_feedback where unit_id='$unit' and sub='$subject' and type='$type' and acc_year='$accyeardet' and type='$type' and status=1");
while($rk=fetcharray($feedcommt))
{
	$complet=$rk['complet'];
	$student=$rk['student'];
	$comment=$rk['comment'];
}		
?>
<?
		$complet1='';
		$complet2='';
		
		if($complet==1)
		$complet1='checked';
		if($complet==2)
		$complet2='checked';

?>
<tr>
<td align="left" nowrap>&nbsp;&nbsp;Completed</td>
<td align="left">&nbsp;&nbsp;Yes&nbsp;&nbsp;<input type='radio' name='complet' value="1" <?=$complet1?> />&nbsp;&nbsp;No&nbsp;&nbsp;<input type='radio' name='complet' value="2" <?=$complet2?>/></td>
</tr>
<tr>
<td nowrap>&nbsp;&nbsp;Comment</td>
<td align='center' colspan='10' >
	<textarea name='comment' rows='3' cols='70'><?php echo $comment; ?></textarea>
</td></tr>
<?
		$student1='';
		$student2='';
		
		if($student==1)
		$student1='checked';
		if($student==2)
		$student2='checked';

?>

<tr>
<td align="left">&nbsp;&nbsp;Allow Student To View</td>
<td align="left">&nbsp;&nbsp;Yes&nbsp;&nbsp;<input type='radio' name='student' value="1" <?=$student1?> />&nbsp;&nbsp;No&nbsp;&nbsp;<input type='radio' name='student' value="2" <?=$student2?> /></td>
</tr>
</table>
    <br>
 <div align="center">
<input type="submit" name="save" value="Save" class="bgbutton"></div></form>
</body>
</html>
