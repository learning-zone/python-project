<?php
session_start();
require("../db.php");

$id = $_REQUEST['id'];

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
$update = $_POST['update'];
if(isset($update))
{
	$phone_no = trim($phone_no);
	$warden_name = trim($warden_name);
	if (empty($phone_no))	$phone_no = "---";
	if (empty($warden_name))	$warden_name = "---";
	if (empty($no_attender))	$no_attender = 0;

	$sql  = "UPDATE hostel_m SET hostel_id='$hostel_id',hostel_name='".strtoupper($hostel_name)."',hostel_type='$hostel_type',address='$address',phone_no='$phone_no',no_floors=$no_floors,no_rooms=$no_rooms,warden_name='".strtoupper($warden_name)."',no_attender=$no_attender,hostel_rent=$hostel_rent,mess_charge=$mess_charge WHERE id=$id";
	execute($sql) or die("UPDATE QUERY $sql " . mysql_error());
	echo "<DIV ALIGN='CENTER'>";
		//echo "<B>";
		//echo "Hostel Details modified Successfully !!";
		//echo "</DIV>";
		?>
        <script language="JavaScript" type="text/javascript">
		alert("Hostel Details modified Successfully !!");
        </script>
        <?php
		echo "<a href=add_n_hostel.php><font color =FFFFFF<u>Back</u></font></a>";
		 die();
}
// ENDS HERE.
?>
<HTML>
<HEAD><TITLE>ADD NEW HOSTEL</TITLE>
<SCRIPT LANGUAGE="JavaScript">
</SCRIPT>
</HEAD>
<BODY>
<CENTER>
<FORM METHOD="POST" ACTION="modify_hostel.php" NAME="frm" onSubmit="return frm_submit()">
<INPUT TYPE="HIDDEN" NAME="id" VALUE="<?=$id;?>">
<TABLE  CELLSPACING="0" CELLPADDING="0" CLASS='forumline' WIDTH="90%">
<TBODY>
<TR>
  <TD CLASS="head" COLSPAN="4" WIDTH="100%" ALIGN="CENTER">Modify Hostel Details</TD></TR>

<?
$query  = "SELECT * FROM hostel_m WHERE id=$id";

$rs = execute($query) or die("QUERY $query " . error_description());
$row = fetcharray($rs);
if ($row["hostel_type"] == "B")
{
	$b = "SELECTED";
	$g = "";
}
else
{
	$b = "";
	$g = "SELECTED";
}
?>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;Hostel ID </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="hostel_id" SIZE="23" VALUE="<?=$row[hostel_id];?>"></TD>
	<TD WIDTH="50%" ALIGN="LEFT" COLSPAN="2">&nbsp;</TD>
</TR>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;Hostel Name </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="hostel_name" SIZE="23" VALUE="<?=$row[hostel_name];?>"></TD>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;Hostel Type </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><SELECT NAME="hostel_type" SIZE="1">
			<OPTION VALUE="B" <?=$b;?>>BOYS</OPTION>
			<OPTION VALUE="G" <?=$g;?>>GIRLS</OPTION>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;Address </TD>
	<TD WIDTH="25%" ALIGN="LEFT" CLASS="cbody"><TEXTAREA NAME="address" ROWS="4" COLS="20"><?=$row["address"];?></TEXTAREA></TD>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;Telephone</TD>
	<TD WIDTH="25%" ALIGN="LEFT" CLASS="cbody"><INPUT TYPE="TEXT" NAME="phone_no" SIZE="20" VALUE="<?=$row[phone_no];?>"></TD>
</TR>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;No. of Floors </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="no_floors" SIZE="23" VALUE="<?=$row[no_floors];?>"></TD>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;No. of Rooms </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="no_rooms" VALUE="<?=$row[no_rooms];?>"></TD>
</TR>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;Warden Name</TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="warden_name" SIZE="23" VALUE="<?=$row[warden_name];?>"></TD>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;No. of Attenders</TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="no_attender" VALUE="<?=$row[no_attender];?>"></TD>
</TR>
<TR>
	<TD COLSPAN="4" CLASS="rowpic" ALIGN="CENTER" WIDTH="100%">&nbsp;Fee Details [Applicable for ONE candidate]</TD>
</TR>
<br>
<TR>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;Hostel Rent </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="hostel_rent" SIZE="23" VALUE="<?=$row[hostel_rent];?>"></TD>
	<TD WIDTH="25%" ALIGN="LEFT">&nbsp;Mess Charge </TD>
	<TD WIDTH="25%" ALIGN="LEFT"><INPUT TYPE="TEXT" NAME="mess_charge" VALUE="<?=$row[mess_charge];?>"></TD>
</TR>
<TR>
	
	
</TR>
</TBODY>
</TABLE>
<br>
<INPUT TYPE="SUBMIT" VALUE="&lt;&lt; MODIFY &gt;&gt;" NAME="update" CLASS='bgbutton'>
</FORM>
</CENTER>
</BODY>
</HTML>