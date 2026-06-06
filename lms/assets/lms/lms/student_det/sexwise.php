
<html>

<head>

<script language="JavaScript">

		function printReport()

{

	prn.style.display = "none";

	window.print();

}

</script>

</head>

<body>

<form>

<?php



session_start();

include("../db.php");

$academic_year=$_SESSION['AcademicYear'];

$sql2 = "select col_name from college ";

$rs2 = execute($sql2);

$row2 = rowcount($rs2);

$r2 = fetcharray($rs2,0);

$colname = $r2["col_name"];



$branch;

$sem==0;

$bransql="select year_id, year_name from course_year where ";

	if($sem==0)

	{

		$bransql.=" status=1 order by head_id , year_id ";

	}

	else

	{

		$bransql.=" status=1 and year_id='$sem' order by head_id";

		

	}



	?>

    <br><br>

	<table width='50%' class='forumline'  align='center'>

    <tr height =34>

    <td class="head" align='center' colspan="4">Gender Wise Report </td>

    </tr><tr height =20>

    <td class="rowpic" align='center'>&nbsp;<?php echo $_SESSION['semname']; ?></td>

    <td class="rowpic" align='center'>&nbsp;Male</td>

    <td class="rowpic" align='center'>&nbsp;Female</td>

	<td class="rowpic" align='center'>&nbsp;Total</td>

  </tr>

  <?php

	 $maleg=0;

	 $femaleg=0;

	 $grandt=0;

	$sql1=mysql_query($bransql);

	while($row1=mysql_fetch_array($sql1))

	{

		$sql3=mysql_query("select count(id) from student_m where gender='M' and course_yearsem='$row1[year_id]' and academic_year='$academic_year'  and archive='N'");

		$male=mysql_fetch_row($sql3);

		$sql4=mysql_query("select count(id) from student_m where gender='F'  and course_yearsem='$row1[year_id]' and academic_year='$academic_year'  and archive='N'");

		$fmale=mysql_fetch_row($sql4);

		$maleg=$maleg+$male[0];

		$femaleg=$femaleg+$fmale[0];

		$grandt=$grandt+($male[0]+$fmale[0]);

		?>

		

  

  <tr height =20>

    <td align="center">&nbsp;&nbsp;<?php echo $row1[year_name]; ?></td>

    <td align='center'>&nbsp;

    

    <a href="DetailSex.php?sex=M&&semid=<?php echo $row1[year_id]; ?>"><?php echo $male[0]; ?></a></td>

    <td align='center'>&nbsp;

    <a href="DetailSex.php?sex=F&&semid=<?php echo $row1[year_id]; ?>"><?php echo $fmale[0]; ?></a></td>

    <td align='center'>&nbsp;

    <a href="DetailSex.php?sex=ALL&&semid=<?php echo $row1[year_id]; ?>"><?php echo ($male[0]+$fmale[0]); ?></a></td>

  </tr>

  





		<?php

	}

	

?>

<tr>

    <td align='center'>&nbsp;Total</td>

    <td align='center'>&nbsp;<a href="DetailSex.php?sex=M&&semid=ALL"><?php echo $maleg; ?></td>

    <td align='center'>&nbsp;<a href="DetailSex.php?sex=F&&semid=ALL"><?php echo $femaleg; ?></td>

    <td align='center'>&nbsp;<a href="DetailSex.php?sex=ALL&&semid=ALL"><?php echo $grandt; ?></td>

  </tr>

</table>

<br><br>

<div id='prn' align='center'>

  <input class='bgbutton' type="button" value="PRINT" name="print" onClick="printReport()" >

</div>

</form>

</BODY>

</HTML>

