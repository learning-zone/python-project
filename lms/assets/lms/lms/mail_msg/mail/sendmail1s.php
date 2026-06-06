<html>
<head>
<?php
	session_start();
	include("../../db.php");
	include("mailclass.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$user=$_SESSION['user'];
	$class_section_id=$_POST['class_section_id'];
	$check=$_POST['check'];
	$remks=$_POST['remks'];
	$Mail_template=$_POST['Mail_template'];
	
	$qury1=fetchrow(execute("select mail_content,mail_subject  FROM `mail_det` where id='$Mail_template'"));
$message=$qury1[0];
$subject=$qury1[1];
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

$t=0;
$s=0;
 
$ref = getenv("HTTP_REFERER");
$ref1=explode('sendmail.php',$ref);
$updatelinkname=$ref1[0]."count.php?id=";
$logolink=$ref1[0];
if($check)
{
	
	for($i=0;$i<sizeof($check);$i++)
	{
		$sql123=execute("select first_name, img_source_s, last_name from student_m where id='$check[$i]'");
		while($r=fetcharray($sql123))
		{
			if($r[1]!='')
			{
				$parent_mailid= $r[1];
				$sql=rowcount(execute("select id from mail_sent_count where to_mail_id='$parent_mailid' and mail_det_id='$Mail_template'"));				
				
					//$parent_name= "Dear Mr & Mrs $r[0] <br>";
					$parent_name= "Dear  $r[0] $r[2]<br>";
					$updatelinkname=$updatelinkname.$Mail_template."&mailid=".$parent_mailid;
					
					$sql1="INSERT INTO `mail_sent_count` (`username`, `mail_det_id`, `from_mail_id`, `to_mail_id`, `student_id`, `mail_date`, `mail_time`, `mail_count`) VALUES
	( '".$user."', '".$Mail_template."', '".$notify_fromaddress."', '".$parent_mailid."', '".$check[$i]."', '".date("Y-m-d")."', '".date("H:i:s")."', 0)";
					
					execute($sql1);
					
					$mail_boday=$parent_name.$message."<br><br>".$Signatore.'<img src="'.$updatelinkname.'" width="0" height="0" border="0" />
					<br><br><div align="center"><img class="new1" src="'.$logolink.'/logo.jpg"></div>';
					send_mail($notify_fromaddress,$parent_mailid,$mail_smtpserver,$mail_smtpport,$mail_smtpuser,$Domain_name,$mail_smtppass,$subject,$mail_boday);		
				
				$s++;
			}
			$t++;
		//end sms code
		}
	}
}
				$sql2=fetchrow(execute("select count from mail_det where id='$Mail_template'"));				
				$newtot=$sql2[0]+$s;
				execute("update mail_det set count='$newtot' where  id='$Mail_template'");
echo "<h5>Out of $t students $s Mail Sent Succesfully </h5>\n" ;
?>
</body>
</html>

