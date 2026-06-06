<?php
session_start();
require_once("../db.php");


$SchoolCode=$_SESSION['SchoolCode'];
$d = getdate();
$MyDay=$d["mday"];
$MyMonth=$d["mon"];
$MyYear=$d["year"];
$date = $MyYear."-".$MyMonth."-".$MyDay;

$B1 = $_POST['B1'];
$crs = $_POST['crs']; 
$sel = $_POST['sel'];
$frm = $_POST['frm'];
$crsyr = $_POST['crsyr'];
$staff = $_POST['staff'];
$mType = $_POST['mType'];
$member = trim("$member");
$member = $_POST['member'];

while( list(,$Value) = each($sel) )
	{
		if($mType==1)
		{
			$qry = fetcharray(execute("select * from student_m where id=$Value"));
			$s_id = $qry[student_id];				
			$sname = $qry[first_name]."&nbsp;".$qry[last_name];
			$qid=$qry[id];
		}
		if($mType==2)
		{
			$qry = fetcharray(execute("select * from staff_det where id=$Value"));
			$s_id = $qry[slno];
			$sname = $qry[f_name]."&nbsp;".$qry[s_name];
			$qid=$qry[id];
		}
		if($mType==3)
		{
			$qry = fetcharray(execute("select * from dept_no where dpt_id=$Value"));
			$s_id = $qry[dept_code];
			$sname = $qry[Dept];
			$qid=$qry[dpt_id];
		}
		$sql = "insert into lib_membership_m(issued_on,s_id,type,m_no,status,pwd,MemberName,totalCards,domain)values('$date','$qid','$mType','$s_id','1','$s_id','$sname','','$SchoolCode')";
		 $res = execute($sql) or die(mysql_error());
		 
		$result=execute("select MAX(id),m_no from lib_membership_m");
	  
	    if ($result){
           $query=fetchrow($result);
        }
	    $id=$query[0];
		$m_no=$query[1];
	    //echo "<p>Id :$m_no</p>";
		
		$sql="INSERT INTO lib_membership_det(mbno,m_id)VALUES('$m_no','$id')";
		 $res = execute($sql) or die(mysql_error());
		
	}
	echo "<div align='center'>Member Details Saved <br></div>";
?>
