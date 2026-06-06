<?php
require_once("../db.php");
$Sel = $_POST['Sel'];
$button2 = $_POST['button2'];
$ty = $_POST['ty'];
$Type = $_REQUEST['Type'];
$msg=$_GET['msg'];
//print_r($_GET);
//print_r($_POST);

$sql =execute("SELECT * FROM lib_vendor_type");
$row=rowcount($sql);
?>
<HTML>
<HEAD>
<Script language="JavaScript">
function F2a99922b(){
document.lib_vendor_type.action = "lib_vendor_type.php?Type=add";
document.lib_vendor_type.submit();
}
function F8f45a264(){
document.lib_vendor_type.action = "lib_vendor_type.php?Type=modify";
document.lib_vendor_type.submit();
}
function F0bfb391b(){
document.lib_vendor_type.action = "lib_vendor_type.php?Type=delete";
document.lib_vendor_type.submit();
}
</script>
</HEAD>
<BODY>

<form method="POST" name="lib_vendor_type" action="lib_vendor_type.php">
<table border="0" width="47%" class=forumline align=center colspan='2'>
<tr><td align="center" Class="head" colspan=2>Add Modify Vendor Type</td></tr>
<?php
if($row > 0)
{
?>
<tr>
<td align="center" CLASS="rowpic">Select</td>
<td align="center" CLASS="rowpic">Type</td>
</tr>
<?php
for($i=0;$i<$row;$i++){
$r = fetcharray($sql,$i);
?>
<tr>
<td align="center" class="CBody"><input type="checkbox" name="Sel[]" value="<?=$r["id"]?>"><small></small></font></td>
<td align="center" class="CBody"><input type="text" name="<?=$r["id"]?>ty" size="35" value="<?=$r["type"]?>"></td>
</tr>
<?php
}
?>
<tr>
<td colspan='2' align="center" ><input type="button" value="Modify" onClick="F8f45a264()" id=button2 name=button2 class=bgbutton></td>
<!-- <td width="100" align="left" valign="top"><input type="button" value="Delete" onclick="F0bfb391b()" id=button1 name=button1></td> -->
</tr>
<?php
}
?>
<tr>
<td colspan='2'>&nbsp;</td>
</tr>
<tr>
<td colspan='2' align="center" CLASS="rowpic">Type</td>
</tr>
<tr>
<td colspan='2' align="center" class="CBody"><input type="text" name="ty" size="40"></td>
</tr>
<tr>
<td colspan='2' align="center"><input type="button" value="Add" onClick="F2a99922b()" class=bgbutton></td>
</tr>
</table>
<?php 
echo "<p align='center'>$msg</p>";
?>
</form>
</BODY>
</HTML>