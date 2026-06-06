<html>
<HEAD>
</HEAD>

<body>
<?php 
session_start();
require("../db.php");
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];	
	$user=$_SESSION['user'];
$sql=execute("select id ,student_id ,first_name ,last_name ,admission_id ,class_section_id from student_m where student_id='$user'");
while($r=fetcharray($sql))
{
	$class_section_id=$r['class_section_id'];
	$id=$r['id'];
	$student_name=$r['first_name']." ".$r['last_name'];
}
$tablename="att_".$branch."_".$sem;
$sysdate=date("Y-m-d");

?>
<form><br>
	<table width="90%" border="1" align="center" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" class="body" align="center">
      <strong>
      <h3>
      <?php
    echo $_SESSION['SchoolName'];
	echo "<br>";
	echo $_SESSION['SchoolAddress'];
	?></h3>
      </strong>
          &nbsp;<strong>&nbsp;&nbsp;Attendance report as on today ( 
	<?php 
	echo date("d-m-Y"); 
	?> )
    </strong><br>&nbsp;</td>

  <tr>
    <td width="10%"><strong>&nbsp;Date</strong></td>
    <td width="20%"><strong><?php echo $_SESSION['semname']; ?></strong></td>
    <td width="15%"><strong>&nbsp;Code</strong></td>
    <td width="55%"><strong>&nbsp;Description</strong></td>

  </tr>

    </tr>
  <?php
  	$sql5=execute(" select id, mor,after,att_date from $tablename where att_date<='$sysdate' and stu_id='$id' and sec='$class_section_id' and (mor=0 or	after=0)");
	while($r1=fetcharray($sql5))
	{
		if($r1['mor']==0 and $r1['after']==0)
		$description='Full Day Absence ';
		else
		$description='Half Day Absence ';
	
		echo "  <tr>
		<td>&nbsp;";
		$sydate=explode("-" , $r1[att_date]);
		 echo $sydate[2]."-".$sydate[1]."-".$sydate[0];
		
		echo "</td>
    <td>&nbsp;";
	 $cr=execute("select * from course_year where year_id='$sem'");
				   $rtt=fetcharray($cr);
	echo $rtt[year_name];
	echo "</td>
    <td>&nbsp;A</td>
    <td>&nbsp;$description</td>
  </tr>";	
	}
	?>
</table>
			
</form>	
</body>
</html>