<?PHP
session_start();
require_once("../db.php");

	
	$result=execute("SELECT * FROM `student_m` ORDER BY id");
	
	 while($row=fetcharray($result))
	 {
		$admission_date=$row['admission_date'];
		$dob=$row['dob'];
		

			    $dateArray=explode('-',$admission_date);
				$acq_yy=$dateArray[0];
				
				$dateArray1=explode('-',$dob);
				$acq_yy1=$dateArray1[0];
				
			if($acq_yy!="0000" and $acq_yy!="" and $acq_yy1!="0000" and $acq_yy1!="")
			{	
				$age=($acq_yy - $acq_yy1);
				echo "<BR>admission_date :".$acq_yy;
				echo "<BR>dob :".$acq_yy1;
				echo "<BR>Age :".$age;
				
				echo "<br>UPDATE `student_m` SET `age`='$age' WHERE id=$row[id]";
				$resultUpdate=execute("UPDATE `student_m` SET `age`='$age' WHERE id=$row[id]");
			}
			
			
	
	}





?>