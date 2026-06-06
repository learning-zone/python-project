<html>
<head>
<?php
	session_start();
	include("../db.php");
	include("mail_class.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$check=$_POST['check'];
	$remks=$_POST['remks'];
	$type=$_POST['type'];
	if(sizeof($check)==0)
	{	
		$Mailsent='Select the check box ';
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=FetchsubjectDet1.php?msg=$Mailsent&branch=$branch&sem=$sem&class_section_id=$class_section_id&type=$type'>";
		die();
	}
echo "<blink>Sending messages......</blink>";

$t=0;
$s=0;	
if($check)
{
	
	for($i=0;$i<sizeof($check);$i++)
	{
		$sql123=execute("select f_name, s_name , mobileno, id from staff_det where id='$check[$i]'");
		while($r=fetcharray($sql123))
		{
			if($r[2]=='' || $r[2]==0 || $r[2]=='0')
			{
				echo "Mobile number not found<br>";
			}
			else	
			{
				 
				$mobilenumbers= "$r[2]"; //enter Mobile numbers comma seperated
				$message = "Announcement $remks"; //enter Your Message 
				$studentid=$r[3];
				send_msg($mobilenumbers,$message,$studentid,$sem);
				$s++;
			}
			$t++;
		//end sms code
		}
	}
}
$bl=$t-$s;
$Mailsent="Total Message attempted to send $t,  
Successfully sent $s,  
Invalid Mobile Nos. $bl" ;
echo "<META HTTP-EQUIV='Refresh' Content='2;URL=FetchsubjectDet1.php?msg=$Mailsent&branch=$branch&sem=$sem&class_section_id=$class_section_id&type=$type'>";
?>
