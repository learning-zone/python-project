<?php
	session_start();
	include('db.php');
	$noti=mysql_fetch_array(mysql_query("select * from notice where id='$id'"));
	$sql=mysql_query("select username from users where S_ID='$noti[staffid]'");
	$sqls=mysql_fetch_array($sql);
	$uname=$sqls[username];
	echo "<table border='0' align='center' colspan='4' class='forumline' cellspacing='2' cellpadding='2' width='100%'>";
	echo "<tr>";
	echo "<td align='center' class='row3'><font color='white' size='3'><b>Notice Details/Username :$uname</b></font></td>";
	echo "</tr>";
	echo "<tr><td>$noti[notice]</td></tr>";
    echo "</table>";
?>