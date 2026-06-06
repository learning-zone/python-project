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
		<td Class="head" align='center' colspan='<?php echo $secmax+4;?>'><font size=2><b>Nationality Wise Report </b></td>
	</tr>
	<tr height='30'><td align='center' rowspan='2' nowrap>Sl.No</td><td align='center' rowspan='2' nowrap><?php echo $_SESSION['semname']; ?></td>
      <td align='center' colspan='<?php echo $secmax+2;?>'>Nationality
        Details</td>
    </tr><tr>
	<?php
	$secnt=execute("SELECT * FROM nationality  order by nation");
	while($r=fetcharray($secnt))
	{
		$mk=$r['id'];
		$rs=fetcharray(execute("select count(id) from student_m where nationality='$mk' and archive='N'  and academic_year='$academic_year'"));
		if($rs[0]>0)
		{
			$nid[]=$r['id'];
			echo "<td align='center' nowrap>$r[1]</td>";
		}
	}
	echo "
	<td align='center'>Blank</td>
	<td align='center'>Total</td></tr>";
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
				<a href="javascript:OpenWind('view_studlist2.php?clid=<?=$rBR[0]?>&secid=<?=$j?>')"><?=$rs[0]?></a></td>
				<?php
			}
			else
				echo "<td align='center'>$rs[0]</td>";
			$ttl+=$rs[0];
			$secttl[$j]+=$rs[0];
		}
	$contsf=fetcharray(execute("select count(id) from student_m where archive='N'  and academic_year='$academic_year' and course_yearsem='$rBR[0]'"));
	$ttnamess=$contsf[0]-$ttl;
	$ftnames=$ttnamess+$gttl;
		echo "<td align='center'>";
		?>
		<!--<a href="javascript:OpenWind('view_studlistb.php?clid=a&semnme=<?=$rBR[0]?>')">--><?=$ttnamess?><!--</a>-->
		<?		
		//tot blank grade
		$tt1444='';
		$tt1namess='';
		$blgead=$contsf[0]-$ttl;
		$tt1444=$tt1444+$blgead;
		$tt1namess=$tt1444+$ttl;
		//end
		$ttnamess2=$ttnamess2+$ttnamess;
        echo "</td>";
		echo "<td align='center'>$tt1namess</td>";
		
		$gttl+=$ttl;
		$sno++;
	}
	echo "</tr>";
	echo "<tr height='30'><td align='right' colspan='2'>Total&nbsp;&nbsp;</td>";
	for($k=0;$k<sizeof($nid);$k++)
	{
		$j=$nid[$k];
		if($secttl[$j]>0)
		{
			echo "<td align='center'>";
			?>
			<a href="javascript:OpenWind('view_studlist2.php?clid=a&secid=<?=$j?>')"><?=$secttl[$j]?></a></td>
			<?php
		}
		else
			echo "<td align='center'>$secttl[$j]</td>";
	}
	$namesss=$ttnamess2+$gttl;
	echo "<td align='center'>";
?>
	<!--<a href="javascript:OpenWind('view_studlistb.php?clid=a&secid=<?=$j?>')">-->
	<?=$ttnamess2?>
	<!--</a>-->
	<?
    echo"</td>";
	echo "<td align='center'><b>$namesss</b></td>";
	echo "</tr>";
	$nmaetest='';
	?>
</table><br>
<div id="prn" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="printReport()"></div>
</form>
</body>
</html>