<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
$user=$_SESSION['user'];

if($_GET)
{
	$sem=$_GET['sem'];
	$Type=$_GET['Type'];
	$Action=$_GET['Action'];
	$branch=$_GET['branch'];
	$a_year=$_GET['a_year'];
	$StudID=$_GET['StudID'];
	$conf_id=$_GET['conf_id'];
    $studfname=$_GET['studfname'];
	$studlname=$_GET['studlname'];
	$student_id=$_GET['student_id'];
	$class_section_id=$_GET['class_section_id'];
}
if($_POST)
{
	$sem=$_POST['sem'];
	$Type=$_POST['Type'];
	$StudID=$_POST['StudID'];
	$branch=$_POST['branch'];
	$app_no=$_POST['app_no'];
	$class_section_id=$_POST['class_section_id'];
}
$adate=date('d/m/Y');

if($Action=="NEW")
{
	$conf_id='';
}
if($conf_id=='')
{
	$facID=fetcharray(execute("SELECT `id` FROM `staff_det` WHERE `f_name`='$user'"));
	
	$tecID=fetcharray(execute("SELECT `id` FROM `student_pt_m` WHERE `teacher_id`='$facID[0]'"));
	$conf_id=$tecID[0];

}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<style type="text/css">
<!--
  body
  {
	  font: 14px "Helvetica Neue", Helvetica, Arial, sans-serif;	
	  margin: 10px 15px;		
  }
  td
  {
	  padding:3px;
  } 
-->
</style>
<script language="javascript">
	function OpenWind2(URL, title,w,h)
	{
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
	var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	}
</script>
<script type="text/javascript">
	function Reload(token)
	{
		document.frm.action="conference_edt.php?conf_id="+token;
		document.frm.submit();
	}
	function ReloadMe()
	{
		document.frm.action="conference_edt.php";
		document.frm.submit();
	}
	function New_onClick()
	{
		//alert('NEW');
		document.frm.action="conference_edt.php?Action=NEW";
		document.frm.submit();
	}
	function Save_onClick()
	{
		//alert('INSERT');
		document.frm.action="conference_exec.php?Type=ADD";
		document.frm.submit();
	}
	function Update_onClick()
	{
		//alert('UPDATE');
		document.frm.action="conference_exec.php?Type=UPDATE";
		document.frm.submit();
	}
	function Delete_onClick()
	{
		//alert('DELETE');
		document.frm.action="conference_exec.php?Type=DEL";
		document.frm.submit();
	}
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>PARENT-TEACHER CONFERENCE</title>
</head>
<body>
<form method='post' action="conference_edt.php" name="frm" >
<input type="hidden" name="StudID" value="<?=$StudID?>"/>
<div id='menu'>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
   <ul class="tabHead"> 
     <?	
 		$details=fetcharray(execute("SELECT * FROM `student_m` WHERE `id`='$StudID' LIMIT 1"));	
	
		$det=fetcharray(execute("SELECT * FROM `student_pt_m` WHERE `id`='$conf_id'"));
      ?> 
    <table class="forumline"  align="center" width="100%">
	<tr><td valign="top"><BR>   
    <li><a href="SearchStudent.php?StudID=<?=$StudID?>" title="Student Details">Student</a></li>
    <li><a href="behaviour.php?StudID=<?=$StudID?>" title="Student Behaviour">Pastoral Care</a></li>
    <li class="currentBtn"><a href="conference_edt.php?StudID=<?=$StudID?>" title="Parent-Teacher Meeting">P/T Meeting</a></li>
    <li><a href="transport.php?StudID=<?=$StudID?>" title="Transportation Details">Transport</a></li>
    <li ><a href="StudentReportCard.php?StudID=<?=$StudID?>" title="Student Report">Assessment</a></li>
    <li><a href="familys.php?StudID=<?=$StudID?>" title="Add Siblings">Family</a></li>
    <li><a href="ecContact.php?StudID=<?=$StudID?>" title="Emergency Contact">EC Contact</a></li>
  </td>
 </tr>
</table>      
 </ul>
</div></div></div>
 <table class='forumline' align='center' width="100%" >
   <tr height="30">
   		<td Class="row3" colspan='7' align='center'>PARENT-TEACHER MEETING &nbsp;&nbsp;[&nbsp;<?=$details['first_name']?>&nbsp;<?=$details['last_name']?>&nbsp;]</td>
   </tr>
   <tr>
   		<td>&nbsp;&nbsp;</td>          
       <?
	   if($det['conf_date']){
		  $ndate=$det['conf_date'];
		  $dateArray=explode('-',$ndate);
		  $acq_yy=$dateArray[0];
		  $acq_mm=$dateArray[1];
		  $acq_dd=$dateArray[2];
		  $conf_date="$acq_dd/$acq_mm/$acq_yy";
	   }
	   ?>
                    
        <td><input type="text" name="adate" value="<?=$conf_date?>" readonly>&nbsp;&nbsp;
           <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
           
         <td nowrap align="right">Teacher Name&nbsp;&nbsp;</td>
         <td><select name="teacher_id">
             <option value=''>---  Select Teacher ---</option>
           	<?php
			$sqlT=execute("SELECT id, f_name FROM staff_det ORDER BY `f_name`");
					if($det[teacher_id]){
						$teacher_id=$det[teacher_id];
					}
					while($rt=fetcharray($sqlT))
					{
						if($teacher_id==$rt['id'])
							echo "<option value='$rt[id]' selected>$rt[f_name]</option>";
						else
							echo "<option value='$rt[id]'>$rt[f_name]</option>";
					}
          
              ?> </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="button"  value="New"  style="width:86px; height:22px;" onClick="New_onClick()" class="bgbutton"></td>
<? if($Action=="NEW"){  ?>
    <td><input type="button" name="Save" value="Save" onClick="Save_onClick()" class="bgbutton" style="width:70px; height:22px"/></td>
<? }else{  ?>
     <td><input type="button" name="Save" value="Save" onClick="Update_onClick()" class="bgbutton" style="width:70px; height:22px"/></td>
<?  }  ?>
        <td><input type="button"  value="Delete"  style="width:86px; height:22px;" onClick="Delete_onClick()" class="bgbutton"></td>
   </tr>
<tr valign="top">
 <td>
 <table align="left" width="30%">
 	<tr>
        <td><select name="conf_id" multiple style="height:550px; width:178px" onChange="Reload(this.value)">    
<?php
	$sql="SELECT `id`,`conf_date`,`teacher_id` FROM `student_pt_m` WHERE student_id='$StudID' ORDER BY conf_date";

		$rs=execute($sql) or die(mysql_error());
		
		while($row=fetcharray($rs))
		{
			$staffname=fetcharray(execute("SELECT f_name FROM `staff_det` WHERE id=$row[teacher_id]"));
		
			if($conf_id==$row['id'])
				echo "<option value='$row[id]' selected title=$staffname[f_name]>$row[conf_date] - $staffname[f_name]</option>";
			else
				echo "<option value='$row[id]' title=$staffname[f_name]>$row[conf_date] - $staffname[f_name]</option>";
		}
	?>
    	</select></td>       
     </tr>
 </table>
  </td>
 <td colspan="6" valign="top"><BR>
  <table align="left" width="70%">
    <tr>         
         <td valign="top" nowrap colspan="4">Subject&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" Name="subject" value="<?=$det['subject']?>" size="40"></td>
    </tr>
     <tr>
         <td valign="top"><fieldset style="border: groove; border-width:1px; width: 200px; align:left;">
			<legend>&nbsp; Location &nbsp;</legend>
            <?		
				if($det['location']==1){
					$first='checked';
				}
				elseif($det['location']==2){
					$second='checked';
				}
				elseif($det['location']==3){
					$third='checked';
				}
				
			?>
        	<p align="left"><input type="radio" name="location" value="1" required <?=$first?>>&nbsp;Phone Conversation</p>
            <p align="left"><input type="radio" name="location" value="2" required <?=$second?>>&nbsp;In-person Conference</p>
            <p align="left"><input type="radio" name="location" value="3" required <?=$third?>>&nbsp;Email/Mail</p>
        </fieldset>
        </td>
             <td valign="top"><fieldset style="border: groove; border-width:1px; width: 200px; align:left;">
			 <legend>&nbsp; Reason &nbsp;</legend> 
             <?			
				if($det['academic']==1){
					$four='checked';
				}
				if($det['conduct']==1){
					$five='checked';
				}
				if($det['other']==1){
					$six='checked';
				}	
			 ?>         
        	 <p align="left"><input type="checkbox" name="academic" value="1" required <?=$four?>>&nbsp;Academic</textarea></p>
             <p align="left"><input type="checkbox" name="conduct" value="1" required <?=$five?>>&nbsp;Conduct</p>
             <p align="left"><input type="checkbox" name="other" value="1" required <?=$six?>>&nbsp;Other ( Explain )</p>
       </fieldset>
       </td>
      <td valign="top"><textarea name="other_reason" rows="8" cols="48" placeholder="Enter Other Reason Here."><?=$det['other_reason']?></textarea></td>
   </tr>
     <tr>
         <td valign="top" colspan="2">
         <fieldset style="border: groove; border-width:1px; width: 425px; align:left;">
			<legend>&nbsp; Observation &nbsp;<a href="javascript:void(0);" onClick ="OpenWind2('add_observation.php', 'OpenWind2',400,300)" title="Click to new observation"><img src="../images/add.png" align="top" height="15" width="15"></a></legend>
            <table><tr>			
		<?
            $rso=execute("SELECT * FROM `student_pt_observation` WHERE status=1 ORDER BY id");
            $l=1;
            while($row=fetcharray($rso))
            {			
				$chk=rowcount(execute("SELECT id FROM student_pt_observation_m WHERE student_id='$det[student_id]' AND teacher_id='$det[teacher_id]' AND observation_id='$row[id]'"));
				
				if($chk < 1){
					$chek='';
				}else{
					$chek='checked';
				}
				
                ?>
                <input type="hidden"  name="Sel[]" value="<?=$row[id]?>">
                <td><input type="checkbox" name="<?=$row[id]?><?=$row[observation]?>" <?=$chek?>><?=$row[observation]?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <?
                    if($l%2==0){
                        ?><tr><?
                    }
                    $l++;
            }
        ?>
        </tr></table></fieldset>
      <td valign="baseline"><textarea name="observation" rows="8" cols="48" placeholder="Enter Observation Here."><?=$det['observation']?></textarea></td>
   </tr>
   <tr>
    	<td>Recommendation</td>
    </tr>
    <tr>
    	<td colspan="3"><textarea name="recommendation" rows="4" cols="113" placeholder="Enter Recommmendation Here."><?=$det['recommendation']?></textarea></td>
    </tr>
    <tr>
    	<td>Parent's Reaction/Comments</td>
    </tr>
    <tr>
    	<td colspan="3">
        <textarea name="parents_comments" rows="4" cols="113" placeholder="Enter Parent's Reaction/Comments Here."><?=$det['parents_comments']?></textarea></td>
    </tr>
</table>
</td>
</tr>
</table>
</form>
</body>
</html>