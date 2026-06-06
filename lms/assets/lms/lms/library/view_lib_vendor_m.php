<?php
require_once("../db.php");
//$Sel[] = $_POST['Sel'];
//r[id]
//$button2 = $_POST['button2'];
//$ty = $_POST['$ty'];
$Sel[] = $_POST['Sel'];
$button2 = $_POST['button2'];
$na = $_POST['na'];
$ad = $_POST['ad'];
$te = $_POST['te'];
$em = $_POST['em'];
$ur = $_POST['ur'];
$re = $_POST['re'];
$button3 = $_POST['button3'];
$type = $_POST['type'];
$Type = $_REQUEST['Type'];
$msg = $_GET['msg'];
//print_r($_GET);
//print_r($_POST);


$sql =execute("SELECT * FROM lib_vendor_type");
$row=rowcount($sql);
$sql = execute("SELECT * FROM lib_vendor_m ORDER BY name");
$row=rowcount($sql);
$sql1 =execute("SELECT * FROM lib_vendor_type");
$row1=rowcount($sql1);
?>
<HTML>
<HEAD>
<Script language="JavaScript">
function F2a99922b(){
document.lib_vendor_m.action = "lib_vendor_m.php?Type=add";
document.lib_vendor_m.submit();
}
function F8f45a264(){
document.lib_vendor_m.action = "lib_vendor_m.php?Type=modify";
document.lib_vendor_m.submit();
}
function F0bfb391b(){
document.lib_vendor_m.action = "lib_vendor_m.php?Type=delete";
document.lib_vendor_m.submit();
}
</script>
<BODY>

<form method="POST" name="lib_vendor_m" action="lib_vendor_m.php">
<table border="0" width="90%" cellspacing="1" cellpadding="0" align=center class=forumline colspan='10'>
<tr height='25'>
   <td colspan='10' class=head align=center>Add/Modify Vendor</td>
</tr>
<?php
if($row > 0)
{
?>
<tr>
	<td align="center" CLASS="rowpic">Select</td>
	<td align="center" CLASS="rowpic">Type</td>
	<td align="center" CLASS="rowpic">Name</td>
	<td align="center" CLASS="rowpic">Address</td>
	<td align="center" CLASS="rowpic">Telephone</td>
	<td align="center" CLASS="rowpic">E-Mail</td>
	<td align="center" CLASS="rowpic">URL</td>
	<td align="center" CLASS="rowpic">Remark</td>
</tr>
<?php
$sql = execute("SELECT * FROM lib_vendor_m ORDER BY name");
$row=rowcount($sql);
for($i=0;$i<$row;$i++)
	{
     $r = fetcharray($sql,$i);
?>
<tr>
	<td align="center" class="CBody"><input type="checkbox" name="Sel[]" value="<?=$r["id"]?>"><small></small></font></td>
	<td align="center" class="CBody"><select name="<?=$r["id"]?>ty" size="1">
	<?php
	$sql1 =execute("SELECT * FROM lib_vendor_type");
	$row1=rowcount($sql1);
	for($j=0;$j<$row1;$j++)
		{
			$r1 = fetcharray($sql1,$j);
			?>
			<?php
			if($r["type"] == $r1["id"])
			{
				?>
				<option value="<?=$r1["id"]?>" selected><?=$r1["type"]?></option>
				<?php
			}
			else
			{
				?>
				<option value="<?=$r1["id"]?>" ><?=$r1["type"]?></option>
				<?php
			}
		}
	?>
	</select></td>
	<td align="center" class="CBody"><input type="text" name="<?=$r["id"]?>na" value="<?=$r["Name"]?>" size="10"></td>
	<td align="center" class="CBody"><input type="text" name="<?=$r["id"]?>ad" value="<?=$r["address"]?>" size="10"></td>
	<td align="center" class="CBody"><input type="text" name="<?=$r["id"]?>te" value="<?=$r["telephone"]?>" size="10"></td>
	<td align="center" class="CBody"><input type="text" name="<?=$r["id"]?>em" value="<?=$r["email"]?>" size="10"></td>
	<td align="center" class="CBody"><input type="text" name="<?=$r["id"]?>ur" value="<?=$r["url"]?>" size="10"></td>
	<td align="center" class="CBody"><input type="text" name="<?=$r["id"]?>re" value="<?=$r["remark"]?>" size="10"></td>
</tr>
<?php
}
?>
<tr><td colspan=10>&nbsp;</td></tr>
<tr>
<td colspan='10' align="center"><input type="button" value="Modify" onClick="F8f45a264()" id=button2 name=button2 class=bgbutton></td>
<!-- <td align="center"><input type="button" value="Delete" onclick="F0bfb391b()" id=button1 name=button1></td> -->
</tr>
<?php
}
?>
<tr><td colspan=10>&nbsp;</td></tr>
<tr>
	<td align="center" CLASS="CHead">Type</td>
	<td align="center" CLASS="CHead">Name</td>
	<td colspan='2' align="center" CLASS="CHead">Address</td>
	<td align="center" CLASS="CHead">Telephone</td>
	<td align="center" CLASS="CHead">E-Mail</td>
	<td align="center" CLASS="CHead">URL</td>
	<td align="center" CLASS="CHead">Remark</td>
	<td></td>
</tr>
<tr>
	<td align="center" class="CBody"><select name="type" size="1">
	<?php
	$sql1 =execute("SELECT * FROM lib_vendor_type");
	$row1=rowcount($sql1);
	for($i=0;$i<$row1;$i++){
	$r1 = fetcharray($sql1,$i);
	?>
	<option value=<?=$r1["id"]?>><?=$r1["type"]?></option>
	<?php
	}
	?>
	</select></td>
	<td align="center" class="CBody"><input type="text" name="na" size="10"></td>
	<td align="center" colspan='2' class="CBody"><input type="text" name="ad" size="20"></td>
	<td align="center" class="CBody"><input type="text" name="te" size="10"></td>
	<td align="center" class="CBody"><input type="text" name="em" size="10"></td>
	<td align="center" class="CBody"><input type="text" name="ur" size="10"></td>
	<td align="center" class="CBody"><input type="text" name="re" size="10"></td>
	<td></td>
</tr>
<tr><td colspan=10>&nbsp;</td></tr>
<tr>
   <td colspan='10' align="center"><input type="button" value="Add" onClick="F2a99922b()" id=button3 name=button3 class=bgbutton></td>
</tr>
</table>
<?php 
echo "<p align='center'>$msg</p>";
?>
</form>
</BODY>
</HTML>