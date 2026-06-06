<?php

	include("../db.php");
	$hname = $_POST['hname'];
$rname = $_POST['rname'];
$branch = $_POST['branch'];
$sem = $_POST['sem'];
$studfname = $_POST['studfname'];
$row1 = $_POST['row1'];
$row = $_POST['row'];
$college = $_POST['college'];
$ID = $_REQUEST['ID'];

$hostel = $_POST['hostel'];
$block = $_POST['block'];
$room = $_POST['room'];
$blood = $_POST['blood'];
$padd = $_POST['padd'];
$pphone = $_POST['pphone'];
$lgname = $_POST['lgname'];
$lgrelation = $_POST['lgrelation'];
$lgadd = $_POST['lgadd'];
$lgphone = $_POST['lgphone'];

$adate = $_POST['adate'];
$bdate = $_POST['bdate'];

$empname =$_POST['empname'];
$empdept =$_POST['empdept'];

$s_id = $_POST['s_id'];

	$res = execute("select * from h_stud_m where s_id='$ID'") or die(mysql_error());
	$row = fetcharray($res);

	$res1 = execute("select student_id,usn,first_name,last_name,gender,img_source from student_m where id='$ID'") or die(mysql_error());
	$row1 = fetcharray($res1);
	if($row1[gender]=='F')
	{
		$hostel_type="G";
	}
	if($row1[gender]=='M')
	{
		$hostel_type="B";
	}
	$res2 = execute("select id,hostel_name from hostel_m where hostel_type='$hostel_type'");
	$res3 = execute("select id,blockname from h_block");
	$res4 = execute("select id,room_no from h_room_m");
?>
<HTML>
 <HEAD>
 <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
 </HEAD>
 



 <BODY>
  <form name='frm' action='mod_h_stud.php' method='post'>
<input type='hidden' name='s_id' value='<?php echo $ID?>'>
	<TABLE ALIGN='center' CLASS="forumline" width='50%' CELLPADDING="0" CELLSPACING="0" >
 <Table ALIGN="CENTER" width="90%">
  <TR height='30'>
   <TD ALIGN="CENTER" CLASS="head" COLSPAN>Modify Students In Hostel
   </TD>
  </TR>
  </Table>
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
		 <table cellspacing='4' cellpadding='0' >
	<tr>
		<td>Aplication No</td>
		<td><?php echo $row1[student_id] ?></td>
	</tr>
	<tr>
		<td>USN</td>
		<td><?php echo $row1[usn] ?></td>
	</tr>
	<tr>
		<td>Student Name</td>
		<td><?php echo $row1[first_name].".".$row1[last_name] ?></td>
	</tr>
	<tr>
		<td>Hostel</td>
		<td><select name='hostel'>
			<?php
				while($row2 = fetcharray($res2))
				{
					if($row[h_id]==$row2[id])
					{
						?>
						<option value='<?php echo $row2[id] ?>' selected><?php echo $row2[hostel_name] ?></option>
						<?php
					}
					else
					{
						?>
						<option value='<?php echo $row2[id] ?>'><?php echo $row2[hostel_name] ?></option>
						<?php
					}
				}
			?>

			</select>
		</td>
	</tr>
	<tr>
	   <td>Block</td>
       <td><select name='block'>
		    <?php
			   while($row3 = fetcharray($res3))
			   {
				   if($row[bid]==$row3[id])
				   {
		              ?>
					  <option value='<?php echo $row3[id] ?>' selected><?php echo $row3[blockname] ?></option>
						<?php
					}
					else
					{
						?>
						<option value='<?php echo $row3[id] ?>'><?php echo $row3[blockname] ?></option>
						<?php
					}
				}
			?>

			</select>
		</td>
	</tr>
	<tr>
	   <td>Room Number</td>
	   <td><select name='room'>
	        <?php
			   while($row4 = fetcharray($res4))
			   {
				   if ($row[room_no] == $row4[id])
				   {
					   ?>
					   <option value='<?php echo $row4[id] ?>' selected><?php echo $row4[room_no] ?></option>
						<?php
					}
					else
					{
						?>
						<option value='<?php echo $row4[id] ?>'><?php echo $row4[room_no] ?></option>
						<?php
					}
				}
			?>

			</select>
		</td>
	</tr>
	</table>
	</table>
	<table class='forumline' align='center' width='90%'>
    <tr>
	  <td>Blood Group</td>
	  <TD><INPUT TYPE="TEXT" NAME="blood" SIZE="28" value=<?php echo $row[blood]?>></td>
    </tr>
    <tr>
	  <td>Permenent Address</td>
	  <td><TEXTAREA ROWS="3" NAME="padd" COLS="25" ><?php echo $row[p_add]?></TEXTAREA></td>
    </tr>
    <tr>
      <td>Phone #</td>
	  <td><INPUT TYPE="TEXT" NAME="pphone" SIZE="28" value=<?php echo $row[p_phone]?>></td>
    </tr>
    <tr>
       <td>Name of Local Guardian</td>
	   <td><INPUT TYPE="TEXT" NAME="lgname" SIZE="28" value=<?php echo $row[lg_name]?>></td>
    </tr>
    <tr>
	   <td>Relationship</td>
	   <td><INPUT TYPE="TEXT" NAME="lgrelation" SIZE="28" value=<?php echo $row[relation]?>></td>
	</tr>
	<tr>
	   <td>Address of LG</td>
	   <td><TEXTAREA ROWS="3" NAME="lgadd" COLS="25"><?php echo $row[lg_add]?></TEXTAREA></td>
	</tr>
	<tr>
	   <td>Phone</td>
	   <td><INPUT TYPE="TEXT" NAME="lgphone" SIZE="28" value=<?php echo $row[phone]?>></td>
    </tr>
	<tr>
		<td>&nbsp;&nbsp;From</td>
		<td nowrap>&nbsp;
		<input type="text" readonly="" name="date3" value="<?php echo $adate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar3')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>  
			<tr>
		<td nowrap>&nbsp;&nbsp;To</td>
		<td nowrap>&nbsp;
		<input type="text" readonly="" name="date4" value="<?php echo $bdate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar4')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
		<tr>
			<TR>
			 <TD COLSPAN="2" align="center">If Any Relative Employed in Same Organisation</TD></TR>
			<TR>
				<TD>Name</TD>
				<TD><INPUT TYPE="TEXT" NAME="empname" SIZE="28"  value=<?php echo $row[emp_n]?>></TD>
			</TR>
			<TR>
				<TD>Department</TD>
				<TD><INPUT TYPE="TEXT" NAME="empdept" SIZE="28"  value=<?php echo $row[dept]?>></TD>
			</TR>
            </table>
            <br>
            <CENTER>
            <div><INPUT TYPE="submit" VALUE="MODIFY" NAME="mod" CLASS="bgbutton" align="middle"></div>
			</CENTER>
	
  </form>
 </BODY>
</HTML>