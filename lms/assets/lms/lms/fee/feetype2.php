<?php


require("../db.php");
?>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
</head>
<?


$rs_sql=execute("select * from fee_type where fee_name='$feename' and course_id='$word' ");

$num = rowcount($rs_sql);
if($num==0 && $feename!="")
{
	$sql = "INSERT INTO fee_type(course_id,fee_name) VALUES('$word','$feename')";

	execute($sql) or die(mysql_error());

	echo "<font color='red' size=2>INSERTED SUCEESSFULLY</font>&nbsp;&nbsp;&nbsp;<a href=feetype.php><u>Click here to go back</u></a>";
}

else
{

	die("<font color='red' size=2> Duplicate Fee Name</font>&nbsp;&nbsp;&nbsp;<a href=feetype.php><u>Click here to go back</u></a>");
}

	while(list(,$value) = each($fid))
     {

      
     $rs_sql=execute("select * from fee_type where id='$value' ");
	    $num = rowcount($rs_sql);

		if($num>0)
		 {
     

		 $temp = "fname$value";
	     $name = $$temp;
         $ssql = "update fee_type set fee_name ='$name' where id = $value";
	      execute($ssql) or die(mysql_error());

	echo "<font color='red' size=2>UPDATED SUCEESSFULLY</font>&nbsp;&nbsp;&nbsp;<a href=feetype.php><u>Click here to go back</u></a>";
}
else
		 {

	die("<font color='red' size=2> Duplicate Fee Name</font>&nbsp;&nbsp;&nbsp;<a href=feetype.php><u>Click here to go back</u></a>");
		 }

}



?>