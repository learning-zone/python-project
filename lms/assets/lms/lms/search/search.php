<?php
include("../../../db.php");
$first_n=$_POST("first_n");
$mob=$_POST("mob");
?>
<html>
<title>
From
</title>
<body>
<from name="search" method="post" action="in_search.php">
<table cellspacing="10" cellpadding="8" width="50%" border="0" align="center">
  <tr>
    <td colspan="6" align="center" width="50%"><strong>Search Customer Detail</strong></td>
   </tr>
  <tr height="90%">
    <td>Customer Name:</td>
    <td><input name="first_n" type="text"></td>
  </tr>
  <tr>
    <td>Mobile No:</td>
    <td><input name="mob" type="text"></td>
  </tr>
  <td colspan="6" align="center"><input value="Search" type="submit" class="bgbutton"></td>
  <tr>
  </tr>
</table>
</from>
<?php

?>
