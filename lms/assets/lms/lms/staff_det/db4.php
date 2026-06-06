<?php
//leave temp tables...
//leave_data
//teaching_13_14_insert
//expat_2013_14_insert
//retainers_teaching_insert
//leave_data_m_20
$con  = mysql_pconnect("localhost","myschool_oberoi","L;~!;[7b}.mO")
	 or die("<b>Cannot open connection to database</b>.");
	
	mysql_select_db("myschool_oberoi")

	 or die("<b>could not select database</b>.");
	$i=0; 




$sql=mysql_query("select b.leave_approval,b.insert_date,b.todtime,b.user from staff_leave a,staff_att_updt b where a.id=b.leave_approval ");
while($r=mysql_fetch_array($sql))
{
	$staffids=mysql_fetch_array(mysql_query("select srid from users where username='$r[3]'"));
	$datetimeins=$r[1]." ".$r[2];
	//echo "<br>select srid from users where username='$r[3]'";
	echo "<br>update staff_leave set user_manager='$r[3]',updated_date='$datetimeins',user_id='$staffids[0]' where id='$r[0]'";
	mysql_query("update staff_leave set user_manager='$r[3]',updated_date='$datetimeins',user_id='$staffids[0]' where id='$r[0]'");
	$datetimeins='';

}
?>
		 	

	
	
	
	 