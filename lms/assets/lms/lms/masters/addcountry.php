<?php
session_start();
include("../db.php");

?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">
var KEY_LEFT  = 268762961;
var KEY_RIGHT = 268762963;
function check(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 65 || charCode > 91 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT ) 
	{
		if((charCode >= 65456 && charCode <= 65465) )
		{
			return true
		}
		else
		{
			if((charCode == 37) || (charCode == 39)|| (charCode == 46) || (charCode==190))
			{
				return true
			}
			else
			{
				alert("Please make sure entries are alphabets only.")
				return false
			}
		}
	}
	return true
}
function EditClick()
{
	document.form1.action="AlterCountry.php?Types=Mod";
	document.form1.submit();
}
</script>
</head>
<body font-size="10" class='bodyline'>
<form Name="AddCountry" action="Add_Country.php" method="GET">
<table class='forumline' align=center>
<tr><td class="head" align='center'><font size="2">Manage Country </font></td></tr>
<tr><td class="CBody" ><input type="text" size="40" name="Country" onKeyDown="return check(event)"></td>
</tr>
<tr height='40'><td colspan=2 align=center><input type="Submit" value="ADD" class='bgbutton'></td></tr>
</table>
</form>
<?php
$query = "SELECT *  FROM country order by country_name";
$rs = execute($query);
$row=rowcount($rs);
if($row)
{
	?>
	<form method="post" id="form1" name="form1"><?php echo $msg?>
	<table class='forumline' align=center>
	<tr><td Class="head" colspan=3 align='center'><font size="2">Modify Country</font></td></tr>
	<tr><td class="row3">Select</td><td class="row3" align="center">Country</td></tr>
	<?php
	for($i=0;$i<$row;$i++)
	{
		$r = fetchrow($rs);
		$exe=execute("select * from country where id='$r[0]'");
		//echo "select * from country where id='$r[0]'";
		$exe1=fetcharray($exe);
		?>
		<tr><td class="CBody" align="center"><input type="checkbox" name="rid[]" Value="<?php echo $r[0]?>"></td>
		<td class="CBody" align="center">
		<input type="text" size=40 name="RName<?php echo $r[0]?>" value="<?php echo $r[1]?>" onKeyDown="return check(event)">
		</td></tr>
		<?php
	}
	?>
	<tr height='40'><td colspan=2 align=center>
	<input type="button" onClick="EditClick()" value="Modify" class='bgbutton'>
	</td></tr>
	</table>  
	<?php
}
else
{
	echo "<p align=\"left\"><b><font face=\"Arial\">No Countries Present</font></b></p>";
}
?>
</form>
</body>
</html>

