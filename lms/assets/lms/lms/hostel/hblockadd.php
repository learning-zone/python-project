 <?php
session_start();
require("../db.php");
$hostel = $_POST['hostel'];
$block = $_POST['block'];
$insert = $_POST['insert'];
$delete = $_POST['delete'];
$row = $_POST['row'];
$block_name = $_POST['block_name'];
$id = $_POST['id'];
$activate = $_POST['activate'];
$Sel = $_POST['Sel'];
$modify = $_POST['modify'];
$delete = $_POST['delete'];
$hostel_name = $_POST['hostel_name'];
// THIS PART IS FOR INSERTING THE BLOCK DETAILS IN TO THE TABLE.
if (isset($insert))
{
	if (strlen(trim($block)) > 0)
	{
		$query  = "SELECT * FROM h_block WHERE blockname='".strtoupper($block)."' AND ";
		$query .= "hostel_no=$hostel";
		$rs = execute($query) or die("QUERY $query " . error_description());
		if (rowcount($rs) == 0)
		{
			$query  = "INSERT INTO h_block (blockname, hostel_no) VALUES('";
			$query .= strtoupper($block)."', $hostel)";
			execute($query) or die("INSERT QUERY : " .error_description());
			//echo "<DIV ALIGN='CENTER'>";
			//echo "Block inserted Successfully !!</DIV>";
			?>
			<script language="JavaScript" type="text/javascript">
			alert("Block inserted Successfully !!")
            </script>
            <?php
		}
		else
		{
			//echo "<DIV ALIGN='CENTER'><B>";
			//echo "Block Already Entered !!</DIV>";
			?>
			<script language="JavaScript" type="text/javascript">
			alert("Block Already Entered !!")
            </script>
            <?php
		}
	}
	else
	{
		//echo "<DIV ALIGN='CENTER'>";
		//echo "Enter The Name of the Block Properly !!</DIV>";
			?>
			<script language="JavaScript" type="text/javascript">
			alert("Enter The Name of the Block Properly !!")
            </script>
            <?php
	}
}
// ENDS HERE.

// THIS PART IS FOR MODIFYING THE BLOCK DETAILS.
if (isset($modify))
{
	while(list($key,$value) = each($Sel))
	{
		$block_name = $_POST["block_name" . $value];
		//$block_name = trim($$block_name);
		$sql  = "UPDATE h_block SET blockname='".strtoupper($block_name)."' WHERE id=".$value;
		execute($sql) or die("UPDATE QUERY : $sql " . error_description());
		//echo "<DIV ALIGN='CENTER'>";
		//echo "Block modified Successfully !!</DIV>";
		?>
			<script language="JavaScript" type="text/javascript">
			alert("Block modified Successfully !!")
            </script>
            <?php
	}
}
// ENDS HERE.

// THIS PART IS FOR DEACTIVATING THE BLOCK DETAILS.
if (isset($delete))
{
	while(list($key,$value) = each($Sel))
	{
		$sql = "UPDATE h_block SET status='0' WHERE id=".$value;
		execute($sql) or die("UPDATE QUERY 2 : $sql " . error_description());
		//echo "<DIV ALIGN='CENTER'><B>";
		//echo "Block deactivated Successfully !!</B></DIV>";
		?>
			<script language="JavaScript" type="text/javascript">
			alert("Block deactivated Successfully !!")
            </script>
            <?php
	}
}
// ENDS HERE.

// THIS PART IS FOR ACTIVATING THE DEACTIVATED BLOCKS.
if (isset($activate))
{
	while(list($key,$value) = each($Sel))
	{
		$sql = "UPDATE h_block SET status='1' WHERE id=".$value;
		execute($sql) or die("UPDATE QUERY 3 : $sql ".error_description());
		//echo "<DIV ALIGN='CENTER'><B>";
		//echo "Block activated Successfully !!</B></DIV>";
		?>
			<script language="JavaScript" type="text/javascript">
			alert("Block activated Successfully !!")
            </script>
            <?php
	}
}
// ENDS HERE.
?>
<HTML>
<HEAD>
<TITLE>Select Block Name</TITLE>
<SCRIPT  LANGUAGE="JavaScript">

</SCRIPT>
</HEAD>
<BODY>
<CENTER>
<FORM NAME="form1" ACTION ="hblockadd.php" METHOD="POST">
<TABLE CLASS='forumline'  WIDTH="90%">
<TBODY>
<TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="2">Add Hostel Block Details</TD></TR>
<TR><td> &nbsp;Hostel</td>
	<td><SELECT NAME="hostel" onchange='form1.submit()'>
			<OPTION VALUE="0">-------Select-------</OPTION>
			<?php
			$sql = "SELECT id, hostel_name FROM hostel_m ORDER BY hostel_name";
			$rs = execute($sql) or die("SELECT QUERY 1 : $sql " . error_description());
			while ($row = fetcharray($rs))
			{
				if($hostel == $row["id"])
				{
					$hostel_name=$row[hostel_name];
					echo "<OPTION VALUE='$row[id]' SELECTED>$row[hostel_name]</OPTION>";
				}
				else
				{
					echo "<OPTION VALUE='$row[id]'>$row[hostel_name]</OPTION>";
				}
			}
			mysql_free_result($rs);
			?>
		</SELECT>
	</TD>
</TR>
</TBODY>
</TABLE>

<?php
// *********** MODIFY / DELETE BLOCK *********** //
if(!empty($hostel))
{
	$query  = "SELECT * FROM h_block WHERE hostel_no=$hostel AND status=1 ORDER BY id ASC";
	$rs = execute($query) or die("SELECT QUERY 2 : $query " . error_description());
	if(rowcount($rs) == 0)
 	{
 		//echo "<TR>";
		//echo "<TD WIDTH='50%' COLSPAN='2' ALIGN='CENTER'>";
		//echo "<B>Block Details are not added to Hostel - $hostel_name!!</B></TD>";
		//echo "</TR>";
		?>
			<script language="JavaScript" type="text/javascript">
			alert("Block Details are not added to Hostel!!")			
            </script>
            <?php
	}
	else
	{
		?>
        <BR>
        <TABLE CLASS='forumline' WIDTH="90%">
        <TBODY>
        <TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="2">Select Block Name</TD></TR>
        <TR>
        <TD CLASS='rowpic' >Select</TD>
        <TD CLASS='rowpic' nowrap >Block Name</TD>
        </TR>
        <?php
		//echo "<TR>";
		//echo "<TD CLASS='rowpic' COLSPAN='2' WIDTH='50%' ALIGN='CENTER'>Select Block Name</TD>";
		//echo "</TR>";	
		$i=0;
		while ($row = fetcharray($rs))
		{
			 if($i%2)
               echo "        <tr class='clsname'> ";
               else
               echo "        <tr> ";
				//echo "<TR>";
   				echo "<TD ALIGN='CENTER' WIDTH='35%'><INPUT TYPE='CHECKBOX' NAME='Sel[]' VALUE='$row[0]'></TD>";
				echo "<TD ALIGN='CENTER' WIDTH='15%'><INPUT TYPE='TEXT' NAME='block_name$row[0]' VALUE='$row[1]'></TD>";
				echo "<INPUT TYPE='HIDDEN' NAME='id[]' value'$row[0]'>";
			echo "</TR>";
			$i++;
		}
		?>
        </TBODY>
        </TABLE>
        <?php
		mysql_free_result($rs);
		echo "<br>";
		//echo "<TR>";
			//echo "<TD ALIGN='CENTER' WIDTH='35%'><INPUT TYPE='SUBMIT' NAME='modify' VALUE='Modify' CLASS='bgbutton'></TD>";
			//echo "<TD ALIGN='CENTER' WIDTH='15%'><INPUT TYPE='SUBMIT' NAME='delete' VALUE='Delete' CLASS='bgbutton'></TD>";
			echo "<INPUT TYPE='SUBMIT' NAME='modify' VALUE='Modify' CLASS='bgbutton'>";
			echo "&nbsp;";
			echo "<INPUT TYPE='SUBMIT' NAME='delete' VALUE='Delete' CLASS='bgbutton'>";
		echo "<BR>";
		//echo "</tbody>";
		//echo "<table>";
	}
}
else
{
	echo "<TR>";
		echo "<TD COLSPAN='2' ALIGN='CENTER' WIDTH='50%'>";
		echo "Select The Hostel !!</TD>";
	echo "</TR>";
}

// ************ ADD BLOCK ************* //
?>
<br>
<TABLE CLASS='forumline'  WIDTH="90%">
<TBODY>
<TR>
<TD CLASS="head" ALIGN="CENTER" COLSPAN="2">New Block Details</TD></TR>
<TR>
<td>&nbsp;Block Name </td>
<TD CLASS="row" ALIGN="CENTER" WIDTH="35%"><INPUT TYPE="TEXT" NAME="block" SIZE="25"></TD>
</TBODY>
</TABLE>
<br>
<div>
<INPUT TYPE="SUBMIT" VALUE="ADD" CLASS="bgbutton" NAME='insert'>
</div>



<?php
// *********** DEACTIVATED BLOCK DETAILS ********* //
if(!empty($hostel))
{
	$rs_sql = execute("SELECT * FROM h_block WHERE hostel_no=$hostel AND status='0' ORDER BY id ASC");
	if(rowcount($rs_sql)==0)
	{
		//echo "<TR>";
		//echo "<TD COLSPAN='2' ALIGN='CENTER' WIDTH='50%'>";
		//echo "No De-activted Blocks !!</TD>";
		//echo "</TR>";
	}
	else
	{
		//echo "<TR>";
		//echo "<TD COLSPAN='2' CLASS='row2' ALIGN='CENTER' WIDTH='50%'><B>DE-ACTIVATED BLOCK DETAILS</B></TD>";
		//echo "</TR>";
		?>
        <BR>
        <TABLE CLASS='forumline' WIDTH="90%">
        <TBODY>
        <TR><TD CLASS="head" ALIGN="CENTER" COLSPAN="2">De-Activated Blocks</TD></TR>
        <?php
		echo "<TR>";
			echo "<TD CLASS='rowpic' >Select</TD>";
			echo "<TD CLASS='rowpic' nowrap >Block Name</TD>";
		echo "</TR>";
		while ($row = fetcharray($rs_sql))
		{
			echo "<TR>";
			echo "<TD  WIDTH='15%' ALIGN='CENTER'><INPUT TYPE='CHECKBOX' NAME='Sel[]' VALUE='$row[0]'>";
				echo "<TD  WIDTH='35%' ALIGN='CENTER'><INPUT TYPE='TEXT' NAME='block_name$row[0]' VALUE='$row[1]'></TD>";
				
				echo "<INPUT TYPE='HIDDEN' NAME='id[]' VALUE='$row[0]'>";
				echo "</TR>";
				echo "</TBODY>";
				echo "</TABLE>";
		}
		mysql_free_result($rs_sql);
		//echo "<TR>";
		//echo "<TD COLSPAN='2' ALIGN='CENTER' WIDTH='50%'>";
		echo "<br>";
		echo "<INPUT TYPE='SUBMIT' NAME='activate' VALUE='Activate' CLASS='bgbutton'></TD>";
		echo "</TR>";
	}
}
?>

</FORM>


</CENTER>
</BODY>
</HTML>
