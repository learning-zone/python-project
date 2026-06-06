<?php
session_start();
require("../db.php");
$dd=execute("select * from student_m where student_id='$user'");
$hh=fetcharray($dd);
if(rowcount($dd)>0)
{

?>
<html>
<head>
<script>
function printReport()
{
	prn.style.display='none';
	print(this.form);
}
</script>
</head>
<body>
<?php
echo "<form action='route_student.php' method=post>";
echo "<input type='hidden' name='type' value='$type'>";
echo "<input type='hidden' name='routename' value='$routename'>";
echo "<Table class='forumline' align=center><tr><td class='head' colspan='2' align='center'>Route Details</td></tr>";



	echo "<tr>";
	echo "<td align='right'>Type</td>";
	echo "<td>";
	echo "<select name=type>";
		echo "<option value=''>Student</option>";
		$qry="select * from type order by type";
		$rs = execute($qry);
	echo "</select></td></tr>";
	echo "<tr>";
	echo "<td align='right'>Route</td>";
	echo "<td>";
	echo "<select name=routename >";
		echo "<option value='0'>ALL Routes</option>";
		$qry="select * from route_master  order by route_name";
		$rs = execute($qry);
		if($rs)
		{
		  if(rowcount($rs)>0)
			{
				while($row=fetcharray($rs))
				{
					if($routename==$row[id])
					{
						echo "<option value='$row[id]' selected>$row[route_name]</option>";
					}
					else
					{
						echo "<option value='$row[id]'>$row[route_name]</option>";
					}
				}

			}

		}
	echo "</select></td>";
	echo "</tr>";
	
?>
<tr><td colspan=2><center><input type="submit" name="rep" value="Submit" class='bgbutton'></center></td></tr>

</table>
<?
}

else
die("<font color='red'>This link is only for Students </font>");
?>
</form>

