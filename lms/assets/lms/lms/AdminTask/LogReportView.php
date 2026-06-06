<html>
<head><title>View Log Report</title>
<script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
<SCRIPT LANGUAGE="JavaScript">

function win_open()
{
	var a = document.MyFrm.username.value;
	var len = a.length;
	if (a == "")
	{
		alert("Enter the Username atleast 3 characters !!");
		document.MyFrm.username.focus();
		return false;
	}
	else if (len < 3)
	{
		alert("Enter the First 3 characters of Username !!");
		document.MyFrm.username.focus();
		return false;
	}
	var x = window.open("usersearch4.php?username="+a,"user1","width=500,height=500,status=no,toolbar=no,scrollbar=no,menubar=no,sizeable=0");
}

function checkIt(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT ) 
	{
		
			if((charCode == 37) || (charCode == 39)|| (charCode == 110)|| (charCode == 46) || (charCode==190))
			{
				return true
			}
			else
			{
				alert("Please make sure entries are numbers only.")
				return false
			}
	}
	return true
}
</SCRIPT>
</head>
<body class='bodyline'>
<?php
	include("../db.php");
	include("../urlaccess.php");
	
	$username = $_POST['username'];
	$modulename = $_POST['modulename'];
	$date31 = $_POST['date31'];
	$date32 = $_POST['date32'];
	$FromDate = $_POST['FromDate'];
	$ToDate= $_POST['ToDate'];
	
	$submit11 = $_POST['submit11'];

	$CDate=explode("-",date("d-m-Y"));

?>

<form method="post" name="MyFrm">

<table class='forumline' align='center'>

<tr><td Class="head" align='center'colspan="4">View Log Report</td></tr>

<?php
/*
<tr><td>Users</td>
<td colspan=3><INPUT TYPE="TEXT" NAME="username" SIZE="15" value=<?=$username?>>&nbsp;&nbsp;
<INPUT TYPE="BUTTON" NAME="search" VALUE="SEARCH" CLASS="bgbutton" onClick="return win_open()"></td>
*/
echo "<td align='left' >User Name</td>";
echo "<TD WIDTH=45% ALIGN=LEFT>";

$query = "SELECT username FROM users WHERE Activated='On'  ORDER BY username";
$rs = execute($query) or die("QUERY $query " . error_description());
echo " <select name='username' onChange='reload1()'>";
echo "<OPTION VALUE='0'>------------ Select ------------</OPTION>";
while($trow=fetcharray($rs))
{
	//echo "<option value='$trow[0]'>$trow[0]</option>";
	if($username==$trow[username])
	{
		echo "<option value='$trow[username]' selected>$trow[username]</option>";
	}
	else
	{
		echo "<option value='$trow[username]'>$trow[username]</option>";
	}
}
echo "</select></TD>";
?>
</tr>

<tr><td>Select Module</td><td colspan=3><select name="modulename">
<option value=''>------------ Select ------------</option>
<option value="-1">All Modules</option>
<?php
	$sql=execute("select * from modules");

	for($i=0;$i<rowcount($sql);$i++)
	{
		$r=fetcharray($sql,$i);
		if($modulename==$r[module])
		{
		echo "<option value='$r[module]' selected>$r[module]</option>";
		}
		else
		{
		echo "<option value='$r[module]'>$r[module]</option>";
		}
	}
?>
</select>
</td></tr>
<tr>
<td >Enter From Date
<td nowrap>
		<input type="text" readonly="" name="date31" value="<?php echo $date31?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar31')"><img src="../images/calendar.jpg"  ></a>
        </td>
        <tr>
        <td >Enter To Date
        <td nowrap>
		<input type="text" readonly="" name="date32" value="<?php echo $date32?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar32')"><img src="../images/calendar.jpg"></a>
        </td>
        </tr>
<?
/*
<input type="text" name="FromDay" onkeydown='return checkIt(event)' size="2" maxlength="2" value="<?=$CDate[0]?>">
<input type="text" name="FromMon" onkeydown='return checkIt(event)' size="2" maxlength="2" value="<?=$CDate[1]?>">
<input type="text" name="FromYear" onkeydown='return checkIt(event)' size="4" maxlength="4" value="<?=$CDate[2]?>">
Enter To Date

<input type="text" name="ToDay" onKeyDown="return checkIt(event)" size="2" maxlength="2" value="<?=$CDate[0]?>">
<input type="text" name="ToMon" onKeyDown="return checkIt(event)" size="2" maxlength="2" value="<?=$CDate[1]?>">
<input type="text" name="ToYear" onKeyDown="return checkIt(event)" size="4" maxlength="4" value="<?=$CDate[2]?>">
</td></tr>
*/
?>
</table>
<br>
<div align='center'><input type="submit" name='submit11' value="View Detailed Log Report" class='bgbutton'></div>
<?
if(isset($submit11))
{

//From Date and To Date format was not correct it has been rectified and it has been hidden

//$FromDate=$date31;
$FromDate = date("Y-m-d", strtotime($date31));
//$ToDate = date("Y-m-d", strtotime($date33));
$ToDate=$date32;

echo "<input type=hidden name=FromDate value=$FromDate>";
echo "<input type=hidden name=ToDate value=$ToDate>";

?>
<SCRIPT LANGUAGE="JavaScript">
document.MyFrm.action="LogReportDetails.php";
document.MyFrm.submit();
</SCRIPT>
<?
}
?>
</form></body></html>
