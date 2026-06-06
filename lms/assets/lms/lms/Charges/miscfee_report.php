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

	$id=$_POST['id'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$misceDet=$_POST['misceDet'];
		  
}
if($_GET)
{
	$adate=$_REQUEST['adate'];
	$bdate=$_REQUEST['bdate'];
	$misceDet=$_REQUEST['misceDet'];
}

?>
<html>
<head>
<script LANGUAGE="JavaScript">
	function reloadMe()
	{
		document.frm.action="miscfee_report.php";
		document.frm.submit();
	}
</script>
<script language="javascript">
function OpenWind2(k2)
{
 var finalVar ;
 finalVar=k2 ;
 window.open(finalVar,'Detailed_report','_blank,align=center,width=800,height=600,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script> 
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>MISCELLANEOUS FEE REPORT</title>
</head>
<body>
<form name="frm" method="post" action="miscfee_report.php">
<br>
	<table class=forumline  align=center width="60%" >
	<tr>
		<td class="head" align="center" colspan="5">MISCELLANEOUS DETAILS</td>
	</tr>
     <tr height="25">
            <td align="right">From Date &nbsp;&nbsp;&nbsp; </td>
            <td><input type="text" name="adate" value="<?=$adate?>" readonly>&nbsp;&nbsp;
                <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
                
            <td align="right">To Date &nbsp;&nbsp;&nbsp; </td>
            <td><input type="text" name="bdate" value="<?=$bdate?>" readonly>&nbsp;&nbsp;
                <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
      </tr>
</table>
	
	<p align="center"><input type="submit" class='bgbutton' value="Search" name="misceDet"></p>
    
   <!-- 	EMAIL DETAILS REPORT	 -->
<?	

if($_POST['misceDet'] || $_REQUEST['misceDet'])
{
	
				
					$dateArray=explode('/',$adate);
					$acq_yy=$dateArray[2];
					$acq_mm=$dateArray[1];
					$acq_dd=$dateArray[0];
					$adate="$acq_yy-$acq_mm-$acq_dd";	
							
					$dateArray1=explode('/',$bdate);
					$acq_yy1=$dateArray1[2];
					$acq_mm1=$dateArray1[1];
					$acq_dd1=$dateArray1[0];
					$bdate="$acq_yy1-$acq_mm1-$acq_dd1";

		
	   $sql="SELECT * FROM `fee_misc_collect_m` WHERE `status` = 1 AND `cancel_status` = 'N'";
	  
	  
	    if($adate !='' and $adate !='--' and $bdate !='' and $bdate !='--')
		{
			$sql.=" AND `inserted_date` >= '$adate'  AND `inserted_date` <= '$bdate'"; //adate=FromDate and bdate=ToDate
		}
		
	        $sql.=" ORDER BY id";
			
		$result=execute($sql) or die(mysql_error());

		  if(rowcount($result)==0)
		  {
			  die('<center>No Records Found !!!</center>');
			  
		  }

if(rowcount($result)>0)
{
   ?>
      <input type="hidden" name="id" value="<?=$id?>">
	  <table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
      <tr>
		<td class="head" align="center" colspan="8">MISCELLANEOUS DETAILS REPORT</td>
	  </tr>
	  <tr height='22' >
		    <td Class="row3">Sl No</td>
			<td Class="row3">Student Name</td>
			<td Class="row3">Grade</td>
            <td Class="row3">Fee Title</td>
            <td Class="row3">Amount</td>
            <td Class="row3">Receipt Date</td>	
	   </tr>
       <?php
	      $i=0;
		  $rowclass=1;
		  $sno=1;
		  while($row=fetcharray($result))
		  {
				if($sno<10)
				{
					$sno="0".$sno;
				}
					if($i%2)
						echo "<tr class='clsname'>";
					else
						echo "<tr>";

				
	$studentName=fetcharray(execute("SELECT `first_name`, `last_name`, `course_yearsem` FROM `student_m` WHERE `id`='$row[student_id]'"));	
	
	$grade=fetcharray(execute("SELECT `year_name` FROM `course_year` WHERE `year_id` = '$studentName[2]'"));	
	$feeTitle=fetcharray(execute("SELECT `name` FROM `fee_misc_m` WHERE `id` = '$row[m_id]'"));
	
	 $resultAmount=execute("SELECT a.*,b.* FROM fee_misc_head a, fee_misc_m_desc b WHERE b.id ='$row[m_id]'  AND a.status = 1 AND a.m_id = b.m_id");
	 
	    while($r=fetcharray($resultAmount))
		{	 
	 		$field_name = $r['subgroup'];
			$total[] = $r[$field_name]; 
		}
		
			?>
                    <td align='center' ><?=$sno?></td>
                    <td align='left' >&nbsp;&nbsp;<?=$studentName[0]?>&nbsp;<?=$studentName[1]?></td>
                    <td align='center' ><?=$grade[0]?></td>
                    <td align='center' >&nbsp;<?=$feeTitle[0]?></td>
                    <td align='center' ><?=array_sum($total)?></td>
                    <td align='center' >&nbsp;<? print( date("d-M-Y", strtotime($row[inserted_date])) ); ?></td>
 
             <?
		       unset($total);
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	   }				
 } 
?>
 </table>
</form>	
</body>
</html>