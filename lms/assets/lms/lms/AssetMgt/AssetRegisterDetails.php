<html>
<head><title>Asset Master</title>
<?php
session_start();
include("../db.php");
$dept = $_POST['dept'];
$id = $_POST['id'];
$SeekPos = $_POST['SeekPos'];
$PAGES = $_POST['PAGES'];
$dept = $_POST['dept'];
$go_to = $_POST['go_to'];
$but_go_to = $_POST['but_go_to'];
$print = $_POST['print'];

$FinancialYear=$FinYear."-".($FinYear+1);
$FYearStart=$FinYear."-04-01";
$FYearEnd=($FinYear+1)."-03-31";
// VARIABLE DECLARATION BEGINS.
$current_date = date("d-m-Y");		// FOR STORING THE CURRENT DATE.
$serial = 1;
$total_lines = 0;
$j = 0;
$_NUMREC_ = 40; // Number of result per page;
//Set the initial seek position
if(empty($SeekPos))
{
        $SeekPos = 0;
}
?>
<script language="JavaScript">
function frm_submit()
{
	document.form1.SeekPos.value=0;
}
function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display="";
}
</script>
</HEAD>
<body>
<?php
echo "<form name=form1 method=post onSubmit='frm_submit()'>";
echo "<input type='hidden' name=SeekPos value=$SeekPos>";
if($dept=="-1")
{
	$sql="select a.*,b.* from individual_asset_details a,asset_master b,";
	//$sql.=" dept_no c where a.dept_id=c.dpt_id and c.Dept<>'Central Stores' and ";
	$sql.=" dept_no c where a.dept_id=c.dpt_id and ";
	//$sql.=" a.condition='Working' and a.status='false' and a.asset_id=b.id";
	$sql.=" a.status='false' and a.asset_id=b.id order by a.item_code";
}
else
{
	$sql="select a.*,b.* from individual_asset_details a,asset_master b,";
	//$sql.=" dept_no c where a.dept_id=c.dpt_id and c.Dept<>'Central Stores' and ";
	$sql.=" dept_no c where a.dept_id=c.dpt_id and ";
	//$sql.=" a.condition='Working' and a.status='false' and a.asset_id=b.id and a.dept_id=$dept";
	$sql.=" a.status='false' and a.asset_id=b.id and a.dept_id=$dept order by a.item_code";
}
$rs=execute($sql) or die(error_description());
echo "</form>";
$countRS=rowcount($rs);
?>
<table class=forumline align=center>
<tr><td Class="head" colspan="5" align="center">Asset Master</td></tr>
<tr><td Class="rowpic">Sl No</td><td Class="rowpic">Asset No.</td><td Class="rowpic">Bar Code No.</td><td Class="rowpic">Description</td>
<td Class="rowpic">Location</td></tr>
<?php
data_seek($rs,$SeekPos); //Move the data pointer to the next position.
if( ($SeekPos + $_NUMREC_) > $countRS)
{
	$MAX = $countRS;
}else{
        $MAX = $SeekPos + $_NUMREC_ ;
}
if( ($SeekPos + $_NUMREC_) >= $countRS){
	$NEXT = $SeekPos;
}else{
	$NEXT  = $SeekPos + $_NUMREC_ ;
}
if( ($SeekPos - $_NUMREC_)  > 0){
	$PREV = $SeekPos - $_NUMREC_;
}else{
        $PREV = 0;
}
$PAGES = $countRS / $_NUMREC_;
if($countRS % $_NUMREC_){
	$PAGES++;
}
$LAST = ((int) $PAGES - 1) * $_NUMREC_;
$slno=$SeekPos+1;
for($i=$SeekPos;$i<$MAX;$i++)
{
	$r=fetcharray($rs,$i);
	$sql1=execute("select * from location_master where id=$r[location_id]");
	$rs1=fetcharray($sql1);
	?>
	<tr><td><?=$slno?></td><td><?=$r["item_code"]?></td><td><?=$r["item_description"]?></td><td><?=$r["asset_name"]?></td>
	<td><?=$rs1["location"]?></td></tr>
	<?php
	$slno++;
}
?>
</table>
<script language="JavaScript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function checkIt(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT ) 
	{
		if((charCode >= 65456 && charCode <= 65465) || (charCode >= 96 && charCode <= 105))
		{
			return true
		}
		else
		{
			alert("Please make sure entries are numbers only.")
			return false
		}
	}
	return true
}
function fun_go_to()
{
	if((document.frm.go_to.value==0)||(document.frm.go_to.value=="")||(parseInt(document.frm.go_to.value) > parseInt(document.frm.PAGES.value) ))
	{
		alert("Page not found");
	}
	else
	{
		document.frm.SeekPos.value = (parseInt(document.frm.go_to.value)-1)* <?=$_NUMREC_?>;
		document.frm.submit();
	}
}
function first()
{
	var i;
	i = 0;
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
function prev()
{
	var i;
	i = "<?=$PREV?>";
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
function next()
{
	var i;
	i = "<?=$NEXT?>";
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
function last()
{
	var i;
	i = "<?=$LAST?>";
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
</script>
<form name="frm" action="AssetRegisterDetails.php">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="SeekPos">
<input type="hidden" name="PAGES" value="<?=$PAGES?>">
<input type="hidden" name="dept" value="<?=$dept?>">
<div align="left">
<table align=center>
<tr><td colspan="2" align="right"><b>Go To</b></td>
<td colspan="2" align="left">
<input type="text" name="go_to" value="<?= ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)" class=bgbutton>
<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()"  class=bgbutton></td></tr>
<tr><td>&nbsp;</td></tr><tr><td>
<!--<input type="button" value="First" onclick="first()">-->
<a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0"   alt="First"></a></td>
<td><!--<input type="button" value="Prev" onclick="prev()">-->
<a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0"   alt="Previous">  </a></td><td>
<!--<input type="button" value="Next" onclick="next()">-->
<a href="Javascript:next()"><img src="../images/nextbtn.gif" border="0" alt="Next" onMouseOver="Javascript:status='Next Page';"></a></td>
<td><!--<input type="button" value="Last" onclick="last()">-->
<a href="Javascript:last()"><img src="../images/lastbtn.gif" border="0" alt="Last" onMouseOver="Javascript:status='Last Page';"></a></td></tr>
</table>
</div><div align="center"><small><b>Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></b></small></div>
<BR><DIV ALIGN='center' id='prn'><INPUT TYPE='BUTTON' NAME='print' VALUE='PRINT THE REPORT' CLASS='bgbutton' onclick='printReport()'></DIV>
</form>
</BODY>
</HTML>
