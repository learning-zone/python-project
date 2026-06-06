<?php
session_start();
function send_msg($phonenumber,$contant,$studentid,$sem)
{
	include("db1.php");
	$user=$_SESSION['user'];
	$sysdate=date("Y-m-d");
	$systime=date("H:i:s");
	//$text=urlencode("xxx");
	//Initialize the sender variable
	//$sender=urlencode("xxxxx");
	//Initialize the URL variable
	//$URL="www.unicel.in/SendSMS/sendmsg.php";
	//Create and initialize a new cURL resource
	
	if($phonenumber!='' and $phonenumber!=0 and $phonenumber!='0' and strlen($phonenumber)==10)
	{
		
		$contant = str_replace(array("\r","\n")," ",$contant);
		$ch = curl_init();
		// Set URL to URL variable
		curl_setopt($ch, CURLOPT_URL,"http://203.212.70.200/smpp/sendsms");
		// Set URL HTTP post to 1
		curl_setopt($ch, CURLOPT_POST, 1);
		// Set URL HTTP post field values
		curl_setopt($ch, CURLOPT_POSTFIELDS, 		"username=renew&password=renew9898&to=$phonenumber&from=MySchl&udh=&text=$contant&dlr-mask=19&dlr-url&category=bulk");
		// Set URL return value to True to return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// The URL session is executed and passed to the browser
		$curl_output =curl_exec($ch);
		
		$curlresponse=$curl_output ;
		$reply=explode('&',$curlresponse);
		$guid=explode('=',$reply[0]);
		$errorcode=explode('=',$reply[1]);
		$seqno=explode('=',$reply[2]);
		execute("INSERT INTO `msg` (`username`, `student_id`, `mobile_number`, `msg`, `class_det`, `msg_date`, `msg_time`,`guid`,`errorcode`,`seqno`) VALUES ( '$user', '$studentid', '$phonenumber', '$contant', '$sem', '$sysdate', '$systime','$guid[1]','$errorcode[1]','$seqno[1]')");
	}
	else
	{
		execute("INSERT INTO `msg_not_sent` (`username`, `student_id`, `mobile_number`, `msg`, `class_det`, `msg_date`, `msg_time`) VALUES ( '$user', '$studentid', '$phonenumber', '$contant', '$sem', '$sysdate', '$systime')");
	}

}


?>