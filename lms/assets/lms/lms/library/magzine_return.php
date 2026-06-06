<?php
include_once("../db.php");
$media=$_POST['media'];
$FDay=$_POST['FDay'];
$FMon=$_POST['FMon'];
$FYear=$_POST['FYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];
$sub1 = $_POST['sub1'];
//print_r($_GET);
//print_r($_POST);
?>
<html><head>
<!------------------------------------------------------------>
<script language=javascript>
function validate()
{
	if(document.frm.report_gen.value=="")
		{
	      alert("Report Generation On");
	      return false
	    }
    else
		{
	      return true
	    }
}
function printreport()
{
prn.style.display="none";
print(this.form);
}
</script></head>
<!------------------------------------------------------------>
<BODY topMargin=0 leftMargin="0">
<form method="POST" name="frm" onSubmit="return validate()">
<table class=forumline align=center width="47%">
<tr>
</tr>
<tr>
	<td colspan=5 class=head align=center>View Returned Magazine/Journal/Question Paper Report</td>
</tr>		
<tr>
	<td>&nbsp;&nbsp;&nbsp;Select Media Type</td>
	<td width="100" align="left" colspan=3>
		<select size="1" name="media" onchange='reload()'>
		<option value='0'>Select Media</option> 
		<?php
               if($media== "7")
                 {
	               $mag="selected";
	               $que="";
                 }
               if($media== "8")
                 {
	               $mag="";
	               $que="selected";
               }
			   ?>
		<option value='7' <?php echo $mag ?> >Magazine/Journal</option>
		<option value='8' <?php echo $que ?> >Question Paper</option>
		</select>
		</td>
</tr>
<tr>
	<td width="30%" align="left">&nbsp;&nbsp;&nbsp;From Date</td>
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
				
	<td align="left">&nbsp;&nbsp;&nbsp;To Date</td>
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
	
</tr>
</table>
<br>
<div align=center><input type="submit" name="sub1" value="<<  View Report  >>" class='bgbutton'></div>
</form>

<?php

if(isset($sub1))
{
	$datefrom=$FYear."-".$FMon."-".$FDay;
	$dateto=$TYear."-".$TMon."-".$TDay;
?>
<br>
    <center>
	<table align=center class=forumline colspan=9 width="90%">
	<tr height='20'>
        <td align='center' colspan=9>As on :<?=date('d-m-Y g:i:s:a')?></td>
    </tr>
	<tr>
		<td colspan=9 align=center class="Head">List of Issued Reference Media</td>
	</tr>
	<tr>
		<td class="rowpic" align="center">Sl.No</td>
	    <td class="rowpic" align="center">Card No.</td>
	    <td class="rowpic" align="center">Accession No.</td>
	    <td class="rowpic" align="center">Issued Date</td>
	    <td class="rowpic" align="center">Due Date</td>
		<td class="rowpic" align="center">Returned Date</td>
		<td class="rowpic" align="center">Issued To</td>
		<td class="rowpic" align="center">Returned To</td>
	    <td class="rowpic" align="center">Status</td>
	</tr>
<?php

if($media==0)
{
$sql="select a.m_no,c.status,c.cno,c.due_date,c.issue_date,c.return_date,c.ret_to,c.name,c.acc_id from lib_membership_m a,";
$sql.="lib_membership_det b,lib_circulation_m c where b.m_id=a.id and b.mbno=c.cno and c.status=1 and";
$sql.=" (c.return_date >= '".$datefrom."') and (c.return_date <= '".$dateto."') and c.media_type in(7,8) order by c.issue_date";
}
if($media!=0)
{
$sql="select a.m_no,c.status,c.cno,c.due_date,c.issue_date,c.return_date,c.ret_to,c.name,c.acc_id from lib_membership_m a,";
$sql.="lib_membership_det b,lib_circulation_m c where c.media_type='$media' and b.m_id=a.id and b.mbno=c.cno";
$sql.=" and c.status=1 and (c.return_date >= '".$datefrom."') and (c.return_date <= '".$dateto."') order by c.issue_date";
}
//echo $sql;
$rs = execute($sql);
$row1=rowcount($rs);
if($row1==0)
{
	echo "No Records Found !!!";
}
if($row1 > 0)
{
?>
<!-----------------------------  PREVIOUS VIEW  -----------------------------------------
<br>
    <center>
	<table align=center class=forumline colspan=9>
	<tr height='20'>
        <td align='center' colspan=9>As on :<?=date('d-m-Y g:i:s:a')?></td>
    </tr>
	<tr>
		<td colspan=9 align=center class="Head">List of Issued Reference Media</td>
	</tr>
	<tr>
		<td class="rowpic" align="center">Sl.No</td>
	    <td class="rowpic" align="center">Card No.</td>
	    <td class="rowpic" align="center">Accession No.</td>
	    <td class="rowpic" align="center">Issued Date</td>
	    <td class="rowpic" align="center">Due Date</td>
		<td class="rowpic" align="center">Returned Date</td>
		<td class="rowpic" align="center">Issued To</td>
		<td class="rowpic" align="center">Returned To</td>
	    <td class="rowpic" align="center">Status</td>
	</tr>
---------------------------------------------------------------------------------------->
<?php
$slno=1;
for($j=0;$j<$row1;$j++)
 {
  $r = fetcharray($rs,$j);
 
?>	
  <tr height='15'>
  <td class="CBody" align='center'><?=$slno?></td> 
  <td class="CBody" align='center'><a href="viewMemberInfo.php?Cno=<?=$r["cno"]?>"><?=$r["cno"]?></a></td>
  <td class="CBody" align='center'><a href="mag_view1.php?acc_no=<?=$r["acc_id"]?>&m_no=<?=$r["cno"]?>"><?=$r["acc_id"]?></a></td>
  <td class="CBody" align='center'><?=date("d-m-Y ",strtotime($r["issue_date"]))?></td>
  <td class="CBody" align='center'><?=date("d-m-Y",strtotime($r["due_date"]))?></td>
  <td class="CBody" align='center'><?=date("d-m-Y",strtotime($r["return_date"]))?></td>
  <td class="CBody" align='center'><?=$r["name"]?></td>
  <td class="CBody" align='center'><?=$r["ret_to"]?></td>
  <?php
	    if($r[status]==1)
		{
			$state11="Returned";
			$clr11="red";
		}
			?>
			<td class="CBody" align='center'><?=$state11?></td>
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
?>

</body>
</html>