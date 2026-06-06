<?php
session_start();
include("../../db1.php");

/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

header("Content-type: text/xml");

echo('<?xml version="1.0" encoding="ISO-8859-1"?>');

echo '<rows id="0">';

	 $Sql=mysql_query("SELECT * FROM `student_m_ec` WHERE `status`=1 ORDER BY `inserted_date`");
		
		     $slno=1;
			while($row=mysql_fetch_array($Sql))
			{	
				if($slno<10)
				    $slno="0".$slno;
					
					print("<row id='".$row['id']."'>");	
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$slno."]]></cell>");	
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['fname']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['lname']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['relation']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['countryCode']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['home_phone']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['cell_phone']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['work_phone']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['email']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['note']."]]></cell>");
			
					print("</row>");				 
	
				  
					$rowclass = 1 - $rowclass;
					++$slno;
	          }
	echo '</rows>';
      ?>
