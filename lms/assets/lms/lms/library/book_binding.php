<?php
require_once("../db.php");
$library=$_POST['library'];
$acc_no=$_POST['acc_no'];
$des=$_POST['des'];
$Day=$_POST['Day'];
$Mon=$_POST['Mon'];
$Year=$_POST['Year'];			
?>
<html>
<head></head>
<body>
<form method='POST' name='frm' action="save_book_binding_det.php">
<table  align='center' class='forumline' >
	<tr>
		<br/><td class='head' align='center' colspan=2>Book Binding Details</td>
	</tr>
    <?php
	/*
	<tr>
		<td align='left'>Library</td>
		<td>
		<select size="1" name="library">
		<?php
		$sql1 = "SELECT * FROM library_name";
		$rs1 = execute($sql1);
		$row1 = rowcount($rs1);
		for($i=0;$i<$row1;$i++)
		{
			$r1 = fetcharray($rs1);
			if($r1[id]==$library)
				$sel="selected";
			else
				$sel="";
			?>
			<option value="<?=$r1["id"]?>" <?=$sel?>><?=$r1["name"]?></option>
			<?php
		}
		?>
		</select>
	</td>	
	</tr>
	*/
	$library=1;
	?>
	<tr>
		<td nowrap="nowrap" align='left'>&nbsp;&nbsp;Accession No.</td>
		<?php
		$sql3=fetcharray(execute("select max(id) from lib_book_binding"));
		$nos=$sql3[0]+1;
		if($nos<10)
			$acc_no="BB0000000".$nos;
		elseif($nos<100)
			$acc_no="BB000000".$nos;
		elseif($nos<1000)
			$acc_no="BB00000".$nos;
		elseif($nos<10000)
			$acc_no="BB0000".$nos;
		elseif($nos<100000)
			$acc_no="BB000".$nos;
		elseif($nos<1000000)
			$acc_no="BB00".$nos;
		elseif($nos<10000000)
			$acc_no="BB0".$nos;
		else
			$acc_no="BB".$nos;
		?>
		<td align='left'><input type='text' name='acc_no' maxlength='15' size='20' value='<?=$acc_no?>' readonly></td>
	</tr>
	<tr>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;Description</td>
		<td align='left'><textarea name='des' rows='5' cols='50'></textarea></td>
	</tr>
	<tr>
		<td nowrap="nowrap" align='left'>Date of Sending</td>
		<td align='left'>
		<?php
			$d=getdate();
			$MyDay=$d["mday"];
			echo "<select name='Day'>";
			for($i=1;$i<=31;$i++)
			{
				if($i <10)
				{
					$i="0".$i;
				}
				if($i == $MyDay)
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
			$MyMonth=$d["mon"];
			echo "<select name='Mon'>";
			for($i=1;$i<=12;$i++)
			{
				if($i <10)
				{
					$i="0".$i;
				}
				if($i == $MyMonth)
					echo "<option value='$i' selected>" . month_name($i) . "</option>\n";
				else
					echo "<option value='$i'>" . month_name($i) . "</option>\n";
			}
			echo "</select>";
			$myr=$d["year"]-5;
			$maxYr =$d["year"]+1;
			$MyYear=$d["year"];
			echo "<select name='Year'>";
			for($i=$myr;$i<=$maxYr;$i++)
			{
			if($i == $MyYear)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
			}
		?>
		</select></td>
	</tr>
	<tr height='40'>
		<td width='100%' colspan='2' align='left'>
		
	</tr>
</table>
<br>
<div align='center'><input type='submit' value='<<  Send  >>' name='add' class='bgbutton'></div>
<?php
function month_name($mon)
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
</form>
</body>
</html>	