<?php

session_start();

require("../db.php");

$academic_year=$_SESSION['AcademicYear'];

?>

<HTML>

<HEAD>

<TITLE>Student List</TITLE>

<script language="javascript">

function OpenWind(k)

{

	var finalVar;

	finalVar=k;

	window.open(finalVar,'Stud','height=700,width=1000,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}

function printReport()

{

	prn.style.display="none";

	window.print();

}

</script>

</HEAD>

<BODY leftmargin=0 topmargin=0>

<form method="POST" name="frm">

<?php

$secnt=fetcharray(execute("select count(id) from student_m where archive='N' and academic_year='$academic_year' and nationality!=0  group by nationality "));

$secmax=$secnt[0];



?>

<table class='forumline' align='center' border="1" >

	<tr>

		<td Class="head" align='center' colspan='<?php echo $secmax+6;?>'>Nationality Wise Report</td>

	</tr>

	<tr height='30'><td align='center' rowspan='2' nowrap>Sl.No</td><td align='center' rowspan='2' nowrap>&nbsp;<?php echo $_SESSION['semname']; ?></td>

      <td align='center' colspan='<?php echo $secmax+4;?>'>Nationality

        Details</td>

    </tr><tr>

	<?php

	$secnt=mysql_query("SELECT * FROM nationality  order by nation");

	while($r=mysql_fetch_array($secnt))

	{

		$mk=$r['id'];

		$rs=fetcharray(execute("select count(id) from student_m where nationality='$mk' and archive='N'  and academic_year='$academic_year'"));

		if($rs[0]>0)

		{

			$nid[]=$r['id'];

			echo "<td align='center' nowrap>&nbsp;&nbsp;&nbsp;$r[1]</td>";

		}

	}

	echo "<td align='center'>&nbsp;&nbsp;Total</td></tr>";

	$rsBR = execute("SELECT year_id,year_name FROM course_year where status=1 order by head_id,year_id");

	$countBR = rowcount($rsBR);

	$sno=1;

	$secttl[]=0;

	$gttl=0;

	for($i=0;$i<$countBR;$i++)

	{

		if($sno<10)

			$sno="0".$sno;

		$rBR = fetcharray($rsBR);

		echo "<tr height='30'><td align='center'>$sno</td>";

		echo "<td nowrap>&nbsp;&nbsp;$rBR[1]</td>";

		$ttl=0;

		for($k=0;$k<sizeof($nid);$k++)

		{

			$j=$nid[$k];

			$rs=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and nationality='$j' and archive='N'  and academic_year='$academic_year'"));

			if($rs[0]>0)

			{

				echo "<td align='center'>";

				?>

				<a href="javascript:OpenWind('nationalityview.php?clid=<?=$rBR[0]?>&secid=<?=$j?>')"><?=$rs[0]?></a></td>

				<?php

			}

			else

				echo "<td align='center'>$rs[0]</td>";

			$ttl+=$rs[0];

			$secttl[$j]+=$rs[0];

		}

		echo "<td align='center'><b>$ttl</b></td>";

		$gttl+=$ttl;

		$sno++;

	}

	echo "</tr>";

	echo "<tr height='30'><td align='right' colspan='2'>&nbsp;Total&nbsp;&nbsp;</td>";

	for($k=0;$k<sizeof($nid);$k++)

	{

		$j=$nid[$k];

		if($secttl[$j]>0)

		{

			echo "<td align='center'>";

			?>

			<a href="javascript:OpenWind('nationalityview.php?clid=a&secid=<?=$j?>')"><?=$secttl[$j]?></a></td>

			<?php

		}

		else

			echo "<td align='center'>$secttl[$j]</td>";

	}

	echo "<td align='center'><b>$gttl</b></td>";

	echo "</tr>";

	?>

</table><br>

<div id="prn" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="printReport()"></div>

</form>

</body>

</html>