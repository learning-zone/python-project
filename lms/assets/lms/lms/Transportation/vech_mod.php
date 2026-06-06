<?php
include("../db.php");
$val = $_POST['val'];
$id = $_POST['id'];
	$Sql="Select * from  trans_vechile_master";
	$res=execute($Sql);
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<form Name="frm" method="Post">
<body topmargin=0 leftmargin=0>
<table width="60%" border="0" align=center cellpadding="0" cellspacing="2" class=forumline>
<tr>
<tr> <td class=head align="center" colspan=4 >&nbsp;&nbsp;&nbsp;VECHILE MASTER </td>
</tr>
<tr> <td class=rowpic><div align="center"><font size="3">Slno</font></div></td>
		<td class=rowpic><div align="center"><font size="3">Vehicle name</font></div></td>
		<td class=rowpic nowrap><div align="center" ><font size="3">Registration No</font></div></td>
		<td class=rowpic><div align="center"><font size="3">View</font></div></td>
</tr>
<?php $r=1;
		while($row=fetcharray($res))
		{
			if($r%2)
			echo "<tr class='clsname'> ";
			else
			echo "<tr> ";
		?>
		
		<td align="center" nowrap>&nbsp;&nbsp;<?php 
		echo $r; ?></td>
		<td width="47%" align="center" nowrap>&nbsp;&nbsp;<?php echo $row[registration_no];?></td>
		<td width="21%" align="center" nowrap><?php echo $row[vechile_mod_no];?></td>
<td  align=center nowrap><a href="alter_vech.php?val=Modify&id=<?php echo$row[id]?>">Modify</a></td>
</tr>
<?php
	$r++;
}
?>
</table>
</body>
</form>
</html>