<?PHP
session_start();
require("../db.php");

//print_r($_GET);
		
$a_year = $_SESSION['AcademicYear'];


if($_GET)
{
	$sem=$_GET['sem'];
	$unit=$_GET['unit'];
	$term=$_GET['Key2'];
	$branch=$_GET['branch'];
	$student_id=$_GET['Key1'];
}
$term=base64_decode($term);
$student_id=base64_decode($student_id);

	$studentDet=fetcharray(execute("SELECT `first_name`,`middle_name`,`last_name`,`dob`,`student_id`,`course_yearsem`,`admission_date` FROM `student_m` WHERE `id`='$student_id'"));
	
	$termDet=fetcharray(execute("SELECT `start_date` FROM `academic_term` WHERE `a_year`='$a_year'"));
	/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/
	


?>
<!DOCTYPE html>
<head>
	<title>TEACHER COMMENTS</title>
<style>
body
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}
.editbox
{
  	display:none
}
/*td
{
	padding:5px;
}*/
.editbox
{
	font-size:14px;
	background-color:#ffffcc;
	border:solid 1px #000;
	padding:4px;
}
.edit_tr:hover
{
	/*background-color:#6600CC;*/
	background:url(edit.png) right no-repeat #80C8E5; 
	cursor:pointer;
}

</style>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".edit_tr").click(function()
{
  var ID=$(this).attr('id');
  $("#first_"+ID).hide();
  $("#first_input_"+ID).show();
  }).change(function()
{
  var ID=$(this).attr('id');
  var first=$("#first_input_"+ID).val();
  temp = encodeURIComponent(first);
  //alert(ID);
  var dataString = 'id='+ ID + '&comment=' + temp;
  $("#first_"+ID).html('<img src="loader.gif" />'); // Loading image
	
//if(first.length>0)
{

  $.ajax({
  type: "POST",
  url: "table_edit_ajax2.php",
  data: dataString,
  cache: false,
  success: function(html) {
	$("#first_"+ID).html(first);
  }
 });
}
//else
{
  //alert('Enter something.');
}

});

// Edit input box click action
$(".editbox").mouseup(function() 
{
  return false
});

// Outside click action
$(document).mouseup(function()
{
  $(".editbox").hide();
  $(".text").show();
});

});
</script>
</head>
<body><BR>
 <table width="98%" border="1" align="center" cellspacing="0" cellpadding="0" class="forumline"  >
 <tr height="25">
 	<td class="head" align="center" colspan="6" title="Student Name"><?=$studentDet['first_name']?>&nbsp;<?=$studentDet['last_name']?></td>
 </tr>
   <tr height="25">
          
          <td align="center" class="row3" width="15%" nowrap>&nbsp;Subject&nbsp;</td>
          <td align="center" class="row3" width="15%" nowrap>&nbsp;Teacher&nbsp;</td>
          <td align="center" class="row3" width="5%" nowrap>&nbsp;Mid-Sem 1&nbsp;</td>
          <td align="center" class="row3" width="5%" nowrap>&nbsp;End-Sem 1&nbsp;</td>
          <td align="center" class="row3" width="50%" nowrap>&nbsp;Teacher Comments&nbsp;</td>
     </tr><tr>
  <?
  
  	//echo "<br>SELECT * FROM student_course a,class_section b,subject_m c WHERE a.stu_id='$student_id' and a.acc_year='$a_year' and a.sub_sec=b.id  AND b.status=1 AND c.subject_id=b.sub AND  c.sub_type!=3 AND b.grade!=0 group by sub_sec order by sub_type";
	

  	$sqlSub=execute("SELECT * FROM student_course a,class_section b,subject_m c WHERE a.stu_id='$student_id' and a.acc_year='$a_year' and a.sub_sec=b.id  AND b.status=1 AND c.subject_id=b.sub AND  c.sub_type!=3 AND b.grade!=0 group by sub_sec");
	
 while($rSub=fetcharray($sqlSub))
 {
	
	$teacherID=fetcharray(execute("SELECT sub_teac,sub_teac2,home_teac,sub_type FROM all_teachers WHERE section='$rSub[sub_sec]' AND acc_year='$a_year'"));	
	$className=fetcharray(execute("SELECT subject_name FROM subject_m WHERE subject_id='$rSub[subject_id]' AND status=1"));
	
	if($teacherID['sub_teac']){
		$teacherName=fetcharray(execute("SELECT `f_name`,`s_name` FROM staff_det WHERE id='$teacherID[sub_teac]' AND `active`='YES'"));
	}
	else
	{
		$teacherName=fetcharray(execute("SELECT `f_name`,`s_name` FROM staff_det WHERE id='$teacherID[sub_teac2]' AND `active`='YES'"));
	}
	if($teacherID['sub_type']==2)
	{
		$teacherName=fetcharray(execute("SELECT `f_name`,`s_name` FROM staff_det WHERE id='$teacherID[home_teac]' AND `active`='YES'"));
	}
	
			$subject=$rSub['sub_sec'];
			$tablename='grade_m_'.$subject.'_'.$term;

			
			$studentMarks=fetcharray(execute("SELECT `comments`,`category`,`category1`,`subject` FROM $tablename WHERE `student_id`='$student_id'"));
			

	/*DISPLAY ASSIGNMENT FOLLOWED BY CATEGORY*/
	 
	  $resultCol=execute("SELECT a.title, a.max_point, a.inserted_date, a.description, a.apply_grade, a.grade_type, b.id FROM grade_assessment a, grade_category b WHERE a.subject=$subject and a.status=1 AND b.status=1 AND a.category_id=b.id ORDER BY a.category_id");
		$rowCount=rowcount($resultCol);
		
		$resultCount=execute("SELECT `id` FROM `grade_assessment` WHERE `subject`='$subject' AND `apply_grade`='Y'  and status=1 ORDER BY category_id");
		$NoRowCount=rowcount($resultCount);
 

				$sql=execute("SELECT a.id,a.student_id,a.first_name,a.last_name,a.admission_id,a.course_yearsem FROM student_m a,student_course b WHERE b.stu_id=a.id  AND a.archive='N' AND b.sub_sec='$subject' AND b.acc_year='$a_year' AND a.id='$student_id' group by b.stu_id ORDER BY a.first_name LIMIT 1");	
			
	  ?>
      
     
      <tr>
        <?php
			
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
					
	
       //++++++++++++++++++++++++++++++++++++++++++   TO FETCH EXSISTING COLUMN NAME  +++++++++++++++++++++++++++++++++++++++++++
			$tablename='grade_m_'.$subject.'_'.$term;
			
			//echo $tablename;
	
	
	$SqlAvg=execute("SELECT * FROM $tablename WHERE `student_id` = '$r[id]' AND `status` = 1 AND `term`='$term'");
		 $rowAvg=rowcount($SqlAvg);
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

$resultColV=execute("SELECT a.category_id, a.title, a.max_point, a.inserted_date, a.description, a.apply_grade, a.grade_type FROM grade_assessment a ,grade_category b WHERE a.subject=$subject AND a.status=1 AND b.status=1 AND a.category_id=b.id ORDER BY a.category_id");



		$rowCount=rowcount($resultColV);
		
	
		$resultCount=execute("SELECT `id` FROM `grade_assessment` WHERE `subject`=$subject AND `apply_grade`='Y'  and status=1 ORDER BY category_id");
		$NoRowCount=rowcount($resultCount);
		
				 $sum=0;		 
		while($rCol=fetcharray($resultColV))      
		{
			
			$string = str_replace(' ', '_', $rCol['title']);
			$field=$string.'_'.$rCol['category_id'];
			
			$tablename='grade_m_'.$subject.'_'.$term;
			
					
			$colValue=fetcharray(execute("SELECT `category`,`category1`,$field FROM `$tablename` WHERE `term`='$term' AND student_id='$r[id]' LIMIT 1"));
			
		}

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
			
			$avg_sum=0;
			while($rAvg=fetcharray($SqlAvg))
			{	
						
				
				$SqlCat=execute("SELECT `id`,`weight` FROM `grade_category` WHERE `subject` = '$subject' AND `status` = '1'");
			    $rowCountFirst=rowcount($SqlCat); 
				
				while($rf=fetcharray($SqlCat))
				{		
	
	
	$SqlAssm=execute("SELECT `id` FROM `grade_assessment` WHERE `subject` = '$subject' AND `status` =1 AND category_id='$rf[id]'");
					$rowCount=rowcount($SqlAssm); 
				
						$field='avg_'.$rf['id'];
						
						if($method['cal_method']==1){
	
							$points=$rAvg[$field] * $rowCount;
						
				   ?>
                	   <td align="center" nowrap><?=$points?></td>
                   <?
						}if($method['cal_method']==2){
							
							$avg_sum = $avg_sum + (($rAvg[$field] * $rf['weight']))/100;

						}
						
					}

						$avg=$avg_sum;
					
						if($avg <= $itms['avg1'] and $avg > $itms['avg2']){				/*CONDITIONS FOR DISPALY GRADES*/
							$display=$itms['letter1'];		
						}elseif($avg <= $itms['avg2'] and $avg > $itms['avg3']){
							$display=$itms['letter2'];
						}elseif($avg <= $itms['avg3'] and $avg > $itms['avg4']){
							$display=$itms['letter3'];
						}elseif($avg <= $itms['avg4'] and $avg > $itms['avg5']){
							$display=$itms['letter4'];
						}elseif($avg <= $itms['avg5'] and $avg > $itms['avg6']){
							$display=$itms['letter5'];
						}elseif($avg <= $itms['avg6'] and $avg > $itms['avg7']){
							$display=$itms['letter6'];
						}elseif($avg <= $itms['avg7'] and $avg > $itms['avg8']){
							$display=$itms['letter7'];
						}elseif($avg <= $itms['avg8'] and $avg > $itms['avg9']){
							$display=$itms['letter8'];
						}elseif($avg <= $itms['avg9'] and $avg > $itms['avg10']){
							$display=$itms['letter9'];
						}elseif($avg <= $itms['avg10'] and $avg > $itms['avg11']){
							$display=$itms['letter10'];
						}elseif($avg <= $itms['avg11'] and $avg > $itms['avg12']){
							$display=$itms['letter11'];
						}elseif($avg <= $itms['avg12'] and $avg > $itms['avg13']){
							$display=$itms['letter12'];
						}elseif($avg <= $itms['avg13'] and $avg > $itms['avg14']){
							$display=$itms['letter13'];
						}elseif($avg <= $itms['avg14'] and $avg > $itms['avg15']){
							$display=$itms['letter14'];
						}else{
							$display=$itms['letter15'];
						}
						 
			
					?>
                  
                    
                     <td align="left" width="10%">&nbsp;<?=$className['subject_name']?></td>
         			 <td align="left" width="12%">&nbsp;<?=$teacherName['f_name']?>&nbsp;<?=$teacherName['s_name']?></td>
                      
                      <? 
					  if($colValue[category]){
 							
				 		$graceValue=fetcharray(execute("SELECT `letter` FROM `grade_grace` WHERE `id`='$colValue[category]'"));						
				      ?>
          			  <td align="left" width="5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$graceValue[letter]?> </td>
                                
                      <?   }else{  
				
					   ?>
                      <td align="left" width="5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$display?> </td>         					
					
                    <?
					  }
                  
					  if($colValue[category1]){
 						
				 		$graceValue1=fetcharray(execute("SELECT `letter` FROM `grade_grace` WHERE `id`='$colValue[category1]'"));
							
							if($rowCount != 0){	
				      ?>
          			  <td align="left" width="5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$graceValue1[letter]?></td>

                      <?   }else{
						  ?>
                       <td align="left" width="5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <?
					  }}else{  
				
					?>
                      <td align="left" width="5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$display?></td>
                    <?
							
							
					  }
					  
					 ?>
                     
                     <td align="left" id="<?=$student_id?>_<?=$studentMarks['subject']?>" class="edit_tr" title="<?=stripslashes($studentMarks['comments'])?>" > 
            <div style="overflow-x:hidden;overflow-y:scroll; height:70px">           					
           <span id="first_<?=$student_id?>_<?=$studentMarks['subject']?>" class="text" style="width:70px; height:22px"><?=stripslashes($studentMarks['comments'])?></span>
           <textarea class="editbox" id="first_input_<?=$student_id?>_<?=$studentMarks['subject']?>" style="width:98%;height:70px" ><?=stripslashes($studentMarks['comments'])?></textarea></div></td>
                      
     </tr>
                     <?
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
    </table>
</body>
</html>