<html>
<head>
<?php
session_start();
include("../db.php");
include("../urlaccess.php");
?>
<script language="javascript">
function activate()
{
	document.form1.action="alterfeecat.php?Types=Act";
	document.form1.submit();
}
function EditClick()
{
	document.form1.action="alterfeecat.php?Types=Mod";
	document.form1.submit();
}
function DeleteClick()
{
	document.form1.action="alterfeecat.php?Types=Del";
	document.form1.submit();
}
function adddata()
{
	if(document.form1.feename.value=='')
	{
		alert("Please Enter Fee Category");
		return false;
	}
	else
	{
		document.form1.action="alterfeecat.php?Types=Add";
		document.form1.submit();
	}
}
</script>
<title></title>
</head>
<body>
<form method="post" name="form1">
<?php
if($msg!="")
	echo "<div><font color='brown' size='3'><b>$msg</b></font></div><br>";
if($act==1)
{
	?>
	<table class=forumline align=center width='50%'>
	<tr><td Class="head" align=center colspan=2>Add New Fee Category Details</td></tr>
	<tr height='20'><td class="rowpic" align=center><b>Fee Category Name</b></td>
	<td valign="top" align=left><input type="text" size="30" name="feename"></td></tr>
	<tr><td align=center colspan=2><input type="button" value="Add" class=bgbutton onClick = "adddata()"><br><div align='right'><font color='brown' size='3'><b><a href='feecatadd.php?act=2'>MODIFY</a>&nbsp;&nbsp;&nbsp;&nbsp;<b></font></div></td></tr>
	</table><br>
	<?php
}
else
{
	$sql = "SELECT catid,cat_name FROM fee_cat WHERE status=1 ORDER BY cat_name ASC";
	$rs = execute($sql);
	$rc = rowcount($rs);
	if($rc)
	{
		?>
		<table class=forumline align=center width='50%'>
		<tr><td Class="head" align=center colspan=2>Modify Fee Category Details</td></tr>
		<tr height='20'><td class="rowpic" align=center><b>Select</b></td>
		<td class="rowpic" align=center><b><font face="Arial">Fee Category Name</b></td></tr>
		<?php
		while($r = fetcharray($rs))
		{
			?>
			<tr><td align="center" class="cbody" align=center><input type="checkbox" name="fid[]" value="<?=$r["catid"]?>"></td>
			<td class="cbody" align=left><input type="text" size="50" name="fName<?=$r["catid"]?>" value="<?=$r["cat_name"]?>"></td></tr>
			<?php
		}
		?>
		<tr><td colspan="2" align="center"><input class=bgbutton Type="Button" Value="    Modify    " onclick="EditClick()" class='cbrown'><br><div align='right'><font color='brown' size='3'><b><a href='feecatadd.php?act=1'>ADD NEW</a>&nbsp;&nbsp;&nbsp;&nbsp;<b></font></div></td></tr></table>
		<?php
	}
	else
		echo "<div><font color='brown' size='3'><b>No Fee Category added..</b></font></div>";
}
?>
</form>
</body>
</html>