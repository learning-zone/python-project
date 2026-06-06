<HTML>
<HEAD>
<?php
session_start();
include("../../db.php");
$feename = $_POST['feename'];
$insert = $_POST['insert'];
$modify = $_POST['modify'];
$name = $_POST['name'];
$delete = $_POST['delete'];
$fid = $_POST['fid'];
$fName = $_POST['fName'];

$dfname = $_POST['dfname'];
$activate = $_POST['activate'];
$Types = $_POST['Types'];

/*
if($user=='')
{
	header("Location:login.php");
}
else
{
	$p_th=$_SERVER['SCRIPT_NAME'];
	$qry=execute("select * from usermenu where username='$user' and access='Yes' and linkpath='$p_th'");
	if(rowcount($qry)==0)
	{
		header("Location:login.php");
	}
}*/

// PART IS FOR ADDING THE FEE TYPE IN TABLE.
if (isset($insert))
{
	$query  = "INSERT INTO hostel_fee_type(fee_name) VALUES('".strtoupper($feename)."')";
	execute($query) or die("QUERY $query " . error_description());
	//echo "<DIV ALIGN='CENTER'><B>";
	//echo "Fee Type Entered Successfully !!</B></DIV>";	
	?>
            <script type="text/javascript">
			alert("Fee Type Entered Successfully !!");
			</script>
            <?php
}
// ENDS HERE.


// PART IS FOR MODIFYING THE FEE TYPE IN TABLE.
if (isset($modify))
{
	while (list($key, $value) = each($fid))
	{
		//$temp = "fName$value";
		//$name = strtoupper($$temp);
		$name = $_POST["fName" . $value];
		if (strlen($name) != 0)
		{
			$query  = "UPDATE hostel_fee_type SET fee_name='$name' WHERE fee_id=$value";
			execute($query) or die("UPDATE QUERY $query " . error_description());
			//echo "<DIV ALIGN='CENTER'><B>";
			//echo "Fee Type Modified Successfully !!</B></DIV>";
			?>
            <script type="text/javascript">
			alert("Fee Type Modified Successfully !!");
			</script>
            <?php
		}
		else
		{
			//echo "<DIV ALIGN='CENTER'><B>";
			//echo "Fee Type should not be Empty!!</B></DIV>";
			?>
            <script type="text/javascript">
			alert("Fee Type should not be Empty!!");
			</script>
            <?php
		}
	}
}
// ENDS HERE.

// PART IS FOR DE ACTIVATING THE FEE TYPE
if (isset($delete))
{
	while (list($key, $value) = each($fid))
	{
//		$temp = "fName$value";
		$name = $_POST["fName".$value];
		$name = strtoupper($name);
		if (strlen($name) != 0)
		{
			$query  = "UPDATE hostel_fee_type SET status=0 WHERE fee_id='$value'";
			execute($query) or die("QUERY $query " . error_description());
			//echo "<DIV ALIGN='CENTER'><B>";
//			echo "Fee Type Deactivated Successfully !!</B></DIV>";
			?>
            <script type="text/javascript">
			alert("Fee Type Deactivated Successfully !!");
			</script>
            <?php
		}
		else
		{
			//echo "<DIV ALIGN='CENTER'>";
			//echo "Fee Type should not be Empty!!</DIV>";
			//echo " value = '$value'";
			?>
            <script type="text/javascript">
			alert("Fee Type should not be Empty!!");
			</script>
            <?php
		}
	}
}
// ENDS HERE



// PART IS FOR ACTIVATING THE DEACTIVATED FEE TYPES.
if (isset($activate))
{
	while (list($key, $value) = each($dfname))
	{
		$query  = "UPDATE hostel_fee_type SET status=1 WHERE fee_id=$value";
		execute($query) or die("QUERY $query " . error_description());
		//echo "<DIV ALIGN='CENTER'><B>";
		//echo "Fee Type Activated Successfully !!</B></DIV>";
		?>
            <script type="text/javascript">
			alert("Fee Type Activated Successfully !!");
			</script>
            <?php
	}
}
// ENDS HERE.
?>

<TITLE>ADD FEE TYPE FOR HOSTELS</TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
function validate()
{
    if(document.form1.feename.value=='')
	{
	   alert("Please Enter The Fee Type");
	   document.form1.feename.focus();
	   return false;
	}
}
function activate()
{
	document.changestatus.action="alterfeetype.php?Types=Act";
	document.changestatus.submit();
}
//-->
</SCRIPT>
</HEAD>
<BODY>
<CENTER>
<FORM METHOD="POST" NAME="form1" ACTION="feetypeadd.php">
<?php
$sql = "SELECT a.* FROM hostel_fee_type a WHERE a.status<>0 ";
$rs = execute($sql) or die("QUERY $sql " . error_description());
if (rowcount($rs) != 0)
{
?>
	<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="90%" CLASS="forumline">
	<TBODY>
	<TR><TD ALIGN="CENTER" COLSPAN="2" CLASS="head">MODIFY HOSTEL FEE TYPES</TD></TR>
	<?
	$i=0;
	while ($row = fetcharray($rs))
	{
		if($i%2)
		echo "        <tr class='clsname'> ";
		else
		echo "        <tr> ";
		$i++;
		echo "<TD ALIGN='CENTER' ><INPUT TYPE='CHECKBOX' NAME='fid[]' VALUE='$row[fee_id]'></TD>";
			echo "<TD ALIGN='CENTER' ><INPUT TYPE='TEXT' SIZE='30' NAME='fName$row[fee_id]' VALUE='$row[fee_name]'></TD>";
		echo "</TR>";
	}
	mysql_free_result($rs);
	?>
    </TBODY>
	</TABLE>
    <BR>
    <div>
	<CENTER>
		<INPUT TYPE="SUBMIT" VALUE="Modify" NAME="modify" CLASS="bgbutton">&nbsp;&nbsp;
		<INPUT TYPE="SUBMIT" VALUE="Delete" NAME="delete" CLASS="bgbutton"></TD>
</CENTER>
</div>
	<BR><BR>
<?php
}
?>

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" CLASS="forumline" WIDTH="90%">
<TBODY>
<TR><TD CLASS="head" COLSPAN="2" ALIGN="CENTER">ADD FEE TYPE DETAILS</TD></TR>
<TR>
	<TD width="100%" ALIGN="CENTER" CLASS="rowpic">Fee Name</TD>
	
</TR>
<TR>
	<TD  ALIGN="CENTER"><INPUT TYPE="TEXT" NAME="feename" SIZE="30"></TD>
    </TBODY>
</TABLE><BR>
	<CENTER><div><INPUT TYPE="SUBMIT" NAME="insert" VALUE="ADD" CLASS="bgbutton" onClick="return validate()"></div></CENTER>


<BR><BR>

<?php
$sql = "SELECT fee_id, fee_name FROM hostel_fee_type WHERE status=0";
$rs = execute($sql) or die("QUERY $sql " . error_description());
if (rowcount($rs) != 0)
{
?>
	<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" CLASS="forumline" WIDTH="90%">
	<TBODY>
	<TR><TD CLASS="head" COLSPAN="2" ALIGN="CENTER">DEACTIVATED FEE TYPE DETAILS</TD></TR>
	<TR>
		<TD CLASS="rowpic" ALIGN="CENTER">Select</TD>
		<TD CLASS="rowpic" ALIGN="CENTER">Fee Name</TD>
	</TR>
	<?
	while ($row = fetcharray($rs))
	{
		echo "<TR>";
			echo "<TD ALIGN='CENTER'><INPUT TYPE='CHECKBOX' NAME='dfname[]' VALUE='$row[fee_id]'></TD>";
			echo "<TD ALIGN='CENTER'>$row[fee_name]</TD>";
		echo "</TR>";
	}
	mysql_free_result($rs);
	echo "<TR>";
		echo "<TD CLASS='row2' ALIGN='CENTER' COLSPAN='2'>";
		echo "</TBODY>";
		echo "</TABLE>";
		?>
		<br>
		<center>
		<INPUT TYPE='SUBMIT' NAME='activate' VALUE='Activate' CLASS='bgbutton'></center>
        <?php
	
	
}
?>
</CENTER>
</BODY>
</HTML>