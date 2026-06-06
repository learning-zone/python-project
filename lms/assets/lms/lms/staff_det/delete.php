<?php
require("../db.php");

if($delete_id != ""){
$SQL = "DELETE FROM staff_det WHERE id = $delete_id";
execute($SQL);
echo("<font face='Arial'><b> Record Successfuly deleted....</b></font>");
}
?>
<HTML>
<HEAD>
</HEAD>
<BODY>
</BODY>
</HTML>
