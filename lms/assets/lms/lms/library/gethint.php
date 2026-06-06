<?php
session_start();
$con  = mysql_pconnect("localhost","root","")
		 or die("<b>Cannot open connection to database</b>.");
	mysql_select_db("rnsit")
		 or die("<b>could not select database</b>.");

	$qq = strtolower($q);
	$var = "select m_no,MemberName from lib_membership_m where MemberName like '$qq%' and type=2";
	$res = execute($var);
	while($row = fetchrow($res))
	{
		 $row1 = $row[1]."<br>";
		 $response="<a href='lib.php?rollno=$row[0]&name=$row[1]'><font size='1'>$row1</font> <a>";
		 echo "$response";
	}
?>