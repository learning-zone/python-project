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
   $m_id = $_GET['m_id'];
   $student_mID = $_REQUEST['student_mID'];
   $academic_year = $_REQUEST['academic_year']; 
	
}
if($_POST)
{
  
   $m_id = $_POST['m_id'];
   $student_mID = $_POST['student_mID'];
   $academic_year = $_POST['academic_year']; 
	
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
	 
	  document.frm.action="miscfee_receipt_print.php?Type=Print";
	  document.frm.submit();
	  
  }
</script>
</head>
<body>
<form name="frm" method='post' action="miscfee_receipt.php">
<?php	
		
	$student_details=fetcharray(execute("SELECT `first_name`, `last_name`, `student_id`, `course_yearsem` FROM `student_m`  WHERE `id` is not null AND archive = 'N' and academic_year = '$academic_year' AND `id` = '$student_mID'"));
		
    ?>
   
  <table border='1' width='90%' align='center' cellspacing='0' cellpadding='0' class='forumline'>
	<tr>
    	<td colspan='4' align='center' class='head'>MISCELLANEOUS FEE DETAILS</td>
    </tr>
    <tr height="30">
    	<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Name</td>
        <td><?=$student_details[0]?>&nbsp;&nbsp;<?=$student_details[1]?></td>
        
        <td align='left'>Admission ID</td>
        <td><?=$student_details[2]?></td>
    </tr>
    <!-- <tr height="30">
    	<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grade</td>
        <?
		  $grade=fetchrow(execute("SELECT `year_name` FROM `course_year` WHERE year_id = '$student_details[3]'"));
		?>
        <td><?=$grade[0]?></td>-->
     
        <tr><td colspan="4">&nbsp;</td></tr>
       
	<?
        $result=execute("SELECT a.*,b.* FROM fee_misc_head a, fee_misc_m_desc b WHERE b.id ='$m_id'  AND a.status = 1 AND a.m_id = b.m_id");
	
    ?>
	
    <tr>
    	<td align='center' class='row3' >Sl No.</td>
        <td align='center' class='row3'>Fee Description</td>
        <td align='center' class='row3' colspan="2">Amount</td>
    </tr>
    <tr>
    <?
		$slno=1;

		while($row=fetcharray($result))
		{
    ?>
    	<td align='center'><?=$slno?></td>
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
         <td align='center'></td>
         <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    	 <td align='center' colspan="2">Total :<?=array_sum($total)?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
      <tr>
    	<td align='center' colspan="4">&nbsp;</td>
    </tr>
    <tr>
    	<td align='center' colspan="4"><textarea name="remark" rows="5" cols="80"></textarea></td>
    </tr>
</table>
	<input type="hidden" name="m_id" value="<?=$m_id?>">
    <input type="hidden" name="student_mID" value="<?=$student_mID?>">
    <input type="hidden" name="academic_year" value="<?=$academic_year?>">
    
    <p align=center><input type="button" value="Print" name="print" class='bgbutton' onClick="printMe()" ></div>
</form>
</body>
</html>
