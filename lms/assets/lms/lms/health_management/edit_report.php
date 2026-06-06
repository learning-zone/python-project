<html>
<?php
	session_start();
	include("../db.php");
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
?>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>New Page 1</title>
</head>
<script>
function reload()
{
	if(document.frm.mtype.value=='1')
	{
		document.frm.action='edit_stud.php';
		document.frm.submit();
	}
	else if(document.frm.mtype.value=='2')
	{
		document.frm.action='edit_staffs.php';
		document.frm.submit();
	}
	else if(document.frm.mtype.value=='3')
	{
		document.frm.action='edit_medical_others.php';
		document.frm.submit();
	}
	else if(document.frm.mtype.value=='')
	{
		alert('Please Select Type');
		return false;
	}
}
</script>
<body>
<p>&nbsp;</p>
<form name='frm'> 
<input type=hidden name='branch' value='<?php echo $branch?>'>
<input type=hidden name='sem' value='<?php echo $sem?>'>

<table  class='forumline' cellspacing=0 align=center width='35%'>
<tr><td align=center colspan=2  class=head>Edit Accident Report</td></tr>
<tr><td >Select Type</td>
<td><select name='mtype' onchange='reload()'>
<option value='0'>---Select---</option>
<option value='1'>Student</option>
<option value='2'>Staff</option>
<option value='3'>Others</option>
</select></td><tr>
</table><br>
</div>
</form>
</body>
</html>
