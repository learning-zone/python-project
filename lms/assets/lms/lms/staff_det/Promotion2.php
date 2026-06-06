<html>
<head>
<title>Service Book Information</title>
<?php 
session_start();
include("../db.php");
?>
<script language="JavaScript">
function checknow()
{
	if(document.frm.headg.value=='')
	{
		alert("Please Enter Heading");
		return false;
	}
	if(document.frm.au_name.value=='')
	{
		alert("Please Enter Authority");
		return false;
	}
	if(document.frm.san_no.value=='')
	{
		alert("Please Enter Sanction No.");
		return false;
	}
	if(document.frm.remarks.value=='')
	{
		alert("Please Enter Description");
		return false;
	}
	else
	{
		document.frm.action="Promotion2.php";
		document.frm.submit;
		return true;
	}
}
function checkdel()
{
	if(confirm("Are you sure you want to delete ?"))
	{
		document.frm.action="Promotion2.php";
		document.frm.submit;
		return true;
	}
	else
	{
		return false;
	}
}
function reload()
{
	document.frm.action="Promotion2.php";
	document.frm.submit;
	return true;
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
	
	$sqlu="update staff_termination set headg='".addslashes($headg)."',eff_date='$eff_date',aut_name='".addslashes($au_name)."',san_no='".addslashes($san_no)."',san_date='$san_date',remarks='".addslashes($remarks)."' where id=$mdel";
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
			<td align="center"><a href="Promotion2.php?id=<?=$id?>&mdel=<?=$crs[0]?>&fYear=<?=$fYear?>&fMon=<?=$fMon?>&fDay=<?=$fDay?>&tYear=<?=$tYear?>&tMon=<?=$tMon?>&tDay=<?=$tDay?>">EDIT</a></td></tr>
			<?php
		}
		echo "</table>";
	}
	else
	{
		echo "<font color='blue'><b>No entries in Service Book..</b></font>";
		die();
	}
}

if($mdel!='')
{
	$rsql=execute("select * from staff_termination where id=$mdel");
	$rsl=fetcharray($rsql);
	?>
	<input type="hidden" name="mdel" value="<?=$mdel?>">
	<table class="forumline" align="center" width='100%'>
	<tr><td colspan="4" class="head" align="center"><font face='Lucida Sans' size='3'>Modify/Delete Service Book Details</font></td></tr>
	<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Heading </font></td>
	<td colspan="3"><input type="text" name="headg" size="80" value='<?=stripslashes($rsl[7])?>'></td></tr>  
	<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Sanction Authority </font></td>
	<td><input type="text" name="au_name" size="20" value='<?=stripslashes($rsl[4])?>'></td>
	<td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Sanction No </font></td>
	<td><input type="text" name="san_no" size="20" value='<?=stripslashes($rsl[3])?>'></td></tr>
	<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Sanctioned Date </font></td>
	<td><select size="1" name="D1">
	<?php
	$sadt=explode("-",$rsl[2]);
	$d1=$sadt[2];
	$d2=$sadt[1];
	$d3=$sadt[0];
	for($k1=1;$k1<=31;$k1++)
	{
		if($k1==$d1)
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
	</select>
	<select size="1" name="D2">
	<?php
	for($k2=1;$k2<=12;$k2++)
	{
		if($k2==$d2)
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
	$maxYr =date("Y")+1;
	$minYr=$d3-2;
	echo "<select name='D3'>";
	for($i=$minYr;$i<=$maxYr;$i++)
	{
		if($i == $d3)
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
	<td>&nbsp;&nbsp;&nbsp;Efective Date </td><td><select size="1" name="PDay">
	<?php
	$efdt=explode("-",$rsl[6]);
	$d1=$efdt[2];
	$d2=$efdt[1];
	$d3=$efdt[0];
	for($k1=1;$k1<=31;$k1++)
	{
		if($k1==$d1)
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
	</select><select size="1" name="PMon">
	<?php
	for($k2=1;$k2<=12;$k2++)
	{
		if($k2==$d2)
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
	$maxYr =date("Y")+1;
	$minYr=$d3-2;
	echo "<select name='PYear'>";
	for($i=$minYr;$i<=$maxYr;$i++)
	{
		if($i == $d3)
		{
			echo "<option value='$i' selected>$i</option>\n";
		}	
		else
		{
			echo "<option value='$i' >$i</option>\n";
		}
	}
	echo "</select></td></tr>";
	?>
	<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Description </font></td>
	<td colspan="3"><textarea name="remarks" cols="80" rows="4"><?=stripslashes($rsl[5])?></textarea></td></tr>
	<tr><td colspan=4 align=center><input type="submit" name="sub1" value=" Modify " class=bgbutton onclick="return checknow()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="sub2" value=" Delete " class=bgbutton onclick="return checkdel()"></td></tr>
	</table>
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