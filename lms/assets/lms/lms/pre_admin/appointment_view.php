<?php
session_start();
require_once("../db.php");
if($_POST)
{

	$id=$_POST['id'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$cdate=$_POST['cdate'];
	$dc_no=$_POST['dc_no'];
	$jobcode=$_POST['jobcode'];
	$institution=$_POST['institution'];
	$institutionDet=$_POST['institutionDet'];
		  
}
if($_GET)
{
	$adate=$_REQUEST['adate'];
	$bdate=$_REQUEST['bdate'];
	$institutionDet=$_REQUEST['institutionDet'];
}
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
?>
<html>
<head>
<script LANGUAGE="JavaScript">
	function reloadMe()
	{
		document.frm.action="appointment_view.php";
		document.frm.submit();
	}
</script>
<script language="javascript">
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, 'toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script> 
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
<title>APPOINTMENT DETAILS REPORT</title>
</head>
<body>
<form name="frm" method="post" action="appointment_view.php">
<br>
	<table class=forumline  align=center width="60%" >
	<tr>
		<td class="head" align="center" colspan="5">ASSIGN APPOINTMENT</td>
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
	
	<p align="center"><input type="submit" class='bgbutton' value="Search" name="appointmentDet"></p>
    
   <!-- 	EMAIL DETAILS REPORT	 -->
<?	

if($_POST['appointmentDet'] || $_REQUEST['appointmentDet'])
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

		
	   $sql="SELECT * FROM `student_m_appointment` WHERE `status`=1";
	   
	  
	    if($adate !='' and $adate !='--' and $bdate !='' and $bdate !='--')
		{
			$sql.=" AND `inserted_date` >= '$adate'  AND `inserted_date` <= '$bdate'"; //adate=FromDate and bdate=ToDate
		}
		
	        $sql.=" ORDER BY id";
			
		$result=execute($sql) or die(mysql_error());

		  if(rowcount($result)==0)
		  {
			  echo "<font color='black'>No Records Found !!!</font>";
			  
		  }

if(rowcount($result)>0)
{
   ?>
      <input type="hidden" name="id" value="<?=$id?>">
	  <table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
      <tr>
		<td class="head" align="center" colspan="8">APPOINTMENT DETAIL REPORT</td>
	  </tr>
	  <tr height='22' >
		    <td Class="row3" align='left'>Sl No</td>
			<td Class="row3" align='left'>Student Name</td>
			<td Class="row3" align='left'>Date of Birth</td>
            <td Class="row3" align='left'>Parent Name</td>
            <td Class="row3" align='left'>Mobile No.</td>
            <td Class="row3" align='left'>Email</td>
            <td Class="row3" align='left'>Appointment Date</td>
            <td Class="row3" align='left'>Fix Appointment</td>
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
						echo "	<tr class='clsname' > ";
					else
						echo "	<tr > ";
			        
						
			?>
                    <td align='center' ><?=$sno?></td>
                    <td align='center' ><?=$row['student_name']?></td>
                <?
					  $adated=$row['dob'];
					  $dateArrayd=explode('-',$adated);
					  $acq_yyd=$dateArrayd[0];
					  $acq_mmd=$dateArrayd[1];
					  $acq_ddd=$dateArrayd[2];
					  $dob="$acq_ddd-$acq_mmd-$acq_yyd";
				?>
                    <td align='center' ><?=$dob?></td>
                    <td align='center' ><?=$row['parent_name']?></td>
                    <td align='center' ><?=$row['mobile']?></td>
                    <td align='center' ><?=$row['email']?></td>
                <?
					 $newdate=$row['app_date'];
					 $newd = (explode(" ",$newdate)); 
					 $newd1 =  $newd[0];
					 $time=date("g:i a", strtotime($newd[1])) ;
					 
					 $app_dateN=$newd1;
					 $date=explode('-',$app_dateN);
					 $app_dateN="$date[2]-$date[1]-$date[0]";
					 $app_date="$app_dateN $time";
				?>
                    <td align='center' >&nbsp;<?=$app_date?></td>
                    <td align='center' >
                    <input type="button"  value="Fix Appointment" onclick ="javascript:OpenWind2('appointment_date.php?id=<?=$row[id]?>', 'OpenWind2',700,450)" class="bgbutton"/></td>                
             <?
		
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