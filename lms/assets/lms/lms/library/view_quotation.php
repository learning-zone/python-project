<html>
<head>
<?
session_start();
include("../db.php");

$dd = $_POST['dd'];
$mm = $_POST['mm'];
$yy = $_POST['yy'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$title = $_POST['title'];
$copies = $_POST['copies'];
$add = $_POST['add'];
$submit1 = $_POST['submit1'];
$quot_id = $_POST['quot_id'];
$library = $_POST['library'];
$vendor = $_POST['vendor'];
$sel = $_POST['sel'];
$B1 = $_POST['B1'];
$row = $_POST['row'];
$ctr = $_POST['crt'];
$tot = $_POST['tot'];
$quot = $_POST['quot'];
$Name = $_POST['Name'];
$address = $_POST['address'];

if($_REQUEST)
{
	$vendor = $_REQUEST['vendor'];
$quot = $_REQUEST['quot'];
$dd = $_REQUEST['dd'];
$mm = $_REQUEST['mm'];
$yy = $_REQUEST['yy'];
}

?>
<script language="JavaScript">
	function printReport()
		{
			prn.style.display = "none";
			window.print();
			prn.style.display = "";
		}
</script>
</head>
<body>
<center><h3><u>QUOTATION</u></h3></center>
<table width=59% align='center'>
	<tr>
		<td>Quotation No. :<?php echo $quot ?></td>
		<td align=right colspan=4>Date : <?php echo $dd ?>-<?php echo $mm ?>-<?php echo $yy ?></td>
	</tr>
	<tr>
		<td colspan=5>To,</td>
	</tr>
	<tr>
		<td colspan=5>
		<?php
			$qry="select * from lib_vendor_m where id=$vendor";
			$rs=execute($qry);
			$row=fetcharray($rs);	
			echo "$row[Name]<br>";
			echo "$row[address]";
		?>
		</td>
	</tr>
	<tr>
		<td colspan=5>Sir,</td>
	</tr>
	<tr>
		<td colspan=5>Please send a Quotation of the following books on unit price and quantity with maximum discount at the earliest.</td>
	</tr>
</table><br><br>
<center><table border=1 cellspacing=0 cellpadding=0 width='46%'>
	<tr height='22'>
		<td align='center' class ='head'>Sl.No.</td>
		<td align='center' class ='head'>Author</td>
		<td align='center' class ='head'>Publisher</td>
		<td align='center' class ='head'>Title</td>
		<td align='center' class ='head'>No. Of Copies</td>
	</tr>
	<?php
	    $qry="select * from quotation_trans where id=$quot";
		$rs=execute($qry);
		if($rs)
		{
			$ctr=1;
			$tot = 0;
			while($row=fetcharray($rs))
			{
				    echo "<tr height='18'>";
					echo "<td align='center'>$ctr</td>";
					echo "<td align='center'>$row[author]</td>";
					echo "<td align='center'>$row[publisher]</td>";
					echo "<td align='center'>$row[title]</td>";
					echo "<td align=right>$row[copies]</td>";
 					echo "</tr>";
				$ctr++;
				$tot = $tot + $row[copies];
			}
		}
	?>
		<tr>
			<td colspan=4 align=right>Total No. of Copies</td>
			<td align=right><?php echo $tot ?></td>
		</tr>
	</table></center><br><br><br>
<table width="115">
	
		<td height="67" align=left>Your's Faithfully<br><br><br>LIBRARIAN</td>
	
</table>
<div id='prn' align='center'>
<input type="button" value="Print" name="B1" onClick="printReport()" class=bgbutton>
</div>
</body>
</html>