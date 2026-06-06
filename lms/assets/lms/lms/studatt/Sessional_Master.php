<HTML>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
</HEAD>
<?php
session_start();
include("../db.php");
if(!$_POST and !$_REQUEST)
{
	$course=$_SESSION['branch'];
	$FromYear=$_SESSION['sem'];	
}
elseif(!$_POST and $_REQUEST)
{
	$action=$_REQUEST['action'];
	$stu_id=$_REQUEST['stu_id'];
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
	document.frm.action="Sessional_Master.php";
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
if($action=='' and $stu_id=='') 
{	?>
    <a href="Sessional_Master.php?action=mod"><input type="button" value="Modify" class="bgbutton"></a><br>
    <?php
}
if($action=='mod' and $stu_id=='') 
{?>
    <a href="Sessional_Master.php"><input type="button" value="Add New" class="bgbutton"></a><br>
    <?php
	$sytemdate=date("Y-m-d");
	?>
    <table  class='forumline' align='center' width="60%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="5" class="head" align="center">Modify Examination </td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic">Sl.No.</td>
    <td align="center" class="rowpic">Exam Name</td>
    <td align="center" class="rowpic"><?php echo $_SESSION['semname']; ?></td
    ><td align="center" class="rowpic">From</td>
    <td align="center" class="rowpic">To</td>
  </tr>
  <?
	$inc=1;
	$temsql3=execute("select a.id , a.descr , a.f_date , a.t_date , b.year_name from exam_m a, course_year b where sts=0 and b.year_id=a.class order by a.class");
	while($r=fetcharray($temsql3))
	{
		echo "<tr height='25'>
    <td align='center'>$inc</td>
    <td nowrap>&nbsp;&nbsp;<a href='Sessional_Master.php?stu_id=$r[id]'>$r[descr]</a></td>
    <td nowrap>&nbsp;&nbsp;$r[year_name]</td>
	<td align='center' nowrap>$r[f_date]</td>
    <td align='center' nowrap>$r[t_date]</td>
  </tr>";
  $inc++;
	}
	
	?>
	</table>
    <?
}
if(isset($update))
{
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	$ttdate=explode('/',$bdate);
	$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];
	
	$vct=0;
	$subidstr='';
	$mmks='';
	for($ii=0;$ii<sizeof($subid);$ii++)
	{
		if($subidstr=='')
		{
			$subidstr=$subid[$ii];
			$mks=$_POST['maxmark_'.$subid[$ii]];
			$mmks=$mks;
			$caq=fetcharray(execute("select sub_type from subject_m where subject_id='$subid[$ii]'"));
			if($caq[0]<3)
				$vct+=$mks;
		}
		else
		{
			$subidstr=$subidstr.",".$subid[$ii];
			$mks=$_POST['maxmark_'.$subid[$ii]];
			$mmks=$mmks.",".$mks;
			$caq=fetcharray(execute("select sub_type from subject_m where subject_id='$subid[$ii]'"));
			if($caq[0]<3)
				$vct+=$mks;
		}
	}
	execute("update exam_m set descr='$descr',sub_id='$subidstr',f_date='$fdate' , t_date='$tdate', exam_name='$ename', max_mark='$mmks',vct='$vct' where id='$stu_id'");
	$iii=3;
	for($ii=0;$ii<sizeof($subid);$ii++)
	{
		$datename=$_POST['date'.$iii];
		$ttdate2=explode('/',$datename);
		$datename=$ttdate2[2]."-".$ttdate2[1]."-".$ttdate2[0];
		$timename=$_POST['time'.$iii];
		if(rowcount(execute("select id from exam_timetable_m where exam_id='$stu_id' and subject_id='$subid[$ii]'")))
		{
			execute("update exam_timetable_m set exam_date='$datename', exam_time='$timename' where exam_id='$stu_id' and subject_id='$subid[$ii]'");
			
		}
		else
		{
			execute("insert into exam_timetable_m(exam_id,subject_id,exam_date,exam_time) values('$stu_id','$subid[$ii]','$datename','$timename')");
		}
		$iii++;
	}
	$course='';
	$FromYear='';
	$adate='';
	$date3='';
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Updated successfully");
	</script>
	<?php
	
}
if($stu_id!='')
{
		?>
    <a href="Sessional_Master.php"><input type="button" value="Add New" class="bgbutton"></a></a>
    <?php
	$temsql4=execute("select * from exam_m where id='$stu_id'");
	while($r1=fetcharray($temsql4))
	{
		$course=$r1['curriculam'];
		$FromYear=$r1['class'];
		$adate=$r1['f_date'];
		$bdate=$r1['t_date'];
		$ename=$r1['exam_name'];
		$descr=$r1['descr'];
		$maxmark=$r1['max_mark'];
		$exam_count=$r1['exam_count'];
		$sub_id12=$r1['sub_id']; 
	}
	$tfdate=explode('-',$adate);
	$adate=$tfdate[2]."/".$tfdate[1]."/".$tfdate[0];
	$ttdate=explode('-',$bdate);
	$bdate=$ttdate[2]."/".$ttdate[1]."/".$ttdate[0];
	
?>
	<FORM NAME='frm' METHOD=POST >
    <input type="hidden" name='stu_id' value="<?=$stu_id?>">
	<table class='forumline' align='center' width="50%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" class="head" align="center">Modify Examination </td>
	</tr>
	<tr height='25'>
	<td nowrap>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
	<td align="left" nowrap>&nbsp;&nbsp;
	<?
	$tempstr="SELECT coursename FROM course_m where course_id='$course'";
	$rs_course=execute($tempstr);
	$r1=fetcharray($rs_course);
	echo $r1[0];
	?></td></tr>
	<tr height='25'>
	<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
	<td >&nbsp;&nbsp;
	<?php
	$sql2 = "SELECT year_name FROM course_year where year_id='$FromYear' ";
	$rs2 = execute($sql2);
	$r2 = fetcharray($rs2);
	echo $r2[0];
	?></td></tr>
	<?php
	if($FromYear!='' and $course!='')
	{
		?>
		<tr>
		<td>&nbsp;&nbsp;From</td>
		<td nowrap>&nbsp;
		<input type="text" readonly="" name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
		<tr>
		<td nowrap>&nbsp;&nbsp;To</td>
		<td nowrap>&nbsp;
		<input type="text" readonly="" name="bdate" value="<?php echo $bdate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
		<tr>
		<td nowrap>&nbsp;&nbsp;Examination Name</td>
		<td nowrap>&nbsp;
		<input type="text" name="ename" size='2' maxlength='2' value="<?=$ename?>">&nbsp;&nbsp;<input type="text" name="descr" value="<?=$descr?>"></td>
		</tr></table>
		<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
	   <tr><td class="head" colspan="5" align="center">Apply Subjects</td></tr>
		<tr><td align='center' class="rowpic" nowrap>Subject Name</td>
		<td align='center' class="rowpic" nowrap>Max.Marks</td>
		
		<td align='center' class="rowpic" nowrap>Date</td>
		<td  align='center' class="rowpic" nowrap>Time</td>
		<td  align='center' class="rowpic" nowrap>Select</td></tr>
      <?php
	  $subarr=explode(',',$sub_id12);
		$mmks=explode(',',$maxmark);
	  $suqry=execute("select subject_id ,subject_name from subject_m where course_id='$course' and course_year_id='$FromYear' and status='1' order by sub_pre");
	  $ssno=1;
	  $iii=3;
	  while($rs1=fetcharray($suqry))
	  {
			echo "<tr><td nowrap>&nbsp;&nbsp;$rs1[1]</td>";
		  for($k=0;$k<sizeof($subarr);$k++)
		  {
			  if($rs1[0]==$subarr[$k])
			  {
				  $check="checked";
				  $mks=$mmks[$k];
			  }
		  }
		  echo "<td align='center'><input type='text' name='maxmark_$rs1[0]' id='maxm_$ssno' value='$mks' size='2' maxlength='3' onchange='selectMe1($ssno)'></td>";
		  echo "
		  <td align='center'>";
		  $dateold=fetchrow(execute("select exam_date from exam_timetable_m where exam_id='$stu_id' and subject_id='$rs1[0]' "));
		  $timeold=fetchrow(execute("select exam_time from exam_timetable_m where exam_id='$stu_id' and subject_id='$rs1[0]'"));
			
			$olddate1=explode('-',$dateold[0]);
			if($olddate1[0]!='00')
			$olddate2=$olddate1[2]."/".$olddate1[1]."/".$olddate1[0];
			else
			$olddate2='';
			if($olddate2=='//')
			$olddate2='';
			
			$datename="date".$iii;
		  	$calandername="Calendar".$iii;
		  
		  $stu_id;
		  ?>
		  
		  <input type="text" readonly="" onFocus="selectMe2(<?php echo $ssno; ?>)" name="<?php echo $datename; ?>" id="<?php echo $datename; ?>" value="<?php echo $olddate2; ?>">&nbsp;&nbsp;
		<a href="javascript:showCal('<?php echo $calandername; ?>')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
		  
		  <?php
		  
		  echo "</td>
		  <td align='center'> <input type='text' name='time".$iii."' value='$timeold[0]'></td>
		  <td align='center'><input type='checkbox' name='subid[]' id='mm_$ssno' value='$rs1[0]' $check onClick='selectMe1($ssno)'></td></tr>";
			$check='';
			$mks='';
			$ssno++;
			$iii++;
	  }
	  ?></table>
	  <br>
	  <div align="center">
		<input type="submit" name="update" value="UPDATE" class="bgbutton">
	  </div>
		<?php
	}
	?>
</FORM>
	<?php
}

if(isset($save))
{
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	$ttdate=explode('/',$bdate);
	$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];
	$temsql=execute("select * from exam_m where class='$FromYear' and f_date='$fdate' and t_date='$tdate' and exam_name='$ename'");
	$accyear=$_SESSION['AcademicYear'];
	$temsql12=execute("select max(exam_count) from exam_m where curriculam='$course' and class='$FromYear' and accyear='$accyear'");
	$examid=fetchrow($temsql12);
	$examidcount=$examid[0]+1;
	if(rowcount($temsql)>0)
		echo "<font color='#FF0000'>Duplicate entry not allowed</font> <br>";
	else
	{
		$vct=0;
		$subidstr='';
		$mmks='';
		for($ii=0;$ii<sizeof($subid);$ii++)
		{
			if($subidstr=='')
			{
				$subidstr=$subid[$ii];
				$mks=$_POST['maxmark_'.$subid[$ii]];
				$mmks=$mks;
				$caq=fetcharray(execute("select sub_type from subject_m where subject_id='$subid[$ii]'"));
				if($caq[0]<3)
					$vct+=$mks;
			}
			else
			{
				$subidstr=$subidstr.",".$subid[$ii];
				$mks=$_POST['maxmark_'.$subid[$ii]];
				$mmks=$mmks.",".$mks;
				$caq=fetcharray(execute("select sub_type from subject_m where subject_id='$subid[$ii]'"));
				if($caq[0]<3)
					$vct+=$mks;
			}
		}
		execute("update exam_m set sts=1 where class='$FromYear' ");
		execute("insert into exam_m (curriculam,class,f_date ,t_date,exam_name,max_mark,sub_id,exam_count,accyear,descr,vct) values('$course','$FromYear','$fdate','$tdate','$ename','$mmks','$subidstr','$examidcount','$accyear','$descr','$vct')");
		$examiddet=fetchrow(execute("select max(id) from exam_m "));
		$iii=3;
		for($ii=0;$ii<sizeof($subid);$ii++)
		{
			$datename=$_POST['date'.$iii];
			$ttdate2=explode('/',$datename);
			$datename=$ttdate2[2]."-".$ttdate2[1]."-".$ttdate2[0];
			$timename=$_POST['time'.$iii];
			execute("insert into exam_timetable_m(exam_id,subject_id,exam_date,exam_time) values('$examiddet[0]','$subid[$ii]','$datename','$timename')");
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
if($action=='' and $stu_id=='') 
{
	?>
	<FORM NAME=frm METHOD=POST >
	<table class='forumline' align='center' width="50%" border="1" cellspacing="0" cellpadding="0">
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
	while($r1=fetcharray($rs_course))
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
		<td nowrap>&nbsp;&nbsp;From</td>
		<td colspan="2" nowrap>&nbsp;
		<input type="text" readonly="" name="adate" value="">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
		<tr>
		<td nowrap>&nbsp;&nbsp;To</td>
		<td colspan="2" nowrap>&nbsp;
		<input type="text" readonly="" name="bdate" value="">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
		<tr>
		<td nowrap>&nbsp;&nbsp;Examination Name</td>
		<td colspan='2' nowrap>&nbsp;
		<input type="text" name="ename" value="<?=$ename?>" size='2' maxlength='2'>&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="descr" value="<?=$descr?>"></td>
		</tr></table>
		<table class='forumline' align='center' width="60%" border="1" cellspacing="0" cellpadding="0">
      <tr><td class="head" colspan="5" align="center">Apply Subjects</td></tr>
	  <tr><td align='center'  class="rowpic" nowrap>Subject Name</td><td align='center' class="rowpic" nowrap>Max.Marks</td>
	  <td align='center' class="rowpic" nowrap>Date</td>
		<td  align='center' class="rowpic" nowrap>Time</td>
		<td align='center' class="rowpic" nowrap>Select</td></tr>
      <?php
	  $suqry=execute("select subject_id,subject_name from subject_m where course_id='$course' and course_year_id='$FromYear' and status='1' order by sub_pre");
		$rcot=rowcount($suqry);
		echo "<input type='hidden' name='rcot' value='$rcot'>";
		$sno=1;
		 $iii=3;
	  while($rs1=fetcharray($suqry))
	  {
			echo "<tr height='25'><td nowrap>&nbsp;&nbsp;$rs1[1]</td>";
			echo "<td align='center'>
			<input type='text' name='maxmark_$rs1[0]' id='max_$sno' value='' size='2' maxlength='3' width='3' onchange='selectMe($sno)'></td>";
			 $datename="date".$iii;
		  $calandername="Calendar".$iii;
			?><td align='center'>
		<input type="text" readonly=""  onFocus="selectMe2(<?php echo $sno; ?>)" name="<?php echo $datename; ?>" id="<?php echo $datename; ?>"  value="">&nbsp;&nbsp;
		<a href="javascript:showCal('<?php echo $calandername; ?>')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
			</td><?php
			echo "<td align='center'> <input type='text' name='time".$iii."' value=''></td>
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
}
?>

</BODY>
</HTML>