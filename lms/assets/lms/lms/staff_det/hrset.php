<html>
<head>
<script>
function reloadme()
	{
		document.frm.action="hrset.php";
		document.frm.submit();
	}
</script>
</head>
 <?php
	session_start();
	include("../db.php");
	//print_r($_POST);
	
	$accyear=$_SESSION['AcademicYear'];
	$hr=$_POST['hr'];
	
	?>
  <?
if($_POST['save'])
{
	$hr=$_POST['hr'];
	$testss="update `staff_leave_hr` set status=0";
		execute($testss);
	for($j=0;$j<sizeof($hr);$j++)
	{
		$coacid=$hr[$j];
			
		$Sql66=execute("select `id` from `staff_leave_hr` where hr_id='$coacid'");
		if(rowcount($Sql66)>0)
		{

			
			$sql33="update `staff_leave_hr` set `user`='$user',status=1 where hr_id='$coacid'";
			execute($sql33);
		}
		else
		{
			
			execute("INSERT INTO `staff_leave_hr` (`user`, `hr_id`, `acc_year`, `status`) VALUES ('$user','$coacid','$accyear','1')");
		}
		
	}
	 ?>
         <script language="javascript">
		 alert("Updated Sucessfully");
		 window.opener.location.href='leavesetup.php';
		window.close();
         </script>
         <?php
}
?>  
<body>
<form Name="frm"  method="post">     
<input type="hidden" name="pfdate" value="<?=$pfdate?>"/>
<input type="hidden" name="ptdate" value="<?=$ptdate?>"/>
<table  align='center' border="0" width="10%" cellpadding="0" cellspacing="0">
<tr>
<td align='center' width="100%" height="100%">
<div style="overflow: auto;height:350px; width:350px;" align="center">
<table  align='center' border="1" width="100%" cellpadding="0" cellspacing="0">
<tr><td Class="head" align='center' colspan="3">Assign HR</td></tr
	><tr>
	<td align="center" class="rowpic">ID</td>
	<td align="center" class="rowpic">Name</td>
    <td align="center" class="rowpic">Check</td>
    </tr>
	<?php
	$stafff=execute("select a.id,a.slno,a.f_name,a.s_name from staff_det a,users b where  b.srid=a.id order by a.f_name");
	while($stafff1=fetcharray($stafff))
	{
		
		$vierts=fetcharray(execute("SELECT hr_id FROM `staff_leave_hr` where `user`='$user' and `status`=1 and hr_id='$stafff1[0]'"));
	
		if($vierts[0])
		$check11='checked';
		else
		$check11='';

	?>
	<tr>
	<td align="center"><?=$stafff1[1]?></td>
	<td>&nbsp;<?=$stafff1[2]?>&nbsp;<?=$stafff1[3]?></td>
    <td align="center"><input type="checkbox" name="hr[]" value="<?=$stafff1[0]?>" <?=$check11?>></td>
    </tr>
    <?
	
	}
	?>
</table>
</div>
</td>
</tr>
</table>

<br>
<div align='center'><input type='submit' name='save' value='Submit' class='bgbutton'></div>
<br>
</form>
</BODY>
</HTML>
