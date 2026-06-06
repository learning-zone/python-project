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

$ststemdate=date("Y-m-d");
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
#marqueecontainer {
	position: relative;
	width: 390px; /*marquee width */
	height: 210px; /*marquee height */
	background-color: light orange;
	overflow: hidden;
	border: none;
	padding: 2px;
	padding-left: 4px;

}
.scroll_div {
	background-color: light orange;
	border: solid 1px #66CCFF;
	width: 300px;
	width /**/: 280px !important;
}
.vmarquee_content {
	position: absolute;
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
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
<script type="text/javascript" src="Code/Highcharts-3.0.2/js/jquery.min.js"></script>

</head>
<body style="background-image:url(bgy.png)" >
 <table class=""  width="100%"  border="1"  cellpadding="3" cellspacing="10" style="border:1px solid black;">
	  <tr>
      <td style="border:0px solid black;" bgcolor="#EDF5FF"><b>&nbsp;&nbsp;&nbsp;&nbsp;
        Students</b></td><td style="border:0px solid black;" bgcolor="#EDF5FF">
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
    
	  <tr><td style="border:0px solid black;" bgcolor="#FFFFFF" ><b>&nbsp;&nbsp;&nbsp;&nbsp;
        Staff</b></td><td style="border:0px solid black;" bgcolor="#FFFFFF" >
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
	
    
	  <tr><td style="border:0px solid black;" bgcolor="#EDF5FF"><b>&nbsp;&nbsp;&nbsp;&nbsp;
        Fathers</b></td><td style="border:0px solid black;" bgcolor="#EDF5FF">
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

		<tr><td style="border:0px solid black;" bgcolor="#FFFFFF" ><b>&nbsp;&nbsp;&nbsp;&nbsp;
        Mothers</b></td><td style="border:0px solid black;" bgcolor="#FFFFFF" >
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
<tr><td style="border:0px solid black;" bgcolor="#EDF5FF"><b>&nbsp;&nbsp;&nbsp;&nbsp;
        Care givers</b></td><td style="border:0px solid black;" bgcolor="#EDF5FF">                      <?php
		$i=0;
		$sql=execute("SELECT b.user, a.rfidno FROM rfid_others_check_in a, rfid_enrolment_user b, student_photo_other c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and b.user_type='6' and c.id=b.user group by b.rfid order c.s_name ");
		while($r=fetcharray($sql))
		{
			$i++; 
		}
        ?>
        <?=$i?></td>
	</tr>
<tr><td style="border:0px solid black;" bgcolor="#FFFFFF" ><b>&nbsp;&nbsp;&nbsp;&nbsp;
        Visitors</b></td><td style="border:0px solid black;" bgcolor="#FFFFFF" > <?php
		$i=0;
		$sql=execute("SELECT b.user, a.rfidno FROM rfid_others_check_in a, rfid_enrolment_user b, visitor_mgt c where a.rfidno=b.rfid and a.att_date='$ststemdate'  and b.status=1 and a.status=1 and b.user_type='9' and c.id=b.user group by b.rfid order c.visitor_name ");
		while($r=fetcharray($sql))
		{
			$i++; 
		}
        ?>
        <?=$i?></td>
	</tr>
<tr><td style="border:0px solid black;" bgcolor="#EDF5FF"><b>&nbsp;&nbsp;&nbsp;&nbsp;
        Medical Room</b></td><td style="border:0px solid black;" bgcolor="#EDF5FF">
        <?php
		$count=0;
		$sql=execute("SELECT  a.rfidno, b.user, b.user_type FROM rfid_medical_check a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and b.status=1 group by b.rfid ");
		while($r=fetcharray($sql))
		{
			$intime1=fetchrow(execute("select count(*) from rfid_medical_check where  rfidno='$r[0]' and att_date='$ststemdate' "));
			if($intime1[0]%2)
			$count++;
		}

        ?>
        <?=$count?></td>
	</tr>	
<tr><td style="border:0px solid black;" bgcolor="#FFFFFF"><b>&nbsp;&nbsp;&nbsp;&nbsp;
        Hostel</b></td><td style="border:0px solid black;" bgcolor="#FFFFFF">               
		<?php
		$count=0;
		$sql=execute("SELECT a.rfidno, b.user, b.user_type FROM rfid_hostel_check a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and b.status=1 group by b.rfid ");
		while($r=fetcharray($sql))
		{
			$intime1=fetchrow(execute("select count(*) from rfid_hostel_check where  rfidno='$r[0]' and att_date='$ststemdate' "));
			if($intime1[0]%2)
			$count++;
		}
		
        ?>
        <?=$count?></td>
	</tr>  
  <tr><td colspan="2" align="right" style="border:0px solid black;" bgcolor="#FFFFFF"><b>
        <a href="javascript:ReloadMe1('h')">PRINT ALL</a>&nbsp;&nbsp;&nbsp;</td></tr>  
      </table>
</body>
</html>