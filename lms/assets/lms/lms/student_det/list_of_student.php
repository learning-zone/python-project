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
$secnt=fetcharray(execute("select max(class_section_id) from student_m where archive='N' and academic_year='$academic_year'"));
$secmax=$secnt[0];
?>
<table class='forumline' align='center' width='100%' border="1">
	<tr>
		<td Class="head" align='center' colspan='<?php echo $secmax+6;?>'>Student List</td>
	</tr>
	<tr height='30'><td align='center' class="row3">Sl.No</td><td align='center' class="row3">&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
	<td align='center' class='row3' colspan='<?php echo $secmax+4;?>'>Section wise Details</td></tr><tr><td>&nbsp;</td><td align="center">&nbsp;&nbsp;</td>
	<?php
	$secnt=execute("select * from class_section where id <= $secmax");
	$cntsec=rowcount($secnt);
	for($i=0;$i<$cntsec;$i++)
	{
		$r=fetcharray($secnt);
		echo "<td align='center'>$r[section_name]</td>";
	}
	echo "<td align='center' width='50'>Total</td></tr>";
	$rsBR = execute("SELECT year_id,year_name FROM course_year where status=1 order by head_id,year_id");
	$countBR = rowcount($rsBR);
	$sno=1;
	$secttl[]=0;
	$gttl=0;
	for($i=0;$i<$countBR;$i++)
	{
		$rBR = fetcharray($rsBR);

		//kkkk
		$rs3e=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and archive='N'"));
		if($rs3e[0])
		{
			if($sno<10)
			$sno="0".$sno;
		
			echo "<tr height='30'><td align='center'>$sno</td>";
			echo "<td nowrap>&nbsp;&nbsp;$rBR[1]</td>";
			$ttl=0;
			for($j=0;$j<=$cntsec;$j++)
			{
				
				$rs=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and class_section_id='$j' and archive='N'"));
				if($rs[0]>0)
				{
					echo "<td align='center'>";
					?>
					<a href="javascript:OpenWind('view_studlist.php?clid=<?=$rBR[0]?>&secid=<?=$j?>')"><?=$rs[0]?></a></td>
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
				<a href="javascript:OpenWind('view_studlist.php?clid=<?=$rBR[0]?>&secid=a')"><?=$ttl?></a></td>
				<?php
			}
			else
				echo "<td align='center'>$ttl</td>";
			$gttl+=$ttl;
			$sno++;

		}
	}
	echo "</tr>";
	echo "<tr height='30'><td align='right' colspan='2'>Total&nbsp;&nbsp;</td>";
	for($j=0;$j<$cntsec;$j++)
	{
		if($secttl[$j]>0)
		{
			echo "<td align='center'>";
			?>
			<a href="javascript:OpenWind('view_studlist.php?clid=a&secid=<?=$j?>')"><?=$secttl[$j]?></a></td>
			<?php
		}
		else
			echo "<td align='center'>$secttl[$j]</td>";
	}
	if($gttl>0)
	{
		echo "<td align='center'>";
		?>
		<a href="javascript:OpenWind('view_studlist.php?clid=a&secid=a')"><?=$gttl?></a></td>
		<?php
	}
	else
		echo "<td align='center'>$gttl</td>";
	echo "</tr>";
	?>
</table><br>
<div id="prn" align='center'><input type="button" value=" Print " name="B1" onClick="printReport()" class='bgbutton'></div>
</form>
</body>
</html>