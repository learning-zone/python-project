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
	 
}
if($_GET)
{
    $Sel=$_REQUEST['Sel'];
	$Type=$_REQUEST['Type'];
}
if(trim($Type) == "Add")
{


    //+++++++++++++++++++++++++++++++++++   UPDATING STUDENT DETAILS    +++++++++++++++++++++++++++++++++++++++++++
	  $count=1;
	  $msg='';
	  $arraySize=sizeof($Sel); 

	for($j=0; $j < $arraySize; ++$j)
	{

$resultCol=execute("SELECT `title` FROM `grade_assessment` WHERE category_id ='$category' AND subject ='$subject' AND `status`=1");
		$i = 0;	
		
		while($row=fetcharray($resultCol))
		{
				//echo '<br>'.$count;			
			 $field_name = str_replace(' ', '_', $row['title']); 
			
			 $val=$Sel[$j];
			 $ins_name=$_POST[$val.$field_name];
			  
			 $fieldname1=$field_name;
			 $fieldname[]=$field_name.'_'.$category;
			 $postvalue[]=$_POST[$fieldname1];
			 
			 $tablename='grade_m_'.$subject.'_'.$term;
			//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
			$flag = 0;
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
						elseif($ins_name=='AB'){
							$flag=1;
						}elseif($ins_name=='NA'){
							$flag=1;
						}				
			}
			if($flag==1){
			 
			   $sqlUpdate="UPDATE `$tablename` SET `$fieldname[$i]` = '$ins_name'  WHERE `student_id` = '$val'";
			   //echo "<br>".$sqlUpdate;
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
		
 
      if($resultt)
	  {
		  $msg="Records Added";
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=setupcat.php?term=$term&subject=$subject&category=$category&msg=$msg'>";
	  }
	  else
	  {		   
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=setupcat.php?term=$term&subject=$subject&category=$category&msg=$msg'>";
	  }
}



?>
