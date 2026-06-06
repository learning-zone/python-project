<?php

session_start();

include("../db.php");
$accyear=$_SESSION['AcademicYear'];
$father=$_POST['father'];
$motherp=$_POST['motherp'];
$guardian=$_POST['guardian'];

$uploadedfile=$_POST['uploadedfile'];

$std_email=$_POST['std_email'];

$usn=$_POST['usn'];

$b_year=$_POST['b_year'];

$b_month=$_POST['b_month'];

$b_day=$_POST['b_day'];

$adate=$_POST['adate'];

$appl_num=$_POST['appl_num'];

$adm_num=$_POST['adm_num'];

$fname=$_POST['fname'];
$mname=$_POST['mname'];

$lname=$_POST['lname'];

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

$DobYear=$_POST['DobYear'];

$DobMon=$_POST['DobMon'];

$DobDay=$_POST['DobDay'];

$var123 = str_replace('/','-',$adate);

$date123 = Date("Y-m-d",strtotime($var123));

$dob=$DobYear."-".$DobMon."-".$DobDay;
$f_id=$_POST['f_id'];

$m_id=$_POST['m_id'];

$g_id=$_POST['g_id'];
$vdt= $v_year."-".$v_month."-".$v_day;
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
$mother_tongue_2=$_POST['mother_tongue_2'];
$nationality2=$_POST['nationality2'];
$emergency_number=$_POST['emergency_number'];
$emergency_mail=$_POST['emergency_mail'];
$varabc = str_replace('/','-',$bdate);

$dateabc= Date("Y-m-d",strtotime($varabc));



$sql="update student_m set admission_id='$appl_num', admission_date='$date123',usn='$usn',img_source_s='$std_email' , student_id='$adm_num',first_name='".addslashes($fname)."',last_name='".addslashes($lname)."',middle_name='".addslashes($mname)."',nationality='$nat',religion='$rel',";

$sql.="gender='$gender',caste_id='$caste',dob='$dob',age='$age_yr',per_address='".addslashes($per_addr)."',per_city='".addslashes($per_city)."',";

$sql.="per_state='".addslashes($per_state)."',per_country='".addslashes($per_country)."',per_pincode='$per_pin',per_phone='$per_phone',";

$sql.="cor_address='".addslashes($cor_addr)."',cor_city='".addslashes($cor_city)."',cor_state='".addslashes($cor_state)."',cor_country='".addslashes($cor_country)."',";

$sql.="cor_pincode='$cor_pin',cor_phone='$cor_phone',parent_name='".addslashes($f_name)."',parent_occupation='".addslashes($foccup)."',parent_income='$finc',";

$sql.="course_admitted='$branch',course_yearsem='$sem',quota_id='$cat',academic_year='$a_year',remarks='".addslashes($extra)."',username='$username',";

$sql.="password='$password',parent_username='$parent_username',parent_password='$parent_password',blood_group='$b_group',admission_type='$fee_type',";

$sql.="m_email='$memail',mnum='$mmb',g_name='$gname',g_occ='$goccup',g_in='$ginc',g_num='$gmb',g_mail='$gemail',f_email='$femail',";

$sql.="place_of_birth='".addslashes($place)."',f_quali='$fqul',m_quali='$mqul',g_quali='$gqul',lang_id='$lang',State='$state',sms_mobile='$fmb',";

$sql.="mother_tongue='$mother',birth_disct='$dist',stud_type='$stud_type',vdate='$vdt',m_name='$mname',m_occ='$moccup',m_inc='$minc',foadd='$foadd',";

$sql.="moadd='$moadd',goadd='$goadd' where id='$StudID'";



mysql_query($sql) or die(mysql_error());



$quer3=mysql_fetch_row(mysql_query("select student_id FROM `additional_info2` where student_id='$StudID'"));
if($quer3[0])
{
	
	$query=mysql_query("UPDATE `additional_info2` SET `passport_no`='$passport_no',`country_of_issue`='$country_of_issue',`type1`='$type1',`type2`='$type2',`type3`='$type3',`type4`='$type4',`emergency_name`='$emergency_name',`emergency_address`='$emergency_address', `date_of_enrol`='$dateabc',`fciti`='$fciti',

`mciti`='$mciti',`gciti`='$gciti',`caregiver_username`='$caregiver_username',

`caregiver_password`='$caregiver_password',`other_address`='$other_address',`f_id`='$f_id',`m_id`='$m_id',`g_id`='$g_id',`mother_tongue_2`='$mother_tongue_2',`nationality2`='$nationality2',`emergency_number`='$emergency_number',`emergency_mail`='$emergency_mail' WHERE student_id='$StudID'");

}

else

{ 

	 $query=mysql_query("INSERT INTO `additional_info2`(`passport_no`, `country_of_issue`, `type1`, `type2`, `type3`, `emergency_name`, `emergency_address`, `date_of_enrol`, `fciti`,  `mciti`,`gciti`,`caregiver_username`,`caregiver_password`,`student_id`,`other_address`,`f_id`,`m_id`,`g_id`) VALUES('$passport_no', '$country_of_issue', '$type1', '$type2', '$type3', '$emergency_name', '$emergency_address', '$dateabc', '$fciti',  '$mciti','$gciti', '$caregiver_username', '$caregiver_password','$StudID','$other_address','$f_id','$m_id','$g_id')");

}


mysql_query("UPDATE `doc_student` SET student_id='$StudID' where student_id='$StudID'");

	///Father mother update

$fmcodes=mysql_fetch_array(mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$StudID' and `status`=1"));

$stfname=mysql_query("SELECT stud FROM `stud_sibling` where `family_code`='$fmcodes[0]' and `status`=1");
while($stfnameone=mysql_fetch_array($stfname))
{
				$uptgrdfs="update student_m set ";

$uptgrdfs.="per_address='".addslashes($per_addr)."',per_city='".addslashes($per_city)."',";

$uptgrdfs.="per_state='".addslashes($per_state)."',per_country='".addslashes($per_country)."',per_pincode='$per_pin',per_phone='$per_phone',parent_name='".addslashes($f_name)."',m_name='$mname',g_name='$gname',";

$uptgrdfs.="cor_address='".addslashes($cor_addr)."',cor_city='".addslashes($cor_city)."',cor_state='".addslashes($cor_state)."',cor_country='".addslashes($cor_country)."',";

$uptgrdfs.="cor_pincode='$cor_pin',cor_phone='$cor_phone',parent_occupation='".addslashes($foccup)."',";

$uptgrdfs.="m_email='$memail',mnum='$mmb',f_email='$femail',foadd='$foadd',moadd='$moadd',";

$uptgrdfs.="f_quali='$fqul',m_quali='$mqul',sms_mobile='$fmb',";

$uptgrdfs.="m_occ='$moccup',";

$uptgrdfs.="msgphone='$msgphone',rgmailid='$rgmailid',usn='$usn' where id='$stfnameone[0]'";
mysql_query($uptgrdfs);
			
}

//end


///upadte all
$stfnamealls=mysql_query("SELECT stud FROM `stud_sibling` where `family_code`='$fmcodes[0]' and `status`=1");
while($stfnameal=mysql_fetch_array($stfnamealls))
{

$nallsv=mysql_fetch_row(mysql_query("select student_id FROM `additional_info2` where student_id='$stfnameal[0]'"));
if($nallsv[0])
{
	
	$query34=mysql_query("UPDATE `additional_info2` SET `emergency_name`='$emergency_name',`emergency_address`='$emergency_address',`fciti`='$fciti',

`mciti`='$mciti',`gciti`='$gciti',`caregiver_username`='$caregiver_username',

`caregiver_password`='$caregiver_password',`other_address`='$other_address',`emergency_number`='$emergency_number',`emergency_mail`='$emergency_mail' WHERE student_id='$stfnameal[0]'");

}

else

{ 

	 $query78=mysql_query("insert into additional_info2(emergency_name,emergency_address,student_id,fciti,mciti,gciti,caregiver_username,caregiver_password,other_address,mother_tongue_2,nationality2,emergency_number,emergency_mail)values('$emergency_name','$emergency_address','$stfnameal[0]','$fciti','$mciti','$gciti','$caregiver_username','$caregiver_password','$other_address','$mother_tongue_2','$nationality2','$emergency_number','$emergency_mail')");

}	
	
}
///end



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
					
					$sqlDoc="INSERT INTO `student_m_doc` (`student_id`, `imagepath`, `inserted_date`) VALUES ('$StudID', '$target_path', CURDATE())";
					
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

if($archive=="on")

{

	if($stud_status1==true)

	{

		$r_arch = mysql_query("update student_m set archive='F' where id='$StudID'");

	}

	else

	{

		mysql_query("insert into archive_student select * from student_m  where id='$StudID' ");

		mysql_query("delete from student_m where id='$StudID'");

		mysql_query("update archive_student set archive='Y' where id='$StudID'");

	}

}
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
		$nop=execute("update student_m set img_source='$target_path' where id='$StudID'");
	}
}

/*if($_FILES['uploadedfile']['tmp_name'] != null)

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

		$nop=execute("update student_m set img_source='$target_path' where id='$StudID'");

	}

}*/

//code start	
	//father photo
	if($_FILES['father']['tmp_name'] != null)
	{
			$f_target_path = "fphoto";			
			if (file_exists("../stud_image_other/") == false)
			$f_path= mkdir("../stud_image_other/",0777);		
			$f_target_path1 = basename( $_FILES['father']['name']);
			$file_type2 = basename( $_FILES['father']['type']);			
			//$f_path1 = explode(".",$f_target_path1);
			$f_path2 = $StudID;
			$f_target_path1 = "../stud_image_other/$f_target_path/"."IMG_".date('d-m-Y').time().'_'.$f_path2.".".$file_type2;
		
		if(move_uploaded_file($_FILES['father']['tmp_name'], $f_target_path1))
		{
			$seltval=mysql_query("select id from student_photo where studid='$StudID'");
			if(mysql_num_rows($seltval)>0)
			{
				$fupdat=execute("update student_photo set f_photo='$f_target_path1',username='$user' where studid='$StudID'");
			}
			else
			{
				mysql_query("INSERT INTO `student_photo` (`studid`, `f_photo`,`acc_year`, `status`) VALUES
				('$StudID', '$f_target_path1','$accyear', 1)");
			}
			
		}
	}
		
		//mother photo
	if($_FILES['motherp']['tmp_name'] != null)
	{
			$m_target_path = "mphoto";			
			if (file_exists("../stud_image_other/") == false)
			$m_path= mkdir("../stud_image_other/",0777);		
			$m_target_path1 = basename( $_FILES['motherp']['name']);
			$file_type = basename( $_FILES['motherp']['type']);			
			//$m_path1 = explode(".",$m_target_path1);
			$m_path2 = $StudID;
			$m_target_path1 = "../stud_image_other/$m_target_path/"."IMG_".date('d-m-Y').time().'_'.$m_path2.".".$file_type;
		
		if(move_uploaded_file($_FILES['motherp']['tmp_name'], $m_target_path1))
		{
			
			$seltval1=mysql_query("select id from student_photo where studid='$StudID'");
			if(mysql_num_rows($seltval1)>0)
			{
				$mupdat=execute("update student_photo set m_photo='$m_target_path1',username='$user' where studid='$StudID'");
			}
			else
			{
				mysql_query("INSERT INTO `student_photo` (`studid`,`m_photo`, `acc_year`, `status`) VALUES
				('$StudID', '$m_target_path1','$accyear', 1)");
			}
		}
	}

//guardian photo
	if($_FILES['guardian']['tmp_name'] != null)
	{
			$g_target_path = "gphoto";			
			if (file_exists("../stud_image_other/") == false)
			$g_path= mkdir("../stud_image_other/",0777);		
			$g_target_path1 = basename( $_FILES['guardian']['name']);
			$file_type1 = basename( $_FILES['guardian']['type']);			
			//$g_path1 = explode(".",$g_target_path1);
			$g_path2 = $StudID;
			$g_target_path1 = "../stud_image_other/$g_target_path/"."IMG_".date('d-m-Y').time().'_'.$g_path2.".".$file_type1;
		
		if(move_uploaded_file($_FILES['guardian']['tmp_name'], $g_target_path1))
		{
			$seltval=mysql_query("select id from student_photo where studid='$StudID'");
			if(mysql_num_rows($seltval)>0)
			{
				$gupdat=execute("update student_photo set g_photo='$g_target_path1',username='$user' where studid='$StudID'");
			}
			else
			{
				mysql_query("INSERT INTO `student_photo` (`studid`, `g_photo`,`acc_year`, `status`) VALUES
				('$StudID', '$g_target_path1','$accyear', 1)");
			}
		}
	}
//code end	



$nop=execute("delete from certificate_det where new_id='$StudID'");

if(is_array($sel))

{

	 while( list(,$value)=each($sel))

	 {

		 $ce= $value;

		 $var12="insert into certificate_det(new_id,stud_id,cert_id,status) values ('$StudID','$appl_num','$ce','true')";

		 mysql_query($var12) or die(mysql_error()."a2");

	 }

}

?>

<table align='center' border='0'>

<tr>
<?
$prts=mysql_fetch_array(mysql_query("select * from student_photo where studid='$StudID'"));
$mrts=mysql_fetch_array(mysql_query("select * from student_photo where studid='$StudID'"));
?>
<?php

if($_FILES['uploadedfile']['tmp_name'] != null)

{

	?>	

	<td align='center'><img src='<?php echo $target_path ?>' width='110' height='120'> </td>
	<td align='center'><img src='<?php echo $prts[f_photo] ?>' width='110' height='120'> </td>
	<td align='center'><img src='<?php echo $mrts[m_photo] ?>' width='110' height='120'> </td>

	<?php

}

else

{	

	?>	

	<td align='center'><img src='<?php echo $image ?>' width='110' height='120'> </td>
	<td align='center'><img src='<?php echo $prts[f_photo] ?>' width='110' height='120'> </td>
	<td align='center'><img src='<?php echo $mrts[m_photo] ?>' width='110' height='120'> </td>

	<?php

}



$sql123=mysql_query("select class_section_id from student_m where id='$StudID'");

$class_section_id=mysql_fetch_row($sql123);

?>

</tr>

<tr height='25'><td  colspan=3><font size=2 color=blue face=verdana><b> <?php echo $fname ?>'s Details are Successfully Updated.</b></font></td></tr>
<?
if($per00==1)
{
?>

<tr height='25'><td align='center'  colspan=3><font color=blue face=verdana>

<b><a href="select_stud_mod2.php?branch=<?php echo $branch ?>&sem=<?php echo $sem ?>&class_section_id=<?php echo $class_section_id[0] ?>">Back</a></b></font></td></tr>
<?
}
else
{
?>
<tr height='25'><td align='center'  colspan=3><font color=blue face=verdana>
<b><a href="view_stud.php?StudID=<?php echo $StudID ?>">Back</a></b></font></td></tr>

<?
}
?>

</table>