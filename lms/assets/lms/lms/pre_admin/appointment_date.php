<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
session_start();
require_once("../db1.php");

if($_POST)
{
	$id=$_POST['id'];
	$app_date=$_POST['app_date'];
}
if($_GET and !$_POST)
{
	$id=$_GET['id'];
}

if($_REQUEST[Types] == "submit")
{
					echo "Before app_date :".$app_date;
					echo "<br>";
					$newdate = $app_date;
					$newd = (explode(" ",$newdate)); 
					$newd1 =  $newd[0];
					$time = $newd[1];
					
					echo "Date :".$newd1;
					echo "<br>";
					echo "Time :".$time;
					echo "<br>";
	
    				$app_dateN=$newd1;
					$date=explode('-',$app_dateN);
					$app_dateN="$date[2]-$date[1]-$date[0]";
					$app_date="$app_dateN $time:00";
					
					echo "New  Date :".$app_date;
					echo "<br>";
					 
     $sql="UPDATE `student_m_appointment` SET `app_date`='$app_date' WHERE `id`= $id";
	 echo $sql; 
	 $result=execute($sql); 
		?>
            <script type="text/javascript">
				window.opener.location.reload();
				window.close();
			 </script>
        <?
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link type="text/css" rel="stylesheet" href="calendar/calendar.css?random=201301011010" media="screen"></link>
	<SCRIPT type="text/javascript" src="calendar/calendar.js?random=201301011010"></script>
<script language='javascript'>
	function reloadMe()
	{
		document.frm.action="appointment_date.php?Types=submit";
		document.frm.submit();
	}
</script>
<title>APPOINTMENT DATE</title>
</head>
<body>

<FORM id="frm" NAME="frm" ACTION="appointment_date.php" METHOD="post">
 <input type="hidden" name="id" value="<?=$id?>">
	<br/>
	<table align='center' class=forumline width='90%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3></td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="right">Appointment Date&nbsp;&nbsp;</td>
                <?
					date_default_timezone_set('Asia/Calcutta');
					$current_date=date('d-m-Y H:i:s');
				?>    
                <td><input type="text" id="app_date" value="<?=$current_date?>" readonly name="app_date">
		     <img src="../images/calendar.jpg" align="absmiddle" onClick="displayCalendar(document.forms[0].app_date,'dd-mm-yyyy hh:ii',this,true)"></td>
			</tr>
	
	</table>
        <br/>
       
        <p align="center"><input type="button"  value="Save"  onClick ="reloadMe()" class='bgbutton'></p>

</form>
 </body>
 </html>
