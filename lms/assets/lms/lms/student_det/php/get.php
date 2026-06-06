<?php
session_start();
include("../../db1.php");

/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

$StudID=$_SESSION['StudID'];

header("Content-type: text/xml");

echo('<?xml version="1.0" encoding="ISO-8859-1"?>');

echo '<rows id="0">';

	 $Sql=mysql_query("SELECT * FROM `student_m_pastoral` WHERE `status`=1 AND `student_id`='$StudID' ORDER BY `inserted_date`");
		
		     $slno=1;
			while($row=mysql_fetch_array($Sql))
			{	
				if($slno<10)
				    $slno="0".$slno;
					
			    	$newd=$row['selected_date'];
					$dateArray=explode('-',$newd);
					$acq_yy=$dateArray[0];
					$acq_mm=$dateArray[1];
					$acq_dd=$dateArray[2];
					$new_date="$acq_dd/$acq_mm/$acq_yy";
							
					
				 $event=mysql_fetch_array(mysql_query("SELECT `event` FROM `student_m_event` WHERE id='$row[event_id]' LIMIT 1"));	
					
				
					print("<row id='".$row['id']."'>");	
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$slno."]]></cell>");	
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$new_date."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$event['event']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['description']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['consequence']."]]></cell>");
					print("<cell><![CDATA[".'&nbsp;&nbsp;'.$row['detention']."]]></cell>");
	
					print("</row>");				 
	
				  
					$rowclass = 1 - $rowclass;
					++$slno;
	          }
	echo '</rows>';
      ?>
