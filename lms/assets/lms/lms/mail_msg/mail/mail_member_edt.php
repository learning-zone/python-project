<?php
session_start();
include("../../db1.php");
if($_POST)
{
	$sem=$_POST['sem'];
	$Sel=$_POST['Sel'];
	$branch=$_POST['branch'];
	$stud_id=$_POST['stud_id'];
	$Unchecked=$_POST['Unchecked'];
	$group_name=$_POST['group_name'];
	$member_type=$_POST['member_type'];	
	$class_section_id=$_POST['class_section_id'];
	$subj=$_POST['subj'];
	
}
if($_GET)
{
	$Sel=$_REQUEST['Sel'];
	$sem=$_REQUEST['sem'];
	$Type=$_REQUEST['Type'];
	$branch=$_REQUEST['branch'];
	$stud_id=$_REQUEST['stud_id'];
	$Unchecked=$_REQUEST['Unchecked'];
	$group_name=$_REQUEST['group_name'];	
	$member_type=$_REQUEST['member_type'];	
	$class_section_id=$_REQUEST['class_section_id'];
	$subj=$_REQUEST['subj'];
}


//print_r($_POST);
//echo "<br>";echo "<br>";
//print_r($_REQUEST);
//echo "<br>";echo "<br>";

if(trim($Type) == "Add")
{
	      
	for($i=0;$i<sizeof($Unchecked);$i++)
	{
		
		$flag=0;
		for($j=0;$j<sizeof($Sel);$j++)
		{
			if($Unchecked[$i]==$Sel[$j])
			$flag=1;
		}
	
		  $val=$Unchecked[$i];	  
		

		  $stud_id=$val;
		  
		  $sql1=execute("SELECT id FROM `mail_member` WHERE `group_name` = '$group_name' AND `stud_id` = '$stud_id' AND `member_type` = '$member_type'");
		   
	 if(rowcount($sql1)>0)
	 {
		 $sql2="UPDATE `mail_member` SET status='$flag' WHERE `group_name` = '$group_name' AND `stud_id` = '$stud_id' AND `member_type` = '$member_type'";
		 $result=execute($sql2) or die(mysql_error());  
	 }
     else
	 { 
		 	if($flag>0)
			{
				$sql3="INSERT INTO `mail_member` (`group_name`, `stud_id`, `member_type`, `status`) VALUES ('$group_name', '$stud_id', '$member_type', '1')";
				//echo $sql2;
				$result=execute($sql3) or die(mysql_error());
			}
	 	}
	 }
      if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=mail_member.php?group_name=$group_name&member_type=$member_type&subj=$subj&sem=$sem&branch=$branch&class_section_id=$class_section_id&Sel=$Sel&Unchecked=$Unchecked&msg=Records Updated Successfully'>";
	  }	
}

?>
