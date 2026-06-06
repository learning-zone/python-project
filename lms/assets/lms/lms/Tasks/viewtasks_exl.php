<?php
session_start();
require_once ("../db1.php");
if ($_GET) {

$adate = $_GET['adate'];
}
if ($_POST) {

$adate = $_POST['adate'];
}
$user = $_SESSION['user'];

$file_name= "TASKS_DETAILS_$user.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <style>
        td.row5{
            background-color:#0C0;
            text-align: center;
        }
    </style>
<title>TASKS DETAILS_<?=date('d-m-Y',strtotime($adate))?></title>
</head>
<body>
    <table class='forumline' align='center' width="98%" border="1" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="20" class="head" align="center"><b>TASKS DETAILS</b></td>
       </tr>
         <tr>
            <td class="row5" nowrap="nowrap">Sl No.</td>
            <td class="row5" nowrap="nowrap">Processor Name</td> 
            <td class="row5" nowrap="nowrap">Name</td>
            <td class="row5" nowrap="nowrap">Indian Name</td>
            <td class="row5" nowrap="nowrap">Pseudo Name</td>
            <td class="row5" nowrap="nowrap">File#</td>
            <td class="row5" nowrap="nowrap">Order#</td>
            <td class="row5" nowrap="nowrap">Queue</td>
            <!-- <td class="row5" nowrap="nowrap">Date</td>-->
            <td class="row5" nowrap="nowrap">Pulling</td>
            <td class="row5" nowrap="nowrap">Ending</td>
            <td class="row5" nowrap="nowrap">Status</td>
            <td class="row5" nowrap="nowrap">Comments</td>
            <td class="row5" nowrap="nowrap">Pulling</td>
            <td class="row5" nowrap="nowrap">Ending</td>
            <td class="row5" nowrap="nowrap">Time Spent</td> 
            
            <td class="row5" nowrap="nowrap">Exception</td> 
            <td class="row5" nowrap="nowrap">Error Message</td> 
            <td class="row5" nowrap="nowrap">Borrower's Name</td> 
            <td class="row5" nowrap="nowrap">Company Name</td>
            <td class="row5" nowrap="nowrap">E-sign Vendor</td> 
      
       </tr>
       <?
	    $dateArray=explode('/',$adate);
        $yy=$dateArray[2];
        $mm=$dateArray[1];
        $dd=$dateArray[0];
        $date1="$yy-$mm-$dd";
	   $i=1;
	   
	      $rsq=execute("SELECT `id`, `file_number`, `order_number`, `queue_number`, `pseudo_name`, `comments`, `pulling_time`, `ending_time`, `process_status`, `date`, `user_name`, `tasks_process_id` FROM `tasks_m` WHERE status=1 and date='$date1' order by pseudo_name");
          
          while($row=fetcharray($rsq))
          {
                
            $processName = fetcharray(execute("SELECT `process_name` FROM tasks_process WHERE id='$row[tasks_process_id]'"));
            
            $staffids = fetcharray(execute("SELECT srid FROM users WHERE username='$row[user_name]'"));
            
            $staffnams=fetcharray(execute("SELECT f_name,s_name from staff_det WHERE id='$staffids[0]'"));
            
            $eSignature=fetcharray(execute("SELECT `error_name`, `borrower_name`, `company_name`, `esign_vendor`  FROM `tasks_m_esignature` WHERE `tasks_m_id` = '$row[id]'"));
	   ?>
        <tr>
            <td nowrap="nowrap" align="center"><?=$i?></td>
            <td nowrap="nowrap" align="center">&nbsp;<?=$processName['process_name']?>&nbsp;</td>
            <td nowrap="nowrap">&nbsp;<?=$row[3]?>&nbsp;</td>
            <td nowrap="nowrap">&nbsp;<?=$staffnams[0]?>&nbsp;<?=$staffnams[1]?>&nbsp;</td>
            <td nowrap="nowrap" align="left">&nbsp;<?=$row['pseudo_name']?>&nbsp;</td>
            <td nowrap="nowrap" align="center">&nbsp;<?=$row['file_number']?>&nbsp;</td>
            <td nowrap="nowrap" align="center">&nbsp;<?=$row['order_number']?>&nbsp;</td>
            <td nowrap="nowrap" align="center">&nbsp;<?=$row['queue_number']?>&nbsp;</td>
            <!--<td nowrap="nowrap" align="center"></td>-->
            <td nowrap="nowrap" align="center">&nbsp;<?=date('d-m-Y',strtotime($row['date']))?> <?=$row['pulling_time']?>&nbsp;</td>
            <td nowrap="nowrap" align="center">&nbsp;<?=date('d-m-Y',strtotime($row['date']))?> <?=$row['ending_time']?>&nbsp;</td>
            <td nowrap="nowrap" align="center">&nbsp;<?=$row['process_status']?>&nbsp;</td>
            <td align="justify">&nbsp;<?=htmlentities($row['comments'])?>&nbsp;</td>
            <td nowrap="nowrap" align="center" valign="top">&nbsp;<?=$row['pulling_time']?>&nbsp;</td>
            <td nowrap="nowrap" align="center" valign="top">&nbsp;<?=$row['ending_time']?>&nbsp;</td>
            <?
                $alltime1 = ($row['pulling_time']);
                $alltime2 = ($row['ending_time']);
                $alltime3 = $alltime2 - $alltime1;
                $alltime1_sec=strtotime($alltime1);
                $alltime2_sec=strtotime($alltime2);
                $alltime3_sec=$alltime2_sec-$alltime1_sec;
                $alltime_final = gmdate ( 'H:i:s' , $alltime3_sec);
            ?>
            <td align="center" valign="top">&nbsp;<?=$alltime_final?>&nbsp;</td>
            
            <td align="justify" valign="top">&nbsp;</td>
            <td align="justify" valign="top">&nbsp;<?=$eSignature['error_name']?>&nbsp;</td>
            <td align="justify" valign="top">&nbsp;<?=$eSignature['borrower_name']?>&nbsp;</td>
            <td align="justify" valign="top">&nbsp;<?=$eSignature['company_name']?>&nbsp;</td>
            <td align="justify" valign="top">&nbsp;<?=$eSignature['esign_vendor']?>&nbsp;</td>
            
       </tr>
       <?
    	   $timespents='';
    	   $timespents_final='';
    	   $i++;
		}
	   ?>
</table>
</body>
</html>
</form>
