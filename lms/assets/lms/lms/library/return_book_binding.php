<?php
require_once("../db.php");
$library=$_POST['library'];
$rbb=$_POST['rbb'];
?>
<html><head>
<script language='javascript'>
function reload()
{
	document.frm.action="return_book_binding.php";
	document.frm.submit();
}
</script>
</head>
<body>
<form name='frm' method='POST' action='modify_book_binding_det.php'>
<?php if($msg!="") echo "$msg"; ?>
<table class='forumline' align='center'>
<tr><br/><td class='head' align='center' colspan='4'>Book(s) Received after Binding</td>
</tr>

<?php
/*
<td align='right' colspan='2'>Library&nbsp;&nbsp;</td>
	<td colspan='2'><select name="library" onChange="reload()">
	<option value=''>Select Library</option>
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
	echo "</select></td></tr>";
*/
$library=1;
//$Register=1;
	
//	if($library!="")
	{
		//echo "select * from lib_book_binding where library='$library' and status='S' order by acc_no"; 
		$rr=execute("select * from lib_book_binding where library='$library' and status='S' order by acc_no");
		if(rowcount($rr)>0)
		{
			?>
			<tr><td align='center' width='5%' nowrap>Select</td><td align='center' width='20%' nowrap>Accession No.</td><td align='center'>Description</td>
			<td align='center' nowrap width='15%'>Sent Date</td></tr>
			<?php
			while($r=fetcharray($rr))
			{
				echo "<tr><td align='center'><input type='checkbox' name='rbb[]' value='$r[0]'></td>";
				echo "<td>&nbsp;&nbsp;$r[acc_no]</td>";
				echo "<td><textarea rows='2' cols='70' readonly>".stripslashes($r[descr])."</textarea></td>";
				$sdt=explode("-",$r[binding_date]);
				$sentdt=$sdt[2]." ".month_name($sdt[1])." ".$sdt[0];
				echo "<td align='center' nowrap>$sentdt</td></tr>";
			}
			?>
			<tr height='50'></tr>
			<?php
		}
	}

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
</table>
<br>
<div align='center'><input type='submit' value='<< Returned  >>' name='add' class=bgbutton onClick='frm_submit()'></div>
</form>
</body>
</html>