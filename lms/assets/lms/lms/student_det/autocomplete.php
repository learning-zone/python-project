<?php
include("../db3.php");
/*
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}
if (!mysql_select_db("myschool_mbis")) {
   echo "Unable to select mydbname: " . mysql_error();
   exit;
}*/

$result = mysql_query("SELECT `first_name` FROM `student_m`");
while ($row = mysql_fetch_assoc($result)) 
{
   		$names[]=$row['first_name'];
}
mysql_free_result($result);
mysql_close($link);

// check the parameter
if(isset($_GET['part']) and $_GET['part'] != '')
{
	// initialize the results array
	$results = array();

	// search colors
	foreach($names as $name)
	{
			
		    $name=strtolower($name);
		// if it starts with 'part' add to results
		if( strpos($name, $_GET['part']) === 0 )
		{
			
			$name=ucfirst($name);
			$results[] = "<font style='Segoe UI', Arial, Verdana, Helvetica, sans-serif'><a href='select_stud_mod2.php?searchField=$name'>".$name."</a></font>";

		}
	}

	// return the array as json with PHP 5.2
	echo json_encode($results);
}