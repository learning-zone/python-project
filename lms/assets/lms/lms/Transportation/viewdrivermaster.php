<?php
session_start();
require("../db.php");
?>
<html>
<HEAD>
<script language="Javascript">
function prn()
{
	pr1.style.display="none";
	print(this.form);
}
</script>
</HEAD>
<body>
<?php
$count=1;
$sql = "SELECT * FROM trans_driver_master ";
$rs = execute($sql);
$num = rowcount($rs);
$rowclass=1;
//echo "Num is : ".$num."<br>";
?>
<Table class='forumline' align=center width="90%" border="1">

<tr><td Class="head" align=center colspan=10>Driver Details</td></tr>

  <tr><td class="rowpic">Sl No</td>
  <td class="rowpic" align="center"><b>Driver Name&nbsp;&nbsp;</b></td>
  <td class="rowpic">Action</td></tr>



<?php

	for($i=0;$i<$num;$i++){

	if($i%2)

	echo "<tr> ";

	else

	echo "<tr class='clsname'> ";

		$r = fetcharray($rs,$i);

?>



 

  <td class="CBody" align="center">

  <?=$count?>

  </td><td class="CBody" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <?=$r[driver_name]?>

  </td>
  <td align="center">  <a href="print_vehicle.php?vehicle_no=<?=$r[id]?>">PRINT</a></td>
   </tr>

<?php

$count++;

	$rowclass = 1 - $rowclass ;

	}

?>



</table>



<br>

<div id=pr1 align=center><INPUT TYPE="button" NAME="print" class='bgbutton' VALUE="PRINT THE REPORT" OnClick="prn()"></div>

</body>

</html>

