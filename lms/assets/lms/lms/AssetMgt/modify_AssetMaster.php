<html>
</body>
<script language="JavaScript">
function EditClick()
{

	
	document.frm.action="modify_Asset_Master.php";
	document.frm.submit();

}
function reload()
{
document.frm.action="modify_AssetMaster.php";
document.frm.submit();
}
</script>
<script language=javascript>
function dispvalue1()
{
	//alert(document.frm.slno.value);
var a1=document.frm.asset.value;
var x1 = window.open("open_asset_list.php?asset="+a1,"width=500,height=500,scrollbars=yes,status=no,toolbar=no,menubar=no,sizeable=0,left=550,top=150");

}
</script>
<?php
session_start();
include("../urlaccess.php");
include("../db.php");
?>
	<form method=post id=form1 name=frm action='modify_Asset_Master.php'>
	<table class="forumline" align=center>
	<tr><td Class=head colspan=9 align=center>MODIFY ASSET MASTER</td></tr>
	<tr><td align=center Class="rowpic"><b>Asset Name</b></td>
	<td Class="row2"><input type="text" size="25" name="asset" value='<?=$asset?>' >
	<input type=button value=search name=search id=search onClick='javascript:dispvalue1();'></tr>
	<tr><td align=center Class="rowpic"><b>Asset Group</b></td>
	<input type=hidden name=type value='<?=$type?>'>

<?php
$query="select * from asset_master";
$result=execute($query);
$rowcount=rowcount($result);
	?>
	<?php

		$r=fetcharray($result,$i);
		?>
		<td><select name="assetup">
		<?php
		//if($type!='')
		//{
		$rsql=execute("select * from asset_sub_group ");
		for($j=0;$j<rowcount($rsql);$j++)
		{
		$rsq=fetcharray($rsql,$j);

			if($type==$rsq[id])
			{
				echo "<option value=$rsq[id] selected>$rsq[asset_subgroup_name]</option>";
			}
			else
			{
				echo "<option value=$rsq[id]>$rsq[asset_subgroup_name]</option>";
			}
		

		}
		//}
		?>
		
		</select></td></tr>
	<input type=hidden name=um value='<?=$um?>'>
	</tr>
	
		
	<tr>
	<td class="row2" colspan="4" align="center"><input class='bgbutton' type="button" onclick="EditClick()" value="Modify" Type="Mod">
	</td></tr></table></form>

</body>
</form>