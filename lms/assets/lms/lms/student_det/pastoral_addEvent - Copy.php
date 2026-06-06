<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/


$academic_year=$_SESSION['AcademicYear'];

if($_GET)
{
	$sem=$_REQUEST['sem'];
	$branch=$_REQUEST['branch'];
	$a_year=$_REQUEST['a_year'];
    $studfname=$_REQUEST['studfname'];
	$studlname=$_REQUEST['studlname'];
	$student_id=$_REQUEST['student_id'];
	$class_section_id=$_REQUEST['class_section_id'];
}
if($_POST)
{

	$sem=$_POST['sem'];
	$branch=$_POST['branch'];
	$a_year=$_POST['a_year'];
    $studfname=$_POST['studfname'];
	$studlname=$_POST['studlname'];
	$student_id=$_POST['student_id'];
	$class_section_id=$_POST['class_section_id'];
}


?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
function ReloadMe()
{
    document.frm.action="ptConference.php";
	document.frm.submit();
}
</script>
<script language="javascript">
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>ADD EVENT</title>
</head>
<body>
	<form method='post' action="pastoral_addEvent.php" name="frm" >
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
            
        <td colspan="4">Reported By&nbsp;&nbsp;<select name="teacher_id">
             <option value=''>----  Select ----</option>
           	<?php
$sqlT=execute("SELECT id,username FROM usermenu WHERE module='Student Management' AND username!='administrator' GROUP BY `username`");
                      while($rt=fetcharray($sqlT))
                      {
                          if($teacher_id==$rt['id'])
                              echo "<option value='$rt[id]' selected>$rt[username]</option>";
                          else
                              echo "<option value='$rt[id]'>$rt[username]</option>";
                      }
          
              ?> </select></td>
   </tr>
   <tr>
   		<td class="rowpic" colspan="6" height="22px">&nbsp;&nbsp;Add Event </td>
    </tr>
    <tr>
        <td colspan="6"><select name="event" style="width:500px">
             <option value=''>----  Select ----</option>
           	<?php
					$sqlE=execute("SELECT * FROM student_m_event WHERE status=1");
                      while($re=fetcharray($sqlE))
                      {
                          if($event==$re['id'])
                              echo "<option value='$re[id]' selected>$re[event]</option>";
                          else
                              echo "<option value='$re[id]'>$re[event]</option>";
                      }
          
              ?> </select>&nbsp;&nbsp;<a href="javascript:void(0);" onClick ="OpenWind2('addEvent.php', 'OpenWind2',400,300)" title="Click to add new Event"><img src="../images/add.png" align="top" height="15" width="15"></a></td>
    </tr>
    <tr>
        <td class="rowpic" colspan="6" height="22px">&nbsp;&nbsp;Description of Event</td>
    </tr>
    <tr>
        <td colspan="6"><textarea name="Event" rows="4" cols="100" placeholder="Enter Description of Event Here."></textarea></td>
    </tr>
    <tr>
        <td class="rowpic" colspan="6" height="22px">&nbsp;&nbsp;Notes ( Confidential - Parent do not see these notes ) </td>
     </tr>
     <tr>
        <td colspan="6" ><textarea name="Notes" rows="4" cols="100" placeholder="Enter Notes Here."></textarea></td>
    </tr>
    <tr>
        <td class="rowpic" colspan="3" height="22px">&nbsp;&nbsp;Consequences</td>
        <td class="rowpic" colspan="3" height="22px">Email Send Options &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     </tr>
     <tr>
        <td rowspan="9" valign="top"><textarea name="Consequences" rows="4" cols="70" placeholder="Enter Consequences Here."></textarea></td>
    </tr>    
    <tr>
        <td align="left" colspan="3" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="Detention" >Parent</td>
    </tr>
    <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="Detention" >Pastoral Heads</td>
    </tr>  
    <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="Detention" >Heads of Secondary</td>
    </tr>            
    <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="Detention" >Dupty Head Academic</td>
    </tr>        
    <tr>
         <td align="left" colspan="4" nowrap>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type="checkbox" name="Detention" >Dupty Head - Middle School</td>
    </tr>        
    <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="Detention" >Head of School</td>
    </tr>        
    <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="Detention" >Others</td>
    </tr>
     <tr>
        <td align="left" colspan="4" nowrap>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;
        <select name="teacher_id" multiple style="height:100px; width:200px">
             <option value=''>----  Select ----</option>
           	<?php
$sqlT=execute("SELECT id,username FROM usermenu WHERE module='Student Management' AND username!='administrator' GROUP BY `username`");
                      while($rt=fetcharray($sqlT))
                      {
                          if($teacher_id==$rt['id'])
                              echo "<option value='$rt[id]' selected>$rt[username]</option>";
                          else
                              echo "<option value='$rt[id]'>$rt[username]</option>";
                      }
          
              ?> </select></td>
    </tr>
    <tr>
        <td colspan="6" valign="top">&nbsp;&nbsp;Detention : 
        <input type="radio" name="Detention" >Yes
        <input type="radio" name="Detention" >No</td>            
      </tr>

</table>
</form>
</body>
</html>