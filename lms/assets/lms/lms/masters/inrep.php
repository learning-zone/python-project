 <html>
 <?php
      include("../db.php");
      $cur=date('Y');
 ?>
<head>
<title> Intake Report </title>
<SCRIPT LANGUAGE="JavaScript">
function prnfee()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = " ";
}
function reload()
{
	document.frm.action="inrep.php";
	document.frm.submit();
}
</script>
</head>
<body>
<form name="frm" method="post" action="inrep.php">
<?php 
if($acyr=="")
{
	$acyr=date("Y");
	$fyr=$acyr-3;
	$tyr=$acyr+2;
	echo "<table class='forumline' align=center width='30%'>";
	echo "<tr><td colspan='2' align='center' class='head'>Intake Report</td></tr>";
	echo "<tr height='40'><td align='center'><b>Accademic Year</b></td><td>";
	echo "<select name='acyr' onchange='reload()'>";
	echo "<option value=''>-- Select --</option>";
	for($i=$fyr;$i<$tyr;$i++)
	{
		echo "<option value='$i'>$i</option>";
	}
	echo "</select></td></tr>";
	echo "</table>";
}
else
{
	?>
	<table class='forumline' align=center width="50%">
	<tr><td Class="head" colspan=5 align='center'><font size="2">Intake Report : <?=$acyr?></font></td></tr>
	<tr><td class="row3" align='center'>Sl.No</td>
	<td class="row3" align='center'>Class</td>
	<td class="row3" align='center'>Maximun Capacity</td>
	<td class="row3" align='center'>Admitted</td>
	<td class="row3" align='center'>Vacancy</td>
	</tr>
	<?php
	$sno=1;
	$sds=execute("select distinct(course_id) from intake order by course_id");
	while($r=fetcharray($sds))
	{
		$ras = fetcharray(execute("select sum(intake) from intake where course_id='$r[0]'"));
		$str1 = "SELECT * FROM course_year where year_id='$r[0]'";
		$rs1 = execute($str1);
		$r2 = fetcharray($rs1);
		if($sno<10)
			$sno="0".$sno;
		?>
		<tr>
		<td align='center'><b><?=$sno?></b></td>
		<td class="CBody"><font color="#0A2756"><b>&nbsp;&nbsp;<?php echo $r2[year_name]?></b></font></td>
	   <td class="CBody" align='center'><?php echo $ras[0]; ?></td>
		<?php		
			$intaketot=$intaketot+$ras[0];
		?>
		<?php 
		$str3="select count(id) from student_m where course_yearsem='$r[0]' and archive='N' and academic_year='$acyr'";
		$sstr3=execute($str3);
		$st3=fetcharray($sstr3);
		$admtot=$admtot+$st3[0];
		$rem=$ras[0]-$st3[0];
		$remtot=$remtot+$rem;
		?>
		<td class="CBody" align='center'><?php if($st3[0]>0) echo $st3[0]; else echo "0"; ?></td>
		<td class="CBody" align='center'><?php echo $rem ?></td>
		</tr>
		<?php
			$sno++;
	}
	?>
	<tr height='35'><td colspan=2 align="center"><b>Total</b></td><td align='center'><b><?php echo $intaketot ?></b></td><td align='center'><b><?php echo $admtot ?></b></td><td align='center'><b><?php echo $remtot ?></b></td></tr>
	</table><br><br>
	<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
	<?php
}
	?>
</form>
</body>
</html>
