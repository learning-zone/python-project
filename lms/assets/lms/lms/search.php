<html>
<head>
</head>
<body>
<?php
$usertype;
$search;
$user;
if($usertype=='u')
$sql1=mysql_query("select * from usermenu  where username='$user' and access='Yes' and module!='$search' and linkname like '%$search%' order by id");
while($row3=mysql_fetch_array($sql1))
{
	$diname=mysql_fetch_row(mysql_query("select Display_name from links where linkname='$row3[linkname]'"));

	echo "<tr height='24'>";
	echo "<td VALIGN=center WIDTH='100%' class='head' nowrap><div>&nbsp;";?>&nbsp;<img src="Picture1.png" width="17" height="17" ><?php echo "
	<a href=$row3[linkpath]$row3[parameter] title='$row3[linkname]' class='topictitle1'>
	<font color='#FFFFFF'>$diname[0]</font></a>&nbsp;&nbsp;</div></td>";
	echo "</tr>";
}
		
?>
</body>
</html>
