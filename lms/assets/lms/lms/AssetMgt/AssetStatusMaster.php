<html>
<?php

	session_start();

	include("../db.php");

	include("../urlaccess.php");

	$Types = $_POST['Types']; 

	$id = $_POST['id'];

$condition = $_POST['condition'];

$addconditions = $_POST['addconditions'];
if($_POST)
{
	$Types = $_POST['Types']; 

	$id = $_POST['id'];

$condition = $_POST['condition'];

$addconditions = $_POST['addconditions'];
	
}
if($_GET)
{
}
	

?>

<head><title>Asset Status Master</title>

<script language="JavaScript">
function deldata()
{
	document.form1.action="AlterAssetStatusMaster.php?Types=Del";
	document.form1.submit();
}


function EditClick()

{

document.form1.action="AlterAssetStatusMaster.php?Types=Mod";

document.form1.submit();

 }

</script>

</head>

<body background="../bg.gif">


<form Name="addasset" method="post" action="AddAssetStatusMaster.php">
<BR>
<table class="forumline" align=center width="50%">
<tr><td Class="head" colspan="4" align="center">Add Asset Status Master Details</td></tr>
<tr><td  align="center" Class="rowpic">Condition</td>

</tr>

<tr>

<td Class="cbody" align="center"><input type="text" size="25" name="condition"></td>

</tr>
</form>
</table><br>
<div align="center"><input type="Submit" name="addconditions" value="ADD" class="bgbutton"></div>


<?php

$query="select * from assetstatusmaster where status=1";

$result=execute($query);

$rowcount=rowcount($result);

$act=$_REQUEST['act'];
$msg=$_REQUEST['msg'];
if($_GET['msg']!='')
{
	?>
    <script language="javascript">
	alert("<?=$msg?>");
    </script>
    <?php
}
if($rowcount>0)

{

?>


<form method="post" id="form1" name="form1">
<br>
<table align="center" class="forumline" width="50%"><tr><td Class="head" colspan="4" align="center">Asset Status Master Details</td></tr>



<tr><td align="center" Class="rowpic">Select</td><td align="center" Class="rowpic"><b>Condition</b></td>

</tr>

<?php

for($i=0;$i<$rowcount;$i++)

{

$r=fetcharray($result,$i);

?>

<tr><td  align="center"><input type="checkbox" name="id[]" Value="<?=$r["id"]?>"></td>

<td Class="cbody" align="center"><input type="text" size=35 name="condition<?=$r[id]?>" value="<?=$r["conditions"]?>"></td>

<?php

}

?>

</table><br>
<div align="center"><input type="button" onClick="EditClick()" value="MODIFY" name="Mod" class="bgbutton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class='bgbutton' value="DELETE" onClick="deldata()">

</div>

<?php

}



?>


</form>


</body>

</html>

