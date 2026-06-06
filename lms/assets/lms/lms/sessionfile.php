<?php
session_start();
include("db1.php");
$q=$_GET["q"];
$_SESSION['branch']=$q;
$branch=$q;
 echo "		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<select name='sem' title='Select Class'  onChange='reload1(this.value)'><option value='select'>-Class-</option>";
		$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'> $r[year_name]</option>";
					}
				}
  echo "</select>";
?>
