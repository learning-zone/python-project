<?php
include("../db.php");
//include("../urlaccess.php");
$member = $_POST['member'];
$B1 = $_POST['B1'];

?>
<HTML>
<HEAD>
<Script language="JavaScript">
function val()
{
	if(document.frm.member.value=='-1')
	{
		alert("Please Select Member");
		return false;
	}
	else
	{
		document.frm.submit();
		return true;
	}
}
function reload()
{
	document.frm.action='mem_circulate.php';
	document.frm.submit();
}
</script>
<?php
//This query is used to select the details from library_name table
$sql = "SELECT * FROM library_name";
$libname = execute($sql);
$row=rowcount($libname);
?>
</HEAD>
<BODY>
<form method="POST" action="mem_circulate1.php" name="frm" onsubmit='return val()'>
<table align=center class=forumline width="47%">
<tr><td  align=center class=head colspan=2>Member Circulation Parameters</td></tr>
<tr><td align="right">Member Type&nbsp;&nbsp;&nbsp;</td>
<td><p align="left"><select size="1" name="member" onchange='reload()'>
<option value="-1">Select Member Type</option>
<?php
$sel1="";
$sel2="";
$sel3="";
if($member=='1')
{
	$sel1='selected';
}
elseif($member=='2')
{
	$sel2='selected';
}
elseif($member=='3')
{
	$sel3='selected';
}
?>
<option value="1" <?php echo $sel1?>>&nbsp;&nbsp;Student</option>
<option value="2" <?php echo $sel2?>>&nbsp;&nbsp;Staff</option>
<option value="3" <?php echo $sel3?>>&nbsp;&nbsp;Department</option>
</select></td></tr>
<br>
</tr>
</table>
<br>
<div align=center>
<input type="submit" value="Submit" name="B1" class=bgbutton ></div>
</form></BODY></HTML>