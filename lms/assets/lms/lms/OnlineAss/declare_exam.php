<?php
	session_start();
	include("../db.php");

if(!$_POST || !$_GET)
{	
	$sem=$_SESSION['sem'];
	$course=$_SESSION['branch'];
	$accyear=$_SESSION['AcademicYear'];
}
if($_POST)
{
	
	$hh=$_POST['hh'];
	$mm=$_POST['mm'];
	$sem=$_POST['sem'];
	$type=$_POST['type'];
	$ename=$_POST['ename'];
	$adate=$_POST['adate'];
	$course=$_POST['course'];
	$subject=$_POST['subject'];
	$short_name=$_POST['short_name'];
	$class_section_id=$_POST['class_section_id'];
}
	$ttime="$hh:$mm";
	
	/*echo "<pre>";
	print_r($_GET);
	print_r($_POST);
	echo "</pre>";*/
	
	//echo "subject :".$subject;
	
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
		?>
		<Script language="JavaScript">
			alert("Duplicate entry not allowed");
		</Script>
		<?php
	}
	else
	{

		execute("INSERT INTO `online_exam_det` (`class_id`, `acc_year`, `section_id`, `exam_name`, `exam_short_name`, `subject_id`, `exam_type`, `score`, `exam_date`, `status`, `time_limit`) VALUES ( '$sem', '$accyear', '$class_section_id', '$ename', '$short_name', '$subject', '$type', '0', '$date1', '1', '$ttime')") or die(mysql_error());
		?>
		<Script language="JavaScript">
			alert("Updated successfully");
		</Script>
		<?php	
	}
}
?>
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
<script LANGUAGE="JavaScript">
function reload(str)
{

var url="../sessionbranchfile.php";

url=url+"?q="+str;

url=url+"&sid="+Math.random();

if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {

    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;

    }

  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
</script>
<script language="javascript">
function reloadAjax(str)
{

var url="../sessionsectionfile.php";

url=url+"?r="+str;

url=url+"&sid="+Math.random();



if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

    document.getElementById("txtHint10").innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET",url,true);

xmlhttp.send();

}
</script>
<body class='bodyline'>
<form method="post" name="frm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' class='forumline' width='75%' border="1">
<tr>
  	<td colspan=2 align='center' class='head'>Declare Examination</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;School Division</td>
    <td><select name="course" onChange="reload(this.value)">
    <option value=''>-- Select --</option>
    <?php
    if($course=='0')
        $s="selected";
    else
        $s="";
        $sql1=execute("SELECT course_id,coursename FROM course_m");
        for($j=0;$j<rowcount($sql1);$j++)
        {
            $r1=fetcharray($sql1,$j);
    
            if($r1[course_id]==$course)
            {
                echo "<option value=$r1[course_id] selected>$r1[coursename]</option>";
            }
            else
            {
                echo "<option value=$r1[course_id]>$r1[coursename]</option>";
            }
        }
    
    ?>
    </select></td>
</tr>
<tr>
      <td>&nbsp;&nbsp;Class</td>
      <td><div id="txtHint9" class="inline">
      	<select name="sem" onChange="reloadAjax(this.value)">
        <option value="">Select Class</option>
        <?php
           $rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$course'");

				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}
				}
        ?>
        </select></div>
        </td>
</tr>
  <tr>
  <td height="28">&nbsp;&nbsp;Section</td>
  <td><div id="txtHint10" class="inline">
  <select name='class_section_id' >
	<?
   $rs_section=execute("SELECT * FROM student_m a,class_section b WHERE a.archive='N' and a.class_section_id=b.id and course_yearsem='$sem' group by b.id");

	echo "<option value=''>--Select--</option>";
	
	for($i=0;$i<rowcount($rs_section);$i++)
	{
	
		$r_section=fetcharray($rs_section,$i);
	
		if($class_section_id==$r_section[id])
		{
			echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
		}
		else
		{
			echo "<option value='$r_section[id]'>$r_section[section_name]</option>";
		}
	}
    ?>
    </select></div>
</td>
  </tr>

<tr>
	<td>&nbsp;&nbsp;Subject Name</td>

    <td><select name="subject" onChange="RefreshMe(0)">
	<option value="">Select Subject </option>
<?php
	$sql3=execute("select subject_id, subject_name from subject_m where course_id='$course' and course_year_id='$sem' and status='1' order by sub_pre");
	while($r3=fetcharray($sql3))
	{
		
		 if($subject==$r3['subject_id'])
		 {
			echo "<option value=$r3[subject_id] selected>$r3[subject_name]</option>";
		 }
		 else
		 {
			echo "<option value=$r3[subject_id]>$r3[subject_name]</option>";
		 }
	}
?>
</select>
</td>
</tr>
</table>
<?php

if(!$subject)
{
	die();
}
?>
<br>
<table align='center' class='forumline' width='75%' border="1" >
	<tr>
		<td align='center' class='head' nowrap>Exam Name</td>
		<td align='center' class='head' nowrap>Short Name</td>
        <td align='center' class="head" nowrap>Type</td>
	  	<td align='center' class="head" nowrap>Exam Date</td>
		<td  align='center' class="head" nowrap>Time Limit</td>
	</tr>
	<tr>
	
      	<td align='center' nowrap>
      	<input size="20" type='text' id="ename" name='ename' value=''>
		</td>
        <td align='center' nowrap>
        <input type='text' id="short_name" name='short_name' value='' maxlength="4" size="4" width="4">
		</td>
        <td align='center' nowrap>
        Descriptive <input type="radio" name="type"  value="1" checked> Selective 
            <input type="radio" name="type" value="2">
		</td>
        <td nowrap>&nbsp;
        <?php 
		$adate=date("d/m/Y");
		?>
		<input type="text" readonly size='12'  name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        
        </td>
        <td>
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
        <td nowrap>&nbsp;<?=$r6['exam_name']?></td>
        <td nowrap>&nbsp;<?=$r6['exam_short_name']?></td>
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
