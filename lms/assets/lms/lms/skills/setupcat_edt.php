<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$user = $_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];

if($_POST)
{

	$Sel=$_POST['Sel'];
	$term = $_POST['term'];
	$subject = $_POST['subject'];
	$category = $_POST['category'];
	$assignment = $_POST['assignment'];
	 
}
if($_GET)
{
    $Sel=$_REQUEST['Sel'];
	$Type=$_REQUEST['Type'];
}
if(trim($Type) == "Add")
{


    //+++++++++++++++++++++++++++++++++++   ADDING STUDENT MARKS   +++++++++++++++++++++++++++++++++++++++++++
	  $count=1;
	  $msg='';
	  $arraySize=sizeof($Sel); 

	for($j=0; $j < $arraySize; ++$j)
	{

$resultCol=execute("SELECT `criterion_name` FROM `grade_criterion` WHERE assessment_id='$assignment' AND subject ='$subject' AND `status`=1 AND category_id='$category'");
		
		$i = 0;	
		
		while($row=fetcharray($resultCol))
		{
				//echo '<br>'.$count;			
			 $field_name = str_replace(' ', '_', $row['criterion_name']); 
			
			 $val=$Sel[$j];
			 $ins_name=$_POST[$val.$field_name];
			  
			 $fieldname1=$field_name;
			 $fieldname[]=$field_name.'_'.$category;
			 $postvalue[]=$_POST[$fieldname1];
			 
			 $tablename='grade_m_'.$subject.'_'.$term;
			//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
			$flag = 0; $msg='';
			
			//echo "<br>SELECT * FROM grade_avg WHERE `status`=1 AND subject='$subject'";
			$chk=execute("SELECT * FROM grade_avg WHERE `status`=1 AND subject='$subject'");
			
			while($cr=fetcharray($chk))
			{
						if($cr['letter1']==$ins_name){				/*CONDITIONS FOR DISPALY GRADES*/
							$flag=1;		
						}elseif($cr['letter2']==$ins_name){
							$flag=1;
						}elseif($cr['letter3']==$ins_name){
							$flag=1;
						}elseif($cr['letter4']==$ins_name){
							$flag=1;
						}elseif($cr['letter5']==$ins_name){
							$flag=1;
						}elseif($cr['letter6']==$ins_name){
							$flag=1;
						}elseif($cr['letter7']==$ins_name){
							$flag=1;
						}elseif($cr['letter8']==$ins_name){
							$flag=1;
						}elseif($cr['letter9']==$ins_name){
							$flag=1;
						}elseif($cr['letter10']==$ins_name){
							$flag=1;
						}elseif($cr['letter11']==$ins_name){
							$flag=1;
						}elseif($cr['letter12']==$ins_name){
							$flag=1;
						}elseif($cr['letter13']==$ins_name){
							$flag=1;
						}elseif($cr['letter14']==$ins_name){
							$flag=1;
						}elseif($cr['letter15']==$ins_name){
							$flag=1;
						}
			
					$SqlException="SELECT `exception` FROM `grade_m_exception` WHERE status=1 ORDER BY id";	
					$rsExp = execute($SqlException) or die(mysql_error());	
					while($re=fetcharray($rsExp))
					{
						if($ins_name==$re['exception']){
							$flag=1;
						}
					}	
			}
			if($flag==1){
							 
			   $sqlUpdate="UPDATE `$tablename` SET `$fieldname[$i]` = '$ins_name'  WHERE `student_id` = '$val'";
			   echo "<br>".$sqlUpdate;
			   $resultUpdate = execute($sqlUpdate) or die(mysql_error());
				
			}
		    else{
				$msg="Please Enter the Correct Grade !";
			}
		     
		   ++$i;
		}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

		     		
			 ++$i;
			 ++$k; 
			 ++$count;
		
	}
		
 
      if($resultUpdate)
	  {
		  //$msg="Records Saved";
		 // echo "<META HTTP-EQUIV='Refresh' Content='0;URL=setupcat.php?term=$term&subject=$subject&category=$category&msg=$msg'>";
	  }
	  else
	  {		   
		  //echo "<META HTTP-EQUIV='Refresh' Content='0;URL=setupcat.php?term=$term&subject=$subject&category=$category&msg=$msg'>";
	  }
}
/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx     ADDING STUDENT GRACE		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/
if(trim($Type) == "grace")
{

	  $arraySize=sizeof($Sel); 
	  $tablename='grade_m_'.$subject.'_'.$term;

	for($j=0; $j < $arraySize; ++$j)
	{
			
			$val=$Sel[$j];
			$grace=$_POST[$val.'grace'];
			
			 $graceID=fetcharray(execute("SELECT `id` FROM `grade_grace` WHERE `letter`='$grace' AND `status`=1"));

		   
			 $sqlUpdate="UPDATE `$tablename` SET `category` = '$graceID[id]'  WHERE `student_id` = '$val'";
			 //echo "<br>".$sqlUpdate;
			 $resultUpdate = execute($sqlUpdate) or die(mysql_error());
		
	}
		
 
      if($resultUpdate)
	  {
		  //$msg="Records Saved";
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=setupcat.php?term=$term&subject=$subject&category=$category&Type=summary'>";
	  }
	  else
	  {		   
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=setupcat.php?term=$term&subject=$subject&category=$category&Type=summary'>";
	  }
}



?>
