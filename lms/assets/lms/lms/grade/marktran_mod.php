<html>
<head>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
<Script language="JavaScript">
	function RefreshMe(val)

	{

		document.frm.action="marktran_mod.php";

		document.frm.submit();

	}

</script>

<?php
	include("../db.php");
	session_start();
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$a_year=$_SESSION['AcademicYear'];

$examname_m=$_POST['examname_m'];
$subject=$_POST['subject'];
$class_section_id=$_POST['class_section_id'];
$ExamName=$_POST['ExamName'];
$ShortName=$_POST['ShortName'];
$examtype=$_POST['examtype'];
$Persatage=$_POST['Persatage'];
$maxmark=$_POST['maxmark'];
$ordercount=$_POST['ordercount'];
$adate=$_POST['adate'];
$bdate=$_POST['bdate'];
$examid=$_REQUEST['examid'];
$masterexamid=$_REQUEST['masterexamid'];
$sem=$_REQUEST['sem'];
$course=$_REQUEST['course'];
$class_section_id=$_REQUEST['class_section_id'];
$subject=$_REQUEST['subject'];

//modify
//print_r($_POST);
if ($_POST['modify'])

{
		
		$examid=$_POST['examid'];
		$ExamName1=$_POST['ExamName'];
		$ShortName1=$_POST['ShortName'];
		$Persatage1=$_POST['Persatage'];
		//$ordercount1=$_POST['ordercount'];		
		//$maxmark1=$_POST['maxmark'];
		$examtype1=$_POST['examtype'];
		$a_year=$_SESSION['AcademicYear'];
		
		$tfdate=explode('/',$adate);
		$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
		$ttdate=explode('/',$bdate);
		$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];

		execute("update dp_exam_sub_m set `exam_name`='$ExamName1', `exam_sub_name`='$ShortName1', `per_info`='$Persatage1', `order_id`='2',`mark`='$maxmark1',`examtype`='$examtype1',`from`='$fdate', `to`='$tdate',`acc_year`='$a_year' where id='$examid'");	
	
?>			
			
		<script type="text/javascript">
				alert("Updated Successfully");
				window.opener.location.href='SubjectSetup.php?id=1&course='+"<?=$course?>"+'&sem='+"<?=$sem?>"+'&class_section_id='+"<?=$class_section_id?>"+'&examname_m='+"<?=$masterexamid?>"+'&subject='+"<?=$subject?>";
				//window.opener.location.reload();
				
 		</script>
<?
}
	?>

</head>
<body class='bodyline'>

<form method="post" name="frm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<input type="hidden" name="examid" value="<?=$examid?>">
<input type="hidden" name="masterexamid" value="<?=$masterexamid?>">
<input type="hidden" name="sem" value="<?=$sem?>">


<?php
$yearstt=execute("SELECT id FROM `dp_exam_sub_m` where `class`='$sem' and exam_id='$masterexamid' and acc_year='$a_year'  and id='$examid'");

		$yearstt2=fetchrow($yearstt);

		$yearstt2[0];

		if($yearstt2[0]==0)

		die();

?>
<table align='center' class='forumline' width='80%' border="1" >
	<tr>
        <td align='center' class='head' nowrap>Exam Name</td>
        <td align='center' class='head' nowrap>Short Name</td>
        <td align='center' class='head' nowrap>From</td>
        <td align='center' class='head' nowrap>To</td>
       <!--  <td align='center' class='head' nowrap>Mark </td>
       <td align='center' class='head' nowrap>Group</td>-->
	</tr>

<?php 

$yearstt=execute("SELECT * FROM `dp_exam_sub_m` where `class`='$sem' and exam_id='$masterexamid' and acc_year='$a_year' and id='$examid'");

while($yearstt1=fetcharray($yearstt))

{

?>

	<tr>
        <td align='center' nowrap>

        	<input type='text' size="40" name='ExamName' value='<?php echo $yearstt1['exam_name']; ?>' required>

		</td>

        <td align='center' nowrap>

        	<input type='text' name='ShortName' value='<?php echo $yearstt1['exam_sub_name']; ?>' required>

		</td>
        
    <td align='center' nowrap>        
		<?php 
		
        $frst=explode('-',$yearstt1['from']);
        if($frst[2]!='0000')
        $from="$frst[2]/$frst[1]/$frst[0]";
        ?>     
        From&nbsp;&nbsp;<input type="text" name="adate" size="10%" value="<?=$from?>" readonly>
        &nbsp;
        <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
    </td>
    
    <td align='center' nowrap>         
		<?php 
        $secnd=explode('-',$yearstt1['to']);
        if($secnd[2]!='0000')
        $to="$secnd[2]/$secnd[1]/$secnd[0]";
        ?>     
        <input type="text"  size="10%" name="bdate" value="<?=$to?>" readonly>
        &nbsp;
        <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
    </td>
   
        <!--<td align='center' nowrap>

        	<input type='text' size="3" name='maxmark' value='<?php echo $yearstt1['mark']; ?>' required>

		</td>

         <td align='center' nowrap>

                <select name="ordercount" >

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

		</td>-->
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

