<html>
<head>
<script language="JavaScript">
function RefreshMe()
{
	document.frm.action="locawise_reprs.php";
	document.frm.submit();
}
function RefreshMepr()
{
	document.frm.action="locawise_reprs_print.php";
	document.frm.submit();
}
function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display=" ";
}
</script>
</head>
<?php
session_start();
//require("../urlaccess.php");
require("../db.php");
$sql=execute("select * from dept_no");
?>
 <BODY>
 
	<table class=forumline align=center>
	<tr><td Class="rowpic" colspan='4' align='center'><font face='Lucida Sans' size='2'>
	<?php 
	$sw=execute("select * from asset_master where id='$assetgroup'");
	$Fetsw=fetcharray($sw);
	?>
	List Of <?php echo $Fetsw[asset_name]?></font></td></tr>
	<?php
	if($assetgroup<>'')
	{
		?>
		<tr><td Class="rowpic"><font face='Lucida Sans' size='2'>Sl No</font></td><td Class="rowpic"><font face='Lucida Sans' size='2'>Asset Code</font></td><td Class="rowpic"><font face='Lucida Sans' size='2'>Location</font></td><td Class="rowpic"><font face='Lucida Sans' size='2'>Condition</font></td></tr>
		<?php
		$qry1=execute("select a.*,d.location from individual_asset_details a,dept_no b,assetstatusmasterc,location_master d where a.asset_id=$assetgroup and a.dept_id=$dept and a.dept_id=b.dpt_id  and a.conditions = 'Working' and a.status='false' and a.location_id=d.id and a.dept_id=d.dept_id") or die(error_description());
		for($i=1;$i<=rowcount($qry1);$i++)
		{
			$r1=fetcharray($qry1,$i);
			echo "<tr height='25'><td>$i</td>";
			echo "<td>$r1[item_code]</td><td>$r1[location]</td>";
			echo "<td>$r1[conditions]</td></tr>";
		}
		?>
		</table>
		<input type="hidden" name="PersonName" value="<?php echo $user?>">
      <?php 
}?>
 </BODY>
 <DIV ALIGN='center' id='prn'>
<INPUT TYPE='BUTTON' NAME='print' VALUE='Print' CLASS='bgbutton' onclick='printReport()'></DIV>
</HTML>
