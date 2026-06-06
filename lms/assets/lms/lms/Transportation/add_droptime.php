<?php
session_start();
include("../db.php");
$drop_time=$_POST['drop_time'];
//print_r($_POST);


?>

<html>

<head>

<SCRIPT LANGUAGE ="JavaScript">

var KEY_LEFT  = 268762961;

var KEY_RIGHT = 268762963;

function EditClick()

{

	document.form1.action="Alterdroptime.php?Types=Mod";

	document.form1.submit();

}

</script>

</head>

<body font-size="10" class='bodyline'>

<form Name="AddCountry" action="add_droptime_det.php" method="GET">

<table class='forumline' align=center>

<tr>
  <td class="rowpic" align="center">Drop Time</td></tr>

<tr><td class="CBody"><input type="text" size="40" name="drop_time" onKeyDown="return check(event)"></td></tr>

<tr height='40'><td align=center><input type="submit" value="ADD" class='bgbutton'></td></tr>

</table>

</form>

<?php

$query = "SELECT * FROM trans_drop_time order by drop_time";

$rs = execute($query);

$row=rowcount($rs);

if($row)

{

	?>

	<form method="post" id="form1" name="form1"><?php echo $msg?>

	<table class='forumline' align=center>

	<tr><td Class="head" colspan=3 align='center'><font size="2">Modify Drop Time</font></td></tr>

	<tr><td class="rowpic">Select</td><td class="rowpic" align="center">Drop Time</td></tr>

	<?php

	for($i=0;$i<$row;$i++)

	{

		$r = fetchrow($rs);

		$exe=execute("select * from trans_drop_time where id='$r[0]'");

		//echo "select * from country where id='$r[0]'";

		$exe1=fetcharray($exe);

		?>

		<tr><td height="26" align="center" class="CBody"><input type="checkbox" name="rid[]" Value="<?php echo $r[0]?>"></td>

		<td class="CBody">

		<input type="text" size=40 name="RName<?php echo $r[0]?>" value="<?php echo $r[1]?>" onKeyDown="return check(event)">

	  </td></tr>

		<?php

	}

	?>

	<tr height='40'><td colspan=3 align=center>

	<input type="button" onClick="EditClick()" value="Modify" class='bgbutton'>

	</td></tr>

	</table>  

	<?php

}

else

{

	echo "<p align=\"left\"><b><font face=\"Arial\">No Records</font></b></p>";

}

?>

</form>

</body>

</html>



