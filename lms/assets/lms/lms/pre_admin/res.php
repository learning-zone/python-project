<html>
<head>
<?php
	session_start();
	include("../db.php");
	include("../mail_msg/mail_class.php");
?>
</head>
<?php
$adminusername='bakulesh.a';
$lname=$_POST['lname'];
$uploadedfile=$POST['uploadedfile'];
$b_year=$_POST['b_year'];
$b_month=$_POST['b_month'];
$b_day=$_POST['b_day'];
$adate=$_POST['adate'];
$appl_num=$_POST['appl_num'];
$adm_num=$_POST['adm_num'];
$fname=$_POST['fname'];
$nat=$_POST['nat'];
$rel=$_POST['rel'];
$gender=$_POST['gender'];
$caste=$_POST['caste'];
$dob=$_POST['dob'];
$age_yr=$_POST['age_yr'];
$per_addr=$_POST['per_addr'];
$per_city=$_POST['per_city'];
$per_state=$_POST['per_state'];
$per_country=$_POST['per_country'];
$per_pin=$_POST['per_pin'];
$per_phone=$_POST['per_phone'];
$cor_addr=$_POST['cor_addr'];
$cor_city=$_POST['cor_city'];
$cor_state=$_POST['cor_state'];
$cor_country=$_POST['cor_country'];
$cor_pin=$_POST['cor_pin'];
$cor_phone=$_POST['cor_phone'];
$f_name=$_POST['f_name'];
$foccup=$_POST['foccup'];
$finc=$_POST['finc'];
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$cat=$_POST['cat'];
$a_year=$_POST['a_year'];
$extra=$_POST['extra'];
$username=$_POST['username'];
$password=$_POST['password'];
$parent_username=$_POST['parent_username'];
$parent_password=$_POST['parent_password'];
$b_group=$_POST['b_group'];
$fee_type=$_POST['fee_type'];
$memail=$_POST['memail'];
$mmb=$_POST['mmb'];
$gname=$_POST['gname'];
$goccup=$_POST['goccup'];
$ginc=$_POST['ginc'];
$gmb=$_POST['gmb'];
$gemail=$_POST['gemail'];
$femail=$_POST['femail'];
$place=$_POST['place'];
$fqul=$_POST['fqul'];
$mqul=$_POST['mqul'];
$gqul=$_POST['gqul'];
$lang=$_POST['lang'];
$state=$_POST['state'];
$fmb=$_POST['fmb'];
$mother=$_POST['mother'];
$dist=$_POST['dist'];
$stud_type=$_POST['stud_type'];
$vdt=$_POST['vdt'];
$mname=$_POST['mname'];
$moccup=$_POST['moccup'];
$minc=$_POST['minc'];
$foadd=$_POST['foadd'];
$moadd=$_POST['moadd'];
$goadd=$_POST['goadd'];
$sel=$_POST['sel'];
$b_year=$_POST['b_year'];
$b_month=$_POST['b_month'];
$b_day=$_POST['b_day'];
$v_year=$_POST['v_year'];
$v_month=$_POST['v_month'];
$v_day=$_POST['v_day'];
$var123 = str_replace('/','-',$adate);
$date123 = Date("Y-m-d",strtotime($var123));
$dob = $b_year."-".$b_month."-".$b_day;
$vdt= $v_year."-".$v_month."-".$v_day;
$msgphone=$_POST['msgphone']; 
$rgmailid=$_POST['rgmailid'];
$app = $_POST['app'];
$std_email = $_POST['std_email'];
$usn = $_POST['usn'];
if($_POST['save'])
{
	
	$fer="insert into student_m_online (last_name,img_source_s, usn, admission_id,admission_date,student_id,first_name,nationality,religion,gender,caste_id,dob,age,per_address,per_city,per_state,per_country,per_pincode,
	per_phone,cor_address,cor_city,cor_state,cor_country,cor_pincode,cor_phone,parent_name,parent_occupation,parent_income,
	course_admitted,course_yearsem,quota_id,academic_year,remarks,username,password,archive,class_section_id,parent_username,parent_password,count,
	blood_group,admission_type,m_email,mnum,g_name,g_occ,g_in,g_num,g_mail,f_email,place_of_birth,f_quali,m_quali,g_quali,lang_id,State,sms_mobile,
	mother_tongue,birth_disct,stud_type,vdate,m_name,m_occ,m_inc,foadd,moadd,goadd,msgphone,rgmailid) values ('$lname','$std_email', '$usn','$appl_num','$date123','$adm_num','".addslashes($fname)."','$nat','$rel','$gender','$caste','$dob','$age_yr','".addslashes($per_addr)."',
	'".addslashes($per_city)."','".addslashes($per_state)."','".addslashes($per_country)."','$per_pin','$per_phone','".addslashes($cor_addr)."',
	'".addslashes($cor_city)."','".addslashes($cor_state)."','".addslashes($cor_country)."','$cor_pin','$cor_phone','".addslashes($f_name)."','".addslashes($foccup)."',
	'$finc','$branch','$sem','$cat','$a_year','".addslashes($extra)."','$username','$password','N',0,'$parent_username','$parent_password',0,
	'$b_group','$fee_type','$memail','$mmb','$gname','$goccup','$ginc','$gmb','$gemail','$femail','".addslashes($place)."','$fqul','$mqul','$gqul',
	'$lang','$state','$fmb','$mother','$dist','$stud_type','$vdt','$mname','$moccup','$minc','$foadd','$moadd','$goadd','$msgphone','$rgmailid')";
	
	$gg=execute($fer) or die(mysql_error());
	
	$queryget = "select MAX(id) from student_m_online";
	$mod1=execute($queryget );	
	$mod2=fetcharray($mod1);
	$Application_no = $mod2[0];
			$message = "Announcement Dear ".$fname." your APL no  ".$Application_no;

			$mobilenumbers= $msgphone; //enter Mobile numbers comma seperated
	
		 	 //enter Your Message 
			send_msg($mobilenumbers,$message,$Application_no,$sem);

	/*
	mail and code strats from here
	
	*/
	
		
	$ref = getenv("HTTP_REFERER");
	$ref1=explode('sendmail.php',$ref);
	$updatelinkname=$ref1[0]."count.php?id=";
	$Mail_template=1;
	$parent_mailid= $rgmailid;
	
	
	$schlname=fetcharray(execute("select col_name , col_addr, col_pin, col_phone   FROM `college` "));
	
	$qury1=fetchrow(execute("select mail_content,mail_subject  FROM `mail_det` where id='$Mail_template'"));
$message='Thanks for applying. We will come back to you shortly ';
$subject='Welcome to '.$schlname[0];
	$parent_name= "Dear ".$fname.'<br>';
	$updatelinkname=$updatelinkname.$Mail_template."&mailid=".$parent_mailid;
	
	$sql1="INSERT INTO `mail_sent_count` (`username`, `mail_det_id`, `from_mail_id`, `to_mail_id`, `student_id`, `mail_date`, `mail_time`, `mail_count`) VALUES
	( '".$adminusername."', '".$Mail_template."', '".$notify_fromaddress."', '".$parent_mailid."', '".$check[$i]."', '".date("Y-m-d")."', '".date("H:i:s")."', 0)";
	
	execute($sql1);
	
	$Signatore="
	<br><br>
	<br><br>
	
	This is System Generated Mail, Please Don't Reply to this.
	";
	
	$mail_boday=$parent_name.$message."<br>Your Application id :-".$Application_no."<br><br>".$Signatore.'<img src="'.$updatelinkname.'" width="0" height="0" border="0" />
	<br><br><div align="center"></div>';
	
	 $subject = 'welcome to Ecole - Password';
 
 
 $headers = 'From: autoemail@myschoolone.com' . "\r\n" .
  'Reply-To: ' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();
 //echo "$to, $subject, $message, $headers";
 $status=mail($parent_mailid, $subject, $mail_boday, $headers);
 if(!$status)
 echo "Unable send mail";
	
	/*
	mail and code strats from here
	
	
	*/
	
	?>
    <script type="text/javascript">
	alert("Applied for Admission please make a note of your Application ID for all further transaction and quries APPLICATION ID :  <?php echo $Application_no ?>");
	
	</script>
    <?php
	//echo $mod1;
	//echo  $Application_no;
	//die();
	$photoid=fetchInsertId($gg);

	if( basename( $_FILES['uploadedfile']['name'])!='')
	{
		$directory = "img".$branch;			
		if (file_exists("../student_images/$directory") == false)
			$dir_created= mkdir("../student_images/$directory",0777);		
	
		$target_path = basename($_FILES['uploadedfile']['name']);
		$var1 = explode(".",$target_path);
		$var3 = $photoid.".".$var1[1];
		$target_path = "../student_images/$directory/".$var3;
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		{
			$nop=execute("update student_m_online set img_source='$target_path' where id='$photoid'");
		}
	}
	if(is_array($sel))
	{
		 while( list(,$value)=each($sel))
		 {
			 $ce= $value;
			 $var12="insert into certificate_det(new_id,stud_id,cert_id,status) values ('$photoid','$appl_num','$ce','true')";
			 execute($var12) or die(mysql_error()."a2");
		 }
	}
	
}
?>
<body>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    //document.form1.action="SearchStudent.php?action=save&flag=1&fname=$fname";
	document.form1.action="Online_link.php?app=$Application_no";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>