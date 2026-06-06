<html>
<?php
include("../db.php");
$grade=$_POST['grade'];

$ay=$_POST['ay'];
$fs=$_POST['fs'];
$std=$_POST['std'];
?>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>New Page 1</title>
</head>
<body>
<table border=1 class='forumline' cellspacing=0 width="55%" align=center> 
		<tr><td colspan=3 align=center  class=head>Student Details</td></tr>
		<tr><td align=center>Student Name</td>
			<td align=center>Identification Number</blink></td>
			<td align=center>Academic Year</td>
		</tr>
		<?php
		 $qq=execute("select * from stud_health where courseid='$grade'");
		 while($ss=fetcharray($qq))
		 {
			 ?>
			 <tr><td><?php echo $ss[studname]?></td>
			 <td align=center><a href='edit_rep.php?grade=<?php echo $ss[courseid]?>&ay=<?php echo $ss[academicyear]?>&fs=<?php 
				 echo $ss['studname']?>&std=<?php echo $ss['studid']?>'>
				 <?php echo $ss[studid]?></td>
				 <td align=center><?php echo $ss[academicyear]?></td></tr>
				 <?php
		 }
			 ?>

</table>
</body>
</form>
</html>

