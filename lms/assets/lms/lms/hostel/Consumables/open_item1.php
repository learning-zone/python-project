<?
include("../../db.php");
?>
<HTML>
<HEAD>
<TITLE>ITEM SEARCH RESULTS</TITLE>
<SCRIPT language="JavaScript">
function winclose(code2,code3,code4,code5)
{
//alert(document.tempfrm.id01.value);
//self.opener.document.frm1.name1.value =code;
self.opener.document.frm.item.value =code2;
self.opener.document.frm.um.value =code3;
self.opener.document.frm.quantity_type.value =code4;
self.opener.document.frm.stock_hand.value=code5;
//alert(code3);
//self.opener.document.frm1.action = "pending.php";
window.close();
}

</SCRIPT>
</HEAD>
<BODY BACKGROUND="">
<?
//echo $item."kkkkk";
echo "<form name='tempfrm' method=post action=IssueMaster.php>";
//ECHO"<INPUT TYPE=hidden NAME=name VALUE=$name>";
//ECHO"<INPUT TYPE=text NAME=ct_id  VALUE=$ct_id>";
echo "<TABLE BORDER='1' CELLSPACING='1' CELLPADDING='1'>";
echo "<TR>";
echo "<TD ALIGN='CENTER' BGCOLOR='#BBCCDD' CLASS='rowpic' ><B>ITEM ID</B></TD>";
echo  "<TD ALIGN='CENTER' BGCOLOR='#BBCCDD' CLASS='rowpic'><B>ITEM NAME</B></TD><TD ALIGN='CENTER' BGCOLOR='#BBCCDD' CLASS='rowpic'><B>QUANTITY TYPE</B></TD><TD ALIGN=CENTER BGCOLOR=#BBCCDD CLASS='rowpic'><B>SELECTION</B></TD>";
echo"</TR>";

$query="select * from h_item_master where item_name like '$item%'	 ";
//echo $query;
$result=execute($query);

$count=rowcount($result);
if($count==0)
{
echo "<TR><td COLSPAN=3 ALIGN=CENTER><FONT COLOR=RED>No records found</FONT></td></TR>";
}

for($i=0;$i<$count;$i++)

{
$r = fetcharray($result);
$na=$r[item_name];
$id01=$r[id];
$type=$r[quantity_type];
$stock_in_hand=$r[stock];

?>
<tr><td><input type=hidden name=id01 value=<?=$id01?>></td></tr>
<TR><TD ALIGN="CENTER" CLASS='row2'><?=$id01?></td>
<TD ALIGN="left" CLASS='subgroup'><?=stripslashes($na);?></td>
<TD ALIGN="left" CLASS='subgroup'><?=stripslashes($type);?>
</TD>
<TD ALIGN="CENTER" CLASS='row2'><INPUT type="button" value="SELECT" onClick="winclose('<?=$na?>','<?=$id01?>','<?=$type?>','<?=$stock_in_hand?>')"></TD>


</TR>
<?
}

?>
</table>
</form>
</body>
</html>
