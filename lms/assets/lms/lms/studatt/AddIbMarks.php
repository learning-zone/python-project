<html>
<head>
<?php
session_start();
include("../db.php");
if($_REQUEST['course'])
{
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$examid=$_REQUEST['examid'];
	$studentid=$_REQUEST['studentid'];
	$subject_id=$_REQUEST['subject_id'];
	$stundetname=$_REQUEST['stundetname'];
	$student_id=$_REQUEST['student_id'];	
}
else
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$examid=$_POST['examid'];
	$studentid=$_POST['studentid'];
	$subject_id=$_POST['subject_id'];
	$stundetname=$_POST['stundetname'];
	$student_id=$_POST['student_id'];
		
}
	$total=$_POST['total'];
	$maxtotal=$_POST['maxtotal'];
	$comments=$_POST['comments'];
	$ibgrade=$_POST['ibgrade'];
	$skillenth=$_POST['skillenth'];
	$applenth=$_POST['applenth'];

$accyeardet=$temp_year_detalis;

?>
<script language='javascript'>
function valid(id)
{
	var mmarks= document.getElementsByName("m_mark" + id)[0].value;
	var obt_mark = parseInt(document.getElementsByName("mark" + id)[0].value);
	if(isNaN(obt_mark))
	{
		alert("Enter number only. For Absentees enter as 0");
		document.getElementsByName("mark" + id)[0].value='';
	}
	else
	{
		if(obt_mark>mmarks)
		{
			alert("Scored Mark cannot be greater than max mark");
			document.getElementsByName("mark" + id)[0].value='';
		}
	}
}
function valid1()
{
	var mmarks= parseInt(document.getElementsByName("cc")[0].value);
	var obt_mark = parseInt(document.getElementsByName("ca")[0].value);
	if(isNaN(mmarks))
	{
		alert("Enter number only.");
		document.getElementsByName("cc")[0].value='';
	}
	if(isNaN(obt_mark))
	{
		alert("Enter number only.");
		document.getElementsByName("ca")[0].value='';
	}
	else
	{
		if(obt_mark>mmarks)
		{
			alert("Attended class cannot be greater than conducted class");
			document.getElementsByName("ca")[0].value='';
		}
	}
}
</script>
</head>
<body>
<form name="frm" action="" method="post">
<?php
echo "
<input type='hidden' name='course' value='$course'>
<input type='hidden' name='sem' value='$sem'>
<input type='hidden' name='examid' value='$examid'>
<input type='hidden' name='studentid' value='$studentid'>
<input type='hidden' name='stundetname' value='$stundetname'>
<input type='hidden' name='student_id' value='$student_id'>
<input type='hidden' name='subject_id' value='$subject_id'>";

$rs_ec=execute("select * from exam_m where id='$examid'");
while($r1=fetcharray($rs_ec))
{
	$subid=explode(',',$r1['sub_id']);
	$mmks=explode(',',$r1['max_mark']);
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
}

if(isset($_POST['save']))
{
		$Sql66=execute(" select id from skill_grade_ib where student_id='$studentid' and subject='$subject_id' and acc_year='$accyeardet' and exam='$examid'");
		if(rowcount($Sql66)>0)
		{
			execute("update skill_grade_ib set `totalmark`='$total', `ibgrade`='$ibgrade', `comments`='$comments' where student_id='$studentid' and acc_year='$accyeardet'  and exam='$examid' and subject='$subject_id'");
		}
		else
		{
			execute("INSERT INTO skill_grade_ib (`divi`, `class`, `exam`, `student_id`, `acc_year`, `totalmark`, `ibgrade`, `comments`,`subject`) VALUES ('$course', '$sem','$examid' , '$studentid', '$accyeardet', '$total', '$ibgrade', '$comments', '$subject_id')");
		}
		
		
	$totma=0;
	for($j=1;$j<$skillenth;$j++)
	{
		$mark=$_POST['mark'.$j];
		$totma=$totma+$mark;
		execute("update skill_grade_ib  set skill$j='$mark' where student_id='$studentid' and acc_year='$accyeardet'  and exam='$examid' and subject='$subject_id'");
	}
	
	execute("update skill_grade_ib set `totalmark`='$totma' where student_id='$studentid' and acc_year='$accyeardet'  and exam='$examid' and subject='$subject_id'");

	for($j=1;$j<$applenth;$j++)
	{
		$app=$_POST['app'.$j];
		execute("update skill_grade_ib  set  aproach$j='$app' where student_id='$studentid' and acc_year='$accyeardet'  and exam='$examid' and subject='$subject_id'");
	}
	?>
		<Script language="JavaScript">
			alert("**** Marks Updated Successfully ***");
			self.opener.location.reload();
			window.close();
		</Script>
		<?php
}
?>
<table align="center" width="70%" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="5" > Add IB Skills </td>
</tr> 

   
  <?php
  echo '
  <tr height="25">
    	<td align="center" colspan="5"  class="row2" >Name : '.$stundetname.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Id : '.$student_id.' 
		</td>
  </tr>';

	$sql1=execute("SELECT a.subject_id , a.subject_name , b.mark FROM subject_m a, master_skills b where a.course_id='$course' and  a.course_year_id='$sem' and b.sub=a.subject_id and a.subject_id=$subject_id  group by b.sub ");
$maxtotal=0;
while($r2=fetcharray($sql1))
{
	$alpha=array('','A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');  
	echo"<tr height='26'>
    			<td nowrap width='75%' colspan='4' class='row2'><strong>  $r2[1] </strong></td>
    	</tr> ";
  $k=1;
	$sql2=execute("SELECT id , skill FROM master_skills where divi='$course' and class='$sem' and sub='$r2[0]' order by posi");
	while($r3=fetcharray($sql2))
	{
			echo " <tr>
						<td width='5%' valign='top'>&nbsp;<br>CRITERION $alpha[$k]<br> $r3[1] <br>&nbsp;</td>
					<td  valign='top'>";
					 
		$sql4=execute("SELECT id , sub_skill FROM sub_skills where  master_skill='$r3[0]' order by posi");
		while($r4=fetcharray($sql4))
		{
			echo "<br>$r4[1] <br>&nbsp;";
		}
		//echo "select skill$k from skill_grade_ib  where student_id='$studentid' and acc_year='$accyeardet'  and exam='$examid' and subject='$subject_id'";
		$sql5=execute("select skill$k ,totalmark, ibgrade from skill_grade_ib  where student_id='$studentid' and acc_year='$accyeardet'  and exam='$examid' and subject='$subject_id'");
		while($r5=fetcharray($sql5))
		{
			$eval1=$r5[0];
			$total=$r5[1];
			$ibgrade=$r5[2];
		}
		echo "</td><input type='hidden' name='subarr[]' value='$r3[0]'>
			<td nowrap align='center'> 
				<input type='text' name='mark$k' value='$eval1' tabindex='$k' onChange='valid($k)' size='3'>
			</td>
			<td nowrap align='center'> 
				<input type='text' name='m_mark$k' value='$r2[2]' onchange size='3' readonly  > 
			</td>
		</tr>";
		 $k++;
	echo "<input type='hidden' name='skillenth' value='$k'>";
	$maxtotal=$maxtotal+$r2[2];
	}
}

 echo " <tr>
    		<td nowrap align='right' colspan='2' >
				<br>
				<strong>  TOTAL  </strong> &nbsp;&nbsp;&nbsp;<br>&nbsp;</td>
	<td>
		<input type='text' name='total' value='$total' tabindex='$k' size='3' readonly>
	</td>
		<td><input type='text' name='maxtotal' value='$maxtotal' size='3' readonly></td>
    </tr> ";
	 echo " <tr>
    		<td nowrap align='right' colspan='2' >
				<br>
				<strong>  INTERNATIONL BACCALAUREATE GRADE  </strong> &nbsp;&nbsp;&nbsp;<br>&nbsp;</td>
	<td colspan='2' align='center'><input type='text' name='ibgrade' value='$ibgrade' size='3'  ></td>

    </tr> ";
?>
</table>
<br>
<table align="center" width="70%" border="1" cellspacing="0" cellpadding="0">
<tr height="26">
    <td align="center" class="row2" >Approaches to Learning </td>
    <td align="center" class="row2" >Improvement Needed</td>
    <td align="center" class="row2" >Satisfactory </td>
    <td align="center" class="row2" >Good </td>
    <td align="center" class="row2" >Excellent </td>

</tr> 
<?php

 $k=1;
	$sql2=execute("SELECT id , skill FROM master_approaches where divi='$course' and class='$sem' and sub='$subject_id' order by posi");
	while($r3=fetcharray($sql2))
	{

		$sql5=execute("select aproach$k ,comments from skill_grade_ib  where student_id='$studentid' and acc_year='$accyeardet'  and exam='$examid' and subject='$subject_id'");
		while($r5=fetcharray($sql5))
		{
			$appval=$r5[0];
			$coments=$r5[1];
		}
		if($appval==1)
		{
			$appdis1='checked';
			$appdis2='';
			$appdis3='';
			$appdis4='';
		}
		if($appval==2)
		{
			$appdis2='checked';
			$appdis3='';
			$appdis4='';
			$appdis1='';
		}
		if($appval==3)
		{
			$appdis3='checked';
			$appdis4='';
			$appdis1='';
			$appdis2='';
		}
		if($appval==4)
		{
			$appdis4='checked';
			$appdis1='';
			$appdis2='';
			$appdis3='';
		}
		echo "	<tr>
					<td >$r3[1]</td>
					<td align='center'><input type='radio' name='app$k' value='1' $appdis1></td>
					<td align='center'><input type='radio' name='app$k' value='2' $appdis2> </td>
					<td align='center'><input type='radio' name='app$k' value='3' $appdis3></td>
					<td align='center'><input type='radio' name='app$k' value='4' $appdis4></td>
				</tr>"; 
	$k++;
	}
	echo "<input type='hidden' name='applenth' value='$k'>";
?>

<tr>
    <td  colspan='5' align='center'>
    <div align="left">Comment :</div><textarea name="comments" rows="3" cols="80"><?php echo $coments; ?></textarea> </td>
</tr> 



</table>
<br>
<div align="center">
	<input type="submit" name="save"  value="Save" class="bgbutton">
</div>
</form>
</body>
</html>
