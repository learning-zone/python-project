<?php
    include("../db.php");
	$id=$_REQUEST['id'];
	$mon=$_REQUEST['mon'];
	$yer=$_REQUEST['yer'];
	$day=$_REQUEST['day'];
	$sem=$_REQUEST['sem'];
	$bdate="$yer-$mon-$day";
	$adate="$day-$mon-$yer";
?>
<html>
<head>
</head>
<body>

<form name='frm' method='post' action=''>
<br>

<table align="center" border="1" cellSpacing="10" cellpadding="10" width=80%""  >
<tr height="20">
	   <td colSpan="4" align="center" class='head'>
	   Announcement </td>
</tr>
<?php
$i=1;

			echo " <tr height='20'>
			<td align='center' class='row3'>Slno</td>
			<td align='center' class='row3'>Title</td>
			<td align='center' class='row3'>Date</td>
			<td align='center' class='row3'>Description</td>
		</tr>	";
//$sql1=execute("SELECT id FROM `announcement_class` where class='$sem' and ('$bdate' between fromdate and todate and type=2) or (type=1 and fromdate='$bdate')");

	$sql2=execute("SELECT * FROM `announcement_class` where id='$id'");
	while($r2=fetcharray($sql2))
	{

		if($r2['type']==1)
		{
			echo "<tr>
					<td align='center'>$i</td>
					<td  nowrap>&nbsp;&nbsp;$r2[title]</td>
					<td align='justify' nowrap>&nbsp;&nbsp;$r2[fromdate]</td>
					<td align='justify'>&nbsp;&nbsp;$r2[description]</td>
				</tr>";
		}
		else
		{
			echo "<tr>
					<td align='center'>$i</td>
					<td nowrap>&nbsp;&nbsp;$r2[title]</td>
					<td nowrap>&nbsp;&nbsp;$r2[fromdate] - $r2[todate]</td>
					<td align='justify'>&nbsp;&nbsp;$r2[description]</td>
				</tr>";
			
		}
	}
	$i++;

?>				
			</table>
	</form>
	
</table>

</body>

</html>
