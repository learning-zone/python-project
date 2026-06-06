<?php
session_start();
include("../db.php");
$appl_num = $_POST['appl_num'];
$uploadedfile =$_POST['uploadedfile'];
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
$archive=$_POST['archive'];
$stud_status1=$_POST['stud_status1'];
$stud_status2=$_POST['stud_status1'];
$image=$_POST['image'];
$StudID=$_POST['StudID'];
$msgphone=$_POST['msgphone']; 
$rgmailid=$_POST['rgmailid'];
$var123 = str_replace('/','-',$adate);
$date123 = Date("Y-m-d",strtotime($var123));
$dob=$DobYear."-".$DobMon."-".$DobDay;
$vdt= $v_year."-".$v_month."-".$v_day;

//insert into student_m starts here

$sql1="insert into student_m set id='$appl_num',admission_date='$date123',student_id='$adm_num',first_name='".addslashes($fname)."',nationality='$nat',religion='$rel',";
$sql1.="gender='$gender',caste_id='$caste',dob='$dob',age='$age_yr',per_address='".addslashes($per_addr)."',per_city='".addslashes($per_city)."',";
$sql1.="per_state='".addslashes($per_state)."',per_country='".addslashes($per_country)."',per_pincode='$per_pin',per_phone='$per_phone',";
$sql1.="cor_address='".addslashes($cor_addr)."',cor_city='".addslashes($cor_city)."',cor_state='".addslashes($cor_state)."',cor_country='".addslashes($cor_country)."',";
$sql1.="cor_pincode='$cor_pin',cor_phone='$cor_phone',parent_name='".addslashes($f_name)."',parent_occupation='".addslashes($foccup)."',parent_income='$finc',";
$sql1.="course_admitted='$branch',course_yearsem='$sem',quota_id='$cat',academic_year='$a_year',remarks='".addslashes($extra)."',username='$username',";
$sql1.="password='$password',parent_username='$parent_username',parent_password='$parent_password',blood_group='$b_group',admission_type='$fee_type',";
$sql1.="m_email='$memail',mnum='$mmb',g_name='$gname',g_occ='$goccup',g_in='$ginc',g_num='$gmb',g_mail='$gemail',f_email='$femail',";
$sql1.="place_of_birth='".addslashes($place)."',f_quali='$fqul',m_quali='$mqul',g_quali='$gqul',lang_id='$lang',State='$state',sms_mobile='$fmb',";
$sql1.="mother_tongue='$mother',birth_disct='$dist',stud_type='$stud_type',vdate='$vdt',m_name='$mname',m_occ='$moccup',m_inc='$minc',foadd='$foadd',";
$sql1.="moadd='$moadd',goadd='$goadd',msgphone='$msgphone',rgmailid='$rgmailid'";
//echo $sql;
execute($sql1);
// insert into student_m ends here



$delsql = "update student_m_pre set archive='F' where id = '$appl_num'";	

execute($delsql);

?>
	<SCRIPT LANGUAGE ="JavaScript">
	    alert("Updated Successfully");
    </script>
<?php
if($_FILES['uploadedfile']['tmp_name'] != null)
{
	$directory = "img".$branch;			
	if (file_exists("../student_images/") == false)
		$dir_created= mkdir("../student_images/",0777);		
	$target_path = basename( $_FILES['uploadedfile']['name']);
	$var = explode(".",$target_path);
	$var3 = $StudID.".".$var[1];
	$target_path = "../student_images/$directory/".$var3;

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
	{
		$nop=execute("update student_m_pre set img_source='$target_path' where id='$StudID'");
	}
}
$nop=execute("delete from certificate_det where new_id='$StudID'");
if(is_array($sel))
{
	 while( list(,$value)=each($sel))
	 {
		 $ce= $value;
		 $var12="insert into certificate_det(new_id,stud_id,cert_id,status) values ('$photoid','$appl_num','$ce','true')";
		 execute($var12) or die(mysql_error()."a2");
	 }
}



	$siddet=fetchrow(execute("SELECT student_id FROM `course_year` where year_id='$sem'"));
	$da=$siddet[0];	
	$res = execute("select max(student_id) from student_m where  student_id like '$da%' ");
	$row = fetchrow($res);
	$varb = $row[0]+1;
	$app_num = $varb;
	$papp_num = $app_num."P";
	execute("update student_m set admission_id='$app_num', student_id='$app_num', username='$app_num', password='$app_num',  parent_username='$papp_num', parent_password='$papp_num' where id='$appl_num'");
?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="applied_students.php";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>