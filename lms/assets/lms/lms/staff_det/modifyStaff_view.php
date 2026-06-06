<html>
<head>
<?php
session_start();
require("../db.php");
$id1 = $_POST['id1'];
$mangs = $_POST['mangs'];
$hr = $_POST['hr'];
$acc_year=$_SESSION['AcademicYear'];
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
$st_pres = $_POST['st_pres'];
$addr_pres  = $_POST['addr_pres'];
$addr_perm  = $_POST['addr_perm'];
$ct_pres  = $_POST['ct_pres'];
$ct_perm  = $_POST['ct_perm'];
$st_perm = $_POST['st_perm'];
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
$s_a_status = $_POST['s_a_status'];
$scard = $_POST['scard'];

?>
</head>
<body background="GCCBack.gif">
<?php


$staffidnams=execute("select `id` from `staff_hr_grup` where staff_id='$id1' and status=1");
if(rowcount($staffidnams)>0)
{
$staffinlea="update `staff_hr_grup` set `user`='$user',hr_id='$hr',mng_id='$mangs' where staff_id='$id1'";
execute($staffinlea);
}
else
{
execute("INSERT INTO `staff_hr_grup` (`user`, `hr_id`,  `mng_id`,  `staff_id`, `acc_year`, `status`) VALUES ('$user','$hr','$mangs','$id1','$acc_year','1')");
}


$updtleave="update `staff_leave_type_group` set status='0' where staff_id='$id1'";
execute($updtleave);

$leav_type=$_POST['leav_type'];
for($jm=0;$jm<sizeof($leav_type);$jm++)
{
$coacid=$leav_type[$jm];
$staff_lev=execute("select id from staff_leave_type_group where staff_id='$id1' and leave_type='$coacid'");
if(mysql_num_rows($staff_lev)>0)
{
$upleave="update `staff_leave_type_group` set status='1' where staff_id='$id1' and leave_type='$coacid'";
execute($upleave);
}
else
{
execute("insert into staff_leave_type_group (`staff_id`, `leave_type`,`status`) values('$id1','$coacid','1')");
}
}

$sss=mysql_query("update `staff_det` set `scard`='$scard',`staff_status_id`='$s_a_status' where `id`='$id1'") ; 

if( basename( $_FILES['uploadedfile']['name'])!='')
{
		$target_path = "../staff_images/";
		$fext=basename( $_FILES['uploadedfile']['name']);
		$fext1=explode(".",$fext);
		$fexn=$id1.".".$fext1[1];
		$target_path = $target_path.$fexn;
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		{
			$sp="update staff_det set img_col='$target_path' where id = '$id1' ";
			execute($sp)or die("could not modify");
		}
}
				
      $join_date = "$JYear-$JMon-$JDay";
      $exp_date = "$JYeare-$JMone-$JDaye";
      $lwd = "$LaYear-$LaMon-$LaDay";
	  $d_o_b = "$dobYear-$dobMon-$dobDay";
     
	  
  	$rd = "$ReYear-$ReMon-$ReDay";
	$dou = "$MoYear-$MoMon-$MoDay";
	$SQL1 = "UPDATE staff_det SET f_name='$f_name',s_name='$s_name2',qual='$qual',dob='$d_o_b',bg='$bg',ms='$ms',";
	$SQL1 .= "addr_pres='".addslashes($addr_pres)."', bank='$bank', religion='$religion' ,mobileno='$mobileno',";
	$SQL1.="ct_pres='$ct_pres',pin_pres='$pin_pres',st_pres='$st_pres',";
	$SQL1 .= "staff_status_id='$s_a_status',substantive='$substantive',gender='$gender'";

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
	if($sp_assoc != "")
	{
		$SQL1 .= ",sp_assoc='$sp_assoc'";
	}
	if($xtra != "")
	{
		$SQL1 .= ",xtra='$xtra'";
	}
	if($father != "")
	{
		$SQL1 .= ",father='$father'";
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
	if($st_perm != "")
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
	$SQL1 .= ",panno='$panno'";
	$SQL1 .= ",tanno='$tanno'";
	
	
	if(@$Gender != "")
	{
		$SQL1 .= ",gender='$Gender'";
	}

	if ($archive.value=="on")
	{
		$SQL1 .= ",releive_date='$rd'";
	}
	else
	{
		$SQL1 .= ",releive_date=NULL";
	}

	$SQL1 .= " where id = $id1";
	$SQL = $SQL1 ;
	//echo ("update staff_det set staff_status_id='$s_a_status' where id='$id1'");
if(empty($archive))
{
	$sqltemp="select * from staff_det where id=$id1";
	$rstemp=execute($sqltemp);
	$rtemp=fetcharray($rstemp,0);

	$sql5=execute("delete from archive where slno='$slno1'") or die("could not modify");
	//execute($sql5) or die(error_description()."error1");
}

//echo $SQL;
//exit();
execute($SQL);// or die("could not modify");

if(!empty($archive))
   {
	if($bank_ac_no!="")	
	{
		$bank_ac_no='0';
	}
	if($f_name=="")	
	{
		$f_name="NA";
	}

	if($s_name=="")	
	{
		$s_name="NA";
	}

	if($qual="")	{
		$qual="NA";
	}
	if($cert="")	{
		$cert="NA";
	}
	if($exp_prev=="")
	{
		$exp_prev="0";
	}
	if($assoc=="")
	{
		$assoc="0";
	}
	if($xtra=="")
	{
	$xtra="NA";
	}
	if($father=="")
	{
	$father="NA";
	}
	if($bg=="")
	{
		$bg="NA";
	}
	if($ms="")
	{
	$ms="NA";
	}
	if($addr_perm=="")
	{
		$addr_perm="NA";
	}
	if($ct_perm=="")
	{
		$ct_perm="NA";
	}
	if($pin_perm=="")
	{
		$pin_perm="0";
	}
	if($state_perm=="")
	{
		$state_perm="NA";
	}
	if($ph_perm=="")
	{
		$ph_perm="0";
	}

	if($offered=="")
	{
		$offered="0";
	}
	if($basic=="")
	{
		$basic="0";
	}
	if($other_facilities=="")
	{
		$other_facilities="NA";
	}
	if($other_responsibilities=="")
	{
		$other_responsibilities="NA";
	}
	if($prev_post=="")
	{
		$prev_post="NA";
	}
	if($prev_work_place=="")
	{
		$prev_work_place="0";
	}
	if($prev_work_city=="")
	{
		$prev_work_city="NA";
	}
	if($prev_work_country=="")
	{
		$prev_work_country="NA";
	}
	if($lwd=="")
	{
		$lwd="0";
	}

	$SQLSTR="insert into archive(bank_ac_no,f_name,s_name,qual,cert,exp_cur,exp_prev,sp_assoc,";
	$SQLSTR.="xtra,father,doa,bg,ms,addr_perm,ct_perm,pin_perm,st_perm,ph_perm,addr_pres,ct_pres,";
	$SQLSTR.="pin_pres,st_pres,ph_pres,email,id,slno,offeredsal,basicsal,";
	$SQLSTR.="cmts,dob,other_facilities,other_responsibilities,prev_post,prev_work_place,";
	$SQLSTR.="prev_work_city,prev_work_country,last_date_of_work,staff_status_id,date_of_updation,";
	$SQLSTR.="expirydate,gender,releive_date) values('$bank_ac_no','$f_name','$s_name2','$qual','$cert',";
	$SQLSTR.="0,$exp_prev,'$assoc','$xtra','$father','$doa','$bg','$ms','$addr_perm','$ct_perm',";
	$SQLSTR.="'$pin_perm','$state_perm','$ph_perm','$addr_pres','$ct_pres','$pin_pres','$state_pres',";
	$SQLSTR.="'$ph_pres','$email',$id1,'$slno1',$offered,$basic,'$cmts',";
	$SQLSTR.="'$d_o_b','$other_facilities','$other_responsibilities','$prev_post',";
	$SQLSTR.="'$prev_work_place','$prev_work_city','$prev_work_country','$lwd',";
	$SQLSTR.="2,'$dou','$expdate','$gender','$rd')";
	
     if($s_a_status==1)
	{
	   $act="YES";
	}
	elseif($s_a_status==2)
	{
	 $act="NO";
	}

	$sql=execute("update staff_det set staff_status_id=2,active='NO' where id=$id1") ;
	$sql22=execute("select * from sal_head where name ='Basic'") or die(error_description());
	$rs22=fetcharray($sql22);
	$sqlu="insert into staff_termination(staff_id,headg,eff_date,aut_name,san_no,san_date,remarks) values($id1,'Service resigned','".date("Y-m-d")."','HR Manager','CLRT/HRM/regn/".$id1."','".date("Y-m-d")."','Resigned from service')";
	execute ($sqlu) or die ("Could not insert...");
	execute("update  empallowances set amt=$basic where empid=$id1 and allowance_id=$rs22[id]");
	//echo "<font face='Arial'><b>$f_name's Details successfully Archived </b></font><br>";
	?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Details successfully Archived");
        </script>
        <?php
}
else
{

   	if($s_a_status==1)
	{
	   $act="YES";
	}
	elseif($s_a_status==2)
	{
	 $act="NO";
	}

	//$sql=execute("update staff_det set staff_status_id=1,Active='YES' where id=$id1") ;
	$sql22=execute("select * from sal_head where name ='Basic'") or die(error_description());
	$rs22=fetcharray($sql22);
	execute("update  empallowances set amt=$basic where empid=$id1 and allowance_id=$rs22[id]");

	if(($CurrentDept<>$subj) || ($StaffStatus != $sstatus) || ($StaffType!= $stype) && ($s_a_status<>2))
	{
//	if($_DATABASE_=='jsscms')
//	{
		$college_id="GIT";
//	}
	
	$count=$id1;
	$designation_id=$stype;
	$dept_id=$subj;
	$work_type_id=$sstatus;
	$staff_id=$college_id."".$dept_id."".$designation_id."".$work_type_id."".$count;
	}
	//echo "<font face='Arial'><b>$f_name's Details successfully Modified... </b></font><br>";
	?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Updated Successfully");
        </script>
        <?php
}
?>
<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="viewstf.php?id1=<?php echo $id1; ?>";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>