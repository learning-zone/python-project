<?php
session_start();
include("../db.php");
$user=$_SESSION['user'];
if($_POST['save'])
{
$breakfast=$_POST['breakfast'];
$lunch=$_POST['lunch'];
$snacks=$_POST['snacks'];
$type2=$_POST['type2'];
$dinner=$_POST['dinner'];
$type3=$_POST['type3'];
$type1=$_POST['type1'];
$type4=$_POST['type4'];
$today=date("Y-m-d");
$today_time=date("Y-m-d H:i:s");
$StudID=$_REQUEST['StudID'];
$quer3=mysql_fetch_row(mysql_query("select student_id FROM `cafeteria_det` where student_id='$StudID'"));
if($quer3[0])
{
	mysql_query("UPDATE `cafeteria_det` set `user`='$user',`breakfast`='$breakfast',`lunch`='$lunch',`snacks`='$snacks', `dinner`='$dinner',`type1`='$type1',`type2`='$type2',`type3`='$type3',`type4`'$type4',`user_type`='1',`date_entered`='$today',`date_time_entered`='$today_time',`student_id`='$StudID')");
}
else	
{
mysql_query("INSERT INTO `cafeteria_det`(`user`,`breakfast`,`lunch`,`snacks`, `dinner`,`type1`,`type2`,`type3`,`type4`,`user_type`,`date_entered`,`date_time_entered`,`student_id`)VALUES('$user','$breakfast','$lunch','$snacks','$dinner','$type1','$type2','$type3','$type4','1','$today','$today_time','$StudID')");
}
}
?>
  <script>

		alert("Inserted Successfully");

		</script>

<html>
<head>
<body>
<form name='frm' method='post' action="">
<table align='center' class='forumline' width='85%' cellpadding="0" cellspacing="0" border="1">

<tr><td colspan="2" align="center" class="head">Cafeteria</td></tr>
<tr><td width="35%" align="center">Time</td><td align="center">Type</td></tr>

<tr><td>&nbsp;<input type="checkbox" name="breakfast" value="1" id="breakfast" <?=$breakfast?> onClick="reload1(1)">&nbsp;Breakfast</td>
<td nowrap>&nbsp;<input type="radio" value="1" name="type1" onClick="reload()" <?=$chec1?>>&nbsp;Veg&nbsp;&nbsp;<input type="radio" value="2" onClick="reload()" name="type1" <?=$chec2?>>&nbsp;Non-Veg</td></tr>


<tr><td>&nbsp;<input type='checkbox' name="lunch" value="2" id="lunch"<?=$lunch?>>&nbsp;Lunch</td>
    <td nowrap >&nbsp;<input type="radio" value="1" name="type2" onClick="reload()" <?=$chec1?>>&nbsp;Veg&nbsp;&nbsp;<input type="radio" value="2" onClick="reload()" name="type2" <?=$chec2?>>&nbsp;Non-Veg</td></tr>

 
<tr><td >&nbsp;<input type='checkbox' name="snacks" value="3" id="snacks"<?=$snacks?>>&nbsp;Snacks/Tea</td>
    <td nowrap>&nbsp;<input type="radio" value="1" name="type3" onClick="reload()" <?=$chec1?>>&nbsp;Veg&nbsp;&nbsp;<input type="radio" val[[ue="2" onClick="reload()" name="type3" <?=$chec2?>>&nbsp;Non-Veg</td></tr>
  

<tr><td>&nbsp;<input type='checkbox' name='dinner' value="4" id="dinner"<?=$dinner?>>&nbsp;Dinner</td>
    <td nowrap>&nbsp;<input type="radio" value="1" name="type4" onClick="reload()" <?=$chec1?>>&nbsp;Veg&nbsp;&nbsp;<input type="radio" value="2" onClick="reload()" name="type4" <?=$chec2?>>&nbsp;Non-Veg</td></tr>
  
</table>
<div align="center"><input type=submit name='save' value='Submit' class='bgbutton'></div>
</form>
</body>
</head>
</html>