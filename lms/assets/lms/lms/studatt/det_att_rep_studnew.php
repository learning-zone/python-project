<?php
session_start();
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
	document.frm.action='det_att_rep_studnew.php';
	document.frm.submit();
}

</SCRIPT>
</HEAD>

<body>
<?php 
$a_year=$_SESSION['AcademicYear'];
$sem1=$_GET['sem'];
$tablename='att_'.$sem1;
$studentid[]=$_GET['StudID'];
$user=$studentid[0];


$sqldet=execute("select a.id,a.codename,a.section_name,a.sub,a.grade,b.stu_id from class_section a,student_course b,student_m c where a.status=1 and a.id=b.sub_sec and b.acc_year='$a_year' and b.stu_id=c.id and c.archive='N' and c.id='$user' group by a.id,b.stu_id order by a.grade,a.codename,a.section_name");

$a=rowcount($sqldet);
$a=$a+2;
$studentname=fetcharray(execute("select first_name, last_name from student_m where id='$studentid[0]'"));

$name=$studentname[0].' '.$studentname[1];

$sql_id=fetchrow(execute("select type from attendance where `acc_year`='$a_year' and `class_id`='$sem1' and status=1"));
if($sql_id[0]==1)
{
?>
    <br>    
    <table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
        <tr height="10">
            <td colspan='<?=$a?>' align='center' class='head'>Attendance Report For <?=$name?></td></tr>
        <tr >
            <td align="center" class="head" width="5%" nowrap>Sl No.</td>
            <td align="center" class="head" width="5%" nowrap>Date</td>
            
<?php       
 while($r=fetchrow($sqldet))
 {    
            echo "<td align='center' class='head' nowrap>$r[1]</td>";
			$subid[]=$r[0];
 }
?>
       </tr>
	
<?php
	$i=1;
	$k=0;

	$sql1=execute("SELECT att_date FROM $tablename where stu_id='$studentid[0]'  group by att_date order by att_date desc");
	while($r2=fetcharray($sql1))
	{
		$old_date = $r2[0];
		$old_date_timestamp = strtotime($old_date);
		$new_date = date('d-M-Y', $old_date_timestamp);
		echo "
		<tr >
			<td align='center'  width='5%' nowrap>$i</td>
			<td align='center' nowrap>$new_date</td>";

		for($k=0;$k<sizeof($subid);$k++)
		{
			$subval=$subid[$k];

			$rmor=fetchrow(execute("select mor from  $tablename where stu_id='$studentid[0]'  and att_date='$r2[0]' and sec='$subval'"));
			if($rmor[0])
			{
				$rmor1=fetchrow(execute("select Description,Point from attendance_points where order_id='$rmor[0]'"));
				if($rmor1[1]==0)
				{
					$status="<font color='#FF0000'>$rmor1[0]</font>";
				}
				else
				{
					$status="<font color='#0000FF'>$rmor1[0]</font>";
					$subidtotp[$k]=$subidtotp[$k]+1;
				}
			}
			else
				$status="<font color='#FF0000'>AB</font>";	
					
			echo "<td align='center'  nowrap>$status</td>";
			$subidtot[$k]=$subidtot[$k]+1;
			
		}
		echo "</tr>";
		$i++;
	}
echo "<tr >
		<td align='center' colspan='2' nowrap>Total </td>";
		for($k=0;$k<sizeof($subid);$k++)
		{
			$toper=round((($subidtotp[$k]*100)/$subidtot[$k]),2);
			echo "<td align='center'  nowrap>$toper</td>";
		}
echo "</tr>";
	echo "</table>";
}
if($sql_id[0]==3)
{

	
	
}
?>
</form>	
</body>
</html>
