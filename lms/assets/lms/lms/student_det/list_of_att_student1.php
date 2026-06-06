<?php
session_start();
require("../db.php");
$academic_year=$_SESSION['AcademicYear'];
//header("Refresh: 5");

?>
<HTML>
<HEAD>
<TITLE>Student List</TITLE>
<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
//   -->

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
<BODY leftmargin=0 topmargin=0  onload="JavaScript:timedRefresh(50000);">
<form method="POST" name="frm">
<?php
$secnt=fetcharray(execute("select max(class_section_id) from student_m where archive='N'  and academic_year='$academic_year'"));
$secmax=$secnt[0];
?>


<table class='forumline' align='center' width='100%' border=1>
	<tr>
		<td Class="head"  align='center' colspan='<?php echo $secmax+3;?>'><font size=2><b>Today's Student Attendance List</b></font></td>
	</tr>
	<tr height='30'><td align='center' class='row3'>Class</td>
	<td align='center' class='row3' colspan='<?php echo $secmax+2;?>' nowrap>
    <?php
    echo date("d-m-Y");
    ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Section wise&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
    echo date("l");
   	?>   
    </td></tr><tr><td>&nbsp;</td>
	<?php
	$secnt=execute("select * from class_section where id <= $secmax");
	$cntsec=rowcount($secnt);
	for($i=1;$i<=$cntsec;$i++)
	{
		$r=fetcharray($secnt);
		echo "<td nowrap align='center'>$r[section_name]<br>
		<table width='100%'  border='1'  align='center' cellspacing='0' cellpadding='0'>
		  <tr>
			<td width='33%'  class='cls1' align='center'>P</td>
			
			<td width='33%'  class='cls1' align='center'>T
			</td>
		  </tr>
		</table>
		</td>";
	}
	echo "<td align='center'>Total<br>
	<table width='100%' border='0'  align='center' cellspacing='0' cellpadding='0'>
		  <tr>
			<td width='33%' class='cls1' align='center'> P </td>
			
			<td width='33%' class='cls1' align='center'> T </td>
		  </tr>
		</table></td></tr>";
	$rsBR = execute("SELECT year_id,year_name FROM course_year where status=1 order by head_id,year_id");
	$countBR = rowcount($rsBR);
	$sno=1;
	$secttl[]=0;
	$gttl=0;
	$gmor1=0;
	$gnoon1=0;
	$ststemdate=date("Y-m-d");
	for($i=0;$i<$countBR;$i++)
	{
		if($sno<10)
			$sno="0".$sno;
		$rBR = fetcharray($rsBR);
		$rs3e=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and archive='N'  and academic_year='$academic_year'"));
		if($rs3e[0])
		{
			echo "<tr >";
			echo "<td class='cls1' nowrap>&nbsp;&nbsp;$rBR[1]</td>";
			$ttl=0;
			$ttm=0;
			$ttn=0;
			for($j=1;$j<=$cntsec;$j++)
			{
				$morningp[0]=0;
				$noonngp[0]=0;
				$rs=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and class_section_id='$j' and archive='N'  and academic_year='$academic_year'"));
				if($rs[0]>0)
				{
					
					$hedid=fetcharray(execute("SELECT head_id FROM course_year where year_id='$rBR[0]'"));
					$attandanceTablename="att_$rBR[0]";
					//echo "SELECT count(mor) FROM $attandanceTablename where att_date='$ststemdate' and mor='1' and sec='$j'<br>";
					$morningp=fetcharray(execute("SELECT count(mor) FROM $attandanceTablename where att_date='$ststemdate' and mor='1' and sec='$j'"));
					$noonngp=fetcharray(execute("SELECT count(after) FROM $attandanceTablename where att_date='$ststemdate' and after='1' and sec='$j'"));
					echo "<td align='center' class='cls1' nowrap>
					<table width='100%' align='center' border='0' cellspacing='0' cellpadding='0'>
	  <tr>
		<td class='cls1' width='33%'align='center'>$morningp[0]</td>
		
		<td class='cls1' width='33%'align='center'>";
		?>
		<a href="javascript:OpenWind('view_studlist_att.php?clid=<?=$rBR[0]?>&secid=<?=$j?>')"><?=$rs[0]?></a></td>
	  </tr>
	</table>
					</td>
					<?php
				}
				else
					echo "<td align='center'>$rs[0]</td>";
				$ttl+=$rs[0];
				$secttl[$j]+=$rs[0];
				$ttm+=$morningp[0];
				$ttn+=$noonngp[0];
			}
			if($ttl>0)
			{
				echo "<td align='center' class='cls1'>
				<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0'>
			  <tr>
				<td width='33%'align='center' class='cls1'> $ttm </td>
				
				<td width='33%'align='center' class='cls1'> ";
				?>
				<a href="javascript:OpenWind('view_studlist_att.php?clid=<?=$rBR[0]?>&secid=a')"><?=$ttl?></a></td>
			  </tr>
			</table></td>
				<?php
			}
			else
				echo "<td align='center'>$ttl</td>";
			$gttl+=$ttl;
			$gmor1+=$ttm;
			$gnoon1+=$ttn;
			$sno++;
		}
	
	}
	echo "</tr>";
	?>
	<tr height='30'><td align='right' colspan='<?php echo $secmax-1;?>'>Total&nbsp;&nbsp;</td>
	
    <?php
	if($gttl>0)
	{
		echo "<td align='center'>
		<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0'>
		  <tr>
			<td width='33%'align='center'> $gmor1 </td>
			
			<td width='33%'align='center'> ";
		?>
		<a href="javascript:OpenWind('view_studlist_att.php?clid=a&secid=a')"><?=$gttl?></a></td>
		  </tr>
		</table></td>
		<?php
	}
	else
		echo "<td align='center'>$gttl</td>";
	echo "</tr>";
	?>
</table><br>
<div id="prn" align='center'><input class='bgbutton' value=" Print " name="B1" onClick="printReport()" ></div>
</form>
</body>
</html>