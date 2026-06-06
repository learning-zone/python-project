<?php
session_start();
require("../db.php");
$ID = $_REQUEST['ID'];
 ?> 
	<HTML>
	<HEAD>
	<TITLE>VIEW STUDENT DETAILS</TITLE>
	<SCRIPT LANGUAGE="JavaScript">
	
	function win_close()
	{
		window.close();
	}
	
	</SCRIPT>
	</HEAD>
	<BODY>
	<?php
	$sql=execute("select * from h_stud_m where s_id='$ID'") or die(mysql_error());
	$row=fetcharray($sql);

	$sql1=execute("select * from student_m where id='$ID'");
	$row1=fetcharray($sql1);

    $sql2=execute("select * from course_m where course_id=$row1[course_admitted]");
	$row2=fetcharray($sql2);

	$sql3=execute("select * from course_year where year_id=$row1[course_yearsem]");
	$row3=fetcharray($sql3);

	$sql4=execute("select * from hostel_m where id=$row[h_id]");
    $row4=fetcharray($sql4);
     
	$sql5=execute("select * from h_block where id=$row[bid]");
    $row5=fetcharray($sql5);

    $sql6=execute("select * from h_room_m where id=$row[room_no]");
    $row6=fetcharray($sql6);

	$join_date = date("d-m-Y", strtotime($row["j_date"]));
	$leaving_date = date("d-m-Y", strtotime($row["l_date"]));
	$dob = date("d-m-Y", strtotime($row1["dob"]));
	?>
	<CENTER>
	<form name='frm' action='doSearch2.php' method='post'>
	<TABLE CLASS="forumline" CELLPADDING="0" CELLSPACING="0"  WIDTH="90%">
	<TBODY>
	<TR height='30'>
	  <TD ALIGN="CENTER" WIDTH="50%" COLSPAN="2" CLASS="head">Student Details</TD></TR>
	</table>
	<table class='forumline' align='center' width='90%' >
	<tr>
		<td width="25%">
			<table   align='left' width='100%'  height="100%"> 
			<tr>
				<td align="center">Student Photo</td></tr>
					<tr height="70">
						<td align='center'>
							<img src="<?php echo $row1[img_source]?>" width='110' height='120'>
					    </td>
					</tr>
				</td>
			</tr>
			</table>
		 </td>
		 <td>
		 <table  cellspacing='4' cellpadding='0' >
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Name</TD>
		<TD WIDTH="40%"><?php echo $row1["first_name"]." ".$row1["last_name"]?></TD>
	</TR>
	<tr height='20'>
		<td>&nbsp;Aplication No</td>
		<td><?php echo $row1[student_id] ?></td>
	</tr>
	<tr height='20'>
		<td>USN</td>
		<td><?php echo $row1[usn] ?></td>
	</tr>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Permanent Address</TD>
		<TD WIDTH="40%"><?php echo $row["p_add"];?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Date of Birth</TD>
		<TD WIDTH="40%"><?php echo $dob?></TD>
	</TR>
	</table>
	</table>
	<table class='forumline' align='center' width='90%' >
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Permanent Phone #</TD>
		<TD WIDTH="40%"><?php echo $row["p_phone"];?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Local Guardian</TD>
		<TD WIDTH="40%"><?php echo $row["lg_name"];?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Relationship</TD>
		<TD WIDTH="40%"><?php echo $row["relation"];?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Address of Local Guardian</TD>
		<TD WIDTH="40%"><?php echo $row["lg_add"];?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;School Division</TD>
		<TD WIDTH="40%"><?php echo $row2[coursename]?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Term / Year</TD>
		<TD WIDTH="40%"><?php echo $row3[year_name]?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Joining Date</TD>
		<TD WIDTH="40%"><?php echo $join_date;?></TD>
	</TR>
	<TR>
		<TD WIDTH="30%">&nbsp;Leaving Date</TD>
		<TD WIDTH="40%"><?php echo $leaving_date;?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Hostel, Block, Room</TD>
		<TD WIDTH="40%"><?php echo $row4[hostel_name]?>,&nbsp;&nbsp; <?php echo $row5[blockname]?>,&nbsp;&nbsp; <?php echo $row6[room_no]?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Blood Group</TD>
		<TD WIDTH="40%"><?php echo $row["blood"];?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="70%" COLSPAN="2" align="center"> If Any Relative Employed in Same Organisation</TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Name</TD>
		<TD WIDTH="40%"><?php echo $row["emp_n"];?></TD>
	</TR>
	<TR height='20'>
		<TD WIDTH="30%">&nbsp;Department</TD>
		<TD WIDTH="40%"><?php echo $row["dept"];?></TD>
	</TR>
	<TR>
    </TBODY>
	</TABLE>
	<br>
<div><INPUT TYPE="submit" VALUE="CLOSE" NAME="close" CLASS="bgbutton"></div>
	

	
	</FORM>
	</CENTER>
</BODY>
</HTML>