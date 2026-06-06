<?php
session_start();
require("../db.php");
$sgroup = $_POST['sgroup'];
$Types = $_POST['Types'];

$sgid = $_POST['sgid'];
$sgName = $_POST['sgName'];
//if($_GET['msg_upd']=='ok')
//	$msg = "**** Update Successfull ****";
?>
<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">

<script language="javascript">
	function EditClick()
		{
			document.form1.action="alterstafftype.php?Types=Mod";
			document.form1.submit();
		 }

	function activate()
		{
			document.changestatus.action="alterstafftype.php?Types=Act";
			document.changestatus.submit();
		}

	function DeleteClick()
		{
			document.form1.action="alterstafftype.php?Types=Del";
			document.form1.submit();
		}

</script>
</head>

<body>
<?php
$sql1 = "SELECT * FROM staff_status where status =1";
$rs = execute($sql1);
$num = rowcount($rs);

if($num)
{?>
	
	<form method="post" id="form1" name="form1">

	<table width="225" align=center ></table>
   
	<table class="forumline" align=center width="35%">
	<tr>
		<td Class="head" align=center colspan=3 >Add Staff Type</td>
	</tr>
	<tr>
		<TD Class="row3"> Sel.</td><TD Class="row3">Staff Type</td>
	</tr>
		<?php
			for($i=0;$i<$num;$i++)
				{
					if($i%2)
               echo "        <tr > ";
               else
               echo "        <tr class='clsname' > ";
					$r = fetcharray($rs,$i);
					?>
					
					<td align="center"><input type="checkbox" name="sgid[]" Value="<?=$r["id"]?>"></td>
					<td align="center"><input type="text" size=20 name="sgName<?=$r["id"]?>" value="<?=$r["name"]?>"></td>
					</tr>
					<?
				}
		?>
	</table>
    
    <br>
    <div align="center">
			<input Type="Button" Value="Modify" onClick="EditClick()" class="bgbutton">
	</div>	
	</form>
    
	<?php
}
?>
<form Name="addsgroup" action="addstaff_type.php" method="Post">
<br>
<table class="forumline" align=center width="35%">
	<tr>
		<td Class="head" align=center colspan=3 >Add Staff Type</td>
	</tr>
<tr>
	<TD Class="row3" align=center colspan=2>Staff Type</td>
</tr>
<tr>
	<td align=center colspan=2>
		<input type="text" size=20 name="sgroup"></td>
</tr>
</table>
<br>
	<div align="center">
    <input type="Submit" value="ADD" class="bgbutton">
</div>

<?php
$sql = "SELECT * FROM staff_status WHERE status=0";
$rs = execute($sql);
$num = rowcount($rs);
if($num){
?>
<?php
	}
?>
</form>
</body>
</html>