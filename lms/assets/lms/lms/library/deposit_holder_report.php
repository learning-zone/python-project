<?php
include_once("../db.php");
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$branchName=$_POST['branchName'];
$semName=$_POST['semName'];
$temp_sem=$semName;
$temp_branch=$branchName;

$onDay = date("d-m-Y");

$var = "Select b.* from student_m a,lib_membership_m b where a.course_admitted='$branch' and a.course_yearsem='$sem' and a.archive='N' and a.id=b.s_id ORDER BY a.first_name ASC";
$res = execute($var) or die(mysql_error());
$num = rowcount($res);
?>
<HTML>
<HEAD>
<script language="JavaScript">
		function printReport()
		{
			prn.style.display = "none";
			window.print();
			prn.style.display = "";
		}
</script>
</HEAD>
<BODY>
	<table border='0' align='center' width='80%' class='forumline'>
		
		<tr>
			<td class='head' align='center' colspan='4'> Card Holder Report As On <?php echo $onDay ?></td>
		</tr>
		<tr>
			<td class='head' align='center' colspan='2'>School Division : <?php echo $temp_branch ?></td>
			<td class='head' align='center' colspan='2'>Class: <?php echo $temp_sem ?></td>
		</tr>
		<tr>
			<td align="center">Sl No</td>
			<td align="center">Name</td>
			<td align="center">Member Number</td>
			<td align="center">Card Number</td>
		</tr>


<?php
for($i=1;$i<=$num;$i++)
{
	$row = fetcharray($res);
	$var1 = "select * from lib_membership_m where s_id='$row[s_id]'";
	$res1 = execute($var1);
	
	echo "<tr>";
	echo "<td align='center'>$i</td>";
	echo "<td align='center'>$row[MemberName]</td>";
	echo "<td align='center'>$row[m_no]</td>";

	while($row1 = fetcharray($res1))
	{
		echo "<td align='center'>$row1[m_no]</td>";
	}
	echo "</tr>";

}	
?>
</table>

		<p align="center">
		<input type='button' name='button' value='<<  Print  >>' class='bgbutton' onclick='printReport()'>
		</p>

</BODY>
</HTML>