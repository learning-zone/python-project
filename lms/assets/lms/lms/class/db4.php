<?php
$con  = mysql_pconnect("localhost","myschool_oberoi","L;~!;[7b}.mO")
	 or die("<b>Cannot open connection to database</b>.");
	
	mysql_select_db("myschool_oberoi")

	 or die("<b>could not select database</b>.");
	$i=0; 
$sql=execute("select * from subject_m a,class_section b where a.status=0 and a.subject_id=b.sub");
while($r=fetcharray($sql))
{
	echo "<br>UPDATE class_section SET status='0' WHERE sub='$r[subject_id]'";

    execute("UPDATE class_section SET status='0' WHERE sub='$r[subject_id]'");
$i++;
}
echo $i;
?>

	
	
	
	 