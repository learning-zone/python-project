<?php

	session_start();

	$per00=$_SESSION['per00'];

	include("../db1.php");

	$user=$_SESSION['user'];

	$usernamedet=$_SESSION['usernamedet'];



	if($usernamedet=='parent_name')

		$passfield='parent_username';

	else

		$passfield='parent_password';



//$ststemdate=date("Y-m-d");
$ststemdate='24-10-2013';

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>MEMBERS PRESENT IN SCHOOL</title>
<style type="text/css">
body{
	margin-top:0px;	
	border-bottom-left-radius:13px;
	border-bottom-right-radius:13px;
	border-top-left-radius:13px;
	border-top-right-radius:13px;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	color:#000;
	font-size:14px;
}
</style>
<script type="text/javascript">
function ReloadMe(classid,secid)
{		

	var w=800,h=500;

	var left = (screen.width/2)-(w/2);

	var top = (screen.height/2)-(h/2);

var newWin = window.open ('student_det/view_studlist_att.php?clid='+classid+'&secid='+secid, 'STUDENT ATTENDANCE', '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);



}

function ReloadMe1(classid,secid)
{		

	var w=800,h=500;

	var left = (screen.width/2)-(w/2);

	var top = (screen.height/2)-(h/2);

var newWin = window.open ('all.php?type='+classid+'&secid='+secid, 'STUDENT ATTENDANCE', '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);



}

</script>
</head>
<body >
 <table  width="100%"  border="0"  cellpadding="2" cellspacing="2">

	  <tr>

      <td bgcolor="#EDF5FF" >&nbsp;&nbsp;&nbsp;&nbsp;Students</td>
      <td bgcolor="#EDF5FF" align='center'>

        <?php

		$i=0;

		$sql=execute("SELECT b.user, a.rfidno FROM rfid_student_check_in a, rfid_enrolment_user b, student_m c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1  and a.status=1 and c.id=b.user group by b.rfid order by c.course_yearsem , c.class_section_id, c.first_name");

		while($r=fetcharray($sql))

		{

			$i++;

		}

        

        ?>

        

        <?=$i?></td>

	</tr>

    

	  <tr>
      	<td  bgcolor="#FFFFFF" >&nbsp;&nbsp;&nbsp;&nbsp;Staff</td>
        <td  bgcolor="#FFFFFF" align="center" >

        <?php

		$i=0;

		$sql=execute("SELECT b.user, a.rfidno FROM rfid_staff_check_in a, rfid_enrolment_user b, staff_det c where a.rfidno=b.rfid  and b.status=1 and a.status=1 and c.id=b.user group by b.rfid order by  c.f_name");

		while($r=fetcharray($sql))

		{

			$i++;

		}

        ?>

        <?=$i?></td>

	</tr>

	  <tr>
      <td  bgcolor="#EDF5FF">&nbsp;&nbsp;&nbsp;&nbsp;Fathers</td>
      <td  bgcolor="#EDF5FF" align='center'>

        <?php

		$i=0;

		$sql=execute("SELECT b.user, a.rfidno FROM rfid_others_check_in a, rfid_enrolment_user b, student_m c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and b.user_type='3' and c.id=b.user group by b.rfid order by c.course_yearsem , c.first_name");

		while($r=fetcharray($sql))

		{

			$i++; 

		}

        ?>



        <?=$i?></td>

	</tr>



		<tr><td  bgcolor="#FFFFFF" >&nbsp;&nbsp;&nbsp;&nbsp;Mothers</td>
        <td  bgcolor="#FFFFFF" align="center" >

        <?php

		$i=0;

		$sql=execute("SELECT b.user, a.rfidno FROM rfid_others_check_in a, rfid_enrolment_user b, student_m c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and b.user_type='4' and c.id=b.user group by b.rfid order by c.course_yearsem , c.first_name");

		while($r=fetcharray($sql))

		{

			$i++; 

		}

        ?>

        <?=$i?></td>

	</tr>

	<tr>

<tr><td  bgcolor="#EDF5FF">&nbsp;&nbsp;&nbsp;&nbsp;Care givers</td>
<td  bgcolor="#EDF5FF" align='center'>                      
		<?php

		$i=0;

		$sql=execute("SELECT b.user, a.rfidno FROM rfid_others_check_in a, rfid_enrolment_user b, student_photo_other c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and b.user_type='6' and c.id=b.user group by b.rfid order c.s_name ");

		while($r=fetcharray($sql))

		{

			$i++; 

		}

        ?>

        <?=$i?></td>

	</tr>

	<tr><td  bgcolor="#FFFFFF" >&nbsp;&nbsp;&nbsp;&nbsp;Visitors</td>
    <td  bgcolor="#FFFFFF" align="center" > <?php

		$i=0;

		$sql=execute("SELECT b.user, a.rfidno FROM rfid_others_check_in a, rfid_enrolment_user b, visitor_mgt c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and b.user_type='9' and c.id=b.user group by b.rfid order c.visitor_name ");

		while($r=fetcharray($sql))

		{

			$i++; 

		}

        ?>

        <?=$i?></td>

	</tr>

<tr><td  bgcolor="#EDF5FF">&nbsp;&nbsp;&nbsp;&nbsp;Medical Room</td>
<td  bgcolor="#EDF5FF" align='center'>

        <?php

		$count=0;

		$sql=execute("SELECT a.rfidno, b.user, b.user_type FROM rfid_medical_check a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and b.status=1 and a.status=1 group by b.rfid ");

		while($r=fetcharray($sql))

		{

			$count++;

		}

		

        ?>

        <?=$count?>

        

        </td>

	</tr>	

<tr><td  bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;Hostel</td>
<td  bgcolor="#FFFFFF" align="center">               

		<?php

		$count=0;

		$sql=execute("SELECT a.rfidno, b.user, b.user_type FROM rfid_hostel_check a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and b.status=1 and a.status=1 group by b.rfid ");

		while($r=fetcharray($sql))

		{

			$count++;

		}

		

        ?>

        <?=$count?></td>

	</tr>  

  <tr>
  		<td colspan="2" align="right"  bgcolor="#FFFFFF">
        <a href="javascript:ReloadMe1('h')">Print All</a>&nbsp;&nbsp;&nbsp;</td></tr>  

      </table>

</body>

</html>