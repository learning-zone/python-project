<?php
include("CreateCSV.class.php");
$conn = mysql_connect("localhost", "root", "");

$sql = "SELECT * FROM ac_login";

#Thanks for nlstart's suggestions, now this class support quoted for CSV value.

//To print out the record without column heading and all values are quoted
print CreateCSV::create($sql);

//To print out the record without column heading and all values are NOT quoted
print CreateCSV::create($sql, false, false);

//To print out the record with column heading and all values are quoted
print CreateCSV::create($sql, true);

//To print out the record with column heading and all values are NOT quoted
print CreateCSV::create($sql, true, false);

?>