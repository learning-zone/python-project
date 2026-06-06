<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";

require_once("../db.php");
$library=$_POST['library'];
$media=$_POST['media'];
$FDay=$_POST['FDay'];
$FMon=$_POST['FMon'];
$FYear=$_POST['FYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$TYear=$_POST['TYear'];

//print_r($_GET);
//print_r($_POST);
?>
<HTML>
<HEAD>
<script language="javascript">
function frm_submit()
{
	document.form1.action='view_day2day_statistics.php';
	document.form1.submit();
}
</script>
<BODY topMargin=0 leftMargin=0>
<form method="POST" action='day_to_day_statistics.php' name="form1">
<table border="1" width="47%" cellspacing="0" cellpadding="0" align='center' class=forumline>
<tr><td colspan=3 class=head align='center'>Day To Day Transaction Report</td></tr>
<?php
//get the no of library names from the table library_name
$slib =execute("SELECT * FROM library_name");
$num = rowcount($slib);
?>
<?php
/*
<tr><td  align="left">&nbsp;&nbsp;&nbsp;Library</td>
<td  align="left"><select size="1" name="library" onChange='javascript:document.form1.submit()'>
<option value='0'>-- All --</option>
<?php
for($i=0;$i<$num;$i++)
{
	$r1 = fetcharray($slib,$i);
	$sel="";
	if($library==$r1[id])
	{
		$sel="selected";
	}
	?>
	<option value="<?php echo $r1["id"]?>" <?php echo $sel?>><?php echo $r1["name"]?></option>
	<?php
}
?>
</select></td></tr>
*/
$library=1;

?>
<tr><td align="left">&nbsp;&nbsp;&nbsp;Media Type</td>
	<td><select name="media">
	<option value='0'>----- All -----</option>
	<?php
	$sql1 = "select * from lib_mediatype order by id";
	$rs = execute($sql1);
	$row=rowcount($rs);
	for($i=0;$i<$row;$i++)
	{
		$r = fetcharray($rs,$i);
		if($media==$r[id])
		{
			?>
			<option value="<?php echo $r["id"]?>" selected><?php echo $r["name"]?></option>
			<?php
		}
		else
		{
			?>
			<option value="<?php echo $r["id"]?>" ><?php echo $r["name"]?></option>
			<?php
		}
	}
	?>
	</select></td>
	</tr>
	<tr><td  align="left">&nbsp;&nbsp;&nbsp;From Date</td>
	<td  align="left">
	<?php
	$d=getdate();
	$MyDay=$d["mday"];
	echo "<select name='FDay'>";
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
	echo "<select name='FMon'>";
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
	echo "<select name='FYear'>";
	for($i=1997;$i<=$maxYr;$i++)
	{
		if($i == $MyYear)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	?>
	</td></tr>
	<tr><td align="left">&nbsp;&nbsp;&nbsp;To Date</td>
	<td  align="left">
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
	for($i=1997;$i<=$maxYr;$i++)
	{
		if($i == $MyYear)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	?>
	</td></tr>
	
</table>
<br>
<div align=center>
	<input type='submit' value='<<  Submit  >>' name='submit1' onClick='frm_submit()' class=bgbutton></div>
</form>
<?php
function F367c6aa8($mon)
{
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