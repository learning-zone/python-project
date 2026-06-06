<?php
session_start();
include("../db.php");
$store_stud=$_REQUEST['store_stud'];

$SchoolCode=$_SESSION['SchoolCode'];
/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/
$father=$_POST['father'];
$motherp=$_POST['motherp'];
$guardian=$_POST['guardian'];
$uploadedfile=$_POST['uploadedfile'];

$usn=$_POST['usn'];
$nationality2=$_POST['nationality2'];
$emergency_mail=$_POST['emergency_mail'];
$mother_tongue_2=$_POST['mother_tongue_2'];
$emergency_number=$_POST['emergency_number'];


$b_year=$_POST['b_year'];

$b_month=$_POST['b_month'];

$b_day=$_POST['b_day'];

$adate=$_POST['adate'];

$appl_num=$_POST['appl_num'];

$adm_num=$_POST['adm_num'];

$fname=$_POST['fname'];

$lname=$_POST['lname'];

$nat=$_POST['nat'];

$rel=$_POST['rel'];

$gender=$_POST['gender'];

$caste=$_POST['caste'];

$dob=$_POST['dob'];
$adate=$_POST['adate'];
$bdate=$_POST['bdate'];
$passport_no=$_POST['passport_no'];
$country_of_issue=$_POST['country_of_issue'];
$type1=$_POST['type1'];
$type2=$_POST['type2'];
$type3=$_POST['type3'];
$type4=$_POST['type4'];
$emergency_name=$_POST['emergency_name'];
$emergency_address=$_POST['emergency_address'];
$fciti=$_POST['fciti'];
$mciti=$_POST['mciti'];
$gciti=$_POST['gciti'];
$caregiver_username=$_POST['caregiver_username'];
$caregiver_password=$_POST['caregiver_password'];

$varabc = str_replace('/','-',$bdate);

$dateabc= Date("Y-m-d",strtotime($varabc));

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

$f_id=$_POST['f_id'];

$m_id=$_POST['m_id'];

$g_id=$_POST['g_id'];

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

$std_email=$_POST['std_email'];

$rgmailid=$_POST['rgmailid'];

if($_POST['save'])

{

	$fer="insert into student_m (img_source_s, usn,admission_id,admission_date,student_id,first_name,last_name,nationality,religion,gender,caste_id,dob,age,per_address,per_city,per_state,per_country,per_pincode,

	per_phone,cor_address,cor_city,cor_state,cor_country,cor_pincode,cor_phone,parent_name,parent_occupation,parent_income,

	course_admitted,course_yearsem,quota_id,academic_year,remarks,username,password,archive,class_section_id,parent_username,parent_password,count,

	blood_group,admission_type,m_email,mnum,g_name,g_occ,g_in,g_num,g_mail,f_email,place_of_birth,f_quali,m_quali,g_quali,lang_id,State,sms_mobile,

	mother_tongue,birth_disct,stud_type,vdate,m_name,m_occ,m_inc,foadd,moadd,goadd,msgphone,rgmailid) values ('$std_email', '$usn', '$appl_num', '$date123', '$adm_num' ,'".addslashes($fname)."','".addslashes($lname)."', '$nat','$rel','$gender','$caste','$dob','$age_yr','".addslashes($per_addr)."',

	'".addslashes($per_city)."','".addslashes($per_state)."','".addslashes($per_country)."','$per_pin','$per_phone','".addslashes($cor_addr)."',

	'".addslashes($cor_city)."','".addslashes($cor_state)."','".addslashes($cor_country)."','$cor_pin','$cor_phone','".addslashes($f_name)."','".addslashes($foccup)."',

	'$finc','$branch','$sem','$cat','$a_year','".addslashes($extra)."','$username','$password','N',0,'$parent_username','$parent_password',0,

	'$b_group','$fee_type','$memail','$mmb','$gname','$goccup','$ginc','$gmb','$gemail','$femail','".addslashes($place)."','$fqul','$mqul','$gqul',

	'$lang','$state','$fmb','$mother','$dist','$stud_type','$vdt','$mname','$moccup','$minc','$foadd','$moadd','$goadd','$msgphone','$rgmailid')";
	$abcd=execute("update student_photo_other set studid='$photoid' where studid='$store_stud'");

     //echo "<br>".$fer;

	$gg=execute($fer) or die(mysql_error());

	$photoid=fetchInsertId($gg);
	//update doc_student
	//echo "UPDATE `doc_student` SET student_id='$photoid' where student_id='$tempiddet'";

	mysql_query("UPDATE `doc_student` SET student_id='$photoid' where student_id='$store_stud'");
	

	mysql_query("UPDATE `student_health` SET student_id='$photoid' where student_id='$store_stud'");
	
	$ins_qry=mysql_query("insert into additional_info2(passport_no,country_of_issue,type1,type2,type3,type4,emergency_name,emergency_address,student_id,date_of_enrol,fciti,mciti,gciti,caregiver_username,caregiver_password,other_address,f_id,m_id,g_id,mother_tongue_2,nationality2,emergency_number,emergency_mail)values('$passport_no','$country_of_issue','$type1','$type2','$type3','$type4','$emergency_name','$emergency_address','$photoid','$dateabc','$fciti','$mciti','$gciti','$caregiver_username','$caregiver_password','$other_address','$f_id','$m_id','$g_id','$mother_tongue_2','$nationality2','$emergency_number','$emergency_mail')");	

	//till here
######################################  	MULTIPLE IMAGE UPLOAD	 	#####################################################
 
error_reporting(0);
$limit_size=50000;

    $uploadedPassport=$_POST['uploadedPassport'];
	
	$tempName=date("dmyHis");
    $j=1;
	$filename = $tempName.$_FILES['file']['name'];
	if($_FILES['uploadedPassport']['tmp_name'] != null)
	{
	
		$uploadDir = "student_doc/";

		for ($i = 0; $i < count($_FILES['uploadedPassport']['name']); ++$i) 
		{
			$directory = "student_doc/";

			 //echo "<br>File names : ".$_FILES['uploadedPassport']['name'][$i];
			 //strrchr : Find the last occurrence of a character in a string

			 $ext = substr(strrchr($_FILES['uploadedPassport']['name'][$i], "."), 1); 
			 //echo  "<br>generate a random new file name to avoid name conflict";

			 $fPath = md5(rand() * time()) . ".$ext";
			 $dir_created= mkdir("../student_det/",0777);	
			 	

			 $target_path = basename( $_FILES['uploadedPassport']['name']);
			 $var = explode(".",$target_path);
			 

			 $var3 = $filename;
			 $target_path = "../student_det/$directory".$fPath;
			 
			
			/* $randNo=rand(0001, 999999); //RANDOM NO GENERATION 

			 if(!$_POST['PicName']){
				$PicName="IMAGE $randNo";
			 }
			 else{
				 $PicName=$_POST['PicName'].' $randNo';
			 }*/
			 
			 //echo "<br>".$PicName;
			if(move_uploaded_file($_FILES['uploadedPassport']['tmp_name'][$i], $uploadDir . $fPath))
			{
					
					$sqlDoc="INSERT INTO `student_m_doc` (`student_id`, `imagepath`, `inserted_date`) VALUES ('$photoid', '$target_path', CURDATE())";
					
					//echo "<br>".$sqlDoc;
					$resultDoc=mysql_query($sqlDoc) or die(mysql_error());
					
			}
			 if (strlen($ext) > 0)
			 {

			  //echo "Uploaded ". $fPath ." succefully. <br>";

			 }

		}

	}
	//---------------------------------------------------------------------------------------------


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
			$nop=execute("update student_m set img_source='$target_path' where id='$photoid'");
		}
	}
	
	//code start
	
		//father photo
		$f_target_path = "fphoto";			
		if (file_exists("../stud_image_other/") == false)
		$f_path= mkdir("../stud_image_other/",0777);		
		$f_target_path1 = basename( $_FILES['father']['name']);
		$file_type = basename($_FILES['father']['type']);		
		//$f_path1 = explode(".",$f_target_path1);
		$f_path2 = $photoid;
		$f_target_path1 = "../stud_image_other/$f_target_path/"."IMG_".date('d-m-Y').time().'_'.$f_path2.".".$file_type;
		
		if(move_uploaded_file($_FILES['father']['tmp_name'], $f_target_path1))
		$f_target_path1 = $f_target_path1;
		else
		$f_target_path1 ='';
		
		//mother photo
		$m_target_path = "mphoto";			
		if (file_exists("../stud_image_other/") == false)
		$m_path= mkdir("../stud_image_other/",0777);		
		$m_target_path1 = basename( $_FILES['motherp']['name']);
		$file_type1 = basename( $_FILES['motherp']['type']);		
		//$m_path1 = explode(".",$m_target_path1);
		$m_path2 = $photoid;
		$m_target_path1 = "../stud_image_other/$m_target_path/"."IMG_".date('d-m-Y').time().'_'.$m_path2.".".$file_type1;
		
		if(move_uploaded_file($_FILES['motherp']['tmp_name'], $m_target_path1))
		$m_target_path1 = $m_target_path1;
		else
		$m_target_path1 ='';
		
		
		//guardian photo
		$g_target_path = "gphoto";			
		if (file_exists("../stud_image_other/") == false)
		$g_path= mkdir("../stud_image_other/",0777);		
		$g_target_path1 = basename( $_FILES['guardian']['name']);
		$file_type2 = basename( $_FILES['guardian']['type']);		
		//$g_path1 = explode(".",$g_target_path1);
		$g_path2 = $photoid;
		$g_target_path1 = "../stud_image_other/$g_target_path/"."IMG_".date('d-m-Y').time().'_'.$g_path2.".".$file_type2;
		
		if(move_uploaded_file($_FILES['guardian']['tmp_name'], $g_target_path1))
		$g_target_path1 = $g_target_path1;
		else
		$g_target_path1 ='';
			
			mysql_query("INSERT INTO `student_photo` (`studid`, `f_photo`, `m_photo`, `g_photo`, `acc_year`,`username`,`status`) VALUES
('$photoid', '$f_target_path1', '$m_target_path1', '$g_target_path1','$accyear','$user',1)");
	
	
	//code end

	if(is_array($sel))
	{
		 while( list(,$value)=each($sel))
		 {

			 $ce= $value;

			 $var12="insert into certificate_det(new_id,stud_id,cert_id,status) values ('$photoid','$appl_num','$ce','true')";

			 $result=mysql_query($var12) or die(mysql_error()."a2");

		 }

	}

}
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx         LIBRARY MEMBERSHIP DETAILS         xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

if($gg) 
{
	
	
	$qry = mysql_fetch_array(mysql_query("SELECT id,student_id,first_name,last_name FROM student_m WHERE id=$photoid"));
	$s_id = $qry[student_id];				
	$sname = $qry[first_name]."&nbsp;".$qry[last_name];
	$qid=$qry[id];
	
$sqlLib = "INSERT INTO lib_membership_m(issued_on,s_id,type,m_no,status,pwd,MemberName,totalCards,domain)VALUES(CURDATE(),'$qid','1','$s_id','1','$s_id','$sname','','$SchoolCode')";
		 $resLib = mysql_query($sqlLib) or die(mysql_error());
		 
		 		 
		$resultLib=mysql_query("SELECT id,m_no FROM lib_membership_m ORDER BY id DESC LIMIT 1");
	  
	    if ($resultLib){
           $queryLib=mysql_fetch_row($resultLib);
        }
	    $id=$queryLib[0];
		$m_no=$queryLib[1];
	    //echo "<p>Id :$m_no</p>";
		
		 $sql="INSERT INTO lib_membership_det(mbno,m_id)VALUES('$m_no','$id')";
		 $res = mysql_query($sql) or die(mysql_error());
		
	}

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

	if($res) 
	{
    	echo "<META http-equiv='refresh' content='0;URL=SearchStudent.php?action=save&flag=1&fname=$fname'>";
	}
	else
	{
    	 echo "<META http-equiv='refresh' content='0;URL=SearchStudent.php?action=save&flag=1&fname=$fname'>";
	}
?>

