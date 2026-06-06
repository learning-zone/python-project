<html>
<head>
<Script language="JavaScript">

function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=1200,height=600,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}
</script>
<?php
	session_start();
	include("../db.php");
	$accyear=$_SESSION['AcademicYear'];
//print_r($_GET);
if($_POST)
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$short_name=$_POST['short_name'];
	$subject=$_POST['subject'];
	$ename=$_POST['ename'];
	$adate=$_POST['adate'];
	$hh=$_POST['hh'];
	$type=$_POST['type'];
	$mm=$_POST['mm'];
	$ttime="$hh:$mm";

}
if($_GET)
{
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$class_section_id=$_REQUEST['class_section_id'];
	$unit=$_REQUEST['unit'];
	$title_id=$_REQUEST['title_id'];
	$subject=$_REQUEST['subject'];
	$type=$_REQUEST['type'];
}
	
?>
</head>
<body class='bodyline'>
<form method="post" name="frm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="type" value="<?=$type?>">
<input type="hidden" name="title_id" value="<?=$title_id?>">
<input type="hidden" name="class_section_id" value="<?=$class_section_id?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="course" value="<?=$course?>">
  <?php
$sql3=execute(" SELECT * FROM `online_assessment` where class_id='$sem' and acc_year='$accyear' and section_id='$class_section_id' and status=1");
if(rowcount($sql3)>=1)
{	
	?>
<table align='center' class='forumline' width='75%' border="1" >
<tr>
		<td align='center' class='head' nowrap>Sl.No</td>
		<td align='center' class='head' nowrap>Description</td>
<!--        <td align='center' class="head" nowrap>Type</td>
-->	  	<td align='center' class="head" nowrap>Submission Date</td>
	  	<td align='center' class="head" nowrap>Submission Time</td>
	   <td align='center' class="head" nowrap>Action</td>
	</tr>
	<?php
	$i=1;
	while($r6=fetcharray($sql3))
	{
	?>
	<tr>
      	<td  align='center' nowrap >&nbsp;<?=$i?></td>
        <td align='center'  nowrap>&nbsp;<?=$r6['exam_name']?></td>
<!--        <td nowrap>&nbsp;<?php
		//if($r6['exam_type']==2)
		//echo "Selective";
		//else
		//echo "Descriptive";
		$bdate=$r6['exam_date'];
		$ttdate2=explode('-',$bdate);
		$date2=$ttdate2[2]."-".$ttdate2[1]."-".$ttdate2[0];
		?>
		</td>
-->      
		<td  align='center' nowrap >&nbsp;<?=$date2?></td>
        <td align='center' nowrap >&nbsp;<?=$r6['time_limit']?>&nbsp;<?=$r6['timefrt']?></td>
        <td align="center" nowrap>
       <a href= "javascript:OpenWind2('studupload.php?amnt=<?=$r6['id']?>')">
<input type="button"  value="upload"  class='bgbutton'></a>
</td>
       </tr>
	<?php	
    $i=$i+1;
	}
	?>
	</table>
<?php
}
?>	
</form></body></html>
