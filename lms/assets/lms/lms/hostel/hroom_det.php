<?php

session_start();
//include("../urlaccess.php");
require("../db.php");
$hname = $_POST['hname'];
$bname = $_POST['bname'];
$rnumber = $_POST['rnumber'];
$rextno = $_POST['rextno'];
$rcapacity = $_POST['rcapacity'];
$insert = $_POST['insert'];

$delete = $_POST['delete'];
$modify= $_POST['modify'];
$id = $_POST['id'];
$extn = $_POST['$extn'];
$capa = $_POST['capa'];



$var = $_POST['var'];
$var1 = $_POST['var1'];
$var2 = $_POST['var2'];
// THIS PART IS FOR INSERTING THE ROOM DETAILS.
if (isset($insert))
{
	$rnumber = trim($rnumber);
	$rcapacity = trim($rcapacity);
	if ($hname == 0)
	{
		//echo "<DIV ALIGN='CENTER'>";
		//echo "Select the Hostel !!</DIV>";
		?>
        <script type="text/javascript">
		alert("Select the Hostel !!");
		</script>
        <?php
	}
	elseif ($bname == 0)
	{
		//echo "<DIV ALIGN='CENTER'>";
		//echo "Select the Block !!</DIV>";
		?>
        <script type="text/javascript">
		alert("Select the Block !!");
		</script>
        <?php
	}
	elseif (empty($rnumber))
	{
		//echo "<DIV ALIGN='CENTER'><B>";
		//echo "Enter the Room Number !!</B></DIV>";
		?>
        <script language="JavaScript" type="text/javascript">
		alert("Enter the Room Number !!");
        </script>
        <?php
	}
	elseif (empty($rcapacity))
	{
		//echo "<DIV ALIGN='CENTER'><B>";
//		echo "Enter the Capacity of the Room !!</B></DIV>";
		?>
        <script language="JavaScript" type="text/javascript">
		alert("Enter the Capacity of the Room !!");
        </script>
        <?php
	}
	else
	{
		$sql  = "SELECT no_rooms FROM hostel_m WHERE id=$hname";
		$rs = execute($sql) or die("QUERY $sql " . error_description());
		$row = fetcharray($rs);
		$total_rooms = $row["no_rooms"];
		mysql_free_result($rs);

		$sql  = "SELECT COUNT(*) AS C FROM h_room_m WHERE h_id=$hname";
		$rs = execute($sql) or die("QUERY $sql " . error_description());
		$row = fetcharray($rs);
		$entered_rooms = $row["C"];
		mysql_free_result($rs);

		if ($entered_rooms < $total_rooms)
		{
			$sql = "SELECT * FROM h_room_m WHERE room_no='$rnumber' AND h_id=$hname AND bid=$bname" ;
			$rs = execute($sql) or die("QUERY $sql " . error_description());
			if (rowcount($rs) != 0)
			{
				//echo "<DIV ALIGN='CENTER'>";
				//echo "Room Number $rnumber already exists !!</DIV>";
				?>
                <script language="JavaScript" type="text/javascript">
				alert("Room Number already exists !!");
                </script>
                <?php
			}
			else
			{
				$rextno = trim($rextno);
				if (empty($rextno))	$rextno = 0;
				$query  = " INSERT INTO h_room_m (h_id, bid, room_no, capacity, occupant, ext_no) ";
				$query .= "VALUES ($hname, $bname, '$rnumber', $rcapacity, 0, $rextno)";
				execute($query) or die("INSERT QUERY : $query " . error_description());
				//echo "<DIV ALIGN='CENTER'>";
				//echo "The Room Number $rnumber inserted Successfully !!</DIV>";
				?>
				<script language="JavaScript" type="text/javascript">
				alert("Room Number  inserted Successfully !!");
                </script>
				<?php
			}
		}
		elseif ($entered_rooms == $total_rooms)
		{
			//echo "<DIV ALIGN='CENTER'>";
			//echo "Already all room details are entered in this Hostel!!</DIV>";
			?>
<script language="JavaScript" type="text/javascript">
alert("Already all room details are entered in this Hostel!!");
</script>
<?php
		}
	}
}
if(isset($delete))
{
if($id)
{
while(list(,$value)=each($id))
{
$del=execute("delete from h_room_m where id=$value");
$del2=execute("delete from h_stud_m where room_no=$value");
}
}

}
if (isset($modify))
{
	while(list(,$value) = each($id))
	{
		$ce = $value;
		
		$room_no = $_POST["rno" . $value];
		
		$extn = $_POST["ext" . $value];
		
		$capa = $_POST["capacity" . $value];		
		$sql  = "UPDATE h_room_m SET ext_no='$extn',capacity='$capa' where id='$ce'";
		$res  = execute($sql) or die(mysql_error());
		if($res)
		{
			?>
				<script language='javascript'>
					alert("Details Updated Successfully");
				</script>
			<?php
		}
	}
}

// ENDS HERE.
?>
<HTML>
<HEAD>
<TITLE>HOSTEL ROOM DETAILS</TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
function frm_reload()
{
	document.frm1.action="hroom_det.php";
	document.frm1.submit();
}
//-->
</SCRIPT>
</HEAD>
<BODY>
<CENTER>
<FORM METHOD="POST" ACTION="hroom_det.php" NAME="frm1">
<TABLE CLASS='forumline' CELLPADDING="0" CELLSPACING="0"  WIDTH="90%">
<TBODY>
<TR><TD ALIGN="CENTER" CLASS="head" COLSPAN="4" ALIGN="CENTER">ADD NEW ROOMS</TD></TR>
<TR>
	<TD CLASS="row" WIDTH="10%">&nbsp;Hostel&nbsp;</TD>
	<TD CLASS="row" WIDTH="40%">
		<SELECT NAME="hname" SIZE="1" onChange="frm_reload()">
			<OPTION VALUE="0">--- Select ---</OPTION>
			<?php
			$sql = "SELECT * FROM hostel_m ORDER BY id ASC";
			$rs = execute($sql) or die("SELECT QUERY 1 : $sql " . error_description());
			if (rowcount($rs) != 0)
			{
				while ($row = fetcharray($rs))
				{
					if($hname == $row["id"])
						echo "<OPTION VALUE='$row[id]' SELECTED>$row[hostel_name]</OPTION>";
					else
						echo "<OPTION VALUE='$row[id]'>$row[hostel_name]</OPTION>";
				}
				mysql_free_result($rs);
			}
			?>
		</SELECT>
	</TD>
	<TD CLASS="row" WIDTH="10%">Block </TD>
	<TD CLASS="row" WIDTH="40%">
		<SELECT NAME="bname" SIZE="1" onChange="frm_reload()">
			<OPTION VALUE="0">--- Select ---</OPTION>
			<?
			$sql = "SELECT * FROM h_block WHERE hostel_no=$hname AND status=1";
			$rs = execute($sql) or die("SELECT QUERY 1 : $sql " . error_description());
			if (rowcount($rs) != 0)
			{
				while ($row = fetcharray($rs))
				{
					if($bname == $row["id"])
						echo "<OPTION VALUE='$row[id]' SELECTED>$row[blockname]</OPTION>";
					else
						echo "<OPTION VALUE='$row[id]'>$row[blockname]</OPTION>";
				}
				mysql_free_result($rs);
			}
			?>
		</SELECT>
	</TD>
</TR>
</TBODY>
</TABLE><br>

<?
if ((!empty($hname)) && (!empty($bname)))
{
?>
	<TABLE CELLPADDING="0" CELLSPACING="0" WIDTH="90%" ALIGN="CENTER">
	<TBODY>
    <TR><TD ALIGN="CENTER" CLASS="head" COLSPAN="4" ALIGN="CENTER">ROOM DETAILS</TD></TR>
	<TR>
<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="10%">Select</TD>
		
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="10%" nowrap>Room Number</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="10%">Extension #</TD>
		<TD CLASS="rowpic" ALIGN="CENTER" WIDTH="10%">Capacity</TD>
		
	</TR>
	<?
	$query  = "SELECT * FROM h_room_m WHERE h_id=$hname AND bid=$bname ORDER BY id ASC";
	$rs = execute($query) or die("QUERY $query " . error_description());
	if (rowcount($rs) != 0)
	{
		$i=0;
		while ($row = fetcharray($rs))
		{
			 if($i%2)
               echo "        <tr class='clsname'> ";
               else
               echo "        <tr > ";
			//echo "<TR>";
				echo"<td  align=center><input type=checkbox name=id[] value=$row[id]></td>";
				?>
				<TD  ALIGN='CENTER' WIDTH='10%'><?php echo $row[room_no]?></TD>
				<TD  ALIGN='CENTER' WIDTH='10%'><INPUT TYPE="text" NAME="ext<?php echo $row[id] ?>" size="5" value="<?php echo $row[ext_no]?>"></TD>
				<TD  ALIGN='CENTER' WIDTH='10%'><INPUT TYPE="text" NAME="capacity<?php echo $row[id] ?>" size="5" value="<?php echo$row[capacity]?>"></TD>
				</TR>
				<?php
				$i++;
		}
		mysql_free_result($rs);
	}
	?>
    </table><br>
	
<INPUT TYPE="SUBMIT" VALUE="DELETE" CLASS="bgbutton" NAME="delete">
&nbsp;&nbsp;
<INPUT TYPE="SUBMIT" VALUE="Modify" CLASS="bgbutton" NAME="modify">
<br>
	
	<table width="90%" >
        <TR><TD ALIGN="CENTER" CLASS="head" COLSPAN="4" ALIGN="CENTER">ADD ROOM</TD></TR>
    <br>
	<tr>
		<TD  ALIGN="CENTER" WIDTH="10%">Room Number </TD>
		<TD  ALIGN="CENTER" WIDTH="10%">Extension #</TD>
		<TD  ALIGN="CENTER" WIDTH="10%">Capacity </TD>
	</tr>

	<tr>		
		<TD  ALIGN="CENTER" WIDTH="10%"><INPUT TYPE="TEXT" NAME="rnumber" SIZE="10"></TD>
		<TD  ALIGN="CENTER" WIDTH="10%"><INPUT TYPE="TEXT" NAME="rextno" SIZE="10"</TD>
		<TD  ALIGN="CENTER" WIDTH="10%"><INPUT TYPE="TEXT" NAME="rcapacity" SIZE="10"></TD>
		</tr>
        </TBODY>
        </TABLE>
        <br>
		<INPUT TYPE="SUBMIT" VALUE="ADD ROOM" CLASS="bgbutton" NAME="insert">
	
<?
}
?>
</FORM>
</CENTER>
</BODY>
</HTML>

