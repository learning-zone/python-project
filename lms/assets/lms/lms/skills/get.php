<?php
session_start();
include("../db.php");
$subject=$_REQUEST['subject'];
$Type=$_REQUEST['Type'];

//include db connection settings
//change this setting according to your environment


//include XML Header (as response will be in xml format)
header("Content-type: text/xml");
//encoding may be different in your case
echo('<?xml version="1.0" encoding="utf-8"?>'); 

//start output of data
echo '<rows id="0">';

//output data from DB as XML

			$subdet=fetchrow(execute("SELECT elective,course_year_id FROM subject_m WHERE subject_id='$subject'"));
			if($subdet[0]=='N')
			{
				$sql=execute("SELECT student_id, first_name, last_name FROM student_m WHERE course_yearsem='$subdet[1]' and archive='N' order by first_name");
			}
			else
			{
				$sql=execute("SELECT a.student_id, a.first_name, a.last_name FROM student_m a, student_course b WHERE a.archive='N' and b.`sub`='$subject' and a.id=b.stu_id and b.acc_year=a.academic_year group by  a.student_id  order by a.first_name ");	
			}
	 
			$qResult = execute ("SELECT * FROM `grade_avg` WHERE `subject` = '$subject' AND `status` ='1'");
			$itms=fetcharray($qResult);
			
        $method=fetcharray(execute("SELECT `cal_method` FROM `grade_setup` WHERE `subject` = '$subject' AND `status`=1"));
		  
				$sno=1;
				$count=1;
				$k = 9;
				
            while($r=fetcharray($sql))
			{
				
				if($sno<10)
				{
					$sno="0".$sno;
				}
				
				if($i%2)
					echo "<tr class=''>";
				else
					echo "<tr>";
					
					
			$qResult = execute ("SELECT * FROM `grade_avg` WHERE `subject` = '$subject' AND `status` ='1'");
			$itms=fetcharray($qResult);
			
        $method=fetcharray(execute("SELECT `cal_method` FROM `grade_setup` WHERE `subject` = '$subject' AND `status`=1"));
		  
				$sno=1;
				$count=1;
				$k = 9;
				
            while($r=fetcharray($sql))
			{
				
				if($sno<10)
				{
					$sno="0".$sno;
				}
				
				if($i%2)
					echo "<tr class=''>";
				else
					echo "<tr>";
					
					echo ("<row id='".$sno."'>");
					
					print("<cell><![CDATA[".$r['first_name'].$r['last_name']."]]></cell>");

       //++++++++++++++++++++++++++++++++++++++++++   TO FETCH EXSISTING COLUMN NAME  +++++++++++++++++++++++++++++++++++++++++++
			//echo "<br>SELECT * FROM grade_m_$subject WHERE `student_id` = '$r[student_id]' AND `status` = '1'";
			$SqlAvg=execute("SELECT * FROM grade_m_$subject WHERE `student_id` = '$r[student_id]' AND `status` = '1'");
			
			while($rAvg=fetcharray($SqlAvg))
			{	
						
				$SqlCat=execute("SELECT `id` FROM `grade_category` WHERE `subject` = '$subject' AND `status` = '1'");
				$rowCountFirst=rowcount($SqlCat); 
				
				while($rf=fetcharray($SqlCat))
				{		
				
	$SqlAssm=execute("SELECT `id` FROM `grade_assessment` WHERE `subject` = '$subject' AND `status` =1 AND category_id='$rf[id]'");
					$rowCount=rowcount($SqlAssm); 
						//echo "<br>category :".$category;
						$field='avg_'.$rf['id'];
						//echo "<br>rowCount :".$rowCount;
						if($method['cal_method']==1){
							$points=$rAvg[$field] * $rowCount;
							
					print("<cell><![CDATA[".$points."]]></cell>");
				
						}if($method['cal_method']==2){
							
					print("<cell><![CDATA[".$rAvg[$field]."]]></cell>");
				
						}
				   		$sum = $sum + $rAvg[$field];
						
						
				}
						$avg = round(($sum / $rowCountFirst),0);
						
					print("<cell><![CDATA[".$avg."]]></cell>");
					
						//echo $itms['avg1']."\t";
						//echo $itms['avg2']."\t";
						//echo $avg;
						if($avg <= $itms['avg1'] and $avg > $itms['avg2']){				/*CONDITIONS FOR DISPALY GRADES*/
							$display=$itms['letter1'];		
						}else if($avg <= $itms['avg2'] and $avg > $itms['avg3']){
							$display=$itms['letter2'];
						}else if($avg <= $itms['avg3'] and $avg > $itms['avg4']){
							$display=$itms['letter3'];
						}else if($avg <= $itms['avg4'] and $avg > $itms['avg5']){
							$display=$itms['letter4'];
						}else if($avg <= $itms['avg5'] and $avg > $itms['avg6']){
							$display=$itms['letter5'];
						}else if($avg <= $itms['avg6'] and $avg > $itms['avg7']){
							$display=$itms['letter6'];
						}else if($avg <= $itms['avg7'] and $avg > $itms['avg8']){
							$display=$itms['letter7'];
						}else if($avg <= $itms['avg8'] and $avg > $itms['avg9']){
							$display=$itms['letter8'];
						}else if($avg <= $itms['avg9'] and $avg > $itms['avg10']){
							$display=$itms['letter9'];
						}else if($avg <= $itms['avg10'] and $avg > $itms['avg11']){
							$display=$itms['letter10'];
						}else if($avg <= $itms['avg11'] and $avg > $itms['avg12']){
							$display=$itms['letter11'];
						}else if($avg <= $itms['avg12'] and $avg > $itms['avg13']){
							$display=$itms['letter12'];
						}else if($avg <= $itms['avg13'] and $avg > $itms['avg14']){
							$display=$itms['letter13'];
						}else if($avg <= $itms['avg14'] and $avg > $itms['avg15']){
							$display=$itms['letter14'];
						}else{
							$display=$itms['letter15'];
						}
						
						
					print("<cell><![CDATA[".$display."]]></cell>");
					print("</row>");
				
				     $sum=0;
					 
			}
		
			
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			 
			++$count;
			++$sno;
			++$i;
		      
		    $rowclass = 1 - $rowclass;
	}

 }

?>