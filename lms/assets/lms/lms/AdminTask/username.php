<?php
session_start();
include("../db.php");
?>
<form name='frm' method="post"  action='login2.php'>
	<?php
		$qq="select S_ID,fullname,description,username,password from users";
		$q=execute($qq);
	?>
		<table width="70%" cellspacing="2" cellpadding="" align="center" class="forumline" border=1>
		<tr><td align='center' class='head' colspan='4'>Staff Information</td>
		<tr><td align='center' class='rowpic'>ID</td>
		<td align='center' class='rowpic'>NAME</td>
		<td align='center' class='rowpic'>DESCRIPTION</td>
		<td align='center' class='rowpic' >USERNAME</td></tr>

	<?php
	$i=0;
	while($row=fetcharray($q))
	{
		if($i%2)
		echo "        <tr class='clsname'> ";
		else
		echo "        <tr> ";
		$i++;
	?>
		<td>&nbsp;&nbsp; <? echo $row[S_ID] ?></td>
		<td>&nbsp;&nbsp; <? echo $row[fullname] ?></td>
		<td>&nbsp;&nbsp;<? echo $row[description ] ?></td>
		<td>&nbsp;&nbsp;<?echo $row[username] ?> </td></tr> 

	<?php
	}
	?>
	</table>
</form>

	

				 
