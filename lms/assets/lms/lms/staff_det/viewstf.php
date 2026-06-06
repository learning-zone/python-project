<?php

session_start();

include("../db.php");

$user = $_SESSION['user'];

$r1=fetcharray(execute("select a.id from staff_det a,users b where a.slno=b.S_ID and b.username='$user'"));

$id1=$r1[0];



if($_POST)

{

$d_addr = $_POST['d_addr'];

$scard = $_POST['scard'];

$user = $_POST['user'];

$f_name = $_POST['f_name'];

$s_name2 = $_POST['s_name2'];

$gender = $_POST['gender'];

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

$panno = $_POST['panno'];

$xtra = $_POST['xtra'];

$sp_assoc = $_POST['sp_assoc'];

$cert = $_POST['cert'];

$cmts = $_POST['cmts'];

$subj = $_POST['subj'];

$slno = $_POST['slno'];

$staff_group = $_POST['staff_group'];

$stype = $_POST['stype'];

$sstatus = $_POST['sstatus'];

$category = $_POST['category'];

$s_name = $_POST['s_name'];

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

$spec = $_POST['spec'];

$yearpass = $_POST['yearpass'];

$college = $_POST['college'];

$univers = $_POST['univers'];

$regno = $_POST['regno'];

$boardname = $_POST['boardname'];

$exp_type = $_POST['exp_type'];

$post  = $_POST['post'];

$workplace = $_POST['workplace'];

$city   = $_POST['city'];

$country  = $_POST['country'];

$FrDay  = $_POST['FrDay'];

$FrMon  = $_POST['FrMon'];

$FrYear  = $_POST['FrYear'];

$LaDay  = $_POST['LaDay'];

$LaMon  = $_POST['LaMon'];

$LaYear  = $_POST['LaYear'];

$flag  = $_POST['flag'];

$did = $_POST['did'];

$dname  = $_POST['dname'];

$drel  = $_POST['drel'];

$dep_addr  = $_POST['dep_addr'];

$d_phone  = $_POST['d_phone'];

$doccu  = $_POST['doccu'];

$depmod  = $_POST['depmod'];

$depdet = $_POST['depdet'];

$depadd  = $_POST['depadd'];

$flag2  = $_POST['flag2'];

$st_perm = $_POST['st_perm'];

$st_pres = $_POST['st_pres'];

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

$archive = $_POST['archive'];

$B1  = $_POST['B1'];

$groupflag = $_POST['groupflag'];

$scaleflag = $_POST['scaleflag'];

$desflag = $_POST['desflag'];

$desflag1 = $_POST['desflag1'];

$offiflag = $_POST['offiflag'];

$addquali  = $_POST['addquali'];

$jodadd  = $_POST['jodadd'];

$phid = $_POST['phid'];

$phfg = $_POST['phfg'];

$phpath = $_POST['phpath'];

$cid = $_POST['cid'];

$join_date = $_POST['join_date'];

$d_o_b = $_POST['d_o_b'];

$d_o_r = $_POST['d_o_r'];

$dou = $_POST['dou'];

$exp_date = $_POST['exp_date'];

$lwd = $_POST['lwd'];

$d_o_a = $_POST['d_o_a'];

$lastdate = $_POST['lastdate'];

$todate = $_POST['todate'];

$phid = $_POST['phid'];

$s_a_status = $_POST['s_a_status'];

$id1 = $_POST['id1'];

$Modify = $_POST['Modify'];

$delpre = $_POST['delpre'];

$modifyquali = $_POST['modifyquali'];

$delequali = $_POST['delequali'];

$qid = $_POST['qid'];

}

if($flag=="")	

	{

		$sql="delete from temp_previous_job where username='$user'";

		execute($sql);

	}

if($flag1=="")	

	{

		$sql="delete from tempstaff_qualification where username='$user'";

		execute($sql);

	}

if($flag2=="")

	{

		$sql=execute("delete from temp_staff_dependents where username='$user'");

	}

if(isset($addquali))

	{

		$d_o_b = "$dobYear-$dobMon-$dobDay";

		$d_o_r = "$dorYear-$dorMon-$dorDay";

		$join_date = "$JYear-$JMon-$JDay";

		

		if(empty($course) && empty($yearpass) && empty($college))

			{

			}

		else

	{

	$sql="insert into staff_qualification(course_name,year_pass,university,reg_date,name_board,college,specialization,staff_id)";

	$sql.=" values('$course','$yearpass','$univers','$regno','$boardname','$college','$spec',$id1)";

	execute($sql);

	$flag1=1;

	$SQL1 = "UPDATE staff_det SET f_name='$f_name',slno='$slno',s_name='$s_name2',qual='$qual',subj='$subj',dob='$d_o_b',releive_date='$d_o_r',bg='$bg',ms='$ms',";

	$SQL1 .= "addr_pres='".addslashes($addr_pres)."',";

	$SQL1 .= "ct_pres='$ct_pres',pin_pres='$pin_pres',st_pres='$st_pres',type_id='$stype',offeredsal='$offeredsal',basicSal='$basicsal',j_date='$join_date',joined_as='$stype1',";

	$SQL1 .= "status_id='$sstatus',staff_status_id='$s_a_status',pfscheme='$PFScheme',substantive='$substantive',group_id=$staff_group";



	if($bank_ac_no!="")	

		{

			$SQL1.=",bank_ac_no='$bank_ac_no'";

		}

	if($offi_pay!="")	

		{

			$SQL1.=",officiating_pay ='$offi_pay'";

		}

	if($pf_ac_no!="")	

		{

			$SQL1.=",pf_ac_no='$pf_ac_no'";

		}

	if($prev_post!="")	

		{

			$SQL1.=",prev_post='$prev_post'";

		}

	if($prev_work_place!="")	

		{

			$SQL1.=",prev_work_place='$prev_work_place'";

		}

	if($prev_work_city!="")	

		{

			$SQL1.=",prev_work_city='$prev_work_city'";

		}

	if($prev_work_country!="")	

		{

			$SQL1.=",prev_work_country='$prev_work_country'";

		}

	if($ph_pres != "")

		{

			$SQL1 .= ",ph_pres='$ph_pres'";

		}

	if($exp_prev != "")

		{

			$SQL1 .= ",exp_prev=$exp_prev";

		}

	if($assoc != "")

		{

			$SQL1 .= ",sp_assoc='$assoc'";

		}

	if($xtra != "")

		{

			$SQL1 .= ",xtra='$xtra'";

		}

	if($father != "")

	{

		$SQL1 .= ",father='$father'";

	}

	if($husband != "")

	{

		$SQL1 .= ",husband='$husband'";

	}

	if($d_o_a != "")

	{

		$SQL1 .= ",doa='$d_o_a'";

	}

	if($addr_perm != "")

	{

	  $SQL1 .= ",addr_perm='".addslashes($addr_perm)."'";

	}

	if($ct_perm != "")

	{

		$SQL1 .= ",ct_perm='$ct_perm'";

	}

	if($pin_perm != "")

	{

		$SQL1 .= ",pin_perm='$pin_perm'";

	}

	if($ph_perm != "")

	{

		$SQL1 .= ",ph_perm='$ph_perm'";

	}

	if($state_perm != "")

	{

		$SQL1 .= ",st_perm='$st_perm'";

	}

	if($email != "")

	{

		$SQL1 .= ",email='$email'";

	}

	if($slno != "")

	{

		$SQL1 .= ",slno='$slno'";

	}

	if($cmts != "")

	{

		$SQL1 .= ",cmts='$cmts'";

	}

    if($other_facilities != "")

	{

		$SQL1 .= ",other_facilities='$other_facilities'";

	}

    if($other_responsibilities != "")

	{

		$SQL1 .= ",other_responsibilities='$other_responsibilities'";

	}

        if($cert != "")

	{

		$SQL1 .= ",cert='$cert'";

	}

	if($exp_date != "")

	{

		$SQL1 .= ",expirydate='$exp_date'";

	}



	$SQL1 .= ",date_of_updation='$dou'";

	$SQL1 .= ",last_date_of_work='$lwd'";



	if($gender != "")

	{

		$SQL1 .= ",gender='$gender'";

	}



	if ($archive=="on")

	{

		$SQL1 .= ",releive_date='$rd'";

	}

	else

	{

		$SQL1 .= ",releive_date='$d_o_r'";

	}



	$SQL1 .= " where id = $id1";

	$SQL = $SQL1 ;

	//echo $SQL;

	execute($SQL) or die(mysql_error()."error2");

}

}

if(isset($modifyquali))

{

	$d_o_b = "$dobYear-$dobMon-$dobDay";

	$d_o_r = "$dorYear-$dorMon-$dorDay";

	$join_date = "$JYear-$JMon-$JDay";

	$sql13=mysql_query("update staff_det set f_name='$f_name', s_name='$s_name2', slno='$slno', gender='$gender', pfscheme='$pfscheme', bank_ac_no='$bank_ac_no' ,pf_ac_no='$pf_ac_no', bank='$bank' where id='$id1'");



	if(is_array($qid))

	{

		while( list(,$Value) = each($qid) )	

		{

			//$Ccourse = "course" . $Value;

			//$course = $$Ccourse;

			$course = $_POST["course" . $Value];

			//$Cyearpass= "yearpass" . $Value;

			//$yearpass = $$Cyearpass;

			$yearpass = $_POST["yearpass" . $Value];

			//$Cunivers = "univers" . $Value;

			//$univers = $$Cunivers;

			$univers = $_POST["univers" . $Value];

			//$Ccountry = "country" . $Value;

			//$country = $$Ccountry;

			$country = $_POST["country" . $Value];

			//$Cregno = "regno" . $Value;

			//$regno = $$Cregno;

			$regno = $_POST["regno" . $Value];

			//$Cboardname = "boardname" . $Value;

			//$boardname = $$Cboardname;

			$boardname = $_POST["boardname" . $Value];

			//$Cspec = "spec" . $Value;

			//$spec = $$Cspec;

			$spec = $_POST["spec" . $Value];

			//$Ccollege = "college" . $Value;

			//$college = $$Ccollege;

			$college = $_POST["college" . $Value];

			$sqlstr = "Update staff_qualification set course_name ='$course',year_pass='$yearpass',";

			$sqlstr.="university ='$univers',reg_date='$regno',name_board='$boardname',college='$college',specialization='$spec' where id=$Value";

			execute($sqlstr) or die(mysql_error());

			$flag1=1;

		}

	}

}

if(isset($jodadd))

{

	 $d_o_b = "$dobYear-$dobMon-$dobDay";      

	 $d_o_r = "$dorYear-$dorMon-$dorDay";  

	 $join_date = "$JYear-$JMon-$JDay";

	 $dou = "$MoYear-$MoMon-$MoDay";

	 $SQL1 = "UPDATE staff_det SET f_name='$f_name',slno='$slno',s_name='$s_name2',qual='$qual',subj='$subj',dob='$d_o_b',releive_date='$d_o_r',bg='$bg',ms='$ms',";

	 $SQL1 .= "addr_pres='".addslashes($addr_pres)."',";

	 $SQL1 .= "ct_pres='$ct_pres',pin_pres='$pin_pres',st_pres='$st_pres',type_id='$stype',offeredsal='$offeredsal',basicSal='$basicsal',j_date='$join_date',joined_as='$stype1',";

	 $SQL1 .= "status_id='$sstatus',staff_status_id='$s_a_status',pfscheme='$PFScheme',substantive='$substantive',group_id=$staff_group";



		if($bank_ac_no!="")	

			{

				$SQL1.=",bank_ac_no='$bank_ac_no'";

			}

		if($offi_pay!="")	

			{

				$SQL1.=",officiating_pay ='$offi_pay'";

			}

		if($pf_ac_no!="")	

			{

				$SQL1.=",pf_ac_no='$pf_ac_no'";

			}

		if($prev_post!="")	

			{

				$SQL1.=",prev_post='$prev_post'";

			}

		if($prev_work_place!="")	

			{

				$SQL1.=",prev_work_place='$prev_work_place'";

			}

		if($prev_work_city!="")	

			{

				$SQL1.=",prev_work_city='$prev_work_city'";

			}

		if($prev_work_country!="")	

			{

				$SQL1.=",prev_work_country='$prev_work_country'";

			}

		if($ph_pres != "")

			{

				$SQL1 .= ",ph_pres='$ph_pres'";

			}

		if($exp_prev != "")

			{

				$SQL1 .= ",exp_prev=$exp_prev";

			}

		if($assoc != "")

			{

				$SQL1 .= ",sp_assoc='$assoc'";

			}

		if($xtra != "")

			{

				$SQL1 .= ",xtra='$xtra'";

			}

		if($father != "")

			{

				$SQL1 .= ",father='$father'";

			}

			if($husband != "")

			{

				$SQL1 .= ",husband='$husband'";

			}



		if($d_o_a != "")

			{

				$SQL1 .= ",doa='$d_o_a'";

			}

		if($addr_perm != "")

			{

				$SQL1 .= ",addr_perm='".addslashes($addr_perm)."'";

			}

		if($ct_perm != "")

			{

				$SQL1 .= ",ct_perm='$ct_perm'";

			}

		if($pin_perm != "")

			{

				$SQL1 .= ",pin_perm='$pin_perm'";

			}

		if($ph_perm != "")

			{

				$SQL1 .= ",ph_perm='$ph_perm'";

			}

		if($state_perm != "")

			{

				$SQL1 .= ",st_perm='$state_perm'";

			}

		if($email != "")

			{

				$SQL1 .= ",email='$email'";

			}

		if($slno != "")

			{

				$SQL1 .= ",slno='$slno'";

			}

		if($cmts != "")

			{

				$SQL1 .= ",cmts='$cmts'";

			}

        if($other_facilities != "")

			{

				$SQL1 .= ",other_facilities='$other_facilities'";

			}

        if($other_responsibilities != "")

			{

				$SQL1 .= ",other_responsibilities='$other_responsibilities'";

			}

        if($cert != "")

			{

				$SQL1 .= ",cert='$cert'";

			}

		if($exp_date != "")

			{

				$SQL1 .= ",expirydate='$exp_date'";

			}



		$SQL1 .= ",date_of_updation='$dou'";

		$SQL1 .= ",last_date_of_work='$lwd'";



		if(@$gender != "")

		{

				$SQL1 .= ",gender='$gender'";

		}

		if ($archive.value=="on")

		{

				$SQL1 .= ",releive_date='$rd'";

		}

		else

		{

			$SQL1 .= ",releive_date='$d_o_r'";

		}



		$SQL1 .= " where id = $id1";

		$SQL = $SQL1 ;

		//echo $SQL;

		execute($SQL); //or die(mysql_error()."error2");



		$lastdate=$LaYear."-".$LaMon."-".$LaDay;

		$todate=$FrYear."-".$FrMon."-".$FrDay;

		if(empty($post) && empty($workplace))

		{

		}

		else

		{

			$sql="insert into previous_job (prev_post,prev_work_place,prev_work_city,prev_work_country,last_date_work,from_date,staff_id,exp_type) values('$post','$workplace','$city','$country','$lastdate','$todate','$id1','$exp_type')";

			execute($sql);

			$flag=1;

		}

}



if(isset($modifyquali)) 

{

	$d_o_b = "$dobYear-$dobMon-$dobDay";

	$d_o_r = "$dorYear-$dorMon-$dorDay";

	$join_date = "$JYear-$JMon-$JDay";



	$sql13=mysql_query("update staff_det set f_name='$f_name', s_name='$s_name2', slno='$slno', gender='$gender', pfscheme='$pfscheme', bank_ac_no='$bank_ac_no' ,pf_ac_no='$pf_ac_no', bank='$bank' where id='$id1'");



	if(is_array($qid))

	{

		while( list(,$Value) = each($qid) )	

		{

			//$Ccourse = "course" . $Value;

			//$course = $$Ccourse;

			$course = $_POST["course" . $Value];

			//$Cyearpass= "yearpass" . $Value;

			//$yearpass = $$Cyearpass;

			$yearpass = $_POST["yearpass" . $Value];

			//$Cunivers = "univers" . $Value;

			//$univers = $$Cunivers;

			$univers = $_POST["univers" . $Value];

			//$Ccountry = "country" . $Value;

			//$country = $$Ccountry;

			$country = $_POST["country" . $Value];

			//$Cregno = "regno" . $Value;

			//$regno = $$Cregno;

			$regno = $_POST["regno" . $Value];

			//$Cboardname = "boardname" . $Value;

			//$boardname = $$Cboardname;

			$boardname = $_POST["boardname" . $Value];

			//$Cspec = "spec" . $Value;

			//$spec = $$Cspec;

			$spec = $_POST["pec" . $Value];

			//$Ccollege = "college" . $Value;

			//$college = $$Ccollege;

			$college = $_POST["college" . $Value];

			$sqlstr = "Update staff_qualification set course_name ='$course',year_pass='$yearpass',";

echo $sqlstr.="university ='$univers',reg_date='$regno',name_board='$boardname',college='$college',specialization='$spec' where id=$Value";

	die();		execute($sqlstr) or die(mysql_error());

			$flag1=1;

		}

	}

}



if(isset($delequali)) 

{

	$d_o_b = "$dobYear-$dobMon-$dobDay";

	$d_o_r = "$dorYear-$dorMon-$dorDay";

	$join_date = "$JYear-$JMon-$JDay";

	$sql13=mysql_query("update staff_det set f_name='$f_name', s_name='$s_name2', slno='$slno', gender='$gender', pfscheme='$pfscheme', bank_ac_no='$bank_ac_no' ,pf_ac_no='$pf_ac_no', bank='$bank' where id='$id1'");

	if(is_array($qid))

	{

		while( list(,$Value) = each($qid) )	

		{

			//$Ccourse = "course" . $Value;

			//$course = $$Ccourse;

			$course = $_POST["course" . $Value];

			//$Cyearpass= "yearpass" . $Value;

			//$yearpass = $$Cyearpass;

			$yearpass = $_POST["yearpass" . $Value];

			//$Cunivers = "univers" . $Value;

			//$univers = $$Cunivers;

			$univers = $_POST["univers" . $Value];

			//$Ccountry = "country" . $Value;

			//$country = $$Ccountry;

			$country = $_POST["country" . $Value];

			//$Cregno = "regno" . $Value;

			//$regno = $$Cregno;

			$regno = $_POST["regno" . $Value];

			//$Cboardname = "boardname" . $Value;

			//$boardname = $$Cboardname;

			$boardname = $_POST["boardname" . $Value];

			//$Cspec = "spec" . $Value;

			//$spec = $$Cspec;

			$spec = $_POST["spec" . $Value];

			//$Ccollege = "college" . $Value;

			//$college = $$Ccollege;

			$college = $_POST["college" . $Value];

			$sqlstr = "delete from staff_qualification where course_name ='$course' and year_pass='$yearpass' and id=$Value";

			execute($sqlstr) or die(mysql_error());

			$flag1=1;

		}

	}

}



//THIS PART FOR Previous Job details updation

if(isset($Modify))	

{

	$d_o_b = "$dobYear-$dobMon-$dobDay";

	$d_o_r = "$dorYear-$dorMon-$dorDay";

	$join_date = "$JYear-$JMon-$JDay";

	$dou = "$MoYear-$MoMon-$MoDay";

	$SQL1 = "UPDATE staff_det SET f_name='$f_name',slno='$slno',s_name='$s_name2',qual='$qual',subj='$subj',dob='$d_o_b',releive_date='$d_o_r',bg='$bg',ms='$ms',";

	$SQL1 .= "addr_pres='".addslashes($addr_pres)."',";

	$SQL1 .= "ct_pres='$ct_pres',pin_pres='$pin_pres',st_pres='$st_pres',type_id='$stype',offeredsal='$offeredsal',basicSal='$basicsal',j_date='$join_date',joined_as='$stype1',";

	 $SQL1 .= "status_id='$sstatus',staff_status_id='$s_a_status',pfscheme='$PFScheme',substantive='$substantive',group_id=$staff_group";



	if($bank_ac_no!="")	

	{

		$SQL1.=",bank_ac_no='$bank_ac_no'";

	}

	if($offi_pay!="")	

	{

		$SQL1.=",officiating_pay ='$offi_pay'";

	}

	if($pf_ac_no!="")	

	{

		$SQL1.=",pf_ac_no='$pf_ac_no'";

	}

	if($prev_post!="")	

	{

		$SQL1.=",prev_post='$prev_post'";

	}

	if($prev_work_place!="")	

	{

		$SQL1.=",prev_work_place='$prev_work_place'";

	}

	if($prev_work_city!="")	

	{

		$SQL1.=",prev_work_city='$prev_work_city'";

	}

	if($prev_work_country!="")	

	{

		$SQL1.=",prev_work_country='$prev_work_country'";

	}

	if($ph_pres != "")

	{

		$SQL1 .= ",ph_pres='$ph_pres'";

	}

	if($exp_prev != "")

	{

		$SQL1 .= ",exp_prev=$exp_prev";

	}

	if($assoc != "")

	{

		$SQL1 .= ",sp_assoc='$assoc'";

	}

	if($xtra != "")

	{

		$SQL1 .= ",xtra='$xtra'";

	}

	if($father != "")

	{

		$SQL1 .= ",father='$father'";

	}

	if($husband != ""){

		$SQL1 .= ",husband='$husband'";

	}

	if($d_o_a != "")

	{

		$SQL1 .= ",doa='$d_o_a'";

	}

	if($addr_perm != "")

	{

		$SQL1 .= ",addr_perm='".addslashes($addr_perm)."'";

	}

	if($ct_perm != "")

	{

		$SQL1 .= ",ct_perm='$ct_perm'";

	}

	if($pin_perm != "")

	{

		$SQL1 .= ",pin_perm='$pin_perm'";

	}

	if($ph_perm != "")

	{

		$SQL1 .= ",ph_perm='$ph_perm'";

	}

	if($state_perm != "")

	{

		$SQL1 .= ",st_perm='$state_perm'";

	}

	if($email != "")

	{

		$SQL1 .= ",email='$email'";

	}

	if($slno != ""){

		$SQL1 .= ",slno='$slno'";

	}

	if($cmts != "")

	{

		$SQL1 .= ",cmts='$cmts'";

	}

    if($other_facilities != "")

	{

		$SQL1 .= ",other_facilities='$other_facilities'";

	}

    if($other_responsibilities != "")

	{

		$SQL1 .= ",other_responsibilities='$other_responsibilities'";

	}

    if($cert != "")

	{

		$SQL1 .= ",cert='$cert'";

	}

	if($exp_date != "")

	{

		$SQL1 .= ",expirydate='$exp_date'";

	}



	$SQL1 .= ",date_of_updation='$dou'";

	$SQL1 .= ",last_date_of_work='$lwd'";



	if(@$gender != "")

	{

		$SQL1 .= ",gender='$gender'";

	}



	if ($archive.value=="on")

	{

		$SQL1 .= ",releive_date='$rd'";

	}

	else

	{

		$SQL1 .= ",releive_date='$d_o_r'";

	}



	$SQL1 .= " where id = $id1";

	$SQL = $SQL1 ;

	//echo $SQL;

	execute($SQL) or die(error_description()."error2");



	if(is_array($cid))

	{

		while( list(,$Value) = each($cid))	

		{

			//$CPost = "post" . $Value;

			//$post = $$CPost;

			$post = $_POST["post" . $Value];

			//$Ccity = "city" . $Value;

			//$city = $$Ccity;

			$city = $_POST["city" . $Value];

			//$Cworkplace = "workplace" . $Value;

			//$workplace = $$Cworkplace;

			$workplace = $_POST["workplace" . $Value];

			//$Ccountry = "country" . $Value;

			//$country = $$Ccountry;

			$country = $_POST["country" . $Value];

			//$Cexpyr = "expyr" . $Value;

			//$expyr = $$Cexpyr;

			$expyr = $_POST["expyr" . $Value];

			//$CLaDay = "LaDay" . $Value;

			//$LaDay = $$CLaDay;

			$LaDay = $_POST["LaDay" . $Value];

			//$CLaMon = "LaMon" . $Value;

			//$LaMon = $$CLaMon;

			$LaMon = $_POST["LaMon" . $Value];

			//$CLaYear = "LaYear" . $Value;

			//$LaYear = $$CLaYear;

			$LaYear = $_POST["LaYear" . $Value];

			//$CFrDay = "FrDay" . $Value;

			//$FrDay = $$CFrDay;

			$FrDay = $_POST["FrDay" . $Value];

			//$CFrMon = "FrMon" . $Value;

			//$FrMon = $$CFrMon;

			$FrMon = $_POST["FrMon" . $Value];

			//$CFrYear = "FrYear" . $Value;

			//$FrYear = $$CFrYear;

			$FrYear = $_POST["FrYear" . $Value];

			$lastdate=$LaYear."-".$LaMon."-".$LaDay;

			$todate=$FrYear."-".$FrMon."-".$FrDay;

			$Cexp_type="exp_type".$Value;

			$exp_type=$$Cexp_type;

			$sqlstr = "Update previous_job set prev_post='$post',prev_work_place='$workplace',";

			$sqlstr.="prev_work_city='$city',prev_work_country='$country',last_date_work='$lastdate',from_date='$todate',staff_id='$id1',exp_type='$exp_type' where id=$Value";

			execute($sqlstr) or die(mysql_error());

			$flag=1;

		}

	}

}







if(isset($delpre))	

{

	$d_o_b = "$dobYear-$dobMon-$dobDay";

	$d_o_r = "$dorYear-$dorMon-$dorDay";

	$join_date = "$JYear-$JMon-$JDay";

	$dou = "$MoYear-$MoMon-$MoDay";

	$SQL1 = "UPDATE staff_det SET f_name='$f_name',slno='$slno',s_name='$s_name2',qual='$qual',subj='$subj',dob='$d_o_b',releive_date='$d_o_r',bg='$bg',ms='$ms',";

	$SQL1 .= "addr_pres='".addslashes($addr_pres)."',";

	$SQL1 .= "ct_pres='$ct_pres',pin_pres='$pin_pres',st_pres='$st_pres',type_id='$stype',offeredsal='$offeredsal',basicSal='$basicsal',j_date='$join_date',joined_as='$stype1',";

	$SQL1 .= "status_id='$sstatus',staff_status_id='$s_a_status',pfscheme='$PFScheme',substantive='$substantive',group_id=$staff_group";



	if($bank_ac_no!="")	

	{

		$SQL1.=",bank_ac_no='$bank_ac_no'";

	}

	if($offi_pay!="")	

	{

		$SQL1.=",officiating_pay ='$offi_pay'";

	}

	if($pf_ac_no!="")	

	{

		$SQL1.=",pf_ac_no='$pf_ac_no'";

	}

	if($prev_post!="")	

	{

		$SQL1.=",prev_post='$prev_post'";

	}

	if($prev_work_place!="")	

	{

		$SQL1.=",prev_work_place='$prev_work_place'";

	}

	if($prev_work_city!="")	

	{

		$SQL1.=",prev_work_city='$prev_work_city'";

	}

	if($prev_work_country!="")	

	{

		$SQL1.=",prev_work_country='$prev_work_country'";

	}

	if($ph_pres != "")

	{

		$SQL1 .= ",ph_pres='$ph_pres'";

	}

	if($exp_prev != "")

	{

		$SQL1 .= ",exp_prev=$exp_prev";

	}

	if($assoc != ""){

		$SQL1 .= ",sp_assoc='$assoc'";

	}

	if($xtra != ""){

		$SQL1 .= ",xtra='$xtra'";

	}

	if($father != ""){

		$SQL1 .= ",father='$father'";

	}

	if($husband != ""){

		$SQL1 .= ",husband='$husband'";

	}

	if($d_o_a != ""){

		$SQL1 .= ",doa='$d_o_a'";

	}

	if($addr_perm != ""){

	$SQL1 .= ",addr_perm='".addslashes($addr_perm)."'";

	}

	if($ct_perm != ""){

		$SQL1 .= ",ct_perm='$ct_perm'";

	}

	if($pin_perm != ""){

		$SQL1 .= ",pin_perm='$pin_perm'";

	}

	if($ph_perm != ""){

		$SQL1 .= ",ph_perm='$ph_perm'";

	}

	if($state_perm != ""){

		$SQL1 .= ",st_perm='$state_perm'";

	}

	if($email != ""){

		$SQL1 .= ",email='$email'";

	}

	if($slno != ""){

		$SQL1 .= ",slno='$slno'";

	}

	if($cmts != ""){

		$SQL1 .= ",cmts='$cmts'";

	}

        if($other_facilities != ""){

		$SQL1 .= ",other_facilities='$other_facilities'";

	}

        if($other_responsibilities != ""){

		$SQL1 .= ",other_responsibilities='$other_responsibilities'";

	}

        if($cert != ""){

		$SQL1 .= ",cert='$cert'";

	}

	if($exp_date != ""){

		$SQL1 .= ",expirydate='$exp_date'";

	}



	$SQL1 .= ",date_of_updation='$dou'";

	$SQL1 .= ",last_date_of_work='$lwd'";



	if(@$gender != ""){

		$SQL1 .= ",gender='$gender'";

	}



	if ($archive.value=="on"){

		$SQL1 .= ",releive_date='$rd'";

	}

	else{

		$SQL1 .= ",releive_date='$d_o_r'";

	}



	$SQL1 .= " where id = $id1";

	$SQL = $SQL1 ;



//echo $SQL;

execute($SQL) or die(error_description()."error2");



	if(is_array($cid)){

	while( list(,$Value) = each($cid))	{

		//$CPost = "post" . $Value;

		//$post = $$CPost;

		//$Ccity = "city" . $Value;

		//$city = $$Ccity;

		//$Cworkplace = "workplace" . $Value;

		//$workplace = $$Cworkplace;

		//$Ccountry = "country" . $Value;

		//$country = $$Ccountry;

		//$Cexpyr = "expyr" . $Value;

		//$expyr = $$Cexpyr;

		//$CLaDay = "LaDay" . $Value;

		//$LaDay = $$CLaDay;

		//$CLaMon = "LaMon" . $Value;

		//$LaMon = $$CLaMon;

		//$CLaYear = "LaYear" . $Value;

		//$LaYear = $$CLaYear;

		//$CFrDay = "FrDay" . $Value;

		//$FrDay = $$CFrDay;

		//$CFrMon = "FrMon" . $Value;

		//$FrMon = $$CFrMon;

		//$CFrYear = "FrYear" . $Value;

		//$FrYear = $$CFrYear;

		//$lastdate=$LaYear."-".$LaMon."-".$LaDay;

		//$todate=$FrYear."-".$FrMon."-".$FrDay;

		//$Cexp_type="exp_type".$Value;

		//$exp_type=$$Cexp_type;

		

		$post = $_POST["post" . $Value];	

		$city = $_POST["city" . $Value];

		$workplace = $_POST["workplace" . $Value];

		$country = $_POST["country" . $Value];

		$expyr = $_POST["expyr" . $Value];

		$LaDay = $_POST["LaDay" . $Value];

		$LaMon = $_POST["LaMon" . $Value];

		$LaYear = $_POST["LaYear" . $Value];

		$FrDay = $_POST["FrDay" . $Value];

		$FrMon = $_POST["FrMon" . $Value];

		$FrYear = $_POST["FrYear" . $Value];

		$sqlstr = "delete from previous_job where prev_post='$post' and prev_work_place='$workplace' and id=$Value";

		execute($sqlstr) or die(mysql_error());

		$flag=1;

	}

	}

}

















//THIS PART FOR DEPENDENTS ADDITION 

if(isset($depadd))

{

  $d_o_b = "$dobYear-$dobMon-$dobDay";         

$d_o_r = "$dorYear-$dorMon-$dorDay";



$join_date = "$JYear-$JMon-$JDay";

	$dou = "$MoYear-$MoMon-$MoDay";

	$SQL1 = "UPDATE staff_det SET f_name='$f_name',slno='$slno',s_name='$s_name2',qual='$qual',subj='$subj',dob='$d_o_b',releive_date='$d_o_r',bg='$bg',ms='$ms',";

	$SQL1 .= "addr_pres='".addslashes($addr_pres)."',";

	$SQL1 .= "ct_pres='$ct_pres',pin_pres='$pin_pres',st_pres='$st_pres',type_id='$stype',offeredsal='$offeredsal',basicSal='$basicsal',j_date='$join_date',joined_as='$stype1',";

	$SQL1 .= "status_id='$sstatus',staff_status_id='$s_a_status',pfscheme='$PFScheme',substantive='$substantive',group_id=$staff_group";



	if($bank_ac_no!="")	{

		$SQL1.=",bank_ac_no='$bank_ac_no'";

	}

	if($offi_pay!="")	{

		$SQL1.=",officiating_pay ='$offi_pay'";

	}

	if($pf_ac_no!="")	{

		$SQL1.=",pf_ac_no='$pf_ac_no'";

	}

	if($prev_post!="")	{

		$SQL1.=",prev_post='$prev_post'";

	}

	if($prev_work_place!="")	{

		$SQL1.=",prev_work_place='$prev_work_place'";

	}

	if($prev_work_city!="")	{

		$SQL1.=",prev_work_city='$prev_work_city'";

	}

	if($prev_work_country!="")	{

		$SQL1.=",prev_work_country='$prev_work_country'";

	}

	if($ph_pres != ""){

		$SQL1 .= ",ph_pres='$ph_pres'";

	}

	if($exp_prev != ""){

		$SQL1 .= ",exp_prev=$exp_prev";

	}

	if($assoc != ""){

		$SQL1 .= ",sp_assoc='$assoc'";

	}

	if($xtra != ""){

		$SQL1 .= ",xtra='$xtra'";

	}

	if($father != ""){

		$SQL1 .= ",father='$father'";

	}

	if($husband != ""){

		$SQL1 .= ",husband='$husband'";

	}

	if($d_o_a != ""){

		$SQL1 .= ",doa='$d_o_a'";

	}

	if($addr_perm != ""){

	$SQL1 .= ",addr_perm='".addslashes($addr_perm)."'";

	}

	if($ct_perm != ""){

		$SQL1 .= ",ct_perm='$ct_perm'";

	}

	if($pin_perm != ""){

		$SQL1 .= ",pin_perm='$pin_perm'";

	}

	if($ph_perm != ""){

		$SQL1 .= ",ph_perm='$ph_perm'";

	}

	if($state_perm != ""){

		$SQL1 .= ",st_perm='$state_perm'";

	}

	if($email != ""){

		$SQL1 .= ",email='$email'";

	}

	if($slno != ""){

		$SQL1 .= ",slno='$slno'";

	}

	if($cmts != ""){

		$SQL1 .= ",cmts='$cmts'";

	}

        if($other_facilities != ""){

		$SQL1 .= ",other_facilities='$other_facilities'";

	}

        if($other_responsibilities != ""){

		$SQL1 .= ",other_responsibilities='$other_responsibilities'";

	}

        if($cert != ""){

		$SQL1 .= ",cert='$cert'";

	}

	if($exp_date != ""){

		$SQL1 .= ",expirydate='$exp_date'";

	}



	$SQL1 .= ",date_of_updation='$dou'";

	$SQL1 .= ",last_date_of_work='$lwd'";



	if(@$gender != ""){

		$SQL1 .= ",gender='$gender'";

	}



	if ($archive.value=="on"){

		$SQL1 .= ",releive_date='$rd'";

	}

	else{

		$SQL1 .= ",releive_date='$d_o_r'";

	}



	$SQL1 .= " where id = $id1";

	$SQL = $SQL1 ;



execute($SQL) or die(error_description()."error2");

	$sql="insert into staff_dependents(staff_id,dname,drel,doccu,d_addr,d_phone) values('$id1','$dname','$drel','$doccu','$d_addr','$d_phone')";



//echo $sql;

	execute($sql);

	$flag2=2;

}

//THIS PART FOR DEPENDENTS MODIFICATION

if(isset($depmod))

{

$join_date = "$JYear-$JMon-$JDay";

$d_o_b = "$dobYear-$dobMon-$dobDay";

$d_o_r = "$dorYear-$dorMon-$dorDay";

$dou = "$MoYear-$MoMon-$MoDay";

	$SQL1 = "UPDATE staff_det SET f_name='$f_name',slno='$slno',s_name='$s_name2',qual='$qual',subj='$subj',dob='$d_o_b',releive_date='$d_o_r',bg='$bg',ms='$ms',";

	$SQL1 .= "addr_pres='".addslashes($addr_pres)."',";

	$SQL1 .= "ct_pres='$ct_pres',pin_pres='$pin_pres',st_pres='$st_pres',type_id='$stype',offeredsal='$offeredsal',basicSal='$basicsal',j_date='$join_date',joined_as='$stype1',";

	$SQL1 .= "status_id='$sstatus',staff_status_id='$s_a_status',pfscheme='$PFScheme',substantive='$substantive',group_id=$staff_group";



	if($bank_ac_no!="")	

	{

		$SQL1.=",bank_ac_no='$bank_ac_no'";

	}

	if($offi_pay!="")	{

		$SQL1.=",officiating_pay ='$offi_pay'";

	}

	if($pf_ac_no!="")	{

		$SQL1.=",pf_ac_no='$pf_ac_no'";

	}

	if($prev_post!="")	{

		$SQL1.=",prev_post='$prev_post'";

	}

	if($prev_work_place!="")	{

		$SQL1.=",prev_work_place='$prev_work_place'";

	}

	if($prev_work_city!="")	{

		$SQL1.=",prev_work_city='$prev_work_city'";

	}

	if($prev_work_country!="")	{

		$SQL1.=",prev_work_country='$prev_work_country'";

	}

	if($ph_pres != ""){

		$SQL1 .= ",ph_pres='$ph_pres'";

	}

	if($exp_prev != ""){

		$SQL1 .= ",exp_prev=$exp_prev";

	}

	if($assoc != ""){

		$SQL1 .= ",sp_assoc='$assoc'";

	}

	if($xtra != ""){

		$SQL1 .= ",xtra='$xtra'";

	}

	if($father != ""){

		$SQL1 .= ",father='$father'";

	}

	if($husband != ""){

		$SQL1 .= ",husband='$husband'";

	}

	if($d_o_a != ""){

		$SQL1 .= ",doa='$d_o_a'";

	}

	if($addr_perm != ""){

	$SQL1 .= ",addr_perm='".addslashes($addr_perm)."'";

	}

	if($ct_perm != ""){

		$SQL1 .= ",ct_perm='$ct_perm'";

	}

	if($pin_perm != ""){

		$SQL1 .= ",pin_perm='$pin_perm'";

	}

	if($ph_perm != ""){

		$SQL1 .= ",ph_perm='$ph_perm'";

	}

	if($state_perm != ""){

		$SQL1 .= ",st_perm='$state_perm'";

	}

	if($email != ""){

		$SQL1 .= ",email='$email'";

	}

	if($slno != ""){

		$SQL1 .= ",slno='$slno'";

	}

	if($cmts != ""){

		$SQL1 .= ",cmts='$cmts'";

	}

        if($other_facilities != ""){

		$SQL1 .= ",other_facilities='$other_facilities'";

	}

        if($other_responsibilities != ""){

		$SQL1 .= ",other_responsibilities='$other_responsibilities'";

	}

        if($cert != ""){

		$SQL1 .= ",cert='$cert'";

	}

	if($exp_date != ""){

		$SQL1 .= ",expirydate='$exp_date'";

	}



	$SQL1 .= ",date_of_updation='$dou'";

	$SQL1 .= ",last_date_of_work='$lwd'";



	if(@$gender != ""){

		$SQL1 .= ",gender='$gender'";

	}



	if ($archive.value=="on"){

		$SQL1 .= ",releive_date='$rd'";

	}

	else{

		$SQL1 .= ",releive_date='$d_o_r'";

	}



	$SQL1 .= " where id = $id1";

	$SQL = $SQL1 ;



execute($SQL) or die(error_description()."error2");











	if(is_array($did)){

		while(list(,$Value)=each($did))	

		{

			//$d="dname".$Value;

			//$dname=$$d;

            //$ddddd="drel".$Value;

			//$drel=$$ddddd;

			//$dddddd="doccu".$Value;

			//$doccu=$$dddddd;


			//$ddddddd="d_addr".$Value;

			//$d_addr=$$ddddddd;

			//$d2="d_phone".$Value;

			//$d_phone=$$d2;

			

			$dname = $_POST["dname".$Value];

			$drel = $_POST["drel".$Value];

			$doccu = $_POST["doccu".$Value];

			$d_addr = $_POST["d_addr".$Value];

			$d_phone = $_POST["d_phone".$Value];

			$depupd=execute("update staff_dependents set dname='$dname',drel='$drel',doccu='$doccu',d_addr='$d_addr',d_phone='$d_phone' where id=$Value");

			$flag2=2;

		}

	}

}



if(isset($depdet))

{

  $d_o_b = "$dobYear-$dobMon-$dobDay";

 $d_o_r = "$dorYear-$dorMon-$dorDay";

 $join_date = "$JYear-$JMon-$JDay";

$dou = "$MoYear-$MoMon-$MoDay";

	$SQL1 = "UPDATE staff_det SET f_name='$f_name',slno='$slno',s_name='$s_name2',qual='$qual',subj='$subj',dob='$d_o_b',releive_date='$d_o_r',bg='$bg',ms='$ms',";

	$SQL1 .= "addr_pres='".addslashes($addr_pres)."',";

	$SQL1 .= "ct_pres='$ct_pres',pin_pres='$pin_pres',st_pres='$st_pres',type_id='$stype',offeredsal='$offeredsal',basicSal='$basicsal',j_date='$join_date',joined_as='$stype1',";

	$SQL1 .= "status_id='$sstatus',staff_status_id='$s_a_status',pfscheme='$PFScheme',substantive='$substantive',group_id=$staff_group";



	if($bank_ac_no!="")	{

		$SQL1.=",bank_ac_no='$bank_ac_no'";

	}

	if($offi_pay!="")	{

		$SQL1.=",officiating_pay ='$offi_pay'";

	}

	if($pf_ac_no!="")	{

		$SQL1.=",pf_ac_no='$pf_ac_no'";

	}

	if($prev_post!="")	{

		$SQL1.=",prev_post='$prev_post'";

	}

	if($prev_work_place!="")	{

		$SQL1.=",prev_work_place='$prev_work_place'";

	}

	if($prev_work_city!="")	{

		$SQL1.=",prev_work_city='$prev_work_city'";

	}

	if($prev_work_country!="")	{

		$SQL1.=",prev_work_country='$prev_work_country'";

	}

	if($ph_pres != ""){

		$SQL1 .= ",ph_pres='$ph_pres'";

	}

	if($exp_prev != ""){

		$SQL1 .= ",exp_prev=$exp_prev";

	}

	if($assoc != ""){

		$SQL1 .= ",sp_assoc='$assoc'";

	}

	if($xtra != ""){

		$SQL1 .= ",xtra='$xtra'";

	}

	if($father != ""){

		$SQL1 .= ",father='$father'";

	}

	if($husband != ""){

		$SQL1 .= ",husband='$husband'";

	}

	if($d_o_a != ""){

		$SQL1 .= ",doa='$d_o_a'";

	}

	if($addr_perm != ""){

	$SQL1 .= ",addr_perm='".addslashes($addr_perm)."'";

	}

	if($ct_perm != ""){

		$SQL1 .= ",ct_perm='$ct_perm'";

	}

	if($pin_perm != ""){

		$SQL1 .= ",pin_perm='$pin_perm'";

	}

	if($ph_perm != ""){

		$SQL1 .= ",ph_perm='$ph_perm'";

	}

	if($state_perm != ""){

		$SQL1 .= ",st_perm='$state_perm'";

	}

	if($email != ""){

		$SQL1 .= ",email='$email'";

	}

	if($slno != ""){

		$SQL1 .= ",slno='$slno'";

	}

	if($cmts != ""){

		$SQL1 .= ",cmts='$cmts'";

	}

        if($other_facilities != ""){

		$SQL1 .= ",other_facilities='$other_facilities'";

	}

        if($other_responsibilities != ""){

		$SQL1 .= ",other_responsibilities='$other_responsibilities'";

	}

        if($cert != ""){

		$SQL1 .= ",cert='$cert'";

	}

	if($exp_date != ""){

		$SQL1 .= ",expirydate='$exp_date'";

	}



	$SQL1 .= ",date_of_updation='$dou'";

	$SQL1 .= ",last_date_of_work='$lwd'";



	if(@$gender != ""){

		$SQL1 .= ",gender='$gender'";

	}



	if ($archive.value=="on"){

		$SQL1 .= ",releive_date='$rd'";

	}

	else{

		$SQL1 .= ",releive_date='$d_o_r'";

	}



	$SQL1 .= " where id = $id1";

	$SQL = $SQL1 ;

execute($SQL) or die(error_description()."error2");

	if(is_array($did))

	{

		while(list(,$Value)=each($did))	

		{

			//$d="dname".$Value;

			//$dname=$$d;

			$dname=$_POST["dname".$Value];

			//$ddddd="drel".$Value;

			//$drel=$$ddddd;

			$drel=$_POST["drel".$Value];

			//$dddddd="doccu".$Value;

			//$doccu=$$dddddd;

			$doccu=$_POST["doccu".$Value];

			//$ddddddd="d_addr".$Value;

			//$d_addr=$$ddddddd;

			$d_addr = $_POST["d_addr".$Value];

			//$d2="d_phone".$Value;

			//$d_phone=$$d2;

			$d_phone=$_POST["d_phone".$Value];

			//echo ("delete from  staff_dependents where dname='$dname' and drel='$drel' and doccu='$doccu' and id=$Value");

			$depdel=execute("delete from  staff_dependents where dname='$dname' and drel='$drel' and doccu='$doccu' and id=$Value");

			$flag2=2;

		}

	}

}



$bg1 = Array('NA','A+ve','B+ve','A-ve','B-ve','O+ve','O-ve','AB+ve','AB-ve');

?>

<html>

<head>

<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">

<script type="text/javascript">

	function copyadd()

	{

		document.frm.addr_perm.value = document.frm.addr_pres.value;

		document.frm.ct_perm.value = document.frm.ct_pres.value;

		document.frm.ph_perm.value = document.frm.ph_pres.value;

		document.frm.pin_perm.value = document.frm.pin_pres.value;

		document.frm.st_perm.value = document.frm.st_pres.value;

	}

function validate_me(){

	if(document.frm.f_name.value == ''){

		alert("Please provide a name to Staff");

		document.frm.f_name.focus();

		return false;

	}else if(document.frm.subj.value == ''){

		alert("Please select a Department");

		document.frm.subj.focus();

		return false;

	}else if(document.frm.staff_group.value == '-1'){

		alert("Please select a Staff Group");

		document.frm.staff_group.focus();

		return false;

	}else if(document.frm.stype.value == '-1'){

		alert("Please select a Staff Designation Type");

		document.frm.stype.focus();

		return false;

	}

	return true;

}

function reload1()

{

	document.frm.groupflag.value="modify";

	document.frm.action='viewstf.php'; 

	document.frm.submit();

}

function reload2()

{

	document.frm.scaleflag.value="modify";

	document.frm.action='viewstf.php'; 

	document.frm.submit();

}

function reload3()

{

	document.frm.desflag.value="modify";

	

	document.frm.action='viewstf.php'; 

	document.frm.submit();

}



function reload4()

{

	document.frm.desflag1.value="modify";

	

	document.frm.action='viewstf.php'; 

	document.frm.submit();

}



function go()

{

	document.frm.offiflag.value="modify";

	document.frm.action='viewstf.php'; 

	document.frm.submit();

}

function pf_reload(){

document.frm.action='viewstf.php';

document.frm.submit();

}

function sho()

{



	if(navigator.appName=="Netscape")

	{

		if (document.frm.sstatus.options[document.frm.sstatus.selectedIndex].value == 3)

		{

			document.frm.miscellaneous1.visibility = "show";

			document.frm.misc.select();

		}

		else

		{

			document.frm.miscellaneous1.visibility = "hide";

		}

	}

	else

	{

		if (document.frm.sstatus.options[document.frm.sstatus.selectedIndex].value == 3)

		{

			misc1.style.display = "";

			misc2.style.display = "";

			document.frm.expirydate.select();

		}

		else

		{

			misc1.style.display = "none";

			misc2.style.display = "none";

		}

	}



}



function sho_releive_date()

{

	if(navigator.appName=="Netscape")

	{

		if (document.frm.s_a_status.options[document.frm.s_a_status.selectedIndex].value == 2)

		{

			document.frm.miscellaneous1.visibility = "show";

			document.frm.miscellaneous.select();

			document.frm.archive.checked=true;

		}

		else

		{

			document.my1.visibility = "hide";

			document.frm.archive.checked=false;

		}

	}

	else

	{

		if (document.frm.s_a_status.options[document.frm.s_a_status.selectedIndex].value == 2)

		{

			miscellaneous1.style.display = "";

			miscellaneous2.style.display = "";

			//document.frm.releive_date.select();

			document.frm.archive.checked=true;

		}

		else

		{

			miscellaneous1.style.display = "none";

			miscellaneous2.style.display = "none";

			document.frm.archive.checked=false;

		}

	}

}



function send()

{

	if(validate_me()){

		document.frm.action='modifyStaff_view.php';

		document.frm.submit();

	}else{

		return false;	

	}

}

function OpenWind(k)

{

	var finalVar;

	finalVar=k;

	window.open(finalVar,'Stud','height=600,width=750,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}

</script>

<title>Modify Staff Detail</title>

</head>

<body>

<input type=hidden name="flag1" value="<?php echo $flag1?>">

<input type=hidden value="<?php echo $flag?>" name="flag">

<?php 

$sql=execute("select * from staff_det where id=$id1");

$r=fetcharray($sql);

?>

<form method="POST" name="frm" action="viewstf.php" enctype="multipart/form-data">

<input type="hidden" name="id1" value="<?php echo $id1?>">

  <table width="98%" border="0" align="center" cellpadding="0" class="forumline">

 

   <tr>

   <td colspan="4" align="center" class="head" >Modify Staff Memebers Details</td>

          </tr>

          <tr>

            <td colspan="4" class="row3" >Personal Details</td>

          </tr>

 <tr>

          <td height="25"  align="left">&nbsp;&nbsp;First Name</td>

          <td  align="left">

            <input type="text" name="f_name" size="20" value="<?php echo $r[f_name]?>" >

          </td>

          <td  align="left">Sur Name</td>

          <td  align="left">

            <input type="text" name="s_name2" size="20" value="<?php echo $r[s_name]?>">

         </td>

        </tr>

		 <tr>

          <td height="25" align="left">&nbsp;&nbsp;Gender</td>

          <td height="25" align="left"><select name="gender">

						<?php

			$tempML = "";

			$tempFML = "";

			if($r[gender]!="")

			{

				$gender=$r[gender];

			}

			if(trim($gender) == "MALE")

			{

				$tempML = "selected";

				$tempFML = "";

			}

			elseif(trim($gender) == "FEMALE"){

				$tempFML = "selected";

				$tempML = "";

			}

			?>

            <option value="MALE" <?php echo $tempML?>>Male</option>

            <option value="FEMALE" <?php echo $tempFML?>>Female</option>

          </select></td>

			<td height="25"  align="left">Date of Birth</td>

          <td height="25"  align="left">

            <?php

		$dob_yr = explode("-",$r["dob"]);

		$MyDay=$dob_yr[2];

//Day

		echo "<select name='dobDay'>";

		if ($MyDay == 00) {

		echo "<option></option>";

		}

		for($i=1;$i<=31;$i++){

		if($i == $MyDay)

		echo "<option value='$i' selected>$i</option>\n";

		else

		echo "<option value='$i'>$i</option>\n";

		}echo "</select>";

//Month

		$MyMonth=$dob_yr[1];

		echo "<select name='dobMon'>";

		if ($MyMonth == 00) {

		echo "<option></option>";

		}

		for($i=1;$i<=12;$i++){

		if($i == $MyMonth)

		echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";

		else

		echo "<option value='$i'>" . MonthName($i) . "</option>\n";

		}

		echo "</select>";

//Year

		$maxYr = 2010;

		$MyYear=$dob_yr[0];

		echo "<select name='dobYear'>";

		if ($MyYear == 00) {

		echo "<option></option>";

		}

		for($i=1940;$i<=$maxYr;$i++){

		if($i == $MyYear)

		echo "<option value='$i' selected>$i</option>\n";

		else

		echo "<option value='$i' >$i</option>\n";

		}

			  echo "</select>";

              $dorDay=$dobDay;

              $dorMon=$dobMon;

              $dorYear=$dobYear+58;

			  $d_o_r = "$dorYear-$dorMon-$dorDay";

         ?>

          </td></tr>

		<tr>

          <td height="25"  align="left">&nbsp;&nbsp;Blood Group</td>

          <td height="25"  align="left"><select name="bg" size="1">

            <?php

			while($val = each($bg1))

			{

			if(strncmp($val['value'],$r["bg"],4) == 0)

			{

		?>

					<option selected value="<?php echo $val['value']?>"><?php echo $val['value']?></option>

					<?php

			}

			else

			{

		?>

					<option value="<?php echo $val['value']?>"><?php echo $val['value']?></option>

					<?php

			}

		}

		?>

          </select></td>

			<td height="25"  align="left">Marital Status</td>

          <td height="25"  align="left">

            <select name="ms" size="1">

              <?php

	$tempMA = "";

	$tempUM = "";



	if(trim($r["ms"]) == "Married")

	{

		$tempMA = "SELECTED";

		$tempUM = "";

	}

	elseif(trim($r["ms"]) == "Unmarried"){

		$tempUM = "SELECTED";

		$tempMA = "";

	}

?>

              <option value="Married" <?php echo $tempMA?>>Married</option>

              <option value="Unmarried" <?php echo $tempUM?>>Unmarried</option>

            </select>

          </td></tr>

        <tr>

          <td height="25" align="left">&nbsp;&nbsp;Mobile Number&nbsp;</td>

          <td height="25" align="left">

            <input type="text" name="mobileno" size="15" value="<?php echo $r[mobileno]?>" maxlength='10'>

          </td>

          <td height="25" align="left">Email&nbsp;</td>

          <td height="25" align="left">

          <textarea rows="2" name="email" cols="40"><?php echo $r[email]?></textarea>

            

          </td>

        </tr>

       <tr>

          <td height="25"  align="left">&nbsp;&nbsp;Fathers/Husband Name</td>

          <td height="25"  align="left">

            <input type="text" name="father" size="20" value="<?php echo $r[father]?>">

          </td>

			<td align="left">Religion</td>

            <td align="left"><select name='religion'>

              <option value=''>-- Select Religion --</option>

              <?

		$qry=execute("select * from religion");

		for($s=0;$s<rowcount($qry);$s++)

		{

			$ff=fetcharray($qry,$s);

			if($r[religion]==$ff[id])	{

			$gg="selected";

			}else	{

						$gg="";

			}

	?>

              <option value="<?=$ff[id]?>" <?=$gg?>>

                <?=$ff[name]?>

              </option>

              <?	}

	?>

            </select></td></tr>

		<tr>

          <td height="25" align="left">&nbsp;&nbsp;Bank Name</td>

          <td height="25" align="left"><select name="bank">

            <option value='0'>-- Select --</option>

            <?php 

$bank11=execute("select * from bank_details where bank_name not like '%sb%' order by bank_name");

if($r[bank]!="")

{

	$bank=$r[bank];

}



while($bank1=fetcharray($bank11))

{

	if($bank1[bank_name]==$bank)

	{

		echo "<option value='$bank1[bank_name]' selected>$bank1[bank_name]</option>";

	}

	else

	{

		echo "<option value='$bank1[bank_name]'>$bank1[bank_name]</option>";

	}

}

?>

          </select></td>

          <td height="25"  align="left">Bank A/C No</td>

          <td height="25"  align="left">

            <input type="text" name="bank_ac_no" size="20" value="<?php echo $r[bank_ac_no]?>">

          </td>

        </tr>

        <tr>

          <td height="25"  align="left">&nbsp;&nbsp;PF A/C No.</td>

          <td height="25"  align="left">

            <input type="text" name="pf_ac_no" size="20" value="<?php echo $r[pf_ac_no]?>">

          </td>

          <td height="25"  align="left">PAN No.</td>

          <td height="25"  align="left">

            <input type="text" name="panno" size="20" value="<?php echo $r[panno]?>" >

          </td>

        </tr>

        <tr>

			<td align="left" valign="top">&nbsp;&nbsp;Extra Curricular

            Actitvities</td>

            <td align="left" valign="top"><input type="text" name="xtra" size="30" value="<?=$r[xtra]?>"></td>

          <td width="21%" align="left" height="25">Association(Membership of professional Bodies)</td>

          <td width="26%" align="left" height="25">

            <input type="text" name="sp_assoc" size="30" value="<?php echo $r[sp_assoc]?>">

          </td>

        </tr>

        <tr>

           

          <td width="24%" align="left" height="26">&nbsp;&nbsp;Rank/Merits/Certificates</td>

          <td width="29%" align="left">

		  <textarea rows="4" name="cert" cols="30"><?php echo $r[cert] ?></textarea>

          </td>           

            <td align="left" valign="top">Comments</td>

            <td align="left" valign="top"><textarea rows="4" name="cmts" cols="30"><?php echo $r[cmts]?></textarea></td>

          </tr>

       

      

  

    <tr>

    <td colspan="4">

    <div align="center">

      <table width="100%" cellspacing="4" cellpadding="0" border="0" align="left" class="forumline">

        <tr>

          <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0" >

              <tr>

			   <tr>

            

                <td class="row3" colspan=12><a name="UP">Office Details</a></td>

              </tr>

          </table></td>

        </tr>

        <tr>

          <td width="16%" height="27"  align="left">&nbsp;&nbsp;Department</td>

          <td width="37%" height="27"  align="left">

            <select name="subj" size="1" disabled>

              <option value="0">-- Select a Department --</option>

              <?php

$SQL = "SELECT * FROM dept_no";

$rs1 = execute($SQL);

$num = rowcount($rs1);

for($i=0;$i<$num;$i++){

	$r2 = fetcharray($rs1,$i);

	if($r2["dpt_id"] == $r[subj]){

?>

              <option selected value="<?php echo $r2[dpt_id]?>"> <?php echo $r2[0]?> </option>

              <?php 	}elseif($r2["dpt_id"] == $subj){

?>

              <option selected value="<?php echo $r2[dpt_id]?>"> <?php echo $r2[0]?> </option>

              <?php

	}else{

?>

              <option value="<?php echo $r2[1]?>"> <?php echo $r2[0]?> </option>

              <?php

	}

}

?>

            </select>

          </td>

		  <td align="left" height="27">Staff Id</td>

          <td align="left" height="27">

            <input type="text" name="slno"  value="<?php echo $r["slno"]?>" readonly>

          </td>

        </tr>

        <tr>

          <td align="left" height="25">&nbsp;&nbsp;Staff Group</td>

          <td align="left" height="25"><select size="1" name="staff_group" disabled>

              <option value="0">-- Select --</option>

              <?php 

	$mm=execute("select * from staff_group where status=1");

	for($k=0;$k<rowcount($mm);$k++)

	{

		$fmm=fetcharray($mm);

		if($groupflag=="modify")

		{

			if($staff_group==$fmm[id])

			{

				echo "<option value='$fmm[id]' selected>$fmm[name]</option>";

			}

			else

			{

				echo "<option value='$fmm[id]'>$fmm[name]</option>";

			}

		}

		else

		{

			$staff_group=$r[group_id];

			if($r[group_id]==$fmm[id])

			{

				echo "<option value='$fmm[id]' selected>$fmm[name]</option>";

			}

			else

			{

				echo "<option value=$fmm[id]>$fmm[name]</option>";

			}

		}

}

	

?>

          </select></td>

          <td align="left" height="25">Staff Designation</td>

          <td align="left" height="25">

            <!-- <select name="stype" size="1" onChange="reload3()"> -->

            <select name="stype" size="1" disabled>

              <option value="0">-- Select a Type --</option>

              <?php



$SQL = "SELECT * FROM staff_des";

$rs2 = execute($SQL);

$num = rowcount($rs2);



for($i=0;$i<$num;$i++)

{

	$r2 = fetcharray($rs2,$i);

	if($desflag=="modify")

	{

		if($r2["d_id"] == $stype)

		{

			

			$desg=explode("/",$r2[d_name]);

			

			for($m=0;$m<=4;$m++)

			{

			   if($desg[m]!="")

			{						

			  echo "<option value='$r2[d_id]' selected>$desg[m]</option>";

			}				

			}

			echo "<option value='$r2[d_id]' selected>$r2[d_name]</option>";

		}

		else

		{

			echo "<option value=$r2[d_id]>$r2[d_name]</option>";

		}

	}

	else

	{

		$stype=$r[type_id];

		if($r2["d_id"] == $r[type_id])

		{

 		   echo	"<option value=$r2[d_id] selected>$r2[d_name]</option>";

		}

		else

		{

 		   echo	"<option value=$r2[d_id]>$r2[d_name]</option>";

		}

	}

	

}	

?>

            </select>

          </td>

        </tr>

        <tr align="center">

          <td width="21%" align="left" height="25">&nbsp;&nbsp;Staff Type</td>

<!--          <td width="26%" align="left" height="25"><select size="1" name="sstatus" onChange="sho()"> -->

          <td width="26%" align="left" height="25"><select size="1" name="sstatus" disabled>

              <option value="0">-- Select --</option>

              <?php

			$rs2 = execute("SELECT * FROM staff_status");

			$num = rowcount($rs2);

			for($i=0;$i<$num;$i++)

			{

				$r2 = fetcharray($rs2,$i);

				if($r2["id"] == $r[status_id])

		 {

?>

              <option selected value="<?php echo $r2[id]?>"><?php echo $r2["name"]?></option>

              <?php	

	}

		elseif($r2["id"] == $sstatus)

		{

?>

              <option selected value="<?php echo $r2[id]?>"><?php echo $r2["name"]?></option>

              <?php	}

else

	{

?>

              <option value="<?php echo $r2["id"]?>"><?php echo $r2["name"]?></option>

              <?php

	}

}

if($r["status_id"] == 3)

{

	@$tempStr = "";

}

else

	{

		@$tempStr = "none";

	}

@$d=explode(" ",$r["expirydate"]);


$check_cat1='';
$check_cat2='';

if($r[category]==1)
{
	$check_cat1='selected';
}
elseif($r[category]==2)
{
	$check_cat2='selected';
}
else
{
	$check_cat1='';
	$check_cat2='';
}
?>

          </select></td>

          <td align="left" height="26">Category</td>

          <td align="left"><select name='category' disabled>
              <option value='' >-- Select Category --</option>
              <option value='1' <?=$check_cat1?>>Teaching</option>
              <option value='2' <?=$check_cat2?>>Non Teaching</option>
          </select></td>

        </tr>

		  <tr align="center">

		<td height="25" align="left">&nbsp;&nbsp;Swap Card Number</td>

          <td height="25" align="left">

            <input type="text" name="s_name" size="20" value="<?php echo $r[scard]?>" readonly>

          </td>

          <td align="left" valign="top">Recruited As Per Rule</td>

          <td align="left">

            <select name="RecPro" disabled>

              <?php

$tempr="";

$tempr1="";

if($r[recruitment_procedure]=="YES")

{

	$tempr="selected";

	$tempr1="";

}

elseif($r[recruitment_procedure]=="NO")

{

	$tempr1="selected";

	$tempr="";

}

?>

              <option value="YES" <?=$tempr?>>YES</option>

              <option value="NO" <?=$tempr1?>>NO</option>

            </select>

          </td>

        </tr>

       

        <tr align="center">

          <td align="left" height="34">&nbsp;&nbsp;Appointment Order Date</td>

          <td align="left" height="34"><?php

	$yr = explode("-",$r["appnt_date"]);

	$MyDay=$yr[2];



echo "<select name='AppDay' disabled>";

	for($i=1;$i<=31;$i++){

	if($i == $MyDay)

		echo "<option value='$i' selected>$i</option>\n";

	else

		echo "<option value='$i' >$i</option>\n";

	}

	echo "</select>";

	



$MyMonth=$yr[1];

//Month

echo "<select name='AppMon' disabled>";

	for($i=1;$i<=12;$i++)

	{

		if($i == $MyMonth)

			echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";

		else

			echo "<option value='$i' >" . MonthName($i) . "</option>\n";

	}

	echo "</select>";

	//Year

$maxYr = date("Y")+2;

$MyYear=$yr[0];

	echo "<select name='AppYear' disabled>";

	for($i=1940;$i<=$maxYr;$i++)

	{

		if($i == $MyYear)

			echo "<option value='$i' selected>$i</option>\n";

		else

			echo "<option value='$i' >$i</option>\n";

	}

	echo "</select>";

echo "<input type=hidden name=AD >";

?></td>

          <td width="16%" align="left" height="34">Date of Joining</td>

          <td width="37%" align="left" height="34">

            <?php

	$yr = explode("-",$r["j_date"]);

	$MyDay=$yr[2];

       

//Day

	echo "<select name='JDay' disabled>";

	if ($MyDay == 00) {

		echo "<option></option>";

		}

	for($i=1;$i<=31;$i++){

	if($i == $MyDay)

	echo "<option value='$i' selected>$i</option>\n";

	else

	echo "<option value='$i'>$i</option>\n";

	}


	echo "</select>";

	$MyMonth=$yr[1];

	//Month

	echo "<select name='JMon' disabled>";

	if ($MyMonth == 00) {

		echo "<option></option>";

		}

	for($i=1;$i<=12;$i++){

	if($i == $MyMonth)

	echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";

	else

	echo "<option value='$i'>" . MonthName($i) . "</option>\n";

	}

	echo "</select>";



	//Year

	$maxYr =2020;

	$MyYear=$yr[0];

	echo "<select name='JYear' disabled>";

	if ($MyYear == 00) {

		echo "<option></option>";

		}

	for($i=2001;$i<=$maxYr;$i++){

	if($i == $MyYear)

	echo "<option value='$i' selected>$i</option>\n";

	else

	echo "<option value='$i' >$i</option>\n";

	}echo "</select>";

?>

         </td>

        </tr>

        <tr align="center">

          <td align="left" valign="top">&nbsp;&nbsp;Facilities Offered</td>

          <td align="left">

            <textarea name="other_facilities" rows=4 cols=30 readonly><?php echo $r[other_facilities]?></textarea>

          </td>

          <td width="16%" align="left" valign="top">Responsibilities</td>

          <td width="37%" align="left">

            <textarea name="other_responsibilities" rows=4 cols=30 readonly><?php echo $r[other_responsibilities]?></textarea>

          </td>

        </tr>

      </table>

    </div>    </td>

    </tr>
<?php
$subj=$r['subj'];
$staff_group=$r['group_id'];
$stype=$r['type_id'];
$sstatus=$r['status_id'];
$category=$r['category'];
$RecPro=$r['recruitment_procedure'];
?>    <tr>

    <td colspan="4">

    <table class="forumline" align="center" width="100%">

      <tr align="center">

		<td colspan="2" align="left" class="row3"><div align="left">Present Address</td>

		<td colspan="2" align="left" class="row3">

		  If Permnent address is same as Present Address Click Here:<input type="checkbox" onClick="copyadd();"><div align="left">Permenent Address</td>

	</tr>

      <tr>

        <td valign="top">&nbsp;&nbsp;Street Address</td>

        <td>

          <textarea rows="4" name="addr_pres" cols="30"><?php echo $r[addr_pres]?></textarea>

        </td>

        <td valign="top">Street Address</td>

        <td>

          <textarea rows="4" name="addr_perm" cols="30"><?php echo $r[addr_perm]?></textarea>

        </td>

      </tr>

      <tr>

        <td valign="top">&nbsp;&nbsp;City</td>

        <td>

          <input type="text" name="ct_pres" size="20" value="<?php echo $r[ct_pres]?>">

        </td>

        <td>City</td>

        <td>

          <input type="text" name="ct_perm" size="20" value="<?php echo $r[ct_perm]?>">

       </td>

      </tr>

      <tr>

        <td valign="top" width="17%">&nbsp;&nbsp;Pin</td>

        <td width="32%">

          <input type="text" name="pin_pres" size="20" value="<?php echo $r[pin_pres]?>">

        </td>

        <td width="17%"><p>Pin</td>

        <td width="34%">

          <input type="text" name="pin_perm" size="20" value="<?php echo $r[pin_perm]?>">

        </td>

      </tr>

      <tr>

        <td width="17%"><p>&nbsp;&nbsp;State</td>

        <td width="32%">

          <input type="text" name="st_pres" size="20" value="<?php echo $r[st_pres]?>">

        </td>

        <td width="17%"><p>State</td>

        <td width="34%">

          <input type="text" name="st_perm" size="20" value="<?php echo $r[st_perm]?>">

        </td>

      </tr>

      <tr>

        <td width="17%">&nbsp;&nbsp;Phone</td>

        <td width="32%">

          <input type="text" name="ph_pres" size="20" value="<?php echo $r[ph_pres]?>">

</td>

          <td>Phone</td>

          <td>

            <input type="text" name="ph_perm" size="20" value="<?php echo $r[ph_perm]?>">

         </td>

      </tr>

     

	<tr>

              <td  align="center" height="25" >&nbsp;&nbsp;

              <img src="<?php echo $r[img_col]?>" width="100px" height="120px;" />

			  <?php			  

			  $imgpth="../staff_images/";


			  ?>

             </td><td  align="center" height="25" ><input type='FILE' name='uploadedfile' value="" size='15'></td>

						  <td colspan='2'>&nbsp;</td>

		  </tr>

      <tr height='50' valign='bottom'>

        <td colspan='3'>&nbsp;</td>

        <td colspan="3"></td>

      </tr>

    </table></td>

    </tr>

    <tr>

    <td colspan="4">

    </td>

    </tr>

    </table>

    <br>

<table border="0" cellspacing="2" cellpadding="0" class="forumline" width="98%" align="center">

<tr><td class= "head" align="center" colspan="9"> Additional Details</td></tr>

            <tr align="left">

              <td colspan=8 class="row3">Qualification</td>

            </tr>

            <?php

$qsql="select * from staff_qualification where staff_id=$id1";

$qrs=execute($qsql);

$qnum=rowcount($qrs);

if($qnum>=1)

{

	echo "<tr>";

	echo "<td class='rowpic' width='5%' align='center'>select</td>";

	echo "<td class='rowpic'>Course</td>";

	echo "<td class='rowpic'>Specialization</td>";

	echo "<td class='rowpic'>Year of Passing</td>";

	echo "<td class='rowpic'>College</td>";

	echo "<td class='rowpic'>University</td>";

	echo "<td class='rowpic'>SR Number</td>";

	echo "<td class='rowpic'>Name of th State Council</td>";

	echo "</tr>";

	for($q=0;$q<$qnum;$q++)

	{

			$qrow=fetcharray($qrs,$q);

			echo "<tr>";

			echo "<td align='center'><input type=checkbox name='qid[]' value=$qrow[0] checked></td>";

			echo "<td><input type=text name='course$qrow[0]' value='$qrow[2]' ></td>";

			echo "<td><input type=text name='spec$qrow[0]' value='$qrow[8]'></td>";

			echo "<td><input type=text name='yearpass$qrow[0]' value='$qrow[3]'></td>";

			echo "<td><input type=text name='college$qrow[0]' value='$qrow[7]' ></td>";

			echo "<td><input type=text name='univers$qrow[0]' value='$qrow[4]'></td>";

			echo "<td><input type=text name='regno$qrow[0]' value='$qrow[5]'></td>";

			echo "<td><input type=text name='boardname$qrow[0]' value='$qrow[6]'></td>";

			echo "</tr>";

	}

	$flag1=1;

	?>

            <input type="hidden" value="<?php echo $flag1?>" name="flag1">

            <?php

	echo "<tr>";

	echo "<td colspan=8 align=left><input type=submit value='Modify' class=bgbutton name='modifyquali'>";

	echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit value='Delete' class=bgbutton name='delequali'></td>";

	echo "</tr>";

}

?>

            <tr>

              <td class='rowpic' colspan='2'>Course</td>

              <td class='rowpic'>Specialization</td>

              <td class='rowpic'>Year of Passing</td>

              <td class='rowpic'>College</td>

              <td class='rowpic'>University</td>

              <td class='rowpic'>Council SR Number & date</td>

              <td class='rowpic'>Name of th State Council</td>

            </tr>

            <tr>

              <td colspan='2'><input type="text" name="course"  width="100%"></td>

              <td><input type="text" name="spec"  width="100%"></td>

              <td><input type="text" name="yearpass"  width="100%"></td>

              <td><input type="text" name="college"  width="100%"></td>

              <td><input type="text" name="univers"  width="100%"></td>

              <td><input type="text" name="regno"  width="100%"></td>

              <td colspan='2'><input type="text" name="boardname"  width="100%"></td>

            </tr>

            <tr>

              <?php

	$flag1=1;

?>

              <input type="hidden" name="flag1" value="<?php echo $flag1?>">

              <td colspan="8" align="left"><input type="submit" name="addquali" value='Add' class="bgbutton"></td>

            </tr>

        </table></td>

    </tr>

    <tr>

      <td colspan="4">

        

        <table width="98%" cellspacing="2" cellpadding="0" border="0" align="CENTER" class="forumline">

          <tr>

            <td colspan=8 class="row3">Previous Job Details</td>

          </tr>

          <?php

  $rsql="select * from previous_job where staff_id='$id1'";

  $rrs=execute($rsql);

  $rnum=rowcount($rrs); 

  if($rnum>=1)

  {

  	echo "<tr>";

    echo "<td class='rowpic' width='5%' align='center'>Select</td>";

	echo "<td class='rowpic'>Experience In</td>";

	echo "<td class='rowpic'>Post</td>";

  	echo "<td class='rowpic'>Organisation</td>";

  	echo "<td class='rowpic'>City</td>";

  	echo "<td class='rowpic'>Country</td>";

  	echo "<td class='rowpic'>From Date</td>";

  	echo "<td class='rowpic'>To Date</td>";

  	echo "</tr>";

	while($prow=fetcharray($rrs,$i))

	{

		echo "<tr>";

		echo "<td align='center'><input type=checkbox name='cid[]' value=$prow[0] checked></td>";

		echo "<td><select name=exp_type$prow[0]>";

		if($prow[exp_type]=="Teaching")	{

			$sel1="selected";

		}elseif($prow[exp_type]=="Practice")	{

			$sel2="selected";

		}elseif($prow[exp_type]=="Industry"){

			$sel3="selected";

		}elseif($prow[exp_type]=="Research"){

			$sel4="selected";

		}

		elseif($prow[exp_type]=="Clerical"){

			$sel5="selected";

		}elseif($prow[exp_type]=="Administration"){

			$sel6="selected";

		}elseif($prow[exp_type]=="Accounts"){

			$sel7="selected";

		}elseif($prow[exp_type]=="Computers"){

			$sel9="selected";

		}		

		echo "<option value='Teaching' $sel1>Teaching</option>";

		echo "<option value='Practice' $sel2>Practice</option>";

		echo "<option value='Industry' $sel3>Industry</option>";

		echo "<option value='Clerical' $sel5>Clerical</option>";

		echo "<option value='Administration' $sel6>Administration</option>";

		echo "<option value='Accounts' $sel7>Accounts</option>";

		echo "<option value='Computers' $sel9>Computers</option>";

		echo "<option value='Research' $sel4>Research</option></select></td>";

		echo "<td><input type=text name='post$prow[0]' value='$prow[2]'></td>";

		echo "<td><input type=text name='workplace$prow[0]' value='$prow[3]'></td>";

		echo "<td><input type=text name='city$prow[0]' value='$prow[4]'></td>";

		echo "<td><input type=text name='country$prow[0]' value='$prow[5]'></td>";

		echo "<td nowrap>";

		//from date

//Day

		$fm_yr = explode("-",$prow[7]);

		$MyDay=$fm_yr[2];

		echo "<select name='FrDay$prow[0]'>";

		echo "<option></option>";

		for($i=1;$i<=31;$i++)

		{

		if($i == $MyDay)

			echo "<option value='$i'selected>$i</option>\n";

		else

			echo "<option value='$i'>$i</option>\n";

		}

		  echo "</select>";  

//Month

		  $MyMonth=$fm_yr[1];

		  echo "<select name='FrMon$prow[0]'>";

		  echo "<option></option>";

		  for($i=1;$i<=12;$i++)  {

		  	if($i == $MyMonth)

		  		echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";

		  	else

		  		echo "<option value='$i'>" . MonthName($i) . "</option>\n";

		  	}

		  	echo "</select>";

//Year

		$maxYr =date('Y');

		$MyYear=$fm_yr[0];

		echo "<select name='FrYear$prow[0]'>";

		echo "<option></option>";

		for($i=1940;$i<=$maxYr;$i++){

			if($i == $MyYear)

				echo "<option value='$i' selected >$i</option>\n";

			else

				echo "<option value='$i' >$i</option>\n";

		}

		echo "</select>";

		echo "</td>";

//end from date

// to date

		echo "<td nowrap>";

		$last_yr = explode("-",$prow[6]);

		$MyDay=$last_yr[2];

		//Day

		echo "<select name='LaDay$prow[0]'>";

		echo "<option></option>";

		for($i=1;$i<=31;$i++){

		if($i == $MyDay)

			echo "<option value='$i'selected>$i</option>\n";

		else

			echo "<option value='$i'>$i</option>\n";

		}

		echo "</select>";

		$MyMonth=$last_yr[1];

		//Month

		echo "<select name='LaMon$prow[0]'>";

		echo "<option></option>";

		for($i=1;$i<=12;$i++)

		{

			if($i == $MyMonth)

				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";

			else

				echo "<option value='$i'>" . MonthName($i) . "</option>\n";

		}

		echo "</select>";

		//Year



		$maxYr =date("Y");

		$MyYear=$last_yr[0];

		echo "<select name='LaYear$prow[0]'>";

		echo "<option></option>";

		for($i=1940;$i<=$maxYr;$i++)

		{

			if($i == $MyYear)

				echo "<option value='$i' selected >$i</option>\n";

			else

				echo "<option value='$i' >$i</option>\n";

		}

		echo "</select>";

		echo "</td>";

		//end to date

		echo "</tr>";

		}

	$flag=1;

?>

          <tr>

            <td colspan=8><input type=submit name='Modify' value='Modify' class=bgbutton>&nbsp;&nbsp;&nbsp;&nbsp;

              <input type=submit name='delpre' value='Delete' class=bgbutton></td>

          </tr>

          <?php

	}

?>

          <tr>

            <td class="rowpic" colspan='2'>Experience In</td>

            <td class="rowpic">Post</td>

            <td class="rowpic">Organisation</td>

            <td class="rowpic">City</td>

            <td class="rowpic">Country</td>

            <td class="rowpic">From date</td>

            <td class="rowpic">To Date</td>

          </tr>

          <tr>

            <td colspan='2'><select name="exp_type">

                <option value="Teaching">Teaching</option>

                <option value="Practice">Practice</option>

                <option value="Industry">Industry</option>

                <option value="Clerical">Clerical</option>

                <option value='Administration'>Administration</option>

                <option value='Accounts' >Accounts</option>

                <option value='Computers'>Computers</option>

                <option value="Research">Research</option>

              </select></td>

            <td><input type=text name='post'  width="100%"></td>

            <td><input type=text name='workplace'  width="100%"></td>

            <td><input type=text name='city'  width="100%"></td>

            <td><input type=text name='country'  width="100%"></td>

            <td nowrap><?php

      //from date

      	$d=getdate();

      	$MyDay=$d["mday"];

      	//Day

      	echo "<select name='FrDay'>";

      	echo "<option></option>";

      	for($i=1;$i<=31;$i++){

      	if($i == $MyDay)

      		echo "<option value='$i' >$i</option>\n";

      	else

      		echo "<option value='$i'>$i</option>\n";

      	}

      	echo "</select>";

      	$MyMonth=$d["mon"];

      	//Month

      	echo "<select name='FrMon'>";

      	echo "<option></option>";

      	for($i=1;$i<=12;$i++)

      	{

      		if($i == $MyMonth)

      			echo "<option value='$i' >" . MonthName($i) . "</option>\n";

      		else

      			echo "<option value='$i'>" . MonthName($i) . "</option>\n";

      	}

      	echo "</select>";

      	//Year

      	$maxYr =$d["year"]+5;

      	$MyYear=$d["year"];

      	echo "<select name='FrYear'>";

      	echo "<option></option>";

      	for($i=1940;$i<=$maxYr;$i++)

      	{

      		if($i == $MyYear)

      			echo "<option value='$i' >$i</option>\n";

      		else

      			echo "<option value='$i' >$i</option>\n";

      	}

      	echo "</select>";

      	echo "</td>";

      	//end from date

      	//to date

      	?>

            <td colspan='2' nowrap><?php

		$d=getdate();

		$MyDay=$d["mday"];

		//Day

		echo "<select name='LaDay'>";

		echo "<option></option>";

		for($i=1;$i<=31;$i++){

			if($i == $MyDay)

				echo "<option value='$i' >$i</option>\n";

			else

				echo "<option value='$i'>$i</option>\n";

		}

		echo "</select>";

		 $MyMonth=$d["mon"];

		 //Month

		 echo "<select name='LaMon'>";

		 echo "<option></option>";

		 for($i=1;$i<=12;$i++)

		 {

		 	if($i == $MyMonth)

		 		echo "<option value='$i' >" . MonthName($i) . "</option>\n";

		 	else

		 		echo "<option value='$i'>" . MonthName($i) . "</option>\n";

		 }

		 echo "</select>";		  								   //Year

		 $maxYr =$d["year"]+5;

		 $MyYear=$d["year"];

		 echo "<select name='LaYear'>";

		 echo "<option></option>";

		 for($i=1940;$i<=$maxYr;$i++)

		 {

		 	if($i == $MyYear)

		 		echo "<option value='$i' >$i</option>\n";

		 	else

		 		echo "<option value='$i' >$i</option>\n";

		 }

		 echo "</select>";

		 echo "</td>";

		//end to date

		 ?>          </tr>

          <tr>

            <?php

	$flag=1;

?>

            <input type="hidden" name="flag" value="<?php echo $flag?>">

            <td colspan="8"><input type="submit" name="jodadd" value="Add" class="bgbutton"></td>

          </tr>

        </table>

    <tr>

      <td colspan="4">

        

        <table class="forumline" align=center width="98%">

          <tr>

            <td align="left" class="row3" colspan="6">Dependent Details</td>

          </tr>

          <?php

$rsql="select * from staff_dependents where staff_id='$id1'";

//echo $rsql;

$rrs=execute($rsql);

$rnum=rowcount($rrs);

if($rnum>=1)

{

		echo "<tr>";

		echo "<td class='rowpic' width='5%' align='center'>Select</td>";

		echo "<td class='rowpic'>Name</td>";

		echo "<td class='rowpic'>Relation</td>";

		echo "<td class='rowpic'>Address</td>";

		echo "<td class='rowpic'>Phone</td>";

		echo "<td class='rowpic'>Occupation</td>";

		echo "</tr>";

	while($prow=fetcharray($rrs,$i))

	{

		echo "<tr>";

		echo "<td align='center'><input type=checkbox name='did[]' value=$prow[0] checked></td>";

		echo "<td><input type=text name='dname$prow[0]' value='$prow[1]'></td>";

		echo "<td><input type=text name='drel$prow[0]' value='$prow[3]'></td>";

		echo "<td><input type=text name='d_addr$prow[0]' value='$prow[5]'></td>";

		echo "<td><input type=text name='d_phone$prow[0]' value='$prow[8]'></td>";

		echo "<td><input type=text name='doccu$prow[0]' value='$prow[4]'></td>";

		echo "</tr>";

	}

	$flag2=2;

?>

          <input type=hidden value="<?php echo $flag?>" name="flag">

          <tr>

            <td colspan="6"><input type=submit name='depmod' value='Modify' class='bgbutton'>&nbsp;&nbsp;&nbsp;&nbsp;

              <input type=submit name='depdet' value='Delete' class='bgbutton'></td>

          </tr>

          <?php 

}

?>

          <tr>

            <td colspan='2' class='rowpic'>Name</td>

            <td class='rowpic'>Relation</td>

            <td class='rowpic'>Address</td>

            <td class='rowpic'>Phone</td>

            <td class='rowpic' colspan='2'>Occupation</td>

          </tr>

          <tr>

            <td colspan='2'><input type=text name='dname'  width="100%"></td>

            <td><input type=text name='drel'  width="100%"></td>

            <td><input type=text name='d_addr'  width="100%"></td>

            <td><input type=text name='d_phone'  width="100%"></td>

            <td><input type=text name='doccu'  width="100%"></td>

          </tr>

          <tr>

            <?php

	$flag2=2;

?>

            <input type=hidden name=flag value=<?php echo $flag?>>

            <td  colspan='6'><input type=submit name="depadd" value="Add" class="bgbutton"></td>

          </tr>

        </table>

    <tr>

    <td colspan="4">

   

    

    <table align=center width='90%'>

    </table>

    </table>

    <br>

      <!--<div align="center">

          <input type="button" value="Save" name="B1" class="bgbutton" onClick="return send()">

          </div>-->

    

    

    

  

  <input type=hidden name=groupflag value="<?php echo $groupflag?>">

  <input type=hidden name=scaleflag value="<?php echo $scaleflag?>">

  <input type=hidden name=desflag value="<?php echo $desflag?>">

  <input type=hidden name=desflag1 value="<?php echo $desflag1?>">

  <input type=hidden name=offiflag value="<?php echo $offiflag?>">

</form>

<?php

  function MonthName($mon)

{

          if($mon == 1) return("Jan");

          if($mon == 2) return("Feb");


          if($mon == 3) return("Mar");

          if($mon == 4) return("Apr");

          if($mon == 5) return("May");

          if($mon == 6) return("Jun");

          if($mon == 7) return("Jul");

          if($mon == 8) return("Aug");

          if($mon == 9) return("Sep");

          if($mon == 10) return("Oct");

          if($mon == 11) return("Nov");

          if($mon == 12) return("Dec");

  }

?>

</body>

</html>

