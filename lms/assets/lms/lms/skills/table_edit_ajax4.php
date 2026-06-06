<?php
session_start();
include("../db1.php");


//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";

$term=1;

if($_POST)
{
	$temp=$_POST['id'];
	$marks=$_POST['marks'];
}
//$temp="3_282";

	$token=split('-', "$temp");
	$id=$token[0];
	$field=$token[1];
	$subject=$token[2];
	
	

	//echo "<br>Temp :".$temp;
	//echo "<br>Student ID :".$id;
	//echo "<br>Subject :".$subject;

if($_POST['id'])
{
	
	$tablename='grade_m_'.$subject.'_'.$term;
	
	//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
			$flag =false; $msg=false;
			
			
			$chk=execute("SELECT * FROM grade_avg WHERE `status`=1 AND subject='$subject'");
			
			while($cr=fetcharray($chk))
			{
						if($cr['letter1']==$marks){				
							$flag=1;		
						}elseif($cr['letter2']==$marks){
							$flag=1;
						}elseif($cr['letter3']==$marks){
							$flag=1;
						}elseif($cr['letter4']==$marks){
							$flag=1;
						}elseif($cr['letter5']==$marks){
							$flag=1;
						}elseif($cr['letter6']==$marks){
							$flag=1;
						}elseif($cr['letter7']==$marks){
							$flag=1;
						}elseif($cr['letter8']==$marks){
							$flag=1;
						}elseif($cr['letter9']==$marks){
							$flag=1;
						}elseif($cr['letter10']==$marks){
							$flag=1;
						}elseif($cr['letter11']==$marks){
							$flag=1;
						}elseif($cr['letter12']==$marks){
							$flag=1;
						}elseif($cr['letter13']==$marks){
							$flag=1;
						}elseif($cr['letter14']==$marks){
							$flag=1;
						}elseif($cr['letter15']==$marks){
							$flag=1;
						}
			
					$SqlException="SELECT `exception` FROM `grade_m_exception` WHERE status=1 ORDER BY id";	
					$rsExp = execute($SqlException) or die(mysql_error());	
					while($re=fetcharray($rsExp))
					{
						if($marks==$re['exception']){
							$flag=1;
						}
					}	
			}
			if($flag==1){
							 
			  $sqlUpdate="UPDATE `$tablename` SET $field= '$marks'  WHERE `student_id` = '$id'";
			  // echo "<br>".$sqlUpdate;
			   $resultUpdate = @execute($sqlUpdate);
				
			}
		    else{
				//$msg="Please Enter the Correct Grade !";
			}
		     
		   ++$i;
		}
	
?>