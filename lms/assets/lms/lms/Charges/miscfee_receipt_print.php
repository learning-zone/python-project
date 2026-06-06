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
   $m_id = $_GET['m_id'];
   $Type = $_GET['Type'];
   $remark = $_GET['remark'];
   $student_mID = $_REQUEST['student_mID'];
   $academic_year = $_REQUEST['academic_year']; 
	
}
if($_POST)
{
  
   $m_id = $_POST['m_id'];
   $remark = $_POST['remark'];
   $student_mID = $_POST['student_mID'];
   $academic_year = $_POST['academic_year']; 
	
}
if($Type == 'Print')
{
	   $receipt_no=rand(100,999);
	  
	   
	   $c_id = fetcharray(execute("SELECT `id` FROM `fee_misc_m_desc` WHERE m_id = '$m_id' AND `status` = 1"));
	  
	  $sql="INSERT INTO `fee_misc_collect_m` (`user_name`, `m_id`, `c_id`, `student_id`, `amount_date`, `remark`,  `receipt_no`, `inserted_date`)
	   VALUES
	('$user_name', '$m_id', '$c_id[0]', '$student_mID', '$amount_date', '$remark', '$receipt_no', CURDATE())";
	
	 //echo "<br>".$sql;
	  $result=execute($sql) or die(mysql_error());
	   
	?>
    <script type="text/javascript">
	  window.print();
	  window.close();
	</script>
	
    <?
}

$cyr=date('Y');
$sel1="";
$sel2="";
$sel3="";

if($paymenttype==1)
	$sel1='selected';
elseif($paymenttype==2)
	$sel2='selected';
elseif($paymenttype==3)
	$sel3='selected';      
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
  function reloadMe()
  {
	  //alert('hi');
	  document.frm.action="miscfee_receipt.php";
	  document.frm.submit();
	  //document.getElementById("frm").submit();
  }
  function printMe()
  {
	 
	  document.frm.action="miscfee_receipt_print.php?Type=Print";
	  document.frm.submit();
	  //return true;
  }
</script>
</head>
<body>
<form name="frm" method='post' action="miscfee_receipt.php">
<?php	
	//$student_mID=1;
	//$m_id=1;
	//$academic_year=2012;	
	
	$student_details=fetcharray(execute("SELECT `first_name`, `last_name`, `student_id`, `course_yearsem`, `academic_year` FROM `student_m`  WHERE `id` is not null AND archive = 'N' and academic_year = '$academic_year' AND `id` = '$student_mID'"));
	
	$std=fetcharray(execute("SELECT `year_name` FROM `course_year`  WHERE `year_id`='$student_details[3]'"));
	
	$details=fetcharray(execute("SELECT `col_name`, `col_phone`, `col_city`, `col_pin` FROM `college`"));
	
	$maxID=fetcharray(execute("SELECT MAX(id) FROM `fee_misc_collect_m` WHERE `status` = 1"));
	$receipt=fetcharray(execute("SELECT `receipt_no` FROM `fee_misc_collect_m` WHERE `id` = '$maxID[0]'"));
		
    ?>
   
    <table border='1' width='60%' align='center' cellspacing='0' cellpadding='0'>
	<tr>
    	<td colspan='4' align='right'> &#9742;&nbsp;<?=$details[1]?>&nbsp;&nbsp;<BR><BR>
      <p align="center" style="font-family:Verdana, Geneva, sans-serif"><b>
	  <?=strtoupper($details[0])?></b></p>
      <p align="center"><b><?=$details[2]?> :&nbsp;<?=$details[3]?>.</b></p>
      <p align="center"><u><b>MISCELLANEOUS RECEIPT</b></u></p>
      <div align="left">&nbsp;&nbsp;No.<?=$receipt[0]?>
      <div align="right">Date :&nbsp;&nbsp;<span style="border-bottom: 2px dotted #000;">
	  <?=date('d-M-Y')?>&nbsp;&nbsp;</span>&nbsp;&nbsp;<br>
      <?
	  		$ay = $student_details[4] + 1;
			$ayear = substr($ay, -2); //TO DISPLAY LAST TWO DIGITS
	  ?>
      <BR>Term :&nbsp;&nbsp;<span style="border-bottom: 2px dotted #000;">
	  <?=$student_details[4]?> - <?=$ayear?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </span>&nbsp;&nbsp;</div></div>
      <p align="left">
      &nbsp;&nbsp;Name :&nbsp;&nbsp;
      <span style="border-bottom: 2px dotted #000;"><?=$student_details[0]?>&nbsp;<?=$student_details[1]?>
      &nbsp;</span></p>
      <p align="left">&nbsp;&nbsp;Std :&nbsp;&nbsp;<span style="border-bottom: 2px dotted #000;"><?=$std[0]?></span></p>
      
    <?
 $result=execute("SELECT a.*,b.* FROM fee_misc_head a, fee_misc_m_desc b WHERE b.id ='$m_id'  AND a.status = 1 AND a.m_id = b.m_id");
	
	
    ?><BR> </td></tr>
 <tr>
    <td align="center" width="85%">&nbsp;</td>
    <td align="center" width="15%">RS</td>
 </tr>
 <tr>
     <?
		$slno=1;

		while($row=fetcharray($result))
		{
    ?>
    	
        <?
				    $string=$row['subgroup'];
			        $name = str_replace('_', ' ', $string);
					$nameNew = preg_replace('/([1-9][0-9]*)/', ' ', $name); // TO HIDE NUMBERS IN WORD
		?>
        <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;<?=$nameNew?></td>
        <?
			$field_name = $row['subgroup'];
			$total[] = $row[$field_name]; 
			
		?>
        <td align='center' colspan="2"><?=$row[$field_name]?></td>
    </tr>   
    <?
			$slno++;
			
		
		}
		    
		?>
     <tr>
         
         <td align='right' >TOTAL :&nbsp;&nbsp;</td>  
    	 <td align="center">&#8377;&nbsp;<?=array_sum($total)?></td>
    </tr> 
    <tr>
    	<td align='left' colspan="3"><b><BR>&nbsp;&nbsp;Rupees.</b><BR><BR>
        &nbsp;&nbsp;<span style="border-bottom: 2px dotted #000;">
        <?=strtoupper(number_to_words(array_sum($total)))?>&nbsp;ONLY.
        </span>
           
      <div style="height:80px;"></div>     
    </td>  
  </tr>   
</table>
</form>
</body>
</html>
