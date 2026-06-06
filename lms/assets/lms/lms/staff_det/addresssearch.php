<?php
  session_start();
require("../db.php");
$f_name=$_POST['f_name'];
$staff_status=$_POST['staff_status'];
$staff_id=$_POST['staff_id'];
$subj=$_POST['subj'];
?>
<html>
<head>
<title>View </title>
<Script language="JavaScript">
function start()
{
 document.frm.dob.options[0].selected=true
}
function delete_me(id1)
{

	if(confirm("Are you sure that you want to delete this record"))
	{
		window.location.href = "delete_sta.php?delete_id=" + id1;
	}
}

function check_data()
{
  document.frm.submit();
}

</script>

</head>

<body onLoad="start()">
    <form method="POST"  action="addressprint2.php" name="frm">

<table width="90%" align="center" class="forumline">
<tr>
<td align="center" class="head" colspan="4">
Address Search</td>
</tr>
<tr>
    <td width="25%" nowrap="nowrap">First Name</td>
    <td width="25%"><input type="text" name="f_name" size="15" ></td>
    <td width="25%">Staff ID</td>
    <td width="25%"><input type="text" name="staff_id" size="15" ></td>
</tr>
<tr align="center">
<td width="25%" align="left" nowrap="nowrap">Staff Status</td>
<td width="25%" align="left"><select  name="staff_status" size="1">
<option  value="0">Select</option>
<option value='1'>Active</option><option value='2'>Archieve</option>
</select>
</td>
<td width="25%" align="left" >Department</td>
<td width="25%" align="left" >
<select  name="subj" size="1">
<option  value="0"> Select </option>
<?php
$temp = "SELECT * FROM dept_no";

$rs = execute($temp);

$num = rowcount($rs);

for($i=0;$i<$num;$i++)
{
$r = fetcharray($rs,$i);
echo("<option value='" . $r[1] . "'>" . $r[0] . "</option>");
}
?>
</select></td></tr>

</table>
      <input type="hidden" name="display" value="<?php echo $display?>">            <p align="center"  ><input type="button" value="Search" name="B1" onClick="check_data()" class='bgbutton'>&nbsp;&nbsp;&nbsp;&nbsp;    <input type="reset" value="Clear All" name="B2" class='bgbutton'></p>
    </form>
</body>
</html>