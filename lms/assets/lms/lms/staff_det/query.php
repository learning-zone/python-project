<?php
session_start();
require_once("../db.php");

$count=fetcharray(execute("SELECT id FROM staff_det ORDER BY id DESC LIMIT 1"));
$size=$count[0];

for($i=1;$i<=$size;++$i)
{

		$qry = fetcharray(execute("SELECT * FROM staff_det WHERE id=$i"));
		$s_id = $qry[slno];
		$sname = $qry[f_name]."&nbsp;".$qry[s_name];
		$qid=$qry[id];

if($qid){
	
$sqlLib = "INSERT INTO lib_membership_m(issued_on,s_id,type,m_no,status,pwd,MemberName,totalCards,domain)VALUES(CURDATE(),'$qid','1','$s_id','1','$s_id','$sname','','$SchoolCode')";

		echo "<br>".$sqlLib;
		 $resLib = execute($sqlLib) or die(mysql_error());
		 
		 		 
		$resultLib=execute("SELECT id,m_no FROM lib_membership_m ORDER BY id DESC LIMIT 1");
	  
	    if ($resultLib){
           $queryLib=fetchrow($resultLib);
        }
	    $id=$queryLib[0];
		$m_no=$queryLib[1];
	    //echo "<p>Id :$m_no</p>";
		
		 $sql="INSERT INTO lib_membership_det(mbno,m_id)VALUES('$m_no','$id')";
		 
		 echo "<br>".$sql;
		 $res = execute($sql) or die(mysql_error());
	}
		 
}
		
?>