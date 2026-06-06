<?php

session_start();

require("../db.php");

$ca = 0;		// FOR CAPACITY
$oc = 0;		// FOR OCCUPANTS
$va = 0;		// FOR VACANCIES.
?>
<HTML>
<HEAD>
<TITLE>SEARCH FOR VIEW / MODIFY HOSTEL DETAILS</TITLE>
</HEAD>
<BODY>
<CENTER>
<FORM METHOD="GET" ACTION="search_hostel1.php" NAME="frm">
<TABLE CLASS='forumline' CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="70%">
<TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="6"><B>VIEW / MODIFY HOSTEL DETAILS</B></TD></TR>
<TR height='25'>
        <TD CLASS='rowpic' WIDTH='20%' ><B>Hostel ID</B></TD>
		<TD CLASS='rowpic' WIDTH='30%' ><B>Hostel Name</B></TD>
		<TD CLASS='rowpic' WIDTH='15%' ><B>Capacity</B></TD>
		<TD CLASS='rowpic' WIDTH='15%' ><B>Occupants</B></TD>
		<TD CLASS='rowpic' WIDTH='20%' ><B>Action</B></TD>
	</TR>
	
	<?php
	$var  = "SELECT id,hostel_id,hostel_name FROM hostel_m ORDER BY id ASC";
	$sql = execute($var);
	$num = rowcount($sql);
	$rowclass=1;
	for($i=1;$i<=$num;$i++)
	{
		$row = fetcharray($sql);
		$var1  = "select sum(capacity) as capac, sum(occupant) as occup from h_room_m where h_id='$row[id]'";
		$sql1 = execute($var1);
		$row1 = fetcharray($sql1);
		if($row1[capac]=='')
		{
			$row1[capac]='--';
		}
		if($row1[occup]=='')
		{
			$row1[occup]='--';
		}

		?>
		<tr class='row<?php echo $rowclass ?>' height='25'>
		<td ><?php echo $row[hostel_id]?></td>
		<td ><?php echo $row[hostel_name]?></td>
		<td align='center' ><?php echo $row1[capac]?></td>
		<td align='center'><?php echo $row1[occup]?></td>
		<td><a href="modify_hostel.php?id=<?php echo $row[id] ?>">Modify</a>&nbsp;&nbsp;/&nbsp;&nbsp; 
		<a href="view_hostel.php?id=<?php echo $row[id] ?>">View</a></td>

		 <?php
			 $rowclass = 1 - $rowclass;
	}
	
	mysql_free_result($sql);
	?>
	</tr>
</TABLE>
</FORM>
</BODY>
</HTML>
