<?php

session_start();

include("../db.php");
$accyear=$_SESSION['AcademicYear'];
$father=$_POST['father'];
$motherp=$_POST['motherp'];
$guardian=$_POST['guardian'];
$emergency_number=$_POST['emergency_number'];
$emergency_mail=$_POST['emergency_mail'];
$type4=$_POST['type4'];
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

$lname=$_POST['lname'];

$nat=$_POST['nat'];
$nationality2=$_POST['nationality2'];


$rel=$_POST['rel'];

$gender=$_POST['gender'];

$caste=$_POST['caste'];

$dob=$_POST['dob'];
$mnum=$_POST['mnum'];

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
$mother_tongue_2=$_POST['mother_tongue_2'];


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
$emergency_name=$_POST['emergency_name'];
$emergency_address=$_POST['emergency_address'];
$fciti=$_POST['fciti'];
$mciti=$_POST['mciti'];
$gciti=$_POST['gciti'];
$caregiver_username=$_POST['caregiver_username'];
$caregiver_password=$_POST['caregiver_password'];
$varabc = str_replace('/','-',$bdate);

$dateabc= Date("Y-m-d",strtotime($varabc));




///Father mother update

$fmcodes=mysql_fetch_array(mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$StudID' and `status`=1"));

$stfname=mysql_query("SELECT stud FROM `stud_sibling` where `family_code`='$fmcodes[0]' and `status`=1");
while($stfnameone=mysql_fetch_array($stfname))
{
				$uptgrdfs="update student_m set ";

$uptgrdfs.="per_address='".addslashes($per_addr)."',per_city='".addslashes($per_city)."',";

$uptgrdfs.="per_state='".addslashes($per_state)."',per_country='".addslashes($per_country)."',per_pincode='$per_pin',per_phone='$per_phone',";

$uptgrdfs.="cor_address='".addslashes($cor_addr)."',cor_city='".addslashes($cor_city)."',cor_state='".addslashes($cor_state)."',cor_country='".addslashes($cor_country)."',";

$uptgrdfs.="cor_pincode='$cor_pin',cor_phone='$cor_phone',parent_occupation='".addslashes($foccup)."',";

$uptgrdfs.="m_email='$memail',mnum='$mnum',f_email='$femail',foadd='$foadd',moadd='$moadd',";

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



$sql="update student_m set img_source_s='$std_email' ,";

$sql.="dob='$dob',nationality='$nat',age='$age_yr',per_address='".addslashes($per_addr)."',per_city='".addslashes($per_city)."',";

$sql.="per_state='".addslashes($per_state)."',per_country='".addslashes($per_country)."',per_pincode='$per_pin',per_phone='$per_phone',";

$sql.="cor_address='".addslashes($cor_addr)."',cor_city='".addslashes($cor_city)."',cor_state='".addslashes($cor_state)."',cor_country='".addslashes($cor_country)."',";

$sql.="cor_pincode='$cor_pin',cor_phone='$cor_phone',parent_occupation='".addslashes($foccup)."',";

$sql.="m_email='$memail',mnum='$mnum',f_email='$femail',";

$sql.="place_of_birth='".addslashes($place)."',f_quali='$fqul',State='$state',m_quali='$mqul',sms_mobile='$fmb',";

$sql.="m_occ='$moccup',foadd='$foadd',moadd='$moadd',";

$sql.="mother_tongue='$mother',msgphone='$msgphone',rgmailid='$rgmailid',usn='$usn' where id='$StudID'";

mysql_query($sql);



$quer3=mysql_fetch_row(mysql_query("select student_id FROM `additional_info2` where student_id='$StudID'"));
if($quer3[0])
{
	
	$query=mysql_query("UPDATE `additional_info2` SET `passport_no`='$passport_no',`country_of_issue`='$country_of_issue',`type1`='$type1',`type2`='$type2',`type3`='$type3',`type4`='$type4',`emergency_name`='$emergency_name',`emergency_address`='$emergency_address', `date_of_enrol`='$dateabc',`fciti`='$fciti',

`mciti`='$mciti',`gciti`='$gciti',`caregiver_username`='$caregiver_username',

`caregiver_password`='$caregiver_password',`other_address`='$other_address',`mother_tongue_2`='$mother_tongue_2',`nationality2`='$nationality2',`emergency_number`='$emergency_number',`emergency_mail`='$emergency_mail' WHERE student_id='$StudID'");

}

else

{ 
	$ins_qry=mysql_query("insert into additional_info2(passport_no,country_of_issue,type1,type2,type3,type4,emergency_name,emergency_address,student_id,date_of_enrol,fciti,mciti,gciti,caregiver_username,caregiver_password,other_address,mother_tongue_2,nationality2,emergency_number,emergency_mail)values('$passport_no','$country_of_issue','$type1','$type2','$type3','$type4','$emergency_name','$emergency_address','$StudID','$dateabc','$fciti','$mciti','$gciti','$caregiver_username','$caregiver_password','$other_address','$mother_tongue_2','$nationality2','$emergency_number','$emergency_mail')");	
}


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


?>

<table align='center' border='0'>

<tr>

<?php

if($_FILES['uploadedfile']['tmp_name'] != null)

{

	?>	

	<td align='center'><img src='<?php echo $target_path ?>' width='110' height='120'> </td>

	<?php

}

else

{	

	?>	

	<td align='center'><img src='<?php echo $image ?>' width='110' height='120'> </td>

	<?php

}



$sql123=mysql_query("select class_section_id from student_m where id='$StudID'");

$class_section_id=mysql_fetch_row($sql123);
$sql12name=mysql_fetch_array(mysql_query("select first_name from student_m where id='$StudID'"));
 $fname=$sql12name[0];
?>

</tr>

<tr height='25'><td><font size=2 color=blue face=verdana><b> <?php echo $fname ?>'s Details are Successfully Updated.</b></font></td></tr>

<tr height='25'><td align='center'><font color=blue face=verdana>
<b><a href="view_stud.php?StudID=<?php echo $StudID ?>">Back</a></b></font></td></tr>


</table>