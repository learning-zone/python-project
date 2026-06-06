<html>
<?php
session_start();
include("../db.php");
$course=$_POST['course'];
$year1=$_POST['year1'];
$feehead=$_POST['feehead'];
$accyear=$_POST['accyear'];

?>
<head>
<script language="JavaScript">
function prnfee()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = "";
}
</script>
</head>
<body>
<table class='forumline' align='center' border="0" width="80%">
<tr><td Class="head" align='center' colspan=5 >Fee Structure for <?=$accyear?>-<?=($accyear+1)?></td></tr>
	<tr height='25'>
		<td align='center' colspan=2><?=$_SESSION['branchname']?></td>
		<td align='center'><?=$_SESSION['semname']?></td>
		<td align='center' colspan=2>Admission Type</td>
	</tr>
	<?php
		$sql="select coursename from course_m where status=1 and course_id='$course'";
	 	$rs=execute($sql);
		$r1=fetchrow($rs);
		$sql1=execute("select year_name from course_year where status=1 and year_id='$year1'");
		$r2=fetcharray($sql1);
		$sql3=execute("select name from admission where id=$feehead");
		$r3=fetcharray($sql3);
	 ?>
	<tr>
	 <td align='center' colspan=2>&nbsp;&nbsp;<?php echo $r1[0]?></td>
	 <td align='center'>&nbsp;&nbsp;<?php echo $r2[0]?></td>
	 <td align='center' colspan='2'>&nbsp;&nbsp;<?php echo $r3[0]?></td></tr>
<?php
 if($course!=0 && $year1!=0 && $feehead!=0)
 {
	 ?>
		<tr><td Class="head" align='center' colspan=5>&nbsp;</td></tr>
		<tr>
			<td align='center'><div id="sl" onClick="selectMe()" onMouseOver="changeMs(1)" onMouseOut="changeMs(0)">Sl No</div></td>
			<td align='center'>Fee Name</td>
			<td align='center'>Fee Category</td>
			<td align='center'>Fee Amount</td>
			<td align='center'>Refundable</td>
		</tr>
<?php
	$var = execute("select fid,amount,catid from fee_head where course_id='$course' and year_id='$year1' and admission_type='$feehead' and accyr='$accyear' and status=1 order by catid,fid");
	if(rowcount($var)>0)
	{
		$sno=1;
		while($r=fetcharray($var))
		{
			$famt=$r[amount];
			$tfeeamt+=$famt;
			$sql=fetcharray(execute("select * from fee_type where fee_id=$r[fid]"));
			if($sql[refund]==1)
				$rfd='Yes';
			else
				$rfd='No';
			if($sno<10)
				$sno="".$sno;
			$rs1=fetcharray(execute("select cat_name from fee_cat where catid=$r[catid]"));
			?>
			<tr><td align='center'><?=$sno?></td><td align='left'>&nbsp;&nbsp;&nbsp;<?php echo $sql[fee_name] ?></td>
			<td align='left'>&nbsp;&nbsp;<?php echo $rs1[0]?></td>
			<td align='right'><?php echo $famt ?></td><td align='center'><?php echo $rfd ?></td></tr>
			<?php
			$sno++;
		}
		?>
		<tr><td align='right' colspan=3>Total Amount&nbsp;&nbsp;&nbsp;</td><td align="right"><?=$tfeeamt?></td><td></td></tr>
		</table><br>
		<div id="prn" align="center"><input type="button" name="prnfeest" value="PRINT" class="bgbutton" onClick="prnfee()"></div>
		<?php
	}
	else
	{
		echo "<br><b>Fee Structure not defined...!!</b>";
		die();
	}
 }
?>
</form>
</html>