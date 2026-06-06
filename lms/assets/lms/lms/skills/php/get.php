<?php
session_start();
include("../../db1.php");

if($_SESSION)
{
	$Type=$_SESSION['Type'];
	$term = $_SESSION['term'];
	$user = $_SESSION['user'];
	$subject = $_SESSION['subject'];
	$a_year = $_SESSION['AcademicYear'];
}

/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

header("Content-type: text/xml");

echo('<?xml version="1.0" encoding="ISO-8859-1"?>');

echo '<rows id="0">';


	  		$sql=mysql_query("SELECT a.id,a.first_name,a.last_name FROM student_m a,student_course b WHERE b.stu_id=a.id AND b.sub_sec='$subject' AND b.acc_year='$a_year' GROUP BY b.stu_id ORDER BY a.first_name");
	 

			
			$qResult = mysql_query ("SELECT * FROM `grade_avg` WHERE `subject` = '$subject' AND `status` =1");
			$itms=mysql_fetch_array($qResult);
			
        $method=mysql_fetch_array(mysql_query("SELECT `cal_method` FROM `grade_setup` WHERE `subject` ='$subject' AND `status`=1"));
		  
				$sno=1;
				$count=1;
						
            while($r=mysql_fetch_array($sql))
			{
								
       //++++++++++++++++++++++++++++++++++++++++++   TO FETCH EXSISTING COLUMN NAME  +++++++++++++++++++++++++++++++++++++++++++
			 $tablename='grade_m_'.$subject.'_'.$term;
						 
	$SqlAvg=mysql_query("SELECT * FROM $tablename WHERE `student_id` = '$r[id]' AND `status` =1");
			$avg_sum=0;
			while($rAvg=mysql_fetch_array($SqlAvg))
			{	
			    //echo "<br>Rows :".$rAvg[id];
	            print("<row id='".$rAvg['id']."'>");
				print("<cell><![CDATA[$count]]></cell>");		
				print("<cell><![CDATA[".'&nbsp;'.$r['first_name'].'&nbsp;'.$r['last_name']."]]></cell>");
						
				$SqlCat=mysql_query("SELECT `id`,`weight` FROM `grade_category` WHERE `subject` = '$subject' AND `status` =1");
				$rowCountFirst=rowcount($SqlCat); 
				$sum=0;
				while($rf=mysql_fetch_array($SqlCat))
				{		
				
	$SqlAssm=mysql_query("SELECT `id` FROM `grade_assessment` WHERE `subject` = '$subject' AND `status`=1 AND category_id='$rf[id]'");
					$rowCount=rowcount($SqlAssm); 
						
						$field='avg_'.$rf['id'];						

				   		$sum = $sum + $rAvg[$field];						
				}
				
						$avg = round(($sum / $rowCountFirst),0);
			    
				
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
						
		
	$grade=mysql_fetch_array(mysql_query("SELECT `grade_type` FROM `grade_setup` WHERE `subject` ='$subject' AND `term`=$term AND `status`=1"));
	
			if($grade['grade_type']=='number' and $Type!="comments"){
				
				print("<cell><![CDATA[".'&nbsp;&nbsp;'.$avg."]]></cell>");


	 		}elseif($grade['grade_type']=='alphabet' and $Type!="comments"){
				
				print("<cell><![CDATA[".'&nbsp;&nbsp;'.$display."]]></cell>");


				}
				else{
					
                    print("<cell><![CDATA[".'&nbsp;&nbsp;'.$rAvg['comments']."]]></cell>");
                    /*<textarea type="text" Name="<?=$r['student_id']?>comments" style="width: 98%;"><?=$rAvg['comments']?></textarea>*/
				}
				     $sum=0;
				print("</row>");				 
			}
					
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			 
		++$count;
		++$sno;
		++$i;
		      
		$rowclass = 1 - $rowclass;
	}
	echo '</rows>';
 ?>
