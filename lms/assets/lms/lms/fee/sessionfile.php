
<?php
include("../db.php");
$q=$_GET['q'];
?>
<table border='1' width='70%' align='center' cellspacing='0' cellpadding='1' class='forumline'>
<tr>
<td align='center'>Bank Name</td>
<td align='center' nowrap>Amount</td>
<td align='center' nowrap>DD or Cheque No.</td>
<td align='center' nowrap>DD/Cheque Date</td>		
</tr>
<?php
for($m1=1;$m1<=$q;$m1++)
{
?>
		<tr><td  align='center' ><select name='bname<?=$m1?>' style="alignment-adjust:central">
		<option value=''>--- Select Bank ---</option>
		<?php
		$sql=execute("select id,bank_name from bank_details where status=1 order by bank_name");
		if(rowcount($sql)>0)
		{
			for($i=0;$i<rowcount($sql);$i++)
			{
				$r=fetcharray($sql);
				if($bname==$r[0])
					echo "<option value=$r[0] selected>$r[1]</option>";
				else
					echo "<option value=$r[0]>$r[1]</option>";
			}
		}
		else
		{
			die("<font color=''><b>Add Bank Details first</b></font>");
		}
		?>
		</select></td>
		
		<td align='center' ><input type='text' name='bamt<?=$m1?>' value='<?=$bdet?>'></td>
		<td align='center' ><input type='text' name='ddno<?=$m1?>' value='<?=$ddno?>'></td>
	<td align='center' ><select name='pdt<?=$m1?>'>
	<?php
	if($pdt=='')
		$pdt=$cdt;
	for($i=1;$i<=31;$i++)
	{
		if($i<10)
			$i="0".$i;
		if($i==$pdt)
			echo "<option value=$i selected>$i</option>";
		else
			echo "<option value=$i>$i</option>";
	}
	?>
	</select><select name='pmt<?=$m1?>'>
	<?php
	if($pmt=='')
		$pmt=$cmt;
	for($i=1;$i<=12;$i++)
	{
		if($i<10)
			$i="0".$i;
		if($i==$pmt)
			echo "<option value=$i selected>" . MonthName($i) . "</option>";
		else
			echo "<option value=$i>" . MonthName($i) . "</option>";
	}
	?>
	</select><select name='pyr<?=$m1?>'>
	<?php
	$cyr=date("Y");
	if($pyr=='')
		$pyr=$cyr;
	for($i=$cyr-4;$i<=$cyr+1;$i++)
	{
		if($i==$pyr)
			echo "<option value=$i selected>$i</option>";
		else
			echo "<option value=$i>$i</option>";
	}
	echo "</select></td></tr>";

}
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
?></table>
