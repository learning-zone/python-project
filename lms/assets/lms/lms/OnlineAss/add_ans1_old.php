<?php
session_start();
include("../db.php");
if($_GET)
{
	$idn=$_GET['id'];
	$examname=$_GET['examname'];
	$time=$_GET['time'];
	$student_id=$_GET['student_id'];
}
else
{
	$examname=$_POST['examname'];
	$idn=$_POST['idn'];
	$time=$_POST['time'];
	$student_id=$_POST['student_id'];
}

$Questions=$_POST['Questions'];

if(isset($_POST['update']))
{
	$cid=$_POST['cid'];
	$score=$_POST['score'];
	$right_ans=$_POST['right_ans'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$idn=$cid[$i];
		
		$optionval=$_POST['optionval'.$cid[$i]];
		if($optionval!='')
		{
			if($right_ans[$i]==$optionval)
			$mark=$score[$i];
			else
			$mark=0;
			execute("INSERT INTO `online_exam_sel_mark` (`exam_id`, `ans`, `student_id`, `status`,score) VALUES ('$idn', '$optionval', '$student_id', '1','$mark');") or die(mysql_error());
				
		}
	}
	?>
	<Script language="JavaScript">
    alert("Updated successfully");
	window.close();
    </Script>
    <?php	
}
?>
<html>
<head><title></title>
<?php
$date=date("m/d/Y");
date("h:i A");
$tomorrow = mktime(0,0,date("h")+4,date("i")+30);
date("h:i A",$tomorrow);
?>
</head>

<body>
<form name="frm" method="post">
<input type="hidden" name="idn" value="<?php echo $idn; ?>">
<input type="hidden" name="examname" value="<?php echo $examname; ?>">
<input type="hidden" name="time" value="<?php echo $time; ?>">
<input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

  <br>
  <?php	
  $sql2=execute("select * from online_exam_sel_questions where exam_id='$idn' and status='1'");
	
if(rowcount($sql2)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='80%' border="1" >
<tr>
		<td align='center' class='head' nowrap>Sl.No
		</td>
		<td align='center' class='head' nowrap><?php echo $examname; ?></td>
		<td width="5%" align="right" class='head' nowrap><?php echo "Duration : ".$time; ?></td>
	</tr>
	<?php
	$i=1;
	while($r6=fetcharray($sql2))
	{
			$sql21=execute("select score from online_exam_sel_mark where exam_id='$r6[0]' and status='1'");
			$k=1;
			if(rowcount($sql21)>=1)
			{
				$flag=1;
				$ans=$r6['right_ans'];
				$desc=fetchrow($sql21);
				echo "	<tr>
						<td width='5%' align='center' valign='top' nowrap>			$i
						</td>
						<td align='justify' colspan='2' >&nbsp;&nbsp;&nbsp;$r6[que]
							<br>&nbsp;&nbsp;&nbsp;ANS : ".$r6['option'.$ans]." <div align='right'>Score : $desc[0] &nbsp;&nbsp;&nbsp;</div>
						</td>
						
					</tr>";
			}
			else
			{
				echo "<tr>
					<td align='justify' width='5%' valign='top' nowrap><input type='hidden' name='cid[]' value='$r6[0]'>
<input type='hidden' name='score[]' value='$r6[score]'>
						<input type='hidden' name='right_ans[]' value='$r6[right_ans]'>
												$i
					</td>
					<td align='justify'  colspan='2' nowrap>&nbsp;&nbsp;&nbsp;$r6[que]<br>";
					$count1=$r6[no_of_option];	
					for($k=1;$k<=$count1;$k++)
					{
						echo "&nbsp;&nbsp;&nbsp;<input type='radio' name='optionval$r6[0]' value='$k'>&nbsp;&nbsp;&nbsp;".$r6['option'.$k]."<br>";
					}
					echo "</td>
					
				</tr>";
			}
			
		$i++;
	}
	?>
	</table>
    <br>
    <?php
	if($flag!=1)
	{
	?>
  <div align='center' >
  <input type="submit" name="update" value="UPDATE"  class='bgbutton'>
	</div><?php
	}
}
?>	
  
</form>
</body>
</html>