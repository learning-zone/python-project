<?php
require("../db.php");
?>
<HTML>
<HEAD>
<TITLE>STUNDENT / STAFF ID RESULTS</TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
function winclose(Code)
{
	self.opener.document.tempfrm.s_id.value = Code;
	self.opener.document.tempfrm.action = "mod_del_user.php";
	window.close();
}
//-->
</SCRIPT>
</HEAD>
<BODY CLASS="bodyline">
<FORM NAME="searchfrm" METHOD="POST" ACTION="S_ids_mod.php">
<INPUT TYPE="HIDDEN" NAME="selection" VALUE="<?=$selection;?>">
<TABLE BORDER="2" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
<TBODY>
<?php
$_NUMREC_ = 15; // Number of result per page;

//Set the initial seek position

if (empty($SeekPos))
	$SeekPos = 0;

if ($selection == "Staff")
{
	echo "<TR>";
	$query  = "SELECT * FROM dept_no WHERE status=1 ORDER BY dpt_id ASC";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) == 0)
	{
		echo "<TD ALIGN=CENTER WIDTH=100% COLSPAN=2><FONT COLOR='#FF0000' SIZE=2><B>";
		echo "No Departments Found !!</B></FONT></TD></TR></TBODY></TABLE></FORM></BODY></HTML>";
		die();
	}
	else
	{
		echo "<TD ALIGN=CENTER WIDTH=70%><SELECT NAME=dept SIZE=1>";
		while ($row = fetcharray($rs))
		{
			if ($dept == $row["dpt_id"])
				echo "<OPTION VALUE='$row[dpt_id]' SELECTED>$row[Dept]</OPTION>";
			else
				echo "<OPTION VALUE='$row[dpt_id]'>$row[Dept]</OPTION>";
		}
		mysql_free_result($rs);
		echo "</SELECT></TD>";
		echo "<TD ALIGN=CENTER WIDTH=30%>";
		echo "<INPUT TYPE=SUBMIT NAME=search VALUE='SEARCH' CLASS='bgbutton'>";
		echo "</TD>";
	}
	echo "</TR>";

	if (isset($search))
	{
		$query  = "SELECT slno, f_name, s_name FROM staff_det WHERE active='YES' AND ";
		$query .= "subj=$dept ORDER BY f_name";
		$field_name1 = "slno";
		$field_name2 = "f_name";
		$field_name3 = "s_name";
	}
}
elseif ($selection == "Student")
{
	echo "<TR>";
	// FOR DISPLAYING THE COURSES.
	$query  = "SELECT * FROM course_m WHERE status=1 ORDER BY course_id ASC";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) == 0)
	{
		echo "<TD ALIGN=CENTER WIDTH=100% COLSPAN=2><FONT COLOR='#FF0000' SIZE=2><B>";
		echo "No Courses Found !!</B></FONT></TD></TR></TBODY></TABLE></FORM></BODY></HTML>";
		die();
	}
	else
	{
		echo "<TD ALIGN=CENTER WIDTH=70%><SELECT NAME=dept SIZE=1>";
		while ($row = fetcharray($rs))
		{
			if ($dept == $row["course_id"])
				echo "<OPTION VALUE='$row[course_id]' SELECTED>$row[coursename]</OPTION>";
			else
				echo "<OPTION VALUE='$row[course_id]'>$row[coursename]</OPTION>";
		}
		mysql_free_result($rs);
		echo "</SELECT></TD>";
	}
	// FOR DISPLAYING THE TERMS/YEARS
	$query  = "SELECT * FROM course_year WHERE status=1 ORDER BY year_id ASC";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) == 0)
	{
		echo "<TD ALIGN=CENTER WIDTH=100% COLSPAN=2><FONT COLOR='#FF0000' SIZE=2><B>";
		echo "No Terms Found !!</B></FONT></TD></TR></TBODY></TABLE></FORM></BODY></HTML>";
		die();
	}
	else
	{
		echo "<TD ALIGN=CENTER WIDTH=70%><SELECT NAME=term SIZE=1>";
		while ($row = fetcharray($rs))
		{
			if ($term == $row["year_id"])
				echo "<OPTION VALUE='$row[year_id]' SELECTED>$row[year_name]</OPTION>";
			else
				echo "<OPTION VALUE='$row[year_id]'>$row[year_name]</OPTION>";
		}
		mysql_free_result($rs);
		echo "</SELECT></TD>";
	}
	echo "</TR>";
	echo "<TR>";
	// FOR DISPLAYING THE SECTIONS.
	$query  = "SELECT * FROM class_section ORDER BY id ASC";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) == 0)
	{
		echo "<TD ALIGN=CENTER WIDTH=100% COLSPAN=2><FONT COLOR='#FF0000' SIZE=2><B>";
		echo "No Sections Found !!</B></FONT></TD></TR></TBODY></TABLE></FORM></BODY></HTML>";
		die();
	}
	else
	{
		echo "<TD ALIGN=CENTER WIDTH=70%><SELECT NAME=section SIZE=1>";
		echo "<OPTION VALUE='0'>No Section</OPTION>";
		while ($row = fetcharray($rs))
		{
			if ($section == $row["id"])
				echo "<OPTION VALUE='$row[id]' SELECTED>$row[section_name]</OPTION>";
			else
				echo "<OPTION VALUE='$row[id]'>$row[section_name]</OPTION>";
		}
		mysql_free_result($rs);
		echo "</SELECT></TD>";
		echo "<TD ALIGN=CENTER WIDTH=30%>";
		echo "<INPUT TYPE=SUBMIT NAME=search VALUE='SEARCH' CLASS='bgbutton'>";
		echo "</TD>";
	}
	echo "</TR>";

	$query  = "SELECT student_id, first_name, last_name FROM student_m WHERE archive='N' ";
	$query .= "AND course_admitted=$dept AND course_yearsem=$term AND class_section_id=$section ";
	$query .= "ORDER BY first_name";
	$field_name1 = "student_id";
	$field_name2 = "first_name";
	$field_name3 = "last_name";
}
if (isset($search))
{
	$rs = execute($query) or die("QUERY $query " . error_description());
	$countRS = rowcount($rs);
	if (!$countRS)
	{
		echo "<B>The search did not retrieve any records.<BR>";
		echo "Search again.";
		die();
	}
	?>
	<TR>
		<TD ALIGN="CENTER" BGCOLOR="#BBCCDD" CLASS='rowpic'><B><?=strtoupper($selection);?> NAME</B></TD>
		<TD ALIGN="CENTER" BGCOLOR="#BBCCDD" CLASS='rowpic'><B><?=strtoupper($selection);?> ID</B></TD>
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
		<TD ALIGN="CENTER" CLASS='row2'><?=stripslashes($r[$field_name2]);?> <?=stripslashes($r[$field_name3]);?></TD>
		<TD ALIGN="CENTER" CLASS='row2'>
		<INPUT type="button" value="<?=$r[$field_name1];?>" onClick="winclose('<?=$r[$field_name1];?>')"></TD>
	</TR>
	<?php
	}
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

<FORM name="frmtemp" action="S_ids.php" mehtod="POST">
<INPUT type="hidden" name="SeekPos">
<INPUT type="hidden" name="selection" value="<?=$selection;?>">
<INPUT TYPE="HIDDEN" NAME="dept" VALUE="<?=$dept;?>">
<INPUT TYPE="HIDDEN" NAME="term" VALUE="<?=$term;?>">
<INPUT TYPE="HIDDEN" NAME="section" VALUE="<?=$section;?>">
<INPUT TYPE="HIDDEN" NAME="search" VALUE="<?=$search;?>">
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
