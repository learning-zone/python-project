<?php
session_start();
include("../connection.php");
$q=$_GET["q"];
echo"<select name=combodep onchange=showjobs(this.value)><option value=select>-SELECT-</option>";
$q1=mysql_query("select * from ac_institution where iIdx_organization='".$q."'");
while($r1=mysql_fetch_assoc($q1))
{

				
                echo "<option value='".$r1[iIdx_institution]."'>".$r1[vinstitution]."</option>";
                
             
}
 echo "</select>";
?>