<?php
	include("../db.php");
?>
<html>
<head>
</head>
<body class='bodyline'>
<form method="POST" name="MyFrm" ENCTYPE='multipart/form-data'>
<input type="hidden" name="id" value="<?=$id?>">
<br>

<?php
$k=1;
$sql3=execute("select * from tee_time_table where  status=1  ");
if(rowcount($sql3)>=1)
{	
	?>
	<table align='center' class='forumline'  border="1" width='90%' >
        <tr>
            <td align='center' class='head' nowrap>Sl.No</td>
            <td align='center' class='head' nowrap>Name</td>
            <td align='center' class='head' nowrap>View</td>
        </tr>
 	<?php
	while($r6=fetcharray($sql3))
	{
		echo "<tr>
		<td align='center' nowrap>$k</td>
		<td nowrap>$r6[name]</td><td nowrap>";
		?>
		<a href="javascript:void(0)" onClick="window.open('viewtimetable.php?linkname=<?=$r6['link']?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">View</a>
		<?php
		echo "</td>
		</tr>";
	$k++;
	}
	?>
	</table>
	<?php
}
?>	
<br>
		
	</form></body></html>
