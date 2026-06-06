<?php
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
session_start();
require_once("../db.php");

if($_POST)
{
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$miscfee=$_POST['miscfee'];

}

?>
<html>
<head>
<title>MISCELLANEOUS FEE REPORT</title>
<script type="text/javascript">
  function reloadMe()
  {
	  document.frm.action="miscfee_report.php";
	  document.frm.submit();
  }
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
</head>
<body>
<form method='post' action="miscfee_report.php" name="frm" >
 <table class='forumline' align='center' width="60%" >
    <tr>
    	<td Class="Head" colspan='4' align='center'>MISCELLANEOUS FEE REPORT</td>
    </tr>
	<tr height='30'>
		<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;From Date</td>
		<td><input type='text' name='adate' value="<?=$adate?>" >&nbsp;
            <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

		<td nowrap>To Date</td>
		<td><input type='text' name='bdate' value="<?=$bdate?>" >&nbsp;
            <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
   </tr>
</table><br>

	<P align=center><input type="submit" class='bgbutton' value="Search" name="miscfee"></P>
</form>
<?

if($_POST['miscfee']!='')
{
		 
		  $dateArray=explode('/',$adate);
		  $acq_yy=$dateArray[0];
		  $acq_mm=$dateArray[1];
		  $acq_dd=$dateArray[2];
		  $fromDate="$acq_yy-$acq_mm-$acq_dd";
		  
		  $dateArray1=explode('/',$bdate);
		  $acq_yy1=$dateArray1[0];
		  $acq_mm1=$dateArray1[1];
		  $acq_dd1=$dateArray1[2];
		  $toDate="$acq_yy1-$acq_mm1-$acq_dd1";
		  
	$sql="SELECT * FROM `fee_misc_collect_m` WHERE `status` = 1";

	if($adate!='' and $bdate!='' )
	{
	 	$sql.=" AND inserted_date >= '$fromDate' AND inserted_date <= '$toDate'";
	}


 $sql.=" ORDER BY id";

   //echo "<br>".$sql;

		$result=execute($sql) or die(mysql_error());
}

if(rowcount($result)>0)
{
	
 ?>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr>
	<td align='center' class='head' colspan='6'>STUDENT DETAILS</td>
</tr>
<tr height='25' >
    <td Class="rowpic" align='center'>Sl No</td>
    <td Class="rowpic" align='center'>Admission ID</td>
    <td Class="rowpic" align='center'>Student Name</td>
    <td Class="rowpic" align='center'>Grade</td>
    <td Class="rowpic" align='center'>Fee Title</td>
    <td Class="rowpic" align='center'>Amount</td>
</tr>

<?php
  $sno=1;
  $rowclass=1;

	for($i=0;$i<rowcount($result);$i++)
	{
		
		$r=fetcharray($result);

		if($sno<10)

			$sno="0".$sno;

		if($i%2)
			echo "<tr class='clsname' > ";
		else
			echo "<tr >";
			
		?>
		<td align='center' ><?=$sno?></td> 
        
        <td align='center' title="Click to cancel receipt" >
 <a href="javascript:void(0);" onClick ="OpenWind2('miscfee_receipt_cancel.php?student_mID=<?=$r[id]?>&academic_year=<?=$r[academic_year]?>&m_id=<?=$r[m_id]?>&c_id=<?=$r[c_id]?>', 'OpenWind2',1000,800)"><?=$r[id]?></a>
        </td>
    <?
		
		$studentName=fetcharray(execute("SELECT `first_name`, `last_name` FROM `student_m` WHERE id = '$r[student_id]'"));
	?>
		<td>&nbsp;&nbsp;<?=$studentName[0]?>&nbsp;<?=$studentName[1]?></td>
    <?
	
		$grade=fetcharray(execute("SELECT `course_yearsem` FROM `student_m` WHERE id = '$r[student_id]'"));
		$gradeName=fetcharray(execute("SELECT `year_name` FROM `course_year` WHERE year_id = '$grade[0]'"));
	?>    
        <td align="center"><?=$gradeName[0]?></td>
    <?
		$feeTitle=fetcharray(execute("SELECT `name` FROM `fee_misc_m` WHERE id = '$r[m_id]'"));
	?>        
        <td align='center'><?=$feeTitle[0]?></td>
    <?
		$amount=fetcharray(execute("SELECT `amount` FROM `fee_misc_head` WHERE m_id  = '$r[m_id]'"));
	?>
        <td align='center'><?=$amount[0]?></td>
    </tr>
	<?php

		$sno++;
		$rowclass = 1 - $rowclass;
	}
?>
</table>
<?
}
?>
</body>
</html>