<?php
session_start();
require_once("../db.php");

$q=$_GET["q"];
$dob=$q;

/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";*/

	$dateArray=explode('/',$dob);
	$b_day=$dateArray[0];
	$b_month=$dateArray[1];
	$b_year=$dateArray[2];
			
	
	$d=date("d");
	$m=date("m");
	$y=date("Y");
	
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
		
		?>
        <input type="text" name="age_yr" value="<?=$age_yr?>" size='2' readonly>
        <?
	}else{
		$age_yr='Age Cant be Greater !';
		?>
        <input type="text" name="age_yr" value="<?=$age_yr?>" size='20' readonly>
        <?
	}
	
		if($age_yr==date("Y")){
			$age_yr='';
		}
?>



