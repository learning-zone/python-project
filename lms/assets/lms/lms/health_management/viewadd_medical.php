
<html>
<?php
include("../db.php");
$grade =$_POST['grade'];

$ad =$_POST['ad'];
$st =$_POST['st'];
$sid =$_POST['sid'];
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
			<td align=center>Identification Number</td>
			<td align=center>Academic Year</td>
		</tr>
		<?php
		     $rg=execute("select * from stud_health where courseid='$grade'");
			 while($fg=fetcharray($rg))
			 {
			   


		?>
		<tr>
			<td>&nbsp;<?php echo $fg[studname]?></td>
			<td align=center><a href='view_medical.php?grade=<?php echo $fg[courseid]?>&ad=<?php echo $fg[academicyear]?>&st=<?php echo $fg['studname']?>&sid=<?php echo $fg['studid']?>'>
			<?php echo $fg[studid]?></td>
			<td align=center><?php echo $fg[academicyear]?></td>
		</tr>
		<?php
			 }
        ?>
		
	</table>
</div>
</body>
</html>
