<?php
session_start();
if($_SESSION['per00']==1)
header('Location: select_stud_mod2.php');

require("../db.php");
?>
<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='StudentattendanceRep.php';
	document.frm.submit();
}

</SCRIPT>
</HEAD>

<body>
<?php 
$a_year=$_SESSION['AcademicYear'];
$sem1=$_SESSION['sem'];
$user=$_SESSION['user'];
$tablename='att_'.$sem1;

$studentid=fetchrow(execute("select id from student_m where admission_id='$user'"));

$studentname=fetcharray(execute("select first_name, last_name from student_m where id='$studentid[0]'"));

$name=$studentname[0].' '.$studentname[1];

$sql_id=fetchrow(execute("select type from attendance where `acc_year`='$a_year' and `class_id`='$sem1' and status=1"));
if($sql_id[0]==5)
{

?>
    <br>    
    <table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
        <tr height="10">
            <td colspan=6 align='center' class='head'>Attendance Report For <?=$name?></td></tr>
        <tr >
            <td align="center" class="head" width="5%" nowrap>Sl No.</td>
            <td align="center" class="head" nowrap>Date</td>
            <td align="center" class="head" nowrap>Status</td>
        </tr>
	
<?php
	$i=1;
	$k=0;
	$sql1=execute("SELECT att_date, mor FROM $tablename where stu_id='$studentid[0]' and subject_id='0' group by att_date order by att_date desc");
	while($r2=fetcharray($sql1))
	{
		$old_date = $r2[0];
		$old_date_timestamp = strtotime($old_date);
		$new_date = date('d-M-Y', $old_date_timestamp);
		if($r2['mor']==0)
		{
			$status="<font color='#FF0000'>Absent</font>";
			$k++;
		}
		else
		$status="<font color='#0000FF'>Present</font>";
		echo "
	       <tr >
            <td align='center'  width='5%' nowrap>$i</td>
            <td align='center' nowrap>$new_date</td>
            <td align='center'  nowrap>$status</td>
        </tr>";
		$i++;
	}
		echo "
	       <tr >
            <td align='center'  width='5%' nowrap></td>
            <td align='center' nowrap>Total </td>
            <td align='center'  nowrap>$i/$k</td>
        </tr>";

	echo "</table>";
}
if($sql_id[0]==1)
{

	$sql=execute("select subject_id, subject_name, subject_code, elective from subject_m where course_year_id='$sem1' and status=1 and  sub_type=2 order by sub_pre");
	while($r=fetcharray($sql))
	{
		if($r['elective']=='Y')
		{
			$studentstatus=fetchrow(execute("select id from student_course where stu_id='$studentid[0]' and acc_year='$a_year' and sub='$r[0]'"));
			if($studentstatus)
			{
				$subjectid1[]=$r['subject_id'];
				$subjectname1[]=$r['subject_code'];	
			}
		}
		else
		{
			$subjectid1[]=$r['subject_id'];
			$subjectname1[]=$r['subject_code'];
		}
	}
	$callspan=2+sizeof($subjectid1);
?>
	<br>    
	<table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
	<tr height="10"><td colspan='<?=$callspan?>' align='center' class='head'>Home Room Attendance For <?=$name?></td></tr>
	<tr >
		<td align="center" class="row3" width="5%" nowrap>Sl No.</td>
		<td align="center" class="row3" nowrap>Date</td>
		<?php
        for($j=0;$j<sizeof($subjectid1);$j++)
		{
			echo "<td align='center' class='row3' nowrap>$subjectname1[$j]</td>";
		}
		?>
	</tr>
	<?php
	$i=1;
	$k=0;
	
	$sql1=execute("SELECT att_date FROM $tablename where stu_id='$studentid[0]' group by att_date order by att_date desc ");
	while($r2=fetcharray($sql1))
	{
		$old_date = $r2[0];
		$old_date_timestamp = strtotime($old_date);
		$new_date = date('d-M-Y', $old_date_timestamp);
		echo "
	       <tr >
            <td align='center'  width='5%' nowrap>$i</td>
            <td align='center' nowrap>$new_date</td>";
        for($j=0;$j<sizeof($subjectid1);$j++)
		{
			
			$r2mor=fetchrow(execute("SELECT mor FROM $tablename where stu_id='$studentid[0]' and subject_id='$subjectid1[$j]' and att_date='$old_date'"));
			if($r2mor[0]==0)
			{
				$status="<font color='#FF0000'>Absent</font>";
				$k++;
			}
			
			if($r2mor[0]==1)
			$status="<font color='#0000FF'>Present</font>";
	
			if($r2mor[0]=='')
			$status="--";
	
			echo "<td align='center'  nowrap>$status</td>";
				
		}
        echo "</tr>";
		$i++;
	}
	
	
}
echo "</table>";
?>
</form>	
</body>
</html>
