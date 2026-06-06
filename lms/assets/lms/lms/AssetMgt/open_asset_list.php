<?
include("../db.php");
?>
<HTML>
<HEAD>
<TITLE>ITEM SEARCH RESULTS</TITLE>
<SCRIPT language="JavaScript">
function winclose(code2,code3,code4)
{

self.opener.document.frm.asset.value =code2;
self.opener.document.frm.um.value =code3;
self.opener.document.frm.type.value =code4;
self.opener.document.frm.action="modify_AssetMaster.php";
self.opener.document.frm.submit();
window.close();
}

</SCRIPT>
</HEAD>
<BODY BACKGROUND="">
<?
//echo $item."kkkkk";
echo "<form name='tempfrm' method=post action=modify_AssetMaster.php>";
//ECHO"<INPUT TYPE=hidden NAME=name VALUE=$name>";
//ECHO"<INPUT TYPE=text NAME=ct_id  VALUE=$ct_id>";
echo "<TABLE BORDER='1' CELLSPACING='1' CELLPADDING='1'>";
echo "<TR>";
echo "<TD ALIGN='CENTER' BGCOLOR='#BBCCDD' CLASS='rowpic' ><B>Asset ID</B></TD>";
echo  "<TD ALIGN='CENTER' BGCOLOR='#BBCCDD' CLASS='rowpic'><B>Asset NAME</B></TD><TD ALIGN='CENTER' BGCOLOR='#BBCCDD' CLASS='rowpic'><B>Asset Subgroup Id</B></TD><TD ALIGN=CENTER BGCOLOR=#BBCCDD CLASS='rowpic'><B>SELECTION</B></TD>";
echo"</TR>";

$query="select * from asset_master where asset_name like '$asset%'	 ";
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
$na=$r[asset_name];
$id01=$r[id];
$type=$r[asset_group_id];
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
