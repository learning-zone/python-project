<?php
require("../db.php");
?>
<HTML>
<HEAD>
<TITLE>USERNAME SEARCH</TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
function winclose(a,Code1,Code,Code2,Code3,Code4,Code5)
{
	self.opener.document.tempfrm.uname.value = a;	
	self.opener.document.tempfrm.fname.value = Code1;
	self.opener.document.tempfrm.shortname.value = Code;
    	self.opener.document.tempfrm.desc.value = Code2;
	self.opener.document.tempfrm.person1.value = Code3;
	self.opener.document.tempfrm.s_id.value = Code4;
	self.opener.document.tempfrm.gname.options[self.opener.document.tempfrm.gname.selectedIndex].value = Code5;
	self.opener.document.tempfrm.action = "mod_del_user.php";
	self.opener.document.tempfrm.submit();
	window.close();
}
//-->
</SCRIPT>
</HEAD>
<BODY CLASS="bodyline">
<FORM NAME="searchfrm" METHOD="POST" ACTION="usersearch.php">
<INPUT TYPE="HIDDEN" NAME="uname" VALUE="<?=$uname;?>">
<TABLE BORDER="2" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
<TBODY>
<?php
$_NUMREC_ = 15; // Number of result per page;

//Set the initial seek position

if (empty($SeekPos))
	$SeekPos = 0;

$query = "SELECT * FROM users WHERE Activated='On' AND username LIKE '$uname%' ORDER BY username";
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
	$username=$r[username];
	$fullname=$r[fullname];
	$desc=$r[description];

	?>
	<TR>
		<TD ALIGN="CENTER" CLASS='row2'><?=stripslashes($r["username"]);?></TD>
		<TD ALIGN="CENTER" CLASS='row2'>
	

	<INPUT type='button' value='SELECT' OnClick="winclose('<?=$r[username]?>','<?=$r[fullname]?>','<?=$r[shortname]?>','<?=$r[description]?>','<?=$r[Person]?>','<?=$r[S_ID]?>','<?=$r[groupname]?>')"></TD></TR>
	<?
	
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

<FORM name="frmtemp" action="usersearch.php" mehtod="POST">
<INPUT type="hidden" name="SeekPos">
<INPUT type="hidden" name="uname" value="<?=$uname?>">
<INPUT type="hidden" name="fullname" value="<?=$fullname?>">
<INPUT type="hidden" name="description" value="<?=$description?>">


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
