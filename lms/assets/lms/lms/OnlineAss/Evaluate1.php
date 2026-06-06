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
}
else
{
	$examname=$_POST['examname'];
	$idn=$_POST['idn'];
	$time=$_POST['time'];
	$studentid=$_POST['studentid'];
	$student_id=$_POST['student_id'];
}

	//print_r($_POST);
	//echo "<br>";
	//print_r($_GET);
    //echo "<br>";
	//print_r($_REQUEST);
	
$student_id=$studentid;
$Questions=$_POST['Questions'];
if(isset($_POST['update']))
{
	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$score=$_POST['score'.$cid[$i]];
		execute("update online_exam_sel_mark set  score='$score' where id='$cid[$i]'");	
	}
		?>
		<Script language="JavaScript">
		alert("Updated Successfully");
		</Script>
		<?php		
}

?>
<html>
<head><title></title>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='Evaluate1.php';
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
$sql31=execute("SELECT student_id FROM `online_exam_sel_mark` where exam_id='$idn' and status=1 group by student_id");
while($r1=fetcharray($sql31))
{
	$student_name=fetchrow(execute("select first_name, last_name from student_m where id='$r1[0]'"));
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
		
	</tr>
	<?php
			
	$i=1;
	while($r6=fetcharray($sql2))
	{
			$sql21=execute("select score from online_exam_sel_mark where exam_id='$r6[0]' AND student_id='$student_id' and status='1'");
			$k=1;
			if(rowcount($sql21)>=1)
			{
				$flag=1;
				$ans=$r6['right_ans'];
				$desc=fetchrow($sql21);
				echo "	<tr>
						<td width='5%' align='center' valign='top' nowrap>			$i
						</td>
						<td align='justify' >&nbsp;&nbsp;&nbsp;$r6[que]
							<br>&nbsp;&nbsp;&nbsp;ANS : ".$r6['option'.$ans]."  <div align='right'>Score : $desc[0] &nbsp;&nbsp;&nbsp;</div>
						</td>
						
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
  
</form>
</body>
</html>