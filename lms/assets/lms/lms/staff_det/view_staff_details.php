<?php
  session_start();
require("../db.php");
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

<body topmargin="15" leftmargin="5" onLoad="start()" link="#000000">
<center>
<table width="50%" class="forumline"><tr><td Class="head" align='center'><font face='Lucida Sans' size='3'>View Staff Details</font></td></tr>
</center>

<tr><td><div align="center"><center>
<table border="0"  cellspacing="0" cellpadding="0">
  <tr>
    <td nowrap="nowrap" width="100%"><font face="Arial">To Search enter the keywords into any/all of the
    relevant fields below and click <br>
    &quot;Search&quot;.<br>
    <tt><font color="#FF0000"><u>Example:</u> </font><strong>First Name:</strong> xyz <strong>Birth
    Month:</strong> April <strong>Experience:</strong> 2 Years</tt></font>
    <form method="POST"  action="searchResult1.php" name="frm">
      <table border="0" width="100%" cellpadding="2">
        <tr align="center">
        <td colspan="4"><hr></td>
        </tr>
        <tr align="center">
			
        </tr>
         <tr align="center">
          <td width="13%" nowrap="nowrap"><font face="Arial">First Name</font></td>
          <td width="19%"><div align="left"><p><input type="text" name="f_name" size="15" ></td>
          <td align='center'><font face="Arial">Staff ID</font></font></td>
			<td width="19%"><div align="left"><p><input type="text" name="staff_id" size="15" ></td>
        </tr>
        <tr align="center">
          <td colspan='2'><font face="Arial"><div align="right"><p>Department</font></td>
          <td colspan='2' align="center"><div align="left"><p>
          <select  name="subj" size="1">
          <option  value="0">-:- Select a Department -:-</option>
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
        <tr align="center">
          <td width="40%" colspan="2"><font face="Arial"><div align="center"><center><p><input
          type="button" value="Search" name="B1" onClick="check_data()" class='bgbutton'></font></td>
          <td width="40%" colspan="2" align="center"><font face="Arial"><div align="center"><center><p><input
          type="reset" value="Clear All" name="B2" class='bgbutton'></font></td>
        </tr>
        <tr align="center">
          <td width="80%" colspan="4"><hr>
          </td>
        </tr>
      </table>
      <input type="hidden" name="display" value="<?php echo $display?>">
    </form>
    </td>
  </tr>
</table></tr></td></table>
</center></div>
</body>
</html>