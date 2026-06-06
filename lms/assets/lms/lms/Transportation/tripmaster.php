<?php
session_start();
require("../db.php");


if(isset($add))
{
if(($tripname=='')||($triptime==''))
		die("<font color=red><b>Fields Should Not Be Empty....!</b></font><br><font color=red><b><a href=tripmaster.php><u>Back</u></b></font><br>");
	$ts=execute("select * from trans_tripmaster where trip_name='$tripname' and route_id=$route2");
	
	if(rowcount($ts)==0)
	{
		$sql1="insert into trans_tripmaster values(null,'$route2','$tripname','$triptime')";
		$rs1=execute($sql1);
	}else
	{
		echo "<font color=blue><small><b>Duplicate Entry</b></small></font>";
	}
}
else if(isset($mod))
{
	if(isset($id))		
	{
		while(list(,$value)=each($id))
		{
			$tn="tname".$value;
			$tna=$$tn;
			$tt="ttime".$value;
			$tti=$$tt;
			$ts=execute("select * from trans_tripmaster where trip_name='$tna' and trip_time ='$tti' and route_id='$route2'");
			//echo ("select *from trans_tripmaster where trip_name='$tna',trip_time ='$tti' and route_id='$route2'");
			$a=rowcount($ts);
			if($a==0)
			{
			$sql2="update trans_tripmaster set trip_name='$tna',trip_time ='$tti' where id='$value'";
			//echo "$sql2";
			$rs1=execute($sql2);
			}
			else
			{
				echo "<font color=blue><small><b>Duplicate Entry</b></small></font>";
			}
		}
	}
	
	else
	{
		echo "<font color=red><b>Please Select The Check Box....!</b></font><br>";
		echo "<font color=red><b><a href=tripmaster.php><u>Refresh</u></b></font><br>";
	}
}

?>
<html>
<head>
<script language=Javascript>
function reload()
{
document.frm.action = "tripmaster.php";
document.frm.submit();
}
</script>
</head>

<body>
<form method=post name="frm" action="tripmaster.php">
<Table class='forumline' align=center width="66%">
  <tr><td class='head' align=center colspan='3'><b> Trip Master</b></td></tr>
  <tr><td class="rowpic" colspan=3 align='center'><b>Trip Details </b></td></tr>
  <tr>
	<td align='center'><select name="route2" Onchange=reload()>
	<option value="">Select Route</option>
<?php
$sql1="select * from trans_route_master ";
$rs1=execute($sql1);
for($j=0;$j<rowcount($rs1);$j++)
	{
	$r1=fetcharray($rs1,$j);

	if($r1["id"]==$route2)
	{
		echo "<option value=$r1[id] selected> $r1[route_name]</option>";
	}
	else
	{
	echo "<option value=$r1[id]> $r1[route_name]</option>";
	}
	}
?>
</select>
<?php
echo "</table>";
echo "<br><Table class='forumline' align=center>";
if($route2 !="")			
{
	$sql=execute("select * from trans_tripmaster where route_id=$route2");
	if(rowcount($sql) !='0')
	{
		echo "<tr><td Class='row3' align='center' colspan='3'>Modify Trip Details</td></tr>";
		echo "<tr><td> select </td><td> Trip Name </td><td> Trip Time</td></tr>";
		for($i=0;$i<rowcount($sql);$i++)
		{
			$rs=fetcharray($sql,$i);
			//echo "name".$rs[trip_name];
			echo "<tr><td> <input type='checkbox' name='id[]' value='$rs[id]'> </td>";
			echo "<td> <input type='text' name='tname$rs[id]' value='$rs[trip_name]'> </td>";
			echo "<td><input type='text' name='ttime$rs[id]' value='$rs[trip_time]'></td></tr>";
		}
		echo "<tr><td colspan=3 align=center><input type='submit' name='mod' value='Modify' class='bgbutton'></td></tr>";
	}
	echo "<tr><td Class='row3' align='center' colspan=3>Add Trip Details</td></tr>";
	echo "<tr><td> Trip Name </td>";
	echo "<td>Trip Time";
	echo "</td><td></td></tr>";
	echo "<tr><td>";
	echo "<input type='text' name='tripname'></td>";
	echo "<td><input type='text' name='triptime'><td></td>";
	echo "</tr> ";
	echo "<tr><td colspan='3' align=center><input type='submit' name='add' class='bgbutton' value='Add' ></td></tr>";
	echo "</table>";
}
?>
</div>
</form>
</body>
</html>