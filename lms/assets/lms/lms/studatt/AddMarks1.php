<html>
<head>
<?php
session_start();
include("../db.php");
if($_REQUEST['course'])
{
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$examid=$_REQUEST['examid'];
	$studentid=$_REQUEST['studentid'];
	$class_section_id=$_REQUEST['class_section_id'];
	$stundetname=$_REQUEST['stundetname'];
	$student_id=$_REQUEST['student_id'];	
}
else
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$examid=$_POST['examid'];
	$studentid=$_POST['studentid'];
	$class_section_id=$_POST['class_section_id'];
	$stundetname=$_POST['stundetname'];
	$student_id=$_POST['student_id'];
	
}
?>
<script language='javascript'>
function valid(id)
{
	var mmarks= document.getElementsByName("m_mark" + id)[0].value;
	var obt_mark = parseInt(document.getElementsByName("mark" + id)[0].value);
	if(isNaN(obt_mark))
	{
		alert("Enter number only. For Absentees enter as 0");
		document.getElementsByName("mark" + id)[0].value='';
	}
	else
	{
		if(obt_mark>mmarks)
		{
			alert("Scored Mark cannot be greater than max mark");
			document.getElementsByName("mark" + id)[0].value='';
		}
	}
}
function valid1()
{
	var mmarks= parseInt(document.getElementsByName("cc")[0].value);
	var obt_mark = parseInt(document.getElementsByName("ca")[0].value);
	if(isNaN(mmarks))
	{
		alert("Enter number only.");
		document.getElementsByName("cc")[0].value='';
	}
	if(isNaN(obt_mark))
	{
		alert("Enter number only.");
		document.getElementsByName("ca")[0].value='';
	}
	else
	{
		if(obt_mark>mmarks)
		{
			alert("Attended class cannot be greater than conducted class");
			document.getElementsByName("ca")[0].value='';
		}
	}
}
</script>
</head>
<body>
<form name="frm" action="" method="post">
<?php
echo "
<input type='hidden' name='course' value='$course'>
<input type='hidden' name='sem' value='$sem'>
<input type='hidden' name='examid' value='$examid'>
<input type='hidden' name='studentid' value='$studentid'>
<input type='hidden' name='stundetname' value='$stundetname'>
<input type='hidden' name='student_id' value='$student_id'>
<input type='hidden' name='class_section_id' value='$class_section_id'>";

$rs_ec=execute("select * from exam_m where id='$examid'");
while($r1=fetcharray($rs_ec))
{
	$subid=explode(',',$r1['sub_id']);
	$mmks=explode(',',$r1['max_mark']);
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
}
$assmk='a.assmk'.$exam_count;
$assmk1='assmk'.$exam_count;
$ba="ba".$exam_count;
$tablename="marks_".$course."_".$sem;
if($_POST['save'])
{
	$totalmark=0;
	$pflg='P';
	for($i=0;$i<sizeof($subid);$i++)
	{
		$totmark=$_POST['mark'.$subid[$i]];
		$caq=fetcharray(execute("select sub_type from subject_m where subject_id='$subid[$i]'"));
		if($caq[0]<3)
			$totalmark=$totalmark+$totmark;
		if($totmark!='')
		{
			if($totmark==0)
			{
				if($caq[0]<3)
				{
					if($pflg!='F')
						$pflg='Ab';
				}
			}
			else
			{		
				$sper=$totmark*100/$mmks[$i];
				if($sper<35)
				{
					if($caq[0]<3)
						$pflg='F';
				}
			}
			$sql1=execute("select * from $tablename where studid='$studentid' and secid='$class_section_id' and subid='$subid[$i]' and accyr='$accyear'");
			if(rowcount($sql1)==0)
			{
				execute("insert into $tablename (studid,secid,subid,$assmk1,accyr) value('$studentid','$class_section_id','$subid[$i]','$totmark','$accyear')");
			}
			else
			{
				execute("update $tablename set $assmk1=$totmark, accyr='$accyear'  where studid='$studentid' and secid='$class_section_id' and subid='$subid[$i]'");	
			}
			$sql24=execute("select $assmk1 from $tablename where subid='$subid[$i]' and accyr='$accyear' and secid='$class_section_id' and $assmk1>0  group by $assmk1 ORDER BY $assmk1 DESC");
			$m=1;
			while($r42=fetcharray($sql24))
			{
				$sql72=execute("select id from $tablename where $assmk1='$r42[0]' and subid='$subid[$i]' and accyr='$accyear' and secid='$class_section_id' ");
				while($r72=fetcharray($sql72))
				{
					execute("update $tablename set $ba='$m' where id='$r72[0]' ");
				}
				$m++;
			}
			
		}
	}
	$sql4=execute("select total_mark,posi,stud_id  from exam_topers where exam_id='$examid'  and stud_id='$studentid' ");
	if(rowcount($sql4)==0)
	{
		execute("insert into exam_topers(total_mark,posi,stud_id,exam_id,sec_id,rfg,cc,ca,sub_remks) values('$totalmark','1','$studentid','$examid','$class_section_id','$pflg','".$_POST['cc']."','".$_POST['ca']."','".addslashes($_POST[sub_remks])."') ");
	}
	else
		execute("update exam_topers set total_mark='$totalmark',sec_id='$class_section_id',rfg='$pflg', cc='".$_POST['cc']."' , ca='".$_POST['ca']."', sub_remks='".addslashes($_POST[sub_remks])."' where exam_id='$examid'  and stud_id='$studentid'");

	$sql2=execute("select total_mark from exam_topers where exam_id='$examid' and sec_id='$class_section_id'  group by total_mark ORDER BY total_mark DESC ");
	$k=1;
	while($r4=fetcharray($sql2))
	{
		$sql7=execute("select id from exam_topers where exam_id='$examid' and total_mark='$r4[0]' and sec_id='$class_section_id'  ");
		while($r7=fetcharray($sql7))
		{
			execute("update exam_topers set posi='$k' where id='$r7[0]' ");	
		}
		$k++;
	}
	
?>
<script language='javascript'>
alert("**** Marks Updated Successfully ***");
self.opener.location.reload();
window.close();
</script>
<?php
}
echo '<table align="center" width="50%" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="4" > Add Marks </td>
  </tr>
  <tr height="25">
    <td align="center" colspan="4" >Name : '.$stundetname.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Id : '.$student_id.' </td>
  </tr><tr><td width="5%" align="center">SL.No</td>
  <td align="center">Subject Name</td>
	<td width="15%" align="center" nowrap>Max<br>Marks</td>
  <td width="15%" align="center" nowrap>Scored<br>Marks</td>
  </tr>
  <input type="hidden" name="subid" value="$subid">'  ;
$ckql=execute("select cc,ca,sub_remks from exam_topers where exam_id='$examid' and stud_id='$studentid'");
if(rowcount($ckql)>0)
{
	$ckrs=fetcharray($ckql);	
	$cfk=1;
}
else
	$cfk=0;
for($i=0;$i<sizeof($subid);$i++)
{
	if($cfk==0)
	{
		$markqury1=execute("select subject_name from subject_m  where subject_id='$subid[$i]'");
		$name=fetchrow($markqury1);
		echo " <tr>
			<td align='center'>".($i+1)."</td>
			<td>&nbsp;&nbsp;$name[0]</td>";
			?>
			<td align='center'><input type='hidden' name='m_mark<?php echo $subid[$i] ?>' value='<?php echo $mmks[$i] ?>' size='3' readonly><?php echo $mmks[$i] ?></td>
			<td align='center'><input type='text' name='mark<?php echo $subid[$i] ?>' value='' size='3'  onblur="valid('<?php echo $subid[$i] ?>')">
			</td></tr><?php
	}
	else
	{
		$markqury=execute("select $assmk,b.subject_name from $tablename a, subject_m b where a.studid='$studentid' and a.subid='$subid[$i]' and b.subject_id=a.subid");
		if(rowcount($markqury)>0)
		{
			while($mark=fetcharray($markqury))
			{
				echo "<tr><td align='center'>".($i+1)."</td><td>&nbsp;&nbsp;$mark[1]</td>";
				$cc=$ckrs[cc];
				$ca=$ckrs[ca];
				$sub_remks=stripslashes($ckrs[sub_remks]);
				?>
				<td align='center'><input type='hidden' name='m_mark<?=$subid[$i]?>' value='<?php echo $mmks[$i] ?>' size='3' readonly><?php echo $mmks[$i] ?></td>
				<td align='center'><input type='text' name='mark<?=$subid[$i]?>' value='<?=$mark[0]?>' size='3'  onblur="valid('<?=$subid[$i]?>')">
				</td></tr><?php
			}
		}
		else
		{
			$markqury1=execute("select subject_name from subject_m  where subject_id='$subid[$i]'");
		$name=fetchrow($markqury1);
		echo " <tr>
			<td align='center'>".($i+1)."</td>
			<td>&nbsp;&nbsp;$name[0]</td>";

			?>
			<td align='center'><input type='hidden' name='m_mark<?php echo $subid[$i] ?>' value='<?php echo $mmks[$i] ?>' size='3' readonly><?php echo $mmks[$i] ?></td>
			<td align='center'><input type='text' name='mark<?php echo $subid[$i] ?>' value='' size='3'  onblur="valid('<?php echo $subid[$i] ?>')">
			</td></tr><?php
		}
	}
}
	$nq1=execute("select f_date, t_date from exam_m where id='$examid'");
	while($nr1=fetcharray($nq1))
	{
		$fdate=$nr1[0];
		$tdate=$nr1[1];
	}
	$atttable="att_".$course."_".$sem;
	$nq2=execute("SELECT count( mor ) , count(after), sum( mor ) , sum(after) FROM $atttable where stu_id='$studentid' and sec='$class_section_id' and att_date between '$fdate' and '$tdate'");
	while($nr2=fetcharray($nq2))
	{
		$cc=$nr2[0]+$nr2[1];
		$ca=$nr2[2]+$nr2[3];
	}
	//$cc=$cc/2;
	//$ca=$ca/2;
 echo "<tr>
    <td align='center' class='head' colspan='4' > Attendance  </td>
  </tr></tr><tr><td colspan='4' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class conducted : <input type='text' name='cc' value='$cc' size='3' >
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 Class attended : <input type='text' name='ca' value='$ca' size='3' onchange='valid1()' ></td>
			  </tr><tr>
    <td align='center' class='head' colspan='4' > Class Teacher Remarks </td>
  </tr></tr><tr><td colspan='4' align='center'><textarea name='sub_remks'  cols='44' rows='4'>$sub_remks</textarea></td>
			  </tr>
	</table>";

?>
<br><div align="center">
<input type="submit" name="save" value="Save"></div></form>
</body>
</html>
