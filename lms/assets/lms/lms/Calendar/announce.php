<?php
include("../db.php");
$q=$_GET["q"];
$sql2=execute("SELECT description, title FROM `announcement_class` where id='$q'");
while($r2=fetcharray($sql2))
{
	echo $r2['title']."<br>".$r2['description'];
}
?>
  