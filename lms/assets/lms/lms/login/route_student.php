<?php
session_start();
require("../db.php");
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
<?
echo "<form action='route_student.php' method=post>";
echo "<input type='hidden' name='type' value='$type'>";
echo "<input type='hidden' name='routename' value='$routename'>";

$dd=execute("select * from student_m where student_id='$user'");
$hh=fetcharray($dd);
$id=1;
 echo "<Table class='forumline' align=center><tr><td class='head' colspan='6' align='center'>Route Details</td></tr>";
if($routename!=0)
	{
		$sql="select a.*,b.*,c.*,d.* from student_m a,route_master b,point_master c,pasng_route_master d";
		$sql.=" where a.id=d.pasng_id and b.id=d.route_id and d.source_pt=c.id and b.id='$routename' and d.sts=0  and a.student_id='$user'";
		
	}
	else
	{
		 $sql="select a.*,b.*,c.*,d.* from student_m a,route_master b,point_master c,pasng_route_master d";
		 $sql.=" where a.id=d.pasng_id and b.id=d.route_id and d.source_pt=c.id  and d.sts=0";
	}
 $rs=execute($sql);

 
    if($rss<0)
    {
      echo "Student Data Not Found";
      die();
    } 
?>
 <tr><td class="rowpic">Sl.No.</td><td class="rowpic">Pickup Points</td><td class="rowpic">Pickup Time</td><td class="rowpic">Passenger Type</td><td class="rowpic">Staff/Student Name</td><td class="rowpic">Contact Nos.</td></tr>
 <?php
while($rss=fetcharray($rs))
  {
     echo "<tr><td>$id</td><td>$rss[point_name]</td><td>$rss[details]</td><td>$rss[p_type]</td><td>$rss[first_name] $rss[last_name]</td><td>$rss[per_phone],$rss[father_mobile],$rss[office_phone]</td></tr>";
	$id++;
  }
	?><br><br>
	<table>
 <div id='prn' align=center colspan=5>
<center><input type=button name='prn' value="PRINT" class='bgbutton' onClick="printReport()"></center>
</table>
</body>
</html> 
</form>
