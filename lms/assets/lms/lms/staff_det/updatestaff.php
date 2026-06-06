<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
<?php

include("../db.php");

$SchoolCode=$_SESSION['SchoolCode']; 
$user = $_POST['user'];
$f_name = $_POST['f_name'];
$s_name = $_POST['s_name'];
$Gender = $_POST['Gender'];
$dobDay = $_POST['dobDay'];
$dobMon = $_POST['dobMon'];
$dobYear = $_POST['dobYear'];
$bg = $_POST['bg'];
$ms = $_POST['ms'];
$mobileno = $_POST['mobileno'];
$email = $_POST['email'];
$father = $_POST['father'];
$religion = $_POST['religion'];
$bank = $_POST['bank'];
$bank_ac_no = $_POST['bank_ac_no'];
$pf_ac_no = $_POST['pf_ac_no']; 
$pan_no = $_POST['pan_no'];
$xtra = $_POST['xtra'];
$assoc = $_POST['assoc'];
$cert = $_POST['cert'];
$cmts = $_POST['cmts'];
$subj = $_POST['subj'];
$staff_id = $_POST['staff_id'];
$staff_group = $_POST['staff_group'];
$stype = $_POST['stype'];
$sstatus = $_POST['sstatus'];
$category = $_POST['category'];
$scard = $_POST['scard'];
$RecPro = $_POST['RecPro'];
$AppDay = $_POST['AppDay'];
$AppMon = $_POST['AppMon'];
$AppYear = $_POST['AppYear'];
$JDay = $_POST['JDay'];
$JMon = $_POST['JMon'];
$JYear = $_POST['JYear'];
$other_facilities = $_POST['other_facilities'];
$other_responsibilities = $_POST['other_responsibilities'];
$course = $_POST['course'];
$specialization = $_POST['specialization'];
$yearpass = $_POST['yearpass'];
$college = $_POST['college']; 
$univers = $_POST['univers'];
$regno = $_POST['regno'];
$boardname = $_POST['boardname'];
$exp_type = $_POST['exp_type'];
$did=$_POST['did']; 
$qid = $_POST['qid'];
$post  = $_POST['post'];
$Organisation  = $_POST['Organisation'];
$city   = $_POST['city'];
$country  = $_POST['country'];
$FrDay  = $_POST['FrDay'];
$FrMon  = $_POST['FrMon'];
$FrYear  = $_POST['FrYear'];
$LaDay  = $_POST['LaDay'];
$LaMon  = $_POST['LaMon'];
$LaYear  = $_POST['LaYear'];
$flag  = $_POST['flag'];
$dname  = $_POST['dname'];
$drel  = $_POST['drel'];
$dep_addr  = $_POST['dep_addr'];
$d_phone  = $_POST['d_phone'];
$doccu  = $_POST['doccu'];
$flag2  = $_REQUEST['flag2'];
$addr_pres  = $_POST['addr_pres'];
$addr_perm  = $_POST['addr_perm'];
$ct_pres  = $_POST['ct_pres'];
$ct_perm  = $_POST['ct_perm'];
$state_pres  = $_POST['state_pres'];
$state_perm  = $_POST['state_perm'];
$pin_pres  = $_POST['pin_pres'];
$pin_perm  = $_POST['pin_perm'];
$ph_pres  = $_POST['ph_pres'];
$ph_perm  = $_POST['ph_perm'];
$uploadedfile  = $_POST['uploadedfile'];
$B1  = $_POST['B1']; 
$addquali  = $_POST['addquali'];
$ModifyjobDet  = $_POST['ModifyjobDet'];
$jodadd  = $_POST['jodadd'];
$depmod  = $_POST['depmod'];
$depadd  = $_POST['depadd'];
$phid = $_REQUEST['phid'];
$phfg = $_REQUEST['phfg'];
$cid = $_POST['cid'];
$join_date = $_POST['join_date'];
$exp_date = $_POST['exp_date'];
$lwd = $_POST['lwd'];
$d_o_b = $_POST['d_o_b'];
$d_o_r = $_POST['d_o_r'];
$d_o_a = $_POST['d_o_a'];
$appnt_date = $_POST['appnt_date'];
$lastdate = $_POST['lastdate'];
$todate = $_POST['todate']; 
$phpath = $_REQUEST['phpath'];
$pth = $_REQUEST['pth'];

		$res_dep = execute("select dept_code from dept_no where dpt_id = '$subj'");

		$row_dep = mysql_fetch_assoc($res_dep);

		

		$res_staff = execute("select max(id) as id from staff_det where subj= '$subj' ");

		$staff_row = mysql_fetch_assoc($res_staff);

		

		$res_slno = execute("select slno from staff_det where id = '$staff_row[id]'");

		$row_slno = mysql_fetch_assoc($res_slno);

		if(rowcount($res_slno)==0)
		{

			$nxt='0001';

			$staff_id = $SchoolCode.$nxt;

		}

		else

		{

			$sln=strlen($row_slno['slno']);

			$a=$SchoolCode;

			$slna=strlen($a);

			$nxt=substr($row_slno['slno'],$slna);

			$nxt = $nxt+1;

			if($nxt<10)

				$nxt="000".$nxt;

			elseif($nxt<100)

				$nxt="00".$nxt;

			elseif($nxt<1000)

				$nxt="0".$nxt;

			$staff_id = $SchoolCode.$nxt;

		}

		if(!empty($f_name))

			{

				$join_date ="";

				$lwd="";

				$d_o_b="";

				$d_o_r="";

				$d_o_a="";

				$exp_date="";

				if(!checkdate($JMon,$JDay,$JYear))

					{

 						echo "Invalid Join Date.";

						die("</td></tr></table>");

  					}

				$join_date = "$JYear-$JMon-$JDay";

				if((!empty($EDay)) or (!empty($EMon)) or (!empty($EYear)) )

					{

						if(!checkdate($EMon,$EDay,$EYear))

							{

								echo "Invalid Expiry Date.";

								die("</td></tr></table>");

							}

					}

				$exp_date = "$EYear-$EMon-$EDay";

				if((!empty($LaDay)) or (!empty($LaMon)) or (!empty($LaYear)) )

					{

						if(!checkdate($LaMon,$LaDay,$LaYear))

							{

								echo "<b>Invalid Last Date of Working.</b>";

          						die("</td></tr></table>");

    						}

					}

				$lwd = "$LaYear-$LaMon-$LaDay";

				

				if(!checkdate($dobMon,$dobDay,$dobYear))

					{

						echo "Invalid Date of Birth.";

						die("</td></tr></table>");

					}

				$d_o_b = "$dobYear-$dobMon-$dobDay";

				$dorDay=$dobDay;

				$dorMon=$dobMon;

				$dorYear=$dobYear+58;

				$d_o_r = "$dorYear-$dorMon-$dorDay";

				if((!empty($AnDay)) or (!empty($AnMon)) or (!empty($AnYear)) )

					{

						if(!checkdate($AnMon,$AnDay,$AnYear))

							{

								echo "Invalid Date of Anniversary.";

								die("</td></tr></table>");

							}

					}

				$d_o_a = "$AnYear-$AnMon-$AnDay";

				$appnt_date="$AppYear-$AppMon-$AppDay";

	

				@$SQL1 = "INSERT INTO staff_det (pf_ac_no,bank_ac_no,f_name,s_name,qual,subj,dob,releive_date,bg,ms,";

				@$SQL3 = "INSERT INTO staff_details_temp (bank_ac_no,f_name,s_name,qual,subj,dob,bg,ms,";

				

				$SQL1 .= "bank,addr_pres,";

				$SQL3 .= "addr_pres,";

				

				$SQL1 .= "ct_pres,pin_pres,st_pres,type_id,offeredsal,basicSal,j_date,";

				$SQL3 .= "ct_pres,pin_pres,st_pres,type_id,offeredsal,basicSal,j_date,";



				$SQL1 .= "status_id,staff_status_id,height,category,id_mark,religion,appnt_date,appnt_des";

				$SQL3 .= "status_id,staff_status_id,height,category,id_mark,religion,appnt_date,appnt_des";

				

				$SQL1 .= ",aicte_scale,group_id,payscale,payrange,substantive,panno,tanno,scard,mobileno";

				$SQL3 .= ",aicte_scale,group_id,payscale,payrange,substantive,panno,tanno";



				@$SQL2 .= " VALUES ('$pf_ac_no','$bank_ac_no','".addslashes($f_name)."','".addslashes($s_name)."','".addslashes($qual)."','$subj','";

				@$SQL4 .= " VALUES ('$bank_ac_no','".addslashes($f_name)."','".addslashes($s_name)."','".addslashes($qual)."','$subj','";



				$SQL2 .= $d_o_b . "','" . $d_o_r . "','" . $bg . "','" . $ms . "','$bank','";

				$SQL4 .= $d_o_b . "','" . $bg . "','" . $ms . "','";



				$SQL2 .= addslashes($addr_pres) . "','$ct_pres','$pin_pres','";

				$SQL4 .= addslashes($addr_pres) . "','$ct_pres','$pin_pres','";



				$SQL2 .= "$state_pres','$stype','$offered','$basic','$join_date";

				$SQL4 .= "$state_pres','$stype','$offered','$basic','$join_date";



				$SQL2 .= "','$sstatus','$s_archive_status','$height','$category','$id_mark','$religion','$appnt_date','$stype'";

				$SQL4 .= "','$sstatus','$s_archive_status','$height','$category','$id_mark','$religion','$appnt_date','$stype'";



				$SQL2 .= ",'$aicte_scale','$staff_group','$scales','$pay_scale','$substantive','$pan_no','$tan_no','$scard','$mobileno'";

				$SQL4 .= ",'$aicte_scale','$staff_group','$scales','$pay_scale','$substantive','$pan_no','$tan_no'";



				$SQL1 .= ",recruitment_procedure,pfscheme";

				$SQL3 .= ",recruitment_procedure,pfscheme";

				

				$SQL2 .= ",'$RecPro','$PFScheme'";

				$SQL4 .= ",'$RecPro','$PFScheme'";



				if($ph_pres != "")

					{

						$SQL1 .= ",ph_pres";		$SQL3 .= ",ph_pres";

						$SQL2 .= ",'$ph_pres'";		$SQL4 .= ",'$ph_pres'";

					}

				if($exp_prev != "")

					{

						$SQL1 .= ",exp_prev";		$SQL3 .= ",exp_prev";

						$SQL2 .= ",'$exp_prev'";    $SQL4 .= ",'$exp_prev'";

					}

				if($assoc != "")

					{

						$SQL1 .= ",sp_assoc"; 	$SQL3 .= ",sp_assoc";

						$SQL2 .= ",'$assoc'";	$SQL4 .= ",'$assoc'";

					}

				if($xtra != "")

					{

						$SQL1 .= ",xtra";		$SQL3 .= ",xtra";

						$SQL2 .= ",'$xtra'";	$SQL4 .= ",'$xtra'";

					}

				if($father != "")

					{

						$SQL1 .= ",father";			$SQL3 .= ",father";

						$SQL2 .= ",'$father'";	$SQL4 .= ",'$father'";

					}

				if($d_o_a != "")

					{

						$SQL1 .= ",doa";		$SQL3 .= ",doa";

						$SQL2 .= ",'$d_o_a'";	$SQL4 .= ",'$d_o_a'";

					}

				if($addr_perm != "")

					{

						$SQL1 .= ",addr_perm"; 	  $SQL3 .= ",addr_perm";

						$SQL2 .= ",'".addslashes($addr_perm)."'";	$SQL4 .= ",'".addslashes($addr_perm)."'";

					}

				if($ct_perm != "")

					{

						$SQL1 .= ",ct_perm";	$SQL3 .= ",ct_perm";

						$SQL2 .= ",'$ct_perm'"; $SQL4 .= ",'$ct_perm'";

					}

				if($pin_perm != "")

					{

						$SQL1 .= ",pin_perm";		$SQL3 .= ",pin_perm";

						$SQL2 .= ",'$pin_perm'"; 	$SQL4 .= ",'$pin_perm'";

					}

				if($ph_perm != "")

					{

						$SQL1 .= ",ph_perm";	$SQL3 .= ",ph_perm";

						$SQL2 .= ",'$ph_perm'";	$SQL4 .= ",'$ph_perm'";

					}

				if($state_perm != "")

					{

						$SQL1 .= ",st_perm";	$SQL3 .= ",st_perm";

						$SQL2 .= ",'$state_perm'";	$SQL4 .= ",'$state_perm'";

					}

				if($email != "")

					{

						$SQL1 .= ",email";		$SQL3 .= ",email";

						$SQL2 .= ",'$email'";	$SQL4 .= ",'$email'";

					}

	if($cmts != "")

	{

		$SQL1 .= ",cmts";	$SQL3 .= ",cmts";

		$SQL2 .= ",'$cmts'";	$SQL4 .= ",'$cmts'";

	}

        if($other_facilities != "")

	{

		$SQL1 .= ",other_facilities";		$SQL3 .= ",other_facilities";

		$SQL2 .= ",'$other_facilities'";		$SQL4 .= ",'$other_facilities'";

	}

        if($other_responsibilities != "")

	{

		$SQL1 .= ",other_responsibilities"; 	$SQL3 .= ",other_responsibilities";

		$SQL2 .= ",'$other_responsibilities'";		$SQL4 .= ",'$other_responsibilities'";

	}

        if($cert != "")

	{

		$SQL1 .= ",cert";		$SQL3 .= ",cert";

		$SQL2 .= ",'".addslashes($cert)."'";		$SQL4 .= ",'".addslashes($cert)."'";

	}

	if($exp_date != "")

	{

		$SQL1 .= ",expirydate";		$SQL3 .= ",expirydate";

		$SQL2 .= ",'$exp_date'";		$SQL4 .= ",'$exp_date'";

	}

	if($lwd != "")

	{

		$SQL1 .= ",last_date_of_work";		$SQL3 .= ",last_date_of_work";

		$SQL2 .= ",'$lwd'";		$SQL4 .= ",'$lwd'";

	}

	if(@$Gender != "")

	{

		$SQL1 .= ",gender";		$SQL3 .= ",gender";

		$SQL2 .= ",'$Gender'";		$SQL4 .= ",'$Gender'";

	}

	$SQL1 .= " )";

	$SQL2 .= ")";

	$SQL = $SQL1 . $SQL2;

	execute($SQL) or die("<p align=center>Can't insert $f_name's Details.</p>");

	$last_id=fetchInsertId();

	

	$stfldrid=$f_name."_".$last_id."_S";

	

	

	$sqlu="insert into staff_termination(staff_id,headg,eff_date,aut_name,san_no,san_date,remarks) values($last_id,'New Appointment','".date("Y-m-d")."','HR Manager','CLRT/HRM/NewApp/".$last_id."','".date("Y-m-d")."','Newly recruited staff')";

	execute ($sqlu) or die ("<p align=center>Could not insert...</p>");





	$sql_des="select a.* from staff_group a,staff_des b where b.d_id=$stype and a.id=b.group_id";

	$rs_des=execute($sql_des);

	$r_des=fetcharray($rs_des);

	if($r_des[name]=="teaching")

	{

		$staff_des="TS";

	}

	elseif($r_des[name]=="nonteaching")

	{

		$staff_des="NS";

	}

	$count=1000+strval($last_id);





	$temp_sql=execute("select * from college");

	$temp_r=fetcharray($temp_sql);

	$college_code=$temp_r[col_code];

	mysql_free_result($temp_sql);

	if(is_array($cid))

	{

		while( list(,$Value) = each($cid) )

		{

			$post = $_POST["post" . $Value];

			$city = $_POST["city" . $Value];

			$Organisation = $_POST["Organisation" . $Value];

			$country = $_POST["country" . $Value];

			$FrDay = $_POST["FrDay" . $Value];

			$FrMon = $_POST["FrMon" . $Value];

			$FrYear = $_POST["FrYear" . $Value];

			$LaDay = $_POST["LaDay" . $Value];

			$LaMon = $_POST["LaMon" . $Value];

			$LaYear = $_POST["LaYear" . $Value];

			$lastdate=$LaYear."-".$LaMon."-".$LaDay;

			$todate=$FrYear."-".$FrMon."-".$FrDay;

			$exp_type = $_POST["exp_type".$Value];

			

			$psql="insert into previous_job(staff_id,prev_post,prev_work_place,prev_work_city,prev_work_country,last_date_work,from_date,exp_type) values($last_id,'$post','$Organisation','$city','$country','$lastdate','$todate','$exp_type')";

			execute($psql)or die("<p align=center>previous_job</p>");

		}

	}



	if(is_array($qid))

	{

		while( list(,$Value) = each($qid) )

		{

			$course = $_POST["course" . $Value];

			$yearpass = $_POST["yearpass" . $Value];

			$college = $_POST["college" . $Value];

			$univers = $_POST["univers" . $Value];

			$regno = $_POST["regno" . $Value];

			$boardname = $_POST["boardname" . $Value];

			$specialization = $_POST["specialization" . $Value];	

			

			$psql="insert into staff_qualification(staff_id,course_name,year_pass,university,reg_date,name_board,college,specialization) values($last_id,'$course','$yearpass','$univers','$regno','$boardname','$college','$specialization')";

			execute($psql)or die("<p align=center>staff_qualification</p>");

		}

	}

	

	if(is_array($did))

	{   

	    while(list(,$Value)=each($did)) 

		{

			$dname = $_POST["dname".$Value];

			$drel = $_POST["drel".$Value];

			$doccu = $_POST["doccu".$Value];

			$dep_addr = $_POST["dep_addr".$Value];

			$d_phone = $_POST["d_phone".$Value];

			

			$sql=execute("insert into staff_dependents(staff_id,dname,drel,doccu,d_addr,d_phone) values($last_id,'$dname','$drel','$doccu','$dep_addr','$d_phone')") or die("<p align=center>staff_dependents</p>");

		}

	}

	$sql_des="update staff_det set slno='$staff_id' where id=$last_id";

	execute($sql_des);

	$query1="select max(id) as myid from staff_det";

	$result1=execute($query1);

	$row1=fetcharray($result1,0);



	$i=$row1["myid"];

	$SQL3 .= ",id )";

	$SQL4 .= ",$i)";

	$NewSQL= $SQL3 . $SQL4;

	

	execute($NewSQL) or die("<p align=center>Can't insert details into staff details temp</p>");



	$sql22=execute("select * from sal_head where name ='Basic'") or die(error_description('error1'));

	$rs22=fetcharray($sql22);

	

	$basic = 1000;

	execute("insert into empallowances (empid,allowance_id,percent,amt) values('$i','$rs22[id]','0','$basic')") or die('error2');

	

	$dou=date('Y-m-d');

	$sql3=" insert into archive(bank_ac_no,f_name,s_name,slno,id,date_of_updation,staff_status_id,subj,status_id,type_id";

	$sql4= "values('$bank_ac_no','$f_name','$s_name','$staff_id',$last_id,'$dou','$s_archive_status','$subj','$sstatus','$stype'";

	$sql3 .=",qual,offeredsal,basicsal,cert,sp_assoc,other_responsibilities,cmts)";

	$sql4 .=",'$qual','$offered','$basic','$cert','$sp_assoc','$other_responsibilities','$cmts')";

	$sql5=$sql3.$sql4;

	execute($sql5);// or die(mysql_error());



$leav_type=$_POST['leav_type'];
for($jm=0;$jm<sizeof($leav_type);$jm++)
{
$coacid=$leav_type[$jm];

execute("insert into staff_leave_type_group (`staff_id`, `leave_type`,`status`) values('$last_id','$coacid','1')");

}

?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Updated Successfully");

        </script>

        <?php

    }

?>

<script language="JavaScript">

function OpenWind(k)

{

	var finalVar;

	finalVar=k;

	window.open(finalVar,'Stud','height=600,width=750,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}

</script>

<?php

    if($phid=='')

	{

	    $phfg=1;

		$phid=date("YmdHis");

		$pth="../staff_images/temp/".$phid.".jpg";

	}

	else

	{

		$phid=str_replace(".jpg","","$phid");

		$pth="../staff_images/temp/".$phid.".jpg";

		$phfg=2;

	}

	$phpath="../staff_images/temp/";

?>

<input type='hidden' name='phid' value='<?=$phid?>'>

<input type='hidden' name='phfg' value='<?=$phfg?>'>

<table width="90%" border="0" align="center" cellpadding="0">

<tr><td Class="Head" align="center">STAFF PHOTO</td></tr>

<tr><td align='center'>

<table border='0' align='center' width='90%' class='forumline'>

<tr><td width='10%' height="67" align='center'>

<a href="javascript:OpenWind('../photobooth/index.php?phid=<?=$phid?>&phpath=<?=$phpath?>')">

<img src="../staff_images/temp/".$phid.".jpg"  title="Click to Capture Photo" border="1"></img>

</a>



<?php

  if($_REQUEST['phid'] )

  { 

    $tempimgpath="../staff_images/temp/".$_REQUEST['phid'];

  }

  else

  {

    $tempimgpath="../staff_images/temp/".$phid.".jpg";

  }

  if($phfg==2)

	{

	    if (file_exists("../staff_images") == false)

		{

			$dir_created= mkdir("../staff_images",0777);

			$var3 = $last_id.".jpg";

			$target_path = "../staff_images/".$var3;

			$orgfile="../staff_images/temp/".$phid.".jpg";	

		}

		$nop="update staff_det set img_col='$tempimgpath' where id='$last_id'";

		execute($nop)or die ("<p align=center>Could not ins...</p>");

		unlink($orgfile);

	}

	else

	{   

			$target_path = "../staff_images/";

			$fext=basename( $_FILES['uploadedfile']['name']);

			$fext1=explode(".",$fext);

			$fexn=$last_id.".".$fext1[1];

			$target_path = $target_path.$fexn;

			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))

			{

				echo "<img src='$target_path' width='90' height='100'>&nbsp;&nbsp;&nbsp;&nbsp;";

			}

			$sp="update staff_det set img_col='$tempimgpath' where id='$last_id'";

			execute($sp)or die ("<p align=center>Could not ins...</p>");

	}

  echo "<input type='hidden' name='tempimgpath' value='$tempimgpath'> ";

?>

</td><td align='center' width='10%'>

<?php

   echo "<img src='$tempimgpath'  width='75' height='85' border='1'>"

?>

</img></td></tr></table></td></tr>