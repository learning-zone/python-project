<HTML>
<HEAD>
<?php
include("../db.php");
session_start();
?>
</HEAD>

<BODY topMargin=0 leftMargin="0">
<center>
<div align="left">
<form method="POST" name="frm" onSubmit="return fun1()">
</div>
<table class=forumline align=center>
<tr>
</tr>
<tr>
	<td colspan=5 class=head align=center>View Issued Reference Report</td>
</tr>		
<tr>
	<td>Select Media Type</td>
	<td width="100" align="left" colspan=3>
		<select size="1" name="media">
		<option value='0'>--------All--------</option>
		<?php
		    $smedia =execute("SELECT * FROM lib_mediatype where id not in (6) order by id");
			$num = rowcount($smedia);
			for($i=0;$i<$num;$i++)
			{
				$r = fetcharray($smedia,$i);
				if($r[id]==$media)
					$sel="selected";
				else
					$sel="";
		?>
				<option value="<?=$r["id"]?>" <?=$sel?>><?=$r["name"]?></option>
			<?php
			}
			?>
		</select></td>
</tr>
<tr>
	<td width="30%" align="right"><div align="left"><font face="Arial"> <b>From Date</b></font></td>
	<?php
	?>
	<td>
	<?php
		$d=getdate();
		$MyDay=$d["mday"];
		echo "<select name='FDay'>";
		for($i=1;$i<=31;$i++)
		{
			if($i == $MyDay)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i'>$i</option>\n";
		}
		echo "</select>";
		$MyMonth=$d["mon"];
		echo "<select name='FMon'>";
		for($i=1;$i<=12;$i++)
		{
			if($i <10)
			{
				$i="0".$i;
			}
			if($i==$MyMonth)
				echo "<option value='$i' selected>" . F367c6aa8($i) . "</option>\n";
			else
				echo "<option value='$i'>" . F367c6aa8($i) . "</option>\n";
		}
		echo "</select>";
		$maxYr = $d["year"]+1;
		$MyYear=$d["year"];
		echo "<select name='FYear'>";
		for($i=1997;$i<=$maxYr;$i++)
		{
			if($i == $MyYear)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
		}
		echo "</select>";
	?>
	</td>
	</TR>
	<tr>
				
	<td align="left"><div align="left"><font face="Arial"><b>To Date</b></font></td>
	<td>
		<?php
			$d=getdate();
			$MyDay=$d["mday"];
			echo "<select name='TDay'>";
			for($i=1;$i<=31;$i++)
			{
				if($i == $MyDay)
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
			$MyMonth=$d["mon"];
			echo "<select name='TMon'>";
			for($i=1;$i<=12;$i++)
			{
				if($i <10)
				{
					$i="0".$i;
				}
				if($i ==$MyMonth)
					echo "<option value='$i' selected>" . F367c6aa8($i) . "</option>\n";
				else
					echo "<option value='$i'>" . F367c6aa8($i) . "</option>\n";
			}
			echo "</select>";
			$maxYr = $d["year"]+1;
			$MyYear=$d["year"];
			echo "<select name='TYear'>";
			for($i=1997;$i<=$maxYr;$i++)
			{
				if($i == $MyYear)
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
		?>
			</td>
			</tr>
			
		
<tr>
	<td colspan=6 align=center><input type="submit" name="sub1" value="View Issued Reference Media List"  	                class='bgbutton'>
	</td>
</tr>
</table>
</form>

<?php
function F367c6aa8($mon)
{
	if($mon == '01') return("Jan");
	if($mon == '02') return("Feb");
	if($mon == '03') return("Mar");
	if($mon == '04') return("Apr");
	if($mon == '05') return("May");
	if($mon == '06') return("Jun");
	if($mon == '07') return("Jul");
	if($mon == '08') return("Aug");
	if($mon == '09') return("Sep");
	if($mon == '10') return("Oct");
	if($mon == '11') return("Nov");
	if($mon == '12') return("Dec");
}

if(isset($sub1))
{
	$datefrom=$FYear."-".$FMon."-".$FDay;
	$dateto=$TYear."-".$TMon."-".$TDay;

	if($media==0)
{
$sql="select a.m_no,c.status,c.cno,c.due_date,c.issue_date,c.name,c.acc_id from lib_membership_m a,";
$sql.="lib_membership_det b,lib_reference_media_trans c where b.m_id=a.id and b.mbno=c.cno and c.status=0 and";
$sql.=" (c.issue_date >= '".$datefrom."') and (c.issue_date <= '".$dateto."') order by c.issue_date";
}
if($media!=0)
{
$sql="select a.m_no,c.status,c.cno,c.due_date,c.issue_date,c.name,c.acc_id from lib_membership_m a,";
$sql.="lib_membership_det b,lib_reference_media_trans c where c.media_type='$media' and b.m_id=a.id and b.mbno=c.cno";
$sql.=" and c.status=0 and (c.issue_date >= '".$datefrom."') and (c.issue_date <= '".$dateto."') order by c.issue_date";
}
$rs = execute($sql);
$row1=rowcount($rs);
if($row1 > 0)
{
?>
<br>
    <center>
	<table align=center class=forumline colspan=7>
	<tr height='20'>
        <td align='center' colspan=7><b><font size='2'>As on :</b><?=date('d-m-Y g:i:s:a')?></font></td>
    </tr>
	<tr>
		<td colspan=7 align=center class="Head">List of Issued Reference Media</td>
	</tr>
	<tr>
		<td class="rowpic" align="center">Sl.No</td>
	    <td class="rowpic" align="center">Card No.</td>
	    <td class="rowpic" align="center">Accession No.</td>
	    <td class="rowpic" align="center">Issued Date</td>
	    <td class="rowpic" align="center">Due Date</td>
		<td class="rowpic" align="center">Issued To</td>
	    <td class="rowpic" align="center">Status</td>
	</tr>
<?php
$slno=1;
for($j=0;$j<$row1;$j++)
 {
  $r = fetcharray($rs,$j);
 
?>	
  <tr height='15'>
  <td class="CBody" align='center'><?=$slno?></td> 
  <td class="CBody" align='center'><a href="viewMemberInfo.php?Cno=<?=$r["cno"]?>"><?=$r["cno"]?></a></td>
  <td class="CBody" align='center'><a href="view_acc_info1.php?acc_no=<?=$r["acc_id"]?>&m_no=<?=$r["cno"]?>"><?=$r["acc_id"]?></a></td>
  <td class="CBody" align='center'><?=date("d-m-Y ",strtotime($r["issue_date"]))?></td>
  <td class="CBody" align='center'><?=date("d-m-Y",strtotime($r["due_date"]))?></td>
  <td class="CBody" align='center'><?=$r["name"]?></td>
  <?php
	    if($r[status]==0)
		{
			$state11="Issued";
			$clr11="red";
		}
			?>
			<td class="CBody" align='center'><font color=<?=$clr11?>><?=$state11?></font></td>
  </tr>
<?php
$slno++;
}
?>
</table>
</center>
<?php
}
}
?>
</body>
</html>