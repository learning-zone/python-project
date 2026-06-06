<html>
<!--This file is written by :shashidhar on 22-09-2006
reason to select asset subgroup and display the reports according to their subgroup
-->
<head>
<script language='javascript'>
function shashi()
{
	document.frm.action="AssetwiseReportxx.php";
	document.frm.submit();
}
</script>
<head>
<?
include("../db.php");
$print = $_POST['print'];
$subass = $_GET['subass'];
$filename = $_POST['filename'];

?>
<form name='frm' method='get'>
<table border='1' align='center' widht='100%' class='forumline'>
<tr><td class='head' align='center'>AssetWise Report</td></tr>
<tr><td><select name='subass' onchange='shashi()'>
<option value='0'> >>Select Subgroup<< </option>
<?
$rt="select *from asset_sub_group";
$rgb=execute($rt);
while($ruu=fetcharray($rgb))
{
	if($ruu[0]==$subass)
	{
		echo "<option value='$ruu[0]' selected>$ruu[1]</option>";
	}
	else
	{
		echo "<option value='$ruu[0]'>$ruu[1]</option>";
	}
}
?>
</select>
</table>
</form>
</html>
