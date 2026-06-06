<?php 
/*
$file_type = "vnd.ms-excel";
$file_name= "ATTENDANCE.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");
*/
session_start();
require("../db.php");

$old_date = '2012-09-10'; // returns Saturday, January 30 10 02:06:34
$old_date_timestamp = strtotime($old_date);
$new_date = date('l', $old_date_timestamp);
	
	$a_year=$_SESSION['AcademicYear'];

	$user=$_SESSION['user'];

	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$class_section_id=$_REQUEST['class_section_id'];
	if($_REQUEST['subject'])
	$subject=$_REQUEST['subject'];
	else
	$subject=0;
	$subject_type=$_REQUEST['subject_type'];
	$subname=$_REQUEST['subname'];
	$sess=$_REQUEST['sess'];
$user=$_SESSION['user'];
$tablename="att_".$sem;
$adate=$_GET['adate'];
$bdate=$_GET['bdate'];
$adate1=explode('/',$adate);
$bdate1=explode('/',$bdate);
   $fdate="$adate1[2]-$adate1[1]-$adate1[0]";
   $todate="$bdate1[2]-$bdate1[1]-$bdate1[0]";

$sql21=execute("select class,section,sub,sub_type from all_teachers where sub_type=2 group by sub order by class");
while($r12=fetcharray($sql21))
{
	//$branch1=$r12[0];
	$sem1=$r12[0];
	$class_section_id1=$r12[1];
}


 ?>	
 <html>
<HEAD>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>

<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='addattendace.php';
	document.frm.submit();
	
}
function selectMe()
{
	var i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}	
</SCRIPT>
</HEAD>

<body>
	<form name="frm" action="" method="post" >
<input type="hidden" name="subname" value="<?=$subname?>">
<input type="hidden" name="branch" value="<?=$branch?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="class_section_id" value="<?=$class_section_id?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="sess" value="<?=$sess?>">
<br>
  <?php
   $sql123.="select b.id,b.student_id,b.first_name,b.last_name,b.admission_id from student_course a,student_m b where a.acc_year='$a_year' and a.stu_id=b.id and a.sub='$subject'  and b.archive='N'  and a.sub_sec='$class_section_id' group by a.stu_id order by b.first_name";
	
	$rs=execute($sql123);
  ?><br>  <table width="70%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <?php

  $sql6=rowcount(execute("SELECT count(id) FROM $tablename where (att_date between '$fdate' and '$todate') and sec='$class_section_id'  and subject_id='$subject' group by att_date order by att_date"));
  	$count1=$sql6+5;
 	$count=$sql6;
  $section_name=fetchrow(execute("select codename,section_name from class_section where id='$class_section_id' and status=1"));
            $course_year=fetchrow(execute("select year_name from course_year where year_id='$sem'"));
			
  ?>
    <tr height="25">
    <td colspan="<?=$count1?>" align="center" class="head">Course-
	<?=$course_year[0]?>&nbsp;&nbsp;&nbsp;<?=$section_name[0]?>-<?=$section_name[1]?>&nbsp;&nbsp;&nbsp;<?=$subname?> 
    Attendance </td>
  </tr>
  <tr>
    <td width="5%" class="head" nowrap>Sl No.</td>
    <td width="20%" align="center" class="head" nowrap>Name</td>
    <td width="10%" align="center" class="head" nowrap>Student Id</td>
    <!--<td width="23%" align="center">Action</td>-->
   <?php
		$sql1=execute("SELECT att_date FROM $tablename where (att_date between '$fdate' and '$todate') and sec='$class_section_id'  and subject_id='$subject' group by att_date order by att_date");
		while($r2=fetcharray($sql1))
		{
			$old_date = $r2[0];
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('M-d', $old_date_timestamp);
			echo "<td align='center' class='head' nowrap>$new_date</td>";
		}
		?>	
  <td align='center' class='head' nowrap>Score</td>
  <td align='center' class='head' nowrap><strong>%</strong></td>
 
 
  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  $flag1=1;
  if($flag1==1)
  {
  	$newcount=$count;
		if($sess=='n')
		$rownameid='after';
		else
		$rownameid='mor';
		
		if($i%2)
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
		echo "
			<td nowrap>&nbsp;$i</td>
			<td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
			<td nowrap align='center'>&nbsp;$r1[student_id]</td>
			";

		$sql1=execute("SELECT att_date FROM $tablename where (att_date between '$fdate' and '$todate') and sec='$class_section_id'  and subject_id='$subject' group by att_date order by att_date");
		while($r2=fetcharray($sql1))
		{
			$sysdate=$r2[0];
			$sql5=execute("select $rownameid from $tablename where att_date='$sysdate' and stu_id='$r1[id]' and sec='$class_section_id'  and subject_id='$subject'");
			$checkiddet=fetchrow($sql5);
			if($checkiddet[0]==1)
			$statuschek='checked';
			else
			$statuschek='';
			
			$flag=1;
			$attst=execute("SELECT order_id, Short_name, Point FROM `attendance_points` order by id ");
			while($nr=fetcharray($attst))
			{      
				if(rowcount($sql5))        
				{
					if($checkiddet[0]==$nr[0])
					{
						$statuschek='checked';
						$naval=$nr[1];
						$navalv=$nr[2];
						
					}
				
				}
				
			
			}
			if(!$navalv)
			{
				$newcount=$newcount-1;
				$bgcolor='red';
			}
			else
			$bgcolor='';
			
			echo "
            <td align='center' class=''>
			<font color='$bgcolor'>
            $naval</font>
            </td>";
		
        }
		echo "<td align='center' class='' nowrap>
				$newcount/$count
            </td>";
			$toper=round((($newcount*100)/$count),2);
			echo "<td align='center' class='' nowrap>$toper</td>";
		$i++;
		echo "</tr>";
  	}
}
  ?>
</table>
<br>				

</form>	
</body>
</html>
