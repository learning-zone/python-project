<?php
require_once("../db.php");
$library=$_POST['library'];
$register=$_POST['register'];
$media=$_POST['media'];
$subject=$_POST['subject'];
$DDay=$_POST['DDay'];
$DMon=$_POST['DMon'];
$DYear=$_POST['DYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];

if(trim($action) == "")
{
$action = "viewnewarrival.php";
}
?>
<HTML>
<HEAD>
<script language="javascript">
function frm_submit()
{

	if(document.form1.media.value=="1") // book
	{
		document.form1.action="viewnewarrival.php";
	}
	else if(document.form1.media.value=="2") //book CD
	{
		document.form1.action="view_newarrival_bookcd.php";
	}
	else if(document.form1.media.value=="3") //book Floppy
	{
		document.form1.action="view_newarrival_bookfloppy.php";
	}
	else if(document.form1.media.value=="6") //Bound Volume
	{
		document.form1.action="view_newarrival_bound_volume.php";
	}
	else if(document.form1.media.value=="4") //Other CD
	{
		document.form1.action="view_newarrival_bookcd.php";
	}
	else if(document.form1.media.value=="5") //Project Report
	{
		document.form1.action="view_newarrival_projct_report.php";
	}
	else if(document.form1.media.value=="8") //magazine
	{
		document.form1.action="view_newarrival_magazine.php";
	}
	document.form1.submit();
}

function frm_refresh()
{

document.form1.submit();
}

</script>
<BODY topMargin=0 leftMargin=0>
<form method="POST" action='selectnewarrival.php' name="form1">
<table border="0" width="47%" cellspacing="1" cellpadding="1" class=forumline align=center>
<?php
$smedia =execute("SELECT * FROM lib_mediatype");
$row_num = rowcount($smedia);
?><br/>
<tr><td align="center" Class="head" colspan=3>New Arrival Report </td></tr>
<?php
$slib =execute("SELECT * FROM library_name");
$num = rowcount($slib);
?>
<?php
/*
<tr>
<td width="20%" align="left">Library</td>
<td width="50"% align="left">
<select size="1" name="library" onChange='javascript:document.form1.submit()'>
<option value=0>Select Library</option>
<?php
for($i=0;$i<$num;$i++){
$r1 = fetcharray($slib,$i);
$sel="";
if($library==$r1[id])
{
	$sel="selected";
}
?>
<option value="<?=$r1["id"]?>" <?=$sel?>><?=$r1["name"]?></option>
<?php
}
?>
</select>
</td></tr>
*/
$library=1;
if($library > 0)
{
	/*
	echo "<tr>";
	echo "<td>";
	echo "<div align=left>Register";
	echo "</td>";
	echo "<td>";
	$qry="select * from lib_register where library=$library";
	echo "<select name=register>";
	echo "<option value=0>ALL</option>";
	$ls=execute($qry) or die(error_description());
	for($ii=0;$ii < rowcount($ls);$ii++)
	{
		$lr=fetcharray($ls,$ii);
		if($lr[id]==$register)
			$sel = "selected";
		else
			$sel = "";
		echo "<option value=$lr[id] $sel>$lr[register]</option>";
	}
	echo "</select>";
	echo "</td>";
	echo "</tr>";
	*/
	?>
	<tr>
	<td align="right">Media &nbsp;</td>
	<td align="left">
	<select size="1" name="media" >
	<?php
	for($i=0;$i<$row_num;$i++)
	{
		$r = fetcharray($smedia,$i);
		?>
		<option value="<?=$r["id"]?>"><?=$r["name"]?></option>
		<?php
	}
	?>
	<option value='8'>Magazine/Journals</option>
	</select></td></tr>
	<tr><td align="right">Subject &nbsp;</td>
	<td>
	<?
	$qry121="select distinct(subject) as subject from lib_book_details a,lib_acc_details b where b.master_id=a.id ";
	$rs121=execute($qry121);
	echo "<select name=subject >";
	echo "<option value='0'>--- Select Subject for Book option only---</option>";
	while($row121=fetcharray($rs121))
	{
		if(trim($row121[subject]) == trim($subject))
			$sel = "selected";
		else
			$sel = "";
		echo "<option value='$row121[subject]' $sel>$row121[subject]</option>";
	}
	echo "</select>";
	?>
	</select></td></tr>
	<tr>
	<td align="right">From Date &nbsp;</td>
	<td align="left">
	<?php
	$d=getdate();
	$MyDay=$d["mday"];
	echo "<select name='DDay'>";
	for($i=1;$i<=31;$i++)
	{
		if($i <10)
		{
			$i="0".$i;
		}
		if($i == $MyDay)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i'>$i</option>\n";
	}
	echo "</select>";
	$MyMonth=$d["mon"];
	echo "<select name='DMon'>";
	for($i=1;$i<=12;$i++)
	{
		if($i <10)
		{
			$i="0".$i;
		}
		if($i == $MyMonth)
			echo "<option value='$i' selected>" . F367c6aa8($i) . "</option>\n";
		else
			echo "<option value='$i'>" . F367c6aa8($i) . "</option>\n";
	}
	echo "</select>";
	$maxYr = $d["year"]+1;
	$MyYear=$d["year"];
	echo "<select name='DYear'>";
	for($i=1950;$i<=$maxYr;$i++)
	{
		if($i == $MyYear)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	?>
	</td>
	</tr>
	<tr>
	<td align="right">To Date &nbsp;</td>
	<td align="left">
	<?php
	$d=getdate();
	$MyDay=$d["mday"];
	echo "<select name='TDay'>";
	for($i=1;$i<=31;$i++)
	{
		if($i < 10)
		{
			$i="0".$i;
		}
		if($i == $MyDay)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i'>$i</option>\n";
	}
	echo "</select>";
	$MyMonth=$d["mon"];
	echo "<select name='TMon'>";
	for($i=1;$i<=12;$i++)
	{
		if($i <10)
		{
			$i="0".$i;
		}
		if($i == $MyMonth)
			echo "<option value='$i' selected>" . F367c6aa8($i) . "</option>\n";
		else
			echo "<option value='$i'>" . F367c6aa8($i) . "</option>\n";
	}
	echo "</select>";
	$maxYr = $d["year"]+1;
	$MyYear=$d["year"];
	echo "<select name='TYear'>";
	for($i=1950;$i<=$maxYr;$i++)
	{
		if($i == $MyYear)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	?>
	</td>
	</tr>
	<!--<td width="20%" align=left></td>-->
	<?
}
?>
</table>
<br>
<div align=center>
	<input type="button" name "submit1" value=" << Submit >> " onClick="frm_submit()" class=bgbutton></div>
</form>
<?php
function F367c6aa8($mon){
if($mon == '01') return("Jan");
if($mon == '02') return("Feb");
if($mon == '03') return("Mar");
if($mon == '04') return("Apr");
if($mon == '05') return("May");
if($mon == '06') return("Jun");
if($mon == '07') return("Jul");
if($mon == '08') return("Aug");
if($mon == '09') return("Sep");
if($mon == '10') return("Oct");
if($mon == '11') return("Nov");
if($mon == '12') return("Dec");
}
?>
</BODY>
</HTML>
