<html>
<head>
<script>
function reloadme()
	{
		document.frm.action="staff.php";
		document.frm.submit();
	}
</script>
</head>
 <?php
	session_start();
	include("../db.php");
	
	
	$accyear=$_SESSION['AcademicYear'];
	$pfdate=$_REQUEST['pfdate'];
	$ptdate=$_REQUEST['ptdate'];
	
	$manager=$_POST['manager'];
	
	?>
  <?
if($_POST['save'])
{
	$manager=$_POST['manager'];
	
	for($j=0;$j<sizeof($manager);$j++)
	{
		$coacid=$manager[$j];
			
		$Sql66=mysql_query("select `id` from `staff_leave_notify` where `user`='$user' and `f_date`='$pfdate'  and `t_date`='$ptdate' and `status`=1 and notify_id='$coacid'");
		if(mysql_num_rows($Sql66)>0)
		{

			$sql33="update `staff_leave_notify` set notify_id='$coacid' where `user`='$user' and `f_date`='$pfdate'  and `t_date`='$ptdate' and `status`=1";
			mysql_query($sql33);
		}
		else
		{
			
			mysql_query("INSERT INTO `staff_leave_notify` (`user`, `notify_id`, `f_date`, `t_date`, `acc_year`, `status`) VALUES ('$user','$coacid','$pfdate','$ptdate','$accyear','1')");
		}
		
	}
	 ?>
         <script language="javascript">
		 alert("Updated Sucessfully");
         </script>
         <?php
}
?>  
<body>
<form Name="frm"  method="post">     
<input type="hidden" name="pfdate" value="<?=$pfdate?>"/>
<input type="hidden" name="ptdate" value="<?=$ptdate?>"/>
<table  align='center' border="1" width="100%" cellpadding="0" cellspacing="0">
<tr><td Class="head" align='center' colspan="3">Staff List</td></tr
	><tr>
	<td align="center" class="rowpic">ID</td>
	<td align="center" class="rowpic">Name</td>
    <td align="center" class="rowpic">Check</td>
    </tr>
	<?php
	$stafff=mysql_query("select a.id,a.slno,a.f_name,a.s_name from staff_det a,users b where  b.srid=a.id order by a.f_name");
	while($stafff1=mysql_fetch_array($stafff))
	{
		
		$vierts=mysql_fetch_row(mysql_query("SELECT notify_id FROM `staff_leave_notify` where `user`='$user' and `f_date`='$pfdate'  and `t_date`='$ptdate' and `status`=1 and notify_id='$stafff1[0]'"));
	
		if($vierts[0])
		$check11='checked';
		else
		$check11='';

	?>
	<tr>
	<td align="center"><?=$stafff1[1]?></td>
	<td>&nbsp;<?=$stafff1[2]?>&nbsp;<?=$stafff1[3]?></td>
    <td align="center"><input type="checkbox" name="manager[]" value="<?=$stafff1[0]?>" <?=$check11?>></td>
    </tr>
    <?
	
	}
	?>
</table>
<br>
<div align='center'><input type='submit' name='save' value='Submit' class='bgbutton'></div>
<br>
</form>
</BODY>
</HTML>
