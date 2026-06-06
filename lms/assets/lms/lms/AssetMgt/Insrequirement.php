<?php
session_start();
require("../db.php");
?>
<html>
<head><title>Item Batch Report</title></head>
<script>
function Print_ltr()
{
	this.window.print()	;
}
</script>
<?
$col=execute("select * from college");
$cq=fetcharray($col);
?>
<body>
<table class=forumline align=center border="1" cellpadding="0" cellspacing="0" width='60%'>
<tr><td><table cellpadding="0" cellspacing="0" width="100%"><tr><td width="10%" valign="top"><img src="../images/logo.gif" width="80" height="80" /></td>
<td width="90%" valign="top" align='center'>
<table width="100%" cellpadding="0" cellspacing="0" align='center'><tr><td class="head" align="center"><?=$cq[col_name]?></td> </tr>
<tr><td align="center" colspan='2'><font color="#666666"><b><?=$cq[col_addr]?></b></font></td></tr>
<tr><td align="center"  colspan='2'><font color="#666666"><b>Phone:<?=$cq[col_phone]?></b></font></td></tr>
<tr><td align="center"  colspan='2'><font color="#666666"><b>Email:<?=$cq[email]?></b></font></td></tr></table></td>
</tr></table></td></tr>
<tr><td colspan="2"><h3>To,</h3></td></tr>
<tr border='0'><td><table cellpadding="0" cellspacing="0" width="100%" border='0'><tr><td style="padding-left:50px;"><b><?=$dept?></b></td><td align="right" ><b>Date:<?=date('d/m/y')?></b></td></tr></table></td></tr>

<tr><td colspan="4" align="center" valign="baseline">
<table border="1" width="100%">
<tr><td class='head' colspan="4">Quotation for requirement </td></tr>
<tr><td align="center"><b><font color="#993333">Sl.No</font></b></td><td align="center"><b><font color="#993333">Asset Group</font></b></td><td align="center"><b><font color="#993333">Asset Name</font></b></td><td align="center"><font color="#993333"><b>Quantity</b></font></td></tr>
<?
$i=0;
	$req=execute("select * from requirementindent order by id desc limit 1");
	$x=fetcharray($req);
	
	if(rowcount($req)>0)
	{
		$rin=explode("/",$x[RINumber]);
		$id=$rin[3]+1;
	}
	else
	{
		$id=1;
	}

while( list(,$Value) = each($aid))
{
	$today=date("Y-m-d");
	
	$sql="insert into requirementindent(RDate,College,person,asset_id,quantity,dept_id) values('$today',";
	$sql.=" '$college','$user',$aname1[$i],$qty[$i],$dep)";
	$rs=execute($sql,$i) or die(error_description());
	$id1=fetchInsertId();

	$sql1=execute("select b.asset_group_id,a.dept_code,b.asset_code  from dept_no a,asset_sub_group b where a.dpt_id=$dep and b.id=$agroup1[$i]");
	$rs1=fetcharray($sql1);
	$sqla=execute("select abbrevation from asset_group where id=$rs1[0]");
	$rsa=fetcharray($sqla);
	$abb="IIS";
	$RiNo[]=$abb."/" .$rsa[0]. "/" .$rs1[1]."/".$id;
	$x=execute("update requirementindent set RINumber='$RiNo[$i]' where id=$id1");
	$sql2=execute("delete from tempreqindent where dept=$dep and agroup=$agroup1[$i] and aname=$aname1[$i]");
	$sql3=execute("select * from tempreqindent");
	if(rowcount($sql3)<1)
	{
		execute("truncate tempreqindent");
	}

	?><tr><td style="padding-left:10px"><?=$i+1?></td><td style="padding-left:10px"><?=$agroup[$i]?></td><td style="padding-left:10px"><?=$aname[$i]?></td><td style="padding-left:10px"><?=$qty[$i]?></td></tr><?$i++;}?>
</table>
</td></tr>
<tr><td><table width="100%"><tr><td align="right" width="80%" style="font-face:sanserif;color:#993333";><h3><i>Thanking You,</i></h3></td><td></td></tr>
<tr><td align="right" colspan="2" style="font-face:sanserif;color:#993333";><h3><i><?=$user?></i></h3></td></tr></table></td></tr>
<tr><td align="center"><input type="button" onClick="Print_ltr()" class="bgbutton"  value="Print" ></td></tr>
</table>
</body>
</html>