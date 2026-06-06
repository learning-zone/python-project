<?php
session_start();
require_once("../db.php");

$media=$_POST['media'];
?>
<HTML>
<HEAD>
<script language="javascript">
function re_load()
{
	document.form1.action="stock_verification.php";
	document.form1.submit();
}
function frm_verify()
{
		var flag_status1;
		flag_status1 = confirm("Do you want to verify the stock details ??");
		if(flag_status1==true)
		{
			document.form1.action="verify_stock_details.php?=$media";
			document.form1.submit();
		}
}
</script>
</HEAD>
<form method="POST" name="form1" >
<table class=forumline align='center' width="47%">
<tr>
	<td class="head" align="center" colspan=2 >STOCK VERIFICATION</td>
</tr>
<tr>
	<td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Media&nbsp;&nbsp;&nbsp;</td>
<td>
<?php
$smedia =execute("SELECT * FROM lib_mediatype order by id");
$num = rowcount($smedia);
?>
<select size="1" name="media" onChange="re_load()">
<option value="0" selected>Select Media </option>
<?php
for($i=0;$i<$num-1;$i++)
{
	$r = fetcharray($smedia,$i);
	if($r[id]==$media)
	{
		$sel="selected";
		$media_name=$r[name];
	}
	else
		$sel="";
	?>
	<option value="<?php echo $r["id"]?>" <?php echo $sel?>><?php echo $r["name"]?></option>
	<?php
}
?>
</select></td></tr>
<?php
if($media !=0 || $media !='')
{
?>
 
<?php
}
?>
</table>
<br>
<div align=center><input type='submit' value='<<  Verify Stock  >>' name='verify' onClick='frm_verify()' class='bgbutton'></div>
</form>
</html>