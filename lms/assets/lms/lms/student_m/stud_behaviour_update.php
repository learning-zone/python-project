<?php
session_start();
include("../db.php");
if($_POST)
{
	$Sel=$_POST['Sel'];
	$subject=$_POST['subject'];
	$description=$_POST['description'];
	$merit=$_POST['merit'];
	$demerit=$_POST['demerit'];
	$id=$_POST['id'];
	
}
if($_REQUEST)
{
	$Sel=$_REQUEST['Sel'];
	$subject=$_REQUEST['subject'];
	$description=$_REQUEST['description'];
	$merit=$_REQUEST['merit'];
	$demerit=$_REQUEST['demerit'];
	$id=$_REQUEST['id'];
	$Type=$_REQUEST['Type'];
}


//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);
	  if(!$Sel)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=stud_behaviour.php?msg=No Records Selected'>";
	  }	

if(trim($Type) == "Add")
{
	
  	    
      $sql="INSERT INTO `student_behaviour_m` (`subject`, `description`, `merit`, `demerit`, `status`) VALUES ('$subject', '$description', '$merit', '$demerit', '1')";
	  //echo $sql;
	  execute($sql) or die(mysql_error());
	  
	  if($sql)
	  {
	  		
		  echo "<META HTTP-EQUIV='Refresh' Content='0; URL=stud_behaviour.php?msg=Inserted Successfully'>";
	  }

}

if(trim($Type) == "Mod")
{
    //echo "Inside Mod";
	for($i=0;$i<sizeof($Sel);$i++)
	{
      $val=$Sel[$i];
	  
	  //echo "Selected Values :".$val;
	  
	   $subject=$_POST[$val.'subject'];
       $description=$_POST[$val.'description'];
       $merit=$_POST[$val.'merit'];
	   $demerit=$_POST[$val.'demerit'];
      
	  $sql="UPDATE `student_behaviour_m` SET `subject` = '$subject', `description` = '$description', `merit` = '$merit', `demerit` = '$demerit'  WHERE `id` = '$val'";
	 
	  //echo $sql;
	 $result=execute($sql) or die(mysql_error());
	}
	  if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=stud_behaviour.php?msg=Updated Successfully'>";
	  }	
}

if(trim($Type) == "Del")
{
      //echo "Inside Del";
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sql="UPDATE `student_behaviour_m` SET `status` = '0' WHERE `id` = '$val'";
		  //echo $sql;
		  $result=execute($sql) or die(mysql_error());
	  }
		  
	  if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=stud_behaviour.php?msg=Deleted Successfully'>";
	  }	
}
?>
