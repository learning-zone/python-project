<?php
session_start();
include("../db.php");
if($_GET)
{
	$idn=$_REQUEST['id'];
	$examname=$_REQUEST['examname'];

}
else
{
	$examname=$_POST['examname'];
	$idn=$_POST['idn'];
}
$score=$_POST['score'];
$Questions=$_POST['Questions'];
if(isset($_POST['update']))
{
	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$score=$_POST['score'.$cid[$i]];
		$Questions=$_POST['Questions'.$cid[$i]];
		mysql_query("update online_exam_des_questions set Description='$Questions', score='$score' where id='$cid[$i]'");	
	}
		?>
		<Script language="JavaScript">
		alert("Successfully Modified ");
		</Script>
		<?php		
}
if(isset($_POST['save']))
{
	if($Questions!='' and $score!='')
	{
		$sql2=mysql_query("select * from online_exam_des_questions where exam_id='$idn' and Description='$Questions' and status='1'");
		if(mysql_num_rows($sql2)>=1)
		{
			?>
			<Script language="JavaScript">
			alert("Duplicate entry not allowed");
			</Script>
			<?php
		}
		else
		{
	
			mysql_query("INSERT INTO `online_exam_des_questions` (`exam_id`, `Description`, `score`, `status`) VALUES ('$idn', '$Questions', '$score', '1');") or die(mysql_error());
			?>
			<Script language="JavaScript">
			alert("Updated successfully");
			</Script>
			<?php	
		}
	}
	else
	{
			?>
			<Script language="JavaScript">
			alert("Null data");
			</Script>
			<?php
		
	}
}
?>
<html>
<head><title>MASTER Questions</title>
</head>
<body>
<form name="frm" method="post">
<input type="hidden" name="idn" value="<?php echo $idn; ?>">
<input type="hidden" name="examname" value="<?php echo $examname; ?>">
<table align='center' class='forumline' width='80%' border="1" >
<tr>
  <td colspan=2 align='center' class='head'>Add Questions For <?php echo $examname; ?></td></tr>
	<tr>
		<td align='center' class='row3' nowrap>Questions</td>
		<td align='center' class='row3' nowrap>Score</td>
	</tr>
	<tr>
      <td align='center' nowrap>
           <textarea name='Questions' rows='4' cols='80' ></textarea>
		</td>
        <td align='center' nowrap>
        <input type='text' name='score' value='' maxlength="2" size="2" width="2">
		</td>
		
	</tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'>
  <br>
  
  <br>
  <?php	
  $sql2=mysql_query("select * from online_exam_des_questions where exam_id='$idn' and status='1'");
	
if(mysql_num_rows($sql2)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='80%' border="1" >
<tr>
		<td align='center' class='head' nowrap>Sel
		</td>
		<td align='center' class='head' nowrap><span class="row3">Questions</span></td>
		<td align='center' class='head' nowrap>Score</td>
		
	</tr>
	<?php
	while($r6=mysql_fetch_array($sql2))
	{
	echo "	<tr>
			<td align='center'  nowrap>
				<input type='checkbox' name='cid' value='$r6[0]'>
			</td>
		 	<td align='center' nowrap> 
				<textarea name='Questions$r6[0]' rows='3' cols='60' >$r6[2]</textarea> 
			</td>
        	<td align='center' nowrap>
        		<input type='text' name='score$r6[0]' value='$r6[3]' maxlength='2' size='2' width='2'>
			</td>
		</tr>";
	}
	?>
	<?php
	?>
	</table>
    <br>
  <div align='center' >
  <input type="submit" name="update" value="UPDATE"  class='bgbutton'>
	
	</div><?php
}
?>	
  
</form>
</body>
</html>