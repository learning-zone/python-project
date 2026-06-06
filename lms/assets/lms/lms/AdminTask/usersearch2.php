<?php
require("../db.php");
?>
<HTML>
<HEAD>
<TITLE>USERNAME SEARCH</TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
function winclose(Code, username1)
{
	self.opener.document.MyFrm.userid.value = Code;
	self.opener.document.MyFrm.username.value = username1;
	self.opener.document.MyFrm.action = "AddRightsToStaff.php";
	window.close();
}
//-->
</SCRIPT>
</HEAD>
<BODY CLASS="bodyline">
<FORM NAME="searchfrm" METHOD="POST" ACTION="usersearch2.php">
<INPUT TYPE="HIDDEN" NAME="username" VALUE="<?=$username;?>">
<TABLE BORDER="2" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
<TBODY>
<?php
$_NUMREC_ = 15; // Number of result per page;

//Set the initial seek position

if (empty($SeekPos))
	$SeekPos = 0;

$query = "SELECT * FROM users WHERE Activated='On' AND Person<>'Student' AND username LIKE '$username%' ORDER BY username";
//echo $query;

$rs = execute($query) or die("QUERY $query " . error_description());
if (rowcount($rs) == 0)
{
	echo "<TR>";
	echo "<TD ALIGN=CENTER WIDTH=100% COLSPAN=2><FONT COLOR='#FF0000' SIZE=2><B>";
	echo "No Users Found !!</B></FONT></TD></TR></TBODY></TABLE></FORM></BODY></HTML>";
	die();
}
$countRS = rowcount($rs);
?>
<TR>
	<TD ALIGN="CENTER" BGCOLOR="#BBCCDD" CLASS='rowpic'><B>Username</B></TD>
	<TD ALIGN="CENTER" BGCOLOR="#BBCCDD" CLASS='rowpic'><B>Selection</B></TD>
</TR>

<?php
data_seek($rs,$SeekPos); //Move the data pointer to the next position.

if (($SeekPos + $_NUMREC_) > $countRS)
{
	$MAX = $countRS;
}
else
{
	$MAX = $SeekPos + $_NUMREC_ ;
}

if (($SeekPos + $_NUMREC_) >= $countRS)
{
	$NEXT = $SeekPos;
}
else
{
	$NEXT  = $SeekPos + $_NUMREC_ ;
}

if (($SeekPos - $_NUMREC_)  > 0)
{
	$PREV = $SeekPos - $_NUMREC_;
}
else
{
	$PREV = 0;
}

$PAGES = $countRS / $_NUMREC_;

if ($countRS % $_NUMREC_)
{
	$PAGES++;
}

$LAST = ((int) $PAGES - 1) * $_NUMREC_;

for ($i=$SeekPos;$i<$MAX;$i++)
{
	$r = fetcharray($rs);
	?>
	<TR>
		<TD ALIGN="CENTER" CLASS='row2'><?=stripslashes($r["username"]);?></TD>
		<TD ALIGN="CENTER" CLASS='row2'>
		<INPUT type="button" value="SELECT" onClick="winclose('<?=$r[id]?>','<?=$r[username];?>')"></TD>
	</TR>
	<?php
}
?>
</TABLE>
</FORM>
<SCRIPT language="JavaScript">
function first()
{
	var i;
	i = 0;
	document.frmtemp.SeekPos.value = i;
	document.frmtemp.submit();
}

function prev()
{
	var i;
	i = "<?=$PREV?>";
	document.frmtemp.SeekPos.value = i;
	document.frmtemp.submit();
}

function next()
{
	var i;
	i = "<?=$NEXT?>";
	document.frmtemp.SeekPos.value = i;
	document.frmtemp.submit();
}

function last()
{
	var i;
	i = "<?=$LAST?>";
	document.frmtemp.SeekPos.value = i;
	document.frmtemp.submit();
}
</SCRIPT>

<FORM name="frmtemp" action="usersearch2.php" mehtod="POST">
<INPUT type="hidden" name="SeekPos">
<INPUT type="hidden" name="username" value="<?=$username?>">
<DIV align="left">
<TABLE border="0" cellspacing="0" cellpadding="0">
<TBODY>
<TR>
	<TD>
	<A href="Javascript:first()"><IMG src="../images/firstbtn.gif" border="0" alt="First"></A>
	</TD>
	<TD>
	<A href="Javascript:prev()"><IMG src="../images/previousbtn.gif" border="0" alt="Previous"></A>
	</TD>
	<TD>
	<A href="Javascript:next()"><IMG src="../images/nextbtn.gif" border="0"
                alt="Next" onmouseover="Javascript:status='Next Page';"></A>
	</TD>
	<TD>
	<A href="Javascript:last()"><IMG src="../images/lastbtn.gif" border="0"
                alt="Last" onmouseover="Javascript:status='Last Page';"></A>
	</TD>
</TR>
</TBODY>
</TABLE>
</DIV>
<DIV align="center">
<SMALL><B>Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></B></SMALL>
</DIV>
</FORM>
</BODY>
</HTML>
