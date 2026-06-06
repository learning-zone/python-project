<?php
//Jahnavi Itagi 13/08/2003 This form shows Employee List According to the staff type
session_start();
include("../db.php");
$stafftype = $_POST['stafftype'];

?>
<html>
<body>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
</head>
</head>

<table align=center >

</table>
<form name="frm" method="POST" action="View_Emplist.php">
<table align=center border=0 cellspacing=2 cellpadding=0 width="50%" class="forumline">
<tr><td class="head" colspan=2 align=center>Details of Employee List</td></tr>
<tr>
<td>Staff Type</td>
<td><select name=stafftype>
<option value='0'>-- All --</option>
<?php
$sql="select * from $_DATABASE_.staff_group order by id";
$rs=execute($sql);
$num=rowcount($rs);
if($num!=0)
{
	for($i=0;$i<$num;$i++)
	{
            $row=fetcharray($rs,$i);
	    echo "<option value=$row[id]>$row[name]</option>";
	}
}
?>
</select>
</td>
</tr>
</table>
<table align=center >
</table>
<br>
<center><input type=submit name=view value="View Report" class="bgbutton"></center>


</form>
</body>
</html>

