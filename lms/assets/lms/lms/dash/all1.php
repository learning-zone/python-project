<?PHP
session_start();
$per00=$_SESSION['per00'];
include("../db1.php");
$sem=$_SESSION['sem'];
$branch=$_SESSION['branch'];
$academic_year=$_SESSION['AcademicYear'];
$ststemdate=date("Y-m-d");
//$ststemdate='2013-08-23';
$k=1;
echo "<table border='1'>";
for($i=1;$i<18;$i++)
{
	$atttable='att_'.$i;

	$sql=execute("select a.student_id, a.first_name, a.last_name, a.class_section_id, b.username,a.id, b.mor, b.att_desc from student_m a, $atttable b  where a.course_yearsem='$i' and a.id=b.stu_id  and b.att_date='2013-09-03' order by a.class_section_id  ");
	while($r=fetcharray($sql))
	{
		$gradename=fetchrow(execute("select year_name from course_year where year_id='$i'"));
		$secname=fetchrow(execute("select s_name from  class_section where id='$r[class_section_id]'"));
		$rdet=fetchrow(execute("select rfid , user_type, status from rfid_enrolment_user where user='$r[id]' and user_type=1 and status=1 order by status limit 1"));
		echo "
			<tr>
			<td>$k</td>
			<td nowrap>$r[0]</td>
			<td nowrap>$r[1]  $r[2]</td>
			<td nowrap>$gradename[0] </td>
			<td>$r[mor]</td>";
		echo "<td nowrap>&nbsp;$r[att_desc]</td>";
		echo "<td nowrap>$rdet[0]</td>";
		echo "</tr>";
		$km++;		
	}
}
echo "</table>";
die();
echo "selec rfidno from rfidupdate where att_date='2013-09-03' group by rfidno<table border='1' >";
$sql=execute("select rfidno from rfidupdate where att_date='2013-09-03' group by rfidno");
while($r=fetcharray($sql))
{
	$rdet=fetchrow(execute("select user , user_type, status from rfid_enrolment_user where rfid='$r[0]' order by status limit 1"));
	echo "<tr>
	<td>$k</td>
	<td>$r[0]</td>
	<td>$rdet[0]</td>
	<td>$rdet[1]</td>
	<td>$rdet[2]</td>
	</tr>";	
	$k++;
}
echo "</table>";
die();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Members Present in School</title>
</head>
<body>
	<table class=""  width="80%" height="" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td class="homebody"  scope="row" align="center"><font size="+1"><b>Members Present in School</b></font></td>
	  </tr>
	<tr></tr></table>
 
        <?php
		$i=1;
		
		$sql=execute("SELECT b.user, a.rfidno FROM rfidupdate a, rfid_enrolment_user b, student_m c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and b.user_type='1' and c.id=b.user group by b.rfid order by c.course_yearsem , c.first_name ");
		while($r=fetcharray($sql))
		{
			$intime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and b.user_type='1' and a.rfidno='$r[1]' order by a.id desc limit 1"));

		 	$outtime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and b.user_type='1' and a.rfidno='$r[1]' order by a.id desc limit 1"));
			if($intime[0]>$outtime[0])
			{
				$name=fetchrow(execute("select first_name, last_name, course_yearsem from student_m where id='$r[0]' and academic_year='$academic_year' and archive='N'"));
				$grade=fetchrow(execute("select year_name from course_year where year_id='$name[2]' "));
				if($name[2]!=$yearid)
				{				
					$i=1;
					echo "</table>
					<br style='page-break-before: always;' clear='all' />
					<table class='' align='center'  width='80%'  border='1'  cellpadding='3' cellspacing='0' style='border:1px solid black;'>
					<tr>
					<td class='head' colspan='4'>Students</td>
					</tr>
					<tr>
						<td class='row3'>Sl.No</td>
						<td class='row3'>Name</td>
						<td class='row3'>Grade</td>
						<td class='row3'>Time</td>
					</tr> ";
				}
				$yearid=$name[2];
				echo "
						<tr>
							<td align='center' >$i</td>
							<td >&nbsp;&nbsp;$name[0] $name[1]</td>
							<td  align='center'>$grade[0]</td>
							<td  align='center'>$intime[0]</td>
						</tr> ";
						$i++; 
			}
		}
        ?>
        </table><br style='page-break-before: always;' clear='all' />
 <table class="" align="center"  width="80%"  border="1"  cellpadding="3" cellspacing="0" style="border:1px solid black;">
	  <tr>
      <td class="head" colspan="4">Staff</td>
      </tr>
      <tr>
      	<td class="row3">Sl.No</td>
        <td class="row3">Name</td>
        <td class="row3">Designation</td>
        <td class="row3">Time</td>
       </tr> 	
        <?php
		$i=1;
		$sql=execute("SELECT b.user, a.rfidno FROM rfidupdate a, rfid_enrolment_user b, staff_det c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and b.user_type='2' and c.id=b.user group by b.rfid order by  c.f_name ");
		while($r=fetcharray($sql))
		{
			$intime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and b.user_type='2' and a.rfidno='$r[1]' order by a.id desc limit 1"));

		 	$outtime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and b.user_type='2' and a.rfidno='$r[1]' order by a.id desc limit 1"));
			if($intime[0]>$outtime[0])
			{
				$name=fetchrow(execute("select f_name, s_name, subj from staff_det where id='$r[0]' and active='YES'"));
				$grade=fetchrow(execute("select Dept from dept_no where dpt_id='$name[2]' "));
				
				echo "
						<tr>
							<td align='center' >$i</td>
							<td >&nbsp;&nbsp;$name[0] $name[1]</td>
							<td  align='center'>$grade[0]</td>
							<td  align='center'>$intime[0]</td>
						</tr> ";
						$i++; 
			}
		}
        ?>
        </table><br style='page-break-before: always;' clear='all' />
 <table class="" align="center"  width="80%"  border="1"  cellpadding="3" cellspacing="0" style="border:1px solid black;">
	  <tr>
      <td class="head" colspan="4">Fathers</td>
      </tr>
      <tr>
      	<td class="row3">Sl.No</td>
        <td class="row3">Name</td>
        <td class="row3">Students Grade</td>
        <td class="row3">Time</td>
   </tr> 	
        <?php
		$i=1;
		$sql=execute("SELECT b.user, a.rfidno FROM rfidupdate a, rfid_enrolment_user b, student_m c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and b.user_type='3' and c.id=b.user group by b.rfid order by c.course_yearsem , c.first_name ");
		while($r=fetcharray($sql))
		{
			$intime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and b.user_type='3' and a.rfidno='$r[1]' order by a.id desc limit 1"));

		 	$outtime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and b.user_type='3' and a.rfidno='$r[1]' order by a.id desc limit 1"));
			if($intime[0]>$outtime[0])
			{
				$name=fetchrow(execute("select parent_name, last_name, course_yearsem from student_m where id='$r[0]' and academic_year='$academic_year' and archive='N'"));
				$grade=fetchrow(execute("select year_name from course_year where year_id='$name[2]' "));
				
				echo "
						<tr>
							<td align='center' >$i</td>
							<td >&nbsp;&nbsp;$name[0] </td>
							<td  align='center'>$grade[0]</td>
							<td  align='center'>$intime[0]</td>
						</tr> ";
						$i++; 
			}
		}
        ?>
        </table>
    <br style='page-break-before: always;' clear='all' />
  <table class="" align="center"  width="80%"  border="1"  cellpadding="3" cellspacing="0" style="border:1px solid black;">
	  <tr>
      <td class="head" colspan="4">Mothers</td>
      </tr>
      <tr>
      	<td class="row3">Sl.No</td>
        <td class="row3">Name</td>
        <td class="row3">Students Grade</td>
        <td class="row3">Time</td>
    </tr> 	
        <?php
		$i=1;
		$sql=execute("SELECT b.user, a.rfidno FROM rfidupdate a, rfid_enrolment_user b, student_m c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and b.user_type='4' and c.id=b.user group by b.rfid order by c.course_yearsem , c.first_name ");
		while($r=fetcharray($sql))
		{
			$intime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and b.user_type='4' and a.rfidno='$r[1]' order by a.id desc limit 1"));

		 	$outtime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and b.user_type='4' and a.rfidno='$r[1]' order by a.id desc limit 1"));
			if($intime[0]>$outtime[0])
			{
				$name=fetchrow(execute("select m_name, last_name, course_yearsem from student_m where id='$r[0]' and academic_year='$academic_year' and archive='N'"));
				$grade=fetchrow(execute("select year_name from course_year where year_id='$name[2]' "));
				
				echo "
						<tr>
							<td align='center' >$i</td>
							<td >&nbsp;&nbsp;$name[0] </td>
							<td  align='center'>$grade[0]</td>
							<td  align='center'>$intime[0]</td>
						</tr> ";
						$i++; 
			}
		}
        ?>
        </table>
	<br style='page-break-before: always;' clear='all' />

  <table class="" align="center"  width="80%"  border="1"  cellpadding="3" cellspacing="0" style="border:1px solid black;">
	  <tr>
      <td class="head" colspan="4">Care givers</td>
      </tr>
      <tr>
      	<td class="row3">Sl.No</td>
        <td class="row3">Name</td>
       
        <td class="row3">Time</td>
       </tr> 	
        <?php
		$i=1;
		$sql=execute("SELECT b.user, a.rfidno FROM rfidupdate a, rfid_enrolment_user b, student_photo_other c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and b.user_type='6' and c.id=b.user group by b.rfid order c.s_name ");
		while($r=fetcharray($sql))
		{
			$intime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and b.user_type='6' and a.rfidno='$r[1]' order by a.id desc limit 1"));

		 	$outtime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and b.user_type='6' and a.rfidno='$r[1]' order by a.id desc limit 1"));
			if($intime[0]>$outtime[0])
			{
				$name=fetchrow(execute("select s_name from student_photo_other where id='$r[0]' "));
				
				
				echo "
						<tr>
							<td align='center' >$i</td>
							<td >&nbsp;&nbsp;$name[0] </td>
							
							<td  align='center'>$intime[0]</td>
						</tr> ";
						$i++; 
			}
		}
        ?>
        </table>
      <br style='page-break-before: always;' clear='all' />  
         <table class="" align="center"  width="80%"  border="1"  cellpadding="3" cellspacing="0" style="border:1px solid black;">
	  <tr>
      <td class="head" colspan="4">Visitors</td>
      </tr>
      <tr>
      	<td class="row3">Sl.No</td>
        <td class="row3">Name</td>
       
        <td class="row3">Time</td>
       </tr> 	
        <?php
		$i=1;
		$sql=execute("SELECT b.user, a.rfidno FROM rfidupdate a, rfid_enrolment_user b, visitor_mgt c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and b.user_type='9' and c.id=b.user group by b.rfid order c.visitor_name ");
		while($r=fetcharray($sql))
		{
			$intime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and b.user_type='9' and a.rfidno='$r[1]' order by a.id desc limit 1"));

		 	$outtime=fetchrow(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and b.user_type='9' and a.rfidno='$r[1]' order by a.id desc limit 1"));
			if($intime[0]>$outtime[0])
			{
				$name=fetchrow(execute("select visitor_name from visitor_mgt where id='$r[0]' "));
				
				
				echo "
						<tr>
							<td align='center' >$i</td>
							<td >&nbsp;&nbsp;$name[0] </td>
							
							<td  align='center'>$intime[0]</td>
						</tr> ";
						$i++; 
			}
		}
        ?>
        </table>
        <br style='page-break-before: always;' clear='all' />  
         <table class="" align="center"  width="80%"  border="1"  cellpadding="3" cellspacing="0" style="border:1px solid black;">
	  <tr>
      <td class="head" colspan="5">Medical Room</td>
      </tr>
      <tr>
      	<td class="row3">Sl.No</td>
        <td class="row3">Name</td>
        <td class="row3">Details</td>
        <td class="row3">Type</td>
        <td class="row3">Time</td>
       </tr> 	
                       <?php
		$intime=execute("SELECT  a.rfidno, b.user, b.user_type FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and a.controllerip='192.168.0.33' and  a.readerno='4'  and b.status=1  group by b.rfid ");
		$count=0;
		while($r=fetchrow($intime))
		{
			$intime1=fetchrow(execute("select count(*) from rfidupdate where  rfidno='$r[0]' and att_date='$ststemdate' and controllerip='192.168.0.33' and  readerno='4' "));
			if($intime1[0]%2)
			{
				if($r[2]==1)
				{
					$name=fetchrow(execute("select first_name, last_name, course_yearsem from student_m where id='$r[1]' and academic_year='$academic_year' and archive='N'"));
					$grade=fetchrow(execute("select year_name from course_year where year_id='$name[2]' "));
					echo "
						<tr>
							<td align='center' >$i</td>
							<td >&nbsp;&nbsp;$name[0] $name[1]</td>
							<td  align='center'>$grade[0]</td>
							<td  align='center'>Student</td> 
							<td  align='center'>$intime[0]</td>
						</tr> ";
					
				}
				if($r[2]==2)
				{
					$name=fetchrow(execute("select f_name, s_name, subj from staff_det where id='$r[0]' and active='YES'"));
				$grade=fetchrow(execute("select Dept from dept_no where dpt_id='$name[2]' "));
				
				echo "
						<tr>
							<td align='center' >$i</td>
							<td >&nbsp;&nbsp;$name[0] $name[1]</td>
							<td  align='center'>$grade[0]</td>
							<td  align='center'>Staff</td> 
							<td  align='center'>$intime[0]</td>
						</tr> ";
					
				}
				$count++;
			}
			
		}
		
        
        ?> 
        </table>       <br style='page-break-before: always;' clear='all' />  
         <table class="" align="center"  width="80%"  border="1"  cellpadding="3" cellspacing="0" style="border:1px solid black;">
	  <tr>
      <td class="head" colspan="5">Hostel</td>
      </tr>
      <tr>
      	<td class="row3">Sl.No</td>
        <td class="row3">Name</td>
        <td class="row3">Details</td>
        <td class="row3">Type</td>
        <td class="row3">Time</td>
       </tr> 	
               <?php
		$intime=execute("SELECT  a.rfidno, b.user, b.user_type FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and a.controllerip='192.168.0.33' and  a.readerno='5'  and b.status=1  group by b.rfid ");
		$count=0;
		while($r=fetchrow($intime))
		{
			$intime1=fetchrow(execute("select count(*) from rfidupdate where rfidno='$r[0]' and att_date='$ststemdate' and controllerip='192.168.0.33' and  readerno='5' "));
			if($intime1[0]%2)
			{
				if($r[2]==1)
				{
					$name=fetchrow(execute("select first_name, last_name, course_yearsem from student_m where id='$r[1]' and academic_year='$academic_year' and archive='N'"));
					$grade=fetchrow(execute("select year_name from course_year where year_id='$name[2]' "));
					echo "
						<tr>
							<td align='center' >$i</td>
							<td >&nbsp;&nbsp;$name[0] $name[1]</td>
							<td  align='center'>$grade[0]</td>
							<td  align='center'>Student</td> 
							<td  align='center'>$intime[0]</td>
						</tr> ";
					
				}
				if($r[2]==2)
				{
					$name=fetchrow(execute("select f_name, s_name, subj from staff_det where id='$r[0]' and active='YES'"));
				$grade=fetchrow(execute("select Dept from dept_no where dpt_id='$name[2]' "));
				
				echo "
						<tr>
							<td align='center' >$i</td>
							<td >&nbsp;&nbsp;$name[0] $name[1]</td>
							<td  align='center'>$grade[0]</td>
							<td  align='center'>Staff</td> 
							<td  align='center'>$intime[0]</td>
						</tr> ";
					
				}				
			}
			$count++;
		}
		
        
        ?></table>
 
<!--<div align="center"><input type="button" name="print" value="Print All"></div>
--></body>
</html>