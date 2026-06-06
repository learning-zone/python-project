<?PHP
session_start();
$per00=$_SESSION['per00'];
include("../db.php");
$sem=$_SESSION['sem'];
$branch=$_SESSION['branch'];
$academic_year=$_SESSION['AcademicYear'];
$ststemdate=date("Y-m-d");
//$ststemdate='2013-08-23';

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
		$sql=execute("SELECT b.user, a.rfidno FROM rfid_student_check_in a, rfid_enrolment_user b, student_m c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1  and a.status=1 and c.id=b.user group by b.rfid order by c.course_yearsem , c.class_section_id, c.first_name ");
		while($r=fetcharray($sql))
		{
			
				$name=fetchrow(execute("select first_name, last_name, course_yearsem,class_section_id from student_m where id='$r[0]' and academic_year='$academic_year' and archive='N'"));
				$grade=fetchrow(execute("select year_name from course_year where year_id='$name[2]' "));
				$secn=fetchrow(execute("select section_name from class_section where id='$name[3]' "));
				$intime=fetchrow(execute("select att_time,att_date from rfid_student_check_in where rfidno='$r[1]' order by id desc limit 1 "));
				
				if($intime[1]!=date("Y-m-d"))
				$calr='#FF0000';
				else
				$calr='';
				if($name[2]!=$yearid)
				{				
					
						$i=1;
						echo "</table>
						<br style='page-break-before: always;' clear='all' />
						<table class='' align='center'  width='80%'  border='1'  cellpadding='3' cellspacing='0' style='border:1px solid black;'>
						<tr>
						<td class='head' colspan='6'>Students</td>
						</tr>
						<tr>
						<td class='row3'>Sl.No</td>
						<td class='row3'>Name</td>
						<td class='row3'>Grade</td>
						<td class='row3'>Section</td>
						<td class='row3'>Date</td>
						<td class='row3'>Time</td>
						</tr> ";
					
					$m=0;
				
				}
				if($secn1!=$name[3] and $m!=0)
				{
					$i=1;
					echo "</table>
					<br style='page-break-before: always;' clear='all' />
					<table class='' align='center'  width='80%'  border='1'  cellpadding='3' cellspacing='0' style='border:1px solid black;'>
					<tr>
					<td class='head' colspan='6'>Students</td>
					</tr>
					<tr>
					<td class='row3'>Sl.No</td>
					<td class='row3'>Name</td>
					<td class='row3'>Grade</td>
					<td class='row3'>Section</td>
					<td class='row3'>Date</td>
					<td class='row3'>Time</td>
					</tr> ";
					
				}
				$m=1;
				$yearid=$name[2];
				$secn1=$name[3];
				echo "
						<tr>
							<td align='center' ><font color='$calr'>$i</font></td>
							<td >&nbsp;&nbsp;<font color='$calr'>$name[0] $name[1]</font></td>
							<td  align='center'><font color='$calr'>$grade[0]</font></td>
							<td  align='center'><font color='$calr'>$secn[0]</font></td>
							<td  align='center'><font color='$calr'>$intime[1]</font></td>
	
							<td  align='center'><font color='$calr'>$intime[0]</font></td>
						</tr> ";
						$i++; 
		}
        ?>
        </table><br style='page-break-before: always;' clear='all' />
 <table class="" align="center"  width="80%"  border="1"  cellpadding="3" cellspacing="0" style="border:1px solid black;">
	  <tr>
      <td class="head" colspan="5">Staff</td>
      </tr>
      <tr>
      	<td class="row3">Sl.No</td>
        <td class="row3">Name</td>
        <td class="row3">Designation</td>
         <td class="row3">Date</td>
        <td class="row3">Time</td>
       </tr> 	
        <?php
		$i=1;
		//$sql=execute("SELECT b.user, a.rfidno FROM rfid_staff_check_in a, rfid_enrolment_user b, staff_det c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and c.id=b.user group by b.rfid order by  c.f_name ");
		
		
		$sql=execute("SELECT b.user, a.rfidno FROM rfid_staff_check_in a, rfid_enrolment_user b, staff_det c where a.rfidno=b.rfid  and b.status=1 and a.status=1 and c.id=b.user group by b.rfid order by  c.f_name ");
		
		while($r=fetcharray($sql))
		{
			$name=fetchrow(execute("select f_name, s_name, subj from staff_det where id='$r[0]' and active='YES'"));
			$grade=fetchrow(execute("select Dept from dept_no where dpt_id='$name[2]' "));
			$intime=fetchrow(execute("select att_time,att_date from rfid_staff_check_in where rfidno='$r[1]' order by id desc limit 1 "));
		
			if($intime[1]!=date("Y-m-d"))
			$calr='#FF0000';
			else
			$calr='';
			
			echo "
			<tr>
			<td align='center' ><font color='$calr'>$i</font></td>
			<td >&nbsp;&nbsp;<font color='$calr'>$name[0] $name[1]</font></td>
			<td  align='center'><font color='$calr'>$grade[0]</font></td>
			<td  align='center'><font color='$calr'>$intime[1]</font></td>
			<td  align='center'><font color='$calr'>$intime[0]</font></td>
			</tr> ";
			$i++; 
		}
        ?><font color=""></font>
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
		$sql=execute("SELECT b.user, a.rfidno FROM rfid_others_check_in a, rfid_enrolment_user b, student_m c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and b.user_type='3' and c.id=b.user group by b.rfid order by c.course_yearsem , c.first_name ");
		while($r=fetcharray($sql))
		{
			$name=fetchrow(execute("select parent_name, last_name, course_yearsem from student_m where id='$r[0]' and academic_year='$academic_year' and archive='N'"));
			$grade=fetchrow(execute("select year_name from course_year where year_id='$name[2]' "));
			$intime=fetchrow(execute("select att_time from rfid_others_check_in where rfidno='$r[1]' order by id desc limit 1 "));
			
			echo "
			<tr>
			<td align='center' >$i</td>
			<td >&nbsp;&nbsp;$name[0] </td>
			<td  align='center'>$grade[0]</td>
			<td  align='center'>$intime[0]</td>
			</tr> ";
			$i++; 
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
		$sql=execute("SELECT b.user, a.rfidno FROM rfid_others_check_in a, rfid_enrolment_user b, student_m c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and b.user_type='4' and c.id=b.user group by b.rfid order by c.course_yearsem , c.first_name ");
		while($r=fetcharray($sql))
		{
			$name=fetchrow(execute("select m_name, last_name, course_yearsem from student_m where id='$r[0]' and academic_year='$academic_year' and archive='N'"));
			$grade=fetchrow(execute("select year_name from course_year where year_id='$name[2]' "));
			$intime=fetchrow(execute("select att_time from rfid_others_check_in where rfidno='$r[1]' order by id desc limit 1 "));
			
			echo "
			<tr>
			<td align='center' >$i</td>
			<td >&nbsp;&nbsp;$name[0] </td>
			<td  align='center'>$grade[0]</td>
			<td  align='center'>$intime[0]</td>
			</tr> ";
			$i++; 
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
		$sql=execute("SELECT b.user, a.rfidno FROM rfid_others_check_in a, rfid_enrolment_user b, student_photo_other c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and b.user_type='6' and c.id=b.user group by b.rfid order c.s_name ");
		while($r=fetcharray($sql))
		{
			$name=fetchrow(execute("select s_name from student_photo_other where id='$r[0]' "));
			$intime=fetchrow(execute("select att_time from rfid_others_check_in where rfidno='$r[1]' order by id desc limit 1 "));
			echo "
			<tr>
			<td align='center' >$i</td>
			<td >&nbsp;&nbsp;$name[0] </td>
			
			<td  align='center'>$intime[0]</td>
			</tr> ";
			$i++; 
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
		$sql=execute("SELECT b.user, a.rfidno FROM rfid_others_check_in a, rfid_enrolment_user b, visitor_mgt c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and b.user_type='9' and c.id=b.user group by b.rfid order c.visitor_name ");
		while($r=fetcharray($sql))
		{
			$name=fetchrow(execute("select visitor_name from visitor_mgt where id='$r[0]' "));
			$intime=fetchrow(execute("select att_time from rfid_others_check_in where rfidno='$r[1]' order by id desc limit 1 "));
			echo "
			<tr>
				<td align='center' >$i</td>
				<td >&nbsp;&nbsp;$name[0] </td>
				<td  align='center'>$intime[0]</td>
			</tr> ";
			$i++; 
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
			   
		$intime6=execute("SELECT a.rfidno, b.user, b.user_type FROM rfid_medical_check a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and a.status=1 and b.status=1 group by b.rfid ");
		$count=0;
		while($r=fetchrow($intime6))
		{
			
				$intime=fetchrow(execute("select att_time from rfid_medical_check where rfidno='$r[0]' and status=1 order by id desc limit 1 "));
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
					$name=fetchrow(execute("select f_name, s_name, subj from staff_det where id='$r[1]' "));
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
			$i++;
			$count++;
		}
		
        
        ?></table>  <br style='page-break-before: always;' clear='all' />  
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
			   
		$intime6=execute("SELECT a.rfidno, b.user, b.user_type FROM rfid_hostel_check a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and a.status=1 and b.status=1 group by b.rfid ");
		$count=0;
		while($r=fetchrow($intime6))
		{
			
				$intime=fetchrow(execute("select att_time from rfid_hostel_check where rfidno='$r[0]' and status=1 order by id desc limit 1 "));
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
					$name=fetchrow(execute("select f_name, s_name, subj from staff_det where id='$r[1]' "));
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
			$i++;
			$count++;
		}
		
        
        ?></table>
 
<!--<div align="center"><input type="button" name="print" value="Print All"></div>
--></body>
</html>