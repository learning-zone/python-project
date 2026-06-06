<?php
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
session_start();
include("../db.php");

if($_GET)
{
   $mID = $_REQUEST['mID'];
   $jmsub = $_REQUEST['jmsub']; 
	
}
if($_POST)
{
  
   $mID = $_POST['mID'];
   $jmsub = $_POST['jmsub'];

	
}
	if($jmsub==1)
	{
		$title='Journals Subscription';
	}
	if($jmsub==2)
	{
		$title='Magazine Subscription';
	}
	if($jmsub==3)
	{
		$title='News Paper Subscription';
	}
  	
    $result=execute("SELECT * FROM `fee_misc_collect_m` WHERE `m_id` = '$m_id' AND `student_id` = '$student_mID' AND status =1");
	$numRow=rowcount($result);
	if($numRow >0)
	{
		?>
        	<script type="text/javascript">
			   alert('Receipt already generated !!!');
			   window.close();
			</script>
        <?
	}
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
  function reloadMe()
  {
	  
	  document.frm.action="miscfee_receipt.php";
	  document.frm.submit();
	
  }
  function printMe()
  {
	 
	  document.frm.action="subscribe_receipt_print.php?Type=Print";
	  document.frm.submit();
	  
  }
</script>
</head>
<body>
<form name="frm" method='post' action="subscribe_receipt1.php">
<?php	
		
	$subscriptionDetails=fetcharray(execute("SELECT `title`, `periodicity`, `supplier`, `subscription_date`,`copies`, 
	`amountMonth`, `extraAmount`, `amount` FROM `lib_magazine_subscription`  WHERE `stts`=1  AND id = '$mID'"));
		
    ?>
   
  <table border='0' width='90%' align='center' cellspacing='0' cellpadding='0' class='forumline'>
	<tr>
    	<td colspan='6' align='center' class='head'><?=$title?> Receipt</td>
    </tr>
    <tr height="30">
    	<td colspan="3" align="left">&nbsp;&nbsp;&nbsp;&nbsp;Title :&nbsp;&nbsp;<?=$subscriptionDetails[0]?></td>    
        <td colspan="3" align="left">No of Copies :&nbsp;&nbsp;<?=$subscriptionDetails[4]?></td>
    </tr>
    
    <tr height="30">
    	<td colspan="3" align="left">&nbsp;&nbsp;&nbsp;&nbsp;Periodicity :&nbsp;&nbsp;<?=$subscriptionDetails[1]?></td>
        <td colspan="3" align="left">Subscription Date :&nbsp;&nbsp;<? print( date("d-M-Y", strtotime($subscriptionDetails[3])) ); ?></td>
    </tr>
          
	
    <tr>
    	<td align='center' class='row3' width="10%">Sl No.</td>
        <td align='center' class='row3' width="30%">Particulars</td>
        <td align='center' class='row3' width="10%">Rate</td>
        <td align='center' class='row3' width="10%">no of Copies</td>
        <td align='center' class='row3' width="10%">Amount</td>
    </tr>
    <tr>
    <?
		$slno=1;
    ?>
    	<td align='center'><?=$slno?></td>
        <td align='center'><?=$subscriptionDetails[0]?></td>
        <td align='center'><?=$subscriptionDetails[7]?></td>
        <td align='center'><?=$subscriptionDetails[4]?></td>
        <td align='center'><?=$subscriptionDetails[5]?></td>
    </tr>   

      <tr>
    	<td align='center' colspan="6">&nbsp;</td>
    </tr>
    <tr>
    	<td align='center' colspan="6"><textarea name="remark" rows="5" cols="80" placeholder="Remarks"></textarea></td>
    </tr>
</table>
	    
     <input type="hidden" name="mID" value="<?=$mID?>">
     <input type="hidden" name="jmsub" value="<?=$jmsub?>">
  
    <p align=center><input type="button" value="Print" name="print" class='bgbutton' onClick="printMe()" ></div>
</form>
</body>
</html>
