<?
include("../../db.php");
?>
<HTML>
<HEAD>
<TITLE>ITEM SEARCH RESULTS</TITLE>
<SCRIPT language="JavaScript">
function winclose(code2,code3,code4)
{
self.opener.document.frm.item.value =code2;
self.opener.document.frm.um.value =code3;
self.opener.document.frm.quantity_type.value =code4;
window.close();
}

</SCRIPT>
</HEAD>
<BODY BACKGROUND="">
<?php
echo "<form name='tempfrm' method=post action=PurchaseMaster.php>";
echo "<TABLE BORDER='0' align='center' CELLSPACING='1' CELLPADDING='1' width='95%' class='forumline'>";
echo "<TR>";
	echo "<TD ALIGN='CENTER'  CLASS='head' colspan='4'><B>Item List</B></TD>";
echo "</tr>";
echo "<TR height='25'>";
	echo "<TD ALIGN='CENTER' CLASS='rowpic' ><B>ITEM ID</B></TD>";
	echo "<TD ALIGN='CENTER' CLASS='rowpic'><B>ITEM NAME</B></TD>";
	echo "<TD ALIGN='CENTER' CLASS='rowpic'><B>QUANTITY TYPE</B></TD>";
	echo "<TD ALIGN=CENTER   CLASS='rowpic'><B>SELECTION</B></TD>";
echo"</TR>";

$query="select * from h_item_master where item_name like '$item%'	 ";
$result=execute($query);
$count=rowcount($result);
if($count==0)
{
	echo "<TR><td COLSPAN=3 ALIGN=CENTER>No Item Present</td></TR>";
}

for($i=0;$i<$count;$i++)

{
$r = fetcharray($result);
$na=$r[item_name];
$id01=$r[id];
$type=$r[quantity_type];

?>
<tr><td><input type=hidden name=id01 value=<?=$id01?>></td></tr>
<TR><TD ALIGN="CENTER" CLASS='row2'><?=$id01?></td>
<TD ALIGN="left" CLASS='subgroup'><?=stripslashes($na);?></td>
<TD ALIGN="left" CLASS='subgroup'><?=stripslashes($type);?>
</TD>
<TD ALIGN="CENTER" CLASS='row2'><INPUT type="button" value="SELECT" onClick="winclose('<?=$na?>','<?=$id01?>','<?=$type?>')"></TD>


</TR>
<?
}

?>
</table>
</form>
</body>
</html>
