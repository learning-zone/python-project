<?php

session_start();

include("../../db.php");

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

$countnumber=$_POST['countnumber'];

$score=$_POST['score'];

$righans=$_POST['righans'];

$option1=$_POST['option1'];

$option2=$_POST['option2'];

$option3=$_POST['option3'];

$option4=$_POST['option4'];

$option5=$_POST['option5'];

$Questions=$_POST['Questions'];

if($_GET['eid'])

{

	$eid=$_GET['eid'];

	execute("update online_exam_sel_questions set status=0 where id='$eid'");	

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

		$sql2=execute("select * from online_exam_sel_questions where exam_id='$idn' and que='$Questions' and status='1'");

		if(rowcount($sql2)>=1)

		{

			?>

			<Script language="JavaScript">

			alert("Duplicate entry not allowed");

			</Script>

			<?php

		}

		else

		{

			execute("INSERT INTO `online_exam_sel_questions` ( `exam_id`, `no_of_option`, `que`, `option1`, `option2`, `option3`, `option4`, `option5`, `right_ans`, `score`, `status`) VALUES ('$idn', '$countnumber', '$Questions', '$option1', '$option2', '$option3', '$option4', '$option5', '$righans','$score', '1')") or die(mysql_error());

			?>

			<Script language="JavaScript">

			alert("Updated successfully");

			</Script>

			<?php	

		}

	}

	else

	{

	$score1=$_POST['score'];

	$option11=$_POST['option1'];

	$option12=$_POST['option2'];

	$option13=$_POST['option3'];

	$option14=$_POST['option4'];

	$option15=$_POST['option5'];

	$Questions1=$_POST['Questions'];

			?>

			<Script language="JavaScript">

			alert("Null data");

			</Script>

			<?php

		

	}

}

?>

<html>

<head>

</head>

<script language="javascript">

function reload()

	{

		document.frm.action="teac_add_questions2.php";

		document.frm.submit();

	}

function goBack()

  {

  window.history.back()

  }

function anscal(val,val1)
{

//	alert("Right Answer is "+val+val1);
	document.getElementById(val1).innerHTML	=val;

}



  

</script>

<body>

<?php

if($_POST['countnumber']==1)

$sel1='selected';

if($_POST['countnumber']==2)

$sel2='selected';

if($_POST['countnumber']==3)

$sel3='selected';

if($_POST['countnumber']==4)

$sel4='selected';

if($_POST['countnumber']==5)

$sel5='selected';



?>

<form name="frm" method="post">

<input type="hidden" name="idn" value="<?php echo $idn; ?>">

<input type="hidden" name="examname" value="<?php echo $examname; ?>">

<input type="button"  class="bgbutton" value="Back" onClick="goBack()">

  <?php	

  

  $sql2=execute("select * from online_exam_sel_questions where exam_id='$idn' and status='1'");

	

if(rowcount($sql2)>=1)

{	

	?>

<br>
<br>
<table align='center' class='forumline' width='80%' border="1" >
	
	<?php

	$j=1;

	while($r6=fetcharray($sql2))

	{
	
	echo "<tr>
		<td align='center' class='head' width='3%'>Sl No</td>
		<td align='center' class='head' width='60%' nowrap>Questions</td>
		<td align='center' class='head' width='10%'>Answer</td>
	</tr>";
	
	$answer=fetcharray(execute("select option$r6[right_ans],option1,option2,option3,option4 from online_exam_sel_questions where exam_id='$idn' and status='1' and id='$r6[id]'"));

  		

	$val=$answer[0];

	echo "	<tr>

			<td align='center' width='3%'>$j</td>

		 	<td align='justify' width='60%'>&nbsp;&nbsp; 

				$r6[que] 

			</td><td align='center' width='10%'>";

			?>
			<input type='button'  class='bgbutton' name="<?=$val?>" value='Answer' onClick="anscal(this.name,<?=$j?>)"></td>
	</tr>
			<tr height="70"><td colspan="4" id="<?=$j?>" align="center" style="font:bold"></td></tr>
	<?
	$choice=fetcharray(execute("select option$r6[right_ans],option1,option2,option3,option4 from online_exam_sel_questions where exam_id='$idn' and status='1' and id='$r6[id]'"));
	?>
	
	<tr><td align="left" colspan="4">&nbsp;a)&nbsp;<?=$choice[1]?></td></tr><tr><td align="left" colspan="4">&nbsp;b)&nbsp;<?=$choice[2]?></td></tr><tr><td align="left" colspan="4">&nbsp;c)&nbsp;<?=$choice[3]?></td></tr><tr><td align="left" colspan="4">&nbsp;d)&nbsp;<?=$choice[4]?></td></tr>	
	<?php
		$j++;
		}
	?>
	</table>

  <?php

}

?>	

  

</form>

</body>

</html>