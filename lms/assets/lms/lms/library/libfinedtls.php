<?php
	require_once("../db.php");	
	$flag = $_POST['flag']; 
	$id = $_POST['id'];
	$amt1 = $_POST['amt1'];
	$daysto1 = $_POST['daysto1'];
	$amt2 = $_POST['amt2'];
	$daysto2 = $_POST['daysto2'];
	$amt3 = $_POST['amt3'];
	$save = $_POST['save'];

	$fnn100=execute("select * from lib_finedtls");
	$rr=fetcharray($fnn100);
	if(rowcount($fnn100)==0)
	$nnmm="Save";
	else
	$nnmm="Modify";

if(isset($_POST['save']))
{
	$fnn11=execute("select * from lib_finedtls");
	if(rowcount($fnn11)==0)
		{
			
			execute("insert into lib_finedtls values('',$daysto1,$daysto2,$amt1,$amt2,$amt3)");
		}
	else
		{
			execute("update lib_finedtls set daysfrom=$daysto1,daysto=$daysto2,fine1=$amt1 ,fine2=$amt2,fine3=$amt3 ") or die(mysql_error());
		}
	$fnn100=execute("select * from lib_finedtls");
	$rr=fetcharray($fnn100);
}
?>
<html>
<head></head>
<body>
<form action="" method="post" >
<input type='hidden' name='flag' value='A'>
<input type='hidden' name='id'>
<table class='forumline' align='center'>
	<tr>
		<td colspan='6' align='center' class='head'>Library Fine Details After Due Date</td>
	</tr>
	<tr height='40'>
		<td size='3' align='right'>Rs.&nbsp;&nbsp;</td>
		<td>&nbsp;<input type='text' name='amt1' size='5' value='<?php echo $rr[fine1] ?>'>&nbsp;&nbsp;per day&nbsp;&nbsp;</td>
		<td>&nbsp;Up To&nbsp;</td>
		<td>&nbsp;<input type='text' name='daysto1' size='5' value='<?php echo $rr[daysfrom] ?>'>&nbsp;&nbsp;days&nbsp;&nbsp;</td>
	</tr>
	<tr height='40'>
		<td>&nbsp;&nbsp;After&nbsp;&nbsp;<?php echo $rr[daysfrom] ?>&nbsp;&nbsp;Days Rs.&nbsp;&nbsp;</td>
		<td>&nbsp;<input type='text' name='amt2' size='5' value='<?php echo $rr[fine2] ?>'>&nbsp;&nbsp;per day&nbsp;&nbsp;</td>
		<td>&nbsp;Up To&nbsp;</td>
		<td>&nbsp;<input type='text' name='daysto2' size='5' value='<?php echo $rr[daysto] ?>'>&nbsp;&nbsp;days&nbsp;&nbsp;</td>
	</tr>
	<tr height='40'>
		<td>&nbsp;&nbsp;After&nbsp;&nbsp;<?php echo $rr[daysto] ?>&nbsp;&nbsp;Days Rs.&nbsp;&nbsp;</td>
		<td>&nbsp;<input type='text' name='amt3' size='5' value='<?php echo $rr[fine3] ?>'>&nbsp;&nbsp;per day&nbsp;&nbsp;</td>
		<td colspan='2'>&nbsp;&nbsp;</td>
	</tr>
	<tr>
	</tr>
</table>
<br>
		<div align='center'><input type='submit' name='save' value='<?php echo $nnmm ?>' class='bgbutton'></div>
</form>
</body>
</html>