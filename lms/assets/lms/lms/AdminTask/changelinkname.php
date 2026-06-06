<html>
<head><title>LINK NAME</title>
<Script language="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
	function RefreshMe(val)
	{
		document.MyFrm.action="changelinkname.php";
		document.MyFrm.submit();
	}

	
</script>
<?php
session_start();
include("../db1.php");

	$module=$_POST['module'];
	$submodule=$_POST['submodule'];


if(isset($_POST['grant1']))
{
	
$selitem=$_POST['cid'];
	for($i=0;$i<sizeof($selitem);$i++)
	{
		$sel1=$selitem[$i];
		$disp=$_POST['dis'.$sel1];
		execute("update `links` set `Display_name`='$disp' where id='$selitem[$i]'");
	}
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php		
}
?>
</head>
<body class='bodyline'>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' class='forumline' width='70%' >
<tr>
  <td colspan=2 align='center' class='head'>LINK NAME</td></tr>

<tr><td>&nbsp;&nbsp;Module</td><td><select name="module" onChange="RefreshMe(0)">
<option value='-1'>-- Select --</option>
<?php
if($module=='0')
	$s="selected";
else
	$s="";
	$sql1=execute("select * from modules order by module") or die(mysql_error());
	for($j=0;$j<rowcount($sql1);$j++)
	{
		$r1=fetcharray($sql1,$j);

		if($r1[module]==$module)
		{
			echo "<option value='$r1[module]' selected>$r1[module]</option>";
		}
		else
		{
			echo "<option value='$r1[module]' >$r1[module]</option>";
		}
	}

?>
</select></td></tr>
<tr>
      <td>&nbsp;&nbsp;Submodule</td>
      <td><select name="submodule" onChange="RefreshMe(0)">
<option value="">Select Class</option>
<?php
	$sql=execute("select * from submodules where module='$module' order by submodule  ") or die(mysql_error());
	while($r=fetcharray($sql))
	{
		if($submodule==$r[submodule])
			echo "<option value='$r[submodule]' selected>$r[submodule]</option>";
		else
			echo "<option value='$r[submodule]' >$r[submodule]</option>";
	}
?>
</select>
</td>
</tr>



</table>
<?php
echo "<br>";
echo "<table align=center class='forumline'  width = '40%'>";
?>
<tr><td align='center' colspan="3">CLICK HERE TO CHECK ALL</td><td width="23" align='center'><div id="checkAll" 
					this.style.cursor='hand';this.style.color='white'"
					this.style.cursor='default';this.style.color='black'"
					onClick="selectMe()"
					Title="Click to Select all Students"><input type="checkbox"></div></td></tr>

<tr>
<td nowrap class='head'>ID</td>
<td nowrap class='head'>Link Name</td>
<td nowrap class='head'>Display Name</td>
<td nowrap class='head'>Access</td>

</tr>
<?php
$qry="select * from links where module='$module' and submodule='$submodule' ";
$rs = execute($qry);
$x=0;
$i=1;
while($row=fetcharray($rs))
{
	if($x%2)
	echo "<tr > ";
	else
	echo "<tr class='clsname'> ";
	$x = $x + 1;
	echo "<td nowrap>";
	echo " $i";
	echo "</td>";
	echo "<td nowrap>";
	echo "$row[2]";
	echo "</td>";
	echo "<td nowrap>";
	
	echo "<input type='text' name='dis".$row[id]."' size='40' value='$row[6]'";
	echo "</td>";

	echo "<td nowrap>";

	echo "<input type='checkbox' name='cid[]' value='$row[id]'>" ;
	echo "</td>";
	echo "</tr>";
	$i++;
}
echo "</table>";
echo "</td></tr>";

echo "<br>";
echo "<div align=center><input type='submit' name='grant1' value='Update' class='bgbutton'></div>";
?>
 
	</form></body></html>
