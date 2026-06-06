<?php
session_start();
include("../db.php");
$d=getdate();
$s=getdate();
function MonthName($mon)
{
	if($mon == 1) return("Jan");
	if($mon == 2) return("Feb");
	if($mon == 3) return("Mar");
	if($mon == 4) return("Apr");
	if($mon == 5) return("May");
	if($mon == 6) return("Jun");
	if($mon == 7) return("July");
	if($mon == 8) return("Aug");
	if($mon == 9) return("Sep");
	if($mon == 10) return("Oct");
	if($mon == 11) return("Nov");
	if($mon == 12) return("Dec");
}

?>
<html>
<head>
<script language='javascript'>
function valid()
{
	if(document.frm.validity.value==0)
	{
		alert("Please select Validity Period");
		document.frm.validity.focus();
	}
	else if(document.frm.amount.value==0)
	{
		alert("Please enter the amount");
		document.frm.amount.focus();
	}
	else
	{
		document.frm.action='desc_fee1.php?type=add';
		document.frm.submit();
	}
}
function edit()
{
		document.frm.action='desc_fee1.php?type=modify';
		document.frm.submit();
}
</script>
</head>
<body>
<form name='frm' method='post'>
<table border='0' align='center' width='80%' cellspacing='1' cellpadding='1' class='forumline'>
<tr>
	<td class='head' colspan='3' align='center'> Add Fee Structure</td>
</tr>
<tr>
	<td  rowspan='2' align='center'>Validity Period</td>
	<td align='center'>Valid Till</td>
	<td  rowspan='2' align='center'>Fee Amount</td>
</tr>
<tr>
	<td align='center'>MM / YYYY</td>
</tr>
<tr>
	<td align='center'>
		<select name='validity'>
			<option value='0'>Select </option>
			<option value='1'> Odd Sem </option>
			<option value='2'> Even Sem </option>
			<option value='3'> 1 Year </option>
		</select>
	</td>
	<td align='center'>
	<?php
		$MyMonth=$d["Fmon"];
		echo "<select name='FMon'>";
		for($i=1;$i<=12;$i++)
		{
			if($i == $MyMonth)
				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
			else
				echo "<option value='$i'>" . MonthName($i) . "</option>\n";
		}
		echo "</select>";
		echo " / ";
		$maxYr = $d["year"]+2;
		$MyYear=$d["year"];
		$d=$d["year"];
		echo "<select name='FYear'>";
		for($i=$d;$i<=$maxYr;$i++)
		{
			if($i == $MyYear)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
		}
		echo "</select>";
	?>
	</td>
	<td  align='center'>
	<input type='text' name='amount' value=''  size=15>
	</td>
</tr>
</table>
<br>
<center>
	<input type='button' name='saveMe' value='Add' class='bgbutton' onClick="valid()">
</center>
</body>
</html>
<?php
if($type=="add")
{
	if($flag==1)
	{
		echo "<font color='blue' size=3'>Details Saved </font>";
	}
	if($flag==2)
	{
		echo "<center><font color='red' size=3'>Duplicate Entry.If you want to change then change the date below</font></center>";
	}
}
if($type=="modify")
{
	if($flag==3)
	{
		echo "<font color='blue' size=3'>Details Updated Successfuly </font>";
	}
}
	$res = execute("select * from trans_fee_str where FYear>=".date('Y')."") or die(mysql_error());
	$num = rowcount($res);
	if($num==0)
	{
		die("<center><font color='red' size=3'>No Details Found</font></center>");
	}
?>
<br>
<table border='0' align='center' width='80%' cellspacing='1' cellpadding='1' class='forumline'>
<tr>
	<td class='head' colspan='4' align='center'> Modify Fee Structure</td>
</tr>
<tr>
	<td  rowspan='2' align='center'>Select</td>
	<td  rowspan='2' align='center'>Validity Period</td>
	<td align='center'>Valid Till</td>
	<td  rowspan='2' align='center'>Fee Amount</td>
</tr>
<tr>
	<td align='center'>MM / YYYY</td>
</tr>
<?php
for($kk=1;$kk<=$num;$kk++)
{
	$row = fetcharray($res);
	if($row[validity]==1)
	{
		$val1="selected";
		$val2="";
		$val3="";
	}
	if($row[validity]==2)
	{
		$val1="";
		$val2="selected";
		$val3="";
	}
	if($row[validity]==3)
	{
		$val1="";
		$val2="";
		$val3="selected";
	}
	?>
	<tr>
		<td align='center'><input type='checkbox' name='tid[]' value='<?php echo $row[id] ?>'>
		<td align='center'>
			<select name='validity<?php echo $row[id] ?>'>
				<option value='0'>Select </option>
				<option value='1' <?php echo $val1 ?> > Odd Sem </option>
				<option value='2' <?php echo $val2 ?> > Even Sem </option>
				<option value='3' <?php echo $val3 ?> > 1 Year </option>
			</select>
		</td>
	<td align='center'>
	<?php
		$MyMonth=$d["Fmon"];
		echo "<select name='FMon$row[id]'>";
		for($i=1;$i<=12;$i++)
		{
			if($i == $row[FMon])
				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
			else
				echo "<option value='$i'>" . MonthName($i) . "</option>\n";
		}
		echo "</select>";
		echo " / ";
		$maxYr = $s["year"]+2;
		$MyYear=$s["year"];
		$ss=$s["year"];
		echo "<select name='FYear$row[id]'>";
		for($i=$ss;$i<=$maxYr;$i++)
		{
			if($i == $row[FYear])
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
		}
		echo "</select>";
		?>
		</td>
		<td  align='center'>
			<input type='text' name='amount<?php echo $row[id] ?>' value='<?php echo $row[amount] ?>'  size=15>
		</td>
		</tr>
		<?php
}
?>
</table>
<br>
<center>
	<input type='button' name='saveMe' value='Modify' class='bgbutton' onClick="edit()">
</center>
</form>