<?php
include("../db.php");
session_start();

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "<br>";*/

$sem = $_SESSION['sem'];
$user = $_SESSION['user'];
$col = $_SESSION['branch'];

if($_POST)
{

	$col = $_POST['col'];
	$nopd = $_POST['nopd'];
	$name = $_POST['name'];
	$secid = $_POST['secid'];
	$colNew = $_POST['colNew'];
	$NewCol = $_POST['NewCol'];
	$ttlprd = $_POST['ttlprd'];
	$secidNew = $_POST['secidNew'];
	$staff_id = $_POST['staff_id'];
	$meeting_date = $_POST['adate'];
	$staff_idNew = $_POST['staff_idNew'];
	$description = $_POST['description'];
	$period_name = $_POST['period_name'];

}
$ttlprd=45;

		

//echo "<br>".$staff_idNew;

if($_REQUEST['Type']=='SAVE')
{	
	//insert starts

		$dateArray=explode('/',$meeting_date);
		$yy=$dateArray[2];
		$mm=$dateArray[1];
		$dd=$dateArray[0];
		
		$meeting_date1="$yy-$mm-$dd";
		
  $chk=execute("SELECT id FROM calendar_schedule_setup WHERE `staff_id` = '$staff_id' AND `meeting_date`='$meeting_date1' AND `status`=1");
	if(rowcount($chk)==0)
	{
		
		$sql="INSERT INTO calendar_schedule_setup (`name`, `description`, `meeting_date`, `staff_id`, `nopd`, `class_id`) VALUES ('$name', '$description', '$meeting_date1', '$staff_id', '$ttlprd', '$secid')";
		
		//echo "<br>".$sql;
		$result=execute($sql) or die("Failed to add data");
		$lastId=fetchInsertId();
		for($i=1; $i <= $ttlprd; ++$i)
		{
			$format = $_POST['format'.$i];
			$to_hour = $_POST['to_hour'.$i];
			$from_hour = $_POST['from_hour'.$i];
			$to_minute = $_POST['to_minute'.$i];
			$from_minute = $_POST['from_minute'.$i];
			$to_time="$to_hour:$to_minute";
			$from_time="$from_hour:$from_minute";
			
		if($to_time!='00:00' and $from_time!='00:00')
		{
			
			$sqlTime="INSERT INTO calendar_schedule_time (`calendar_schedule_setup_id`, `from_time`, `to_time`, `format`) VALUES ('$lastId', '$from_time', '$to_time', '$format')";
			
			$resultTime=execute($sqlTime) or die(mysql_error());
			//echo "<br>".$sqlTime;
		}
			
	}
	?>
   			<script type="text/javascript">
				alert("Scheduler Created");
			</script>
    <?
	}
	else
	{
	/*********** UPDATE QUERY  ***************/	
		$dateArray=explode('/',$meeting_date);
		$yy=$dateArray[2];
		$mm=$dateArray[1];
		$dd=$dateArray[0];
		$meeting_date1="$yy-$mm-$dd";
		$sql="UPDATE calendar_schedule_setup  SET `name`='$name', `description`='$description', `meeting_date`='$meeting_date1', `nopd`='$nopd', `class_id`='$secid' WHERE `staff_id`='$staff_id'";
		$result=execute($sql) or die("Failed to add data");		
		$lastId=fetcharray(execute("SELECT `id` FROM `calendar_schedule_setup` WHERE `staff_id`='$staff_id'"));	
		
		//echo "<br>SELECT a.id FROM `calendar_schedule` a, `calendar_schedule_time` b, `calendar_schedule_setup` c WHERE a.calendar_schedule_time_id = b.id AND c.id = b.calendar_schedule_setup_id AND c.id='$lastId[id]'";
		
		$schedule_check=rowcount(execute("SELECT a.id FROM `calendar_schedule` a, `calendar_schedule_time` b, `calendar_schedule_setup` c WHERE a.calendar_schedule_time_id = b.id AND c.id = b.calendar_schedule_setup_id AND c.id='$lastId[id]'"));	
		
  if($schedule_check < 1) //TO CHECK SCHEDULE IS ALREADY ASSIGN OR NOT
  {
  
	  execute("DELETE FROM `calendar_schedule_time` WHERE `calendar_schedule_setup_id`='$lastId[id]'");
	  for($i=1; $i <= $ttlprd; ++$i)
	  {
		  $format = $_POST['format'.$i];
		  $to_hour = $_POST['to_hour'.$i];
		  $from_hour = $_POST['from_hour'.$i];
		  $to_minute = $_POST['to_minute'.$i];
		  $from_minute = $_POST['from_minute'.$i];	
		  $to_time="$to_hour:$to_minute";
		  $from_time="$from_hour:$from_minute";
	  
			  if($to_time!='00:00' and $from_time!='00:00')
			  {
				  
				  $sqlTime="INSERT INTO calendar_schedule_time (`calendar_schedule_setup_id`, `from_time`, `to_time`, `format`) VALUES ('$lastId[id]', '$from_time', '$to_time', '$format')";
				  $resultTime=execute($sqlTime) or die(mysql_error());
				  
			  }//IF CLOSE				  
	   }//FOR CLOSE
  }//IF CLOSE
  else{
	  ?>
      <script type="text/javascript">
	    alert("Schedule already assigned, Can't be modify");
	  </script>
      <?
  }
}//ELSE CLOSE	
		
	//insert ends
	//copy code strats
	if($_POST[staff_idNew]>0)
	{
		$staff_idNew=$_POST[staff_idNew];
		$chk=execute("SELECT id FROM calendar_schedule_setup WHERE `staff_id` = '$staff_idNew'");
		if(rowcount($chk)==0)
		{
			$dateArray=explode('/',$meeting_date);
			$yy=$dateArray[2];
			$mm=$dateArray[1];
			$dd=$dateArray[0];
			$meeting_date1="$yy-$mm-$dd";
			$sql="INSERT INTO calendar_schedule_setup (`name`, `description`, `meeting_date`, `staff_id`, `nopd`, `class_id`) VALUES ('$name', '$description', '$meeting_date1', '$staff_idNew', '$ttlprd', '$secidNew' )";
			$result=execute($sql) or die("Failed to add data");
			$lastId=fetchInsertId();
			for($i=1; $i <= $ttlprd; ++$i)
			{
				$format = $_POST['format'.$i];
				$to_hour = $_POST['to_hour'.$i];
				$from_hour = $_POST['from_hour'.$i];
				$to_minute = $_POST['to_minute'.$i];
				$from_minute = $_POST['from_minute'.$i];
				$to_time="$to_hour:$to_minute";
				$from_time="$from_hour:$from_minute";
			if($to_time!='00:00' and $from_time!='00:00')
		    {
				$sqlTime="INSERT INTO calendar_schedule_time (`calendar_schedule_setup_id`, `from_time`, `to_time`, `format`) VALUES ('$lastId', '$from_time', '$to_time', '$format')";
				$resultTime=execute($sqlTime) or die(mysql_error());
			}
			}
		}
		else
		{
		/*********** UPDATE QUERY  ***************/	
			
			$sql="UPDATE calendar_schedule_setup  SET `name`='$name', `description`='$description', `meeting_date`='$meeting_date1', `nopd`='$nopd', `class_id`='$secidNew' WHERE `staff_id`='$staff_idNew'";
			$result=execute($sql) or die("Failed to add data");		
			$lastId=fetcharray(execute("SELECT `id` FROM `calendar_schedule_setup` WHERE `staff_id`='$staff_idNew'"));	
			
			$schedule_check=rowcount(execute("SELECT a.id FROM `calendar_schedule` a, `calendar_schedule_time` b, `calendar_schedule_setup` c WHERE a.calendar_schedule_time_id = b.id AND c.id = b.calendar_schedule_setup_id AND c.id='$lastId[id]'"));	
		
  if($schedule_check < 1) //TO CHECK SCHEDULE IS ALREADY ASSIGN OR NOT
  {			
			execute("DELETE FROM `calendar_schedule_time` WHERE `calendar_schedule_setup_id`='$lastId[id]'");
			for($i=1; $i <= $ttlprd; ++$i)
			{
				$format = $_POST['format'.$i];
				$to_hour = $_POST['to_hour'.$i];
				$from_hour = $_POST['from_hour'.$i];
				$to_minute = $_POST['to_minute'.$i];
				$from_minute = $_POST['from_minute'.$i];	
				$to_time="$to_hour:$to_minute";
				$from_time="$from_hour:$from_minute";
				
					if($to_time!='00:00' and $from_time!='00:00')
					{
						$sqlTime="INSERT INTO calendar_schedule_time (`calendar_schedule_setup_id`, `from_time`, `to_time`, `format`) VALUES ('$lastId[id]', '$from_time', '$to_time', '$format')";
						$resultTimeCopy=execute($sqlTime) or die(mysql_error());
					}//IF CLOSE
			  }//FOR CLOSE
		}else{
			?>
            <script type="text/javascript">
				alert("Schedule already assigned, Can't be modify");
			</script>
            <?
		}
	}//ELSE CLOSE
}	//copy code ends
	if($resultTimeCopy){
		?>
   			<script type="text/javascript">
				alert("Scheduler Copied");
			</script>
   	 <?
	}
}
/*****  DELETE RECORDS OPTIONS *******/
if($_REQUEST['Type']=="DEL" and $staff_id!='')
{
	
	$dateArray=explode('/',$meeting_date);
	$yy=$dateArray[2];
	$mm=$dateArray[1];
	$dd=$dateArray[0];
	$Deletemeeting_date="$yy-$mm-$dd";
			
	$schedule_id=fetcharray(execute("SELECT id FROM `calendar_schedule_setup` WHERE `staff_id`='$staff_id' AND `meeting_date`='$Deletemeeting_date' AND `status`=1"));
	
	
	$rs=execute("UPDATE `calendar_schedule_setup` SET `status`=0 WHERE `staff_id`='$staff_id' AND `meeting_date`='$Deletemeeting_date'");
	
	$rsTime=execute("UPDATE `calendar_schedule_time` SET `status`=0 WHERE `calendar_schedule_setup_id`='$schedule_id[id]'");
	
	$name='';
	$description='';
	$meeting_date='';
	?>
   			<script type="text/javascript">
				alert("Scheduler Deleted");
			</script>
   	 <?
			
}


?>
<!DOCTYPE HTML>
<html>
<head>
<script language="JavaScript">
function reload1()
{
	document.frm.action="schedulerSetup.php";
	document.frm.submit();
}
function save_onClick()
{
	//alert('save');
	document.frm.action="schedulerSetup.php?Type=SAVE";
	document.frm.submit();
}
function delete_onClick()
{
	alert('delete');
	document.frm.action="schedulerSetup.php?Type=DEL";
	document.frm.submit();
}
</script>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
</head>
<body>
<form name="frm" method="post">
<?php
if($meeting_date)
{
	$dateArray=explode('/',$meeting_date);
	$yy=$dateArray[2];
	$mm=$dateArray[1];
	$dd=$dateArray[0];
	$tempdate="$yy-$mm-$dd";
}
	//echo "<br>SELECT * FROM `calendar_schedule_setup` WHERE `staff_id`='$staff_id' AND `meeting_date`='$tempdate' AND `status`=1";
	
	$schedule_det=fetcharray(execute("SELECT * FROM `calendar_schedule_setup` WHERE `staff_id`='$staff_id' AND `meeting_date`='$tempdate' AND `status`=1"));
	//echo "<br> schedule_det :".$schedule_det[nopd];

?>
<? if($schedule_det[nopd]){ ?>
<input type="hidden" name="nopd" value="<?=$schedule_det[nopd]?>">
<? } ?>
<table align="center" border="0" class="forumline" width="70%">
<tr>

	<td class=head align=center colspan='8'>SCHEDULER SETUP</td>

</tr>
<tr>
 <td colspan="8" align="right" ><input type="button" name="save" value="Save" class="bgbutton" style="width:70px; " onClick="save_onClick()">
     &nbsp;&nbsp;
    <input type="button" name="delete" value="Delete" class="bgbutton" style="width:70px; " onClick="delete_onClick()">
  </td>
</tr>

<tr height="35">

	<td >&nbsp;&nbsp; <?php echo $_SESSION['semname']; ?></td>
    <td nowrap colspan="3"><select name='col' onchange='reload1()' style="width:120px;">
	<option value=''>--- Select ---</option>
	<?php   
    $hq=execute("SELECT `year_id`, `year_name` FROM `course_year` ORDER BY year_id");

    while($hq1=fetcharray($hq))
    {
        if($col==$hq1[0])
            echo"<option value='$hq1[0]' selected>$hq1[1]</option>";
        else
            echo"<option value='$hq1[0]'>$hq1[1]</option>";
    }

    ?>    
    </select></td>
        <!--<td align="left">Class</td>
        <td ><select name='secid' onchange='reload1()' style="width:120px;">
        <option value=''>--- Select ---</option>
        <?php
    
        $sql=execute("SELECT * FROM class_section WHERE grade='$col' AND status=1");
    
        while($r=fetcharray($sql))
        {
            if($secid==$r[0])
                echo "<option value=$r[0] selected>$r[codename] - $r[section_name]</option>";
            else
                echo "<option value=$r[0]>$r[codename] - $r[section_name]</option>";
        }
        ?>
        </select></td>
        
        <td align="left">Teacher </td>
        
        <td ><select name='staff_id' onchange='reload1()' style="width:120px;">
        <option value=''>--- Select ---</option>
        <?php
    
        $sql=execute("SELECT a.id,a.f_name FROM staff_det a,all_teachers b WHERE a.id IN ( sub_teac2, sub_teac, home_teac) AND b.section='$secid' GROUP BY a.id");
    
        while($r=fetcharray($sql))
        {
			if($staff_id==$r[id])
				echo "<option value=$r[id] selected>$r[f_name] </option>";
			else
				echo "<option value=$r[id]>$r[f_name]</option>";
		}
        ?>
        </select></td>-->

	</tr>
    <tr height="35">

        <td>&nbsp;&nbsp; Meeting Date</td>
        <?
		
        if($schedule_det['meeting_date']!="0000-00-00" and $schedule_det['meeting_date']!='')
        {
                $meeting_date=$schedule_det['meeting_date'];
                $dateArray=explode('-',$meeting_date);
                $b_day=$dateArray[2];
                $b_month=$dateArray[1];
                $b_year=$dateArray[0];
                $meeting_date="$b_day/$b_month/$b_year";
        }
		
        ?>
        <td colspan="6"><input type="text" name="adate" value="<?=$meeting_date?>" onFocus="reload1()"/>&nbsp;<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

     
</tr>
 <tr>

	<td>&nbsp;&nbsp; Event Name</td>
    <? 
		if($schedule_det[name]){
			$name=$schedule_det[name];
		}
	?>
		
    <td><input type="text" name="name" value="<?=$name?>"/></td>
   
    <td>Description</td>
    <? 
		if($schedule_det[description]){
			$description=$schedule_det[description];
		}
	?>
    <td colspan="4"><textarea name="description" rows="2"  cols="30" ><?=$description?></textarea></td>
    
</tr>

<tr>
   <td colspan="6">&nbsp;&nbsp; Copy Scheduler</td>
</tr>
<tr>
    <!-- COPY SCHEDULER  -->
    
    <td >&nbsp;&nbsp; <?php echo $_SESSION['semname']; ?></td>
    <td nowrap colspan="3"><select name='colNew' onchange='reload1()' style="width:120px;">

	<option value=''>--- Select ---</option>

	<?php   

    $hqNew=execute("SELECT `year_id`, `year_name` FROM `course_year` ORDER BY year_id");

    while($hq1New=fetcharray($hqNew))
    {

        if($colNew==$hq1New[0])
            echo"<option value='$hq1New[0]' selected>$hq1New[1]</option>";
        else
            echo"<option value='$hq1New[0]'>$hq1New[1]</option>";
    }
    ?>    
    </select></td>

       <!-- <td align="left">Class</td>
        <td ><select name='secidNew' onchange='reload1()' style="width:120px;">
        <option value=''>--- Select ---</option>
        <?php
    
        $sql=execute("SELECT * FROM class_section WHERE grade='$colNew' AND status=1");
    
        while($r=fetcharray($sql))
        {
            if($secidNew==$r[0])
                echo "<option value=$r[0] selected>$r[codename] - $r[section_name]</option>";
            else
                echo "<option value=$r[0]>$r[codename] - $r[section_name]</option>";
        }
        ?>
        </select></td>
        
        <td align="left">Teacher </td>
        
        <td ><select name='staff_idNew' onchange='reload1()' style="width:120px;">
        <option value='0'>--- Select ---</option>
        <?php
    
        $sql=execute("SELECT a.id,a.f_name FROM staff_det a,all_teachers b WHERE a.id IN ( sub_teac2, sub_teac, home_teac) AND b.section='$secidNew' AND a.id!='$staff_id' GROUP BY a.id");
    
        while($r=fetcharray($sql))
        {
			if($staff_idNew==$r[id])
				echo "<option value=$r[id] selected>$r[f_name] </option>";
			else
				echo "<option value=$r[id]>$r[f_name]</option>";
		}
        ?>
        </select></td>-->
</tr>
</table>

		<table align="center" border="1" class="forumline" width="70%">

		<tr>
        	<td class="row3" align="center" rowspan='2'>Slot No.</td>
            <td class="row3" align="center">From Time</td>
            <td class="row3" align="center">To Time</td> 
            <!--<td class="row3" align="center" rowspan='2'>AM / PM</td> -->          
        </tr>
		<tr>
        	<td align='center' class="row3">Hrs : Min</td>
            <td align='center' class="row3">Hrs : Min</td>
        </tr>
        <?php

if($staff_id!='' and $meeting_date!='')
{

	//echo "<br>SELECT * FROM `calendar_schedule_time` WHERE `calendar_schedule_setup_id`='$schedule_det[id]' ORDER BY `from_time`";
	
	$sql=execute("SELECT * FROM `calendar_schedule_time` WHERE `calendar_schedule_setup_id`='$schedule_det[id]' ORDER BY `from_time`");

	$rcnt=rowcount($sql);
	//echo "<br>".$rcnt;
	$k=1;
	if($rcnt>0)
	{

		$sno=1;
		
		
		 while($row=fetcharray($sql))
		 {
			if($sno<10){
			   $sno='0'.$sno;
			}
			
			$to_time=$row['to_time'];
			$from_time=$row['from_time'];
			
			$dateArray = explode(':',$from_time);
			$from_hour = $dateArray[0];
			$from_minute = $dateArray[1];
			$from_second = $dateArray[2];
			
			$dateArray = explode(':',$to_time);
			$to_hour = $dateArray[0];
			$to_minute = $dateArray[1];
			$to_second = $dateArray[2];
			
			$format=$row['format'];
					
		?>
      <tr>
				 <td align="center" class="row3" ><?=$sno?></td>
				 <td align="center"  class="row3" nowrap>
                 <select name='from_hour<?=$k?>'>	
            <?PHP
                 for($a=0;$a<=23;$a++)
   				 {
						if($a<10){
							$a="0".$a;
						}
					if($from_hour==$a){
						echo"<option value=$a selected>$a</option>";
					}else{
						echo"<option value=$a>$a</option>";
					}
				}
			?>
                 </select>
                 <select name='from_minute<?=$k?>'>
  			<?PHP
                 for($b=0;$b<=59;$b++)
   				 {
						if($b<10){
							$b="0".$b;
						}
					if($from_minute==$b){
						echo"<option value=$b selected>$b</option>";
					}else{
						echo"<option value=$b>$b</option>";
					}
				}
			?>
                 </select></td>
			<td align="center"  class="row3" nowrap>
                 <select name='to_hour<?=$k?>'>	
            <?PHP
                 for($c=0;$c<=23;$c++)
   				 {
						if($c<10){
							$c="0".$c;
						}
					if($to_hour==$c){
						echo"<option value=$c selected>$c</option>";
					}else{
						echo"<option value=$c>$c</option>";
					}
				}
			?>
                 </select>
                 <select name='to_minute<?=$k?>'>
  			<?PHP
                 for($d=0;$d<=59;$d++)
   				 {
						if($d<10){
							$d="0".$d;
						}
					if($to_minute==$d){
						echo"<option value=$d selected>$d</option>";
					}else{
						echo"<option value=$d>$d</option>";
					}
				}
			?>
                 </select></td>
			  </tr>
			 <?
			++$sno;
			++$k;
			
		}
	}
		
?>
<tr>
<?php
		$sno=$k;
		for($k=$k; $k <= $ttlprd; $k++)
		{ 
			if($sno<10){
			   $sno='0'.$sno;
			}
				
			 ?>
				 <td align="center" ><?=$sno?></td>
				 <td align="center" nowrap>
                 <select name='from_hour<?=$k?>'>	
            <?PHP
                 for($a=0;$a<=23;$a++)
   				 {
						if($a<10){
							$a="0".$a;
						}
						echo"<option value=$a>$a</option>";
					
				}
			?>
                 </select>
                 <select name='from_minute<?=$k?>'>
  			<?PHP
                 for($b=0;$b<=59;$b++)
   				 {
						if($b<10){
							$b="0".$b;
						}
					
						echo"<option value=$b>$b</option>";
					
				}
			?>
                 </select></td>
			<td align="center" nowrap>
                 <select name='to_hour<?=$k?>'>	
            <?PHP
                 for($c=0;$c<=23;$c++)
   				 {
						if($c<10){
							$c="0".$c;
						}
					
						echo"<option value=$c>$c</option>";
					
				}
			?>
                 </select>
                 <select name='to_minute<?=$k?>'>
  			<?PHP
                 for($d=0;$d<=59;$d++)
   				 {
						if($d<10){
							$d="0".$d;
						}
				
						echo"<option value=$d>$d</option>";
					
				}
			?>
                 </select></td>
			  </tr>
			 <?
			++$sno;
		}
	
   }

		?>

		</table>
   
</form>
</body>
</html>