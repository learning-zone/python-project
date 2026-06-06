<?php
require_once("../db.php");
$type=$_POST['type'];
$action=$_REQUEST['action'];
$library=$_POST['library'];
$cardno=$_POST['cardno'];
$DDay=$_POST['DDay'];
$DMon=$_POST['DMon'];
$DYear=$_POST['DYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];
if(trim($action) == "") 
	{
		$action = "searchresultM.php";
	}
?>
<html><head>
<script language="JavaScript">
function F06a943c5()
{
	//alert("hello1");
	if(document.form1.type.selectedIndex==0)
	{
		alert("Select Member Type");
	}	
	else
	{
		//alert("hello");
		document.form1.action="searchresultM.php";
		document.form1.submit();
	}
}
function frm_reload()
{
	document.form1.action="";
	document.form1.submit();
}
</script>
</HEAD>
<BODY>
<form method="POST" name="form1">
<table align='center' width="47%" border="0" class="forumline" colspan=4>
<tr><td align=center class='head' colspan=4>Member Transaction Detail Report</td></tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Member Type</td>
	<td><select name="type" onChange="frm_reload()">
	<?php
	if($type==1)
		{
			$temp_sel1="selected";
			$temp_sel2="";
		}
	if($type==2)
		{
			$temp_sel2="selected";
			$temp_sel1="";
		}
	?>
	<option value="">- Select a Member-</option>
	<option value="1" <?=$temp_sel1?>>Student</option>
	<option value="2" <?=$temp_sel2?>>Staff</option>
	</select></td>
	<td></td>
</tr>
<tr>
<?php
/*
	<td>Library</td>
	<td><select size="1" name="library">
	<option value="-1">---Select a Library ---</option>
	<?php
	$slib =execute("SELECT * FROM library_name");
	$num = rowcount($slib);
	for($i=0;$i<$num;$i++){
	$r1 = fetcharray($slib,$i);
	?>
	<option value="<?=$r1["id"]?>"><?=$r1["name"]?></option>
	<?php
	}
	?>
	</select> 
	*/
	$library =1;
	?>
	  <td>&nbsp;&nbsp;&nbsp;Library Card No.
	<td colspan="2"><input type="text" name="cardno"></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;From Date</td>
	<td>
	<?php
		$d=getdate();
		$MyDay=$d["mday"];
		echo "<select name='DDay'>";
		for($i=1;$i<=31;$i++)
			{
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
				if($i == $MyMonth)
				echo "<option value='$i' selected>" . F367c6aa8($i) . "</option>\n";
				else
				echo "<option value='$i'>" . F367c6aa8($i) . "</option>\n";
			}
		echo "</select>";
		$maxYr = $d["year"]+1;
		$MyYear=$d["year"];
		echo "<select name='DYear'>";
		for($i=1997;$i<=$maxYr;$i++)
			{
				if($i == $MyYear)
				echo "<option value='$i' selected>$i</option>\n";
				else
				echo "<option value='$i' >$i</option>\n";
			}
		echo "</select>";
	?>
	</td>
	<td></td>
</tr>

<tr>
	<td>&nbsp;&nbsp;&nbsp;To Date</td>
	<td>
	<?php
		$d=getdate();
		$MyDay=$d["mday"];
		echo "<select name='TDay'>";
		for($i=1;$i<=31;$i++)
			{
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
				if($i == $MyMonth)
				echo "<option value='$i' selected>" . F367c6aa8($i) . "</option>\n";
				else
				echo "<option value='$i'>" . F367c6aa8($i) . "</option>\n";
			}
		echo "</select>";
		$maxYr = $d["year"]+1;
		$MyYear=$d["year"];
		echo "<select name='TYear'>";
		for($i=1997;$i<=$maxYr;$i++)
			{
				if($i == $MyYear)
				echo "<option value='$i' selected>$i</option>\n";
				else
				echo "<option value='$i' >$i</option>\n";
			}
		echo "</select>";
	?>
	</td>
	<td></td>
</tr>
</table>
<br>
<center><input type="button" value=" Search " onClick="F06a943c5()" name="button" class="bgbutton">
</center>
<?php
function F367c6aa8($mon)
	{
		if($mon == 1) return("Jan");
		if($mon == 2) return("Feb");
		if($mon == 3) return("Mar");
		if($mon == 4) return("Apr");
		if($mon == 5) return("May");
		if($mon == 6) return("Jun");
		if($mon == 7) return("Jul");
		if($mon == 8) return("Aug");
		if($mon == 9) return("Sep");
		if($mon == 10) return("Oct");
		if($mon == 11) return("Nov");
		if($mon == 12) return("Dec");
	}
?>
</form>
</BODY>
</HTML>