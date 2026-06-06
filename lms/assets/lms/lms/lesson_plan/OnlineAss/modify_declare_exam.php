<html>
<head><title>Declare Examination</title>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<Script language="JavaScript">

function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
	function RefreshMe(val)
	{
		document.frm.action="modify_declare_exam.php";
		document.frm.submit();
	}
	function RefreshMe2(val)
	{
		document.frm.action="modify_declare_exam.php?id="+val;
		document.frm.submit();	
	}
	function RefreshMe1()
	{
		var ename=document.getElementById("ename").value;
		var short_name=document.getElementById("short_name").value;
		if(ename=='' || short_name=='')
		alert("Please fill the credentials");
		else
		{
		 	document.frm.action="modify_declare_exam.php?save=1";
			document.frm.submit();
		}
	}
	
</script>
<?php
	session_start();
	include("../../db.php");


if($_POST)
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];

}
else
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
}
	$accyear=$_SESSION['AcademicYear'];
	$short_name=$_POST['short_name'];
	$subject=$_POST['subject'];
	$ename=$_POST['ename'];
	$adate=$_POST['adate'];
	$hh=$_POST['hh'];
	$mm=$_POST['mm'];
	$ttime="$hh:$mm";
	$class_section_id=$_POST['class_section_id'];
	$type=$_POST['type'];
	
	//print_r($_REQUEST);
	//echo "<br>";
	$ttdate2=explode('/',$adate);
	$date1=$ttdate2[2]."-".$ttdate2[1]."-".$ttdate2[0];
if($_GET['id'])
{
	$cid=$_GET['id'];
		execute("update online_exam_det set status=0 where id='$cid'");	
		?>
		<Script language="JavaScript">
		alert("Deleted successfully");
		</Script>
		<?php
		
		
}
if($_GET['save']==1)
{
	$sql2=execute("SELECT id FROM `online_exam_det` where class_id='$sem' and acc_year='$accyear' and section_id='$class_section_id' and exam_name='$ename' and subject_id='$subject' AND exam_type='$type' and status=1");
	if(rowcount($sql2)>=1)
	{
		
		$lpmod="update online_exam_det set `exam_name`='".addslashes($ename)."',`exam_short_name`='".addslashes($short_name)."',`exam_type`='$type',`exam_date`='$date1',`time_limit`='$ttime' where acc_year='$accyear' and subject_id='$subject' and `class_id`='$sem'";
			execute($lpmod);
		
		
		?>
		<Script language="JavaScript">
		alert("Duplicate entry not allowed");
		</Script>
		<?php
	}
	
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php	
	
}
?>
</head>
<body class='bodyline'>
<form method="post" name="frm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;
<a href= "declare_exam.php"><input type='button' align='center' class='bgbutton' value='back'></a></div>
<br>

  <?php

$sql3=execute(" SELECT * FROM `online_exam_det` where class_id='$sem' and acc_year='$accyear' and section_id='$class_section_id' and subject_id='$subject' and status=1");
if(rowcount($sql3)>=1)
{	
	?>
<table align='center' class='forumline' width='75%' border="1" >
<tr>
		<td align='center' class='head' nowrap>Sl.No</td>
		<td align='center' class='head' nowrap>Exam Name</td>
		<td align='center' class='head' nowrap>Short Name</td>
        <td align='center' class="head" nowrap>Type</td>
	  	<td align='center' class="head" nowrap>Valid</td>
		<td  align='center' class="head" nowrap>Time</td>
		<td  align='center' class="head" nowrap>Action</td>
		
	</tr>
	<?php
	$i=1;
	while($r6=fetcharray($sql3))
	{
	?>
	<tr>
      	<td nowrap>&nbsp;<?=$i?></td>
        <td nowrap><input size="20" type='text' id="ename" name='ename' value='<?=$r6['exam_name']?>'></td>
        <td nowrap><input type='text' id="short_name" name='short_name' value='<?=$r6['exam_short_name']?>'></td>
        <td nowrap>&nbsp;<?php
		if($r6['exam_type']==1)
		echo "Descriptive";
		else
		echo "Selective";
		$bdate=$r6['exam_date'];
		$ttdate2=explode('-',$bdate);
		$date2=$ttdate2[2]."-".$ttdate2[1]."-".$ttdate2[0];

		?>
		</td>
        <td nowrap>&nbsp;<?=$date2?></td>
        <td nowrap>&nbsp;<?=$r6['time_limit']?></td>
        <td align="center" nowrap>
       <input type="button" onClick="RefreshMe2(<?=$r6['id']?>)" name="save3" value="DELETE"  class='bgbutton'></td>
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
