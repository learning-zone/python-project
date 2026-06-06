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
		document.frm.action="Promotion1.php";
		document.frm.submit;
		return true;
	}
}
</script>
</head>
<body>
<?php 
if(isset($sub1))
{
	$san_date="$D3-$D2-$D1";
	$eff_date="$PYear-$PMon-$PDay";

	$sqlu="insert into staff_termination(staff_id,headg,eff_date,aut_name,san_no,san_date,remarks) values($id,'".addslashes($headg)."','$eff_date','".addslashes($au_name)."','".addslashes($san_no)."','$san_date','".addslashes($remarks)."')";
	execute ($sqlu) or die ("Could not insert...");
	echo "<font color=blue'><b>Insert Succefully... You can add more for same staff. ..</b></font>";
}
$qry=execute("select f_name,s_name,subj,slno,type_id from staff_det where id=$id");
$ff=fetcharray($qry);

$C_qry=execute("select d_name from staff_des where d_id=$ff[type_id]");
$C_des=fetcharray($C_qry);

$dqry=execute("select Dept from dept_no where dpt_id=$ff[subj]");
$d_name=fetcharray($dqry);
?>
<form method="POST" name=frm >
<input type=hidden name=id value="<?php echo $id?>">
<table class="forumline" align="center">
<tr><td colspan="4" class="head" align="center"><font face='Lucida Sans' size='3'>New Service Book Entry</font></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Staff ID </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $ff[slno]?></td>
<td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Staff Name </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $ff[f_name]?>&nbsp;<?php echo $ff[s_name]?></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Designation </font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $C_des[0]?></td>
<td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Curricullam</font></td>
<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $d_name[0]?></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Heading </font></td>
<td colspan="3"><input type="text" name="headg" size="80"></td></tr>  
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Sanction Authority </font></td>
<td><input type="text" name="au_name" size="20"></td>
<td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Sanction No </font></td>
<td><input type="text" name="san_no" size="20"></td></tr>
<tr><td><font face='Lucida Sans' size='1.8'>&nbsp;&nbsp;&nbsp;Sanctioned Date </font></td>
<td><select size="1" name="D1">
<?php
$d1=date("d");
$d2=date("m");
$d3=date("Y");
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
$maxYr =$d3+1;
$minYr=$d3-1;
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
$maxYr =$d3+1;
$minYr=$d3-1;
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
<td colspan="3"><textarea name="remarks" cols="80" rows="4"></textarea></td></tr>
<tr><td colspan=4 align=center><input type="submit" name="sub1" value=" Save " class=bgbutton onclick="return checknow()"></td></tr>
</table><br>
</form>
<?php
function MonthName($mon)
{
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
</body>
</html>