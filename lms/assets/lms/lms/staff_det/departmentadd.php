<?php
session_start();
require("../db.php");
$Types = $_POST['Types'];

$sdept = $_POST['sdept'];
$dcode = $_POST['dcode'];
$sgid = $_POST['sgid'];
$sgName = $_POST['sgName'];
$DCode = $_POST['DCode'];

?>
<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<script language="javascript">
function F66ada25c()
{
var chkrs = document.getElementsByName('sgid[]');
var chkcnt = 0;
for(i=0;i<chkrs.length;i++){
	if(chkrs[i].checked){
		chkcnt++;
		var cre1 = 'document.form1.sgName'+chkrs[i].value+'.value';
		var cre2 = 'document.form1.DCode'+chkrs[i].value+'.value';
		if(eval(cre1)==''){
			alert("Department Name cannot be blank");
			return false;
		}
		if(eval(cre2)==''){
			alert("Department Code cannot be blank");
			return false;
		}
	}
}
if(chkcnt==0){
	alert("please select a check box to modify");
	return false;	
}
document.form1.action="alterdepartment.php?Types=Mod";
document.form1.submit();
}
function F1294fd5c()
{
document.form1.action="alterdepartment.php?Types=Del";
document.form1.submit();
}
function activate()
{
document.changestatus.action="alterdepartment.php?Types=Act";
document.changestatus.submit();
}
function validate_add(){
	if(document.addsgroup.sdept.value==''){
		alert("Please provide a Department Name");
			document.addsgroup.sdept.focus();
			return false;
	}
	if(document.addsgroup.dcode.value==''){
		alert("Please provide a Department Code");
			document.addsgroup.dcode.focus();
			return false;
	}
	return true;
}
</script>
</head>
<body>
<form Name="addsgroup" action="adddepartment.php" method="Post">
<table class='forumline'align='center' width="90%">
<tr><td Class="Head" align=center colspan=4 >ADD Department</td></tr>
<tr class='head'>
<TD align='center' class='row3'>Department Name</td>
<TD align='center' class='row3'>Department Code</td>
</tr>
<tr>
<td align="center">&nbsp;&nbsp;&nbsp;<input type="text" size=20 name="sdept"></td>

<td align="center">&nbsp;&nbsp;&nbsp;<input type="text" size=5 maxlength="5" name="dcode">
</td></tr>
</table>
<br>
<div align="center">
<input type="Submit" value="ADD" class='bgbutton' onClick="return validate_add();"></td>
</div>
</form>
<?php
$sql1 = "SELECT * FROM dept_no where status=1 order by dept";
$rs = execute($sql1);
$num = rowcount($rs);
if($num){
?>
<form name="form1" id="form1" method="post"  >
<table width="62%" align=center>
</TABLE>
<table class="forumline" align=center width=90%>
<tr><td Class="Head" align=center colspan=4>Modify Department</td></tr>
<tr ><TD align="center" class='row3'> Sel.</td><TD align="center" class='row3'>Department Name</td>
<TD align="center" class='row3'>Department Code</td>
</tr>
<?php
for($i=0;$i<$num;$i++)
{
	if($i%2)
	echo "<tr >";
	else
	echo "<tr class='clsname'>";
$r = fetcharray($rs,$i);
?>
<td align="center"><input type="checkbox" name="sgid[]" Value="<?=$r["dpt_id"]?>"></td>
<td align="center"><input type="text" size=30 name="sgName<?=$r["dpt_id"]?>" value="<?=$r["Dept"]?>"></td>
<td align="center"><input type="text" size="5" maxlength="5" name="DCode<?=$r["dpt_id"]?>" value="<?=$r["dept_code"]?>"></td>
</tr>

<?
}
?>
</table>
<br>
<div align="center">
<input Type="Button" Value="Modify" onClick="F66ada25c()" class="bgbutton">
</div>
<?php
	}
?>
<?php
/*
if($msg!=''){
?>
<script type="text/javascript">
	alert("<?= @$msg ?>");
</script>
<?php } ?>
<?php
if($_GET['msg_upd']=='ok'){
?>
<script type="text/javascript">
	alert("Update Success !!!!");
	//alert("yes");
</script>
<?php } ?>
<?php
if($_GET['msg_dup']=='ok'){
?>
<script type="text/javascript">
	alert("Update failure. Duplicate entries not allowed !!!!");
</script>
<?php }
*/
?>
</form>
</body>
</html>