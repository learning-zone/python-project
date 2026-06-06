<?php

    include("../db.php");

	$id=$_REQUEST['id'];

	$yer=$_REQUEST['yer'];

	$day=$_REQUEST['day'];

	$bdate="$yer-$mon-$day";

	$adate="$day-$mon-$yer";

?>
<html>
<head>
</head>
<body>
<form name='frm' method='post' action=''>
<table align="center" border="1" cellSpacing="0" width="98%">
<tr height="30">
	   <td colSpan="4" align="center" class='head'>Announcement</td>
</tr>
<?php
	$i=1;
	echo " <tr>
			<td align='center' class='row3'>Slno</td>
			<td align='center' class='row3'>Title</td>
			<td align='center' class='row3'>Date</td>
			<td align='center' class='row3'>Description</td>
		</tr>";

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
<?php
function MonthName($mont)
{

        if($mont == 1) return("January");

        if($mont == 2) return("February");

        if($mont == 3) return("March");

        if($mont == 4) return("April");

        if($mont == 5) return("May");

        if($mont == 6) return("June");

        if($mont == 7) return("July");

        if($mont == 8) return("August");

        if($mont == 9) return("September");

        if($mont == 10) return("October");

        if($mont == 11) return("November");

        if($mont == 12) return("December");

}

?>
</table>
</body>
</html>

