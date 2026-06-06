<html>
<head>
<?php
	session_start();
	
	$user_name = $_SESSION['user'];
	
	include("../../db.php");
	//include("mailclass.php");
	echo "<pre>";
	//print_r($_GET);
	//print_r($_POST);
	echo "</pre>";
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$user=$_SESSION['user'];
	$class_section_id=$_POST['class_section_id'];
	$check=$_POST['check'];
	$remks=$_POST['remks'];
	$Mail_template=$_POST['Mail_template'];
	
	
$sendto=$_REQUEST['sendto'];
$staff_dd=$_REQUEST['staff_dd'];
$staff_dd1=$_REQUEST['staff_dd1'];
$selected_student1=$_REQUEST['selected_student1'];
	
	$subject=$_POST['subject']; // mail subject
	$editor1=$_POST['editor1']; // mail body
	$store_stud=$_POST['store_stud'];
	$message=$editor1;
	$subject=$subject;
	$sendto=$_POST['sendto'];
	$person_type=$_POST['person_type'];
/*	$qury1=fetchrow(execute("select mail_content,mail_subject  FROM `mail_det` where id='$Mail_template'"));
$message=$qury1[0];
$subject=$qury1[1];

*/
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
 
 	$attachment='';
	
	$adtevat=date("Y-m-d");
	
	$sql3=execute("select id,username,name,link from  mail_attachments where adate='$adtevat' and status=1 and username='$user' and str_id='$store_stud'");
if(rowcount($sql3)>=1)
{	
	$attachment.="Attachments :  ";
	while($r6=fetcharray($sql3))
	{
		$link=$r6['link'];
		//str_replace(find,replace,string,count) 
		$link2=str_replace('attachments/','',$link,$count); 
		
		$link1='http://www.mbis.myschoolone.com/renew/mail_msg/mail/'.$link; 
		
		$attachment.="<a href='$link1' title='click here'>$r6[name]</a>&nbsp;&nbsp;&nbsp;   ";
	}
	$attachment.="<hr><br><br>";

}
 
$ref = getenv("HTTP_REFERER");
$ref1=explode('sendmail.php',$ref);
$logolink=$ref1[0];
$updatelinkname=$ref1[0]."count.php?id=";
$sysdate=date("Y-m-d");

for($staffid=0;$staffid<sizeof($selected_student1);$staffid++)
		{
			
			$staff_id = $selected_student1[$staffid];
			$staff_sql="SELECT `id`,`f_name` as first_name,`s_name` as last_name, `email` FROM `staff_det` where id ='$staff_id'";
			$staff_id_rs = fetchrow(execute($staff_sql));
			$staff_list_id = $staff_id_rs[0];
			$staff_list_name = $staff_id_rs[1];
			$staff_list_lname = $staff_id_rs[2];
			$staff_list_email = $staff_id_rs[3];//person_type
			$insert_sql = "INSERT INTO `student_mail_list` (`date_entered`, `staff_idss`, `first_name`, `last_name`, `staff_mailid`, `parent_name`, `m_name`, `f_email`, `m_email`, `g_name`, `g_mail`, `user`, `person_type`,`store_ids`) VALUES ('$sysdate', '$staff_id', '$staff_list_name', '$staff_list_lname', '$staff_list_email', NULL, NULL, NULL, NULL, NULL, NULL, '$user_name', 'staff','$store_stud')";
				$insert_rs = execute($insert_sql);
		}


//stud family mails	
$cunt=0;
$sendto=$_POST['sendto'];
for($i=0;$i<8;$i++)
{
	$sendtnewwal=$_REQUEST['sendto'.$i];

	
	
	if($sendtnewwal==5)
	$sqlst=execute("select id,staff_mailid,first_name from student_mail_list where staff_mailid!='' and  staff_mailid!='#N/A' and `user`='$user'  and `date_entered`='$sysdate' and store_ids='$store_stud' ");
	
	if($sendtnewwal==4)
	$sqlst=execute("select id,emrgcy_mails,parent_name from student_mail_list where emrgcy_mails!='' and  emrgcy_mails!='#N/A' and `user`='$user'  and `date_entered`='$sysdate' and store_ids='$store_stud' ");
	
	if($sendtnewwal==7)
	$sqlst=execute("select id,`f_email`, `parent_name` from student_mail_list where f_email!='' and f_email!='#N/A' and `user`='$user'  and `date_entered`='$sysdate'  and store_ids='$store_stud'");
	
	if($sendtnewwal==2)
	$sqlst=execute("select  id,`m_email`, `m_name` from student_mail_list where m_email!='' and m_email!='#N/A' and `user`='$user'  and `date_entered`='$sysdate'  and store_ids='$store_stud'");
	
	if($sendtnewwal==3)
	$sqlst=execute("select  id,`g_mail`, `g_name` from student_mail_list where g_mail!='' and g_mail!='#N/A' and `user`='$user'  and `date_entered`='$sysdate'  and store_ids='$store_stud'");
	
	if($sendtnewwal==1)
	$sqlst=execute("select id,`stud_mailss`, first_name, last_name from student_mail_list where stud_mailss!='#N/A' and stud_mailss!='' and `user`='$user'  and `date_entered`='$sysdate'  and store_ids='$store_stud'");
	
	if($sendtnewwal==6)
$sqlst=execute("select id,From_address,From_name from mail_settings where user_id='$user' and status=1");

	while($r=fetcharray($sqlst))
	{
		if($r[1]!='')
		{
			
				$parent_mailid= $r[1];
		/*	$sql=rowcount(execute("select id from mail_sent_count where to_mail_id='$parent_mailid' and mail_det_id='$Mail_template'"));				
		*/	
				if($sendtnewwal==7)
				{
				$parent_name= "Dear Mr $r[2] ";
				}
				elseif($sendtnewwal==2)
				{
				$parent_name= "Dear Mrs $r[2] ";
				}
				else
				{
				$parent_name= "Dear $r[2]";
				}
				
				if($r[3]!='#N/A')
				$parent_name.="$r[3]";
				
				
				$parent_name.=",<br>";
				//$parent_name= "Dear Parent <br>";
				$parent_name='<br>';
				$updatelinkname=$updatelinkname.$Mail_template."&mailid=".$parent_mailid;
				
				$sql1="INSERT INTO `mail_sent_count` (`username`, `mail_det_id`, `from_mail_id`, `to_mail_id`, `student_id`, `mail_date`, `mail_time`, `mail_count`) VALUES
( '".$user."', '".$Mail_template."', '".$notify_fromaddress."', '".$parent_mailid."', '".$check[$i]."', '".date("Y-m-d")."', '".date("H:i:s")."', 0)";
				
				execute($sql1);
				
				$mail_boday=$attachment.$parent_name.$message."<br><br>".$Signatore;
				$mail_boday=urlencode($mail_boday);
				//echo $mailbody=urldecode($mailbody);
			$responce="Cound not send the message to";
				//echo $responce=send_mail($notify_fromaddress,$parent_mailid,$mail_smtpserver,$mail_smtpport,$mail_smtpuser,$Domain_name,$mail_smtppass,$subject,$mail_boday,$notify_fromname);
			

				$mastmailid=fetchrow(execute("select max(id) `mail_sent_count` where `from_mail`='$notify_fromaddress' and to_mail='$parent_mailid'"));
				$date=date("Y-m-d");
				$time=date("H:i:s");

				execute("INSERT INTO `mail_logs` (`mail_sent_id`,`mail_det`, `response`, `status`, `mail_date`, `mail_time`, `user`, `from_mail`, `to_mail`, `subject`) VALUES ('$mastmailid[0]','$mail_boday', '$responce', '1', '$date', '$time', '$user', '$notify_fromaddress', '$parent_mailid', '$subject')");
	
			$s++;
			$cunt++;
		}
		$t++;
	
	}//end sms code
}
	
	execute("update student_mail_list set status=0 where `user`='$user'  and `date_entered`='$sysdate' and person_type='$person_type'");
	
				$sql2=fetchrow(execute("select count from mail_det where id='$Mail_template'"));				
				$newtot=$sql2[0]+$s;
				execute("update mail_det set count='$newtot' where  id='$Mail_template'");
				execute("update mail_attachments set status=0 where username='$user'");
				
				
				echo $cunt." Mails in queue to be sent.";
				
//echo "<h5>Out of $t Parents $s Mail Sent Succesfully </h5>\n" ;

?>
</body>
</html>
