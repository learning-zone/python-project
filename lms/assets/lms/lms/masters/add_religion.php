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
	document.form1.action="Alterreligion.php?Types=Mod";
	document.form1.submit();
}
</script>
</head>
<body font-size="10" class='bodyline'>
<form Name="Addreligion" action="Add_religion1.php" method="GET">
<table class='forumline' align=center>
<tr><td class="head" align='center'><font size="2">Manage Religion</font></td></tr>
<tr><td class="rowpic" align="center">Religion</td></tr>
<tr><td class="CBody" align="center">
<input type="text" size="20" name="cname" onKeyDown="return check(event)"></td></tr></table>
<br>
<div align=center><input type="Submit" value="ADD" class='bgbutton'></div>
</form>
<?php
$query = "SELECT *  FROM religion";
$rs = execute($query);
$row=rowcount($rs);
if($row)
{
	?>
	<form method="post" id="form1" name="form1"><?php echo $msg?>
	<table class='forumline' align=center>
	<tr><td Class="head" colspan=3 align='center'><font size="2">Modify Religion</font></td></tr>
	<tr><td class="rowpic">Select</td><td class="rowpic" align="center">Religion</td></tr>
	<?php
	for($i=0;$i<$row;$i++)
	{
		$r = fetchrow($rs);
		$exe=execute("select * from religion ");
		
		$exe1=fetcharray($exe);
		?>
		<tr><td class="CBody" align="center"><input type="checkbox" name="rid[]" Value="<?php echo $r[0]?>"></td>
		<td class="CBody">
		<input type="text" size=30 name="RName<?php echo $r[0]?>" value="<?php echo $r[1]?>" onKeyDown="return check(event)">
		</td></tr>
		<?php
	}
	?></table>  <br>
	<div align=center>
	<input type="button" onClick="EditClick()" value="Modify" class='bgbutton'>
	</div>
	
	<?php
}
else
{
	echo "<p align=\"left\"><b><font face=\"Arial\">No Religion Names Are Present</font></b></p>";
}
?>
</form>
</body>
</html>

