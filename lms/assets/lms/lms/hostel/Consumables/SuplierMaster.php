<?php
session_start();
require("../../db.php");
$vendor_id = $_GET['vendor_id'];
$vendor_name = $_GET['vendor_name'];
$address = $_GET['address'];
$contact_person = $_GET['contact_person'];
$phone = $_GET['phone'];
$fax = $_GET['fax'];
$email = $_GET['email'];
$remarks = $_GET['remarks'];
$Types = $_GET['Types'];
?>
<html>
<head>
<title>Add / Modify Vendor Details</title>
<SCRIPT LANGUAGE ="JavaScript">
function EditClick()
{
document.form1.action="AlterVendor.php?Types=Mod";
document.form1.submit();
}
</script>
</head>

<body>
<?php
$query="select * from h_suplier_master order by name";
$result=execute($query);
$rowcount=rowcount($result);
if($rowcount>0)
{
?>
<form method=GET id=form1 name=form1>
<table class=forumline align=center width="90%"><tr><td Class="head" colspan="9" align=center>Vendor Master</td></tr>
<tr><td align=center Class="rowpic"><b>Select</b></td><td align=center Class="rowpic"><b>Name</b></td>
<td Class="rowpic" align=center><b>Address</b></td><td Class="rowpic" align=center><b>Contact Person</b></td>
<td Class="rowpic" align=center><b>Phone No</b></td><td Class="rowpic" align=center><b>Fax</b></td>
<td Class="rowpic" align=center><b>Email</b></td>
<td Class="rowpic" align=center><b>Suppliers For</b></td>
<td Class="rowpic"></td>
</tr>
<?php
for($i=0;$i<$rowcount;$i++)
{
$r=fetcharray($result,$i);
if($i%2)
               echo "        <tr > ";
               else
               echo "        <tr class='clsname'> ";
?>

<td Class="cbody" align="center"><input type="checkbox" name="vendor_id<?=$r['id']?>" Value="<?=$r['id']?>"></td>
<td Class="cbody" align="center"><input type="text" size=23 name="vendor_name<?=$r['id']?>" value="<?=$r['name']?>" onKeyDown="return checkit(event)"></td>
<td Class="cbody" align="center"><textarea name="address<?=$r['id']?>" cols=25 rows=3 wrap><?=$r['address']?></textarea></td>
<td Class="cbody" align="center"><input type="text" size=15 name="contact_person<?=$r['id']?>" value="<?=$r['contact_person']?>" onKeyDown="return checkit(event)"></td>
<td Class="cbody" align="center"><input type="text" size=10 name="phone<?=$r['id']?>" value="<?=$r['phone']?>" onKeyDown="return check(event)"></td>
<td Class="cbody" align="center"><input type="text" size=10 name="fax<?=$r['id']?>" value="<?=$r['fax']?>" onKeyDown="return check(event)"></td>
<td Class="cbody" align="center"><input type="text" size=25 name="email<?=$r['id']?>" value="<?=$r['email']?>"></td>
<td Class="cbody" align="center"><input type="text" size=25 name="remarks<?=$r['id']?>" value="<?=$r['remarks']?>"></td>
<td Class="cbody" align="center"><input type = "hidden" size=25 name="Types" value="Mod"></td>
</tr>

<?php
//here
$Types = "Mod";
}
?>
</table>
<br>
<center><input type="button" onClick="EditClick()" value="Modify" class=bgbutton>
</center>

</form>
<?php
}
else
{
echo "<p align=\"left\"><b>No Vendor Information Present</b></p>";
}
?>
<form Name=additem action="AddVendor.php" method=GET>
<table claSS=forumline  align="center" width="90%">
<tr><td class=rowpic>Name</td><td class=rowpic>Address</td><td class=rowpic>Contact Person</td><td class=rowpic>Phone</td><td class=rowpic>Fax</td><td class=rowpic>Email</td><td class=rowpic>Suppliers For</td>
</tr>
<tr><td align="center"><input type=text size=15 name="vendor_name" onKeyDown="return checkit(event)"></td>
<td align="center"><textarea cols=25 rows=5 name="address"></textarea></td>
<td align="center"><input type=text size=18 name="contact_person" onKeyDown="return checkit(event)"></td>
<td align="center"><input type=text size=10 name="phone" onKeyDown="return check(event)"></td>
<td align="center"><input type=text size=10 name="fax" onKeyDown="return check(event)"></td>
<td align="center"><input type=text size=20 name="email"></td>
<td align="center"><input type=text size=20 name="remarks"></td></tr>
</table>
<br>
<center><input type=Submit value=ADD class=bgbutton></center>

</form>
</body>
</html>