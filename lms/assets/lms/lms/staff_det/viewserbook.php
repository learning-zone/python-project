<html>
<head>
<title>Service Book Information</title>
<?php 
session_start();
include("../db.php");
?>
<script language="javascript">
function Print1()
{
	prn.style.display="none";
	window.print();
	prn.style.display="";
}
function reload()
{
	document.frm.action="viewserbook.php";
	document.frm.submit;
	return true;
}
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=500,width=750,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
</head>
<body>
<form name="frm" method="post">
<input type="hidden" name="id" value="<?=$id?>">
<?php
$fdt="$fYear-$fMon-$fDay";
$tdt="$tYear-$tMon-$tDay";
$qry=execute("select f_name,s_name,subj,slno,type_id from staff_det where id=$id");
$ff=fetcharray($qry);

$C_qry=execute("select d_name from staff_des where d_id=$ff[type_id]");
$C_des=fetcharray($C_qry);

$dqry=execute("select Dept from dept_no where dpt_id=$ff[subj]");
$d_name=fetcharray($dqry);
?>
<table class="forumline" align="center" width='100%'>
<tr><td colspan="4" class="head" align="center"><font face='Lucida Sans' size='3'>Service Book Details</font></td></tr>
<tr><td colspan="4" align="center"><font face='Lucida Sans'color='brown'>*** Select From & To dates to View ***</font></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Staff ID </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $ff[slno]?></td>
<td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Staff Name </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $ff[f_name]?>&nbsp;<?php echo $ff[s_name]?></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Designation </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $C_des[0]?></td>
<td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Department </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $d_name[0]?></td></tr>
<tr><td align='center'>Period From</td><td><select size="1" name="fDay">
<?php
if($fDay=='')
{
	$fDay=date("d");
	$fMon=date("m");
	$fYear=date("Y");
}
for($k1=1;$k1<=31;$k1++)
{
	if($k1==$fDay)
	{
		?>
		<option value="<?php echo $k1?>" selected><?php echo $k1?></option>
		<?php
	}
	else
	{
		?>
		<option value="<?php echo $k1?>"><?php echo $k1?></option>
		<?php
	}
}
?>
</select><select size="1" name="fMon">
<?php
for($k2=1;$k2<=12;$k2++)
{
	if($k2==$fMon)
	{
		?>
		<option value="<?php echo $k2?>" selected><?php echo MonthName($k2)?></option>
		<?php
	}
	else
	{
		?>
		<option value="<?php echo $k2?>"><?php echo MonthName($k2)?></option>
		<?php
	}
}
echo "</select>";
$maxYr =$fYear+1;
$minYr=$fYear-5;
echo "<select name='fYear'>";
for($i=$minYr;$i<=$maxYr;$i++)
{
	if($i == $fYear)
	{
		echo "<option value='$i' selected>$i</option>\n";
	}	
	else
	{
		echo "<option value='$i' >$i</option>\n";
	}
}
echo "</select></td>";
?>
<td align='center'>Period To</td><td><select size="1" name="tDay">
<?php
if($tDay=='')
{
	$tDay=date("d");
	$tMon=date("m");
	$tYear=date("Y");
}
for($k1=1;$k1<=31;$k1++)
{
	if($k1==$tDay)
	{
		?>
		<option value="<?php echo $k1?>" selected><?php echo $k1?></option>
		<?php
	}
	else
	{
		?>
		<option value="<?php echo $k1?>"><?php echo $k1?></option>
		<?php
	}
}
?>
</select><select size="1" name="tMon">
<?php
for($k2=1;$k2<=12;$k2++)
{
	if($k2==$tMon)
	{
		?>
		<option value="<?php echo $k2?>" selected><?php echo MonthName($k2)?></option>
		<?php
	}
	else
	{
		?>
		<option value="<?php echo $k2?>"><?php echo MonthName($k2)?></option>
		<?php
	}
}
echo "</select>";
$maxYr =$tYear+1;
$minYr=$tYear-5;
echo "<select name='tYear'>";
for($i=$minYr;$i<=$maxYr;$i++)
{
	if($i == $tYear)
	{
		echo "<option value='$i' selected>$i</option>\n";
	}	
	else
	{
		echo "<option value='$i' >$i</option>\n";
	}
}
?>
</select></td>
<tr><td colspan=4 align=center><input type="submit" name="getdt" value=" Get Details " class="bgbutton" onclick="return reload()"></td></tr>
</table>
<?php
if(isset($sub1))
{
	$san_date="$D3-$D2-$D1";
	$eff_date="$PYear-$PMon-$PDay";
	
	$sqlu="update staff_termination set headg='$headg',eff_date='$eff_date',aut_name='$au_name',san_no='$san_no',san_date='$san_date',remarks='$remarks' where id=$mdel";
	execute ($sqlu) or die ("Could not Update...");
}
if(isset($sub2))
{
	$sqlu="delete from staff_termination where id=$mdel";
	execute ($sqlu) or die ("Could not Delete...");
	$mdel='';
}
if($fdt!="--" || $tdt!="--")
{
	$csql=execute("select * from staff_termination where staff_id=$id and san_date between '$fdt' and '$tdt' order by san_date");
	if(rowcount($csql)>0)
	{
		?>
		<table class='forumline' align='center' width='100%'>
		<tr><td align="center">S.No</td><td align="center">Saction No</td><td align="center">Sanction Date</td><td align="center">Authority</td><td align="center">Heading</td><td align="center">Effective Date</td><td align="center">Action</td></tr>
		<?php
		$k=0;
		while($crs=fetcharray($csql))
		{
			$k++;
			if($k<10)
				$k="0".$k;
			$sdt=explode("-",$crs[san_date]);
			$sdt1="$sdt[2]-$sdt[1]-$sdt[0]";
			$edt=explode("-",$crs[eff_date]);
			$edt1="$edt[2]-$edt[1]-$edt[0]";
			?>
			<tr><td align="center"><?=$k?></td><td><?=stripslashes($crs[3])?></td>
			<td nowrap align="center"><?=$sdt1?></td><td><?=stripslashes($crs[4])?></td>
			<td><?=stripslashes($crs[7])?></td><td nowrap align="center"><?=$edt1?></td>
			<td align="center"><A HREF="javascript:OpenWind('viewserbook1.php?id=<?=$id?>&mdel=<?=$crs[0]?>')">VIEW</a></td></tr>
			<?php
		}
		echo "</table>";
	}
	else
	{
		echo "<font color='blue'><b>No entries in Service Book..</b></font>";
		die();
	}
	?>
	<br><div id="prn" align="center">
	<input type="button" class=bgbutton value="<< PRINT >>" onClick="Print1()"></div>
<?php
}
?>
</form>
<?php
function MonthName($mon){
        if($mon == 1) return("Jan");
        if($mon == 2) return("Feb");
        if($mon == 3) return("Mar");
        if($mon == 4) return("Apr");
        if($mon == 5) return("May");
        if($mon == 6) return("Jun");
        if($mon == 7) return("Jul");
        if($mon == 8) return("Aug");
        if($mon == 9) return("Sep");
        if($mon == 10) return("Oct");
        if($mon == 11) return("Nov");
        if($mon == 12) return("Dec");
}
?>
</form>
</body>
</html>