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

		document.MyFrm.action="unit_test.php";

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
	$a_year=$_SESSION['AcademicYear'];
//print_r($_GET);
if($_POST)

{
	
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$course=$_POST['course'];
	$sem=$_POST['sem'];
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
	$masteexamn=$_REQUEST['masteexamn'];
	$course=$_REQUEST['course'];
}

$ExamName=$_POST['ExamName'];

$ShortName=$_POST['ShortName'];

$weight=$_POST['weight'];

$maxmark=$_POST['maxmark'];

$ordercount=$_POST['ordercount'];
$typeids=$_POST['typeids'];

if ($_POST['saveyear'])

{	

				$a_year=$_SESSION['AcademicYear'];
				$insvat="INSERT INTO `msp_unit` ( `unit`, `unit_s`, `mark_m`,  `status`, `posi`,`exam_id`,`sub`,`class`,`acc_year`,un_type) VALUES ( '$ExamName', '$ShortName', '$maxmark','1','$ordercount','$examid','$subject','$sem','$a_year','$typeids')";
				$gg=execute($insvat);
				$unitsids=fetchInsertId($gg);
				?>

				<Script language="JavaScript">

				alert("Updated successfully");
        window.opener.location.href='skillset.php?id=1&sem='+"<?=$sem?>"+'&masteexamn='+"<?=$masteexamn?>"+'&examname_m='+"<?=$examid?>"+'&course='+"<?=$course?>"+'&unit='+"<?=$unitsids?>";

				</Script>

				<?php
		}

//modify

if ($_POST['modify'])

{

	

	$cid=$_POST['seltype'];

	for($i=0;$i<sizeof($cid);$i++)

	{

		$ExamName1=$_POST['ExamName'.$cid[$i]];

		$ShortName1=$_POST['ShortName'.$cid[$i]];
		
		$ordercount1=$_POST['ordercount'.$cid[$i]];		

		$maxmark1=$_POST['maxmark'.$cid[$i]];
		
		
		$a_year=$_SESSION['AcademicYear'];

		execute("update msp_unit set `unit`='$ExamName1',`unit_s`='$ShortName1',`posi`='$ordercount1',`un_type`='$typeids',`mark_m`='$maxmark1' where id='$cid[$i]'");	

	}

		?>

		<Script language="JavaScript">
		alert("Updated successfully");
        window.opener.location.href='skillset.php?id=1&sem='+"<?=$sem?>"+'&masteexamn='+"<?=$masteexamn?>"+'&examname_m='+"<?=$examid?>"+'&course='+"<?=$course?>"+'&unit='+"<?=$unitsids?>";

		</Script>
		<?php		

}

?>
<?
if($_POST['del'])
{
	$seltype=$_POST['seltype']; 
	while( list(,$Value) = each($seltype) )
	
	{
		
		$upd=execute("update msp_unit set status='0' where id='$Value'");
	}
	?>
		<Script language="JavaScript">
        alert("Deleted successfully");
        window.opener.location.href='skillset.php?id=1&sem='+"<?=$sem?>"+'&masteexamn='+"<?=$masteexamn?>"+'&examname_m='+"<?=$examid?>"+'&course='+"<?=$course?>";
        </Script>
    <?
}
?>
</head>

<body class='bodyline'>

<form method="post" name="MyFrm">

<input type="hidden" name="flag" value="<?=$flag?>">

<input type="hidden" name="examid" value="<?=$examid?>">
<input type="hidden" name="course" value="<?=$course?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="subject" value="<?=$subject?>">

<table align='center' class='forumline' width='70%' border="1" >

	<tr>
        <td align='center' class='head' nowrap>Unit Name</td>
	</tr>

	<tr>
        <td align='center' nowrap>
        	<input type='text' size="40" name='ExamName' value='' required>
		</td>
</tr>
</table>

<br>  <div align='center' >

  <input type="submit" name="saveyear" value="Save Setup"  class='bgbutton'>

</div>  





<br>

<?php



		$yearstt=execute("SELECT id FROM `msp_unit` where exam_id='$examid' and sub='$subject' and acc_year='$a_year'  and status=1");

		$yearstt2=fetchrow($yearstt);

		$yearstt2[0];

		if($yearstt2[0]==0)

		die();

?>
</form>
<form method="post" name="MyFrm1">

<table align='center' class='forumline' width='70%' border="1" >

	<tr>
		<td align='center' class='head' nowrap>Check</td>
        <td align='center' class='head' nowrap>Unit Name</td>
   	</tr>

<?php 

$yearstt=execute("SELECT * FROM `msp_unit` where exam_id='$examid'  and sub='$subject' and acc_year='$a_year' and status=1");

while($yearstt1=fetcharray($yearstt))

{

?>

	<tr>

	<td align="center"><input type='checkbox' name='seltype[]' value='<?=$yearstt1[id]?>'></td>
        <td align='center' nowrap>

        	<input type='text' size="40" name='ExamName<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['unit']; ?>'>

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
<br><div align='center'><input type='submit' name='del' value='Delete' class='bgbutton'></div>
	</form>
 </body>
</html>