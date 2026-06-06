<?php
session_start();
include("../db1.php");
$scoredmark=$_GET["q"];
$maxmark=$_GET["sid"];
$newmark=($scoredmark/$maxmark)*100;
 
			$mxam=execute("SELECT name FROM grade WHERE $newmark BETWEEN g_from AND g_to");	
			$maxmark=fetchrow($mxam);
			echo $maxmark[0];
			

?>
