<?php
session_start();
include("../db.php");
?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">
var KEY_LEFT  = 268762961;
var KEY_RIGHT = 268762963;
function EditClick()
{
	document.form1.action="Alterlang.php?Types=Mod";
	document.form1.submit();
}
</script>
</head>
<body font-size="10" class='bodyline'>
<form Name="Addlanguage" action="addlanguage.php" method="GET">
<table class='forumline' align=center width="50%" border="1">
<tr><td class="head" align='center'><font size="2">Manage Language </font></td></tr>
<tr><td class="row3" align="center">Language</td></tr>
<tr><td class="CBody" align="center"><input type="text" size="40" name="language" onKeyDown="return check(event)"></td></tr>
<tr height='40'><td align=center><input type="Submit" value="ADD" class='bgbutton'></td></tr>
</table>
</form>
<?php
$query = "SELECT *  FROM language  order by lang";
$rs = execute($query);
$row=rowcount($rs);
if($row)
{
	?>
	<form method="post" id="form1" name="form1"><?php echo $msg?>
	<table class='forumline' align=center width="50%" border="1">
	<tr><td Class="head" colspan="2"  align='center'><font size="2">Modify Language</font></td></tr>
	<tr><td class="row3">Select</td><td class="row3" align="center">Language</td></tr>
	<?php
	for($i=0;$i<$row;$i++)
	{
		$r = fetchrow($rs);
		$exe=execute("select * from language where id='$r[0]'");
		$exe1=fetcharray($exe);
		?>
		<tr><td class="CBody" align="center"><input type="checkbox" name="rid[]" Value="<?php echo $r[0]?>"></td>
		<td class="CBody" align="center">
		<input type="text" size=40 name="RName<?php echo $r[0]?>" value="<?php echo $r[1]?>" onKeyDown="return check(event)">
		</td></tr>
		<?php
	}
	?>
	<tr height='40'><td colspan=3 align=center>
	<input type="button" onClick="EditClick()" value="Modify" class='bgbutton'>
	</td></tr>
	</table>  
	<?php
}
else
{
	echo "<p align=\"left\"><b><font face=\"Arial\">No Languages Are Present</font></b></p>";
}
?>
</form>
</body>
</html>

