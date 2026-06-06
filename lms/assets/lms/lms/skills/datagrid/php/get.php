<?php
//session_start();
//error_reporting(E_ALL ^ E_NOTICE);

require_once('../common/config.php');

//include XML Header (as response will be in xml format)
header("Content-type: text/xml");

echo('<?xml version="1.0" encoding="ISO-8859-1"?>');

//start output of data
echo '<rows id="0">';

//output data from DB as XML
$sql = "SELECT  * from customers";
$res = mysql_query ($sql) or die(mysql_error());
		

	
		$count=1;
	while($row=mysql_fetch_array($res))
	{
		
		//create xml tag for grid's row
		print ("<row id='".$row['customerNumber']."'>");
		print("<cell><![CDATA[$count]]></cell>");
		print("<cell><![CDATA[".$row['customerName']."]]></cell>");
		print("<cell><![CDATA[".$row['contactLastName']."]]></cell>");
		print("<cell><![CDATA[".$row['contactFirstName']."]]></cell>");
		print("<cell><![CDATA[".$row['phone']."]]></cell>");
		print("<cell><![CDATA[".$row['city']."]]></cell>");
		print("<cell><![CDATA[".$row['state']."]]></cell>");
		print("<cell><![CDATA[".$row['postalCode']."]]></cell>");
		print("</row>");
		
			++$count;
}


echo '</rows>';

?>