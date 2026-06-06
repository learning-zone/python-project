<?
session_start();
include("../db.php");
$sql="select col_name from college";
$rs=execute($sql);
if(rowcount($rs)>=1)
{
	$row=fetcharray($rs);
	$colname=$row[col_name];
}
?>
<HTML>
<HEAD>
<TITLE>Welcome to <?=$colname?></TITLE>
</HEAD>
<BODY class='bodyline'>
<?
if (isset($_POST['unlock']))
{

	//Modified by Muzammil Ahmed A on 21-June-2005
	//Validation has been done so that if the username is not selected then the below message is displayed
	$user1=$_POST['user1'];
	if($user1=='Select')
	{
		echo "<font color=blue>Please select the username or there are no users to unlock</font>";
		die();
	}
	$query = "UPDATE users SET Activated='On', count=0 WHERE username='$user1'";
	execute($query) or die("UPDATE QUERY $query : " . error_description());

}
?>
<FORM NAME="frm" METHOD="POST" ACTION="unlock.php">
<TABLE class='forumline' align='center' width="30%">
<tr><td class='head' align='center' colspan=3>Power Up User</td></tr>
<TR>
	<TD COLSPAN="3" ALIGN="CENTER" class='cattitle'>
	Recreation of the Unlocked User</TD>
</TR>

<TR>
	<TD ALIGN="LEFT">&nbsp;USER NAME</TD>
	<TD  ALIGN="LEFT">
	<?
	$query = "SELECT username FROM users WHERE count>3 ORDER BY username ASC";
	$rs = execute($query) or die("QUERY $query : " . error_description());

	if (rowcount($rs) == 0)
	{
		echo "<FONT COLOR=#FF0000 SIZE=2><B>No Locked Users!!</B></FONT></td>";
	}
	else
	{
		echo "<SELECT NAME=user1 SIZE=1>";
		while ($row = fetcharray($rs))
		{
			if (empty($flag))
			{
				echo "<OPTION VALUE='Select'>---Select---</OPTION>";
				$flag = 1;
			}
			echo "<OPTION VALUE='$row[username]'>$row[username]</OPTION>";
		}
		mysql_free_result($rs);
		echo "</SELECT>";
		?>
		</TD>
        </TR>
        </TABLE>
        <BR>
		<DIV ALIGN="CENTER"><INPUT TYPE="SUBMIT" NAME="unlock" VALUE="UNLOCK THE USER" class='bgbutton'></DIV>
	<?
	}
	?>

</TABLE></FORM></BODY></HTML>
