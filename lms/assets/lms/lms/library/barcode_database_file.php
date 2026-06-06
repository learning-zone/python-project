<?php
require_once("../db.php");
$library=$_POST['library'];
$media=$_POST['media'];
$acc_from=$_POST['acc_from'];
$acc_to=$_POST['acc_to'];
?>
<HTML>
<HEAD>
<script language="javascript">
function frm_submit()
{
	var acc_from,acc_to;
	acc_from= document.form1.acc_from.value;
	acc_to= document.form1.acc_to.value;

	if (document.form1.acc_from.value=="" || document.form1.acc_to.value=="" )
	{
		alert("Enter Accession No From and To ");
		document.form1.acc_from.focus();
		return false;
	}
/*	if (acc_from.length < 6 || acc_to.length < 6 )
	{
		alert("Enter Valid Accession  ");
		document.form1.acc_from.focus();
		return false;
	}*/
	if (acc_from > acc_to)
	{
		alert("Accession No From can't be greater than accession no To  ");
		document.form1.acc_from.focus();
		return false;
	}
	document.form1.action='create_barcode_data_file.php';
	document.form1.submit();
}
</script>
<BODY topMargin=0 leftMargin=0>
<form method="POST" action='barcode_database_file.php' name="form1">
<table border="1" width="47%" cellspacing="0" cellpadding="0" align='center' class=forumline>
<tr><td colspan=3 class='head' align='center'>Create Barcode Database File</td></tr>
<?php
	echo "<tr>";
	$Register=1;
	echo "</tr>";
if($register !=0 && $register !="" || $register!=-1)
{
	echo "<tr>";
	echo"<td align='right'>Media &nbsp;</td>";
	echo"<td><select name=media>";
	echo "<option value='1' >Book</option>";
	echo "<option value='2' >CD's/DVD's</option>";
	//echo "<option value='3' >Book Floppy</option>";
	//echo "<option value='4' >Other CD</option>";
	echo "<option value='5' >Project Report</option>";
	//echo "<option value='6' >Bound Volumes</option>";
	echo "</select></td>";
	echo "</tr>";
	echo "<tr><td colspan=2 align='center'>Accession No.</td>";
	echo "</tr>";
	echo "<tr>";
	echo"<td colspan=2 align='center'>From &nbsp;<input type='text' name='acc_from' size=10 maxlength=8 >&nbsp; To &nbsp;<input type='text' name='acc_to' size=10 maxlength=8 ></td>";
	echo "</tr>";
	//echo"<tr>";
	//echo"<td colspan=2 align='center'><input type='button' value='<<  Submit  >>' name='submit1' onClick='frm_submit()' class='bgbutton'></td>";
	//echo "</tr>";
}
?>
</table>
 <p align='center'><input type='button' value='<<  Submit  >>' name='submit1' onClick='frm_submit()' class='bgbutton'></p>
</form>
</BODY>
</HTML>