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

$secnt=fetcharray(execute("select max(religion) from student_m where archive='N' and academic_year='$academic_year' "));

$secmax=$secnt[0];

?>
<table class='forumline' align='center' width='60%'>
	<tr>
      <td Class="head" align='center' colspan='<?php echo $secmax+4;?>'>Religion Wise Report</td>

	</tr>

	<tr height='30'><td align='center' rowspan='2'>Sl.No</td><td align='center' rowspan='2'><?php echo $_SESSION['semname']; ?></td>

      <td align='center' colspan='<?php echo $secmax+2;?>'>Religion Details</td>

    </tr><tr>

	<?php

	$secnt=execute("SELECT * FROM religion where id <= $secmax");

	$cntsec=rowcount($secnt);

	for($i=0;$i<$cntsec;$i++)

	{

		$r=fetcharray($secnt);

		echo "<td align='center'>$r[name]</td>";

	}

	echo "<td align='center'>Total</td></tr>";

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

		echo "<td>&nbsp;&nbsp;$rBR[1]</td>";

		$ttl=0;

		for($j=1;$j<=$cntsec;$j++)

		{

			$rs=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and religion='$j' and archive='N'"));

			if($rs[0]>0)

			{

				echo "<td align='center'>";

				?>

				<a href="javascript:OpenWind('view_studlist3.php?clid=<?=$rBR[0]?>&secid=<?=$j?>')"><?=$rs[0]?></a></td>

				<?php

			}

			else

				echo "<td align='center'>$rs[0]</td>";

			$ttl+=$rs[0];

			$secttl[$j]+=$rs[0];

		}

		if($ttl>0)

		{

			echo "<td align='center'>";

			?>

			<a href="javascript:OpenWind('view_studlist3.php?clid=<?=$rBR[0]?>&secid=a')"><?=$ttl?></a></td>

			<?php

		}

		else

			echo "<td align='center'>$ttl</td>";

		$gttl+=$ttl;

		$sno++;

	}

	echo "</tr>";

	echo "<tr height='30'><td align='right' colspan='2'>Total&nbsp;&nbsp;</td>";

	for($j=1;$j<=$cntsec;$j++)

	{

		if($secttl[$j]>0)

		{

			echo "<td align='center'>";

			?>

			<a href="javascript:OpenWind('view_studlist3.php?clid=a&secid=<?=$j?>')"><?=$secttl[$j]?></a></td>

			<?php

		}

		else

			echo "<td align='center'>$secttl[$j]</td>";

	}

	if($gttl>0)

	{

		echo "<td align='center'>";

		?>

		<a href="javascript:OpenWind('view_studlist3.php?clid=a&secid=a')"><?=$gttl?></a></td>

		<?php

	}

	else

		echo "<td align='center'>$gttl</td>";

	echo "</tr>";

	?>

</table><br>

<div id="prn" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="printReport()" ></div>

</form>

</body>

</html>