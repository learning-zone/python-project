<html>

<head>

<Script language="JavaScript">

function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}

	function RefreshMe(val)

	{

		document.MyFrm.action="SubjectSetup.php";

		document.MyFrm.submit();

	}



function checkval(st)

{

	alert("Marks have been entered for this term, hence cannot be modified. Please get in touch with your school system administrator for further assistance  ");

	document.getElementById(st).checked = false;

}

</script>

<?php

	session_start();

	include("../db.php");

if($_POST)

{
	
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$a_year=$_POST['a_year'];
	$examid=$_POST['examid'];
	$subject=$_POST['subject'];
	$masterexamid=$_POST['masterexamid'];
}

if($_REQUEST)

{
	$subject=$_REQUEST['subject'];
	$examid=$_REQUEST['examid'];
	$masterexamid=$_REQUEST['masterexamid'];
	$sem=$_REQUEST['sem'];
}

$ExamName=$_POST['ExamName'];

$ShortName=$_POST['ShortName'];

$Persatage=$_POST['Persatage'];

$maxmark=$_POST['maxmark'];

$ordercount=$_POST['ordercount'];

if ($_POST['saveyear'])

{	

		$yearstt=execute("SELECT count(id)

FROM `dp_exam_sub_sub_m` where exam_id='$examid' and sub_id='$subject' and (exam_name='$ExamName' or exam_sub_name='$ShortName')");

		$yearstt1=fetchrow($yearstt);

		if($yearstt1[0]>0)

		{

			?>

			<Script language="JavaScript">

			alert("Duplicate entry not allowed");

			</Script>

			<?php		

		}

		else

		{

			

			if($ExamName!='' and $ShortName!='' and $maxmark!='' and $ordercount!='')

			{
				
				execute("INSERT INTO `dp_exam_sub_sub_m` ( `exam_name`, `exam_sub_name`, `per_info`, `mark`,  `status`, `order_id`,`exam_id`,masterexam,sub_id,class) VALUES ( '$ExamName', '$ShortName', '$Persatage', '$maxmark','1','$ordercount','$examid','$masterexamid','$subject','$sem')");
				
				?>

				<Script language="JavaScript">

				alert("Updated successfully");

				</Script>

				<?php

			}

			else

			{

				?>	

				<Script language="JavaScript">

				alert("Make sure all the entry properly entered");

				</Script>

				<?php

				

			}

		}

	

	

		

}

//modify

if ($_POST['modify'])

{

	

	$cid=$_POST['seltype'];

	for($i=0;$i<sizeof($cid);$i++)

	{

		$ExamName1=$_POST['ExamName'.$cid[$i]];

		$ShortName1=$_POST['ShortName'.$cid[$i]];

		$Persatage1=$_POST['Persatage'.$cid[$i]];

		$ordercount1=$_POST['ordercount'.$cid[$i]];		

		$maxmark1=$_POST['maxmark'.$cid[$i]];

		execute("update dp_exam_sub_sub_m set `exam_name`='$ExamName1', `exam_sub_name`='$ShortName1', `per_info`='$Persatage1',`masterexam`='$masterexamid' ,`order_id`='$ordercount1',`mark`='$maxmark1',`class`='$sem',`sub_id`='$subject' where id='$cid[$i]'");	

	}

		?>

		<Script language="JavaScript">

		alert("Updated successfully");

		</Script>

		<?php		



	

}

?>

</head>

<body class='bodyline'>

<form method="post" name="MyFrm">

<input type="hidden" name="flag" value="<?=$flag?>">

<input type="hidden" name="examid" value="<?=$examid?>">

<input type="hidden" name="masterexamid" value="<?=$masterexamid?>">
<input type="hidden" name="subject" value="<?=$subject?>">

<table align='center' class='forumline' width='70%' border="1" >

	<tr>

        <td align='center' class='head' nowrap>Exan Name</td>

        <td align='center' class='head' nowrap>Short Name</td>

		<!--<td align='center' class='head' nowrap> % </td>-->

        <td align='center' class='head' nowrap> Mark </td>

        <td align='center' class='head' nowrap>Order</td>

	</tr>



	<tr>

	

        <td align='center' nowrap>

        	<input type='text' size="40" name='ExamName' value=''>

		</td>

        <td align='center' nowrap>

        	<input type='text' name='ShortName' value=''>

		</td>

      <!--  <td align='center' nowrap>

        	<input type='text' name='Persatage' size="2" maxlength="3" value=''>

		</td>-->

		

        <td align='center' nowrap>

        	<input type='text' size="3" name='maxmark' maxlength="3" value=''>

		</td>

         <td align='center' nowrap>

                <select name="ordercount" >

                    <option value="">Select</option>

                    <?php

                        for($j=1;$j<10;$j++)

                        {

                            if($ordercount==$j)

                                echo "<option value=$j selected>   $j   </option>";

                            else

                                echo "<option value=$j>   $j   </option>";

                        }

                    ?>

             </select>

		</td>



</tr>



</table>

<br>  <div align='center' >

  <input type="submit" name="saveyear" value="Save Setup"  class='bgbutton'>

</div>  





<br>

<?php



		$yearstt=execute("SELECT id FROM `dp_exam_sub_sub_m` where exam_id='$examid' and sub_id='$subject'");

		$yearstt2=fetchrow($yearstt);

		$yearstt2[0];

		if($yearstt2[0]==0)

		die();

?><table align='center' class='forumline' width='70%' border="1" >

	<tr>

		<td align='center' class='head' nowrap>Sl No.</td>

        <td align='center' class='head' nowrap>Exan Name</td>

        <td align='center' class='head' nowrap>Short Name</td>

		<!--<td align='center' class='head' nowrap> % </td>-->

        <td align='center' class='head' nowrap>Mark </td>

        <td align='center' class='head' nowrap>Order</td>

   	</tr>

<?php 

$yearstt=execute("SELECT * FROM `dp_exam_sub_sub_m` where exam_id='$examid'  and sub_id='$subject'");

while($yearstt1=fetcharray($yearstt))

{

?>

	<tr>

	

      	 <td align='center'  nowrap>

         <?php

		 if($yearstt1['status']==0)

		 {

		 	echo "<input type='checkbox' name='$yearstt1[0]' onClick='checkval(this.value)' id='$yearstt1[0]' value='$yearstt1[0]'>";

         }

		 else

		 {

				echo "<input type='checkbox' name='seltype[]' value='$yearstt1[0]'>";

		 }

		 ?>

		</td>

        <td align='center' nowrap>

        	<input type='text' size="40" name='ExamName<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['exam_name']; ?>'>

		</td>

        <td align='center' nowrap>

        	<input type='text' name='ShortName<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['exam_sub_name']; ?>'>

		</td>

     <!--   <td align='center' nowrap>

        	<input type='text' name='Persatage<?php echo $yearstt1[0]; ?>' size="2" value='<?php echo $yearstt1['per_info']; ?>'>

		</td>-->

        <td align='center' nowrap>

        	<input type='text' size="3" name='maxmark<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['mark']; ?>'>

		</td>

         <td align='center' nowrap>

                <select name="ordercount<?php echo $yearstt1[0]; ?>">

                    <option value="">Select</option>

                    <?php

                        for($j=1;$j<10;$j++)

                        {

							$tempname=$yearstt1['order_id'];

                            if($tempname==$j)

                                echo "<option value=$j selected>   $j   </option>";

                            else

                                echo "<option value=$j>   $j   </option>";

                        }

                    ?>

             </select>

		</td>



</tr>



<?php

}

?>

</table>

<br>

  <div align='center' >

  <input type="submit" name="modify" value="Modify"  class='bgbutton'>

</div>

	</form>

 </body>

</html>

