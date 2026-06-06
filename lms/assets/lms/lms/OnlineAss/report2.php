<?php
session_start();
include("../db.php");
if($_GET)
{
	$idn=$_GET['id'];
	$examname=$_GET['examname'];
	$time=$_GET['time'];
	$student_id=$_GET['student_id'];
	$studentid=$_GET['studentid'];
	$cid=$_GET['cid'];
	$score=$_GET['score'];
}
else
{
	$examname=$_POST['examname'];
	$idn=$_POST['idn'];
	$time=$_POST['time'];
	$studentid=$_POST['studentid'];
	$student_id=$_POST['student_id'];
	$cid=$_POST['cid'];
	$score=$_POST['score'];
}


	//echo "<br>";
	//print_r($_GET);
    //echo "<br>";
	//print_r($_POST);

	
$student_id=$studentid;
$Questions=$_POST['Questions'];
?>
<html>
<body>

<table align='center' class='forumline' width='80%' border="1" >
<tr>
	<td align='center' class='head' colspan="6" nowrap><?php echo $examname; ?></td>
</tr>
<tr>
		<td align='center' class='row3' nowrap>Sl.No</td>
		<td align='center' class='row3' nowrap>Student Name</td>
		<td align='center' class='row3' nowrap>Student ID</td>
		<td align='center' class='row3' nowrap>Max Scores</td>
		<td align='center' class='row3' nowrap>Obtained Scores</td>
		<td align='center' class='row3' nowrap>Scores (%)</td>
		
		
</tr>

	<?php
	
  $result=execute("select * from `online_exam_des_mark` where status='1' GROUP BY student_id");
	
 if(rowcount($result)>0)
 {
	 $SlNo=1;
	 
	 
	  while($row=fetcharray($result))
      { 
	  		
	
	  	  $fname=fetcharray(execute("select first_name from student_m where id='$row[0]'"));
		  $lname=fetcharray(execute("select last_name from student_m where id='$row[0]'"));
	  	  $max_score=fetcharray(execute("select SUM(score) from `online_exam_des_questions` where exam_id='$idn' and status='1'")); 
	      $obt_score=fetcharray(execute("select SUM(score) from `online_exam_des_mark` where student_id='$row[0]' AND ques_id='$idn' AND status='1'"));
		  
		  //echo "<br>";
		  //echo "idn :".$idn;
		  //echo "max_score :".$max_score[0];
		  //echo "obt_score :".$obt_score[0];
		  
		  $score_per=($obt_score[0]*100)/$max_score[0];
		  $score_per=round($score_per,0);
		  
		?>
		<tr>
			    <td align="center"><?=$SlNo?></td>
		        <td>&nbsp;&nbsp;<?=$fname[0]?>&nbsp;<?=$lname[0]?></td>
				<td align="center"><?=$row['student_id']?></td>
				<td align="center"><?=$max_score[0]?></td>
				<td align="center"><?=$obt_score[0]?></td>
				<td align="center"><?=$score_per?> (%)</td>
		</tr>
		<? 
		   $SlNo = $SlNo + 1;  
     
	  }
	
	  
  }
?>

</table>  
</form>
  
</form>
</body>
</html>