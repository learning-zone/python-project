<?php
include("db.php");
$q=$_GET["q"];
?>

  <tr align="justify">
    <td align="justify" valign="top">&nbsp;
    <?php
	
	$sql2=mysql_query("SELECT description FROM `announcement_class` where id='$q'");
	while($r2=mysql_fetch_array($sql2))
	{
		echo $r2['description'];
	}
    ?>
    </td>
  </tr>

