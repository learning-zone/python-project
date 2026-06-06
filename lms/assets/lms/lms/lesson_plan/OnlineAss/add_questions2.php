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

			alert("Please Enter Mark");

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

		document.frm.action="add_questions2.php";

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

<table align='center' class='forumline' width='80%' border="1" >

<tr>

  <td colspan=2 align='center' class='head'>Add Questions For <?php echo $examname; ?></td></tr>

	<tr>

		<td align='center' class='row3' colspan="2" nowrap>Select number of options &nbsp;&nbsp;&nbsp;&nbsp;

          <select name="countnumber" onChange="reload()">

        <option value="0">Select</option>

        <option value="1" <?=$sel1?>>1</option>

        <option value="2" <?=$sel2?>>2</option>

        <option value="3" <?=$sel3?>>3</option>

        <option value="4" <?=$sel4?>>4</option>

        </select>

      </td>

	</tr>

    	<tr>

		<td align='center' class='row3' nowrap>Questions</td>

		<td align='center' class='row3' nowrap>Score</td>

	</tr>

	<tr>

      <td align='center' nowrap>

           <textarea name='Questions' rows='2' cols='80' ><?=$Questions1?></textarea>

		</td>

        <td align='center' nowrap>

        <input type='text' name='score' value='<?=$score1?>' maxlength="2" size="2" width="2">

		</td>

		

	</tr>

	<tr>

		<td align='center' class='row3' nowrap>Options</td>

		<td align='center' class='row3' nowrap>Ans</td>

	</tr>

<?php

$k=1;

for($i=0;$i<$countnumber;$i++)

{

?>

	<tr>

      <td align='center' nowrap>

        <?php

		$var1='option1'.$k;

		?>   <textarea name='option<?=$k?>' rows='2' cols='80' ><?=$$var1?></textarea>

		</td>

        <td align='center' nowrap>

        <input type="radio" name="righans" value="<?=$k?>" checked>

		</td>

	</tr>

<?php

$k++;

}

?>

</table>

<br>

  <div align='center' >

  <input type="submit" name="save" value="SAVE"  class='bgbutton'>

  <br>

  

  <br>

  <?php	

  

  $sql2=execute("select * from online_exam_sel_questions where exam_id='$idn' and status='1'");

	

if(rowcount($sql2)>=1)

{	

	?>

<br>

<table align='center' class='forumline' width='80%' border="1" >

<tr>

		<td align='center' class='head' nowrap>Sl No

		</td>

		<td align='center' class='head' nowrap><span class="row3">Questions</span></td>

		<td align='center' class='head' nowrap>Answer</td>

		<td align='center' class='head' nowrap>Action</td>

	</tr>



	<?php

	$j=1;

	while($r6=fetcharray($sql2))

	{

	$answer=fetcharray(execute("select option$r6[right_ans] from online_exam_sel_questions where exam_id='$idn' and status='1' and id='$r6[id]'"));

  		

	$val=$answer[0];

	echo "	<tr>

			<td align='center'  nowrap>

				$j

			</td>

		 	<td align='justify'>&nbsp;&nbsp; 

				$r6[que] 

			</td><td align='center'>";

			?><input type='button'  class='bgbutton' name="<?=$val?>" value='Answer' onClick="anscal(this.name,<?=$j?>)">&nbsp;&nbsp;<div align="center" id="<?=$j?>"></div>
			<?php

			echo "</td>

        	<td align='center' nowrap>

        	    <a href='add_questions2.php?id=$idn&examname=$examname&eid=$r6[0]'>Delete</a>

			</td>

		</tr>";

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