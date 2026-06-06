<?php
session_start();
require("../db.php");
$branch = $_POST['branch'];
$vechile=$_POST['vechile'];
?>
<html>
<HEAD>
<script language="Javascript">
function prn()
{
	pr1.style.display="none";
	print(this.form);
}
function reload()

{

	document.frm.action='viewvechilemaster.php';

	document.frm.submit();

}
</script>
</HEAD>
<body>
<?php
$count=1;
$sql = "SELECT * FROM trans_vechile_master group by vechile_mod_no";
$rs = execute($sql);
$num = rowcount($rs);
 $rowclass=1;
if($num==0)
{
echo "NO DATA FOUND";
}
?>
<table width="90%" class='forumline' align=center border="1">
<tr><td class="head" colspan=9 align='center'>Vehicle Details </td></tr>
<tr><td class="rowpic" align="center">Sl No</td><td class="rowpic" align="center">Vehicle Name</td> <td class="rowpic" align="center">Action</td></tr>
<?php
	for($i=0;$i<$num;$i++){
	if($i%2)
	echo "<tr> ";
	else
	echo "<tr class='clsname'> ";
    $r = fetcharray($rs,$i);

?>


  <td class="CBody" align="center">



  <?=$count ?>

  </td><td class="CBody" align="center">&nbsp;&nbsp;

  <?=$r[vechile_mod_no]?>
  </td>  
  <td align="center">
  <a href="print_vehicle.php?id=<?=$r[id]?>">PRINT</a></td>

    </tr>

<?php

$count++;

	$rowclass = 1 - $rowclass ;

	}

?>





</table>

<br>



</body>

</html>

