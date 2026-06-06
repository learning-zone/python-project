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
<html>
<head>
<title>TASKS DETAILS_<?=date('d-m-Y',strtotime($adate))?></title>
</head>
<body>
    <table class='forumline' align='center' width="98%" border="1" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="9" class="head" align="center"><b>TASKS DETAILS</b></td>
       </tr>
        <tr>
            <td class="row3" nowrap="nowrap" style="background-color:#0C0"><b>Sl No.</b></td>
            <td class="row3" nowrap="nowrap" style="background-color:#0C0"><b>Name</b></td>
            <td class="row3" nowrap="nowrap" style="background-color:#0C0"><b>File#</b></td>
            <td class="row3" nowrap="nowrap" style="background-color:#0C0"><b>Order#</b></td>
            <td class="row3" nowrap="nowrap" style="background-color:#0C0"><b>Queue</b></td>
            <!--<td class="row3" nowrap="nowrap">Date</td>-->
            
            <td class="row3" nowrap="nowrap" style="background-color:#0C0"><b>Status</b></td>
            <td class="row3" nowrap="nowrap" style="background-color:#0C0"><b>Pulling</b></td>
             <td class="row3" nowrap="nowrap" style="background-color:#0C0"><b>Comments</b></td>
            <td class="row3" nowrap="nowrap" style="background-color:#0C0"><b>Ending</b></td>
           
       </tr>
       <?
	    $dateArray=explode('/',$adate);
    $yy=$dateArray[2];
    $mm=$dateArray[1];
    $dd=$dateArray[0];
    $date1="$yy-$mm-$dd";
	   $i=1;
	   
	      $rsq=execute("SELECT file_number,order_number,queue_number,pseudo_name,comments,pulling_time,ending_time,process_status,date FROM `tasks_m` WHERE status=1 and date='$date1' order by pseudo_name");
		   while($row=fetcharray($rsq))
        {
	   ?>
        <tr>
            <td nowrap="nowrap" align="center"><?=$i?></td>
            <td nowrap="nowrap">&nbsp;<b><?=$row[3]?></b></td>
            <td nowrap="nowrap" align="center"><?=$row[0]?></td>
            <td nowrap="nowrap" align="center"><?=$row[1]?></td>
            <td nowrap="nowrap" align="center"><?=$row[2]?></td>
            <!--<td nowrap="nowrap" align="center"><?=date('d-m-Y',strtotime($row[8]))?></td>-->
            <td nowrap="nowrap" align="center"><?=date('d-m-Y',strtotime($row[8]))?> <?=$row[5]?></td>
            <td nowrap="nowrap" align="center"><?=date('d-m-Y',strtotime($row[8]))?> <?=$row[6]?></td>
            <td nowrap="nowrap" align="center"><?=$row[7]?></td>
            <td align="justify">&nbsp;<?=$row[4]?></td>
       </tr>
       <?
	   $i++;
		}
	   ?>
</table>
</body>
</html>
</form>
