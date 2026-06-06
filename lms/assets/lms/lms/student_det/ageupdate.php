<?php
session_start();
require_once("../db.php");


/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";*/

$d=date("d");
$m=date("m");
$y=date("Y");
	
	echo "<br>SELECT * FROM `student_m` WHERE dob!='' AND dob!='0000-00-00'";
	$sql="SELECT * FROM `student_m` WHERE dob!='' AND dob!='0000-00-00'";
	
	$rs=execute($sql) or die(mysql_error());
	
	while($row=fetcharray($rs))
    {
		   echo "<br>Student ID".$row[id];
		
			$dob=$row['dob'];
			$dateArray=explode('-',$dob);
			$b_day=$dateArray[2];
			$b_month=$dateArray[1];
			$b_year=$dateArray[0];
			
			
		
	
	$dob="$b_year-$b_month-$b_day";
	$crd="$y-$m-$d";

	if(strtotime($dob) < strtotime($crd))
	{
		
		if($b_month < $m)
		{
			$age_yr=$y - $b_year;
		}
		else
		{
			if($b_month==$m)
			{
				if($b_day<=$d)
				{
					$age_yr=$y-$b_year;
				}
				else
				{
					$age_yr=($y-$b_year)-1;
				}
			}
			else
			{
				$age_yr=($y-$b_year)-1;
			}
		}
	}
	echo "<br>UPDATE `student_m` SET `age`='$age_yr' WHERE `id`='$row[id]'";
	$updateAge=fetcharray(execute("UPDATE `student_m` SET `age`='$age_yr' WHERE `id`='$row[id]'"));

	}

	


?>



