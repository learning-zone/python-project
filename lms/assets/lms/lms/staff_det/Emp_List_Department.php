<?php
  session_start();
require("../db.php");
$subj = $_POST['subj'];
?>

<html>

<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">



<Script language="JavaScript">
function start()
{
 document.frm.dob.options[0].selected=true
}
function delete_me(id1)
{

	if(confirm("Are you sure that you want to delete this record"))
	{
		window.location.href = "delete.php?delete_id=" + id1;
	}
}

function check_data()
{
  document.frm.submit();
}

</script>

</head>

<body topmargin="15" leftmargin="5" onLoad="start()" link="#000000">

  
    
    <form method="POST"  action="emp_list_dep.php" name="frm">
    <center>  <table width="80%" border=0 class="forumline">
<tr>
<td Class="head" colspan=4 align=center >View Staff Details</td>
</tr>
<tr>
          <td align=center>Department</td>
         
          <td align=center><select  name="subj" size="1">
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
</select></td>

        </tr>  </table>
        <br>
<center>		   <input type="button" value="Search" name="B1" onClick="check_data()" class='bgbutton'></font></center>
     <input type="hidden" name="display" value="<?php echo $display?>">

	 <input type='hidden' name='key2' value="<?php echo ASC ?>">
		<input type='hidden' name='key1' value="<?php echo slno ?>">
    </form>
    </td>
 </body>
</html>

