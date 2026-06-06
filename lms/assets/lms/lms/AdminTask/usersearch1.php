<?php
require("../db.php");
?>
<HTML>
<HEAD>
<TITLE>USERNAME SEARCH</TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
function winclose(Code)
{

	self.opener.document.tempfrm.username.value = Code;
	self.opener.document.tempfrm.action = "useraccess.php";
		document.searchfrm.action="useraccess.php?Type=ref";
		document.searchfrm.submit();
	window.close();

}
//-->
</SCRIPT>
</HEAD>
<BODY CLASS="bodyline">
<FORM NAME="searchfrm" METHOD="POST" ACTION="usersearch1.php">
<INPUT TYPE="HIDDEN" NAME="username" VALUE="<?=$username;?>">
<TABLE BORDER="2" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
<TBODY>
<?php
$_NUMREC_ = 15; // Number of result per page;
//Set the initial seek position
if (empty($SeekPos))
	$SeekPos = 0;
$query = "SELECT * FROM users WHERE Activated='On' AND username LIKE '$username%' ORDER BY username";
$rs = execute($query) or die("QUERY $query " . error_description());
// Modified by Farooqahamed to add rights for students for whome  username and password is taken from student_m table 
/*Modified By Manjula on 07-06-2006
To Add rights is not required for students & its displaying the student username(For Student rights another link is there )*/
//$query1 = "SELECT * FROM student_m WHERE  username LIKE '$username%' ORDER BY username";
//$rs1 = execute($query1) or die("QUERY $query " . error_description());
if (rowcount($rs) == 0)
{
	// if(rowcount($rs1)==0)
	{
		echo "<TR>";
		echo "<TD ALIGN=CENTER WIDTH=100% COLSPAN=2><FONT COLOR='#FF0000' SIZE=2><B>";
		echo "No Users Found !!</B></FONT></TD></TR></TBODY></TABLE></FORM></BODY></HTML>";
		die();
	}
}


$countRS = rowcount($rs);
//$countRS1=rowcount($rs1);
$count=$countRS+$countRS1;
?>
<TR>
	<TD ALIGN="CENTER" BGCOLOR="#BBCCDD" CLASS='rowpic'><B>Username</B></TD>
	<TD ALIGN="CENTER" BGCOLOR="#BBCCDD" CLASS='rowpic'><B>Selection</B></TD>
</TR>
<?php
if($countRS!=0)
{
	data_seek($rs,$SeekPos); //Move the data pointer to the next position.
}
/*else
{
		data_seek($rs1,$SeekPos); //Move the data pointer to the next position.
}*/
if (($SeekPos + $_NUMREC_) > $count)
{
	$MAX = $countRS;
	$MAX1=$countRS1;
}
else
{
	$MAX = $SeekPos + $_NUMREC_ ;
	$MAX1=$seekPos+$_NUMREC_;
}

if (($SeekPos + $_NUMREC_) >= $count)
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

$PAGES = $count / $_NUMREC_;

if ($count % $_NUMREC_)
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
		<INPUT type="button" value="SELECT" onClick="winclose('<?=$r[username];?>')"></TD>
	</TR>
	<?php
}
for ($i1=$SeekPos;$i1<$MAX1;$i1++)
{
	$r1 = fetcharray($rs1);
	?>
	<TR>
		<TD ALIGN="CENTER" CLASS='row2'><?=stripslashes($r1["username"]);?></TD>
		<TD ALIGN="CENTER" CLASS='row2'>
		<INPUT type="button" value="SELECT" onClick="winclose('<?=$r1[username];?>')"></TD>
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

<FORM name="frmtemp" action="usersearch1.php" mehtod="POST">
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
