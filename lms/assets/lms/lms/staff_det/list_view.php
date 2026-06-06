<?php
include('../db.php');
$sql = "SELECT * from activity_log";
$rs = mysql_query($sql);
?>
<table class='forumline' align='center' width="98%" border="1" cellpadding="0" cellspacing="0">
<tr>
	<td colspan="10" class="head" align="center">Login DETAILS</td>
</tr>
<tr>
	<td class="row3" nowrap="nowrap">id</td>
	<td class="row3" nowrap="nowrap">Date Entered (GMT)</td>
	<td class="row3" nowrap="nowrap">Time Idle</td>
	<td class="row3" nowrap="nowrap">Current Time</td>
	<td class="row3" nowrap="nowrap">Username</td>
	<td class="row3" nowrap="nowrap">Login Time</td>
</tr>
<?php
while($row = mysql_fetch_array($rs)){
	$id = $row['id'];
	$date_entered = $row['date_entered'];
	$timeIdle = $row['timeIdle'];
	$currentTime = $row['currentTime'];
	$userName = $row['userName'];
	$loginTime = $row['loginTime'];	
	?>
	<tr>
		<td><?php echo $id;?></td>
		<td><?php echo $date_entered;?></td>
		<td><?php echo $timeIdle;?></td>
		<td><?php echo $currentTime;?></td>
		<td><?php echo $userName;?></td>
		<td><?php echo $loginTime;?></td>
	</tr>
	<?php
}
?>
</table>