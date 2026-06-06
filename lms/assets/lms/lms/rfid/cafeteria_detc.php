<?php
session_start();
include("../db.php");
$StudID=$_REQUEST['StudID'];
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


$quer3=fetchrow(execute("select * FROM `cafeteria_det` where user='$StudID' and user_type=5"));
if($type1==1 || $type2==2)
	{
		$breakfast=1;
	}
	if($type2==1 || $type2==2)
	{
		
		$lunch=1;
	}
	if($type3==1 || $type3==2)
	{
		
		$snacks=1;
	}
	if($type4==1 || $type4==2)
	{
		
		$dinner=1;
	}
if($quer3[0])
{
	
	execute("UPDATE `cafeteria_det` set `user`='$StudID',`breakfast`='$breakfast',`lunch`='$lunch',`snacks`='$snacks', `dinner`='$dinner',`type1`='$type1',`type2`='$type2',`type3`='$type3',`type4`='$type4',`user_type`='2',`date_entered`='$today',`date_time_entered`='$today_time' where `user_type`='5' and user='$id'");
}
else	
{
execute("INSERT INTO `cafeteria_det`(`user`,`breakfast`,`lunch`,`snacks`, `dinner`,`type1`,`type2`,`type3`,`type4`,`user_type`,`date_entered`,`date_time_entered`)VALUES('$StudID','$breakfast','$lunch','$snacks','$dinner','$type1','$type2','$type3','$type4','5','$today','$today_time')");
}
?>
 <script>

		alert("Inserted Successfully");

		</script>
        <?php
}
?>
 

<html>
<head>
<body>
<form name='frm' method='post' action="">
<table align='center' class='forumline' width='65%' cellpadding="0" cellspacing="0" border="1">

<tr><td colspan="2" align="center" class="head">Cafeteria</td></tr>
<tr><td width="35%" align="center">Time</td><td align="center">Type</td></tr>

<?php
$quer3=fetcharray(execute("select * FROM `cafeteria_det` where user='$StudID' and user_type=5"));
 if($quer3['type1']=='1')
  $chec1='checked';
  else
  $chec2='checked';
  ?>
  
<tr><td >&nbsp;<!--<input type="checkbox" name="breakfast" value="1" id="breakfast" <?=$breakfast?> onClick="reload1(1)">-->&nbsp;Breakfast</td>
<td nowrap align="center">&nbsp;<input type="radio" value="1" name="type1" onClick="reload()" <?=$chec1?>>&nbsp;Veg&nbsp;&nbsp;<input type="radio" value="2" onClick="reload()" name="type1" <?=$chec2?>>&nbsp;Non-Veg</td></tr>


 <?php
  if($quer3['type2']=='1')
  $chec3='checked';
  else
  $chec4='checked';
  ?>
<tr><td>&nbsp;<!--<input type='checkbox' name="lunch" value="2" id="lunch"<?=$lunch?>>-->&nbsp;Lunch</td>
    <td nowrap align="center">&nbsp;<input type="radio" value="1" name="type2" onClick="reload()" <?=$chec3?>>&nbsp;Veg&nbsp;&nbsp;<input type="radio" value="2" onClick="reload()" name="type2" <?=$chec4?>>&nbsp;Non-Veg</td></tr>

 
  <?php
  if($quer3['type3']=='1')
  $chec5='checked';
  else
  $chec6='checked';
  ?>
<tr><td >&nbsp;<!--<input type='checkbox' name="snacks" value="3" id="snacks"<?=$snacks?>>-->&nbsp;Snacks/Tea</td>
    <td nowrap align="center">&nbsp;<input type="radio" value="1" name="type3" onClick="reload()" <?=$chec5?>>&nbsp;Veg&nbsp;&nbsp;<input type="radio" value="2" onClick="reload()" name="type3" <?=$chec6?>>&nbsp;Non-Veg</td></tr>
  
 <?php
   if($quer3['type4']=='1')
  $chec7='checked';
  else
  $chec8='checked';
  ?>
<tr><td>&nbsp;<!--<input type='checkbox' name='dinner' value="4" id="dinner"<?=$dinner?>>-->&nbsp;Dinner</td>
    <td nowrap align="center">&nbsp;<input type="radio" value="1" name="type4" onClick="reload()" <?=$chec7?>>&nbsp;Veg&nbsp;&nbsp;<input type="radio" value="2" onClick="reload()" name="type4" <?=$chec8?>>&nbsp;Non-Veg</td></tr>
  
</table><br>
<div align="center"><input type=submit name='save' value='Submit' class='bgbutton'></div>
</form>
</body>
</head>
</html>