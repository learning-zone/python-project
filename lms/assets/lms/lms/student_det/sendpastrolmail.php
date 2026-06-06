<html>
<head>
<?php
session_start();
include("../db.php");
include("../mail_msg/mail/mailclass.php");
print_r($_POST);
//die();
$parent_check = $_POST['parent'];

if($parent_check != '1')
{
	die("Recepient Not Selected");
}

$user=$_SESSION['user'];
$event_id = $_POST['event_id'];
$description = $_POST['description'];
$StudID = $_POST['StudID'];
$eventdate = $_POST['adate'];
$message = "<br>Event : ".$event_id."<br>"."Event Date : ".$eventdate."<br>".$description;
$sql_students="SELECT `id`,`first_name`,`last_name`, `rgmailid`, `parent_name`, `m_name`, `f_email`, `m_email`, `g_name`, `g_mail` FROM `student_m` WHERE id ='$StudID'";
//WHERE id is not null  AND academic_year='$a_year'";
$students_id = fetchrow(execute($sql_students));
$student_list_id = $students_id[0];
$student_list_name = $students_id[1];
$student_list_lname = $students_id[2];
$student_list_mailid = $students_id[3];
$parent_name1 = $students_id[4];
$student_name_mname = $students_id[5];
$student_name_pmailid = $students_id[6];
$student_name_mmailid = $students_id[7];
$student_name_gname = $students_id[8];
$student_name_gmaidid = $students_id[9];

$sql_event = "SELECT * FROM student_m_event WHERE `id` = '$event_id'";
$event_id = fetchrow(execute($sql_event));
$event_name = $event_id[1];
$message = "<br>Event : ".$event_name."<br>"."Event Date : ".$eventdate."<br>".$description;

$attachment='';
$subject = "Pastoral Care";
$parent_mailid = $student_name_pmailid;
$parent_name = "Dear Mr ".$parent_name1;

$mother_mailid = $student_name_mmailid;
$mother_name = "Dear Mrs ".$student_name_mname;
//echo "Student name : ".$student_name;
//echo "select * from `mail_settings` where `user_id`='$user' and status='1'";
$quer=execute("select * from `mail_settings` where `user_id`='$user' and status='1'");
	while($r1=fetcharray($quer))
	{
		$notify_fromname=$r1['From_name'];
		$notify_fromaddress=$r1['From_address'];
		$Domain_name=$r1['Domain_name'];
		$mail_smtpserver=$r1['SMTP'];
		$mail_smtpport=$r1['SMTP_Port'];
		$mail_smtpuser=$r1['Username'];
		$mail_smtppass=$r1['Password'];
		$Signatore=$r1['Signatore'];
	}
	
$ref = getenv("HTTP_REFERER");
$ref1=explode('sendmail.php',$ref);
$logolink=$ref1[0];
$updatelinkname=$ref1[0]."count.php?id=";

$sysdate=date("Y-m-d");

$sql_count="INSERT INTO `mail_sent_count` (`username`, `mail_det_id`, `from_mail_id`, `to_mail_id`, `student_id`, `mail_date`, `mail_time`, `mail_count`) VALUES
( '".$user."', '".$Mail_template."', '".$notify_fromaddress."', '".$parent_mailid."', '".$StudID."', '".date("Y-m-d")."', '".date("H:i:s")."', 0)";
$rs = execute($sql_count);


				
				$mail_boday=$attachment.$parent_name.$message."<br><br>".$Signatore;
				//echo "<br>".$mail_boday."<br>";
				echo $responce=send_mail($notify_fromaddress,$parent_mailid,$mail_smtpserver,$mail_smtpport,$mail_smtpuser,$Domain_name,$mail_smtppass,$subject,$mail_boday,$notify_fromname);
				
// send mail to mother
$sql_count="INSERT INTO `mail_sent_count` (`username`, `mail_det_id`, `from_mail_id`, `to_mail_id`, `student_id`, `mail_date`, `mail_time`, `mail_count`) VALUES
( '".$user."', '".$Mail_template."', '".$notify_fromaddress."', '".$mother_mailid."', '".$StudID."', '".date("Y-m-d")."', '".date("H:i:s")."', 0)";
$rs = execute($sql_count);


				
				$mail_boday=$attachment.$mother_name.$message."<br><br>".$Signatore;
				//echo "<br>".$mail_boday."<br>";
				echo $responce=send_mail($notify_fromaddress,$mother_mailid,$mail_smtpserver,$mail_smtpport,$mail_smtpuser,$Domain_name,$mail_smtppass,$subject,$mail_boday,$notify_fromname);
// end sending mail to mother
?>
</body>
</html>