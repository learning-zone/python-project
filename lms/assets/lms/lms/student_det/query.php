<?php
session_start();
require_once("../db.php");

$count=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM student_m"));
$size=$count[0];

for($i=1;$i<=$size;++$i)
{

$qry = mysql_fetch_array(mysql_query("SELECT id,student_id,first_name,last_name FROM student_m WHERE archive='N' AND id=$i"));
	$s_id = $qry[student_id];				
	$sname = $qry[first_name]."&nbsp;".$qry[last_name];
	$qid=$qry[id];

if($qid){
	
$sqlLib = "INSERT INTO lib_membership_m(issued_on,s_id,type,m_no,status,pwd,MemberName,totalCards,domain)VALUES(CURDATE(),'$qid','1','$s_id','1','$s_id','$sname','','$SchoolCode')";

		echo "<br>".$sqlLib;
		 $resLib = mysql_query($sqlLib) or die(mysql_error());
		 
		 		 
		$resultLib=mysql_query("SELECT id,m_no FROM lib_membership_m ORDER BY id DESC LIMIT 1");
	  
	    if ($resultLib){
           $queryLib=mysql_fetch_row($resultLib);
        }
	    $id=$queryLib[0];
		$m_no=$queryLib[1];
	    //echo "<p>Id :$m_no</p>";
		
		 $sql="INSERT INTO lib_membership_det(mbno,m_id)VALUES('$m_no','$id')";
		 
		 echo "<br>".$sql;
		 $res = mysql_query($sql) or die(mysql_error());
	}
		 
}
		
?>