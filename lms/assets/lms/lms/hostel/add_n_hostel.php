<?php
session_start();

require("../db.php");
$hostel_id = $_POST['hostel_id'];
$hostel_name = $_POST['hostel_name'];
$address = $_POST['address'];
$no_floors = $_POST['no_floors'];
$warden_name  = $_POST['warden_name'];
$hostel_rent = $_POST['hostel_rent'];
$hostel_type = $_POST['hostel_type'];
$phone_no = $_POST['phone_no'];
$no_rooms = $_POST['no_rooms'];
$no_attender = $_POST['no_attender'];
$mess_charge = $_POST['mess_charge'];
$add = $_POST['add'];

$id = $_REQUEST['id'];
echo $id ;
if(isset($add))
{
	$query  = "SELECT * FROM hostel_m WHERE hostel_id='$hostel_id' OR hostel_name='$hostel_name'";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if(rowcount($rs)==0)
	{
		$phone_no = trim($phone_no);
		$warden_name = trim($warden_name);
		if (empty($phone_no))	$phone_no = "---";
		if (empty($warden_name))	$warden_name = "---";
		if (empty($no_attender))	$no_attender = 0;
		if (empty($hostel_rent))	$hostel_rent = 0;
		if (empty($mess_charge))	$mess_charge = 0;
		

		$sql  = "INSERT INTO hostel_m (hostel_id, hostel_name, hostel_type,address, phone_no, no_floors, no_rooms, warden_name, no_attender, hostel_rent, mess_charge) VALUES ('$hostel_id','".strtoupper($hostel_name)."','$hostel_type','$address','$phone_no',$no_floors, $no_rooms,'".strtoupper($warden_name)."',$no_attender,$hostel_rent,$mess_charge)";
		execute($sql) or die("INSERT QUERY : $sql " . mysql_error());
		$insert_flag = "Success";
	}
	else
		$insert_flag = "Flop";

	if ($insert_flag == "Success")
	{
		//echo "<DIV ALIGN='CENTER'>";
		//echo "Hostel Details inserted Successfully !!";
		//echo "</DIV>";
		?>
		<script language="JavaScript" type="text/javascript">
		alert("Hostel Details inserted Successfully !!");
		</script>
		<?php
	}
	elseif ($insert_flag == "Flop")
	{
		//echo "<DIV ALIGN='CENTER'>";
		//echo "Hostel Details already Inserted !!";
		//echo "</DIV>";	
		?>
		<script language="JavaScript" type="text/javascript">
		alert("Hostel Details already Inserted !!");
		</script>
		<?php

	}
}
// ENDS HERE.
?>
<HTML>


<HEAD><TITLE>ADD NEW HOSTEL</TITLE>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
</HEAD>
<BODY>
<CENTER>
<FORM METHOD="POST" ACTION="add_n_hostel.php" NAME="frm" onSubmit="return frm_submit()">
<TABLE  CELLSPACING="0" CELLPADDING="0" CLASS='forumline' WIDTH="90%">
<TBODY>
<TR><TD CLASS="head" COLSPAN="4" WIDTH="100%" ALIGN="CENTER">Add New Hostel</TD></TR>

<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; Hostel ID </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="hostel_id" SIZE="23"></TD>
	<TD WIDTH="50%" ALIGN="LEFT" COLSPAN="2">&nbsp;</TD>
</TR>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; Hostel Name </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="hostel_name" SIZE="23"></TD>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; Hostel Type </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><SELECT NAME="hostel_type" SIZE="1">
	<option value="0">-select-</option>
	<?php
        if($hostel_type=="B")
           {
	        $a="selected";
	        $b=""; 
		   }
        if($hostel_type=="A")
           {
	        $a="";
	        $b="selected"; 
		   }
		?>						
			<OPTION VALUE="B" <?php echo $a?>>BOYS</OPTION>
			<OPTION VALUE="G" <?php echo $b?>>GIRLS</OPTION>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; Address</TD>
	<TD WIDTH="25%" ALIGN="LEFT" CLASS="cbody"><TEXTAREA NAME="address" ROWS="4" COLS="17"></TEXTAREA></TD>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; Telephone</TD>
	<TD WIDTH="25%" ALIGN="LEFT" CLASS="cbody"><INPUT TYPE="TEXT" NAME="phone_no" SIZE="20"></TD>
</TR>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; No. of Floors </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="no_floors" SIZE="23"></TD>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; No. of Rooms </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="no_rooms"></TD>
</TR>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; Warden Name</TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="warden_name" SIZE="23"></TD>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; No. of Attenders</TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME='no_attender'></TD>
</TR>
<TR>
	<TD COLSPAN="4" CLASS="rowpic" ALIGN="CENTER" WIDTH="100%" height='25'>Fee Details [Applicable for ONE candidate]</TD>
</TR>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; Hostel Fee </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="hostel_rent" SIZE="23"></TD>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;&nbsp; Mess fee </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="mess_charge"></TD>
</TR>
<br>
</TBODY>
</TABLE>

<!--	<TD ALIGN="CENTER" COLSPAN="4">-->
    <br>
	<INPUT TYPE="SUBMIT" VALUE="&lt;&lt; ADD &gt;&gt;" NAME="add" CLASS='bgbutton'>


<BR>
<br>
<TABLE CLASS='forumline' CELLPADDING="0" CELLSPACING="0"  WIDTH="90%">
<TR>
  <TD CLASS="head" ALIGN="CENTER" COLSPAN="8">View / Modify Hostel Details</TD></TR>
<TR height='25'>
        <TD CLASS='rowpic' WIDTH='08%' nowrap >Hostel ID</TD>
		<TD CLASS='rowpic' WIDTH='23%' >Hostel Name</TD>
		<TD CLASS='rowpic' WIDTH='13%' >Telephone</TD>
		<TD CLASS='rowpic' WIDTH='21%' >Warden</TD>
		<TD CLASS='rowpic' WIDTH='10%' >Capacity</TD>
		<TD CLASS='rowpic' WIDTH='10%' >Occupants</TD>
		<TD CLASS='rowpic' WIDTH='15%' >Action</TD>
	</TR>
	
	<?php
	$var  = "SELECT id,hostel_id,hostel_name,phone_no,warden_name FROM hostel_m ORDER BY id ASC";
	$sql = execute($var);
	$num = rowcount($sql);
	$rowclass=1;
	for($i=1;$i<=$num;$i++)
	{
		$row = fetcharray($sql);
		$var1  = "select sum(capacity) as capac, sum(occupant) as occup from h_room_m where h_id='$row[id]'";
		//echo $row[id];
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

		
        if($i%2)
		echo "        <tr> ";
		else
		echo "        <tr class='clsname'> ";
               
        //       echo "        <tr height='25'> ";
		?>
		<td  ALIGN="CENTER"><?php echo $row[hostel_id]?></td>
		<td  ALIGN="CENTER"><?php echo $row[hostel_name]?></td>
		<td  ALIGN="CENTER"><?php echo $row[phone_no]?></td>
		<td  ALIGN="CENTER"><?php echo $row[warden_name]?></td>
		<td  align='center' ><?php echo $row1[capac]?></td>
		<td  align='center'><?php echo $row1[occup]?></td>
		<td  align='center'><a href="modify_hostel.php?id=<?php echo $row[id] ?>">Modify</a>&nbsp;&nbsp;/&nbsp;&nbsp; 
		<a href="view_hostel.php?id=<?php echo $row[id] ?>">View</a></td>

		 <?php
			 $rowclass = 1 - $rowclass;
	}
	
	mysql_free_result($sql);
	?>
	</tr>
</TABLE>
</FORM>
</CENTER>
<script language="JavaScript" type="text/javascript">
						 var frmvalidator  = new Validator("frm");
						 frmvalidator.addValidation("hostel_id","req","Please Enter Valid ID");
						 frmvalidator.addValidation("hostel_name","req","Please Enter Name");
						 frmvalidator.addValidation("address","req","Please Enter Address ");
						 frmvalidator.addValidation("no_floors","req","Please Enter No Flores");
						 frmvalidator.addValidation("no_rooms","req","Please Enter No Rooms ");
 						 frmvalidator.addValidation("hostel_type","dontselect=0","Please Slect Hostel Type");
						 
			</script>
</BODY>
</HTML>

