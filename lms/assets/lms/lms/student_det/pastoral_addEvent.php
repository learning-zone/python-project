<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$a_year=$_SESSION['AcademicYear'];

if($_GET)
{
	$sem=$_REQUEST['sem'];
	$StudID=$_GET['StudID'];
	$Type = $_REQUEST['Type'];
	$branch=$_REQUEST['branch'];
    $studfname=$_REQUEST['studfname'];
	$studlname=$_REQUEST['studlname'];
	$student_id=$_REQUEST['student_id'];
	$class_section_id=$_REQUEST['class_section_id'];
}
if($_POST)
{
	$sem=$_POST['sem'];
	$other=$_POST['other'];
	$adate=$_POST['adate'];
	$notes=$_POST['notes'];
	$StudID=$_POST['StudID'];
	$branch=$_POST['branch'];
	$parent=$_POST['parent'];
	$event_id=$_POST['event_id'];
    $studfname=$_POST['studfname'];
	$studlname=$_POST['studlname'];
	$detention=$_POST['detention'];
	$teacher_id=$_POST['teacher_id'];
	$email_send=$_POST['email_send'];
	$reported_by=$_POST['reported_by'];
	$head_school=$_POST['head_school'];
	$description=$_POST['description'];
	$consequence=$_POST['consequence'];
	$head_middle=$_POST['head_middle'];
	$head_academy=$_POST['head_academy'];
	$pastoral_head=$_POST['pastoral_head'];
	$head_secondary=$_POST['head_secondary'];
	$class_section_id=$_POST['class_section_id'];
}

if($Type=="add")
{
	 
			  $dateArray=explode('/',$adate);
			  $acq_yy=$dateArray[2];
			  $acq_mm=$dateArray[1];
			  $acq_dd=$dateArray[0];
			  $selected_date="$acq_yy-$acq_mm-$acq_dd";
			  
			  $email_send="$parent,$pastoral_head,$head_secondary,$head_academy,$head_middle,$head_school,$other,";
			  
	 $sqlInsert="INSERT INTO `student_m_pastoral`(`student_id`, `selected_date`, `reported_by`, `event_id`, `description`, `notes`, `consequence`, `detention`, `email_send`, `a_year`, `inserted_date`) VALUES('$StudID', '$selected_date', '$reported_by', '$event_id', '".addslashes($description)."', '".addslashes($notes)."', '".addslashes($consequence)."', '$detention', '$email_send', '$a_year', NOW())";
 	 
	 //echo "<br>".$sqlInsert;
	 $resultInsert=execute($sqlInsert) or die(mysql_error());
	 if($resultInsert){
		 ?>
         	<script type="text/javascript">
			   alert('Records Added');
			   window.opener.location.reload();
			   window.close();
			 </script>
         <?
	 }
}
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
  function ReloadMe()
  {
	  document.frm.action="pastoral_addEvent.php";
	  document.frm.submit();
  }
  function adds_onclick()
  {
	  document.frm.action="pastoral_addEvent.php?Type=add";
	  document.frm.submit();
  }
  function send_onClick()
  {
	  document.frm.action = "sendpastrolmail.php";
	  document.frm.submit();
  }
</script>
<script language="javascript">
function OpenWind4(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>ADD EVENT</title>
</head>
<body>
<form method='post' action="pastoral_addEvent.php" name="frm" >
<input type="hidden" name="StudID" value="<?=$StudID?>"/>
 <table class='forumline' align='center' width="98%" >
   <tr>
   		<td Class="Head" colspan='6' align='center'>ADD EVENT</td>
   </tr>
    <tr>
   		<td Class="row3" colspan='6' align='center' height="22px"><?=$studfname?>&nbsp;&nbsp;<?=$studlname?></td>
   </tr>
   <tr>
   		<td>&nbsp;&nbsp;Date&nbsp;&nbsp;
        <input type="text" name="adate" value="<?=$adate?>" readonly>&nbsp;&nbsp;
            <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
            
        <td colspan="4">Reported By&nbsp;&nbsp;
        	<select name="reported_by">
             <option value=''>----  Select ----</option>
           	<?php
				$sqlT=execute("SELECT id,f_name FROM staff_det WHERE status_id='1' ORDER BY `f_name`");
                      while($rt=fetcharray($sqlT))
                      {
                          if($reported_by==$rt['id'])
                              echo "<option value='$rt[id]' selected>$rt[f_name]</option>";
                          else
                              echo "<option value='$rt[id]'>$rt[f_name]</option>";
                      }
          
              ?> </select></td>
   </tr>
   <tr>
   		<td class="rowpic" colspan="6" height="22px">&nbsp;&nbsp;Add Event </td>
    </tr>
    <tr>
        <td colspan="6"><select name="event_id" style="width:500px">
             <option value=''>----  Select ----</option>
           	<?php
					$sqlE=execute("SELECT * FROM student_m_event WHERE status='1' ORDER BY `event`");
                      while($re=fetcharray($sqlE))
                      {
                          if($event_id==$re['id'])
                              echo "<option value='$re[id]' selected>$re[event]</option>";
                          else
                              echo "<option value='$re[id]'>$re[event]</option>";
                      }
          
              ?> </select>&nbsp;&nbsp;<a href="javascript:void(0);" onClick ="OpenWind4('addEvent.php', 'OpenWind4',500,400)" title="Click to add new Event"><img src="../images/add.png" align="top" height="15" width="15"></a></td>
    </tr>
    <tr>
        <td class="rowpic" colspan="6" height="22px">&nbsp;&nbsp;Description of Event</td>
    </tr>
    <tr>
        <td colspan="6"><textarea name="description" rows="4" cols="100" placeholder="Enter Description of Event Here."></textarea></td>
    </tr>
    <tr>
        <td class="rowpic" colspan="6" height="22px">&nbsp;&nbsp;Notes ( Confidential - Parent do not see these notes ) </td>
     </tr>
     <tr>
        <td colspan="6" ><textarea name="notes" rows="4" cols="100" placeholder="Enter Notes Here."></textarea></td>
    </tr>
    <tr>
        <td class="rowpic" colspan="3" height="22px">&nbsp;&nbsp;Consequences</td>
        <td class="rowpic" colspan="3" height="22px">Email Send Options &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     </tr>
     <tr>
        <td rowspan="9" valign="top"><textarea name="consequence" rows="4" cols="70" placeholder="Enter Consequences Here."></textarea>
        <br> &nbsp;&nbsp;Detention : 
        <input type="radio" name="detention" value="YES">Yes
        <input type="radio" name="detention" value="NO">No
        </td>
    </tr>    
    <tr>
        <td align="left" colspan="3" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" value="1" name="parent" >Parent</td>
    </tr>
    <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" value="2" name="pastoral_head" >Pastoral Heads</td>
    </tr>  
    <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" value="3" name="head_secondary" >Heads of Secondary</td>
    </tr>            
    <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" value="4" name="head_academy" >Dupty Head Academic</td>
    </tr>        
    <tr>
         <td align="left" colspan="4" nowrap>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type="checkbox" value="5" name="head_middle" >Dupty Head - Middle School</td>
    </tr>        
    <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" value="6" name="head_school" >Head of School</td>
    </tr>        
    <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" value="7" name="other" >Others</td>
    </tr>
     <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;
        <select name="teacher_id[]" multiple style="height:100px; width:200px">
             <option value=''>----  Select ----</option>
			<?
			$qry="SELECT `id`,`f_name` as first_name,`s_name` as last_name FROM `staff_det` where active='YES' order by f_name";
			
			$sqlF=execute($qry);
			while($rr=fetcharray($sqlF))
			{
			if($teacher_id==$rr[0])
			echo "<option value='$rr[0]' selected>$rr[1] $rr[2]</option>";
			else
			echo "<option value='$rr[0]'>$rr[1] $rr[2]</option>";
			}
			?> 
			</select>
			</td>
    </tr>
</table>
<p align="center">
<input type="button" name="Save" value="Save" class="bgbutton" onClick="adds_onclick()" style="width:80px; height:22px"/>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name="Delete" value="Delete" class="bgbutton" onClick="delete_onClick()" style="width:80px; height:22px"/>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="send" value="Send Email" class="bgbutton" onClick="send_onClick()" style="width:80px; height:22px"/>
</p>

</form>
</body>
</html>