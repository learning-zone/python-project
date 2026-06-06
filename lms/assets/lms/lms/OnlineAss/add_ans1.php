<?php
session_start();
include("../db.php");
if($_GET)
{
	$idn=$_GET['id'];
	$examname=$_GET['examname'];
	$time=$_GET['time'];
	$student_id=$_GET['student_id'];
	$exam_date=$_GET['exam_date'];
}
else
{
	$examname=$_POST['examname'];
	$idn=$_POST['idn'];
	$time=$_POST['time'];
	$student_id=$_POST['student_id'];
	$exam_date=$_POST['exam_date'];
}

$Questions=$_POST['Questions'];

  //print_r($_REQUEST);

if($_POST['idn'])
{
	$cid=$_POST['cid'];
	$score=$_POST['score'];
	$right_ans=$_POST['right_ans'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$idn=$cid[$i];
		
		$optionval=$_POST['optionval'.$cid[$i]];
		
			if($right_ans[$i]==$optionval)
			$mark=$score[$i];
			else
			$mark=0;
		execute("INSERT INTO `online_exam_sel_mark` (`exam_id`, `ans`, `student_id`, `status`,score) VALUES ('$idn', '$optionval', '$student_id', '1','$mark');");
	
	}
	?>
	<Script language="JavaScript">
    alert("Updated successfully");
	window.close();
    </Script>
    <?php	
}

$date=date("m/d/Y");
date("h:i A");
$tomorrow = mktime(0,0,date("h")+4,date("i")+30);
date("h:i A",$tomorrow);
?>

  <?php
  	
	$total=0;
	$sum=0;
 $sql2=execute("select * from online_exam_sel_questions where exam_id='$idn' and status='1' ORDER BY RAND()");
	
 if(rowcount($sql2)>=1)
 { 
 ?>
 		<table width="25%" align="center"><tr><td  width="100%" align="center" class="bgbutton" id="remain" nowrap>
		<?php echo "$remainingHour hours, $remainingMinutes minutes, $remainingSeconds seconds";?>
			
	</td></tr></table>
	<br><br>
	<?

	$i=1;
	while($r6=fetcharray($sql2))
	{
			$sql21=execute("select score from `online_exam_sel_mark` where exam_id='$r6[0]' AND `student_id`='$student_id' AND status='1'");
			$k=1;
				$score=fetcharray(execute("select score from `online_exam_sel_mark` where exam_id='$r6[0]' AND `student_id`='$student_id' AND status='1'"));
				$score=$score[0];
				
			   // echo "Score".$score; 
			/*	
				if($score != '')
				{
				   goto labelFirst;   //TO AVOID TIMER FUNCTION CALLING WHEN STUDENT WANTS TO SEE HIS/HER RESULT.
				}
	         */
           
#############################################################   TIMER FUNCTION  ###################################################################
############ SET DEFAULT SERVER TIME-ZONE  ############### 

  $curdate=date('Y-m-d H:i:s');

  date_default_timezone_set('Asia/Calcutta');
  $date = date('m/d/Y h:i:s a', time());
  
  $timezone = date_default_timezone_get();
  //echo "The current server timezone is: " . $timezone;

########################################################## 
// Define date format
   $dateFormat = "Y-m-d H:i:s";	
############### EXAM TIME-LIMIT  ##################
    $newtime = $time;

	$timeArray=explode(':',$newtime);
	$acq_hh=$timeArray[0];
	$acq_mm=$timeArray[1];
	$acq_ss=$timeArray[2];
	

    $second = '00';
    $minute = $acq_mm;
    $hour = $acq_hh;
####################################################
###############  EXAM DATE  ########################
    $newDate = $exam_date;
	 
	$dateArray=explode('-',$newDate);
	$acq_yy = $dateArray[0];
	$acq_mm1 = $dateArray[1];
	$acq_dd = $dateArray[2];

	$tarYear = $acq_yy;
	$tarMonth = $acq_mm1;
	$tarDay = $acq_dd;

#####################################################
    $curHour=date('H');
	$curMinute=date('i');
	$curSecond=date('s');
	
	$tarHour = ($curHour + $hour);
	$tarMinute = ($curMinute + $minute);
	$tarSecond = ($curSecond + $second);



$targetDate = mktime($tarHour,$tarMinute,$tarSecond,$tarMonth,$tarDay,$tarYear);
$actualDate = time();


 $secondsDiff = $targetDate - $actualDate;

$remainingDay     = floor($secondsDiff/60/60/24);
$remainingHour    = floor(($secondsDiff-($remainingDay*60*60*24))/60/60);
$remainingMinutes = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))/60);
$remainingSeconds = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))-($remainingMinutes*60));

$targetDateDisplay = date($dateFormat,$targetDate);
$actualDateDisplay = date($dateFormat,$actualDate);

?>
<head>
<script type="text/javascript">

  var days = <?php echo $remainingDay; ?>  
  var hours = <?php echo $remainingHour; ?>  
  var minutes = <?php echo $remainingMinutes; ?>  
  var seconds = <?php echo $remainingSeconds; ?> 

     
function setCountDown()
{
  seconds--;
  if (seconds < 0){
      minutes--;
      seconds = 59
  }
  if (minutes < 0){
      hours--;
      minutes = 59
  }
  if (hours < 0){
      days--;
      hours = 23
  }
 document.getElementById("remain").innerHTML =hours+" hours, "+minutes+" minutes, "+seconds+" seconds";
  setTimeout ( "setCountDown()", 1000 ); 
   
  if(days < 0 || hours < 0 || minutes < 0 || seconds < 0)
  {
  		alert("Time-Up");
	    document.frm.submit();

  }
    

}
		window.onload=setCountDown();
</script>
</head>
<?
    //labelFirst:
 ?>
<body>
<form name="frm" method="post">
<input type="hidden" name="idn" value="<?php echo $idn; ?>">
<input type="hidden" name="examname" value="<?php echo $examname; ?>">
<input type="hidden" name="time" value="<?php echo $time; ?>">
<input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
<table align='center' class='forumline' width='80%' border="1" >
<tr>
	<td align='center' class='head' nowrap>Sl.No
	  </td>
		<td align='center' class='head' nowrap><?php echo $examname; ?>
	  </td>
	</tr>
	<?php

			if(rowcount($sql21)>=1)
			{
			
				$flag=1;
				$ans=$r6['right_ans'];
				$desc=fetchrow($sql21);
				echo "	<tr>
						<td width='5%' align='center' valign='top' nowrap>			$i
						</td>
						<td align='justify' colspan='2' >&nbsp;&nbsp;&nbsp;$r6[que]
							<br>&nbsp;&nbsp;&nbsp;ANS : ".$r6['option'.$ans]." <div align='right'>Score : $desc[0] &nbsp;&nbsp;&nbsp;</div>
						</td>
						
					</tr>";
			}
			else
			{
				echo "<tr>
					<td align='justify' width='5%' valign='top' nowrap><input type='hidden' name='cid[]' value='$r6[0]'>
<input type='hidden' name='score[]' value='$r6[score]'>
						<input type='hidden' name='right_ans[]' value='$r6[right_ans]'>
												$i
					</td>
					<td align='justify'  colspan='2' nowrap>&nbsp;&nbsp;&nbsp;$r6[que]<br>";
					$count1=$r6[no_of_option];	
					for($k=1;$k<=$count1;$k++)
					{
						echo "&nbsp;&nbsp;&nbsp;<input type='radio' name='optionval$r6[0]' value='$k'>&nbsp;&nbsp;&nbsp;".$r6['option'.$k]."<br>";
					}
					echo "</td>
					
				</tr>";
			}
			
		$i++;
	}
	?>
	</table>
    <?php
	if($flag!=1)
	{   
          
	?>
  <br><br><div align='center' >
  <input type="submit" name="update" value="UPDATE"  class='bgbutton'>
	</div><?php
	}
  }

?>	  
</form>
</body>
</html>