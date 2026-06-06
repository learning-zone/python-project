<?php
date_default_timezone_set("Asia/Kolkata");
session_start();
require_once("../db.php");


/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$user_name = $_SESSION['user'];

$currentDate = date("Y-m-d");

if($_GET){
    
     $Type = $_GET['Type'];
    
}
if($_POST){
    
  $date = $_POST['bdate'];  
  $token = $_POST['token'];
  $page = $_POST['page'];
  $error_name  = $_POST['error_name'];
  $pseudo_name = $_POST['pseudo_name'];
  //$ending_time = $_POST['ending_time'];
  $file_number = $_POST['file_number'];
  $order_number = $_POST['order_number'];
  $queue_number = $_POST['queue_number'];
  $comments = htmlentities($_POST['comments']);
  //$pulling_time = $_POST['pulling_time'];
  $borrower_name = htmlentities($_POST['borrower_name']);
  $company_name  = htmlentities($_POST['company_name']);
  $esign_vendor = htmlentities($_POST['esign_vendor']);
  $tasks_queue_id = $_POST['tasks_queue_id']; 
  $process_status = $_POST['process_status'];
  $tasks_process_id = $_POST['tasks_process_id'];
      
}
 
  $tasksProcess=fetcharray(execute("SELECT `id`, `tasks_process_id` FROM `tasks_queue` WHERE status=1 AND queue_name='$queue_number'")); 
  $tasksQueue=fetcharray(execute("SELECT `id` FROM `tasks_process` WHERE status=1 AND id='$tasksProcess[tasks_process_id]'")); 

if(($_REQUEST[Type] == "INSERT" or $_REQUEST[Type] == "NEW") and (!empty($file_number) and !empty($order_number)))
{
    
    $dateArray=explode('/',$date);
    $yy=$dateArray[2];
    $mm=$dateArray[1];
    $dd=$dateArray[0];
    $date="$yy-$mm-$dd";
    
    $pulling_time = date("H:i:s");

    $sql="INSERT INTO `tasks_m` (`user_name`, `tasks_process_id`, `tasks_queue_id`, `file_number`, `order_number`, `queue_number`, `pseudo_name`, `comments`, `pulling_time`, `ending_time`, `date`, `process_status` ) VALUES ('$user_name', '$tasksProcess[id]', '$tasksQueue[id]', '$file_number', '$order_number', '$queue_number', '$pseudo_name', '".addslashes($comments)."', '$pulling_time', '$ending_time', '$date', '$process_status')";

   // echo "<br>".$sql;
    
    $rs=execute($sql) or die("<p align=center>Unable to Save Tasks Details</p>");
    
     //$rs=execute($sql) or die(mysql_error());
     
     $token=fetchInsertId($sql);
    
    if($rs){    

        echo "<META http-equiv='refresh' content='0;URL=addtasks.php?token=$token&page=$page' target='_parent'>";
    }
    else{

        echo "<META http-equiv='refresh' content='0;URL=addtasks.php?token=$token&page=$page' target='_parent'>";
    }

}// IF CONDITION CLOSE


if($_REQUEST[Type] == "UPDATE")
{

    $dateArray=explode('/',$date);
    $yy=$dateArray[2];
    $mm=$dateArray[1];
    $dd=$dateArray[0];
    $date="$yy-$mm-$dd";
    
    $ending_time = date("H:i:s");

     $sql="UPDATE `tasks_m` SET `tasks_queue_id` = '$tasksQueue[id]', `file_number` = '$file_number', `order_number` = '$order_number', `queue_number` = '$queue_number', `pseudo_name` = '$pseudo_name', `comments` = '".addslashes($comments)."', `ending_time` = '$ending_time', `date` = '$date', `process_status`='$process_status'  WHERE id='$token'";
    
      
    $checkDate=fetcharray(execute("SELECT DATE_FORMAT(inserted, '%Y-%m-%d' ), `process_status` FROM `tasks_m` WHERE id='$token' AND status=1"));
        
    if((strtotime($currentDate) == strtotime($checkDate[0])) or $checkDate['process_status']=='Start' ){
            
        //echo "<br>".$sql;     
        $rsUpdate=execute($sql) or die("<p align=center>Unable to Update Tasks Details !</p>");
    }
    //E-SIGNATURE TABLE 
    if(!empty($borrower_name) || !empty($company_name) || !empty($esign_vendor)) {
    
        $check=rowcount(execute("SELECT `id` FROM `tasks_m_esignature` WHERE tasks_m_id='$token' AND status=1"));
        
        if($check < 1) {
            
                $sqle="INSERT INTO `tasks_m_esignature` (`tasks_m_id`, `error_name`, `borrower_name`, `company_name`, `esign_vendor`) VALUES ('$token', '$error_name', '".addslashes($borrower_name)."', '".addslashes($company_name)."', '".addslashes($esign_vendor)."')";
                 //echo "<br/>".$sqle;
                 $rse=execute($sqle) or die("<p align=center>Unable to Update E-Signature Details !</p>");
            
            
        }else {
                   
               $sqle="UPDATE `tasks_m_esignature` SET `error_name`= '$error_name',  `borrower_name`='".addslashes($borrower_name)."', `company_name`='".addslashes($company_name)."', `esign_vendor`= '".addslashes($esign_vendor)."' WHERE `tasks_m_id` ='$token'";    
                //echo "<br/>".$sqle;
                $rse=execute($sqle) or die("<p align=center>Unable to Update E-Signature Details !</p>");
            
        }
    }
    

    if($rsUpdate) {

         echo "<META http-equiv='refresh' content='0;URL=addtasks.php?page=$page'>"; //ONCE THE TAKS IS COMPLETED/REJECTED FORM WILL BECOME EMPTY
    }
    else{

         echo "<META http-equiv='refresh' content='0;URL=addtasks.php?token=$token&page=$page'>";
    }
}

?>