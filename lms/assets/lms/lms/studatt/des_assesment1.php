<HTML>
<HEAD>
<?php
session_start();
include("../db.php");

?>
<SCRIPT LANGUAGE="JavaScript">
function adds_onclick()
{
	document.frm.action="add_cie.php?Type=Add";
	document.frm.submit();
}
function Modify_onclick()
{
	document.frm.action="add_cie.php?Type=Mod";
	document.frm.submit();
}
</SCRIPT>
</HEAD>
<BODY class='bodyline'>
<form name="frm" method="post">
<input type=hidden name='prm' value='<?=$prm?>'>
<input type=hidden name='sem' value='<?=$sem?>'>
<input type=hidden name='subn' value='<?=$subn?>'>
<input type=hidden name='secid' value='<?=$secid?>'>
<Table class='forumline' align=center>
<tr><td Class="head" align=center colspan=3>Add / Modify Subject Evaluation Scheme</td></tr>
<tr><td>&nbsp;</td></tr><tr><td>
<?php
$cyr=$curyr1;
$insdt=date("Y-m-d");

$sql2=execute("select * from cie_det where accyr=$cyr and c_id='$prm' and sem_id='$sem' and sec_id='$secid' and sub_id=$subn");
$num=rowcount($sql2);
if($num>0)
{
	?>
	<Table class='forumline' align='center'>
	<TR><TD Class="rowpic" align='center'>Sel</TD><TD Class="rowpic" align='center' nowrap>ASSESSMENT NAME</TD><TD Class="rowpic" nowrap align='center'>CONDUCTED DATE</TD><TD Class="rowpic" align='center'>MAX MARKS</TD><TD Class="rowpic" align='center'>WEIGHTAGE</TD></TR>
	<?php
	$r2=fetcharray($sql2);
	$num_cie=$r2[num_cie];
	for($i=1;$i<=$num_cie;$i++)
	{
		$ass_dt1=explode("-",$r2["ass_dt".$i]);
		?>
		<TR><TD class="CBody"><Input Type="checkbox" name="Sel[]" value="<?=$i?>"></TD>
		<td class="CBody"><Input Type="Text" Name="ass<?=$i?>" value='<?=$r2["ass".$i]?>' size=30></td>
		<td class="CBody"><select name="ass_dtd<?=$i?>">
		<?php
		for($j=1;$j<=31;$j++)
		{
			if($j < 10)
			{
				$j="0".$j;
			}
			$sel="";
			if($j==$ass_dt1[2])
			{
				$sel="selected";
			}
			echo "<option  value='$j' $sel >$j</option>";

		}
		?>
		</select><select name="ass_dtm<?=$i?>">
		<?php
		for($j=1;$j<=12;$j++)
		{
			if($j < 10)
			{
				$j="0".$j;
			}
			$sel="";
			if($j==$ass_dt1[1])
			{
				$sel="selected";
			}
			echo "<option  value='$j' $sel >$j</option>";
		}
		?>
		</select>
		<select name="ass_dty<?=$i?>">
		<?php
		for($j=$cyr-1;$j<=$cyr+1;$j++)
		{
			$sel="";
			if($j==$ass_dt1[0])
			{
				$sel="selected";
			}
			echo "<option  value='$j' $sel >$j</option>";
		}
		echo "</select>";
		?>
		</td>
		<td class="CBody" align='center'><Input Type="Text" Name="ass_max<?=$i?>" value='<?=$r2["ass_max".$i]?>' size=4></td>
		<td class="CBody" align='center'><Input Type="Text" Name="ass_wt<?=$i?>" value='<?=$r2["ass_wt".$i]?>' size=4></td>
		<?php
	}
	?>
	<tr><td colspan=5 align=center><Input type="submit" Name="Modify" value="Modify" onclick="Modify_onclick()" class='bgbutton'></td></tr></table>
	<?php
}
if($num_cie=='')
	$num_cie=1;
else
	$num_cie++;
?>
<input type='hidden' name='num_cie' value='<?=$num_cie?>'>
<br><br><Table class='forumline' align='center' width='100%'>
<TR><TD Class="rowpic" nowrap align='center'>ASSESSMENT NAME</TD><TD Class="rowpic" nowrap align='center'>CONDUCTED DATE</TD><TD Class="rowpic" align='center'>MAX MARKS</TD><TD Class="rowpic" align='center'>WEIGHTAGE</TD></TR>
<TR><td class="CBody"><Input Type="Text" Name="ass" size=30></td>
<td class="CBody"><select name="ass_dtd">
<?php
$cdt=explode("-",$insdt);
for($j=1;$j<=31;$j++)
{
	if($j < 10)
	{
		$j="0".$j;
	}
	$sel="";
	if($j==$cdt[2])
	{
		$sel="selected";
	}
	echo "<option  value='$j' $sel >$j</option>";

}
?>
</select><select name="ass_dtm">
<?php
for($j=1;$j<=12;$j++)
{
	if($j < 10)
	{
		$j="0".$j;
	}
	$sel="";
	if($j==$cdt[1])
	{
		$sel="selected";
	}
	echo "<option  value='$j' $sel >$j</option>";
}
?>
</select>
<select name="ass_dty">
<?php
for($j=$cyr-1;$j<=$cyr+1;$j++)
{
	$sel="";
	if($j==$cdt[0])
	{
		$sel="selected";
	}
	echo "<option  value='$j' $sel >$j</option>";
}
echo "</select>";
?>
</td>
<td class="CBody" align='center'><Input Type="Text" Name="ass_max" size=4></td>
<td class="CBody" align='center'><Input Type="Text" Name="ass_wt" size=4></td>
<tr><td colspan=4 align=center><Input type="submit" Name="Add" value="<< ADD >>" onclick="adds_onclick()" class='bgbutton'></td></tr>
</form>
</BODY>
</HTML>