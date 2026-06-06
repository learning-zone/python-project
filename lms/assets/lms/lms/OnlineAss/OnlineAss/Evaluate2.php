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
if(isset($_POST['update']))
{
	//$cid=$_POST['cid'];
	
	
	for($i=0;$i<sizeof($cid);$i++)
	{
		$temp=$cid[$i];
		$scoreval=$_POST['score'.$temp];
	
	    //echo "<br>";
		//echo "Value of cid :".$cid[$i];
		//echo "<br>";
		//echo "Value of score :".$score[$i];
		//echo "<br>";
		
		    mysql_query("update online_exam_des_mark set score='$scoreval' where ques_id='$cid[$i]' AND student_id='$student_id'");	
	    
	 }
		?>
		<Script language="JavaScript">
		alert("Updated Successfully");
		window.close();
		</Script>
		<?php		
}

?>
<html>
<head>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='Evaluate2.php';
	document.frm.submit();
	
}
</script>
<?php
$date=date("m/d/Y");
date("h:i A");
$tomorrow = mktime(0,0,date("h")+4,date("i")+30);
date("h:i A",$tomorrow);
?>
</head>

<body>
<form name="frm" method="post">

  <br>
<div align="center">Select Student :
<select name="studentid"  onchange='reload()'>
<option value='0'>Select</option>
<?php
$sql31=mysql_query("SELECT student_id FROM `online_exam_des_mark` where exam_id='$idn' and status=1 group by student_id");
while($r1=mysql_fetch_array($sql31))
{
	$student_name=mysql_fetch_row(mysql_query("select first_name, last_name from student_m where id='$r1[0]'"));
	if($studentid==$r1[0])
	{
		echo "<option value='$r1[0]' selected>$student_name[0] $student_name[1]</option>";
	}
	else
	{
		echo "<option value='$r1[0]'>$student_name[0] $student_name[1] </option>";
	}	
}
?>
</select>

</div>
<input type="hidden" name="idn" value="<?php echo $idn; ?>">
<input type="hidden" name="examname" value="<?php echo $examname; ?>">
<input type="hidden" name="time" value="<?php echo $time; ?>">
<input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
  <?php	
  $sql2=mysql_query("select * from `online_exam_des_questions` where exam_id='$idn' and status='1'");
    
	
if(mysql_num_rows($sql2)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='80%' border="1" >
<tr>
		<td align='center' class='head' nowrap>Sl.No
		</td>
		<td align='center' class='head' nowrap><?php echo $examname; ?></td>
		
	</tr>
	<?php
			
	$i=1;
	$v=0;
	while($r6=mysql_fetch_array($sql2))
	{      
			  
	   $sql21=mysql_query("select score from `online_exam_des_mark` where exam_id='$idn' AND student_id='$student_id' and status='1' AND ques_id='$r6[0]' ORDER BY ques_id");
	   $ans=mysql_fetch_row(mysql_query("select Description from `online_exam_des_mark` where exam_id='$idn' AND student_id='$student_id' and status='1' AND ques_id='$r6[0]' ORDER BY ques_id"));
	   $score_disp=mysql_fetch_array(mysql_query("select score from `online_exam_des_mark` where exam_id='$idn' AND student_id='$student_id' and status='1' AND ques_id='$r6[0]' ORDER BY ques_id"));
		
            $answer=$ans[0];
			$k=1;
			if(mysql_num_rows($sql21)>=1)
			{
			
				$desc=mysql_fetch_row($sql21);
				?>
				<tr>
					  <td width='5%' align='center' valign='top' nowrap>			<?=$i?>
					  </td>
					  <td align='justify' >&nbsp;&nbsp;&nbsp;<?=$r6[Description]?>
					  <br>&nbsp;&nbsp;&nbsp;ANS : <?=$answer?>  
					  <div align='right'>Score : <input type="text" name="score<?=$r6[0]?>" size="2" value="<?=$score_disp[0]?>" maxlength="2"/>&nbsp;&nbsp;&nbsp;</div>
						</td>
						
					</tr>
				<?

				 	   
			}
			
			           echo "<input type='hidden' name='cid[]' value='$r6[0]'>";
       
		$i++;
		$v++;

	}
	?>
	</table>
    <br>
 
  <div align='center' >
  <input type="submit" name="update" value="UPDATE"  class='bgbutton'>
 
	</div><?php
	
}
?>	
      
</form>
  
</form>
</body>
</html>