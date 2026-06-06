<?php
session_start();
include("../connection.php");
$q=$_GET["q"];
$q1=mysql_query("select * from ac_institution where iIdx_organization='".$q."'");
 echo "<select name=cmbdep> <option value=select>-SELECT-</option>";
	  while ($row1 = mysql_fetch_assoc($q1))
      {
				 
				 
	
        echo "<option value='".$row1[iIdx_institution]."'>".$row1[vinstitution]." </option>";
        } 
     echo " </select> ";
?>