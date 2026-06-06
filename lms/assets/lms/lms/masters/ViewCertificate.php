<html>
<head>
<?php
session_start();
require("../db.php");
?>
<SCRIPT LANGUAGE ="JavaScript">
function EditClick()
{
	document.form1.action="AlterCertificate.php?Types=Mod";
	document.form1.submit();
}

 function DeleteClick()
 {
	document.form1.action="AlterCertificate.php?Types=Del";
	document.form1.submit();
 }
</script>
</head>
<body font-size="10" class='bodyline'>


<?php

 $query = "SELECT *  FROM certificate_m WHERE status=1";

 $rs = execute($query);

 $row=rowcount($rs);


 if($row){

?>

  <form method="post" id="form1" name="form1">
  <table width="360" align=center class='forumline'>
  <tr>
  <td class='head' align='center' colspan=2>Modify Document Details</td>
  </tr>
  <tr><td class="rowpic">Select</td><td class="rowpic" align="center">Document Name</td></tr>
  <?php
	for($i=0;$i<$row;$i++){
 		$r = fetchrow($rs);
  ?>
<tr><td class="CBody" align="Center">
  <input type="checkbox" name="cid[]" Value="<?=$r[0]?>">
    </td><td class="CBody" align="Center">
    <input type="text" size=40 name="CName<?=$r[0]?>" value="<?=$r[1]?>">
    </td>
    </tr>

   <?php
	}
   ?>
</table>
  <div align="center">

  <input type="button" onClick="EditClick()" value=" Modify " class='bgbutton'>
  &nbsp;&nbsp;&nbsp;
  <input type="button" onClick="DeleteClick()" value=" Delete  " class='bgbutton'>
  </div>
  
  </form>
  <?php
	}else{
          echo "<p align=\"left\"><b>No Documents Present</b></p>";
	}

  ?>


<form Name="AddCertificate" action="AddCertificate.php" method="GET">

<table width="320" class='forumline' align=center><thead>
<td class='head' align='center' colspan=2>Manage Document Details</td>
</thead>
<tr><td class="CBody" align="Center">
<input type="text" size="40" name="CertificateName">
</td></tr></table>
<div align=center ><input type="Submit" value=" ADD " class='bgbutton'></div>
</form>


<?php
 $sql = "SELECT *  FROM certificate_m WHERE status=0";

$rs = execute($sql);

$num = rowcount($rs);

if($num){
?>

<div align="left">

  <form name="changestatus" method="post" action="AlterCertificate.php?Types=Act">
  <table border="0" cellspacing="1" width="300" align=center class='forumline'>
    <tr>
      <td width="20%" colspan="2" class='rowpic' align='center'>Deleted Certificates</td>
    </tr>
    <tr>
      <td width="20%" class="row3"><font face="Verdana"><b>Select</b></font></td>
      <td class="row3"><font face="Verdana"><b>Certificates</b></font></td>
    </tr>

<?php
	for($i=0;$i<$num;$i++){
			$rsdf = fetcharray($rs,$i);
	?>

    <tr>
      <td width="20%" class="cbody" align="Center"><input type="checkbox" name="ctname[]" value="<?=$rsdf[id]?>"></td>      <td class="cbody"><?=$rsdf["name"]?> </td>
    </tr>

<?php
	}
?>
    <tr>
      <td colspan="2" align=center > <input type="submit" value=" Activate " class='bgbutton'></td>
    </tr>
  </table>
</div>

<?php
	}

?>



</form>

</body>
</html>

