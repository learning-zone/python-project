<?php
require_once("../db.php");
$acc_no=$_POST['acc_no'];
$media=$_POST['media'];
$acc=$_POST['acc'];
if($acc_no!='')
{
$sel=execute("select * from phy_lib_stock where acc_no='$acc_no'");
if(rowcount($sel)>0)
echo "<script>alert('Enter Accession Number')</script>"; 
else
{
	$str=execute("insert into phy_lib_stock values('$acc_no','$media')");
	echo "Accession No $acc_no  is inserted "; 
}
}
else
{
	$sql=execute("SELECT * FROM lib_mediatype order by id");
}
?>
<html>
<head>
<script type="text/javascript">
function reload()
{
	document.frm.action='phystkrep.php';
	document.frm.submit();
}
function accnum()
{
	document.frm.acc.focus();
}
</script>
<!--
<style type="text/css">
.tab{
padding-top:150px;
}
</style>-->
</head>
<body onLoad="accnum()">

<!--<div class="tab">-->
<form name="frm" method="post">
<table align="center" class="forumline" cellpadding="0" cellspacing="0" width="47%">
<?php
if($media=="")
{

?>
<tr><td colspan="3" align="center" class="head">Physical Stock Verification</td></tr>
<tr><td align="right">Media Type &nbsp;:</td>
<td><select name="media" onChange="reload()">
<option value="">Select</option>
<?php
while($rs=fetcharray($sql))
{
	echo "<option value='$rs[name]'>$rs[name]</option>";
}
?>
</select></td></tr>
<?php
}
else
{
?>
<tr><td colspan="3" align="center" class="head">Physical Stock Verification</td></tr>
<tr><td align="right">Media Type &nbsp;</td><td align="center">:</td>
<td><input type="text" name="media" value="<?=$media?>" onChange="reload()" readonly></td></tr>
<tr><td nowrap align="right">Enter Acc No &nbsp;</td><td align="center">:</td>
<td><input type="text" name="acc_no" value="" onChange="reload()" title="Enter Accession Number">
</td></tr>
 <?php
 }
 ?>
</table>
<br>
<div align="center"><input type="button" value="ADD" onClick="" class="bgbutton" ></div>
</form>

</div>
</body>
</html>
