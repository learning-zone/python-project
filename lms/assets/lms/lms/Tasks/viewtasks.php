<?php 

session_start();
require_once ("../db.php");
if ($_GET) {

$adate = $_GET['adate'];
}
if ($_POST) {

$adate = $_POST['adate'];
}
$user = $_SESSION['user'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
    <script language="javascript" src="../js/cal2.js"></script>
    <script language="javascript" src="../js/cal_conf2.js"></script>
    <script>

	function gen_excel()
		{
			document.frm.action='viewtasks_exl.php';
			document.frm.submit();
		}
	</script>
</head>
<body>
<form name="frm" action="" method="post" ENCTYPE="multipart/form-data">
    
<table class='forumline'  align='center' width="40%" cellpadding="0" cellspacing="0">
    <tr>
    <td class="head" align="center" colspan="2">TASKS DETAILS</td>
    </tr>
    <tr>
    <td align="right">Date</td>
    <td nowrap align="center"><input type="text" name="adate" value="<?=$adate?>" style="height:25px; width:170px" >&nbsp;&nbsp;
    <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
    </tr>
</table>
<br />
<div align="center">
<input type="submit" name="search" value="Search" class="bgbutton" style="width:70px;"/>
</div>
<br />
    <table class='forumline' align='center' width="98%" border="1" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="20" class="head" align="center">TASKS DETAILS</td>
       </tr>
        <tr>
            <td class="row3" nowrap="nowrap">Sl No.</td>
            <td class="row3" nowrap="nowrap">Processor <br/>Name</td> 
            <td class="row3" nowrap="nowrap">Name</td>
            <td class="row3" nowrap="nowrap">Indian Name</td>
            <td class="row3" nowrap="nowrap">Pseudo Name</td>
            <td class="row3" nowrap="nowrap">File#</td>
            <td class="row3" nowrap="nowrap">Order#</td>
            <td class="row3" nowrap="nowrap">Queue</td>
           <!-- <td class="row3" nowrap="nowrap">Date</td>-->
            <td class="row3" nowrap="nowrap">Pulling</td>
            <td class="row3" nowrap="nowrap">Ending</td>
            <td class="row3" nowrap="nowrap">Status</td>
            <td class="row3" nowrap="nowrap">Comments</td>
            <td class="row3" nowrap="nowrap">Pulling</td>
            <td class="row3" nowrap="nowrap">Ending</td>
            <td class="row3" nowrap="nowrap">Time Spent</td> 
            
            <td class="row3" nowrap="nowrap">Exception</td> 
            <td class="row3" nowrap="nowrap">Error <br/>Message</td> 
            <td class="row3" nowrap="nowrap">Borrower's<br/> Name</td> 
            <td class="row3" nowrap="nowrap">Company <br/>Name</td>
            <td class="row3" nowrap="nowrap">E-sign <br/>Vendor</td> 
      
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
	   $i++;
		}
	   ?>
</table>
<br/>
<div align='center'>

	<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="EXCEL EXPORT" OnClick="gen_excel()">
</div>
</form>
</body>
</html>
