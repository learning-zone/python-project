<?php
session_start();
include("../db.php");

?>
<html>
<head>
<title>TESTING</title>
</head>
<body>
<?PHP
	$n=10;
	$q=$n-1;
	for($i=1;$i<=$n;$i++)
	{

		//echo $i;
		echo "<BR>".$q.'----';
		if($i==$q)
		{
			echo 'About to End';
		}
		
	}
?>
