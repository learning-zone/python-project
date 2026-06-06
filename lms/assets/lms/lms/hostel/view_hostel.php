<?
session_start();
require("../db.php");
$id = $_REQUEST['id'];
// VARIABLE DECLARATIONS
$ca = 0;	// FOR CAPACITY
$va = 0;	// FOR VACANCIES
$oc = 0;	// FOR NUMBER OF OCCUPANTS
$rn = "";	// ROOM NUMBER.

$query  = "SELECT * FROM hostel_m WHERE id=$id";
$rs = execute($query) or die(mysql_error());
$row = fetcharray($rs);
if ($row["hosteltype"] == "G")
	$htype = "GIRLS";
else
	$htype = "BOYS";
?>
<HTML>
<HEAD>
<TITLE>HOSTEL DETAILS</TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
function F8a0496f6()
{
	history.go(-1)
}
//-->
</SCRIPT>
</HEAD>
<BODY>
<CENTER>
<br>
<TABLE CLASS='forumline' CELLPADDING="0" CELLSPACING="0"  WIDTH="90%">
<TBODY>
<TR>
  <TD COLSPAN="2" CLASS="head" ALIGN="CENTER">View Hostel Details</TD></TR>
<TR >
	<TD WIDTH="50%"   ALIGN="left">&nbsp;Hostel ID</TD>
	<TD WIDTH="50%"  ALIGN="left">&nbsp;<?php echo $row["hostel_id"];?></TD>
</TR>
<TR class='clsname'>
	<TD WIDTH="50%"   ALIGN="left">&nbsp;Hostel Name</TD>
	<TD WIDTH="50%"  ALIGN="left">&nbsp;<?php echo $row["hostel_name"];?></TD>
</TR>
<?php
$sql = "SELECT capacity, occupant, room_no FROM h_room_m WHERE h_id=$id";
$res = execute($sql) or die("QUERY $sql " . error_description());
while ($rw = fetcharray($res))
{
	$ca = $ca + $rw["capacity"];
	$oc = $oc + $rw["occupant"];
	$rn = $rw["room_no"];
}
$va = $ca - $oc;
mysql_free_result($res);

?>
<TR >
	<TD WIDTH="50%" ALIGN="left">&nbsp;Hostel Type</TD>
	<TD WIDTH="50%" ALIGN="left">&nbsp;<?php echo $htype;?></TD>
</TR>
<TR class='clsname'>
	<TD WIDTH="50%" ALIGN="left">&nbsp;Address</TD>
	<TD WIDTH="50%" ALIGN="left">&nbsp;<?php echo $row["address"];?></TD>
</TR>
<TR >
	<TD WIDTH="50%" ALIGN="left">&nbsp;Phone No</TD>
	<TD WIDTH="50%" ALIGN="left">&nbsp;<?php echo $row["phone_no"]?></TD>
</TR>
<TR class='clsname'>
	<TD WIDTH="50%" ALIGN="left">&nbsp;No. of Rooms</TD>
	<TD WIDTH="50%" ALIGN="left">&nbsp;<?php echo $row["no_rooms"];?></TD>
</TR>
<TR>
	<TD WIDTH="50%" ALIGN="left">&nbsp;Capacity</TD>
	<TD WIDTH="50%" ALIGN="left">&nbsp;<?php echo $ca;?></TD>
</TR>
<TR class='clsname'>
	<TD WIDTH="50%" ALIGN="left">&nbsp;No. of Occupants</TD>
	<TD WIDTH="50%" ALIGN="left">&nbsp;<?php echo $oc;?></TD>
</TR>
<TR>
	<TD WIDTH="50%" ALIGN="left">&nbsp;Vacancy</TD>
	<TD WIDTH="50%" ALIGN="left">&nbsp;<?php echo $va;?></TD>
</TR>
<TR class='clsname'>
	<TD WIDTH="50%" ALIGN="left">&nbsp;No. of Attenders</TD>
	<TD WIDTH="50%" ALIGN="left">&nbsp;<?php echo $row["no_attender"];?></TD>
</TR>
<TR>
	<TD WIDTH="50%" ALIGN="left">&nbsp;Hostel Fees</TD>
	<TD WIDTH="50%" ALIGN="left">&nbsp;<?php echo $row["hostel_rent"];?></TD>
</TR>
<TR class='clsname'>
	<TD WIDTH="50%" ALIGN="left">&nbsp;Mess Fees</TD>
	<TD WIDTH="50%" ALIGN="left">&nbsp;<?php echo $row["mess_charge"];?></TD>
</TR>
</TABLE>
</CENTER>
<center>
<?
mysql_free_result($rs);
echo "<b><a href=add_n_hostel.php><font color =FFFFFF<u>Back</u></font></a>";
		    	die();
?>
</center>


</BODY>
</HTML>