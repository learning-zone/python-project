<?php
include_once("../db.php");
$accno=$_POST['accno'];
$media=$_POST['media'];
$cardno=$_POST['cardno'];
$IDay=$_POST['IDay'];
$IMon=$_POST['IMon'];
$IYear=$_POST['IYear'];
$DDay=$_POST['IDay'];
$DMon=$_POST['IMon'];
$DYear=$_POST['IYear'];
$remark=$_POST['remark'];
$m_id=$_POST['m_id'];

//print_r($_GET);
//print_r($_POST);



	$issue_date= $IYear."-".$IMon."-".$IDay;
   // $issue_time= $IHour.":".$IMin.":".$ISec;

	$due_date= $DYear."-".$DMon."-".$DDay;
	$due_time= $DHour.":".$DMin.":".$DSec;
	

	date_default_timezone_set("Asia/Kolkata");
	$date = date('h:i:s', time());
	//echo "<p>Current Time:$date</p>";
	$issue_time=$date;

	
	//echo "<p>Access no:$accno</p>";
	###################### TO FETCH STUDENT ID  ############################
		$result=execute("select MAX(id),m_no from lib_membership_m");
	  
	    if ($result){
           $query=fetchrow($result);
        }
	    $id=$query[0];
		$m_no=$query[1];
		$cardno=$m_no;
	    //echo "<p>Id :$id</p>";
		//echo "<p>Member :$m_no</p>";
	#########################################################################
	
	$var1 = "insert into lib_circulation_m(m_id,acc_id,issue_date,due_date,return_date,remarks,status,cno,media_type,";
	$var1.=" name,returned,issue_time,due_time) VALUES('$m_id','$accno','$issue_date','$due_date','','$remark','0',";
	$var1.=" '$cardno','$media','$user','','$issue_time','$due_time')";
	//echo"$var1"; 
	//die();
	$res = execute($var1) or die(mysql_error());
	if($media==7)
	{
			$var3="update lib_magazine set status=1 where magazine_no='$accno'";
			$res3=execute($var3) or die(mysql_error());
	}
	if($media==8)
	{
			$var4="update lib_question_paper_det set flag=1 where id='$accno'";
			$res4=execute($var4) or die(mysql_error());
	}
	//header("Location:media2.php?Action=issue&flag=1");
	echo "<META HTTP-EQUIV='Refresh' Content='0;URL=media2.php?Action=issue&msg=1'>";
?>