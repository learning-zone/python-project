<?php
session_start();
include("../db1.php");
include("numbers-words.php");
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
$user_name=$_SESSION['user'];

if($_GET)
{
   $mID = $_GET['mID'];
   $Type = $_GET['Type'];
   $remark = $_GET['remark'];
   $jmsub = $_REQUEST['jmsub'];
	
}
if($_POST)
{  
   $mID = $_POST['mID'];
   $jmsub = $_POST['jmsub'];
   $remark = $_POST['remark'];
	
}
if($Type == 'Print')
{
	   $receipt_no=rand(100,999);
	 
	  
	  $sql="INSERT INTO `lib_magazine_subscription_receipt` (`m_id`, `user_name`, `remarks`,  `receipt_no`, `inserted_date`)
	   VALUES ('$mID', '$user_name', '$remark', '$receipt_no', CURDATE())";
	
	  //echo "<br>".$sql;
	  $result=execute($sql) or die(mysql_error());
	   
	?>
    <script type="text/javascript">
	  window.print();
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
	  document.frm.action="subscribe_receipt_print.php";
	  document.frm.submit();
	  
  }
  function printMe()
  {
	 
	  document.frm.action="subscribe_receipt_print.php?Type=Print";
	  document.frm.submit();
	  //return true;
  }
</script>
</head>
<body>
<form name="frm" method='post' action="subscribe_receipt_print.php">
<?php	
	//$mID=00000001;
	//$jmsub=1;
	
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

	
	$details=fetcharray(execute("SELECT `col_name`, `col_phone`, `col_city`, `col_pin` FROM `college`"));
	
	$maxID=fetcharray(execute("SELECT MAX(id) FROM `lib_magazine_subscription_receipt` WHERE `status` = 1"));
	$receipt=fetcharray(execute("SELECT `receipt_no` FROM `lib_magazine_subscription_receipt` WHERE `id` = '$maxID[0]'"));
	
    $subscriptionDetails=fetcharray(execute("SELECT `title`, `periodicity`, `supplier`, `subscription_date`,`copies`, 
	`amountMonth`, `extraAmount`, `amount` FROM `lib_magazine_subscription`  WHERE `stts`=1  AND id = '$mID'"));
		
    ?>
   
    <table border='1' width='60%' align='center' cellspacing='0' cellpadding='0'>
	<tr>
    	<td colspan='6' align='right'> &#9742;&nbsp;<?=$details[1]?>&nbsp;&nbsp;<BR><BR>
      <p align="center" style="font-family:Verdana, Geneva, sans-serif"><b>
	  <?=strtoupper($details[0])?></b></p>
      <p align="center"><b><?=$details[2]?> :&nbsp;<?=$details[3]?>.</b></p>
      <p align="center"><u><b><?=$title?> Receipt</b></u></p>
      <div align="left">&nbsp;&nbsp;No.<?=$receipt[0]?>
      <div align="right">Date :&nbsp;&nbsp;<span style="border-bottom: 2px dotted #000;">
	  <?=date('d-M-Y')?>&nbsp;&nbsp;</span>&nbsp;&nbsp;<br></div>
      <p align="left">
      &nbsp;&nbsp;Supplier Name :&nbsp;&nbsp;
      <span style="border-bottom: 2px dotted #000;"><?=$subscriptionDetails[2]?>
      &nbsp;</span></p>
      
  <BR> </td></tr>
  <?php	
		

		
    ?>
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
         
         <td align='right' colspan="4" >TOTAL :&nbsp;&nbsp;</td>  
    	 <td align="center">&#8377;&nbsp;<?=$subscriptionDetails[5]?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr> 
    <tr>
    	<td align='left' colspan="5"><b><BR>&nbsp;&nbsp;Rupees.</b><BR><BR>
        &nbsp;&nbsp;<span style="border-bottom: 2px dotted #000;">
        <?=strtoupper(number_to_words($subscriptionDetails[5]))?>&nbsp;ONLY.
        </span>
           
      <div style="height:100px;"></div>     
    </td>  
  </tr>   
</table>
</form>
</body>
</html>
