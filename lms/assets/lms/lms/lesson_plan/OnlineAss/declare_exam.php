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
		document.frm.action="declare_exam.php";
		document.frm.submit();
	}
	function RefreshMe2(val)
	{
		document.frm.action="declare_exam.php?id="+val;
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
		 	document.frm.action="declare_exam.php?save=1";
			document.frm.submit();
		}
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
	include("../../db.php");
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
	
	$sql2=execute("SELECT id FROM `online_exam_det` where class_id='$sem' and acc_year='$accyear' and section_id='$class_section_id' and exam_name='$ename' and subject_id='$subject' AND exam_type='2' and status=1");
	if(rowcount($sql2)>=1)
	{
		?>
		<Script language="JavaScript">
		alert("Duplicate entry not allowed");
		</Script>
		<?php
	}
	else
	{
		
		execute("INSERT INTO `online_exam_det` (`class_id`, `acc_year`, `section_id`, `exam_name`, `exam_short_name`, `subject_id`, `exam_type`, `score`, `exam_date`, `status`, `time_limit`) VALUES ( '$sem', '$accyear', '$class_section_id', '$ename', '$short_name', '$subject', '2', '0', '$date1', '1', '$ttime')") or die(mysql_error());
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php	
	}
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
<br>

<table align='center' class='forumline' width='75%' border="1" >
	<tr>
		<td align='center' class='head' nowrap>Quiz Name</td>
		<td align='center' class='head' nowrap>Short Name</td>
<!--        <td align='center' class="head" nowrap>Type</td>
-->	  	<td align='center' class="head" nowrap>Date</td>
		<td  align='center' class="head" nowrap>Time Limit</td>
	</tr>
	<tr>
	
      	<td align='center' nowrap>
      	<input size="20" type='text' id="ename" name='ename' value=''>
		</td>
        <td align='center' nowrap>
        <input type='text' id="short_name" name='short_name' value='' maxlength="4" size="4" width="4">
		</td>
<!--        <td align='center' nowrap>
        Descriptive <input type="radio" name="type"  value="1" checked> Selective 
            <input type="radio" name="type" value="2" >
		</td>
-->               <td  align='center' nowrap>
        <?php 
		$adate=date("d/m/Y");
		?>
		<input type="text" readonly size='12'  name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        
        </td>

        <td  align='center' >
		<?php
			echo "(H:M)<select name='hh' id='hh'>";
			for($m=0;$m<5;$m++)
			{
				echo "<option value='$m'>$m</option>";
			}
			echo "</select>";
			echo "<select name='mm' id='mm'>";
			$m1='00';
			for($m=1;$m<5;$m++)
			{
				if($m1==15)
				echo "<option value='$m1' selected>$m1</option>";
				else
				echo "<option value='$m1'>$m1</option>";
				$m1=$m1+15;
			}
			echo "</select>";
			?>
		</td>
	</tr>
</table>
<br>
  <div align='center' >
  <input type="button" onClick="RefreshMe1()" name="save" value="SAVE"  class='bgbutton'>
</div>
  <br>
  <?php

$sql3=execute(" SELECT * FROM `online_exam_det` where class_id='$sem' and acc_year='$accyear' and section_id='$class_section_id' and subject_id='$subject' and status=1");
if(rowcount($sql3)>=1)
{	
	?>
<table align='center' class='forumline' width='75%' border="1" >
<tr>
		<td align='center' class='head' nowrap>Sl.No</td>
		<td align='center' class='head' nowrap>Quiz Name</td>
		<td align='center' class='head' nowrap>Short Name</td>
<!--        <td align='center' class="head" nowrap>Type</td>
-->	  	<td align='center' class="head" nowrap>Date</td>
		<td  align='center' class="head" nowrap>Time</td>
		<td  align='center' class="head" nowrap>Action</td>
		
	</tr>
	<?php
	$i=1;
	while($r6=fetcharray($sql3))
	{
	?>
	<tr>
      	<td nowrap  align='center' >&nbsp;<?=$i?></td>
        <td nowrap  align='center' >&nbsp;<?=$r6['exam_name']?></td>
        <td nowrap  align='center' >&nbsp;<?=$r6['exam_short_name']?></td>
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
		<td nowrap  align='center' >&nbsp;<?=$date2?></td>
        <td nowrap align='center' >&nbsp;<?=$r6['time_limit']?></td>
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
