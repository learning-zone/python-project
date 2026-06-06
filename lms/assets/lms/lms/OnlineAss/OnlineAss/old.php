<HTML>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="../js/cal2.js"></script>
  <script language="javascript" src="../js/cal_conf2.js"></script>
</HEAD>
<?php
session_start();
include("../db.php");
$accyear=$_SESSION['AcademicYear'];
if(!$_POST)
{
	$course=$_SESSION['branch'];
	$FromYear=$_SESSION['sem'];	
}
else
{
	$stu_id=$_POST['stu_id'];
	$course=$_POST['course'];
	$FromYear=$_POST['FromYear'];	
	$update=$_POST['update'];
	$save=$_POST['save'];
	$subid=$_POST['subid'];
	$rcot=$_POST['rcot'];
	$descr=$_POST['descr'];
	$date3=$_POST['date3'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$ename=$_POST['ename'];
}
$date1 = date("d/m/Y");

$sql = execute("SELECT * FROM users WHERE username='$user'") or die(error_description());
$rs=fetcharray($sql);
$UserId=$rs[id];
?>
<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="declare_exam.php";
	document.frm.submit();
}

function validtade()
{
	alert("hi");
}
function selectMe(i)
{
	var a = parseInt(document.getElementById("max_"+i).value);
	if(isNaN(a))
	{
		document.getElementById("mm_"+i).checked=false;
		document.getElementById("max_"+i).value='';
	}
	else
	{
		if(a<1)
		{
			document.getElementById("mm_"+i).checked=false;
			document.getElementById("max_"+i).value='';
		}
		else
		{
			document.getElementById("mm_"+i).checked=true;
		}
	}
}
function selectMe1(i)
{

	var a = parseInt(document.getElementById("maxm_"+i).value);
	if(isNaN(a))
	{
		document.getElementById("mm_"+i).checked=false;
		document.getElementById("maxm_"+i).value='';
	}
	else
	{
		if(a<1)
		{
			document.getElementById("mm_"+i).checked=false;
			document.getElementById("maxm_"+i).value='';
		}
		else
		{
			document.getElementById("mm_"+i).checked=true;
		}
	}
}
function selectMe2(i)
{

	var ii=2+i;
	var a = document.getElementById("date"+ii).value;
	if(a=='')
	{
		document.getElementById("mm_"+i).checked=false;
	}
	else
	{
		document.getElementById("mm_"+i).checked=true;
	}
}
</SCRIPT>
<BODY>
<?php
if($save)
{
	$temsql=mysql_query("select * from online_exam_master where class_id='$FromYear'  and exam_name='$ename' and acc_year='$accyear'");
	if(mysql_num_rows($temsql)>0)
	{
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Duplicate entry not allowed");
		</script>
		<?php
	}
	else
	{
		
		$inser=mysql_query("INSERT INTO `online_exam_master` (`class_id`, `acc_year`, `exam_name`, `exam_short_name`, `status`) VALUES ('$FromYear', '$accyear', '$ename', '$descr', '1')");
		$examiddet=mysql_fetch_row(mysql_query("select max(id) from online_exam_master"));
		
		$iii=3;
		for($ii=0;$ii<sizeof($subid);$ii++)
		{
			$datename=$_POST['date'.$iii];
			$ttdate2=explode('/',$datename);
			$datename=$ttdate2[2]."-".$ttdate2[1]."-".$ttdate2[0];
			$timename=$_POST['time'.$iii];
			//mysql_query("insert into exam_timetable_m(exam_id,subject_id,exam_date,exam_time) values('$examiddet[0]','$subid[$ii]','$datename','$timename')");
			$iii++;
		}
		$course='';
		$FromYear='';
		$adate='';
		$date3='';
		
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Added successfully");
		</script>
		<?php
		
	}
}
	?>
	<FORM NAME=frm METHOD=POST >
	<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" class="head" align="center">Declare Examination </td>
	</tr>
	<tr>
	<td width="30%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
	<td  align="left">&nbsp;
	<select name="course" size="1" OnChange=go()>
	<option value='' >-- Select --</option>
	<?
	$tempstr="SELECT course_id ,coursename FROM  course_m ";
	$rs_course=execute($tempstr);
	while($r1=mysql_fetch_array($rs_course))
	{
	if($course==$r1[0])
		{
			echo "<option value='$r1[0]' selected>$r1[1]</option>";
		}
		else
		{
			echo "<option value='$r1[0]'>$r1[1]</option>";
		}
	}
	?>
	</select></td></tr>
	
	  <tr>
	<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
	<td colspan="2">&nbsp;
	<select name="FromYear" OnChange=go()>
	<?php
	$sql2 = "SELECT * FROM course_year where status=1 and head_id='$course' ";
	$rs2 = execute($sql2);
	$num = rowcount($rs2);
	echo "<option value=''>-- Select --</option>";
	for($i=0;$i<$num;$i++)
	{
		$r2 = fetcharray($rs2,$i);
		if($FromYear==$r2[0])
		echo "<option value=\"$r2[0]\" selected>$r2[1]</option>";
		else
		echo "<option value=\"$r2[0]\">$r2[1]</option>";
	}
	?> </select> </td></tr>
	<?php
	if($FromYear!='' and $course!='')
	{
		?>
		
		<tr>
		<td nowrap>&nbsp;&nbsp;Examination Name</td>
		<td colspan='2' nowrap>&nbsp;
		<input type="text" name="ename" value="<?=$ename?>" size='2' maxlength='2'>&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="descr" value="<?=$descr?>"></td>
		</tr></table>
		<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
      <tr><td class="head" colspan="5" align="center">Apply Subjects</td></tr>
	  <tr><td align='center'  class="rowpic" nowrap>Subject Name</td><td align='center' class="rowpic" nowrap>Type</td>
	  <td align='center' class="rowpic" nowrap>Valid</td>
		<td  align='center' class="rowpic" nowrap>Time</td>
		<td align='center' class="rowpic" nowrap>Select</td></tr>
      <?php
	  $suqry=mysql_query("select subject_id,subject_name from subject_m where course_id='$course' and course_year_id='$FromYear' and status='1' order by sub_pre");
		$rcot=mysql_num_rows($suqry);
		echo "<input type='hidden' name='rcot' value='$rcot'>";
		$sno=1;
		$iii=3;
	  while($rs1=mysql_fetch_array($suqry))
	  {
			echo "<tr height='25'><td nowrap>&nbsp;&nbsp;$rs1[1]</td>";
			echo "<td align='center'>";
			?>
            Descriptive <input type="radio" name="type_<?=$rs1[0]?>" onchange='selectMe(<?=$sno?>)' value="1" checked> Selective 
            <input type="radio" name="type_<?=$rs1[0]?>" onchange='selectMe(<?=$sno?>)' value="2">
            </td>
            <?php
			$datename="date".$iii;
		  	$calandername="Calendar".$iii;
			?><td align='center'>
		<input type="text" readonly=""  size='12'   onFocus="selectMe2(<?php echo $sno; ?>)" name="<?php echo $datename; ?>" id="<?php echo $datename; ?>"  value="">&nbsp;&nbsp;
		<a href="javascript:showCal('<?php echo $calandername; ?>')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
			</td><td align='center'>
            
            <?php
			echo "HR <select name='hh".$rs1[0]."' id='hh".$rs1[0]."'>";
			for($m=0;$m<5;$m++)
			{
				echo "<option value='$m'>$m</option>";
			}
			echo "</select>";
			echo " MM <select name='ss".$rs1[0]."' id='ss".$rs1[0]."'>";
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
			 
			echo "</td>
			<td align='center'><input type='checkbox' name='subid[]' id='mm_$sno' value='$rs1[0]' onClick='selectMe($sno)'></td></tr>";
			$sno++;
			$iii++;
	  }
	  ?></table>
	  <br>
	  <div align="center">
		<input type="submit" name="save" value="SAVE" class="bgbutton">
	  </div>
		<?php
	}
	?>
</FORM>
	<?php

?>

</BODY>
</HTML>