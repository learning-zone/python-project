<?php

session_start();
include("../../db.php");


$hostel = $_POST['hostel'];
$action = $_POST['action'];
?>
<HTML>
<HEAD>
<TITLE>HOSTEL STUDENT SEARCH</TITLE>
</HEAD>
<BODY>
<CENTER>
<FORM METHOD="POST" ACTION="specstudent.php" NAME="frm" onSubmit="return formSubmit(this.form)">
<TABLE CLASS="forumline" ALIGN="CENTER" CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="90%">
<TBODY>
<TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="3">APPLY FEE BY HOSTEL</TD></TR>
<TR>
	<TD align="LEFT">&nbsp;Hostel</TD>
	<TD align="LEFT"><SELECT NAME="hostel" SIZE="1">
		<OPTION VALUE="0">-- Select Hostel--</OPTION>
		<?php
		$query = "SELECT * FROM hostel_m";
		$rs = execute($query) or die("QUERY $query " . error_description());
		if (rowcount($rs) != 0)
		{
			while ($row = fetcharray($rs))
			{
				if ($row["id"] == $hostel)
					echo "<OPTION VALUE='$row[id]' SELECTED>$row[hostel_name]</OPTION>";
				else
					echo "<OPTION VALUE='$row[id]'>$row[hostel_name]</OPTION>";
			}
			mysql_free_result($rs);
		}
		?>
		</SELECT>
	</TD>
    </TBODY>
</TABLE>
<br>
    <div>
    <center>
	<INPUT TYPE="SUBMIT" NAME="<< SUBMIT >>" CLASS="bgbutton" VALUE="Submit">
    </center>
    </div>


<?
$sql  = "SELECT id, s_id, first_name, last_name, domain FROM ";
	$sql .= "h_stud_m  WHERE h_id=$hostel AND archive='N' ";

	$result = execute($sql) or die();
	echo "</TBODY>";
	echo "</TABLE>";

	echo "<BR><BR>";

	echo "<TABLE CELLPADDING='0' CELLSPACING='0' BORDER='0' WIDTH='90%' CLASS='forumline'>";
	echo "<TBODY>";
	echo "<TR><TD COLSPAN='3' ALIGN='CENTER' CLASS='head' WIDTH='90%'>LIST OF STUDENTS OF $HostelName</TD></TR>";
	echo "<TR>";
		//echo "<TD CLASS='row2' WIDTH='10%'>Select</TD>";
		echo "<TD CLASS='row2' WIDTH='40%'>Student ID</TD>";
		echo "<TD CLASS='row2' WIDTH='50%'>Student Name</TD>";
	echo "</TR></TBODY>";
	// FOR DISPLAYING THE LIST OF STUDENTS IN ACTUAL DATABASE.
	$sql  = "SELECT id, s_id, first_name, last_name, domain FROM ";
	$sql .= "h_stud_m  WHERE h_id=$hostel AND archive='N' ";
//	echo $hostel;
	$result = execute($sql) or die();
	if (rowcount($result) != 0)
	{
		//echo "inside2" ;
		$num = rowcount($result);
		echo "<INPUT TYPE='HIDDEN' NAME='num_student' VALUE='$num'>";
		$i=0;
		while ($row = fetcharray($result))
		{
			 if($i%2)
               echo "        <tr class='clsname'> ";
               else
               echo "        <tr> ";
			   $i++;
			?>
            <TD WIDTH='20%' ALIGN='CENTER'>
            <a href="generalreceipts.php?id=<?=$row[s_id]?>&m=<?=0?>&hostel=<?=$hostel?>"><?=$row[s_id]?></a>
            </TD>
            <?
							
//echo "<TD WIDTH='20%' ALIGN='CENTER'>$row[student_id]</TD>";
		//echo "<TD WIDTH='20%' ALIGN='CENTER'>$row[s_id]</TD>";
				echo "<TD WIDTH='60%' ALIGN='CENTER'>$row[first_name] $row[last_name]</TD>";
			echo "</TR>";
		}
		mysql_free_result($result);
	}
	// ENDS HERE.
?>

</FORM>
</CENTER>
</BODY>
</HTML>